<?php

class notifikasi_model extends CI_Model{
  public function __construct()
	{
    $this->load->database();
  }
  public function get_notifikasi($id_user){
    $query=  "(SELECT notifikasi.id_notifikasi, notifikasi.id_user as notif_user, user.id_user as id_memberi_notif, user.username as memberi_notif, komentar.id_resep as resep_komen, notifikasi.status as status, 'komentar' as jenis, komentar.create_add as create_add
              FROM `notifikasi`
              LEFT JOIN komentar ON komentar.id_komentar=notifikasi.id_komentar
              RIGHT JOIN user ON user.id_user=komentar.id_user
              WHERE notifikasi.id_user='$_SESSION[id_user]'&& notifikasi.status=0
              )
              UNION
              (SELECT notifikasi.id_notifikasi, notifikasi.id_user as notif_user, user.id_user as id_memberi_notif, user.username as memberi_notif, 'follow' as resep_komen, notifikasi.status as status, 'follow' as jenis, teman.create_add as create_add
              FROM `notifikasi`
              LEFT JOIN teman ON teman.id_teman=notifikasi.id_teman
              RIGHT JOIN user ON user.id_user=teman.id_usera
              WHERE notifikasi.id_user='$_SESSION[id_user]' && notifikasi.status=0
              )ORDER BY `create_add` desc";
    return $this->db->query($query);
  }

  public function update_status($id_notifikasi){
    $this->db->set('status', "1");
    $this->db->where(array('id_notifikasi'=>$id_notifikasi));
    $this->db->update('notifikasi');
  }

  public function get_notifikasi_status($id_notifikasi){
    $this->db->from('notifikasi');
    $this->db->where(array('id_notifikasi'=>$id_notifikasi));
    return $this->db->get();
  }

  public function get_teman($id_teman){
    $this->db->select('teman.id_usera, user.username'); // <-- There is never any reason to write this line!
    $this->db->from('notifikasi');
    $this->db->join('teman', 'teman.id_teman = notifikasi.id_teman');
    $this->db->join('user', 'user.id_user = teman.id_usera');
    $this->db->where(array('notifikasi.id_teman'=>$id_teman));
    return $this->db->get();
  }
  public function get_komentar($id_komentar){
    $this->db->select('komentar.id_resep'); // <-- There is never any reason to write this line!
    $this->db->from('notifikasi');
    $this->db->join('komentar', 'komentar.id_komentar = notifikasi.id_komentar');
    $this->db->where(array('notifikasi.id_komentar'=>$id_komentar));
    return $this->db->get();
  }
  /*  public function get_numrows_notifikasi(){
      $this->db->select('*');
      $this->db->from('notifikasi');
      $this->db->where(array('id_user'=>$_SESSION['id_user']));
      return $this->db->get()->num_rows();
    }*/
}
