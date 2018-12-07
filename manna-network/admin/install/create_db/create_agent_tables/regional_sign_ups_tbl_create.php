<?php
if( !defined( __DIR__ ) ) define( __DIR__, dirname(__FILE__) );

if(!defined("DB_NAME_AGENTS")){
include(dirname( __FILE__, 6 ) . "/manna-configs/manna-configs/db_cfg/auth_constants.php");
}
$dbname = DB_NAME_AGENTS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql="CREATE TABLE `regional_sign_ups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continent` int(6) NOT NULL DEFAULT '0',
  `country` int(6) NOT NULL DEFAULT '0',
  `state` int(6) NOT NULL DEFAULT '0',
  `district1` int(6) NOT NULL DEFAULT '0',
  `city` int(6) NOT NULL DEFAULT '0',
  `district2` int(6) NOT NULL DEFAULT '0',
  `street` varchar(150) DEFAULT '0',
  `link_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
`agent_ID` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=11287 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='customer data';
";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table regional_sign_ups created successfully";
} else {
    echo "<h3>Error creating regional_sign_ups table: " . $conn->error . '</h3>';
}

$conn->close();
?>
