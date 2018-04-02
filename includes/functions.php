<?php
function gavias_slider_makeid($length = 5){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function gavias_slider_writecache( $folder, $file, $value, $e='css' ){
    $file   = $folder  . preg_replace('/[^A-Z0-9\._-]/i', '', $file).'.'.$e ;
    $handle = fopen($file, 'w+');
      fwrite($handle, ($value));
      fclose($handle);
  }