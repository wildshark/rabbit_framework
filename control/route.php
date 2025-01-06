<?php
class rabbit{

    public static function error_handler(){
    
        $path ='error.log';//tell php where to save your error logs
        ini_set('log_errors',1);//logs errors 
        ini_set('error_log',$path); //override php's default error log directory 
    
    }

    public static function log_error($error){
        file_put_contents('error.log',$error."\n",FILE_APPEND);
    }

    public static function _sys_desk_reqt(){
        
        try {
            if (!isset($_REQUEST['submit'])) {
                if (!isset($_REQUEST['page'])) {
                    if (!isset($_REQUEST['main'])) {
                        session_destroy();
                        deleteAllFilesInTempFolder("temp/");
                        require_once "./frame/login.php";
                    } else {
                        require_once './control/navgiate.php';
                    }
                } else {
                    require_once "./control/page.php";
                }
            } else {
                require_once './control/module.php';
            }
        } catch (Exception $e) {
            echo "ERROR :" . $e->getMessage();
            self::log_error(date('Y-m-d H:i:s')."ERROR : " . $e->getMessage());
            // Log the error or take appropriate action
        }
    }

    static function _sys_soap_reqt(){
        require_once './control/global.php';
        try {
            $controller = new controller();
            if(true === $controller->isConnrcted()){
                $sbn = new SoapClient(null, array(
                    'location' => HOST . QUERY_URL,
                    'uri' => HOST . QUERY_URL,
                    'trace' => 1
                ));
            
                if (!isset($_REQUEST['submit'])) {
                    if (!isset($_REQUEST['page'])) {
                        if (!isset($_REQUEST['main'])) {
                            session_destroy();
                            deleteAllFilesInTempFolder("temp/");
                            require_once "./frame/login.php";
                        } else {
                            require_once './control/navgiate.php';
                        }
                    } else {
                        require_once "./control/page.php";
                    }
                } else {
                    require_once './control/module.php';
                }

            }else{
                echo "ERROR : Unable to connect to server";
                self::log_error(date('Y-m-d H:i:s')."ERROR : Unable to connect to server");
            }
        } catch (Exception $e) {
            echo "SBN Fault: " . $e->getMessage();
            self::log_error(date('Y-m-d H:i:s')."ERROR : " . $e->getMessage());
            // Log the error or take appropriate action
        }
    }

    static function LoadModular(){
        $modular_folder = 'modular/';
        // Check if the 'modular' folder exists
        if (!is_dir($modular_folder)) {
            die("Error: 'modular' folder does not exist.");
        }
        // Get a list of files in the 'modular' folder
        $files = scandir($modular_folder);

        // Check if there are any files in the folder (excluding '.' and '..')
        if (count($files) <= 2) {
            die("Error: No files found in the 'modular' folder.");
        }

        // Loop through the files and include them
        foreach ($files as $file) {
            // Skip '.' and '..' (current and parent directories)
            if ($file === '.' || $file === '..') {
                continue;
            }

            // Construct the full file path
            $file_path = $modular_folder . $file;

            // Check if the file exists
            if (!is_file($file_path)) {
                echo "Warning: File '$file' does not exist.<br>";
                continue;
            }

            // Include the file
            include_once($file_path);
        }
    }

    static function info(){
        return sysio::test();
    }
    
    static function start($start){
      
        if($start ==="soap"){
            self::_sys_soap_reqt();
        }elseif($start==="desk"){
            self::_sys_desk_reqt();
        }
    }
}