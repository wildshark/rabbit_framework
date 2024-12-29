<?php

class temp extends controller{

    private $tmpdir;

    public function __construct(){
        parent::__construct();
        $this->tmpdir = "./temp";
    }

    public function createTempDir(){
        if (!is_dir($this->tmpdir)) {
            if (!mkdir($this->tmpdir, 0777, true)) {
                return "Failed to create temporary directory.";
            }
        }
        return $this->tmpdir;
    }

    public function deleteTempDir(){
        if (is_dir($this->tmpdir)) {
            deleteAllFilesInTempFolder($this->tmpdir);
            rmdir($this->tmpdir);
        }
    }

    public function getTempDir(){
        return $this->tmpdir;
    }

    public function checkTempDir(){
        return is_dir($this->tmpdir);
    }

    public function listTempFiles(){
        $files = [];
        if ($handle = opendir($this->tmpdir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $files[] = $entry;
                }
            }
            closedir($handle);
        }
        return $files;
    }

    public function getTempFile($filename){
        $filepath = $this->tmpdir . "/" . $filename;
        if(is_file($filepath)){
            return file_get_contents($filepath);
        }
        return false;
    }

    public function createTempFile($filename, $content){
        $filepath = $this->tmpdir . "/" . $filename;
        if(file_put_contents($filepath, $content)){
            return $filepath;
        }
        return false;
    }

    public function deleteTempFile($filename){
        $filepath = $this->tmpdir . "/" . $filename;
        if(is_file($filepath)){
            unlink($filepath);
            return true;
        }
        return false;
    }
}

?>
