jQuery(document).ready(function($) {
    //console.log(object.ajaxurl);
    var fruit = "Banana";

    $.ajax({
        url : object.ajaxurl,
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
});