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
   <a href="#prebuilt-ubuntu">prebuilt packages for Ubuntu</a>.
</p>
<h1>Source Code</h1>
<p>
For instructions on how to download the code using Git and compile it
  please, see the first tutorial:
</p>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<p>
  The code is hosted on
  the <a href="http://github.com/toastedcrumpets/DynamO">DynamO GitHub
  site</a> and can be browsed online there.  It is recommended that
  you use Git to download the code, but you can also download a zip of
  the latest source code using the link below.
</p>
<?php button("Download Zip of the Development Branch","https://github.com/toastedcrumpets/DynamO/zipball/master");?>
<h1 id="prebuilt-ubuntu">Ubuntu</h1>
<p>
  There is a nightly build of the DynamO development tree which you
  can use to get the cutting-edge features and automatic updates
  whenever they are released.
</p>
<p>
  To install, add the PPA to your system and install the dynamo
  packages. A brief summary of the shell commands required is given
  below, and further instructions are given at
  the <a href="https://launchpad.net/~dynamomd/+archive/dynamo-daily-ppa">PPA
  site</a> if required.
</p>
<?php codeblockstart(); ?>sudo add-apt-repository ppa:dynamomd/dynamo-daily-ppa
sudo apt-get update
sudo apt-get install dynamo-core dynamo-tools dynamo-visualisation
<?php codeblockend("bash"); ?>
