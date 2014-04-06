<?php
/**
 * Litlle Baby DDoS Shield MyBB Plugin v0.1
 * Credit to TweetyCoaster for Little Baby DDoS Shield Codes
 =======================================================
 * Little Baby DDoS Shield MyBB Plugin is still in Beta.
 * Developed By Moss (http://www.facebook.com/jinxwayne)
 */
if(!defined("IN_MYBB"))
{
	header('Status: 404 Not Found'); 
	echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
</body></html>";
 exit;
}
function littlebaby_info()
{
	return array(
        "name"  => "Little Baby DDoS Shield Plugin for MyBB",
        "description"=> "This php ddos sheild code was written by TweetCoaster And MyBB plugin was developed by Moss",
        "website"        => "http://www.facebook.com/jinxwayne",
        "author"        => "TweetyCoaster,Moss",
        "authorsite"    => "http://www.yehg.net,http://www.facebook.com/jinxwayne",
        "version"        => "v0.1",
        "guid"             => "",
        "compatibility" => "*"
    );
}
## Little Baby Install & Activate ##
function littlebaby_activate()
{
	global $db;
	$littlebaby_group = array(
        'gid'    => 'NULL',
        'name'  => 'littlebaby',
        'title'      => 'Little Baby DDoS Shield Settings',
        'description'    => 'Change the settings for Admin Email.',
        'disporder'    => "40",
        'isdefault'  => 'no',
    );
	$db->insert_query('settinggroups', $littlebaby_group);
    $gid = $db->insert_id(); 
	$littlebaby_setting1 = array(
        "sid" => "NULL",
        "name" => "littlebaby_subject",
        "title" => "Subject",
        "description" => "This is the subject of the email.",
        "optionscode" => "text",
        "value" => "Warning:",
        "disporder" => "1",
        "gid" => intval($gid),
    ); 
	$db->insert_query('settings', $littlebaby_setting1);
	$littlebaby_setting2 = array(
        "sid" => "NULL",
        "name" => "littlebaby_temail",
        "title" => "To Email",
        "description" => "All emails will be sent here.",
        "optionscode" => "text",
        "value" => "youremail@example.com",
        "disporder" => "2",
        "gid" => intval($gid),
        );
    $db->insert_query("settings", $littlebaby_setting2);
	$littlebaby_setting3 = array(
        "sid" => "NULL",
        "name" => "littlebaby_femail",
        "title" => "From Email",
        "description" => "All emails will be sent from here.  You do not have to fill in this field, but if you do, make sure the email is not being picked up as spam.",
        "optionscode" => "text",
        "value" => "",
        "disporder" => "3",
        "gid" => intval($gid),
        );
    $db->insert_query("settings", $littlebaby_setting3);
    rebuild_settings();
}
## Little Baby Deactivate ##
function littlebaby_deactivate() {

global $db, $mybb;
    require "../inc/adminfunctions_templates.php";
    $query = $db->query("SELECT gid FROM ".TABLE_PREFIX."settinggroups WHERE name='littlebaby'");
    $g = $db->fetch_array($query);
    $db->query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE gid='".$g['gid']."'");
    $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE gid='".$g['gid']."'");

rebuild_settings();

global $db;

}
?>