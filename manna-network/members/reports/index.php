<?
//Get the name of the file (form.php)
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],
$phpself)) . $phpself;
//You've got a clean PHP_SELF again (y) 

/*
include($_SERVER['DOCUMENT_ROOT']."/classes/access_user/access_user_class.php"); 
// call this page to test referer function
// test this page like "testpage.php?var=test" if you are using a querystring
$test_page_protect = new Access_user;
$test_page_protect->login_page = "login.php"; // change this only if your login is on another page
$test_page_protect->access_page($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']); // set this  method, including the server vars to protect your page and get redirected to here after login
$hello_name = ($test_page_protect->user_full_name != "") ? $test_page_protect->user_full_name : $test_page_protect->user;
$test_page_protect->get_user_info();
$user_id=$test_page_protect->id;

if (isset($_GET['action']) && $_GET['action'] == "log_out") {
	$test_page_protect->log_out(); // the method to log off
}
*/
// include the configs
require_once("../config/config.php");

    
// load the login class

// load php-login components
require_once("../php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

 
    
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {    
    // the user is logged in...


$user_id = $_SESSION['user_id'];



$link_selected =$_GET['link_selected'];
$type =$_GET['type'];
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
$sql="select `BB_user_ID` from `links` where `id` = '$link_selected'";
$result = @mysql_query($sql, $connect);
$num_rows = mysql_num_rows($result);
if($num_rows >0){
$row = mysql_fetch_array($result);
$BB_user_ID = $row['BB_user_ID'];
}

if($BB_user_ID != $user_id){
echo 'header(you are not authprized)';
exit();
}


include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/db2bbconfig.php");
include($_SERVER['DOCUMENT_ROOT']."/link_exchange/admin/connect.php");
$sql="select `file_name`, `folder_name`, `end_clone_date` from `widgets` where `link_id` = ".$link_selected;

$result = @mysql_query($sql, $connect);
$num_rows = mysql_num_rows($result);
if($num_rows >0){
$row = mysql_fetch_array($result);
$folder_name = $row['folder_name'];
$file_name = $row['file_name'];
$end_clone_date = $row['end_clone_date'];
}


//if($end_clone_date > '0000-00-00 00:00:00' and $type != 'start_up'){
//echo 'That link is no longer eligible to host a web directory';

//}


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/template_topy.php");
?>

<script>
var page_set = [
{'caption': 'Install Location', 'url': 'widget_install.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Customize', 'url': 'widget_config.php?link_selected=<?echo $link_selected;?>'},
    {'caption': 'Get Code - Template Version', 'url': 'widget_template_version_code.php?link_selected=<?echo $link_selected;?>'}
,
    {'caption': 'Get Code - BareBones Version', 'url': 'widget_barebones_version_code.php?link_selected=<?echo $link_selected;?>'}

];
</script>

<?
$msg="";
if($type == 'manage'){
echo '<h1>Manage Your Web Directory Installation</h1>
<p style="text-align:left; ">Change your web directory\'s location settings <a href="widget_process_edit.php?link_selected='.$link_selected.'">Edit Web Directory Installation Location</a>
<p style = "text-align:left;"> Customise Your Web Directory\'s Looks <a href="widget_config.php?link_selected='.$link_selected.'">Insert/Edit Web Directory Customising</a>
<ul><li>
  Page Titles Custom To Your Website
   </li><li> Page Titles Custom To The Category And Your Website
    </li><li>Page Header Meta Tags Custom To Your Website And To The Category
    </li><li>Custom "Add A Link" Buttons
    </li><li>Custom "Leaving Page" - notifies users 1) the web directory is 3rd party 2) they are leaving your site 3) you endorse BungeeBones
    </li><li>Select How/When/If Your Directory Displays Free Links
    </li><li>Select If Your Directory Links Are "NoFollow"
</li></ul>   
 And More
