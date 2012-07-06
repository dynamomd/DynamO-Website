<?php header("Content-type: text/css"); 
$sitebg = "#b7c7d7";
$pagebg = "#ffffff";
$inactivebutton = "#e0f0ff";
$hoverbutton = "#ccddcc";
?>

/* Main html element styles */
html { height: 100%; }

.syntaxhighlighterwrapper {
    display:inline-block;
    max-width:100%;
    min-height:20px;
}

.newsdivider {
    height:2px;
    clear:both;
    background-color:#000000;
    margin:15px;
}	

body {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color:<?php echo $sitebg; ?>;
    min-width:768px;
}

h1 { 
    font-size:18pt; 
    border-bottom:2px solid; 
    display:block; 
}

h2 { font-size:16pt; display:block; }

li { margin:5px; }

.rounded {
    border-radius: 15px;
    padding: 15px;
    background-color: #ffffff;
    margin: 0px 15px 15px 15px;
}

.logo {
 border:2px solid;
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
    height: auto;
}

.video-container {
    position:relative;
    clear:both;
    margin-left:auto; 
    margin-right:auto;
}

.video-container .fullscreen-button {
    width:31px;
    display:inline;
    height:31px;
    background-image: url(csssprites.png);
    background-position: -180px 0;
    position:absolute;
    right:0;
    top:0;
}

.video-container .fullscreen-button:hover {
    background-position: -211px 0;
}

#sitelogo { 
    background-repeat:no-repeat; 
    background-image:url(sitelogo.png); 
    background-position: 15px 0px;
    height: 115px;
    display:block;
}

#footer {
    position:relative;
    height:41px;
    padding:0px;
    padding-left:15px;
    line-height:41px;
    border:2px solid;
}

#w3footerlogoHTML, #w3footerlogoCSS {
    border:0;
    float:right;
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

#menu {
    margin:15px 15px 0 15px;
}

#menu a {
    color:#000000;
    text-decoration: none; 
    background-color:<?php echo $inactivebutton; ?>;
    padding:10px 15px;
    display:inline-block;
    border: 2px solid;
    border-bottom:none;
    border-radius: 15px 15px 0 0;
    margin-right:-2px;
    font-weight:bold;
}

#menu a.selected {
    background-color:#ffffff;
    border-bottom:2px solid #ffffff;
    margin-bottom:-2px;
}

#menu a:hover { 
    background-color: <?php echo $hoverbutton;?>; 
}

#menu a.selected:hover {
    background-color: #eeeeee; 
}

#contentwrapper {
    border-radius: 0 15px 15px 15px;
    padding-top: 15px;
    border:2px solid;
}

#TOC {
     float:right;
     display:inline-block;
     background-color:#ccddee;
     margin: -15px -15px 15px 15px;
     padding:15px;
     border-radius: 0 15px 0 15px;
     position:relative;
     border-bottom:solid 2px #000000;
     border-left:solid 2px #000000;
}

#TOC #header {
     float:right;
     display:inline;
     position:relative;
     margin: -15px -15px 0 0;
     border-bottom:solid 2px;
     border-left:solid 2px;
     border-radius: 0 15px 0 15px;
     padding: 2px 15px;
}

#pagetitle {
    float:left;
    padding: 2px 15px;
    font-weight: bold;
    margin: -10px 15px 15px -15px;
}

/* Button */
.button { text-align:center; margin: 15px 0; }

.button a:hover { background-color: <?php echo $hoverbutton;?>; }

.button a {
    border:2px solid;
    position:relative;
    padding: 5px 15px;
    border-radius:15px;
    background-color: <?php echo $inactivebutton;?>; 
    color:#000000;
    display:inline-block;
    text-decoration:none;
}

.figure { 
    display: inline-block; 
    margin:5px;
    padding-top:15px;
    border:2px solid;
    background-color:#ffffff;
    border-radius: 15px 15px 15px 15px;
}

.figure .caption { 
    text-align:center; 
    clear: both;
    margin:15px;
}
