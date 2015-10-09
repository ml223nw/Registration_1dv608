<?php

namespace controller;

class RegisterController {

	private $model;
	private $view;
	private $loginView;

	public function __construct(\model\RegisterModel $model, \view\RegisterView $view, \view\LoginView $loginView) {
	    
		$this->model = $model;
		$this->view =  $view;
		$this->loginView =  $loginView;
	}
	
    public function RegisterNewUser($isLoggedIn, $lv, $dtv) {
            
            $message = "";
            $isUserSaved = false;
            $UserTryRegister = $this->view->UserTryRegister();
            
        if (strlen($message) == 0) {
            
            if ($UserTryRegister && $this->model->GetUserData($this->view->getUserName())) {
                    $message .=  "User exists, pick another username.";
            }
            
            if ($UserTryRegister == true) {
                
                $this->model->SaveUserData($this->view->getUserName(), $this->view->getPassword());
                $message .= "Registered new user.";
                $this->loginView->SetRequestUsername(strip_tags($this->view->getUserName()));
                $isUserSaved = true;
            }
            
        }
        
        if ($UserTryRegister && strcmp($this->view->getPassword(), $this->view->getRepeatPassword()) != 0) {
            
		    $message .=  "Passwords do not match.<br>";
	    } 
	    
        if (strlen($message) == 0 && $UserTryRegister && $this->model->GetUserData($this->view->getUserName())) {
            
            $message .=  "User exists, pick another username.";
        } 
            
        if (preg_match('/[^A-Za-z0-9.#\\-$]/', $this->view->getUserName())) {
            
            $message =  "Username contains invalid characters.";
            $this->view->SetRequestUsername(strip_tags($this->view->getUserName()));
        }
                    
        if ($UserTryRegister && (mb_strlen($this->view->getUserName(),'UTF-8') < 3)) {
            
		    $message =  "Username has too few characters, at least 3 characters.<br>";
	    } 
	    
        if ($UserTryRegister && (mb_strlen($this->view->getPassword(),'UTF-8') < 6)) {
            
		    $message .=  "Password has too few characters, at least 6 characters.<br>";
    	} 
        
        $this->view->setMessage($message);
        
        if ($isUserSaved == true) {
            
            return $message;
            
        } else {
            
            $lv->renderRegister($isLoggedIn,$this->view,$dtv);
        }
        
        }
        
    }


