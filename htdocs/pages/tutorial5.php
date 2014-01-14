<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Example: Multicomponent Square-Well Fluid";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written and is incomplete.</b>
</p>
<p>
  This tutorial uses an example study of multicomponent square-well
  particles to introduce several topics:
</p>
<ul>
  <li>
    How to use the example configurations generated by
    the <b>dynamod</b> command as a basis for more complex systems.
  </li>
  <li>
    <a href="#settingup">How to specify multiple species and complex interactions in the
    configuration file.</a>
  </li>
  <li>
    <a href="#compressing">How to compress a simulation to higher
    densities.</a>
  </li>
  <li>
    <a href="#rescaling">How to rescale the temperature in a
    configuration.</a>
  </li>
  <li>
    <a href="#thermostat">How to add a thermostat.</a>
  </li>
  <li>
    How to process collected data, including transport coefficients,
    in the output file.
  </li>
</ul>
<p>
  Although this tutorial looks at a multicomponent square-well fluid,
  it provides you with all of the knowledge you need to study any
  multicomponent system.
</p>

<h2><a id="aboutsquarewellfluids"></a>About square-well fluids</h2>
<p>
  For the purpose of the tutorial, we'll want to simulate a mixture of
  square-well molecules. If you want to learn more about the
  square-well potential, its parameters, and how it corresponds to
  realistic intermolecular interactions please see the reference entry
  linked below.
</p>
<?php button("Reference entry for <i>\"SquareWell\"</i> Type <b>Interactions</b>","/index.php/reference#typesquarewell");?>
<p>
  We will again use periodic boundary conditions, and these are
  described in the following reference entry.
</p>
<?php button("Reference entry for <i>\"PBC\"</i> Type <b>BoundaryConditions</b>","/index.php/reference#typepbc");?>
<h2>The whole tutorial in brief</h2>
<p>
  We're going to study a binary mixture of square-well
  molecules. We'll have a larger species, A, and a smaller species,
  B. The mixture we will study has a hard-core diameter ratio of
  $\sigma_A/\sigma_B=2$ and a mass ratio proportional to their
  volumes $m_A/m_B=\sigma_A^3/\sigma_B^3=8$. Both molecules have
  the same well-width factor $\lambda_A=\lambda_B=1.5$. For
  interactions between species we'll use the additive rule. For
  example, between species A and B the interaction diameter is
  $\sigma_{AB}=\left(\sigma_A+\sigma_B\right)/2$. We'll want to study
  a mixture of $N=4000$ particles over a range of densities and
  concentrations. The dynamod/dynarun commands are
</p>
<?php codeblockstart(); ?>
#Create the monocomponent system
dynamod -m 1 -C 10 -d 0.5 --i1 0 -r 1 -o config.start.xml

#Now edit config.start.xml by hand to convert it into a multicomponent system
#...

#Compress the multicomponent system to a higher density
dynarun config.start.xml --engine=3 --target-pack-frac 0.1 -o config.compressed.xml

#Add a thermostat, to allow us to control the temperature
dynamod config.compressed.xml -T 1.0 -o config.thermostatted.xml

#Equilibrate the system using the thermostat to set the temperature
dynarun config.thermostatted.xml -c 1000000 -o config.equilibrated.thermostatted.xml

#Disable the thermostat again, so that we might collect accurate dynamical information
dynamod -T 0 config.equilibrated.thermostatted.xml -o config.equilibrated.xml

#Run the simulation again to ensure it is relaxed/equilibrated from disabling the thermostatt
dynarun config.equilibrated.xml -c 1000000 -o config.equilibrated.xml

#Now collect data on the system
dynarun config.equilibrated.xml -c 1000000 -o config.final.xml
<?php codeblockend("brush: shell;"); ?>
<p>
  We'll now look in detail at these commands, in particular how the
  configuration file was edited by hand into a multicomponent system.
</p>
<h1><a id="settingup"></a>Setting up the configuration file</h1>
<p>
  When you first start using DynamO, it is not really practical to try
  to create a configuration file from scratch. It is much simpler and
  convenient to take an existing configuration, which is close to the
  system you wish to study, and to modify it. Once you are familiar
  with the file format you may then write your own tools to generate
  configuration files in the programming language of your choice (see
  <a href="/index.php/tutorialA">Appendix A</a> for more information
  on this).
</p>
<p>
  We need to see what systems the <b>dynamod</b> command can prepare
  so that we can pick the most convenient starting point for the
  multicomponent square-well system. We again query the available
  options of the <b>dynamod</b> command using the <i>--help</i>
  option:
</p>
<?php codeblockstart(); ?>dynamod --help<?php codeblockend("brush: shell;"); ?>
<p>
  A full listing of the options of the <b>dynamod</b> program is
  outputted, and the start of the list of systems it can create/pack
  should look like the following:
