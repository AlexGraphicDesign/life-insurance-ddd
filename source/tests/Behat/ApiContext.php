<?php

declare(strict_types=1);

namespace Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Coduo\PHPMatcher\PHPUnit\PHPMatcherAssertions;
use Safe\DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class ApiContext implements Context
{
    use PHPMatcherAssertions;

    /**
     * @var array<string, array<string, string>>
     */
    private static array $savedCookies = [];
    private ?Response $response = null;
    private string $uri;
    private string $method;
    private ?string $content = null;
    /**
     * @var array<string, string>
     */
    private array $headers = [];
    /**
     * @var array<string, mixed>
     */
    private array $formParams = [];
    /**
     * @var array<string, mixed>
     */
    private array $queryParams = [];
    /**
     * @var array<string, string>
     */
    private array $cookies = [];

    public function __construct(private readonly KernelInterface $kernel)
    {
        $this->kernel->boot();
    }

    /**
     * @Given I build a :method request on :uri
     */
    public function iBuildRequestOn(string $method = 'GET', string $uri = ''): void
    {
        $this->iBuildRequestOnWithCookie($method, $uri, false);
    }

    /**
     * @Given I build a :method request on :uri with cookie
     */
    public function iBuildRequestOnWithCookie(string $method = 'GET', string $uri = '', bool $withCookie = true): void
    {
        $this->formParams = [];
        $this->queryParams = [];
        $this->content = null;
        $this->headers = [];
        $this->uri = $uri;
        $this->cookies = $withCookie ? $this->getCookies() : $this->cookies;
        $this->method = strtoupper($method);
        $this->response = null;
    }

    /**
     * @Given I build a :method request on :uri with email :email and password
     */
    public function iBuildRequestWithLoginOn(string $method = 'GET', string $uri = '', string $username = '', string $password = 'test'): void
    {
        if (!isset(self::$savedCookies[$username])) {
            $this->iBuildRequestOn('POST', '/api/user/login');
            $this->iAddHeaderEqualTo('content-type', 'application/json');
            $this->content = json_encode(['username' => $username, 'password' => $password], JSON_THROW_ON_ERROR);
            $this->theResponseStatusCodeShouldBe(200);
            self::$savedCookies[$username] = $this->getCookies();
        }
        $this->cookies = self::$savedCookies[$username];
        $this->iBuildRequestOnWithCookie($method, $uri, false);
    }

    /**
     * @Then the response status code should be :code
     */
    public function theResponseStatusCodeShouldBe(int $responseCode): void
    {
        try {
            $response = $this->getResponse();
        } catch (\Exception $e) {
            if (404 !== $responseCode) {
                throw new \RuntimeException(sprintf('Response should be "%s" but message is %s', $responseCode, $e->getMessage()));
            }
        }

        if (isset($response) && $response->getStatusCode() !== $responseCode) {
            throw new \RuntimeException(sprintf('Response should be "%s" found "%s"', $responseCode, $this->response->getStatusCode()));
        }
    }

    private function getCookies(): array
    {
        $cookies = [];
        foreach ($this->getResponse()->headers->getCookies() as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        return $cookies;
    }

    private function getResponse(): Response
    {
        if (!$this->response) {
            $request = new Request(
                $this->queryParams ?? [],
                $this->formParams ?? [],
                [],
                $this->cookies ?? [],
                $this->files ?? [],
                [],
                $this->content);
            $request->server->set('REQUEST_METHOD', $this->method);
            $request->server->set('REQUEST_URI', $this->uri);
            $request->server->set('HTTPS', 'on');
            $request->headers->add($this->headers ?? []);

            $this->response = $this->kernel->handle($request);
        }

        return $this->response;
    }

    /**
     * @When I add :header header equal to :value
     */
    public function iAddHeaderEqualTo(string $header, string $value): void
    {
        $this->headers[$header] = $value;
        $this->response = null;
    }

    /**
     * @Given I specified the following json in request:
     */
    public function iSpecifiedTheFollowingJsonInRequest(string $content): void
    {
        $this->iAddHeaderEqualTo('Content-Type', 'application/json');
        preg_match_all('#\((now.*)\)#', $content, $matchs);
        foreach ($matchs[0] as $key => $value) {
            $date = new DateTime($matchs[1][$key]);
            $content = str_replace($value, $date->format('Y-m-d H:i:s'), $content);
        }

        $this->content = $content;
    }

    /**
     * @Given the request should have these parameters:
     */
    public function theRequestShouldHaveTheseParameters(TableNode $parameters): void
    {
        foreach ($parameters->getRowsHash() as $parameter => $content) {
            preg_match_all('#\((now.*)\)#', $content, $matchs);
            foreach ($matchs[0] as $key => $value) {
                $date = new DateTime($matchs[1][$key]);
                $content = str_replace($value, $date->format('Y-m-d H:i:s'), $content);
            }

            $this->queryParams[$parameter] = $content;
        }
    }

    /**
     * @Then the response should contain the following json:
     */
    public function theResponseShouldContainsTheFollowingJson(string $string): void
    {
        $content = $this->getResponse()->getContent();
        try {
            $this->assertMatchesPattern(
                $string,
                $content,
            );
        } catch (\Exception $e) {
            // TODO: Mieux gérer les exceptions
            throw new \Exception(sprintf("Error on compare, difference in %s \n. Response should be %s found %s", $e->getMessage(), $content, $string), $e->getCode(), $e);
        }
    }
}
