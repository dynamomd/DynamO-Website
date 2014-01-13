<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Thermostats, compression, and data collection";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written and is incomplete.</b>
</p>
<p>
  This tutorial uses an example study of square-well particles to
  introduce several topics:
</p>
<ul>
  <li>
    <a href="#compressing">How to compress a system to higher
    densities.</a>
  </li>
  <li>
    <a href="#rescaling">How to rescale the velocities and how to set
    the temperature.</a>
  </li>
  <li>
    <a href="#thermostat">How to use a thermostat.</a>
  </li>
  <li>
    How to process collected data, including transport coefficients,
    in the output file.
  </li>
</ul>
<h2><a id="aboutsquarewellfluids"></a>About the system</h2>
<p>
  For the purpose of the tutorial, we'll want to simulate a fluid of
  square-well molecules. If you want to learn more about the
  square-well potential, its parameters, and how it corresponds to
  realistic intermolecular interactions please see the reference entry
  linked below.
</p>
<?php button("Reference entry for <i>\"SquareWell\"</i> Type <b>Interactions</b>","/index.php/reference#typesquarewell");?>
<p>
  We will again use periodic boundary conditions to allow us to
  simulate an infinite fluid without the effects of walls or other
  containers, and these are described in the following reference
  entry:
</p>
<?php button("Reference entry for <i>\"PBC\"</i> Type <b>BoundaryConditions</b>","/index.php/reference#typepbc");?>
<h2>The whole tutorial in brief</h2>
<p>
  We're going to create a square-well fluid with $N=4000$ particles at
  a low density. We'll then compress it to a higher density to see how
  compression works, then we'll try to control the temperature using
  rescaling and thermostats. Finally, we'll collect some measurements
  from the system. The commands we will use are
</p>
<?php codeblockstart(); ?>
#Create the low-density square-well system
dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 1 -o config.start.xml

#Compress the system to a higher density
dynarun config.start.xml --engine=3 --target-density 0.5 -o config.compressed.1.xml

#Run the system briefly to check the temperature
dynarun config.compressed.1.xml -c 1000000 -o config.compressed.2.xml

#Try to set the temperature through rescaling the particle velocities
dynamod config.compressed.2.xml -r 1.0 -o config.compressed.3.xml

#Run the system again to see how the temperature is affected
dynarun config.compressed.3.xml -c 1000000 -o config.compressed.4.xml

#Add a thermostat, to allow us to control the temperature
dynamod config.compressed.4.xml -T 1.0 -o config.thermostatted.xml

#Run the system using the thermostat to set the temperature and let it equilibrate
dynarun config.thermostatted.xml -c 1000000 -o config.equilibrated.xml

#Disable the thermostat again, so that we might collect accurate dynamic information
dynamod -T 0 config.equilibrated.xml -o config.equilibrated.xml

#Run the simulation to collect data on the system
dynarun config.equilibrated.xml -c 1000000 -o config.final.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  We'll now look in detail at these commands.
</p>
<h1><a id="settingup"></a>Setting up the configuration file</h1>
<p>
  When you first start using DynamO, it is not really practical to try
  to create a configuration file from scratch. The <b>dynamod</b> tool
  helps by providing many pre-made configuration files.
</p>
<p>
  Following the same steps
  in <a href="/index.php/tutorial2#generating-configuration-files">tutorial
  2</a>, we again query the available options of the <b>dynamod</b>
  command using the <i>--help</i> option:
</p>
<?php codeblockstart(); ?>dynamod --help<?php codeblockend("brush: shell;"); ?>
<p>
  We then look for the most useful mode and we see that square-well
  fluids can be made using <b>dynamod</b>'s packing mode 1. We can get
  some more information on this mode by adding the <i>--help</i>
  option:
</p>
<?php codeblockstart(); ?>dynamod -m 1 --help<?php codeblockend("brush: shell;"); ?>
<p>
  And a detailed description of the modes options will be outputted on
  screen:
