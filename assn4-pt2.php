<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values

define('TAX_RATES',
    array(
        'Single'=>array(
                'Rates' => array(10,15,25,28,33,35,39.6),
                'Ranges' => array(0, 9275, 37650, 91150, 190150, 413350, 415050 ),
                'MinTax' => array(0,927.50 , 5183.75, 18558.75, 46278.75, 119934.75, 120529.75  )
        ),
        'Married_Jointly'=>array(
            'Rates' => array(10,15,25,28,33,35,39.6),
            'Ranges' => array(0, 18550, 75300, 151900, 231450, 413350, 466950),
            'MinTax' => array(0, 1855, 10367.50,  29517.50, 51791.50, 111818.50, 130578.50  )
        ),
        'Married_Separately'=>array(
            'Rates' => array(10,15,25,28,33,35,39.6),
            'Ranges' => array(0, 9275, 37650,75950, 115725, 206675, 233475  ),
            'MinTax' => array(0, 927.50, 5183.75, 14758.75, 25895.75, 55909.25, 65289.25  )
        ),
        'Head_Household'=>array(
            'Rates' => array(10,15,25,28,33,35,39.6),
            'Ranges' => array(0, 13250, 50400, 130150, 210800, 413350, 441000  ),
            'MinTax' => array(0, 13250, 6897.50, 26835, 49417, 116258.50, 125936 )
        ),

    )
);

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

    $hh_amt = incomeTaxHeadOfHousehold($net_income);



}

function incomeTaxSingle($data){

}

function incomeTaxMarriedJointly($data){

}

function incomeTaxMarriedSeparately($data){

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

    foreach(constant('TAX_RATES') as $tax_status => $tax_rate ){
        echo '<h1> Tax Status is '. $tax_status. '</h1><br>';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Taxable Income</th>';
        echo '<th>Tax Rate</th>';
        echo '</tr>';

        $rates = $tax_rate['Rates'];
        $ranges = $tax_rate['Ranges'];
        $min_tax = $tax_rate['MinTax'];
        for($x = 0; $x < count($rates); $x++ ){
            echo '<tr>';
            if ($x == 0){
                echo '<td> ' . $ranges[$x] . ' - ' . $ranges[$x + 1] . '</td>';
                echo '<td>' . $rates[$x] . '%</td>';
            }
            else if($x == (count($rates) - 1)){
                echo '<td> $' . $ranges[$x] . ' or more </td>';
                echo '<td> $' . $min_tax[$x] . ' plus '. $rates[$x] . '% of the amoubt over $' . $ranges[$x] . '  </td>';
            } else {
                echo '<td> ' . $ranges[$x] . ' - ' . $ranges[$x + 1] . '</td>';
                echo '<td> $' . $min_tax[$x] . ' plus '. $rates[$x] . '% of the amoubt over $' . $ranges[$x] . '  </td>';
            }
            echo '</tr>';
            //echo '<p> Curr Rate is ' . $rates[$x] . '</p><br>';
        }

        echo '</tbody>';
        echo '</table>';


?>

</body>
</html>
