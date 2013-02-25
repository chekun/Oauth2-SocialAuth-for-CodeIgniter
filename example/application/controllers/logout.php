<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
    {
      	parent::__construct();
    	! $this->session->userdata('is_login') AND redirect();
    }

	public function index()
	{
		$this->session->sess_destroy();
		$this->session->set_userdata('is_login', FALSE);
        redirect();
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */