# PHP rühmatöö projekt

PROJEKTI NIMI - MINU TERVISEPÄEVIK

PROJEKTI VEEBIRAKENDUSE PILT:
![screen shot 2017-01-09 at 20 41 32](https://cloud.githubusercontent.com/assets/22045695/21778683/148fb440-d6ad-11e6-94a6-035350a6df2a.png)

LIIKMED - Marliis Odamus, Eliise Piiritalo, Regiina Krivulina, Geithy Plakk

EESMÄRK - Treeningu ja toitumise analüüsimine. Inimestel on võimalus endale kasutaja luua ning oma treening- ja toitumisandmeid sisestada ja analüüsida (päevade kokkuvõtted).

KIRJELDUS - Rühmatöö eeskujuks võtsime "Terve Eesti Eest" treeningpäeviku. Veebiportaalis saab määrata enda igapäevase liikumistegevuse algus- ja lõppajad. Võimalus vaadata päeviku graafikut, mis näitab visuaalselt kalorite kulu. Graafiku perioodi saab valida klikates nupule "Vali periood". Samuti on võimalus lisada uusi tegevusi valides kõrvalolevast kalendrist päeva, mille tulemusi soovitakse sisestada.
Teise rakendusena võtsime eeskujuks "Nutridata Toitumisprogramm". NutriData toitumisprogramm võimaldab analüüsida menüü energia- ja toitainete sisalduse vastavust Eesti riiklikele ea- ja soopõhistele toitumissoovitustele.

FUNKTSIONAALSUSE LOETELU -
v0.1 Saab teha kasutaja ja sisselogida
v0.2 Saab lisada treeningandmed
v0.3 Saab lisada toidukorra
v0.4 Saab näha enda tulemusi

ANDMEBAASI SKEEM:
![screen shot 2017-01-09 at 21 06 26](https://cloud.githubusercontent.com/assets/22045695/21779264/9037f538-d6af-11e6-9c02-5541a8dd6140.png)

TABELITE LOOMISE SQL LAUSED:

<div class="highlight highlight-source-sql"><pre><span class="pl-k">CREATE</span> <span class="pl-k">TABLE</span> <span class="pl-en">user</span> (
  id <span class="pl-k">INT</span> <span class="pl-k">NOT NULL</span> AUTO_INCREMENT <span class="pl-k">PRIMARY KEY</span>,
  firstName <span class="pl-k">VARCHAR</span>(<span class="pl-c1">200</span>) <span class="pl-k">NOT NULL</span>,
  lastName <span class="pl-k">VARCHAR</span>(<span class="pl-c1">200</span>) <span class="pl-k">NOT NULL</span>,
  Email <span class="pl-k">VARCHAR</span>(<span class="pl-c1">255</span>) <span class="pl-k">NOT NULL</span>,
  password <span class="pl-k">VARCHAR</span>(<span class="pl-c1">128</span>) <span class="pl-k">DEFAULT NULL</span>,
  Gender <span class="pl-k">VARCHAR</span>(<span class="pl-c1">10</span>) <span class="pl-k">NOT NULL</span>
);</pre></div>

<div class="highlight highlight-source-sql"><pre><span class="pl-k">CREATE</span> <span class="pl-k">TABLE</span> <span class="pl-en">user_sample</span> (
  id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  Email <span class="pl-k">VARCHAR</span>(<span class="pl-c1">255</span>) <span class="pl-k">NOT NULL</span>,
  password <span class="pl-k">VARCHAR</span>(<span class="pl-c1">128</span>) <span class="pl-k">DEFAULT NULL</span>,
  created <span class="pl-k">TIMESTAMP</span> <span class="pl-k">NULL</span> <span class="pl-k">DEFAULT</span> <span class="pl-k">CURRENT_TIMESTAMP</span> <span class="pl-k">ON UPDATE CURRENT_TIMESTAMP</span>
);</pre></div>

<div class="highlight highlight-source-sql"><pre><span class="pl-k">CREATE</span> <span class="pl-k">TABLE</span> <span class="pl-en">PersonData</span> (
  id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  user_id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  date <span class="pl-k">DATE</span> <span class="pl-k">NOT</span> <span class="pl-k">NULL</span>,
  weight <span class="pl-k">INT</span>(<span class="pl-c1">5</span>) <span class="pl-k">NOT NULL</span>,
  height <span class="pl-k">INT</span>(<span class="pl-c1">5</span>) <span class="pl-k">NOT NULL</span>,
  created <span class="pl-k">TIMESTAMP</span> <span class="pl-k">NOT</span> <span class="pl-k">NULL</span> <span class="pl-k">DEFAULT</span> <span class="pl-k">CURRENT_TIMESTAMP</span> <span class="pl-k">ON UPDATE CURRENT_TIMESTAMP</span>
);</pre></div>

<div class="highlight highlight-source-sql"><pre><span class="pl-k">CREATE</span> <span class="pl-k">TABLE</span> <span class="pl-en">FoodData</span> (
  id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  user_id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  food <span class="pl-k"> VARCHAR</span>(<span class="pl-c1">300</span>) <span class="pl-k">NOT NULL</span>,
  content <span class="pl-k"> VARCHAR</span>(<span class="pl-c1">300</span>) <span class="pl-k">NOT NULL</span>,
  drinks <span class="pl-k"> VARCHAR</span>(<span class="pl-c1">300</span>) <span class="pl-k">NOT NULL</span>,
  amount <span class="pl-k"> FLOAT</span> <span class="pl-k">NOT</span> <span class="pl-k">NULL</span>,
  created <span class="pl-k">TIMESTAMP</span> <span class="pl-k">NOT</span> <span class="pl-k">NULL</span> <span class="pl-k">DEFAULT</span> <span class="pl-k">CURRENT_TIMESTAMP</span> <span class="pl-k">ON UPDATE CURRENT_TIMESTAMP</span>
  deleted <span class="pl-k"> DATE DEFAULT NULL</span>
);</pre></div>

<div class="highlight highlight-source-sql"><pre><span class="pl-k">CREATE</span> <span class="pl-k">TABLE</span> <span class="pl-en">AthleteData_2</span> (
  id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  user_id <span class="pl-k">INT</span>(<span class="pl-c1">11</span>) <span class="pl-k">NOT NULL</span>,
  TypeOfTraining <span class="pl-k">VARCHAR</span>(<span class="pl-c1">20</span>) <span class="pl-k">NOT NULL</span>,
  WorkoutHour <span class="pl-k">FLOAT</span> <span class="pl-k">NOT NULL</span>,
  Kilometers <span class="pl-k">FLOAT</span> <span class="pl-k">NOT NULL</span>,
  feeling <span class="pl-k">VARCHAR</span>(<span class="pl-c1">20</span>) <span class="pl-k">NOT NULL</span>,
  comment <span class="pl-k">VARCHAR</span>(<span class="pl-c1">255</span>) <span class="pl-k">NOT NULL</span>,
  created <span class="pl-k">TIMESTAMP</span> <span class="pl-k">NOT NULL</span> <span class="pl-k">DEFAULT</span> <span class="pl-k">CURRENT_TIMESTAMP</span> <span class="pl-k">ON UPDATE CURRENT_TIMESTAMP</span>
);</pre></div>

KOKKUVÕTE - Mida õppisid juurde? Mis ebaõnnestus? Mis oli keeruline?

Marliis - Juurde õppisin lehe kujundamist ning nägin, kui kaua võtab ühe veebilehekülje tegemine tegelikult aega. Samuti polnud ma varem kasutanud GitHub'i ega andmebaasi. Ebaõnnestus see, et me ei osanud kõiki esialgselt plaanitud funktsioone tööle saada, kuna need osutusid liiga keerulisteks. Keeruline oli tulemuste lehe tööle saamine ja erinevate errorite lahendamine.

Eliise -

Regiina -

Geithy -


**Rühmatööde demo päev** on valitud eksamipäev jaanuaris, kuhu tullakse terve rühmaga koos!

## Tööjuhend
1. Üks rühma liikmetest _fork_'ib endale käesoleva repositooriumi ning annab teistele kirjutamisõiguse/ligipääsu (_Settings > Collaborators_)
1. Üks rühma liikmetest teeb esimesel võimaluse _Pull request_'i (midagi peab olema repositooriumis muudetud)
1. Muuda repositooriumi README.md faili vastavalt nõutele
1. Tee valmis korralik veebirakendus

### Nõuded

1. **README.md sisaldab:**
    * suurelt projekti nime;
    * suurelt projekti veebirakenduse pilt;
    * rühma liikmete nimed;
    * eesmärki (3-4 lauset, mis probleemi üritate lahendada);
    * kirjeldus (sihtrühm, eripära võrreldes teiste samalaadsete rakendustega – kirjeldada vähemalt 2-3 sarnast rakendust mida eeskujuks võtta);
    * funktsionaalsuse loetelu prioriteedi järjekorras, nt
        * v0.1 Saab teha kasutaja ja sisselogida
        * v0.2 Saab lisada huviala
        * ...
    * andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna);
    * **kokkuvõte:** mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).


2. **Veebirakenduse nõuded:**
    * rakendus on terviklik (täidab mingit funktsiooni ja sellega saab midagi teha);
    * terve arenduse ajal on kasutatud _git_'i ja _commit_'ide sõnumid annavad edasi tehtud muudatuste sisu; 
    * kasutusel on vähemalt 6 tabelit;
    * kood on jaotatud klassidesse;
    * koodis kasutatud muutujad/tabelid on inglise keeles;
    * rakendus on piisava funktsionaalsusega ja turvaline;
    * kõik tiimi liikmed on panustanud rakenduse arendusprotsessi.

## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
