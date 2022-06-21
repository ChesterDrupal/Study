<?php

namespace Drupal\block_exchange\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements InputDemo form controller.
 *
 * This example demonstrates the different input elements that are used to
 * collect data in a form.
 */
class InputUrl extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->configFactory()->get('block_exchange.settings');
    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Your URL'),
      '#default_value' => $config->get('url'),
      '#maxlength' => 255,
      '#size' => 100,
      '#description' => $this->t('Put your url here'),
    ];

    $form['currency'] = [
      '#type' => 'select',
      '#title' => $this->t('Choose your currency'),
      '#default_value' => $config->get('currency'),
      '#options' => [
        'USD' => $this->t('USD - UAH'),
        'EUR' => $this->t('EUR - UAH'),
        'BTC' => $this->t('BTC - USD'),
      ],
      '#description' => $this->t('Which currency u wanna check?'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save configuration'),
    ];

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'block_exchange_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $myurl = $form_state->getValue('url');
    $currency = $form_state->getValue('currency');

    $config = $this->configFactory()->getEditable('block_exchange.settings');

    $config->set('url', $myurl);
    $config->set('currency', $currency);
    $config->save();

  }
}
