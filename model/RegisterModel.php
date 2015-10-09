<?php

namespace model;

class RegisterModel {
    
    private static $file = "data/RegisteredUsers.txt";
    
        public function GetUserData($userName) {
            
        $handleUserData = fopen(self::$file, 'r');
        
        do
            {
                
            $userData = fgets($handleUserData);
            $seperateUserAndPasswordData = explode("::", $userData);
            
            if (strcmp($userName, $seperateUserAndPasswordData[0]) == 0) {
                
                fclose($handleUserData);
                return $userData;
            }

        }
        while(strlen($userData) > 0);
        fclose($handleUserData);
    }    
    
    public function SaveUserData($userName, $password) {
         
        $handleUserData = fopen(self::$file, 'a');
        $userData = $userName . "::" .password_hash($password, PASSWORD_BCRYPT) .PHP_EOL;        
        fwrite($handleUserData, $userData);
        fclose($handleUserData);
    }
    
}
