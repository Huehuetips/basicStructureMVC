<?php

namespace app\classes;
use app\models\mainModel;

class userClass extends mainModel{

    private $userUser;
    private $passwordUser;

    function setUserUser($userUser){
        $this->userUser = $userUser;
    }

    function getUserUser(){
        return $this->userUser;
    }

    function setPasswordUser($passwordUser){
        $this->passwordUser = $passwordUser;
    }

    function getPasswordUser(){
        return $this->passwordUser;
    }
}