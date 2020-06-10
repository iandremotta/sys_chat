<?php

class settingsController extends controller
{

    private $user;

    public function __construct()
    {
        $this->user = new Users();

        if (!$this->user->verifyLogin()) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }
    public function index()
    {
        $dados = array(
            'id' => $this->user->findBy('id'),
            'name' => $this->user->findBy('name'),
            'email' => $this->user->findBy('email'),
            'username' => $this->user->findBy('username'),
            'pass' => $this->user->findBy('email'),
        );

        $this->loadTemplate('settings', $dados);
    }

    public function resetpass()
    {
        $data = array();
        $id = $this->user->getUid();

        $this->user->updatePass($id);
        $this->loadView('resetpass', $data);
    }

    public function updateusername()
    {
        $data = array();
        if (!empty($_POST['data']) && isset($_POST['data'])) {
            $username = strtolower($_POST['data']);
            if (!$this->user->userExists($username)) {
                $id = $this->user->getUid();
                $this->user->updateData($id, 'username');
            } else {
                echo "dados inválidos";
            }
        }


        $this->loadView('updateusername', $data);
    }

    public function updateName()
    {
        $data = array();

        $id = $this->user->getUid();
        $this->user->updateData($id, 'name');
        $this->loadTemplate('updatename', $data);
    }

    public function updateEmail()
    {
        $data = array();
        if (!empty($_POST['data']) && isset($_POST['data'])) {
            $email = strtolower($_POST['data']);
            if (!$this->user->emailExists($email)) {
                $id = $this->user->getUid();
                $this->user->updateData($id, 'email');
            } else {
                echo "dados inválidos";
            }
        }
        $this->loadView('updateemail', $data);
    }

    public function deleteUser()
    {
        $data = array();
        $id = $this->user->getUid();
        if (isset($_POST['data']) && (!empty($_POST['data'])) && $_POST['data'] == 'confirmar') {
            $this->user->updateData($id, 'deleted');
            $this->user->clearLoginHash();
        }

        if (isset($_POST['data']) && (!empty($_POST['data']))) {
            $data['msg'] = 'Escreva confirmar.';
        }

        $this->loadView('deleteuser', $data);
    }
}
