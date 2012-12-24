<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Appendix C: Configuration File Format Reference";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This reference is currently being written and is incomplete.</b>
</p>
<p>
  In this appendix, a complete description of the file format is
  presented. This reference documentation is terse as an
  <a href="/index.php/tutorial3">introduction to the file format is
  covered in tutorial 3</a>.
</p>
<h1>Scheduler</h1>
<h2>"Dumb" Type</h2>
<h2>"NeighbourList" Type</h2>
<h2>"SystemOnly" Type</h2>
<h1>Simulation Size</h1>
