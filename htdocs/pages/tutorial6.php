<?php 
   /*Check that this file is being accessed by the template*/
   $mathjax=1;
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 6: Polydispersity, locals (walls), and granular dynamics";
   ?>
<?php printTOC(); ?>
<p style="text-align:center; margin:15px; background-color:#FFD800; font-size:16pt; font-family:sans; line-height:40px;">
  <b>This tutorial is currently being written and is incomplete.</b>
</p>
<p>
  This tutorial introduces the use of polydisperse
  particle <b>Properties</b>, the challenges of granular/dissipative
  interactions in gravity, and how to introduce walls/boundaries into
  a configuration file.
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
