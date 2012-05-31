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

function codeblockstart()
 {
   global $syntaxhighlighter;
   $syntaxhighlighter=1;
   ob_start();
 }

function codeblockend($opts)
 {
   $code = ob_get_clean();
   echo "<pre class=\"".$opts."\">".htmlentities($code)."</pre>";
 }

function button($text, $link)
 {
 ?> <div class="button"><a href="<?php echo $link;?>"><?php echo $text;?></a></div>
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
$mathjax=0;
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
    <meta name="google-site-verification" content="atSxig_hk_QoQxF4dobExHXxGUIt57ToZf3g_welkB0" />
    <link rel="stylesheet" type="text/css" href="/style/style.php" />
    <!--[if IE]><link rel="stylesheet" href="/style/ie-css3-support.css" type="text/css"/><![endif]-->
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
    <?php if ($mathjax) { ?>
    <script type="text/javascript" src="/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
       tex2jax: {
        inlineMath: [['$','$'], ['\\(','\\)']],
        processEscapes: true },
       TeX: {
        equationNumbers: { autoNumber: "AMS" },
        extensions: ["AMSmath.js", "AMSsymbols.js", "autobold.js", "cancel.js"]
        }
      });
    </script>
    <?php } ?>
  </head>
  <body>
    <div id="wrapper">
      <!-- HEADER AND LOGO -->
      <div class="rounded" id="header">
	<a href="/" id="sitelogo" ></a>
      </div>

      <!-- MENU -->
      <div id="leftmenu">
	<a href="/index.php/news">News</a>
	<a href="/index.php/download">Download</a>
	<a href="/index.php/documentation">Docs/Support</a>
	<a href="/index.php/features">Features</a>
	<a href="/index.php/credits">Credits</a>
      </div>

      <!-- CONTENT -->
      <div id="contentwrapper" class="rounded" >
	<div id="pagetitle"><p><?php echo $pagetitle; ?></p></div>
	<div style="height:0px;"></div>
	<?php echo $content; ?>
	<div style="clear:both;"></div>
      </div>

      <!-- A DIV TO STOP THE FOOTER OVERLAPPING THE CONTENT -->
      <div id="wrapperfooterpad"></div>
    </div>
    <!-- FOOTER -->
    <div id="footer" class="rounded">
      Copyright &copy; Marcus Bannerman 2008-<?php echo date("Y"); ?>
      <a href="http://validator.w3.org/check?uri=referer" id="w3footerlogoHTML"></a>
      <a href="http://jigsaw.w3.org/css-validator/check/referer" id="w3footerlogoCSS"></a>
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
