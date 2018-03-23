<?php

/**
* 
*/
//class auth_helper {

    function doLogin($user, $pass){
        
        if ($user == 'admin' and $pass == 'admin') {
            $_SESSION['user'] = 'admin';
            $_SESSION['name'] = 'admin';
            return true;
        }
        return false;
    }
    function doLogout(){
        unset($_SESSION['user'], $_SESSION['name']);
        return true;
    }
    function isLoggedIn(){   // isAdmin()
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }   
//}