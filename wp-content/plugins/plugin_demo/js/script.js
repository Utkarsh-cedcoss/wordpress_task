/** this is our js file */
//   jQuery(function(){  
      
//     jQuery("button").on("click",function(){
        
        
//          var Name=jQuery("#txtName").val();
//          var Email=jQuery("#txtEmail").val();
//          var info = { action : "demo_aj", data: new Array(Name,Email) };
//          jQuery.post(ajax.ajax_url, info ,function(response){
            
//             jQuery(".yes").text(response);
//          });
        
        
        
//     });

// });


jQuery(document).ready(function($) {
  //console.log("yess...");
  $("button").click(function(){
    //console.log("clicked");
    var Name=jQuery("#txtName").val();
    var Email=jQuery("#txtEmail").val();
    var info = new Array(Name,Email);
    //console.log(ajax.ajax_url);
    
    $.ajax({
      url : ajax.ajax_url,
      data : {
        'action':'example_ajax_request',
        'info' : info,
        'nonce' : ajax.nonce
      },

      success:function(data) {
        // This outputs the result of the ajax request
        console.log(data);
    },
    error: function(errorThrown){
        console.log(errorThrown);
    }

    
    });

  });


  $("#submit").click(function(){
      //console.log("clicked");
      var name=$("#name").val();
        var email=$("#email").val();
        var message=$("#message").val();
        var info = new Array(name,email,message);
        console.log(info);

        $.ajax({
                  url : ajax.ajax_url,  // 'ajax' is the object we made at the time of localizing script and 'ajax_url' is the key which points to 'admin-ajax.php' file
      
                  data : {
                      'action' : 'feedback_form',
                      'info' : info,
                      'nonce' : ajax.nonce  // 'ajax' is object, 'nonce' is key described while localizing script.
      
                  },
      
                  success : function(data){
                      console.log(data);
                  },
          
                  error : function(errorThrown){
                      console.log(errorThrown);
                  }
              });
  });
});