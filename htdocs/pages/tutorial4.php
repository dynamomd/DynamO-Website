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
<p>
  This tutorial uses an example study of multicomponent square-well
  particles to introduce several topics:
</p>
<ul>
  <li>
    How to specify multiple species and complex interactions in the
    configuration file.
  </li>
  <li>
    How to compress a simulation to high density.
  </li>
  <li>
    How to process collected data, including transport coefficients,
    in the output file.
  </li>
</ul>
<p>
</p>
<h1>Setting up the Configuration File</h1>
<h1>Running the Simulation</h1>
<h1>Processing the Results</h1>
