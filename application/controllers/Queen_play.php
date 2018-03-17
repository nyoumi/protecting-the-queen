<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'classes/Queen.php';

class Queen_play extends CI_Controller {

    public function __construct()
    {
            //to enable compatibility with parent controller
                parent::__construct();
                $this->load->model('queen_model');
                $this->load->model('kingdom_model');
    }

	/**
     * index method
     */
	public function index()
	{
        echo "welcome";
		//$this->load->view('hello world');
    }
    /**
     * queen 
     */
	public function place($place_x,$place_y,$facing)
	{
        $facing = strtoupper($facing);
        $data['kingdom'] = $this->kingdom_model->get_kingdom();
        if($data['kingdom']==null) {
            //error_no_kingdom_yet : 400
            $this->respond_errors("error no kingdom yet",400);
            return;
        }        
        
         
        $my_kingdom=$this->kingdom_model->mapper($data['kingdom']);

        $queen= new Queen($place_x,$place_y,$facing,$data['kingdom']["id"]);

        $errors=$queen->validate($my_kingdom);
        if(sizeof($errors==0)){
          $this->queen_model->create_queen($queen);
          $this->respond($queen,200);
        }else {
             //kingdom_constraint_validation_error:300
             $this->respond_errors($errors,300);

        }
       
		//$this->load->view('hello world');
    }
    /**
     * 1. get datas on db if exist
     * 2. map data to object
     * 3. move
     * 4. validate the move
     * 5. update data if validation ok or send error code if not
     */
    public function move()
	{
        
        $data['kingdom'] = $this->kingdom_model->get_kingdom();
        if($data['kingdom']==null) {
            //error_no_kingdom_yet : 4
            $this->respond_errors("error no kingdom yet",400);
            return;
        }
        $kingdom=$this->kingdom_model->mapper($data['kingdom']);
        
        
        $data["queen"]= $this->queen_model->get_queen();
        if($data['queen']==null) {
            //error_no_queen_yet : 405
            $this->respond_errors("error no queen yet",405);
            return;
        }
        $queen=$this->queen_model->mapper($data['queen']);

        $queen->move();
        //if there are no validation errors
        $errors=$queen->validate($kingdom);
        if (sizeof($errors)>0){
            //kingdom_constraint_validation_error:3
            $this->respond_errors($errors,300);

        }else{
            $data['queen'] = $this->queen_model->update_queen_pos($queen);
            $this->respond($queen,200);
        }

    }

    /**
     * change the facing of the queen
     *
     * knowing that facing is actually a number we can increment it or decrement it
     * 
     * @param	string $direction    LEFT or RIGHT
     * output a json of the queen place
     */
    public function rotation($direction)
	{
        
        $direction = strtoupper($direction);

        $data["queen"]= $this->queen_model->get_queen();
        if($data['queen']==null) {
            //error_no_queen_yet : 405
            $this->respond_errors("error no queen yet",405);
            return;
        }
        $queen=$this->queen_model->mapper($data['queen']);

        $errors=$queen->rotate($direction);

        if (sizeof($errors)>0){
          //error_bad_direction_value :1
          $this->respond_errors($errors,100);

        }else{
            $this->queen_model->update_queen_facing($queen);
            $this->respond($queen,200);
            
        }

    }
      /**
     * give the position of the queen
     */
    public function report()
	{
        
        
        $data["queen"]= $this->queen_model->get_queen();
        if($data['queen']==null) {
            //error_no_queen_yet : 405
            $this->respond_errors("error no queen yet",405);
            return;
        }
        $queen=$this->queen_model->mapper($data['queen']);

        $this->respond($queen,200);
        

    }
    /**
     * show json responses
     */
    public function respond($queen,$status){
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($this->queen_model->serialize($queen), JSON_PRETTY_PRINT  | JSON_UNESCAPED_SLASHES));

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
