<?php
pagestart("News");

//Look in the news directory and create a date sorted list of the news items
$file_array=glob('pages/news/*.html');
rsort($file_array);
ob_start();
foreach ($file_array as $filename) { echo "<hr />"; include($filename); }

pageend();
?>
