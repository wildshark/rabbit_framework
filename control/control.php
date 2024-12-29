<?php

class controller{

    private $config;
    private $calendar;
    private $mode;

    public function __construct()
    {
        $this->config = "./data/config.json";
        $this->calendar = "./data/calendar.json";

    }

    private function mode(){

        
    }

    public function config(){
        if(is_file($this->config)){
            return json_decode(file_get_contents($this->config),TRUE);
        }  
        return false;
    }

    public function calendar(){
        if(is_file($this->calendar)){
            return json_decode(file_get_contents($this->calendar),TRUE);
        }  
        return false;
    }

    public function decodeUID($id){

        if(!is_numeric($id)){
            echo 'invaild id';
            die(0);
        }else{
            for ($i = 1; $i <= 99999999999999; $i++) {
                if (sha1($i) == $id) {
                    return $i;
                } 
            }
        }
    }

    public function encodeUID($id){
        
        return sha1($id);
    }

    public function createSession($inactive){
        
        if (!isset($_SESSION['countdown'])){
            $_SESSION['countdown'] = 120;
            $_SESSION['time_started'] = time();
        }
        
        $timeSince = $inactive - $_SESSION['time_started'];
        $remainingSeconds = abs($_SESSION['countdown'] - $timeSince);
        
        if ($remainingSeconds > 360 ){
            session_unset();
            session_destroy();
            header("location: index.php");
            exit(0);
        }
    }

    public function isConnrcted(){
        
        $is_connected = false;

        $headers = @get_headers(HOST);
        if(!isset($headers)){
            $is_connected = false;
        }else{
            if(strpos($headers[0],'200')===false){
                $is_connected = false;
            } else {
                $is_connected = true;
            }
        }
        return $is_connected;
    }
}

?>