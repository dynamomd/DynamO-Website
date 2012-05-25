<?php
  global $syntaxhighlighter;
  $syntaxhighlighter=1;
  pagestart("Tutorial 3: Exploring the Configuration Files (sheared inelastic hard spheres)"); 
?>

<h2>2.3. Exploring the configuration file</h2>
<p>
  Lets take a look inside the <em>hardsphere.xml</em> file we just
  generated. You can open this <b>XML file</b> with your favourite
  text editor, or even your web browser. XML files are a modern way
  for storing data and are used in a wide range of applications as
  they're easy for both a human and a computer to understand. If you
  have trouble understanding the general XML format,
  please <a href="http://www.w3schools.com/xml/">take a look at these
  tutorials</a>.
</p>
<p>
  The whole configuration is enclosed within a pair
  of <b>DynamOconfig</b> <em>tags</em>.
</p>
<script type="syntaxhighlighter" class="brush: xml"><![CDATA[
<?xml version="1.0"?>
<DynamOconfig version="1.4.0">
...
</DynamOconfig>
]]></script>
<p>
  We will omit these tags in the following examples and use "..." to
  indicate any XML data we have skipped.
</p>
<p>
  We'll start with the particle data first. At the bottom of the file,
  you should see lots of <b>Pt</b> <em>tags</em> stored inside
  a <b>ParticleData</b> <em>tag</em>:
</p>
<script type="syntaxhighlighter" class="brush: xml"><![CDATA[
<ParticleData>
...
<Pt ID="56">
<P x="-6.50000000000000e+00" y="-2.50000000000000e+00" z="-6.50000000000000e+00"/>
<V x="5.20851366504843e-01" y="-5.38736236641469e-01" z="-1.56915668716473e+00"/>
</Pt>
...
</ParticleData>
]]></script>
<p>
  Each of these <b>Pt</b> <em>tags</em> represent the data of a single
  particle.
</p>
<p>
  Each <b>Pt</b> tag has an <b>ID</b> <em>attribute</em>, which is a
  unique number used to identify the particle, and two
  enclosed <em>tags</em> called <b>P</b>
  and <b>V</b>. The <b>P</b> <em>tag</em> holds the position of a
  particle within the system and the <b>V</b> tag holds the particles
  velocity.
</p>
<p>
  At the top of the file, the actual dynamics of the simulation are
  specified. For example, in the <b>Simulation</b> <em>tag</em> there
  is another <em>tag</em>
  called <b>SimulationSize</b>. Unsurprisingly, this holds the size of
  the simulation domain.
</p>
<script type="syntaxhighlighter" class="brush: xml"><![CDATA[
<SimulationSize x="1.400000000000e+01" y="1.400000000000e+01" z="1.400000000000e+01"/>
]]></script>
<p>
  There are many other <em>tags</em> in the configuration file. For
  example, the <b>BC</b> <em>tag</em> sets the boundary conditions of
  the simulation. The type may be <b>"PBC"</b> for periodic boundary
  conditions or <b>"None"</b> for an infinite system.
</p>
<p>
  If you want to simulate a certain system, it is recommended you take
  the nearest system available in dynamod, then look at other examples
  to understand how to add whatever else you might require. But for
  now, we will just use this starting configuration to run a
  simulation and collect snapshots of the system.
</p>
<h1>3. Running a simulation</h1>
<p>
  Now that we have a configuration, we are ready to run a simulation!
  This is very easy, just run <b>dynarun</b> like so:
</p>
<pre class="brush: shell">dynarun hardsphere.xml -o hardsphere.final.xml -c 1000000</pre>
<p>
  This will use <b>dynarun</b> to calculate the trajectory of
  the <em>hardsphere.xml</em> configuration for a million events
  (<em>-c 1000000</em>) and then write the final configuration
  to <em>hardsphere.final.xml</em>. If you want to run a simulation
  for a certain time (instead of a certain number of events) you just
  run <b>dynarun</b> with the <em>-f</em> option:
</p>
<pre class="brush: shell">dynarun hardsphere.xml -o hardsphere.final.xml -f 200</pre>
<p>
  and this will use <b>dynarun</b> to calculate the trajectory of the
  hardsphere.xml configuration for 200 units of simulation time.
</p>
<p>
  There are many ways to collect data from a DynamO simulation, but
  the most common usage is to take periodic snapshots of the
  system. DynamO has a special command line option for this:
</p>
<pre class="brush: shell">dynarun hardsphere.xml -o hardsphere.final.xml -f 200 --snapshot 20</pre>
<p>
  This will take a snapshot of the system every 20 units of simulation
  time! If you run the command above, you will see you have 10
  snapshots taken:
</p>
<pre class="brush: shell">ls Snapshot.* 
  Snapshot.0.xml.bz2 Snapshot.1.xml.bz2 Snapshot.2.xml.bz2
  Snapshot.3.xml.bz2 Snapshot.4.xml.bz2 Snapshot.5.xml.bz2
  Snapshot.6.xml.bz2 Snapshot.7.xml.bz2 Snapshot.8.xml.bz2
  Snapshot.9.xml.bz2</pre>
<p>
  Congratulations, you've run your first DynamO simulation!
</p>

<?php pageend(); ?>