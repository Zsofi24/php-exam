<?php
require_once './config.php';
require_once './Filehandler.php';

class DB {
    protected $mysql;

    public function __construct()
    {
        if(file_exists('config.php')) {
            require_once('config.php');
        } else {
            //dobunk egy hibát throw new Exception();
        }
    }


    function inserts($dataArray)
    {
        $fieldArray = ['elso_operandus', 'operator', 'masodik_operandus'];
        $mysql = $this->getConnect();
        //var_dump($dataArray);
        $types = "isi";
        foreach ($dataArray as $key => $value) {
            $params = [$value[0], $value[1], $value[2]];
            //var_dump($value);
            $insert = "INSERT INTO operatorok ($fieldArray[0], $fieldArray[1], $fieldArray[2]) VALUES (?, ?, ?)";
            //echo "<p>$insert</p>";
            $statement = $this->prepare($insert, $types, $params);
            $statement->execute();
        }
        $this->close();
    }
    
    protected function getConnect() 
    {
        if($this->mysql !== NULL) {
            return $this->mysql;
        } else {
            $this->mysql = new mysqli('localhost', 'root','', 'operator');
            return $this->mysql;
        }
    }
    
    private function close()
    {
        if($this->mysql !== NULL) {
            $this->mysql->close();
        }
    }

    protected function prepare($sql, $types, $data)
    {
        $stmt = $this->mysql->prepare($sql);
        if($types !== "") {
            $stmt->bind_param($types, ...$data);
        }
        return $stmt;
    }
}

$insert = new DB();
$new = $insert->inserts($resultArray);
//echo $new;
