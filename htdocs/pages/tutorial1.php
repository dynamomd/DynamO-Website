<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 1: Compiling DynamO from source";
   ?>
<?php printTOC(); ?>
<p>
  This tutorial covers the build requirements, compilation, and
  installation of the DynamO simulation package and its tools. <b>You
  do not need to build your own version of DynamO if you are on
  Ubuntu</b>; however, you need to build your own version of DynamO
  if you want to be able to make changes to the code (to add new
  features to DynamO).
</p>
<p>
  If you've already installed DynamO using
  the <a href="/index.php/download#prebuilt">prebuilt packages</a>, you can
  skip straight to tutorial 2:
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow: Running a simulation of hard spheres","/index.php/tutorial2");?>
<p>
</p>
<h1>Step 0: Build requirements</h1>
<p>
  Currently, DynamO will only compile and run on <b>Gnu/Linux</b>
  based systems (e.g., Ubuntu/Gentoo/RedHat/Suse) and there are no
  plans at this time to create a windows version of DynamO. The code
  should compile with only minor modifications on Mac systems, but
  this has not been tested by the developers.
</p>
<p>
  Before you can build DynamO, you will need a compiler and several
  other programs and libraries installed. There are also several
  optional dependencies which, if they're installed, will activate
  extra features such as saving visualisations directly to video.
</p>
<h2>Essential programs and libraries</h2>
<p>
  These programs and libraries <b>must</b> be installed if you want to
  compile DynamO:
</p>
<ul>
  <li>
    <a href="http://git-scm.com/">git</a> - Git is the version control
    software which you use to download the code. If you cannot install
    this, you can download a source file instead.<br/><b>Ubuntu
    Package</b>: git.
  </li>
  <li>
    <a href="http://gcc.gnu.org">gcc</a>
    and <a href="http://www.gnu.org/software/make/">make</a> - You
    need a compiler and the make build system.<br/><b>Ubuntu Package</b>:
    build-essential.
  </li>
  <li>
    <a href="http://www.boost.org/">Boost Libraries</a> - DynamO uses
    many of the boost libraries (program_options, iostreams,
    filesystem, math) and it is easiest to install them all.<br/><b>Ubuntu
    Package</b>: libboost-all-dev.
  </li>
  <li>
    <a href="http://www.boost.org/boost-build2/">Boost Build</a> -
    DynamO uses the boost build system to manage the compilation and
    it is usually included with the boost libraries.<br/><b>Ubuntu
    Package</b>: libboost-dev, but it will be pulled in by the
    libboost-all-dev above.
  </li>
  <li>
    <a href="http://judy.sourceforge.net/">libJudy</a> (Optional) -
    DynamO uses Judy arrays for storing interaction information. This
    significantly speeds up stepped interactions. <br/><b>Ubuntu
    Package</b>: libjudy-dev.
  </li>
</ul>
<p>
  If you cannot install a recent version of Boost or Boost Build on
  the computer (either due to insufficient user rights or out-of-date
  packages), please see the section on <a href="#with-boost">using a
  local Boost installation</a> below.
</p>
<h2>Visualiser requirements (Optional)</h2>
<p>
  These programs and libraries only need to be installed if you want
  to use the visualiser supplied with DynamO:
</p>
<ul>
  <li>
    <b>OpenGL 3.3+ Graphics Card and Drivers</b>: You will need a
    modern graphics card with support for OpenGL 3.3 or
    higher. Usually, this means using a AMD/ATI or Nvidia card with
    up-to-date drivers.
  </li>
  <li><a href="http://www.gtkmm.org/">Gtkmm</a>:<br/><b>Ubuntu Package</b>: libgtkmm-2.4-dev.
  </li>
  <li>
    <a href="http://freeglut.sourceforge.net/">Freeglut</a>:<br/><b>Ubuntu
    Package</b>: freeglut3-dev.
  </li>
  <li>
    <a href="http://glew.sourceforge.net/">GLEW</a> version 1.6+.<br/><b>Ubuntu Package</b>: libglew1.6-dev.
  </li>
  <li>
    <a href="http://ffmpeg.org/">libavcodec</a> - (Optional) Allows
    you to record visualisations directly to a movie file. This may be
    supplied by your systems FFMPEG package.<br/><b>Ubuntu Package</b>:
    libavcodec-dev.
  </li>
</ul>
<h1>Step 1: Downloading</h1>
<p>
  Take a look at the download page for full instructions on how to
  download a copy of the DynamO source code.  The recommended method
  is to use git to download the source, which would look like this:
