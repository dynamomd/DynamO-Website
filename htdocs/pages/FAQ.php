<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Frequently asked questions";
   ?>
<?php printTOC(); ?>
<p>
  Here are a list of frequently asked questions and their answers.
</p>
<h1>Q: What does DynamO stand for?</h1>
<p>
  Short answer: <b>Dynam</b>ics of <b>O</b>bjects.
</p>
<p>
  A more precise name would be "Dynamics of Discrete Objects," so if
  there is ever an O'Reilly book on DynamO it will feature a Dodo on
  the front cover.
</p>
<h1>Q: What is the logo of DynamO?</h1>
<div class="figure" style="float:left; width:200px;">
  <a href="/images/dynamologo.png">
    <img height="205" width="200" alt="The dynamo logo" src="/images/dynamologo.png"/>
  </a>
  <div class="caption">
    The DynamO logo.
  </div>
</div>
<p>
  Short answer: An illustration of an electric dynamo (see left),
  which forms the O of DynamO.
</p>
<p>
  The "source" of the drawing is the U.S. Patent 284,110 which
  describes an electric dynamo. The original figure was redrawn using
  inkscape. The artwork for the logo is available in the docs folder
  of the source code
  (<a href="https://github.com/toastedcrumpets/DynamO/tree/master/docs">available
  here</a>).
</p>
<h1 style="clear:both;" id="q-what-units-does-the-dynamod-command-useproduce">Q: What are the units of DynamO?</h1>
<p>
  Short answer: whatever units you use in the input configuration
  file.
</p>
<p>
  The configuration files expose almost every parameter of the system
  (see below about $k_B$), so whatever units you use to setup the
  DynamO input, these are used as the units of the output. You must be
  consistent in your choice of units, so if the particle sizes are
  specified in Angstroms, your simulation size, particle positions,
  and all other parameters with units of length must also be specified
  in Angstroms. But, provided you are consistent in your choice of
  units, you may use any set of units you like.
</p>
<p>
  There are two peculiarities which are discussed below:
</p>
<ul>
  <li>
    The example configurations produced by the dynamod command use the
    natural set of dimensionless units for the system studied,
    and <a href="#q-what-units-does-the-dynamod-command-useproduce">this
    is discussed in more detail in the following question</a>.
  </li>
  <li>
    <p>
      In DynamO and in many other simulation packages (such as
      GROMACS), <a href="http://en.wikipedia.org/wiki/Boltzmann_constant">Boltzmann's
      constant</a> is assumed to be one $(k_B=1)$. Boltzmann's
      constant is actually a unit conversion factor used to convert
      units of temperature into units of energy (per degree of
      freedom). Therefore, when you choose the value of the Boltzmann
      constant you are actually choosing the units of temperature of
      the system.
    </p>
    <p>
      For example, if the input of dynamo is specified in units of
      meters/seconds/kilograms, then the units of the product,
      $k_B\,T$, is actually Joules (per degree of freedom). If we set
      $k_B=1$, then our units of temperature are then also Joules (per
      degree of freedom). When presented like this it should be
      apparent that Kelvin/Celcius/Farenheit are actually inconvenient
      scales for molecular calculations, and that we should simply use
      the natural unit of energy of the system by setting $k_B=1$.
    </p>
    <p>
      For most applications, you can just view every temperature in
      the configuration file as actually being the product $k_B\,T$;
      however, please remember that Boltzmann's constant also crops up
      in all properties which are connected to the temperature, such
      as the heat capacity and the thermal conductivity. If you decide
      to use "real" units in your simulations, you will need to
      correct for this assumption in your results.
    </p>
  </li>
</ul>
<h1>Q: What units does the dynamod command use/produce?</h1>
<p>
  Short answer: Whenever the <b>dynamod</b> command is used to
  generate a configuration, it tries to use the most natural set of
  dimensionless units for that type of system. The results should then
  directly correspond to the typical units used in publications.
