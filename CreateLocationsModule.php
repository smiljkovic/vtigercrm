<?php
 /* Check vtiger_entityname table!!!!!!!!!!!! It shall contain modulename entry!!!! */
include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Package.php';
include_once 'includes/main/WebUI.php';

include_once 'include/Webservices/Utils.php';

$Vtiger_Utils_Log = true;

$MODULENAME = 'Locations';

$moduleInstance = new Vtiger_Module();
$moduleInstance->name = $MODULENAME;
$moduleInstance->parent = "Inventory";
$moduleInstance->save();

// Schema Setup
$moduleInstance->initTables();

// Webservice Setup
$moduleInstance->initWebservice();

// Field Setup
$block1 = new Vtiger_Block();
//$block1->label = 'LBL_' . strtoupper($moduleInstance->name) . '_INFORMATION';
$block1->label = 'Address Information';
$moduleInstance->addBlock($block1);

//Add custom module auto numbering
// $field0 = new Vtiger_Field();
// $field0->name = 'gateway_no';            // change fieldname
// $field0->label = 'Gateway Number';
// $field0->table = $moduleInstance->basetable;
// $field0->column = $field0->name;
// $field0->columntype = 'VARCHAR(100)';
// $field0->uitype = 4;
// $field0->presence = 0;
// $field0->displaytype = 1;
// $field0->typeofdata = 'V~O';
// $block1->addField($field0);
# setup auto value
$oEntity = new CRMEntity();
$oEntity->setModuleSeqNumber("configure",$moduleInstance->name,"LOC",1);  // change ENR to your sequence prefix 

// Add field here using normal defination
$field1 = new Vtiger_Field();
$field1->name = 'locationname';
$field1->table = $moduleInstance->basetable;
$field1->label = 'Location Name';
$field1->column = $field1->name;
$field1->columntype = 'VARCHAR(100)';
$field1->uitype = 2;
$field1->displaytype = 1;
$field1->presence = 0;
$field1->typeofdata = 'V~M';
$block1->addField($field1);

$moduleInstance->setEntityIdentifier($field1);

// Add field here using normal defination
$field2 = new Vtiger_Field();
$field2->name = 'locationstreet';
$field2->table = $moduleInstance->basetable;
$field2->label = 'Street and Number';
$field2->column = $field2->name;
$field2->columntype = 'VARCHAR(100)';
$field2->uitype = 2;
$field2->displaytype = 1;
$field2->presence = 0;
$field2->typeofdata = 'V~M';
$block1->addField($field2);

$field3 = new Vtiger_Field();
$field3->name = 'locationzip';
$field3->table = $moduleInstance->basetable;
$field3->label = 'ZIP code';
$field3->column = $field3->name;
$field3->columntype = 'VARCHAR(100)';
$field3->uitype = 2;
$field3->displaytype = 1;
$field3->presence = 0;
$field3->typeofdata = 'V~M';
$block1->addField($field3);

$field4 = new Vtiger_Field();
$field4->name = 'locationcity';
$field4->table = $moduleInstance->basetable;
$field4->label = 'City';
$field4->column = $field4->name;
$field4->columntype = 'VARCHAR(100)';
$field4->uitype = 2;
$field4->displaytype = 1;
$field4->presence = 0;
$field4->typeofdata = 'V~M';
$block1->addField($field4);

$field5 = new Vtiger_Field();
$field5->name = 'locationcountry';
$field5->table = $moduleInstance->basetable;
$field5->label = 'Country';
$field5->column = $field5->name;
$field5->columntype = 'VARCHAR(100)';
$field5->uitype = 2;
$field5->displaytype = 1;
$field5->presence = 0;
$field5->typeofdata = 'V~M';
$block1->addField($field5);


$mfield1 = new Vtiger_Field();
$mfield1->name = 'assigned_user_id';
$mfield1->label = 'Assigned To';
$mfield1->table = 'vtiger_crmentity';
$mfield1->column = 'smownerid';
$mfield1->uitype = 53;
$mfield1->displaytype = 1;
$mfield1->presence = 2;
$mfield1->typeofdata = 'V~M';
$block1->addField($mfield1);

$mfield2 = new Vtiger_Field();
$mfield2->name = 'createdtime';
$mfield2->label = 'Created Time';
$mfield2->table = 'vtiger_crmentity';
$mfield2->column = 'createdtime';
$mfield2->displaytype = 2;
$mfield2->uitype = 70;
$mfield2->typeofdata = 'DT~O';
$block1->addField($mfield2);

