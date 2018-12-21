<?php
//NOTE: the next AGENT_FOLDERNAME setting can be adjusted according to your folder naming preference. Just be sure that you match the name changes you make here to  those you make renaming the bitcoin_ad_agency folder 
if (!defined('AGENT_FOLDERNAME')) {
define("AGENT_FOLDERNAME", "bitcoin_ad_agency/manna-network");
}
if (!defined('AGENT_URL')) {
define("AGENT_URL", "insert your site's domain name here");
}

//IMPORTANT - YOU MUST CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID AGENT ID! IMPROPER CONFIGURATION CAN RESULT IN LOSS OF YOUR AND YOUR DOWNLINE'S COMMISSIONS AND ENLISTMENT CREDITS! 
if (!defined('AGENT_ID')) {
define("AGENT_ID", "insert your agent ID number here");//get it from https://manna-network.cash/agents/register.php
//define("AGENT_ID", "1");//bad example WRONG  NOTE has quotes 
//Correct example - define("AGENT_ID", 1);
}
//IMPORTANT - YOU MUST CONTACT MANNA NETWORK ADMINISTRATION TO GET A VALID $exchange_pw in order to send and receive updated link, bids and categories!
$exchange_pw = "insert your exchange_pw here";//get it from https://manna-network.cash/agents/register.php

//temporary (i.e. for installation purposes only) root user with full grant capabilities - used for setup only - removing password after installation is fine
$servername = "localhost";
$username = "root";//your MySql user name here
$password = "insert your mysql user's password here";
?>
