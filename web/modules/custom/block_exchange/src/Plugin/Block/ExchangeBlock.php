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

    if ($testcurr == 'USD') {
      $build['exchange_function'] = [
        '#title' => $title,
        '#theme' => 'block-exchange-block',
        '#item' => $data[0],
        '#wrapper_attributes' => ['class' => ['exch-container']],
      ];
      return $build;
    }
    elseif ($testcurr == 'EUR') {
      $build['exchange_function'] = [
        '#title' => $title,
        '#theme' => 'block-exchange-block',
        '#item' => $data[1],
        '#wrapper_attributes' => ['class' => ['exch-container']],
      ];
      return $build;
    }
    elseif ($testcurr == 'BTC') {
      $build['exchange_function'] = [
        '#title' => $title,
        '#theme' => 'block-exchange-block',
        '#item' => $data[2],
        '#wrapper_attributes' => ['class' => ['exch-container']],
      ];
      return $build;
    }

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
