# Card Template Engine 0.3.0

Vollständig lauffähiges WordPress-Plugin für Karten aus Custom Post Types und ACF-Feldern.

## Installation

ZIP über **Plugins → Installieren → Plugin hochladen** installieren und aktivieren.

## Basis-Shortcode

```text
[cte_cards type="news"]
```

Einspaltig:

```text
[cte_cards type="news" columns="1"]
```

Mit voller WYSIWYG-Ausgabe:

```text
[cte_cards type="news" template="full" columns="1"]
```

Mit Kategorie:

```text
[cte_cards type="news" taxonomy="news-kategorie" category="flugbetrieb" limit="3"]
```

## Wichtig: Keine Feldnamen im Template

Das universelle Template arbeitet nur mit Slots wie `title`, `image`, `teaser`, `content` und `date`.
Die konkreten ACF-Feldnamen stehen ausschließlich in:

```text
config/news.php
```

Aktuelles News-Mapping:

- `image` → ACF `titelbild`
- `teaser` → ACF `teaser`
- `content` → ACF `langtext`
- `date` → ACF `datum`
- `author` → ACF `autor`

## Eigene Feldnamen verwenden

Kopiere `config/news.php` ins Child-Theme:

```text
wp-content/themes/DEIN-CHILD-THEME/card-template-engine/config/news.php
```

Dort kannst du das Mapping ändern, ohne das Plugin anzufassen.

## Eigenes Kartendesign

Kopiere ein Template ins Child-Theme:

```text
wp-content/themes/DEIN-CHILD-THEME/card-template-engine/news/default.php
```

Im Template steht das Objekt `$card` zur Verfügung, z. B.:

```php
$card->text('title');
$card->image('image');
$card->excerpt('teaser', 'content', 28);
$card->html('content');
$card->url('url');
```

## Kategorieabhängige Templates

Mit `template="auto"` und `category="flugbetrieb"` sucht CTE nach:

```text
card-template-engine/news/flugbetrieb.php
```

Fallback ist `default.php`.
