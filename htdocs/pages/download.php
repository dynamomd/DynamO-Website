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
   <a href="#prebuilt">prebuilt packages for Ubuntu</a>.
</p>

<h1 id="prebuilt">Prebuilt packages</h1>
<p>
  These are live builds of the DynamO source code for a range of
  popular Linux distributions. You may need to install additional
  packages for DynamO to work.
</p>
<?php
function endswith($string, $test) {
  $strlen = strlen($string);
  $testlen = strlen($test);
  if ($testlen > $strlen) return false;
  return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
  }

echo "<p><ul>\n";
try {
  $packagetypes = array("ubuntu14.04.deb" => "Ubuntu 14.04", "ubuntu12.04.deb" => "Ubuntu 12.04", "centos7.rpm" => "CentOS 7 (RedHat Enterprise Linux)", "centos6.6.rpm" => "CentOS 6.6 (RedHat Enterprise Linux)", "fedora21.rpm" => "Fedora 21", "debian7.deb" => "Debian 7 (Wheezy)", "opensuse13.2.rpm" => "OpenSUSE 13.2");
  
  foreach($packagetypes as $extension => $distroid) {    
    $buildfiles = glob('../build-uploads/*'.$extension);
    if(!empty($buildfiles)) {
      array_multisort(array_map( 'filemtime', $buildfiles), SORT_NUMERIC,SORT_DESC, $buildfiles);
      echo " <li><a href=\"/".$buildfiles[0]."\">".$distroid."</a></li>\n";
    }
  }
}
catch (RuntimeException $e) {
  header('Content-Type: text/plain; charset=utf-8');
  echo "<li>Failed to load the prebuilt packages. ";
  echo $e->getMessage()."</li>\n";
}
echo "</ul></p>\n";
?>
<p>
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
For instructions on how to download the code using Git and compile it
  please, see the first tutorial:
</p>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<p>
  The code is hosted on
  the <a href="http://github.com/toastedcrumpets/DynamO">DynamO GitHub
  site</a> and can be browsed online there.  It is recommended that
  you use Git to download the code.
</p>
