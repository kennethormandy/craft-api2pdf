# Api2Pdf plugin for Craft CMS 3.x

Generate PDFs easily, using [Api2Pdf.com](https://www.api2pdf.com)

## Requirements

This plugin requires Craft CMS 3.1.x or later.

## Installation

To install the plugin, require the plugin using Composer:

```sh
composer require kennethormandy/craft-api2pdf
```

Then, in the Craft CMS Control Panel, go to Settings → Plugins, and click the “Install” button for craft-api2pdf. Or run:

```sh
./craft install/plugin api2pdf
```

## Actions

- [`api2pdf/pdf/generate-from-url`](#action-generate-from-url)
- [`api2pdf/pdf/generate-from-html`](#action-generate-from-html)

## Twig

- [`craft.api2pdf.generateFromUrl`](twig-generatefromurl-function)
- [`craft.api2pdf.generateFromHtml`](twig-generatefromhtml-function)

## Examples

### Action `generate-from-url`

Get the JSON response from Api2Pdf:

```html
<form method="post" action="" accept-charset="UTF-8">
  <input
    type="hidden"
    name="action"
    value="api2pdf/pdf/generate-from-url"
  />
  <input type="hidden" name="url" value="https://example.com" />
  {{ csrfInput() }}
  <input type="submit" value="Generate PDF from URL" />
</form>
```

Redirect directly to the PDF url:

```html
<form method="post" action="" accept-charset="UTF-8">
  <input
    type="hidden"
    name="action"
    value="api2pdf/pdf/generate-from-url"
  />
  <!-- Redirect to the PDF URL -->
  <input type="hidden" name="redirect" value="1" />
  <input type="hidden" name="url" value="https://example.com" />
  {{ csrfInput() }}
  <input type="submit" value="Generate PDF from URL with a redirect" />
</form>
```

### Action `generate-from-url`

Redirect directly to the PDF made using an HTML string:

```html
<form method="post" action="" accept-charset="UTF-8">
  <input
    type="hidden"
    name="action"
    value="api2pdf/pdf/generate-from-html"
  />
  <input type="hidden" name="redirect" value="1" />
  <input type="hidden" name="html" value="<p>Hello from action with HTML</p>" />
  {{ csrfInput() }}
  <input type="submit" value="Generate with redirect from HTML" />
</form>
```

### Twig generateFromUrl function

```twig
{% set result = craft.api2pdf.generateFromUrl('https://example.com') %}

{% if result and result.success %}
  {{ result.url }}
{% endif %}
```

### Twig generateFromHtml function

```twig
{% set result = craft.api2pdf.generateFromHtml('<h1>Hello</h1>') %}

{% if result and result.success %}
  {{ result.url }}
{% endif %}
```

Slightly more complicated example:

```twig
{% set redirect = false %}
{% set options = {} %}
{% set result = craft.api2pdf.generateFromHtml('<h1>Hello</h1>', redirect, options) %}

{% if result and result.success %}

  {# Display the URL #}
  <p>{{ result.pdf }}</p>

  {# The other pieces of metadata availabe #}
  <ul>
    <li>{{ result.mbIn }}mb</li>
    <li>{{ result.mbOut|round }}mb</li>
    <li>US${{ result.cost|round }}</li>
    <li>{{ result.responseId }}</li>
  </ul>
  
{% endif %}
```

<!--

## Templates

In progress. Add your own templates in `templates/pdf` (right now, the specific template is hard-coded for me, but you will be able to pass along a file name).

-->

## License

Copyright © [Kenneth Ormandy Inc.](https://kennethormandy.com)
