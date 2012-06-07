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
    min-width:768px;
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
    margin: 0px 15px 15px 15px;
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
    border: 1px solid;
    border-radius: 15px 15px 0 0;
    margin-left:-1px;
    font-weight:bold;
}

#menu a:hover { 
    background-color: <?php echo $hoverbutton;?>; 
}

#contentwrapper {
    border-radius: 0 15px 15px 15px;
    position:relative;
}

#pagetitle {
    position:absolute;
    left: 0; 
    top: 0;
    padding: 2px 15px;
    border-radius: 15px 0 15px 0;
    font-weight: bold;
    border-bottom: 1px solid;
    border-right: 1px solid; 
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
