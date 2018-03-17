<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'classes/Kingdom.php';



class Kingdom_play extends CI_Controller {

    public function __construct()
    {
            //to enable compatibility with parent controller
                parent::__construct();
                $this->load->model('kingdom_model');
    }

	/**
     * index method
     */
	public function index()
	{
        echo "welcome!";
		//$this->load->view('hello world');
    }
    /**
     * queen 
     */
	public function create($length_n,$width_m)
	{
        $kingdom= new Kingdom($length_n,$width_m);
        if($kingdom->validate()){
            $data['kingdom'] = $this->kingdom_model->create_kingdom($kingdom);
            $this->respond($kingdom,200);
        }else {
            $errors=array();
            $errors["limits"]="this value don't respect the limits of the kingdom";
            //kingdom_constraint_validation_error:3
            $this->respond_errors($errors,300);
        }
        
        
        
		//$this->load->view('hello world');
    }

    /**
     * show json responses
     */
    public function respond($kingdom,$status){
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($this->kingdom_model->serialize($kingdom), JSON_PRETTY_PRINT  | JSON_UNESCAPED_SLASHES));

    }
    /**
     * show json errors
     */
    public function respond_errors($message,$status){
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($message, JSON_PRETTY_PRINT  | JSON_UNESCAPED_SLASHES));

    }
}
