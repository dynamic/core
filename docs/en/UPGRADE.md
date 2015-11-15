#dynamic/core

##Upgrade Guide

###2.0 to 3.0

####Tags

Tags have been moved from `DetailPage` to `Taggable` DataExtension. To keep existing functionality from Core 2.0, do the following:

In your project `config.yml`, add:

```
DetailPage:
  extensions:
    - Taggable
```
In `mysite/code/`, create file `TagDataExtension.php`

```
<?php

class TagDataExtension extends DataExtension
{
    private static $belongs_many_many = array(
        'Pages' => 'DetailPage',
    );
}

```

In your project `config.yml`, add:

```
Tag:
  extensions:
    - TagDataExtension
````