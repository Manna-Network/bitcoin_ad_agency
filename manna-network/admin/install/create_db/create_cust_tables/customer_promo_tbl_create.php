<?php
if(!defined("DB_NAME_CUSTOMERS")){
include(dirname( __FILE__, 6 ) . "/manna-configs/db_cfg/auth_constants.php");
}
$dbname = DB_NAME_CUSTOMERS; //both names of each database were saved to the auth+
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<br>Connection failed: " . $conn->connect_error);
} 
echo "<br>Connected successfully";

$sql="
CREATE TABLE IF NOT EXISTS `promo_codes` (
`id` int(12) NOT NULL AUTO_INCREMENT,
`t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`promo_title`                  varchar(25)           NULL,                   
 `promo_description`            varchar(225)          NULL,                   
 `coin_type`                    varchar(60)           NULL,                   
 `promo_amount`                 decimal(20,10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) 

 ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;
";
if ($conn->query($sql) === TRUE) {
    echo "<br>Table promo_codes created successfully";
} else {
    echo "<br>Error creating table promo_codes: " . $conn->error;
}

$conn->close();
?>
