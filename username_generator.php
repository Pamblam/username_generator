<?php

// if a pdo connection, table and column name are passed it will 
// make sure the username isn't already used.
function username_generator($pdo=null, $table=null, $column=null){
	$here = realpath(dirname(__FILE__));
	$adjs = file("$here/adjs.txt");
	$nouns = file("$here/nouns.txt");
	$username = trim(ucfirst(strtolower($adjs[array_rand($adjs)]))).
		trim(ucfirst(strtolower($nouns[array_rand($nouns)])));
	if(empty($pdo)) return $username;
	$q = $pdo->query("select count(1) as cnt from `$table` where `$column` = '$username'");
	return !!$q->fetch(2)['cnt'] ? username_generator($pdo, $table, $column) : $username;
}

