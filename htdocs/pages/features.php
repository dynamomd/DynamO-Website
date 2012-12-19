<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Features";
 ?>
<?php printTOC(); ?>
<h1>Video Gallery</h1>
<p>
  In this section, a range of sample videos of DynamO simulations are
  presented to highlight what is currently possible with the code and
  to give an idea of its speed. The videos below are all running in
  real time or have been slowed down to allow a clearer animation. The
  majority of the videos have been produced using the Coil
  visualisation software, which is included as a part of DynamO.
</p>
<div style="clear:both;text-align:center;">
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("snowmen", "zAC4PgtUwU4", 533, 300); ?>
  <div class="caption">
    This is a simulation of a snowmen molecules. Snowmen molecules can
    be used as a tool to study crystal formation in binary systems
    (such as NaCl salts) or as a simple model of a liquid
    crystal. They also provide a initial test system for the
    implementation of composite particles for granular systems.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
<?php embedAJAXvideo("vibratedBed", "2MBmJRDzYYk", 533, 300); ?>
  <div class="caption" >
    A small test simulation of a vibrated mixture of granulate. The
    wall at the bottom of the container has a "temperature" which is
    an approximation of a high frequency and low amplitude vibration.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("nanospheres", "zBi5eEP2V90", 533, 300); ?>
  <div class="caption" >
    A simulation of thermophoresis (also known as the Soret effect or
    thermodiffusion) occurring in a nanofluid in between a hot and
    cold wall. Highlighted here is reverse thermophoresis, where the
    larger species migrates towards the hot plate.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("pendulum", "FrDoc6t7jwI", 533, 300); ?>
  <div class="caption" >
    A simulation of a pendulum used to test the constraint force
    implementation in gravity. The constraint force is used to anchor
    the top of the chain to the fixed particle (white), and is a key
    element of the more general rigid-body simulators.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("granularDamper", "3mlisuFJkqk", 533, 315); ?>
  <div class="caption">
    A simulation (top) of an experimental granular damper (bottom)
    after an initial perturbation. Granular dampers are novel devices
    used to dampen vibration in structures without requiring a fixed
    anchor or significant maintainance. The simulator predicts the
    decay of the amplitude to within 1% of the experimental results.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("pairHPpolymer", "RXCOU9btDuQ", 400, 325); ?>
  <div class="caption">
    DynamO has many tools for simulating the folding of model proteins
    and this is just an example simulation of a pair of heteropolymers
    which agglomerate and begin to fold. The image in the lower right
    is the contact map used to track the folded structure of the pair.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("sleepingparticles", "9oaobaxhGX8", 533, 298); ?>
  <div class="caption">
    A simple test simulation of gravity and the boundary sphere meshes
    used to implement the hopper, chute and cup. The particles in the
    cup are sent to "sleep" (white) once they settle and may "wake up"
    on impact. The advantage of sending particles to sleep is that
    they incurr no computational cost.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("trianglemesh", "1Rn-bL8S30Y", 533, 280); ?>
  <div class="caption">
    A test simulation of the triangle mesh boundaries, these can be
    used to capture arbitrarily complex (and sharp) boundaries.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
<?php embedAJAXvideo("shearpoly2d", "0kYY6NjE_sE", 533, 298); ?>
  <div class="caption">
    A simple simulation of sheared polydisperse hard disks used to
    demonstrate the use of DynamO in 2D systems.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("thinHardLines", "hUVZxEhjoc0", 533, 298); ?>
  <div class="caption">
    The complex dynamical system of infinitely-thin rods. These
    "molecules" caused a stir when they were first proposed, as they
    are an ideal gas which exhibits non-ideal transport
    properties. They are therefore an excellent model to test some of
    the dynamical approximations of kinetic theory.
  </div>
