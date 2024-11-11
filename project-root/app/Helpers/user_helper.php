<?php

if(!function_exists('isUserLoggedIn')){
    function isUserLoggedIn(){
        $userSession = session()->get();

        if($userSession){
            return true;
        }else{
            return false;
        }
    }
}

?>