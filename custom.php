<?php
    # connect to mySQL
    # select * from menuC
    # save 3 arrays, customID, modname, price
    # bring arrays over to JS for client side loading
    # form submission should have html input id using/following customID to cart via session?!
    # or from this page submit to another php file via form then through that php file create/update session for add to cart

    # https://stackoverflow.com/questions/15979952/shopping-cart-session-php

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

            #classic:hover, #custom:hover {
                opacity: 0.7;
            }

            .mid {
                margin: auto;
                height: 1000px;
            }

            #desc p {
                padding-bottom: 30px;
                text-align: center;
                color: #683e06;
            }

            #desc table {
                margin: auto;
                text-align: center;
                width: 850px;
                color: #683e06;
            }

            #choices td {
                padding: 10px;
                padding: 15px 15px;
            }

            #desc table tr:nth-of-type(odd) {
                background-color: #d3b792d8;
            }

            #desc table tr:nth-of-type(even) {
                background-color: #dfccb3d8;
            }

            #menu {
                border-bottom: 2px solid #683e06;
            }

            #reg, #large, #round, #square {
                height: 20px;
                width: 20px;
            }

            #oreo, #fruits, #mnm, #biscoff {
                height: 20px;
                width: 20px;
            }

            .droplist {
                height: 30px;
                border: 2px solid #683e06;
            }

            .message {
                font-size: 80%;
            }

        </style>
    </head>
    <body>
        <div class="wrapper">
        <div class="top">
        <header>
            <div id="navigation">
                <a href="index.html">
                    <img src="logo2.png" alt="Home" style="width:300px;height:150px;border:0;">
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
                            <a href="classic.php" id="classic">CLASSIC MENU</a>
                        </td>
                        <td>
                            <a href="custom.php" style="color: #683e06;" id="custom"><b>CUSTOM MENU</b></a>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="desc">
                <p>Choose from our wide range of choices to customise your cake.</p>
                <table border="0" id="choices">
                    <tbody>
                        <tr>
                            <td class="title" width="15%" style="font-size: 120%;">Size:</td>
                            <td align="left" style="font-size: 100%;"><input type="radio" name="size" id="reg">&nbsp;Regular &nbsp; &nbsp;<input type="radio" name="size" id="large">&nbsp;Large</td>
                            <td class="message">Choose the size!</td>
                        </tr>
                        <tr>
                            <td class="title" style="font-size: 120%;">Shape:</td>
                            <td align="left" style="font-size: 100%;"><input type="radio" name="shape" id="round">&nbsp;Round &nbsp; &nbsp;<input type="radio" name="shape" id="square">&nbsp;Square</td>
                            <td class="message">Choose the shape!</td>
                        </tr>
                        <tr>
                            <td class="title" style="font-size: 120%;">Toppings:</td>
                            <td align="left" style="font-size: 100%;"><input type="checkbox" name="top[]" id="oreo">Oreo Cookies &nbsp; &nbsp;<input type="checkbox" name="top[]" id="fruits">Fruits <br><input type="checkbox" name="top[]" id="mnm">M&M Chocolates &nbsp; &nbsp;<input type="checkbox" name="top[]" id="biscoff">Crushed Biscoff</td>
                            <td class="message">Choose your toppings!</td>
                        </tr>
                        <tr>
                            <td class="title" style="font-size: 120%;">Cream:</td>
                            <td align="left">
                                <select style="font-size: 80%; color: #683e06;" id="cream" class="droplist">
                                    <option value="creambutter" selected>Butter Cream</option>
                                    <option value="cheesecream">Cream Cheese</option>
                                    <option value="choccream">Chocolate Cream</option>
                                    <option value="strawberry">Strawberry Cream</option>
                                    <option value="icing">Royal Icing</option>
                                </select>
                            </td>
                            <td class="message">Choose your coating!</td>
                        </tr>
                        <tr>
                            <td class="title" style="font-size: 120%;">Layering:</td>
                            <td align="left">
                                Base Layer: &nbsp;
                                <select style="font-size: 80%; color: #683e06;" id="first" class="droplist">
                                    <option value="butter" selected>Butter</option>
                                    <option value="choc">Chocolate</option>
                                    <option value="toffee">Toffee</option>
                                    <option value="cheese">Cheese</option>
                                    <option value="velvet">Red Velvet</option>
                                    <option value="matcha">Matcha</option>
                                </select>
                                <br><br>
                                2nd Layer: &nbsp;
                                <select style="font-size: 80%; color: #683e06;" id="first" class="droplist">
                                    <option value="butter" selected>Butter</option>
                                    <option value="choc">Chocolate</option>
                                    <option value="toffee">Toffee</option>
                                    <option value="cheese">Cheese</option>
                                    <option value="velvet">Red Velvet</option>
                                    <option value="matcha">Matcha</option>
                                </select>
                                <br><br>
                                3rd Layer: &nbsp;
                                <select style="font-size: 80%; color: #683e06;" id="first" class="droplist">
                                    <option value="butter" selected>Butter</option>
                                    <option value="choc">Chocolate</option>
                                    <option value="toffee">Toffee</option>
                                    <option value="cheese">Cheese</option>
                                    <option value="velvet">Red Velvet</option>
                                    <option value="matcha">Matcha</option>
                                </select>
                            </td>
                            <td class="message">Choose the cake flavours!</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Add to Cart</td>
                        </tr>
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