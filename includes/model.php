<?php
function gavias_slider_load($sid) {
  $result = db_select('{gavias_slider}', 'd')
          ->fields('d')
          ->condition('id', $sid, '=')
          ->execute()
          ->fetchObject();
  $slideshow = new stdClass();
  if($result){
      $json = base64_decode($result->settings);
      $slideshow->settings = json_decode($json);
      
      $json = base64_decode($result->data);
      $slideshow->slides = json_decode($json);
      
      for ($i = 0; $i < count($slideshow->slides); $i++) {
        if (!empty($slideshow->slides[$i]->background_image_uri)) {
          $slideshow->slides[$i]->background_image = file_create_url($slideshow->slides[$i]->background_image_uri);
        }
      }
      if(!empty($slideshow->settings)) {
          
      }
    }else{
      return false;
    }
  return $slideshow;
}