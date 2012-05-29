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

h1 { min-width:533px; font-size:18pt; border-bottom:3px solid; display:block; clear:both; }

h2 { font-size:16pt; display:block; }

li { margin:5px; }

.rounded {
    border-radius: 15px;
    padding: 15px;
    background-color: #ffffff;
}

.newsdate {
    display:inline;
    float:right;
    padding-top:10px;
    font-weight:bold;
}

/* Stuff for making full width HTML5 and flash videos */
.video-container video {
    width: 100%;
    min-width: 533px;
    height: auto;
}

.video-container {
    max-width:600px; 
    margin-left:auto; 
    margin-right:auto;
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
}

#footer {
    margin-top:-55px;
    margin-left:15px;
    margin-right:15px;
    position:relative;
    min-width:768px;
    height:41px;
    padding:0px;
    padding-left:15px;
    line-height:41px;
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
    right:15px;
    background-position: -90px 0;
}

#w3footerlogoCSS {
    right:118px;
    background-position: 0 0;
}

#leftmenu {
    width:160px;
    position:absolute;
    left:15px;
    padding:15px 0 15px 0;
}

#leftmenu a { 
    color:#000000; 
    text-decoration: none; 
    line-height:30px; 
    display:block;
    padding-left:15px;
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
}

/* Button */
.button { 
    background-color: <?php echo $inactivebutton;?>; 
    cursor: pointer;
    position:relative; 
    padding-left:15px; 
    padding-right:15px;
    height:30px; 
    display:inline-block; 
    border-radius:15px;
    line-height:30px; 
    /*Fixes for crappy ie7*/
    /*zoom:1; *display: inline;*/
    /*Fixes for crappy ie6*/
    /*_height: 30px;*/
}

.button:hover { background-color: <?php echo $hoverbutton;?>; }

.button span { 
    position:absolute; 
    width:100%; 
    height:100%; 
    top:0;
    left:0;
    z-index:1;
}

.button a {
    color:#000000;
    text-decoration:none;
}

.figure { 
    float: right; 
    display: inline-block; 
    margin:5px; 
    border: solid 1px; 
    /*Fixes for crappy ie7*/
    /*zoom:1; *display: inline;*/
    /*Fixes for crappy ie6*/
    /*_height: 30px;*/
}

.figure iframe { 
    width:100%; 
}

.figure .caption { 
    text-align:center; 
    clear: both;
    padding:5px;
}
