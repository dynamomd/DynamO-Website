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
<p>
  In this tutorial we will start to explore the file format of DynamO,
  learn all of the DynamO terminology, and start to look at ways of
  setting up arbitrary simulations. 
</p>
<p>
  Understanding the configuration file format is key to understanding
  how to use and setup DynamO, even if the <b>dynamod</b> tool already
  generates the systems you're interested in. The configuration file
  format is also key to understanding the DynamO code, as it
  introduces all of the terminology and concepts you need.
</p>
<p>
  Almost every parameter of a simulation, apart from its duration, is
  set inside the configuration file, so you will at least need to be
  able to read the configuration file information even if you don't
  intend to change it.
</p>
<p>
  We will take a look at the same system as studied in the previous
  tutorial and use its configuration file as an example.
</p>
<h1>The Example Configuration</h1>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedvideo("hardspheres", "tn6Cz0tNPuU", 400, 250); ?>
  <div class="caption">
    The starting configuration of 1372 hard-spheres with periodic
    boundary conditions.
    <?php button("Show Configuration","/pages/config.tut3.xml");?>
  </div>
</div>
<p>
  We will generate a standard hard sphere configuration and use it to
  explore the file format. We will also demonstrate the effect of some
  simple changes as well.  We have chosen to look at the hard sphere
  configuration as it is one of the simplest configurations we can
  generate. The more complex settings will be covered in later
  tutorials.
</p>
<p>
  To begin, use <b>dynamod</b> to generate a hard sphere configuration
  like so:
</p>
<?php codeblockstart(); ?>
dynamod -m 0 -d 0.5 -C 7 -o config.start.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  Some example output is provided in the caption of the video to the
  right. Please note that your own generated output will have
  different randomly-assigned-velocities than the example provided.
</p>
<p>
  XML files can be opened and edited by your favourite text editor. If
  you click the button in the caption of the video you will see that
  web browsers will present the contents of an XML file nicely but to
  edit it you will need to save it and open the saved file in a text
  editor.
</p>
<h1>General Layout</h1>
<p>
  Open the XML file, <i>config.start.xml</i>, which was generated
  by <b>dynamod</b> and take a look at the top of the file. You'll
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
  Whenever some content has been omitted we will use &quot;...&quot;
  to indicate the XML data we have skipped. There is
  a <b>version</b> <i>attribute</i> in
  the <b>DynamOconfig</b> <i>tag</i> which is used by DynamO to check
  that the file format is the correct version before trying to load
  it. This version number is only incremented when a major change in
  the file format happens.
</p>
<p>
  At the top of the file, inside the root tags, are a pair
  of <b>Simulation</b> tags.
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
  These <b>Simulation</b> contain most of the settings of the
  simulation and their contents are discussed in detail below. Beneath
  the <b>Simulation</b> tags lies the <b>Properties</b> tag:
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
  Underneath the <b>Properties</b> tag, at the bottom of the file, lies
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
  velocity. DynamO always outputs numerical values in scientific
  notation to ensure no precision is lost when loading and saving.
</p>
<p>
  You may notice that there is no mass or size of the particles
  specified here. This is because of the general and unique functional
  definition of &quot;properties&quot; of particles in DynamO. Roughly
  speaking, the mass of a particle is defined by <b>Species</b> tags,
  and its interaction properties, such as its diameter, are specified
  in <b>Interaction</b>, <b>Global</b>, and <b>Local</b> tags which
  are all inside the <b>Simulation</b> section. Each of these tags are
  discussed in the following sections.
</p>
<h1>Simulation Tags</h1>
<p>
  The <b>Simulation</b> tags are where the details of the system
  dynamics are stored. There are a huge number of settings that can be
  adjusted here, so we will deal with each tag separately.
</p>
<h2>Scheduler</h2>
<p>
  The first tags in the <b>Simulation</b> section of the configuration
  file are the <b>Scheduler</b> tags (please ignore the ensemble tags
  for now, they will be removed in a future version).
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
  The <b>Scheduler</b> tags contain the settings for the event scheduler and
  event sorter, which are the parts of DynamO responsible for
  determining which event happens next in the simulation. 
</p>
<p>
  <u>Changing the <b>Scheduler</b> settings should never affect the
  results DynamO generates</u>. However, a correct set of settings
  will greatly increase DynamO's speed. The <b>Scheduler</b> tags will
  almost always look as they do above, as these are the optimal
  settings for most simple systems. These settings are to use a
  neighbour list to detect events, and to use a Bounded Priority Queue
  on three-element Min-Max heaps for event sorting.
