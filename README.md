# Cerbo

Cerbo (pronounce /t͡serbo/) is a CMS/CMF to easily create and extends
web sites.

> Otherwise, cerbo means "brain" in esperanto. Just because *Cerbo*
> is the only CMS zombies wants to use !

## Requirements

* PHP >= 5.2.4

If you want to use *phar* version of the extensions (this is absolutly
not mandatory) :

* PHP >= 5.3

## ToDo

### Routes

* Implement a system of routes (url alias) with the possibility to
    make a clean redirection (301) or just to make an invisible
    redirection.

### Content structures

* A structure could inherit from another one. This way you could
    have very generic elements that are used to handle while
    adding new elements for specific cases. (It allows too create
    generic templates that extends others too easily).
* Structures are dynamic and can be made of different datatypes
    (the datatypes are defined in the kernel and in dedicated
    extensions).

### Cache

* **Requests** : They should be stored in a PHP file to avoid the
    long data extraction and get the page faster.
* **Content** : Content should be stored in `var/cache` will
    re-creating datatree.
