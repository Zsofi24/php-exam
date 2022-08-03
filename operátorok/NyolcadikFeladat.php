<?php
require_once './DB.php';

class Create extends DB
{
    private $fileName = NULL;
    
    public function __construct($fileName = NULL)
    {
       if(file_exists($fileName)) {
            $this->fileName = $fileName;
       }
    }
    
    public function getFileName() 
    {
        return $this->fileName;
    }

    public function setFileName($fileName): void 
    {
        if(file_exists($fileName)) {
            $this->fileName = $fileName;
        }
    }
    
    public function result($resultArray)
    {
         $results = [];
         foreach ($resultArray as $value) {
            switch ($value[1]) {
                case "+":
                    $result = $value[0] + $value[2];
                    break;
                case "-":
                    $result = $value[0] - $value[2];
                    break;
                case "*":
                    $result = $value[0] * $value[2];
                    break;
                case "/":
                    if((int)$value[2] === 0) {
                        $result = "Egyéb hiba!";
                        break;
                    } else {
                        $result = $value[0] / $value[2];
                        break;
                    }
                case "mod":
                    if((int)$value[2] === 0) {
                        $result = "Egyéb hiba!";
                        break;
                    } else {
                        $result = $value[0] % $value[2];
                        break;
                    }
                case "div":
                    if((int)$value[2] === 0) {
                        $result = "Egyéb hiba!";
                        break;
                    } else {
                        $result = $value[0] / $value[2];
                        break;
                    }
                default:
                    $result = "Hibás operátor!";
            }
            $results[] = $result;
         }
        return $results;
    }

    public function appendArray($resultArray, $results)
    {
        $countArray = [];
        for ($i=0; $i < count($results); $i++) { 
            $c = $results[$i];
            $a = $resultArray[$i][0];
            $operator = $resultArray[$i][1];
            $b = $resultArray[$i][2];
            $line = "$a $operator $b = $c \r\n";   //php_eol        
            $countArray[$i] = $line;
        }
        return $countArray;
    }

    public function append($countArray)
    {
        $handler = fopen('eredmenyek.txt', 'a+');
        for($i = 0; $i < count($countArray); $i++) {
            fwrite($handler, $countArray[$i]);
        }
        fclose($handler);
    }
}

$create = new Create('eredmenyek.txt');
//$resultArray = $fileHandler->beolvas();
$results = $create->result($resultArray);
$countArray = $create->appendArray($resultArray, $results);
$create->append($countArray);
