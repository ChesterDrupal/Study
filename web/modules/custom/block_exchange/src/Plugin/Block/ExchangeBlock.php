<?php

namespace Drupal\block_exchange\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Exchange' Block.
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
    $config = \Drupal::config('block_exchange.settings');
    $testurl = $config->get('url');
    $testcurr = $config->get('currency');

    $urltomass = @file_get_contents($testurl);
    $data = json_decode($urltomass, TRUE);
    $title = $this->t('Currency: BUY - SELL');

    $curr_indentificator = 0;

    switch ($testcurr) {
      case 'USD':
        $curr_indentificator = 0;
        break;

      case 'EUR':
        $curr_indentificator = 1;
        break;

      case 'BTC':
        $curr_indentificator = 2;
        break;
    }
    $build['exchange_function'] = [
      '#title' => $title,
      '#theme' => 'block-exchange-block',
      '#item' => $data[$curr_indentificator],
      '#wrapper_attributes' => ['class' => ['exch-container']],
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
