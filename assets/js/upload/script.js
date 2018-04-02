(function($) {
    $(function(){
        // Initialize the jQuery File Upload plugin
        $('.upload').each(function(){
            var $this = $(this);
            var $_id = $(this).attr('data-id');
            $(this).fileupload({
                add: function (e, data) {
                    var $_id = data.form[0].id;
                    $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'inline-block'); 
                    });
                    var jqXHR = data.submit().done(function(data){
                        data = JSON.parse(data);
                        $('#gva-' + $_id + ' .loading').each(function(){
                            $(this).css('display', 'none'); 
                        });
                        $('#gva-' + $_id + ' input.file-input').each(function(){
                            $(this).val(data['file_url']); 
                        });

                        $('#slide-reviews-' + $_id).css('background', 'url(\'' + data['file_url_full'] + '\')');

                        $('#gva-' + $_id + ' .gavias-field-upload-remove').each(function(){
                            $(this).css('display', 'inline-block');
                        });

                    });
                },

                progress: function(e, data){
                
                },
                fail: function(e, data){
                    // Something has gone wrong!
                    data.context.addClass('error');
                }
            });
        });

        // Helper function that formats the file sizes
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }

    });

    $(document).ready(function(){
        $('.gavias-field-upload-remove').click(function(){
          $(this).parent().find('.gavias-image-demo').attr('src', $(this).attr("data-src"));
          $(this).parent().find('input.file-input').val('');
        })
    });

})(jQuery);