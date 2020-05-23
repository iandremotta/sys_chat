<?php
class Users extends Model {

	private $uid;

	public function verifyLogin() {
		if(!empty($_SESSION['chathashlogin'])) {
			$s = $_SESSION['chathashlogin'];
			$sql = "SELECT * FROM users WHERE loginhash = :hash";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":hash", $s);
			$sql->execute();
			if($sql->rowCount() > 0) {
				$data = $sql->fetch();
				$this->uid = $data['id'];
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function validateUsername($u) {
		if(preg_match('/^[a-z0-9]+$/', $u)) {
			return true;
		} else {
			return false;
		}
	}

	public function userExists($u) {

		$sql = "SELECT * FROM users WHERE username = :u";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u", $u);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function emailExists($e) {

		$sql = "SELECT * FROM users WHERE email = :e";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":e", $e);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function registerUser($name, $email, $username, $pass) {
		$newpass = password_hash($pass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (name, email, username, pass) VALUES (:n, :e, :u, :p)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":n", $name);
		$sql->bindValue(":e", $email);
		$sql->bindValue(":u", $username);
		$sql->bindValue(":p", $newpass);
		$sql->execute();
	}

	public function validateUser($username, $pass) {

		$sql = "SELECT * FROM users WHERE username = :username";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":username", $username);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$info = $sql->fetch();
			
			if(password_verify($pass, $info['pass'])) {
				$loginhash = md5(rand(0,99999).time().$info['id'].$info['username']);
				$this->setLoginHash($info['id'], $loginhash);
				$_SESSION['chathashlogin'] = $loginhash;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}

	private function setLoginHash($uid, $hash) {

		$sql = "UPDATE users SET loginhash = :hash WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":hash", $hash);
		$sql->bindValue(":id", $uid);
		$sql->execute();

	}

	public function clearLoginHash() {
		$_SESSION['chathashlogin'] = '';
	}

	public function updateGroups($groups) {
		$groupstring = '';
		if(count($groups) > 0) {
			$groupstring = '!'.implode('!', $groups).'!';
		}

		$sql = "UPDATE users SET last_update = NOW(), groups = :groups WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':groups', $groupstring);
		$sql->bindValue(':id', $this->uid);
		$sql->execute();
	}

	public function clearGroups() {
		$sql = "UPDATE users SET groups = '' WHERE last_update < DATE_ADD(NOW(), INTERVAL -2 MINUTE)";
		$this->db->query($sql);
	}

	public function getUsersInGroup($group) {
		$array = array();

		$sql = "SELECT username FROM users WHERE groups LIKE :groups";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':groups', '%!'.$group.'!%');
		$sql->execute();

		if($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach($list as $item) {
				$array[] = $item['username'];
			}
		}

		return $array;
	}

	public function getUid() {
		return $this->uid;
	}

	public function findBy($info){
		$sql = "SELECT * FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $this->uid);
		$sql->execute();
		$data = $sql->fetch();
		return $data[$info];
	}
	/*
	public function getName() {

		$sql = "SELECT username FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $this->uid);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();
			return $data['username'];
		}

		return '';
	}

	public function getEmail() {

		$sql = "SELECT email FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $this->uid);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['email'];
		}

		return '';
	}

	public function getUsername() {

		$sql = "SELECT username FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $this->uid);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['username'];
		}

		return '';
	}

	public function getPass() {

		$sql = "SELECT pass FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $this->uid);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['pass'];
		}

		return '';
	}

	*/

	public function recoveryPassword($email){
		$sql = "SELECT * FROM users WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();
		if($sql->rowCount() > 0) {
	
			$sql = $sql->fetch();
			$id = $sql['id'];
			$token = md5(time().rand(0, 99999).rand(0, 99999));
			$sql = "INSERT INTO user_token (id_user, ut_hash) VALUES (:id_user, :ut_hash);";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_user", $id);
			$sql->bindValue(":ut_hash", $token);
			$sql->execute();
			
			$link = "http://projetox.pc/login/resetpass?token=".$token;

			$mensagem = "Clique no link para redefinir sua senha:<br/>".$link;

			$assunto = "Redefinição de senha";

			$headers = 'From: seuemail@seusite.com.br'."\r\n" .
					'X-Mailer: PHP/'.phpversion();
			//mail($email, $assunto, $mensagem, $headers);
			echo $mensagem;
			exit;
		}
	}

	public function resetPass($token){
		$sql = "SELECT * FROM user_token WHERE ut_hash = :ut_hash AND used = 0";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":ut_hash", $token);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id_user'];
				if(isset($_POST['password'])){
					$pass = $_POST['password'];
					$newpass = password_hash($pass, PASSWORD_DEFAULT);
					$_SESSION['chathashlogin'] = '';
					$sql2 = "UPDATE users SET pass = :pass WHERE id = :id";
								
					$sql2 = $this->db->prepare($sql2);
					$sql2->bindValue(":pass", $newpass);
					
					$sql2->bindValue(":id", $id);
					$sql2->execute();
					header("Location:".BASE_URL. 'login' );
				}			
		}else{
			header("Location:".BASE_URL. 'login' );
		}
	}

	public function updateDate(){

	}
}	




