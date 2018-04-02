<?php
namespace Drupal\gavias_slider\Form;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation;
class AddForm implements FormInterface {
   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'add_form';
   }

   /**
    * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
   public function buildForm(array $form, FormStateInterface $form_state) {
      $sid = 0;
      if(\Drupal::request()->attributes->get('sid')) $sid = \Drupal::request()->attributes->get('sid');
      
      if (is_numeric($sid)) {
        $slide = db_select('{gavias_slider}', 'd')->fields('d')->condition('id', $sid, '=')->execute()->fetchAssoc();
        } else {
            $slide = array('id' => 0, 'name' => '');
        }
        $form = array();
        $form['id'] = array(
            '#type' => 'hidden',
            '#default_value' => $slide['id']
        );
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => 'Name',
            '#default_value' => $slide['name']
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => 'Save'
        );

      $form['actions'] = array('#type' => 'actions');
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Save'
      );
    return $form;
   }

   /**
   * Implements \Drupal\Core\Form\FormInterface::validateForm().
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
      if (isset($form['values']['name']) && $form['values']['name'] === '' ) {
         $this->setFormError('name', $form_state, $this->t('Please enter name for slider.'));
       } 
   }

   /**
   * Implements \Drupal\Core\Form\FormInterface::submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if (is_numeric($form['id']['#value']) && $form['id']['#value'] > 0) {
      $sid = db_update("gavias_slider")
        ->fields(array(
            'name' => $form['name']['#value'],
        ))
        ->condition('id', $form['id']['#value'])
        ->execute();
        \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
      drupal_set_message("Slide '{$form['name']['#value']}' has been updated");
    } else {
        $sid = db_insert("gavias_slider")
          ->fields(array(
              'name' => $form['name']['#value'],
              'settings' => '',
              'data' => ''
          ))
          ->execute();
        drupal_set_message("Slide '{$form['name']['#value']}' has been created");
        \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
    }
    $response = new \Symfony\Component\HttpFoundation\RedirectResponse(\Drupal::url('gavias_slider.admin'));
    $response->send();
   }
}