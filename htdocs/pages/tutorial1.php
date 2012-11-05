<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 1: Compiling and Installing DynamO";
   ?>
<?php printTOC(); ?>
<p>
  This tutorial covers the requirements, compilation and installation
  of the DynamO simulation package. It is recommended that you build
  your own version of DynamO if you want to make changes or plan to
  add new features to DynamO.
</p>
<p>
  If you've already installed DynamO using the prebuilt packages, you
  can skip straight to tutorial 2.
</p>
<?php button("Tutorial 2: Running a Simulation of Hard Spheres","/index.php/tutorial2");?>
<h1>Step 0: Build Requirements</h1>
<p>
  Before you can build DynamO, you will need a compiler and several
  other programs and libraries installed. There are also several
  optional libraries which, if they're installed, will activate extra
  features such as saving visualisations directly to video, or
  wii-remote head tracking.
</p>
<h2>Essential Libraries</h2>
<p>
  These programs and libraries <b>must</b> be installed if you want to
  compile DynamO:
</p>
<ul>
  <li>
    <a href="http://gcc.gnu.org">gcc</a>
    and <a href="http://www.gnu.org/software/make/">make</a> - You
    need a compiler and the make build system(<b>Ubuntu</b>:
    build-essential).
  </li>
  <li>
    <a href="http://www.boost.org/">Boost Libraries</a> - DynamO uses
    many of the boost libraries (program_options, iostreams,
    filesystem, math) and it is easiest to install them all (<b>Ubuntu
    Package</b>: libboost-all-dev).
  </li>
  <li>
    <a href="http://www.boost.org/boost-build2/">Boost Build</a> - DynamO uses the
    boost build system to manage the compilation, this is usually
    included with the boost libraries (<b>Ubuntu Package</b>:
    libboost-dev, but it will be pulled in by the libboost-all-dev
    above).
  </li>
</ul>
<h2>Visualiser Requirements</h2>
<p>
  These programs and libraries only need to be installed if you want
  to use the visualiser (called Coil) supplied with DynamO:
