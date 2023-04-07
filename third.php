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



    $query = "SELECT * FROM CUSTOMERS;";
$result = mysqli_query($conn, $query);

    $dropdown = '<select name="cid_text" id="cid_text">';
    while ($row = mysqli_fetch_array($result)) {
        $dropdown .= '<option value="' . $row['CID'] . '">' . $row['NAME'] . '-' . $row['SURNAME'] . '</option>';
    }
    $dropdown .= '</select>';

    ?>

<form method="post" action="third.php">
    <!-- Customer Id <input type="text" name="cid_text" id="cid_text" value="">  -->
    Username <?php echo $dropdown; ?>
    Date of resarvation<input type="date" name="date_text" id="date_text" value="">
    <input type="submit">
</form>


<?php
$cid_text = $_POST["cid_text"];
$date_text = $_POST["date_text"];
$sql = "SELECT COUNT(*) CNT,SUM(COST) CST FROM RESERVATIONS R WHERE R.CID IN (
    SELECT CID FROM CUSTOMERS C WHERE R.CID=C.CID AND $cid_text=C.CID) AND MONTH(DATE_OF_RES) = MONTH('$date_text')";
         
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table style='border:1px solid black'>";
    echo "<tr>" .
        "<th>RESERVATIONS</th>" .
        "<th>COST</th>" .
        "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>" . 
            "<td>$row[CNT]</td>" .
            "<td>$row[CST]</td>" .
            "</tr>";
    }
    echo "</table>";
} else {
    echo "none found";
}
mysqli_close($conn);
?>