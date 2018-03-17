<?php

Const  FACINGS=array("NORTH","WEST", "SOUTH", "EAST");

class Queen {

    /**
    * the x location of this queen
    *
    * @var	int
    */

    private $place_x;
    /**
    * the x location of this queen
    *
    * @var	int
    */

    private $place_y;

    /**
    * the facing of the queen
    *
    * @var	string
    */
    private $facing;

    /**
    * the kingdom of the queen
    *
    * @var	int
    */
    private $kingdom_id;


    /**
         *add parameters to the object respecting constraints
        * first we check if the parameters are valid before creating the object 
        *
        *
        * @param	int	$place_x		place_x
        * @param	int	$place_y		place_y
        * @param	string	$facing		facing
        * @param	int	$kingdom_id		kingdom_id
        * @param	bool	$empty	Whether to replace the old header value, if already set
        * @return	bool true if success false if not
        */
    public function __construct($place_x,$place_y,$facing,$kingdom_id)
    {

        
            $this->place_x = $place_x;
            $this->place_y = $place_y;   
            $this->kingdom_id = $kingdom_id;
            $this->facing=$facing;
    }

    /**
     *getters and setters
     */

    public function getPlace_x() {
        return $this->place_x;
    }

    public function getPlace_y() {
        return $this->place_y;
    }

    public function getFacing() {
        return $this->facing;
    }

    public function getKingdom_id() {
        return $this->kingdom_id;
    }

    public function setPlace_x($place_x) {
        $this->place_x = $place_x;
    }

    public function setPlace_y($place_y) {
        $this->place_y = $place_y;
    }

    public function setFacing($facing) {
        $this->facing = $facing;
    }

    public function setKingdom_id($kingdom_id) {
        $this->kingdom = $kingdom_id;
    }

    /**
     * move the queen from one position to another
     *
     * this function don't verifies constraints it just moves the queen to the desired position
     * validation will be done by the function 'validate'. 
     *  
     * Note: O=NORTH, 1=WEST, 2=SOUTH, 3=EAST
     * @param	int $place_x    place_x
     * @param	int $place_y    place_y
     * @param	int $facing    facing converted to his int value
     */
    public function move()
    {
        switch ($this->facing) {
            case FACINGS[0]:
                $this->place_y++;
                break;
            case FACINGS[1]:
                $this->place_x--;
                break;
            case FACINGS[2]:
                $this->place_y--;
                break;
            case FACINGS[3]:
                $this->place_x++;
                break;
        }
        
    }

    /**
     * change the facing of the queen
     *
     * this function increments the facing inversely proportional to clockwise. 
     * from North to west = LEFT it increments
     * from WEST to NORTH = RIGHT it decrements
     * knowing that facing is actually a number we can increment it or decrement it
     * 
     * @param	string $direction    LEFT or RIGHT
     * @param	string $facing    facing
     * @return	$array array of errors 
     */

    public function rotate($direction)
    {
        $errors=array();
        if(!($direction=="RIGHT" || $direction=="LEFT") )
        {
            $errors["rotate"]="bad direction on parameters";
            return $errors;
        }
        $key = array_search($this->facing,FACINGS);
        if($direction=="LEFT")
        {
            $key++; 
            
        }
        
        if($direction=="RIGHT"){
            $key--; 
        }
        $this->facing=FACINGS[$this->adjustKey($key)];
            

    }

    /**
     * validate placement of the queen 
     * 
     * @param	$Kingdom  $kingdom    the kingdom of the queen
     * @return	array  an array containing the errors if there are 
     */

    public function validate($kingdom)
    {
        $errors=array();
        if(!is_integer(intval($this->place_x) )) $errors["place_x"]=" is not integer";
        if(!is_integer(intval($this->place_y)) ) $errors["place_y"]=" is not integer";
        if(!is_string($this->facing))   $errors["facing"]="is not a string";

        //if there is no error we continue
        if(sizeof($errors)==0)
        {
           
            //verify that the value of facing exist
            if(!$this->validateFacing($this->facing)){
                $errors["facing"]="is not a valid value";
            }
            
        }else {
                return $errors;
        }

        //verifying constraints 
        if( !(($this->place_x>=0 AND ($this->place_x <= intval($kingdom->getLength_n()))) AND ($this->place_y>=0 AND ($this->place_y <= intval($kingdom->getWidth_m())))))
        {
            $errors["limits"]="the queen is out of bounds of the kingdom";
            var_dump($errors);
        }
        return $errors;

        
    }

    /**
     * validate the facing of the queen
    */
    public function validateFacing($facing)
    {
       if (in_array($facing, FACINGS)) {
       
        $key = array_search($this->facing,FACINGS);
           return TRUE;
       }else {
           return FALSE;
       }

        
    }
    
    /**
     * adjust the facing if its key is out of bound and return his string value
      */
    public function adjustKey($key)
    {
       if ($key>= sizeof(FACINGS)) {
           return 0;
       }
       if ($key< 0) {
           return sizeof(FACINGS)-1;
        }
        return $key;

        
    }
    
}