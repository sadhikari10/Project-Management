<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trader_signup</title>
   
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


.dropdown {
    position: relative;

}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 90px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;

}

.dropdown:hover .dropdown-content {
    display: flex;
}

.dropdown-content {
    display: none;
    flex-direction: row;
    align-items: firstbaseline;
    position: absolute;
    min-width: 120px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content label {
    margin: 5px 3px;
}

.dropdown-content input[type="radio"] {
    margin-right: 12px;
}

.register-as {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom:-10px;
}

.checkbox-container {
    display: flex;
    flex-direction: column;
}

.checkbox-container input[type="radio"] {
    margin-right: 5px;
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
        <legend>Welcome</legend>
        <div class="form-group">
            <div class="nested-div">
                <label><i class="fa fa-user icon"></i>Firstname</label>
                <input type="text" name="firstname" placeholder="Enter your first name" required>
            </div>
         
            <div class="nested-div">
                <label><i class="fa fa-user icon"></i>Lastname</label>
                <input type="text" name="lastname" placeholder="Enter your last name" required>
            </div>
        </div>
        <div class="box-container">
            <div class="form-group">
                <label><i class="fa fa-lock icon"></i>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label><i class="fa fa-lock icon"></i>Re-enter Password</label>
                <input type="password" name="rpassword" placeholder="Re-enter your password" required>
            </div>
            <div class="form-group">
                <label><i class="fa fa-envelope icon"></i>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label><i class="fa fa-phone icon"></i>Contact Number</label>
                <input type="tel" name="contact_number" placeholder="Enter your contact number" required>
            </div>


<div class="sam">
    <label for="gender-button"><h4> <i class="fa fa-venus-mars"></i>Gender</h4></label>
    <div class="dropdown">
        <button id="gender-button">Select Gender</button>
        <div class="dropdown-content">
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label><br>
        </div>
    </div>

</br></br>


            <div class="form-group">
                <label><i class="fa fa-image icon"></i>Upload Your Picture</label>
                <input type="file" name="profile_picture" required>
            </div>
        </div>
       
<div class="register-as">
    <label for="register-as"><h4><i class="fa fa-user-plus"></i> Register As</h4></label>

    
</div>


<div class="checkbox-container">
    <label for="student">
        <input type="radio" id="student" name="register-as" value="student"> Butchers
    </label>

    <label for="teacher">
        <input type="radio" id="teacher" name="register-as" value="teacher"> Greengrocer
    </label>

    <label for="professional">
        <input type="radio" id="professional" name="register-as" value="professional"> Fishmonger
    </label>

    <label for="business-owner">
        <input type="radio" id="business-owner" name="register-as" value="business-owner"> Bakery
    </label>

    <label for="other">
        <input type="radio" id="other" name="register-as" value="other">Delicatessen
    </label>
</div>


</div>
        <div class="terms-container">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms"> Terms and Conditions</label>
        
        <input type="submit" value="Register"></div>
    </fieldset>
</br>
     <div class="ram">
        <label>Already have an account?
        <button onclick="window.location.href='login.php'"> Sign In </button></label>
    </div>
</form>

   
</br>

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
