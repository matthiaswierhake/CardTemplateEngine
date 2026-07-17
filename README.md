# ClubCMS 2.0

## Vision

ClubCMS ist ein modulares Frontend-CMS für WordPress.

Das Plugin übernimmt **keine Layout-Aufgaben**. Das Layout wird
vollständig durch das verwendete Theme oder den Page Builder erstellt.
ClubCMS liefert ausschließlich Inhaltsmodule und deren Bearbeitung.

## Grundprinzip

Jeder Inhaltsbereich wird über einen Shortcode eingebunden.

``` text
[clubcms category="news"]
```

Jeder Shortcode rendert genau eine Kategorie als Card-Liste.

## Redaktion

Berechtigte Benutzer können direkt an jeder Card:

-   Bearbeiten
-   Neu
-   Löschen
-   Duplizieren

Alle Aktionen öffnen einen zentralen Frontend-Editor und kehren nach dem
Speichern zur Ausgangsseite zurück.

## Administration

Die Konfiguration erfolgt ausschließlich im Backend.

Dort werden verwaltet:

-   Kategorien
-   Felder pro Kategorie
-   Vorlagen
-   Berechtigungen
-   Einstellungen

Jede Kategorie besitzt ihr eigenes Formularmodell.

## Architekturprinzipien

-   WordPress bleibt CMS und Benutzerverwaltung.
-   ClubCMS verwaltet Inhalte.
-   Keine Logik im Theme.
-   Eine Funktion pro Klasse.
-   Kleine, klar abgegrenzte Module.

## Entwicklungsregeln

-   README beschreibt Vision und Architektur.
-   ROADMAP ist verbindlich.
-   CHANGELOG dokumentiert ausschließlich erledigte Arbeiten.
-   Neue Ideen gehören nicht in die Roadmap.
"# CardTemplateEngine" 
"# CardTemplateEngine" 
