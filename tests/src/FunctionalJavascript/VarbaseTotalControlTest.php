<?php

namespace Drupal\Tests\varbase_total_control\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Tests Varbase Total Control Dashboard.
 *
 * @group varbase_total_control
 */
class VarbaseTotalControlTest extends WebDriverTestBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  protected $profile = 'standard';

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'olivero';

  /**
   * {@inheritdoc}
   */
  protected $strictConfigSchema = FALSE;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'page_manager_ui',
    'varbase_total_control',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Insall the Claro admin theme.
    $this->container->get('theme_installer')->install(['vartheme_claro']);

    // Set the Claro theme as the default admin theme.
    $this->config('system.theme')->set('admin', 'vartheme_claro')->save();

  }

  /**
   * Check Varbase Total Control Dashboard.
   */
  public function testCheckVarbaseTotalControlDashboard() {

    // Given that the root super user was logged in to the site.
    $this->drupalLogin($this->rootUser);

    $this->drupalGet('admin/dashboard');
    $this->assertSession()->pageTextContains('Dashboard');
    $this->assertSession()->pageTextContains('Take Total Control.');

    $this->assertSession()->pageTextContains('Create Content');
    $this->assertSession()->pageTextContains('Add new Basic page');
    $this->assertSession()->pageTextContains('Content Overview');
    $this->assertSession()->pageTextContains('New Content');

    $this->assertSession()->pageTextContains('New User Accounts');
    $this->assertSession()->pageTextContains('Administer Menus');
    $this->assertSession()->pageTextContains('Main navigation');
    $this->assertSession()->pageTextContains('Menu administration');
    $this->assertSession()->pageTextContains('Administer Content Types');
    $this->assertSession()->pageTextContains('Content type administration');
    $this->assertSession()->pageTextContains('Administer Taxonomy');
    $this->assertSession()->pageTextContains('Taxonomy administration');

    $this->assertSession()->pageTextContains('Administer Panel Pages');
    $this->assertSession()->pageTextContains('Total Control dashboard');
    $this->assertSession()->pageTextContains('Page manager administration');

    $this->drupalGet('admin/dashboard/users');
    $this->assertSession()->pageTextContains('User Accounts');

    $this->drupalGet('admin/dashboard/comments');
    $this->assertSession()->pageTextContains('Comments');

  }

}
