<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 3: Exploring the Configuration File";
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
  But before we can change the configuration, we must understand
  it. 
</p>
<h1>2. The Starting Configuration</h1>
<p>
  We will generate a standard hard sphere configuration, use it to
  explore the file format, and to demonstrate the large effect of some
  simple changes.  We have chosen to look at the hard sphere
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
<?php button("Tutorial 2: Running a Simulation of Hard Spheres","/pages/config.tut3.xml");?>
<p>
</p>




<h1>3. The Tags</h1>

<p>
 The whole configuration is enclosed within a pair
  of <b>DynamOconfig</b> <em>tags</em>.
</p>
<?php codeblockstart(); ?><?xml version="1.0"?>
<DynamOconfig version="1.4.0">
...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  We will omit these tags in the following examples and use "..." to
  indicate any XML data we have skipped.
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
<h1>3. Running a simulation</h1>
<p>
  Now that we have a configuration, we are ready to run a simulation!
  This is very easy, just run <b>dynarun</b> like so:
</p>
<?php codeblockstart(); ?>dynarun hardsphere.xml -o hardsphere.final.xml -c 1000000<?php codeblockend("brush: shell;"); ?>
<p>
  This will use <b>dynarun</b> to calculate the trajectory of
  the <em>hardsphere.xml</em> configuration for a million events
  (<em>-c 1000000</em>) and then write the final configuration
  to <em>hardsphere.final.xml</em>. If you want to run a simulation
  for a certain time (instead of a certain number of events) you just
  run <b>dynarun</b> with the <em>-f</em> option:
</p>
<?php codeblockstart(); ?>dynarun hardsphere.xml -o hardsphere.final.xml -f 200<?php codeblockend("brush: shell;"); ?>
<p>
  and this will use <b>dynarun</b> to calculate the trajectory of the
  hardsphere.xml configuration for 200 units of simulation time.
</p>
<p>
  There are many ways to collect data from a DynamO simulation, but
  the most common usage is to take periodic snapshots of the
  system. DynamO has a special command line option for this:
</p>
<?php codeblockstart(); ?>dynarun hardsphere.xml -o hardsphere.final.xml -f 200 --snapshot 20<?php codeblockend("brush: shell;"); ?>
<p>
  This will take a snapshot of the system every 20 units of simulation
  time! If you run the command above, you will see you have 10
  snapshots taken:
</p>
<?php codeblockstart(); ?>ls Snapshot.* 
  Snapshot.0.xml.bz2 Snapshot.1.xml.bz2 Snapshot.2.xml.bz2
  Snapshot.3.xml.bz2 Snapshot.4.xml.bz2 Snapshot.5.xml.bz2
  Snapshot.6.xml.bz2 Snapshot.7.xml.bz2 Snapshot.8.xml.bz2
  Snapshot.9.xml.bz2<?php codeblockend("brush: shell;"); ?>
<p>
  Congratulations, you've run your first DynamO simulation!
</p>
