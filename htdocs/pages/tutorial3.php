<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 3: Exploring the Configuration File Format";
   ?>
<div style="text-align:center; border: 5px solid; margin:15px;  background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written.</b>
</div>
<?php printTOC(); ?>
<p>
  In this tutorial we'll start to explore the file format of DynamO
  and look at ways of setting up arbitrary simulations.
</p>
<h1>Introduction</h1>
<p>
  When studying a new system, we need to find a convenient way to
  generate configurations across the range of study parameters we
  wish to explore.
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
<h1>The Example Configuration</h1>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedvideo("hardspheres", "tn6Cz0tNPuU", 400, 250); ?>
  <div class="caption">
    The starting configuration of 1372 hard-spheres with periodic
    boundary conditions.
  </div>
</div>
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
<h1>General Layout</h1>
<p>
  Open the XML file and take a look at the top of the file. You'll
  notice that there is a short line at the top that identifies this
  file as an XML file:
</p>
<?php codeblockstart(); ?>
<?xml version="1.0"?>
<?php codeblockend("brush: xml;"); ?>
<p>
  Underneath this lies the contents of the file. You will notice that
  the whole content of the file is enclosed within a pair
  of <b>DynamOconfig</b> <i>tags</i>. In XML, these are called
  the <i>root tags</i>:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Whenever some content has been omitted we will use "..." to indicate
  the XML data we have skipped. There is
  a <b>version</b> <i>attribute</i> in
  the <b>DynamOconfig</b> <i>tag</i> which is used by DynamO to check
  that the file format is the up-to-date version before trying to load
  it. This version number is only incremented when a major change in
  the file format is needed in a new version of DynamO.
</p>
<p>
  At the top of the file are a pair of <b>Simulation</b> tags.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  These contain most of the settings of the simulation and their
  contents are discussed in detail below. Beneath the simulation tags
  is the
  <b>Properties</b> tag:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
  <Properties/>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  You can see that this tag is empty in this configuration. It is only
  needed in polydisperse systems where there are a large number of
  parameters to set for each particle. Their use will be covered in a
  later tutorial but for now we can ignore them.
</p>
<h2>Particle Data</h2>
<p>
  Underneath the Properties tag, at the bottom of the file, lies
  the <b>ParticleData</b> tags.  You should see lots
  of <b>Pt</b> <i>tags</i> stored inside
  the <b>ParticleData</b> <i>tags</i>, like so:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
  <ParticleData>
    <Pt ID="0">
      <P x="-6.50000000000000e+00" y="-6.50000000000000e+00" z="-6.50000000000000e+00"/>
      <V x="-5.52389513657453e-01" y="-1.50017672465470e-01" z="-2.80144593124301e-01"/>
    </Pt>
    ...
  </ParticleData>
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Each of these <b>Pt</b> <i>tags</i> represent the data of a single
  particle.  Each <b>Pt</b> <i>tag</i> has
  an <b>ID</b> <i>attribute</i>, which is a unique number used to help
  you identify the particle. <u>This ID number is not read by
  DynamO</u> when it loads the configuration file. DynamO loads and
  assigns ID's to the particles in the order they appear in the
  configuration file. It is just written there for your reference of
  the ID numbers DynamO last used.
</p>
<p>
  Inside the particle (<b>Pt</b>) <i>tag</i> there are two
  enclosed <i>tags</i> called <b>P</b>
  and <b>V</b>. The <b>P</b> <i>tag</i> holds the position of a
  particle within the system and the <b>V</b> tag holds the particles
  velocity.
</p>
<p>
  You may notice that there is no mass or size of the particles
  specified here. This is because of the very general and unique
  functional definition of "properties" of particles possible in
  DynamO. The mass of a particle is defined by <b>Species</b> tags,
  and its interaction properties, such as its diameter, are specified
  in <b>Interaction</b>, <b>Global</b>, and <b>Local</b> tags in the
  Simulation section. These are now discussed in the following
  section.
</p>
<h1>Simulation Tags</h1>
<p>
  The <b>Simulation</b> tags are where the details of the system are
  stored. There is a huge number of settings that can be adjusted
  here, so we will deal with each tag separately.
