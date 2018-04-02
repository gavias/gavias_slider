<?php

/**
 * @file
 * Contains \Drupal\gavias_slider\Plugin\Block\SliderBlock.
 */

namespace Drupal\gavias_slider\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides blocks which belong to Gavias Slider.
 *
 *
 * @Block(
 *   id = "gavias_slider_block",
 *   admin_label = @Translation("Gavias Slider"),
 *   category = @Translation("Gavias Slider"),
 *   deriver = "Drupal\gavias_slider\Plugin\Derivative\SliderBlock",
 * )
 *
 */

class SliderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $sid = $this->getDerivativeId();

     $block = array();
      if (str_replace('gavias_slider_block____', '', $sid) != $sid) {
        $sid = str_replace('gavias_slider_block____', '', $sid);

        $content_block = gavias_slider_slides($sid);
        
        if(!$content_block) $content_block =  'No block builder selected';
        $block = array(
          '#theme' => 'block-slider',
          '#content' => $content_block,
          '#cache' => array('max-age' => 0)
        );
      }

      return $block;
  }


  /**
   *  Default cache is disabled. 
   * 
   * @param array $form
   * @param \Drupal\gavias_slider\Plugin\Block\FormStateInterface $form_state
   * @return 
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $rebuild_form = parent::buildConfigurationForm($form, $form_state);
    $rebuild_form['cache']['max_age']['#default_value'] = 0;
    return $rebuild_form;
  }

}
