<?php

namespace view;

class RegisterView {
	
        private static $registration = "RegisterView::Register";
		private static $messageId = "RegisterView::Message";
        private static $register = "register";
        private static $name = "RegisterView::UserName";
        private static $password = "RegisterView::Password";
        private static $passwordRepeat = "RegisterView::PasswordRepeat";

        
        private static $sessionSaveLocation = "\\view\\LoginView\\message";

        private $message = "";
        private $RequestUsername = "";
     
 	public function userWantsToRegister() {
		
		return isset($_GET[self::$register]) || isset($_POST[self::$registration]) ;            
	}  
        
	public function UserTryRegister() {
		
		return isset($_POST[self::$registration]);
	}  
        
	public function response() {

            return $this->doRegisterForm();
        }    

	private function doRegisterForm() {
		
		return $this->generateRegisterFormHTML($this->message);
	}      

        
	private function redirect($message) {
		
		$_SESSION[self::$sessionSaveLocation] = $message;
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		header("Location: $actual_link");
	}
	
		public function getRequestUserName() {
                if ($this->RequestUsername != "")
                    return $this->RequestUsername;
		if (isset($_POST[self::$name]))
			return trim($_POST[self::$name]);
		return "";
	}  
        
	public function setRequestUsername($name) {
		$this->RequestUsername = $name;
        }
                
	public function getUserName() {
		if (isset($_POST[self::$name]))
			return trim($_POST[self::$name]);
		return "";
	}        

	public function getPassword() {
		if (isset($_POST[self::$password]))
			return trim($_POST[self::$password]);
		return "";
	}   
	public function getRepeatPassword() {
		if (isset($_POST[self::$passwordRepeat]))
			return trim($_POST[self::$passwordRepeat]);
		return "";
	}                
	public function setMessage($message) {
		$this->message = $message;
	}                


 	private function generateRegisterFormHTML($message) {
		return 
                        "<h2>Register new user</h2>
                        <form method='post' > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id='".self::$messageId."'>$message</p>
                                        <div>
					<label for='".self::$name."'>Username :</label>
					<input type='text' id='".self::$name."' name='".self::$name."' value='".$this->getRequestUserName()."'/>
                                        </div>
                                        <div>
					<label for='".self::$password."'>Password :</label>
					<input type='password' id='".self::$password."' name='".self::$password."'/>
                                        </div>
                                        <div>
					<label for='".self::$passwordRepeat."'>Repeat password :</label>
					<input type='password' id='".self::$passwordRepeat."' name='".self::$passwordRepeat."'/>
                                        </div>

    					<input type='submit' name='".self::$registration."' value='Register'/>
				</fieldset>
			</form>
		";
	}  
	
}
        