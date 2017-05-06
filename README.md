# core
[![Build Status](https://travis-ci.com/dynamic/core.svg?token=hFT1sXd4nNmguE972zHN&branch=master)](https://travis-ci.com/dynamic/core)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dynamic/core/badges/quality-score.png?b=master&s=def7f99b770fb60dce2320ad226733817b62b743)](https://scrutinizer-ci.com/g/dynamic/core/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/dynamic/core/badges/coverage.png?b=master&s=6eb131287352509a481bf5b9e7ee6c965e56ab00)](https://scrutinizer-ci.com/g/dynamic/core/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/dynamic/core/badges/build.png?b=master&s=7988b4a6f697b3a7e9a17588bc2e93be1b96c136)](https://scrutinizer-ci.com/g/dynamic/core/build-status/master)
[![codecov](https://codecov.io/gh/dynamic/core/branch/2.0/graph/badge.svg?token=d71ul0CuvH)](https://codecov.io/gh/dynamic/core)


Core is a [SilverStripe](http://silverstripe.org) module that adds many basic features most simple brochure sites require.

Features include:
* Page type for home page
* Company information in Site Settings
* Various template configuration options
* Preview settings for holder/detail page relations
* A spiff system that can be shared across pages
* A slides system that can be utilized by many pages
* Simple News/Blog system
* Search Page
* Two types of form pages (Contact includes google map and company information)
* Various additional page types that help achieve different content goals

## Installation

### Requirements

* [`Framework`](https://github.com/silverstripe/silverstripe-framework)
* [`CMS`](https://github.com/silverstripe/silverstripe-cms)
* [`Flexslider`](https://github.com/dynamic/SilverStripe-FlexSlider)
* [`TagField`](https://github.com/silverstripe-labs/silverstripe-tagfield)
* [`UserForms`](https://github.com/silverstripe/silverstripe-userforms)
* [`SpamProtection`](https://github.com/silverstripe/silverstripe-spamprotection)

### Suggested Addons

* [`GridFieldRelationHandler`](https://git.simon.geek.nz/simon_w/gridfieldrelationhandler)
* [`DisplayLogic`](https://github.com/unclecheese/silverstripe-display-logic)
* [`SortableGridField`](https://github.com/UndefinedOffset/SortableGridField)

### Composer Installation

Assuming you have proper permissions to use the `core` repository add the following to your project's `composer.json` file:

```
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/dynamic/core.git"
    }
  ]
```

as well as in your `"requirements"`:

```
"dynamic/core": "2.0"
```

### Git Installation

Again assuming you have proper permissions to use the `core` repository, run the following command from terminal within your project's root:

`git clone git@github.com:dynamic/core.git -b 2.0  dynamic-core`

If you would like to checkout a specific tag use the following command (Note: there may be limitations in older git versions):

`git clone git@github.com:dynamic/core.git --branch <taghere>  dynamic-core`

### Manual Installation

Place this directory in the root of your SilverStripe installation and rename the folder to `dynamic-core`

### Post Installation Commands

Like other installations with SilverStripe, we need to rebuild the database and flush the cache. This is achieved by navigating to the following url's:

`http://yoursite.com/dev/build` and `http://yoursite.com/?flush=all`

Replace `yoursite.com` with your domain name.

### Recommended Configuration

```
SectionPage:
  extensions:
    - FlexSlider
    - SpiffManager
SectionPage_Controller:
  extensions:
    - FlexSliderExtension
DetailPage:
  extensions:
    - PreviewExtension
    - FlexSlider
DetailPage_Controller:
  extensions:
    - FlexSliderExtension
VirtualPage:
  extensions:
    - VirtualPageExtension
```

## Additional Information

### Maintainer Contact

 *  [Dynamic](http://www.dynamicagency.com) (<dev@dynamicagency.com>)
 
## License

	Copyright (c) 2015, Dynamic Inc
	All rights reserved.
	
	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	
	Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	
	Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
	
	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.