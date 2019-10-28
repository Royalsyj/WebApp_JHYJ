<?php

    $servername = "localhost";
    $username = "f31ee";
    $password = "f31ee";
    $dbname = "f31ee";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo "<script type='text/javascript'>alert('Connecting to database failed!');</script>";
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM `menu`";
    if($result= mysqli_query($conn, $sql)){
        #$num_rows = mysql_num_rows($result);
        $num_rows = mysqli_num_rows($result);       #for home use cos PHP 7
        $menuID = array_fill(0, $num_rows, 0);
        $foodname = array_fill(0, $num_rows, 0);
        $price = array_fill(0, $num_rows, 0);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            #echo $row['timestamp'] . "<br>";
            #echo $row['OrderID'] . "<br>";
            $menuID[$i] = $row['menuID'];
            $foodname[$i] = $row['foodname'];
            $price[$i] = $row['price'];
            $i++;
        }
    }
    $box = array_fill(0, count($menuID), 0);
    for($a=0;$a<count($menuID);$a++){
        if($_POST['box' . $a] == '0'){
            $box[$a] = $_POST['qtybox'. $a];
            #echo $box[$a] . "<br>";
        }    
    }
    $sql = "SELECT orderID FROM `orders` ORDER BY OrderID DESC LIMIT 1";
    if($result= mysqli_query($conn, $sql)){
        while($row = mysqli_fetch_assoc($result)) {
            $orderID = $row["orderID"] + 1;
        }
    }
    #echo $orderID;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout Page</title>
<meta charset="utf-8">
<link rel="stylesheet" href="JHYJCSS.css">
<style>
    #contenttitle {
        margin-top: 30px;
        margin-bottom: 50px;
        text-align:center;
        font-size: 200%;
        color: #683e06;
        border-bottom: 3px solid #683e06;
    }

    #desc {
        font-size: 130%;
        padding-bottom: 30px;
        text-align: center;
        color: #683e06;
    }

    #desc #coutlist {
        margin: auto;
        text-align: center;
        color: #683e06;
        border: 2px solid #683e06;
    }

    #coutlist th, #coutlist td, #coutlist tr {
        padding: 5px;
        font-size: 90%
    }

    .mid {
        height: 1400px;
    }
    
    #custDet {
        font-size: 70%;
        color: #683e06;
        width: 580px;
        background-color: #e6dde4a6;
        padding: 10px;
        text-align: center;
        margin: auto;
    }

    #custDet th, #custDet td {
        padding: 10px;
    }

    body {
        background-color: #bdc0c9;
        background-image: url('background3.jpg');
        background-size: auto;
        background-repeat: no-repeat;
    }

    input[type="text"], input[type="email"] {
        width: 200px;
        height: 18px;
        font-size: 80%;
    }

    #pay {
        width: 70px;
        height: 30px;
        font-size: 80%;
        color: #683e06;
        border-radius: 5px;
        margin-top: 5px;
    }

    #coutlist thead tr, #coutlist tfoot tr {
        background-color: #d3b792d8
    }

    #coutlist tbody tr {
        background-color: #dfccb3d8;
    }

