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

    public function read() : array
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
        return $resultArray;
    }

    public function readExpressions(string $fName)
    {
        $handler = fopen($fName, 'r');
        if($handler) {
            if(($line = fgets($handler)) === false) {
                return false;
            } else {
                return true;
            }
            fclose($handler);
        }
    }
}
