<?php 
    global $theme_root, $base_url; 
    $_id = gavias_slider_makeid(10);
?>
<input type="hidden" name="sid" value="<?php print $sid ?>"/>
<input type="hidden" name="action" value="slide"/>
<div id="gavias_slider_setting">
    <div id="review-content">
        <div class="main-list-silde space-20">
            <ul id="gavias_list_slide" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix "></ul>
            <a href="#" id="addslide">Add Slide</a>
        </div>

        <div class="clearfix"></div>

        <div class="slide-reviews" id="slide-reviews-upload-<?php print $_id ?>" class="space-20" style="margin:0 auto; width:1170px; height: 400px; border: 1px solid #ccc; list-style: none; position: relative;">
            
        </div>

        <div class="clearfix "></div>

        <div id="gavias_slide_main">
            <div class="form-wrapper no-border">
                <div class="gavias_heading"><span class="fieldset-legend"><h3 class="options_heading">Slide options</h3></span></div>
                <div class="fieldset-wrapper">
                    <table>
                        <tr>
                            <td>
                                <label>Background image</label> 
                                <div class="gva-upload-image" id="gva-upload-<?php print $_id; ?>">
                                    <form class="upload" id="upload-<?php print $_id; ?>" method="post" action="<?php print ($base_url . '/admin/structure/gavias_slider/upload') ?>" enctype="multipart/form-data">
                                        <div class="drop">
                                            <input type="file" name="upl" multiple class="input-file-upload"/>
                                        </div>
                                    </form>
                                    <input readonly="true" type="text" name="background_image_uri" value="" class="slide-option file-input" />
                                    <span class="loading">Loading....</span>
                                </div>  
                            </td>
                            <td>
                            <label>Video Link (Youtube Only)</label> 
                                <input name="link_video" class="slide-option form-text" type="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.3%">
                                <label>Slide title</label> 
                                <input name="title" class="slide-option form-text" type="text"/>
                            </td>
                            
                            <td width="33.3%">
                                <label>Background color</label> 
                                <input type="text" name="background_color" class="slide-option form-text"/>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <label>Enables Opacity from scroll</label> 
                                <select name="opacity_enable" class="slide-option form-select">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </td>
                            <td>
                                <label>Show Overlay</label> 
                                <select name="overlay_enable" class="slide-option form-select">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Background Position</label> 
                                <select name="background_position" class="slide-option form-select">
                                    <option value="center top">center top</option>
                                    <option value="center right">center right</option>
                                    <option value="center bottom">center bottom</option>
                                    <option value="center center">center center</option>
                                    <option value="left top">left top</option>
                                    <option value="left center">left center</option>
                                    <option value="left bottom">left bottom</option>
                                    <option value="right top">right top</option>
                                    <option value="right center">right center</option>
                                    <option value="right bottom">right bottom</option>
                                </select>
                            </td>
                            <td>
                                <label>Background Repeat</label> 
                                <select name="background_repeat" class="slide-option form-select">
                                    <option value="no-repeat">no-repeat</option>
                                    <option value="repeat">repeat</option>
                                    <option value="repeat-x">repeat-x</option>
                                    <option value="repeat-y">repeat-y</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

             <div class="form-wrapper no-border">
                <div class="gavias_heading"><span class="fieldset-legend"><h3 class="options_heading">Slide data options</h3></span></div>
                 <div class="fieldset-wrapper">
                    <table>
                     <tbody>
                        <tr>
                            <td colspan="3">
                                <label>Caption Title</label> 
                                 <textarea cols="70" rows="5" class="slide-option form-text" name="caption_title"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label>Caption Description</label> 
                                <textarea cols="70" rows="5" class="slide-option form-text" name="caption_description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.3%">
                                <label>Caption Title Font Size</label> 
                                <select name="caption_title_fs" class="slide-option form-select">
                                    <?php for($i=15; $i< 100; $i++){ ?>
                                        <option value="<?php print $i; ?>"> <?php print $i; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="33.3%">
                                 <label>Caption Title Letter Spacing(px)</label> 
                                 <select name="caption_title_ls" class="slide-option form-select">
                                    <?php for($i=0; $i< 36; $i++){ ?>
                                        <option value="<?php print $i; ?>"> <?php print $i; ?> </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td width="33.3%">
                                <label>Caption Title Font Weight</label>
                                <select name="caption_title_fw" class="slide-option form-select">
                                    <option value="100">100</option>
                                    <option value="300">300</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                    <option value="600">600</option>
                                    <option value="700">700</option>
                                    <option value="800">800</option>
                                    <option value="900">900</option>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Caption Skin</label> 
                                <select name="caption_skin" class="slide-option form-select">
                                    <option value="">Select Option</option>
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                    <option value="custom">Custom Color (Change from below option)</option>
                                </select>
                            </td>
                            <td>
                                <label>Custom Caption Text Color(ex: #F5f5f5)</label> 
                                <input type="text" name="caption_skin_custom" class="slide-option form-text"/>
                            </td>
                            <td>
                                <label>Custom Caption Background Color(ex: #fff)</label> 
                                <input type="text" name="caption_background" class="slide-option form-text"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                 <label>Text button 1</label> 
                                 <input type="text" name="caption_text_btn_1" class="slide-option form-text"/>
                            </td>
                            <td>
                                 <label>Link button 1</label> 
                                 <input type="text" name="caption_link_btn_1" class="slide-option form-text"/>
                            </td>
                            <td>
                                <label>Skin button 1</label> 
                                 <select name="btn_skin_1" class="slide-option form-select">
                                    <option value="">Select Option</option>
                                    <option value="outline">Outline</option>
                                    <option value="flat">Flat</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <label>Text button 2</label> 
                                 <input type="text" name="caption_text_btn_2" class="slide-option form-text"/>
                            </td>
                            <td>
                                 <label>Link button 2</label> 
                                 <input type="text" name="caption_link_btn_2" class="slide-option form-text"/>
                            </td>
                            <td>
                                <label>Skin button 2</label> 
                                 <select name="btn_skin_2" class="slide-option form-select">
                                    <option value="">Select Option</option>
                                    <option value="outline">Outline</option>
                                    <option value="flat">Flat</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Content Animation</label> 
                                <select name="caption_animation" class="slide-option form-select">
                                    <option value="">Select Option</option>
                                    <option value="fade-in">Fade in</option>
                                    <option value="slide-top">Slide from Top</option>
                                    <option value="slide-left">Slide from Left</option>
                                    <option value="slide-bottom">Slide from Bottom</option>
                                    <option value="slide-right">Slide from Right</option>
                                    <option value="scale-down">Scale Down</option>
                                    <option value="flip-x">Horizontally Flip</option>
                                    <option value="flip-y">Vertically Flip</option>
                                </select>
                            </td>

                             <td>
                                <label>Content Align</label>
                                <select name="caption_align" class="slide-option form-select">
                                    <option value="">Select Option</option>
                                    <option value="left_top">Left Top</option>
                                    <option value="center_top">Center Top</option>
                                    <option value="right_top">Right Top</option>
                                    <option value="left_center">Left Center</option>
                                    <option value="center_center">Center Center</option>
                                    <option value="right_center">Right Center</option>
                                    <option value="left_bottom">Left Bottom</option>
                                    <option value="center_bottom">Center Bottom</option>
                                    <option value="right_bottom">Right Bottom</option>
                                </select>
                            </td>
                             <td>
                            </td>
                        </tr>
                        </tbody> 
                    </table>
                </div>    
            </div>
        </div>
    </div>
    <input type="button" id="save" class="form-submit" value="Save"/>
</div>
