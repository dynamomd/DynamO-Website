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
    <a href="#datacollection">How to collect data, and considerations with thermostats.</a>
  </li>
  <li>
    <a href="#dataprocessing">How to process collected data, including
    transport coefficients, in the output file.</a>
  </li>
</ul>
<h2><a id="aboutsquarewellfluids"></a>About the system</h2>
<p>
  For the purpose of the tutorial, we'll want to simulate a fluid of
  square-well molecules at a reduced temperature of $k_B\,T=2$ and a
  reduced density of $\rho=0.1$ (see
  the <a href="/index.php/FAQ#q-what-units-does-the-dynamod-command-useproduce">FAQ
  on units</a> if you don't understand these values). If you want to
  learn more about the square-well potential, its parameters, and how
  it corresponds to realistic intermolecular interactions please see
  the reference entry linked below.
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
dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 2.0 -o config.start.xml
#Run the system briefly to check the temperature
dynarun config.start.xml -c 1000000
#Add a thermostat, to allow us to control the temperature
dynamod config.out.xml.bz2 -T 2.0
#Run the system using the thermostat to set the temperature and let it equilibrate
dynarun config.out.xml.bz2 -c 1000000
#Run it some more to equilibrate it further
dynarun config.out.xml.bz2 -c 1000000
#Disable the thermostat again, so that we might collect accurate dynamic information
dynamod -T 0 config.out.xml.bz2
#Run the simulation to collect data on the system
dynarun config.out.xml.bz2 -c 1000000 -o config.final.xml -L IntEnergyHist
<?php codeblockend("brush: shell;"); ?>
<p>
  We'll now look in detail at each of these commands.
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
<?php codeblockstart(); ?>dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 2.0 -o config.start.xml<?php codeblockend("brush: shell;"); ?>
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
  temperature is $k_B\,T=2$ (or whatever is passed as an argument to
  the option). <a href="/index.php/outputplugins#temperature">For a
  system without rotational degrees of freedom</a>, the temperature
  is given by

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
ETA 16s, Events 100k, t 7.08388, <MFT> 0.141678, T 2.47483, U -0.71225
ETA 14s, Events 200k, t 13.6032, <MFT> 0.136032, T 2.48533, U -0.728
ETA 12s, Events 300k, t 20.1072, <MFT> 0.134048, T 2.48133, U -0.722
ETA 11s, Events 400k, t 26.6342, <MFT> 0.133171, T 2.48267, U -0.724
...
<?php codeblockend("brush: shell;"); ?>
<p>
  You should note that if the temperature fluctuates higher, the
  internal energy fluctuates lower as the total energy is
  constant. You can see this if you calculate the average energy per
  particle

  \[\left\langle E\right\rangle=U + 3\,k_B\,T/2\]
  
  And see that for this system it remains constant at the starting
  value of $\approx3$. This is one of the nice properties of
  event-driven molecular dynamics, energy is exactly
  conserved. Unfortunately, we still need some way of setting the
  temperature. We could rescale again to take some energy out of the
  system to try to lower it to a temperature of $k_B\,T=2$, but this
  would need to be repeated over by hand until the temperature
  converged. Instead, we can use a thermostat to automatically
  add/remove energy from the system to reach a specified temperature.
</p>
<h1><a id="thermostat"></a>Adding a thermostat</h1>
<p>
  To add an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a>, again use the dynamod tool:
</p>
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 2.0 <?php codeblockend("brush: shell;"); ?>
<p>
  Please note that this command loads the <i>config.out.xml.bz2</i>
  file, adds an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a>, and the result is saved into the default output file
  name, which is <i>config.out.xml.bz2</i>. This will overwrite the
  initial file, if you don't want to do this, specify a new file name
  with the <i>-o</i> option.
</p>
<p>
  The dynamod command above will add
  an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a> to the system with a target temperature of $k_B\,T=2$
  (set by the <i>-T</i> argument). This thermostat will eventually
  bring the system to the specified temperature, even with changes in
  the configurational energy, by randomly reassigning particle
  velocities.
</p>
<p>
  <b>Note</b>: If you wish to change the thermostat temperature at a
  later time, you can use the dynamod on the configuration again:
</p>
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 4.0<?php codeblockend("brush: shell;"); ?>
<p>
  You can even use <b>dynamod</b> remove the thermostatt by using a
  temperature of zero (<i>-T 0</i>). Alternatively, you can open up
  the configuration file in a text editor, and edit or delete
  the <a href="/index.php/reference#typeandersen">Andersen type
  System</a> event by hand:
</p>
<?php codeblockstart();?>
<System Type="Andersen" Name="Thermostat" MFT="1.0" Temperature="1.0" SetPoint="0.05" SetFrequency="100">
  <IDRange Type="All"/>
</System>
<?php codeblockend("brush: xml;"); ?>
<p>
  With the thermostat added and the temperature set to 1, we can see
  what the result is on the temperature of the system. Again, running
  the system
</p>
<?php codeblockstart(); ?>dynarun config.out.xml.bz2 -c 1000000<?php codeblockend("brush: shell;"); ?>
<p>
  And the output should look like this:
</p>
<?php codeblockstart(); ?>
...
ETA 16s, Events 100k, t 6.28632, <MFT> 0.129188, T 2.15641, U -0.75675
ETA 15s, Events 200k, t 12.6762, <MFT> 0.130097, T 2.05169, U -0.771
ETA 13s, Events 300k, t 19.1881, <MFT> 0.13125, T 2.03105, U -0.7735
ETA 11s, Events 400k, t 25.678, <MFT> 0.131705, T 2.01297, U -0.75525
ETA 9s, Events 500k, t 32.179, <MFT> 0.13203, T 2.06379, U -0.7915
ETA 7s, Events 600k, t 38.6795, <MFT> 0.132246, T 2.02205, U -0.77625
ETA 6s, Events 700k, t 45.1681, <MFT> 0.132363, T 2.01704, U -0.7615
ETA 4s, Events 800k, t 51.6511, <MFT> 0.132437, T 2.04454, U -0.78925
ETA 2s, Events 900k, t 58.1523, <MFT> 0.132537, T 2.01887, U -0.79125
ETA 0s, Events 1000k, t 64.6884, <MFT> 0.132689, T 1.9653, U -0.7795
...
<?php codeblockend("brush: shell;"); ?>
<p>
  We can see that the temperature approaches the required temperature
  by the end. It's only just reached steady state (take a look at the
  instantaneous $T$ and $U$ values) so it might be best to run the
  configuration for another $10^6$ events.
