<?php

//seesion
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $date = date("Y-m-d H:i:sa");
    $errorMessage = "** [$date] Error #$errline **\n";
    $errorMessage .= "Type: " . error_reporting() . " (" . $errno . ")\n";
    $errorMessage .= "Message: " . $errstr . "\n";
    $errorMessage .= "File: " . $errfile . "\n";
    $errorMessage .= "Line: " . $errline . "\n\n";
  
    // Write error to file
    if (!file_exists('error.txt')) touch('error.txt'); //create file if it doesn't exist.
    file_put_contents("error.txt", $errorMessage, FILE_APPEND | LOCK_EX); // Use LOCK_EX for exclusive access
  
    // Optionally display a custom error message to the user
    // echo "<p>An error occurred: " . $errstr . "</p>"; 
}

function get_greeting($username) {
    $current_time = date("H:i");
    
    if ($current_time >= "06:00" && $current_time < "12:00") {
        return "Good Morning! ".$username;
    } elseif ($current_time >= "12:00" && $current_time < "18:00") {
        return "Good Afternoon! ".$username;
    } else {
        return "Good Evening! ".$username;
    }
}

function isNull($num){

    if($num == false){
        return "0";
    }else{
        return $num;
    }
}

function isSerialNumber() {
    static $num = 1;
    return $num++;
}

function getTimeElapsed($datetime, $full = false) {
    // time_elapsed('2016-01-18 13:07:30', true); 
    // 2 years, 1 month, 2 weeks, 6 days, 25 seconds ago
    // time_elapsed('2016-01-18 13:07:30'); 
    // 2 years ago
    
        $now = time();
        $ago = strtotime($datetime);
        
        $diff   = $now - $ago; 
        
        $string = array(
            'year'  => 31104000,
            'month' => 2592000,
            'week'  => 604800,
            'day'   => 86400,
            'hour'  => 3600,
            'minute'=> 60,
            'second'=>  1
        );
        
        $data = array();
        
        foreach ($string as $k => $v) {
        
            if($diff > $v){
                $count = round($diff / $v);
                $data[$k] = $count . (($count > 1) ? ' ' . $k .'s' : ' ' . $k);
                $diff     = $diff % $v;
            }
        }
        
        if (!$full) $data = array_slice($data, 0, 1);
        
        return $data ? implode(', ', $data) . ' ago' : 'just now';
    }

    function deleteAllFilesInTempFolder($folderPath) {
        if (!is_dir($folderPath)) {
            throw new Exception("The specified path is not a directory.");
        }
    
        if (!is_readable($folderPath)) {
            throw new Exception("The specified directory is not readable.");
        }
    
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
    
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }
    }

?>
