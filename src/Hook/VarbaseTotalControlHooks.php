<?php

namespace Drupal\varbase_total_control\Hook;

use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Object-oriented hook implementations for Varbase Total Control Dashboard.
 *
 * Drupal 11 replaces procedural hooks with methods carrying the #[Hook]
 * attribute (https://www.drupal.org/node/3442349). The real logic lives here
 * and uses dependency injection; the procedural functions in
 * varbase_total_control.module are kept as #[LegacyHook] shims delegating here.
 */
class VarbaseTotalControlHooks {

  /**
   * Constructs a VarbaseTotalControlHooks object.
   */
  public function __construct(
    protected RouteMatchInterface $routeMatch,
  ) {}

  /**
   * Implements hook_page_attachments().
   */
  #[Hook('page_attachments')]
  public function pageAttachments(array &$attachments): void {
    $routers = [
      'page_manager.page_view_total_control_dashboard_total_control_dashboard-panels_variant-1',
      'page_manager.page_view_total_control_dashboard_total_control_dashboard-panels_variant-0',
    ];

    if (in_array($this->routeMatch->getRouteName(), $routers)) {
      // Attach the extra CSS for the Varbase dashboard.
      $attachments['#attached']['library'][] = 'varbase_total_control/vtc';
    }
  }

  /**
   * Implements hook_theme().
   */
  #[Hook('theme')]
  public function theme($existing, $type, $theme, $path): array {
    return [
      'block__views_block__varbase_google_analytics_summary_top_pages_block' => [
        'base hook' => 'block',
      ],
      'block__views_block__varbase_google_analytics_summary_top_sources_block' => [
        'base hook' => 'block',
      ],
      'block__varbase_total_control' => [
        'base hook' => 'block',
      ],
      'block__total_control' => [
        'base hook' => 'block',
      ],
      'block__views_block__control_content_panes_pane_tc_new' => [
        'base hook' => 'block',
      ],
      'block__views_block__varbase_google_analytics_summary_sessions_and_pageviews' => [
        'base hook' => 'block',
      ],
      'block__varbase_dashboard_user' => [
        'base hook' => 'block',
      ],
    ];
  }

}
