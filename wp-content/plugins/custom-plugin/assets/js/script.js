/** this is our js file */
jQuery(function(){
    jQuery(document).on("click",".btnclick",function(){
        //console.log(ajaxurl);
        var post_data="action=custom_plugin_library&param=get_message";
        $.post(ajaxurl,post_data,function(response){
            console.log(response);
        });  // this function is used to send form data to server.
    });

    $(function(){
        $("#frmPost").validate({
            submitHandler:function(){
                var post_data = $("#frmPost").serialize()+"&action=custom_plugin_library&param=post_form_data";

                $.post(ajaxurl,post_data,function(response){
                    console.log(response);
                });
            }

        })
      });
});