<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('user_model');
		$this->load->model('teman_model');
		$this->load->model('notifikasi_model');
		$this->load->helper(array('form', 'url'));

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

	public function login()
	{
		if($this->isLogin()){
			redirect('/resep/halamanutama');
		}
		if(isset($_POST['submit'])){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($username == "admin" && $password == "admin"){
	      $_SESSION['username'] = $username;
				redirect('/user/admin');
			}
			if($this->user_model->login($username, $password))
			{
				redirect('/resep/halamanutama');
			}else{
				$this->session->set_flashdata('message', 'Username atau password anda salah!');
				$this->load->view('layout/guest_header');
				$this->load->view('layout/login');
		    $this->load->view('layout/user_footer');
			}
		}else{
			$this->load->view('layout/guest_header');
			$this->load->view('layout/login');
	    $this->load->view('layout/user_footer');
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
  	redirect('/user/login', 'location');
	}

	public function registrasi()
	{
		if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			redirect('/resep/halamanutama');
		}else if(!$this->isLogin()){
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'is_unique[user.username]|alpha_dash',
        array(
                'is_unique' => '%s sudah digunakan',
								'alpha_dash' => '%s tidak boleh ada spasi'
        )
			);
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
				array(
								'valid_email' => '%s tidak valid'
				)
			);

			if ($this->form_validation->run() == FALSE){
				$this->load->view('layout/guest_header');
				$this->load->view('layout/registrasi');
				$this->load->view('layout/user_footer');
	    }else{
				$ext = pathinfo($_FILES["user_foto"]["name"], PATHINFO_EXTENSION);
				$date = date("dmYhis");
				$user_foto = "img_$date.$ext";
				$config['upload_path'] = './application/assets/img/user';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']     = '1024';
				$config['file_name'] = $user_foto;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$upload = $this->upload->do_upload('user_foto');

				$post = $this->input->post();
        $input->nama = $post['nama'];
        $input->jenis_kelamin = $post['jenis_kelamin'];
        $input->username =  $post['username'];
        $input->password = $post['password'];
        $input->email = $post['email'];
        $input->nomor_telepon = $post['nomor_telepon'];
        $input->user_foto = $user_foto;
				$query = $this->user_model->insert_data_member($input);
				redirect('/user/login');
	    }
		}
	}

	public function admin()
	{
		if($this->isAdmin() && $this->isLogin()){
			$data['getUser'] = $this->user_model->getUser();
			$this->load->view('admin/admin', $data);
		}else if(!$this->isAdmin() && $this->isLogin()){
			redirect('/resep/halamanutama');
		}else if(!$this->isLogin()){
			redirect('/user/login');
		}
	}

	public function profile($username, $id_user, $offset=0)
	{
		$hasil=$this->user_model->get_profile_resep($username);
		$data['total_rows']=$hasil->num_rows();
		$config['base_url']= base_url().'/user/profile/'.$username.'/'.$id_user;
		$config['total_rows']=$hasil->num_rows();
		$config['per_page']=4;
		$config['uri_segment'] = 5;
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
		$data['user']=$this->user_model->get_profile_resep($username, $config['per_page'],$offset)->result_array();
		$data['profile']=$this->user_model->get_profile($username)->result_array();
		$data['total_rows_follow']=$this->teman_model->following($id_user)->num_rows();
		$data['total_rows_follower']=$this->teman_model->follower($id_user)->num_rows();
		if(!$this->isAdmin() && $this->isLogin()){
		$data['ikuti']=$this->teman_model->isfollowing($id_user);
		$data['notif']=$this->notifikasi_model->get_notifikasi($id_user)->result_array();
		$data['total_notif']=$this->notifikasi_model->get_notifikasi($id_user)->num_rows();
    $this->load->view('layout/user_header', $data);
    $this->load->view('member/halamanprofile', $data);
    $this->load->view('layout/user_footer');
  	}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else if(!$this->isLogin()){
			$this->load->view('layout/guest_header');
	    $this->load->view('member/halamanprofile', $data);
	    $this->load->view('layout/user_footer');
    }
	}


	public function delete_user($id_user)
	{
		if($this->isAdmin() && $this->isLogin()){
			$this->user_model->delete($id_user);
	  	redirect('/user/admin', 'location');
		}else if(!$this->isAdmin() && $this->isLogin()){
			redirect('/resep/halamanutama');
			}else {
			redirect('/user/login');
		}
	}

	public function editprofile(){
		$data['user'] = $this->user_model->get_edit($_SESSION['id_user'])->result_array();
		if(!$this->isAdmin() && $this->isLogin()){
		$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
		$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
		$this->load->view('layout/user_header',$data);
		$this->load->view('member/editprofile', $data);
		$this->load->view('layout/user_footer');
		}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else if(!$this->isLogin()){
      redirect('/user/login');
    }
	}

	public function updateProfile(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'is_unique[user.username]',
			array(
							'is_unique' => '%s sudah digunakan'
			)
		);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
			array(
							'valid_email' => '%s tidak valid'
			)
		);

		if ($this->form_validation->run() == FALSE){
				$data['user'] = $this->user_model->get_edit($_SESSION['id_user'])->result_array();
				$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
				$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
				$this->load->view('layout/user_header',$data);
				$this->load->view('member/editprofile', $data);
				$this->load->view('layout/user_footer');
		}else{
				if ($_FILES["user_foto"]["size"] !==0 ) {
					$ext = pathinfo($_FILES["user_foto"]["name"], PATHINFO_EXTENSION);
					$date = date("dmYhis");
					$user_foto = "img_$date.$ext";
					$config['upload_path'] = './application/assets/img/user';
					$config['allowed_types'] = 'jpg|png|jpeg|JPG';
					$config['max_size']     = '3500';
					$config['file_name'] = $user_foto;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$upload = $this->upload->do_upload('user_foto');
					$input->user_foto = $user_foto;
				}
					$post = $this->input->post();
					$input->nama = $post['nama'];
					$input->jenis_kelamin = $post['jenis_kelamin'];
					$input->password = $post['password'];
					$input->email = $post['email'];
					$input->nomor_telepon = $post['nomor_telepon'];

					$query = $this->user_model->update_profile($input);
					redirect('user/profile/'.$_SESSION['username'].'/'.$_SESSION['id_user'], 'location');
	}
}
public function updateProfile_admin($id_user){

			if ($_FILES["user_foto"]["size"] !==0 ) {
				$ext = pathinfo($_FILES["user_foto"]["name"], PATHINFO_EXTENSION);
				$date = date("dmYhis");
				$user_foto = "img_$date.$ext";
				$config['upload_path'] = './application/assets/img/user';
				$config['allowed_types'] = 'jpg|png|jpeg|JPG';
				$config['max_size']     = '3500';
				$config['file_name'] = $user_foto;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$upload = $this->upload->do_upload('user_foto');
				$input->user_foto = $user_foto;
			}
			  $post = $this->input->post();
				$input->nama = $post['nama'];
				$input->jenis_kelamin = $post['jenis_kelamin'];
				$input->password = $post['password'];
				$input->email = $post['email'];
				$input->nomor_telepon = $post['nomor_telepon'];

				$query = $this->user_model->update_profileadmin($input, $id_user);
				redirect('user/admin');

}
			public function updatenotif($id_notifikasi){
				if(!$this->isAdmin() && $this->isLogin()){
					$data['update'] = $this->notifikasi_model->update_status($id_notifikasi);
					$data['update_stat'] = $this->notifikasi_model->get_notifikasi_status($id_notifikasi)->result_array();
					if($data['update_stat'][0]['id_teman']==null){
						$data['komentar'] = $this->notifikasi_model->get_komentar($data['update_stat'][0]['id_komentar'])->result_array();
						redirect('resep/halaman_resep/'.$data['komentar'][0]['id_resep']);
					}else if($data['update_stat'][0]['id_komentar']==null){
						$data['teman'] = $this->notifikasi_model->get_teman($data['update_stat'][0]['id_teman'])->result_array();
						redirect('user/profile/'.$data['teman'][0]['username'].'/'.$data['teman'][0]['id_usera']);
					}
		  	}else if($this->isAdmin() && $this->isLogin()){
		      redirect('/user/admin');
		    }else if(!$this->isLogin()){
					redirect('/user/login');
		    }


			}

}
