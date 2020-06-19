/** this is our js file */
jQuery(function(){
    // $("#frmPost").validate({
    //     submitHandler:function(){
    //         var post_data = $("#frmPost").serialize();
    //         console.log(post_data);

            
    //     }

    // })
    jQuery("button").on("click",function(){
        //console.log("we are ready");
         var Name=jQuery("#txtName").val();
         var Email=jQuery("#txtEmail").val();
         var info = new Array(Name,Email);
         console.log(info);
        
        
    });

});