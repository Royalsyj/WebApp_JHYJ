<?php
	session_start();
	if (!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	if (!isset($_SESSION['qty'])){
		$_SESSION['qty']= array();
	}
	
	$deletecart = unserialize($_POST["delete"]);
	$orderID = unserialize($_POST["orderID"]);

	$custname = $_POST["custname"];
	$custaddress = $_POST["custaddress"];
	$custphone = $_POST["custphone"];
	$custemail = $_POST["custemail"];

	for($i=0;$i<count($deletecart);$i++){
		$a = $deletecart[$i];
		unset($_SESSION["cart"][$a]);
		unset($_SESSION["qty"][$a]);
	}

	$sqlall = unserialize($_POST["sqlall"]);
	$sqlorders = unserialize($_POST["sqlorders"]);

	$servername = "localhost";
    $username = "f31ee";
    $password = "f31ee";
    $dbname = "f31ee";
	
	$print_success = TRUE;
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo "<script type='text/javascript'>alert('Connecting to database failed!');</script>";
		die("Connection failed: " . mysqli_connect_error());
		$print_success = FALSE;
	}
	
	for($i=0;$i<count($sqlorders);$i++){
		$sql = $sqlorders[$i];
		if ($result=mysqli_query($conn,$sql)) {
			//echo "Insert sqlall success.";
		} else{
			echo "Error inserting sqlorders record!";
			$print_success = FALSE;
		}
	}
	
	for($i=0;$i<count($sqlall);$i++){
		$sql = $sqlall[$i];
		if ($result=mysqli_query($conn,$sql)) {
			//echo "Insert sqlall success.";
		} else{
			echo "Error inserting sqlall record!";
			$print_success = FALSE;
		}
	}

	$sql = "INSERT INTO `customers` (orderID, name, address, phone, email) VALUES (".$orderID.", ". $custname . ", ". $custaddress .", ". $custphone .", ". $custemail .")";
	if ($result=mysqli_query($conn,$sql)) {
		//echo "Insert sqlall success.";
	} else{
		echo "Error inserting record!";
		$print_success = FALSE;
	}
	//header("refresh:1; url=classic.php");

?>
<!doctype html>
<html lang="en">
    <head>
        <title>JHYJCakes Checkout Success</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="JHYJCSS.css">
        <style>
            #contenttitle {
                margin-top: 30px;
                margin-bottom: 50px;
                text-align:left;
                font-size: 200%;
                color: #683e06;
                border-bottom: 3px solid #683e06;
            }

            #desc {
                font-size: 100%;
                padding-bottom: 30px;
                text-align: center;
                color: #683e06;
            }

            .mid {
                margin: auto;
                height: 600px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
        <div class="top">
        <header>
            <div id="navigation">
                <a href="index.html">
                    <img src="logo2.png" alt="Home" id="logo" style="width:300px;height:150px;border:0;">
                </a>
                <div class="tablenav">
                    <table align="right" id="navbar">
                        <tr>
                            <td colspan="2"></td>
                            <td align="right"><a href="cart.php" id="cart"><img src="cart.png" alt="Cart" style="width: 50px; height: 50px; border:0;"></a></td>
                        </tr>
                        <tr>
                            <td><div class="dropmenu" id="menu">
                                <b>MENU</b>
                                <div class="dropcontent">
                                    <b><a href="classic.php">CLASSIC</a></b>
                                    <b><a href="custom.php">CUSTOM</a></b>
                                </div>
                            </div></td>
                            <td><b><a href="track.html">TRACK ORDER</a></b></td> &nbsp;
                            <td><b><a href="about.html">ABOUT US</a></b></td> &nbsp;
                        </tr>
                    </table>
                </div>              
            </div>
        </header>
        </div>
        <div class="mid">
            <div id="contenttitle">
                <p><b>CHECKOUT SUCCESSFUL</b></p>
            </div>
            <div id="desc">
                <p><b>Your Order Number is: &nbsp; <?php echo $orderID; ?></b></p>
                <p>An email has been sent to you. <br> You may use this number to track your order progress.</p>
            </div>
        </div>
        </div>
        <div class="bot">
        <footer>
            <hr>
            <br>
            <div id="tm">
                <small><i><b>Copyright &copy; 2019 JHYJCakes</b></i></small>
            </div>
            <div id="links"><b>
                <a href="about.html#left">CONTACT US</a> &nbsp; &nbsp;
                <a href=""></a>
            </b></div>
        </footer>
        </div>
    </body>
</html>