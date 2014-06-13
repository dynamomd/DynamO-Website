<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Thermostats and transport properties"; 
   $pagetab="Tutorial 4";
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
    <a href="#datacollection">How to collect data and considerations with thermostats.</a>
  </li>
  <li>
    <a href="#dataprocessing">How to process collected data. This
    includes transport coefficients using <b>dynatransport</b>.</a>
  </li>
</ul>
<p>
  This is a full study on the square-well fluid system.
</p>
<h2 id="aboutsquarewellfluids">About the system</h2>
<p>
  For the purpose of the tutorial, we'll want to simulate a fluid of
  square-well molecules. These are essentially hard-sphere particles
  with a short-range attractive well:
</p>
<div style="text-align:center;">
<?php embedfigure("/images/sw.png", 650, 232, "A diagram of a square-well molecule including its parameters.");?>
</div>
<p>
  We will simulate this fluid at a reduced temperature of $k_B\,T=2$
  and a reduced density of $\rho=0.1$. If you want to learn more about
  the square-well potential, its parameters, and how it corresponds to
  realistic intermolecular interactions please see
  the <a href="/index.php/reference#typesquarewell">reference
  entry</a>. If you're uncertain of the units please see
  the <a href="/index.php/FAQ#q-what-units-does-the-dynamod-command-useproduce">FAQ
  on units</a>, but everything here is presented in reduced units.
</p>
<p>
  We will again use <a href="/index.php/reference#typepbc">periodic
  boundary conditions</a> to allow us to simulate an infinite fluid
  without the effects of walls or other containers.
</p>
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
#Disable the thermostat and remove any momentum, so that we might collect accurate dynamic information
dynamod -T 0 -Z config.out.xml.bz2
#Run the simulation to collect data on the system
dynarun config.out.xml.bz2 -c 1000000 -o config.final.xml -L IntEnergyHist -L MSD
#Use dynatransport to analyse the transport coefficients
dynatransport output.xml -s 2 -c 10 -v
<?php codeblockend("bash"); ?>
<p>
  We'll now look in detail at each of these commands.
</p>
<h1 id="settingup">Setting up the configuration file</h1>
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
<?php codeblockstart(); ?>dynamod --help<?php codeblockend("bash"); ?>
<p>
  We then look for the most useful mode and we see that square-well
  fluids can be made using <b>dynamod</b>'s packing mode 1. We can get
  some more information on this mode by adding the <i>--help</i>
  option:
</p>
<?php codeblockstart(); ?>dynamod -m 1 --help<?php codeblockend("bash"); ?>
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
...<?php codeblockend("bash"); ?>
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
<?php codeblockstart(); ?>dynamod -m 1 -C 10 -d 0.1 --i1 0 -r 2.0 -o config.start.xml<?php codeblockend("bash"); ?>
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
<h1 id="rescaling">Rescaling velocities</h1>
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
<?php codeblockstart(); ?>dynarun config.start.xml -c 1000000<?php codeblockend("bash"); ?>
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
<?php codeblockend("bash"); ?>
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
<h1 id="thermostat">Adding a thermostat</h1>
<p>
  To add an <a href="/index.php/reference#typeandersen">Andersen
  thermostat</a>, again use the dynamod tool:
</p>
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 2.0 <?php codeblockend("bash"); ?>
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
<?php codeblockstart(); ?>dynamod config.out.xml.bz2 -T 4.0<?php codeblockend("bash"); ?>
<p>
  You can even use <b>dynamod</b> remove the thermostatt by using a
  temperature of zero (<i>-T 0</i>). Alternatively, you can open up
  the configuration file in a text editor, and edit or delete
  the <a href="/index.php/reference#typeandersen">Andersen type
  System</a> event by hand:
</p>
<?php codeblockstart();?>
<System Type="Andersen" Name="Thermostat" MFT="2.0" Temperature="1.0" SetPoint="0.05" SetFrequency="100">
  <IDRange Type="All"/>
</System>
<?php codeblockend("xml"); ?>
<p>
  With the thermostat added and the temperature set to $k_B\,T=2$, we
  can see what the result is on the temperature of the system. Again,
  running the system
