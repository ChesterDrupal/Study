<?php

namespace Drupal\block_exchange\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "block_exchange",
 *   admin_label = @Translation("Exchange Block")
 * )
 */
class ExchangeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build()
  {

    $j = @file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
    $data = json_decode($j, TRUE);

    $title = $this->t("A list returned to be rendered using theme('item_list')");
    $build['render_version'] = [
      '#theme' => 'item_list',
      '#title' => $title,
      '#items' => array_column($data, 'ccy'),
      '#attributes' => ['class' => ['render-version-list']],
    ];

    $title = $this->t("The same list rendered by theme('theming_example_list')");
    $build['our_theme_function'] = [
      '#title' => $title,
      '#theme' => 'block-exchange-block',
      '#items' => $data,
      '#wrapper_attributes' => ['class' => ['exch-container']],
      '#markup' => $this->t("This block's title is changed to uppercase..."),
    ];
    return $build;

  }
  /**
   * @TODO work with cache.
   *
   * @return int
   */
  public function getCacheMaxAge() {
    return 0;
  }
}
