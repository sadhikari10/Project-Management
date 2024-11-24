<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer_signup</title>
<link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<style type="text/css">
    


/* Body Styles */
.video-background {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100vh; /* Adjust as needed */
}

#myVideo {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -1;
    transform: translateX(-50%) translateY(-50%);
}

.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    z-index: 1;
    background-color: skyblue; /* Set background color to sky blue */
    padding: 20px; /* Add padding to the container */
    border-radius: 10px; /* Add border radius for rounded corners */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Add box shadow for depth */
    max-width: 600px; /* Limit the maximum width of the container */
    width: 90%; /* Make the container responsive */
    box-sizing: border-box;
    max-height: 90vh; /* Ensure the container does not exceed the viewport height */
    overflow-y: auto; /* Allow scrolling if content exceeds max-height */
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

/* Dropdown Styles */
.dropdown-content {
    display: none;
    flex-direction: column; /* Display checkboxes vertically */
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    padding: 10px;
    position: absolute;
    z-index: 1;
    margin-top: 10px; /* Add margin at the top */
}

.dropdown-content label {
    display: block; /* Display labels as block */
    margin-bottom: 5px;
}

.dropdown-content input[type="radio"] {
    margin-right: 5px;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-bottom: 10px; /* Add 10px margin gap below the dropdown */
}

.button-label,
.sam button,
.register-container,
.terms-container input[type="submit"],
.kipp button {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: inline-block;
    transition: all 0.3s ease;
    text-align: center;
}

/* 3D Effect and Glow on Hover */
.button-label:hover,
.register-container,
.sam button:hover,
.terms-container input[type="submit"]:hover,
.kipp button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
}

/* Gender Dropdown Visibility */
#gender-button:checked + .button-label + .dropdown-content {
    display: flex;
}

/* Terms and Conditions Container */
.terms-container {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Align checkbox and link to the start */
    margin-top: 20px;
}

.terms-container input[type="checkbox"] {
    margin-right: 5px;
}

#terms-link {
    cursor: pointer;
    text-decoration: underline;
    color: blue;
}

.register-container {
    display: flex;
    justify-content: center; /* Center the register button */
    margin-top: 20px;
}
.register-container hover: {
    display: flex;
    justify-content: center; /* Center the register button */
    margin-top: 20px;
}
.terms-container input[type="submit"] {
    margin-left: auto; /* Push the submit button to the right */
}

/* Modal Styles */
.modal-trigger {
    display: none;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 10px;
}

.modal .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    margin: -20px -20px 0 0;
}

#termsModalTrigger:checked + #termsModal {
    display: block;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .form-group {
        flex-direction: column;
    }

    .nested-div {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .terms-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .terms-container input[type="submit"] {
        margin-left: 0;
        margin-top: 10px;
        width: 100%;
    }

    .kipp label {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .kipp button {
        margin-top: 10px;
        width: 100%;
    }

    .sam {
        width: 100%;
        text-align: center;
    }

    .sam button {
        width: 100%;
    }

    .dropdown-content {
        position: static;
        width: 100%;
        box-shadow: none;
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .form-group input {
        padding: 6px;
    }

    .container {
        padding: 10px;
    }

    .button-label,
    .sam button,
    .terms-container input[type="submit"],
    .ram button {
        padding: 6px 12px;
    }
}




</style>


<body>





<!-- starting of header -->
<div class="header">
    <div class="logo">
        <img src="logo.jpg" alt="Logo">
    </div>

    <div class="search-container">
        <form action="#" class="search-form">
            <input type="text" placeholder="Search Here ...">
            <button class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    <div class="auth-container">
        <div class="auth-links">
            <button id="signUpBtn"><a href="#"><i class="fa fa-user-plus"></i> SIGN UP</a></button>
            <button id="signInBtn"><a href="#"><i class="fa fa-sign-in"></i> SIGN IN</a></button>
        </div>

        <div class="cart-icon">
            <button id="cartBtn">
                <i class="fa fa-shopping-cart"></i>
            </button>
        </div>
    </div>


</div>











<!-- starting of nav bar from here -->


<nav class="navbar">
    <div>
        <ul class="left-side">
            <li class="dropdowns">
                <a href="#"><i class="fa fa-list"></i><span class="gap"></span>All Categories </a>
                <div class="dropdowns-content">
                    <a href="service1.html">Service 1</a>
                    <a href="service2.html">Service 2</a>
                    <a href="service3.html">Service 3</a>
                </div>
            </li>
        </ul>
    </div>
    
    <div class="gap"></div>

    <div>
        <ul class="right-side">
            <li><a href="#"><i class="fa fa-home"></i><span class="gap"></span>Home</a></li>
            <li class="gap"></li>
            <li><a href="#"><i class="fa fa-info-circle"></i><span class="gap"></span>About Us</a></li>
            <li class="gap"></li>
            <li class="dropdowns">
                <a href="#"><i class="fa fa-shopping-bag"></i><span class="gap"></span>Shops </a>
                <div class="dropdowns-content">
                    <a href="product1.html">Product 1</a>
                    <a href="product2.html">Product 2</a>
                    <a href="product3.html">Product 3</a>
                </div>
            </li>
            <li class="gap"></li>
            <li><a href="#"><i class="fa fa-envelope"></i><span class="gap"></span>Contact</a></li>
        </ul>
    </div>
</nav>

<!-- ending of nav bar -->




