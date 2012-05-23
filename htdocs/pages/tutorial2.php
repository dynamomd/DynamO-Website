<?php 
  global $syntaxhighlighter;
  $syntaxhighlighter=1;
  pagestart("Tutorial 2: Running a Simulation (hard spheres)"); 
?>
<p>
  Testing the use of syntaxhighlighter.
</p>
<script type="syntaxhighlighter" class="brush: xml"><![CDATA[
<?xml version="1.0"?>
<DynamOconfig version="1.5.0">
<Simulation lastMFT="1.30409724290073e-01">
<Ensemble Type="NVE"/>
<Scheduler Type="NeighbourList">
<Sorter Type="BoundedPQMinMax3"/>
</Scheduler>
<SimulationSize x="1.40000000000000e+01" y="1.40000000000000e+01" z="1.40000000000000e+01"/>
<BC Type="PBC"/>
<Genus>
<Species Mass="1" Name="Bulk" IntName="Bulk" Type="Point" Range="All"/>
</Genus>
<Topology/>
<SystemEvents/>
<Globals>
]]></script>
<?php pageend(); ?>
