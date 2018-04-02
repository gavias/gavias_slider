<?php

/**
 * @file
 * Contains \Drupal\gavias_slider\Derivative\SliderBlock.
 */

namespace Drupal\gavias_slider\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides blocks which belong to Gavias Slider.
 */
class SliderBlock extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if(!db_table_exists('gavias_slider')){
      return "";
    }
    $results = db_select('{gavias_slider}', 'd')
          ->fields('d', array('id', 'name'))
          ->execute();
    foreach ($results as $row) {
      $this->derivatives['gavias_slider_block____' . $row->id] = $base_plugin_definition;
      $this->derivatives['gavias_slider_block____' . $row->id]['admin_label'] = 'Gavias Slider ' . $row->name;
    }
    return $this->derivatives;
  }
}
