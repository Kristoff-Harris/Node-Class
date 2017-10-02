<?php
    // get the data from the form
    $net_income = filter_input(INPUT_POST, 'net_income',
        FILTER_VALIDATE_FLOAT);
    //$interest_rate = filter_input(INPUT_POST, 'interest_rate',
    //    FILTER_VALIDATE_FLOAT);
    //$years = filter_input(INPUT_POST, 'years',
    //    FILTER_VALIDATE_INT);

    // validate investment
    if ($net_income === FALSE ) {
        $error_message = 'Net Income must be a valid number.';
    } else if ( $net_income <= 0 ) {
        $error_message = 'Net Income must be greater than zero.';
    // validate interest rate
    } else if ( $net_income === FALSE )  {
        $error_message = 'Net Income must be a valid number.';
    } else if ( $net_income <= 0 ) {
        $error_message = 'Interest rate must be greater than zero.'; 
    // validate years
    } else if ( $net_income === FALSE ) {
        $error_message = 'Years must be a valid whole number.';
    } else if ( $net_income <= 0 ) {
        $error_message = 'Years must be greater than zero.';
    } else {
        $error_message = ''; 
    }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('example.php');
        exit(); 
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


?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Income Tax Calculator</h1>

        <h4>With a net taxable income of <?php echo $net_income ?> </h4>

        <label>Single Status Tax:</label>
        <span><?php echo $single_tax_amt; ?></span><br>

        <label>Married Filing Jointly:</label>
        <span><?php echo $mfj_amt; ?></span><br>

        <label>Married Filing Separately:</label>
        <span><?php echo $mfs_amt; ?></span><br>

        <label>Head of Household:</label>
        <span><?php echo $hh_amt; ?></span><br>

        <!-- <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br> -->
    </main>
</body>
</html>
