 <?php

include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Package.php';
include_once 'includes/main/WebUI.php';

include_once 'include/Webservices/Utils.php';

$Vtiger_Utils_Log = true;

$MODULENAME = 'Accounts';
$HIDEFIELDS = true;
$fieldsArray = array(
    'fax', // Office Phone
    'tickersymbol', // Title
    'otherphone',
    'account_id',
    'employees',
    'email2',
    'ownership',
    'rating',
    'industry',
    'accounttype',
    'annual_revenue',
    'emailoptout',
    'notify_owner',
    'isconvertedfromlead',
    //address details
    'bill_state',
    'bill_pobox',
    'ship_street',
    'ship_city',
    'ship_state',
    'ship_code',
    'ship_country',
    'ship_pobox'
);


$moduleInstance = Vtiger_Module::getInstance($MODULENAME);
if($moduleInstance) {
    
    foreach ($fieldsArray as $field) {
        $fieldInstance = Vtiger_Field::getInstance($field, $moduleInstance);
        
        if($fieldInstance) {

            $db = PearDatabase::getInstance();
            if ($HIDEFIELDS == 'true'){
                echo "Hiding ".$field.".<br/>";
                $result = $db->pquery('UPDATE vtiger_field SET presence = ? WHERE tabid = 6 AND fieldid = ?',array('1', $fieldInstance->id));
                
            } else {
                echo "Unhiding ".$field.".<br/>";
                $result = $db->pquery('UPDATE vtiger_field SET presence = ? WHERE tabid = 6 AND fieldid = ?',array('2', $fieldInstance->id));
                                
            }
        } else {
            echo $field." not found.<br/>";
        }
    }
    
} else {
    echo $MODULENAME." can not be found.<br/>";
}
 
    

?>
