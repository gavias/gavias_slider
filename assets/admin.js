var keyString="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
base64Encode = function(c) {
  var a = "";
  var k, h, f, j, g, e, d;
  var b = 0;
  c = UTF8Encode(c);
  while (b < c.length) {
    k = c.charCodeAt(b++);
    h = c.charCodeAt(b++);
    f = c.charCodeAt(b++);
    j = k >> 2;
    g = ((k & 3) << 4) | (h >> 4);
    e = ((h & 15) << 2) | (f >> 6);
    d = f & 63;
    if (isNaN(h)) {
      e = d = 64
    } else {
      if (isNaN(f)) {
        d = 64
      }
    }
    a = a + keyString.charAt(j)
    + keyString.charAt(g)
    + keyString.charAt(e)
    + keyString.charAt(d)
  }
  return a
};

UTF8Encode = function(b) {
  b = b.replace(/\x0d\x0a/g, "\x0a");
  var a = "";
  for ( var e = 0; e < b.length; e++) {
    var d = b.charCodeAt(e);
    if (d < 128) {
      a += String.fromCharCode(d)
    } else {
      if ((d > 127) && (d < 2048)) {
        a += String.fromCharCode((d >> 6) | 192);
        a += String.fromCharCode((d & 63) | 128)
      } else {
        a += String.fromCharCode((d >> 12) | 224);
        a += String.fromCharCode(((d >> 6) & 63) | 128);
        a += String.fromCharCode((d & 63) | 128)
      }
    }
  }
  return a
};

GaviasCompare = function(a,b){
  if (a.index < b.index)
     return -1;
  if (a.index > b.index)
    return 1;
  return 0;
}
$slides = drupalSettings.gavias_slider.slides
$settings  = drupalSettings.gavias_slider.settings 

if($slides == null) $slides = new Array();
if($settings == null) $settings = new Array();
var defaultSettings = {
  startheight: 700,
  fullheight: 'false',
  slider_effect: 'false',
  speed: '500',
  autoplay: 'true',
  autoplay_speed: '3000',
  display_dot: 'true',
  pause: 'false',
  display_arrows: 'true',
  display_dot: 'true'
};
var defaultSlide = {
  removed: 0,
  title: 'Slide',
  opacity_enable: '0',
  overlay_enable: '0',
  background_position:'center top',
  background_repeat: 'no-repeat',
  caption_title: '', 
  caption_description: '',
  caption_title_fs: 30,
  caption_title_ls: 0,
  caption_title_fw: 300,
  caption_skin: '',
  caption_skin_custom: '',
  caption_background: '',
  caption_text_btn_1: 'Download now',
  caption_link_btn_1: '#',
  btn_skin_1: '',
  caption_text_btn_2: 'Read more',
  caption_link_btn_2: '#',
  btn_skin_2: 'flat',
  caption_animation: 'slide-bottom',
  caption_align: 'center_center',
  link_video: ''
};

