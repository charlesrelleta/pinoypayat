<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
					parent::__construct();
	        $this->load->model("cms_model");
	        $this->load->model("accounts_model");
	}
	public function index()
	{
		$this->load->view('administrator/login_view');
	}

	public function login(){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|callback_password_check');
			if ($this->form_validation->run()){
				$this->accounts_management();
			}else{
					$this->load->view('administrator/login_view');
			}
	}

	public function password_check()
	{
		$user = $this->input->post('username');
    $pass=  $this->input->post('password');
    $result = $this->accounts_model->login($user, $pass);
    if($result){
      return TRUE;
    }else{
      $this->form_validation->set_message('password_check', 'Invalid email or password');
      return FALSE;
    }
	}

	public function profile(){
		$this->load->view('administrator/profile');
	}

	public function dashboard(){
		$this->load->view('administrator/dashboard_view');
	}

	public function accounts_management()
		{
			if ($query = $this->accounts_model->get_users()) {
				$data['content'] = $query;
			}else {
				$data['content'] = false;
			}
			$this->load->view('administrator/accounts_view',$data);
		}

	public function cms_home()
	{
		if ($query = $this->cms_model->get_home()) {
			$data['content'] = $query;
		}$this->load->view('administrator/cms_home_view', $data);
	}
	public function cms_about()
	{
	  if ($query = $this->cms_model->get_about()) {
        $data['content'] = $query;
      }$this->load->view('administrator/cms_about_view', $data);
	}
	public function cms_contacts()
	{
		if ($query = $this->cms_model->get_contacts()) {
			$data['content'] = $query;
		}
		$this->load->view('administrator/cms_contacts_view',$data);
	}
	public function cms_posts()
	{
		if ($query = $this->cms_model->get_posts()) {
			$data['content'] = $query;
		}else {
			$data['content'] = false;
		}
		$this->load->view('administrator/cms_posts_view',$data);
	}

	public function bmi_results(){
			if ($query = $this->cms_model->get_bmiResults()) {
				$data['content'] = $query;
			}else {
				$data['content'] = false;
			}
			$this->load->view('administrator/cms_bmi_results',$data);
	}

  public function goto_updatePost(){
      $id = $this->uri->segment(3);
			if ($query = $this->cms_model->post_get_by_id($id)) {
				$data['content'] = $query;
			}
    	$this->load->view('administrator/cms_posts_update',$data);
	}


	  public function goto_updateBmiResult(){
	      $id = $this->uri->segment(3);
				if ($query = $this->cms_model->bmi_result($id)) {
					$data['content'] = $query;
				}
	    	$this->load->view('administrator/cms_bmi_update',$data);
		}

	public function goto_addPost(){
			$this->load->view('administrator/cms_posts_add');
	}

	public function goto_addBmiResult(){
			$this->load->view('administrator/cms_bmi_add');
	}
	public function add_post(){
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'content' =>  $this->input->post('content')
	);
	$this->cms_model->add_post($data);
	redirect("Admin/cms_posts");
	}

	public function add_bmiResult(){
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'tips' =>  $this->input->post('tips'),
		'indicator' =>  $this->input->post('indicator')
	);
	$this->cms_model->add_bmiResult($data);
	redirect("Admin/bmi_results");
	}

	public function update_about(){
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'content' =>  $this->input->post('content')
	);
	$this->cms_model->update_about($data);
	redirect("Admin/cms_about");
	}


	public function update_home(){
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'post_title' =>  $this->input->post('post_title'),
		'post_description' => $this->input->post('post_description')
	);
	$this->cms_model->update_home($data);
	redirect("Admin/cms_home");
	}


	public function update_contacts(){
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'tel_title' =>  $this->input->post('tel_title'),
		'telephone' =>  $this->input->post('telephone'),
		'cel_title' =>  $this->input->post('cel_title'),
		'cellphone' =>  $this->input->post('cellphone'),
		'email_title' =>  $this->input->post('email_title'),
		'email' =>  $this->input->post('email'),
	);
	$this->cms_model->update_contacts($data);
	redirect("Admin/cms_contacts");
	}

	public function update_post(){

		date_default_timezone_set("Asia/Hong_Kong");
	  $date_info = date('Y-m-d H:i:s');
		$data = array(
		'title' => $this->input->post('title'),
		'description' => $this->input->post('description'),
		'content' =>  $this->input->post('content'),
		'date_updated' => $date_info
	);
	$id = $this->input->post('id');
	$this->cms_model->update_post($data,$id);
	redirect("Admin/cms_posts");
	}

	public function update_bmiResult(){

		$this->form_validation->set_rules('title', 'Title', 'max_length[100]|required');
		$this->form_validation->set_rules('description', 'Description', 'max_length[2000]|required');
		$this->form_validation->set_rules('tips', 'tips', 'max_length[5000]|required');
		$this->form_validation->set_rules('date_updated', 'date_updated', 'required');

	if ($this->form_validation->run()){

				date_default_timezone_set("Asia/Hong_Kong");
			  $date_info = date('Y-m-d H:i:s');
				$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'tips' =>  $this->input->post('tips'),
				'date_updated' => $date_info);

					$id = $this->input->post('id');
					$this->cms_model->update_bmiResult($data,$id);
					redirect("Admin/bmi_results");
	}else{
			$this->bmi_results();
		}
	}
	public function verify_registration(){
			$this->form_validation->set_rules('username', 'Username', 'min_length[6]|max_length[50]|trim|required');
			$this->form_validation->set_rules("password", "Password", 'min_length[6]|max_length[50]|trim|xss_clean|required|matches[confirmpassword]');
			$this->form_validation->set_rules("confirmpassword", "Confirm Password", 'min_length[6]|trim|xss_clean|required');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('middlename', 'Middle Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('license', 'License Number', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('birthdate', 'Birth Date', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required');
			$this->form_validation->set_rules('profession', 'Profession', 'required');

		if ($this->form_validation->run()){
			$this->home();
		}else{
				$this->load->view('client/registration_View');
			}
		}

		public function account_activation(){
			$id =  $this->uri->segment(3);
			$data = array("status" => 1);
			$result = $this->accounts_model->update_record($id, $data);
			$this->accounts_management();
		}

		public function account_deactivation(){
			$id =  $this->uri->segment(3);
			$data = array("status" => 2);
			$result = $this->accounts_model->update_record($id, $data);
			$this->accounts_management();
		}

}
