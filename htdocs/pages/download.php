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
  DynamO is an open-source and free code, made available under version
  3 of the GPL licence. On this page you
  can <a href="#source-code-downloads">download the source code</a> or
  use the <a href="#installing-on-ubuntu-and-later">prebuilt packages
  for Ubuntu</a>.
</p>
<h1>Supported systems</h1>
<p>
  DynamO should compile and run on any modern <b>Linux</b>
  distribution and has been compiled on <b>Mac OSX</b> by several
  users. There is no version of DynamO for <b>Windows</b> at this
  time.
</p>
<p>
  If you intend to use the visualiser, it is highly recommended to
  compile or use the prebuilt packages on a Ubuntu system, as it
  requires a modern OpenGL/Mesa installation.
</p>
<h1 id="prebuilt">Prebuilt Packages (Ubuntu 12.04 and later)</h1>
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
<h1>Source Code</h1>
<p>
  There are several ways you can obtain a copy of the source code and
  these are listed below.  Once you have a copy of the source code you
  can compile DynamO by
  <a href="/index.php/tutorial1">following the tutorial</a>.
</p>
<h2>Git</h2> 
<p>
  The recommended method of downloading an up-to-date copy of the
  DynamO sources is using git and
  the <a href="https://github.com/toastedcrumpets/DynamO"> public
    GitHub repository</a>. Using git, it is easy to update your version
  of the code and to send any changes you make back to the developers.
  To get a copy of the code, just install git and use the following
  command in your terminal:
</p> 
<?php codeblockstart(); ?>git clone http://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  This will create a folder called <em>DynamO</em> in the working
  directory. If this command fails (you have a restrictive proxy), you
  can try the alternative git protocol address using the command
  below:
</p>
<?php codeblockstart(); ?>git clone git://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  You can now pick which branch or version of DynamO you'd like. There
  are several available:
</p>
<ul>
  <li>
    <b>v1-5-0:</b> This is the most recent stable release, the
    code is as stable as possible and has been thoroughly tested for
    bugs, but it may miss recently added features.
  </li>
  <li>
    <b>master:</b> This is the stable development branch for the
    next release of DynamO, code <i>should</i> compile and run
    without errors but it may be a little buggy.
  </li>
  <li>
    <b>experimental:</b> This is where new patches and features are
    born. Probably unstable and buggy, but very fresh! Not really
    meant for the public, but its been made available to let others
    track or join in the development process.
  </li>
</ul>
<p>
  If you decide you want something other than the default branch
  (master), just check it out by running the following command in the
  DynamO directory:
</p>
<?php codeblockstart(); ?>git checkout v1-5-0<?php codeblockend("bash"); ?>
<p>
  Now that you've downloaded the source code, you can follow the tutorial on how to compile DynamO:
</p>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<h2>Zip file</h2>
<p>
  It is recommended that you use the git to download the source code
  whenever possible; However, if you are having difficulties you may
  download a full copy of the source using the link below.
</p>
<?php button("Download Zip of the Development Branch","https://github.com/toastedcrumpets/DynamO/zipball/master");?>
