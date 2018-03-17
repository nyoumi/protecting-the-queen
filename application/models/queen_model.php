<?php
    define("QUEEN", "queen");
    define("KEY_CONSTRAINT_ERROR",1452);
class Queen_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_queen()
        {   
            $query = $this->db->query("SELECT * FROM QUEEN;");
            
            if(sizeof($query->row_array())>0){
                return $query->row_array(0);
            }else {
                return null;
            }

            
        }

        public function create_queen($queen )
        {
            
            $data = array(
                'place_x' =>$queen->getPlace_x(),
                'place_y' => $queen->getPlace_y(),
                'facing'  =>$queen->getFacing(),
                'kingdom_id' =>$queen->getKingdom_id()
            );

            //here i will do a kind of try - catch to handle the error if there is one

            $sql = $this->db->set($data)->get_compiled_insert(QUEEN);

            if (!$this->db->simple_query( $sql))
            {
                $error = $this->db->error();
                //if ($error["code"]===KEY_CONSTRAINT_ERROR){
                $this->db->truncate(QUEEN);
                $this->db->query( $sql);
           // }
            }
           
        }
        public function update_queen_pos($queen )
        {
            $data = array(
                'kingdom_id'      =>$queen->getKingdom_id(),
                'place_x'         =>$queen->getPlace_x(),
                'place_y'         =>$queen->getPlace_y()
            );
        
            $this->db->update(QUEEN, $data);
        }

        public function update_queen_facing($queen )
        {
            $data = array(
                'kingdom_id'      =>$queen->getKingdom_id(),
                'facing'          =>$queen->getFacing()
            );
        
            $this->db->update(QUEEN, $data);
        }
        /**
         * change a queen array to queen object 
         * @return QUEEN $width_m width of the queen
         */
        public function mapper($queen )
        {
                $my_queen=new Queen($queen["place_x"],$queen["place_y"],$queen["facing"],$queen["kingdom_id"]);

                return $my_queen;
        }
        /**
         * change a queen object to queen array 
         */
        public function serialize($queen )
        {
            $my_queen=array();
            $my_queen["place_x"]=$queen->getPlace_x();
            $my_queen["place_y"]=$queen->getPlace_y();
            $my_queen["facing"]=$queen->getFacing();
                return $my_queen;
        }

}