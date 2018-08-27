<?php
$servername = "mysql";
$username = "test";
$password = "test";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
CREATE TABLE `todo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text,
  `dueDate` datetime DEFAULT NULL,
  `createdAt` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";
//$conn->query($sql);

if ($conn->query($sql) === TRUE)
{
    echo "alert('Table creation: successful!');";
}
else
{
    echo "alert('Table creation: unsuccessful! " . $conn->error . " ');";
}

$conn->close();

//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//    }
//} else {
//    echo "0 results";
//}
//$conn->close();
//?>
