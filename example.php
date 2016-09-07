<?php

require "username_generator.php";

echo "10 randomly generated usernames:<ol>";
for($i=10;$i--;)
	echo "<li>".username_generator()."</li>";
echo "</ol>";
