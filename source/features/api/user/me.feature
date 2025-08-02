Feature: User me

  Scenario: Get user without login
    When I build a "GET" request on "/api/user/me"
    Then the response status code should be 403

