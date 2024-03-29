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

    public function read($header = false) : array
    {
        $resultArray = [];
        
        if($this->fileName !== NULL) {
            $handler = fopen($this->fileName, 'r');
            if($handler) {
                $lineCount = 0;
                while(($line = fgets($handler)) !== false) {
                    if(!$header && $lineCount === 0) {
                        $lineCount++;
                        continue;
                    }
                    $resultArray[] = explode(';', $line);
                    $lineCount++;
                }
                fclose($handler);
            }
        }
        return $resultArray;
    }
}

// $fileHandler = new FileHandler('pilotak.csv');
// $fileHandler->setFileName('pilotak.csv');
// $resultArray = $fileHandler->read(false);
