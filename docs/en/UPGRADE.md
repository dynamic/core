#dynamic/core

##Upgrade Guide

###2.0 to 3.0

####Links (SideBar)

Links have been moved from `DetailPage` to `LinksList` DataExtension. To keep existing functionality from Core 2.0, do the following:

In your project `config.yml`, add:

```
DetailPage:
  extensions:
    - LinksList
```
In `mysite/code/`, create file `LinkObjectDataExtension.php`

```
<?php

class LinkObjectDataExtension extends DataExtension
{
    private static $belongs_many_many = array(
        'Pages' => 'Page',
    );
}

```

In your project `config.yml`, add:

```
LinkObject:
  extensions:
    - LinkObjectDataExtension
````