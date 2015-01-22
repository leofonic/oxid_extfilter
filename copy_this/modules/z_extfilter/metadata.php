<?php
$aModule = array(
    'id'          => 'z_extfilter',
    'title'       => 'Attributfilter Extension',
    'description' =>  array(
        'de'=>'Stellt alle Attributwerte dar',
        'en'=>'Enables all attribute values',
    ),
    'version'     => '2.0',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'extend'      => array(
        'oxattributelist' => 'z_extfilter/models/z_extfilter_oxattributelist',
    ),
    'blocks' => array(
    ),
    'settings' => array(
    ),
);