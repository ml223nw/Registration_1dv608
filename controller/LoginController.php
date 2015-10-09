<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace controller;

require_once("model/LoginModel.php");
require_once("view/LoginView.php");
require_once("model/RegisterModel.php");
require_once("controller/RegisterController.php");

class LoginController {

	private $model;
	private $view;
	private $regModel;
	private $regView;
	private $regController;
        
	public function __construct(\model\LoginModel $model, \view\LoginView $view) {
		
		$this->model = $model;
		$this->view =  $view;
        $this->regView = new \view\RegisterView();
        $this->regModel = new \model\RegisterModel();
	}
	
    public function RunApp($lv, $dtv) {
    	
        $isLoggedIn = $this->model->isLoggedIn($this->view->getUserClient());
        if ($this->regView->userWantsToRegister()){
            
            $this->regController = new \controller\RegisterController($this->regModel, $this->regView, $this->view);
            $message = $this->regController->RegisterNewUser($isLoggedIn, $lv,$dtv);
            if (strlen($message) > 0)
                $this->view->redirect_index ($message);
        }
        else {
            $lv->renderLogin($isLoggedIn, $this->view, $dtv);
        }        
    }


	public function doControl() {
		
		$userClient = $this->view->getUserClient();

		if ($this->model->isLoggedIn($userClient)) {
			if ($this->view->userWantsToLogout()) {
				$this->model->doLogout();
				$this->view->setUserLogout();
			}
		} else {
			
			if ($this->view->userWantsToLogin()) {
				$uc = $this->view->getCredentials();
				if ($this->model->doLogin($uc, $this->regModel) == true) {
					$this->view->setLoginSucceeded();
				} else {
					$this->view->setLoginFailed();
				}
			}
		}
		$this->model->renew($userClient);
	}
	
}