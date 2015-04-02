<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Credits";
 ?>
<img alt="Logos for the University of Aberdeen, EPSRC, and the MSS research group in Erlangen" src="/images/credit_logos.png" style="height:auto;max-height:74px;width:100%;max-width:503px;margin:15px auto; display:block;" />
<h1>Programming Credits</h1>
<ul>
  <li>
    <b>Marcus Bannerman</b>: DynamO was originally developed
    during Marcus' PhD, under the supervision of Dr Leo Lue and was
    funded through a EPSRC doctoral training award. From 2009 till
    2011, this work continued during his Post-Doc at the University of
    Erlangen-Nuremberg in the research group of Prof. Thorsten
    Poeschel. Now Marcus is a lecturer at Aberdeen University and
    continues to orientate his research around DynamO and event driven
    simulators.
  </li>
  <li>
    <b>Leo Lue</b>: Provided a complete event driven code, histogram
    reweighting scripts, and more which were used as reference
    implementations while DynamO was developed. Leo provides a great
    amount of theoretical/technical support and implemented the MJ
    model for protein interactions.
  </li>
  <li><b>Gil Rutter</b>: Gil implemented the PRIME protein potential,
  which is the first complex multi-site potential in DynamO. This
  required significant development and determination of the
  free/unpublished model parameters. Gil continues to work on
  developing this model.
  </li>
  <li>
    <b>Robert Sargant</b>: Robert began the implementation of
    asymmetric potentials with rotational degrees of freedom. He
    implemented the dynamics of lines and the root finder of Frenkel
    and Maguire among other improvements. Robert was funded by the
    EPSRC under a DTA award.
  </li>
</ul>
<h1>Libraries and Source Code Used</h1>
<ul>
  <li>
    XML parsing uses <a href="http://rapidxml.sourceforge.net/">RapidXML</a>.
  </li>
  <li>
    XML writing uses a small class provided by <a href="http://www.codeproject.com/KB/stl/simple_xmlwriter.aspx">Obolutus</a>.
  </li>
  <li>
    <a href="http://www.gtkmm.org/en/">Gtkmm</a>, <a href="http://cairographics.org/">Cairo</a>, <a href="http://ffmpeg.org">FFMPEG</a>
    and the <a href="http://www.boost.org/">boost</a> libraries are
    some excellent open source libraries utilised within the code.
  </li>
  <li>
    The build system used is the CMake system.
  </li>
  <li>
    <a href="http://boscoh.com/">Bosco ho</a> provided
    the <a href="http://boscoh.com/protein/rmsd-root-mean-square-deviation">reference
    script</a> from which the RMSD calculations of polymer structures
    script is based.
  </li>
  <li>
    MinMax Heaps are based on an implementation provided
    by <a href="http://www.coldbrains.com/">T. Wease.</a>
  </li>
  <li>
    A small PNG library is used for saving snapshots and was provided
    by <a href="http://www.blue-neutrino.com/">Severin Strobl</a>.
  </li>
  <li>
    Thank you to Michael R Sweet for creating fldiff, a program which
    makes it so easy to compare good and bad EDMD trajectories and has
    saved hours of debugging in the scheduler code. This has now been
    superceeded by the meld program.
  </li>
  <li>
    Cédric Laugerotte's website (now offline) was a great help for determining
    tesselations of spheres</a>.
  </li>
</ul>