</p>
<?php codeblockstart(); ?>dynarun config.out.xml.bz2 -c 10000000
...
ETA 16s, Events 100k, t 6.50405, <MFT> 0.13339, T 2.00641, U -0.7845
ETA 15s, Events 200k, t 13.0134, <MFT> 0.13345, T 1.98747, U -0.78325
ETA 13s, Events 300k, t 19.5232, <MFT> 0.133469, T 1.9498, U -0.7825
ETA 11s, Events 400k, t 26.1082, <MFT> 0.133857, T 1.97389, U -0.815
ETA 9s, Events 500k, t 32.6387, <MFT> 0.133873, T 2.01406, U -0.76675
ETA 7s, Events 600k, t 39.2339, <MFT> 0.134103, T 2.02729, U -0.79425
...
<?php codeblockend("brush: shell;"); ?>
<p>
  Much better. We're now ready to collect some data!
<h1 id="datacollection">Collecting Data</h1>
<p>
  At this point we have a system which has been equilibrated with a
  thermostat. We want to collect some information on the properties of
  the system, namely the internal energy histograms, diffusion
  coefficients, viscosity, and thermal conductivity.
</p>
<p>
  To find out what output plugins are available and how to load them
  please see the <a href="/index.php/outputplugins">output plugin
  documentation</a>. Most of what we want to collect is contained in
  the <a href="/index.php/outputplugins#misc">Misc</a> plugin which is
  loaded by default, but we'll need to add the <a href="/index.php/outputplugins#intenergyhist">IntEnergyHist</a>
  plugin to collect the energy histograms.
</p>
<p>
  Unfortunately there is a problem with thermostats while collecting
  data which characterises the dynamics of the system, e.g. the
  transport
  coefficients. The <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a> changes the motion of the system when it randomly
  re-assigns the particle velocities. Thus, if we measure the
  properties of the system, they will be the those of the square-well
  fluid AND the thermostat, not the fluid alone.
  
  Also, if we take a look at the restrictions on using
  the <a href="/index.php/outputplugins#thermalconductivityrestrictions">thermal
  conductivity</a>, we'll notice that it is restricted only to
  NVE/microcanonical simulations (systems without a thermostat).
</p>
<p>
  We're going to have to disable the thermostat during data collection
  and hope (and check) that the system fluctuates close to the target
  temperature. We can use dynamod to disable the thermostat:
