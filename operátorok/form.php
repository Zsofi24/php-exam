<?php
require_once('Process.php');
$calc = "";
$oper = "";
$num1 = "";
$num2 = "";

if(isset($_POST['expression'])) {
    $oper = $_POST['oper'];
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    $process = new Process($oper, (int)$num1, (int)$num2);
    $calc = $process->calculate();
} 
?>

    <form action="" method="post">
        <input type="number" name="num1" placeholder="első szám" value="<?php echo $num1?>">
        <select name="oper" value="<?php echo $oper?>">
            <option value="+" <?php if($oper == "+") echo "selected"?>>+</option>
            <option value="-" <?php if($oper == "-") echo "selected"?>>-</option>
            <option value="/" <?php if($oper == "/") echo "selected"?>>/</option>
            <option value="*" <?php if($oper == "*") echo "selected"?>>*</option>
            <option value="mod" <?php if($oper == "mod") echo "selected"?>>mod</option>
            <option value="div" <?php if($oper == "div") echo "selected"?>>div</option>
        </select>
        <input type="number" name="num2" placeholder="második szám" value="<?php echo $num2?>">
        <button type="submit" name="expression">Számol</button>
    </form>
    <div>
        <p><?php print($calc); ?></p>
    </div>
