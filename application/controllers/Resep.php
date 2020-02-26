<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {

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
		$this->load->model('resep_model');
		$this->load->model('notifikasi_model');
		$this->load->model('user_model');
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

	public function listresep()
	{
		if($this->isAdmin() && $this->isLogin()){
			$data['getResep'] = $this->resep_model->getResep();
			$this->load->view('admin/listresep', $data);
		}else if(!$this->isAdmin() && $this->isLogin()){
			redirect('/resep/halamanutama');
		}else if(!$this->isLogin()){
			redirect('/user/login');
		}
	}

	public function delete_resep($id_resep)
	{
		$this->resep_model->delete($id_resep);
		if($this->isAdmin() && $this->isLogin()){
  		redirect('resep/listresep', 'location');
		}else if(!$this->isAdmin() && $this->isLogin()){
			redirect('resep/halamanutama', 'location');
		}else if(!$this->isLogin()){
			redirect('user/login');
		}
	}

	public function tambahresep(){
		if($this->isAdmin() && $this->isLogin()){
			redirect('user/admin');
		}else if(!$this->isAdmin() && $this->isLogin()){
			$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
			$this->load->view('layout/user_header',$data);
			$this->load->view('member/tambahresep');
			$this->load->view('layout/user_footer');
		}else if(!$this->isLogin()){
			redirect('user/login');

		}
	}

	public function insertResep(){
				$langkah=$_POST['langkah_memasak'];
				$langkah_="";
				for( $i =0;$i<count($langkah);$i++ ) {
				  if ($i != count($langkah)-1) {
				  	$langkah_.=$langkah[$i]."| ";
				  }else{
						$langkah_.=$langkah[$i];
					}
				}
				$bahan=$_POST['bahan_makanan'];
				$bahan_="";
				for( $i =0;$i<count($bahan);$i++ ) {
				  if ($i != count($bahan)-1) {
				  	$bahan_.=$bahan[$i].", ";
				  }else{
						$bahan_.=$bahan[$i];
					}
				}
				$ext = pathinfo($_FILES["resep_foto"]["name"], PATHINFO_EXTENSION);
				$date = date("dmYhis");
				$resep_foto = "img_$date.$ext";
				$config['upload_path'] = './application/assets/img/resep';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']     = '3500';
				$config['file_name'] = $resep_foto;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$upload = $this->upload->do_upload('resep_foto');

				$post = $this->input->post();
				$input->id_user = $_SESSION['id_user'];
				$input->nama_resep = $post['nama_resep'];
				$input->durasi = $post['durasi'];
				$input->porsi = $post['porsi'];
				$input->bahan_makanan = $bahan_;
				$input->langkah_memasak =  $langkah_;
				$input->resep_foto = $resep_foto;
				$query = $this->resep_model->insert_resep_masakan($input);

				redirect('resep/halamanutama');
	}

  public function halamanutama($offset=0)
  {
		$hasil=$this->resep_model->get_all_resep();
		$config['base_url'	]= base_url(). '/resep/halamanutama';
		$config['total_rows']=$hasil->num_rows();
		$config['per_page']=8;

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
		$data['resep']=$this->resep_model->get_all_resep($config['per_page'],$offset)->result_array();
    if(!$this->isAdmin() && $this->isLogin()){
			$id_user=$_SESSION['id_user'];
			$data['notif']=$this->notifikasi_model->get_notifikasi($id_user)->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($id_user)->num_rows();
	    $this->load->view('layout/user_header', $data);
	    $this->load->view('member/halamanutama', $data);
	    $this->load->view('layout/user_footer');
  	}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else if(!$this->isLogin()){
	    $this->load->view('layout/guest_header');
	    $this->load->view('member/halamanutama', $data);
	    $this->load->view('layout/user_footer');
    }
  }

	public function search_byname(){
		$post = $this->input->post();
		$data['user'] = $this->resep_model->getsearch_byname($post['cari'])->result_array();
		if(!$this->isAdmin() && $this->isLogin()){
		$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
		$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
		$this->load->view('layout/user_header',$data);
		$this->load->view('member/search_nama', $data);
		$this->load->view('layout/user_footer');
		}else if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isLogin()){
			$this->load->view('layout/guest_header');
			$this->load->view('member/search_nama', $data);
			$this->load->view('layout/user_footer');
		}
	}

	public function halaman_resep($id_resep){

		$data['resep'] = $this->resep_model->get_resep_utama($id_resep)->result_array();
		$data['komentar'] = $this->resep_model->get_resep_komentar($id_resep)->result_array();
		$data['resep'][0]['bahan_makanan'] = $this->tampil_resep($data['resep'][0]['bahan_makanan']);
		$data['resep'][0]['langkah_memasak'] = $this->tampil_resep_langkah($data['resep'][0]['langkah_memasak']);

		$data['isHasRated']=false;
		$avgRate=0;
		foreach ($data['komentar'] as $value) {
			$avgRate+=$value['rating'];
			if(isset($_SESSION['id_user'])){
				if ($_SESSION['id_user']==$value['id_user']) {
					$data['isHasRated']=true;
				}
			}
		}


			if (count($data['komentar'])==0) {
				$data['avgRate']=0;
			}else {
				$avgRate=$avgRate/count($data['komentar']);
				$data['avgRate']=$avgRate;
			}
		if(!$this->isAdmin() && $this->isLogin()){
			$id_user=$_SESSION['id_user'];
			$data['notif']=$this->notifikasi_model->get_notifikasi($id_user)->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($id_user)->num_rows();
			$this->load->view('layout/user_header', $data);
			$this->load->view('member/halamanresep', $data);
			$this->load->view('layout/user_footer');
		}else if($this->isAdmin() && $this->isLogin()){
			redirect('/user/admin');
		}else if(!$this->isLogin()){
			$this->load->view('layout/guest_header');
			$this->load->view('member/halamanresep', $data);
			$this->load->view('layout/user_footer');
		}
	}

	public function getPopuler($offset=0){
		$hasil=$this->resep_model->get_populer();
		$config['base_url'	]= base_url(). '/resep/getPopuler';
		$config['total_rows']=$hasil->num_rows();
		$config['per_page']=8;

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
		$data['resep']=$this->resep_model->get_populer($config['per_page'],$offset)->result_array();
    if(!$this->isAdmin() && $this->isLogin()){
			$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
	    $this->load->view('layout/user_header', $data);
	    $this->load->view('member/halamanpopuler', $data);
	    $this->load->view('layout/user_footer');
  	}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else if(!$this->isLogin()){
	    $this->load->view('layout/guest_header');
	    $this->load->view('member/halamanpopuler', $data);
	    $this->load->view('layout/user_footer');
    }
	}

	public function editresep($id_resep){
		$data['resep'] = $this->resep_model->get_resep_utama($id_resep)->result_array();
		if(!$this->isAdmin() && $this->isLogin()){
		$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
		$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
		$this->load->view('layout/user_header',$data);
		$this->load->view('member/editresep', $data);
		$this->load->view('layout/user_footer');
		}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else if(!$this->isLogin()){
      redirect('/user/login');
    }
	}

	public function updateresep($id_resep){
		$langkah=$_POST['langkah_memasak'];
		$langkah_="";
		for( $i =0;$i<count($langkah);$i++ ) {
			if ($i != count($langkah)-1) {
				$langkah_.=$langkah[$i]."| ";
			}else{
				$langkah_.=$langkah[$i];
			}
		}
		$bahan=$_POST['bahan_makanan'];
		$bahan_="";
		for( $i =0;$i<count($bahan);$i++ ) {
			if ($i != count($bahan)-1) {
				$bahan_.=$bahan[$i].", ";
			}else{
				$bahan_.=$bahan[$i];
			}
		}

		if ($_FILES["resep_foto"]["size"] !==0 ) {
			$ext = pathinfo($_FILES["resep_foto"]["name"], PATHINFO_EXTENSION);
			$date = date("dmYhis");
			$resep_foto = "img_$date.$ext";
			$config['upload_path'] = './application/assets/img/resep';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']     = '3500';
			$config['file_name'] = $resep_foto;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$upload = $this->upload->do_upload('resep_foto');
			$input->resep_foto = $resep_foto;
		}

			$post = $this->input->post();
			$input->id_user = $_SESSION['id_user'];
			$input->nama_resep = $post['nama_resep'];
			$input->durasi = $post['durasi'];
			$input->porsi = $post['porsi'];
			$input->bahan_makanan = $bahan_;
			$input->langkah_memasak = $langkah_;
			$query = $this->resep_model->update_resep($input,$id_resep);
			redirect('resep/halaman_resep/'.$id_resep);
	}

	function updateresep_admin($id_resep){
		if ($_FILES["resep_foto"]["size"] !==0 ) {
			$ext = pathinfo($_FILES["resep_foto"]["name"], PATHINFO_EXTENSION);
			$date = date("dmYhis");
			$resep_foto = "img_$date.$ext";
			$config['upload_path'] = './application/assets/img/resep';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']     = '3500';
			$config['file_name'] = $resep_foto;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$upload = $this->upload->do_upload('resep_foto');
			$input->resep_foto = $resep_foto;
		}
			$post = $this->input->post();
			$input->nama_resep = $post['nama_resep'];
			$input->durasi = $post['durasi'];
			$input->porsi = $post['porsi'];
			$input->bahan_makanan = $post['bahan_makanan'];
			$input->langkah_memasak =  $post['langkah_memasak'];
			$query = $this->resep_model->update_resep($input,$id_resep);
			redirect('resep/listresep');
	}


	function preprocessing($string){
		if ($string == '') {
			return [];
		}
		$string = preg_replace("/[^a-zA-Z\s]/", "", $string);


		//case folding
		$string = mb_convert_case($string, MB_CASE_LOWER, "UTF-8");


		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$stemmer  = $stemmerFactory->createStemmer();
		// stem
		$string   = $stemmer->stem($string);

		//tokenisasi
		$token = explode(" ",$string);

		//stopword removal
		$array = file('vendor\\ID-Stopwords-master\\id.stopwords.02.01.2016.txt', FILE_IGNORE_NEW_LINES);
		$str = implode(" ", $array);
		$stopwords = explode (" ",$str);

		$hasil = array_values(array_diff($token, $stopwords));

		return $hasil;
	}

	public function get_tf($arr_resep){
		if (count($arr_resep) < 1) {
			return [];
		}
		//preprocessing
		$token_dokumen = array();
		foreach ($arr_resep as $d) {
			$temp="";
			foreach ($this->preprocessing($d) as $k) {
				$temp.=$k." ";
			}
			$str=array_count_values(str_word_count($temp, 1));
			array_push($token_dokumen,$str);
		}
		return $token_dokumen;
	}

	public function get_logtf($term_unik,$token_dokumen){
		//vsm -> log tf
		$vsm = array();
		foreach ($term_unik as $key) {
			$temp = array();
			foreach ($token_dokumen as $d) {
				if (array_key_exists($key, $d)) {
					array_push($temp,1+log10($d[$key]));
				}else{
					array_push($temp,0);
				}
			}
			$vsm[$key] = $temp;
		}
		return $vsm;
	}

	public function get_idf($vsm,$token_dokumen){
		// idf
		$idf=array();
		foreach ($vsm as $key => $val) {
			$df=0;
			foreach ($val as $value) {
				if ($value != 0) {
					$df++;
				}
			}
		if ($df==0) {
			$idf[$key]=0;
		}else{
			$idf[$key]=log10(count($token_dokumen)/$df);
		}
		}
		return $idf;
	}

	public function get_tfidf($vsm,$idf){
		//tf idf
		$tf_idf=array();
		foreach ($idf as $key => $value) {
			$temp=array();
			foreach ($vsm[$key] as $tf) {
				array_push($temp, $value*$tf);
			}
			$tf_idf[$key]=$temp;
		}
		return $tf_idf;
	}

	public function get_norm_tfidf($token_dokumen,$tf_idf){
		//normalisasi
		$sqrt=array();
		for ($i=0; $i <count($token_dokumen) ; $i++) {
			$temp=0;
			foreach ($tf_idf as $value) {
				$temp+=$value[$i]*$value[$i];
			}
			foreach ($tf_idf as $val) {

			}
			array_push($sqrt, sqrt($temp));
		}
		$norm_tfidf=array();
		foreach ($tf_idf as $key => $value) {
			$temp=array();
			$i=0;
			foreach ($value as $n	) {
				if ($sqrt[$i]==0) {
					array_push($temp,0);
				}else{
					array_push($temp,$n/$sqrt[$i]);
				}
				$i++;
			}
			$norm_tfidf[$key]=$temp;
		}

		return $norm_tfidf;

	}

	public function norm_tfidf_database(){
		///DATABASE TFIDF
		/////////////////////////////////////////////////////////////////////////////
		$hasil=$this->resep_model->get_all_resep()->result_array();
		$arr_resep = array();
		$t = "";
		foreach ($hasil as $a) {
			array_push($arr_resep,$a['bahan_makanan']);
			$t.=$a['bahan_makanan']." ";
		}
		//get_tf
		$token_dokumen_=$this->get_tf($arr_resep);

		//term unik
		$term_unik = array_values(array_unique($this->preprocessing($t)));

		//log tf
		$vsm = $this->get_logtf($term_unik,$token_dokumen_);


		//idf
		$idf = [];
		$idf=$this->get_idf($vsm,$token_dokumen_);

		//tf idf
		$tf_idf=$this->get_tfidf($vsm,$idf);

		//norm tf idf
		$norm_tfidf = $this->get_norm_tfidf($token_dokumen_,$tf_idf);


		$value = new \stdClass();
		$value->idf = $idf;
		$value->norm_tfidf = $norm_tfidf;
		$value->token_dokumen_ = $token_dokumen_;

		return $value;

		//////////////////////////////////////////////////////////////////////////////
	}

	public function norm_tfidf_query($idf){
		//QUERY
		/////////////////////////////////////////////////////////////////////////////
		$query = array($_GET['cariBahan']);
		//get_tf
		$token_dokumen=$this->get_tf($query);


		//term unik
		$term_unik = array_values(array_unique($this->preprocessing($query[0])));

		//log tf
		$vsm = $this->get_logtf($term_unik,$token_dokumen);


		$idf_query=array();
		foreach ($term_unik as $key) {
			if (array_key_exists($key, $idf)) {
				$idf_query[$key] = $idf[$key];
			}
		}

		//tf idf
		$tf_idf=$this->get_tfidf($vsm,$idf_query);

		//norm tf idf
		$norm_tfidf_query = $this->get_norm_tfidf($token_dokumen,$tf_idf);

		return $norm_tfidf_query;
		///////////////////////////////////////////////////////////////////////////
	}

	public function cossim(){
		$hasil=$this->resep_model->get_all_resep()->result_array();
		$value = $this->norm_tfidf_database();
		$idf = $value ->idf;
		$norm_tfidf = $value->norm_tfidf;
		$token_dokumen_ = $value->token_dokumen_;

		$norm_tfidf_query = $this->norm_tfidf_query($idf);

		$cos_sim=array();
		for ($i=0; $i <count($token_dokumen_) ; $i++) {
			$temp=0;
			foreach ($norm_tfidf_query as $key => $value) {
				$temp+=$norm_tfidf[$key][$i]*$norm_tfidf_query[$key][0];
			}
			array_push($cos_sim,$temp);
		}

		$old_cos_sim=$cos_sim;
		rsort($cos_sim);

		$index_sort=array();
		for($i=0; $i<count($old_cos_sim); $i++){
			$indexes=array_keys($old_cos_sim, $cos_sim[$i]);
			$index_sort=array_merge($index_sort, $indexes);
			$index_sort=array_unique($index_sort);
			$index_sort=array_values($index_sort);
		}
		$hasil_akhir=array();
		for ($i=0; $i <count($hasil) ; $i++) {
			 array_push($hasil_akhir,$hasil[$index_sort[$i]]);
		}
		return $hasil_akhir;
	}

	public function search(){
		$data['hasil']=$this->cossim();
		if(!$this->isAdmin() && $this->isLogin()){
			$data['notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->result_array();
			$data['total_notif']=$this->notifikasi_model->get_notifikasi($_SESSION['id_user'])->num_rows();
	    $this->load->view('layout/user_header',$data);
	    $this->load->view('member/search_bahan', $data);
	    $this->load->view('layout/user_footer');
  	}else if($this->isAdmin() && $this->isLogin()){
      redirect('/user/admin');
    }else{
	    $this->load->view('layout/guest_header');
	    $this->load->view('member/search_bahan', $data);
	    $this->load->view('layout/user_footer');
    }
	}

	public function tampil_resep($resep){
		$hasil="";
		$str_arr = preg_split ('/\,/', $resep);
		foreach ($str_arr as $key => $value) {
			$hasil .= ($key+1).". ".$value."<br>";
		}
		return $hasil;
	}

		public function tampil_resep_langkah($resep){
			$hasil="";
			$str_arr = preg_split ('/\|/', $resep);
			foreach ($str_arr as $key => $value) {
				$hasil .= ($key+1).". ".$value."<br>";
			}
			return $hasil;
		}





}
