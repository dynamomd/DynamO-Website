<?php
/*Check that this file is being accessed by the template*/
if (!isset($in_template))
  {
    header( 'Location: /index.php/404');
    return;
  }

$pagetitle="Documentation";
ob_start();
   ?>
<h1>Tutorials</h1> 
<p>
  The documentation for DynamO is still being written and limited to a
  set of tutorials on the basic topics. Please click on any of the
  links below to take a look
</p>
<div style="text-align:center;"><?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?></div>
<p>
  If what you need to simulate is not covered in the tutorials, but is
  listed in the <a href="/index.php/features">features</a>, please
  feel free to email the developers for some advice (see below).
</p>

<h1>Source Code</h1>
<p>
  If you're looking to extend DynamO or to understand how it works,
  you'll need to take a look at the source code. The DynamO API is
  partially documented using Doxygen and a up to date version is
  available at the link below.
</p>
<div style="text-align:center;"><?php button("DynamO API Documentation","/doxygen");?></div>
<h1>Reporting Bugs</h1>
<p>If you think you've found a bug, please report it using the GitHub
Issue tracker link below.</p>
<div style="text-align:center;"><?php button("GitHub Issue
Tracker","https://github.com/toastedcrumpets/DynamO/issues");?></div>

<h1>Support</h1>
<p>If you have a problem which is not a bug and cannot find the answer
in the documentation, you can email your queries to the following
address:</p>
<p style="text-align:center;"><a href="mailto:support@dynamomd.org">support@dynamomd.org</a></p>
<h1>Citing DynamO</h1>
<p>If you find the DynamO useful and publish a paper using results
obtained from DynamO, please help support it's development by citing
the following paper.</p>
<div style="text-align:center;">
  M. N. Bannerman, R. Sargant, L. Lue, "DynamO: A free O(N) general
    event-driven simulator,"<em>
    J. Comp. Chem.</em>, <strong>32</strong>, 3329-3338 (2011)"
  <br/><a href="http://dx.doi.org/10.1002/jcc.21915"> Link to journal article</a>
</div>
<!-- Page End -->
<?php $content = ob_get_clean(); ?>
