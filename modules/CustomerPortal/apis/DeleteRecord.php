<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/
require_once 'include/Webservices/Delete.php';

class CustomerPortal_DeleteRecord extends CustomerPortal_API_Abstract
{

	protected $recordValues = false;
	protected $mode = 'edit'; //FIXME - Mode



	function process(CustomerPortal_API_Request $request)
	{
		$response = new CustomerPortal_API_Response();
		global $current_user, $adb;
		$current_user = $this->getActiveUser();

		if ($current_user) {
			$module = $request->get('module');

			$recordId = $request->get('recordId');
			if ($recordId) {
				$module = VtigerWebserviceObject::fromId($adb, $recordId)->getEntityName();
			}
			else{
				throw new Exception("Record not provided", 1412);
				exit;
			}
			if (!CustomerPortal_Utils::isModuleActive($module)) {
				throw new Exception("Module not accessible", 1412);
				exit;
			}

			
			//NOTE - Delete record possible only for Billing module, add later other modules if needed 
			if (in_array($module, array('Billing'))) {
				$recordId = $request->get('recordId');
				if (empty($recordId)) {
					throw new Exception("Record not found", 1412);
					exit;
				} else {
					if (!CustomerPortal_Utils::isModuleRecordDeletable($module)) {
						throw new Exception("Module record cannot be deleted", 1412);
						exit;
					}
				}
						
				try {
					vtws_delete($recordId, $current_user);
				} catch (Exception $e) {
					throw new Exception("Module record cannot be deleted", 1412);
					exit;
				}
				$response->setResult(array('record' => $recordId));
				
			} else {
				$response->setError(1404, 'Delete operation not supported for this module');
			}
			return $response;
		}
	}
}
