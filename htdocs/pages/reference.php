<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Configuration File Format Reference";
   $pagecss="#taglist ul {padding-left: 15px;} #taglist li {list-style:disc; list-style-position:inside; font-weight:bold; padding-left:5px; margin-top:5px;}";
?>
<script> 
function toggle_visibility(elementname) {
	var ele = document.getElementById(elementname);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
} 
</script>
<?php printTOC(); ?>
<p>
  In this reference a complete description of the file format is
  presented. The introductory documentation in this reference is terse
  as <a href="/index.php/tutorial3">a general introduction to the file
  format is covered in tutorial 3</a>. 
</p>
<p>
  In the following sections, all of the available tags of the
  configuration file are listed and all of the options are detailed
  for each tag type. Below is a hyperlinked hierarchy of the tags in
  the configuration file.
</p>
<h1>General Structure</h1>
<div id="taglist">
  <ul style="padding-left: 15px;list-style:circle; list-style-position:inside; font-weight:bold; padding-left:5px; margin-top:5px;">
    <li>
      DynamOconfig
      <ul>
	<li>
	  Simulation<sup>1</sup>
	  <ul>
	    <li>
	      <a href="#scheduler">Scheduler</a>
	      <ul>
		<li>
		  <a href="#sorter">Sorter</a>
		</li>
	      </ul>
	    </li>
	    <li>
	      <a href="#simulationsize">SimulationSize</a>
	    </li>
	    <li>
	      Genus<sup>1</sup>
	      <ul>
		<li>
		  <a href="#species">Species</a>
		  <ul>
		    <li>
		      <a href="#idrange">IDRange</a>
		    </li>
		  </ul>
		</li>
	      </ul>
	    </li>
	    <li>
	      <a href="#bc">BC</a>
	    </li>
	    <li>
	      <a href="#topology">Topology</a>
	    </li>
	    <li>
	      Interactions<sup>1</sup>
	      <ul>
		<li>
		  <a href="#interaction">Interaction</a>
		  <ul>
		    <li>
		      <a href="#idpairrange">IDPairRange</a>
		    </li>
		    <li>
		      <a href="#potential">Potential</a>
		    </li>
		    <li>
		      <a href="#capturemap">CaptureMap</a>
		    </li>
		  </ul>
		</li>
	      </ul>
	    </li>
	    <li>
	      Locals<sup>1</sup>
	      <ul>
		<li>
		  <a href="#local">Local</a>
		  <ul>
		    <li>
		      <a href="#idrange">IDRange</a>
		    </li>
		  </ul>
		</li>
	      </ul>
	    </li>
	    <li>
	      Globals<sup>1</sup>
	      <ul>
		<li>
		  <a href="#global">Global</a>
		  <ul>
		    <li>
		      <a href="#idrange">IDRange</a>
		    </li>
		  </ul>
		</li>
	      </ul>
	    </li>
	    <li>
	      SystemEvents<sup>1</sup>
	      <ul>
		<li>
		  <a href="#system">System</a>
		  <ul>
		    <li>
		      <a href="#idrange">IDRange</a>
		    </li>
		    <li>
		      <a href="#potential">Potential</a>
		    </li>
		  </ul>
		</li>
	      </ul>
	    </li>
	    <li>
	      <a href="#dynamics">Dynamics</a>
	    </li>
	  </ul>
	</li>
	<li>
	  Properties<sup>1</sup>
	  <ul>
	    <li>
	      <a href="#property">Property</a>
	    </li>
	  </ul>
	</li>
	<li>
	  ParticleData<sup>1</sup>
	  <ul>
	    <li>
	      <a href="#pt">Pt</a>
	    </li>
	  </ul>
	</li>
      </ul>
    </li>
  </ul>
</div>
<p>
  <sup>1</sup>These tags are only container tags, and do not have any
  attributes.
</p>
<h1><a id="scheduler"></a>Scheduler</h1>
<p>
  The Scheduler specifies how DynamO searches the simulation for
  events. How the events are sorted is specified by the <a href="#sorter">Sorter</a> tag.
</p>
<h2>Type="Dumb"</h2>
<p>
  <b>Description:</b> The "Dumb" scheduler is the most basic and
  slowest scheduler available. When particles undergo an event, the
  Dumb scheduler tests for new events against all other particles in
  the system (regardless of where they are). This cost scales linearly
  with the system size ($\mathcal{O}(N)$), resulting in an overall
  $\mathcal{O}(N^2)$ scaling of the computational cost. This Scheduler
  type is only provided for debugging and testing purposes.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Scheduler Type="Dumb">
  <Sorter .../>
</Scheduler><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Dumb"</i> to select this Scheduler type.
  </li>
  <li>
    <b><a href="#sorter">Sorter</a></b> <i>(tag)</i>: This tag specifies the type of event
    sorter used in the Scheduler. See the <a href="#sorter">section
      on Sorters</a> for more information on this tag.
  </li>
</ul>
<h2>Type="NeighbourList"</h2>
<p>
  <b>Description:</b> The "NeighbourList" scheduler uses a
  NeighbourList to optimise the detection of events. When particles
  undergo an event, the NeighbourList scheduler only tests for new
  events against nearby particles. This cost is independent of the
  system size ($\mathcal{O}(1)$), resulting in an overall linear
  ($\mathcal{O}(N)$) scaling of the computational cost.
</p>
<p>
  <b>Note:</b> The neighbour list used by the scheduler is not
  actually provided by the Scheduler. There must be a <a href="#global">Global</a>
  interaction available in the system which implements a
  NeighbourList. This neighbour list must have the name attribute set
  to "SchedulerNBList" to allow the NeighbourList Scheduler to
  identify it.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Scheduler Type="NeighbourList">
  <Sorter .../>
</Scheduler><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"NeighbourList"</i> to select this Scheduler type.
  </li>
  <li>
    <b><a href="#sorter">Sorter</a></b> <i>(tag)</i>: This tag specifies the type of event
    sorter used in the Scheduler. See the <a href="#sorter">section
      on Sorters</a> for more information on this tag.
  </li>
</ul>
<h1><a id="sorter"></a>Sorter</h1>
<p>
  The Sorter tag specifies the method DynamO uses to sort events when
  determining the next event to occur.
