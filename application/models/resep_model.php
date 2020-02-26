<?php

class resep_model extends CI_Model{
  public function __construct()
	{
    $this->load->database();
  }

  function getResep(){
    $query = $this->db->get('resepmasakan');
    return $query;
  }

  function delete($id_resep){
    return $this->db->delete('resepmasakan', array('id_resep'=>$id_resep));
  }

  public function get_all_resep($perpage=null, $offset=null){
    if (isset($perpage) && isset($offset)) {
      $this->db->select('*'); // <-- There is never any reason to write this line!
      $this->db->from('resepmasakan');
      $this->db->join('user', 'user.id_user = resepmasakan.id_user');
      $this->db->limit($perpage, $offset);
      $this->db->order_by("id_resep", "desc");
      return $this->db->get();
    }

    $this->db->select('*'); // <-- There is never any reason to write this line!
    $this->db->from('resepmasakan');
    $this->db->join('user', 'user.id_user = resepmasakan.id_user');
    $this->db->order_by('id_resep', 'DESC');
    return $this->db->get();
  }

  public function insert_resep_masakan($data){

        return $this->db->insert('resepmasakan', $data);
  }

  public function getsearch_byname($data){
    $query = "SELECT user.id_user as id_user, user.username as username, user.nama as nama, user.user_foto as user_foto, resepmasakan.id_resep as id_resep, resepmasakan.id_user as id_user_resep, resepmasakan.resep_foto as resep_foto, resepmasakan.nama_resep as nama_resep FROM `user`
      LEFT JOIN `resepmasakan` ON user.id_user = resepmasakan.id_user
      WHERE `username` LIKE '%$data%' OR resepmasakan.nama_resep LIKE '%$data%'
      UNION
      SELECT user.id_user as id_user, user.username as username, user.nama as nama, user.user_foto as user_foto, resepmasakan.id_resep as id_resep, resepmasakan.id_user as id_user_resep, resepmasakan.resep_foto as resep_foto, resepmasakan.nama_resep as nama_resep FROM `user`
      RIGHT JOIN `resepmasakan` ON user.id_user = resepmasakan.id_user
      WHERE `username` LIKE '%$data%' OR resepmasakan.nama_resep LIKE '%$data%'";

    return $this->db->query($query);

    // return $this->db->get();
  }

  public function get_resep_utama($id_resep){
    $this->db->select('*'); // <-- There is never any reason to write this line!
    $this->db->from('resepmasakan');
    $this->db->join('user', 'user.id_user = resepmasakan.id_user');
    $this->db->where(array('resepmasakan.id_resep'=>$id_resep));
    return $this->db->get();
  }

  // public function get_populer(){
  //   $query = "SELECT *, AVG(rating) as rating_masakan FROM komentar
  //             JOIN resepmasakan ON `resepmasakan`.`id_resep` = `komentar`.`id_resep`
  //             JOIN user ON `user`.`id_user`= `komentar`.`id_user`
  //             GROUP BY komentar.id_resep ORDER BY rating_masakan DESC";
  //   return $this->db->query($query);
  // }

  public function get_populer($perpage=null, $offset=null){
    if (isset($perpage) && isset($offset)) {
      $this->db->select('*, avg(rating) as rating_masakan'); // <-- There is never any reason to write this line!
      $this->db->from('komentar');
      $this->db->join('resepmasakan', 'resepmasakan.id_resep = komentar.id_resep');
      $this->db->join('user', 'user.id_user = resepmasakan.id_user');
      $this->db->limit($perpage, $offset);
      $this->db->group_by("komentar.id_resep");
      $this->db->order_by("rating_masakan", "desc");
      return $this->db->get();
    }

    $this->db->select('*, avg(rating) as rating_masakan'); // <-- There is never any reason to write this line!
    $this->db->from('komentar');
    $this->db->join('resepmasakan', 'resepmasakan.id_resep = komentar.id_resep');
    $this->db->join('user', 'user.id_user = resepmasakan.id_user');
    $this->db->group_by("komentar.id_resep");
    $this->db->order_by("rating_masakan", "desc");
    return $this->db->get();
  }

  public function get_resep_komentar($id_resep){
    $this->db->from('komentar');
    $this->db->join('user', 'komentar.id_user = user.id_user');
    $this->db->where(array('id_resep'=>$id_resep));
    return $this->db->get();
  }

  public function update_resep($data,$id_resep){
    $this->db->where(array('id_resep'=>$id_resep));
    $this->db->update('resepmasakan', $data);

  }

  // function delete_resep($id_resep){
  //   return $this->db->delete('resepmasakan', array('id_resep'=>$id_resep));
  // }

  // public function get_komentar_rating($id_resep){
  //   $this->db->select('*'); // <-- There is never any reason to write this line!
  //   $this->db->from('komentar');
  //   $this->db->where(array('id_resep'=>$id_resep));
  // }
}
