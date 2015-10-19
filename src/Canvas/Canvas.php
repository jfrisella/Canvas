<?php
/**
*   Canvas Class
*/  
namespace Canvas;

class CanvasLTI
{

    /**
    *   Oauth Key
    *
    *   @var string
    */
    protected $key;
    
    
    /**
    *   Oauth Secret
    *
    *   @var string
    */
    protected $secret;
    
    
    /**
    *   Oauth parameters
    *
    *   @var array
    */
    protected $parameters;


    /**
    *   Create new Canvas instance
    *
    *   @param $key {string} - oauth key
    *   @param $secret {string} - oauth secret
    */
    public function __construct($key, $secret){
        $this->key = $key;
        $this->secret = $secret;
    }
    
    
    /**
    *   Validate Canvas Parameters
    *
    *   @param $details {array} - assoc array of LTI details passed by canvas
    *       - path {string} - url path string of endpoint
    *       - action {string} - http method used
    *       - parameters {array} - parameters passed by canvas
    */
    public function validate(array $details = array()){
        if(!isset($details["path"]) || empty($details["path"])){
            throw new Exception("CanvasLTI : validate : missing or empty path endpoint", 400);
        }
        if(!isset($details["action"]) || empty($details["action"])){
            throw new Exception("CanvasLTI : validate : missing or empty action", 400);
        }
        if(!isset($details["parameters"]) || empty($details["parameters"])){
            throw new Exception("CanvasLTI : validate : missing or empty parameters", 400);
        }
        
        
    }

}