</p>
<h2>Type="CBT"</h2>
<p>
  <b>Description:</b> The "CBT" Sorter uses a STL priority queue for
  each particle and inserts this into a Complete Binary Tree (CBT) to
  sort the events. This type of Sorter is very robust to unusual
  systems (such as systems with zero or one particle) but, as the
  computational cost scales as $\mathcal{O}(\log_2(N)$ with the system
  size, it is not the default Sorter used by DynamO.
<p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Sorter Type="CBT"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"CBT"</i> to select this Sorter type.
  </li>
</ul>
<h2>Type="BoundedPQMinMax3"</h2>
<p>
  <b>Description:</b> The "BoundedPQMinMax3" Sorter uses a bounded
  MinMax heap of size 3 to sort particle events. These particle queues
  are then presorted using a bounded priority queue. The earliest
  entry in the bounded priority queue is then sorted using a Complete
  Binary Tree. In this way, the lazy deletion scheme can be combined
  with a fixed size event queue and a bounded priority queue to yield
  a constant ($\mathcal{O}(1)$) scaling of the computational cost with
  the system size. There are variants of this scheduler with different
  sizes of the MinMax heaps ranging from 2 to 8 (e.g.,
  "BoundedPQMinMax8" is also available). After many years of testing
  this has proven to be the fastest and lowest memory event sorter for
  a range of event-driven particle simulations. In small systems the
  CBT Sorter is slightly faster and, depending on the system studied,
  you may find the MinMax heap size might be increased or decreased to
  increase performance.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Sorter Type="BoundedPQMinMax3"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"BoundedPQMinMax3"</i> to select this Sorter
    type. Other variants from "BoundedPQMinMax2" to
    "BoundedPQMinMax8" are also available.
  </li>
</ul>
<h1><a id="simulationsize"></a>SimulationSize</h1>
<p>
  <b>Description:</b> The SimulationSize tag specifies the dimensions
  of the primary image for periodic boundary conditions. When the
  system is not periodic, it specifies the size of the tiled
  neighbourlist (if one is used). If no neighbour list is used in an
  infinite system, this tag has no effect.
</p>
<p>
  <b>Example Usage:</b> This example specifies a $10\times10\times10$
  primary image.
</p>
<?php codeblockstart();?>
<SimulationSize x="10" y="10" z="10"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>x</b> <i>(attribute)</i>: The size in the $x$ dimension.
  </li>
  <li>
    <b>y</b> <i>(attribute)</i>: The size in the $y$ dimension.
  </li>
  <li>
    <b>z</b> <i>(attribute)</i>: The size in the $z$ dimension.
  </li>
</ul>
<h1><a id="species"></a>Species</h1>
<p>
  Species are vital tags used to specify the mass and inertia data of
  a set of particles. They also provide a unique identifier/name for
  groups of particles as each particle must belong to exactly one
  species. Many output plugins use the species of a particle to
  separate results (for example, a radial distribution function will
  be generated for all pairings of species in the system).
</p>
<p>
  Particles will have rotational degrees of freedom if they have a
  Species which provides a non-zero inertia tensor
  (e.g. <a href="#typesphericaltop">"SphericalTop"</a>). Other Species
  types such as <a href="#typepoint">"Point"</a>
  and <a href="#typefixedcollider">"FixedCollider"</a> will avoid the
  computational overhead of tracking the rotation of the particles.
</p>
<h2>Type="Point"</h2>
<p>
  <b>Description:</b> This Species type corresponds to point mass
  (zero inertia) particles, but this type is also used in systems
  where inertial data is unimportant (atomic or frictionless
  systems). It is the simplest type of Species available.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Species Mass="1" Name="Bulk" Type="Point">
  <IDRange .../>
</Species><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Point"</i> to select this Species type.
  </li>
  <li>
    <b>Mass</b> <i>(attribute)</i>: The mass of the particles
    represented by this Species. 

    <br/> This attribute is a <b>Property specifier</b> with units
    of <b>Mass</b> (see the <a href="#property">section on Properties</a>
    for more information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the particles
    represented by this Species. This is used in output, so species
    "A" or "Carbon" are examples. If the system is monocomponent,
    dynamod often uses the name "Bulk".
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: A <a href="#idrange">IDRange</a> which specifies the
    Particles represented by this Species tag. The IDRanges of each
    Species must not overlap with any other Species in the
    system. All particles must belong to exactly one Species.
  </li>
</ul>
<h2>Type="FixedCollider"</h2>
<p>
  <b>Description:</b> This Species type corresponds to particles which
  have infinite mass and no inertia tensor. This is useful for
  particles which are used as the boundaries of a system (also called
  a particle mesh).
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Species Name="Bulk" Type="FixedCollider">
  <IDRange .../>
</Species><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"FixedCollider"</i> to select this Species type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the particles
    represented by this Species. This is used in output, so species
    "A" or "Carbon" are examples. If the system is monocomponent,
    dynamod often uses the name "Bulk".
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: A <a href="#idrange">IDRange</a> which specifies the
    Particles represented by this Species tag. The IDRanges of each
    Species must not overlap with any other Species in the
    system. All particles must belong to exactly one Species.
  </li>
</ul>
<h2>Type="SphericalTop"</h2>
<p>
  <b>Description:</b> This Species type corresponds to particles where
  the three principal momenta of inertia are identical. It is also
  used in systems where only two of the principal momenta of inertia
  are equal but the rotation is constrained such that the particle
  cannot precess.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Species Mass="1" Name="Bulk" Type="SphericalTop" InertiaConstant="0.1">
  <IDRange .../>
</Species><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"SphericalTop"</i> to select this Species type.
  </li>
  <li>
    <b>Mass</b> <i>(attribute)</i>: The mass of the particles
    represented by this Species.  

    <br/> This attribute is a <b>Property specifier</b> with units
    of <b>Mass</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>InertiaConstant</b> <i>(attribute)</i>: The area factor of the
    principal momenta of inertia of the particles represented by this
    Species. This is value is multiplied by the mass of the particle
    to obtain the value of the principal momenta of inertia.For a
    solid sphere this value should be $\sigma^2/10$ where $\sigma$ is
    the particle
    diameter. <a href="http://en.wikipedia.org/wiki/List_of_moments_of_inertia">A
    list of inertia constants is available at wikipedia</a>.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the particles
    represented by this Species. This is used in output, so species
    "A" or "Carbon" are examples. If the system is monocomponent,
    dynamod often uses the name "Bulk".
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: A <a href="#idrange">IDRange</a> which specifies the
    Particles represented by this Species tag. The IDRanges of each
    Species must not overlap with any other Species in the
    system. All particles must belong to exactly one Species.
  </li>
</ul>
<h1><a id="bc"></a>BC (Boundary Conditions)</h1>
<p>
  The BC tag in the configuration file controls the boundary
  conditions of the simulation.
</p>
<h2>Type="None"</h2>
<p>
  <b>Description:</b> The "None" boundary condition actually
  corresponds to an infinite system, without boundaries. The positions
  of the particles are not restricted in any dimension.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><BC Type="None"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"None"</i> to select this BC type.
  </li>
</ul>
<h2>Type="PBC"</h2>
<p>
  <b>Description:</b> The "PBC" boundary condition applies periodic
  boundary conditions to every dimension. The positions of the
  particles are wrapped to fit within the primary image, whose
  dimensions are specified by
  the <a href="#simulationsize">SimulationSize</a> tag.
</p>
<p>
  When we want to study molecular fluids we often want the "bulk"
  properties of the fluid. Effects like surface tension will have a
  strong influence if there are any free surfaces or boundaries in
  contact with the fluid, as systems simulated are usually relatively
  small ($\approx10^5$ molecules). On the other hand, there must be
  some boundary used to contain the fluid, as using an open (infinite
  size) system will cause the fluid to either evaporate or form
  droplets, again with surface effects. To avoid the effects of
  boundaries/walls while still "containing" the
  system, <a href="http://en.wikipedia.org/wiki/Periodic_boundary_conditions">periodic
  boundary conditions</a> are often used.  With periodic boundaries, a
  small representative amount of fluid, called the "primary image," is
  simulated. This primary image is then surrounded with periodic
  images which are copies of the primary image as illustrated in the
  figure below:
</p>
<img src="/images/PBC.png" alt="The interparticle potential energy of a hard-sphere molecule" width="650" height="293" style="display:block;margin:0 auto 0 auto;">
<p>
  These boundaries allow the approximation of an infinite fluid using
  a small repeating image. This is an approximation as the periodicity
  adds additional correlations to the system, but it is a convenient
  technique to avoid using real boundaries such as walls to contain
  the system. When using periodic boundary conditions it is still
  possible to enter into two-phases if the simulation has attractive
  interactions, so care must still be taken.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><BC Type="PBC"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"PBC"</i> to select this BC type.
  </li>
</ul>
<h2>Type="LE"</h2>
<p>
  <b>Description:</b> The "LE" boundary condition applies
  Lees-Edwards boundary conditions to the system. These are periodic
  boundary conditions but they shear the system by setting the
  periodic images in the $y$ direction in motion in the $x$ direction
  (see figure below). They are also known as sliding-brick boundary
  conditions.
</p>
<img src="/images/LEBC.png" alt="An illustration of the Lees-Edward sliding-brick boundary condition" width="714" height="251" style="display:block;margin:0 auto 0 auto;">
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><BC Type="LE" DXD="0" Rate="1"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"LE"</i> to select this BC type.
  </li>
  <li>
    <b>DXD</b> <i>(attribute)</i>: This attribute stores the current
    displacement of the nearest periodic images in the $x$-direction
    (units of length).
  </li>
  <li>
    <b>Rate</b> <i>(attribute)</i>: This specifies how fast the
    boundary is shearing (units of primary image length per unit
    time).
  </li>
</ul>
<h1><a id="topology"></a>Topology</h1>
<p>
  Topology tags are used to specify structures in the configuration
  file, such as molecules, so they may be marked out for data
  collection. This tag is only for specialised use cases and is not
  yet documented.
</p>
<h1><a id="interaction"></a>Interaction</h1>
<p>
  Interaction tags are used to specify how pairs of particles interact
  and generate Interaction events.
</p>
<p>
  <b>Each pair of Particle ID's must have a corresponding
  Interaction.</b>  <br/> Every possible pairing of particles
  (including self pairings)
  <b>must</b> have a corresponding Interaction, even if they don't
  interact. If you don't want them to interact at all, you must use a
  <a href="#typenull">Null Interaction</a>.
</p>
<p>
  <b>The order in which Interactions are listed in the configuration
    file is important.</b><br/> When DynamO tests for
    interactions/events between a pair of particles, it moves through
    the list of interactions in the order in which they are specified,
    testing if the ID's of the pair match the
    Interaction's <a href="#idpairrange">IDPairRange</a>. Interactions
    which are higher in the configuration file will override matching
    Interactions which are lower down.
</p>
<p><a id="selfinteractions"></a>
  <b>Each particle must also have a self-Interaction</b>.<br/> This
  self-Interaction does not generate events, but is used to decide how
  to draw the particle in the visualiser and to calculate some single
  particle properties, such as the excluded volume.
</p>
<h2>Type="Null"</h2>
<p>
  <b>Description:</b> The "Null" Interaction is used to mark particle
  pairs out as non-interacting. All particle pairs must have a
  corresponding Interaction defined, so this Interaction is the only
  way to prevent events being generated for a set of particle pairs.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="Null" Name="Bulk">
  <IDPairRange .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Null"</i> to select this Interaction type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the
    Interaction. This name is used to identify the Interaction in
    the configuration file (e.g.,
    see <a href="#species">Species</a>) and in the output generated
    by the dynarun command. Each Interaction must have a name which
    is unique.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="HardSphere"</h2>
<p>
  <b>Description:</b> The "HardSphere" Interaction implements the
  hard-sphere interaction potential. This is one of the simplest
  event-driven potentials available.
</p>
<p>
  A hard sphere is a simple molecular model used to capture the
  fundamental effects of "excluded-volume" interactions. You may think
  of the hard-sphere fluid as an extension of the ideal-gas model,
  where each molecule now has a diameter, $\sigma$, and cannot overlap
  the volume of this diameter with the volume of other molecules. The
  parameters of this model are illustrated below:
</p>
<img src="/images/hardsphere.png" alt="The interparticle potential energy of a hard-sphere molecule" width="650" height="232" style="display:block;margin:0 auto 0 auto;">
<p>
  where $u(r)$ is the interparticle potential (which is the potential
  energy between two particles separated by a distance of
  $r$). Particles do not interact at separations greater than the
  diameter of the molecule ($u(r)=0$ for $r\in[\sigma,\,\infty]$). The
  infinite interaction energy of the hard core ($u(r)=+\infty$ for
  $r\in[0,\,\sigma]$) makes it energetically impossible for particles
  to "overlap", therefore the particles will elastically bounce-off of
  each other when they come into contact.
</p>
<p>
  The effects of this additional "excluded volume" interaction is
  dramatic and leads to complex transport coefficients as a function of
  density and the appearance of a fluid-solid freezing transition. This
  model is too simple to capture any complex temperature effects, such
  as a liquid/gas phase transition, as it has no finite interaction
  energies (unlike the <a href="#typesquarewell">square-well
    fluid</a>). Despite its simplicity, the structure of many real
  crystals is dominated by the repulsive "excluded-volume" interactions
  caused by overlapping electron clouds which may be effectively
  captured by the hard-sphere model. It is also at the heart of kinetic
  theory which is the most successful attempt to predict the transport
  properties of fluids from their molecular interactions. The
  interparticle potential of this model is given in the figure below:
</p>
<p>
  <b>Collision Rule:</b> To perform an interaction we need a collision
  rule which calculates the post-collision velocities of the two
  particles undergoing the Interaction. The collision rule expresses the
  post-collision velocities in terms of the pre-collision values.
</p>
<?php showhidestart(); ?>
    Using the definition of the relative velocity
    $\boldsymbol{v}_{ij}=\boldsymbol{v}_{i}-\boldsymbol{v}_{j}$ of two
    particles $i$ and $j$, and the identities
    $\boldsymbol{v}_i=\boldsymbol{v}_{ij}+\boldsymbol{v}_j$ and
    $\boldsymbol{v}_j=\boldsymbol{v}_i-\boldsymbol{v}_{ij}$, we have
    
    \[\begin{align}
    \boldsymbol{v}_j'-\boldsymbol{v}_j&amp;=\boldsymbol{v}_i'-\boldsymbol{v}_i - \boldsymbol{v}_{ij}'+\boldsymbol{v}_{ij}
    \end{align}\]
    
    where the primes denote post-collision values.  Using the conservation
    of momentum, we can write
    
    \[\begin{align}
    m_i\,\boldsymbol{v}_i'+m_j\,\boldsymbol{v}_j'&amp;=m_i\,\boldsymbol{v}_i+m_j\,\boldsymbol{v}_j\\
    \boldsymbol{v}_i'-\boldsymbol{v}_i&amp;=-\frac{m_j}{m_i}\left(\boldsymbol{v}_j'-\boldsymbol{v}_j\right)
    \end{align}\]

    where $m_i$ is the mass of particle $i$.  Using the equation
    derived from the conservation of momentum to eliminate
    $\boldsymbol{v}_j$ terms, we have

    \[\begin{align}
    \boldsymbol{v}_i'-\boldsymbol{v}_i&amp;=-\frac{m_j}{m_i}\left(\boldsymbol{v}_i'-\boldsymbol{v}_i - \boldsymbol{v}_{ij}'+\boldsymbol{v}_{ij}\right)\\
    &amp;=m_i^{-1}\,\mu\left(\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right)
    \end{align}\]

    where $\mu_{ij}=\left(m_i^{-1}+m_j^{-1}\right)^{-1}$ is the reduced
    mass. Therefore we can calculate the post-collision velocities of the
    particles if we know the change in the relative velocities. For smooth
    particles the velocities only change along the line of contact, and we
    have:

    \[\begin{align*}
    \left[\boldsymbol{v}_{ij}'\right]_\parallel&amp;=-\varepsilon\left[\boldsymbol{v}_{ij}\right]_\parallel &amp;
    \left[\boldsymbol{v}_{ij}'\right]_\perp&amp;=\left[\boldsymbol{v}_{ij}\right]_\perp
    \end{align*}\]

    where $\varepsilon$ is the elasticity/coefficient of restitution
    and the subscript $\parallel$ and $\perp$ denote the components
    parallel and perpendicular to the line of contact. These are
    calculated like so
    $\boldsymbol{v}_{ij,\parallel}=\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{v}_{ij}\right)$
    and
    $\boldsymbol{v}_{ij,\perp}=-\hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{v}_{ij}\right)$
    where $\hat{\boldsymbol{r}}_{ij}$ is the unit vector in the
    direction of the relative separation at contact,
    $\boldsymbol{r}_{ij}=\boldsymbol{r}_i-\boldsymbol{r}_j$, and
    $\boldsymbol{r}_i$ is the position of particle $i$. Combining
    these rules results in the following expression

    \[\begin{align*}
    \boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}=-(1+\varepsilon)\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{v}_{ij}\right)\hat{\boldsymbol{r}}_{ij}
    \end{align*}\]

    This leads to the final expressions for smooth particles:

    \[\begin{align}
    \boldsymbol{v}_i'-\boldsymbol{v}_i&amp;=-m_i^{-1}\,\mu_{ij}(1+\varepsilon)\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{v}_{ij}\right)\hat{\boldsymbol{r}}_{ij}\\
    \boldsymbol{v}_j'-\boldsymbol{v}_j&amp;=+m_j^{-1}\,\mu_{ij}(1+\varepsilon)\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{v}_{ij}\right)\hat{\boldsymbol{r}}_{ij}
    \end{align}\]

    In rough systems, particles will change rotation due to
    interactions. To define the dynamics in such a system we need to
    consider the relative surface velocity at the point of contact,
    $\boldsymbol{g}_{ij}$, calculated as follows \[\begin{align*}
    \boldsymbol{g}_{ij}&amp;=\left(\boldsymbol{v}_i-\boldsymbol{\omega}_i\times
    R_i\,\hat{\boldsymbol{r}}_{ij}\right)-\left(\boldsymbol{v}_j+\boldsymbol{\omega}_j\times
    R_j\hat{\boldsymbol{r}}_{ij}\right)\\
    &amp;=\boldsymbol{v}_{ij}-\left(R_i\,\boldsymbol{\omega}_i+R_j\,\boldsymbol{\omega}_j\right)\times\hat{\boldsymbol{r}}_{ij}
    \end{align*}\] where $\boldsymbol{\omega}_j$ is the angular velocity
    and $R_i$ is the radus of particle $i$. In this case, we can define a
    normal and a tangential coefficient of restitution as follows

    \[\begin{align}
    \left[\boldsymbol{g}_{ij}\right]_\parallel'&amp;=-\varepsilon^n\left[\boldsymbol{g}_{ij}\right]_\parallel
    &amp;
    \left[\boldsymbol{g}_{ij}\right]_\perp'&amp;=\varepsilon^t\left[\boldsymbol{g}_{ij}\right]_\perp
    \end{align}\] 

    where
    $\boldsymbol{g}_{ij,\parallel}=\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right)$
    and
    $\boldsymbol{g}_{ij,\perp}=-\hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)$. Noting
    that
    $\boldsymbol{x}=\hat{\boldsymbol{e}}(\hat{\boldsymbol{e}}\cdot\boldsymbol{x})-\hat{\boldsymbol{e}}\times\left(\hat{\boldsymbol{e}}\times\boldsymbol{x}\right)$,
    these definitions lead to the following expressions

    \[\begin{align*}
    \hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]\right)&amp;=-(1+\varepsilon^n)\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right)
    &amp;
    \hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]\right)&amp;=(\varepsilon^t-1)\hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)
    \end{align*}\]

    We need to find an expression which closes the linear momentum balance
    by providing a relationship between  $\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}$ and
    $\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}$, as well as determining how the angular velocity
    changes. Beginning with the angular velocity, we take the contact
    point as the origin about which the angular momentum is defined. We
    then note that all contact forces act through the origin and see that
    angular velocity is conserved for both particles separately. Thus we
    will have two separate angular-momentum conservation rules:

    \[\begin{align*}
    m_i\,R_i\,\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{v}_i' + \boldsymbol{I}_i\cdot\boldsymbol{\omega}_i' &amp;= m_i\,R_i\,\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{v}_i + \boldsymbol{I}_i\cdot\boldsymbol{\omega}_i\\
    m_j\,R_j\,\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{v}_j' - \boldsymbol{I}_j\cdot\boldsymbol{\omega}_j' &amp;= m_j\,R_j\,\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{v}_j - \boldsymbol{I}_j\cdot\boldsymbol{\omega}_j
    \end{align*}\]

    For symmetric objects we have an isotropic inertia tensor
    $\boldsymbol{I}_i=I_i\,\boldsymbol{1}$, and can define a reduced moment of inertia as
    $\tilde{I}_i=I_i/m_i\,R_i^2$ and can rearrange these two equations
    like so

    \[\begin{align*}
    \boldsymbol{\omega}_i'- \boldsymbol{\omega}_i&amp;=- R_i^{-1}\tilde{I}_i^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_i' -\boldsymbol{v}_i\right)\right]\\
    \boldsymbol{\omega}_j'- \boldsymbol{\omega}_j &amp;= + R_j^{-1}\tilde{I}_j^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_j' -\boldsymbol{v}_j\right)\right]
    \end{align*}\]

    We need to find the post-collision linear velocities to close these
    expressions. We can define the pre and post collision relative
    velocity at the surface as follows

    \[\begin{align*}
    \boldsymbol{g}_{ij}&amp;=\left(\boldsymbol{v}_i-\boldsymbol{\omega}_i\times
    R_i\,\hat{\boldsymbol{r}}_{ij}\right)-\left(\boldsymbol{v}_j+\boldsymbol{\omega}_j\times
    R_j\hat{\boldsymbol{r}}_{ij}\right)\\
    &amp;=\boldsymbol{v}_{ij}-\left(R_i\,\boldsymbol{\omega}_i+R_j\,\boldsymbol{\omega}_j\right)\times\hat{\boldsymbol{r}}_{ij}
    \end{align*}\]

    Finding the post collision value of this 

    \[\begin{align*}
    \boldsymbol{g}_{ij}'&amp;=\boldsymbol{v}_{ij}'-\left(R_i\,\boldsymbol{\omega}_i'+R_j\,\boldsymbol{\omega}_j'\right)\times\hat{\boldsymbol{r}}_{ij}\\
    &amp;=\boldsymbol{v}_{ij}' - \left(R_i\left(\boldsymbol{\omega}_i - R_i^{-1}\,\tilde{I}_i^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_i' -\boldsymbol{v}_i\right)\right]\right)+R_j\left(\boldsymbol{\omega}_j + R_j^{-1}\,\tilde{I}_j^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_j' -\boldsymbol{v}_j\right)\right]\right)\right)\times\hat{\boldsymbol{r}}_{ij}\\
    &amp;=\boldsymbol{v}_{ij}'-\left(R_i\,\boldsymbol{\omega}_i +
    R_j\,\boldsymbol{\omega}_j\right)\times\hat{\boldsymbol{r}}_{ij} +
    \left(\tilde{I}_i^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_i'
    -\boldsymbol{v}_i\right)\right]
    -\tilde{I}_j^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_j'
    -\boldsymbol{v}_j\right)\right]\right)\times\hat{\boldsymbol{r}}_{ij}
    \end{align*}\]

    Subtracting the pre-collision value from this value, and assuming that
    all particles have the same reduced moment of inertia, we have

    \[\begin{align*}
    \boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}&amp;=\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}+
    \tilde{I}^{-1}\left(\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_i'
    -\boldsymbol{v}_i\right)\right]
    -\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_j'
    -\boldsymbol{v}_j\right)\right]\right)\times\hat{\boldsymbol{r}}_{ij}\\
    &amp;=\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}-
    \tilde{I}^{-1}\,\hat{\boldsymbol{r}}_{ij}\times\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_{ij}'
    -\boldsymbol{v}_{ij}\right)\right]
    \end{align*}\]

    Now that we have the relationship between $\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}$
    and $\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}$, we look to insert the coefficients of
    restitution. We notice that the second term is perpendicular to
    $\hat{\boldsymbol{r}}_{ij}$, therefore we have

    \[\begin{align}
    \hat{\boldsymbol{r}}_{ij}\cdot\left(\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right) = \hat{\boldsymbol{r}}_{ij}\cdot\left(\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right)
    \end{align}\]

    Taking the vector product instead and we have

    \[\begin{align*}
    \hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]  &amp;=\hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right]-
    \tilde{I}^{-1}\hat{\boldsymbol{r}}_{ij}\times\left[\hat{\boldsymbol{r}}_{ij}\times\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_{ij}'
    -\boldsymbol{v}_{ij}\right)\right]\right]
    \end{align*}\]

    we note that
    $\hat{\boldsymbol{e}}\times\left(\hat{\boldsymbol{e}}\times\left(\hat{\boldsymbol{e}}\times\boldsymbol{x}\right)\right)=-\hat{\boldsymbol{e}}\times\boldsymbol{x}$,
    giving

    \[\begin{align}
    \hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]
    &amp;=\hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right]+
    \tilde{I}^{-1}\,\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_{ij}'
    -\boldsymbol{v}_{ij}\right)\nonumber\\
    \hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right]&amp;=\left(1+\tilde{I}^{-1}\right)^{-1}\hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]
    \end{align}\]

    Noting again that in general we have
    $\boldsymbol{x}=\hat{\boldsymbol{e}}(\hat{\boldsymbol{e}}\cdot\boldsymbol{x})-\hat{\boldsymbol{e}}\times\left(\hat{\boldsymbol{e}}\times\boldsymbol{x}\right)$, and 
    we can write

    \[\begin{align}
    \boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}&amp;=\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot(\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij})\right) -\hat{\boldsymbol{r}}_{ij}\times\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}\right)\right]\\
    &amp;=\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\left(\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right)\right) -\left(1+\tilde{I}^{-1}\right)^{-1}\hat{\boldsymbol{r}}_{ij}\times\left[\hat{\boldsymbol{r}}_{ij}\times\left[\boldsymbol{g}_{ij}'-\boldsymbol{g}_{ij}\right]\right]
    \end{align}\]

    Inserting in the coefficients of restitution, we have

    \[\begin{align}
    \boldsymbol{v}_{ij}'-\boldsymbol{v}_{ij}&amp;=-(1+\varepsilon^n)\hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right) -\left(1+\tilde{I}^{-1}\right)^{-1}(\varepsilon^t-1)\hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)
    \end{align}\]

    Using this we can complete the expression for the linear velocity
    change:

    \[\begin{align}
    \boldsymbol{v}_i'-\boldsymbol{v}_i&amp;=-m_i^{-1}\,\mu_{ij}\left((1+\varepsilon^n)
    \hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right)
    +\left(1+\tilde{I}^{-1}\right)^{-1}(\varepsilon^t-1)
    \hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)\right)
    \end{align}\]

    Inserting this into the expression for the change in angular velocity,
    we have

    \[\begin{align*}
    \boldsymbol{\omega}_i'- \boldsymbol{\omega}_i&amp;=- R_i^{-1}\tilde{I}_i^{-1}\left[\hat{\boldsymbol{r}}_{ij}\times\left(\boldsymbol{v}_i' -\boldsymbol{v}_i\right)\right]\\
    &amp;=
    m_i^{-1}\,\mu_{ij}\,R_i^{-1}\left(1+\tilde{I}\right)^{-1}(\varepsilon^t-1)\hat{\boldsymbol{r}}_{ij}\times\left[
    \hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)\right]\\
    &amp;=
    -m_i^{-1}\,\mu_{ij}\,R_i^{-1}\left(1+\tilde{I}\right)^{-1}(\varepsilon^t-1)\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}
    \end{align*}\]

    The corresponding rules for particle $j$ follow with similar
    reasoning or through relabing and noting that
    $\boldsymbol{g}_{ji}=-\boldsymbol{g}_{ij}$. In summary, we have
