<!DOCTYPE html>
<html>
    <head>
        <title>Ερωτημα 1ο</title><meta charset="UTF-8"></head>
        <body>
            <?php 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "CharteredAirlines";
            
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            if(!$conn){
                die("connection failed" . mysqli_connect_errno());
            }
            mysqli_set_charset($conn, "utf8");
            $sql = "SELECT * FROM FLIGHTS";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result)>0){
                echo "<table style='border:1px solid black'>";
                echo "<tr>" .
                    "<th>FNO</th>" .
                    "<th>DEPARTURE</th>" .
                    "<th>ARRIVAL</th>" .
                    "<th>INTOREXT</th>" .
                    "<th>SEATS</th>" .
                    "<th>FREE</th>" .
                    "<th>DATE_OF_DEP</th>" .
                    "</tr>";
            
            while($row=mysqli_fetch_assoc($result)){
                echo"<tr>".
                    "<td>".$row['FNO']."</td>".
                    "<td>".$row['DEPARTURE']."</td>".
                    "<td>".$row['ARRIVAL']."</td>".
                    "<td>".$row['INTOREXT']."</td>".
                    "<td>".$row['SEATS']."</td>".
                    "<td>".$row['FREE']."</td>".
                    "<td>".$row['DATE_OF_DEP']."</td>".
                    "</tr>";
            }
            echo "</table>";
        }else{
            echo "none found";
        }

        mysqli_close($conn);
            ?>
 
</body></html>
