<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 2: Running a Simulation of Hard Spheres";
   ?>
<?php printTOC(); ?>
<p>
  In this tutorial, we will cover the basics of using DynamO, and
  learn how to simulate the simplest event driven system, the hard
  sphere fluid with periodic boundary conditions. This will give you
  an overview of the general work-flow of simulations with DynamO, and
  later tutorials will go into the details.
</p>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedvideo("hardspheres", "tn6Cz0tNPuU", 400, 250); ?>
  <div class="caption">
    A video of the system generated and simulated in this tutorial.
    <?php button("Show Configuration","/pages/config.tut3.xml");?>
  </div>
</div>
<p>
  A video of the results of what is covered in this tutorial is
  presented to the right.  At the start of the video, the hard spheres
  are shown in their initial configuration generated by
  the <b>dynamod</b> tool. The particles are placed on a regular FCC
  lattice and assigned random velocities.
</p>
<p>
  Once the simulation is started (using the <b>dynarun</b> program),
  the lattice structure rapidly disappears. However, it is obvious
  from the clear colour banding that the particles have not actually
  moved very far. The system still has a "memory" of its initial
  configuration and we will need to equilibrate the system before we
  collect data.
</p>
<p>
  To equilibrate the system, the simulation is then set to run at full
  speed for a few thousand collisions and then slowed down again to
  take a look at the results. We can see that the simulation has
  equilibrated well and the coloured particles are well mixed.
</p>
<p>
  Let's take a look at how to perform this simulation in DynamO...
</p>
<h1>Verifying the DynamO Installation</h1>
<p>
  Please ensure that you have already followed
  the <a href="/index.php/tutorial1">previous tutorial</a> and
  compiled and installed your own copy of DynamO.
</p>
<p>
  We'll start off by testing if you successfully compiled and
  installed DynamO. Open up a terminal and run the following command:
</p>
<?php codeblockstart(); ?>dynamod<?php codeblockend("brush: shell;"); ?>
<p>
  You may need to change this path to wherever you installed the
  dynamo binaries. If everything is working correctly, you should see
  the copyright notice and the descriptions of the options of the
  dynamod program:
</p>
<?php codeblockstart(); ?>dynamod  Copyright (C) 2011  Marcus N Campbell Bannerman
This program comes with ABSOLUTELY NO WARRANTY.
This is free software, and you are welcome to redistribute it
under certain conditions. See the licence you obtained with
the code
Usage : dynamod <OPTIONS>...[CONFIG FILE]
...<?php codeblockend("brush: plain;"); ?>
<p>
  If you do not see the above output, please double check that you
  encountered no errors when building dynamo. Return to
  the <a href="/index.php/tutorial1">previous tutorial</a> and recheck
  the output of the <b>make</b> command.
</p>
<p>
  We're now ready to setup and run our first DynamO simulation...
</p>
<h1>In Brief</h1> 
<p>
  There are only three commands to cover in this tutorial, so we'll
  cover them briefly and then go into each command in detail. 
</p>
<p>
  Let us say that you want to run a hard-sphere simulation of 1372
  particles at a reduced density of 0.5 and a temperature of 1.  You
  want to create the system, and then run it for $10^6$ collisions to
  equilibrate, then another $10^6$ collisions to collect some data for
  your research. All you have to do is run the following commands in
  your terminal/shell:
</p>
<?php codeblockstart(); ?>#Create the configuration
dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml

#A "equilibration run" to equilibrate the configuration
dynarun config.start.xml -c 1000000 -o config.equilibrated.xml

#A "production run" to collect data on the system
dynarun config.equilibrated.xml -c 1000000 -o config.end.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  But what were those three commands and what do the options/switches
  (-c -o -m) control? We'll look at each command individually in the
  following sections.
</p>
<h1>Configuration Files and Dynamod</h1>
<p>
  The first step in the brief example was to create the
  initial <b>configuration file</b>, called <em>config.start.xml</em>,
  using <b>dynamod</b>.
</p>
<?php codeblockstart(); ?>dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p>
  In this section, we will learn about the configuration files of
  DynamO, which are the main input and output of DynamO, and how to
  generate configuration files using <b>dynamod</b>.
</p>
<h2>About the Configuration File</h2>
<p>
  Before we can run any simulations with DynamO, we must write or
  generate a configuration file. A configuration file is a single file
  which contains all of the parameters of the system.
</p>
<p>
  The configuration file format is used for...
</p>
<ul>
  <li>
    ...the starting point for a simulation.
  </li>
  <li>
    ...for saving any snapshots of the system while it is being simulated.
  </li>
  <li>
    ...for saving the final state of the simulation for continuing it later. 
  </li>
