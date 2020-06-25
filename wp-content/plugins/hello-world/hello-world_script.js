jQuery(document).ready(function($) {
    //console.log(object.ajaxurl);
    var fruit = "Banana";

    $.ajax({
        url : object.ajaxurl,
        //type : "post",
        data : {
            'action' : 'ajax_request',
            'fruit' : fruit,
            'nonce' : object.nonce,

        },
        success : function(data){
            console.log(data);
        },

        error : function(errorThrown){
            console.log(errorThrown);
        }
    });

    jQuery("#frmPost").validate({
        submitHandler: function(){
            //console.log("form passes");
            var Name=$("#txtName").val();
            var Email=$("#txtEmail").val();
            var Message=$("#txtMessage").val();
            var info = new Array(Name,Email,Message);
            //console.log(info);

            $.ajax({
                url : object.ajaxurl,

                data : {
                    'action' : 'ajax_feedback_form',
                    'info' : info,
                    'nonce' : object.nonce

                },

                success : function(data){
                    console.log(data);
                },
        
                error : function(errorThrown){
                    console.log(errorThrown);
                }
            })
        }

    });

    // $("#submit").click(function(){
    //     //console.log("clicked");
    //     var name=$("#name").val();
    //     var email=$("#email").val();
    //     var message=$("#message").val();
    //     var info = new Array(name,email,message);
    //     //console.log(info);

    //     $.ajax({
    //         url : object.ajaxurl,

    //         data : {
    //             'action' : 'feedback_form',
    //             'info' : info,
    //             'nonce' : object.nonce

    //         },

    //         success : function(data){
    //             console.log(data);
    //         },
    
    //         error : function(errorThrown){
    //             console.log(errorThrown);
    //         }
    //     })


    // });

});