</p>
<?php codeblockstart(); ?>git clone https://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  If this command fails, it could be because you don't have an
  internet connection or you are behind a proxy. Please ensure that
  your proxy details are correctly set up in git. If you have an old
  version of git (such as the tom cluster in Manchester), you can try
  using the git protocal using the following command:
</p>
<?php codeblockstart(); ?>git clone git://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  One of the above commands should allow you to download the source
  code so now change into the directory ready to start the build.
</p>
<?php codeblockstart(); ?>cd DynamO<?php codeblockend("bash"); ?>
<h1>Step 2: Compilation</h1>
<p>
  DynamO uses the modern, powerful, but fairly complex boost-build
  system. Using the boost build system takes some getting used to;
  however, to make it easy to build DynamO there is a wrapper Makefile
  included in the sources.
</p>
<p>
  Building DynamO is then as straightforward as running the make
  command:
</p>
<?php codeblockstart(); ?>make<?php codeblockend("bash"); ?>
<p>
  This step will take a while as there are hundreds of source files to
  compile.
</p>
<p>
  If there are any errors, they are often due to missing build
  dependencies. Dynamo automatically checks if it can find the
  dependencies it needs to build. The list of tests should look like
  this (they may be in any order):
</p>
<pre>Performing configuration checks

    - Magnet: OpenCL libraries and headers (optional) : no
    - DynamO: Judy array library (libJudy) : yes
    - DynamO: libbz2 library   : yes
    - DynamO: Boost headers    : yes
    - DynamO: Boost filesystem library : yes
    - DynamO: Boost program options library : yes
    - DynamO: Boost iostreams library : yes
    - Magnet: libavcodec (video encoding support) : yes
    - Coil: Gtkmm              : yes
    - Coil: GLEW (v1.6+)       : yes
    - Coil: GLUT               : yes
    - Coil: libCwiid Wii-mote support (Optional) : yes
    - DynamO-Coil Integration Supported : yes
...patience...</pre>
<p>
  If you are missing any of the boost libraries, then DynamO won't
  build at all. If you are missing any of Coil's dependencies you will
  see <br/>[DynamO-Coil Integration : <b>no</b>]<br/>However, DynamO will
  still build but without the visualizer support (the dynavis program
  will be missing).
</p>
<p>
  If you still have errors, take a look at the
  <a href="/index.php/support">support section of the site</a> to find
  ways of filing a bug report and how to contact the developers.
</p>
<h1>Step 3: Installation</h1>
<p>
  Once the compilation has completed, everything you need to use
  DynamO should be in the <em>bin</em> sub-directory.
</p>
<p>
  You can now install DynamO into your system (<em>/usr/bin</em>) using the
  following command.
</p>
<?php codeblockstart(); ?>sudo make install<?php codeblockend("bash"); ?>
<p>
  Alternatively, you may just run the executables from where they
  are or add the directory <em>DynamO/bin</em> to your PATH variable.
</p>
<p>
  Congratulations! You now have a working installation of DynamO. You
  can now move on to the next tutorial!
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow","/index.php/tutorial2");?>
<h1>Updating</h1>
<p>
  This covers how to update using Git, which you might choose to do if
  you have made changes to the code. Alternatively, you can just
  redownload the code and start again from the instructions above.
</p> 
<p>
  If there has been a major update to the code, you will need to clean
  up the current version of the code by running the following command:
</p>
<?php codeblockstart(); ?>make clean<?php codeblockend("bash"); ?>
<p>
  You can then easily update to the latest version of DynamO by just
  running the following commands:
</p>
<?php codeblockstart(); ?>git pull
make
sudo make install<?php codeblockend("bash"); ?>
<p>
  and you should now have an up-to-date set of executables installed!
</p>
<h1>Building debugging executables</h1>
<p>
  If you're having some trouble with DynamO, you can build a debug
  version. This version is slower than the standard version, but
  contains many extra sanity checks and verbose error reports. To
  create the debugging version just run the following command in the
  DynamO directory
</p>
<?php codeblockstart(); ?>make debug
sudo make install<?php codeblockend("bash"); ?>
<p>
  This will install some executables built with debugging symbols and
  extra sanity checks. These executables have the suffix "<em>_d</em>"
  (dynamod_d and dynarun_d) to indicate they're the debugging version.
</p>
<h1><a id="with-boost"></a>Using a local Boost installation</h1>
<p>
  In some environments it can be difficult to meet the installation
  requirements of DynamO. For example, on HPC resources you usually
  cannot install a recent boost version or install boost build. This
  is because the cluster is a little out-of-date or you are normal
  user and do not have the rights to install software. Fortunately,
  this problem can be worked around as we can install the boost
  libraries and boost build in our home directory. This is known as
  using a local Boost installation.
