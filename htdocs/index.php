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

function menulink($page, $text)
 {
   echo "<a href=\"/index.php/".$page."\">".$text."</a>";
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
    <!--[if lt IE 10]><link rel="stylesheet" href="/style/ie-css3-support.css" type="text/css"/><![endif]-->
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <title>DynamO Simulation Package</title>
  </head>
  <body>
    <!-- SPACER TO COUNTER DODGY PAGE MARGIN INTERACTIONS -->
    <div style="height:15px;"></div>

    <!-- HEADER AND LOGO -->
    <div class="rounded">
      <a href="/" id="sitelogo" ></a>
    </div>

    <!-- MENU -->
    <div id="menu">
      <?php menulink("news", "News"); ?><?php menulink("download", "Download"); ?><?php menulink("documentation", "Docs/Support"); ?><?php menulink("features", "Features"); ?><?php menulink("credits", "Credits"); ?>
    </div>

    <!-- CONTENT -->
    <div id="contentwrapper" class="rounded">
      <div id="pagetitle"><?php echo $pagetitle; ?></div>
      <div style="height:0px;"></div>
      <?php echo $content; ?>
      <div style="clear:both;"></div>
    </div>

    <!-- FOOTER -->
    <div id="footer" class="rounded">
      Copyright &copy; Marcus Bannerman 2008-<?php echo date("Y"); ?>
      <a href="http://validator.w3.org/check?uri=referer" id="w3footerlogoHTML"></a>
      <a href="http://jigsaw.w3.org/css-validator/check/referer" id="w3footerlogoCSS"></a>
    </div>

    <!-- SPACER TO COUNTER DODGY PAGE MARGIN INTERACTIONS -->
    <div style="height:1px;"></div>

    <!-- JAVASCRIPT -->
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
    <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
    <script>
/*!
* screenfull.js
* v1.0.0 - 2012-05-02
* https://github.com/sindresorhus/screenfull.js
* (c) Sindre Sorhus; MIT License
*/
(function(a,b){"use strict";var c=typeof Element!="undefined"&&"ALLOW_KEYBOARD_INPUT"in Element,d=function(){var a=[["requestFullscreen","exitFullscreen","fullscreenchange","fullscreen","fullscreenElement","fullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitfullscreenchange","webkitIsFullScreen","webkitCurrentFullScreenElement","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozfullscreenchange","mozFullScreen","mozFullScreenElement","mozfullscreenerror"]],c=0,d=a.length,e={},f,g;for(;c<d;c++){f=a[c];if(f&&f[1]in b){for(c=0,g=f.length;c<g;c++)e[a[0][c]]=f[c];return e}}return!1}(),e={isFullscreen:b[d.fullscreen],element:b[d.fullscreenElement],request:function(a){var e=d.requestFullscreen;a=a||b.documentElement,a[e](c&&Element.ALLOW_KEYBOARD_INPUT),b.isFullscreen||a[e]()},exit:function(){b[d.exitFullscreen]()},toggle:function(a){this.isFullscreen?this.exit():this.request(a)},onchange:function(){},onerror:function(){}};if(!d){a.screenfull=null;return}b.addEventListener(d.fullscreenchange,function(a){e.isFullscreen=b[d.fullscreen],e.element=b[d.fullscreenElement],e.onchange.call(e,a)}),b.addEventListener(d.fullscreenerror,function(a){e.onerror.call(e,a)}),a.screenfull=e})(window,document);
    </script>
    <script>
      var fullscreen_objects = document.getElementsByClassName("video-container");
      for (var i = fullscreen_objects.length - 1; i >= 0; i--)
      {
       
       var d = document.createElement("div");
       d.className="fullscreen-button";
       fullscreen_objects[i].appendChild(d);
        
      d.addEventListener('click', function() {
				    if (!screenfull.isFullscreen)
				    screenfull.toggle(this.parentNode.getElementsByTagName('video')[0]);
				    });
      }
    </script>
  </body>
</html>
