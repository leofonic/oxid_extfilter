<?php
$aModule = array(
    'id'          => 'z_extfilter',
    'title'       => 'Zunderweb Attributfilter Extension',
    'description' =>  array(
        'de'=>'Zeigt nach Auswahl eines Attributfilters andere M&ouml;glichkeiten direkt an',
        'en'=>'Shows all attribute values after selecting a value',
    ),
    'version'     => '1.2',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'extend'      => array(
        'oxattributelist' => 'zunderweb/z_extfilter/models/z_extfilter_oxattributelist',
    ),
    'blocks' => array(
    ),
    'settings' => array(
    ),
);