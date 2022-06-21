<?php

namespace Drupal\block_exchange;

/**
 * Provides my special service.
 */
class ObjectExch {

  function SaveInDb($data) {

    $query = \Drupal::database()->insert('exchangetable');
    $query->fields(array(
      'text',
    ));
    $query->values(array(
      $x = $data['buy'].' - '.$data['sale']
    ));
    $query->execute();

  }
}