</p>
<h2>Scheduler</h2>
<p>
  The first tag in the <b>Simulation</b> section are
  the <b>Scheduler</b> tags (please ignore the ensemble tags for now,
  they will be removed in a future version).
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
  <Scheduler Type="NeighbourList">
    <Sorter Type="BoundedPQMinMax3"/>
  </Scheduler>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  The Scheduler tags contain the settings for the event scheduler and
  event sorter, which are the parts of DynamO responsible for
  determining which event happens next in the simulation. 
</p>
<p>
  Changing the scheduler settings should never affect the results
  DynamO generates, but a correct set of settings will greatly
  increase DynamO's speed. The Scheduler tags will almost always look
  as they do above, as these are the optimal settings for most simple
  systems. These settings are to use a neighbour list to detect
  events, and to use a Bounded Priority Queue on Min-Max heaps for
  event sorting.
</p>
<h2>Simulation Settings</h2>
<p>
  In the <b>Simulation</b> <i>tag</i> there is another <i>tag</i>
  called <b>SimulationSize</b>. Unsurprisingly, this holds the size of
  the simulation domain.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
  <SimulationSize x="1.400000000000e+01" y="1.400000000000e+01" z="1.400000000000e+01"/>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we can see the simulation is performed in a
  $14\times14\times14$ domain. We will see in a moment that this
  system has periodic boundary conditions, but even infinite systems
  must have some finite size specified for the neighbourlist to
  function, so you will always see a SimulationSize tag in your
  configurations.
</p>
<h2>Boundary Conditions</h2>
<p>
  Another mandatory tag within the Simulation tags is the Boundary
  Condition (<b>BC</b>) tag.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  ...
  <BC Type="PBC"/>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>

<p>
  Here we can see that the current BCs are Periodic Boundary
  Conditions (<b>PBC</b>). If you change the boundary conditions
  to <b>None</b>, like so:
</p>
<?php codeblockstart(); ?>
...
<BC Type="None"/>
...
<?php codeblockend("brush: xml;"); ?>
<div class="figure" style="float:right;width:337px;">
  <iframe width="333" height="250" src="https://www.youtube-nocookie.com/embed/RzjmpRtwDAw"></iframe>
  <div class="caption">
    The same configuration as in the movie above, but with the
    Boundary Conditions set to <b>None</b>.
  </div>
</div>
<p>
  The configuration will now exist in an infinite domain without
  boundaries (see the video on the right). The particles will be
  allowed to fly off in all directions, which is very useful if you
  want to simulate a single polymer or any system with gravity.
</p>
<p>
  But be warned, if you now try to convert back to periodic boundary
  conditions, all particle positions will be "folded" back into the
  simulation domain specified by the <b>SimulationSize</b> tag (a
  cubic $14\times14\times14$ volume). This "folding" will probably
  result in overlapping particles leading to invalid dynamics, so you
  need to be careful when changing Boundary Conditions from None to
  PBC.
</p>
<p>
  There are also Lees-Edwards shearing boundary conditions available
  in DynamO (<b>Type="LE"</b>) which will be discussed in a future
  tutorial.
</p>
<h2>Species</h2>
<h2>Interactions</h2>
<h2>Locals</h2>
<h2>Globals</h2>
<h2>Dynamics</h2>
<h2>Units</h2>
<p>
  A common question users ask when first using DynamO is "What are the
  units of Dynamo?" and the answer is whichever units you use. Every
  setting in the configuration file has consistent units. If you
  specify all lengths in meters, all times in seconds and all masses
  in kilograms then you should use Joules when specifying
  energies. There is no hidden units within the simulator.
</p>
<p>
  One exception to this is the Boltzmann constant. DynamO assumes this
  to be $k_B=1$. What this means is that when you specify the
  temperature in DynamO, you are actually specifying the thermal unit,
  $k_B\,T$.
</p>
<p>
  In practice, event-driven simulations are usually carried out in
  some reduced set of units. For this reason, any configuration
  generated by <b>dynamod</b> will have one set of particles with a
  mass and diameter of 1. In athermal systems such as hard spheres,
  the temperature is set to 1 to set the time and energy units. In
  energetic systems such as square wells, one interaction energy is
  set to 1 to set the time and energy units.
</p>
