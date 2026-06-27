@varbase_total_control @permissions
Feature: Varbase Total Control - dashboard access by role
  As a site builder
  I want only authorized users to reach the Total Control dashboard

  Scenario: Anonymous users cannot access the dashboard
    Given I am an anonymous user
    When I am on "/admin/dashboard"
    Then I should see "Access denied"

  Scenario: Authenticated users without permission cannot access the dashboard
    Given I am a logged in user with the "Normal user" user
    When I am on "/admin/dashboard"
    Then I should see "Access denied"

  Scenario: Users with the Total Control permission can access the dashboard
    Given I am a logged in user with the "Dashboard user" user
    When I am on "/admin/dashboard"
    Then I should see "Create Content"
    And I should not see "Access denied"
    And I should not see "The website encountered an unexpected error"
