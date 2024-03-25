<?php

include_once('vtlib/Vtiger/Module.php');
$moduleInstance = Vtiger_Module::getInstance('Accounts');
$accountsModule = Vtiger_Module::getInstance('Chargers');
$relationLabel  = 'Chargers';
$moduleInstance->setRelatedList(
      $accountsModule, $relationLabel, Array('ADD','SELECT')
);
echo "Relation is Created";

?>