<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teman extends CI_Controller {

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
    $this->load->model('user_model');
		$this->load->model('teman_model');
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

  public function follow($username, $id_user){
		if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			$data['profile']=$this->user_model->get_profile($username)->result_array();
	    $data['total_rows']=$this->user_model->get_profile_resep($username)->num_rows();
		  $data['ikuti']=$this->teman_model->isfollowing($id_user);
			$data['follow']=$this->teman_model->following($id_user)->result_array();
			$data['total_rows_follow']=$this->teman_model->following($id_user)->num_rows();
			$data['total_rows_follower']=$this->teman_model->follower($id_user)->num_rows();
			$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
	    $this->load->view('layout/user_header',$data);
	    $this->load->view('member/following',$data);
	    $this->load->view('layout/user_footer');
		}else if(!$this->isLogin()){
			$data['profile']=$this->user_model->get_profile($username)->result_array();
	    $data['total_rows']=$this->user_model->get_profile_resep($username)->num_rows();
			$data['follow']=$this->teman_model->following($id_user)->result_array();
			$data['total_rows_follow']=$this->teman_model->following($id_user)->num_rows();
			$data['total_rows_follower']=$this->teman_model->follower($id_user)->num_rows();
			$this->load->view('layout/guest_header');
			$this->load->view('member/following',$data);
			$this->load->view('layout/user_footer');
		}
  }

	public function follower($username, $id_user){
		if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			$data['profile']=$this->user_model->get_profile($username)->result_array();
	    $data['total_rows']=$this->user_model->get_profile_resep($username)->num_rows();
		  $data['ikuti']=$this->teman_model->isfollowing($id_user);
			$data['follow']=$this->teman_model->follower($id_user)->result_array();
			$data['total_rows_follow']=$this->teman_model->following($id_user)->num_rows();
			$data['total_rows_follower']=$this->teman_model->follower($id_user)->num_rows();
			$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
	    $this->load->view('layout/user_header',$data);
	    $this->load->view('member/follower',$data);
	    $this->load->view('layout/user_footer');
		}else if(!$this->isLogin()){
			$data['profile']=$this->user_model->get_profile($username)->result_array();
	    $data['total_rows']=$this->user_model->get_profile_resep($username)->num_rows();
			$data['follow']=$this->teman_model->follower($id_user)->result_array();
			$data['total_rows_follow']=$this->teman_model->following($id_user)->num_rows();
			$data['total_rows_follower']=$this->teman_model->follower($id_user)->num_rows();
			$this->load->view('layout/guest_header');
			$this->load->view('member/follower',$data);
			$this->load->view('layout/user_footer');
		}
  }

	public function follow_action($id_user){
		if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			$data = new stdClass();
			$post = $this->input->post();
			$data->id_usera = $_SESSION['id_user'];
			$data->id_ikuti = $id_user;
			$input->status = "0";
			$this->teman_model->follow($data);
			$t['teman'] = $this->teman_model->teman()->result_array();
			$input->id_user = $t['teman'][0]['id_ikuti'];
			$input->id_teman = $t['teman'][0]['id_teman'];
			$this->user_model->insert_data_notifikasi($input);
			redirect('/user/profile/'.$post['username'].'/'.$id_user, 'location');
		}else if(!$this->isLogin()){
			redirect('/user/login');
		}

	}

	public function unfollow($id_user){
		if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			$post = $this->input->post();
			$this->teman_model->unfollow($id_user);
			redirect('/user/profile/'.$post['username'].'/'.$id_user, 'location');
		}else if(!$this->isLogin()){
			redirect('/user/login');
		}
	}

	public function resepfollowing($id_user, $offset=0){
		$hasil=$this->teman_model->resep_teman($id_user);
		$config['base_url'	]= base_url(). '/teman/resepfollowing/'.$id_user;
		$config['total_rows']=$hasil->num_rows();
		$config['per_page']=8;
		$config['uri_segment'] = 4;
		$config['full_tag_open']="<ul class='pagination float-right'>";
		$config['full_tag_close']="</ul>";
		$config['num_tag_open']="<li class='page-item'>";
		$config['num_tag_close']="</li>";
		$config['cur_tag_open']="<li class='disabled'><li class='page-item active'><a class='page-link' href='#'>";
		$config['cur_tag_close']="<span class='sr-only'></span></a></li></li>";
		$config['next_tag_open']="<li class='page-item'>";
		$config['next_tag_close']="</li>";
		$config['prev_tag_open']="<li class='page-item'>";
		$config['prev_tag_close']="</li>";
		$config['first_tag_open']="<li class='page-item'>";
		$config['first_tag_close']="</li>";
		$config['last_tag_open']="<li class='page-item'>";
		$config['last_tag_close']="</li>";
		$config['attributes'] =array('class' => 'page-link');

		$this->pagination->initialize($config);
		$data['halaman']=$this->pagination->create_links();
		$data['offset']=$offset;
		$data['resep']=$this->teman_model->resep_teman($id_user, $config['per_page'],$offset)->result_array();
    if(!$this->isAdmin() && $this->isLogin()){
			$id_user=$_SESSION['id_user'];
			$data['notif']=$this->notifikasi_model->get_notifikasi($id_user)->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($id_user)->num_rows();
	    $this->load->view('layout/user_header', $data);
	    $this->load->view('member/resepfollowing', $data);
	    $this->load->view('layout/user_footer');
  	}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else{
	    redirect('/user/login');
    }
	}
}
