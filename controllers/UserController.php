<?php 


class UserController{
    public function indexAction($args){

        $user = new User();
        $user->setId(1);

        $user->delete();
        
    }
}