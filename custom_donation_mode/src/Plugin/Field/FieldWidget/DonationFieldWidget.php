<?php

namespace Drupal\custom_donation_mode\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;



/**
 * Plugin implementation of the 'donation_mode_widget' widget.
 *
 * @FieldWidget(
 *   id = "donation_mode_widget",
 *   label = @Translation("Donation Mode Default"),
 *   field_types = {
 *     "donation_mode"
 *   }
 * )
 */


class DonationFieldWidget extends WidgetBase {
  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['payment_mode'] = array(
      '#title' => t('Payment Mode'),
      '#type' => 'select',
      '#options' => [
        '_none' => t('- None -'),
        'online' => t('Online'),
        'offline' => t('Offline'),
      ],
      '#default_value' => isset($items[$delta]->payment_mode) ? $items[$delta]->payment_mode : 'none',
      "#attributes" => ["class" => ['field-payment-mode']],
    );
    $element['payment_type'] = array(
      '#type' => 'radios',
      '#title' => t('Payment type'),
      '#options' => [
        'cash' => t('Cash'),
        'cheque' => t('Cheque'),
      ],
      '#default_value' => isset($items[$delta]->payment_type) ? $items[$delta]->payment_type : NULL,
      '#widget' => [
        '#states' => [
          'required' => [
            '.field-payment-mode' => ['value' => 'offline'],
          ],
        ],
      ],
      '#states' => [
        //show this textfield only if the payment_mode is selected offline
        'visible' => [
          '.field-payment-mode' => ['value' => 'offline'],
        ],
        'required' => [
            '.field-payment-mode' => ['value' => 'offline'],
          ],
        
      ],
    );

    
    return $element;
  }
}