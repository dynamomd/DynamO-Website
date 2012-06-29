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
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written, so it may be incomplete or contain errors.</b>
</p>
<p>
  In this tutorial we'll start to explore the file format of DynamO
  and look at ways of setting up arbitrary simulations. Understanding
  the configuration file format is key to understanding how to use and
  setup DynamO, even if the dynamod tool already generates the systems
  you're interested in. The configuration file format is also key to
  understanding the DynamO code, as it introduces all of the
  terminology and concepts you need. Almost every parameter of a
  simulation, apart from its duration, is set inside the configuration
  file.
</p>
<h1>Introduction</h1>
<p>
  When studying a new system, we need to find a convenient way to
  generate configurations across the range of study parameters we wish
  to explore. For example, if we want to study hard spheres we need to
  generate systems at different densities and particle counts.
</p>
<p>
  Many sample configurations, with variable input parameters, can be
  generated using the dynamod tool; However, these example setups only
  cover systems studied by the DynamO developers and will not always
  be what you want.
</p>
<p>
  The recommended method for performing simulations with DynamO is to
  use dynamod to generate a configuration close to what you wish to
  simulate. This configuration can then be modified slightly to
  produce the exact system you wish to study. These changes can easily
  be automated to reduce the manual effort required
  (<a href="/index.php/tutorialA">See Appendix A</a> for more
  information).
</p>
<p>
  So in order to effectively use DynamO, we must have a good
  understanding of it's configuration file format. Then we can take a
  look at the dynamod examples in later tutorials, learn all of the
  different options and how to change them.
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
    DynamO</u> when it loads the configuration file. <b><u>DynamO loads
      and assigns ID's to the particles in the order they appear in the
      configuration file</u></b>. The ID is written there for your
  reference of the ID numbers DynamO used in the simulation that
  produced this file.
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
  <Simulation>
    <Scheduler Type="NeighbourList">
      <Sorter Type="BoundedPQMinMax3"/>
    </Scheduler>
    ...
  </Simulation>
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
  events, and to use a Bounded Priority Queue on three-element Min-Max
  heaps for event sorting.
</p>
<h2>Simulation Size</h2>
<p>
  In the <b>Simulation</b> <i>tag</i> there is another <i>tag</i>
  called <b>SimulationSize</b>. Unsurprisingly, this holds the size of
  the simulation domain.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <SimulationSize x="1.400000000000e+01" y="1.400000000000e+01" z="1.400000000000e+01"/>
    ...
  </Simulation>
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
<div class="figure" style="float:right;width:337px;">
  <?php embedvideo("infinitehardspheres", "RzjmpRtwDAw", 333, 250); ?>
  <div class="caption">
    The same configuration as in the movie above, but with the
    Boundary Conditions set to <b>None</b>.
  </div>
</div>
<p>
  Another mandatory tag within the Simulation tags is the Boundary
  Condition (<b>BC</b>) tag.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <BC Type="PBC"/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we can see that the current BCs are Periodic Boundary
  Conditions (<b>PBC</b>). If you change the boundary conditions
  to <b>None</b>, like so:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <BC Type="None"/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
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
<p>
  The next interesting tags are the <b>Species</b> tags within
  the <b>Genus</b> tags.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Genus>
      <Species Mass="1" Name="Bulk" IntName="Bulk" Type="Point" Range="All"/>
    </Genus>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  In DynamO, a single <b>Species</b> tag defines the mass and inertia
  tensor of a collection of particles. It also defines and allows the
  calculation any unique property of the particle. For example, it
  defines how the particles are represented when visualised and it
  defines the excluded volume of each so that a packing fraction can
  be calculated. Therefore, <u>each particle must belong to <b>exactly</b>
    one species</u>.
</p>
<p>
  The obvious attributes of the <b>Species</b> tag are the <b>Mass</b>
  of the particles and the <b>Name</b> of the Species. Names are used
  when reporting collected results which vary by the species, such as
  diffusion coefficients, radial distribution functions, and so on.
