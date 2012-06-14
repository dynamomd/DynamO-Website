<?php 
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 2: Example output.xml file";
   ?>
<?php codeblockstart(); ?><?xml version="1.0"?>
<OutputData>
  <Misc>
    <Density val="0.5"/>
    <PackingFraction val="0.261799387799154"/>
    <SpeciesCount val="1"/>
    <ParticleCount val="1372"/>
    <Temperature Mean="0.99999999999997" MeanSqr="0.999999999999985" Current="1.00000000000001"/>
    <UConfigurational Mean="0" MeanSqr="0" Current="0"/>
    <ResidualHeatCapacity Value="0"/>
    <Pressure Avg="1.63550973282348">
      <Tensor>
	1.63671533938513 2.01129023746515e-05 -0.00157158738399153 
	2.01129023746491e-05 1.63219996522308 -0.00168279131744163 
	-0.00157158738399152 -0.00168279131744163 1.63761389386222 
      </Tensor>
    </Pressure>
    <Duration Events="1000000" OneParticleEvents="0" TwoParticleEvents="1000000" Time="189.607937271031"/>
    <Timing Start="Fri May 25 17:27:42 2012 " End="Fri May 25 17:27:50 2012 " EventsPerSec="119270.140411462" SimTimePerSec="22.6145661537722"/>
    <PrimaryImageSimulationSize x="14" y="14" z="14"/>
    <Total_momentum x="2.40918396343659e-13" y="1.26565424807268e-14" z="-1.30340183090993e-13"/>
    <totMeanFreeTime val="0.130071044967927"/>
    <NegativeTimeEvents Count="0"/>
    <Memusage MaxKiloBytes="32628"/>
  </Misc>
</OutputData>
<?php codeblockend("brush: xml;"); ?>
