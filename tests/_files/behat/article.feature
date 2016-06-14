Feature: Articles
  In order to stay up-to-date about arboned
  As a visitor
  There need to be article content type

  Background:
    Given "segment" terms:
      | name       |
      | My Segment |

  @api
  Scenario: View article item page
    Given I am viewing an "article":
      | title   | My article |
      | segment | My Segment |
      | body    | PLACEHOLDER BODY. |
    Then I should see the heading "My article"
    And I should see the text "PLACEHOLDER BODY." in the "content" region

  @api
  Scenario: View article overview page
    Given "article" content:
      | title          | segment    |
      | First article  | My Segment |
      | Second article | My Segment |
    When I go to "my-segment/nieuws"
    Then I should see "First article"
    And I should see "Second article"
