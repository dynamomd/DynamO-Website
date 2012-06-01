<?php header("Content-type: text/css"); 
$sitebg = "#b7c7d7";
$pagebg = "#ffffff";
$inactivebutton = "#e0f0ff";
$hoverbutton = "#ccddcc";
?>

/* Main html element styles */
html { height: 100%; }

body {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color:<?php echo $sitebg; ?>;
}

h1 { 
    font-size:18pt; 
    border-bottom:2px solid; 
    display:block; 
    clear:both; 
}

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
    height: auto;
}

.video-container {
    width:533px; 
    margin-left:auto; 
    margin-right:auto;
}

#header {
    position:relative; 
    margin: 15px; 
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
    margin:15px;
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
    margin:15px;
}

#leftmenu a {
    color:#000000;
    text-decoration: none; 
    padding-left:15px;
    background-color:<?php echo $inactivebutton; ?>;
    border:2px solid;
    border-radius:15px;
    padding: 5px 15px;
    display:inline-block;
    margin-right:5px;
}

#leftmenu a:hover { 
    background-color: <?php echo $hoverbutton;?>; 
}

#contentwrapper {
    margin: 15px;
    position:relative;
    min-height:210px;
}

@media screen and (min-width: 800px) {
    #leftmenu {
	width:160px;
	position:absolute;
	margin-top:0;
    }
    
    #leftmenu a {
	min-width:126px;
	margin-bottom:15px;
    }
 
    #contentwrapper {
	margin-left:190px;
    }  
}

#pagetitle {
    position:absolute;
    left: 0; 
    top: 0;
    padding: 0px 15px;
    border-radius: 15px 0 15px 0;
    font-weight: bold;
    border-bottom: 2px solid;
    border-right: 2px solid; 
}

#pagetitle p {
    padding:0;
    margin: 2px 0 2px 0;
}

#content { 
    background-color:<?php echo $pagebg; ?>; 
    padding: 10px 15px 10px 15px;
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
    float: right; 
    display: inline-block; 
    margin:5px; 
    border:2px solid; 
}

.figure .caption { 
    text-align:center; 
    clear: both;
    padding:5px;
}
