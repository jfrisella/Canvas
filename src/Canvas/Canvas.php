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
    *   Timestamp Length to test for, defaults to one day in seconds
    *
    *   @var int
    */
    protected $timestamp = 86400;
    
    
    /**
    *   Action
    *
    *   @var string
    */
    protected $action = "POST";
    
    
    /**
    *   Path
    *
    *   @var string
    */
    protected $path = "https://www.somepath.com/App/";
    

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
    *   @return Canvas output object
    */
    public function validate(array $parameters = array()){
        //Set parameters
        $this->parameters = $parameters;
     
        try{
            
            return $this->_validate();
        
        }catch(\Exception $e){
            return new \Canvas\CanvasOutput($e->getCode(), $e->getMessage());
        }
        
    }
    
    
    /**
    *   Validate Helper
    *
    *   @return Canvas output object
    */
    protected function _validate(){
    
        if(!isset($this->parameters["oauth_signature"]) || empty($this->parameters["oauth_signature"])){
            throw new Exception("CanvasLTI : validate : missing or empty oauth_signature", 400);
        }
        if(!isset($this->parameters["oauth_timestamp"]) || empty($this->parameters["oauth_timestamp"])){
            throw new Exception("CanvasLTI : validate : missing or empty oauth_timestamp", 400);
        }
        if(!isset($this->parameters["oauth_consumer_key"]) || empty($this->parameters["oauth_consumer_key"])){
            throw new Exception("CanvasLTI : validate : missing or empty oauth_consumer_key", 400);
        }
        
        //Test oauth_timestamp
        $time = time();
        $diff = $time - intval($this->parameters["oauth_timestamp"]);
        if($diff > $this->timestamp && $diff < 0){
            throw new Exception("CanvasLTI : validate : stale timestamp", 400);
        }
        
        //Test signature
        if(!$this->_testSignature()){
            throw new Exception("CanvasLTI : validate : signatures do not match", 400);
        }
        
        return new \Canvas\CanvasOutput(200, "success", $this->parameters);
        
    }
    
    
    /**
    *   Test Signature
    *
    *   @return boolean - if signature matches
    */
    protected function _testSignature(){
    
        //Prep parameters
        $params = $this->parameters;
        unset($params["oauth_signature"]);
        
        $oauth = new \BaglerIT\OAuthSimple( $this->key , $this->secret );
        $results = $oauth->sign(Array(  'action'=> $this->action,
                                        'path'=>$this->path,
                                        'parameters'=>$params));
                                        
        //Test signature
        return $this->parameters["oauth_signature"] === urldecode($results["signature"]);
    }

    
    /**
    *   Set Timestamp 
    *
    *   @param $timestamp {int} - length of time to test against oauth_timestamp
    */
    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }
    
    
    /**
    *   Set Path
    *
    *   @param $path {string} - url path to test signature against
    */
    public function setPath($path){
        $this->path = $path;
    }
    
    
    /**
    *   Set Action
    *
    *   @param $action {string} - http method action to test signature against
    */
    public function setAction($action){
        $this->action = $action;
    }
    
}