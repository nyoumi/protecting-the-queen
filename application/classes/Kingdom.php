<?php

define("MAX_LENGTH", 10);
define("MAX_WIDTH", 10);
define("MIN_LENGTH", 2);
define("MIN_WIDTH", 1);
class Kingdom {

     /**
    * the id of the kingdom
    *
    * @var	int
    */
    private $id;
    /**
    * the N length of the kingdom
    *
    * @var	int
    */

    private $length_n;
    /**
    * the M width of the kingdom
    *
    * @var	int
    */

    private $width_m;


    /**
     *getters and setters
     */
    public function __construct($length_n,$width_m)
	{
        $this->length_n=$length_n;
        $this->width_m=$width_m;

    }

    public function getId() {
        return $this->id;
    }

    public function getLength_n() {
        return $this->length_n;
    }

    public function getWidth_m() {
        return $this->width_m;
    }

    public function setLength_n($length_n) {
        $this->length_n = $length_n;
    }

    public function setWidth_m($width_m) {
        $this->width_m = $width_m;
    }

    /**
     * validate the creation of the kingdom respecting constraints 
     * 
     * @param	int $max_length    max length
     * @param	int $max_width    max width
     * @param	int $min_length    min length
     * @param	int $min_width    min width
     * @param	int $length_n    length of the kingdom
     * @param	int $width_m    width of the kingdom
     * @return	bool true if kingdom respect constraints false if not
     */

    public function validate()
    {
        if(($this->length_n>=MIN_LENGTH AND $this->length_n<MAX_LENGTH) AND ($this->width_m>=MIN_WIDTH AND $this->width_m<MAX_WIDTH))
        {
            return true;
        }else {
            return false;
        }

        
    }

}