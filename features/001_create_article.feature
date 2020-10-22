@create_article
Feature: Create article
  @loginAsUser1
  @setToken
  @secureClient
  Scenario: Create an article
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/articles" with body:
    """
      {
        "title": "foo",
        "content": "bar"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "title" should be equal to the string "foo"
    And the JSON node "content" should be equal to the string "bar"

  @setToken
  @secureClient
  Scenario: I can't create an article with empty title and empty content
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/articles" with body:
    """
      {
        "title": ""
      }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON nodes should be equal to:
      | violations[0].propertyPath | title |
      | violations[0].message | not_blank   |
      | violations[1].propertyPath | content |
      | violations[1].message | not_null   |

  @setToken
  @secureClient
  Scenario: I can't create a shopping item with null title and empty content
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/articles" with body:
    """
      {
        "content": ""
      }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON nodes should be equal to:
      | violations[0].propertyPath | title |
      | violations[0].message | not_null   |
      | violations[1].propertyPath | content |
      | violations[1].message | not_blank   |