<?php showhideend("Show/hide derivation of collision rule"); ?>
<p>
  \[\begin{align*}
  \boldsymbol{v}_i'-\boldsymbol{v}_i&amp;=-\frac{\mu_{ij}}{m_i}\left((1+\varepsilon^n)
  \hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right)
  +\frac{\varepsilon^t-1}{1+\tilde{I}^{-1}}
  \hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)\right)\\
  \boldsymbol{v}_j'-\boldsymbol{v}_j&amp;=\frac{\mu_{ij}}{m_j}\left((1+\varepsilon^n)
  \hat{\boldsymbol{r}}_{ij}\left(\hat{\boldsymbol{r}}_{ij}\cdot\boldsymbol{g}_{ij}\right)
  +\frac{\varepsilon^t-1}{1+\tilde{I}^{-1}}
  \hat{\boldsymbol{r}}_{ij}\times\left(\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}\right)\right)\\
  \boldsymbol{\omega}_i'-
  \boldsymbol{\omega}_i&amp;=-\frac{\mu_{ij}(\varepsilon^t-1)}{m_i\,R_i\left(1+\tilde{I}\right)}
  \hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}
  \\
  \boldsymbol{\omega}_j'-
  \boldsymbol{\omega}_j&amp;=-\frac{\mu_{ij}(\varepsilon^t-1)}{m_j\,R_j\left(1+\tilde{I}\right)}\hat{\boldsymbol{r}}_{ij}\times\boldsymbol{g}_{ij}
  \end{align*}\]

  where $\varepsilon^n$ and $\varepsilon^t$ are the normal and
  tangential coefficient of elasticity respectively. See the
  derivation above for more information on the symbols and their
  meaning.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<Interaction Type="HardSphere" Diameter="1" Name="Bulk">
  <IDPairRange .../>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"HardSphere"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The interaction diameter
    ($\sigma$) of the particle pairs corresponding to this
    Interaction. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: This is an optional
    attribute. The elasticity, $\varepsilon^n$, controls the dissipation of
    translational energy between interacting particles.  This value is
    typically 1 for molecular systems and between zero and one for
    granular systems. If the attribute is unset, it is equivalent
    to <i>Elasticity="1"</i>.

    <br/> This attribute is a <b>Property specifier</b>
    with <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>TangentialElasticity</b> <i>(attribute)</i>: This is an
    optional attribute. The tangential elasticity, $\varepsilon^t$,
    controls the dissipation/generation of energy between interacting
    particles in the tangential/rotational direction and is typically
    in the range $[-1,1]$. If the tangential elasticity is one, there
    is no tangential interaction,
    whereas <i>TangentialElasticity="-1"</i> corresponds to a complete
    reversal of the relative surface velocities. It is important to
    note that setting the <i>TangentialElasticity</i> attribute
    requires that the particles have a <a href="#species">Species</a>
    with inertia information. If the attribute is unset then
    rotational dynamics are ignored and the particles can have
    any <a href="#species">Species</a> type.

    <br/> This attribute is a <b>Property specifier</b>
    with <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>:
    This <a href="#idpairrange">IDPairRange</a> tag specifies the
    pairs of particles which interact using this Interaction. See
    the <a href="#idpairrange">section on IDPairRanges</a> for more
    information on the format of this tag.
  </li>
