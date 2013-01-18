<?php header("Content-type: text/css"); 
$sitebg = "#b7c7d7";
$pagebg = "#ffffff";
$inactivebutton = "#e0f0ff";
$hoverbutton = "#ccddcc";
?>

/* Main html element styles */
html { height: 100%; }

p {
    /* Android autofit bugfix */
    background-color: #ffffff;
}

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
    font-size:1.5em;
    border-bottom:2px solid;
    display:block;
    clear:left;
    margin-top:1.5em;
    /* Android autofit bugfix */
    background-color: #ffffff;
}

h2 { 
    font-size:1em;
    margin-top:1.5em;
    display:block; 
    /* Android autofit bugfix */
    background-color: #ffffff;
    border-bottom:1px solid;
}

h3 {
    
}

li { 
    margin:5px;     
    /* Android autofit bugfix */
    background-color: #ffffff;
 }

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

.video-container {
    position:relative;
    clear:both;
    cursor: pointer;
    margin-left:auto; 
    margin-right:auto;
}

.video-container .play-button {
    width:31px;
    height:31px;
    position:absolute;
    background-image: url(csssprites.png);
    background-position: -242px 0;
}

.video-container:hover .play-button {
    background-position: -273px 0;
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
    width:88px; 
    height:31px; 
    position:absolute;
    top:5px;
    background-image: url(csssprites.png); 
}

#mathjaxfooterlogo {
    border:0;
    width:127px; 
    height:31px; 
    position:absolute;
    top:5px;
    background-image: url(csssprites.png); 
    background-position: -305px 0;
    right:221px;
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
    margin-bottom:-2px;
    z-index:100;
    padding-bottom:12px;
    position:relative;
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
    position:relative;
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

#TOC li { 
    /* Android autofit bugfix */
    background-color:#ccddee;
 }

#TOC #header {
    float:right;
    font-weight:bold;
    display:inline;
    background-color:#ffffff;
    position:relative;
    margin: -15px -15px 0 0;
    border-bottom:solid 2px;
    border-left:solid 2px;
    border-radius: 0 15px 0 15px;
    padding: 2px 15px;
}

#pagetitle {
    position:absolute;
    top:2px;
    left:15px;
    font-weight: bold;
}

#pagedate {
    position:absolute;
    right:15px;
    bottom:2px;
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
    position:relative;
}

.figure .caption { 
    text-align:center; 
    clear: both;
    margin:15px;
}