<p>
  The <b>IntName</b> attribute specifies the name of
  the <b>Interaction</b> (see below) that can be used to visualise
  this particle. For example, if the Interaction named "Bulk" was a
  hard-sphere interaction, spheres would be used to draw the
  particle. If it was a hard line or parallel cube Interaction, lines
  or cubes respectively would be used to render them. This interaction
  is also queried for the excluded volume of each particle of the
  Species, for example when calculating the packing fraction of the
  system.
</p>
<p>
  The <b>Type</b> parameter specifies the class of inertia tensor that
  the particle has. A value of "Point" implies that this particle has
  no rotational degrees of freedom, such as atoms in molecular
  systems. Other values, such as spherical top or a full tensor are
  available and are useful when studying granular systems.
</p>
<p>
  Finally, we come to the <b>Range</b> attribute, which is discussed
  in the next section.
</p>
<h2>Range Attributes</h2>
<p>
  The <b>Range</b> attributes are perhaps the most unique and
  confusing part of the DynamO file format. However, they are
  extremely powerful and a very elegant method for mapping properties
  and interactions onto particles.
</p>
<p>
  <i>"Traditionally"</i> in other particle simulators, each particle has its
  own section of the configuration file (and memory) to store its
  mass. Unfortunately, in many simulations every particle has the same
  mass and this redundant storage of information wastes memory and
  speed. 
</p>
<p>
  What we want is a <i>"functional"</i> definition of properties, such
  as the mass. We would like to be able to specify it once, and
  then <i>map</i> this property onto a <b>range</b> of particles:
</p>
<div style="width:456px; margin: 15px auto; display:block;">
  <img src="/images/range_explanation.png" width="456" height="179" alt="A graphic comparing the traditional method of storing redundant particle data, and the functional method" />
</div>
<p>
  This "functional" mapping saves memory and the small computational
  cost of using these definitions is nothing compared to the speed
  increases due to the reduced use of the memory bandwidth.
</p>
<p>
  But how does this work in DynamO? You might have guessed by now, the
  range of particle ID's that a property such as the <b>Species</b>
  maps on to is specified by the <b>Range</b> attribute. If we take a
  look at the example configuration file again:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Genus>
      <Species Mass="1" Name="Bulk" IntName="Bulk" Type="Point" Range="All"/>
    </Genus>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here it is clear to see that the Range attribute has a value of
  "All", which means all particles have the same Species (and
  therefore mass, intertia tensor and representative Interaction).
  Multiple species can be defined in a straightforward way. For
  example, we can change the configuration file so that we have two
  <b>Species</b>, each with a different mass:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Genus>
      <Species Mass="1" Name="A" IntName="Bulk" Type="Point" Range="Ranged" Start="0" End="134"/>
      <Species Mass="0.001" Name="B" IntName="Bulk" Type="Point" Range="Ranged" Start="135" End="1371"/>
    </Genus>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we can see that the particles with IDs in the range $[0,134]$
  belong to Species "A" and the particles with IDs in the range
  $[135,13499]$ belong to Species "B"! Both Species have the
  same <b>IntName</b> attribute here, but in true binary systems you
  will probably need different interactions for different species.
</p>
<p>
  In later tutorials, we will see some more types of Ranges and how
  they can be used. We will also see what to do when functional
  definitions are difficult, such as in polydisperse systems where
  every particle has a unique mass and size.
</p>
<h2>Interactions</h2>
<p>
  The next important tags in the file format are
  the <b>Interaction</b> tags. These tags are used to specify the
  interactions between particles, whether they are non-bonded
  interactions, such as Lennard-Jones, or bonded interactions. The key
  definition of an Interaction is an event generator involving
  two-particles. Therefore, every two particle event is specified
  here, and <b><u>every pair of particles must have a corresponding
      Interaction!</u></b>
</p>
<p>
  If we take a look at the example configuration file again, we have:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Interactions>
      <Interaction Type="HardSphere" Diameter="1" Elasticity="1" Name="Bulk" Range="2All"/>
    </Interactions>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we can see the <b>Type</b> attribute specifying that this is a
  hard sphere interaction,
</p>
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
