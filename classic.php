<?php //catalog.php
session_start();
if (!isset($_SESSION['cart'])){
	$_SESSION['cart']= array();
}

if (!isset($_SESSION['qty'])){
	$_SESSION['qty']= array();
}

if (isset($_GET['buy'])) {
	$i = $_GET['buy'];
	$qty = $_SESSION["qty"][$i] + 1;
	$_SESSION["cart"][$i] = $i;
	$_SESSION["qty"][$i] = $qty;
	#$_SESSION['cart'][] = $_GET['buy'];
	header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
	exit();
}

// function add_to_cart($id){
// 	if (in_array($_GET['buy'], $_SESSION['cart'][]){
// 		echo "test";
// 		#$_SESSION['qty'][$id] = $_SESSION['qty'][$id + 1];
// 	}
// }

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
<!doctype html>
<html lang="en">
    <head>
        <title>JHYJCakes</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="JHYJCSS.css">
        <style>
            #contenttitle {
                margin-top: 30px;
                margin-bottom: 50px;
                padding: 20px 20px;
                text-align:center;
                font-size: 200%;
                color: #683e06;
                border-bottom: 3px solid #683e06;
            }
            
            #contenttitle table {
                text-align:center;
                width: 800px;
                background-color: #dfccb3d8;
                margin: auto;
                margin-bottom: 30px;
                box-shadow: 3px 3px 3px #683e06;
            }

            #contenttitle a {
                text-decoration: none;
                color:#683e06;
            }

            #contenttitle td {
                padding: 5px 5px;
            }

            #contenttitle td:nth-of-type(odd) {
                background-color: #d3b792d8;
                border-right: 4px solid #683e06;
            }
            
            #desc p {
                padding-bottom: 30px;
                text-align: center;
                color: #683e06;
            }

            #desc table {
                margin: auto;
                text-align: center;
                color: #683e06;
            }

            #desc table tr:nth-of-type(odd) {
                background-color: #d3b792d8;
            }

            #desc table tr:nth-of-type(even) {
                background-color: #dfccb3d8;
            }

            #desc td {
                padding: 10px;
            }

            .mid {
                height: 2600px;
                margin: auto;
            }

            #menu {
                border-bottom: 2px solid #683e06;
            }

            body {
                background-color: #bdc0c9;
                background-image: url('background3.jpg');
                background-size: auto;
                background-repeat: no-repeat;
            }

            #buy {
                color: #683e06;
            }

            #classic:hover, #custom:hover {
                opacity: 0.7;
            }
        </style>
    </head>
    <body>
        <script>
            function show(n) {
                var i;
                var x = document.getElementsByClassName("imgs");
                window.style.display = "block"
                x[n].style.display = "block";
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
                <table border="0">
                    <tr>
                        <td>
                            <a href="classic.php" style="color: #683e06;" id="classic"><b>CLASSIC MENU</b></a>
                        </td>
                        <td>
                            <a href="custom.php" id="custom">CUSTOM MENU</a>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="desc">
                <p>View our collection of pre-made cakes here on our classic menu.</p>
                <table border="0">
                    <tbody>
					<?php
					$cake_images = [];
					$cake_images[] = "<img src=\"vanillabutter.jpg\" alt=\"vanillabutter\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(0)\">";
					$cake_images[] = "<img src=\"chocolateoreo.jpg\" alt=\"chocolateoreo\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(1)\">";
					$cake_images[] = "<img src=\"fruityberries.jpg\" alt=\"fruityberries\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(2)\">";
					$cake_images[] = "<img src=\"creamycheese.jpg\" alt=\"creamycheese\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(3)\">";
					$cake_images[] = "<img src=\"durian.jpg\" alt=\"deliciousdurian\" id=\"featured1\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(4)\">";
					$cake_images[] = "<img src=\"biscoff.jpg\" alt=\"boldbiscuit\" id=\"featured2\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(5)\">";
					$cake_images[] = "<img src=\"matcha.jpg\" alt=\"mainlymatcha\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(6)\">";
					$cake_images[] = "<img src=\"blackforest.jpg\" alt=\"blackforest\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(7)\">";
					$cake_images[] = "<img src=\"strawberryshortcake.jpg\" alt=\"strawberryshortcake\" class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(8)\">";
					$cake_images[] = "<img src=\"logcake.jpg\" alt=\"christmascake\" id=\"featured3\"class=\"imgs\" style=\"width: 250px; height: 200px;\" onmouseover=\"show(9)\">";
					$cake_desc = [];
					$cake_desc[] = "Butter flavoured cake with a smooth topping of sweet vanilla.";
					$cake_desc[] = "A combination of chocolate and crushed oreo.";
					$cake_desc[] = "Berry nice to fill up your belly with berries!";
					$cake_desc[] = "Crusty cheese cake with a generous topping of cream cheese, topped with berries.";
					$cake_desc[] = "A flavourful durian cake made from Mao Shan Wang durians. Definitely irresistible for durian lovers!";
					$cake_desc[] = "Love Biscoff? You will love this!";
					$cake_desc[] = "A cake made from the finest of Japanese matcha.";
					$cake_desc[] = "A great choice to excite the palette of chocolate enthusiast.";
					$cake_desc[] = "";
					$cake_desc[] = "Our Christmas Special!<br>A spongey chocolate cake topped with toffee cream, an absolutely brilliant choice for the festive season.";
						for ($i=0; $i<count($menuID); $i++){
							echo "<tr>";
							echo "<td>" .$foodname[$i]. "</td>";
							echo "<td>" .$cake_images[$i]. "</td>";
							echo "<td>" .$cake_desc[$i] . "</td>";
							echo "<td>$" .number_format($price[$i], 2). "</td>";
							echo "<td><a href='" .$_SERVER['PHP_SELF']. '?buy=' . $i . "' id='buy'>Add to Cart</a></td>";
							echo "</tr>";
							}
						?>
                    </tbody>
                </table>
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

<!--https://www.istockphoto.com/sg/photos/chocolate-cake?sort=mostpopular&mediatype=photography&phrase=chocolate%20cake-->
<!--https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.8days.sg%2Featanddrink%2Frecipes%2Fone-durian-and-gula-melaka-cake-to-rule-them-all-10068174&psig=AOvVaw23gwFrIVrZlhGOKgfIk2pH&ust=1572256271084000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKjws5yVvOUCFQAAAAAdAAAAABAD-->
<!--https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.foodline.sg%2Fcatering%2FEatzi-Gourmet-Catering%2F8794-Christmas-Specialty-(Turkeys-Log-Cakes-Platters)%2FAlaCarteOrderP%2F33493-Chocolate-Velvet-Logcake%2F&psig=AOvVaw0ml3kY1ONRxV1eg0U9sQYN&ust=1572255850975000&source=images&cd=vfe&ved=0CAMQjB1qFwoTCLjAxNSTvOUCFQAAAAAdAAAAABAD-->
<!--https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.belsizecakeshop.co.uk%2Fproduct-page%2Fbiscoff-craze&psig=AOvVaw0D21fW6rjyBopX6WTOG8W4&ust=1572256068362000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCLCu28eUvOUCFQAAAAAdAAAAABBa-->