<p style="text-align:left;">View and/or collect your web directory\'s EARNINGS <a href="widget_earnings.php?link_selected='.$link_selected.'">See/Collect Earnings</a>
';
}
elseif($type == 'edit'){
echo '<h1>Edit Your Web Directory Installation Configuration</h1>';
$msg .= '<p style="text-align:left; font-size: 145%;">Get & Install Widget (i.e. web directory) Source Code</p>';

$msg .= '<a name="custom"></a> <table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';

$msg .=   '<p style="text-align:left; "><h1 style="color: navy;">Installation Instructions</h1>
<h2 style="color: white;">Change Location Configuration</h2>
<p> <a style="color: white;" href="widget_process_edit.php?link_selected='. $link_selected.'" title="Install Location" >Change Install Location Form</a>
<p style="text-align:left; ">At Bungeebones we need to know where your web directory is installed for it to work properly.  Change this setting if you haved installed the web directory in a location and you want to relocate it to a different location.

<p style="text-align:left; "> Using the fictitious YourSite.com domain as an example (<b>replace YourSite.com with your own actual domain</b>), then, you can place the web directory at YourSite.com/foo.php, YourSite.com/foo/bar.php, YourSite.com/foo/foo/bar.php etc.
<ul><li>If you want to install it at YourSite.com/foo.php then enter the word "root" for the directory name/location in the form below.
</li><li>If you want to install it at YourSite.com/foo/bar.php then enter "foo" in the directory name/location and "bar.php" as the file location
</li><li>If you want to install it at YourSite.com/foo/foo/bar.php then enter "foo/foo" in the directory name/location and "bar.php" as the file location


</li></ul>
If you want your web directory in a folder named "links" on your website you will enter that desired name here and will eventually ( in Step 2) create a new folder at YourSite.com/links. If you want it in a folder named "web_directory" you will create a new folder at YourSite.com/web_directory, etc. Correctly matching the configuration to the actual install location is <b>absolutely crucial</b> for the web directory to work properly. So go to the <a style="color: white;" href="widget_process_edit.php?link_selected='. $link_selected.'" title="Install Location" >Install Location Form</a> now and configure where you will be installing the web directory, then go on to Step 2.

<h2 style="color: white;">Step 2 - Upload And Install Demo/Test Version</h2> 
<p style="text-align:left; ">Now create a folder on your website in the location you specified above, making sure that the naming and the spelling are identical to what you entered.If you change your mind about the folder or file name don\'t worry as it is all editable by re-entering the form in Step 1. Just make sure the configuration names and the actual names are the same.
<p style="text-align:left; ">Next, you need to download the BungeeBones demo version from here -  <a target="_blank" href="http://bungeebones.com/ftp/demo.tar.gz">(demo.tar.gz download) </a> and then upload it to the folder you just created. Extract the file there and rename the demo.php page in the upload to exactly what you entered as the page name during the configuration in step one. 

<p style="text-align:left; ">You will have to make one, small configuration change to the page you just renamed. In the second line of code in the page there is a line that reads "//verify that the affiliate number below is yours to insure your affiliate credit and payments" and just below that on line three it has - 
$affiliate_num = 3112 ; . 

<p style="text-align:left; "><b>Change that number (i.e. 3112) to YOUR AFFILIATE NUMBER for this site which IS <font style="color: white;"> ...   '. $link_selected.'   ...</font>

<p style="text-align:left; ">After you uploaded and untarred the file on your site, in the location you specified, and named as you entered, it should work. The "Demo Version" should produce a complete and fully working web directory right out of the box but it won\'t look pretty, that\'s for sure. It is the quickest and easiest way to test and make sure all the configurations in the "Install Location" form are correct or check for any other issues BEFORE you go to the trouble of customising and branding it to your website. The tar.gz file also includes another file named ajax_to_curl.php which is needed for the regional filtering to function properly.

<p style="text-align:left; "> Make sure the web directory is working properly. Open the page in a browser and be sure to click the categories on the main page because it may look normal but still not be functioning properly. If not, there may be a conflict with our code and your hosting company settings. If it is NOT working, DON\'T go any further. Go to the TROUBLESHOOTING section below or contact us.

 <p style="text-align:left; ">Assuming that everything is working properly read about the BareBones Version below and decide which method (i.e.  1) modifying the Demo/Test Version or 2) make your website template and use the Barebones Version) that you will use to brand the web directory to the look of your website. We want to get the web directory to look as if it is one of your regular website pages.
<h2 style="text-align:left; color: white;">Step 3 - Branding the Web Directory To Your Own Look</h2>
<p style="text-align:left; "><a target="_blank" style="color: white;" href="widget_barebones_version_code.php?link_selected='. $link_selected.'"  ><b>The BareBones Version</b></a> comes as two blocks of code that need to be inserted into one of your own website page templates. One section of code needs to be pasted into the "head" section and the other into the "body" section of the page.</p>
<p style="text-align:left; ">The BareBones Version is usually the quicker way to get your installation branded to your website (rather than using the demo/test version) but, if you prefer, you can skip this section completely and just add your own site\'s header, footer, pictures, CSS, menus etc. to the demo and end up at the same place as what the following process will accomplish. All the various locations on the demo page have varied text to help you locate them in the code in order to help replace them with your own.
 
