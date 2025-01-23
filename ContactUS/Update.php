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

        try{
            $dsn="mysql:host=$host; dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);

            $sql="UPDATE contact SET
            emri=:emri,
            email=:email,
            komenti=:komenti";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':emri' => $emri,
                ':email' => $email,
                ':komenti' => $komenti
            ]);
            header("Location: Read.php?message=Record updated successfully");
                    exit();
        }
        catch(PDOException $e){
            echo "Error : ".$e->getMessage();
        }
    }

    ?>