(function ($) {
  $(document).ready(function () {
    if ($slides.length == 0) {
      $('#gavias_slide_main').hide(0);
    }
    $($slides).each(function (slideIndex) {
      addSlideTab(slideIndex);
      loadSlide(0);
    })
    $('#gavias_list_slide').sortable({
      update: function (event, ui) {
        $('#gavias_list_slide').find('li').each(function (index) {
          var sindex = $(this).attr('index');
          $slides[sindex].index = index;
        })
      }
    });

    $('#addslide').click(function () {
      addSlide();
      return false;
    })

    $('#save').click(function () {
      saveLayerSlider();
    })
  

    $settings = $.extend(true, defaultSettings, $settings);

    //console.log($settings);
    $('input.global-settings, select.global-settings').each(function (index) {
      $(this).val($settings[$(this).attr('name')]);
    });

    $('input[name=width]').change(function () {
      $('#' + $currentSlide + '-' + $currentLayer).css({
        width: $(this).val() + 'px'
      });
    });
    $('input[name=height]').change(function () {
      $('#' + $currentSlide + '-' + $currentLayer).css({
        height: $(this).val() + 'px'
      });
    });
  })

  function addSlideTab(slideIndex) {
    var slideTab = $('<li>').attr('index', slideIndex);
    var slideTabTitle = '';
    if ($slides[slideIndex].title == '') {
      slideTabTitle = $('<span>').text('Slide ' + (slideIndex + 1));
    } else {
      slideTabTitle = $('<span>').text($slides[slideIndex].title || 'Slide title');
    }
    slideTabTitle.click(function () {
      if ($(this).hasClass('active')) return;
      saveSlide();
      loadSlide(slideIndex);
    })
    var slideTabRemove = $('<span>').text('x').addClass('remove-slide');
    slideTabRemove.click(function () {
      removeSlide(slideIndex);
    })
    slideTab.append(slideTabTitle).append(slideTabRemove);
    $('#gavias_list_slide').append(slideTab);
  }

  function addSlide() {
    saveSlide();
    var newSlideIndex = $slides.length;
    $slides[newSlideIndex] = {};
    $.extend(true, $slides[newSlideIndex], defaultSlide);
    $slides[newSlideIndex].index = newSlideIndex;
    addSlideTab(newSlideIndex);
    loadSlide(newSlideIndex);
    $('#gavias_slide_main').show(0);
  }

  function loadSlide(slideIndex) {
    $currentSlide = slideIndex;
    $('ul#gavias_list_slide').find('li').removeClass('active');
    $('ul#gavias_list_slide').find('li[index=' + slideIndex + ']').addClass('active');
    //alert($('input[name="background_image_uri"]').val());
    //alert($slides[slideIndex].background_image);
    
    jQuery('.slide-option').each(function (index) {
      if (typeof $slides[slideIndex][jQuery(this).attr('name')] != "undefined") {
        jQuery(this).val($slides[slideIndex][jQuery(this).attr('name')]);
      } else {
        jQuery(this).val('');
      }
    });

    if ($slides[slideIndex].background_image != undefined) {
      $('.slide-reviews').css({
        backgroundImage: 'url(' + drupalSettings.gavias_slider.base_url + $slides[slideIndex].background_image + ')'
      })
       $('.slide-reviews').css({
        backgroundImage: 'url("' + drupalSettings.gavias_slider.base_url + $('input[name="background_image_uri"]').val() + '")'
      })
    }else{
      $('.slide-reviews').css({
        backgroundImage: 'url("' + drupalSettings.gavias_slider.base_url + $('input[name="background_image_uri"]').val() + '")'
      })
    }
  }

  function saveSlide() {
    if ($slides.length == 0) return;
    jQuery('.slide-option').each(function (index) {
      $slides[$currentSlide][jQuery(this).attr('name')] = $(this).val();
    });      
  }

  function removeSlide(slideIndex) {
    $('ul#gavias_list_slide').find('li[index=' + slideIndex + ']').remove();
    $slides[slideIndex]['removed'] = 1;
    loadSlide(0);
  }

  function saveGlobalSettings() {
    $('input.global-settings, select.global-settings').each(function (index) {
      $settings[$(this).attr('name')] = $(this).val();
    })
  }

  function saveLayerSlider() {
    saveSlide();
    saveGlobalSettings();
    $slides.sort(GaviasCompare);
    var $slides2 = [];
    var $sindex = 0;
    $.each($slides, function (index, slide) {
      if(slide.removed == 0){
        $slides2[$slides2.length] = slide;
      }
    })
    var datasettings = base64Encode(JSON.stringify($settings));

   //console.log($settings);return;
    
    var dataslides = base64Encode(JSON.stringify($slides2));
    var data = {
      sid: jQuery('input[name=sid]').val(),
      data: dataslides,
      settings: datasettings,
      action: jQuery('input[name=action]').val(),
    };
    
    $('#save').val('Saving...');
    $.ajax({
      url: drupalSettings.gavias_slider.saveConfigURL,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function (data) {
        $('#save').val('Save');
       //window.location = url_redirect;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ":" + jqXHR.responseText);
      }
    });
  }
})(jQuery);