</p>
<?php codeblockstart(); ?>...
Packer options:
  -m [ --pack-mode ] arg Chooses the system to pack (construct)
                         Packer Modes:
                         0:  Monocomponent hard spheres
                         1:  Mono/Multi-component square wells
                         2:  Random walk of an isolated attractive polymer
<?php codeblockend("brush: shell;"); ?>
<p>
  We see that square-well fluids can be made using <b>dynamod</b>'s
  packing mode 1. We can get some more information on this mode using
  the following command:
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
  This mode can create a multicomponent system for us using the first
  string option (<i>--s1</i>), but we'll create it by hand from the
  monocomponent system.
</p>
<p>
  Lets start by making a monocomponent mixture of square-wells using
  the following command:
</p>
<?php codeblockstart(); ?>dynamod -m 1 -C 10 -d 0.5 --i1 0 -r 1 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
<p style="font-family:monospaced;">
  The options passed here
  are <a href="/index.php/tutorial2#initial-positions-and-crystals">discussed
  in detail in tutorial 2</a>. The only differences are that the
  number of particles has been increased to 4000 (<i>-C 10</i>), and
  we're creating square-well molecules (<i>-m 1</i>) instead of hard
  spheres. An example of the configuration file is available below (it
  is a large XML file, so your browser may take some time to display
  it).
</p>
<?php button("Example monocomponent configuration","/pages/config.tut5.mono.xml");?>
<p>
  This system has the 4000 particles we're looking for, but we'll need
  to convert a fraction of these to another species to make the
  multicomponent square-well system we wish to study. In the following
  sections we look at what needs to be done to perform this
  conversion, and learn how DynamO handles multiple interactions.
</p>
<h2>Adding a new Species</h2>
<p>
  If you open the <i>config.start.xml</i> file in a text editor,
  you'll notice that there is only one <b>Species</b> defined:
</p>
<?php xmlXPathFile("pages/config.tut5.mono.xml", "/DynamOconfig/Simulation/Genus"); ?>
<p>
  If we want to study a binary system, we'll need to define two
  <b>Species</b> to be able to get per-species results in the output
  data. Using two <b>Species</b> also provides a convenient way to
  specify the different masses of the two types of particles. Lets
  assume we want to convert the first 100 particles in the
  configuration file to
  <b>Species</b> "A" and have the rest as <b>Species</b> "B", we can change the file
  to:
</p>
<?php xmlXPathFile("pages/config.tut5.binary.xml", "/DynamOconfig/Simulation/Genus"); ?>
<p>
  You should notice that we've reduced the mass of the smaller
  particles (type B) to match the ratio $m_A/m_B=8$. This implies that
  we'll also need to effectively shrink the diameter of the particles
  which are becoming <b>Species</b> B. Instead, we could have
  increased the mass of the larger particles (type A) to satisfy this
  ratio; but this would have meant that we would also have to increase
  their diameter. The problem with increasing diameters of particles
  by hand is that you may accidentally cause nearby particles to
  overlap. We must be careful to avoid creating overlapping cores, as
  the dynamics are undefined in these cases. DynamO is extremely
  stable and may eventually resolve these overlaps but it is not
  guaranteed in all cases. We have kept one mass at a value of one, as
  this corresponds to a set of reduced units (see
  the <a href="/index.php/FAQ#q-what-units-does-the-dynamod-command-useproduce">FAQ
  on the units of DynamO</a>)
</p>
<p>
  You should also notice that the <b>IDRange</b>
  of <b>Type</b> <i>"Ranged"</i> is an inclusive range of particle
  ID's. The particle ID's start with zero and end on 99; therefore,
  the first <b>Species</b> tag corresponds to the first 100 particles
  in the configuration file.  For more information on the
  <i>"Ranged"</i> <b>IDRange</b> tag, please see the reference:
</p>
<?php button("Reference entry for <i>\"Ranged\"</i> Type <b>IDRange</b>","/index.php/reference#typeranged");?>
<p>
  In the next section we'll take a look at setting up all of
  the <b>Interaction</b>s of the system.
</p>
<h2>Setting up the Interactions</h2>
<p>
  In the original file, only
  one <a href="/index.php/reference#typesquarewell">square-well
  Type <b>Interaction</b></a> is defined:
</p>
<?php xmlXPathFile("pages/config.tut5.mono.xml", "/DynamOconfig/Simulation/Interactions", 4, 2); ?>
<p>
  Here, we will use three separate <b>Interaction</b> tags to input
  the parameters of the three types of interactions between all
  species (A-A, A-B, and B-B). We were very careful to shrink the mass
  of type "B" particles so that, in order to obtain the ratio
  $\sigma_A/\sigma_B=2$, the large particles will have a diameter of
  $\sigma_A=1$ and the small particles a diameter of
  $\sigma_B=0.5$. An example implementation using these diameters is
  given below:
