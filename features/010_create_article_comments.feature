@create_article
Feature: Create article
  @loginAsUser1
  @setToken
  @secureClient
  Scenario: Create an article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I create a current article with body:
    """
      {
        "title": "bar",
        "content": "foo"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "title" should be equal to the string "bar"
    And the JSON node "content" should be equal to the string "foo"

  