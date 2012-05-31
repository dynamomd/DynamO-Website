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
    min-width:533px; 
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
    min-width: 533px;
    height: auto;
}

.video-container {
    width:533px; 
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
}


#leftmenu a {
    color:#000000; 
    text-decoration: none; 
    line-height:30px; 
    display:block;
    padding-left:15px;
    background-color:<?php echo $inactivebutton; ?>;
    border:2px solid;
    border-radius:15px;
    margin-bottom:5px;
}

#leftmenu a:hover { 
    background-color: <?php echo $hoverbutton;?>; 
}

#contentwrapper {
    margin-left:190px; 
    margin-right:15px;
    position:relative;
    min-width:563px;
}

#pagetitle {
    position:absolute;
    left: 0px;
    top: 0px;
    padding: 0px 15px 0px 15px;
    border-radius: 15px 0 15px 0;
    border-bottom:2px solid;
    border-right:2px solid; 
    background-color:<?php echo $inactivebutton; ?>;
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
