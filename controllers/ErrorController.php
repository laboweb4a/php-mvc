<?php

class ErrorController {
    public function notFoundAction(){
        header("HTTP/1.0 404 Not Found");
        echo "404";
    }
}