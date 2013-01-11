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
  In this reference a complete description of the available output
  plugins of DynamO, and how to load them is presented.
</p>
<p>
  Output plugins are routines which can be activated in DynamO to
  collect measurements on the simulation <i>while it is
  running</i>. Although most static/structural properties can be
  measured from the configuration files, dynamical properties must be
  measured using output plugins. There are a wide range of properties
  which can be measured by DynamO, from transport properties
  (viscosity, mutual diffusion, thermal conductivity) to internal
  energy histograms.
</p>
<p>
  All data collected by active output plugins is written into a single
  XML file at the end of a simulation (<i>output.xml.bz2</i> by
  default).
</p>
<p>
  DynamO loads the <a href="#misc-plugin">Misc output plugin</a>
  automatically as it samples a wide range of properties of the system
  which are computationally inexpensive to collect; however, all other
  output plugins must be enabled manually. This is discussed in the
  following section:
</p>
<h1>Loading Plugins</h1>
<p>
  Once you have chosen a plugin to load, you simply add it to the
  dynarun command line using the <i>-L</i> option. For example, to
  load the <a href="#intenergyhist-internal-energy-histogram">internal
  energy histogram plugin</a>, you would run
</p>
<?php codeblockstart(); ?>
dynarun config.xml -c 1000000 -L IntEnergyHist
<?php codeblockend("brush: shell;"); ?>
<p>
  And the <i>output.xml.bz2</i> file generated by this dynarun command
  will now contain a histogram of the internal energy. Many of the
  output plugins can take options and can be set using a colon after
  the plugin name, like so:
</p>
<?php codeblockstart(); ?>
dynarun config.xml -c 1000000 -L IntEnergyHist:BinWidth=0.1
<?php codeblockend("brush: shell;"); ?>
<p>
  If you need to specify multiple options, you must use a comma to
  delimit options. For example, the <a href="#mft-mean-free-time">mean
  free time plugin</a> has two options which can be set like so:
</p>
<?php codeblockstart(); ?>
dynarun config.xml -c 1000000 -L MFT:BinWidth=0.5,Length=100
<?php codeblockend("brush: shell;"); ?>
<p>
  The options and the generated output of all available output plugins
  is detailed below.
</p>
<h1>Plugins</h1>
<p>
  In the following sections, the options and output of each output
  plugin are listed.
</p>
<h2>Misc Plugin</h2>
<p>
  The Misc plugin is loaded automatically and contains properties
  which are relatively cheap to collect. Fortunately, this includes
  the majority of the output which it is possible to collect with
  DynamO. The output tags of the Misc plugin and how they are
  collected are discussed in the following subsections.
</p>
<h3>Density</h3>
<p>
  This tag contains the number of particles divided by the volume of
  the primary image. In non-periodic systems, this value may not have
  any significance as the primary image is not related to the
  dynamics. Effects such as walls reducing the volume of the system
  accessible to a particle are not included in this calculation.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <Density val="0.5"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>val</b> <i>(attribute)</i>: The density of the system.
  </li>
</ul>
<h3>Packing Fraction</h3>
<p>
  This tag contains the volume of all particles divided by the volume
  of the primary image. In non-periodic systems, this value may not
  have any significance as the primary image is not related to the
  dynamics. Effects such as walls reducing the volume of the system
  accessible to a particle are not included in this calculation. The
  volume of each particle is calculated from the representative
  interaction which is specified by the
  particle's <a href="/index.php/reference#species">Species tags</a>.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <PackingFraction val="0.261799387799154"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>val</b> <i>(attribute)</i>: The packing fraction of the system.
  </li>
</ul>
<h3>SpeciesCount</h3>
<p>
  This tag contains the number
  of <a href="/index.php/reference#species">Species</a> in the system.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <SpeciesCount val="1"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>val</b> <i>(attribute)</i>: The number of species in the
    system.
  </li>
</ul>
<h3>ParticleCount</h3>
<p>
  This tag contains the number
  of <a href="/index.php/reference#species">Particles</a> in the
  system.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <ParticleCount val="1372"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>val</b> <i>(attribute)</i>: The number of particles in the
    system.
  </li>