</style>
</head>
<body onload="reset()">
    <script>
        var name = document.getElementById("custname");
        var add = document.getElementById("custaddress");
        var email = document.getElementById("custemail");
        var num = document.getElementById("custphone");

        function reset() {//form reset
            document.getElementById("myform").reset();
        }

        function validateName() { //validate name
            var name = document.getElementById("custname");
            var regexp = /^[A-Za-z\s]{1,}$/; //At least one alphabetical chracters
            if(name.value.length > 0) {
                if(regexp.test(name.value) == false) {
                    document.getElementsByClassName("message")[0].innerHTML = "Invalid Name!";
                    document.getElementById("custname").style.border = "2px solid #e0150e";
                    document.getElementsByClassName("message")[0].style.color = "#e0150e";
                    document.getElementById("pay").disabled = true;
                    return false;
                } else {
                    document.getElementsByClassName("message")[0].innerHTML = "";
                    document.getElementById("custname").style.border = "2px solid green";
                    document.getElementById("pay").disabled = false;
                    return true;
                }
            } else {
                document.getElementsByClassName("message")[0].innerHTML = "Only Alphabetical Characters";
                document.getElementsByClassName("message")[0].style.color = "";
                document.getElementById("custname").style.border = "";
            }
        }

        function validateAdd() { //validate address
            var add = document.getElementById("custaddress");
            var regexp = /^([\w][\s]){1,}$/; //at least one word char/whitespace

            if(add.value.length > 0) {
                if(regexp.test(add.value)) {
                    document.getElementsByClassName("message")[1].innerHTML = "Invalid Address!";
                    document.getElementById("custaddress").style.border = "2px solid #e0150e";
                    document.getElementsByClassName("message")[1].style.color = "#e0150e";
                    document.getElementById("pay").disabled = true;
                    return false;
                } else {
                    document.getElementsByClassName("message")[1].innerHTML = "";
                    document.getElementById("custaddress").style.border = "2px solid green";
                    document.getElementById("pay").disabled = false;
                    return true;
                }
            } else {
                document.getElementsByClassName("message")[1].innerHTML = "";
                document.getElementsByClassName("message")[1].style.color = "";
                document.getElementById("custaddress").style.border = "";
            }
        }

        function validateEmail() { //validate email
            var email = document.getElementById("custemail");
            var regexp = /^[\w.-]+@([A-Za-z]+\.){1,3}[A-Za-z]{2,3}$/; //word charcters before @ and at least 2 and max 4 extensions
                                                                      //last extension must be 2-3 characters
            if(email.value.length > 0) {
                if(regexp.test(email.value) == false) {
                    document.getElementsByClassName("message")[2].innerHTML = "Invalid Email!";
                    document.getElementById("custemail").style.border = "2px solid #e0150e";
                    document.getElementsByClassName("message")[2].style.color = "#e0150e";
                    document.getElementById("pay").disabled = true;
                    return false;
                } else {
                    document.getElementsByClassName("message")[2].innerHTML = "";
                    document.getElementById("custemail").style.border = "2px solid green";
                    document.getElementById("pay").disabled = false;
                    return true;
                }
            } else {
                document.getElementsByClassName("message")[2].innerHTML = "@ Required";
                document.getElementsByClassName("message")[2].style.color = "";
                document.getElementById("custemail").style.border = "";
            }
        }

        function validatePhone() { //validate phone no.
            var num = document.getElementById("custphone");
            var regexp = /^[0-9]{8}$/; //can only enter exactly 8 numbers

            if(num.value.length > 0) {
                if(regexp.test(num.value) == false) {
                    document.getElementsByClassName("message")[3].innerHTML = "Invalid Contact Number!";
                    document.getElementById("custphone").style.border = "2px solid #e0150e";
                    document.getElementsByClassName("message")[3].style.color = "#e0150e";
                    document.getElementById("pay").disabled = true;
                    return false;
                } else {
                    document.getElementsByClassName("message")[3].innerHTML = "";
                    document.getElementById("custphone").style.border = "2px solid green";
                    document.getElementById("pay").disabled = false;
                    return true;
                }
            } else {
                document.getElementsByClassName("message")[3].innerHTML = "Exactly 8 numbers";
                document.getElementsByClassName("message")[3].style.color = "";
                document.getElementById("custphone").style.border = "";
            }
        }
    </script>
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
                                            <td><div class="dropmenu">
                                                <b>MENU</b>
                                                <div class="dropcontent">
                                                    <b><a href="classic.php">CLASSIC</a></b>
                                                    <b><a href="custom.php">CUSTOM</a></b>
                                                </div>
                                            </div></td>
                                            <td><b><a href="track.html">TRACK ORDER</a></b></td> &nbsp;
                                            <td><b><a href="about.html" id="about">ABOUT US</a></b></td> &nbsp;
                                        </tr>
                                    </table>
                                </div>              
                            </div>
                        </header>
                    </div>
                    <div class="mid">
                    <div id="contenttitle">
                <b><p>CHECKOUT</p></b>
            </div>
            <div id="desc">
            <p><a href="cart.php" style="font-size: 70%; color: #683e06;">Back to Cart</a></p>
