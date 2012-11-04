<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Download";
 ?>
<p>
  DynamO is an open-source and free code, made available under version
  3 of the GPL licence. Here you can download prebuilt packages for
  Ubuntu systems or obtain the source code to compile your own copy of
  DynamO.
</p>
<h1>Ubuntu Packages</h1>
<p>
  At the moment, there are no stable releases available for Ubuntu as
  these prebuilt packages are a new feature for DynamO 1.4.0. You can
  use the development versions by adding the DynamO Daily Build PPA to
  your system. See the details in the link below
</p>
<?php button("View the Ubuntu PPA","https://code.launchpad.net/~dynamomd/+archive/dynamo-daily-ppa");?>
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
  GitHub repository</a>.
</p>

<p>
  Just install git and use the following command in your terminal:
</p> 
<?php codeblockstart(); ?>git clone https://github.com/toastedcrumpets/DynamO.git<?php codeblockend("brush: shell;"); ?>
<p>
  This will create a folder called <em>DynamO</em> in the working
  directory. If this command fails, you can try the alternative git
  protocol address using the command below:
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
<h2>Alternative Source Code Downloads</h2>
<p>
  It is recommended that you use the git to download the source code
  whenever possible. However, incase there is any problem accessing
  git on your computer, you may download a copy of the sources using
  the links below.
</p>
<?php button("Download Latest Development Branch","https://github.com/toastedcrumpets/DynamO/zipball/master");?>
<?php button("Download Stable Version 1.3.2","https://github.com/toastedcrumpets/DynamO/zipball/dynamo-1-3-2");?>
<?php button("Download Stable Version 1.2","https://github.com/toastedcrumpets/DynamO/zipball/dynamo-1-2");?>
