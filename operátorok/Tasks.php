<?php
require_once './DB.php';

class Tasks extends DB
{
    public function taskSecond()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(*) as db FROM operators";
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

    public function taskThird()
    {
        $conn = $this->getConnect();
        $sql = "SELECT COUNT(operator) AS db_modulo FROM operators WHERE operator = 'mod'";
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

    public function taskFourth()
    {
        $conn = $this->getConnect();
        $sql = "SELECT first_num, second_num FROM operators";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
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

    public function taskFifth()
    {
        $conn = $this->getConnect();
        $sql = "SELECT operator, COUNT(operator) AS db_operator FROM operators where operator IN ('mod', '/', 'div','-', '*', '+') GROUP BY operator;";
        $stmt = $this->prepare($sql, "", []);
        $stmt->execute();
        $statistics = [];
        if ($stmt->error !== "") {
            return $stmt->error;
        } else {
            $stmt->bind_result($operator, $db_operator);
            while ($stmt->fetch()) {
                $statistics[] = "$operator -> $db_operator";
            }
            return $statistics;
        }
    }

    public function taskSixth($a, $b, $operator) {
        switch ($operator) {
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
}
