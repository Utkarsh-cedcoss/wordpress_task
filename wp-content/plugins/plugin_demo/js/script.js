/** this is our js file */
/* jQuery(function(){ */
    
    
    //     submitHandler:function(){
    //         var post_data = $("#frmPost").serialize();
    //         console.log(post_data);

            
    //     }

    // })
  jQuery(function(){  
      //var ajaxurl = '<?php ?>';
    jQuery("button").on("click",function(){
        
        //var output='<?php echo "this is right"?>';
        //console.log(ajax.ajax_url);
         var Name=jQuery("#txtName").val();
         var Email=jQuery("#txtEmail").val();
         var info = { action : "demo_aj", data: new Array(Name,Email) };
         jQuery.post(ajax.ajax_url, info ,function(response){
            //console.log(response);
            jQuery(".yes").text(response);
         });
         //console.log(info);
        
        
    });

});