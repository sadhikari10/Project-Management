<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_login</title>
   
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Header Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            padding: 20px;
            position: relative;
        }

        .logo img {
            height: 100px;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin: 0 auto; 
            max-width: 600px; 
        }

        .search-form input {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            margin-right: 10px;
            font-size: 18px;
            width: 100%; 
        }

        .search-button {
            border: 2px solid rgba(0, 128, 128, 0.5);
            background-color: transparent;
            border-radius: 10px 20px 10px 20px;
            cursor: pointer;
            padding: 14px 20px; 
        }

        .search-button i {
            font-size: 24px;
            margin-right: 5px;
        }

        .auth-links {
            position: absolute;
            top: 20px; 
            right: 20px; 
        }

        .auth-links button {
            margin-right: 10px;
        }

        .shopping-cart-button {
            position: absolute;
            top: 60px; 
            right: 20px; 
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between; 
        }

        .navbar li {
            margin-right: 20px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        @media screen and (min-width: 768px) {
            .search-form input {
                padding: 15px;
                border: 1px solid #ccc;
                border-radius: 2px 20px 2px 20px;
                margin-right: 10px;
                font-size: 18px;
                width: 100%;
            }
        }

        /* Body Styles */
        form {
            max-width: 400px; 
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }

        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center; 
        }

        .form-group {
            margin-bottom: 20px;
            display: flex; 
            flex-wrap: wrap; 
        }

        .nested-div {
            flex: 1; 
            margin-right: 10px; 
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px; 
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4caf50;
        }

        .box-container {
            background-color: #f4f7f8;
            padding: 15px; 
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        .box-container:hover {
            border-color: #4caf50;
        }

        .box-container .form-group {
            margin-bottom: 15px;
        }

        .box-container .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .box-container .form-group input[type="password"],
        .box-container .form-group input[type="email"],
        .box-container .form-group input[type="tel"],
        .box-container .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .box-container .form-group input:focus {
            border-color: #4caf50;
        }

        .icon {
            margin-right: 10px;
            color: #aaa;
        }

        .terms-container {
            text-align: center; 
            margin-bottom: 20px; 
        }

        input[type="checkbox"] {
            margin-right: 5px; 
        }

        input[type="submit"] {
            background: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto; 
        }

        input[type="submit"]:hover {
            background: #45a049;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: #darkred;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            flex: 1;
            margin: 10px;
            border: 1px solid #fff; 
            padding: 10px; 
        }

        .footer-heading {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .footer-links {
            list-style-type: none;
            padding: 0;
            color: aqua;
        }

        .footer-links li {
            margin-bottom: 5px;
        }

        .social-media-icons {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social-media-icons img {
            width: 30px;
            margin: 0 5px;
        }

        .payment-methods {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .payment-methods img {
            width: 50px;
            margin: 0 10px;
        }

        .footer-links li a {
            color: darkcyan; 
        }

        .footer-links li i {
            margin-right: 10px; 
        }

        .social-media-icons i {
            margin-right: 30px; 
        }

        .footer-links {
            column-count: 2; 
            column-gap: 20px; 
        }

        @media screen and (min-width: 768px) {
            .footer-links {
                column-count: 4;
            }
        }

        .ram {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

.apple {
    display: flex;
    align-items: center;
}

.apple .ball{
    display: flex;
    align-items: center;
}

.apple label {
    margin-right: 10px;
}

.apple input[type="checkbox"] {
    margin-right: 5px;
}




.apple {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.ball {
    margin-bottom: 10px; /* Add margin bottom for spacing */
}

input[type="submit"] {
    background: #4caf50;
    color: #fff;
    border: none;
    padding: 18px 100px; /* Increase padding for a bigger button */
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}



    </style>
</head>
<body>

<header>
    <div class="auth-links">
        <button><a href="#"><i class="fa fa-sign-in"></i> SIGN IN</a></button>
        <button><a href="#"><i class="fa fa-user-plus"></i> SIGN UP</a></button>
    </div>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <form action="#" class="search-form">
        <input type="text" placeholder="Search">
        <button class="search-button">
            <i class="fa fa-search"></i>
        </button>
    </form>
    <div class="shopping-cart-button">
        <button style="font-size:24px">
            <i class="fa fa-shopping-cart"></i> Cart
        </button>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li class="dropdown">
            <a href="#"><i class="fa fa-list"></i>  All Categories</a>
            <div class="dropdown-content">
                <a href="#">Service 1</a>
                <a href="#">Service 2</a>
                <a href="#">Service 3</a>
            </div>
        </li>
        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
        <li><i class="fa fa-info-circle"></i><a href="#">About Us</a></li>
        <li class="dropdown">
            <a href="#"><i class="fa fa-shopping-bag"></i>  Shops </a>
            <div class="dropdown-content">
                <a href="#">Product 1</a>
                <a href="#">Product 2</a>
                <a href="#">Product 3</a>
            </div>
        </li>
        <li><i class="fa fa-envelope"></i><a href="#"> Contact</a></li>
    </ul>
</nav>

<div class="container">
    <form action="process.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><h2>Log In</h2></legend>
            <div class="form-group">
                <div class="nested-div">
                    <label><i class="fa fa-user icon"></i>Username or Email-address</label>
                    <input type="text" name="firstname" placeholder="Enter your Username or Email-address" required>
                </div>
            </div>
            <div class="box-container">
                <div class="form-group">
                    <label><i class="fa fa-lock icon"></i>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>


      <div class="apple">
    <div class="ball">
        <label for="terms">Remember me</label>
        <input type="checkbox" name="terms" id="terms" required>
    </div>
    <br> <!-- Adding a line break -->
    <input type="submit" value="Log In">
</div>

            </form>
</br>
    <div class="ram">
        <label>Forget Password?
        <button onclick="window.location.href='login.php'">Click here </button></label>
    </div>
    <br>
</div>
</fieldset>


<footer>
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-heading"><h3>Categories</h3></div>
            <ul class="footer-links">
                <li><a href="#">Category 1</a></li>
                <li><a href="#">Category 2</a></li>
                <li><a href="#">Category 3</a></li>
                <li><a href="#">Category 4</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <div class="footer-heading"><h3>Website Name</h3></div>
            <ul class="footer-links">
                <li><i class="fa fa-home"></i> <a href="#">Home</a></li>
                <li><i class="fa fa-info-circle"></i> <a href="#"> About Us</a></li>
                <li><i class="fa fa-envelope"></i> <a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <div class="footer-heading"><h3>Follow Us</h3></div>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/officialpage" target="_blank"><i class="fa fa-facebook fa-2x" style="color: #3b5998;"></i></a>
                <a href="https://www.instagram.com/officialpage" target="_blank"><i class="fa fa-instagram fa-2x" style="color: #e4405f;"></i></a>
                <a href="https://twitter.com/officialpage" target="_blank"><i class="fa fa-twitter fa-2x" style="color: #1da1f2;"></i></a>
            </div>
        </div>
        <div class="footer-section">
            <div class="footer-heading"><h3>Payment Methods</h3></div>
            <div class="payment-methods">
                <i class="fa fa-credit-card fa-3x" style="color: #1da1f4;"></i> 
            </div>
        </div>
    </div>
</footer>

</body>
</html>