</ul>
<h2><a id="typesquarewell"></a>Type="SquareWell"</h2>
<p>
  <b>Description:</b> The "SquareWell" Interaction implements the
  square-well interaction potential, illustrated in the figure below. 
</p>
<p>
  A square-well molecule is a particle which has a hard-core diameter
  of $\sigma$ and is surrounded by an attractive well with a diameter
  of $\lambda\,\sigma$ and a depth of $\varepsilon$. These variables
  are illustrated in the diagram below:
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
  square-well model (<span style="font-weight:bold;
  color:#000;">black</span>) and a "realistic" interatomic potential
  (<span style="font-weight:bold; color:#800;">red</span>) is given in
  the figure below:
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
  potential (see the <a href="#typesteppedpotential">"Stepped" type
  Interaction</a>), we can quite quickly capture the full behaviour of
  the smooth/"realistic" potential. However, the square-well model is
  so interesting because it is so simple! We can make progress in
  understanding it theoretically and, if we can understand the
  fundamental behaviour of square-well molecules, the fundamental
  behaviour of realistic potentials can also be explained.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="SquareWell" Diameter="1" Elasticity="1" Lambda="1.5" WellDepth="1" Name="Bulk">
  <IDPairRange .../>
  <CaptureMap .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"SquareWell"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The interaction diameter
    ($\sigma$) of the particle pairs corresponding to this
    Interaction. 

    <br/> This attribute is a <b>Property specifier</b> with a
    unit of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle pairs corresponding to this Interaction. This value is
    typically 1 for molecular systems and between zero and one for
    granular systems.
    
    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Lambda</b> <i>(attribute)</i>: The well-width factor
    ($\lambda$) of the particle pairs corresponding to this
    Interaction. Values below 1 are not valid. 

    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>WellDepth</b> <i>(attribute)</i>: The interaction energy
    ($\varepsilon$) of the particle pairs corresponding to this
    Interaction. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Energy</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b>CaptureMap</b> <i>(tag)</i>: If present, the CaptureMap tag
    should store the particle pairs which are within the well. If it
    is not present, it will be automatically generated when the
    configuration is next loaded by dynarun or dynamod. The data in
    this tag must be correct at all times otherwise errors in the
    dynamics will occur so take care when manually editing the
    configuration file. See the reference entry
    on <a href="#capturemap">CaptureMap</a> for more details.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="ParallelCubes"</h2>
<div class="figure" style="width:266px; float:right;">
  <?php embedAJAXvideo("parallelCubes_small", "B_qASDj9J8I", 266, 150); ?>
  <div class="caption">
    A simulation of Parallel hard cubes.
  </div>
</div>
<p>
  <b>Description:</b> The "ParallelCubes" Interaction implements the
  hard cube interaction potential where the cubes do not rotate and
  are axis-aligned (a video of this system is presented to the right).
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="ParallelCubes" Diameter="1" Elasticity="1" Name="Bulk">
  <IDPairRange .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"ParallelCubes"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The interaction diameter is
    the length at which the particle pairs collide with this
    Interaction (the length of a cube side). 
    
    <br/> This attribute is a <b>Property specifier</b> with a unit of
    <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle pairs corresponding to this Interaction. This value is
    typically 1 for molecular systems and between zero and one for
    granular systems. 

    <br/> This attribute is a <b>Property specifier</b>
    with <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="Lines"</h2>
<div class="figure" style="width:266px; vertical-align:middle; float:right;">
  <?php embedAJAXvideo("thinHardLines", "hUVZxEhjoc0", 266, 150); ?>
  <div class="caption">
    A simulation of Infinitely-thin rods.
  </div>
</div>
<p>
  <b>Description:</b> The "Lines" Interaction implements the hard
  infinitely-thin rods interaction potential (a video of this system
  is presented to the right). 
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="Lines" Length="1" Elasticity="1" Name="Bulk">
  <IDPairRange .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Lines"</i> to select this Interaction type.
  </li>
  <li>
    <b>Length</b> <i>(attribute)</i>: The length of the lines. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle pairs corresponding to this Interaction. This value is
    typically 1 for molecular systems and between zero and one for
    granular systems. 
    
    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="Stepped"</h2>
<p>
  <b>Description:</b> The "Stepped" Interaction wraps a generic
  spherically-symmetric stepped <a href="#potential">Potential</a> and
  uses it for two-particle interactions. This can be used to implement
  many simple systems (hard-spheres, square-wells) and many complex
  systems such as a discontinuous Lennard-Jones potential. An
  alternative approach is to use a <a href="#typeumbrella">"Umbrella"
  System event</a> to bind collections of particles together using
  a <a href="#potential">Potential</a>.
</p>
<p>
  <b>Example Usage:</b> Generic wrapping of a <a href="#potential">Potential</a>.
</p>
<?php codeblockstart();?>
<Interaction Type="Stepped" Name="Bulk" LengthScale="1" EnergyScale="1">
  <IDPairRange .../>
  <Potential .../>
  <CaptureMap .../>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Stepped"</i> to select this Interaction type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b>LengthScale</b> <i>(attribute)</i>: The length scale by which
    the <a href="#potential">Potential</a> is scaled for each
    particle. For example, if
    a <a href="#typelennardjonespotential">Lennard-Jones type
    Potential</a> is used, this sets the $\sigma$ value for each
    particle.
    
    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>EnergyScale</b> <i>(attribute)</i>: The energy scale by which
    the <a href="#potential">Potential</a> is scaled for each
    particle. For example, if
    a <a href="#typelennardjonespotential">Lennard-Jones type
    Potential</a> is used, this sets the $\varepsilon$ value for each
    particle.
    
    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Potential</b> <i>(tag)</i>:
    The <a href="#potential">Potential</a> tag specifies the stepped
    potential used for this interaction. Please see the section on
    the <a href="#potential">Potential</a> tag for more information.
  </li>
  <li>
    <b>CaptureMap</b> <i>(tag)</i>: If present, the CaptureMap tag
    should store the current step of any particle pairs which are
    inside the Interaction range of the potential. If it is not
    present, it will be automatically generated when the configuration
    is next loaded by dynarun or dynamod. The data in this tag must be
    correct at all times otherwise errors in the dynamics will occur
    so take care when manually editing the configuration file. See the
    reference entry on <a href="#capturemap">CaptureMap</a> for more
    details.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="ThinThread"</h2>
<p>
  <b>Description:</b> The "ThinThread" Interaction implements a
  square-well potential which has hysteresis. The particle behaves as
  a hard sphere, but once a pair of particles collide with the hard
  core, they enter the well. The energy of this well must be paid to
  escape, thus the model loses energy each time particles enter the
  well. Once particles escape the well, they must again collide with
  the core before they can re-enter the well (as illustrated in the
  figure below). This model may be used to model wet granulate and the
  formation of liquid bridges as when wet granular particles contact
  each other a liquid bridge stretches between them. Breaking this
  bridge requires an amount of energy and distance to overcome the
  surface tension (modelled by the well), but once the bridge is
  broken the particles will only interact again at short distances.
</p>
<img src="/images/thinthread.png" alt="A diagram of a thin thread molecule including its parameters" width="650" height="232" style="display:block;margin:0 auto 0 auto;">
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="ThinThread" Diameter="1" Elasticity="1" Lambda="1.5" WellDepth="1" Name="Bulk">
  <IDPairRange .../>
  <CaptureMap .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"ThinThread"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The interaction diameter
    ($\sigma$) of the particle pairs corresponding to this
    Interaction. 
    
    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle pairs corresponding to this Interaction. This value is
    typically 1 for molecular systems and between zero and one for
    granular systems. 

    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Lambda</b> <i>(attribute)</i>: The well-width factor
    ($\lambda$) of the particle pairs corresponding to this
    Interaction. Values below 1 are not valid. 

    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>WellDepth</b> <i>(attribute)</i>: The interaction energy
    ($\varepsilon$) of the particle pairs corresponding to this
    Interaction. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Energy</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b>CaptureMap</b> <i>(tag)</i>: If present, the CaptureMap tag
    should store the particle pairs which are within the well. If it
    is not present, it will be automatically generated when the
    configuration is next loaded by dynarun or dynamod. The data in
    this tag must be correct at all times otherwise errors in the
    dynamics will occur so take care when manually editing the
    configuration file. See the reference entry
    on <a href="#capturemap">CaptureMap</a> for more details.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2>Type="SquareBond"</h2>
<p>
  <b>Description:</b> The "SquareBond" Interaction implements a
  square-well potential with an infinite interaction energy. This
  allows you to bond particles together to form polymeric structures.
</p>
<img src="/images/squarebond.png" alt="A diagram of a square-bond including its parameters" width="650" height="232" style="display:block;margin:0 auto 0 auto;">
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Interaction Type="SquareBond" Diameter="1" Elasticity="1" Lambda="1.5" Name="Bulk">
  <IDPairRange .../>
</Interaction><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"SquareBond"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The interaction diameter
    ($\sigma$) of the particle pairs corresponding to this
    Interaction. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle pairs corresponding to this Interaction. This value is
    typically 1 for molecular systems and between zero and one for
    granular systems. 
    
    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Lambda</b> <i>(attribute)</i>: The bond-width factor
    ($\lambda$) of the particle pairs corresponding to this
    Interaction. Values below 1 are not valid. 

    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Interaction. This
    name is used to identify the Interaction in the output generated
    by the dynarun command. Each Interaction must have a name which is
    unique.
  </li>
  <li>
    <b><a href="#idpairrange">IDPairRange</a></b> <i>(tag)</i>: This <a href="#idpairrange">IDPairRange</a> tag specifies
    the pairs of particles which interact using this
    Interaction. See the <a href="#idpairrange">section on
      IDPairRanges</a> for more information on the format of this tag.
  </li>
</ul>
<h2><a id="capturemap"></a>CaptureMap</h2>
<p>
  <b>CaptureMap</b>s are used by DynamO to track which particles are
  currently interacting with other particles using that
  <b>Interaction</b>. For example,
  the <a href="#typesquarewell">SquareWell
  type <b>Interaction</b>s</a> uses the capture map to record all
  pairs of particles who are inside each others attractive well. This
  information must be saved and loaded with the configuration file as,
  if a particle is on the edge of the well, it is impossible to
  determine if they are captured or not from their position
  alone. Without using a <b>CaptureMap</b>, this ambiguity would lead to the
  simulation either losing or gaining energy after a save/load.
</p>
<p>
  If DynamO does not see a <b>CaptureMap</b> in the configuration
  file, but the <b>Interaction</b> requires one it will automatically
  calculate the <b>CaptureMap</b> from the particle positions.
</p>
<p>
  Whenever we change a configuration file by hand, its very likely
  that we will invalidate any data stored within <b>CaptureMap</b>
  tags inside the file.  The simplest way of correcting this error is
  to delete the <b>CaptureMap</b> tags. This forces DynamO to rebuild
  them when it next loads the configuration file. You should note that
  deleting the CaptureMap might cause the potential energy of the
  system to change slightly, so it should be avoided if energy
  conservation is desired.
</p>
<h1><a id="local"></a>Local</h1>
<p>
  Locals are sources of events for particles where each event only
  involves a single particle and this event only occurs when the
  particle is within certain regions of the simulation. The standard
  example of a Local is a wall or some other boundary of the
  simulation.
</p>
<h2>Type="Wall"</h2>
<p>
  <b>Description:</b> The "Wall" Local implements an infinite
  plane/wall. This Local is typically used as a boundary of the
  simulation and may also be "thermalised" to inject or remove energy
  from the system. As these planes/walls are infinite, you must take
  care that they are axis-aligned if the system is periodic. They are
  not compatible with shearing simulations
  (see <a href="#">Lees-Edwards boundary conditions</a>) unless the
  normal is aligned with the $y$-axis (which would defeat the purpose
  of using Lees-Edwards boundaries).
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Local Type="Wall" Name="GroundPlate" Elasticity="1" Diameter="1" Temperature="0.5">
  <IDRange Type="All"/>
  <Norm x="0" y="1" z="0"/>
  <Origin x="0" y="-7.5" z="0"/>
</Local><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Wall"</i> to select this Interaction type.
  </li>
  <li>
    <b>Diameter</b> <i>(attribute)</i>: The diameter of the
    particles which interact with this wall. Although the diameter
    must be given here (to be consistent with Interactions), you
    should note that particles actually collide with the wall when
    they reach a separation equal to half the diameter. 

    <br/> This attribute is a <b>Property specifier</b> with a unit
    of <b>Length</b> (see the <a href="#property">section on
      Properties</a> for more information).
  </li>
  <li>
    <b>Elasticity</b> <i>(attribute)</i>: The elasticity of the
    particle collisions. This value is typically 1 for molecular
    systems and between zero and one for granular systems. 

    <br/> This attribute is a <b>Property specifier</b> with
    <b>Dimensionless</b> units (see
    the <a href="#property">section on Properties</a> for more
    information).
  </li>
  <li>
    <b>Temperature</b> <i>(attribute)</i>: The temperature is an
    optional tag. If it is present, whenever a particle hits the
    wall, the normal component of its velocity will be randomly
    reassigned from a distribution with the specified
    temperature. If it is not present, the particles will collide
    according to the elasticity.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Local. This name
    is used to identify the Local in the output generated by the
    dynarun command. Each Local must have a name which is
    unique.
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: This <a href="#idrange">IDRange</a> tag specifies the
    particles which interact using this Local. See
    the <a href="#idrange">section on IDRanges</a> for more
    information on the format of this tag.
  </li>
  <li>
    <b>Norm</b> <i>(tag)</i>: The normal of the plane of the
    wall. The value is renormalised by DynamO on load.
    <ul>
      <li>
	<b>x</b> <i>(attribute)</i>: The $x$-component of the normal.
      </li>
      <li>
	<b>y</b> <i>(attribute)</i>: The $y$-component of the normal.
      </li>
      <li>
	<b>z</b> <i>(attribute)</i>: The $z$-component of the normal.
      </li>
    </ul>
  </li>
  <li>
    <b>Origin</b> <i>(tag)</i>: A point on the plane of the
    wall.
    <ul>
      <li>
	<b>x</b> <i>(attribute)</i>: The $x$-coordinate of the point.
      </li>
      <li>
	<b>y</b> <i>(attribute)</i>: The $y$-coordinate of the point.
      </li>
      <li>
	<b>z</b> <i>(attribute)</i>: The $z$-coordinate of the point.
      </li>
    </ul>
  </li>
</ul>
<h1><a id="global"></a>Global</h1>
<p>
  Globals, like Locals, specify events which only affect a single
  particle in the system. The difference between Globals and Locals is
  that a Global event will occur to a particle, regardless of its
  location in the system. The most common type of Global used is the
  cellular neighbour list.
</p>
<h2>Type="Cells"</h2>
<p>
  <b>Description:</b> The "Cells" Global implements a cellular
  neighbour list, which may be used by the Scheduler to optimise the
  simulation. The neighbourlist will track all particles that match
  its <a href="#idrange">IDRange</a> and can provide information on which tracked particles
  are within the neighbourhood of other particles or points.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Global Type="Cells" Name="SchedulerNBList" NeighbourhoodRange="1">
  <IDRange .../>
</Global><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Cells"</i> to select this Global type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the Global. This
    name is used to identify the Global in the output generated by
    the dynarun command. Each Global must have a name which is
    unique. In particular, if this cellular neighbour list is to be
    used by the <a href="#typeneighbourlist">"NeighbourList" type Scheduler</a>, it should have the
    name "SchedulerNBList".
  </li>
  <li>
    <b>NeighbourhoodRange</b> <i>(attribute)</i>: This optional
    attribute sets the minimum distance at which particles are
    considered to be in the neighbourhood of other particles or
    points. If the neighbour list is used by
    the <a href="#typeneighbourlist">"NeighbourList" type
      Scheduler</a>, this distance should be at least equal to or
    greater than the maximum <a href="#interaction">Interaction</a> distance in the system. If
    this tag is unset, the maximum interaction distance is
    automatically calculated.
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: This <a href="#idrange">IDRange</a> tag specifies the
    particles which are tracked in the cellular neighbour list. See
    the <a href="#idrange">section on IDRanges</a> for more
    information on the format of this tag.
  </li>
</ul>
<h1><a id="system"></a>System</h1>
<p>
  System tags represent events which are unique. There is only one
  event time generated by a System, and this event may alter zero or
  many particles at once. If an event type does not fit into the
  categories of
  <a href="#global">Global</a>, <a href="#local">Local</a>,
  or <a href="#interaction">Interaction</a>, it will be implemented
  via a System event. The most common type of system event is the
  Andersen thermostat.
</p>
<h2><a id="typeandersen"></a>Type="Andersen"</h2>
<p>
  <b>Description:</b> The "Andersen" System implements an Andersen
  thermostat. An Andersen thermostat functions by randomly reassigning
  the velocities of individual particles from a Gaussian distribution
  with a specified temperature. These reassignments occur at random
  time intervals given by a Poisson distribution with a specified mean
  free time.
</p>
<p>
  This thermostat adds thermal "noise" into the system, and so
  dynamical properties will be affected by its action. To avoid
  completely losing the dynamics of the system, the thermostat is
  usually controlled to ensure that only a certain fraction of the
  total events of the system are thermostat events. In DynamO, this
  fraction is specified by a
  <b>SetPoint</b> attribute. Every <b>SetFrequency</b> events, the
  mean free time of the thermostat is adjusted to try to match
  the <b>SetPoint</b>.
</p>
<p>
  If you want the mean free time to remain fixed during a simulation
  and want to disable the frequency control please ensure that you do
  not define the <b>SetFrequency</b> or
  <b>SetPoint</b> attributes. If either attribute is missing the
  frequency control will be disabled.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<System Type="Andersen" Name="Thermostat" MFT="1.0" Temperature="1.0" SetPoint="0.05" SetFrequency="100">
  <IDRange Type="All"/>
</System>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Andersen"</i> to select this System type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the System event. This
    name is used to identify the System in the output generated by the
    dynarun command. Each System must have a name which is unique.
  </li>
  <li>
    <b>MFT</b> <i>(attribute)</i>: The current mean free time over
    which the thermostat is applied. Please note, this is the
    mean free time of the thermostat <b>not</b> the mean free time
    per particle.
  </li>
  <li>
    <b>Temperature</b> <i>(attribute)</i>: The temperature ($k_B\,T$)
    of the thermostat.
  </li>
  <li>
    <b>SetPoint</b> <i>(attribute)</i>: This attribute is optional and
    only takes effect if the <b>SetFrequency</b> attribute is also
    defined. The target fraction of events which should be
    applications of the thermostat. This is effectively the damping
    constant of the thermostat.
  </li>
  <li>
    <b>SetFrequency</b> <i>(attribute)</i>: This attribute is optional
    and only takes effect if the <b>SetPoint</b> attribute is also
    defined. The thermostat mean free time is adjusted every
    SetFrequency events to attempt to match the SetPoint fraction of
    events.
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag)</i>: This <a href="#idrange">IDRange</a> tag specifies the
    particles to which the thermostat is applied. See
    the <a href="#idrange">section on IDRanges</a> for more
    information on the format of this tag.
  </li>
