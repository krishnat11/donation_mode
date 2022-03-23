<?php

namespace Drupal\custom_donation_mode\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'donation_mode_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "donation_mode_formatter",
 *   label = @Translation("Donation Mode Formatter"),
 *   field_types = {
 *     "donation_mode"
 *   }
 * )
 */


class DonationFieldFormatter extends FormatterBase {
  /**
 * {@inheritdoc}
 */
public function viewElements(FieldItemListInterface $items,$langcode) {
   $elements = array();

   foreach ($items as $delta => $item) {
    if($item->payment_mode != 'none'){
        if($item->payment_mode == 'offline'){
        $fieldView = $item->payment_mode .','.$item->payment_type;
        }else{
        $fieldView = $item->payment_mode;
        }
        $elements[$delta] = ['#markup' => $fieldView];
      }
    }
    return $elements;
  } 
}