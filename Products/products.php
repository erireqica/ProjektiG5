<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/ProjektiG5/products.css">
     <style>


body {
    background: url('/ProjektiG5/ProjektiImages/background.jpg') no-repeat center center/cover;
    color: white;
    text-align: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}


body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); 
    z-index: -1;
}


#topbar {
    background: rgba(0, 0, 0, 0.9);
    width: 100%;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 10;
}

#logo {
    height: 50px;
    margin-left: 20px;
}

#top {
    list-style: none;
    display: flex;
    margin-right: 20px;
}

#top li {
    margin: 0 15px;
}

#top li a {
    text-decoration: none;
    color: orange;
    font-weight: bold;
    transition: 0.3s;
}

#top li a:hover {
    color: white;
}


#main {
    margin-top: 100px;
    width: 80%;
}


#d2, #d3, #d4 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(0, 0, 0, 0.85);
    border: 2px solid orange; 
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(255, 102, 0, 0.7);
    margin: 20px auto;
    padding: 15px;
    max-width: 800px; 
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

}


b {
    font-size: 27px;
    color: orange;
}


.buy-now {
    display: inline-block;
    background: orange;
    color: white;
    font-size: 22px;
    font-weight: bold;
    padding: 10px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s ease-in-out;
}

.buy-now:hover {
    background: white;
    color: orange;
    border: 2px solid orange;
    transform: scale(1.05);
}


    </style>
</head>
<body>
     <div id="main">
        <div id="d1">
            <div id="topbar">
                <img id="logo" src="/ProjektiImages/logo.png" alt="logo">
                <ul id="top">
                    <li><a href="/ProjektiG5/Main/main.php"> Home </a></li>
                    <li><a href="/ProjektiG5/Products/products.php"> Products </a></li>
                    <li><a href="/ProjektiG5/ContactUS/Create.php"> Contact Us</a></li>
                    <li><a href="/ProjektiG5/LogIn/LogIn.php"> Log In </a></li>
                   
                </ul>
                
        </div>

        <div id="d2">
                <div id="d21">
                    <i>
                   <b><p> IMMORTAL NYC hair wax for men:</p></b>
                    <p> Textured and tousled looks.</p>
                    <p> Thick, with a matte finish.</p>
                    <p> Strong, but flexible throughout the day.</p>
                    <p style="color:black">Price: 10$</p>
                    <a href="/ProjektiG5/LogIn/LogIn.php" class="buy-now">Buy Now</a>
                </i>
                </div>
                <div id="d22"><img src="/ProjektiG5/ProjektiImages/Haircut2.jpg" alt=""></div>
        </div>

        <div id="d3">
            <div id="d31">
                
                <i>
                    <p> <b>IMMORTAL NYC pomade:</b></p>
                    <p> Soft, but flexible throughout the day.</p>
                    <p>Sleek, classic styles like pompadours or side parts.</p>
                    <p style="color:black"> Price: 7$</p>
                    <a href="/ProjektiG5/LogIn/LogIn.php" class="buy-now">Buy Now</a>
                </i>
           
        </div>
            <div id="d32"><img src="/ProjektiG5/ProjektiImages/Haircut3.jpg" alt=""></div>
        </div>

        <div id="d4">
            <div id="d41">
            <i>
                <b>IMMORTAL NYC hair gel:</b>
                <p> Spiky styles or high-hold looks.</p>
                <p> Thick, sticky, dries hard.</p>
                <p>Very strong but can make hair stiff.</p>
                <p style="color:black"> Price: 12$</p>
                <a href="/ProjektiG5/LogIn/LogIn.php" class="buy-now">Buy Now</a>
            </i>
        </div>
            <div id="d42"><img src="/ProjektiG5/ProjektiImages/Haircut4.jpg" alt=""></div>
        </div>
        
     </div>
</body>
</html>
