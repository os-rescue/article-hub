@update_article
Feature: Update article
  @loginAsUser1
  @setToken
  @secureClient
  Scenario: Create an article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I create a current article with body:
    """
      {
        "title": "test 123",
        "content": "123 test"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "title" should be equal to the string "test 123"
    And the JSON node "content" should be equal to the string "123 test"

  @setToken
  @secureClient
  Scenario: I update the previous article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I update the current article with body:
    """
      {
        "title": "test 321",
        "content": "321 test"
      }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "title" should be equal to the string "test 321"
    And the JSON node "content" should be equal to the string "321 test"

  @loginAsUser2
  @setToken
  @secureClient
  Scenario: As a User2 I can't update the content of the current article 
    When I add "Content-Type" header equal to "application/json"
    When I add "Accept" header equal to "application/ld+json"
    And I update the current article with body:
    """
    {
      "content": "Lorem ipsum 01"
    }
    """
    Then the response status code should be 403
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "hydra:title" should be equal to the string "An error occurred"
    And the JSON node "hydra:description" should be equal to the string "Access Denied."
