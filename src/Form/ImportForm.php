<?php
namespace Drupal\gavias_slider\Form;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation;
class ImportForm implements FormInterface {
   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'import_form';
   }

   /**
    * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
   public function buildForm(array $form, FormStateInterface $form_state) {
      $bid = 0;
      if(\Drupal::request()->attributes->get('bid')) $bid = \Drupal::request()->attributes->get('bid');

      if (is_numeric($bid)) {
        $bblock = db_select('{gavias_slider}', 'd')
           ->fields('d')
           ->condition('id', $bid, '=')
           ->execute()
           ->fetchAssoc();
      } else {
        $bblock = array('id' => 0, 'title' => '');
      }

      if($bblock['id']==0){
        drupal_set_message('Not found gavias block slider !');
        return false;
      }

      $form = array();
      $form['id'] = array(
          '#type' => 'hidden',
          '#default_value' => $bblock['id']
      );
      $form['title'] = array(
          '#type' => 'hidden',
          '#default_value' => $bblock['title']
      );
      $form['params'] = array(
          '#type' => 'textarea',
          '#title' => 'Past code import for block slider "'.$bblock['title'].'"',
          '#default_value' => ''
      );
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
      if (isset($form['values']['title']) && $form['values']['title'] === '' ) {
         $this->setFormError('title', $form_state, $this->t('Please enter title for buider block.'));
       } 
   }

   /**
   * Implements \Drupal\Core\Form\FormInterface::submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($form['id']['#value']) {
      $id = $form['id']['#value'];
      db_update("gavias_slider")
      ->fields(array(
        'params' => $form['params']['#value'],
      ))
      ->condition('id', $id)
      ->execute();
      drupal_set_message("Block Builder '{$form['title']['#value']}' has been updated");
      $response = new \Symfony\Component\HttpFoundation\RedirectResponse(\Drupal::url('gavias_slider.admin.edit', array('bid'=>$id)));
      $response->send();
    }  
  }
}