</p>
<?php codeblockstart(); ?>dynarun config.out.xml.bz2 -c 1000000<?php codeblockend("bash"); ?>
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
<?php codeblockend("bash"); ?>
<p>
  We can see that the temperature approaches the required temperature
  at the end. Looking at the instantaneous $T$ and $U$ values it
  appears to have reached steady state after around 200k events. The
  average mean free time (<i>MFT</i>) is still changing but this is
  due to it accumulating samples during the equilibration. We can
  confirm this by running the configuration for another $10^6$ events.
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
<?php codeblockend("bash"); ?>
<p>
  Here its easy to see that the mean free time is relatively stable as
  well. It is very difficult to conclusively prove that we're at
  steady state but previous experience with this system tells us that
  we're now ready to collect some data.
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
  loaded by default, but we'll need to add
  the <a href="/index.php/outputplugins#intenergyhist">IntEnergyHist</a>
  and <a href="/index.php/outputplugins#msd">MSD</a> plugins to
  collect the energy histograms and diffusion data.
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
dynamod -T 0 -Z config.out.xml.bz2
<?php codeblockend("bash"); ?>
<p>
  Please note that we also zeroed the total momentum again using
  the <i>-Z</i> option as the <a href="/index.php/FAQ#q-the-andersen-thermostat-is-giving-me-a-nonzero-system-momentum-average-is-this-an-error">Andersen thermostat causes the total
  momentum to fluctuate around zero</a>. Now we're ready to collect some
  data! We just run dynarun while enabling the output plugins we wish
  to use:
</p>
<?php codeblockstart(); ?>
dynarun config.out.xml.bz2 -c 1000000 -o config.final.xml -L IntEnergyHist
<?php codeblockend("bash"); ?>
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
<?php codeblockend("bash"); ?>
<p>
  We can then check the file to see how close the temperature is to
  $k_B\,T=2$ after we disabled the thermostat. We use
  the <a href="/index.php/outputplugins#temperature">Temperature</a>
  tag in the output file for this:
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//Temperature"); ?>
<p>
 The average value has a deviation of $\approx2\%$ from the desired
 value, which can be expected with this system size. Larger systems
 (with longer equilibration times) will lower this value if needed as
 the fluctuations scale with $N^{-0.5}$. For publication results, I
 would recommend setting the temperature more accurately, perhaps
 using the calculated heat capacity to estimate the required energy to
 add or remove from the system to more accurately set the temperature.
</p>
<p>
 It is interesting to note at this point that DynamO collects "exact"
 time averages wherever possible (see
 the <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">FAQ
 on averages</a>). By exact we mean that the mean values are not
 discretely sampled over the trajectory, but are true time averages
 integrated over the length of the simulation.
</p>
<p>
  We can also get some scale for the fluctuation of the temperature by
  calculating its standard deviation. We can calculate this using the
  mean square value, e.g.
  
  \[\sigma_T=\sqrt{\left\langle T^2\right\rangle - \left\langle T\right\rangle^2} \approx0.009079\]

  Again, this value is system size dependent. Interestingly, in NVE
  simulations this value is related the heat capacity of the system;
  however, we will calculate this property through the configurational
  internal energy below.
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
  deviation which is related to the residual heat capacity, $C_V^{ex.}$, by
  the following formula:
  
  \[\frac{C_v^{ex.}}{k_B}=\frac{\left\langle U_{conf.}^2\right\rangle
  - \left\langle U_{conf.}\right\rangle^2}{k_B^2\,T^2}\]

  however, for convenience we can just use
  the <a href="/index.php/outputplugins#uconfigurational">ResidualHeatCapacity</a>
  tag which calculates this for us:
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
  calculate key thermodynamic properties such as the density of
  states. This also allows us to use advanced techniques such as
  multicanonical simulations and histogram reweighting. We enabled the
  internal energy histogram plugin with the <i>-L IntEnergyHist</i>
  option to dynarun and its output is under the <i>EnergyHist</i> tag
  in the output file:
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
<div style="clear:right; float:right">
<?php embedfigure("/images/histogram.tut4.png", 323, 350, "A rough internal energy histogram.");?>
</div>
<?php codeblockstart(); ?>
xmlstarlet sel -t -v '//EnergyHist/HistogramWeighted' output.xml > histogram.dat
<?php codeblockend("bash"); ?>
<p>
  Now we can plot the data and we should end up with a graph like the
  one on the right. It appears that this data is quite rough and
  longer simulations are needed to accurately obtain good averages,
  but this is a good initial estimate.
