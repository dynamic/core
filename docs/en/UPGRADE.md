#dynamic/core

##Upgrade Guide

###2.0 to 3.0

####Spiffs

Spiffs have been updated as follows:

The goal is to make it easier to both extend Spiff, and apply Spiffs to any Page/Object desired. This should be considered a base class, and we recommend only using descended classes in projects.

1. Depreciation warning added for `$Headline` - use `$Title` instead

2. `$Name` is used as an internal reference, added RightTitle in CMS to indicate this

3. `belong_many_many section pages` has been removed, so that Spiffs can be applied to any page type. Use a DataExtension on Spiff to set reciprocal relationships.

	To keep existing SectionPages relation from Core 2.x, do the following:

In `mysite/code/`, create file `SpiffDataExtension.php`

```
<?php

class SpiffDataExtension extends DataExtension
{
    private static $belongs_many_many = array(
        'SectionPages' => 'SectionPage',
    );
}

```

In your project `config.yml`, add:

```
Spiff:
  extensions:
    - SpiffDataExtension
````