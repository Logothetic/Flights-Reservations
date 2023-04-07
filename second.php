    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CharteredAirlines";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("connection failed" . mysqli_connect_errno());
    }
    mysqli_set_charset($conn, "utf8");


    $query = "SELECT * FROM FLIGHTS;";
    $result = mysqli_query($conn, $query);

    $dropdown = '<select name="FLIGHTS" id="FLIGHTS">';
    while ($row = mysqli_fetch_array($result)) {
        $dropdown .= '<option value="' . $row['FNO'] . '">' . $row['DEPARTURE'] . '-' . $row['ARRIVAL'] . '</option>';
    }
    $dropdown .= '</select>';
    ?>

    <form method="post" action="second.php">
        Flights: <?php echo $dropdown; ?>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    $submited=$_POST["FLIGHTS"];
    $sql = "SELECT * FROM CUSTOMERS C 
             WHERE C.CID IN (SELECT CID FROM RESERVATIONS R
                            WHERE R.CID=C.CID AND $submited=R.FNO)";
            
                    $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result)>0){
                echo "<table style='border:1px solid black'>";
                echo "<tr>" .
                    "<th>FNO</th>" .
                    "<th>CID</th>" .
                    "<th>NAME</th>" .
                    "<th>SURNAME</th>" .
                    "</tr>";
            
            while($row=mysqli_fetch_assoc($result)){
                echo"<tr>".
                    "<td>$submited</td>".
                    "<td>$row[CID]</td>".
                    "<td>$row[NAME]</td>".
                    "<td>$row[SURNAME]</td>".
                    "</tr>";
            }
            echo "</table>";
        }else{
            echo "none found";
        }
        mysqli_close($conn);
        ?>
