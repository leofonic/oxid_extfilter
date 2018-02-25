OXID Attribute Filter Extension
===============================

### Shopversion
OXID eShop 6  

### Installation
`composer require......` (todo)

### Installation (Alternativ)

Dateien kopieren nach: `source/modules/zunderweb/Extfilter`

Eintrag in composer.json:

    "autoload": {
        "psr-4": {
            "Zunderweb\\Extfilter\\": "./source/modules/zunderweb/Extfilter"
            }

    },

Dann: `composer dump-autoload`