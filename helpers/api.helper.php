<?php

class ApiHelper {

    function getData() {
        $data = file_get_contents("php://input");
        return json_decode($data); 
    }  
}