</p>
<?php xmlXPathFile("pages/config.tut5.binary.xml", "/DynamOconfig/Simulation/Interactions", 4,3); ?>
<p>
  The first <b>Interaction</b> entry handles the interactions
  between <b>Species</b> "A" particles. A
  special <a href="/index.php/reference#typesingle">"Single" type
  IDPairRange</a> is used to convert a single IDRange, which
  identifies all of the type A particles, into a <b>IDPairRange</b>
  describing all pairings of type A particles.
</p>
<?php button("Reference entry for <i>\"Single\"</i> Type <b>IDPairRange</b>","/index.php/reference#typesingle");?>
<p>
  The second <b>Interaction</b> entry corresponds to the inter-<b>Species</b>
  <b>Interaction</b>s between type A and type B particles. Here,
  another type of <b>IDPairRange</b> is used which takes
  two <b>IDRange</b>s and creates a
  <b>IDPairRange</b> which matches all pairings between them. The
  diameter of the <b>Interaction</b> is worked out using the additive
  rule:

  \[\sigma_{AB}=\left(\sigma_A+\sigma_B\right)/2=\left(1+0.5\right)/2=0.75\]

  Technically, the Lambda is also calculated using the additive rule,
  but as both <b>Species</b> have the same Lambda value we have
  $\lambda_{AB}=\lambda_A=\lambda_B=1.5$.
</p>
<?php button("Reference entry for <i>\"Pair\"</i> Type <b>IDPairRange</b>","/index.php/reference#typepair");?>
<p>
  The final <b>Interaction</b> represents the intra-<b>Species</b>
  interactions between the type B particles. Surprisingly, this has
  an <i>"All"</i> type
  <b>IDPairRange</b> tag which maps to all possible pairings of particles in
  the system. This works due to the way that DynamO searches for
  <b>Interaction</b>s. DynamO moves down the list of <b>Interaction</b>s <u>in
  order</u> testing against each <b>Interaction</b> for a match. The first
  match is the one that is returned! So, this last tag actually
  matches all pairs <u>except</u> for those that match above. The only
  pairs which are left are the B-B pairings.
</p>
<p>
  In the third <b>Interaction</b>, we could have also used the
  following <b>IDPairRange</b> instead of the "All" type:
</p>
<?php codeblockstart(); ?>
<IDPairRange Type="Single">
  <IDRange Type="Ranged" Start="100" End="3999"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  A good reason for using the catch-<i>"All"</i> <b>Interaction</b> in
  the end is that in complex systems with
  unusual <b>Interaction</b> <b>IDPairRange</b>s it can be quite hard
  to define which particles are actually left over. Using
  an <i>"All"</i> rule at the end and catching the complex
  interactions first makes it simpler to implement.
</p>
<p>
  Although the example <b>Interaction</b>s listed above are suitable
  for our system, it is obvious there is more than one way to specify
  the
  <b>Interaction</b>s. For example, we could specify the <i>B-B</i>
  Interaction first instead. A general rule for DynamO is that the
  simplest configuration files are the fastest but the way in which
  the <b>Interaction</b>s are specified will usually not make much
  difference to the performance of DynamO, so use whatever is most
  convenient for you.
</p>
<h3>About CaptureMap tags</h3>
<p>
  You should notice that the <b>CaptureMap</b> tag in the original
  mono-component configuration file has been deleted and that the new
  <b>Interaction</b> tags do not contain them. This is deliberate as
  we want DynamO to rebuild the <b>CaptureMap</b> as we have changed the
  <b>Interaction</b> parameters. For more information
  on <b>CaptureMap</b>s and why deleting it is required, please see
  the reference linked below.
</p>
<?php button("Reference entry for <b>CaptureMap</b>","/index.php/reference#capturemap");?>
<h2>Summary and finished example</h2>
<p>
  The configuration has now been modified to a two-component
  square-well system and an example of the finished
  configuration is available below. 
</p>
<?php button("Example low-density binary configuration","/pages/config.tut5.binary.xml");?>
<p>
  We'll now look at converting this into a high density
  configuration and how to thermostat the temperature.
</p>
<h1><a id="compressing"></a>Compressing the configuration</h1>
<div class="figure" style="clear:right; float:right;width:400px;">
  <?php embedAJAXvideo("tut4_compression", "x62zeoF457w", 400, 225); ?>
  <div class="caption">
    A 10:1 size-ratio low-density binary square-well system under
    compression.<br/>
    <a href="/pages/config.tut5.binary.xml">View configuration file</a>
  </div>
</div>
<p>
  To create the binary system we had to shrink one set of particles to
  avoid causing any overlaps or invalid states. Unfortunately, this
  results in a low-density configuration (for example see right). The
  low-density behaviour of fluids is fairly well-understood as it
  approaches that of an ideal gas. Most of the interesting behaviour
  we wish to explore through simulation appears at higher densities,
  so we need a method to generate high-density systems.
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