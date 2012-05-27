<?php pagestart("Features"); ?>
<h1>Simple Systems</h1>
<p>DynamO can simulate:</p>
<ul>
  <li>
    <b>Smooth</b> or <b>rough hard
      spheres</b>, <b>square wells</b>, <b>soft
      cores</b> and all the other simple EDMD potentials.
  </li>
  <li>
    <b>Millions of particles </b>for <b>billions of
      events</b>: Using 500 bytes per particle and running at
    around 75k events a second, even an old laptop can run huge
    simulations.
  </li>
  <li>
    <b>Non-Equilibrium Molecular Dynamics</b> (NEMD):
    DynamO has Lees-Edwards boundary conditions for shearing systems,
    thermalised walls and Andersen or rescaling thermostats.
  </li>
  <li>
    <b>Compression dynamics</b>: Need high density
    systems? DynamO can compress any of its systems using isotropic
    compaction until the pressure diverges! 
  </li>
  <li>
    <b>Poly-dispersity</b>: All interactions are
    generalised to fully poly-disperse particles.
  </li>
</ul>

<h1>Granular Systems/Complex Boundaries</h1>
<p>DynamO contains all the latest EDMD algorithms for dissipative
  systems:</p>
<ul>
  <li>
    <b>Event driven dynamics with gravity</b>: Almost all
    interactions work in the presence of gravity, allowing event driven
    simulations of macroscopic systems.
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

<h1>Polymeric Systems/Accelerated Dynamics</h1>
<p>Dynamo has extremely advanced algorithms for accelerated dynamics:</p>
<ul>
  <li>
    <b>Parallel tempering/Replica exchange</b>: Run multiple
    simulations in parallel and use this Monte Carlo technique to
    enhance the sampling of phase space.
  </li>
  <li>
    <b>Histogram reweighting</b>: Combine the results from
    replica exchange simulations and extrapolate to temperatures which
    were not simulated.
  </li>
  <li>
    <b>Multicanonical simulations</b>: Used in conjunction
    with replica exchange techniques, multicanonical simulations greatly
    enhance the sampling of phase space, helping find the true native
    state of the polymer.
  </li>
</ul>

<h1>Videos of Example Systems</h1>

<h2>Gravity, boundary sphere meshes and sleeping particles</h2>
<div class="video-container" style="padding-bottom: 54.90%; " >
  <video style="min-width:533px;" controls >
    <source src="/videos/sleepingparticles.mp4" type='video/mp4' />
    <source src="/videos/sleepingparticles.ogg" type='video/ogg' />
    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/9oaobaxhGX8" allowfullscreen frameborder="0"></iframe>
  </video>
</div>
<?php pageend(); ?>
