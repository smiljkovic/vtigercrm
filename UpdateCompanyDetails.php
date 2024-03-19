<?php
include_once 'config.inc.php';
include_once 'include/database/PearDatabase.php';

$COMPANYNAME = 'OBLO Living LLC';
$COMPANYADDRESS = 'Narodnog Fronta 23a';
$COMPANYCITY = 'Novi Sad';
$COMPANYSTATE = '';
$COMPANYCOUNTRY = 'Serbia';
$COMPANYZIP = '21000';
$COMPANYPHONE = '+381 21 4801 101';
$COMPANYFAX = '';
$COMPANYWEBSITE = 'www.obloliving.com';

$adb = PearDatabase::getInstance();

// To add a settings link
echo "Company details update started ....<br/>";
$fieldid = $adb->getUniqueID('vtiger_organizationdetails');
$adb->pquery("UPDATE vtiger_organizationdetails SET organization_id=?, organizationname=?, address=?, city=?, state=?, country=?, code=?, phone=?, fax=?, website=?",
            array(1, $COMPANYNAME, $COMPANYADDRESS, $COMPANYCITY, $COMPANYSTATE, $COMPANYCOUNTRY, $COMPANYZIP, $COMPANYPHONE, $COMPANYFAX, $COMPANYWEBSITE));
echo "Company details update finished ....<br/><br/>";

