<?php

class ajaxController extends controller {

	private $user;
	

    public function __construct()
    {
        $this->user = new Users();
        if(!$this->user->verifyLogin()){
            $array = array(
                'status' => '0'
            );
            echo json_encode($array);
            exit;
        }
    }
    public function index(){}
      
    public function get_groups(){
        $array = array('status' => '1');
        $groups = new Groups();
        $array['list'] = $groups->getList();

        echo json_encode($array);
        exit;
    }

    public function add_group(){
        $array = array('status'=>'1', 'error'=>'0');
        $groups = new Groups();

        if(!empty($_POST['name'])){
            $name = $_POST['name'];

            $groups->add($name);
        } else{
            $array['error'] = '1';
            $array['errorMsg'] = 'Falta o nome do grupo';
        }
        echo json_encode($array);
        exit;
    }

    public function add_message() {
		$array = array('status' => '1', 'error' => '0');
		$messages = new Messages();

		if(!empty($_POST['msg']) && !empty($_POST['id_group'])) {
			$msg = $_POST['msg'];
			$id_group = $_POST['id_group'];
			$uid = $this->user->getUid();

			$messages->add($uid, $id_group, $msg, 'text');
		} else {
			$array['error'] = '1';
			$array['errorMsg'] = 'Mensagem vazia';
		}

		echo json_encode($array);
		exit;
	}

	/*
	don't working
	public function add_file() {
		$array = array('status' => '1', 'error' => '0');
		$messages = new Messages();

		if(!empty($_POST['id_group'])) {
			$id_group = $_POST['id_group'];
			$uid = $this->user->getUid();

			
			if(!empty($_FILES['file']['tmp_name'])) {
				if(in_array($_FILES['file']['type'], )) {
					$newname = md5(time().rand(0,9999));
					
					move_uploaded_file($_FILES['file']['tmp_name'], 'media/images/'.$newname);
					$messages->add($uid, $id_group, $newname, 'file');
				} else {
					$array['error'] = '1';
					$array['errorMsg'] = 'Arquivo inválido';
				}
			}else {
				$array['error'] = '1';
				$array['errorMsg'] = 'Arquivo em branco';
			}
		} else {
			$array['error'] = '1';
			$array['errorMsg'] = 'Grupo inválido';
		}

		echo json_encode($array);
		exit;
	}
	

	*/
	
    public function get_messages() {
		$array = array('status' => '1', 'msgs' => array(), 'last_time' => date('Y-m-d H:i:s'));
		$messages = new Messages();

		set_time_limit(60); //finish response

		$ult_msg = date('Y-m-d H:i:s');
		if(!empty($_GET['last_time'])) {
			$ult_msg = $_GET['last_time'];
		}

		$groups = array();
		if(!empty($_GET['groups']) && is_array($_GET['groups'])) {
			$groups = $_GET['groups'];
		}

		$this->user->updateGroups( $groups );
		$this->user->clearGroups();
		
		while(true) {
			session_write_close();//bug
			$msgs = $messages->getMessage($ult_msg, $groups);

			if(count($msgs) > 0) {
				$array['msgs'] = $msgs;
				$array['last_time'] = date('Y-m-d H:i:s');
				break;
			} else {
				sleep(2);
				continue;
			}
			
		}

		echo json_encode($array);
		
	}

}
