<?php

include_once('vtlib/Vtiger/Module.php');
$moduleInstance = Vtiger_Module::getInstance('Locations');
$accountsModule = Vtiger_Module::getInstance('Chargers');
$relationLabel  = 'Chargers';
$moduleInstance->setRelatedList(
      $accountsModule, $relationLabel, Array('ADD'),'get_dependents_list');

echo "Relation is Created";

?>