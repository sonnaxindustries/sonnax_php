<?php $thisPage="Navigation"; ?><?php  $ccuser = $_GET['ccuser']; ?> <a href="index.php?ccuser=<?php echo $ccuser; ?>" class="nav" onMouseover="return dropdownmenu(this, event, menu5, '')" onMouseOut="delayhidemenu()">Home</a>&nbsp;&nbsp;<a href="PTO.php?ccuser=<?php echo $ccuser; ?>" class="nav">PTOs</a>&nbsp;&nbsp;<a href="catalogue.php?ccuser=<?php echo $ccuser; ?>#2" class="nav">Light&nbsp;Truck</a>&nbsp;&nbsp;<a href="catalogue.php?ccuser=<?php echo $ccuser; ?>#4" class="nav">Heavy&nbsp;Truck</a>&nbsp;&nbsp;<a href="catalogue.php?ccuser=<?php echo $ccuser; ?>#8" class="nav">Industrial</a>&nbsp;&nbsp;<a href="catalogue.php?ccuser=<?php echo $ccuser; ?>#18" class="nav">Marine</a>&nbsp;&nbsp;<a href="downloads.php?ccuser=<?php echo $ccuser; ?>" class="nav" onMouseover="return dropdownmenu(this, event, menu3, '')" onMouseout="delayhidemenu()">Downloads/Info</a>&nbsp;&nbsp;<a href="contact.php?ccuser=<?php echo $ccuser; ?>" class="nav" onMouseover="return dropdownmenu(this, event, menu6, '')" onMouseOut="delayhidemenu()">Contact</a>
<script language="JavaScript" type="text/JavaScript">
var menu5=new Array()
menu5[0]='<a class="nav" href="index.php?ccuser=<?php echo $ccuser; ?>">Home Page</a><br>'
//menu5[1]='<a class="nav" href="/bid">Auction Home</a><br>'
//menu5[2]='<a class="nav" href="/chat">Forum Home</a><br>'

//Contents for menu 1 (news)
var menu1=new Array()
menu1[0]='<a class="nav" href="FAQ.php?ccuser=<?php echo $ccuser; ?>">Frequently Asked Questions</a><br>'
//menu1[1]='<a class="nav" href="../members/">current issues</a><br>'
//menu1[2]='<a class="nav" href="../members/browse.php?ccuser=<?php echo $ccuser; ?>">archives</a><br>'
//menu1[4]='<a class="nav" href="#">word</a><br>'
//menu1[5]='<a class="nav" href="#">word</a><br>'

//Contents for menu 2 (demo video)
var menu2=new Array()
menu2[0]='<a class="nav" href="demo_video.php?ccuser=<?php echo $ccuser; ?>">Video of the PTS in Action</a>'
//menu2[1]='<div align="center">or</div><a class="nav" href="../bid/register.php?ccuser=<?php echo $ccuser; ?>">auction (registration)</a>'
//menu2[1]='<br>'

//Contents for menu 3 (Catalogue/Downloads)
var menu3=new Array()
menu3[0]='<a class="nav" href="cad.php?ccuser=<?php echo $ccuser; ?>">Products</a><br>'
menu3[1]='<a class="nav" href="downloads.php?ccuser=<?php echo $ccuser; ?>">Videos</a><br>'
menu3[2]='<a class="nav" href="downloads.php?ccuser=<?php echo $ccuser; ?>">Catalogues</a><br>'
menu3[3]='<a class="nav" href="downloads.php?ccuser=<?php echo $ccuser; ?>">Images</a><br>'

//menu3[3]='<a class="nav" href="frac.php?ccuser=<?php echo $ccuser; ?>">Frac Rig Catalogue</a><br>'
//menu3[4]='<a class="nav" href="downloads.php?ccuser=<?php echo $ccuser; ?>">Download Videos and Catalogues</a><br>'

//Contents for menu 4 (dealers)
var menu4=new Array()
menu4[0]='<a class="nav1" href="dealersallus.php?ccuser=<?php echo $ccuser; ?>">US Distributors</a><br>'
menu4[1]='<a class="nav1" href="dealersallcan.php?ccuser=<?php echo $ccuser; ?>">Canadian Distributors</a><br>'
//menu4[2]='<a class="nav1" href="dealers2.php?ccuser=<?php echo $ccuser; ?>">Jamaican Distributors</a><br>'

//Contents for menu 6 (Contact)
var menu6=new Array()
menu6[0]='<a class="nav" href="contact.php?ccuser=<?php echo $ccuser; ?>">Contact Us</a><br>'
//menu6[1]='<a class="nav" href="#">word</a><br>'

//Contents for menu 7 (Home)
var menu7=new Array()
menu7[0]='<a class="nav1" href="index.php?ccuser=<?php echo $ccuser; ?>">Home Page</a><br>'
//menu7[1]='<a class="nav1" href="#">word</a><br>'

//Contents for menu 8 (About Us)
var menu8=new Array()
menu8[0]='<a class="nav1" href="about.php?ccuser=<?php echo $ccuser; ?>">About Us</a><br>'
//menu8[1]='<a class="nav1" href="#">word</a><br>'

//Contents for menu 9 (Login)
var menu9=new Array()
menu9[0]='<a class="nav" href="../bid/login.php?ccuser=<?php echo $ccuser; ?>">log in here</a><br>'
//menu9[1]='<a class="nav" href="#">word</a><br>'

//Contents for menu 10 (Services)
var menu10=new Array()
menu10[0]='<a class="nav" href="../services.php?ccuser=<?php echo $ccuser; ?>">professional services</a><br>'
//menu10[1]='<a class="nav" href="#">word</a><br>'

//Contents for menu 12 (FAQ)
var menu12=new Array()
menu12[0]='<a class="nav" href="../bid/faq.php?ccuser=<?php echo $ccuser; ?>">frequently asked questions</a><br>'
//menu12[1]='<a class="nav" href="#">word</a><br>'

//Contents for menu 11 (Links)
var menu11=new Array()
menu11[0]='<a class="nav" href="../links.php?ccuser=<?php echo $ccuser; ?>">links</a><br>'
//menu11[1]='<a class="nav" href="#">word</a><br>'

var menuwidth='' //default menu width was 130px
var menubgcolor='#999999'  //menu bgcolor
var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var hidemenu_onclick="yes" //hide menu when user clicks within menu?

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu
</script>