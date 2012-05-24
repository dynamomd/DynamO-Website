<?php header("Content-type: text/css"); 
$sitebg = "#b7c7c8";
$pagebg = "#ffffff";
$leftmenuhovercolor = "#eeeeee";
$inactivebutton = "#ccdddd";
$hoverbutton = "#bbcccc";
?>

/* Main html element styles */
html { height: 100%; }

body {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color:<?php echo $sitebg; ?>;
}

h1 { min-width:533px; }

li {margin:5px;}

.newsdate {
    display:inline;
    float:right;
    padding-top:10px;
    font-weight:bold;
}

/* Stuff for making full width HTML5 and flash videos */
video {
	max-width: 100%;
	min-width:533px;
	height: auto;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
}

.video-container iframe,  
.video-container object,  
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Floating footer code */
#wrapper { 
    min-height:100%; 
    min-width:768px;
    overflow-y:visible; 
    position:relative; 
}

#wrapperfooterpad { 
    height:55px; 
    margin-bottom:10px; 
    clear:both; 
    position:relative;
    margin-left:190px; 
}

#header {
    position:relative; 
    margin: 15px 15px 15px 15px; 
}

#sitelogo { 
    background-repeat:no-repeat; 
    background-image:url(sitelogo.png); 
    background-position: 15px 0px;
    height: 115px;
    display:block;
    background-color:#ffffff;
}

#footer {
    height:40px; 
    margin-top:-55px;
    position:relative;
}

#w3footerlogoHTML, #w3footerlogoCSS {
    border:0; 
    width:88px; 
    height:31px; 
    position:absolute;
    top:5px;
    background-image: url(csssprites.png); 
}

#w3footerlogoHTML {
    right:0;
    background-position: -186px 0;
}

#w3footerlogoCSS {
    right:108px;
    background-position: -96px 0;
}

#leftmenu {
    width:160px;
    margin-left:15px; 
    position:absolute;
    left:0;
}

#leftmenu a { 
    color:#000000; 
    text-decoration: none; 
    line-height:30px; 
    display:block; 
    padding-left:16px; 
    background-color:<?php echo $pagebg; ?>;
}

#leftmenu a:hover { 
    background-color:<?php echo $leftmenuhovercolor;?>; 
}

#contentwrapper { 
    margin-left:190px; 
    margin-right:15px;
    position:relative;
    min-width:563px;
}

#pagetitle { 
    position:absolute; 
    font-weight:bold; 
    top:2px; 
    padding-left:15px;
}

#content { 
    background-color:<?php echo $pagebg; ?>; 
    padding: 10px 15px 10px 15px;
    min-width:533px; 
}

/*     Styling of the round edged boxes       */
.borderleft, .borderright { position:absolute; top:0px; width:15px; height:100%; }
.borderleft { left:15px; }
.borderright { right:15px; }
.bordercentre { background-color:<?php echo $pagebg; ?>; position:absolute; left:30px; right:30px; bottom:0; top:0;}
.verticalborder { background-color: <?php echo $pagebg; ?>; position:absolute; top:15px; bottom:15px;left:0px; right:0px; }
.horizontalborder { background-color: <?php echo $pagebg; ?>; height:15px; margin-left:15px; margin-right:15px; }

.topleftcornerborder, .bottomleftcornerborder, .toprightcornerborder, .bottomrightcornerborder {
    background-image: url(csssprites.png);
    width:15px;
    height:15px;
    position:absolute;
}

.topleftcornerborder { top:0; left:0; background-position: 0 0; }
.bottomleftcornerborder { bottom:0; left:0; background-position: 0 -15px; }
.toprightcornerborder { top:0; right:0; background-position: -15px 0; }
.bottomrightcornerborder { bottom:0; right:0; background-position: -15px -15px; }

/* Button */
.button { 
    cursor: pointer;
    position:relative; 
    padding-left:15px; 
    padding-right:15px;
    height:30px; 
    display:inline-block; 
    /*Fixes for crappy ie7*/
    zoom:1; *display: inline;
    /*Fixes for crappy ie6*/
    _height: 30px;
}

.button span { 
    position:absolute; 
    width:100%; 
    height:100%; 
    top:0;
    left:0;
    z-index:1;
}

.button .center { 
    background-color: <?php echo $inactivebutton;?>; 
    height:30px; 
    line-height:30px; 
    display:inline-block; 
    /*Fixes for crappy ie7*/
    zoom:1; *display: inline;
    /*Fixes for crappy ie6*/
    _height: 30px;
}
.button .left, .button .right {
    background-image: url(csssprites.png); 
    width:15px; 
    height:30px; 
    position:absolute;
}

.button .left { top:0; left:0; background-position: -32px 0; }

.button .right { bottom:0; right:0; background-position: -47px 0; }

.button:hover .center { background-color: <?php echo $hoverbutton;?>; }
.button:hover .left { background-position: -64px 0; }
.button:hover .right { background-position: -79px 0; }

.bordercentre p { padding:0; margin:0; line-height:40px; }

h1 { font-size:18pt; border-bottom:3px solid; display:block; clear:both; }

h2 { font-size:16pt; display:block; }

.figure { 
    float: right; 
    display: inline-block; 
    margin:5px; 
    border: solid 1px; 
    /*Fixes for crappy ie7*/
    zoom:1; *display: inline;
    /*Fixes for crappy ie6*/
    _height: 30px;
}

.figure iframe { 
    width:100%; 
}

.figure .caption { 
    text-align:center; 
    clear: both;
    padding:5px; 
}
