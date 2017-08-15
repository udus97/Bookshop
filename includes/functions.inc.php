<?php
require_once "db.inc.php";
require_once "meekrodb.2.3.class.php";
require_once "HTMLTable.class.php";


DB::$user = DBUSER;
DB::$password = DBPASS;
DB::$dbName = DB;


function generate_datalist_html(){
	$html = "";
	$authors = DB::query('SELECT distinct authorName from author');

	foreach($authors as $author){
		$author_name = $author['authorName'];
		$html .= "<option label = '$author_name' value = '$author_name'>";
	}
	return $html;
}

