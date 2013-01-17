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
    How to specify multiple species and complex interactions in the
    configuration file.
  </li>
  <li>
    How to compress a simulation to higher densities.
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
<h1>About Square-Well Fluids</h1>
<p>
  For the purpose of the tutorial, we'll want to simulate a mixture of
  square-well molecules. A square-well molecule is a particle which
  has a hard-core diameter of $\sigma$ and is surrounded by an
  attractive well with a diameter of $\lambda\,\sigma$ and a depth of
  $\varepsilon$. These variables are illustrated in the diagram below:
</p>
<img src="/images/sw.png" alt="A diagram of a square-well molecule including its parameters" width="650" height="232" style="display:block;margin:0 auto 0 auto;">
<p>
  where $u(r)$ is the interparticle potential (which is the potential
  energy between two particles separated by a distance of $r$).
</p>
<p>
  Square-well molecules are simple models which display the two
  fundamental features of real molecules, a short range repulsion (due
  to overlapping electron clouds) and longer ranged attraction (due to
  van-der-waals/London/dispersion forces). A comparison of the
  square-well model (<span style="font-weight:bold; color:#000;">black</span>) and a "realistic" interatomic potential
  (<span style="font-weight:bold; color:#800;">red</span>) is given in the figure below:
</p>
<img src="/images/swcomparison.png" alt="A diagram of a square-well molecule including its parameters" width="429" height="215" style="display:block;margin:0 auto 0 auto;">
<p>
  It is clear that the square-well potential is a rough approximation
  of the "realistic" potential, but its dynamics are not immediately
  clear. With the "realistic" potential, it is easy to see how a pair
  of particles might "fall down" the potential and attract or repulse
  each other, but how does this behaviour appear in the square-well
  model?  When two distant square-well particles approach each other
  and reach a separation of $r=\lambda\,\sigma$, they enter the well
  (or "capture" each other) and a momentum impulse increases their
  kinetic energy by $\varepsilon$ (they are attracted to each
  other). If they then approach the inner core and reach a separation
  of $r=\sigma$, they will be unable to pay the infinite energy cost
  to enter the core and will instead elastically bounce off it. Once
  they begin to retreat from each other (either by bouncing off the
  core or by missing it) and reach a separation of
  $r=\lambda\,\sigma$, they must have enough kinetic energy in the
  direction of the well to escape it and pay the energy cost,
  $\varepsilon$, otherwise they will bounce off the inside of the well
  (both are attractive interactions).
</p>
<p>
  If we used more steps to more accurately approximate the "realistic"
  potential, we can quite quickly capture the full behaviour of the
  smooth/"realistic" potential. However, the square-well model is so
  interesting because it is so simple! If we can understand the
  fundamental behaviour of square-well molecules, the fundamental
  behaviour of realistic potentials will also be explained without the
  additional complexity.
</p>

<h2>The System Studied</h2>
<p>
  We're going to study a binary mixture of square-well
  molecules. We'll have a larger species, A, and a smaller species,
  B. The mixture we will study has a hard-core diameter ratio of
  $\sigma_A/\sigma_B=10$ and a mass ratio proportional to their
  volumes $m_A/m_B=\sigma_A^3/\sigma_B^3=1000$. Both molecules have
  the same well-width factor $\lambda_A=\lambda_B=1.5$. For
  interactions between species we'll use the additive rule. For
  example, between species A and B the interaction diameter is
  $\sigma_{AB}=\left(\sigma_A+\sigma_B\right)/2$. We'll want to study
  a mixture of $N=4000$ particles over a range of densities and
  concentrations.
</p>
<h1>Setting up the Configuration File</h1>
<p>
  When you first start using DynamO, it is not really practical to try
  to create a configuration file from scratch. It is much simpler and
  convenient to take an existing configuration, which is close to the
  system you wish to study, and to modify it. Once you are familiar
  with the file format you may then write your own tools to generate
  configuration files in the programming language of your choice.
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
  spheres. An example of the configuration
  file <a href="/pages/config.tut4.mono.xml">is available here</a> (it
  is a large XML file, so your browser may take some time to display
  it).
</p>
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
<?php xmlXPathFile("pages/config.tut4.mono.xml", "/DynamOconfig/Simulation/Genus"); ?>
<p>
  If we want to study a binary system, we'll need to define two
  species to be able to identify the two types of particles in the
  output. Using two species also provides a convenient way to specify
  the two masses of the two types of particles. Lets assume we want to
  convert the first 100 particles in the configuration file to species
  A and have the rest as species B, we can change the file to:
</p>
<?php xmlXPathFile("pages/config.tut4.binary.xml", "/DynamOconfig/Simulation/Genus"); ?>
<p>
  You'll notice that the <b>IDRange</b> of <b>Type</b> <i>"Ranged"</i>
  is an inclusive range of particle ID's. The particle ID's start with
  zero therefore the first <b>Species</b> tag corresponds to the first
  100 particles in the configuration file.  For more information on
  the "Ranged" <b>IDRange</b> tag, please see the reference:
</p>
<?php button("Reference entry for <i>\"Ranged\"</i> Type <b>IDRange</b>","/index.php/reference#typeranged");?>
<p>
  If we consult
  the <a href="/index.php/reference#species">documentation for the
  Species tag</a>, we see that each particle must belong to exactly
  one Species and each Species must have a
  representative <b>Interaction</b>, who's <i>name</i> is specified by
  the <b>IntName</b> attribute. This Interaction is used to describe
  particles in the Species for visualisation and for calculation of
  properties such as its excluded volume. Obviously, we need to define
  at least two interactions, called <i>"AAInteraction"</i> and
  <i>"BBInteraction"</i> which describe the two types of particles in
  the system. In the next section we'll take a look at setting all of
  the Interactions of the system up.
</p>
<h2>Setting up the Interactions</h2>
<p>
  In the original file, only one Interaction is defined:
</p>
<?php xmlXPathFile("pages/config.tut4.mono.xml", "/DynamOconfig/Simulation/Interactions", 4, 2); ?>
<p>
</p>
<?php xmlXPathFile("pages/config.tut4.binary.xml", "/DynamOconfig/Simulation/Interactions", 4,3); ?>
<p>
  
</p>
<h1>Compressing the Configuration</h1>
<h1>Running the Simulation</h1>
<h1>Processing the Results</h1>
