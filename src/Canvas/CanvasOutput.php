<?php
/**
*   Canvas Output
*/
namespace Canvas;

class CanvasOutput
{

    /**
    *   Results
    *
    *   @var array
    */
    protected $results;
    
    
    /**
    *   Status 
    *       - 200 or 400
    *
    *   @var int
    */
    protected $status;
    
    
    /**
    *   Get Message
    *
    *   @var string
    */
    protected $message;
    
    
    /**
    *   Create new CanvasOutput instance
    */
    public function __construct($status, $message, array $results = array()){
        $this->status = $status;
        $this->message = $message;
        $this->results = $results;
    }
    
    
    /**
    *   Get Status Code
    *
    *   @return $this->status
    */
    public function getStatus(){
        return $this->status;
    }
    
    
    /**
    *   Get Results
    *
    *   @return $this->results
    */
    public function getResults(){
        return $this->results;
    }
    
    
    /**
    *   Get Message
    *
    *   @return $this->message
    */
    public function getMessage(){
        return $this->message;
    }
    
    /**
    *   Is Success
    *
    *   @return boolean - true if status === 200
    */
    public function isSuccess(){
        return intval($this->status) === 200;
    }

}