<?php
require_once './DB.php';

class Feladatok extends DB
{
    public function masodikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(*) as db FROM operatorok";
        //$result->query($sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count;
        }
    }

    public function harmadikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(operator) AS db_modulo FROM operatorok WHERE operator = 'mod'";
        //$result->query($sql);
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count;
        }
    }

    public function negyedikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT elso_operandus, masodik_operandus FROM operatorok";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        $operandusok = [];
        $answer_yes = "van ilyen kifejezés";
        $answer_no = "nincs ilyen kifejezés";
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($first, $second);
            while ($stmt->fetch()) {
                if (($first % 10 === 0) && ($second % 10 === 0)) {
                    return $answer_yes;
                }
            }
            return $answer_no;
        }
    }

    public function otodikFeladat()
    {
        $conn = $this->getConnect();
        $sql = "SELECT operator, COUNT(operator) AS db_operator FROM operatorok where operator IN ('mod', '/', 'div','-', '*', '+') GROUP BY operator ";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        $statisztika = [];
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($operator, $db_operator);
            while ($stmt->fetch()) {
                $statisztika[] = "$operator -> $db_operator <br>";
            }
            return $statisztika;
        }
    }

    public function hatodikFeladat($a, $b, $muveletiJel) {
        switch ($muveletiJel) {
            case "+":
                $result = $a + $b;
                return "$a + $b = $result";
            case "-":
                $result = $a - $b;
                return "$a - $b = $result";
            case "*":
                $result = $a * $b;
                return "$a * $b = $result";
            case "/":
                if($b === 0) {
                    return "Egyéb hiba!";
                } else {
                    $result = $a / $b;
                    return "$a / $b = $result";
                }
            case "mod":
                if($b === 0) {
                    return "Egyéb hiba!";
                } else {
                $result = $a % $b;
                return "$a mod $b = $result";
                }
            case "div":
                if($b === 0) {
                    return "Egyéb hiba!";
                } else {
                $result = $a / $b;
                return "$a div $b = $result";
                }
            default:
                return "Hibás operátor!";
        }
    }

    public function hetedikFeladat()
    {
        
    }
}


