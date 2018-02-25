OXID Attribute Filter Extension
===============================

### Shopversion
OXID eShop 6  



### Installation

1. `composer config repositories.Zunderweb/Extfilter git https://github.com/Josef-A-Puckl/oxid_extfilter/`

2. `composer require zunderweb/z_extfilter:dev-oxid_6`



### Installation (Alternativ)

`composer require......` (todo)


### Installation (Alternativ)

1. Dateien kopieren nach: `source/modules/zunderweb/Extfilter`

2. Eintrag in composer.json:

    "autoload": {
        "psr-4": {
            "Zunderweb\\Extfilter\\": "./source/modules/zunderweb/Extfilter"
            }

    },

3. `composer dump-autoload`
