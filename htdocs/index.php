<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('Europe/London');

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

$TOC=0;
function printTOC()
 {
   global $TOC;
   $TOC = 1;
   echo "TABLEOFCONTENTSMARKER";
 }

$html5video = false;

function embedvideo($filename, $youtubecode, $width, $height)
{
   echo "<div class=\"video-container\">";

   global $html5video;

   $basename = $_SERVER{'DOCUMENT_ROOT'} . "/videos/" . $filename;
   $html5embed = $html5video && file_exists($basename.".jpg");
   if ($html5embed)
   { ?> <video controls poster="/videos/<?php echo $filename; ?>.jpg" preload="none"> <?php
     if (file_exists($basename.".mp4")) {?> <source src="/videos/<?php echo $filename; ?>.mp4" type='video/mp4' /> <?php }
     if (file_exists($basename.".webm")) {?> <source src="/videos/<?php echo $filename; ?>.webm" type='video/webm' /> <?php }
     if (file_exists($basename.".ogg")) {?> <source src="/videos/<?php echo $filename; ?>.ogg" type='video/ogg' /> <?php }
   }
  ?> <iframe frameBorder="0" width="<?php echo $width?>" height="<?php echo $height?>" src="https://www.youtube-nocookie.com/embed/<?php echo $youtubecode?>?rel=0&amp;autohide=1&amp;theme=light&amp;modestbranding=1&amp;showinfo=0"></iframe> <?php

  if ($html5embed) { ?></video><?php }
  echo "</div>";
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


ob_start();
include_once("pages/".$page.".php");
$content = ob_get_clean();

function create_toc( $content ) {
	preg_match_all( '/<h([1-6])(.*)>([^<]+)<\/h[1-6]>/i', $content, $matches, PREG_SET_ORDER );
 
	global $anchors;
 
	$anchors = array();
	$toc 	 = '<div id="TOC"><div id="header">Table of Contents</div><ol class="toc">'."\n";
	$i 		 = 0;
 
	foreach ( $matches as $heading ) {
 
		if ($i == 0)
			$startlvl = $heading[1];
		$lvl 		= $heading[1];
 
		$ret = preg_match( '/id=[\'|"](.*)?[\'|"]/i', stripslashes($heading[2]), $anchor );
		if ( $ret && $anchor[1] != '' ) {
			$anchor = stripslashes( $anchor[1] );
			$add_id = false;
		} else {
			$anchor = preg_replace( '/\s+/', '-', preg_replace('/[^a-z\s]/', '', strtolower( $heading[3] ) ) );
			$add_id = true;
		}
 
		if ( !in_array( $anchor, $anchors ) ) {
			$anchors[] = $anchor;
		} else {
			$orig_anchor = $anchor;
			$i = 2;
			while ( in_array( $anchor, $anchors ) ) {
				$anchor = $orig_anchor.'-'.$i;
				$i++;
			}
			$anchors[] = $anchor;
		}
 
		if ( $add_id ) {
			$content = substr_replace( $content, '<h'.$lvl.' id="'.$anchor.'"'.$heading[2].'>'.$heading[3].'</h'.$lvl.'>', strpos( $content, $heading[0] ), strlen( $heading[0] ) );
		}
 
		$ret = preg_match( '/title=[\'|"](.*)?[\'|"]/i', stripslashes( $heading[2] ), $title );
		if ( $ret && $title[1] != '' )
			$title = stripslashes( $title[1] );
		else	
			$title = $heading[3];
		$title 		= trim( strip_tags( $title ) );
 
		if ($i > 0) {
			if ($prevlvl < $lvl) {
				$toc .= "\n"."<ol>"."\n";
			} else if ($prevlvl > $lvl) {
				$toc .= '</li>'."\n";
				while ($prevlvl > $lvl) {
					$toc .= "</ol>"."\n".'</li>'."\n";
					$prevlvl--;
				}
			} else {
				$toc .= '</li>'."\n";
			}
		}
 
		$j = 0;
		$toc .= '<li><a href="#'.$anchor.'">'.$title.'</a>';
		$prevlvl = $lvl;
 
		$i++;
	}
 
	unset( $anchors );
 
	while ( $lvl > $startlvl ) {
		$toc .= "\n</ol>";
		$lvl--;
	}
 
	$toc .= '</li>'."\n";
	$toc .= '</ol></div>'."\n";
 
        return str_replace("TABLEOFCONTENTSMARKER",$toc,$content);
}

if ($TOC)
 {
  $content =  create_toc($content);
 }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="DynamO Event Driven Simulation Package" />
    <meta name="keywords" content="DynamO, Event Driven Simulation, hard sphere, square well" />
    <meta name="author" content="Marcus Bannerman" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="google-site-verification" content="atSxig_hk_QoQxF4dobExHXxGUIt57ToZf3g_welkB0" />
    <link rel="stylesheet" type="text/css" href="/style/style.php" />
    <!--[if lt IE 10]><link rel="stylesheet" href="/style/ie-css3-support.css" type="text/css"/><![endif]-->
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
    <!-- SPACER TO COUNTER DODGY PAGE MARGIN INTERACTIONS -->
    <div style="height:15px;"></div>

    <!-- HEADER AND LOGO -->
    <div class="rounded">
      <a href="/" id="sitelogo" ></a>
    </div>

    <!-- MENU -->
    <div id="menu">
      <!-- There can be no spaces between these elements, due to the treatment of the anchor tag as a word and the automatic kerning of html -->
      <?php menulink("news", "News"); ?><?php menulink("download", "Download"); ?><?php menulink("documentation", "Docs/Support"); ?><?php menulink("features", "Features"); ?><?php menulink("credits", "Credits"); ?>
    </div>
    <!-- CONTENT -->
    <div id="contentwrapper" class="rounded">
      <div id="pagetitle"><?php echo $pagetitle; ?></div>
      <div style="clear:left; display:inline-block; height:15px; width:5px;"></div>
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
      'xpath /syntaxhighlighter/scripts/shBrushXPath.js',
      'text plain /syntaxhighlighter/scripts/shBrushPlain.js',
      'python /syntaxhighlighter/scripts/shBrushPython.js'
      );
      SyntaxHighlighter.all();</script>
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
if (document.getElementsByClassName)
{
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
}
    </script>
  </body>
</html>
