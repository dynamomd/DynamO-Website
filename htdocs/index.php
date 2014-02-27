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

function showhidestart()
 { ob_start(); }

function showhideend($name)
 {
   $code = ob_get_clean();
   $unique_identifier = uniqid("codeid");
   ?>
<div style="background:#eeeeee;  border:2px solid #000000; position:relative; padding-top:30px;" class="rounded">
  <a style="background:#ffffff; display:block; position:absolute; padding:5px 5px 5px 5px; left:0;top:0; border-radius:15px 0 15px 0; border-right:2px solid #000000;border-bottom:2px solid #000000;" href="javascript:toggle_visibility('<?php echo $unique_identifier;?>')"><?php echo $name; ?></a>
  <p id="<?php echo $unique_identifier; ?>" style="background:#eeeeee; display:none">
<?php echo $code;?> </p></div> <?php
 }

function echoXML($xmlnode, $spacing, $max_depth, $max_children, $max_lines_of_text=3)
{
 //Print the current node and its attributes
 echo str_repeat("  ", $spacing)."<".$xmlnode->getName();
 foreach ($xmlnode->attributes() as $name => $attr){
  echo " ".$name."=\"".$attr."\"";
 }

 if ($xmlnode->count()) {
  //Print the node's children and text
  echo ">";
  if ($max_depth == 1){
   //This node has children, but the maximum depth has been reached
   echo "...</".$xmlnode->getName().">\n";
  } else {
   $childcounter = 0;
   echo "\n";
   foreach ($xmlnode->children() as $child){
    echoXML($child, $spacing+1, $max_depth - 1, $max_children);
    if ((++$childcounter == $max_children)) break;
   }
   if (($childcounter == $max_children) && ($childcounter < $xmlnode->count()))
    echo str_repeat("  ", $spacing+1)."...\n";
   echo str_repeat("  ", $spacing)."</".$xmlnode->getName().">\n";
  }
 } else {
   $text = trim($xmlnode);
   if (empty($text)) {
     echo "/>\n";
   } else {
     echo ">\n";
     $s = explode("\n",$text);
     if (count($s) <= $max_lines_of_text) {
       echo $text."\n";
     } else {
        $s = implode("\n",array_slice($s,0,$max_lines_of_text));
        echo $s."\n...\n";
     }
     echo str_repeat("  ", $spacing)."</".$xmlnode->getName().">\n";
   }
 }
}

function xmlXPathFile($file, $xpathExpr, $max_depth = 0, $max_children = 0)
{
   $fileXML = new SimpleXMLElement($file,0,true);
   $nodelist = $fileXML->xpath($xpathExpr);
   codeblockstart();
   $tags=explode("/", trim($xpathExpr, " /"));
   array_pop($tags);
   $currentdepth=0;
   foreach ($tags as $node){
    echo str_repeat("  ", $currentdepth)."<".$node.">\n";
    ++$currentdepth;
   }
   foreach ($nodelist as $node){
    echoXML($node, $currentdepth, $max_depth, $max_children);
   }
   foreach (array_reverse($tags) as $node){
    echo str_repeat("  ", --$currentdepth)."</".$node.">\n";
   }
   codeblockend("brush: xml;");
}

function button($text, $link)
 {
 ?> <div class="button"><a href="<?php echo $link;?>"><?php echo $text;?></a></div>
<?php
 }

function menulink($linkpage, $text)
 {
   global $page;
   echo "<a";
   if ($page == $linkpage) echo " class=\"selected\"";
   echo " href=\"/index.php/".$linkpage."\">".$text."</a>";
 }

$TOC=0;
function printTOC()
 {
   global $TOC;
   $TOC = 1;
 }

$containsvideo = false;

function embedAJAXvideo($filename, $youtubecode, $width, $height, $caption)
{
   global $containsvideo;
   $containsvideo = true;
   ?>
<div class="figure" style="width:100%;max-width:<?=$width?>px; vertical-align:middle;">
  <div class="video-container" style="width:100%;max-width:<?=$width?>px;height:auto;max-height:<?=$height?>px;" id="<?=$filename?>video" onclick="delayedLoadOfVideo('<?=$filename?>video', '<?=$height?>', '<?=$width?>', '<?=$youtubecode?>')">
    <div class="play-button"></div>
    <img style="width:100%;max-width:<?=$width?>px;" src="/videos/<?=$filename?>.jpg">
  </div>
  <div class="caption"><?=$caption?></div>
</div>
<?php }

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

