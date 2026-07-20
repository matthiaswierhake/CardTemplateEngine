# MW CTE – Card Template Engine

MW CTE ist ein WordPress-Plugin zur flexiblen Darstellung von Inhalten in Form von Dashboards, Columns, Cards und Tiles.

Die Engine trennt konsequent:

- Konfiguration
- Datenbeschaffung
- Rendering
- Templates

Dadurch können Datenquellen und Darstellung unabhängig voneinander erweitert werden.

---

# Projektumgebung

## WordPress

Aktuelle WordPress-Version

## Theme

Kadence Theme

## Child Theme

MW Club

Das Child Theme enthält ausschließlich projektspezifische Funktionen.

Namenskonventionen:

Funktionen

```
club_*
```

Konstanten

```
CLUB_*
```

Das Plugin darf keine Funktionen aus dem Child Theme voraussetzen.

Die Kommunikation erfolgt ausschließlich über WordPress.

---

# Plugin

Name

```
MW CTE
```

Namespace

```
CTE
```

Funktionspräfix

```
mw_cte_
```

Konstanten

```
CTE_VERSION
CTE_FILE
CTE_DIR
CTE_URL
```

---

# Ziel

Die Engine soll beliebige Inhalte darstellen können.

Beispiele

- News
- Veranstaltungen
- Mitarbeiter
- Dokumente
- Produkte
- Vereinsinformationen

Die Engine soll unabhängig vom Theme funktionieren.

---

# Architektur

```
Dashboard
    │
    ▼
Column
    │
    ▼
Card
    │
    ▼
Tile
```

## Dashboard

Eine Seite.

Besteht aus mehreren Columns.

## Column

Container.

Enthält mehrere Cards.

## Card

Konfiguration einer Ausgabe.

Beschreibt

- Datenquelle
- Darstellung

Card enthält keine Daten.

Card enthält keine Renderinglogik.

## Tile

Repräsentiert genau einen Datensatz.

Ist ein Wrapper um

```
WP_Post
```

und bietet komfortable Methoden.

---

# Ablauf

```
WordPress

↓

mw-cte.php

↓

Autoloader

↓

Plugin::boot()

↓

Shortcode

↓

Card

↓

Renderer

↓

Query

↓

WP_Query

↓

WP_Post[]

↓

Tile[]

↓

card.php

↓

tile.php
```

---

# Verantwortlichkeiten

## mw-cte.php

Pluginstart

- Konstanten
- Autoloader laden
- Plugin starten

---

## Autoloader

Registriert den PHP-Autoloader.

Lädt Klassen automatisch.

Enthält keine Pluginlogik.

---

## Plugin

Initialisiert Komponenten.

Aktuell

- Admin
- Shortcodes

Später

- REST
- CLI
- Cron
- Dashboard Loader

---

## Admin

Backend.

Registriert

- Dashboard
- Cards
- Templates
- Tests
- Einstellungen

---

## Shortcode

Einstieg ins Frontend.

Erzeugt eine Card.

Übergibt sie an den Renderer.

---

## Card

Reine Konfiguration.

Beispiel

- Quelle
- Limit
- Sortierung
- Template
- Spalten
- Bild anzeigen
- Datum anzeigen
- Excerpt anzeigen

Keine Logik.

---

## Query

Übersetzt eine Card in eine

```
WP_Query
```

Lädt die Daten.

---

## Tile

Wrapper für

```
WP_Post
```

Stellt Methoden bereit.

Beispiele

```
title()

permalink()

excerpt()

thumbnail()

field()

categories()
```

Templates verwenden ausschließlich Tile.

Nicht direkt WordPress.

---

## Renderer

Koordiniert den Ablauf.

```
Card

↓

Query

↓

Tile[]

↓

card.php
```

Renderer erzeugt selbst kein HTML.

---

## card.php

Komplette Card.

Aufgabe

- Überschrift
- Wrapper
- Grid
- Tiles ausgeben

---

## tile.php

Ein einzelner Datensatz.

Aufgabe

- Bild
- Titel
- Datum
- Excerpt
- Weiterlesen

---

# Templates

```
templates/

    default/

        card.php

        tile.php
```

Neue Templates können ergänzt werden.

Beispiele

```
news/

calendar/

gallery/

staff/
```

---

# Datenfluss

```
Card

↓

Query

↓

WP_Post

↓

Tile

↓

Template
```

---

# Grundprinzip

Die Engine trennt drei Ebenen.

## 1. Konfiguration

```
Card
```

## 2. Daten

```
Query

↓

Tile
```

## 3. Darstellung

```
Renderer

↓

card.php

↓

tile.php
```

Diese Ebenen dürfen möglichst unabhängig bleiben.

---

# Entwicklungsregeln

- Strict Types verwenden
- Namespace CTE
- Keine globale Logik
- Kleine Klassen
- Eine Aufgabe pro Klasse
- Keine HTML-Ausgabe außerhalb der Templates
- Renderer enthält keine Darstellung
- Card enthält keine Logik
- Query kennt keine Templates
- Templates kennen keine WP_Query

---

# Projektstatus

## Fertig

- Bootstrap
- Autoloader
- Plugin
- Admin
- Shortcode
- Card
- Query
- Tile
- Renderer
- card.php
- tile.php
- Testcenter

## Geplant

- Dashboard Loader
- Column Loader
- Config Loader
- Template Loader
- Dashboard-Konfiguration
- Card-Konfiguration
- Backend Editor
- CSS-System
- Template-Auswahl
- REST API

---

# Langfristiges Ziel

Die komplette Ausgabe einer Seite soll ausschließlich über Konfiguration aufgebaut werden.

Beispiel

```
Dashboard

    Column

        Card

            Query

            Template

            Optionen
```

Der PHP-Code der Engine soll dabei möglichst unverändert bleiben.