</p>
<p>
  For example, in a
  mono-component <a href="/index.php/reference#typehardsphere">hard
  sphere system</a>, the natural unit of length is the particle
  diameter, $\sigma$. The natural unit of mass is the mass of a single
  particle, $m$. The natural unit of time is more difficult to choose
  but we can pick a unit of energy and, through the definition of unit
  length and mass, use it to set the unit of time. The only property
  which has units of energy in the hard sphere system is the
  temperature $k_B\,T$. Therefore, the natural unit of time is
  $\sqrt{m\,\sigma^2 /k_B\,T}$! If we use these units of length
  ($\sigma=1$), mass ($m=1$), and time ($\sqrt{m\,\sigma^2
  /k_B\,T}=1$) to reduce our system into dimensionless units, we find
  that the temperature, particle diameter, and particle mass always go
  to 1. In fact,
  this <a href="http://en.wikipedia.org/wiki/Dimensional_analysis">dimensional
  analysis</a> of the system reveals that the only remaining
  independent parameters of the system are the number of particles,
  $N$, and the volume of the system, $V$. Typically, the volume of the
  system is expressed through the reduced number density
  $\rho^*=\sigma^3\,N/V$. Therefore, the only parameters ever varied
  in a study of monocomponent hard-sphere systems are the dimensionlessdensity
  $\rho^*$ and the particle count.
</p>
<p>
  The <b>dynamod</b> mode for creating hard sphere systems therefore
  sets the mass and diameter of particles to be equal to 1, as this is
  the natural dimensionless units of the system.
</p>
<p>
  If we look at
  mono-component <a href="/index.php/reference#typesquarewell">square-well
  systems</a> we now have two properties with units of energy (and
  therefore time), the temperature $k_B\,T$ and the well-depth
  $\varepsilon$. It is common to select the well-depth as the unit of
  energy ($\varepsilon=1$), which results in an additional independent
  parameter $k_B\,T/\varepsilon$ on top of the parameters used for
  hard-spheres ($N$ and $\rho^*$). In this case, the unit of time is
  $\sqrt{m\,\sigma^2 /\varepsilon}$.
</p>
<p>
  The <b>dynamod</b> mode for creating square-well systems therefore
  sets the mass, diameter, and well depth of all particles to be equal
  to 1, as this is the natural dimensionless units of the system.
</p>
<h1 id="q-how-does-dynamo-collect-exact-timeaverages">Q: How does DynamO collect exact time-averages?</h1>
<p>
  Short answer: Many properties have a constant value between events,
  and so the following equation for the time average can be solved
  analytically:

  \[\left\langle A\right\rangle=t_{sim}^{-1}\int_0^{t_{sim}}A(t)\,{\rm d}t\]
  
  where $A(t)$ is the value of the property being averaged at a time
  $t$ and $t_{sim}$ is the duration of the simulation.  To illustrate,
  if $N_{events}$ occur during the duration of the simulation, and the
  property $A$ only changes on events, the integration can be
  rewritten as a sum:

  \[\left\langle A\right\rangle=t_{sim}^{-1}\sum_{i=1}^{N_{events}}A(t_{i-1})\left(t_i-t_{i-1}\right)\]
  
  where $t_i$ is the time of the $i$th event, $t_0=0$ by definition,
  and $A(t_i)$ is the value of the property just after the $i$th
  event.
</p>
<p>
  There are some restrictions to this. For example, in
  systems <b>without</b> gravity and <b>without</b> shearing boundary
  conditions, the velocities of all particles are constant between
  events. If we calculate the kinetic energy at the start of the
  simulation, the only changes will occur during the execution of an
  event. It is then very simple to collect exact time-averages using
  the equation above. However, in gravity and in shearing systems the
  particles velocities change with time causing the kinetic energy to
  vary between events. Some of these changes can also be integrated
  exactly, but at the moment DynamO does not do this.
