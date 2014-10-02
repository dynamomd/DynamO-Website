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
  the <a href="/index.php/download#prebuilt-ubuntu">prebuilt packages</a>,
  you can skip straight to tutorial 2:
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow: Running a simulation of hard spheres","/index.php/tutorial2");?>
<p>
</p>
<h1>Step 0: Build requirements</h1>
<p>
  DynamO is only tested on <b>Gnu/Linux</b> based systems (e.g.,
  Ubuntu/Gentoo/RedHat/Suse). Compilation under Mac and windows is
  under development.
</p>
<p>
  To build DynamO you will need a compiler, CMake, and several other
  libraries installed. There are also several optional dependencies
  which, if they're installed, will activate extra features. The
  minimum requirements are <b>git</b>, <b>cmake</b>, and the <b>boost
  libraries</b>. For the visualiser to compile, you
  need <b>freeglut</b>, <b>GLEW</b>, and <b>gtkmm-2.4</b>. For your
  convenience, commands to install these packages on Debian,
  RedHat-based, and OpenSUSE distributions are given below.
</p>
<h2>Ubuntu</h2>
<p>
  On <b>Ubuntu</b> versions 12.04 and above, you can install the minimum dependencies
  using the following command:
</p>
<?php codeblockstart(); ?>sudo apt-get install git build-essential cmake libboost-all-dev<?php codeblockend("bash"); ?>
<p>
  And the optional packages with this command:
</p>
<?php codeblockstart(); ?>apt-get install libjudy-dev libgtkmm-2.4-dev freeglut3-dev libavcodec-dev libglew1.6-dev<?php codeblockend("bash"); ?>
<p>
  Now you can continue to <a href="#step1">step 1</a>.
</p>
<h2>CentOS/Red Hat Enterprise Linux (RHEL)/Scientific Linux 6</h2>
<p>
  For older RedHat based distributions (e.g. RHEL 5 or 6), you will
  need to update to a modern compiler (gcc 4.6+) and you will also
  need to install an up-to-date version of boost. The instructions
  have only been tested on CentOS 6.5.
</p>
<p>
  To install the modern compiler, you will need to install the updated
  developer toolset. For all variants of RedHat, this involves
  installing the developer tool set. Instructions on how to do this
  are listed below for the three main distributions:
</p>
<ul>
  <li><a href="https://access.redhat.com/documentation/en-US/Red_Hat_Developer_Toolset">RedHat Enterprise Linux instructions here.</a></li>
  <li>
    <a href="http://linux.web.cern.ch/linux/devtoolset/">Scientific Linux instructions here.</a>
  </li>
  <li>CentOS 5/6: Become root and type the following commands:
    <?php codeblockstart(); ?>
    wget http://people.centos.org/tru/devtools-1 ... s-1.1.repo -O /etc/yum.repos.d/devtools-1.1.repo
    yum install devtoolset-1.1<?php codeblockend("bash"); ?>
    When you need to activate the updated gcc compiler, simply type this command first:
    <?php codeblockstart(); ?>scl enable devtoolset-1.1 bash<?php codeblockend("bash"); ?>
  </li>
</ul>
<p>
  You can then install the minimum dependencies like so
</p>
<?php codeblockstart(); ?>yum groupinstall "Development Tools"
yum install git cmake bzip2-devel
<?php codeblockend("bash"); ?>
<p>
  You will also need to install an up-to-date version of boost by
  hand, preferably v1.50 or above.
</p>
<p>
  If you are having trouble updating to a modern version of boost,
  please follow <a href="#step1">step 1</a> to download a copy of the
  DynamO source code, then try the instructions
  for <a href="#withboost">installing using a local boost</a>.
</p>
<h2>Red Hat Enterprise/CentOS/Scientific Linux 7</h2>
<p>
  To install the minimum dependencies, use the following two commands:
</p>
<?php codeblockstart(); ?>yum groupinstall "Development Tools"
yum install git cmake boost-devel bzip2-devel
<?php codeblockend("bash"); ?>
<h2>OpenSUSE (13.1)</h2>
<p>
  These instructions have only been tested on OpenSUSE 13.1. To
  install the minimum dependencies, use the following command:
</p>
<?php codeblockstart(); ?>sudo zypper install gcc-c++ cmake libbz2-devel git boost-devel<?php codeblockend("bash"); ?>
<p>
  Now you can continue to <a href="#step1">step 1</a>.
</p>
<h1 id="step1">Step 1: Download the code</h1>
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
<h1 id="withboost">Alternative Step 2:Compiling using a local boost installation</h1>
<p>
  Many HPC resources have up-to-date compilers but out-of-date boost
  installations. In these cases it can be handy to have a way to
  install boost locally, in your own home directory.
</p>
<p>
  First, download the source of the current release of the boost
  library
  from <a href="http://www.boost.org/users/download/">here</a>, and
  extract it. You can do this using the commands below, provided wget
  is installed (it is not installed by default on Mac/OSX systems).
</p>
<?php codeblockstart(); ?>cd ~
wget http://downloads.sourceforge.net/project/boost/boost/1.56.0/boost_1_56_0.tar.gz
tar -xf boost_1_56_0.tar.gz
<?php codeblockend("bash"); ?>
<p>
  Now change into the boost source directory and build only the
  libraries that DynamO needs.
</p>
<?php codeblockstart(); ?>cd ~/boost_1_56_0
./bootstrap.sh --with-libraries=program_options,system,filesystem,iostreams,test
./b2
<?php codeblockend("bash"); ?>
<p>
  Now we can compile DynamO using this local boost
  installation. Change back to the DynamO directory and run the
  following commands:
</p>
<?php codeblockstart(); ?>#Make the build directory
mkdir -p build-dir
#Set up the build pointing to the local boost installation
cd build-dir
export BOOST_ROOT=~/boost_1_56_0/
export BOOST_LIBRARYDIR=~/boost_1_56_0/stage/lib
cmake ../
#begin the compilation
make
<?php codeblockend("bash"); ?>
<h1>Step 3: Installation</h1>
<p>
  Once the compilation has completed, you can install DynamO into your
  system using the following command (you will need to be root).
</p>
<?php codeblockstart(); ?>make install<?php codeblockend("bash"); ?>
<p>
  Alternatively, you may just run the executables from the build
  directory.  Congratulations, you now have a working installation of
  DynamO and can now move on to the next tutorial:
</p>
<?php button("Tutorial 2: Introduction to the DynamO workflow","/index.php/tutorial2");?>
<h1>Testing</h1>
<p>
  DynamO has a test-suite to confirm that the code is functioning as
  expected. You can run the test suite using the make test command:
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
#Create a special build directory for the debug code
cd debug-build-dir
#Set up the build
cmake -DCMAKE_BUILD_TYPE=Debug ..
#Begin the compilation
make
sudo make install<?php codeblockend("bash"); ?>
