<?php
function endswith($string, $test) {
  $strlen = strlen($string);
  $testlen = strlen($test);
  if ($testlen > $strlen) return false;
  return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
  }

try {
  if (!isset($_GET['packagename'])) {
    throw new RuntimeException('Missing package name.');
  }

  $packagetypes = array("ubuntu14.04.deb", "ubuntu12.04.deb", "centos6.6.rpm", "centos7.rpm", "fedora21.rpm", "debian7.deb", "opensuse13.2.rpm");

  foreach($packagetypes as $distroid) {
    if (!endswith($_GET['packagename'], $distroid)) continue;
      
    //First, load and save the file packages
    /* PUT data comes in on the stdin stream */
    $putdata = fopen("php://input", "r");
    /* Open a file for writing */
    $fp = fopen("build-uploads/".$_GET['packagename'], "w");
    if (!$fp) {
      throw RuntimeException('Failed to open output file:'."build-uploads/".$_GET['packagename']);
    }
    /* Read the data 1 KB at a time and write to the file */
    while ($data = fread($putdata, 1024)) fwrite($fp, $data);
    /* Close the streams */
    fclose($fp);
    fclose($putdata);
    echo "Successfully uploaded package\n";

    // Find all related distribution files and sort by modify date
    $buildfiles = glob('build-uploads/*'.$distroid);
    array_multisort(array_map( 'filemtime', $buildfiles), SORT_NUMERIC,SORT_DESC, $buildfiles);
    
    $builds_to_keep=3;
    foreach(array_slice($buildfiles, $builds_to_keep) as $target) {
      echo "Deleting old build :".$target."\n";
      unlink($target);
    }
    
    exit();
  }
  throw new RuntimeException('Failed to identify the distribution.');
} 
catch (RuntimeException $e) {
  header('Content-Type: text/plain; charset=utf-8');
  echo "This script is not for public use: Debug error message below:\n";
  echo $e->getMessage()."\n";
}
?>
