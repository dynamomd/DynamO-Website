<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('Europe/London');

function pagestart($title)
 {
  global $pagetitle, $in_template;
  /*Check that this file is being accessed by the template*/
  if (!isset($in_template))
  {
   header( 'Location: /index.php/404');
   return;
  }
  $pagetitle=$title;
  ob_start();
 }

function pageend() 
 {
  global $content;
  $content = ob_get_clean(); 
 }

function button($text, $link)
 {
 ?>
<div class="button" >
  <div class="left"></div>
  <a href="<?php echo $link;?>" ><span></span></a>
  <div class="center"><?php echo $text;?></div>
  <div class="right"></div>
</div>
 <?php
 }

/* Set the default page accessed when someone opens this file*/
$page="frontpage";

/* Check if there is a page to be loaded */
if (isset($_GET["page"]))
{ $page = htmlspecialchars($_GET["page"]); }

/*Test that the requested page exists.*/
if (!file_exists("pages/".$page.".php"))
{ $page="404"; }

/*Load the page*/
$syntaxhighlighter=0;
$in_template=1;
include_once("pages/".$page.".php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="DynamO Event Driven Simulation Package" />
    <meta name="keywords" content="DynamO, Event Driven Simulation, hard sphere, square well" />
    <meta name="author" content="Marcus Bannerman" />
    <link rel="stylesheet" type="text/css" href="/style/style.php" />
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <title>DynamO Simulation Package</title>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-31464781-1']);
      _gaq.push(['_trackPageview']);

      (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </head>
  <body>
    <div id="wrapper">
      <div style="height:15px;"></div>
      <!-- HEADER AND LOGO -->
      <div id="header">
	<div class="borderleft">
	  <div class="topleftcornerborder sprite"></div>
	  <div class="verticalborder"></div>
	  <div class="bottomleftcornerborder sprite"></div>
	</div>
	<a href="/" id="sitelogo" class="bordercentre"></a>
	<div class="borderright">
	  <div class="toprightcornerborder sprite"></div>
	  <div class="verticalborder"></div>
	  <div class="bottomrightcornerborder sprite"></div>
	</div>
      </div>
      <div id="headercontentspacing"></div>
      <!-- MENU -->
      <div id="leftmenu">
	<div class="topleftcornerborder sprite"></div> 
	<div class="toprightcornerborder sprite"></div>
	<div class="horizontalborder"></div>
	<a href="/index.php/news">News</a>
	<a href="/index.php/download">Download</a>
	<a href="/index.php/documentation">Docs/Support</a>
	<a href="/index.php/features">Features</a>
	<a href="/index.php/credits">Credits</a>
	<div class="bottomleftcornerborder sprite"></div>
	<div class="bottomrightcornerborder sprite"></div>
	<div class="horizontalborder"></div>
      </div>
      <!-- CONTENT -->
      <div id="contentwrapper">
	<div class="topleftcornerborder sprite"></div> 
	<div class="toprightcornerborder sprite"></div>
	<div class="horizontalborder"></div>
	<div id="pagetitle"><?php echo $pagetitle; ?></div>
	<div id="content"><?php echo $content; ?></div>
	<div class="bottomleftcornerborder sprite"></div> 
	<div class="bottomrightcornerborder sprite"></div>
	<div class="horizontalborder"></div>
      </div>
      <!-- A DIV TO STOP THE FOOTER OVERLAPPING THE CONTENT -->
      <div id="wrapperfooterpad"></div>
    </div>
    <!-- FOOTER -->
    <div id="footer">
      <div class="borderleft">
	<div class="topleftcornerborder sprite"></div>
	<div class="verticalborder"></div>
	<div class="bottomleftcornerborder sprite"></div>
      </div>
      <div class="bordercentre">
	<p>Copyright &copy; 2008-<?php echo date("Y"); ?></p>
	<a href="http://validator.w3.org/check?uri=referer" class="w3footerlogo" style="background: url('/images/valid-xhtml11-blue.png'); right:0;"></a>
	<a href="http://jigsaw.w3.org/css-validator/check/referer" class="w3footerlogo" style="background: url('/images/vcss-blue.png'); right:93px;"></a>
      </div>
      <div class="borderright">
	<div class="toprightcornerborder sprite"></div>
	<div class="verticalborder"></div>
	<div class="bottomrightcornerborder sprite"></div>
      </div>
    </div>
    <?php if ($syntaxhighlighter) { ?>
    <link href="/syntaxhighlighter/styles/shThemeDynamO.css" type="text/css" rel="stylesheet" />
    <link href="/syntaxhighlighter/styles/shCore.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/syntaxhighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="/syntaxhighlighter/scripts/shAutoloader.js"></script>
    <script type="text/javascript">
      SyntaxHighlighter.autoloader(
      'cpp c /syntaxhighlighter/scripts/shBrushCpp.js',
      'bash shell script /syntaxhighlighter/scripts/shBrushBash.js',
      'xml /syntaxhighlighter/scripts/shBrushXml.js',
      'text plain /syntaxhighlighter/scripts/shBrushPlain.js'
      );
      SyntaxHighlighter.all()</script>
    <?php } ?>
  </body>
</html>
