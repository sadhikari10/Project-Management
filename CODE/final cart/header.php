<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sphere</title>
    <link rel="stylesheet" type="text/css" href="header12.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- need to change -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-9SRoxnALndHWBB2V9eq8aoyxF5AColhf7yU9Ckrq3+Mwx2VRWPv3V+vef2wQzjHTl6+J6YpYELl2hXa/BbIBag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><img src="logo.jpg" alt="Logo" style="width:25px;height:25px"></a>
        </li>
      </ul>
    </div>

    <!-- starting of header -->
    <div class="search-container">
        <form action="index.php" method="GET" class="search-form" enctype="multipart/form-data">
            <input type="text" placeholder="Search Here ..." name="search_query">
            <button type="submit" class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>


        <div>
            <div class="cart-icon">
                <a href="mycart.php" class="btn btn-outline-success">
                    <i class="fa fa-shopping-cart"></i> 
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- starting of nav bar from here -->
<nav class="navbar">
    <div>
        <form>
            <ul class="left-side">
                <li class="dropdowns">
                    <a href="#"><i class="fa fa-list"></i><span class="gap"></span>All Categories </a>
                    <div class="dropdowns-content">
                        <a href="index.php?category=butcher">Butcher</a>
                        <a href="index.php?category=delicatessen">Delicatessen</a>
                        <a href="index.php?category=bakery">Bakery</a>
                        <a href="index.php?category=greengrocer">Greengrocer</a>
                        <a href="index.php?category=fishmonger">Fishmonger</a>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    
    <div class="gap"></div>

    <div>
        <ul class="right-side">
            <li><a href="index.php"><i class="fa fa-home"></i><span class="gap"></span>Home</a></li>
            <li class="gap"></li>
            <li><a href="../About Us/about_us.php"><i class="fa fa-info-circle"></i><span class="gap"></span>About Us</a></li>
            <li class="gap"></li>
            <li class="gap"></li>
            <li><a href="../Contact_Us/contact.php"><i class="fa fa-envelope"></i><span class="gap"></span>Contact</a></li>
        </ul>
    </div>
</nav>

<!-- ending of nav bar -->
</body>
</html>
