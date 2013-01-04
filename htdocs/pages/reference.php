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
  <b>Full Attribute List</b>:
  <ul>
    <li>No additional attributes are available.</li>
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
  <b>Full Attribute List</b>:
  <ul>
    <li>No additional attributes are available.</li>
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
  The following example <b>IDRange</b> includes the particle IDs
  0, 1, 2, 3, 4, and 5.
</p>
<?php codeblockstart();?><IDRange Type="Ranged" Start="0" End="5"/><?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Attribute List</b>:
  <ul>
    <li>
      <b>Start:</b> The first ID in the range.
    </li>
    <li>
      <b>End:</b> The last ID in the range.
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
  <b>Full Attribute List</b>:
  <ul>
    <li>No additional attributes are available.</li>
  </ul>
</p>
<h1>IDPairRange</h1>
<h1>Scheduler</h1>
<h2>Type="Dumb"</h2>
<h2>Type="NeighbourList"</h2>
<h2>Type="SystemOnly"</h2>
<h1>Sorter</h1>
<h1>Species</h1>
<h1>Interaction</h1>
<h1>Local</h1>
<h1>Global</h1>
<h1>Simulation Size</h1>
<h1>Pt (Particle)</h1>
<p>
  A <b>Pt</b> or Particle tag represents the unique data of a single
  particle.
</p>
