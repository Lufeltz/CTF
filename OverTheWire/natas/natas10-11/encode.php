<?php
    $encoded_data = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");

    echo base64_encode(json_encode($encoded_data));
?> 
