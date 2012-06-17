<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 3: Exploring the Configuration File Format";
   ?>
<p>
  In this tutorial we'll start to explore the file format of DynamO
  and look at ways of setting up arbitrary simulations.
</p>
<h1>1. Introduction</h1>
<p>
  When studying a new system, we need to find a convenient way to
  generate sample configurations generated across the range of study
  parameters that we wish to simulate.
</p>
<p>
  Many sample configurations, with variable input parameters, can be
  generated using the dynamod tool; However, these example setups only
  cover systems studied by the DynamO developers and will sometimes
  not exactly coincide with the wishes of the DynamO user.
</p>
<p>
  The recommended method for performing simulations with DynamO is to
  use dynamod to generate a configuration close to what you wish to
  simulate. This configuration can then be modified to produce the
  exact system you wish to study. These changes can easily be
  automated to reduce the manual effort
  required (<a href="/index.php/tutorialA">See Appendix A</a> for
  more information).
</p>
<p>
  So in order to effectively use DynamO, we must have a good
  understanding of it's configuration file format.
</p>
<h1>2. The Starting Configuration</h1>
<p>
  We will generate a standard hard sphere configuration and use it to
  explore the file format. We will also demonstrate the effect of some
  simple changes as well.  We have chosen to look at the hard sphere
  configuration as it is one of the simplest configurations we can
  generate.
</p>
<p>
  To begin, use dynamod to generate a hard sphere configuration like
  so:
</p>
<?php codeblockstart(); ?>
dynamod -m 0 -d 0.5 -C 7 -o config.start.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  Some example output is provided at the button below for
  convenience. Note that your own generated output will have different
  randomly-assigned-velocities than the example provided.
</p>
<?php button("Example Configuration File","/pages/config.tut3.xml");?>
<p>
  XML files can be opened and edited by your favourite text editor. If
  you click the link above you will see that modern web browsers will
  present the contents of an XML file nicely, but you won't be able to
  edit them.
</p>
<h1>3. The Tags</h1>
<p>
  Open the XML file and take a look at the top of the file. You'll
  notice that there is a short line at the top that identifies this
  file as an XML file:
</p>
<?php codeblockstart(); ?>
<?xml version="1.0"?>
<?php codeblockend("brush: xml;"); ?>
<p>
  Underneath this is the contents of the file. You will notice that he
  whole content of the file is enclosed within a pair
  of <b>DynamOconfig</b> <em>tags</em>.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Whenever some content has been omitted we will use "..." to indicate
  the XML data we have skipped.
</p>
<p>
  We'll start with the particle data first. At the bottom of the file,
  you should see lots of <b>Pt</b> <em>tags</em> stored inside
  a <b>ParticleData</b> <em>tag</em>:
</p>
<?php codeblockstart(); ?><ParticleData>
...
<Pt ID="56">
<P x="-6.50000000000000e+00" y="-2.50000000000000e+00" z="-6.50000000000000e+00"/>
<V x="5.20851366504843e-01" y="-5.38736236641469e-01" z="-1.56915668716473e+00"/>
</Pt>
...
</ParticleData>
<?php codeblockend("brush: xml;"); ?>
<p>
  Each of these <b>Pt</b> <em>tags</em> represent the data of a single
  particle.
</p>
<p>
  Each <b>Pt</b> tag has an <b>ID</b> <em>attribute</em>, which is a
  unique number used to identify the particle, and two
  enclosed <em>tags</em> called <b>P</b>
  and <b>V</b>. The <b>P</b> <em>tag</em> holds the position of a
  particle within the system and the <b>V</b> tag holds the particles
  velocity.
</p>
<p>
  At the top of the file, the actual dynamics of the simulation are
  specified. For example, in the <b>Simulation</b> <em>tag</em> there
  is another <em>tag</em>
  called <b>SimulationSize</b>. Unsurprisingly, this holds the size of
  the simulation domain.
</p>
<?php codeblockstart(); ?>
<SimulationSize x="1.400000000000e+01" y="1.400000000000e+01" z="1.400000000000e+01"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  There are many other <em>tags</em> in the configuration file. For
  example, the <b>BC</b> <em>tag</em> sets the boundary conditions of
  the simulation. The type may be <b>"PBC"</b> for periodic boundary
  conditions or <b>"None"</b> for an infinite system.
</p>
<p>
  If you want to simulate a certain system, it is recommended you take
  the nearest system available in dynamod, then look at other examples
  to understand how to add whatever else you might require. But for
  now, we will just use this starting configuration to run a
  simulation and collect snapshots of the system.
</p>

