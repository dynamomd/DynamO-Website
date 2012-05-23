<?php 
  $syntaxhighlighter=1;
  pagestart("Tutorial 1: Compiling and Installing DynamO"); 
?>
<p>
  This tutorial covers the requirements, compilation and installation
  of the DynamO simulation package. It is recommended that you build
  your own version of DynamO to keep up with the rapid code
  development and to ensure compatibility with your system.
</p>
<h1>Step 0: Build Requirements</h1>
<p>
  Currently DynamO will only run on <b>Gnu/Linux</b> based
  systems (e.g., Ubuntu/Gentoo/RedHat). You will need to be familiar
  with how to install programs on whichever distribution of Linux you
  are using before you will be able to setup DynamO. 
</p>
<p>
  DynamO, like many Linux programs, is driven through a Command-Line
  Interface (CLI). To be able to use DynamO, you will need to be
  familiar with the terminal of your Linux distribution. Take a look
  at <a href="https://help.ubuntu.com/community/UsingTheTerminal">this
    link</a> to learn more about the terminal and how it works if you are
  at all unsure what this means.
</p>
<p>
  Before you can build DynamO, you will need several programs and
  libraries installed. There are also several optional libraries which,
  if they're installed, will activate extra features. 
</p>
<h2>Required Libraries</h2>
<ul>
  <li>
    <a href="http://www.bzip.org/">libbz2</a> - The output of DynamO
    is compressed for efficiency using this library.
    <br/>(<b>Ubuntu Packages</b>: libbz2-dev).
  </li>
</ul>
<h2>Visualisation Requirements (Optional)</h2>
<ul>
  <li><a href="http://www.gtkmm.org/">Gtkmm</a>
    <br/>(<b style="font-size: 16px;">Ubuntu Package</b>:
    libgtkmm-2.4-dev).
  </li>
  <li>
    <a href="http://freeglut.sourceforge.net/">Freeglut</a>
    <br/>(<b>Ubuntu Package</b>:freeglut3-dev)
  </li>
  <li>
    <a href="http://glew.sourceforge.net/">GLEW</a> (ver 1.6 and
    above) <br/> (<b>Ubuntu Package</b>: libglew1.6-dev)
  </li>
  <li>
    <a href="http://www.khronos.org/opencl/">OpenCL</a> - An OpenCL
    implementation is provided with the latest AMD and NVidia
    graphics card drivers. You will need a relatively modern
    graphics card to use the visualiser too. <br/> (<b>Ubuntu
      Packages</b>: either fglrx-dev (AMD) or nvidia-dev
    (NVidia)).
  </li>
  <li>
    <a href="http://ffmpeg.org/">libavcodec</a> - (Optional) Allows
    you to record visualisations directly to a movie file. This may be
    supplied by your systems FFMPEG package.  <br/> (<b>Ubuntu
    Package</b>: libavcodec-dev)
  </li>
</ul>
<h1>Step 1: Download the Source Code</h1>
<p>
  Use the menu link to the left to download a copy of DynamO. Once you
  have the source code, change into the directory ready to start the
  build. I download the DynamO source code to my home directory, so I
  would type:
</p>
<pre class="brush: shell">cd ~/DynamO</pre>
<h1>Step 2: Compilation and Installation</h1>
<p>
  DynamO uses the modern, powerful, but quite complicated boost-build
  system. Using the boost build system takes some getting used to;
  however, to make it easy to build DynamO there is a fake Makefile
  included in the sources.
</p>
<p>
  Building DynamO is then as straightforward as running the make
  command:
</p>
<pre class="brush: shell">make</pre>
<p>
  This step can take a while, it will download a copy of boost, and
  build DynamO.
</p>
<p>
  If there are any errors, they are often due to missing build
  dependencies. Dynamo automatically checks if it can find the
  dependencies it needs to build. The list of tests should look like
  this (they may be in any order):
</p>
<pre class="brush: plain; highlight: [2, 5, 12];">
Performing configuration checks
    (Required libraries for building DynamO)
    - DynamO: bzip2 library    : yes

    (Tests for building the visualiser)
    - Coil: Gtkmm              : yes
    - Coil: OpenCL lib         : yes
    - Coil: GLEW               : yes
    - Coil: GLUT               : yes
    - DynamO-Coil Integration  : yes

    (Tests for added functionality in the visualiser)
    - Magnet: libavcodec (video encoding support) : yes
    - Coil: libCwiid Wii-mote support (Optional) : yes
</pre>
<p>
  If you are missing the <b>bzip2</b> library, then DynamO won't build
  at all. If you are missing any of Coil's dependencies [DynamO-Coil
  Integration : <b>no</b>] DynamO will still build, but without the
  visualizer support.
</p>
<p>
  If you still have errors, take a look at the
  <a href="/index.php/documentation">documentation</a> to find ways of
  contacting the developers.
</p>
<h1>Step 3: Installing the Executables</h1>
<p>
  Once DynamO compiled successfully the two main exectuables,
  called <em><b>dynamod</b></em>
  and <em><b>dynarun</b></em>, should be in the <em>bin</em>
  directory. You can run these programs from there, or copy them to
  some convenient place. For example, you can look at the help page of
  dynamod by running the following command from the <em>DynamO</em> directory.:
</p>
<pre class="brush: shell">./bin/dynamod --help</pre>
<p>
  You can also install the exectuables into your /usr/bin directory
  (although its not recommended) using the following command.
</p>
<pre class="brush: shell">sudo make install</pre>
<p>
  Congratulations! You now have a working installation of DynamO.
</p>
<h1>Step 4: Updating the Code</h1>
<p>
  This covers how to update using Git, which you might choose to do if
  you have made changes to the code. In other cases, you can just
  redownload the code and start from the top.
</p> 
<p>
  If there has been a major update to the code (change in the version
  of boost used, new dependencies, etc.), you will need to clean up
  the current version of the code by running the following command:
</p>
<pre class="brush: shell">make distclean</pre>
<p>
  You can then easily update to the latest version of DynamO by just
  running the following commands:
</p>
<pre class="brush: shell">git pull
make</pre>
<p>
  (and "<em>sudo make install"</em> if you previously installed it to
  the system).
</p>
<h1>Appendix A: Building Executables for Debugging</h1>
<p>
  If you're having some trouble with DynamO, you can build a debug
  version of the simulator once a normal version has been built. This
  version is slower than the standard version, but contains many extra
  sanity checks and verbose error reports. To create the debugging
  version just run the following command in the DynamO directory
</p>
<pre class="brush: shell">src/boost/bjam -j2 install debug</pre>
<p>
  This will install some executables built with debugging symbols and
  extra sanity checks in the <em>bin/</em> directory. These
  executables have the suffix "<em>_d</em>" (dynamod_d and dynarun_d)
  to indicate they're the debugging version.
</p>
<?php pageend(); ?>
