<?php
// function gavias_slider_add_form($bid) {
//   $bid = arg(2);
//   if (is_numeric($bid)) {
//     $bblock = db_select('{gavias_slider}', 'd')
//        ->fields('d')
//        ->condition('id', $bid, '=')
//        ->execute()
//        ->fetchAssoc();
//   } else {
//     $bblock = array('id' => 0, 'title' => '', 'body_class'=>'');
//   }

//   $form = array();
//   $form['id'] = array(
//       '#type' => 'hidden',
//       '#default_value' => $bblock['id']
//   );
//   $form['title'] = array(
//       '#type' => 'textfield',
//       '#title' => 'Title',
//       '#default_value' => $bblock['title']
//   );
//   $form['body_class'] = array(
//       '#type' => 'textfield',
//       '#title' => 'Class body',
//       '#default_value' => isset($bblock['body_class']) ? $bblock['body_class'] : '',
//       '#description' => 'Layout display boxed when class = "boxed", e.g body class "boxed header-absolute"'
//   );
//   $form['submit'] = array(
//       '#type' => 'submit',
//       '#value' => 'Save'
//   );
//   return $form;
// }

// function gavias_slider_add_form_submit($form, $form_state) {
//   if ($form['id']['#value']) {
//     $pid = db_update("gavias_slider")
//             ->fields(array(
//                 'title' => $form['title']['#value'],
//                 'body_class'  => $form['body_class']['#value']
//             ))
//             ->condition('id', $form['id']['#value'])
//             ->execute();
//     drupal_goto('admin/gavias_slider');
//     drupal_set_message("Block Builder '{$form['title']['#value']}' has been updated");
//   } else {
//     $pid = db_insert("gavias_slider")
//             ->fields(array(
//                 'title' => $form['title']['#value'],
//                 'body_class'  => $form['body_class']['#value'],
//                 'params' => '',
//             ))
//             ->execute();
//       drupal_goto('admin/gavias_slider/'.$pid.'/edit');

//     drupal_set_message("blockbuilder '{$form['title']['#value']}' has been created");
//   }
// }


// function gavias_slider_edit(){
//   require_once gavias_slider_PATH . '/includes/utilities.php';
//   require_once gavias_slider_PATH .'/includes/backend.php';
//   drupal_add_library('media', 'media_browser');
//   drupal_add_library('media', 'media_browser_settings');
//   drupal_add_library('system', 'ui.draggable');
//   drupal_add_library('system', 'ui.dropable');
//   drupal_add_library('system', 'ui.sortable');
//   drupal_add_library('system', 'ui.dialog');
//   drupal_add_css(gavias_slider_PATH.'/vendor/font-awesome/css/font-awesome.min.css'); 
//   drupal_add_css(gavias_slider_PATH.'/vendor/notify/styles/metro/notify-metro.css');
//   drupal_add_js(gavias_slider_PATH . '/vendor/notify/notify.min.js');
//   drupal_add_js(gavias_slider_PATH . '/vendor/notify/styles/metro/notify-metro.js');
//   drupal_add_css(gavias_slider_PATH.'/assets/css/admin.css');
//   $general_sc = gavias_blockbluider_general_shortcode();
//   if(isset($_GET['destination']) && $_GET['destination']){
//     $url_redirect = $_GET['destination'];
//   }else{
//     $url_redirect = 'admin/gavias_slider/'.arg(2).'/edit';
//   }
//   $url_redirect = url($url_redirect);
//   $js = 'var gbb_url_redirect = "'.$url_redirect.'"; var $general_shortcodes = '.(json_encode($general_sc)).';';
//   drupal_add_js($js, 'inline');
//   drupal_add_js(gavias_slider_PATH . '/assets/js/admin.js');
//   ob_start();
//   include drupal_get_path('module', 'gavias_slider') . '/templates/backend/form.php';
//   $content = ob_get_clean();
//   return $content;
// }

// function gavias_slider_save_element($data) {
//   $gbb_els = array();

//   //$data['gbb-items'] = $data['gbb-items'];
//   // row
//   if( isset($data['gbb-row-id']) && is_array($data['gbb-row-id'])){
//     foreach( $data['gbb-row-id'] as $rowID_k => $rowID ){
//       $row = array();
//       if( isset($data['gbb-rows']) && is_array($data['gbb-rows'])){
//         foreach ( $data['gbb-rows'] as $row_attr_k => $row_attr ){
//           $row['attr'][$row_attr_k] = $row_attr[$rowID_k];
//         }
//       }
//       $row['columns'] = '';
//       $gbb_els[] = $row;
//     }
  
//     $array_rows_id = array_flip( $data['gbb-row-id'] );

//   } 
// //print_r($gbb_els);die();
//   $col_row_id = array();
//  // print_r($data['gbb-column-id']);die();
//   if( isset($data['gbb-column-id']) && is_array($data['gbb-column-id'])){
//     foreach( $data['gbb-column-id'] as $column_id_key => $column_id ){
//       if($column_id){
//         $column = array();
//         if( isset($data['gbb-columns']) && is_array($data['gbb-columns'])){
//           foreach ( $data['gbb-columns'] as $col_attr_k => $col_attr ){
//             $column['attr'][$col_attr_k] = $col_attr[$column_id_key];
//           }
//         }
//         $column['items'] = '';

