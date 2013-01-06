<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Configuration File Format Reference";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This reference is currently being written and is incomplete.</b>
</p>
<p>
  In this appendix, a complete description of the file format is
  presented. This reference documentation is terse as an
  <a href="/index.php/tutorial3">introduction to the file format is
  covered in tutorial 3</a>.
</p>
<h1>IDRange</h1>
<p>
  <b>IDRange</b>s are used to specify a range
  of <a href="#pt-particle">Particle</a> IDs. These are used in
  Species, Local, Global and Topology objects to specify the 
  set of particles to which they apply.
</p>
<h2>Type="All"</h2>
<p>
  <b>Description:</b> An ID Range which maps to all particles in the
  simulation.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><IDRange Type="All"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the value <i>"All"</i>
      to select this range type.
    </li>
  </ul>
</p>
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
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the
      value <i>"None"</i> to select this range type.
    </li>
  </ul>
</p>
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
</p>
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
</p>
<h1>IDPairRange</h1>
<p>
  <b>IDPairRange</b>s are used to specify the pairs of particles to
  which an Interaction applies. Each IDPairRange represent a
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
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the value <i>"All"</i>
      to select this range type.
    </li>
  </ul>
</p>
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
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the
      value <i>"None"</i> to select this range type.
    </li>
  </ul>
</p>
<h2>Type="Pair"</h2>
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
</p>
<h2>Type="Single"</h2>
<p>
  <b>Description:</b> This creates a IDPairRange from one
  IDRange. Every particle ID in the IDRange is paired with every other
  particle in the IDRange.
</p>
<p>
  <b>Example Usage:</b> This example pairs particle IDs 0, 1, and 2.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Single">
  <IDRange Type="Ranged" Start="0" End="2"/>
</IDPairRange>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
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
</p>
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
</p>
<h2>Type="Chains"</h2>
<p>
  <b>Description:</b> This IDPairRange is provided as a convenient way
  to bond sequential particle IDs into linear chains.
</p>
<p>
  <b>Example Usage:</b> If the example below was used with a square
  bond Interaction, it would bond a set of particles together into
  chains of 4.
  
  This example matches the particle pairings (0,1), (1,2), (2,3) and
  (4,5), (5,6), (6,7). As IDPairRanges are symmetric, the pairings
  (1,0), (2,1), etc. are also included.
</p>
<?php codeblockstart();?>
<IDPairRange Type="Chains" Start="0" End="7" Interval="4"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
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
</p>
<h1>Scheduler</h1>
<h1>Sorter</h1>
<h1>SimulationSize</h1>
<p>
  <b>Description:</b> The SimulationSize tag specifies the dimensions
  of the primary image for periodic boundary conditions. When the
  system is not periodic, it specifies the size of the tiled
  neighbourlist.
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
</p>
<h1>Species</h1>
<h1>BC</h1>
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
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the
      value <i>"None"</i> to select this BC type.
    </li>
  </ul>
</p>
<h2>Type="PBC"</h2>
<p>
  <b>Description:</b> The "PBC" boundary condition applies periodic
  boundary conditions to every dimension. The positions of the
  particles are wrapped to fit within the primary image, whose
  dimensions are specified by
  the <a href="#simulationsize">SimulationSize</a> tag.
</p>
<p>
  <b>Example Usage:</b>
</p>
<?php codeblockstart();?><BC Type="PBC"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
  <ul>
    <li>
      <b>Type</b> <i>(attribute)</i>: Must have the
      value <i>"PBC"</i> to select this BC type.
    </li>
  </ul>
</p>
<h1>Interaction</h1>
<h1>Local</h1>
<h1>Global</h1>
<h1>Pt (Particle)</h1>
<p>
  <b>Description:</b> A <b>Pt</b> or Particle tag represents the
  unique data of a single particle. Each particle must have at least a
  position and velocity tag, but it may also include additional
  attributes and tags corresponding
  to <a href="#properties">Properties</a>.
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
      commands.
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
</p>
<h1>Properties</h1>
<p>
</p>
