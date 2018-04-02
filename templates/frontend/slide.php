<div class="item swiper-slide <?php print ((isset($slide->caption_align) && $slide->caption_align) ? $slide->caption_align : 'center_center'); ?>">
   <div class="gavias-slider-image slide <?php print $video_class ?>" <?php print $data_bg_video ?> style="<?php print $image_background_style; ?>">
      <?php if(isset($slide->overlay_enable) && $slide->overlay_enable == '1') echo '<div class="gavias-slide-overlay"></div>' ?>
      <div class="slider-content">
         <div class="container">
            <div class="gva-caption <?php print ((isset($slide->opacity_enable) && $slide->opacity_enable == 1) ? 'gavias-opacity' : '') ?> caption-skin-<?php print $caption_attrs['caption_skin']; ?> <?php print ((isset($slide->caption_animation) && $slide->caption_animation) ? 'gavias-'.$slide->caption_animation : 'gavias-scale-down'); ?>">

               <?php if(isset($slide->caption_title) && $slide->caption_title ){ ?>
                  <div class="caption-title" style="font-size:<?php print $caption_attrs['caption_title_fs']; ?>; font-weight:<?php print $caption_attrs['caption_title_fw']; ?>; letter-spacing:<?php print $caption_attrs['caption_title_ls']; ?>; <?php if($caption_attrs['caption_skin'] == 'custom') print ('color:' . $caption_attrs['caption_skin_custom']); ?>">
                     <div class="caption-inner" style="<?php if($caption_attrs['caption_background'] != '') print ('background-color:' . $caption_attrs['caption_background']); ?>">
                        <?php echo html_entity_decode(trim($slide->caption_title)) ?>
                     </div>
                  </div>
               <?php } ?>  

               <?php if(isset($slide->caption_description) && $slide->caption_description ){ ?>
                  <div class="caption-description" style="<?php if($caption_attrs['caption_skin'] == 'custom') print ('color:' . $caption_attrs['caption_skin_custom']); ?>">
                     <div class="caption-inner" style="<?php if($caption_attrs['caption_background'] != '') print ('background-color:' . $caption_attrs['caption_background']); ?>">
                        <?php echo html_entity_decode(trim($slide->caption_description)) ?>
                     </div>
                  </div>
               <?php } ?> 

               <div class="slider-action">
                  <?php if(isset($slide->caption_text_btn_1) && $slide->caption_text_btn_1){ ?>
                     <a <?php echo (isset($slide->caption_link_btn_1) && $slide->caption_link_btn_1 ? 'href="' .$slide->caption_link_btn_1. '"' : '') ?> class="btns btn-slide <?php if(isset($slide->btn_skin_1) && $slide->btn_skin_1) echo 'btn-slide-' . $slide->btn_skin_1; ?>">
                        <?php echo $slide->caption_text_btn_1 ?>
                     </a>
                  <?php } ?> 
                   
                  <?php if(isset($slide->caption_text_btn_2) && $slide->caption_text_btn_2 ){ ?>
                     <a <?php echo (isset($slide->caption_link_btn_2) && $slide->caption_link_btn_2 ? 'href="' .$slide->caption_link_btn_2. '"' : '') ?> class="btns btn-slide <?php if(isset($slide->btn_skin_2) && $slide->btn_skin_2) echo 'btn-slide-' . $slide->btn_skin_2; ?>">
                        <?php echo $slide->caption_text_btn_2 ?>
                     </a>
                  <?php } ?>  
               </div>
            </div>
         </div>   
      </div>   
   </div>   
</div>