</p>
<h1>Q: You say I can edit the configuration files using my favourite text editor? How?</h1>
<p>
  Short answer: Most modern text editors bundled with Linux such
  as <a href="http://kate-editor.org/">Kate</a>
  or <a href="http://projects.gnome.org/gedit/">GEdit</a> (my personal
  choice is
  <a href="http://www.gnu.org/software/emacs/">emacs</a>) support
  opening xml files and will even highlight them for you. Just open
  them using either the open file dialog or by calling the editor from
  the command line. For example, to open a compressed configuration
  file from the terminal to edit it using Kate, just write:
</p>
<?php codeblockstart(); ?>kate config.out.xml.bz2<?php codeblockend("brush: shell;"); ?>
<p>
  DynamO writes out a compressed xml files by default (indicated by
  the extension <i>.bz2</i>). Luckily, most text editors will happily
  uncompress and recompress the file for you if you just open it
  directly, as shown above.
</p>
<h1>Q: When I try to run dynavis I get a GLXBadFBConfig error, what is wrong?</h1>
<p>
  Short answer: Your graphics card and/or drivers do not support
  OpenGL 3.3 contexts, which are required for the visualisation
  library. To run the visualiser you will need a modern graphics card
  (your PC should be able to run modern games at decent speeds). You
  may need to either upgrade your drivers and/or your graphics card.
</p>
<p>
  This error usually appears right at the start, and looks like:
</p>
<?php codeblockstart(); ?>dynarun  Copyright (C) 2011  Marcus N Campbell Bannerman
This program comes with ABSOLUTELY NO WARRANTY.
This is free software, and you are welcome to redistribute it
under certain conditions. See the licence you obtained with
the code
Simulation: Reading the XML input file into memory
Simulation: Parsing the raw XML
Simulation: Loading tags from the XML
CellNeighbourList: Cells Loaded
NbListScheduler: Neighbour List Scheduler Algorithmn Loaded
Dynamics: Loading Particle Data
Dynamics: Particle count 1372
SystemInteraction: System halt set for 1.79769e+308
The program 'dynavis' received an X Window System error.
This probably reflects a bug in the program.
The error was 'GLXBadFBConfig'.
  (Details: serial 34 error_code 181 request_code 154 minor_code 34)
  (Note to programmers: normally, X errors are reported asynchronously;
   that is, you will receive the error a while after causing it.
   To debug your program, run it with the --sync command line
   option to change this behavior. You can then get a meaningful
   backtrace from your debugger if you break on the gdk_x_error() function.)
BoundedPQ: Exception Events = 0<?php codeblockend("brush: shell;"); ?>
<p>
  The GLXBadFBConfig error is raised as your system was unable to
  provide an OpenGL 3.3 context.
</p>
<p>
  If you are using built-in Intel graphics, you will probably not be
  able to use the visualiser yet until the open source drivers catch
  up with the closed-source drivers (and windows). They are catching
  up quickly but it will be 2014 or possibly later before OpenGL 3.3
  is fully supported and distributed. 
</p>
<p>
  If you have a discrete graphics card, we highly recommend that you
  use the binary drivers. Binary drivers are the closed-source drivers
  developed by the manufacturers of your graphics card. For AMD/ATI
  cards, the packages are called FGLRX, but for NVidia cards they are
  usually called nvidia or nvidia-current.
</p>
<h1 id="q-the-andersen-thermostat-is-giving-me-a-nonzero-system-momentum-average-is-this-an-error">Q: The Andersen thermostat is giving me a non-zero system momentum
average. Is this an error?</h1>
<p>
  Short answer: Probably not. The Andersen thermostat allows the
  system momentum to fluctuate about zero. This can lead to some
  suprisingly large values of the total momentum.
</p>
<p>
  Please
  see <a href="https://github.com/toastedcrumpets/DynamO/issues/29">issue
  #29 in the github tracker</a> for more information.