</p>
<p>
  We've covered some basic properties and how to extract tabulated
  data, now we will take a look at the transport properties.
</p>
<h2>Transport Properties</h2>
<p>
  Transport properties, such as the viscosity, thermal conductivity,
  and diffusivity are difficult to measure in simulation. They require
  the use of correlators and need long simulation times to gain good
  averages. You also need to be careful of their definition,
  especially in multicomponent systems, and over what correlation
  times it is valid to collect data from. This is all documented in
  the <a href="/index.php/outputplugins#thermalconductivity">reference
  entry for the thermal conductivity</a> but there is no substitute
  for experience here. Please calculate known values from the
  literature to validate your understanding before attempting to
  measure new systems.
</p>
<p>
  The easiest transport property to calculate is the self-diffusion
  coefficient, obtained from
  the <a href="/index.php/outputplugins#msd">MSD plugin</a>:
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//MSD"); ?>
<p>
  Here, each Species and Topology will have a separate entry for the
  calculated diffusion coefficient. This value is just calculated from
  the total distanced travelled over the simulation by each particle,
  so there isn't a significant amount of work to do in processing
  it. We only need to be confident that the simulations have been run
  for sufficient time to reach the long-time behavior.
<p>
  The other transport property data lies within several correlator
  tags. E.g.
