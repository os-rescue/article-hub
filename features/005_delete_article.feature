@delete_article
Feature: Delete article
  @loginAsUser1
  @setToken
  @secureClient
  Scenario: Create an article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I create a current article with body:
    """
      {
        "title": "foo 123",
        "content": "123 bar"
      }
    """
    Then the response status code should be 201

  @setToken
  Scenario: Gets the list of articles
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/api/articles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "hydra:totalItems" should be equal to the number 3

  @setToken
  @secureClient
  Scenario: I delete the previous article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I delete the current article
    Then the response status code should be 204
    
  @setToken
  Scenario: Gets the list of articles
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/api/articles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "hydra:totalItems" should be equal to the number 2
