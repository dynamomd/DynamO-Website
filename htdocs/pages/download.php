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
  These builds of the DynamO source code are built regularly for a
  range of popular Linux distributions.
</p>
<?php
function endswith($string, $test) {
  $strlen = strlen($string);
  $testlen = strlen($test);
  if ($testlen > $strlen) return false;
  return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
  }

function YesNotd($value) {
   if ($value){
      echo "<td class=\"yes\">Yes</td>";
   } else {
      echo "<td class=\"no\">No</td>";
   }
  }

echo "<table id=\"download-table\">\n";
echo "<thead><tr><td>Distribution</td><td>Version</td><td>Build date</td><td>Visualiser</td><td>Adv. Potentials</td></tr></thead>\n";
echo "<tbody>\n";
try {
  $packagetypes = array(
    array("extension" => "ubuntu14.04.deb", "distro" => "Ubuntu 14.04", "vis" => True, "c++11" => True),
    array("extension" => "ubuntu12.04.deb", "distro" => "Ubuntu 12.04", "vis" => True, "c++11" => False), 
    array("extension" => "centos7.rpm", "distro" => "CentOS 7 (RedHat Enterprise Linux)", "vis" => False, "c++11" => False),
    array("extension" => "centos6.6.rpm", "distro" => "CentOS 6.6 (RedHat Enterprise Linux)", "vis" => False, "c++11" => False),
    array("extension" => "fedora21.rpm", "distro" => "Fedora 21", "vis" => True, "c++11" => True),
    array("extension" => "debian7.deb", "distro" => "Debian 7 (Wheezy)", "vis" => True, "c++11" => False),
    array("extension" => "opensuse13.2.rpm", "distro" => "OpenSUSE 13.2", "vis" => True, "c++11" => True));

  foreach($packagetypes as $data) {
    $buildfiles = glob('build-uploads/*'.$data["extension"]);
    if(!empty($buildfiles)) {
      array_multisort(array_map( 'filemtime', $buildfiles), SORT_NUMERIC,SORT_DESC, $buildfiles);
      $file=$buildfiles[0];
      preg_match("#dynamomd-([0-9\\.]+)#", $file, $matches);
      echo "<tr onclick=\"window.document.location='/".$file."'\">";
      echo "<td>".$data["distro"]."</a></td>";
      echo "<td>".$matches[1]."</td>";
      echo "<td>".date("d/m/y", filemtime($file))."</td>";
      YesNotd($data["vis"]);
      YesNotd($data["c++11"]);
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
  Please note, you may need to install additional packages for DynamO
  to work, and not all functionality is supported across all
  platforms. Only more recent distributions support the visualiser and
  advanced potentials.
</p>
<p>
  You can check the status of the builds using
  the <a href="http://cdash.dynamomd.org/index.php?project=DynamO">DynamO
  CDash site</a>. If your distribution or version is not listed above
  and you think it should be,
  please <a href="index.php/support#ContactingtheDevelopers">contact
  the developers</a> to request an additional build,
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
