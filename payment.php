<!DOCTYPE html>
<html>

<head>
    <title>Payment Continue</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/fonts/sb-bistro/sb-bistro.css" rel="stylesheet" type="text/css">
    <link href="assets/fonts/font-awesome/font-awesome.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/css/theme.css">


</head>

<body>

<body class="credit-card-body">
    <div class="credit-card-container">
        <form   >
            <p>Credit Card Payment</p>
            <label for="cardNumber">Credit Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX" maxlength="16" pattern="[0-9]{16}" required>

            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" maxlength="5" pattern="[0-9/]" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" placeholder="XXX" maxlength="3" required>

            <a class="btn btn-success text-white" href="order.php">Payment<a>
        </form>
    </div>
    
</body>


</html>