</ul>
<h2><a id="typeumbrella"></a>Type="Umbrella"</h2>
<p>
  <b>Description:</b> The "Umbrella" System implements an umbrella
  potential, allowing a <a href="#potential">Potential</a> to be
  specified between the centres of mass of two collections of
  particles.
</p>
<p>
  <b>Example Usage:</b> An umbrella potential between two groups of 64
  particles:
</p>
<?php codeblockstart();?>
<System Type="Umbrella" Name="UmbrellaPotential" LengthScale="1" EnergyScale="1">
  <IDRange Type="Ranged" Start="0" End="63"/>
  <IDRange Type="Ranged" Start="64" End="127"/>
  <Potential Type="Stepped" Direction="Right">
    <Step R="0.25" E="0.25"/>
    <Step R="0.5" E="0.5"/>
    <Step R="0.75" E="0.75"/>
    <Step R="1.0" E="1.0"/>
    <Step R="1.25" E="1.25"/>
    <Step R="1.5" E="1.5"/>
    <Step R="1.75" E="1.75"/>
    <Step R="2.0" E="2.0"/>
    <Step R="2.25" E="2.25"/>
    <Step R="2.5" E="2.5"/>
    <Step R="2.75" E="2.75"/>
    <Step R="3.0" E="3.0"/>
    <Step R="3.25" E="3.25"/>
    <Step R="3.5" E="3.5"/>
    <Step R="3.75" E="3.75"/>
    <Step R="4.0" E="4.0"/>
    <Step R="4.5" E="4.5"/>
    <Step R="5.0" E="5.0"/>
    <Step R="5.5" E="5.5"/>
    <Step R="6.0" E="6.0"/>
  </Potential>