</p>
<p>
  Instead of the <i>NeighbourList</i> <b>Scheduler</b> we could use
  the <i>Dumb</i> <b>Scheduler</b>:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    <Scheduler Type="Dumb">
      <Sorter Type="BoundedPQMinMax3"/>
    </Scheduler>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  The <i>Dumb</i> type is the simplest type of <b>Scheduler</b> and it
  doesn't need a NeighbourList to function. However, it is very slow
  as it checks all pairs of particles for events, regardless of their
  position. Its only practical use is when developing new types of
  <b>Interaction</b>s, or tracking down errors in the Neighbour List
  implementation.
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
  function, so you will always see a <b>SimulationSize</b> tag in your
  configurations.
</p>
<p>
  If we increase the size of the simulation domain to a
  $30\times30\times30$ domain:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <SimulationSize x="30" y="30" z="30"/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedvideo("hardspheres", "-QbpKrtPvWU", 400, 300); ?>
  <div class="caption">
    The effect of expanding the simulation domain.
    <?php button("Show Modified Configuration","/pages/config.tut3.expanded.xml");?>
  </div>
</div>
<p>
  We lower the density of the configuration and produce the video to
  the right. Notice that the particles are still in the center of the
  domain and expand outwards to fill the primary image. When using
  periodic boundary conditions, the positions in the configuration
  file are always written out in the range $(\pm L_x/2, \pm L_y/2, \pm
  L_z/2)$ so that the point $(0,0,0)$ lies in the middle of the
  simulation domain.
</p>
<p>
  If, instead of expanding, we tried to reduce the simulation domain
  we might find that we run into difficulties. This is because any
  particles now outside the primary image will be &quot;folded&quot;
  back into it, possibly causing overlapping particles and invalid
  dynamics.
</p>
<p>
  We will now look into how we can disable this periodic
  &quot;folding&quot; completely in the following section on boundary
  conditions.
</p>
<h2>Boundary Conditions</h2>
<p>
  Another mandatory tag within the <b>Simulation</b> tags is the
  Boundary Condition (<b>BC</b>) tag.
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
<div class="figure" style="float:right;width:337px;">
  <?php embedvideo("infinitehardspheres", "RzjmpRtwDAw", 333, 250); ?>
  <div class="caption">
    The same configuration as in the movie above, but with the
    Boundary Conditions set to <b>None</b>.
    <?php button("Show Modified Configuration","/pages/config.tut3.infinite.xml");?>
  </div>
</div>
<p>
  The configuration will now exist in an infinite domain without
  boundaries (see the video on the right). The particles will be
  allowed to fly off in all directions, which is very useful if you
  want to simulate a single isolated polymer, or any system with
  gravity.
</p>
<p>
  But be warned, if you now try to convert back to periodic boundary
  conditions, all particle positions will be &quot;folded&quot; back into the
  simulation domain specified by the <b>SimulationSize</b> tag (a
  cubic $14\times14\times14$ volume). This &quot;folding&quot; will probably
  result in overlapping particles leading to invalid dynamics, so you
  need to be careful when changing Boundary Conditions from <i>None</i> to
  <i>PBC</i>.
</p>
<p>
  There are also Lees-Edwards shearing boundary conditions available
  in DynamO (<b>Type</b>=&quot;<i>LE</i>&quot;) which will be
  discussed in a future tutorial.
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
  A single <b>Species</b> tag defines the mass and inertia tensor of a
  collection of particles. It also defines the calculation of certain
  unique properties of the particle. For example, it defines how the
  particles are represented when visualised. It also defines the
  excluded volume of each particle so that a packing fraction can be
  calculated. Therefore, <u>each particle must belong
  to <b>exactly</b> one species</u>.
</p>
<p>
  The obvious attributes of the <b>Species</b> tag are the <b>Mass</b>
  of the particles and the <b>Name</b> of
  the <b>Species</b>. <b>Name</b>s are used to identify particles when
  reporting species specific results, such as diffusion coefficients,
  radial distribution functions, and so on.
<p>
  The <b>IntName</b> attribute specifies the name of
  the <b>Interaction</b> (see below) that can be used to visualise
  this particle. For example, if the <b>Interaction</b> named
  &quot;Bulk&quot; was a hard-sphere interaction, spheres would be
  used to draw the particle. If it was a hard line or parallel cube
  Interaction, lines or cubes respectively would be used to render
  them. This interaction is also queried for the excluded volume of
  each particle of the <b>Species</b>, for example when calculating
  the packing fraction of the system.
</p>
<p>
  The <b>Type</b> parameter specifies the class of inertia tensor that
  the particle has. A value of <i>Point</i> implies that this particle
  has no rotational degrees of freedom, such as atoms in molecular
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
  <i>&quot;Traditionally&quot;</i> in other particle simulators, each particle
  has its own section of the configuration file (and memory) to store
  properties such as its mass, diameter, type and so
  on. Unfortunately, in many simulations many particles have the same
  properties and this redundant storage of information wastes memory
  and speed.