</p>
<ul>
  <li><a href="http://www.gtkmm.org/">Gtkmm</a> (<b style="font-size:
    16px;">Ubuntu Package</b>: libgtkmm-2.4-dev).
  </li>
  <li>
    <a href="http://freeglut.sourceforge.net/">Freeglut</a> (<b>Ubuntu
    Package</b>: freeglut3-dev).
  </li>
  <li>
    <a href="http://glew.sourceforge.net/">GLEW</a> version 1.6+ (<b>Ubuntu Package</b>: libglew1.6-dev).
  </li>
  <li>
    <a href="http://www.khronos.org/opencl/">OpenCL Headers</a> -
    OpenCL is a new parallel programming paradigm, and the visualiser
    uses it to process data during rendering (<b>Ubuntu Packages</b>: opencl-headers).
  </li>
  <li>
    <a href="http://www.khronos.org/opencl/">OpenCL Library</a> - An
    OpenCL library is provided with the latest AMD and NVidia binary
    graphics card drivers. You will need a relatively modern graphics
    card to use the visualiser too. (<b>Ubuntu Packages</b>: fglrx
    (AMD) <i>OR</i> nvidia-current (NVidia)).
  </li>
  <li>
    <a href="http://ffmpeg.org/">libavcodec</a> - (Optional) Allows
    you to record visualisations directly to a movie file. This may be
    supplied by your systems FFMPEG package (<b>Ubuntu Package</b>:
    libavcodec-dev).
  </li>
</ul>
<h1>Step 1: Downloading</h1>
<p>
  Take a look at the download page for full instructions on how to
  download a copy of the DynamO source code. Once you have the source
  code, change into the directory ready to start the build. 
</p>
<p>
  The recommended method is to use git to download the source, which
  would look like this:
</p>
<?php codeblockstart(); ?>git clone https://github.com/toastedcrumpets/DynamO.git
cd DynamO<?php codeblockend("brush: shell;"); ?>
<h1>Step 2: Compilation</h1>
<p>
  DynamO uses the modern, powerful, but quite complicated boost-build
  system. Using the boost build system takes some getting used to;
  however, to make it easy to build DynamO there is a wrapper Makefile
  included in the sources.
</p>
<p>
  Building DynamO is then as straightforward as running the make
  command:
</p>
<?php codeblockstart(); ?>make<?php codeblockend("brush: shell;"); ?>
<p>
  This step can take a while as there are hundreds of source files to
  compile.
</p>
<p>
  If there are any errors, they are often due to missing build
  dependencies. Dynamo automatically checks if it can find the
  dependencies it needs to build. The list of tests should look like
  this (they may be in any order):
</p>
<?php codeblockstart(); ?>Performing configuration checks

    - DynamO: Boost headers    : yes
    - DynamO: Boost system library : yes
    - DynamO: Boost filesystem library : yes
    - DynamO: Boost program options library : yes
    - DynamO: Boost iostreams library : yes
    - Magnet: libavcodec (video encoding support) : yes
    - Coil: Gtkmm              : yes
    - Coil: OpenCL libraries and headers : yes
    - Coil: GLEW (v1.6+)       : yes
    - Coil: GLUT               : yes
    - Coil: libCwiid Wii-mote support (Optional) : no
    - DynamO-Coil Integration  : yes
...patience...
<?php codeblockend("brush: plain;"); ?>
<p>
  If you are missing any of the boost libraries, then DynamO won't
  build at all. If you are missing any of Coil's dependencies you will
  see [DynamO-Coil Integration : <b>no</b>]; however, DynamO will
  still build but without the visualizer support (the dynavis program
  will be missing).
</p>
<p>
  If you still have errors, take a look at the
  <a href="/index.php/documentation">documentation</a> to find ways of
  filing a bug report and how to contact the developers.
</p>
<h1>Step 3: Installation</h1>
<p>
  Once the compilation has been successfully completed, everything you
  need to use DynamO should be in the <em>bin</em> sub-directory.
</p>
<p>
  You can now install DynamO into your system (<em>/usr/bin</em>) using the
  following command.
</p>
<?php codeblockstart(); ?>sudo make install<?php codeblockend("brush: shell;"); ?>
<p>
  (Advanced users can copy the contents of <em>DynamO/bin</em>
  wherever they like, or add it to their PATH variable, or just run
  the executables from where they are)
</p>
<p>
  Congratulations! You now have a working installation of DynamO. You
  can now move on to the next tutorial!
</p>
<?php button("Tutorial 2: Running a Simulation of Hard Spheres","/index.php/tutorial2");?>

<h1>Appendix A: Updating</h1>
<p>
  This covers how to update using Git, which you might choose to do if
  you have made changes to the code. Alternatively, you can just
  redownload the code and start again from the top.
</p> 
<p>
  If there has been a major update to the code (change in the version
  of boost used, new dependencies, etc.), you will need to clean up
  the current version of the code by running the following command:
</p>
<?php codeblockstart(); ?>make distclean<?php codeblockend("brush: shell;"); ?>
<p>
  You can then easily update to the latest version of DynamO by just
  running the following commands:
</p>
<?php codeblockstart(); ?>git pull
make
sudo make install<?php codeblockend("brush: shell;"); ?>
<p>
  and you should now have an up-to-date set of executables installed!
</p>
<h1>Appendix B: Debugging Executables</h1>
<p>
  If you're having some trouble with DynamO, you can build a debug
  version of the simulator once a normal version has been built. This
  version is slower than the standard version, but contains many extra
  sanity checks and verbose error reports. To create the debugging
  version just run the following command in the DynamO directory
</p>
<?php codeblockstart(); ?>make debug
sudo make install<?php codeblockend("brush: shell;"); ?>
<p>
  This will install some executables built with debugging symbols and
  extra sanity checks in the <em>bin/</em> directory. These
  executables have the suffix "<em>_d</em>" (dynamod_d and dynarun_d)
  to indicate they're the debugging version.
</p>
