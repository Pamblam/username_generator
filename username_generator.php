<?php

// if a pdo connection, table and column name are passed it will 
// make sure the username isn't already used.
function username_generator($pdo=null, $table=null, $column=null){
	$nouns = explode("\n",file_get_contents("nouns.txt"));
	$adjs = explode("\n",file_get_contents("adjs.txt"));
	$username = ucfirst(strtolower($adjs[array_rand($adjs)])).
		ucfirst(strtolower($nouns[array_rand($nouns)]));
	if(empty($pdo)) return $username;
	$q = $pdo->query("select count(1) from `$table` where `$column` = '$username'");
	return !!count($q->fetch(2)) ? username_generator($pdo, $table, $column) : $username;
}

