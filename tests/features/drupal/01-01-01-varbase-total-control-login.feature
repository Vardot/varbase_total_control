@varbase_total_control @login
Feature: Varbase Total Control - login page
  Scenario: The login page loads for an anonymous visitor
    Given I am an anonymous user
    When I am on "/user/login"
    Then "#user-login-form" should be visible
    And I should see "Log in"
    And I should not see "Page not found"
    And I should not see "The website encountered an unexpected error"
