<?php
session_start(); 
require("common.php");

$content = $db->real_escape_string($_POST['content']);
$T_ID = $db->real_escape_string(trim($_POST['T_ID']));
$per_page = $db->real_escape_string($_POST['per_page']);
$U_ID = $_SESSION['U_ID'];
$time = date('Y-m-d H:i:s');

$query = 'INSERT INTO Post(P_Number, T_ID, U_ID, Post_Time, Last_Edit_Time, Content) VALUES (null, '.$T_ID.', '.$U_ID.', \''.$time.'\', \''.$time.'\', \''.$content.'\');';
$db->query($query);
if ($db->error){
	exit('<meta http-equiv="refresh" content="0; url=' . urldecode($homepage.'thread.php?T_ID='.$T_ID.'database_error='.$db->error) . '"/>'); 
}

$query = 'SELECT COUNT(*) FROM Post WHERE T_ID='.$T_ID;
			$result = $db->query($query);
			$row = $result->fetch_row();
			$pagecount = (int)(($row[0]+$per_page-1)/$per_page);

exit('<meta http-equiv="refresh" content="0; url=' . urldecode($homepage.'thread.php?T_ID='.$T_ID.'&per_page='.$per_page.'&page='.$pagecount) . '"/>'); 
?>