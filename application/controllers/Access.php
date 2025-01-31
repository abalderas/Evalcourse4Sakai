<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {
    
	// Options required for the events-queries
	public function __construct()
	{
        parent::__construct();
        //loading  the mongodb library
        $this->load->library('mongo_db');
		 
		
    }
	
	public function index()
	{
		$this->load->view('login_view'); 
	}
	
	public function check()
	{	
		$user_id = $this->input->post('lg_username');
		$pass_form = $this->input->post('lg_password');
		$query = $this->mongo_db->where(array('eid' => "$user_id"))->get('users');
		if (count($query)>0)
		{
			$pass_bd = substr($query[0]['user_id'],0,4);
			if ($pass_bd == $pass_form)
			{
				$this->session->set_userdata('user_id', $user_id);
				redirect("/main/EventsTeacher");
			}
			else
			{
				$data['msg'] = "Incorrect password";
				$this->load->view('login_view', $data); // pass incorrecto
			}
		}
		else
		{
			$data['msg'] = "User not found";
			$this->load->view('login_view', $data); // user not found
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('user_id', '');
		redirect(base_url());
	}
}

?>