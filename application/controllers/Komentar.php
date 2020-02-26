<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    $this->load->model('komentar_model');
		$this->load->model('user_model');
		$this->load->model('notifikasi_model');
	}

  public function isAdmin(){
		$bool = false;
		if (isset($_SESSION['username'])) {
			$role = $_SESSION['username'];
			if ($role=="admin") {
				$bool=true;
			}
		}
		return $bool;
	}

  public function isLogin(){
    $bool = false;
    if (isset($_SESSION['username'])) {
      $bool=true;
    }
    return $bool;
  }

  public function komentar_rating($id_resep){
		if($this->isAdmin() && $this->isLogin()){
			$data['getUser'] = $this->user_model->getUser();
			$this->load->view('admin/admin', $data);
		}else if(!$this->isAdmin() && $this->isLogin()){
			$post = $this->input->post();
			$input->id_user = $_SESSION['id_user'];
			$input->id_resep = $id_resep;
			$input->komentar = $post['message'];
			$input->rating =  $post['rate'];
			$query = $this->komentar_model->insert_komentar_rating($input);
			$k['komentar'] = $this->komentar_model->komentar()->result_array();
			$data->id_user = $k['komentar'][0]['id_user_resep'];
			$data->id_komentar = $k['komentar'][0]['id_komentar'];
			$this->user_model->insert_data_notifikasi($data);
			redirect ('resep/halaman_resep/'.$id_resep);
		}else{
			redirect('/user/login');
		}
	}

	public function delete_komentar($id_komentar)
	{
		if($this->isAdmin() && $this->isLogin()){
			$data['getUser'] = $this->user_model->getUser();
			$this->load->view('admin/admin', $data);
		}else if(!$this->isAdmin() && $this->isLogin()){
			$data['id_resep'] = $id_resep;
			$this->komentar_model->deleteKomentar($id_komentar);
			redirect ('resep/halamanutama', 'location');
		}else if(!$this->isLogin()){
			redirect('/user/login');
		}

	}
}
