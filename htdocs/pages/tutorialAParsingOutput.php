<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial A: Parsing Output/Config Files";
   ?>
<p>
  This tutorial is designed to help people interface DynamO with other
  pieces of software, or to write tools to process the results of
  simulations. It demonstrates several ways in which you can parse the
  XML which makes up the configuration and output files, to either
  read out the data you want or to edit and change the configuration
  files.
</p>
<p style="text-align:center;">
  <b>This is not a tutorial on the format of the configuration or
  output files, but on <u>easy ways to read and edit these
  files.</u></b>
</p>
<p>
  The file formats themselves will be covered in more depth in a
  future tutorial.  Before reading this tutorial it would be best to
  already be familiar with how DynamO operates and have a good idea
  what information you'd like to extract.
</p>
<h2>About XML in General</h2>
<p>
  The file formats of DynamO are written in XML, which is a convenient
  markup language that is easy for both humans and computers to
  read. There are many excellent XML libraries and tools available out
  there to help you, but there are some general concepts to first
  understand before you can use them.
</p>
<p>
  In general, a DynamO output file will look something like this:
</p>
<?php codeblockstart(); ?><?xml version="1.0"?>
<OutputData>
  <Misc>
    <Density val="0.5"/>
    <PackingFraction val="0.261799387799154"/>
    <SpeciesCount val="1"/>
    <ParticleCount val="1372"/>
    <Temperature Mean="1" MeanSqr="0.999999999999983" Current="1.00000000000001"/>
    <UConfigurational Mean="0" MeanSqr="0" Current="0"/>
    <ResidualHeatCapacity Value="0"/>
    <Pressure Avg="1.63675534410931">
      <Tensor>
	1.63579652003868 0.00150781121155836 -0.00219599326916204 
	0.00150781121155836 1.63761040787334 0.0014142402702099 
	-0.00219599326916205 0.0014142402702099 1.63685910441592 
      </Tensor>
    </Pressure>
    <Duration Events="1000000" OneParticleEvents="0" TwoParticleEvents="1000000" Time="189.547531133865"/>
    <Timing Start="Thu Jun 14 23:20:27 2012 " End="Thu Jun 14 23:20:32 2012 " EventsPerSec="197261.743069976" SimTimePerSec="37.3904782963859"/>
    <PrimaryImageSimulationSize x="14" y="14" z="14"/>
    <Total_momentum x="2.88657986402541e-14" y="3.99680288865056e-15" z="2.87214696470528e-13"/>
    <totMeanFreeTime val="0.130029606357831"/>
    <NegativeTimeEvents Count="0"/>
    <Memusage MaxKiloBytes="35404"/>
  </Misc>
</OutputData><?php codeblockend("brush: xml;"); ?>
<p>
  When you want to read or edit some part of the document, you need a
  way to specify a path to the tag or attribute you wish to
  read/change. The standard lanuage for doing this is
  called <b>XPath</b>, and there is an excellent
  introduction <a href="http://www.w3schools.com/xpath/default.asp">available
  here</a>. We'll just quickly cover its basic use now.
</p>
<p>
  Let us say we wanted to read the number of events the simulation has
  run for. We can specify the Event attribute of the Duration tag
  using the following XPath expression:
</p>
<?php codeblockstart(); ?>/OutputData/Misc/Duration/@Events<?php codeblockend("brush: plain;"); ?>
<p>
  This XPath expression selects the Event attribute by descending from
  the root tag (<b>OutputData</b>) all the way down to
  the <b>Duration</b> tag, then choosing its Events attribute. But
  what if we want to search for our tag?
</p>
<p>
  We could write an XPath expression which searches for all Duration
  tags, and selects their Event attributes like so:
</p>
<?php codeblockstart(); ?>//Duration/@Events<?php codeblockend("brush: plain;"); ?>
<p>
  Notice the double forward slash at the start? It means search for
  the node, then apply the xpath from that starting point. An
  important thing to note is that all Duration tags in the file are
  selected with this expression.
</p>
<p>
  We now know a little about XPath and can learn more as we go along,
  so we will now cover the XMLstarlet program before moving onto
  libraries in popular programming languages.
</p>
<h1>Shell Scripting (using XMLStarlet)</h1>
<p>
  If you are familiar with shell scripting, you might want to try out
  the <a href="http://xmlstar.sourceforge.net/"><b>xmlstarlet</b></a>
  tool. Its a compact and effective program for rapidly selecting some
  data out of an xml file.
</p>
<p>
</p>
<h1>Python</h1>
<p> 
  Something
</p>
<?php codeblockstart(); ?>dynamod<?php codeblockend("brush: shell;"); ?>