</p>
<p>
  First, download an up-to-date copy of the boost libraries from
  the <a href="http://www.boost.org/users/download/">main boost
  site</a> into your home directory. At the time of writing this is
  version 1.53. I use the
  <i>wget</i> program to download it from the terminal into my home
  directory on the cluster:
</p>
<?php codeblockstart(); ?>cd ~
wget http://downloads.sourceforge.net/project/boost/boost/1.53.0/boost_1_53_0.tar.bz2<?php codeblockend("bash"); ?>
<p>
  Once it has finished downloading, you need to untar the Boost
  sources into a directory before you can compile them. The following
  command will do the trick.
</p>
<?php codeblockstart(); ?>tar -xjf boost_1_53_0.tar.bz2<?php codeblockend("bash"); ?>
<p>
  You should now have a <i>boost_1_53_0</i> directory in your home
  directory. Just in case you need to upgrade boost in the future, I
  would rename the directory to something more generic:
</p>
<?php codeblockstart(); ?>mv boost_1_53_0 boost<?php codeblockend("bash"); ?>
<p>
  Next we need to build the boost-build system. Change into the boost
  directory and run the <i>bootstrap.sh</i> script:
</p>
<?php codeblockstart(); ?>cd ~/boost
./bootstrap.sh<?php codeblockend("bash"); ?>
<p>
  Once its finished bootstrapping the boost build system, you should
  now have the <i>bjam</i> executable in the current directory. Now
  we're ready to build the boost libraries using the bjam command.
</p>
<?php codeblockstart(); ?>./bjam<?php codeblockend("bash"); ?>
<p>
  If everything goes well, you should have a message informing you
  that the libraries are in <i>stage/lib</i> and the headers are in
  the current directory. If some libraries fail to build, DynamO will
  still probably build just fine as only two compiled boost libraries
  are used. All that remains is to download a copy of DynamO, and use
  boost build to compile it. We have to set some extra variables to
  allow the bjam program we just built to run outside the <i>boost</i>
  directory, and to set up the compiler link and include paths for the
  boost libraries. We can do all of this by using the following
  commands:
</p>
<?php codeblockstart(); ?>cd ~/
git clone https://github.com/toastedcrumpets/DynamO.git
cd ~/DynamO/
BOOST_BUILD_PATH=~/boost/tools/build/v2/ ~/boost/bjam install include=~/boost/ linkflags="-L ~/boost/stage/lib/"<?php codeblockend("bash"); ?>
<p>
  The option <i>link=static</i> and <i>runtime-link=static</i> ensures
  that the boost libraries are linked statically so that you can run
  DynamO even when the boost libraries are not installed (e.g., on
  compute nodes).
</p>
<p>
  If this completes successfully, you should now have a set of dynamo
  executables in the <i>bin</i> subdirectory of the DynamO
  sources. You should be able to run these executables on any node
  too, as the boost libraries are statically linked by default.
</p>
<p>
  <b>Optional</b>: If you want to make these variables permanent you
  can set this all up by adding the commands below to
  your <i>.bashrc</i> file:
</p>
<?php codeblockstart(); ?>export BOOST_BUILD_PATH=~/boost/tools/build/v2/
export CPATH=~/boost/:$CPATH
export LIBRARY_PATH=~/boost/stage/lib/:$LIBRARY_PATH<?php codeblockend("bash"); ?>
<h1>Troubleshooting</h1>
<h2>Configuration checks say No, why?</h2>
<p>
  If you're trying to enable a feature, or simply get the code to
  build you may be stopped by the configuration checks. To figure out
  why a configuration check is failing, take a look
  at <i>build-dir/config.log</i>. This is where the output of each
  configuration check is stored.
</p>
<h2>Running make or bjam gives "rule check-target-builds unknown" error</h2>
<p>
  On some systems, you will get an error like this when you try to
  compile DynamO:
</p>
<?php codeblockstart(); ?>
~/DynamO$ make
### Building release version of DynamO
/home/weinhartt/DynamO/src/dynamo/../magnet/jam/builddep.jam:37: in
builddep.set-feature-on-build
rule check-target-builds unknown in module ../magnet/jam/builddep.
src/dynamo/jamfile:45: in modules.load
<?php codeblockend("bash"); ?>
<p>
  This error is because your boost/bjam installation is too old to
  support the "check-target-builds" feature which DynamO uses to check
  that all of its dependencies are installed. This feature has been in
  boost-build since at least mid-2010, so you will need to
  either <a href="#with-boost">use a local boost installation</a> or
  update to a newer linux release.
</p>
