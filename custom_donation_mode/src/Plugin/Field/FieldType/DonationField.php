<?php

namespace Drupal\custom_donation_mode\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a custom donation field.
 * 
 * @FieldType(
 *   id = "donation_mode",
 *   label = @Translation("Custom Donation Mode"),
 *   default_formatter = "donation_mode_formatter",
 *   default_widget = "donation_mode_widget",
 * )
 */


class DonationField extends FieldItemBase  {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'max_length' => 255,
    ] + parent::defaultStorageSettings();
  }

  /**
  * {@inheritdoc}
  */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $definition) {
    $properties['payment_mode'] = DataDefinition::create('string')
      ->setLabel(t('Payment mode'));

    $properties['payment_type'] = DataDefinition::create('string')
      ->setLabel(t('Payment type'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $definition) {
     $schema = [
      'columns' => [
        'payment_mode' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'payment_type' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ],
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
   $item = $this->getValue();
    return (empty($item['payment_mode']) && empty($item['payment_type']) || $item['payment_mode'] == '_none' );
  }


  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'payment_mode';
  }
}