<?php

function gavias_slider_preprocess_slides(&$vars) {
    $vars['theme_hook_suggestions'][] = 'gavias__slides';
    $slides = $vars['slides'];
    $settings = $vars['settings'];
    $html_id = drupal_html_id('gavias-slider-'.$vars['id']);
    $vars['id'] = $html_id;
    $vars['attributes_array']['style'] = 'min-height: 350px';
    $vars['attributes_array']['class'] = 'gavias-slider swiper-container first-el-true';
    $vars['attributes_array']['data-height'] = (isset($settings->startheight) && $settings->startheight) ? $settings->startheight : '700';
    $vars['attributes_array']['data-fullheight'] = (isset($settings->fullheight) && $settings->fullheight) ? $settings->fullheight : 'fasle';
    $vars['attributes_array']['data-pause'] = (isset($settings->autoslide) && $settings->autoslide) ? $settings->autoslide : '7000';
    $vars['attr_height'] = (isset($settings->startheight) && $settings->startheight) ? $settings->startheight : '700';
 
    $vars['content'] = '';
    if($slides){
        foreach ($slides as $slide) {
            $vars['content'] .= theme('gavias_slider_slide', array(
                'slide' => $slide,
            ));
        }
    }
}

function gavias_slider_preprocess_slide(&$vars) {
    $slide = $vars['slide'];
    $var['slide'] = $slide;
    $vars['attributes_array']['class'] = 'swiper-slide center_center swiper-slide-duplicate';
    
    $vars['attributes_array']['data-time'] = '6000';

    $caption_attr['class'] = 'gva-caption';
    
    //Caption title
    if(isset($slide->caption_title_fs) && $slide->caption_title_fs){
        $caption_attr['caption_title_fs'] = $slide->caption_title_fs . 'px';
    }else{
        $caption_attr['caption_title_fs'] = '30px';
    }  

    if(isset($slide->caption_title_ls) && $slide->caption_title_ls){
        $caption_attr['caption_title_ls'] = $slide->caption_title_ls . 'px';
    }else{
        $caption_attr['caption_title_ls'] = '0px';
    }  

    if(isset($slide->caption_title_fw) && $slide->caption_title_fw){
        $caption_attr['caption_title_fw'] = $slide->caption_title_fw;
    }else{
        $caption_attr['caption_title_fw'] = '700';
    }  

    if(isset($slide->caption_skin) && $slide->caption_skin){
        $caption_attr['caption_skin'] = $slide->caption_skin;
    }else{
        $caption_attr['caption_skin'] = 'white';
    } 

    if(isset($slide->caption_skin_custom) && $slide->caption_skin_custom){
        $caption_attr['caption_skin_custom'] = $slide->caption_skin_custom;
    }else{
        $caption_attr['caption_skin_custom'] = '#FFF';
    }

    if(isset($slide->caption_background) && $slide->caption_background){
        $caption_attr['caption_background'] = $slide->caption_background;
    }else{
        $caption_attr['caption_background'] = '';
    }

    $vars['caption_attrs'] = $caption_attr;

    $style[] = '';
   
    if($slide->background_image_uri){
        $wrapper = file_stream_wrapper_get_instance_by_uri($slide->background_image_uri);
       
        $path = base_path() .  $wrapper->getDirectoryPath() . "/" . file_uri_target($slide->background_image_uri);
        $style[] = "background-image: url('{$path}')";
    }

    $style[] = 'background-color: #ccc'; 
    if($slide->background_image){
        $vars['image'] = implode(';', $style);
    }
    $data_bg_video = $video_class = '';
    if(isset($slide->link_video) && $slide->link_video){
        $video_class = 'youtube-bg';
        $data_bg_video ="data-property=\"{videoURL: '{$slide->link_video}',
          containment: 'self', startAt: 0,  stopAt: 0, autoPlay: true, loop: true, mute: true, showControls: false, 
          showYTLogo: false, realfullscreen: true, addRaster: false, optimizeDisplay: true, stopMovieOnBlur: true}\"";
    }
}
