<?php

class komentar_model extends CI_Model{
  public function __construct()
	{
    $this->load->database();
  }

  function deleteKomentar($id_komentar){
    return $this->db->delete('komentar', array('id_komentar'=>$id_komentar));
  }

  public function insert_komentar_rating($data){
      $this->db->insert('komentar', $data);
	}

  public function komentar(){
    $this->db->select('komentar.id_komentar as id_komentar, resepmasakan.id_user as id_user_resep');
    $this->db->from('komentar');
    $this->db->join('resepmasakan', 'resepmasakan.id_resep = komentar.id_resep');
    $this->db->order_by('komentar.id_komentar', 'DESC');
    return $this->db->get();
  }

}
