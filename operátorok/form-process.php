<?php

  require_once './Process.php';

  $oper = $_POST['oper'];
  $num1 = $_POST['num1'];
  $num2 = $_POST['num2'];

  $process = new Process($oper, (int)$num1, (int)$num2);
  $calc = $processs->calculate();

?>
