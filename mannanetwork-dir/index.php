<?php date_default_timezone_set('America/New_York'); 
echo ' in index   dirname( __FILE__, 2 ) = ', dirname( __FILE__, 2 );
include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/auth_constants.php");
/*  returns         define("READER_CUSTOMERS", "a3_reader_customers_auth.php");
                                 define("WRITER_CUSTOMERS", "a3_writer_customers_auth.php");
				 define("READER_AGENTS", "a3_reader_agents_auth.php");
 				define("WRITER_AGENTS", "a3_writer_agents_auth.php");
define("DB_NAME_CUSTOMERS", "mannanetwork");
define("DB_NAME_AGENTS", "mannanetwork"); */

include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/".READER_AGENTS);
/*returns
    $servername = "localhost";
			      $username = "a3_reader_agents";
			      $password = "9ks0AwkrxV9ZHXMJIGCskeHtdTV3UiP6";
			      $dbname = "a3_agents";
*/


echo  '<br>$servername =',  $servername ;
echo '<br>$username = ',$username;
echo '<br>$password = ',$password;
echo '<br>$dbname = ', $dbname;
//include(dirname( __FILE__, 2 ). "/manna-configs/db_cfg/mysqli_connect.php");
echo '<br>after include mysqli connect ';
require('functions/functions.php');
 
if (array_key_exists("affiliate_num",$_POST))
  {
$affiliate_num = $_POST['affiliate_num'];
  }
else
  {
  $affiliate_num = "";
  }
if (array_key_exists("agent_num",$_POST))
  {
$agent_num  = $_POST['agent_num'];
  }
else
  {
  $agent_num  = "";
  }
if (array_key_exists("category_id",$_POST))
  {
$category_id  = $_POST['category_id'];
  }
else
  {
  $category_id  = 1;
  }
if (array_key_exists("cat_page_num",$_POST))
  {
$cat_page_num  = $_POST['cat_page_num'];
  }
else
  {
  $cat_page_num  = "";
  }
if (array_key_exists("link_page_num",$_POST))
  {
$link_page_num  = $_POST['link_page_num'];
  }
else
  {
  $link_page_num  = "";
  }
if (array_key_exists("link_page_id",$_POST))
  {
$link_page_id  = $_POST['link_page_id'];
  }
else
  {
  $link_page_id  = "";
  }
if (array_key_exists("pagem_url_cat",$_POST))
  {
$pagem_url_cat  = $_POST['pagem_url_cat'];
  }
else
  {
  $pagem_url_cat  = "";
  }
if (array_key_exists("link_page_total",$_POST))
  {
$link_page_total  = $_POST['link_page_total'];
  }
else
  {
  $link_page_total  = "";
  }
if (array_key_exists("link_record_num",$_POST))
  {
$link_record_num  = $_POST['link_record_num'];
  }
else
  {
  $link_record_num  = "";
  }
if (array_key_exists("regional_number",$_POST))
  {
$regional_number  = $_POST['regional_number'];
  }
else
  {
  $regional_number  = "";
  }


$linkList = getLinks($category_id);
//$comboList= array($catList, $linkList);
echo json_encode($linkList);

?>