<p style="text-align:left; ">If you decide to give the BareBones version a shot, then, since you already have installed the Demo Version save it as a backup so you can reference it\'s coding while building the barebones one (note the Demo/Test Version will no longer be fully functional unless it is renamed, again, to its original name (or you change the config in Step 1 to match it), but it could become a troubleshooting tool if needed.). 
<h3>Steps To Installing The BareBones Version*</h3>
<ol><li>Rename the page of the current Demo/Test Version web directory page to something else in order to be able to install your new template page the same as it. A good name to rename this demo version page could be something like "troubleshoot.php" (or your equivalent)</li>
<li>Create and/or copy one of your own website\'s pages as a template. <a target="_blank" href="make_template.php?link_selected='. $link_selected.'">See a step-by-step tutorial with screenshots on how to make a website template here.</a> How to do that? Open one of your own website pages that has the "look" you want with your web browser (IE, Firefox, Chrome etc). What do I mean by "the right look"? The major parts of a web page are the top header where a picture and perhaps a main menu usually are. Then there is usually a left side bar, sometimes a right side bar, and lastly a footer. If you can find a page on your site with just those four sections (or three without the right sidebar) and the center of the page as one complete block it will be easier to make your template. If your page has a number of small blocks with the main center block it becomes more of a challenge. 

<li>Then, while on your selected page, right click the mouse and look for something in the popup menu like "Page source" or "View Source". Once the page shows you the code of the page just copy the entire code (hold down Ctrl and press c), open a blank page in a text editor (notepad for example) and then paste (hold down Ctrl and press v) page code into the new page. Now you need to "disassemble" the page a little before inserting the BarebOnes code. What you want to do is locate the opening "body tag". It will start out like this (&lt;body) but may have other characters after the word "body". We want to remove all the text and code from the end of that opening body tag to the beginning of the closing body tag. To find the closing body tag (but remember or write down where the opening tag is) go down towards the bottom of the page and find the closing "body tag" - it looks like this -  (&lt;/body&gt;). Now delete EVERYTHING in BETWEEN the opening body tag and the closing body tag but be sure not to delete any part of them (especially not the angle brackets). Now after you delete type something where all that writing used to be such as "placeholder" or something (it makes it easier to find the right spot again). </li>

