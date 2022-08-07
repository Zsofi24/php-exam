<?php
require_once './config.php';
require_once './Filehandler.php';

class DB {
    protected $mysql;

    public function __construct()
    {
        if(file_exists('config.php')) {
            require_once('config.php');
        } 
    }

    function inserts($dataArray)
    {
        $fieldArray = ['név', 'születési_dátum', 'nemzetiség', 'rajtszám'];
        $mysql = $this->getConnect();
        $types = "sssi";
        foreach ($dataArray as $key => $value) {
            $params = [$value[0], $value[1], $value[2], $value[3]];
            $insert = "INSERT INTO versenyzok ($fieldArray[0], $fieldArray[1], $fieldArray[2], $fieldArray[3]) VALUES (?, ?, ?, ?)";
            $statement = $this->prepare($insert, $types, $params);
            $statement->execute();
        }
        $this->close();
    }
    
    public function getConnect() 
    {
        if($this->mysql !== NULL) {
            return $this->mysql;
        } else {
            $this->mysql = new mysqli('localhost', 'root','', 'pilotak');
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

// $insert = new DB();
// $new = $insert->inserts($resultArray);
