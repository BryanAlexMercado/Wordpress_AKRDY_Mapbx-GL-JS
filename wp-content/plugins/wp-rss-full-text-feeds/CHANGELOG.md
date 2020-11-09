# Change log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [1.3.2] - 2019-08-06
### Changed
* Changed protocol for all links to HTTPS wherever necessary or applicable.

### Fixed
* Fixed fatal errors when WP RSS Aggregator and the Feed to Post add-on are not active.
* Fixed an error on the Feed to Post settings page when no license key has yet been entered.

## [1.3.1] - 2016-08-01
### Changed
* Updated copyright and other info in plugin header.

## [1.3] - 2015-12-30
### Changed
* The licensing system was significantly overhauled.

## [1.2.6] - 2015-11-12
### Fixed
* Plugin could not be activated if no license had previously been saved, preventing plugin activation.

## [1.2.5] - 2015-11-05
### Added
* New object-oriented updater and autoloader.

## [1.2.4] - 2015-09-28
### Changed
* Improved stability of license checks and product updates.
* Added Czech, Dutch, Br Portugese and Finnish translations.

### Fixed
* Corrected error message when dependency on Feed to Post isn't satisfied.

## [1.2.3] - 2015-01-15
### Added
* Added translation support for new languages.

## [1.2.2] - 2014-11-05
### Fixed
* WPRSS_FTR_PATH Error on activation, after updating to WP RSS Aggregator v4.6.3.

## [1.2.1] - 2014-10-31
### Fixed
* Function redeclaration error for `register_addon`.

## [1.2] - 2014-10-30
### Changed
* Improved licensing to match the other add-ons.

### Fixed
* When importing full text, a 501 Method Not Implemented error was being recieved.

## [1.1] - 2014-08-13
### Fixed
* Activating the license was deactivating the licenses for the other add-ons.

## [1.0] - 2014-08-11
Initial Release
