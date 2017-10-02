<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = "";
$name = $email = $gender = $comment = $website = "";
$single_tax_amt = "";
$mfj_amt = "";
$mfs_amt = "";
$hh_amt = "";

$display_result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $display_result = "TRUE";
  if (empty($_POST["net_income"])) {
    $nameErr = "Name is required";
  }else if ((is_bool($_POST["net_income"]) == "FALSE")) {
      $nameErr = "Net Income must be a number";
  } else {
    $net_income = test_input($_POST["net_income"]);
  }

    // calc single rate
    if ($net_income <= 9275) {
        $single_tax_amt = $net_income * 0.10;
    } else if ($net_income <= 37650 ) {
        $single_tax_amt = 927.50 + (.15 * ($net_income - 9275));
    } else if ($net_income <= 91150){
        $single_tax_amt = 5183.75 + (.25 * ($net_income - 37650));
    } else if ($net_income <= 190150 ){
        $single_tax_amt = 18558.75 + (.28 * ($net_income - 91150));
    } else if ($net_income <= 413350 ){
        $single_tax_amt = 46278.75 + (.33 * ($net_income - 190150));
    } else if ($net_income <= 415050 ){
        $single_tax_amt = 119934.75 + (.35 * ($net_income - 413350));
    } else {
        $single_tax_amt = 120529.75 + (.396 * ($net_income - 415050));
    }
    // calc mfj (married filing jointly) amount
    if ($net_income <= 18550) {
        $mfj_amt = $net_income * 0.10;
    } else if ($net_income <= 75300) {
        $mfj_amt = 1855 + (.15 * ($net_income - 18550));
    } else if ($net_income <= 151900) {
        $mfj_amt = 10367.50 + (.25 * ($net_income - 75300));
    } else if ($net_income <= 231450) {
        $mfj_amt = 29517.50 + (.28 * ($net_income - 151900));
    } else if ($net_income <= 413350) {
        $mfj_amt = 51791.50 + (.33 * ($net_income - 231450));
    } else if ($net_income <= 415050) {
        $mfj_amt = 111818.50 + (.35 * ($net_income - 413350));
    } else {
        $mfj_amt = 130578.50+ (.396 * ($net_income - 466950));
    }
    // calc mfs (married filling sep) amount
    if ($net_income <= 9275) {
        $mfs_amt = $net_income * 0.10;
    } else if ($net_income <= 37650) {
        $mfs_amt = 927.50 + (.15 * ($net_income - 9275));
    } else if ($net_income <= 75950) {
        $mfs_amt = 5183.75 + (.25 * ($net_income - 37650));
    } else if ($net_income <= 115725) {
        $mfs_amt = 14758.75 + (.28 * ($net_income - 75950));
    } else if ($net_income <= 206675) {
        $mfs_amt = 25895.75 + (.33 * ($net_income - 115725));
    } else if ($net_income <= 233475) {
        $mfs_amt = 55909.25 + (.35 * ($net_income - 206675));
    } else {
        $mfs_amt = 65289.25 + (.396 * ($net_income - 233475));
    }
    // calc hh (Head of Househole) amount
    if ($net_income <= 13250) {
        $hh_amt = $net_income * 0.10;
    } else if ($net_income <= 50400) {
        $hh_amt = 1325 + (.15 * ($net_income - 13250));
    } else if ($net_income <= 130150) {
        $hh_amt = 6897.50 + (.25 * ($net_income - 50400));
    } else if ($net_income <= 210800) {
        $hh_amt = 26835 + (.28 * ($net_income - 130150));
    } else if ($net_income <= 413350) {
        $hh_amt = 49417 + (.33 * ($net_income - 210800));
    } else if ($net_income <= 441000) {
        $hh_amt = 116258.50 + (.35 * ($net_income - 413350));
    } else {
        $hh_amt = 125936 + (.396 * ($net_income - 441000));
    }


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
Net Income: <input type="number" name="net_income">
<span class="error">* <?php echo $nameErr;?></span>

<br><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php
if($display_result == "TRUE") {

    echo "<h2>Your Net Worth:</h2>";
    echo "<span>$net_income</span><br>";

    echo "<label>Single Status Tax:</label>";
    echo  "<span>$single_tax_amt<span><br>";

    echo "<label>Married Filing Jointly:</label>";
    echo "<span>$mfj_amt</span><br> ";

    echo "<label>Married Filing Separately:</label>";
    echo  "<span> $mfs_amt </span><br>";

    echo " <label>Head of Household:</label>";
    echo "<span>$hh_amt</span><br>";

}

?>

</body>
</html>
