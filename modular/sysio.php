<?php

class sysio extends carrot{

    static function output($inpt){

        $opt = explode('=',$inpt);
        return $opt[1];
    }

   static function getBiosSerialNumber(){
       $inpt = shell_exec('wmic bios get serialnumber /value');
       return self::output($inpt);
    }

   static function getProcessorSerialNumber(){
        $inpt = shell_exec('wmic cpu get processorid /value');
       return self::output($inpt);
    }

   static function getHDDSerialNumber(){
        $inpt = shell_exec('wmic diskdrive get serialnumber /value');
       return self::output($inpt);
    }

   static function getWindowsVersion(){
        $inpt =  shell_exec('wmic os get Caption /value');
       return self::output($inpt);
    }


   static function getSystemSpecification(){
        $systemSpecification = [];
        $manufacturer = shell_exec('wmic computersystem get manufacturer /value');
        $model = shell_exec('wmic computersystem get model /value');
        $totalPhysicalMemory = shell_exec('wmic computersystem get TotalPhysicalMemory /value');

        //Clean up output from wmic
        $manufacturer = str_replace("Manufacturer=", "", $manufacturer);
        $manufacturer = trim($manufacturer);

        $model = str_replace("Model=", "", $model);
        $model = trim($model);

        $totalPhysicalMemory = str_replace("TotalPhysicalMemory=", "", $totalPhysicalMemory);
        $totalPhysicalMemory = trim($totalPhysicalMemory);

        $systemSpecification['Manufacturer'] = $manufacturer;
        $systemSpecification['Model'] = $model;
        $systemSpecification['TotalPhysicalMemory'] = $totalPhysicalMemory;

        return $systemSpecification;
    }

    //Helper function to clean up wmic output
    static function cleanWmicOutput($output){
        $output = str_replace("=", "", $output);
        $output = trim($output);
        return $output;
    }

    //Example usage
    static function test(){
        echo "BIOS Serial Number: " . self::getBiosSerialNumber() . "<br/>";
        echo "Processor Serial Number: " . self::getProcessorSerialNumber() . "<br/>";
        echo "HDD Serial Number: " . self::getHDDSerialNumber() . "<br/>";
        echo "Windows Version: " . self::getWindowsVersion() . "<br/>";

        $systemSpec = self::getSystemSpecification();
        echo "Manufacturer: " . $systemSpec['Manufacturer'] . "<br/>";
        echo "Model: " . $systemSpec['Model'] . "<br/>";
        echo "Total Physical Memory: " . $systemSpec['TotalPhysicalMemory'] . "<br/>";
       
    }

}

//Example usage
//sysio::test();

?>
