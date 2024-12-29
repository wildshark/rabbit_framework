<?php

class rsource extends controller{

    private $filepath;
    private $filetype;

    public function __construct($filepath, $filetype = 'json'){
        parent::__construct();
        $this->filepath = $filepath;
        $this->filetype = $filetype;
    }

    public function read(){
        if(file_exists($this->filepath)){
            if($this->filetype == 'json'){
                return json_decode(file_get_contents($this->filepath), true);
            }elseif($this->filetype == 'csv'){
                $data = [];
                if (($handle = fopen($this->filepath, "r")) !== FALSE) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $data[] = $row;
                    }
                    fclose($handle);
                }
                return $data;
            }
        }
        return false;
    }

    public function create($data){
        if($this->filetype == 'json'){
            return file_put_contents($this->filepath, json_encode($data, JSON_PRETTY_PRINT));
        }elseif($this->filetype == 'csv'){
            if (($handle = fopen($this->filepath, "w")) !== FALSE) {
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }
                fclose($handle);
            }
            return true;
        }
        return false;
    }

    public function update($data){
        if($this->filetype == 'json'){
            return file_put_contents($this->filepath, json_encode($data, JSON_PRETTY_PRINT));
        }elseif($this->filetype == 'csv'){
            if (($handle = fopen($this->filepath, "w")) !== FALSE) {
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }
                fclose($handle);
            }
            return true;
        }
        return false;
    }

    public function search($key, $value){
        $data = $this->read();
        if($data){
            if($this->filetype == 'json'){
                foreach($data as $item){
                    if(isset($item[$key]) && $item[$key] == $value){
                        return $item;
                    }
                }
            }elseif($this->filetype == 'csv'){
                foreach($data as $row){
                    if($row[array_search($key, $data[0])] == $value){
                        return array_combine($data[0], $row);
                    }
                }
            }
        }
        return false;
    }

    public function deleteRecord($key, $value){
        $data = $this->read();
        if($data){
            if($this->filetype == 'json'){
                $newData = array_filter($data, function($item) use ($key, $value){
                    return !isset($item[$key]) || $item[$key] != $value;
                });
                return $this->update($newData);
            }elseif($this->filetype == 'csv'){
                $headers = $data[0];
                $newData = array_filter($data, function($row) use ($key, $value, $headers){
                    return $row[array_search($key, $headers)] != $value;
                });
                return $this->update($newData);
            }
        }
        return false;
    }

    public function delete(){
        return unlink($this->filepath);
    }
}
