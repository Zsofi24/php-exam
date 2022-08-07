<?php
require_once './DB.php';

class Tasks extends DB
{
    public function taskThird()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(*) as db FROM versenyzok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count;
        }
    }

    public function taskFourth()
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
            return $count;
        }
    }

    public function taskFifth()
    {
        $conn = $this->getConnect();
        $sql = "SELECT név, születési_dátum FROM versenyzok WHERE születési_dátum < '1901-01-01'";
        $oldPeople = [];
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($name, $date);
            while($stmt->fetch()) {
                $oldPeople[] = "$name ($date)"; 
            }
            return $oldPeople;
        }
    }

    public function taskSixth()
    {
        $conn = $this->getConnect();
        $sql = "SELECT nemzetiség FROM versenyzok WHERE rajtszám > 0 ORDER BY rajtszám LIMIT 1";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($nationality);
            $stmt->fetch();
            return $nationality;
        }
    }

    public function taskSeventh()
    {
        $conn = $this->getConnect();
        $sql = "SELECT rajtszám, COUNT(rajtszám) FROM versenyzok WHERE rajtszám > 0 GROUP BY rajtszám HAVING 
        count(rajtszám) > 1";
        $startNumbers = [];
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($numbers, $count);
            while($stmt->fetch()) {
                $startNumbers[] = $numbers; 
            }
            return $startNumbers;
        }
    }
}
