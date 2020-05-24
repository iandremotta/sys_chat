<?php

class reportController extends controller {

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
        $data = array(
            'name' =>$this->user->findBy('name'),
            'username' =>$this->user->findBy('username'),
            'email' =>$this->user->findBy('email'),
            
        );
       
        $id = $this->user->getUid();
        $messages = new Messages();
        $group = new Groups();

        $data['message']= $messages->selectAll($id);
        
              
        //exit;
        
        
        $this->loadView('report', $data);
    }   

}