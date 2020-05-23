<?php

class loginController extends controller {
    public function index() {
		$data = array(
			'msg' => ''
		);

		if(!empty($_GET['error'])) {
			if($_GET['error'] == '1') {
				$data['msg'] = 'Usuário e/ou senha inválidos!';
			}
		}

		$this->loadView('login', $data);
	}

	public function signin() {

		if(!empty($_POST['username'])) {
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];

			$users = new Users();
			if($users->validateUser($username, $pass)) {
				header("Location: ".BASE_URL);
				exit;
			} else {
				header("Location: ".BASE_URL.'login?error=1');
				exit;
			}
		} else {
			header("Location: ".BASE_URL.'login');
			exit;
		}

	}

	public function signup() {
		$data = array(
			'msg' => ''
		);

		if(!empty($_POST['username'])) {
			$name = $_POST['name'];
			$email = strtolower($_POST['email']);
			$username = strtolower($_POST['username']);
			$pass = $_POST['pass'];

			$users = new Users();
			
			if(!$users->emailExists($email)){
				if($users->validateUsername($username)) {
					if(!$users->userExists($username)) {
						$users->registerUser($name, $email, $username, $pass);
						header("Location: ".BASE_URL."login");
					} else {
						$data['msg'] = 'Usuário já existente!';
					}
				} else {
					$data['msg'] = 'Usuário não válido (Digite apenas letras e números).';
				}
			} else {
				$data['msg'] = "E-mail inválido.";
			}
			}

			

		$this->loadView('signup', $data);
	}


	public function forget(){
		$data = array(
			'msg' => ''
		);

		if(!empty($_POST['email'])) {
			$email = $_POST['email'];
			$users = new Users();
			$users->recoveryPassword($email);
		}

		$this->loadView('forget', $data);
	}
	

	public function resetpass(){
		$data = array(
			'msg' => ''
		);
		if(!empty($_GET['token'])){
			$token = $_GET['token'];
			$users = new Users();
			$users->resetPass($token);
			$this->loadView('resetpass', $data);
		} else{
			header("Location: ".BASE_URL.'login');
		}
	
	}

	public function logout() {
		$users = new Users();
		$users->clearLoginHash();

		header("Location: ".BASE_URL.'login');
	}

}
