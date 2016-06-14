Feature: Breadcrumb
  In order to know where I am on the website
  As a visitor
  Pages should contain a breadcrumb trail

  #@api
  #Scenario: No breadcrumb on the homepage
  #  Given "page" content:
  #    | title | path  |
  #    | Home  | /home |
  #  When I am on the homepage
  #  Then I should not see a ".breadcrumb" element

  @api
  Scenario: Breadcrumb on the search page
    Given a segment with title "My Segment"
    When I am on "my-segment/zoeken"
    Then I should see "Home" in the ".breadcrumb" element
    And I should see "My Segment" in the ".breadcrumb" element

  @api
  Scenario: Breadcrumb on an article page
    Given a segment with title "My Segment"
    When I am viewing an "article" content:
      | title   | My article |
      | segment | My Segment |
    Then I should see "Home" in the ".breadcrumb" element
    And I should see "My Segment" in the ".breadcrumb" element
    And I should see "Nieuws" in the ".breadcrumb" element
