<?php
require_once './config.php';
require_once './Filehandler.php';

require_once './SQLGenerator.php';

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
        $fieldArray = ['név', 'születési_dátum', 'nemzetiség', 'rajtszám'];
        $mysql = $this->getConnect();
        $sqlGenerator = new SQLGenerator();
        //var_dump($dataArray);
        $types = "sssi";
        foreach ($dataArray as $key => $value) {
            $params = [$value[0], $value[1], $value[2], $value[3]];
            //var_dump($value);
            $insert = "INSERT INTO versenyzok ($fieldArray[0], $fieldArray[1], $fieldArray[2], $fieldArray[3]) VALUES (?, ?, ?, ?)";
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

$insert = new DB();
$new = $insert->inserts($resultArray);
//echo $new;