<li>Save one copy of what you created as a backup, and then save another to the location where the original demo version page was and name it as the former demo page (i.e. that matches your settings in step 1. View the new page in the browser to make sure everything is still working correctly. As we proceed make sure you make backups as we progress in case we ever need to start over.</li>
<li>Find the starting and ending body tags. The start tag is often just &lt;body&gt; but sometimes there are other items in the tag after the word "body". The end tag is almost always &lt;/body&gt;. Then delete everything between those tags and enter some place holder text in its place. Type anything, your pet\'s name, your phone number, anything in order to be able to find the right spot again later. 
<li>Copy and paste the first block of BareBones code into the "&lt;head&gt;" section of the page (See Maneuvering The "Head Section" Code below)</li>
<li>Copy and paste the second block of code into the &lt;body&gt; section of the page (see Maneuvering The "Body Section" Code below</li>
</ol>
<p>More information <a target="_blank" href="make_template.php?link_selected='. $link_selected.'">here on how to build your own web site template</a>.
<p style="text-align:left; ">*For a fee of only $15 we can create the entire page which includes everything from creating your page template from your website to insertng the BungeeBones code. We will email you the finished page and all you will need to do is insert the file into your site at the proper location. We can even do that for you (if you give us access to the server your site is on) for only an additional $5. To order yours use the <a href="http://Bungeebones.com/feedback.php">contact form</a> in the left menu on the BungeeBones.com home page. 

<h3 style="text-align:left; ">Maneuvering The "Head Section" Code</h3>
<p style="text-align:left; ">What you will be doing is replacing the first portion of your existing web page template code with the first block of code in the BungeeBones Barebones version. By the "first portion" of the page I mean literally every bit of code from the very beginning of the code to "somewhere" in the head section but, in no case, ever replacing the closing head tag (the closing head tag looks like this - &lt;/head&gt;).
<p style="text-align:left; ">Within that first block of the Barebones code pasted on your page, everything from between the opening php tag (&lt;?php) to the second of the closing php tags (?&gt;) is critical to proper operation. Everything between that closing php tag and the closing head tag are, however, reserved for your own page\'s critical code. 
<p style="text-align:left; ">Here is a list of some things that might be critical to the proper operation or display of your page and that you need to make certain remain included in the head section code (but after the BungeeBones code):
<ul><li>CSS style links, code, urls etc.</li>
<li>Javascript and/or other scripts functions</li>
<li>"Analytics" code</li>
<li>Any other code unique to your template and that is already within the head section</li></ul>

<p style="text-align:left; ">After you have included all of your own needed head code you can close the head section with your current pages closing head tag.
<p style="text-align:left; ">Also worth mentioning is that BungeeBones comes with its own dynamic metatags for the head section. The <b>title, description, and keywords</b> are all dynamically built for each individual page that the web directory script displays. And later on, in step three, you also get to customise those metatags to your indivual website as well. Basically BungeeBones customises the page to the category of links being displayed while your settings customise them to your website.

<h3 style="text-align:left; ">Maneuvering The "Body Section" Code</h3>
<p style="text-align:left; ">The second block of the Barebones Version code needs to be inserted into the body section of the page. To locate that look for the body tag that at least begins like this: &lt;body. The reason I said "at least begins like this" is because the body tag often has styling information, class or ID names etc inside of it too. Unlike in the head section, we don\'t have to make any changes to the tag. Simply copy and paste the second block of code, including all the php tags (both the opening &lt;? and the closing ?&gt;), into your web directory page. Your directory should be functioning within your own page template now. If not, see the troubleshooting section below.

<p> <a target="_blank" style="color: white;" href="widget_barebones_version_code.php?link_selected='. $link_selected.'"  >BareBones Version Code</a>

<h2 style="color: white;">Step 3 - Custom Configuration</h2>
<p style="text-align:left; "><b>After you have installed the directory and it is working properly then you can make a number of customisations and brand it to your website by such things as:
<ul><li>Page Titles Custom To Your Website </li>
 <li>Page Titles Custom To The Category And Your Website </li>
<li>Page Header Meta Tags Custom To Your Website And To The Category </li>
<li>Custom "Add A Link" Buttons</li>
<li>Custom "Leaving Page" - notifies users 1) the web directory is 3rd party 2) they are leaving your site 3) you endorse BungeeBones</li>
<li>Select How/When/If Your Directory Displays Free Links</li>
<li>Select If Your Directory Links Are "NoFollow"</li>
<li>And More</li>
</ul>


<p> <a style="color: white;" href="widget_config.php?link_selected='. $link_selected.'"  >Customise</a>


