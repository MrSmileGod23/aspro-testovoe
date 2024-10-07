<?php
include "../database/dbconnect.php";

$sql = "select * from history";

$result = mysqli_query($connection, $sql);
echo "
    <table class='table'>
    <thead>
    <tr>
        <th scope='col'>#</th>
        <th scope='col'>Строка</th>
        <th scope='col'>Результат</th>
    </tr>
    </thead>
    <tbody>
    ";
while ($data = mysqli_fetch_row($result)) {
    echo "<tr>";
    echo "<th>$data[0]</th>";
    echo "<th>$data[1]</th>";
    echo "<th>$data[2]</th>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

