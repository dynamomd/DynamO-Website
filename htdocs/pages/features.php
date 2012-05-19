<?php
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }

   $pagetitle="Features";
   ob_start();
   ?>
<!-- Page Begin -->
<h1>Simple Systems</h1>
<p>DynamO can simulate:</p>
<ul>
  <li>
    <strong>Smooth</strong> or <strong>rough hard
      spheres</strong>, <strong>square wells</strong>, <strong>soft
      cores</strong> and all the other simple EDMD potentials.
  </li>
  <li>
    <strong>Millions of particles </strong>for <strong>billions of
      events</strong>: Using 500 bytes per particle and running at
    around 75k events a second, even an old laptop can run huge
    simulations.
  </li>
  <li>
    <strong>Non-Equilibrium Molecular Dynamics</strong> (NEMD):
    DynamO has Lees-Edwards boundary conditions for shearing systems,
    thermalised walls and Andersen or rescaling thermostats.
  </li>
  <li>
    <strong>Compression dynamics</strong>: Need high density
    systems? DynamO can compress any of its systems using isotropic
    compaction until the pressure diverges! 
  </li>
  <li>
    <strong>Poly-dispersity</strong>: All interactions are
    generalised to fully poly-disperse particles.
  </li>
</ul>

<h1>Granular Systems/Complex Boundaries</h1>
<p>DynamO contains all the latest EDMD algorithms for dissipative
  systems:</p>
<ul>
  <li>
    <strong>Event driven dynamics with gravity</strong>: Almost all
    interactions work in the presence of gravity, allowing event driven
    simulations of macroscopic systems.
  </li>
  <li>
    <strong>Sleeping particles</strong>: In systems where particles
    come to a rest, the sleeping particles algorithm can remove the cost
    of simulating the particles completely.
  </li>
  <li>
    <strong>Triangle or sphere meshes</strong>: Arbitrary complex
    boundaries can be implemented using triangle meshes imported from
    CAD drawings.
  </li>
  <li>
    <strong>Stepped potentials</strong>: Arbitrary stepped potentials
    may be simulated to approximate any soft potential.
  </li>
</ul>

<h1>Polymeric Systems/Accelerated Dynamics</h1>
<p>Dynamo has extremely advanced algorithms for accelerated dynamics:</p>
<ul>
  <li>
    <strong>Parallel tempering/Replica exchange</strong>: Run multiple
    simulations in parallel and use this Monte Carlo technique to
    enhance the sampling of phase space.
  </li>
  <li>
    <strong>Histogram reweighting</strong>: Combine the results from
    replica exchange simulations and extrapolate to temperatures which
    were not simulated.
  </li>
  <li>
    <strong>Multicanonical simulations</strong>: Used in conjunction
    with replica exchange techniques, multicanonical simulations greatly
    enhance the sampling of phase space, helping find the true native
    state of the polymer.
  </li>
</ul>

<h1>Example Videos</h1>

<h2>Sheared and Compressed Polydisperse Hard Spheres</h2>

<h2>Gravity, boundary sphere meshes and sleeping particles</h2>
<div class="video-container" style="padding-bottom: 54.90%; " >
  <video controls >
    <source src="/videos/sleepingparticles.mp4" type='video/mp4' />
    <source src="/videos/sleepingparticles.ogg" type='video/ogg' />
    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/9oaobaxhGX8" frameborder="0" allowfullscreen></iframe>
  </video>
</div>

<!-- Page End -->
<?php $content = ob_get_clean(); ?>
