<?php 
   $mathjax=1;
   /*Check that this file is being accessed by the template*/
   if (!isset($in_template))
   {
   header( 'Location: /index.php/404');
   return;
   }
   $pagetitle="Tutorial 1: Compiling DynamO from source";
   $pagetab="Tutorial 1";
   ?>
<?php printTOC(); ?>
<p>
  This tutorial covers the requirements and compilation/installation
  of the DynamO simulation package and its tools.
</p>
<p>
  If you've already installed DynamO using
  the <a href="/index.php/download#prebuilt">prebuilt packages</a>,
  you can skip straight to tutorial 2:
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow: Running a simulation of hard spheres","/index.php/tutorial2");?>
<p>
</p>
<h1>Step 0: Build requirements</h1>
<p>
  DynamO is only tested on <b>Gnu/Linux</b> based systems (e.g.,
  Ubuntu/Gentoo/RedHat/Suse). Compilation under Mac and windows is a
  work in progress.
</p>
<p>
  To build DynamO you will need a compiler, CMake, and several other
  libraries installed. There are also several optional dependencies
  which, if they're installed, will activate extra features. The
  minimum requirements are <b>git</b>, <b>cmake</b>, and the <b>boost
  libraries</b>. For the visualiser to compile, you
  need <b>freeglut</b>, <b>GLEW</b>, and <b>gtkmm-2.4</b>. For your
  convenience, commands to install these packages on Debian and RedHat
  based distributions are given below.
</p>
<h2>Ubuntu/Debian</h2>
<p>
  On <b>Ubuntu/Debian</b>, you can install these dependencies using
  the following command:
</p>
<?php codeblockstart(); ?>sudo apt-get install git build-essential cmake libboost-all-dev<?php codeblockend("bash"); ?>
<p>
  And the optional packages with this command:
</p>
<?php codeblockstart(); ?>apt-get install libjudy-dev libgtkmm-2.4-dev freeglut3-dev libavcodec-dev libglew1.6-dev<?php codeblockend("bash"); ?>
<h2>Red Hat Enterprise/CentOS/Scientific Linux  (6/7)</h2>
<p>
  <b>Notes:</b> For older distributions (e.g. RHEL 6), you will need
  to update to a modern compiler (gcc 4.6+) and you will also need to
  install an up-to-date version of boost. Please search online for how
  to update gcc using the SCL system, and compile/install your own
  copy of boost.
</p>
<p>
  To install the minimum dependencies, use the following two commands:
</p>
<?php codeblockstart(); ?>yum groupinstall "Development Tools"
yum install git cmake boost-devel bzip2-devel 
<?php codeblockend("bash"); ?>
<h1>Step 1: Download the code</h1>
<p>
  You must then download a copy of the source code. The recommended
  method is to use git:
</p>
<?php codeblockstart(); ?>git clone https://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  If this command fails, it could be because you don't have an
  internet connection or you are behind a proxy. You can also try
  using the git protocal:
</p>
<?php codeblockstart(); ?>git clone git://github.com/toastedcrumpets/DynamO.git<?php codeblockend("bash"); ?>
<p>
  Both of these commands create a folder called DynamO with the full
  code inside. Change in to this folder to build the code.
</p>
<?php codeblockstart(); ?>cd DynamO<?php codeblockend("bash"); ?>
<h1>Step 2: Compilation</h1>
<p>
  DynamO uses the CMake build system to handle its compilation. You
  set up the build/compilation in a sub directory like so:
</p>
<?php codeblockstart(); ?>mkdir build-dir
cd build-dir
cmake ..<?php codeblockend("bash"); ?>
<p>
  This last step should take a few seconds while cmake checks the
  setup of your system. If there are any errors, they are typically
  due to missing build dependencies. If you cannot fix these on your
  own, please take a look at the
  <a href="/index.php/support">support section of the site</a> to find
  ways of filing a bug report and how to contact the developers.
</p>
<p>
  Once cmake has finished setting up the build, you need to run make
  to actually compile the code.
</p>
<?php codeblockstart(); ?>make<?php codeblockend("bash"); ?>
<h1>Step 3: Installation</h1>
<p>
  Once the compilation has completed, you can install DynamO into your
  system using the following command (you will need to be root).
</p>
<?php codeblockstart(); ?>make install<?php codeblockend("bash"); ?>
<p>
  Alternatively, you may just run the executables from where they are.
  Congratulations, you now have a working installation of DynamO and
  can now move on to the next tutorial:
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow","/index.php/tutorial2");?>
<p>
  You can also test that everything works by running the test suite
</p>
<?php codeblockstart(); ?>make test<?php codeblockend("bash"); ?>
<h1>Updating</h1>
<p>
  This covers how to update using Git, which you might choose to do if
  you have made changes to the code. Alternatively, you can just
  redownload the code and start again from the instructions above.
</p> 
<p>
  First, you will need to pull any new updates from the git repository:
</p>
<?php codeblockstart(); ?>cd DynamO
git pull<?php codeblockend("bash"); ?>
<p>
  Then you should scrub the old build. This can be done by removing
  the build-dir:
</p>
<?php codeblockstart(); ?>rm -Rf build-dir<?php codeblockend("bash"); ?>
<p>
  Finally, rebuild the code
</p>
<?php codeblockstart(); ?>mkdir build-dir
cd build-dir 
cmake ../
make
sudo make install<?php codeblockend("bash"); ?>
<p>
  and you should now have an up-to-date set of executables installed.
</p>
<h1>Building debugging executables</h1>
<p>
  If you're having some trouble with DynamO, you can build a debug
  version. This version is slower than the standard version, but
  contains many extra sanity checks and verbose error reports. To
  create the debugging version just run the following command in the
  DynamO directory
</p>
<?php codeblockstart(); ?>cd DynamO
mkdir debug-build-dir
cd debug-build-dir
cmake -DCMAKE_BUILD_TYPE=Debug ..
make
sudo make install<?php codeblockend("bash"); ?>
