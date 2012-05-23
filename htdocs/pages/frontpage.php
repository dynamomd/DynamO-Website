<?php pagestart("Welcome"); ?>
<p>
  DynamO is a free and open-source event-driven particle simulator.
</p>
<p>
  It can be used to simulate a wide range of particle models, from
  hard spheres, to square-wells and stepped potentials, thin needles
  and more. From molecular dynamics to granular dynamics, DynamO
  implements the latest in event-driven algorithms and
  techniques.
</p>
<p>
  Take a look at the
  <a href="/index.php/features">features</a> to see if DynamO can
  simulate what you need, <a href="/index.php/download">download</a> a
  copy, and take a look at
  the <a href="/index.php/documentation">documentation</a> on how to
  install and use it.
</p>

<!-- Page End -->
<h1>Latest News</h1>
<?php 
//Look in the news directory and create a date sorted list of the news items
$file_array=glob('pages/news/*.html');
rsort($file_array);

if (!empty($file_array))
{ 
  $filename = current($file_array);
 echo "<div class=\"newsdate\">".date("jS F Y", filemtime($filename))."</div>";
 include($filename); 
}
pageend();
?>
