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
if(!function_exists('isAdminLoggedIn')){
    function isAdminLoggedIn(){
        if(isAdmin()){
            $admin_logged = session()->get('isAdminLoggedIn');
            if($admin_logged === '1'){
                return true;
            }else{
                return false;
            }
        }
    }
}
if(!function_exists('isAdmin')){
    function isAdmin(){
        if(isUserLoggedIn()){
            $admin = session()->get('isAdmin');
            if($admin === '1'){
                return true;
            }else{
                return false;
            }
        }
    }
}

?>