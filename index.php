<?php

namespace App;

use App\Database\DatabaseHelper;
use App\Notification\BySMS;

require_once __DIR__ . '/App/Database/DatabaseHelper.php';
require_once __DIR__ . '/App/Notification/BySMS.php';

//connect to the database
$DB_CON = DatabaseHelper::connect();

$sql = 'SELECT * 
      FROM customers
      WHERE 
         DATE_FORMAT(birthday,\'%m-%d\') = DATE_FORMAT(NOW(),\'%m-%d\')';

$result = $DB_CON->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Lang</th><th>Birthday</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {

        BySMS::send(
            $row["customerName"],
            $row["MobileNumber"],
            $row["preferredLanguage"],
            $row["birthday"]
        );

        echo "<tr><td>" .
            $row["id"] .
            "</td><td>".
            $row["customerName"] .
            "</td><td>".
            $row["MobileNumber"] .
            "</td><td>".
            $row["preferredLanguage"].
            "</td><td>" .
            $row["birthday"].
            "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$DB_CON->close();