</p>
<?php codeblockstart(); ?>...
Mode 1: Mono/Multi-component square wells
 Options
  -C [ --NCells ] arg (=7)    Set the default number of lattice unit-cells in each direction.
  -x [ --xcell ] arg          Number of unit-cells in the x dimension.
  -y [ --ycell ] arg          Number of unit-cells in the y dimension.
  -z [ --zcell ] arg          Number of unit-cells in the z dimension.
  --rectangular-box           Set the simulation box to be rectangular so that the x,y,z cells also specify the simulation aspect ratio.
  -d [ --density ] arg (=0.5) System density.
  --i1 arg (=FCC)             Lattice type (0=FCC, 1=BCC, 2=SC)
  --f1 arg (=1.5)             Well width factor (also known as lambda)
  --f2 arg (=1)               Well Depth (negative values create square shoulders)
  --s1 arg (monocomponent)    Instead of f1 and f2, you can specify a multicomponent system using this option. You need to pass the the parameters for each species as follows --s1 "diameter(d),lambda(l),mass(m),welldepth(e),molefrac(x):d,l,m,e,x[:...]"
...<?php codeblockend("brush: shell;"); ?>
<p>
  Here you can see many of the same options available for hard-sphere
  systems, as seen
  in <a href="/index.php/tutorial2#generating-configuration-files">tutorial
  2</a>. The only additions are the well width (<i>--f1</i>) and depth
  (<i>--f2</i>) options and the option for a multicomponent system
  (<i>--s1</i>).
</p>
<p>
  Lets start by making a monocomponent mixture of square-wells using
  the following command:
</p>
<?php codeblockstart(); ?>dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p style="font-family:monospaced;">
  The options passed here
  are <a href="/index.php/tutorial2#initial-positions-and-crystals">discussed
  in detail in tutorial 2</a>. The only differences are that the
  number of particles has been increased to 4000 (<i>-C 10</i>), we're
  creating square-well molecules (<i>-m 1</i>) instead of hard
  spheres, and the density is lower (<i>-d 0.1</i>). An example of the
  configuration file is available below (it is a large XML file, so
  your browser may take some time to display it).
</p>
<?php button("Example monocomponent configuration","/pages/config.tut4.mono.xml");?>
<p>
  As we haven't specified the well depth and well width, they have
  been left at their default values of 1 and 1.5 respectively. Next,
  we're going to compress the system!
</p>
<h1><a id="compressing"></a>Compressing the configuration</h1>
<p>
  We've created a relatively configuration with a reduced density of
  0.5.
</p>
<p>
  To access high density systems while avoiding generating invalid
  states, DynamO implements the linear compression algorithm first
  proposed by
  Woodcock[<a href="http://dx.doi.org/10.1111/j.1749-6632.1981.tb55667.x">paper</a>],
  but later popularised by Lubachevsky and
  Stillinger[<a href="http://dx.doi.org/10.1007/BF01054337">paper</a>]. This
  is a mode of simulation where all particles grow in size over
  time. At the end of the growth run, the dimensions are all rescaled
  so that the particles have the same initial size, but the simulation
  box has shrunk proportionally.
</p>
<p>
  To carry out the compression, use the <i>engine</i> option
  of <b>dynarun</b> to use the compression engine. You also set the
  end point of the compression using either
  the <i>--target-pack-frac</i> or the <i>--target-density</i>
  option. If you don't use these options, the compression will keep
  running and you'll have to manually stop the simulation
  by <a href="/index.php/FAQ#stoppausepeek">pressing ctrl-c</a>.
</p>
<?php codeblockstart(); ?>dynarun config.start.xml --engine=3 --target-pack-frac 0.3 -o config.compressed.xml<?php codeblockend("brush: shell;"); ?>
<p>
  Please see <a href="/index.php/FAQ#packingfraction">this FAQ</a> on why we decided to set the packing fraction,
  not the number density of the system.
</p>
<p>
  A video of an example compression run is given to the right (its a
  10:1 size ratio system to exaggerate the effect). The simulation
  ends automatically once the target number density or packing
  fraction is reached which may take some time. If the system appears
  to get "stuck" (the simulation time is not increasing), then it
  might be wise to stop the compression
  run, <a href="#rescaling">rescale the particle velocities</a>, and
  to run a normal simulation for a while to allow the system to relax.
</p>
<p>
  We will now finish setting up the system by looking at how we might
  control the temperature of the system.
