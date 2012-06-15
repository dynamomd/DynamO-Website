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
<h2>XPath Expressions</h2>
<p>
  The file formats of DynamO are written in XML, which is a convenient
  markup language that is easy for both humans and computers to
  read. There are many excellent XML libraries and tools available out
  there to help you, but there are some general concepts to first
  understand before you can use them. 
  </p>
<p>
  The main piece of information to learn is how to select or specify
  part of an XML file to one of these tools or libraries. The method
  of doing this is typically though XPath expressions. There is an
  excellent
  introduction <a href="http://www.w3schools.com/xpath/default.asp">available
  here</a>, but we'll just quickly cover its basic use now.
</p>
<p>
  We'll take an example XML file and discuss how to select different
  parts of it. In general, a DynamO output file will look something
  like this:
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
  Let us say we wanted to read the number of events the simulation has
  run for. We can specify the Event attribute of the Duration tag
  using the following XPath expression:
</p>
<?php codeblockstart(); ?>/OutputData/Misc/Duration/@Events<?php codeblockend("brush: xpath;"); ?>
<p>
  This XPath expression selects the Event attribute by descending from
  the root tag (<b>OutputData</b>) all the way down to
  the <b>Duration</b> tag, then choosing its Events attribute. We can
  give this xpath expression to whatever XML tool or library we have
  and it will fetch the value of the Event attribute for us. But what
  if we want to search for our tag?
</p>
<p>
  We could write an XPath expression which searches for all Duration
  tags, and selects their Event attributes like so:
</p>
<?php codeblockstart(); ?>//Duration/@Events<?php codeblockend("brush: xpath;"); ?>
<p>
  Notice the double forward slash at the start? It means search
  through the whole document for the node called Duration, then try to
  match the rest of the XPath expression from that starting point. An
  important thing to note is that <b>all</b> Duration tags in the file
  are selected with this expression, but in this case there is only
  one.
</p>
<p>
  What if there are many tags all with the same name? How do we pick
  just one of them? Consider the truncated DynamO configuration file below:
</p>
<?php codeblockstart(); ?><?xml version="1.0"?>
<DynamOconfig version="1.5.0">
  <Simulation>...</Simulation>
  <Properties/>
  <ParticleData>
    <Pt ID="0">
      <P x="-1.11037288097451e+01" y="-1.11037288097451e+01" z="-1.11037288097451e+01"/>
      <V x="-2.95244768899765e+00" y="1.69905035103138e+00" z="-4.36956213342932e-01"/>
    </Pt>
    <Pt ID="1">
      <P x="-9.39546283901511e+00" y="-9.39546283901511e+00" z="-1.11037288097451e+01"/>
      <V x="5.15945424590186e-01" y="5.70316794177150e-03" z="-1.20432656964027e+00"/>
    </Pt>
    <Pt ID="2">
      <P x="-1.11037288097451e+01" y="-9.39546283901511e+00" z="-9.39546283901511e+00"/>
      <V x="4.36297207983260e-01" y="5.85618104960393e-01" z="8.24344277363928e-01"/>
    </Pt>
    <Pt ID="3">
      <P x="-9.39546283901511e+00" y="-1.11037288097451e+01" z="-9.39546283901511e+00"/>
      <V x="3.79648279950273e-01" y="9.10688422856331e-01" z="-8.44297890125311e-01"/>
    </Pt>
    ...
  </ParticleData>
</DynamOconfig>
<?php codeblockend("brush: xml;"); ?>
<p>
  What if we wanted to select all the Pt (particle) tags so we can
  later read their P (position) tags? The following two expressions
  are equivalent and do exactly what we want:
</p>
<?php codeblockstart(); ?>/DynamOconfig/ParticleData/Pt
//Pt<?php codeblockend("brush: xpath;"); ?>
<p>
  So how do we select just one tag out of a whole list of tags? Well,
  the easiest way is to specify its number, like so:
</p>
<?php codeblockstart(); ?>
/DynamOconfig/ParticleData/Pt[1]
//Pt[1]<?php codeblockend("brush: xpath;"); ?>
<p>
  Both of these expressions create a list of Pt tags, then select the
  first one to appear (in this case, the one with and ID attribute of
  0). But what if the tags are out of order and we want to search for
  a tag with a certain ID value? This is where the power of XPath
  expressions becomes apparent:
</p>
<?php codeblockstart(); ?>
/DynamOconfig/ParticleData/Pt[@ID="0"]
//Pt[@ID="0"]<?php codeblockend("brush: xpath;"); ?>
<p>
  Now we're searching for a Pt tag with an ID attribute value of
  0. These square bracket expressions are called predictates and they
  are extremely powerful. For example, we can select the last Pt tag
  using the following XPath expressions:
</p>
<?php codeblockstart(); ?>
/DynamOconfig/ParticleData/Pt[last()]
//Pt[last()]<?php codeblockend("brush: xpath;"); ?>
<p>
  Or we could select the Position tags of all Pt tags with an ID below
  4 using the following XPath expressions:
</p>
<?php codeblockstart(); ?> /DynamOconfig/ParticleData/Pt[@ID<4]/P
//Pt[@ID<4]/P<?php codeblockend("brush: xpath;"); ?>
<p>
  There is a lot more to learn about XPath expressions, but we now
  know enough to access any data we would like to from the output and
  config files of DynamO. 
</p>
<p>
  We will now cover some tools and libraries that let you apply XPath
  expressions to XML documents and to actually discuss some
  interesting examples.
</p>
<h1>Using XMLStarlet</h1>
<p>
  The easiest way to see the effect of XPath expressions on a DynamO
  configuration file is to use
  the <a href="http://xmlstar.sourceforge.net/"><b>xmlstarlet</b></a>
  tool. Its a compact and effective program for rapidly selecting some
  data out of an xml file, and if you are familar with shell scripting
  you will find it very easy to use.
</p>
<h2>Example: Making an XYZ position file</h2>
<p>
  The best way to learn XMLstarlet is through examples. The first is
  how to generate a file with just the positions in it. This file
  format is very popular among the MD community. The way you would
  call xmlstarlet is as follows:
</p>
<?php codeblockstart(); ?>xmlstarlet sel -t -m '//Pt/P' -v '@x' -o ' ' -v '@y' -o ' ' -v '@z' -n config.out.xml<?php codeblockend("brush: shell;"); ?>
<p>
  Breaking this command down, it calls xmlstarlet, places it into
  select mode (sel). Then it starts a template (-t) which is a command
  or action for xmlstarlet to take. The instructions are then:
</p>
<ul>
  <li>
    <b>(-m '/P')</b> Search through the XML file and for each P tag inside a Pt tag:
    <ul>
      <li>
	<b>(-v '@x')</b> Write out the value of the x attribute.
      </li>
      <li>
	<b>(-o ' ')</b> Print a single space
      </li>
      <li>
	<b>(-v '@y')</b> Write out the value of the y attribute.
      </li>
      <li>
	<b>(-o ' ')</b> Print a single space
      </li>
      <li>
	<b>(-v '@z')</b> Write out the value of the z attribute.
      </li>
      <li>
	<b>(-n)</b> Print a new line.
      </li>
    </ul>
  </li>
</ul>
<p>
  You should use shell redirection if you want to send this output to
  a file.
</p>
<h1>Python</h1>
<p> 
  Something
</p>
<?php codeblockstart(); ?>dynamod<?php codeblockend("brush: shell;"); ?>
