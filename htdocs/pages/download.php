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

<h1 id="prebuilt">Prebuilt packages</h1>
<p>
  These builds of the DynamO source code are built each day for a range of
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

echo "<table id=\"download-table\">\n";
echo "<thead><tr><td>Version</td><td>Build date</td><td>Distribution</td></tr></thead>\n";
echo "<tbody>\n";
try {
  $packagetypes = array("ubuntu14.04.deb" => "Ubuntu 14.04", "ubuntu12.04.deb" => "Ubuntu 12.04", "centos7.rpm" => "CentOS 7 (RedHat Enterprise Linux)", "centos6.6.rpm" => "CentOS\
 6.6 (RedHat Enterprise Linux)", "fedora21.rpm" => "Fedora 21", "debian7.deb" => "Debian 7 (Wheezy)", "opensuse13.2.rpm" => "OpenSUSE 13.2");

  foreach($packagetypes as $extension => $distroid) {
    $buildfiles = glob('build-uploads/*'.$extension);
    if(!empty($buildfiles)) {
      array_multisort(array_map( 'filemtime', $buildfiles), SORT_NUMERIC,SORT_DESC, $buildfiles);
      $file=$buildfiles[0];
      preg_match("#dynamomd-([0-9\\.]+)#", $file, $matches);
      echo "<tr onclick=\"window.document.location='/".$file."'\">";
      echo "<td>".$matches[1]."</td>";
    echo "<td>".date("d/m/y", filemtime($file))."</td>";
      echo "<td>".$distroid."</a></td>";
      echo "</tr>\n";
    }
  }
}
catch (RuntimeException $e) {
  header('Content-Type: text/plain; charset=utf-8');
  echo "<li>Failed to load the prebuilt packages. ";
  echo $e->getMessage()."</li>\n";
}
echo "</tbody>\n";
echo "</table>\n";
?>
<p>
  If your distribution is not listed above,
  please <a href="index.php/support#ContactingtheDevelopers">contact the
    developers</a> to request an additional build,
  or <a href="/index.php/tutorial1">compile the code yourself</a>.
  <h1 id="prebuilt-ubuntu">Ubuntu PPA</h1>
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