</p>
<?php codeblockstart(); ?>
dynamod -T 0 config.out.xml.bz2
<?php codeblockend("brush: shell;"); ?>
<p>
  Now we're ready to collect some data! We just run dynarun while
  enabling the output plugins we wish to use:
</p>
<?php codeblockstart(); ?>
dynarun config.out.xml.bz2 -c 1000000 -o config.final.xml -L IntEnergyHist
<?php codeblockend("brush: shell;"); ?>
<p>
  And we're now ready to process the results!
</p>
<h1 id="dataprocessing">Processing the results</h1>
<h2>Thermodynamic properties</h2>
<p>
  In the first instance, we can start processing the collected data in
  the same way
  <a href="/index.php/tutorial2#processing">tutorial 2 deals with
    processing collected data</a>. Expanding the output file:
</p>
<?php codeblockstart(); ?>
bunzip2 output.xml.bz2
<?php codeblockend("brush: shell;"); ?>
<p>
  We can then check the file to see how close the temperature is to
  $k_B\,T=2$ after we disabled the thermostat. We use
  the <a href="/index.php/outputplugins#temperature">Temperature</a>
  tag in the output file for this:
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//Temperature"); ?>
<p>
 The average value has a deviation of $\approx1\%$ from the desired
 value, which can be expected with this system size. Larger systems
 (with longer equilibration times) will lower this value if needed (it
 scales with $N^{-0.5}$). Its also interesting to note that DynamO
 collects "exact" time averages wherever possible (see
 the <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">FAQ
 on averages</a>).
</p>
<p>
  We can also get some scale for the fluctuation of the temperature by
  calculating its standard deviation. We can calculate this using the
  mean square value, e.g.
  
  \[\sigma_T=\sqrt{\left\langle T^2\right\rangle - \left\langle T\right\rangle^2} \approx0.007542\]

  Again, this value is system size dependent and it is related the
  heat capacity of the system.
</p>
<p>
  Taking a look at
  the <a href="/index.php/outputplugins#uconfigurational">UConfigurational</a>
  tag, we have:
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//UConfigurational"); ?>
<p>
  where this is the total energy the system has through interactions
  (if you want the specific configurational internal energy you will
  need to divide by $N$). We could again calculate the standard
  deviation, but as its related to the residual heat capacity, $C_V$,
  by the following formula:
  
  \[\frac{C_v^{ex.}}{k_B}=\frac{\left\langle U_{conf.}^2\right\rangle
  - \left\langle U_{conf.}\right\rangle^2}{k_B^2\,T^2}\]

  we can just use
  the <a href="/index.php/outputplugins#uconfigurational">ResidualHeatCapacity</a>
  tag which calculates the above property:
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//ResidualHeatCapacity"); ?>
<p>
  Please note that, like the UConfigurational values, this value is
  extensive.  We'll now take a look at processing collected data which
  is more complex, beginning with the internal energy histogram.
</p>
<h2>Internal Energy Histogram</h2>
<p>
  The <a href="/index.php/outputplugins#intenergyhist">internal energy
  histogram</a> is extremely interesting as it allows us to begin to
  calculate properties such as the density of states and allows us to
  use advanced techniques such as multicanonical simulations and
  histogram reweighting. We enabled the internal energy histogram
  plugin with the <i>-L IntEnergyHist</i> option to dynarun and its
  output is under the <i>EnergyHist</i> tag.
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//EnergyHist"); ?>
<p>
  For all the details on what the above attributes mean, please see
  the
  <a href="/index.php/outputplugins#intenergyhist">IntEnergyHist
  plugin documentation</a>, but it is essentially a list of
  configurational internal energy values and the fraction of
  simulation time spent in each (again collected
  using <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">exact
  time averaging</a> and not periodic sampling. If we wanted to
  process or plot this data, we need to cut it out of
  the <i>output.xml</i> file. For a full description of how to handle
  XML files, please <a href="/index.php/tutorialA">take a look at the
  reference</a>. Here, we'll use the xmlstarlet tool to cut it out:
</p>
<?php codeblockstart(); ?>
xmlstarlet sel -t -v '//EnergyHist/HistogramWeighted' output.xml > histogram.dat
<?php codeblockend("brush: shell;"); ?>
<p>
  Now we can plot the data and we should end up with a graph like the
  one on the right.
</p>
<h2>Transport Properties</h2>
