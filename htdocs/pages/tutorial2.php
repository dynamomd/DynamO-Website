<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 2: Introduction to the DynamO workflow";
   ?>
<?php printTOC(); ?>
<p>
  In this tutorial, the basic steps of working with DynamO are
  introduced by performing a simulation of a hard sphere fluid.
</p>
<p>
  You will need to have access to an installed copy of DynamO, either
  by using the precompiled packages in
  the <a href="/index.php/download">download section of the site</a>
  or by following the <a href="/index.php/tutorial1">previous
  tutorial</a> to compile and install your own copy of DynamO. You can
  check if dynamo works by opening a terminal and typing the following
  command:
</p>
<?php codeblockstart(); ?>dynamod<?php codeblockend("brush: shell;"); ?>
<p>
   If everything is working correctly, you should see the copyright
  notice and the descriptions of the options of the dynamod program:
</p>
<?php codeblockstart(); ?>dynamod  Copyright (C) 2013  Marcus N Campbell Bannerman
This program comes with ABSOLUTELY NO WARRANTY.
This is free software, and you are welcome to redistribute it
under certain conditions. See the licence you obtained with
the code
Usage : dynamod <OPTIONS>...[CONFIG FILE]
...<?php codeblockend("brush: plain;"); ?>
<p>
  If you do not see the above output, please double check that you
  encountered no errors while installing/building DynamO. If you have
  problems and you have built DynamO yourself, you can return to
  the <a href="/index.php/tutorial1">previous tutorial</a> and recheck
  the output of the <b>make</b> command.
