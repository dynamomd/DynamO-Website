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
  can <a href="#source-code-downloads">download the source code</a> so
  you can compile DynamO yourself or, if you have Ubuntu linux, you
  can use the <a href="#ubuntu">prebuilt packages for
  Ubuntu</a>.
</p>
<p>
  Currently, DynamO will only compile and run on <b>Gnu/Linux</b>
  based systems (e.g., Ubuntu/Gentoo/RedHat/Suse) and there are no
  plans at this time to create a windows version of DynamO. The code
  should compile with only minor modifications on Mac systems, but
  this has not been tested.
</p>
<h1>Ubuntu</h1>
<p>
  To download and install DynamO on Ubuntu, it is recommended that you
  add a DynamO PPA repository so that you recieve automatic updates
  and bug fixes.
</p>
<h2>Stable Releases</h2>
<p>
  Once DynamO 1.4.0 has been released, a PPA with the stable packages
  will be posted here.
</p>
<h2>Daily Development Releases</h2>
<p>
  There is a daily build of the DynamO development tree which you can
  use to get the latest versions and features. Just add the daily
  build PPA to your ubuntu system using the following terminal
  commands:
</p>
<?php codeblockstart(); ?>sudo add-apt-repository ppa:dynamomd/dynamo-daily-ppa
sudo apt-get update
sudo apt-get install dynamo-core dynamo-tools dynamo-visualisation<?php codeblockend("brush: shell;"); ?>
<p>
  More information about the PPA is given on its Launchpad site.
</p>
<?php button("Ubuntu Daily Build PPA","https://code.launchpad.net/~dynamomd/+archive/dynamo-daily-ppa");?>
<h1>Source Code Downloads</h1>
<p>
  There are several ways you can obtain a copy of the source code and
  these are listed below.  Once you have a copy of the source code you
  can compile DynamO by
  <a href="/index.php/tutorial1">following the tutorial</a>.
</p>
<h2>Git Access to the Source</h2> 
<p>
  The recommended method of downloading an up-to-date copy of the
  DynamO sources is using git and
  the <a href="https://github.com/toastedcrumpets/DynamO"> public
  GitHub repository</a>. Using git, it is easy to update your version
  of the code and to send any changes you make back to the developers.
  To get a copy of the code, just install git and use the following
  command in your terminal:
</p> 
<?php codeblockstart(); ?>git clone http://github.com/toastedcrumpets/DynamO.git<?php codeblockend("brush: shell;"); ?>
<p>
  This will create a folder called <em>DynamO</em> in the working
  directory. If this command fails (you have a restrictive proxy), you
  can try the alternative git protocol address using the command
  below:
</p>
<?php codeblockstart(); ?>git clone git://github.com/toastedcrumpets/DynamO.git<?php codeblockend("brush: shell;"); ?>
<p>
  You can now pick which branch or version of DynamO you'd like. There
  are several available:
</p>
<ul>
    <li>
      <b>dynamo-1-3-2:</b> This is the most recent stable release, the
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
<?php codeblockstart(); ?>git checkout dynamo-1-3-2<?php codeblockend("brush: shell;"); ?>
<p>
  Now that you've downloaded the source code, you can follow the tutorial on how to compile DynamO:
</p>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<h2>Alternative Source Code Downloads</h2>
<p>
  It is recommended that you use the git to download the source code
  whenever possible. However, incase there is any problem accessing
  git on your computer, you may download a copy of the sources using
  one of the links below.
</p>
<?php button("Download Latest Development Branch","https://github.com/toastedcrumpets/DynamO/zipball/master");?>
<?php button("Download Stable Version 1.3.2","https://github.com/toastedcrumpets/DynamO/zipball/dynamo-1-3-2");?>
<?php button("Download Stable Version 1.2","https://github.com/toastedcrumpets/DynamO/zipball/dynamo-1-2");?>