</P>
<h2 style="text-align:left;  color: white;">Trouble Shooting</h2>
<p style="text-align:left; ">There are basically just three things that can go wrong with your installation
<ol><li>Your web directory and page location and/or name(s) are wrong in the configuration</li>
<li>Your web hosting company has settings that are preventing the web directory from communicating with the BungeeBones server</li>
<li>You accidentally erased or added extraneous code when you created your own template or when you added the blocks of BungeeBones code to it</li></ol>
<h3 style="text-align:left; ">1) Wrong Directory/Page Names or Configurations</h3>
<p style="text-align:left; ">This is the easiest problem to fix. Just check that the directory name and the page name AND EXTENSION are correct in stage one. You can go and edit them and make sure of spelling and especially that the page name uses the .php extension (ie. its name is something like "index.php").
<h3 style="text-align:left; ">2) Wrong Host Settings</h3>
<p style="text-align:left; ">BungeeBones uses a software project called <a target="_blank" href="curl.haxx.se">CURL</a> which provides a library and command-line tool for transferring data between servers. If your hosting company does not have CURL installed then BungeeBones won\'t work there. 
<p style="text-align:left; ">There are two ways to determine if your hosting company supports CURL. The first is quite easy. You simply ask them. CURL is widely used and they most likely are familar with it. If it is not installed ask them if they will install it for you.
<p style="text-align:left; ">If for some reason you can\t find out from your hosting company then you can add just one more page to your directory that you will add just three lines of code in it like below
<p style="text-align:left; ">&lt;?php
<p style="text-align:left; ">echo phpinfo();
<p style="text-align:left; ">?&gt;
<p style="text-align:left; ">You then need to save it to your website and visit it with your browser. You can place it anywhere and name it anything you like but it, like the web directory page, needs the .php extension to function correctly. So, if you want, save it to the same directory you created above and name it phpinfo.php.
<p style="text-align:left; ">Now visit the page by entering its URL or address into your browser. You should see an information packed page that tells you all about the php settings on your hosting account. Scroll down through it or do a page search for a section about CURL. If it is installed you can\'t miss it. If it is not installed there will be no mention of it. If it isn\'t installed I again suggest youcontact your host and ask them to install it. It is quite easy to install but if for some reason they can\t or won\'t then you have a problem. If it were me, I would move to a different hosting company.
<h3 style="text-align:left; color: white;" >3) Messed Up Code</h3>
<p style="text-align:left; ">Making sure that your own web page template functions properly before adding any BungeeBones code is crucial. So, assuming the template was working properly we then have to look for some error made when posting the code to the page. This can be a little bit tricker to track down. Sometimes the simplest things such as an extra or ommitted comma, parenthesis, quotes etc can be right in front of us and we keep missing it.
<p style="text-align:left; ">The first thing I would do, in order to make sure it is, indeed a coding problem, is to temporaily restore the operation of the template version (you did have that funtioning at the beginning of the installation process right?). It is very easy to do that. Go back to step one and replace the page name there with the new name you gave the template version. In my instructions I suggested you rename the template "troubleshooter.php". If that is what you did, then change the name in the page location in step one to "troubleshooter.php" and then open that page in a browser. If it is functioning normally you have, indeed, isolated it to a coding issue on your barebones page. So reverse the process and change the configuration back to the name of your barebones page.
<h3>Some common errors and possible causes</h3>
<ul><li>Web directory displays but the page borders are all pushed out of position or directoy display in a side bar instead of the main body.</li>
<ul><li>There are tags that divide up your page into sections. They are most often the &lt;div&gt; tag but they also could be &lt;td&gt; or &lt;tr&gt;. They pretty much have to occur in pairs of opening and closing tags. The closing tag is just like the opening one except it contains a slash in fron to the tag name. If you past the code on the wrong side of a tag it will cause hings like that.
</li><ul><li>Recommended approach - Unless you are very skilled at "debugging" code then by far the easiest approach would be simply to start fresh with a copy of your blank template. 
</li?</ul>
</ul>


 
</td></tr></table>';
}
else
{


$msg .= '<a name="custom"></a> <table style = "margin-left:auto; 
    margin-right:auto;" bgcolor="gray" width="75%"><tr><td><p style="text-align:left; font-size: 125%;"> ';

$msg .=   '<p style="text-align:left; "><h1 style="color: navy;">Link Enrollment Report</h1>

<p> <a style="color: white;" href="registered_links.php?link_selected='. $link_selected.'" title="Link Enrollment Report" >Link Enrollment Report</a> See which websites enrolled in the BungeeBones system from your website.
<p style="text-align:left; "><h1 style="color: navy;">Paid Link Purchase Report</h1>
<a style="color: white;" href="registered_paid_links.php?link_selected='. $link_selected.'" title="Paid Link Purchase" >Paid Link Purchase/Cancellation Reports</a>. See which websites have enrolled as paid links and are earning you commissions, which/if any have cancelled, which have increased their bid, or reduced their bid.
<p style="text-align:left; "><h1 style="color: navy;">Web Directory Installations Report</h1>
<a style="color: white;" href="report_widget_installations.php?link_selected='. $link_selected.'">Web Directory Installations Report</a>. See which websites that enrolled at your website have installed a web directory on their own site and are earning you commissions.
<h1 style="color: navy;"> Commission Earnings History Report</h1> 
<p> <a style="color: white;" href="../reports/user_cp_commissions_report.php?link_selected='. $link_selected.'" title="Commission History Reports" >Commission History Report</a>
<p style="text-align:left; ">See your earnings history.

</td></tr></table>';

}



echo $msg;
echo '<a href="../index.php"> <h2><u>Return To User Control Panel</u></a>

<br><a href="widget_index_custom.php?link_selected=104&type=manage">Return To Web Directory Management Panel</a></h2>';


include($_SERVER['DOCUMENT_ROOT']."/bungee_jumpers/templatebottomnsb.php");

} else {
    // the user is not logged in...
    include("../views/not_logged_in.php");
}

