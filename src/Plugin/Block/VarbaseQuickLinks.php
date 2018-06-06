<?php

namespace Drupal\varbase_total_control\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Varbase Quick Links'.
 *
 * @Block(
 * id = "varbase_quick_links",
 * admin_label = @Translation("Quick Links"),
 * category = @Translation("Dashboard")
 * )
 */
class VarbaseQuickLinks extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $links = [];

    $links[] = \Drupal::l($this->t('Manage menus'), new Url('entity.menu.collection'));
    $links[] = \Drupal::l($this->t('Manage taxonomy'), new Url('entity.taxonomy_vocabulary.collection'));
    $links[] = \Drupal::l($this->t('Manage users'), new Url('entity.user.collection'));

    $body_data = [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#items' => $links,
    ];

    return [
      '#type' => 'markup',
      '#markup' => drupal_render($body_data),
    ];
  }

}
