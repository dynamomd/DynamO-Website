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

