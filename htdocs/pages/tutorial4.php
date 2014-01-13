<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Thermostats and data collection (transport properties)";
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
  a low density. We'll try to control the temperature using velocity
  rescaling, then using thermostats. Finally, we'll collect some
  measurements from the system. The commands we will use are
</p>
<?php codeblockstart(); ?>
#Create the low-density square-well system
dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 1 -o config.start.xml

#Run the system briefly to check the temperature
dynarun config.start.xml -c 1000000

#Try to set the temperature through a second rescaling the particle velocities
dynamod config.out.xml.bz2 -r 1.0

#Run the system again to see how the temperature is affected
dynarun config.out.xml.bz2 -c 1000000

#Add a thermostat, to allow us to control the temperature
dynamod config.out.xml.bz2 -T 1.0

#Run the system using the thermostat to set the temperature and let it equilibrate
dynarun config.out.xml.bz2 -c 1000000

#Disable the thermostat again, so that we might collect accurate dynamic information
dynamod -T 0 config.out.xml.bz2

#Run the simulation to collect data on the system
dynarun config.out.xml.bz2 -c 1000000 -o config.final.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  We'll now look in detail at these commands.
</p>
<h1><a id="settingup"></a>Setting up the configuration file</h1>
<p>
  When you first start using DynamO, it is not really practical to try
  to create a configuration file from scratch. The <b>dynamod</b> tool
  helps by providing many pre-designed systems to start your
  simulations from.
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
<?php button("Example initial configuration","/pages/config.tut4.start.xml");?>
<p>
  As we haven't specified the well depth and well width, they have
  been left at their default values of 1 and 1.5 respectively. Next,
  we're going to look at thermostatting the system.
</p>
<h1><a id="rescaling"></a>Rescaling velocities</h1>
<p>
  When creating the configuration, we initially set the temperature
  through the rescale option <i>-r</i>. This option works by rescaling
  all of the velocities of the particles so that the instantaneous
  temperature is one (or whatever is passed as an argument to the
  option). For a system without rotational degrees of freedom, the
  temperature is given by

  \[k_B\,T = \frac{1}{3\,N}\sum_i^N m_i\,v_i^2\]

  so it is clear that by scaling the velocities we can set the
  temperature to whatever we wish. However, rescaling the temperature
  only holds the temperature fixed (AKA thermostats) in "hard" systems
  such as the
  <a href="/index.php/reference#typehardsphere">hard-sphere</a>/<a href="/index.php/reference#typeparallelcubes">parallel-cube</a>/<a href="/index.php/reference#typelines">hard-lines</a>
  systems. This is because these systems have no finite potential
  energy terms between the particles, therefore the temperature does
  not change with time (except if we perform work such as compression
  on the system).
</p>
<p>
  For square-well systems, we can set the temperature at the start of
  the simulation, but it will change over time due to interactions
  converting energy between kinetic and potential modes. We can see
  this if we run a simulation on the starting configuration:
</p>
<?php codeblockstart(); ?>dynarun config.start.xml -c 1000000<?php codeblockend("brush: shell;"); ?>
<p>
  Please note, we didn't set an output configuration file name
  using <i>-o</i> so the default <i>config.out.xml.bz2</i> is
  used. Taking a look at the output, we can see the temperature (and
  <a href="/index.php/outputplugins#uconfigurational">excess internal
  energy $U$</a>) is fluctuating over time:
</p>
<?php codeblockstart(); ?>
...
ETA 16s, Events 100k, t 8.26149, <MFT> 0.16523, T 1.5725, U -0.85875
ETA 15s, Events 200k, t 15.2939, <MFT> 0.152939, T 1.58983, U -0.88475
ETA 13s, Events 300k, t 22.3303, <MFT> 0.148868, T 1.58567, U -0.8785
ETA 11s, Events 400k, t 29.2878, <MFT> 0.146439, T 1.592, U -0.888
...
<?php codeblockend("brush: shell;"); ?>
<p>
  You should note that if the temperature fluctuates higher, the
  internal energy fluctuates lower as the total energy is
  constant. You can see this if you calculate the average energy per
  particle

  \[\left\langle E\right\rangle=U + 3\,k_B\,T/2\]
  
  And see that for this system it remains constant at the starting
  value of 1.5. This is one of the nice properties of event-driven
  molecular dynamics, energy is exactly conserved. Unfortunately, we
  still need some way of setting the temperature. We could rescale
  again to take some energy out of the system to try to lower it to a
  temperature of 1, but this would need to be repeated over by hand
  until the temperature converged. Instead, we can use a thermostat to
  try to hold the temperature constant.
</p>
<h1><a id="thermostat"></a>Adding a thermostat</h1>
<p>
  To add an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a>, again use the dynamod tool:
</p>
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 1.0 <?php codeblockend("brush: shell;"); ?>
<p>
  Please note, we're loading the <i>config.out.xml.bz2</i> file,
  adding an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a>, and the result is saved into the default output file
  name, which is <i>config.out.xml.bz2</i>. This will overwrite the
  initial file, if you don't want to do this, specify a new file name
  with the <i>-o</i> option.
</p>
<p>
  The dynamod command above will add
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
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 4.0<?php codeblockend("brush: shell;"); ?>
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
