Feature: Search suppliers
  In order to find suppliers
  As a User
  I want to search for suppliers

  Scenario: Search supplier without login
    When I build a "GET" request on "/api/supplier/search"
    Then the response status code should be 403

  Scenario: Search products with login whithout parameters
    Given I build a "GET" request on "/api/supplier/search" with email "admin@fake-mail.fr" and password
    And I specified the following json in request:
    """
    {
    }
    """
    Then the response status code should be 200
    And the response should contain the following json:
    """
    {
      "errors": false,
      "data": [
      ],
      "totalItems": 8,
      "totalPages": 1,
      "page": 1,
      "limit": 10
    }
    """
