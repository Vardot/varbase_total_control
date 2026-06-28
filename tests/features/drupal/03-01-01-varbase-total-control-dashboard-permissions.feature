@varbase_total_control @permissions
Feature: Varbase Total Control - dashboard by role
  As a site builder
  I want users with the Total Control permission to reach the dashboard

  # The dashboard page (/admin/dashboard) is a page_manager page with no
  # page-level access conditions; the actionable widget content is access
  # controlled per block. So this checks the granted role sees the dashboard.
  Scenario: A user with the "have total control" permission opens the dashboard
    Given I am a logged in user with the "Dashboard user" user
    When I am on "/admin/dashboard"
    Then I should see "Dashboard"
    And I should see "Create New Content"
    And I should not see "Access denied"
    And I should not see "The website encountered an unexpected error"