</p>
<h1><a id="stoppausepeek"></a>Q: How do I stop/pause/output-data during a simulation?</h1>
<p>
  Short answer: Press ctrl-c in the terminal you are running dynarun
  in, then press "s" and enter.
</p>
<p>
  If dynarun recieves a SIGINT (which can be created in a terminal by
  pressing ctrl-c), the first time it recieves one it will try to
  present a menu to the user to allow them to either shutdown the
  simulation, peek at the data collected so far, or to look at any
  live statistics of the simulation. An example of the menu is
  presented below.
</p>
<?php codeblockstart(); ?>
Tue 09:55, Events 100k, t 19.0976, <MFT> 0.131009, T 1, U 0
^C
Caught SIGINT, notifying running simulation...

<S>hutdown or <P>eek at data output:
<?php codeblockend("brush: shell;"); ?>
<p>
  While this menu is displayed, dynarun is paused and waiting for
  input.  If dynarun recieves a second SIGINT (ctrl-c) while waiting
  for a response, it will immediately exit the program and no data is
  saved.
</p>
<p>
  If you press "s" or "S" then press return or enter, dynamo will set
  the simulation to shutdown after the next event. This causes dynarun
  to exit normally, writing out the configuration file and any
  collected data as though it had naturally reached the end of a
  simulation.
</p>
<p>
  If you press "p" or "P" followed by enter, dynamo will write out the
  collected data of the simulation to a file called
  peek.data.xml.bz2. This allows you to "peek" at the results
  collected so far without stopping the simulation.
</p>
<p>
  Any other key followed by enter or return will cause dynamo to
  continue the simulation without any changes.
</p>
<h1><a id="packingfraction"></a>Q: Why do many simulations use packing
fraction ($\eta$) instead of number density ($\rho$)?</h1>
<p>
  Short answer: Volume fraction has reasonably well-established bounds
  whereas number densities depend strongly on the polydispersity of
  the system.
</p>
<p>
  It is most convenient to work in packing fractions instead of
  densities as almost all systems have a maximum packing fraction
  somewhere near the mono-component hard sphere limit of
  $\eta^{max}_{HS}=\pi\,\sqrt{2}/6\approx0.74$, thus a system with a
  packing fraction near 0.6-0.7 is usually a high-density system
  regardless of the interactions. Number densities on the other hand
  have a varying range of values depending on the unit length scale
  and particle sizes. 
</p>
<p>
  For example, in the system studied
  in <a href="/index.php/tutorial4">tutorial 4</a>, once compression
  is complete, the packing fraction of $\eta=0.3$ has a reduced number
  density of $\rho\approx22$ whereas the mono-component hard sphere
  system has a maximum number density of
  $\rho_{HS}^{max}=\sqrt{2}\approx1.41$. Thus we cannot immediately
  estimate what a "high" number density is for a polydisperse system.
</p>
<h1><a id="stoppausepeek"></a>Q: How do I take "snapshots" or regular samples of a running simulation?</h1>
<p>
  Short answer: Use the <i>--snapshot</i> or <i>--snapshot-events</i>
  options to dynarun.
</p>
<p>
  The <i>--snapshot</i> option allows you to set a time interval after
  which dynarun will take a "snapshot" and save the configuration and
  output data of the system into a file
  named <i>Snapshot.0.xml.bz2</i>, <i>Snapshot.1.xml.bz2</i>, ... At
  the same time, the current data from the output plugins is saved
  to <i>Snapshot.output.0.xml.bz2</i> etc.
</p>
<p>
  If you use the <i>--snapshot-events</i> option, this allows you to
  take a snapshot every ficed number of events. These files are saved
  to
  <i>Snapshot.output.Xe.xml.bz2</i>
  and <i>Snapshot.output.Xe.xml.bz2</i> where X is replaced with the
  snapshot number. This name difference is to allow you to collect
  both event and time snapshots together.
</p>