<form action="checkout_success.php" method="post" id="myform">
<table border="1" name="coutlist" id="coutlist">
	<thead>
	<tr>
		<th>Item Description</th>
        <th>Quantity</th>
		<th>Price</th>
	</tr>
	</thead>
    <tbody>
<?php
$total = 0;
$sqlall = [];
$sqlorders = [];
$deletecart = [];
$d_timestamp = date("Y-m-d H:i:s", time() + 86400);
echo '<p id="couttime" style="font-size: 80%; color: #683e06;"><b>Checkout Time:</b> &nbsp; <span id="time"> '.$d_timestamp.'</span></p>';
for ($i=0; $i<count($menuID); $i++){
    $j = $i + 1;
    if(!empty($box[$i])){
        echo "<tr>";
        echo "<td>" .$foodname[$i]. "</td>";
        echo "<td>" .$box[$i]. "</td>";
        echo "<td>$" .number_format($price[$i], 2)*$box[$i]. "</td>";
        echo "</tr>";
        $total = $total + number_format($price[$i], 2)*$box[$i];
        $sqlall[] = "INSERT INTO `orderdetails` (orderID, menuID, size, shape, topping, layer1, layer2, layer3, quantity) VALUES (".$orderID.", ".$j.", 0,0,0,0,0,0, ".$box[$i]." );";
        $deletecart[] = $i;
    }
}
$sqlorders[] = "INSERT INTO `orders` (amount) VALUES  (" . $total. ");";
$sqlorders[] = "INSERT INTO `delivery` (orderID, deliverytime) VALUES (" . $orderID . ", '".$d_timestamp."');";
echo "</tbody><tfoot>
        <tr>
		<td align='right' colspan='2'><b>Total Due:</b></td>
		<td>$".$total."</td>
        </tr>
    </tfoot>";
?>     
</table>
<br>
    <table border="0" name="custDet" id="custDet">
        <tr align='left'>
            <td colspan='2' align='left' style="font-size: 120%; color: #683e06;"><b>Customer Credentials</b></td>
        </tr>
        <tr>
            <td align='right'>Name:</td>
            <td align="left"><input type="text" name="custname" id="custname" oninput="validateName()" required></td>
            <td align="left" class="message" style="font-size: 70%;">Only Alphabetical Characters</td>
        </tr>
        <tr>
            <td align='right'>Delivery Address:</td>
            <td align="left"><input type="text" name="custaddress" id="custaddress" oninput="validateAdd()" required></td>
            <td align='left' class="message" style="font-size: 70%;"></td>
        </tr>
        <tr>
            <td align='right'>Email:</td>
            <td align="left"><input type="email" name="custemail" id="custemail" oninput="validateEmail()" required></td>
            <td align='left' class="message" style="font-size: 70%;">@ Required</td>
        </tr>
        <tr>
            <td align='right'>Contact Number:</td>
            <td align="left"><input type="text" name="custphone" id="custphone" oninput="validatePhone()" required></td>
            <td align='left' class="message" style="font-size: 70%;">Exactly 8 Numbers</td>
        </tr>
    </table>
    <input type="submit" id="pay" value="Pay!" disabled>
    <input type='hidden' name='sqlall' value="<?php echo htmlentities(serialize($sqlall)); ?>" >
    <input type='hidden' name='sqlorders' value="<?php echo htmlentities(serialize($sqlorders)); ?>" >
    <input type='hidden' name='delete' value="<?php echo htmlentities(serialize($deletecart)); ?>" >
    <input type='hidden' name='orderID' value="<?php echo htmlentities(serialize($orderID)); ?>" >
</form>
<p style="font-size: 60%; color: #683e06;"><i>All prices are in imaginary dollars.</i></p>
<?php
	#echo 'hi '. htmlspecialchars($_SESSION['cart'][10]);
?>
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