</System>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Umbrella"</i> to select this System type.
  </li>
  <li>
    <b>Name</b> <i>(attribute)</i>: The name of the System event. This
    name is used to identify the System in the output generated by the
    dynarun command. Each System must have a name which is unique.
  </li>
  <li>
    <b>LengthScale</b> <i>(attribute)</i>: The length scale by which
    the <a href="#potential">Potential</a> is scaled by. For example,
    if a <a href="#typelennardjonespotential">Lennard-Jones type
    Potential</a> is used, this sets the $\sigma$ value.
  </li>
  <li>
    <b>EnergyScale</b> <i>(attribute)</i>: The energy scale by which
    the <a href="#potential">Potential</a> is scaled by. For example,
    if a <a href="#typelennardjonespotential">Lennard-Jones type
    Potential</a> is used, this sets the $\varepsilon$ value.
  </li>
  <li>
    <b><a href="#idrange">IDRange</a></b> <i>(tag$\times$2)</i>: There
    are two <a href="#idrange">IDRange</a> tags which specify the two
    ranges of particles which interact using the umbrella
    potential. See the <a href="#idrange">section on IDRanges</a> for
    more information on the format of these tags.
  </li>
  <li>
    <b>Potential</b> <i>(tag)</i>:
    The <a href="#potential">Potential</a> tag specifies the stepped
    potential used for the umbrella potential. Please see the section
    on the <a href="#potential">Potential</a> tag for more
    information.
  </li>
</ul>
<h1><a id="dynamics"></a>Dynamics</h1>
<p>
  The Dynamics tag specifies the equations of motion of the
  system. The standard variant is the "Newtonian" type, but there are
  other types available which allow the addition of an external force
  such as gravity.
</p>
<h2>Type="Newtonian"</h2>
<p>
  <b>Description:</b> The "Newtonian" Dynamics type is the standard
  Dynamics implementation in DynamO. All particles are moving under
  standard Newtonian dynamics, without the influence of external
  forces.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<Dynamics Type="Newtonian"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Newtonian"</i> to select this Dynamics type.
  </li>
</ul>
<h2>Type="NewtonianGravity"</h2>
<p>
  <b>Description:</b> The "NewtonianGravity" Dynamics type allows an
  external acceleration to be included in the dynamics.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<Dynamics Type="NewtonianGravity" ElasticV="1.0">
  <g x="0" y="-1" z="0"/>
</Dynamics>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"NewtonianGravity"</i> to select this Dynamics type.
  </li>
  <li>
    <b>ElasticV</b> <i>(attribute)</i>: An optional tag. If this tag
    is present, this tag specifies the velocity below which particle
    interactions will be turned elastic (used to prevent inelastic
    collapse).
  </li>
  <li>
    <b>tc</b> <i>(attribute)</i>: An optional tag. If this tag is
    present, this tag specifies the minimum re-collision rate which
    turns an interaction elastic (used to prevent inelastic
    collapse). For more information
    see <a href="http://dx.doi.org/10.1007/s100350050017">this
    paper</a>
    (also <a href="http://arxiv.org/abs/cond-mat/9810009">available on
    arxiv</a>).
  </li>
  <li>
    <b>g</b> <i>(tag)</i>: A tag specifying the vector of the external
    acceleration.
    <ul>
      <li>
	<b>x</b>, <b>y</b>, <b>z</b>, <i>(attributes)</i>: The
	components of the external acceleration.
      </li>
    </ul>
  </li>
