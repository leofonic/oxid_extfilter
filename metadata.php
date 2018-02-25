<?php

$sMetadataVersion = '2.0';
$aModule = array(
    'id'          => 'z_extfilter',
    'title'       => 'Zunderweb Attributfilter Extension',
    'description' =>  array(
        'de'=>'Zeigt nach Auswahl eines Attributfilters andere M&ouml;glichkeiten direkt an',
        'en'=>'Shows all attribute values after selecting a value',
    ),
    'version'     => '3.0',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'extend'      => array(
        \OxidEsales\Eshop\Application\Model\AttributeList::class => \Zunderweb\Extfilter\Model\AttributeList::class,
    ),
);