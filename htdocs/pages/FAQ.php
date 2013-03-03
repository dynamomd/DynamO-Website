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
<h1>Q: What are the units of DynamO?</h1>
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
      the natural unit of energy of the system.
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
  For example, in the hard sphere system, the natural unit of length
  is the particle diameter, $\sigma$. The natural unit of mass is the
  mass of a single particle, $m$. The natural unit of time is more
  difficult to choose but we can pick a unit of energy and, through
  the definition of unit length and mass, use it to set the unit of
  time. The only property which has units of energy in the hard sphere
  system is the temperature $k_B\,T$. Therefore, the natural unit of
  time is $\sqrt{m\,\sigma^2 /k_B\,T}$! If we use these units of
  length, mass, and time to reduce our system into dimensionless
  units, we find that the temperature, particle diameter, and particle
  mass always go to 1. In fact,
  this <a href="http://en.wikipedia.org/wiki/Dimensional_analysis">dimensional
  analysis</a> of the system reveals that the only remaining
  parameters are the number of particles, $N$, and the volume of the
  system, $V$. Typically, the volume of the system is expressed
  through the reduced number density
  $\rho^*=\sigma^3\,N/V$. Therefore, the only parameters ever varied
  in a study of monocomponent hard-sphere systems are the density and
  the particle count.
</p>
<p>
  The <b>dynamod</b> mode for creating hard sphere systems therefore
  sets the mass and diameter of particles to be equal to 1, as this is
  the natural dimensionless units of the system.
</p>
<h1>Q: How does DynamO collect exact time-averages?</h1>
<p>
  Short answer: Many properties have a constant value between events,
  and so the following equation for the time average can be solved
  analytically:

  \[\left\langle A\right\rangle=t_{sim}^{-1}\int_0^{t_{sim}}A(t)\,{\rm d}t\]
  
  where $A(t)$ is the value of the property being averaged at a time
  $t$ and $t_{sim}$ is the duration of the simulation. 
</p>
<p>
  If $N_{events}$ occur during the duration of the simulation, and the
  property $A$ only changes during events, the integration can be
  rewritten as a sum:

  \[\left\langle A\right\rangle=t_{sim}^{-1}\sum_{i=1}^{N_{events}}A(t_{i-1})\left(t_i-t_{i-1}\right)\]
  
  where $t_i$ is the time of the $i$th event, $t_0=0$ by definition,
  and $A(t_i)$ is the value of the property just after the $i$th
  event.  It is easy to collect an exact time average using this
  expression.
</p>
<p>
  For example, in systems <b>without</b> gravity and <b>without</b>
  shearing boundary conditions, the velocities of all particles are
  constant between events. If we calculate the kinetic energy at the
  start of the simulation, the only changes will occur during the
  execution of an event. It is then very simple to collect exact
  time-averages using the equation above. However, in gravity and in
  shearing systems the particles velocities change with time causing
  the kinetic energy to vary between events. Some of these changes can
  also be integrated exactly, but at the moment DynamO does not do
  this.
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
  Short answer: Your graphics card or drivers don't support OpenGL
  3.3, you need to upgrade your drivers.
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
  This is usually due to your computer running the open-source drivers
  which are currently a little behind in implementing recent versions
  of OpenGL. They are catching up quickly but it will be 2014 or
  possibly later before OpenGL 3.3 is fully supported. In the meantime
  we highly recommend that you use the binary drivers.
</p>
<h1>Q: The Andersen thermostat is giving me a non-zero system momentum
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
