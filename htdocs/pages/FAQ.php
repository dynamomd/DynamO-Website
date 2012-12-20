<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Appendix B: Frequently asked questions";
   ?>
<?php printTOC(); ?>
<p>
  Here are a list of frequently asked questions and their answers.
</p>
<h3>Q: What are the units of DynamO?</h3>
<p>
  The short answer is: whatever units you use!
</p>
<p>
  The configuration files expose (almost) every parameter of the
  system, so you set the units of the DynamO input, and this is
  carried through to the output. You must be consistent in your choice
  of units, so if the particle sizes are specified in Angstroms, your
  simulation size/particle positions/etc must also be specified in
  Angstroms. Otherwise, your units may be any scale at all.
</p>
<p>
  There are two peculiarities which are discussed below:
</p>
<ul>
  <li>
    The example configurations produced by the dynamod command must have
    their own units,
    and <a href="#q-what-units-does-the-dynamod-command-useproduce">these
      are discussed in a following question</a>.
  </li>
  <li>
    In DynamO and in many other simulation packages (such as
      GROMACS), <a href="http://en.wikipedia.org/wiki/Boltzmann_constant">Boltzmann's
      constant</a> is assumed to be one $(k_B=1)$. Boltzmann's
      constant is simply a unit conversion factor from units of
      temperature to units of energy per particle, so it defines the
      units of temperature. For most applications, you can just view
      every temperature in the configuration file as actually being
      the product $k_B\,T$; however, please remember that Boltzmann's
      constant also crops up in all properties which are connected to
      the temperature, such as the heat capacity and the thermal
      conductivity. If you decide to use "real" units in your
      simulations, you will need to correct for this assumption in
      your results.
  </li>
</ul>
</p>
<h3>Q: What units does the dynamod command use/produce?</h3>
<p>
  The short answer is: Whenever the <b>dynamod</b> command is used to
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
