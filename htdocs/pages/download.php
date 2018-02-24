<?php
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Download";
   ?>
<?php printTOC(); ?>
<p>
  DynamO is free and open-source, made available under version 3 of
  the GPL licence. On this page you
  can <a href="#source-code-downloads">download the source code</a> or
   <a href="#prebuilt">prebuilt packages</a> for a range of Linux distributions.
</p>

<h1 id="prebuilt">Prebuilt Windows/Linux/OSX packages</h1>
<p>
  <a href="https://github.com/toastedcrumpets/DynamO/releases/">Click here to see all releases</a>.
</p>
<p>
  Please note, you may need to install additional packages for DynamO
  to work.
</p>
<p>
  A Ubuntu PPA is available which enables automatic updates of DynamO.
  To install, add the PPA to your system and install the dynamo
  packages. A brief summary of the shell commands required is given
  below, and further instructions are given at
  the <a href="https://launchpad.net/~dynamomd/+archive/dynamo-daily-ppa">PPA
  site</a> if required.
</p>
<?php codeblockstart(); ?>sudo add-apt-repository ppa:dynamomd/dynamo-daily-ppa
sudo apt-get update
sudo apt-get install dynamomd
<?php codeblockend("bash"); ?>
<h1>Source Code</h1>
<p>
  The code is hosted on
  the <a href="http://github.com/toastedcrumpets/DynamO">DynamO GitHub
  site</a> and can be browsed online there. For instructions on how to
  download the code using Git and compile it please, see the first
  tutorial:
</p>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<p>
</p>
