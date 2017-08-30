<?php

namespace Drupal\varbase_total_control\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;

/**
 * Provides a 'Varbase Content Overview'.
 *
 * @Block(
 * id = "varbase_content_overview",
 * admin_label = @Translation("My Site Overview"),
 * category = @Translation("Dashboard")
 * )
 */
class VarbaseContentOverview extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $header = [
      [
        'data' => t('Content'),
      ],
      [
        'data' => t('Discussion'),
      ],
    ];
    $rows = [];
    $types = node_type_get_types();
    $config = $this->getConfiguration();
    $moduleHandler = \Drupal::service('module_handler');
    $comments_exist = $moduleHandler->moduleExists('comment');
    $spam = isset($config['varbase_total_control_spam_overview']) && $config['varbase_total_control_spam_overview'] == 1;

    foreach ($types as $type => $object) {
      // Compare against type option on pane config.
      if ((!array_key_exists($type, $config['varbase_total_control_types_overview'])) || (isset($config['varbase_total_control_types_overview']) && $config['varbase_total_control_types_overview'][$type]) == $type) {
        $type_count = db_query("SELECT count(*) FROM {node_field_data} WHERE type = :type and status = 1", [
          ':type' => $type,
        ])->fetchField();
        $content_data[$type] = \Drupal::translation()->formatPlural(number_format($type_count), '<span class="num">1</span> ' . $object->get('name') . ' item', '<span class="num">@count</span> ' . $object->get('name') . ' items');

        // Check if comments module is enabled.
        if ($comments_exist) {
          // Compare against comment options on pane config.
          if ((!array_key_exists($type, $config['varbase_total_control_comments_overview'])) || (isset($config['varbase_total_control_comments_overview']) && $config['varbase_total_control_comments_overview'][$type]) == $type) {
            $comment_count = db_query("SELECT count(DISTINCT c.cid) FROM {comment} c INNER JOIN {comment_field_data} n ON c.cid = n.cid INNER JOIN {node} node WHERE n.entity_id = node.nid AND node.type = :type AND n.status = 1", [
              ':type' => $type,
            ])->fetchField();
            $content_data[$type . '_comments'] = \Drupal::translation()->formatPlural(number_format($comment_count), '<span class="comment"><span class="num">@count</span> Comment</span>', '<span class="comment"><span class="num">@count</span> Comments</span>');

            // Compare against spam option checkbox on pane config.
            if ($spam) {
              $spam_count = db_query("SELECT count(DISTINCT c.cid) FROM {comment} c INNER JOIN {comment_field_data} n ON c.cid = n.cid INNER JOIN {node} node WHERE n.entity_id = node.nid AND node.type = :type AND n.status = 0", [
                ':type' => $type,
              ])->fetchField();
              $content_data[$type . '_comments_spam'] = \Drupal::translation()->formatPlural(number_format($spam_count), '<span class="spam"><span class="num">@count</span> Spam</span>', '<span class="spam"><span class="num">@count</span> Spams</span>');
            }
          }
        }

        $options = [
          'type' => $type,
        ];

        $url = new Url('system.admin_content', $options);
        $link = \Drupal::l($content_data[$type], $url);

        if ($comments_exist) {
          $comment = (!empty($content_data[$type . '_comments_spam']) ? Markup::create($content_data[$type . '_comments']->render() . $content_data[$type . '_comments_spam']->render()) : Markup::create($content_data[$type . '_comments']->render()));
          $rows[] = [
            'data' => [
              [
                'data' => Markup::create($link),
                'class' => ['type'],
              ],
              [
                'data' => $comment,
                'class' => ['discussion'],
              ],
            ],
          ];
        }
        else {
          $header = [
            [
              'data' => t('Content'),
            ],
          ];
          $rows[] = [
            'data' => [
              $link,
            ],
          ];
        }
      }
    }

    $body_data = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return [
      '#type' => 'markup',
      '#markup' => drupal_render($body_data),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();
    $types = node_type_get_types();
    $type_defaults = [];

    foreach ($types as $type => $object) {
      $type_options[$type] = $object->get('name');
      if (!array_key_exists($type, $type_defaults)) {
        $type_defaults[$type] = $type;
      }
    }

    $form['varbase_total_control_types_overview'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Show post counts for the following content types'),
      '#options' => $type_defaults,
      '#default_value' => $config['varbase_total_control_types_overview'],
    ];

    $form['varbase_total_control_comments_overview'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Show comment counts for the following content types'),
      '#options' => $type_defaults,
      '#default_value' => $config['varbase_total_control_comments_overview'],
    ];
    $spam_options = [
      0 => t('no'),
      1 => t('Yes'),
    ];
    $form['varbase_total_control_spam_overview'] = [
      '#type' => 'radios',
      '#title' => $this->t('Include spam counts with comments'),
      '#options' => $spam_options,
      '#default_value' => $config['varbase_total_control_spam_overview'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['varbase_total_control_types_overview'] = $values['varbase_total_control_types_overview'];
    $this->configuration['varbase_total_control_comments_overview'] = $values['varbase_total_control_comments_overview'];
    $this->configuration['varbase_total_control_spam_overview'] = $values['varbase_total_control_spam_overview'];
  }

}
