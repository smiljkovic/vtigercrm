 <?php

include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Package.php';
include_once 'includes/main/WebUI.php';

include_once 'include/Webservices/Utils.php';

$Vtiger_Utils_Log = true;

$MODULENAME = 'Contacts';
$HIDEFIELDS = true;
$fieldsArray = array(
    'phone', // Office Phone
    'title', // Title
    'fax',
    'department',
    'reportsto',
    'secondaryemail',
    'donotcall',
    'emailoptout',
    'reference',
    'notify_owner',
    'leadsource',
    'otherphone',
    'assistant',
    'assistantphone',
    //address details
    'otherstreet',
    'othercity',
    'mailingstate',
    'otherstate',
    'otherzip',
    'othercountry',
    'mailingpobox',
    'otherpobox',
    'imagename'
    
 
);


$moduleInstance = Vtiger_Module::getInstance($MODULENAME);
if($moduleInstance) {
    
    foreach ($fieldsArray as $field) {
        $fieldInstance = Vtiger_Field::getInstance($field, $moduleInstance);
        
        if($fieldInstance) {

            $db = PearDatabase::getInstance();
            if ($HIDEFIELDS == 'true'){
                echo "Hiding ".$field.".<br/>";
                $result = $db->pquery('UPDATE vtiger_field SET presence = ? WHERE tabid = 4 AND fieldid = ?',array('1', $fieldInstance->id));
                
            } else {
                echo "Unhiding ".$field.".<br/>";
                $result = $db->pquery('UPDATE vtiger_field SET presence = ? WHERE tabid = 4 AND fieldid = ?',array('2', $fieldInstance->id));
                                
            }
        } else {
            echo $field." not found.<br/>";
        }
    }
    
} else {
    echo $moduleInstance->name." can not be found.<br/>";
}
 
    

?>
