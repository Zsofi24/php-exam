<?php


class Feldolgoz {
    public $a;
    public $b;
    public $muveletiJel;

    public function toArray() {
    
    if(isset($_POST["submit"])) {
    
        $expression = htmlspecialchars($_POST["expression"]);
        $array = explode(" ", $expression);
        foreach ($array as $value) {
           $value[0] = $this->a;
           $value[1] = $this->muveletiJel;
           $value[2] = $this->b;
        }

        return "$this->a $this->muveletijel $this->b = ";
    }
}

}

$feldolgozas = new Feldolgoz;
$feldolgozas =  $feldolgozas->toArray();

header('Location: index.php');
