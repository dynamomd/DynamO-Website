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
  <i><u>&quot;Computer Simulation of Liquids,&quot;
  M. P. Allen, and D. J. Tildesley, 1989, Oxford Science Pub.</u></i>
</p>
<p>
  A short summary of the basics, written by Allen
  is <a href="http://www2.fz-juelich.de/nic-series/volume23/allen.pdf">also
  available online</a> if you cannot find a copy of the book.
</p>
<p>
  Although the fundamentals of Molecular Dynamics are always the same,
  the event-driven techniques used in DynamO differ in implementation
  from the techniques described in the resources above. These
  differences are best described in the excellent book by Haile.
</p>
<p style="text-align:center;">
  <i><u>&quot;Molecular Dynamics Simulation: Elementary Methods,&quot;
  J. M. Haile, 1992, Wiley</u></i>
</p>
<h1>User Documentation/Tutorials</h1> 
<p>
  The user documentation for DynamO comes in the form of a set of
  tutorials, which take you through the basic topics and lead you onto
  more advanced techniques. There is a set of reference appendices
  below which cover the fine details not included in the
  tutorials. Please click on any of the links below to take a look
</p>
<div style="clear:both;"></div>
<?php button("Tutorial 1: Compiling DynamO from Source","/index.php/tutorial1");?>
<?php button("Tutorial 2: Introduction to the DynamO workflow","/index.php/tutorial2");?>
<?php button("Tutorial 3: Overview of the Configuration File Format","/index.php/tutorial3");?>
<?php button("Tutorial 4: Example: Multicomponent Square-Well Fluid","/index.php/tutorial4");?>
<?php button("Appendix A: Parsing Output and Config Files","/index.php/tutorialA");?>
<?php button("Appendix B: Frequently Asked Questions","/index.php/FAQ");?>
<?php button("Appendix C: Configuration File Format Reference","/index.php/reference");?>
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
<h1>Publications/Citing DynamO</h1>
<p>
  If you find the DynamO useful and publish a paper using results
  obtained from DynamO, please help support it's development by citing
  the following paper.
</p>
<div style="text-align:center;">
  <a href="http://dx.doi.org/10.1002/jcc.21915">M. N. Bannerman,
    R. Sargant, L. Lue, "DynamO: A free O(N) general event-driven
    simulator,"<i> J. Comp. Chem.</i>, <b>32</b>, 3329-3338
    (2011)"</a>
</div>
<p>
  Below is a list of publications which have used DynamO in their
  results:
</p>
<ul>
  <li>
    <a href="http://dx.doi.org/10.1103/PhysRevLett.108.098301">
      S. Mandal, M. Gross, D. Raabe, F. Varnik, "Heterogeneous Shear
      in Hard Sphere Glasses," <i>Phys. Rev. Lett.<i>, <b>108</b>,
      098301 (2012)
    </a>
  </li>
  <li>
    <a href="http://dx.doi.org/10.1103/PhysRevE.84.011301">
      M. N. Bannerman, J. E. Kollmer, A. Sack, M. Heckel, P. Müller,
      T. Pöschel, "Movers and shakers: Granular damping in
      microgravity," <i>Phys. Rev. E</i>, <b>84</b>, 011301 (2011)
    </a>
  </li>
  <li>
    <a href="http://link.aip.org/link/?JCP/133/124506">
      M. N. Bannerman, L. Lue, "Exact event-rate formulae for
      square-well and square-shoulder systems," <i>J. Chem. Phys.,</i> <b>133</b>,
      124506 (2010)
    </a>
  </li>
  <li>
    <a href="http://link.aip.org/link/?JCPSA6/132/084507/1">
      M. N. Bannerman, L. Lue, L. V. Woodcock "Thermodynamic pressures
      for hard spheres and closed-virial equation-of-state,"
      <i>J. Chem. Phys.</i>, <b>132</b>, 084507 (2010)
    </a>
  </li>
  <li>
    <a href="http://dx.doi.org/10.1007/s10955-009-9795-0">
      Wm. G. Hoover, C. G. Hoover, M. N. Bannerman, "Single-Speed
      Molecular Dynamics of Hard Parallel Squares and Cubes,"
      <i>J. Stat. Phys.</i>, <b>136</b>, 715-732 (2009)
    </a>
  </li>
  <li>
    <a href="http://dx.doi.org/10.1103/PhysRevE.80.021801">
      M. N. Bannerman, J. E. Magee, L. Lue, "Structure and stability
      of helices in square-well homopolymers," <i>Phys. Rev. E</i>, <b>80</b>,
      021801 (2009)
    </a>
  </li>
  <li>
    <a href="http://dx.doi.org/10.1063/1.3120488">
      M. N. Bannerman, L. Lue, "Transport properties of highly
      asymmetric hard sphere
      mixtures," <i>J. Chem. Phys.</i>, <b>130</b>, 164507 (2009)
    </a>
  </li>
  <li>
    <a href="http://dx.doi.org/10.1103/PhysRevE.79.041308">
      M. N. Bannerman, T. E. Green, P. Grassia, L. Lue, "Collision
      statistics in sheared inelastic hard
      spheres," <i>Phys. Rev. E</i>, <b>79</b>, 041308 (2009)
    </a>
  </li>
</ul>


