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

    $single_tax_amt = incomeTaxSingle($net_income);
    $mfj_amt = incomeTaxMarriedJointly($net_income);
    $mfs_amt = incomeTaxMarriedSeparately($net_income);
    $hh_amt = incomeTaxHeadOfHousehold($net_income);

}

function incomeTaxSingle($net_inc){
    // calc single rate
    if ($net_inc <= 9275) {
        return $net_inc * 0.10;
    } else if ($net_inc <= 37650 ) {
        return 927.50 + (.15 * ($net_inc - 9275));
    } else if ($net_inc <= 91150){
        return 5183.75 + (.25 * ($net_inc - 37650));
    } else if ($net_inc <= 190150 ){
        return 18558.75 + (.28 * ($net_inc - 91150));
    } else if ($net_inc <= 413350 ){
        return 46278.75 + (.33 * ($net_inc - 190150));
    } else if ($net_inc <= 415050 ){
        return 119934.75 + (.35 * ($net_inc - 413350));
    } else {
        return 120529.75 + (.396 * ($net_inc - 415050));
    }
}

function incomeTaxMarriedJointly($net_inc){
    // calc mfj (married filing jointly) amount
    if ($net_inc <= 18550) {
        return $net_inc * 0.10;
    } else if ($net_inc <= 75300) {
        return 1855 + (.15 * ($net_inc - 18550));
    } else if ($net_inc <= 151900) {
        return 10367.50 + (.25 * ($net_inc - 75300));
    } else if ($net_inc <= 231450) {
        return 29517.50 + (.28 * ($net_inc - 151900));
    } else if ($net_inc <= 413350) {
        return 51791.50 + (.33 * ($net_inc - 231450));
    } else if ($net_inc <= 415050) {
        return 111818.50 + (.35 * ($net_inc - 413350));
    } else {
        return 130578.50+ (.396 * ($net_inc - 466950));
    }
}

function incomeTaxMarriedSeparately($net_inc){
    // calc mfs (married filling sep) amount
    if ($net_inc <= 9275) {
        return $net_inc * 0.10;
    } else if ($net_inc <= 37650) {
        return 927.50 + (.15 * ($net_inc - 9275));
    } else if ($net_inc <= 75950) {
        return 5183.75 + (.25 * ($net_inc - 37650));
    } else if ($net_inc <= 115725) {
        return 14758.75 + (.28 * ($net_inc - 75950));
    } else if ($net_inc <= 206675) {
        return 25895.75 + (.33 * ($net_inc - 115725));
    } else if ($net_inc <= 233475) {
        return 55909.25 + (.35 * ($net_inc - 206675));
    } else {
        return 65289.25 + (.396 * ($net_inc - 233475));
    }
}

function incomeTaxHeadOfHousehold($net_inc){
    // calc hh (Head of Househole) amount
    if ($net_inc <= 13250) {
        return $net_inc * 0.10;
    } else if ($net_inc <= 50400) {
        return 1325 + (.15 * ($net_inc - 13250));
    } else if ($net_inc <= 130150) {
        return 6897.50 + (.25 * ($net_inc - 50400));
    } else if ($net_inc <= 210800) {
        return 26835 + (.28 * ($net_inc - 130150));
    } else if ($net_inc <= 413350) {
        return 49417 + (.33 * ($net_inc - 210800));
    } else if ($net_inc <= 441000) {
        return 116258.50 + (.35 * ($net_inc - 413350));
    } else {
        return 125936 + (.396 * ($net_inc - 441000));
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
