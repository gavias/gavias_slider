<?php

/**
 * @file
 * Contains \Drupal\gavias_slider\Controller\AdminController.
 */

namespace Drupal\gavias_slider\Controller;

use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends ControllerBase {

  public function gavias_slider_list(){
  
    if(!db_table_exists('gavias_slider')){
      return "";
    }

    $header = array( 'ID', 'Name', 'Action');
    
    $results = db_select('{gavias_slider}', 'd')
            ->fields('d', array('id', 'name'))
            ->execute();
    $rows = array();

    foreach ($results as $row) {

      $tmp =  array();
      $tmp[] = $row->id;
      $tmp[] = $row->name;
      $tmp[] = t('<a href="@link_1">Edit Name</a> | <a href="@link_2">Edit Silder</a> | <a href="@link_3">Config Global</a> | <a href="@link_4">Delete</a>', array(
            '@link_1' => \Drupal::url('gavias_slider.admin.add', array('sid' => $row->id)),
            '@link_2' => \Drupal::url('gavias_slider.admin.edit', array('sid' => $row->id)),
            '@link_3' => \Drupal::url('gavias_slider.admin.config', array('sid' => $row->id)),
            '@link_4' => \Drupal::url('gavias_slider.admin.delete', array('sid' => $row->id))
        ));
      $rows[] = $tmp;
    }
    return array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No Slider available. <a href="@link">Add Slider</a>.', array('@link' => \Drupal::url('gavias_slider.admin.add', array('sid'=>0)))),
    );
  }

  public function gavias_slider_edit($sid) {
    global $base_url;
    $page['#attached']['library'][] = 'gavias_slider/gavias_slider.assets.admin';
    $slideshow = gavias_slider_load($sid);
    
    $abs_url_config = \Drupal::url('gavias_slider.admin.save', array(), array('absolute' => FALSE));
    $page['#attached']['drupalSettings']['gavias_slider']['base_url'] = $base_url;
    $page['#attached']['drupalSettings']['gavias_slider']['saveConfigURL'] = $abs_url_config;
    $page['#attached']['drupalSettings']['gavias_slider']['setting'] = json_encode($slideshow->settings);
    $page['#attached']['drupalSettings']['gavias_slider']['slides'] = $slideshow->slides;

    ob_start();
    include GAVIAS_SLIDER_PATH . '/templates/backend/slider.php';
    $content = ob_get_clean();
    $page['admin-form'] = array(
      '#theme' => 'admin-form',
      '#content' => $content
    );
    return $page;
  }

  public function gavias_slider_config($sid){
    global $base_url;
    $page['#attached']['library'][] = 'gavias_slider/gavias_slider.assets.admin';
    $slideshow = gavias_slider_load($sid);
    
    $abs_url_config = \Drupal::url('gavias_slider.admin.save', array(), array('absolute' => FALSE));
    $page['#attached']['drupalSettings']['gavias_slider']['base_url'] = $base_url;
    $page['#attached']['drupalSettings']['gavias_slider']['saveConfigURL'] = $abs_url_config;
    $page['#attached']['drupalSettings']['gavias_slider']['settings'] = $slideshow->settings;
    $page['#attached']['drupalSettings']['gavias_slider']['slides'] = $slideshow->slides;

    ob_start();
    include GAVIAS_SLIDER_PATH . '/templates/backend/global.php';
    $content = ob_get_clean();
    $page['admin-global'] = array(
      '#theme' => 'admin-global',
      '#content' => $content
    );
    return $page;
  }


  public function gavias_slider_save(){
    header('Content-type: application/json');
    $sid = $_REQUEST['sid'];
    $data = $_REQUEST['data'];
    $settings = $_REQUEST['settings'];
    $action = $_REQUEST['action'];
    if($action == 'config'){
      db_update('{gavias_slider}')->fields(array(
        'settings' => $settings
      ))->condition('id', $sid, '=')->execute();
    }
    if($action == 'slide'){
      db_update('{gavias_slider}')->fields(array(
          'data' => $data,
      ))->condition('id', $sid, '=')->execute();
    }  
    $result = array(
        'data' => 'saved'
    );
    
     // Clear all cache
    \Drupal::service('plugin.manager.block')->clearCachedDefinitions();     
    $module_handler = \Drupal::moduleHandler();
    $module_handler->invokeAll('rebuild');

    print json_encode($result);
    exit(0);
  }
 
  public function gavias_upload_file(){
    // A list of permitted file extensions
    global $base_url;
    $allowed = array('png', 'jpg', 'gif','zip');
    $_id = gavias_slider_makeid(6);
    if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

      $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

      if(!in_array(strtolower($extension), $allowed)){
        echo '{"status":"error extension"}';
        exit;
      }  
      $path_folder = \Drupal::service('file_system')->realpath(file_default_scheme(). "://gva-slider-upload");
    
      $file_path = $path_folder . '/' . $_id . '-' . $_FILES['upl']['name'];
      $file_url = str_replace($base_url, '',file_create_url(file_default_scheme(). "://gva-slider-upload") . '/' .  $_id .'-'. $_FILES['upl']['name']); 
      if (!is_dir($path_folder)) {
       @mkdir($path_folder); 
      }
      if(move_uploaded_file($_FILES['upl']['tmp_name'], $file_path)){
        $result = array(
          'file_url' => $file_url,
          'file_url_full' => $base_url . $file_url
        );
        print json_encode($result);
        exit;
        }
    }

    echo '{"status":"error"}';
    exit;

  }

}
