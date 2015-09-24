jQuery(document).ready(function($) {

    $('.bp-color-field').wpColorPicker({

    });

    var targetfield, image_url;

    jQuery('.bp_upload_button').click(function() {

        targetfield = jQuery(this).prev('.upload-url');

        tb_show('', 'media-upload.php?refer=custom_images&amp;type=image&amp;TB_iframe=true');

        return false;

    });

    window.send_to_editor = function(html) {

        image_url = $('img', html).attr('src');

        jQuery(targetfield).val(image_url);

        tb_remove();
    }

    jQuery('#bp-tab-container').tabs({

        active: $.cookie('activetab'),

        activate: function(event, ui) {

            $.cookie('activetab', ui.newTab.index(), {

                expires: 1

            });

        }

    });

});

