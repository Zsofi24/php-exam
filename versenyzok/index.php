<?php

require_once './DB.php';
require_once './FileHandler.php';
require_once './Tasks.php';

$fileHandler = new FileHandler('pilotak.csv');

$db = new DB();
$conn = $db->getConnect();
$stmt = $conn->prepare("SELECT * FROM pilotak.versenyzok;");
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) {
    $resultArray = $fileHandler->read(false);
    $insert = new DB();
    $new = $insert->inserts($resultArray);
}

$third = new Tasks();
$third = $third->taskThird() ;
echo "<p>3. feladat: $third</p>";

$fourth = new Tasks();
$fourth = $fourth->taskFourth() ;
echo "<p>4. feladat: $fourth</p>";

$fifth = new Tasks();
$fifth = $fifth->taskFifth();
echo "<p>5. feladat: </p>";
foreach ($fifth as $value) {
    print ("$value <br>");
}

$sixth = new Tasks();
$sixth = $sixth->taskSixth() ;
echo "<p>6. feladat: $sixth</p>";

$seventh = new Tasks();
$seventh = $seventh->taskSeventh();
echo "<p>7. feladat: </p>";
foreach ($seventh as $value) {
    echo ($value . ", ");
}
