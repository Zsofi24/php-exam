<?php

class FileHandler 
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

    public function beolvas() : array
    {
        $resultArray = [];
        if($this->fileName !== NULL) {
            $handler = fopen($this->fileName, 'r');
            if($handler) {
                $lineCount = 0;
                while(($line = fgets($handler)) !== false) {
                    
                    $resultArray[] = explode(' ', substr($line, 0, strlen($line)-2));
                    $lineCount++;
                }
                fclose($handler);
            }
        }
        //print('<pre>');
        //var_dump($resultArray);
        return $resultArray;
    }
}

$fileHandler = new FileHandler('kifejezesek.txt');
//$fileHandler->setFileName('pilotak.csv');
$resultArray = $fileHandler->beolvas();
//print('<pre>');
//var_dump($resultArray);

