<?php

class settingsController extends controller {

    private $user;

    public function __construct()
    {
        $this->user = new Users();

        if(!$this->user->verifyLogin()){
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }
    public function index(){
        $dados = array(
            'name' => $this->user->getName(),
        );

        $this->loadTemplate('settings', $dados);
    }   

}