</div>
<div class="figure" style="width:533px; vertical-align:middle;">
  <?php embedAJAXvideo("parallelCubes", "B_qASDj9J8I", 533, 300); ?>
  <div class="caption">
    Parallel hard cubes are another simple model-molecular system with
    interesting thermodynamic behaviour. The freezing transition in
    fluids is still poorly understood and this system is an "ideal"
    model to explore it in, as it readily and obviously freezes but
    appears to undergo a second order transition.
  </div>
</div>
</div>
<h1 style="clear:both;">Full List of Features</h1>
<h2>Key Features</h2>
<p>DynamO has the following features:</p>
<ul>
  <li>
    <b>Smooth</b> or <b>rough hard spheres</b>, <b>square
      wells</b>, <b>soft cores</b>, <b>stepped potentials</b> and all
      the other simple EDMD potentials are fully supported. Some
      complex interactions, such as <b>hard lines</b> and part of the
      PRIME model for protiens, are also supported.
  </li>
  <li>
    <b>Millions of particles </b>for <b>billions of events</b>. Using
      500 bytes per particle and running at around 75k events per
      second, DynamO is one of the most efficient and fastest
      event-driven simulators available.
  </li>
  <li><b>Transport Properties</b>: DynamO automatically collects
    information on all of the transport coefficients for the simulated
    fluid, including the thermal conductivity, viscosity, self and
    mutual diffusion, and thermal diffusion coefficients. These are
    collected using the Einstein form of the Green-Kubo expressions.
  </li>
  <li>
    <b>Non-Equilibrium Molecular Dynamics</b> (NEMD): DynamO has
    thermostats, thermalised walls, and Lees-Edwards boundary
    conditions for shearing systems, allowing the study of a wide
    range of Non-Equilibrium data.
  </li>
  <li>
    <b>Compression dynamics</b>: Need to study high density systems?
    DynamO can compress most of its model systems using isotropic
    compaction, allowing you to start from a low density where it is
    easier to place the particles.
  </li>
  <li>
    <b>Poly-dispersity</b>: All interactions are
    generalised to fully poly-disperse particles.
  </li>
  <li>
    <b>Stable handling of overlapped states</b>: Thanks to a careful
    implementation of the event-detection routines in DynamO, it can
    safely recover from invalid states caused by overlapped cores in
    most cases. This makes DynamO the most stable event-driven
    particle dynamics code, and this feature is essential
    in <b>granular systems</b>.
</ul>

<h2>Granular Systems/Complex Boundaries</h2>
<p>DynamO contains all the latest EDMD algorithms for dissipative
  systems:</p>
<ul>
  <li>
    <b>Event driven dynamics with gravity</b>: All interactions work
    in the presence of gravity, allowing event driven simulations of
    macroscopic systems.
  </li>
  <li>
    <b>Sleeping particles</b>: In systems where particles
    come to a rest, the sleeping particles algorithm can remove the cost
    of simulating the particles completely.
  </li>
  <li>
    <b>Triangle or sphere meshes</b>: Arbitrary complex
    boundaries can be implemented using triangle meshes imported from
    CAD drawings.
  </li>
  <li>
    <b>Stepped potentials</b>: Arbitrary stepped potentials
    may be simulated to approximate any soft potential.
  </li>
</ul>

<h2>Polymeric Systems/Accelerated Dynamics</h2>
<p>Dynamo has extremely advanced algorithms for accelerated dynamics:</p>
<ul>
  <li>
    <b>Parallel tempering/Replica exchange</b>: Run multiple
    simulations in parallel and use this Monte Carlo technique to
    enhance the sampling of phase space when it is energetically
    difficult. This is essential in protein/polymer-folding
    simulations.
  </li>
  <li>
    <b>Histogram reweighting</b>: Combine the results from replica
    exchange simulations and extrapolate to temperatures which were
    not simulated, maximising the information extracted.
  </li>
  <li>
    <b>Multicanonical simulations</b>: Used either in conjunction with
    or as a replacement for replica exchange techniques,
    multicanonical simulations greatly enhance the sampling of phase
    space, helping find the true native states of the polymer.
  </li>
</ul>
