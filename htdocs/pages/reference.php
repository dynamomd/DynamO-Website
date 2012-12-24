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
  <b>This tutorial is currently being written, so it may be incomplete or contain errors.</b>
</p>
<p>
  In this appendix, a complete description of the file format is
  presented. This reference documentation is relatively brief as an
  <a href="/index.php/tutorial3">introduction to the file format is
  covered in tutorial 3</a>.
</p>
<h1>Scheduler</h1>
<h1>Simulation Size</h1>
  
