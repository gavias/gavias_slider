<?php
namespace Drupal\gavias_slider\Form;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
class DelForm extends ConfirmFormBase  {
   /**
   * The ID of the item to delete.
   *
   * @var string
   */
    protected $sid;

   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'del_form';
   }
  
  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Do you want to delete %sid?', array('%sid' => $this->sid));
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelUrl() {
      return new Url('gavias_slider.admin');
  }

  /**
   * {@inheritdoc}
   */
    public function getDescription() {
    return t('Only do this if you are sure!');
  }

  /**
   * {@inheritdoc}
   */
    public function getConfirmText() {
    return t('Delete it!');
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelText() {
    return t('Cancel');
  }

  /**
   * {@inheritdoc}
   *
   * @param int $id
   *   (optional) The ID of the item to be deleted.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $sid = NULL) {
    $this->sid = $sid;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     $sid = $this->sid;
    if(!$sid && \Drupal::request()->attributes->get('sid')) $sid = \Drupal::request()->attributes->get('sid');
    db_delete('gavias_slider')
            ->condition('id', $sid)
            ->execute();
    \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
    drupal_set_message("Slider '#{$sid}' has been delete");
    $response = new \Symfony\Component\HttpFoundation\RedirectResponse(\Drupal::url('gavias_slider.admin'));
    $response->send();
  }

}