</ul>
<h2>Type="NewtonianMC"</h2>
<p>
  <b>Description:</b> The "NewtonianMC" Dynamics implements a
  multicanonical simulation. Multicanonical simulations deform the
  energy potential of the system to accelerate the dynamics.  A
  descriptive paper on the technique is
  <a href="http://dx.doi.org/10.1021/jp962142e">"Multicanonical
    Ensemble Generated by Molecular Dynamics Simulation for Enhanced
    Conformational Sampling of Peptides"</a>. The following notes will
    be based around the notation of this paper.
</p>
<p>
  If we are in the canonical ensemble, the probability of being in a
  certain configurational energy, $E$, is

  \[P_c(E)=\frac{1}{Z_{c}} n(E) \exp\left[-E/k_BT\right] \]

  But for efficient sampling of all energies we would prefer it if the
  probability of each energy is constant and equal.

  \[ P_{mc} (E) = \frac{1}{Z_{mc}} n(E) \exp\left[-E/k_BT-W(E)\right] = \textrm{constant} \]

  This is the ideal multi-canonical simulation, as we sample all
  energies equally. However, to perform the ideal multi-canonical
  simulation we need to know the $W(E)$ function.

  \[ W(E) = \ln n(E) - E / k_B T = \ln P_c(E) \]

  This requires knowing the density of states ($n(E)$), but if these
  quantities are known, the problem of sampling the system is already
  solved. So what we need is an iterative way to determine the $W(E)$
  function. The simplest technique is to run a simulation with
  $W^{(0)}(E)=0$, and then iterate towards the optimal weighting with
  this expression:

  \[ W^{(i+1)}(E) = W^{(i)}(E) + \ln P^{(i)}_{mc}(E) \]

  There are more advanced techniques available in the literature which
  have been implemented and these are available as scripts which are
  run outside of DynamO. These are discussed elsewhere and only the
  DynamO interface is described here.
</p>
<p>
  It should be noted that the $W$ function is effectively an
  additional potential in the Hamiltonian of the system:

  \[ P_{mc} (E) = \frac{1}{Z_{mc}} n(E) \exp\left[-(E+E_{MC}(E))/k_B\,T\right] \]

  where $E_{MC}(E) = k_B\,T\,W(E)$ is the multicanonical potential.
  If we want to specify a multicanonical potential (or $W$ function)
  in DynamO, we must do so using a stepped function. Each step has the
  same width and is centered around an energy value. The width of all
  steps is set using the <b>EnergyStep</b> attribute of
  the <b>PotentialDeformation</b> tag. The energy and $W$ value of
  each step is specified in a list of <b>W</b> tags inside
  the <b>PotentialDeformation</b> tag. If there is no step specified
  for an energy, its $W$ value is automatically assumed to be zero.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<Dynamics Type="NewtonianMC">
  <PotentialDeformation EnergyStep="0.01">
    <W Energy="0" Value="-8.16128284222000e+02"/>
    <W Energy="-18" Value="-5.39112459746000e+02"/>
    ...
  </PotentialDeformation>
</Dynamics>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"NewtonianMC"</i> to select this Dynamics type.
  </li>
  <li>
    <b>PotentialDeformation</b> <i>(tag)</i>: This tag encloses the
    stepped deformation potential used in the multicanonical
    simulation.
    <ul>
      <li>
	<b>EnergyStep</b> <i>(attribute)</i>: The width of each
	deformation potential step.
      </li>
      <li>
	<b>W</b> <i>(tag)</i>: This tag contains the location of the
	deformation potential step and its $W$ value.
	<ul>
	  <li>
	    <b>Energy</b> <i>(attribute)</i>: The centre energy of the
	    deformation energy step.
	  </li>
	  <li>
	    <b>Value</b> <i>(attribute)</i>: The $W$ value of the
	    deformation energy step.
	  </li>
	</ul>
      </li>
    </ul>
  </li>
</ul>
<h1><a id="property"></a>Property</h1>
<p>
  Property tags are a mechanism which allows you to specify large
  amounts of information which may or may not vary on a per-particle
  basis. For example, if every Particle in the system is
  a <a href="#typehardsphere">HardSphere type Interaction</a> with the
  same diameter of 1.5, you might use the following Interaction:
</p>
<?php codeblockstart();?>
<Interaction Type="HardSphere" Diameter="1.5" Elasticity="1" Name="Bulk">
  <IDPairRange .../>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
  The values of the <i>Diameter</i> and <i>Elasticity</i> are called
  a <i>numeric</i> properties where the value of the property
  specifier is the value of the property. But what if you want a
  polydisperse system, where each particle may have a unique mass and
  diameter? In this case we would use <i>named Properties</i>:
</p>
<?php codeblockstart();?>
<Interaction Type="HardSphere" Diameter="D" Elasticity="1" Name="Bulk">
  <IDPairRange .../>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we've used the name "D" to refer to a new named
  Property. Whenever DynamO encounters a property specifier, such as
  the Diameter attribute above, and fails to convert it directly into
  a floating-point number due to the presence of letters in its name,
  it assumes that the property is a named property.  This named
  property can also be reused in other property specifiers at the same
  time, such as in a <a href="#typewall">Wall type Local</a>:
</p>
<?php codeblockstart();?><Local Type="Wall" Name="GroundPlate" Elasticity="1" Diameter="D">
  ...
</Local><?php codeblockend("brush: xml;"); ?>
<p>
  And now both the Wall Local and the HardSphere Interaction will use
  the same diameter for each particle. Each named Property must be
  defined in the Properties tag in the configuration file. For
  example, if we wanted to define the mass and diameter of each
  particle individually, we would define two "PerParticle" Properties
  like so:
</p>
<?php codeblockstart();?>
<Properties>
  <Property Type="PerParticle" Name="D" Units="Length"/>
  <Property Type="PerParticle" Name="M" Units="Mass"/>
</Properties>
<?php codeblockend("brush: xml;"); ?>
<p>
  You should note that the units of the Property must correspond to
  the units of the property specifier. If you check
  the <a href="#typehardsphere">HardSphere Interaction</a>
  documentation, you can confirm that the Diameter attribute has units
  of Length (The available units
  include <b>Dimensionless</b>, <b>Length</b>, <b>Area</b>, <b>Volume</b>, <b>Time</b>, <b>Mass</b>,
  and <b>Energy</b>). 
<p>
  We can use a named property in the <a href="#typepoint">Species
  definition</a> to use this new per-particle mass:
</p>
<?php codeblockstart();?><Species Mass="M" Name="Bulk" Type="Point">
  ...
</Species><?php codeblockend("brush: xml;"); ?>
<p>
  Once the per-particle Property has been defined and referred to in
  other parts of the configuration file, you must specify the value of
  the property for each particle. This is done by adding an attribute
  to the <a href="#pt">Pt (particle) tags</a> with the same name as
  the property. For example:
</p>
<?php codeblockstart();?><Pt ID="0" M="1.11" D="0.323451">
  <P .../>
  <V .../>
</Pt>
<?php codeblockend("brush: xml;"); ?>
<p>
  At the moment, there is only the PerParticle type of named property,
  and every single particle must have the corresponding property
  attribute (in the example above, each <b>Pt</b> tag must have
  a <b>D</b> and <b>M</b> attribute).
</p>
<h1><a id="pt"></a>Pt (Particle)</h1>
<p>
  <b>Description:</b> A <b>Pt</b> or Particle tag represents the
  unique data of a single particle. Each particle must have at least a
  position and velocity tag, but it may also include additional
  attributes and tags corresponding
  to <a href="#property">Properties</a>.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><Pt ID="0">
  <P x="1.71513720091304e+00" y="5.49987913872954e+00" z="4.32598642635552e+00"/>
  <V x="1.51174422678297e+00" y="-8.06881217863154e-01" z="-8.11332120569972e-01"/>