</p>
<p>
  What we want is a <i>&quot;functional&quot;</i> definition of
  properties where we can input statements like &quot;all particles
  have a mass of 1&quot; . We would like to be able to specify a
  property once, and then <i>map</i> this property onto a <b>range</b>
  of particles (see image below).
</p>
<div style="width:456px; margin: 15px auto; display:block;">
  <img src="/images/range_explanation.png" width="456" height="179" alt="A graphic comparing the traditional method of storing redundant particle data, and the functional method" />
</div>
<p>
  This &quot;functional&quot; mapping saves memory and the small computational
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
  Here it is clear to see that the <b>Range</b> attribute has a value
  of &quot;All&quot;, which means all particles have the
  same <b>Species</b> (and therefore mass, intertia tensor and
  representative Interaction).  Multiple <b>Species</b> can be defined
  in a straightforward way, and this is discussed in the next
  tutorial.
</p>
<p>
  In later tutorials, we will see some more types of <b>Ranges</b> and
  how they can be used. We will also see what to do when functional
  definitions are difficult, such as in polydisperse systems where
  every particle has a unique mass and size.
</p>
<h2>Topology</h2>
<p>
  Another empty tag you will encounter in this configuration file is
  the <b>Topology</b> tag.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Topology/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  This tag does not affect the dynamics at all. It is used as a way to
  mark out molecules or other multi-particle structures for monitoring
  and collection of data. For example, you might create a list of the
  particles in each polymer in your molecular simulation so that you
  can calculate a molecular (instead of atomic) diffusion coefficient.
  This tag will become more useful when bonded interactions are
  introduced in a later tutorial on polymeric systems.
</p>
<h2>Interactions</h2>
<p>
  The next important tags in the file format are
  the <b>Interaction</b> tags. These tags are used to specify the
  interactions between pairs of particles (bonded, non-bonded,
  whatever). The key definition of an <b>Interaction</b> is an event
  which involves two-particles. Therefore, every two particle event is
  specified here, and <u>every pair of particles must have a
  corresponding <b>Interaction!</b></u>
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
  hard sphere interaction. Hard spheres have a <b>Diameter</b>
  and <b>Elasticity</b> which are set by the appropriate
  attributes. The <b>Interaction</b> has a <b>Name</b> which is used
  to identify it (e.g, it is used in the <b>IntName</b> attribute of
  the <b>Species</b> tag).
</p>
<p>
  Finally, there is a <b>Range</b> attribute at the end of the
  tag. <b>Interaction</b> <b>Range</b>s are unique in that they
  specify <u>pairs</u> of particles, not just individual
  particles. This is why the <b>Range</b> attribute has a value
  of <em>2All</em>, which specifies all pairs of particles.  Two
  particle ranges are covered in more detail in the next tutorial.
