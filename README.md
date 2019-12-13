# craft-api2pdf plugin for Craft CMS 3.x

Generate PDFs using api2pdf.com

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, require the plugin using Composer:

```sh
composer require kennethormandy/craft-api2pdf
```

Then, in the Craft CMS Control Panel, go to Settings → Plugins, and click the “Install” button for craft-api2pdf.

## Actions

- `craft-api2pdf/pdf/generate-from-url`
- `craft-api2pdf/pdf/generate-from-html`

## Twig

```twig
{% set options = {} %}
{{ craft.api2pdf.headlessChromeFromHtml('<h1>Hello</h1>', options) }}
```

## Templates

In progress. Add your own templates in `templates/pdf` (right now, the specific template is hard-coded for me, but you will be able to pass along a file name).

## Example

```html
<form method="post" action="" accept-charset="UTF-8">
  <input
    type="hidden"
    name="action"
    value="craft-api2pdf/pdf/generate-from-url"
  />
  <input type="hidden" name="url" value="https://example.com" />
  {{ csrfInput() }}
  <input class="btn" type="submit" value="Generate PDF from URL" />
</form>
```

## License

Copyright © [Kenneth Ormandy Inc.](https://kennethormandy.com)
