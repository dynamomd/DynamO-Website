<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Documentation";
 ?>
<?php printTOC(); ?>
<h1>The Basics</h1>
<p>
  All of the documentation of DynamO assumes that you have some
  experience with both Linux and Molecular Dynamics simulation. Here
  some resources are provided to help with these basics if you have no
  prior experience in these topics.
</p>
<p>
  DynamO, like many Linux programs, is driven through a Command-Line
  Interface (CLI). To be able to use DynamO, you will need to be
  familiar with the Linux terminal. Take a look
  at <a href="http://www.linuxcommand.org">this link</a> to learn more
  about the terminal and how it works if you are at all unsure what
  this means.
</p>
<p>
  If you're looking for general documentation on Molecular Dynamics,
  there are a few good introductory textbooks available. The
  definitive text by Allen and Tildesley has always been very popular
  with students and veterans alike.
</p>
<p style="text-align:center;">
  &quot;Computer Simulation of Liquids,&quot;
  M. P. Allen, and D. J. Tildesley, 1989, Oxford Science Pub.
</p>
<p>
  A short summary of the basics, written by Allen
  is <a href="http://www2.fz-juelich.de/nic-series/volume23/allen.pdf">also
  available online</a> if you cannot find a copy of the book.
</p>
<p>
  Although the fundamentals of Molecular Dynamics are always the same,
  the event-driven techniques used in DynamO differ in implementation
  from the techniques described in the resources above.. These
  differences are best described in the excellent book by Haile.
</p>
<p style="text-align:center;">
  &quot;Molecular Dynamics Simulation: Elementary Methods,&quot;
  J. M. Haile, 1992, Wiley
</p>
<h1>User Documentation/Tutorials</h1> 
<p>
  The user documentation for DynamO comes in the form of a set of
  tutorials on the basic topics. Please click on any of the links
  below to take a look
</p>
<div style="clear:both;"></div>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<?php button("Tutorial 2: Running a Simulation of Hard Spheres","/index.php/tutorial2");?>
<?php button("Tutorial 3: Exploring the Configuration File Format","/index.php/tutorial3");?>
<?php button("Appendix A: Parsing Output and Config Files","/index.php/tutorialA");?>
<p>
  If what you need to simulate is not covered in the tutorials, but is
  listed in the <a href="/index.php/features">features</a>, please
  feel free to email the developers for some advice (see below).
</p>
<h1>Developer Documentation</h1>
<p>
  If you're looking to extend DynamO or to understand how it works,
  you'll need to take a look at the source code. The DynamO API is
  partially documented using Doxygen and a up to date version is
  available at the link below.
</p>
<?php button("DynamO API Documentation","/doxygen");?>
<h1>Support and Reporting Bugs</h1>
<p>
  If you think you've found a bug, please report it using the GitHub
  Issue tracker link below.
</p>
<?php button("GitHub Issue Tracker",
      "https://github.com/toastedcrumpets/DynamO/issues");?>
<p>
  If you have a problem which is not a bug and cannot find the answer
  in the documentation, you can email your queries to the following
  address:
</p>
<?php button("support@dynamomd.org", "mailto:support@dynamomd.org");?>
<h1>Citing DynamO</h1>
<p>
  If you find the DynamO useful and publish a paper using results
  obtained from DynamO, please help support it's development by citing
  the following paper.
</p>
<div style="text-align:center;">
  M. N. Bannerman, R. Sargant, L. Lue, "DynamO: A free O(N) general
    event-driven simulator,"<em>
    J. Comp. Chem.</em>, <b>32</b>, 3329-3338 (2011)"
</div>
<?php button("Link to journal article","http://dx.doi.org/10.1002/jcc.21915");?>
<h1>Alternatives</h1>
<p>
  There are some alternative event driven packages available on the
  internet and they are listed here:
</p>
<ul>
  <li>
    <a href="http://www.speadmd.org/">SPEADMD</a> : This is a
    collection of event driven potentials and Thermodynamic
    Perturbation Theory (TPT) which can be used to accurately estimate
    the thermophysical properties of compounds. The results are
    extremely impressive, although it appears that the fine details on
    the potentials used are not readily available and the code is
    unavailable, except via a web interface.</li>
  <li>
    <a href="http://cims.nyu.edu/~donev/Packing/PackLSD/Instructions.html">PackLSD </a>
    (or an <a href="http://cherrypit.princeton.edu/Packing/C++/">older
    version</a>):<br /> This is powerful code aimed at generating
    densely packed hard particle (ellipsoidal) configurations. DynamO
    uses the same techniques for compression but it is limited to
    spherical shapes. The PackLSD code is also simpler as it is
    targeted only to the task of generating hard particle packings,
    yet more advanced in that it handles more general particle
    shapes. It also contains tools for analysing the packed
    configuration.
  </li>
  <li>
    <a href="http://danger.med.unc.edu/tools.php">iFold:</a> This is
    an event driven simulator for protein simulations presented by the
    Dokholyan group. It doesn't appear that the source code for the
    simulator is freely available.
  </li>
  <li>
    <a href="http://halmd.org/index.html">HALMD</a>: <br />This looks
    like a general time-stepping package but it has a backend for
    performing simulations of hard spheres.
  </li>
  <li>
    <a href="http://nba.uth.tmc.edu/cds/">Cellular Dynamic
      Simulator</a>: <br /> An impressive package designed to simulate
    biological processes. Includes support for triangle meshes,
    brownian dynamics, and also has its own 3D visualizer.
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
