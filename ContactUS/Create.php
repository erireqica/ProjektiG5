<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="main">
        <div id="topbar">
            <img id="logo" src="/ProjektiImages/logo (1).png" alt="logo">
            <ul id="top">
                <li><a href="../../Main/main.html"> Home </a></li>
                <li><a href="/Products/products.html">Products </a> </li>
                <li><a href="../../AboutUs/AboutUs.html"> About Us </a></li>
                <li><a href="/LogIn/LogIn.html"> Log In </a></li>
            </ul>
        </div>
            
            <div class="container">
                <h1>Contact Us</h1>
                <form id="contactForm">
            
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                  </div>
            
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                  </div>
            
                  <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                  </div>
            
                  <button type="submit">Submit</button>
                  <p id="responseMessage" class="hidden"></p>
            
                </form>

             </div>

              <script src="script.js"></script>
              <a href="Read.php">Shiko komentet</a>
        
    </div>    


    <?php
    
    $host='localhost';
    $username='root';
    $password="";
    $dbname='contact';
    $tabela="contact";

    if(isset($_POST['Submit'])){
        $emri=$_POST['name'];
        $email=$_POST['email'];
        $komenti=$_POST['message'];

        if(empty($emri) || empty($email) || empty($komenti)){
            die("Ju lutem plotesoni kolonat");
        }
        try{
            $dsn="mysql:host=$host; dbname=$dbname;";
            $conn= new PDO($dsn, $username, $password);
            
            $sql="INSERT INTO $tabela (Emri, Email, Komenti) VALUES (:emri, :email, :message)";
            $stmt=$conn->prepare($sql);
            $stmt->execute([':emri'=>$emri, ':email'=>$email, ':message'=>$komenti]);
            echo "Mesazhi juaj u pranua me sukses";
        }
        catch(PDOExeption $a){
            echo"Error: ". $a->getMessage();

            }
            header("Location: Read.php?success");

    }
    ?>

</body>
</html>