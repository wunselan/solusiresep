<?php

class teman_model extends CI_Model{
  public function __construct()
	{
    $this->load->database();
  }

  public function follow($data)
  {
    return $this->db->insert('teman', $data);
  }

  public function isfollowing($id_user){
    $this->db->select('*');
    $this->db->from('teman');
    $this->db->where(array('id_ikuti'=>$id_user, 'id_usera'=>$_SESSION['id_user']));
    return $this->db->get()->num_rows();
  }

  public function unfollow($id_user){
    return $this->db->delete('teman', array('id_ikuti'=>$id_user, 'id_usera'=>$_SESSION['id_user']));
  }

  public function following($id_user){
    $this->db->select('*');
    $this->db->from('teman');
    $this->db->join('user', 'user.id_user = teman.id_ikuti');
    $this->db->where(array('id_usera'=>$id_user));
    return $this->db->get();
  }

  public function follower($id_user){
    $this->db->select('*');
    $this->db->from('teman');
    $this->db->join('user', 'user.id_user = teman.id_usera');
    $this->db->where(array('id_ikuti'=>$id_user));
    return $this->db->get();
  }

  public function teman(){
    $this->db->select('*');
    $this->db->from('teman');
    $this->db->order_by('id_teman', 'DESC');
    return $this->db->get();
  }

  public function resep_teman($id_user, $perpage=null, $offset=null){
    if (isset($perpage) && isset($offset)) {
      $this->db->select('resepmasakan.nama_resep, resepmasakan.id_resep, resepmasakan.resep_foto, user.username, user.id_user'); // <-- There is never any reason to write this line!
      $this->db->from('resepmasakan');
      $this->db->join('user', 'user.id_user = resepmasakan.id_user');
      $this->db->join('teman', 'user.id_user = teman.id_ikuti');
      $this->db->limit($perpage, $offset);
      $this->db->where(array('id_usera'=>$_SESSION['id_user']));
      $this->db->order_by('resepmasakan.create_add', 'desc');
      return $this->db->get();
    }
    $this->db->select('resepmasakan.nama_resep, resepmasakan.id_resep, resepmasakan.resep_foto, user.username, user.id_user'); // <-- There is never any reason to write this line!
    $this->db->from('resepmasakan');
    $this->db->join('user', 'user.id_user = resepmasakan.id_user');
    $this->db->join('teman', 'user.id_user = teman.id_ikuti');
    $this->db->where(array('id_usera'=>$_SESSION['id_user']));
    $this->db->order_by('resepmasakan.create_add', 'desc');
    return $this->db->get();
  }

}
