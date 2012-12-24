<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Example: Multicomponent Square-Well Fluid";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written, so it may be incomplete or contain errors.</b>
</p>
<h1>Setting up the Configuration File</h1>
<h1>Running the Simulation</h1>
<h1>Processing the Results</h1>