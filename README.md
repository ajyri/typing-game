# Web-palvelinohjelmoinnin kurssityö 2021
Tekijä: Jyri Ahola  
Linkki lähdekoodiin: https://github.com/ajyri/typing-game  
Linkki toimivaan työhön: http://159.65.113.135/~jyri/typing-game/public/  
Linkki esittelyvideoon: TBA  
## Esittely:
Harjoitustyön ideana oli rakentaa minimalistinen kirjoituspeli jossa tietokannasta haetaan satunnainen sitaatti jonka käyttäjän pitää kirjoittaa. Kirjoittamisen jälkeen peli kertoo käyttäjälle hänen kirjoitusnopeutensa, tarkkuuden ja lopullisen ajan. Sivustolla on myös kirjautumismahdollisuus. Sisäänkirjautuneiden käyttäjien tulokset tallennetaan tietokantaan ja tuloksia voi sisäänkirjautuneena tarkastella. 
Frontend on tehty Laravel blade templateja ja javascriptiä hyödyntäen. Sivuston tyylit on tehty Bootstrap kirjastolla ja css:llä.      
Backend on tehty Laravel frameworkilla ja tietokanta on luotu mysql käyttäen.
Kurssityö sijaitsee itse asentamallani DigitalOceanin palvelimella.
## Tietokanta
![enter image description here](https://i.imgur.com/UcsCvBa.png)
Kuvassa sivuston yksinkertainen tietokantarakenne.
 ## Kirjoituspeli:
 Kirjoituspelin logiikasta vastaa **script.js** tiedosto joka sijaitsee Laravelin public hakemistossa.
Sivun käynnistyessä kutsutaan frontendin funktiota **gameStart()** jonka sisällä ensin **getQuote()** funktiota hyödyntäen tehdään backendin QuoteControllerille pyyntö jossa haetaan tietokannasta satunnainen sitaatti. Tämän jälkeen sitaatti katkotaan yksittäisen kirjaimen kokoisiin \<span> elementteihin ja renderöidään ruudulle. Käyttäjän kirjoittaessa \<span> elementin päällä oleva osoitin liikkuu eteenpäin ja kirjaimen väri muuttuu sen mukaan oliko syötetty kirjain oikein vai väärin. Syötettä myös filtteröidään yksinkertaista regexiä hyödyntäen jolloin esim. Numerot ja muut toimintonäppäimet eivät aiheuta syötteitä. 
Kun käyttäjä on kirjoittanut sitaatin loppuun sitaatti piilotetaan näkyvistä ja esille tuodaan lopputulokset. Tässä vaiheessa frontend tekee pyynnön backendin ScoreControllerille tuloksen tallentamiseksi. Tulos tallennetaan tietokantaan vain jos käyttäjä on kirjautunut sisään. Vieraskäyttäjälle ilmoitetaan tuloksen näytön yhteydessä että hän voi kirjautua sisään tallentaakseen tuloksensa.
#### Tiedot jotka tallennetaan tietokantaan tuloksesta:
WPM: Lyhenne termistä "Words Per Minute",  arvio käyttäjän kirjoitusnopeudesta.   
Acc: Käyttäjän tarkkuus kirjoittaessa.   
Quote id: Kirjoitetun sitaatin id. Tätä hyödynnetään myöhemmin kun haetaan käyttäjien tuloksia näytettäväksi.   
User id: Käyttäjän id. Tätä hyödynnetään myöhemmin kun haetaan käyttäjien tuloksia näytettäväksi.   

## Käyttäjien hallinta ja autentikointi:
Käyttäjien hallinta tapahtuu täysin Laravel frameworkin tarjoamilla valmiilla ominaisuuksilla. Tietojen tallentaminen ja autentikointi on tätä kautta paljon vaivattomampaa sekä myös turvallisempaa verrattuna jos itse yrittäisin alkaa luomaan autentikointijärjestelmää. Users tietokannassa on myös kohta "is_admin" joka on boolean arvo. Jos tämä arvo on tosi, käyttäjä saa automaattisesti admin oikeudet. Auth middlewarea hyödyntäen käyttäjä ohjataan kirjautumissivulle tai etusivulle jos hänellä ei ole oikeuksia kyseiseen reittiin.

#### Admin käyttäjän oikeudet:
Admin käyttäjille on lisätty näkymä jossa on CRUD ominaisuudet sitaattien hallintaa varten. Tämä mahdollistaa sitaattien lisäämisen, poiston tai päivityksen tarpeen mukaan.   
![enter image description here](https://i.imgur.com/RKHxcdT.png)
![enter image description here](https://i.imgur.com/4wWszLY.png)
## Reittien ja tietokannan käsittely
Reittien käsittely tapahtuu api.php ja web.php tiedostoissa. Api tiedostoon on lisätty kaikki reitit joista palautetaan tietoa mutta ei ole tarvetta palauttaa erillistä näkymää. Web tiedostossa on kaikki reitit joissa palautetaan käyttäjälle näkymä. Poikkeuksena tässä on 'api/savescore' reitti web.php tiedostossa joka kutsuu ScoreControllerin **saveScore()** funktiota. En saanut api reittien kautta autentikaatiota valitettavasti toimimaan ja en ehtinyt tätä selvittää joten tämä on laiskasti ratkaistu näin.

### ScoreController
Tämä kontrolleri vastaa tulosten tallentamisesta sekä yksittäisten tulosten hakemisesta tarkastelua varten.
**saveScore()** funktiossa tarkastetaan ensin onko käyttäjä kirjautuneena sisään Auth::check() funktiota hyödyntäen. Jos palautettu arvo on tosi, tallennetaan tuloksen tiedot tietokantaan.
**viewScore()** funktiossa haetaan annetun id:n perusteella tietyn sitaatin tulokset ja palautetaan ne.


### QuoteController
Tämä kontrolleri vastaa sitaateista. Suurinosa tämän kontrollerin funktioista on yksinkertaisia CRUD funktioita.
**getRandomQuote()** funktiossa haetaan ensin jokaisen sitaatin id taulukkoon jonka jälkeen satunnaisesti haetaan taulukosta yksi id ja id:lle kuuluva sitaatti.
**getLeaderboard()** funktiossa palautetaan jokainen sitaatti ja näille kuuluvien tulosten määrä.

## Ajan käyttö
En ottanut aikaa ylös tätä työtä tehdessä mutta arviolta asetettu työmäärä mielestäni tuli tässä työssä täyteen.

## Itsearvio
Henkilökohtaisesti olen tyytyväinen mitä saavutin tätä työtä tehdessä. Huomasin myös työn edetessä kuinka paljon tältä kurssilta olen oppinut. Kokonaisarvosanaksi antaisin itselleni: **4**
### Kehittämiskohteita
Tarkoituksena oli vielä ehtiä lisäämään käyttäjäprofiilit ja esim. Profiilikuvan lisääminen käyttäjälle mutta ajan takia tätä en valitettavasti ehtinyt tehdä. API reititysten kanssa on vielä paljon kehitettävää, autentikaatio-ongelmat tulosten tallentamisen kanssa osoittavat että dokumentaatiota on vielä paljon luettavana. Myös sivuston ulkoasu mielestäni kaipaisi lisäyksiä mutta en halunnut takertua näihin ongelmiin koska itse backend oli enemmän tärkeä tässä työssä. Myös mitään sen suurempaa suunnitelmaa en työn alussa laatinut vaan aloin työskennellä oman pienen vision perusteelta.