</p>
<h1><a id="rescaling"></a>Rescaling velocities to set the temperature</h1>
<p>
  During compression you should be able to observe that the system's
  temperature and internal energy is varying significantly. This is
  due to the change in internal energy due to density changes as well
  as any work performed by the compression process. In repulsive
  systems, this work always causes heating resulting in faster moving
  particles and more events per unit of simulation time. This will
  cause the compression to slow down as the simulation has to process
  more events per unit of expansion. In attractive systems, the system
  may cool or heat on compression
  (see <a href="http://en.wikipedia.org/wiki/Joule%E2%80%93Thomson_effect">Joule-Thomson
  effect</a>), but even cooling is problematic if the system becomes
  "stuck".
</p>
<p>
  You may consider stopping the compression periodically and rescaling
  the temperature as it can accelerate the compression. You can find
  out how to <a href="/index.php/FAQ#stoppausepeek">stop any
  simulation while it is running in this FAQ</a>.  To rescale the
  temperature of a configuration file we can use the following dynamod
  command:
</p>
<?php codeblockstart(); ?>dynamod config.compressed.xml -r 1 -o config.rescaled.xml<?php codeblockend("brush: shell;"); ?>
<p>
  This will rescale the velocities of the particles in the system so
  that the current temperature is 1 (set by the <i>-r</i>
  option). Please note, that this does not thermostat the
  temperature. Rescaling the temperature only exactly sets/thermostats
  the temperature in "hard" systems such as the
  using <a href="/index.php/reference#typehardsphere">hard-sphere</a>/<a href="/index.php/reference#typeparallelcubes">parallel-cube</a>/<a href="/index.php/reference#typelines">hard-lines</a>
  systems. These systems have the internal energy of an ideal gas,
  therefore the temperature does not change with time (except if it is
  compressed). In systems such as the square-well fluid studied here
  we will need to use a thermostat to control the temperature.
</p>
<h1><a id="thermostat"></a>Adding a thermostat</h1>
<p>
   After you have rescaled the temperature and begin to simulate the
  system again, square-well particles may begin to rapidly heat or
  cool as they exchange configurational energy for kinetic energy.  If
  we want to measure the system at a set temperature, we will need to
  add a thermostat to try hold the system at the desired temperature.
</p>
<p>
  To add a thermostat, again use the dynamod tool:
</p>
<?php codeblockstart(); ?>dynamod config.rescaled.xml -T 1.0 -o config.thermostatted.xml<?php codeblockend("brush: shell;"); ?>
<p>
  This will add
  an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a> to the system with a target temperature of 1 (set by
  the <i>-T</i> argument). This thermostat will eventually bring the
  system to the specified temperature, even with changes in the
  configurational energy, by randomly reassigning particle velocities.
</p>
<p>
  <b>Note</b>: If you wish to change the thermostat temperature at a
  later time, you can use the dynamod on the configuration again:
</p>
<?php codeblockstart(); ?>dynamod config.thermostatted.xml -T 4.0 -o config.thermostatted.xml<?php codeblockend("brush: shell;"); ?>
<p>
  You can even use <b>dynamod</b> remove the thermostatt by using a
  temperature of zero (<i>-T 0</i>). Alternatively, you can open up
  the configuration file in a text editor, and edit
  the <a href="/index.php/reference#typeandersen">Andersen type
  System</a> event by hand:
</p>
<?php codeblockstart();?>
<System Type="Andersen" Name="Thermostat" MFT="1.0" Temperature="1.0" SetPoint="0.05" SetFrequency="100">
  <IDRange Type="All"/>
</System>
<?php codeblockend("brush: xml;"); ?>
<p>
  Now that we have set the density of the system and found a way to
  control its temperature, we can create a state point (simulation
  with a set temperature and density) and investigate its properties.
</p>
<h1>Running the simulation</h1>
<p>
  Now that the system is set up, we need to equilibrate it before we
  take any measurements. A rough guide to the length of time to
  equilibrate the system is 25 events per particle but the only way to
  be sure is to track properties and test that they reach a steady
  state value.
</p>
<h1>Processing the results</h1>
<p>
  Still writing
</p>
