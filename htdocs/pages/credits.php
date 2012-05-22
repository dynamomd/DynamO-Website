<?php pagestart("Credits"); ?>
<img height="80" width="214" alt="Logo for the University of Aberdeen" src="/images/UoALogo.png" style="margin: 45px 15px 10px 15px; float:left;" />
<img height="80" width="200" alt="Logo for the EPSRC" src="/images/EPSRC.png" style="margin: 45px 15px 10px 15px; float:left;" />
<img height="150" width="192" alt="Logo for the MSS research group in Erlangen" src="/images/MSS_logo.png" style="margin: 10px 15px 10px 15px; float:left;" />
<div style="clear: both;"></div>
<h1>Programming Credits</h1>
<ul>
  <li>
    <b>Marcus Bannerman (2006-Present)</b>: DynamO was originally developed
    during Marcus' PhD, under the supervision of Dr Leo Lue and was
    funded through a EPSRC doctoral training award. From 2009 till
    2011, this work continued during his Post-Doc at the University of
    Erlangen-Nuremberg in the research group of Prof. Thorsten
    Poeschel. Now Marcus is a lecturer at Aberdeen University and
    continues to orientate his research around DynamO and event driven
    simulators.
  </li>
  <li>
    <b>Leo Lue (2006-Present)</b>: Provided a complete event driven code,
    histogram reweighting scripts and more which were used as references
    while DynamO was developed. Leo provides a great amount of
    theoretical/technical support and more recently implemented the MJ
    model for protein interactions.
  </li>
  <li>
    <b>Robert Sargant (2008-2010)</b>: Rob started the work on
    asymmetric potentials with rotational degrees of freedom. He
    implemented the dynamics of lines and the essential root finder of
    Frenkel and Maguire among other improvements. He was also funded
    by the EPSRC.
  </li>
</ul>
<h1>Libraries and Source Code Used</h1>
<ul>
  <li>
    A templated vector and matrix class, provided
    by <a href="http://www.chem.utoronto.ca/~rzon/">Ramses van
    Zon</a>, is used as the basis for most vector operations.
  </li>
  <li>
    Callbacks are implemented
    using <a href="http://www.codeproject.com/KB/cpp/FastDelegate.aspx">FastDelegates</a>
    , provided by Don Clugston.
  </li>
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
    The build system used to build DynamO
    is <a href="http://www.boost.org/boost-build2/">boost build</a>.
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
    A big thank you to Michael R Sweet for
    creating <a href="http://www.easysw.com/~mike/fldiff/index.html">fldiff</a>,
    a program which makes it so easy to compare good and bad EDMD
    trajectories, its has saved hours of debugging in the scheduler code.
  </li>
  <li>
    Cédric Laugerotte's website was a great help for determining
    <a href="http://student.ulb.ac.be/~claugero/sphere/index.html">tesselations
    of spheres</a>.
  </li>
</ul>
<?php pageend(); ?>