$contentdate = date("l jS F Y ", filemtime("pages/".$page.".php"));

function create_toc( $content ) {
	preg_match_all( '/<h([1-3])(.*)>([^<]+)<\/h[1-6]>/i', $content, $matches, PREG_SET_ORDER );

	global $anchors; 
	$anchors = array();
        $prevlvl = 1;
	$toc 	 = '<div id="TOC"><div id="header">Table of Contents</div>'."\n".'<ol class="toc">';
	$lineopen = False;
 	/*Scan over each heading in the document*/
	foreach ( $matches as $heading ) {
		$lvl = $heading[1];

		/*Figure out the anchor id of the heading and if we need to add one*/
		$ret = preg_match( '/id=[\'|"](.*)?[\'|"]/i', stripslashes($heading[2]), $anchor );
		if ( $ret && $anchor[1] != '' ) {
			$anchor = stripslashes( $anchor[1] );
			$add_id = false;
		} else {
			$anchor = preg_replace( '/\s+/', '-', preg_replace('/[^a-z\s]/', '', strtolower( $heading[3] ) ) );
			$add_id = true;
		}
 
		/*Check if the new anchor is unique, alter it if it is not*/
		if ( !in_array( $anchor, $anchors ) ) {
			$anchors[] = $anchor;
		} else {
			$orig_anchor = $anchor;
			$j = 2;
			while ( in_array( $anchor, $anchors ) ) {
				$anchor = $orig_anchor.'-'.$j;
				$j++;
			}
			$anchors[] = $anchor;
		}
 
		/*Add the anchor id if needed*/
		if ( $add_id ) {
		 $content = substr_replace( $content, '<h'.$lvl.' id="'.$anchor.'"'.$heading[2].'>'.$heading[3].'</h'.$lvl.'>', strpos( $content, $heading[0] ), strlen( $heading[0]));
		}
 
		/*Grab the title of the heading if needed.*/
		$ret = preg_match( '/title=[\'|"](.*)?[\'|"]/i', stripslashes( $heading[2] ), $title );
		if ( $ret && $title[1] != '' )
			$title = stripslashes( $title[1] );
		else	
			$title = $heading[3];
		$title = trim( strip_tags( $title ) );
		
		/*Open or close lists as needed*/
                while ( $prevlvl < $lvl ) {
		 if (!$lineopen) {
		 $toc .= '<li style="list-style-type: none;">';
		 }
                 $lineopen = False;
		 $toc .= "\n".'<ol>';
                 $prevlvl++;
                }
                while ( $prevlvl > $lvl ) {
		 if ($lineopen) {
		 $toc .= "</li>";
		 }
                 $toc .= "\n</ol>";
                 $lineopen = True; //ol elements are always in a line
                 $prevlvl--;
                }
                /* Add the list item*/
		 if ($lineopen) {
		 $toc .= "</li>\n";
		 }
		$toc .= "\n<li>".'<a href="#'.$anchor.'">'.$title."</a>";
                $lineopen = True;
		$prevlvl = $lvl;
	}
 
	unset( $anchors );
 
	while ( $lvl > 1 ) {
	  $toc .= "\n</ol>";
	 $lvl--;
	}
 
	$toc .= '</ol></div>'."\n";
 
        return $toc;
}

