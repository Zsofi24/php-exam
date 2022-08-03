<?php
require_once './FileHandler.php';
class SQLGenerator 
{
    public function array2Insert($fieldArray, $dataArray)
    {
        //foreach ($dataArray as $value) 
        // print_r($value[3]);
        $insert = "INSERT INTO versenyzok ($fieldArray[0], $fieldArray[1], $fieldArray[2], $fieldArray[3]) VALUES ('$dataArray[0]', '$dataArray[1]', '$dataArray[2]', '$dataArray[3]')";
        return $insert;
        
    }
}

//$new = new SQLGenerator();
// $array = $new->array2Insert($resultArray);
// print($array);

