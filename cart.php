<?php
    #connection to mySQL
    # select * from menu
    # select * from menuC
    # fill arrays with menu info

    # only when someone presses the 'submit order' button on the checkout page, then the orderID value will be updated to +1
    # checkout to contain requested delivery time (cannot be same day delivery)

session_start();
if (!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}
if (!isset($_SESSION['qty'])){
	$_SESSION['qty']= array();
}

if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['qty']);
	header('location: ' . $_SERVER['PHP_SELF']);
	exit();
}

if (isset($_GET['delete'])) {
    $i = $_GET['delete'];
	unset($_SESSION["cart"][$i]);
	unset($_SESSION["qty"][$i]);
	#$_SESSION['cart'][] = $_GET['buy'];
	header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
	exit();
}
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
?>
<html lang="en">
<head>
<title>Shopping Cart</title>
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

    #desc table {
        margin: auto;
        text-align: center;
        color: #683e06;
    }

    #desc th, td, tr {
        padding: 5px;
        font-size: 115%
    }

    #desc input[type="submit"] {
        margin: auto;
        text-align: center;
    }

    .mid {
        margin: auto;
        height: 1130px;
    }

    #desc table thead tr, tfoot tr {
        background-color: #d3b792d8;
    }

    #desc table tbody tr {
        background-color: #dfccb3d8;
    }

    #desc table, tr{
        border: 2px solid #683e06;
    }

    #desc input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }

    #desc input[type="number"] {
        width: 100px;
        height: 30px;
        border-radius: 5px;
        font-size: 80%;
    }

    #desc input[type="submit"] {
        width: 80px;
        height: 30px;
        margin-top: 10px;
        font-size: 55%;
        border-radius: 5px;
        color: #683e06;
    }

    #desc input[type="button"] {
        width: 80px;
        height: 30px;
        margin-top: 10px;
        font-size: 55%;
        border-radius: 5px;
        color: #683e06;
    }

    #desc table tbody #delete {
        color: #683e06;
    }

    .tablenav {
        text-align: right;
    }

    body {
        background-color: #bdc0c9;
        background-image: url('background3.jpg');
        background-size: auto;
        background-repeat: no-repeat;
    }
</style>
</head>
<?php
    echo "<script type='text/javascript'>
    window.cart_list_quantity = new Array;
    window.cart_list_price = new Array;
    window.looplength = ".count($menuID).";
    </script>";
    for($a=0; $a < count($menuID); $a++){
        echo "<script type='text/javascript'>
        window.cart_list_quantity[". $a ."] = ". $_SESSION['qty'][$a] .";
        window.cart_list_price[". $a ."] = " . $price[$a] . ";
        </script>";
    }
?>
<script>
    function add(accumulator, a) {
        return accumulator + a;
    }
    window.price_calc = new Array();
    window.totalp = 0.0;
    var total = 0.0;
    //On load, cart quantities loaded

    function qty_edit(qtyid, value){
        
        for(var i=0;i<window.looplength;i++){
            boxnumber = "box"+i;
            qtyboxnumber = "qtybox"+i;
            if(document.getElementById(qtyboxnumber) != null){
                var qtynum = document.getElementById(qtyboxnumber).value;
            }
            if(document.getElementById(boxnumber) != null){
                if(document.getElementById(boxnumber).checked == true){
                    window.price_calc[i] = window.cart_list_price[i]*qtynum;
                    //alert(window.price_calc[i]);
                } else {
                    window.price_calc[i] = 0;
                }
                
            }
        }
        const total = window.price_calc.reduce(add,0);
        //alert(total);
        
        //alert("WHY");
        
        //alert("WHY");
        document.getElementById("total").innerHTML = '$' + total;
    }

    function enable() {
        var numrows = document.getElementById("cartlist").rows.length;
        if(numrows >= 3) {
            document.getElementById("message").innerHTML = "<b>Please Select An Item To Checkout.</b>";
            document.getElementById("message").style.color = "#e0150e";
            document.getElementById("cout").style.border = "2px solid #e0150e";
            check();
        } else {
            return false;
        }                
    }

    function check() {
        var totalString = document.getElementById("total").innerHTML;
        var total = parseFloat(totalString.substring(1));
        if(total == 0) {
            document.getElementById("message").innerHTML = "<b>Please Select An Item To Checkout.</b>";
            document.getElementById("message").style.color = "#e0150e";
            document.getElementById("cout").style.border = "2px solid #e0150e";
            document.getElementById("cout").disabled = true;
            return false;
        } else {
            document.getElementById("cout").type = "submit";
            document.getElementById("cout").removeAttribute("disabled");
            document.getElementById("message").innerHTML = "";
            document.getElementById("message").style.color = "";
            document.getElementById("cout").style.border = "";
            return true;
        }
    }
</script>
<body onload="enable()">
<div class="wrapper">
<div class="top">
                        <header>
                            <div id="navigation">
                                <a href="index.html">
                                    <img src="logo2.png" id="logo" alt="Home" style="width:300px;height:150px;border:0;">
                                </a>
                                <div class="tablenav">
                                    <table align="right" id="navbar">
                                        <tr>
                                            <td colspan="2"></td>
                                            <td align="right"><a href="cart.php" id="cart"><img src="cart.png" alt="Cart" style="width: 50px; height: 50px; border:0;"></a></td>
                                        </tr>
                                        <tr align="center">
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
                <b><p>YOUR CART</p></b>
            </div>
            <div id="desc">
<table border="1" id="cartlist">
	<thead>
	<tr>
        <th>Delete</th>
        <th>Selected</th>    
		<th>Item Description</th>
        <th>Quantity</th>
		<th>Price</th>
	</tr>
	</thead>
	<tbody>
    <form action="checkout.php" method="post">
<?php
$total = 0;
for ($i=0; $i < count($menuID/*$_SESSION['cart']*/); $i++){
    if (!empty($_SESSION['qty'][$i])) {
        echo "<tr>";
        echo "<td><a href='" .$_SERVER['PHP_SELF']. '?delete=' . $i . "' id='delete'>Delete</a></td>";
        echo "<td><input type=\"checkbox\" name=\"box" . $i . "\" id=\"box" . $i . "\" value='0' onclick=\"qty_edit('" . $i . "', this.value)\" onchange=\"check()\"></td>";        
        echo "<td>" .$foodname[$_SESSION['cart'][$i]]. "</td>";
        echo "<td><input type=\"number\" name=\"qtybox" . $i . "\" id=\"qtybox" . $i . "\" min='1' value='" . $_SESSION['qty'][$i] . "' onchange=\"qty_edit('" . $i . "', this.value)\"></td>";
        echo "<td align='right'". $i .">$";
        echo number_format($price[$_SESSION['cart'][$i]], 2). "</td>";
        echo "</tr>";    
    }
    #echo "<tr>";
    #echo "<td>" .$_SESSION['cart'][$i]['buy']
    $box = 'box' . $i;
	#$total = $total + $price[$_SESSION['cart'][$i]];
}

?>
	</tbody>
	<tfoot>
	<tr>
		<th align='right' colspan="4">Total:</th><br>
		<td align='right'><p id="total">$0</p>
		</td>
	</tr>
	</tfoot>
</table>
<p id='message' style="font-size: 80%;"><p>
<p id="checkout"><input id='cout' type='button' value='Checkout!' disabled></p>
</form>
<div>
<p><a href="classic.php" style="font-size: 70%; color: #683e06;">Continue Shopping</a> &nbsp;  &nbsp;
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1" style="font-size: 70%; color: #683e06;">Empty your Cart</a></p>
</div>
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