</ul>
<p>
  <b>Every single parameter of the system is set in a configuration
  file</b>, including the particle positions, interactions, boundary
  conditions and solver details. Many other simulation packages
  usually place some of this information in several different files,
  but DynamO only uses one file. Lets take a look at how we can
  generate a configuration file...
</p>
<h2>Generating Configuration Files</h2>
<p>
  <b>dynamod</b> is a program designed to manipulate existing
  configuration files or to generate example configuration files. We
  can take a look at the options of <b>dynamod</b> using
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
<h2>Initial Positions and Crystals</h2>
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
  When creating an initial configuration, you must be careful to place
  the particles so that there are no overlaps which would lead to
  invalid dynamics. But we want to be able to "pack" the particles as
  close together as possible so we can generate high density
  configurations easily.
</p>
<p>
  We're looking for a regular structure, or lattice, which maximises
  the distance between the positions, or "sites", for a fixed size of
  system. Such structures occur frequently in nature and they're
  called <b>crystal lattices</b>. You can take a look
  at <a href="http://en.wikipedia.org/wiki/Close-packing_of_spheres">Wikipedia's
  article on the closest way to pack spheres</a> for more information
  on this topic.
</p>
<p>
  For mono-sized spheres, there are three popular
  <a href="http://en.wikipedia.org/wiki/Cubic_crystal_system">cubic
  crystal structures</a> which are used by simulators to initially
  position particles. There is Face-Centred Cubic (FCC),
  Body-Centered Cubic (BCC), and the Simple (or Primitive) Cubic
  (SC). DynamO can use any of these three to initially place your
  particles, and this is selected using the first integer argument
  (<em>--i1 X</em>, where <em>X=0</em> for FCC, <em>X=1</em> for BCC
  and <em>X=2</em> for SC).
</p>
<p>
  The FCC crystal often is favoured for producing the initial particle
  positions as it is the naturally-forming crystal structure of
  single-sized hard-spheres. Thus, it gives the closest packing you
  can physically achieve for mono-sized hard spheres without
  generating overlaps. It also provides a good starting point for
  other particle shapes and types too.
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
<h2>In Summary</h2>
<p>
  To conclude this part, we'll quickly summarise the description of
  each of the options passed to dynamod
</p>
<?php codeblockstart(); ?>dynamod -m 0 -C 7 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p>
  The above command says:
</p>
<ul>
  <li>
    <b><em>-m 0</em></b> : Generate a hard sphere system.
  </li>
  <li>
    <b><em>-C 7</em></b> : Create a $7\times7\times7$ lattice.
  </li>
  <li>
    <b><em>--i1 0</em></b> : The unit cell of the lattice is Face-Centred
    Cubic (FCC).
  </li>
  <li>
    <b><em>-d 0.5</em></b> : Scale the particles so that it has a reduced
    density of 0.5.
  </li>
  <li>
    <b><em>-r 1</em></b> : Rescale the particle velocities so the system has a
    temperature of 1.
  </li>
  <li>
    <b><em>-o config.start.xml</em></b> : And write the result out into a
    configuration file called <em>config.start.xml</em>.
    </li>
</ul>
<h1>Running the Simulation</h1>
<p>
  The hardest part of this tutorial is now over. All we need to do is
  take the starting configuration file and actually run a simulation.
</p>
<p>
  The running of simulations is performed using the <b>dynarun</b>
  command. This command has many options which can be seen
  using <em>--help</em>, but for now we'll only use <em>-c</em>
  and <em>-o</em>.
</p>
<?php codeblockstart(); ?>dynarun config.start.xml -c 1000000 -o config.equilibrated.xml<?php codeblockend("brush: shell;"); ?>
<p>
  This command takes the configuration in <em>config.start.xml</em>
  and runs it for 10<sup>6</sup> events/collisions <i>(-c
  1000000)</i>, before putting the final configuration
  in <em>config.equilibrated.xml</em>
</p>
<p>
  Periodically, you should see some output from <b>dynarun</b>
  informing you of its progress in the simulation:
</p>
<?php codeblockstart(); ?>...
Mon 07:59, ETA 5s, Events 100k, t 19.0791, <Mean Free Time> 0.130882, 
Mon 07:59, ETA 4s, Events 200k, t 38.0597, <Mean Free Time> 0.130545,
...<?php codeblockend("brush: plain;"); ?>
<p>
  This is telling you the time the output was written to screen (so
  you can see if the simulator has frozen), an estimate of how much
  longer the simulation will take (ETA), how many events have been
  executed already, and how much simulation time has passed. The
  average mean free time is also outputted to help you track the
  equilibration of the system.
</p>
<p>
  From previous experience, $10^6$ events is more than enough
  to equilibrate this small system of 1372 particles. Now we can run
  the simulation to collect some data from the system at
  equilibrium. We just take the output from the
  previous <b>dynarun</b> command as input to a new one:
</p>
<?php codeblockstart(); ?>dynarun config.equilibrated.xml -c 1000000 -o config.end.xml<?php codeblockend("brush: shell;"); ?>
<p>
  But where is this data that's been collected? The most obvious
  result is that you have a new configuration file,
  called <em>config.end.xml</em>. If you're interested in studying
  structural properties the stored particle positions are probably
  sufficient for your research. But there is another source of data
  generated with each execution of dynarun.
</p>
<h1>Processing the Collected Data</h1>
<p>
  <b>dynarun</b> has the ability to collect a wide range of
  properties, such as transport coefficients, radial distribution
  functions and much more. How to use these will be covered in the
  following tutorials, but there are some basic properties which
  <b>dynarun</b> will always collect. These results, along with any
  other enabled properties, are outputted to a compressed XML file
  called <em>output.xml.bz2</em> (you can set the output file name
  using the <em>--out-data-file</em> option). Both the configuration
  files and the output files are written in XML, as it is a format
  that is easy for both humans and computers to read. We'll cover how
  to look at this data by hand now, and how to write programs/scripts
  to access it in a later tutorial.
</p>
<p>
  To read this output data file, you must first un-compress the file
  using the <b>bunzip2</b> command like so:
</p>
<?php codeblockstart(); ?>bunzip2 output.xml.bz2<?php codeblockend("brush: shell;"); ?>
<p>
  This will rename the file from <em>output.xml.bz2</em> to
  <em>output.xml</em>, and you will be able to open it using your
  favourite text editor. An example <em>output.xml</em> file from the
  default hard sphere simulation is available below.
</p>
<?php button("Example output.xml file contents", "/index.php/tutorial2exampleoutput");?>
<p>
  Taking a look inside <em>output.xml</em>, we can see there's lots of
  information available. The mean free time, density, packing
  fraction, particle count, simulation size, memory usage and
  performance are available. The temperature is available too:
</p>
<?php codeblockstart(); ?>...
<Temperature Mean="0.99999999999997" MeanSqr="0.999999999999985" Current="1.00000000000001"/>
...<?php codeblockend("brush: xml;"); ?>
<p>
  Here you can see that the temperature is almost exactly 1. Hard
  spheres have no configurational internal energy, so once you set
  their temperature it will not fluctuate. In this case, we don't need
  a thermostat to hold the temperature at 1. 
</p>
<p>
  The most interesting property for the hard sphere system is the
  pressure, conveniently available under the Pressure tag:
</p>
<?php codeblockstart(); ?>...
<Pressure Avg="1.63787027134353">
  <Tensor>
    1.63913447194771 0.000569183767859779 0.000659703403366379 
    0.000569183767859774 1.63705438233026 -0.000767271561307316 
    0.000659703403366379 -0.000767271561307315 1.63742195975262 
  </Tensor>
</Pressure>
...<?php codeblockend("brush: xml;"); ?>
<p>
  The pressure is calculated using
  the <a href="http://www.sklogwiki.org/SklogWiki/index.php/Pressure#Virial_pressure">virial
  expression</a>. The isotropic pressure,
  $p=\left(P_{xx}+P_{yy}+P_{zz}\right)/3$, is available as
  the <b>Avg</b> attribute of the <b>Pressure</b> tag, but the full
  pressure tensor, $\mathbf{P}$, is enclosed in the <b>Tensor</b>
  tags. The pressure values are just written out as a set of space
  separated values which are arranged as follows:
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
  There are some other properties available, such as the
  configurational internal energy and residual heat capacity:
</p>
<?php codeblockstart(); ?>...
<UConfigurational Mean="0" MeanSqr="0" Current="0"/>
<ResidualHeatCapacity Value="0"/>
...<?php codeblockend("brush: xml;"); ?>
<p>
  But as mentioned before these values are zero as the hard sphere
  fluid has an ideal heat capacity and internal energy. In later
  tutorials, we'll look at more complex systems and their properties
  in detail.
</p>
<h1>In Summary</h1>
<p>
  We've covered how to create an initial configuration,
  using <b>dynamod</b> and how to "run" this configuration for a fixed
  number of events using <b>dynarun</b>. Finally, we started to take a
  look at some of the data that <b>dynarun</b> collects automatically.
</p>
<p>
  This is just the tip of the iceberg as far as what is possible. In
  the later tutorials we will take a look at more complex systems and
  how to edit the configuration files by hand. We will cover loading
  output plug-ins to collect more interesting information, such as the
  thermal conductivity and viscosity. We will show how to use
  compression dynamics to generate dense configurations of arbitrary
  systems and we can also learn to use the visualiser to render the
  results of the simulations.
</p>
