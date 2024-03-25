<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/
require_once 'include/Webservices/GetMeta.php';


class CustomerPortal_GetMeta extends CustomerPortal_API_Abstract {

	function process(CustomerPortal_API_Request $request) {
		/*
		'module' => $module,
			'moduleLabel' => $module,
			'recordId' => $recordId,
			'parentId' => $parentId,
			'parentModule' => $parentModule,
		*/
		
		global $adb;
		$parentId = $request->get('parentId');
		$recordId = $request->get('recordId');
		$module = $request->get('moduleLabel');

		if (!CustomerPortal_Utils::isModuleActive($module)) {
			throw new Exception("Records not Accessible for this module", 1412);
			exit;
		}

		if (!empty($parentId)) {
			if (!$this->isRecordAccessible($parentId)) {
				throw new Exception("Parent record not Accessible", 1412);
				exit;
			}
			$relatedRecordIds = $this->relatedRecordIds($module, CustomerPortal_Utils::getRelatedModuleLabel($module), $parentId);

			if (!in_array($recordId, $relatedRecordIds)) {
				throw new Exception("Record not Accessible", 1412);
				exit;
			}
		} else {
			if (!$this->isRecordAccessible($recordId, $module)) {
				throw new Exception("Record not Accessible", 1412);
				exit;
			}
		}
		
		$response = new CustomerPortal_API_Response();
		$current_user = $this->getActiveUser();

		if ($current_user) {
			$record = vtws_get_meta($recordId, $current_user);

			$response->setResult($record);
		}
		return $response;

	}

}