</p>
<h1>About this tutorial</h1>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedAJAXvideo("hardspheres", "tn6Cz0tNPuU", 400, 250); ?>
  <div class="caption">
    A video of the hard sphere system which is generated and simulated
    in this tutorial.  <?php button("Show
    Configuration","/pages/config.tut3.xml");?>
  </div>
</div>
<p>
  When performing a molecular dynamics simulation with DynamO, the
  standard steps, or "workflow", is to:
</p>
<ol>
  <li>
    Create an initial "configuration" file, which is the starting
    point of the simulation. This file contains a description of all
    particles and their interactions.
  </li>
  <li>
    Use the initial configuration file as the start of a simulation to
    allow the configuration to relax and come into equilibrium. The
    output of this stage is an "equilibrated" configuration file.
  </li>
  <li>
    Use the equilibrated configuration as the start of a simulation to
    collect data. You will generate a final configuration file, which
    can be used as the starting point for other simulations, and an
    output file, containing all the data collected by DynamO.
  </li>
</ol>
<p>
  This tutorial will give you a general understanding of these steps
  and later tutorials will go into the details.
</p>
<p>
  In this tutorial you will simulate a hard-sphere fluid. The hard
  sphere is a simple molecular model used to capture the fundamental
  effects of "excluded-volume" interactions (see
  the <a href="/index.php/reference#typehardsphere">reference</a>
  entry for more details).  A video of the initial configuration and
  equilibration performed in this tutorial is presented to the right.
  At the start of the video, the hard spheres are shown in their
  initial configuration. The particles are placed on a lattice and
  assigned random velocities. The particles are then coloured by their
  ID number and the simulation is "run".
</p>
<p>
  In the video you may notice some particles popping in and out of
  view, these are particles which are moving from one side of the
  simulation volume to the other when they pass through the periodic
  boundary condition (you can see some red particles disappear on the
  left and instantaneously reappear on the right). We use periodic
  boundary conditions as they allow us to simulate a small amount of
  fluid as though it is part of an infinite/bulk system (see
  the <a href="/index.php/reference#typepbc">reference</a> entry for
  more details).
</p>
<p>
  As the simulation proceeds, the initial lattice structure rapidly
  disappears. However, it is obvious from the clear colour banding
  that the particles have not actually moved very far from their
  initial positions. The system still has a "memory" of its initial
  configuration and we will need to equilibrate the system before we
  can collect data.
</p>
<p>
  To equilibrate the system, the simulation is then set to run at full
  speed for a few thousand collisions and then slowed down again to
  take a look at the results. We can see that the simulation has
  equilibrated well and the coloured particles are well mixed. This
  system is now ready to sample "equilibrium" data from.
</p>
<p>
  Let's take a look at how this simulation was performed in DynamO...
</p>
<h2>Quick overview of commands</h2> 
<p>
  There are only three commands to cover in this tutorial, so we'll
  cover them briefly and then go into each command in detail. 
</p>
<p>
  Let us say that you want to run a hard-sphere simulation of 1372
  particles. These particles should be packed together at a reduced
  density of 0.5 and have a reduced temperature of 1 (if these values
  look peculiar, please see
  the <a href="/index.php/FAQ#q-what-are-the-units-of-dynamo">FAQ on
  the units of DynamO</a>).  You want to create the system, and then
  run it for $10^6$ collisions to equilibrate, then carry on and run
  it for another $10^6$ collisions to collect some data for your
  research. All you have to do is run the following commands in your
  terminal/shell:
</p>
<?php codeblockstart(); ?>
dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml
dynarun config.start.xml -c 1000000 -o config.equilibrated.xml
dynarun config.equilibrated.xml -c 1000000 -o config.end.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  But what were those three commands and what do the options/switches
  (-c -o -m) control? We'll look at each command individually in the
  following sections.
</p>
<h1>Configuration files and dynamod</h1>
<p>
  The first step in the brief example was to create the
  initial <b>configuration file</b>, called <em>config.start.xml</em>,
  using <b>dynamod</b>.
</p>
<?php codeblockstart(); ?>dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p>
  In this section, we will briefly learn about the configuration files
  of DynamO, which are the main input and output of DynamO, and how to
  generate configuration files using <b>dynamod</b>.
</p>
<h2>About the configuration file</h2>
<p>
  Before we can run any simulations with DynamO, we must write or
  generate a configuration file. A configuration file is a single file
  which contains all of the parameters of the system and it is used
  for...
</p>
<ul>
  <li>
    ...the starting point for a simulation.
  </li>
  <li>
    ...for saving any snapshots of the system while it is being simulated.
  </li>
  <li>
    ...for saving the final state of the simulation. This can also
    then be used to continue the simulation later!
  </li>
</ul>
<p>
  <b>Every single parameter of the system is set in a configuration
  file</b>, including the particle positions, interactions, boundary
  conditions and solver details. Many other simulation packages
  usually place some of this information in several different files,
  but DynamO only uses one file. This means there is a lot of
  information in this one file and it can be quite difficult to
  generate from scratch. So lets take a look at how we can generate an
  basic example configuration file to start us off.
</p>
<h2>Generating configuration files</h2>
<p>
  <b>dynamod</b> is a program designed to generate example
  configuration files, or to manipulate existing configuration
  files. We can take a look at the options of <b>dynamod</b> using
  the <em>--help</em> option:
</p>
<?php codeblockstart(); ?>dynamod --help<?php codeblockend("brush: shell;"); ?>
<p>
  There are many options available and a lot are related to modifying
  existing configurations (this is why it is called dyna<b>mod</b>),
  but if we want to generate a configuration we are only need to be
  interested in the bottom section which starts with:
</p>
<?php codeblockstart(); ?>...
Packer options:
  -m [ --pack-mode ] arg    Chooses the system to pack (construct)
                            Packer Modes:
                            0:  Monocomponent hard spheres
                            1:  Mono/Multi-component square wells
                            2:  Random walk of an isolated attractive polymer
...<?php codeblockend("brush: plain;"); ?>
<p>
  This section is a list of the built in example configurations
  that <b>dynamod</b> can produce.  We ask <b>dynamod</b> to generate
  any one of the configurations listed there using
  the <em>--pack-mode</em> option (or <em>-m</em> for short).
</p>
<p>
  As this is a tutorial on hard spheres, we will want to use mode
  0. Once you have selected your <em>--pack-mode</em>, you can request
  more information on its specific options by using
  the <em>--help</em> option again in combination with the
  selected <em>--pack-mode</em>:
</p>
<?php codeblockstart(); ?>dynamod -m0 --help<?php codeblockend("brush: shell;"); ?>
<p>
 And you should get the following output:
</p>
<?php codeblockstart(); ?>
Mode 0: Monocomponent hard spheres
 Options
  -C [ --NCells ] arg (=7)    Set the default number of lattice unit-cells in each direction.
  -x [ --xcell ] arg          Number of unit-cells in the x dimension.
  -y [ --ycell ] arg          Number of unit-cells in the y dimension.
  -z [ --zcell ] arg          Number of unit-cells in the z dimension.
  --rectangular-box           Set the simulation box to be rectangular so that the x,y,z cells also specify the simulation aspect ratio.
  -d [ --density ] arg (=0.5) System density.
  --i1 arg (=FCC)             Lattice type (0=FCC, 1=BCC, 2=SC)
  --i2 arg (disabled)         Adds a temperature rescale event every x events
  --f1 arg (=1.0)             Sets the elasticity of the hard spheres
<?php codeblockend("brush: plain;"); ?>
<p>
  What you can see here are a list of options with their default
  values in parenthesis, so if you run:
</p>
<?php codeblockstart(); ?>dynamod -m0 -o config.start.xml.bz2<?php codeblockend("brush: shell;"); ?>
<p>
  It will actually output the same result as running the following
  command.
</p>
<?php codeblockstart(); ?>dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p>
  This is the exact command that was discussed in the brief overview,
  and its the default set-up of the hard-sphere example. There are
  lots of options you can use to change the density, number of
  particles and their placement, and these are discussed in the next
  section.
</p>
<h2>Initial positions and crystals</h2>
<div class="figure" style="float:right; width:400px;">
  <a href="/images/tut1_initialpos.jpg">
    <img height="400" width="400" alt="Image of hard spheres arranged in an FCC lattice." src="/images/tut1_initialpos.jpg"/>
  </a>
  <div class="caption">
    The default FCC hard sphere system generated by dynamod.
  </div>
</div>
<p>
  Most of the options for this <em>--pack-mode</em> (and many other
  pack modes) control the initial placement of the particles.
</p>
<p>
  When you create an initial configuration, you must be careful to
  place the particles so that there are no overlaps which would lead
  to invalid dynamics. If we placed two hard sphere particles so that
  they were overlapping, the system would be in an invalid state as
  "hard" particles cannot interpenetrate each other. On the other
  hand, we want to be able to "pack" the particles as close together
  as possible so that we can generate high density configurations
  easily. Obviously we cannot just randomly drop particles as this
  will quickly lead to overlaps, even in low density systems.
</p>
<p>
  What we're looking for is a regular structure, or lattice, which
  maximises the distance between the different positions, or "sites",
  for a fixed size of system. This structure would ensure that we
  minimise the chance of any particles overlapping right at the start
  of the simulation. Such structures occur frequently in nature and
  they're called <b>crystal lattices</b>. You can take a look
  at <a href="http://en.wikipedia.org/wiki/Close-packing_of_spheres">Wikipedia's
  article on the closest way to pack spheres</a> for more information
  on this topic.
</p>
<p>
  For mono-sized spheres, there are three popular
  <a href="http://en.wikipedia.org/wiki/Cubic_crystal_system">cubic
  crystal structures</a> which are used by simulators to initially
  position particles. There
  is <a href="http://en.wikipedia.org/wiki/Cubic_crystal_system#Cubic_space_groups">Face-Centred
  Cubic (FCC), Body-Centered Cubic (BCC), and the Simple (or
  Primitive) Cubic (SC)</a>. DynamO can use any of these three to
  initially place your particles, and this is selected using the first
  integer argument (<em>--i1 X</em>, where <em>X=0</em> for
  FCC, <em>X=1</em> for BCC and <em>X=2</em> for SC).
</p>
<p>
  The FCC crystal often is favoured for producing the initial particle
  positions as it is the naturally-forming crystal structure of
  single-sized hard-spheres. Thus, it gives the closest packing you
  can physically achieve for mono-sized hard spheres without
  generating overlaps. It also provides a good starting point for
  other particle shapes and types too, so you'll often see rods,
  polymers, and other shapes initially arranged in an FCC lattice!
</p>
<p>
  So, back to <b>dynamod</b>. When you pass <em>-C7 --i1 0</em>
  to <b>dynamod</b> you are asking dynamo to produce a
  $7\times7\times7$ <i>(-C 7)</i> FCC <i>(--i1 0)</i> lattice and
  place a single particle on each lattice site.
</p>
<p>
  As the FCC lattice has 4 unique sites per unit cell, this will
  result in $N=4\times7^3=1372$ particles being generated. The size of
  the particles is then scaled to match the density passed using
  the <em>--density</em> option, or <em>-d</em> for short (by default
  we have <em>-d 0.5</em>).
</p>
<h2>In summary</h2>
<p>
  To conclude this part, we'll quickly summarise the description of
  each of the options passed to dynamod:
</p>
<?php codeblockstart(); ?>dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p>
  The above command says:
</p>
<ul>
  <li>
    <b><em>-m 0</em></b> : Generate a hard sphere system (mode 0).
  </li>
  <li>
    <b><em>-C 7</em></b> : Create a $7\times7\times7$ lattice.
  </li>
  <li>
    <b><em>--i1 0</em></b> : The unit cell of the lattice is
    Face-Centred Cubic (FCC) (this has 4 "sites" per unit cell, so
    we'll have $4\times7^3=1372$ particles in total).
  </li>
  <li>
    <b><em>-d 0.5</em></b> : Scale the lattice so that the system will
    have a reduced density of 0.5.
  </li>
  <li>
    <b><em>-r 1</em></b> : Rescale the particle velocities so the
    system has an initial temperature of 1 (it will remain at 1 during
    the simulation as hard spheres are athermal).
  </li>
  <li>
    <b><em>-o config.start.xml</em></b> : And write the result into a
    configuration file called <em>config.start.xml</em>.
  </li>
</ul>
<p>
  When you run this simulation you will get a lot of text on the
  screen detailing the steps dynamod is carrying out, but at the end
  you should see the following 
</p>
<?php codeblockstart(); ?>Simulation: Config written to config.start.xml<?php codeblockend("brush: plain;"); ?>
<p>
  Which indicates the command was successful. You can take a look at
  the <a href="/pages/config.tut3.xml">contents of the configuration
  file</a>, but the configuration file will be explained in more
  detail in the <a href="index.php/tutorial2">next tutorial</a>.
<h1>Running the simulation using dynarun</h1>
<p>
  The most complex part of this tutorial is now over. All that remains
  is to take this initial starting configuration file and actually run
  a simulation.
</p>
<p>
  The running of simulations is performed using the <b>dynarun</b>
  command. This command has many options which can be listed using
  the <em>--help</em> option, but for now we'll only use
  the <em>-c</em> and <em>-o</em> options. The command we're going to
  use is:
</p>
<?php codeblockstart(); ?>dynarun config.start.xml -c 1000000 -o config.equilibrated.xml<?php codeblockend("brush: shell;"); ?>
<p>
  This command takes the configuration in <em>config.start.xml</em>
  and runs it for 10<sup>6</sup> events/collisions <i>(-c
  1000000)</i>, before putting the final configuration
  in <em>config.equilibrated.xml</em>. We specify the duration of the
  simulation in events as DynamO is an event-driven simulator, and the
  natural unit of computation is an event. You may specify the
  duration in units of time using the <em>-h</em> option like so:
</p>
<?php codeblockstart(); ?>dynarun config.start.xml -f 190 -o config.equilibrated.xml<?php codeblockend("brush: shell;"); ?>
<p>
  In this system, a simulation for 190 units of time is roughly
  proportional to $10^6$ events, so both commands should result in
  roughly the same simulation duration. Its just more natural to
  specify the duration in events (collisions) as the simulator
  processes these at a constant rate.
</p>
<p>
  When you run the command above, you should see some periodic output
  from <b>dynarun</b> informing you of its progress in the simulation:
</p>
<?php codeblockstart(); ?>...
ETA 15s, Events 100k, t 19.0566, <MFT> 0.130728, T 1, U 0
ETA 14s, Events 200k, t 38.0891, <MFT> 0.130645, T 1, U 0
...<?php codeblockend("brush: plain;"); ?>
<p>
  In order, the columns are: an estimate of how much longer the
  simulation will take (ETA), how many events have been executed
  already, and how much simulation time has passed. The average mean
  free time (MFT), the average temperature (T) and configurational
  internal energy (U) are also outputted to help you track the
  equilibration of the system. These values should fluctuate around a
  fixed value once the system reaches equilibrium. Once the simulation
  is over, you'll see that the final configuration is written out
  to <em>config.equilibrated.xml</em>:
</p>
<?php codeblockstart(); ?>Simulation: Output written to output.xml.bz2
Simulation: Config written to config.equilibrated.xml<?php codeblockend("brush: plain;"); ?>
<p>
  Some collected data is also written to <em>output.xml.bz2</em>, but
  this data will contain influences of the initial crystalline
  configuration so it should be discarded. The purpose of this first
  run is to allow the system to have enough time to "relax" from this
  crystalline configuration and "forget" about this initial
  configuration. Ideally, our results should be the same regardless of
  where we started (a property of systems which are ergodic).
</p>
<p>
  From previous experience, $10^6$ events is more than enough to
  equilibrate this small system of 1372 particles. If we were
  uncertain about the equilibration of this system, we might monitor
  the mean free time (and other properties) and check they reach a
  steady value. The final configuration from this "equilibration" run
  is now used as the input to a new "production" run using the
  following command:
</p>
<?php codeblockstart(); ?>dynarun config.equilibrated.xml -c 1000000 -o config.end.xml<?php codeblockend("brush: shell;"); ?>
<p></p>
<?php codeblockstart(); ?>Simulation: Output written to output.xml.bz2
Simulation: Config written to config.end.xml<?php codeblockend("brush: plain;"); ?>
<p>
  The final configuration is written out to
  the <em>config.end.xml</em> file, but this is not the only source of
  data outputted by the dynarun command. In the following section we
  discuss the contents of the <em>output.xml.bz2</em> file.
</p>
<h2>Visualising the simulation</h2>
<p>
  If you want to visualise a configuration or simulation, you replace
  the <b>dynarun</b> program with the <b>dynavis</b> program like so:
</p>
<?php codeblockstart(); ?>dynavis config.equilibrated.xml -c 1000000 -o config.end.xml<?php codeblockend("brush: shell;"); ?>
<p>
  The simulation will load and the visualiser windows will appear. The
  simulation will be paused at the start and you can un-pause it using
  the visualiser controls. If you close the visualiser windows, the
  simulation will automatically unpause and will carry on running.
</p>
<h1>Processing the collected data</h1>
<p>
  <b>dynarun</b> has the ability to collect a wide range of properties
  for molecular and granular systems. These include complex properties
  such as transport coefficients (viscosity, thermal conductivity, and
  mutual/thermal diffusion) along with more traditional properties
  such as radial distribution functions, power loss, pressure tensors
  and much more (see the <a href="/index.php/outputplugins">output
  plugin reference</a> for more details). Some analysis of the more
  complex properties will be covered in the following tutorials, but
  there are some basic properties which we'll cover in this tutorial.
</p>
<p>
  Any data collected on the simulation by <b>dynarun</b> is outputted
  to a compressed XML file called <em>output.xml.bz2</em> (you can
  change the output file name using the <em>--out-data-file</em>
  option). Both the configuration files and the output files are
  written in XML, as it is a format that is easy for both humans and
  computers to read. We'll cover how to look at this data by hand now,
  but this data format is also easy for a computer to read
  (see <a href="/index.php/tutorialA">Appendix A: Parsing Output and
  Config Files</a>).
</p>
<p>
  To read this output data file, you must first un-compress the file
  using the <b>bunzip2</b> command using the following command:
</p>
<?php codeblockstart(); ?>bunzip2 output.xml.bz2<?php codeblockend("brush: shell;"); ?>
<p>
  This will uncompress the file from <em>output.xml.bz2</em> into
  <em>output.xml</em>, and you will be able to open it using your
  favourite text editor. Even internet browsers can open XML files and
  an example <em>output.xml</em> file from the default hard sphere
  simulation is available at the link below.
</p>
<?php button("Example output.xml file", "/pages/tutorial2output.xml");?>
<p>
  Taking a look inside <em>output.xml</em>, we can see there's lots of
  information available. The mean free time, density, packing
  fraction, particle count, simulation size, memory usage and
  performance are available. The temperature is available too:
</p>
<?php xmlXPathFile("pages/tutorial2output.xml", "//Temperature"); ?>
<p>
  Here you can see that the temperature is almost exactly 1. Hard
  spheres have no configurational internal energy, so once you set
  their temperature it will not fluctuate. In this case, we don't need
  a thermostat to hold the temperature at 1. 
</p>
<p>
  An interesting property for the hard sphere system is the pressure,
  conveniently available under the Pressure tag:
</p>
<?php xmlXPathFile("pages/tutorial2output.xml", "//Pressure"); ?>
<p>
  The hydraulic pressure, $p=\left(P_{xx}+P_{yy}+P_{zz}\right)/3$, is
  available as the <b>Avg</b> attribute of the <b>Pressure</b> tag,
  but the full pressure tensor, $\mathbf{P}$, is enclosed in
  the <b>Tensor</b> tags. The pressure values are just written out as
  a set of space separated values which are arranged as follows:
</p>
$$
\begin{align}
\mathbf{P}=
\begin{pmatrix}
P_{xx} & P_{xy} & P_{xz}\\
P_{yx} & P_{yy} & P_{yz}\\
P_{zx} & P_{zy} & P_{zz}
\end{pmatrix}
\end{align}
$$
<p>
  More information on the pressure tag is available in
  the <a href="/index.php/outputplugins#pressure">reference
  documentation</a>:
</p>
<p>
  There are some other properties available, such as the
  configurational internal energy and residual heat capacity:
</p>
<?php xmlXPathFile("pages/tutorial2output.xml", "//UConfigurational"); ?>
<p></p>
<?php xmlXPathFile("pages/tutorial2output.xml", "//ResidualHeatCapacity"); ?>
<p>
  But as mentioned before these values are zero as the hard sphere
  fluid has an ideal heat capacity and internal energy. At the bottom
  of the file are correlation data for the thermal conductivity
  (<b>ThermalConductivity</b> tag) and other transport properties, but
  these will be covered in later tutorials.  If you want more
  information on these tags or the available output plugins, please
  take a look at the output plugin reference documentation using the
  button below.
</p> 
<?php button("Output plugin reference documentation","/index.php/outputplugins");?>
<h1>In summary</h1>
<p>
  We've covered how to create an initial configuration
  using <b>dynamod</b> and how to "run" this configuration for a fixed
  number of events using <b>dynarun</b>. Finally, we started to take a
  look at some of the data that <b>dynarun</b> collects automatically.
</p>
<p>
  This is just the tip of the iceberg as far as what is possible. In
  the next tutorial, we will take a look at more complex systems and
  how to edit the configuration files by hand to generate them.
</p>
<?php button("Tutorial 3: Overview of the Configuration File Format","/index.php/tutorial3");?>