</p>
<?php xmlXPathFile("pages/output.tut4.xml", "//ThermalConductivity"); ?>
<div style="clear:right; float:right">
<?php embedfigure("/images/correlator.tut4.png", 384, 319, "The Einstein correlators for the thermal conductivity in each
    direction and the number of samples collected at each time point.");?>
</div>
<p>
  For the thermal conductivity, the first column is the time, the
  second is the number of samples collected at that time, and the last
  three columns are the correlator values in the $x$, $y$, and
  $z$-directions. For more information please take a look at
  the <a href="/index.php/outputplugins#thermalconductivity">reference
  entry for the thermal conductivity</a>. As these are the Einstein
  correlators, the transport coefficients are the gradients of the
  correlation functions. If we cut the data out of <i>output.xml</i>
  using xmlstarlet or some other tool and plot each correlator we end
  up with the graph to the right.
</p>
<p>
  Ideally, this plot should consist of points in a straight line which
  we can fit to extract the slope/thermal transport coefficient,
  $L_{\lambda\lambda}$. Unfortunately, at short times we have
  short-time effects from molecular processes which dominate the
  correlator. We are only interested in the behaviour at long times,
  where a "hydrodynamic" description applies, so we need to avoid
  these short-time effects. Unfortunately again, at long times we have
  poor statistics (see the low number of samples at long times) AND we
  have effects from the periodic boundary conditions.
</p>
<p>
  We need to extract the correlator curves from a window which has
  good statistics, ignores short times and avoids long time effects
  and poor statistics. Once we have the window of time, we need to fit
  a linear function to the correlator, and to calculate the
  gradient/transport coefficient. Luckily, there is
  the <b>dynatransport</b> tool to help us do all of this.
</p>
<h3>dynatransport</h3>
<p>
If we run the <b>dynatransport</b> tool on the output file, we can get
an estimate of the transport coefficients.
</p>
<?php codeblockstart(); ?>
dynatransport output.xml
ShearViscosityL_{\eta,\eta}= 0.0628751050012 +- 0.0 <R>^2= 0.386109814931
BulkViscosityL_{\kappa,\kappa}= 11.3811651077 +- 0.0 <R>^2= 0.567696677048
ThermalConductivityL_{\lambda,\lambda}= 0.178111094018 +- 0.0 <R>^2= 0.535953655856
ThermalDiffusionL_{\lambda,Bulk}= -3.03999278728e-18 +- 0.0 <R>^2= 0.736800451496
MutualDiffusionL_{Bulk,Bulk}= 1.04605741811e-34 +- 0.0 <R>^2= 0.893542145422
<?php codeblockend("bash"); ?>
<p>
  By default, <b>dynatransport</b> uses the full data set to calculate
  the correlators. You should be able to see that the $R^2$ values of
  the fits are significantly below $1$ which indicates that the
  correlators are not linear in the window selected. We can view the
  current fit by passing the <i>-v</i> option:
</p>
<?php codeblockstart(); ?>
dynatransport output.xml -v
<?php codeblockend("bash"); ?>

<div style="clear:right; float:right">
<?php embedfigure("/images/tut4.dynatransport.1.png", 400, 322,
    "Sample output for the viscosity from dynatransport when used with
    the <i>-v</i> option.");?>
</div>
<p>
  This will give plots, like the one presented to the right, for each
  transport property, including averaged correlator data, standard
  deviations between each dimension, and the regressed line used to
  calculate the coefficient.
</p>
<p>
  Clearly, this linear fit is terrible and focuses too much on the
  long time section which has poor sampling. After examining the fit
  and testing a few different window sizes its clear that one suitable
  window appears to be $\Delta t \in [2,10]$. We can set this window
  for dynatransport using the start (<i>-s</i>) and cutoff (<i>-c</i>)
  options to give:
</p>
<?php codeblockstart(); ?>
dynatransport output.xml -s 2 -c 10 -v
ShearViscosityL_{\eta,\eta}= 0.195306335342 +- 0.0 <R>^2= 0.999498595286
BulkViscosityL_{\kappa,\kappa}= 0.0707529418455 +- 0.0 <R>^2= 0.0110843745332
ThermalConductivityL_{\lambda,\lambda}= 0.508343229525 +- 0.0 <R>^2= 0.997347634149
ThermalDiffusionL_{\lambda,Bulk}= -4.22881210719e-19 +- 0.0 <R>^2= 0.866354789486
MutualDiffusionL_{Bulk,Bulk}= 2.2536681734e-35 +- 0.0 <R>^2= 0.968183740424
<?php codeblockend("bash"); ?>
<div style="clear:right; float:right">
<?php embedfigure("/images/tut4.dynatransport.2.png", 400, 322,
    "Sample output from dynatransport when used with the <i>-v -s 2 -c
    10</i> options to control the time window used for data fitting.");?>
</div>
<p>
  This fit is significantly better (see plot), although there is some strong
  variation between the dimensions it appears that the average is
  almost linear. We're only comparing the fit for the viscosity but
  all fits should be checked.
</p>
<p>
  Using this window gives a much better fit for the thermal conductivity
  $L_{\lambda\,\lambda}\approx0.5083$ and viscosity
  $L_{\eta\,\eta}\approx0.1953$. The bulk viscosity is relatively hard
  to calculate and you should notice that the thermal diffusion,
  $L_{\lambda\,Bulk}$, and mutual diffusion, $L_{Bulk,Bulk}$,
  coefficients are close to zero. These coefficients are only non-zero
  for systems with multiple Species.
</p>
<h1>Conclusions</h1>
<p>
  We've simulated a square well system of $N=4000$ molecules/particles
  with a well-width of $\lambda=1.5$ at a reduced density of
  $\rho=0.1$ and temperature
  $k_B\,T=1.97\approx2$. Using <b>dynarun</b> we've equilibrated and
  run the simulation to collect data. We've then calculated the
  average configurational internal energy $U_{conf.}\approx-3161$ and
  internal energy histograms.  Using <b>dynatransport</b> we've
  calculated the self-diffusion coefficient $D\approx1.957$, thermal
  conductivity $L_{\lambda\,\lambda}\approx0.5083$, and viscosity
  $L_{\eta\,\eta}\approx0.1953$.
</p>
<p>
  This is our first proper study with DynamO. Now we will look at more
  complex systems and how to set them up.
</p>