if ($TOC) {
  $content = create_toc($content).$content;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DynamO Event Driven Simulation Package" />
    <meta name="keywords" content="DynamO, Event Driven Simulation, hard sphere, square well" />
    <meta name="author" content="Marcus Bannerman" />
    <meta name="google-site-verification" content="atSxig_hk_QoQxF4dobExHXxGUIt57ToZf3g_welkB0" />
    <link rel="stylesheet" type="text/css" href="/style/style.css" />
    <?php if ($syntaxhighlighter) { ?>
    <link href="/syntaxhighlighter/styles/shThemeDynamO.css" type="text/css" rel="stylesheet" />
    <link href="/syntaxhighlighter/styles/shCore.css" type="text/css" rel="stylesheet" />
    <?php } ?>
    <!--[if lt IE 10]><link rel="stylesheet" href="/style/ie-css3-support.css" type="text/css"/><![endif]-->
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <title>DynamO: <?php echo $pagetitle; ?></title>
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
    <?php if ($containsvideo) { ?>
    <script type="text/javascript">
      var tag = document.createElement('script');
      tag.src = "//www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      function onPlayerReady(event) {
        event.target.playVideo();
        event.target.setPlaybackQuality('highres');
      }

      function delayedLoadOfVideo(videoelemid, height, width, youtubecode)
      {
        /*Grab the video element*/
        videoelem = document.getElementById(videoelemid);
        /*Calculate how big the iframe needs to be to avoid resizing it*/
        currentwidth = videoelem.offsetWidth;
        currentHeight = Math.ceil((currentwidth + 0.0) * height / width);
        videoelem.removeAttribute("style");
        videoelem.removeAttribute("onclick");
        while( videoelem.hasChildNodes() ){
         videoelem.removeChild(videoelem.lastChild);
        }

        player = new YT.Player(videoelemid, {
          playerVars: { modestbranding: true, 'showinfo': 0, theme: 'light', 'autohide': 1, 'rel': 0, wmode: "opaque"},
          width: currentwidth,
          height: currentHeight,
          videoId: youtubecode,
          events: {
            'onReady': onPlayerReady,
          }
        });
      }
    </script>
    <?php } if (isset($pagecss)) { echo "<style>".$pagecss."</style>";} ?>
  </head>
  <body>
    <!-- SPACER TO COUNTER DODGY PAGE MARGIN INTERACTIONS -->
    <div style="height:15px;"></div>

    <!-- HEADER AND LOGO -->
    <div class="logo rounded">
      <a href="/" id="sitelogolink"><img id="sitelogo" alt="The DynamO logo" src="/style/sitelogo.png"></a>
    </div>

    <a href="https://github.com/toastedcrumpets/DynamO/"><img style="position: absolute; top: 0; right: 0; border: 0;" src="/images/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>

    <!-- MENU -->
    <div id="menu">
      <!-- There can be no spaces between these elements, due to the treatment of the anchor tag as a word and the automatic kerning of html -->
      <?php menulink("news", "News"); ?><?php menulink("download", "Download"); ?><?php menulink("documentation", "Manual"); ?><?php menulink("features", "Features"); ?><?php menulink("support", "Support"); ?><?php menulink("credits", "Credits"); ?>
    </div>
    <!-- CONTENT -->
    <div id="contentwrapper" class="rounded">
      <?php echo $content; ?>
      <div style="clear:both;height:10px;"></div>
      <p id="pagedate"><i>Page last modified: <?php echo $contentdate; ?></i></p>
    </div>
    
    <!-- FOOTER -->
    <div id="footer" class="rounded">
      <p>&copy; M. Bannerman 2008-<?php echo date("Y"); ?></p>
      <div id="footerlogos">
	<?php if ($mathjax) { ?>
	<a href="http://www.mathjax.org/" id="mathjaxfooterlogo"></a>
	<?php } ?>
	<a href="http://validator.w3.org/check?uri=referer" id="w3footerlogoHTML"></a>
	<a href="http://jigsaw.w3.org/css-validator/check/referer" id="w3footerlogoCSS"></a>
      </div>
      <div style="clear:both;"></div>
    </div>

    <!-- SPACER TO COUNTER DODGY PAGE MARGIN INTERACTIONS -->
    <div style="height:1px;"></div>

    <!-- JAVASCRIPT -->
    <!-- SYNTAXHIGHLIGHTER -->
    <?php if ($syntaxhighlighter) { ?>
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
    <!-- MATHJAX -->
    <?php if ($mathjax) { ?>
    <script type="text/javascript" src="/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
       tex2jax: {
        inlineMath: [['$','$'], ['\\(','\\)']],
        processEscapes: true },
       TeX: {
        equationNumbers: { autoNumber: "AMS" },
        extensions: ["AMSmath.js", "AMSsymbols.js", "autobold.js", "cancel.js"]
        },
	webFont: "TeX"
      });
    </script>
    <?php } ?>    
  </body>
</html>
