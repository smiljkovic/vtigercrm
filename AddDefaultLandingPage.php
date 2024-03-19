 <?php

include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Package.php';
include_once 'includes/main/WebUI.php';

include_once 'include/Webservices/Utils.php';

$Vtiger_Utils_Log = true;

$MODULENAME = 'Users';

$moduleInstance = Vtiger_Module::getInstance($MODULENAME);
$blockInstance = Vtiger_Block::getInstance('LBL_MORE_INFORMATION', $moduleInstance);
    if ($blockInstance) {
        $fieldInstance = Vtiger_Field::getInstance('defaultlandingpage', $moduleInstance);
        if (!$fieldInstance) {
            $fieldInstance = new Vtiger_Field();
            $fieldInstance->name		= 'defaultlandingpage';
            $fieldInstance->column		= 'defaultlandingpage';
            $fieldInstance->label		= 'Default Landing Page';
            $fieldInstance->table		= 'vtiger_users';
            $fieldInstance->columntype = 'VARCHAR(100)';
            $fieldInstance->defaultvalue = $defaultModule;
            $fieldInstance->typeofdata = 'V~O';
            $fieldInstance->uitype		= '32';
            $fieldInstance->presence	= '0';

            $blockInstance->addField($fieldInstance);
            $configModuleInstance = Settings_Vtiger_ConfigModule_Model::getInstance();
            $defaultModules = $configModuleInstance->getPicklistValues('default_module');
            $fieldInstance->setPicklistValues($defaultModules);
            echo "<br> Default landing page field added <br>";
        }
    }

?>
