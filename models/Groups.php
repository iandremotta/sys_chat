<?php
class Groups extends Model {

    public function getList(){
        $array = array();
        $sql = "SELECT * FROM db_batepapo.groups ORDER by name ASC";
        $sql = $this->db->query($sql);
        $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function add($name){
        $sql = "INSERT INTO db_batepapo.groups (name) VALUES (:name)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':name', $name);
        $sql->execute();
    }  
    
    public function getName($id){
        $sql = "SELECT name FROM db_batepapo.groups WHERE id = $id";
        $sql = $this->db->query($sql);
        $array = $sql->fetch();
        return $array['name'];
    }

    /* create admin and method isAdmin(boolean)
    public function deleteGroup($id){
        $user = new Users();
        if($user->isAdmin()){
            $sql = "DELETE FROM db_batepapo.groups WHERE id = $id";
            $sql = $this->db->query($sql);
            $sql->execute();
        }
    }
    */
}