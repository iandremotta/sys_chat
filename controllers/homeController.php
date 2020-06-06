<?php

class homeController extends controller {

    private $user;

    /*
        só deixa o usuário entrar no sistema se estiver logado
    */
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
            'id' =>$this->user->getUid(),
            'name' =>$this->user->findBy('name'),
        );
        $this->loadTemplate('home', $dados);
    }   

}