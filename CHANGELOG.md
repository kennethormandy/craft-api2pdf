# Release Notes for Api2Pdf

## 5.0.0-beta.1 - 2024-12-20

### Added
- Added Craft 5 compatibility

## 4.0.0 - 2024-12-20

### Added
- Added Craft 4 compatibility (no changes from v1.0.0-beta.1)

### Removed
- Removed indication of support for Craft v3.x from `composer.json`

## 1.0.0-beta.1 - 2023-01-03

### Added
- Added Craft 4 compatibility

## 0.5.0 - 2020-01-30

### Added
- Adds support for `merge` action
- Adds Twig `merge` function

### Changed
- Removed manual loading of `.env` file, fixing running of tests on CI

### Fixed
- Examples in README using `url` instead of `pdf` in result

## 0.4.0 - 2020-01-12

### Added
- Adds support for passing in the API key as an option
- Adds basic tests
- Adds icon
- Adds license

## 0.3.0 - 2020-01-04

### Added
- Adds support for matching generating functions in Twig and as actions, updates README
- Adds support for using an environment variable for settings API key

### Changed
- Clarified API: everything other than the initial URL or HTML is provided as options
- Updates README

### Fixed
- Pins api2pdf dependency to specific version (v1.1.1)

## 0.2.0 - 2019-12-13

### Added
- Moves plugin into separate repository

## 0.1.0 - 2019-08-09

### Added
- Initial version

<!--

## X.Y.Z - YYYY-MM-DD

### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security

-->
