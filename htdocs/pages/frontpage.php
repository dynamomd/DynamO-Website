<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Welcome";
   ?>
<div style="float:right;">
  <?php embedfigure("/images/frontpage.png", 250, 269, "See the <a href=\"/index.php/features\">Features</a> section for examples of what DynamO can do.");?>
</div>
<p>
  DynamO is a free and open-source event-driven particle
  simulator. Event-driven simulation is a fast and <u>analytical</u>
  technique for particle simulation and is an alternative approach to
  the more traditional time-stepping approaches (such as those found
  in
  <a href="http://www.gromacs.org/">Gromacs</a>, <a href="http://web678.public1.linz.at/Drupal/?q=OpenSourceDEM">Liggghts</a>,
  and <a href="http://www.ks.uiuc.edu/Research/namd/">NAMD</a>).
  DynamO is a reference implementation of many established
  event-driven models and a research platform for the latest advances
  in event-driven algorithms.
</p>
<p>
  You can use DynamO as a molecular dynamics package to study model
  fluids or as a granular dynamics package to investigate solid
  particle processes (such as the hopper flow to the right). A wide
  range of particle models are available, from the basic hard sphere,
  to square-wells, stepped Lennard-Jones potentials, thin needles
  and more.
</p>
<p>
  Take a look at the
  <a href="/index.php/features">features / gallery</a> section of the
  website to see examples of what systems DynamO can simulate. You
  can <a href="/index.php/download">download</a> a copy, and take a
  look at the <a href="/index.php/documentation">documentation</a> to
  evaluate it for yourself.
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
  include($filename); 
}
?>
