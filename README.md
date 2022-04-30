# Deutsche Feiertage

Dies ist die Datengrundlage für https://projects.kkapsner.de/Kalender/Feiertage/

Viele Leute wissen nicht, dass es nur einen Deutschen Feiertag gibt: der Tag der Deutschen Einheit (3. Oktober)[^1]

[^1]: https://www.bmi.bund.de/DE/themen/verfassung/staatliche-symbole/nationale-feiertage/nationale-feiertage-node.html Stand 29.04.2022

Alle anderen Feiertage sind durch die Länder festgelegt. Dabei gibt es 8 weitere Feiertage, die bundeseinheitlich sind[^1]:
* Neujahr (1. Januar)
* Karfreitag (Freitag vor dem Ostersonntag[^2])
* Ostermontag (Samstag nach dem Ostersonntag[^2])
* Christi Himmelfahrt (39 Tage nach dem Ostersonntag[^2])
* Pfingstmontag (50 Tage nach dem Ostersonntag[^2])
* Tag der Arbeit (1. Mai)
* erster Weihnachtstag (25. Dezember)
* zweiter Weihnachtstag (26. Dezember)

[^2]: Zur Berechnung des Ostersonntags wird Spencers Osterformel verwendet: https://doi.org/10.1038/013487a0

Die anderen Feiertage sind von Bundesland zu Bundesland verschieben. Es gibt sogar Feiertage, die von Gemeinde zu Gemeinde unterschiedlich sind (z.B. Mariä Himmelfahrt in Bayern[^3][^4] oder das Friedensfest in Augsburg[^3])

[^3]: https://www.gesetze-bayern.de/Content/Document/BayFTG-1 Stand 29.04.2022
[^4]: https://www.statistik.bayern.de/statistik/gebiet_bevoelkerung/zensus/himmelfahrt/index.php

## verpflichtende Parameter

## region

Code der Region, für die die Feiertage ausgegeben werden sollen. Folgende Codes sind unterstützt[^5]:

[^5]: https://www.destatis.de/DE/Methoden/abkuerzung-bundeslaender-DE-EN.html Stand 29.04.2022

* BB: Brandenburg
* BE: Berlin
* BW: Baden-Württemberg
  * BW-Schule: schulfreie Tage in Baden-Württemberg
* BY: Bayern[^3][^6]
  * BY-A: Stadt Augsburg[^3][^6]
  * BY-k: Landkreis in Bayern mit vorwiegend katholischer Bevölkerung[^3][^4][^6]
  * BY-Schule: schulfreie Tage in Bayern[^3][^6][^7]
  * BY-A-Schule: schulfreie Tage der Stadt Augsburg[^3][^6][^7]
* HB: Bremen
* HE: Hessen
* HH: Hamburg
* MV: Mecklenburg-Vorpommern
* NI: Niedersachsen [^8]
* NW: Nordrhein-Westfalen
* RP: Rheinland-Pfalz
* SH: Schleswig-Holstein
* SL: Saarland
* SN: Sachsen
* ST: Sachsen-Anhalt
* TH: Thüringen


[^6]: https://www.stmi.bayern.de/suv/bayern/feiertage/index.php Stand 29.04.2022

[^7]: https://www.gesetze-bayern.de/Content/Document/BayFTG-4 Stand 29.04.2022

[^8]: https://www.mi.niedersachsen.de/startseite/themen/allgemeine_angelegenheiten_des_inneren/feiertagsrecht/feiertagsgesetz-61491.html Stand 30.04.2022

## optionale Parameter

### type

Rückgabetyp der Feriendatei. Mögliche Werte:

* ics (Standardwert)
* csv
* html
* json
* raw (funktioniert ohne Region)

Beispiel: https://projects.kkapsner.de/Kalender/Feiertage/?type=json

### year

Erstes Jahr, das für die beweglichen Feiertage verwendet wird. Standartwert ist das aktuelle Jahr minus dem Parameter [yearsAgo](#yearsAgo).

### yearsAgo

Anzahl der Jahre in der Vergangenheit, in denen bewegliche Feiertage angezeigt wird. Standartwert in 1.

Wird ignoriert wenn [year](#year) verwendet wird.

### endYear

Letztes Jahr, das für die beweglichen Feiertage verwendet wird. Standartwert ist das Startjahr plus dem Parameter [yearsCount](#yearsCount).

### yearsCount

Anzahl der Jahre, in denen bewegliche Feiertage angezeigt wird. Standartwert in 5.

Wird ignoriert wenn [endYear](#endYear) verwendet wird.

### noCache

Die reine Anwesenheit dieses Parameters schaltet den Cache aus

### separator

Separator der CSV-Datei. Sollte immer in Zusammenhang mit [noCache](#noCache) verwendet werden.

Beispiel: https://projects.kkapsner.de/Kalender/Feiertage/?region=BY&type=csv&noCache&separator=;

## Disclaimer

1. Bis jetzt sind nur die Feiertage von Bayern und Niedersachsen mit den Gesetzestexten abgeglichen.
2. Die Feiertage bilden den aktuellen Stand (29.04.2022) ab. Abweichende Regelungen in der Vergangenheit (z.B. Änderungen beim Reformationstag) werden nicht berücksichtigt.