</p>
<p>
  We can see the dramatic effect of some simple changes to the
  <b>Interaction</b> by reducing the particle <b>Diameter</b>
  and <b>Elasticity</b>:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Interactions>
      <Interaction Type="HardSphere" Diameter="0.5" Elasticity="0.5" Name="Bulk" Range="2All"/>
    </Interactions>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<div class="figure" style="float:right;width:337px;">
  <?php embedvideo("granularhardspheres", "d6M43_Nr4pQ", 333, 250); ?>
  <div class="caption">
    Modifying the <b>Interaction</b> to make a low density granular
    gas. <?php button("Show Modified
    Configuration","/pages/config.tut3.granular.xml");?>
  </div>
</div>
<p>
  By lowering the <b>Diameter</B> to a half of its previous value,
  we've reduced the density of the system by a factor of $2^3=8$. If you
  take a look at the video to the right you will see that this density
  is comparable to the density of the system where we doubled the size
  of the simulation domain (see the <b>SimulationSize</b> tag above);
  However, in this case the particles are spread evenly about in space
  at the start of the simulation. Please note that if you increase the
  <b>Diameter</b>, you may again cause overlaps and invalid dynamics!
</p>
<p>
  By lowering the <b>Elasticty</b>, we have created a <i>granular</i>
  system. In granular systems, inelastic interactions remove energy
  over time and the system begins to slow down. You can also see a
  hint of clustering in the video to the right, which is another
  characteristic of granular systems.
</p>
<p>
  We have now covered the primary type of events (two
  particle <b>Interaction</b> events) which will occur in our
  simulations but there are many other possible event types
  available. These are grouped into <b>Locals</b>, <b>Globals</b>,
  and <b>System</b> events, which are discussed below.
</p>
<h2>Locals</h2>
<p>
  In this simulation, we have an empty <b>Locals</b> tag:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Locals/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  A <b>Local</b> is any possible event involving one particle which is
  localised in space. Typical examples of <b>Local</b>s are are walls,
  triangle meshes and other fixed objects. The key part of the
  definition is that the events only occur if the particle is in a
  certain location in space. This means these events can be optimised
  by inserting them into the neighbour list.
</p>
<p>
  Using <b>Locals</b> will be discussed in a later tutorial when we
  study walls and triangle meshes.
</p>
<h2>Globals</h2>
<p>
  <b>Globals</b> are single particle events which can occur anywhere
  (i.e., they cannot be optimised by the use of neighbour lists). One
  example of a <b>Global</b> is a neighbour list itself:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Globals>
      <Global Type="Cells" Name="SchedulerNBList" NeighbourhoodRange="1.00000000000000e+00" Range="All"/>
    </Globals>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  This <b>Global</b> is a celluar neighbour list
  (<b>Type</b>=&quot;<i>Cells</i>&quot;), which is set to track the
  particles within a distance of at least 1 of every particle, as
  specified by the <b>NeighbourhoodRange</b> attribute. This neighbour
  list has a special <b>Name</b> (<i>SchedulerNBList</i>) which is
  used by the <i>NeighbourList</i> <b>Scheduler</b> to identify which
  neighbour list it is to use when detecting events.
</p>
<p>
  There are a few more <b>Global</b> events available in DynamO, such as
  single-occupancy cells or a waker for the sleeping particles
  algorithm. However, the use of these events is rare and often
  the <b>Globals</b> tag only contains a single neighbour list.
</p>
<h2>Systems</h2>
<p>
  Finally, <b>System</b> events comprise every other source of events
  that does not fit into the above categories. These might be
  thermostats, umbrella potentials, snapshotting, simulation end
  conditions or temperature rescalers.
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <SystemEvents/>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  This configuration has no <b>System</b> events, but we will see the
  use of thermostats and rescalers in later tutorials.
</p>
<h2>Dynamics</h2>
<p>
  Finally, the last tag to discuss is the <b>Dynamics</b> tag:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Dynamics Type="Newtonian"/>
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here you can change the fundamental dynamics of the system. For
  example, you might add a constant downwards force to all particles
  to mimic gravity (see right).
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Dynamics Type="NewtonianGravity">
      <g x="0" y="-1" z="0"/>
    </Dynamics>
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedvideo("fallinghardspheres", "Hx6rcS-RAkU", 400, 300); ?>
  <div class="caption">
    Enabling gravity causes all the particles to fall, but with
    periodic boundary conditions there is nothing to arrest their
    descent.
    <?php button("Show Modified Configuration","/pages/config.tut3.gravity.xml");?>
  </div>
</div>
<p>
  You can also run compression simulations or use multicanonical
  potentials to deform the energy landscape of the system through
  the <b>Dynamics</b> tag.
</p>
<h1>Units</h1>
<p>
  A common question users ask when first using DynamO is &quot;What
  are the units of Dynamo?&quot; and the answer is &quot;whichever
  units you use.&quot; Every setting in the configuration file has
  consistent units. If you specify all lengths in meters, all times in
  seconds and all masses in kilograms then you should use Joules when
  specifying energies.  Generally speaking, there are no hidden units
  within the simulator.
</p>
<p>
  However, there is one standard exception to this which is the
  Boltzmann constant, $k_B$. DynamO assumes $k_B=1$. What this means
  in practice is that when you specify the temperature in DynamO, you
  are actually specifying the thermal unit, $k_B\,T$.
</p>
<p>
  In practice, event-driven simulations are usually carried out in
  some reduced set of units. For this reason, any configuration
  generated by <b>dynamod</b> will have one set of particles with a
  mass and diameter of 1. In athermal systems such as hard spheres,
  the temperature is set to 1 to fix the units of time and energy. In
  energetic systems such as square wells, one interaction energy is
  set to 1 to establish the time and energy units.
</p>
<h1>Conclusion</h1>
<p>
  In this lengthy tutorial we've covered the entire configuration file
  format. This has introduced many concepts and terms which you may be
  unfamiliar with. If you are looking for a good resource on
  molecular-dynamics and event-driven simulation we can recommend the
  following text:
</p>
<p style="text-align:center;">
  &quot;Molecular Dynamics Simulation: Elementary Methods,&quot;
  J. M. Haile, 1992, Wiley
</p>
<p>
  Now that we've covered the general workflow of using DynamO in
  tutorial 2, and all of the terminology and configuration file format
  in this tutorial, the following tutorials will now focus on case
  studies of certain systems and collecting data.
</p>