//         $parent_row_id = $data['column-parent'][$column_id_key];
//         $new_parent_row_id = $array_rows_id[$parent_row_id];
//         if(isset($gbb_els[$new_parent_row_id])){
//           $gbb_els[$new_parent_row_id]['columns'][$column_id] = $column;
//         }
//         $col_row_id[$column_id] = $new_parent_row_id;
//       }
//     }  
//   } 

//   // items 
//   if( key_exists('element-type', $data) && is_array($data['element-type'])){
//     $count = array();
//     $count_tabs = array();
    
//     foreach( $data['element-type'] as $type_k => $type ){ 
//       $item = array();
//       $item['type'] = $type;
//       $item['size'] = $data['element-size'][$type_k];

//       if( ! key_exists($type, $count) ) $count[$type] = 0;
//       if( ! key_exists($type, $count_tabs) ) $count_tabs[$type] = 0;

//       if( key_exists($type, $data['gbb-items']) ){ 
//         foreach(  $data['gbb-items'][$type] as $attr_k => $attr ){

//           if( $attr_k == 'tabs'){
//             // field tabs fields
//             $item['fields']['count'] = $attr['count'][$count[$type]];
//             if( $item['fields']['count'] ){
//               for ($i = 0; $i < $item['fields']['count']; $i++) {
//                 $tab = array();
//                 $tab['title'] = stripslashes($attr['title'][$count_tabs[$type]]);
//                 $tab['content'] = stripslashes($attr['content'][$count_tabs[$type]]);
//                 $item['fields']['tabs'][] = $tab;
//                 $count_tabs[$type]++;
//               }
//             }
//           } else {
//             $item['fields'][$attr_k] = stripslashes($attr[$count[$type]]);            
//           }
//         }
//       }
//       $count[$type] ++;
//       $column_id = $data['element-parent'][$type_k];
//       $parent_row_id = $data['element-row-parent'][$type_k];

//       $new_parent_row_id = $array_rows_id[$parent_row_id];
//       $new_column_id = $column_id;
//       $gbb_els[$new_parent_row_id]['columns'][$new_column_id]['items'][] = $item;
//     }
//   }

// //print_r($gbb_els);die();
//   // save
//   if( $gbb_els ){
//     $new = base64_encode(json_encode($gbb_els));    
//   }
//   return $new;
// }

// function gavias_slider_save(){
//  header('Content-type: application/json');
//   $data = $_REQUEST['data'];
//   $pid = $_REQUEST['pid'];
//   //$data = base64_decode($data);
//   // $data = json_decode($data);
//   $params = '';
//   if($data){
//     $data = base64_decode($data);
//     $data = json_decode($data, true);
//     $params = gavias_slider_save_element($data);
//     //print_r($params);die();
//   } 
//   if($params==null) $params = '';

//   db_update("gavias_slider")
//         ->fields(array(
//             'params' => $params,
//         ))
//         ->condition('id', $pid)
//         ->execute();

//   $result = array(
//     'data' => 'update saved'
//   );
//    print json_encode($result);
//     exit(0);
// }


function gavias_slider_delete($gid) {
  return drupal_get_form('gavias_slider_delete_confirm_form');
}

function gavias_slider_delete_confirm_form($form_state) {
  $form = array();
  $form['id'] = array(
    '#type'=>'hidden',
    '#default_value' => arg(2)
  );
  return confirm_form($form, 'Do you really want to detele this block bulider ?', 'admin/gavias_slider', NULL, 'Delete', 'Cancel');
}

function gavias_slider_delete_confirm_form_submit($form, &$form_state){
  $gid = $form['id']['#value'];
  db_delete('gavias_slider')
          ->condition('id', $gid)
          ->execute();
  drupal_set_message('The block bulider has been deleted');
  drupal_goto('admin/gavias_slider');
}

function gavias_slider_export($gid){
  $pbd_single = gavias_slider_load($gid);
  $data = $pbd_single->params;
  header("Content-Type: text/txt");
  header("Content-Disposition: attachment; filename=gavias_slider_export.txt");
  print $data;
  exit;
}

function gavias_slider_import($bid) {
  $bid = arg(2);
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
    drupal_set_message('Not found gavias slider !');
    return false;
  }

  $form = array();
  $form['id'] = array(
      '#type' => 'hidden',
      '#default_value' => $bblock['id']
  );
  $form['params'] = array(
      '#type' => 'textarea',
      '#title' => 'Past code import for block builder "'.$bblock['title'].'"',
      '#default_value' => ''
  );
  $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Save'
  );
  return $form;
}

function gavias_slider_import_submit($form, $form_state) {
  if ($form['id']['#value']) {
    $id = $form['id']['#value'];
    db_update("gavias_slider")
      ->fields(array(
          'params' => $form['params']['#value'],
      ))
      ->condition('id', $id)
      ->execute();
    drupal_goto('admin/gavias_slider/'.$id.'/edit');
    drupal_set_message("Block Builder '{$form['title']['#value']}' has been updated");
  } 
}