</Pt>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>ID</b> <i>(attribute)</i>: DynamO loads and assigns ID's to
    particles in the order in which they appear in the configuration
    file. This tag is therefore not read by DynamO, but is provided
    in generated configuration files to make it easy to identify
    particles.
  </li>
  <li>
    <b>P</b> <i>(tag)</i>: This tag contains the position of the
    particle. In systems with periodic boundary conditions, the
    dynamod/dynarun commands will output the position of the
    particle image which is in the primary image (the "wrapped"
    particle position).  This behaviour may be disabled using
    the <i>--unwrapped</i> option of the dynamod and dynarun
    commands (the particle positions correspond to the initial
    particle image's final location).
    <ul>
      <li>
	<b>x</b> <i>(attribute)</i>: The particles $x$-coordinate.
      </li>
      <li>
	<b>y</b> <i>(attribute)</i>: The particles $y$-coordinate.
      </li>
      <li>
	<b>z</b> <i>(attribute)</i>: The particles $z$-coordinate.
      </li>
    </ul>
  </li>
  <li>
    <b>V</b> <i>(tag)</i>: This tag contains the velocity of the
    particle.
    <ul>
      <li>
	<b>x</b> <i>(attribute)</i>: The $x$-component of the particle velocity.
      </li>
      <li>
	<b>y</b> <i>(attribute)</i>: The $y$-component of the particle velocity.
      </li>
      <li>
	<b>z</b> <i>(attribute)</i>: The $z$-component of the particle velocity.
      </li>
    </ul>
  </li>
</ul>
<h1><a id="potential"></a>Potential</h1>
<p>
  The Potential tag represents a collection of discontinuities and
  energies which make up a stepped potential. The location of these
  steps may be manually entered using
  the <a href="#typesteppedpotential">"Stepped" type</a> or
  automatically generated, such as in
  the <a href="#typelennardjonespotential">Lennard-Jones type</a>.
</p>
<h2><a id="typesteppedpotential"></a>Type="Stepped"</h2>
<p>
  <b>Description:</b> This Potential type allows a stepped potential
  to be directly entered in. This is the most general stepped
  potential available, but requires manual entry of the potential.
</p>
<p>
  <b>Example Usage:</b> An implementation of the sixth hand stepped
  approximation of the Lennard-Jones potential reported
  by <a href="http://link.aip.org/link/doi/10.1063/1.456811">Chapela
  et al. (1989)</a>:
</p>
<?php codeblockstart();?>
<Potential Type="Stepped" Direction="Left">
  <Step R="2.3" E="-0.06"/>
  <Step R="1.75" E="-0.22"/>
  <Step R="1.45" E="-0.55"/>
  <Step R="1.25" E="-0.98"/>
  <Step R="1.05" E="-0.47"/>
  <Step R="1.0" E="0.76"/>
  <Step R="0.95" E="3.81"/>
  <Step R="0.9" E="10.95"/>
  <Step R="0.85" E="27.55"/>
  <Step R="0.80" E="66.74"/>
  <Step R="0.75" E="1.0e+300"/>
</Potential>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Stepped"</i> to select this Dynamics type.
  </li>
  <li>
    <b>Direction</b> <i>(attribute)</i>: This sets the direction of
    the stepping.
    <br/>
    For example, for potentials which have zero
    interaction energy at long distances, the "Left" direction is the
    most convenient. The Lennard-Jones potential is an example of such
    a potential. In this case, each <b>Step</b> tag specifies a
    location of a discontinuity and the energy on its left hand side
    ($r^-$). The outermost step is assumed to have an energy of zero.
    <br/>
    A spring potential is an example where the "Right" direction
    is most convenient as it has zero interaction energy at $r=0$. In
    this case, each <b>Step</b> tag specifies a location of a
    discontinuity and the energy on its right hand side ($r^+$). The
    innermost step has a energy of zero
  </li>
  <li>
    <b>Step</b> <i>(tag)</i>: This tag represents a single
    discontinuity/step of the stepped potential. On load these steps
    are sorted by their <b>R</b> value.
    <ul>
      <li>
	<b>R</b> <i>(attribute)</i>: The radial separation of the
	discontinuity.
      </li>
      <li>
	<b>E</b> <i>(attribute)</i>: The energy of the potential on
	either the left or right hand side of the discontinuity
	(depending on the Direction).
      </li>
    </ul>
  </li>
</ul>
<h2><a id="typelennardjonespotential"></a>Type="LennardJones"</h2>
<h1><a id="idrange"></a>IDRange</h1>
<p>
  <b>IDRange</b>s are used to specify a range
  of <a href="#pt">Particle</a> IDs. These are used in
  <a href="#species">Species</a>, <a href="#local">Local</a>, <a href="#global">Global</a>
  and <a href="#topology">Topology</a> objects to specify the set of
  particles to which they apply.
</p>
<h2>Type="All"</h2>
<p>
  <b>Description:</b> An ID Range which maps to all particles in the
  simulation.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<IDRange Type="All"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the value <i>"All"</i>
    to select this range type.
  </li>
</ul>
<h2>Type="None"</h2>
<p>
  <b>Description:</b> An ID Range which does not map to any particles.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><IDRange Type="None"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"None"</i> to select this range type.
  </li>
</ul>
<h2>Type="Ranged"</h2>
<p>
  <b>Description:</b> An ID Range which maps to a sequential list of
  particles simulation. The range is inclusive (both its start and end
  points are inside the range).
</p>
<p>
  <b>Example Usage:</b>
</p>
<p>
  The following example <b>IDRange</b> includes the particle IDs 0, 1,
  2, 3, 4, and 5.
</p>
<?php codeblockstart();?><IDRange Type="Ranged" Start="0" End="5"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Ranged"</i> to select this range type.
  </li>
  <li>
    <b>Start</b> <i>(attribute)</i>: The lowest value ID which is
    inside the range.
  </li>
  <li>
    <b>End</b> <i>(attribute)</i>: The highest value ID which is
    inside the range.
  </li>
</ul>
<h2>Type="List"</h2>
<p>
  <b>Description:</b> An ID Range which maps to a specified list of
  particles. This is the most general type of Range possible, as all
  IDs inside the range must be specfied individually.
</p>
<p>
  <b>Example Usage:</b>
</p>
<p>
  The following example <b>IDRange</b> includes the particle IDs
  0, 2, and 5.
</p>
<?php codeblockstart();?><IDRange Type="List">
  <ID val="0"/>
  <ID val="2"/>
  <ID val="5"/>
</IDRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"List"</i> to select this range type.
  </li>
  <li>
    <b>ID</b> <i>(tag)</i>: A tag containing an ID/entry in the
    list.
    <ul>
      <li>
	<b>val</b> <i>(attribute)</i>: The ID of the entry.
      </li>
    </ul>
  </li>
</ul>
<h2>Type="Union"</h2>
<p>
  <b>Description:</b> An IDRange which combines several IDRanges into
  one.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><IDRange Type="Union">
  <IDRange .../>
  <IDRange .../>
  ...
</IDRange><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Union"</i> to select this range type.
  </li>
  <li>
    <b>IDRange</b> <i>(tag)</i>: A list of IDrange subtags which
    describe the IDRanges to be combined.
  </li>
</ul>
<h1><a id="idpairrange"></a>IDPairRange</h1>
<p>
  <b>IDPairRange</b>s are used to specify the pairs of particles to
  which an <a href="#interaction">Interaction</a> applies. Each IDPairRange represent a
  collection or set of ID pairs.
</p>
<h2>Type="All"</h2>
<p>
  <b>Description:</b> An ID Range which maps to all pairs of particles
  in the simulation.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><IDPairRange Type="All"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the value <i>"All"</i>
    to select this range type.
  </li>
</ul>
<h2>Type="None"</h2>
<p>
  <b>Description:</b> An ID Range which doesn't map to any pair of
  particles.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><IDPairRange Type="None"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"None"</i> to select this range type.
  </li>
</ul>
<h2><a id="typepair"></a>Type="Pair"</h2>
<p>
  <b>Description:</b> This creates a IDPairRange from two
  IDRanges. Each particle ID in the first range is paired with all of
  the particle IDs in the second range. Pairs of particle IDs which
  only match one range are not included in the pair range.
</p>
<p>
  <b>Example Usage:</b> This example pairs particle IDs 0,1,2 with IDs
  3,4,5. Pairs only within one range, such as (0,1) or (3,4), are not
  included. All IDRangePairs are symmetric, so both (1,4) and (4,1)
  are included in this example range.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Pair">
  <IDRange Type="Ranged" Start="0" End="2"/>
  <IDRange Type="Ranged" Start="3" End="5"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Pair"</i> to select this range type.
  </li>
  <li>
    <b>IDRange</b> <i>($2\times$tag)</i>: There must be two IDRange tags
    present and each specifies one of the IDRanges used to make the
    IDPairRange. The order in which the IDRanges are specifed is
    unimportant. See the <a href="#idrange">section on the available
      IDRange types</a> for more information.
  </li>
</ul>
<h2><a id="typesingle"></a>Type="Single"</h2>
<p>
  <b>Description:</b> This creates a IDPairRange from one
  IDRange. Every particle ID in the IDRange is paired with every other
  particle in the IDRange.
</p>
<p>
  <b>Example Usage:</b> This example pairs particle IDs 0-0, 0-1, 0-2, 1-1, 1-2, and 2-2.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Single">
  <IDRange Type="Ranged" Start="0" End="2"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Single"</i> to select this range type.
  </li>
  <li>
    <b>IDRange</b> <i>(tag)</i>: See
    the <a href="#idrange">section on the available IDRange
      types</a> for more information.
  </li>
</ul>
<h2><a id="typeself"></a>Type="Self"</h2>
<p>
  <b>Description:</b> This creates a IDPairRange from one
  IDRange. Every particle ID in the IDRange is paired with itself.
</p>
<p>
  <b>Example Usage:</b> This example pairs particle IDs 0-0, 1-1, and 2-2.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Self">
  <IDRange Type="Ranged" Start="0" End="2"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Self"</i> to select this range type.
  </li>
  <li>
    <b>IDRange</b> <i>(tag)</i>: See
    the <a href="#idrange">section on the available IDRange
      types</a> for more information.
  </li>
</ul>
<h2>Type="List"</h2>
<p>
  <b>Description:</b> This is the most versatile IDPairRange available
  as it allows you to specify the particle pairings individually.
</p>
<p>
  <b>Example Usage:</b> This example matches the particle pairings
  (0,1), (1,2), and (2,3). As IDPairRanges are symmetric, the pairings
  (1,0), (2,1), and (3,2) are also included. This example might be
  used to bond particles together into a chain.
</p>
<?php codeblockstart();?>
<IDPairRange Type="List">
  <IDPair ID1="0" ID2="1"/>
  <IDPair ID1="1" ID2="2"/>
  <IDPair ID1="2" ID2="3"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"List"</i> to select this range type.
  </li>
  <li>
    <b>IDPair</b> <i>(tag)</i>: Each IDPair tag specifies one
    pairing of particle IDs.
    <ul>
      <li>
	<b>ID1</b> <i>(attr)</i>: The first ID of the pair. The
	order of the IDs is unimportant and DynamO always writes the
	configuration out so that ID1 is the lowest of the pair.
      </li>
      <li>
	<b>ID2</b> <i>(attr)</i>: The second ID of the pair.
      </li>
    </ul>
  </li>
</ul>
<h2>Type="Union"</h2>
<p>
  <b>Description:</b> This creates a IDPairRange from a
  combination/union of several IDPairRanges.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?>
<IDPairRange Type="Union">
  <IDPairRange .../>
  <IDPairRange .../>
  ...
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Union"</i> to select this range type.
  </li>
  <li>
    <b>IDPairRange</b> <i>(tag)</i>: Each IDPairRange sub tag
    represents one of the IDPairRanges to be combined.
  </li>
</ul>
<h2>Type="Chains"</h2>
<p>
  <b>Description:</b> This IDPairRange is provided as a convenient way
  to bond sequential particle IDs into linear chains.
</p>
<p>
  <b>Example Usage:</b> If the example below was used with
  a <a href="#typesquarebond">square-bond Interaction</a>, it would
  bond a set of particles together into chains of 4.
  
  This example matches the particle pairings (0,1), (1,2), (2,3) and
  (4,5), (5,6), (6,7). As IDPairRanges are symmetric, the pairings
  (1,0), (2,1), etc. are also included.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Chains" Start="0" End="7" Interval="4"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Type</b> <i>(attribute)</i>: Must have the
    value <i>"Chains"</i> to select this range type.
  </li>
  <li>
    <b>Start</b> <i>(attribute)</i>: The first ID of the sequential
    particle IDs.
  </li>
  <li>
    <b>End</b> <i>(attribute)</i>: The last ID of the sequential
    particle IDs.
  </li>
  <li>
    <b>Interval</b> <i>(attribute)</i>: How long the chains
    are. Please note that End - Start must be a whole multiple of
    Interval.
  </li>
</ul>
