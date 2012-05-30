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
<?php /*for file in $(ls *.mp4); do name=${file%.mp4}; ffmpeg -i $name.mp4  -ss 10 -vframes 1 -vcodec mjpeg -f image2 $name.jpg; done*/ ?>
<h2>Granular Damper Simulation</h2>
<div class="video-container">
  <video controls poster="/videos/granularDamper.jpg" preload="none">
    <source src="/videos/granularDamper.mp4" type='video/mp4' />
    <source src="/videos/granularDamper.ogg" type='video/ogg' />
    <iframe width="533" height="315" src="https://www.youtube-nocookie.com/embed/3mlisuFJkqk"></iframe>
  </video>
</div>

<h2>Gravity, Boundary Sphere Meshes and Sleeping Particles</h2>
<div class="video-container">
  <video controls poster="/videos/sleepingparticles.jpg" preload="none">
    <source src="/videos/sleepingparticles.mp4" type='video/mp4' />
    <source src="/videos/sleepingparticles.ogg" type='video/ogg' />
    <iframe width="533" height="293" src="https://www.youtube-nocookie.com/embed/9oaobaxhGX8"></iframe>
  </video>
</div>

<h2>Triangle Meshes and Gravity</h2>
<div class="video-container">
  <video controls poster="/videos/trianglemesh.jpg" preload="none">
    <source src="/videos/trianglemesh.mp4" type='video/mp4' />
    <source src="/videos/trianglemesh.ogg" type='video/ogg' />
    <iframe width="533" height="286" src="https://www.youtube-nocookie.com/embed/1Rn-bL8S30Y"></iframe>
  </video>
</div>
<?php pageend(); ?>
