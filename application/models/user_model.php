<?php

class user_model extends CI_Model{
  public function __construct()
	{
    $this->load->database();
  }

  function login($username, $password){
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $query = $this->db->get('user');

    if($query->num_rows()>0){
      $result = $query->result();
      $_SESSION['username'] = $result[0]->username;
      $_SESSION['id_user'] = $result[0]->id_user;
      return true;
    }else{
      return false;
    }
  }

  function getUser(){
    $query = $this->db->get('user');
    return $query;
  }

  function delete($id_user){
    return $this->db->delete('user', array('id_user'=>$id_user));
  }

  public function insert_data_member($data){
    return $this->db->insert('user', $data);
  }


  public function get_profile_resep($username, $perpage=null, $offset=null){
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('resepmasakan');
      $this->db->join('user', 'user.id_user = resepmasakan.id_user');
      $this->db->where(array('username'=>$username));
      $this->db->limit($perpage, $offset);
      $this->db->order_by("id_resep", "desc");

      return $this->db->get();
  }

  public function get_profile($username){
    $this->db->select('*'); // <-- There is never any reason to write this line!
    $this->db->from('user');
    $this->db->where(array('username'=>$username));
    return $this->db->get();
  }

  public function get_edit($id_user){
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where(array('id_user'=>$_SESSION['id_user']));
    return $this->db->get();
  }

  public function update_profile($data){
    $this->db->where(array('id_user'=>$_SESSION['id_user']));
    $this->db->update('user', $data);

  }

  public function update_profileadmin($data, $id_user){
    $this->db->where(array('id_user'=>$id_user));
    $this->db->update('user', $data);

  }
  public function insert_data_notifikasi($input){
    return $this->db->insert('notifikasi', $input);
  }

}
?>
