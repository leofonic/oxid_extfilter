<?php
class z_extfilter_oxattributelist extends z_extfilter_oxattributelist_parent{
    public function getCategoryAttributes( $sActCat, $iLang )
    {
        startProfile("getattributes");
        
        $aAttributes    = array();
        $blActiveFilter = false;
        $aSessionFilter = oxSession::getVar( 'session_attrfilter' );
        
        //get Attriibutes
        $aAllAttributes = $this->_getAttributeValues( $sActCat, array());
        
        //if there are any
        if (count($aAllAttributes)) {
            $oStr = getStr();
            //loop through results
            $aAttributes = array();
            foreach ($aAllAttributes as $aAttributeValues){
                $sAttId = $aAttributeValues["sAttId"];
                $sAttTitle = $aAttributeValues["sAttTitle"];
                $sAttValue = $aAttributeValues["sAttValue"];
                $blDisabled = 0;
                $blSelected = 0;

                //make empty attribute only once
                if ( !$this->offsetExists( $sAttId ) ) {
                    $oAttribute = oxNew( "oxattribute" );
                    $oAttribute->setTitle( $sAttTitle );
                    $this->offsetSet( $sAttId, $oAttribute );

                    //make testset
                    $aTestFilter = $aSessionFilter;
                    //reset current attribute
                    unset($aTestFilter[$sActCat][$iLang][$sAttId]);
                    //get Articles
                    $aCurrentAttributes = $this->_getAttributeValues( $sActCat,$aTestFilter);
                    $aCurrentAttributeValues[$sAttId] = array();
                    foreach ($aCurrentAttributes as $aCurrentAttribute){
                        $aCurrentAttributeValues[$sAttId][] = strtolower($aCurrentAttribute["sAttValue"]);
                    }
                }

                //get Identifier
                $oValueId = $oStr->htmlspecialchars( $sAttValue );

                //value already selected?
                if (isset($aSessionFilter[$sActCat][$iLang][$sAttId]) && $aSessionFilter[$sActCat][$iLang][$sAttId] == $sAttValue){
                    $blSelected = 1;
                }
                //anything found?
                if (!$blSelected && !in_array(strtolower($sAttValue),$aCurrentAttributeValues[$sAttId])) {
                    $blDisabled = 1;
                    $blSelected = 0;
                }

                //add to array
                $sAttValueId = md5( $sAttValue );
                $oAttribute = $this->offsetGet( $sAttId );
                if (!$blDisabled){
                    $oAttribute->addValue($oStr->htmlspecialchars( $sAttValue ));
                }
                if ($blSelected){
                    $oAttribute->setActiveValue($oStr->htmlspecialchars( $sAttValue ));
                }
            }
        }
        oxSession::setVar( "session_attrfilter", $aSessionFilter);
        stopProfile("getattributes");
        return $this;
    }
    protected function _getAttributeValues( $sActCat, $aFilter){

        $oArtList = oxNew( "oxarticlelist");
        $oArtList->loadCategoryIDs( $sActCat, $aFilter );
        $aRet = array();
        $iLang = oxLang::getInstance()->getBaseLanguage();

        // Only if we have articles
        if (count($oArtList) > 0 ) {
            $oDb = oxDb::getDb();
            $sArtIds = '';
            foreach (array_keys($oArtList->getArray()) as $sId ) {
                if ($sArtIds) {
                    $sArtIds .= ',';
                }
                $sArtIds .= $oDb->quote($sId);
            }
            $sActCatQuoted = $oDb->quote($sActCat);
            $sAttTbl = getViewName( 'oxattribute', $iLang );
            $sO2ATbl = getViewName( 'oxobject2attribute', $iLang );
            $sC2ATbl = getViewName( 'oxcategory2attribute', $iLang );

            $sSelect = "SELECT DISTINCT att.oxid, att.oxtitle, o2a.oxvalue ".
                       "FROM $sAttTbl as att, $sO2ATbl as o2a ,$sC2ATbl as c2a ".
                       "WHERE att.oxid = o2a.oxattrid AND c2a.oxobjectid = $sActCatQuoted AND c2a.oxattrid = att.oxid AND o2a.oxvalue !='' AND o2a.oxobjectid IN ($sArtIds) ".
                       "ORDER BY c2a.oxsort , att.oxpos, att.oxtitle, o2a.oxvalue";

            $rs = $oDb->execute( $sSelect );
            if ($rs != false && $rs->recordCount() > 0) {
                $oStr = getStr();
                while ( !$rs->EOF && list($sAttId,$sAttTitle, $sAttValue) = $rs->fields ) {
                    $aAtt = array();
                    $aAtt["sAttId"] = $sAttId;
                    $aAtt["sAttTitle"] = $sAttTitle;
                    $aAtt["sAttValue"] = $sAttValue;
                    $aRet[] = $aAtt;
                    $rs->moveNext();
                }
            }
        }
        return $aRet;
    }
}
