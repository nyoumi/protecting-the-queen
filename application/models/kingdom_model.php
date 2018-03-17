<?php
define("KINGDOM", "kingdom");
include_once APPPATH . 'classes/Kingdom.php';

class Kingdom_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        /**
         * query kingdom in database 
         * @param $id id of the kingdom
         * @return $query an array of the result
         */
        public function get_kingdom()
        {   
                $query = $this->db->query("SELECT * FROM KINGDOM;");

                if(sizeof($query->row_array())>0){
                        return $query->row_array(0);
                    }else {
                        return null;
                    }
        }

        /**
         * insert a kingdom in database 
         * @param $length_n length of the kingdom
         * @param $width_m width of the kingdom
         */
        public function create_kingdom($kingdom )
        {        
                $data = array(
                        'length_n' =>$kingdom->getLength_n(),
                        'width_m' => $kingdom->getWidth_m()
                );

                $query = $this->db->query("SELECT * FROM KINGDOM;");

                if(sizeof($query->row_array())>0){
                       
                             $this->db->update(KINGDOM, $data);
                    }else {
                        $this->db->insert(KINGDOM, $data);
                    }
            
        }
        /**
         * change a kingdom array to kingdom object 
         * @param $length_n length of the kingdom
         * @return KINGDOM $width_m width of the kingdom
         */
        public function mapper($kingdom )
        {
                $kingdomObject=new Kingdom($kingdom["length_n"],$kingdom["width_m"]);

                return $kingdomObject;
        }
        /**
         * change a queen object to queen array 
         */
        public function serialize($kingdom )
        {
            $my_kingdom=array();
            $my_kingdom["Length_n"]=$kingdom->getLength_n();
            $my_kingdom["Width_m"]=$kingdom->getWidth_m();
                return $my_kingdom;
        }
}