@get_articles
Feature: Get articles
  @loginAsUser1
  @setToken
  Scenario: Gets the list of articles
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/api/articles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON node "hydra:totalItems" should be equal to the number 2And the JSON node "hydra:totalItems" should be equal to the number 3
    And the JSON should be valid according to this schema:
    """
    {
      "$schema": "http://json-schema.org/draft-07/schema",
      "$id": "http://example.com/example.json",
      "type": "object",
      "title": "The Root Schema",
      "additionalProperties": true,
      "required": [
        "hydra:member",
        "hydra:totalItems",
        "hydra:search"
      ],
      "properties": {
        "@context": {
          "$id": "#/properties/@context",
          "type": "string",
          "title": "The @context Schema",
          "examples": [
            "/api/contexts/Articles"
          ]
        },
        "@id": {
          "$id": "#/properties/@id",
          "type": "string",
          "title": "The @id Schema",
          "examples": [
            "/api/articles/00235f24-badf-472b-a32c-c48b3e6e7e27"
          ]
        },
        "@type": {
          "$id": "#/properties/@type",
          "type": "string",
          "title": "The @type Schema",
          "examples": [
            "hydra:Collection"
          ]
        },
        "hydra:member": {
          "$id": "#/properties/hydra:member",
          "type": "array",
          "title": "The Hydra:member Schema",
          "examples": [
            [
              {
                "@id": "/api/articles/1a47c275-5d62-46ea-aa0d-78521248dc46",
                "created_by": {
                  "@id": "/api/users/8bdf44b7-974f-429c-8caa-8ca375cf3961",
                  "@type": "User",
                  "middle_name": null,
                  "first_name": "User1",
                  "last_name": "Test1"
                },
                "created_at": "2020-10-22T09:15:15+00:00",
                "@type": "Article",
                "title": "Lorem ipsum 01",
                "content": "Lorem ipsum 02"
              },
              {
                "@id": "/api/request_notes/7b49d282-f542-4e47-8cca-4310181584a9",
                "created_by": {
                  "@id": "/api/users/8bdf44b7-974f-429c-8caa-8ca375cf3961",
                  "@type": "User",
                  "middle_name": null,
                  "first_name": "User1",
                  "last_name": "Test1"
                },
                "created_at": "2020-10-22T09:14:15+00:00",
                "@type": "Article",
                "title": "Lorem ipsum 03",
                "content": "Lorem ipsum 04"
              }
            ]
          ],
          "additionalItems": false,
        },
        "hydra:totalItems": {
          "$id": "#/properties/hydra:totalItems",
          "type": "integer",
          "title": "The Hydra:totalitems Schema",
          "default": 0,
          "examples": [
            3.0
          ]
        },
        "hydra:search": {
          "$id": "#/properties/hydra:search",
          "type": "object",
          "title": "The Hydra:search Schema",
          "examples": [
            {
              "hydra:template": "/api/requests/00235f24-badf-472b-a32c-c48b3e6e7e27/notes{?order[created_at]}",
              "hydra:mapping": [
                {
                  "@type": "IriTemplateMapping",
                  "variable": "order[created_at]",
                  "property": "created_at",
                  "required": false
                }
              ],
              "hydra:variableRepresentation": "BasicRepresentation",
              "@type": "hydra:IriTemplate"
            }
          ],
          "additionalProperties": true,
          "required": [
            "hydra:template",
            "hydra:variableRepresentation",
            "hydra:mapping"
          ],
          "properties": {
            "@type": {
              "$id": "#/properties/hydra:search/properties/@type",
              "type": "string",
              "title": "The @type Schema",
              "examples": [
                "hydra:IriTemplate"
              ]
            },
            "hydra:template": {
              "$id": "#/properties/hydra:search/properties/hydra:template",
              "type": "string",
              "title": "The Hydra:template Schema",
              "examples": [
                "/api/requests/00235f24-badf-472b-a32c-c48b3e6e7e27/notes{?order[created_at]}"
              ]
            },
            "hydra:variableRepresentation": {
              "$id": "#/properties/hydra:search/properties/hydra:variableRepresentation",
              "type": "string",
              "title": "The Hydra:variablerepresentation Schema",
              "examples": [
                "BasicRepresentation"
              ]
            },
            "hydra:mapping": {
              "$id": "#/properties/hydra:search/properties/hydra:mapping",
              "type": "array",
              "title": "The Hydra:mapping Schema",
              "examples": [
                [
                  {
                    "@type": "IriTemplateMapping",
                    "variable": "order[created_at]",
                    "property": "created_at",
                    "required": false
                  }
                ]
              ],
              "additionalItems": true,
              "items": {
                "$id": "#/properties/hydra:search/properties/hydra:mapping/items",
                "type": "object",
                "title": "The Items Schema",
                "examples": [
                  {
                    "@type": "IriTemplateMapping",
                    "variable": "order[created_at]",
                    "property": "created_at",
                    "required": false
                  }
                ],
                "additionalProperties": true,
                "required": [
                  "variable",
                  "property",
                  "required"
                ],
                "properties": {
                  "@type": {
                    "$id": "#/properties/hydra:search/properties/hydra:mapping/items/properties/@type",
                    "type": "string",
                    "title": "The @type Schema",
                    "examples": [
                      "IriTemplateMapping"
                    ]
                  },
                  "variable": {
                    "$id": "#/properties/hydra:search/properties/hydra:mapping/items/properties/variable",
                    "type": "string",
                    "title": "The Variable Schema",
                    "examples": [
                      "order[created_at]"
                    ]
                  },
                  "property": {
                    "$id": "#/properties/hydra:search/properties/hydra:mapping/items/properties/property",
                    "type": "string",
                    "title": "The Property Schema",
                    "examples": [
                      "created_at"
                    ]
                  },
                  "required": {
                    "$id": "#/properties/hydra:search/properties/hydra:mapping/items/properties/required",
                    "type": "boolean",
                    "title": "The Required Schema",
                    "default": false,
                    "examples": [
                      false
                    ]
                  }
                }
              }
            }
          }
        }
      }
    }
    """
    