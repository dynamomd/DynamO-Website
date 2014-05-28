<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Support";
 ?>
<?php printTOC(); ?>
<p>
  If you think you have a straightforward question, please check
  the <a href="/index.php/documentation">online documentation</a>
  first to see if it answers your questions. In particular, check
  the <a href="/index.php/FAQ">FAQ</a>.
</p>
<p>
  DynamO is a research project which has been open-sourced to help
  push forward both event-driven algorithms and discrete-potential
  models. The best way to recieve support is to contact and
  collaborate with researchers/developers familiar with DynamO.
</p>
<h1>Contacting the Developers</h1>
<p>
  You can contact the developers of DynamO by emailing the following
  address:
</p>
<?php button("support@dynamomd.org", "mailto:support@dynamomd.org");?>
<p>
  If it turns out that you've discovered a bug in DynamO, you will be
  encouraged to post a bug report on the Github issue tracker so you
  can track when the bug is fixed.
</p>
<h1>Reporting Bugs</h1>
<p>
  If you think you've found a bug, please report it using the GitHub
  Issue tracker link below. The bug tracker allows others to see how
  your problem might be resolved and it also allows you to track the
  progress in dealing with any reported issues.
</p>
<?php button("GitHub Issue/Bug Tracker",
      "https://github.com/toastedcrumpets/DynamO/issues");?>
<p>
  Please note, you will need a (free) GitHub account.
</p>
<h1>Alternatives</h1>
<p>
  If all else fails, there are some alternative event-driven packages
  (and groups) available and they are listed here:
</p>
<ul>
  <li>
    <a href="http://cims.nyu.edu/~donev/Packing/PackLSD/Instructions.html">PackLSD </a>
    (or an <a href="http://cherrypit.princeton.edu/Packing/C++/">older
    version</a>):<br /> This is powerful code aimed at generating
    densely packed hard particle (ellipsoidal) configurations. DynamO
    uses the same techniques for compression but it is currently
    limited to spheres or shapes composed of multiple spheres. The
    PackLSD code is simpler as it is targeted only to the task of
    generating hard particle packings, yet more advanced in that it
    handles ellipsoids. It also contains tools for analysing the
    packed configuration.
  </li>
  <li>
    <a href="http://danger.med.unc.edu/tools.php">iFold:</a> This is
    an event driven simulator for protein simulations presented by the
    Dokholyan group. It doesn't appear that the simulator is
    publically available but the results are impressive.
  </li>
  <li>
    <a href="http://www.speadmd.org/">SPEADMD</a> : This is a
    collection of event driven potentials and Thermodynamic
    Perturbation Theory (TPT) which can be used to accurately estimate
    the thermophysical properties of compounds. The results are
    extremely impressive and details on the potential parameters are
    reported in publications. The simulation code does not appear to
    be publically available but simulations can be requested through a
    web interface.
  </li>
  <li>
    <a href="http://nba.uth.tmc.edu/cds/">Cellular Dynamic
      Simulator</a>: <br /> An impressive package designed to simulate
      biological processes. Includes support for triangle meshes,
      brownian dynamics, and also has its own 3D visualizer.
  </li>
  <li>
    <a href="http://people.cas.uab.edu/~khu/gt/Hardballs">Hardballs</a>:
    <br /> This appears to be the start of 2D EDMD simulation code.
  </li>
  <li>
    <a href="http://www.lps.ens.fr/~krauth/index.php/Bernard_Krauth_Wilson_2009">Event-Chain
      Algorithm:</a> <br />A remarkable event-driven algorithm capable
      of evolving discrete and continuous potential
      configurations. Not molecular dynamics but a great example of
      advanced algorithmic ideas from the event driven particles
      field.
  </li>
</ul>
