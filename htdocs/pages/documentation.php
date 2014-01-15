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
<p>
  All of the documentation of DynamO assumes the reader has some
  experience with both Linux and Molecular Dynamics simulation. The
  tutorials are aimed at graduate-level students and so cover some of
  the basics of the techniques. There are
  some <a href="#recommended-resources">recommended resources</a>
  listed below which will introduce the basics of these topics if you
  are at all unfamiliar with them.
</p>
<h1>User Documentation</h1> 
<p>
  The user documentation for DynamO comes in the form of a set of
  tutorials which take you through the fundamentals and lead you into
  more advanced applications of the code. There are also a set of
  references which you can use to explore any system not directly
  discussed in the tutorials. Some frequently asked questions are also
  answered in the <a href="/index.php/FAQ">FAQ page</a>.  If the
  system you wish to simulate is not covered in the tutorials, but is
  supported in the <a href="/index.php/features">features</a>, please
  feel free to
  <a href="/index.php/support#contacting-the-developers">contact the
  developers</a> for some advice.
</p>
<div style="clear:both;text-align:center;"><b>Tutorials</b></div>
<?php button("1: Compiling DynamO from Source","/index.php/tutorial1");?>
<?php button("2: Introduction to DynamO","/index.php/tutorial2");?>
<?php button("3: The configuration file","/index.php/tutorial3");?>

<?php button("4: Thermostats and transport properties","/index.php/tutorial4");?>
<?php button("5: Multiple Species/Interactions, compression dynamics, and ticker output plugins","/index.php/tutorial5");?>
<div style="clear:both;text-align:center;"><b>References</b></div>
<?php button("Configuration File Format Reference","/index.php/reference");?>
<?php button("Output Plugin Reference","/index.php/outputplugins");?>
<?php button("Frequently Asked Questions","/index.php/FAQ");?>
<?php button("Parsing Output and Config Files","/index.php/tutorialA");?>
<p>
</p>
<h1>Citing DynamO and Publications</h1>
<p>
  If you find the DynamO useful and publish a paper using results
  obtained from DynamO, please help support it's development by citing
  the following paper.
</p>
<div style="text-align:center;">
  M. N. Bannerman, R. Sargant,
    L. Lue, <a href="http://dx.doi.org/10.1002/jcc.21915">"DynamO: A
    free O(N) general event-driven simulator,"</a><i>
    J. Comp. Chem.</i>, <b>32</b>, 3329-3338 (2011)"</a>
</div>
<p>
  Below is a list of publications which have used DynamO in their
  results:
</p>
<ul>
  <li>
    C. Thomson, L. Lue, and M. N. Bannerman, <a href="http://dx.doi.org/10.1063/1.4861669">"Mapping continuous
      potentials to discrete forms,"</a> <i>J. Chem. Phys.</i>, <b>140</b>,
    034105 (2014)
  </li>
  <li>
    P. C. Royall, A. Malins, A. J. Dunleavy, and R. Pinney,
    <a href="http://events.tifrh.res.in/sof2014/Book/Patrick.pdf">"Geometric Frustration is Strong in Model Fragile
      Glassformers,"</a> <i>In Fragility of Glass-forming Liquids, TRiPS
      13</i>, Ed. A. L. Greer, K. F. Kelton, S. Sastry (2014)
  </li>
  <li>
    J. E. Kollmer, A. Sack, M. Heckel, F. Zimber, P. Mueller,
    M. N. Campbell Bannerman and T. Poeschel, <a href="">"Collective
    Granular Dynamics in a Shaken Container at Low Gravity
    Conditions,"</a> <i>AIP Conf. Proc.</i>, <b>1542</b>, 811-814
    (2013)
  </li>
  <li>
    S. Mandal, V. Chikkadi, B. Nienhuis, D. Raabe, P. Schall, and
    F. Varnik, <a href="http://dx.doi.org/10.1103/PhysRevE.88.022129">"Heterogeneous
    Shear in Hard Sphere Glasses,"</a> <i>Phys. Rev. E</i>, <b>88</b>,
    022129 (2013)
  </li>
  <li>
    S. Mandal, M. Gross, D. Raabe, and
    F. Varnik, <a href="http://dx.doi.org/10.1103/PhysRevLett.108.098301">"Heterogeneous
    Shear in Hard Sphere
    Glasses,"</a> <i>Phys. Rev. Lett.</i>, <b>108</b>, 098301 (2012)
  </li>
  <li>
      M. N. Bannerman, J. E. Kollmer, A. Sack, M. Heckel, P. Müller, and
      T. Pöschel, <a href="http://dx.doi.org/10.1103/PhysRevE.84.011301">"Movers
      and shakers: Granular damping in
      microgravity,"</a> <i>Phys. Rev. E</i>, <b>84</b>, 011301 (2011)
    </a>
  </li>
  <li>
      M. N. Bannerman and
      L. Lue, <a href="http://link.aip.org/link/?JCP/133/124506">"Exact
      event-rate formulae for square-well and square-shoulder
      systems,"</a> <i>J. Chem. Phys.,</i> <b>133</b>, 124506 (2010)
    </a>
  </li>
  <li>
    
      M. N. Bannerman, L. Lue, L. V. Woodcock <a href="http://link.aip.org/link/?JCPSA6/132/084507/1">"Thermodynamic pressures
      for hard spheres and closed-virial equation-of-state,"</a>
      <i>J. Chem. Phys.</i>, <b>132</b>, 084507 (2010)
    </a>
  </li>
  <li>
    Wm. G. Hoover, C. G. Hoover,
      M. N. Bannerman, <a href="http://dx.doi.org/10.1007/s10955-009-9795-0">"Single-Speed
      Molecular Dynamics of Hard Parallel Squares and Cubes,"</a>
    <i>J. Stat. Phys.</i>, <b>136</b>, 715-732 (2009)
  </li>
  <li>
    M. N. Bannerman, J. E. Magee,
    L. Lue, <a href="http://dx.doi.org/10.1103/PhysRevE.80.021801">"Structure
      and stability of helices in square-well
      homopolymers,"</a> <i>Phys. Rev. E</i>, <b>80</b>, 021801 (2009)
  </li>
  <li>
      M. N. Bannerman,
      L. Lue, <a href="http://dx.doi.org/10.1063/1.3120488">"Transport
      properties of highly asymmetric hard sphere
      mixtures,"</a> <i>J. Chem. Phys.</i>, <b>130</b>, 164507 (2009)
    </a>
  </li>
  <li>
    M. N. Bannerman, T. E. Green, P. Grassia,
    L. Lue, <a href="http://dx.doi.org/10.1103/PhysRevE.79.041308">"Collision
    statistics in sheared inelastic hard
    spheres,"</a> <i>Phys. Rev. E</i>, <b>79</b>, 041308 (2009)
    </a>
  </li>
</ul>
<p>
  If you have any publications you want to be listed here please
  <a href="/index.php/support#contacting-the-developers">contact the
  developers</a>.
</p>
<h1>Recommended Resources</h1>
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
  A short summary of the basics, also written by Allen,
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