</ul>
<h3>SystemMomentum</h3>
<p>
  This tag contains the current and average momentum of the particles
  in the system. 

  <br/> The averages in this tag are collected exactly (see the
  <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">FAQ
  on exact averages in DynamO</a>) and so this data is not valid
  when <a href="/index.php/reference#typele">Lees-Edwards boundary
  conditions</a> are applied.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <SystemMomentum>
    <Current x="-1.02140518265514e-13" y="3.42226247340705e-14" z="-9.39248678832882e-14"/>
    <Average x="-1.02140518265516e-13" y="3.42226247340696e-14" z="-9.39248678832878e-14"/>
  </SystemMomentum>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Current</b> <i>(tag)</i>: The total momentum of the system at
    the moment the output is written out
    <ul>
      <li>
	<b>x</b>, <b>y</b>, <b>z</b>, <i>(attributes)</i>: The
	components of the current momentum.
      </li>
    </ul>
  </li>
  <li>
    <b>Average</b> <i>(tag)</i>: The time averaged total momentum of
    the system.
    <ul>
      <li>
	<b>x</b>, <b>y</b>, <b>z</b>, <i>(attributes)</i>: The
	components of the average momentum.
      </li>
    </ul>
  </li>
</ul>
<h3>Temperature</h3>
<p>
  This tag contains the temperature of the particles in the
  system. This includes rotational degrees of freedom (if present). As
  with all temperature values in DynamO, the temperature reported is
  effectively the product, $k_B\,T$ (see
  the <a href="/index.php/FAQ#q-what-are-the-units-of-dynamo">FAQ on
  units</a>).

  <br/> The averages in this tag are collected exactly (see the
  <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">FAQ
  on exact averages in DynamO</a>) and so this data is not valid
  when <a href="/index.php/reference#typele">Lees-Edwards boundary
  conditions</a> are applied.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <Temperature Mean="1.00000000000002" MeanSqr="0.999999999999996" Current="1.00000000000001" Min="1.00000000000001" Max="1.00000000000001"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Mean</b> <i>(attribute)</i>: The time-averaged temperature,
    $\left\langle k_B\,T\right\rangle$.
  </li>
  <li>
    <b>MeanSqr</b> <i>(attribute)</i>: The time-averaged square of the
    temperature, $\left\langle k_B^2\,T^2\right\rangle$. This can be
    used to work out the standard deviation of the temperature using
    the following formula: \[\sigma = \sqrt{\left\langle
    k_B^2\,T^2\right\rangle - \left\langle k_B\,T\right\rangle^2}\]
  </li>
  <li>
    <b>Current</b> <i>(attribute)</i>: The value of the temperature,
    $k_B\,T$, at the moment the output is written out.
  </li>
  <li>
    <b>Min</b>, <b>Max</b> <i>(attributes)</i>: The minimum and
    maximum values of the temperature during the simulation.
  </li>
</ul>
<h3>UConfigurational</h3>
<p>
  This tag contains the interaction energy per particle. This is equal
  to the excess internal energy (also known as the configurational
  internal energy).

  <br/> The averages in this tag are collected exactly (see the
  <a href="/index.php/FAQ#q-how-does-dynamo-collect-exact-timeaverages">FAQ
  on exact averages in DynamO</a>) and so this data is not valid
  when <a href="/index.php/reference#typele">Lees-Edwards boundary
  conditions</a> are applied.
</p>
<p>
  <b>Example output</b>:
</p>
<?php codeblockstart();?>
<Misc>
  <UConfigurational Mean="0" MeanSqr="0" Current="0" Min="0" Max="0"/>
</Misc>
<?php codeblockend("brush: xml;"); ?>
<p>
  <b>Full Tag, Subtag, and Attribute List</b>:
</p>
<ul>
  <li>
    <b>Mean</b> <i>(attribute)</i>: The time-averaged configurational
    internal energy, $\left\langle U_{conf.}\right\rangle$.
  </li>
  <li>
    <b>MeanSqr</b> <i>(attribute)</i>: The time-averaged square of the
    configurational internal energy, $\left\langle
    U_{conf.}^2\right\rangle$. This can be used to work out the
    standard deviation of the configurational internal energy using
    the following formula: \[\sigma = \sqrt{\left\langle
    U_{conf.}^2\right\rangle - \left\langle
    U_{conf.}\right\rangle^2}\]
  </li>
  <li>
    <b>Current</b> <i>(attribute)</i>: The value of the
    configurational internal energy, $U_{conf.}$, at the moment the
    output is written out.
  </li>
  <li>
    <b>Min</b>, <b>Max</b> <i>(attributes)</i>: The minimum and
    maximum values of the configurational internal energy during the
    simulation.
  </li>
</ul>
<h2>IntEnergyHist (Internal Energy Histogram)</h2>
<p>
</p>
<h2>MFT (Mean Free Time)</h2>
<p>
</p>
<h2>RadiusGyration</h2>
<p>
</p>
