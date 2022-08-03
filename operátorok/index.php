<?php

require_once './Feladatok.php';

$masodik = new Feladatok();
$masodik = $masodik->masodikFeladat();
echo "<p>2. feladat: Kifejezések száma: $masodik</p>";

$harmadik = new Feladatok();
$harmadik = $harmadik->harmadikFeladat();
echo "<p>3. feladat: Kifejezések maradékos osztással: $harmadik</p>";

$negyedik = new Feladatok();
$negyedik = $negyedik->negyedikFeladat();
echo "<p>4. feladat:$negyedik</p>";

$otodik = new Feladatok();
$otodik = $otodik->otodikFeladat();
echo "<p>5. feladat: </p>";

foreach ($otodik as $value) {
    print($value);
}

$hatodik = new Feladatok();
$hatodik=$hatodik->hatodikFeladat(2, 3, "*");
echo "<p>6.feladat: $hatodik</p>";

echo "<p>7.feladat:</p>";
require_once './form.php';


