<?php
      $host='localhost';
      $username='root';
      $password="";
      $dbname='log';
      $tabela="tbl3";

       try{
        $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    
        $sql = "SELECT * FROM $tabela";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll();

            if($result){
             echo  "<tr>
                <th>Emri</th>
                <th>Email</th>
                <th>Komenti</th>
                </tr>";

                foreach($result as $x){
                    echo "<tr>";
                    echo "<td>". $x['emri']. "</td>";
                    echo "<td>". $x['email']. "</td>";
                    echo "<td>". $x['komenti']. "</td>";
                    
                   echo "</tr>";
                }
                echo "</table>";

            }
       }
       catch(PDOException $e){
            echo "Error: ". $e->getMessage();
       }
      
?>
 <a href="Create.php" class="create-record">Shto nje Koment te ri</a>
 <?php
 if(isset($_GET ['success'])){
    echo "<h2 id='h1'>Rekordi u fshij me sukses;</h2>";
 }
 echo "<script>
 setTimeout(function(){
    document.getElementById('h1').style.display = 'none';
 },5000);
 </script>";
 ?>