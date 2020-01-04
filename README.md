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

- `api2pdf/pdf/generate-from-url`
- `api2pdf/pdf/generate-from-html`

## Twig

```twig
{% set options = {} %}
{{ craft.api2pdf.headlessChromeFromHtml('<h1>Hello</h1>', options) }}
```

## Templates

In progress. Add your own templates in `templates/pdf` (right now, the specific template is hard-coded for me, but you will be able to pass along a file name).

## Example

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
  <input class="btn" type="submit" value="Generate PDF from URL" />
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
  <input class="btn" type="submit" value="Generate PDF from URL with a redirect" />
</form>
```

## License

Copyright © [Kenneth Ormandy Inc.](https://kennethormandy.com)
