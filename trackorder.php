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

$orderID = $_POST['orderID'];

$sql = "SELECT `deliverytime` FROM `delivery` WHERE orderID = ". $orderID . ";";
if($result= mysqli_query($conn, $sql)){
    $deliverytime = [];
    $i = 0;
    
    while($row = mysqli_fetch_assoc($result)) {
        $deliverytime[] = $row['deliverytime'];
        $i++;
    }
    for($a=0;$a<count($deliverytime);$a++){
        //echo $deliverytime[$a] ."<br>";
        //$deliverytime[$a] = date("c",strtotime($deliverytime[$a]));
        //echo $deliverytime[$a];
        //echo "<br> " . $a;
    }
} else {
    echo "Error with SQL";
}

//$today = date("Y-m-d H:i:s", time());

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
                text-align:center;
                font-size: 200%;
                color: #683e06;
                border-bottom: 3px solid #683e06;
            }

            .mid {
                margin: auto;
                height: 600px;
            }

            #desc {
                margin: auto;
                text-align: center;
            }
        </style>
        <script>
            window.time_compare = '<?php echo $deliverytime[0]; ?>';
            function delivery_check(){
                //var mySQLDate = '2015-04-29 10:29:08';
                //new Date(Date.parse(mySQLDate.replace('-','/','g')));        
                window.time_compare = new Date(window.time_compare);
                //alert(window.time_compare);
                window.time_delivering = new Date(window.time_compare.getTime() - 6*60*60*1000);
                if (window.time_compare > new Date()){
                    if(new Date() > window.time_delivering){
                        //alert("Delivering!");
                        document.getElementById("orderstatus").innerHTML = "Delivering! <br><br> Estimated delivery time: &nbsp;" + window.time_compare;   //This one is 6 hours before expected delivery completion
                    }else{
                        //alert("Processing!");
                        document.getElementById("orderstatus").innerHTML = "Processing! <br><br> Estimated delivery time: &nbsp;" + window.time_compare;   //This one is 24~6 hours before expected delivery completion
                    }

                }else {
                    //alert("Delivered!");
                    document.getElementById("orderstatus").innerHTML = "Delivered! <br><br> Time Delivered: &nbsp;</b>" + window.time_compare;        //This is when the current datetime is more than the expected delivery completion
                }
                document.getElementById("deliverytime").innerHTML = window.time_compare;    //use these to show the output in html
                document.getElementById("delivering").innerHTML = window.time_delivering;   //use these to show the output in html
            }

        </script>
    </head>
    <body onload="delivery_check()">
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
                <p><b>ORDER STATUS</b></p>
            </div>
            <div id="desc">
                <p style="color: #683e06"><b>Status of Order #<?php echo $orderID ?>: &nbsp; <span id="orderstatus"><span></p>
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