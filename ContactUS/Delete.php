<?php
      $host='localhost';
      $username='root';
      $password="";
      $dbname='contact';
      $tabela="contact";

      if(isset($_GET['ID'])){
        $id=$_GET['id'];
        try{
            $dsn="mysql:host=$host; dbname=$dbname";
                $pdo = new PDO($dsn, $username, $password);
                $sql="DELETE FROM $tabela WHERE ID=$id";
                $stmt=$conn->prepare($sql);
                $stmt->execute([':id'=>$id]);
                header("Location: Read.php?Success");
                exit;   
        }
        catch(PDOException $a){
            echo "Error: " . $a->getMessage();
        }
      }
      ?>