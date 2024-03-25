<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/

class Portal_DeleteRecord_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		$module = $request->getModule();
		$recordId = $request->get('recordId');
		
		// $requestParams['assigned_user_id'] = Portal_Session::get('assigned_user_id');
		$result = Vtiger_Connector::getInstance()->deleteRecord($module, $recordId);
		$response = new Portal_Response();
		$response->setResult($result);

		return $response;
	}

}
