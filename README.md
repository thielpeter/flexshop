FlexShop für REDAXO 5.x
=============

[comment]: <> (![Screenshot]&#40;https://raw.githubusercontent.com/yakamara/redaxo_yform/assets/manager_editdata.png&#41;)


Beschreibung
-------
Mit FlexShop ganz einfach und flexibel einen Shop realisieren.

Das Addon bietet einen voll funktionsfähigen Shop mit einzelnen Objekten oder ganzen Kategorien, Warenkorb und Checkout-Prozess. Bezahlmethoden können als Plugin hinzugefügt werden.

Features
------

- Einzelne Objekte können über den Shortcut REX_FLEXSHOP[object={id}] in einen beliebigen Artikel eingebunden werden
- Objekte einer Kategorie können über den Shortcut REX_FLEXSHOP[categorie={id}] in einen beliebigen Artikel eingebunden werden
- Der Warenkorb kann über den Shortcut REX_FLEXSHOP[cart] bzw. REX_FLEXSHOP[cart=light] in einen beliebigen Artikel eingebunden werden

Einrichtung
------

1. Artikel und Modul für Warenkorb anlegen und per REX_FLEXSHOP[cart] einbinden
2. Warenkorb-Icon per REX_FLEXSHOP[cart=light] in Template einbinden
3. Artikel und Modul für die Ausgabe von Objekten anlegen und per REX_FLEXSHOP[object={id}] einbinden
4. Artikel für die abgeschlossene Bestellung anlegen und befüllen
5. In den Addon-Einstellungen die Artikel-Id für den Warenkorb und die abgeschlossene Bestellung hinterlegen
