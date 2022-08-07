<?php

require_once './Tasks.php';

class Process 
{
    public $operator;
    public $num1;
    public $num2;

    public function __construct(string $one, int $two, int $three)
    {
        $this->operator = $one;
        $this->num1 = $two;
        $this->num2 = $three;
    }

    public function calculate() {
        $feladatok = new Tasks();
        return $feladatok->taskSixth($this->num1, $this->num2, $this->operator);
    }
}
