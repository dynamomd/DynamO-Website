<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 4: Binary Systems and Collecting Results";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written, so it may be incomplete or contain errors.</b>
</p>

<p>
For example, we can change the configuration file so that
we have two
<b>Species</b>, each with a different mass:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Genus>
      <Species Mass="1" Name="A" IntName="Bulk" Type="Point" Range="Ranged" Start="0" End="134"/>
      <Species Mass="0.001" Name="B" IntName="Bulk" Type="Point" Range="Ranged" Start="135" End="1371"/>
    </Genus>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  Here we can see that the particles with IDs in the range $[0,134]$
  belong to <b>Species</b> &quot;A&quot; and the particles with IDs in
  the range $[135,13499]$ belong to <b>Species</b> &quot;B&quot;! Both
  <b>Species</b> have the same <b>IntName</b> attribute here, but in true
  binary systems you will probably need different interactions for
  different species.
</p>
<h1>Introduction</h1>
<p>
  When studying a new system, we need to find a convenient way to
  generate configurations across the range of study parameters we wish
  to explore. For example, if we want to study hard spheres we need to
  generate systems at different densities and particle counts.
</p>
<p>
  Many sample configurations, with variable input parameters, can be
  generated using the dynamod tool; However, these example setups only
  cover systems studied by the DynamO developers and will not always
  be what you want.
</p>
<p>
  The recommended method for performing simulations with DynamO is to
  use dynamod to generate a configuration close to what you wish to
  simulate. This configuration can then be modified slightly to
  produce the exact system you wish to study. These changes can easily
  be automated to reduce the manual effort required
  (<a href="/index.php/tutorialA">See Appendix A</a> for more
  information).
</p>
<p>
  So in order to effectively use DynamO, we must have a good
  understanding of it's configuration file format. Then we can take a
  look at the dynamod examples in later tutorials, learn all of the
  different options and how to change them.
</p>

<h1>Blah</h1>
<p>
  When DynamO is testing for a possible interaction between two
  particles, it starts at the top of the list of Interactions and
  moves down until it makes a match. When it makes a match, only this
  Interaction is considered for the generation of events. Thus, the
  Ranges of interactions may overlap, but only one Interaction (the
  first match) will ever be used. An example of this is discussed in
  the next tutorial.
</p>

<h2>Species and Interaction Example: Binary System</h2>
<p>
  As an example of where you can take what we've covered so far, we
  will change our simulation into a two-component system. Take the
  example output file and change the Species and Interaction tags to
  the following values:
</p>
<?php codeblockstart(); ?>
<DynamOconfig version="1.5.0">
  <Simulation>
    ...
    <Genus>
      <Species Mass="1" Name="A" IntName="AAInt" Type="Point" Range="Ranged" Start="0" End="99"/>
      <Species Mass="0.001" Name="B" IntName="BBInt" Type="Point" Range="Ranged" Start="100" End="1371"/>
    </Genus>
    ...
    <Interactions>
      <Interaction Type="HardSphere" Diameter="1" Elasticity="1" Name="AAInt" Range="2Single">
        <SingleRange Range="Ranged" Start="0" End="99"/>
      </Interaction>
      <Interaction Type="HardSphere" Diameter="0.55" Elasticity="1" Name="ABInt" Range="Pair">
        <Range1 Range="Ranged" Start="0" End="99"/>
        <Range2 Range="Ranged" Start="100" End="1371"/>
      </Interaction>
      <Interaction Type="HardSphere" Diameter="0.1" Elasticity="1" Name="BBInt" Range="2All"/>
    </Interactions>
    ...
  </Simulation>
  ...
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<div class="figure" style="float:right;width:337px;">
  <?php embedvideo("binarysystem", "PJPM61SH_BI", 333, 187); ?>
  <div class="caption">
    The example configuration modified so that its a binary system.
  </div>
</div>
<p>
  You can download a pre-changed result using the button below and a
  video of the result is presented to the right:
</p>
<?php button("Example Binary Configuration File","/pages/config.tut4.binary.xml");?>
<p>
  First, we changed the Species tags to create two species, one
  species of 100 relatively heavy particles and the remainder a
  relatively light set of particles:
</p>
<?php codeblockstart(); ?>
<Species Mass="1" Name="A" IntName="AAInt" Type="Point" Range="Ranged" Start="0" End="99"/>
<Species Mass="0.001" Name="B" IntName="BBInt" Type="Point" Range="Ranged" Start="100" End="1371"/>
<?php codeblockend("brush: xml;"); ?>
<p>
  The first 100 particles ($0\to99$ inclusive) of the configuration
  file belong to <b>Species</b> <b>Name</b> <i>A</i> and have
  a <b>Mass</b> of <i>1</i>. The Interaction which represents these
  particles is called <i>AAInt</i>. The rest of the particles
  ($100\to1371$ inclusive) belong
  to <b>Species</b> <b>Name</b> <i>B</i>, with a much
  lower <b>Mass</b> of <i>0.001</i>.
</p>
<p>
  You should note that when defining these species I've been careful
  that each particle belongs to only one species and the Ranges do not
  overlap.
</p>
<p>
  We now also have multiple <b>Interaction</b> tags, each one
  describing an interaction between the different species. For
  example, the first Interaction represents the interaction between
  particles of Species A with other particles of Species A.
</p>
<?php codeblockstart(); ?>
<Interaction Type="HardSphere" Diameter="1" Elasticity="1" Name="AAInt" Range="2Single">
  <SingleRange Range="Ranged" Start="0" End="99"/>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
  This was achieved by using the <i>2Single</i> <b>Range</b>, which
  converts a single <b>Range</b> (stored in the <b>SingleRange</b>
  tag) into a pair Range. Basically, if the first particle and the
  second particle match the SingleRange (i.e., they have ID's in the
  range $[0,99]$), they will use this interaction. You can see that
  Species A interacts with itself with a diameter of <i>1</i>.
</p>
<p>
  The next Interaction accounts for the interactions between
  Species <i>A</i> and Species <i>B</i>.:
</p>
  <?php codeblockstart(); ?>
<Interaction Type="HardSphere" Diameter="0.55" Elasticity="1" Name="ABInt" Range="Pair">
  <Range1 Range="Ranged" Start="0" End="99"/>
  <Range2 Range="Ranged" Start="100" End="1371"/>
</Interaction>
<?php codeblockend("brush: xml;"); ?>
<p>
</p>

