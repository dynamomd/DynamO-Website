<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial A: Parsing Output/Config Files";
   ?>
<p>
  This tutorial will show you some of the ways in which you can
  extract information from DynamO files via scripting. To understand
  what's going on here you should already be familiar with how DynamO
  operates and have a good idea what information you'd like to
  extract.
</p>
<p style="text-align:center;">
  <b><u>This is not a tutorial on the file format of DynamO.</u></b>
</p>
<p>
  Please take a look at tutorial 3 to learn more about the file formats.
</p>
<p>
  This tutorial is designed to help people interface DynamO with other
  pieces of software, or to write tools to process the results of
  simulations. Please consider sharing any tool you create and think
  is interesting to others.
</p>
<h1>Shell Scripting</h1>
<p>
  Something
</p>
<h1>Python</h1>
<p> 
  Something
</p>
<?php codeblockstart(); ?>dynamod<?php codeblockend("brush: shell;"); ?>