$mfield3 = new Vtiger_Field();
$mfield3->name = 'modifiedtime';
$mfield3->label = 'Modified Time';
$mfield3->table = 'vtiger_crmentity';
$mfield3->column = 'modifiedtime';
$mfield3->displaytype = 2;
$mfield3->uitype = 70;
$mfield3->typeofdata = 'DT~O';
$block1->addField($mfield3);


/* NOTE: Vtiger 7.1.0 onwards */
        $mfield4 = new Vtiger_Field();
        $mfield4->name = 'source';
        $mfield4->label = 'Source';
        $mfield4->table = 'vtiger_crmentity';
        $mfield4->displaytype = 2; // to disable field in Edit View
        $mfield4->quickcreate = 3;
        $mfield4->masseditable = 0;
        $block1->addField($mfield4);

        $mfield5 = new Vtiger_Field();
        $mfield5->name = 'starred';
        $mfield5->label = 'starred';
        $mfield5->table = 'vtiger_crmentity_user_field';
        $mfield5->displaytype = 6;
        $mfield5->uitype = 56;
        $mfield5->typeofdata = 'C~O';
        $mfield5->quickcreate = 3;
        $mfield5->masseditable = 0;
        $block1->addField($mfield5);

        $mfield6 = new Vtiger_Field();
        $mfield6->name = 'tags';
        $mfield6->label = 'tags';
        $mfield6->displaytype = 6;
        $mfield6->columntype = 'VARCHAR(1)';
        $mfield6->quickcreate = 3;
        $mfield6->masseditable = 0;
        $block1->addField($mfield6);
/* End 7.1.0 */

$block2 = new Vtiger_Block();
$block2->label = 'Geocoding Information';
$moduleInstance->addBlock($block2);

// Add field here using normal defination
$field21 = new Vtiger_Field();
$field21->name = 'latitude';
$field21->table = $moduleInstance->basetable;
$field21->label = 'Latitude';
$field21->column = $field21->name;
$field21->columntype = 'VARCHAR(100)';
$field21->uitype = 2;
$field21->displaytype = 1;
$field21->presence = 0;
$field21->typeofdata = 'V~O';
$block2->addField($field21);

$field22 = new Vtiger_Field();
$field22->name = 'longitude';
$field22->table = $moduleInstance->basetable;
$field22->label = 'Longitude';
$field22->column = $field22->name;
$field22->columntype = 'VARCHAR(100)';
$field22->uitype = 2;
$field22->displaytype = 1;
$field22->presence = 0;
$field22->typeofdata = 'V~O';
$block2->addField($field22);

// Filter Setup
$filter1 = new Vtiger_Filter();
$filter1->name = 'All';
$filter1->isdefault = true;
$moduleInstance->addFilter($filter1);
$filter1->addField($field1)->addField($mfield1, 1);


// Sharing Access Setup
$moduleInstance->setDefaultSharing('Public');

$targetpath = 'modules/' . $moduleInstance->name;

if (! is_file($targetpath)) {
    mkdir($targetpath);

    $templatepath = 'vtlib/ModuleDir/6.0.0';

    $moduleFileContents = file_get_contents($templatepath . '/ModuleName.php');
    $replacevars = array(
        'ModuleName' => $moduleInstance->name,
        '<modulename>' => strtolower($moduleInstance->name),
        '<entityfieldlabel>' => $field1->label,
        '<entitycolumn>' => $field1->column,
        '<entityfieldname>' => $field1->name
    );

    foreach ($replacevars as $key => $value) {
        $moduleFileContents = str_replace($key, $value, $moduleFileContents);
    }
    file_put_contents($targetpath . '/' . $moduleInstance->name . '.php', $moduleFileContents);
}

if (! file_exists('languages/en_us/ModuleName.php')) {
    $ModuleLanguageContents = file_get_contents($templatepath . '/languages/en_us/ModuleName.php');

    $replaceparams = array(
        'Module Name' => $moduleInstance->name,
        'Custom' => $moduleInstance->name,
        'ModuleBlock' => $moduleInstance->name,
        'ModuleFieldLabel Text' => $field1->label
    );

    foreach ($replaceparams as $key => $value) {
        $ModuleLanguageContents = str_replace($key, $value, $ModuleLanguageContents);
    }

    $languagePath = 'languages/en_us';
    file_put_contents($languagePath . '/' . $moduleInstance->name . '.php', $ModuleLanguageContents);
}

Settings_MenuEditor_Module_Model::addModuleToApp($moduleInstance->name, $moduleInstance->parent);

echo $moduleInstance->name." is Created";

?>

