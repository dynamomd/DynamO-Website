<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 6: Polydispersity, locals (walls), granular dynamics,  and a bit of python";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written and is incomplete.</b>
</p>
<p>
  This tutorial introduces the use of polydisperse particles (e.g.,
  Properties), the challenges of granular/dissipative interactions in
  gravity, and how to introduce walls/boundaries into a configuration
  file. It also uses python to ease the generation of configuration
  files.
</p>
<p>
  Given that many concepts are already dealt with in the previous
  tutorials, we'll start to move a little quicker in these
  tutorials.
</p>
<h2><a id="aboutsquarewellfluids"></a>About the system</h2>
<p>
  For this tutorial we will study our first granular
  system. Fundamentally, granular particle systems are distinguished
  from molecular systems through their dissipation of energy. Granular
  systems also usually have complex boundary conditions and include
  gravity as an external force. Examples of granular systems include
  sand piles, mining operations,
  <a href="http://en.wikipedia.org/wiki/Mill_(grinding)">mill/grinding</a>,
  grain hoppers/silos,
  <a href="http://en.wikipedia.org/wiki/Tableting">tableting in
  pharmaceutical/food industries</a>, and so on. It is clear that in
  these systems we must also capture
  the <a href="http://en.wikipedia.org/wiki/Particle-size_distribution">polydispersity</a>
  of the particles. Each particle has a different mass and geometry
  which, in its simplest form, is a variation in diameter.
</p>
<p>
 We are going to simulate a granular system of $N=1372$ polydisperse
 inelastic hard-spheres falling onto a flat ground which is bounded by
 a set of walls. 
</p>
<h1>Creating the configuration</h1>
<p>
  As is usual, we will take a simple base configuration and the
  complexity we need. Starting with a simple hard sphere system:
</p>
<?php codeblockstart(); ?>
dynamod -m0 -d 1.0 -C 7 -o config.hs.xml
<?php codeblockend("bash"); ?>
<p>
  This creates a system of mono-sized spheres in periodic boundary
  conditions. First, we want to add polydispersity to the system. We
  can do this by hand, but we really should learn to automate these
  tedious tasks using a nice language like python. 
</p>
<h2>Adding polydispersity</h2>
<p>
  To add polydispersity to our configuration, we need to use
  the <b>Property</b> tags. For details on exactly how these work,
  please see the <a href="/index.php/reference#property">Property tags
  reference page</a>. Here, we'll just look at what changes we need to
  make. First, we take each particle (Pt) tag in the configuration
  file:
</p>
<?php xmlXPathFile("pages/config.tut6.HS.xml", "//ParticleData", 2,2); ?>
<p>
  And add some attributes which specify its mass and diameter:
</p>
<?php xmlXPathFile("pages/config.tut6.poly.xml", "//ParticleData", 2,2); ?>
<p>
  These attributes are just extra data attached to the particle, the
  names are arbitrary but its convenient to choose "M" for mass and
  "D" for diameter. We need to then tell DynamO it should load these
  attributes by adding definitions of the properties to the Property
  tag:
</p>
<?php xmlXPathFile("pages/config.tut6.poly.xml", "//Properties", 2,3); ?>
<p>
  Here you can see all we've done is tell DynamO there are these
  properties with names "M" and "D", and they have units of mass and
  length respectively.
</p>
<p>
  These attributes will be loaded and saved by DynamO, but they're not
  used in the configuration yet. Lets change the current Interaction:
</p>
<?php xmlXPathFile("pages/config.tut6.HS.xml", "//Interaction"); ?>
<p>
  Here, we can replace the numerical property "1" used in the Diameter
  attribute with "D".
</p>
<?php xmlXPathFile("pages/config.tut6.poly.xml", "//Interaction"); ?>
<p>
  If you check
  the <a href="/index.php/reference#typehardsphere">reference entry
  for HardSphere Interactions</a>, you'll see that the Diameter
  attribute has units of Length. DynamO will check that the same units
  are used when defining the Properties and when they're actually
  used.
</p>
<?php xmlXPathFile("pages/config.tut6.poly.xml", "//Species"); ?>
<h2>Adding polydispersity automatically using python</h2>
<p>
  Of course, with $N=1372$ particles I didn't add the polydisperse
  attributes to each particle by hand. The main reason that DynamO has
  XML configuration files is to allow you to write your own tools to
  build systems in the programming language of your choice. One
  easy-to-use language is python. I achieved everything above using
  the script below:
</p>
<?php codeblockstart(); echo file_get_contents("pages/tut6.py"); codeblockend("python"); ?>
<p>
  Please take a look at the documentation
  on <a href="/index.php/tutorialA">"Parsing Output and Config
  Files"</a> to find out more about how this script works.
</p>
<h1>Adding walls</h1>
