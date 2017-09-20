<?php

namespace App;

use App\Database\DatabaseHelper;

require_once __DIR__ . '/App/Database/DatabaseHelper.php';


//connect to the database
$DB_CON = DatabaseHelper::connect();

$sql = 'SELECT * 
      FROM log';

$result = $DB_CON->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>date</th><th>MobileNumber</th><th>smsContent</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<tr><td>" .
            $row["id"] .
            "</td><td>".
            $row["date"] .
            "</td><td>".
            $row["MobileNumber"] .
            "</td><td>".
            $row["MobileNumber"].
            "</td><td>" .
            $row["smsContent"].
            "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$DB_CON->close();