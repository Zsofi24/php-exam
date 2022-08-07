<?php

require_once './DB.php';
require_once './FileHandler.php';
require_once './Tasks.php';
require_once './TaskEight.php';

$fileHandler = new FileHandler('kifejezesek.txt');
$db = new DB();
$conn = $db->getConnect();
$stmt = $conn->prepare("SELECT * FROM operator.operators;");
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) {
    $resultArray = $fileHandler->read();
    $insert = new DB();
    $new = $insert->inserts($resultArray);
}

$second = new Tasks();
$second = $second->taskSecond();
echo "<p>2. feladat: Kifejezések száma: $second</p>";

$third = new Tasks();
$third = $third->taskThird();
echo "<p>3. feladat: Kifejezések maradékos osztással: $third</p>";

$fourth = new Tasks();
$fourth = $fourth->taskFourth();
echo "<p>4. feladat:$fourth</p>";

$fifth = new Tasks();
$fifth = $fifth->taskFifth();
echo "<p>5. feladat: </p>";
foreach ($fifth as $value) {
    print("$value <br>");
}

$sixth = new Tasks();
$sixth=$sixth->taskSixth(2, 3, "*");
echo "<p>6.feladat: $sixth</p>";

echo "<p>7.feladat:</p>";
require_once './form.php';

//Task 8
$eight = new TaskEight('eredmenyek.txt');
if(!($empty = $fileHandler->readExpressions('eredmenyek.txt'))) {
    $resultArray = $fileHandler->read();
    $results = $eight->result($resultArray);
    $countArray = $eight->appendArray($resultArray, $results);
    $eight->append($countArray);
}
