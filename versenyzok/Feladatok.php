<?php
require_once './DB.php';

class Feladatok extends DB
{
    public function harmadikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(*) as db FROM versenyzok";
        //$result->query($sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($count);
            $stmt->fetch();
            return "3. feladat: $count";
        }
    }


    public function negyedikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT név FROM versenyzok ORDER BY id DESC LIMIT 1";
        //$result = mysqli_query($conn, $sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($count);
            $stmt->fetch();
            return "4. feladat: $count";
        }
    }

    public function otodikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT név, születési_dátum FROM versenyzok WHERE születési_dátum < '1901-01-01'";
        $oldPeople = [];
        //$result = mysqli_query($conn, $sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($name, $date);
            while($stmt->fetch()) {
                $oldPeople[] = "$name ($date) <br>"; 
            }
            return $oldPeople;
        }
    }

    public function hatodikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT nemzetiség FROM versenyzok WHERE rajtszám > 0 ORDER BY rajtszám LIMIT 1";
        //$result = mysqli_query($conn, $sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($nemzetiseg);
            $stmt->fetch();
            return "6. feladat: $nemzetiseg";
        }
    }

    public function hetedikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT rajtszám, COUNT(rajtszám) FROM versenyzok WHERE rajtszám > 0 GROUP BY rajtszám HAVING 
        count(rajtszám) > 1";
        $rajtszamok = [];
        //$result = mysqli_query($conn, $sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($numbers, $count);
            while($stmt->fetch()) {
                $rajtszamok[] = $numbers; 
            }
            return $rajtszamok;
        }
    }
}


$harmadik = new Feladatok();
$harmadik = $harmadik->harmadikFeladat() ;
echo "<p>$harmadik</p>";

$negyedik = new Feladatok();
$negyedik = $negyedik->negyedikFeladat() ;
echo "<p>$negyedik</p>";

$otodik = new Feladatok();
$otodik = $otodik->otodikFeladat();
echo "<p>5. feladat: </p>";
foreach ($otodik as $value) {
    print ($value);
}

$hatodik = new Feladatok();
$hatodik = $hatodik->hatodikFeladat() ;
echo "<p>$hatodik</p>";

$hetedik = new Feladatok();
$hetedik = $hetedik->hetedikFeladat();
echo "<p>7. feladat: </p>";
foreach ($hetedik as $value) {
    echo ($value . ", ");
}