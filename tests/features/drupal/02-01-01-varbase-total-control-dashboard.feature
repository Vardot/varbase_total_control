@varbase_total_control @dashboard
Feature: Varbase Total Control - administration dashboard
  As a site administrator
  I want the Varbase Total Control dashboard with its widgets
  So that I can manage the site from one place

  Background:
    Given I am a logged in user with the "Webmaster" user

  Scenario: The dashboard shows the Varbase Total Control widgets
    When I go to "/admin/dashboard"
    Then I should see "Dashboard"
    And I should see "Create New Content"
    And I should see "My Site Overview"
    And I should see "Quick Links"
    And I should not see "Access denied"
    And I should not see "The website encountered an unexpected error"
