<?php
$getParam=isset($_REQUEST['param'])?$_REQUEST['param']:'';

if(!empty($getParam)){
    if($getParam=="get_message"){
        echo json_encode(array(
            "name"=>"online web tutor",
            "author"=>"Sanjay Kumar"
        ));
        die;
    }


    if($get_param=="post_form_data"){
        echo json_encode($_REQUEST);
        die;
    }
}
?>