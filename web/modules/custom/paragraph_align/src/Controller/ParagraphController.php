<?php

namespace Drupal\paragraph_align\Controller;

class ParagraphController {
  public function para() {
    return array(
      '#title' => 'Hello World!',
      '#markup' => 'Content for Hello World.'
    );
  }
}
