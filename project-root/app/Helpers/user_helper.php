<?php

if(!function_exists('isUserLoggedIn')){
    function isUserLoggedIn(){
        $userSession = session()->get('user_id');

        if($userSession){
            return true;
        }else{
            return false;
        }
    }
}

?>