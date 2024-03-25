{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
    <script type="text/ng-template" id="editRecordModalBilling.template">
        <form class="form form-vertical" novalidate="novalidate" name="billingForm">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" ng-show="editRecord.id">Edit Payment Method - {{editRecord.billingname}}</h4>
				<h4 class="modal-title" ng-show="!editRecord.id">{{'Add New Payment Method'|translate}}</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'350px'}">
				
				<div class="form-group" ng-class="{'has-error':billingForm.billingname.$error.required && submit}" ng-if="!disabledFields['billingname']">
					<label>{{billingNameLabel}}
						<span class="text-danger">*</span>
					</label>
					<input type="text" class="form-control" name="billingname" ng-model="data['billingname']" required="true" required>
				</div>

				<div class="form-group">
					
					<div class="row" style="margin-bottom:10px;">
						<div class="col-sm-12 col-md-12 col-lg-12">
								<ng-form name="innerForm" ng-class="{'has-error':billingForm.cardnumber.$error.required && submit}" ng-if="!disabledFields['cardnumber']">
										<label>{{cardNumberLabel}}
											<span class="text-danger">*</span>
										</label>
										<div class="card-container" style="margin-bottom:10px;">
											<!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
											<div class="card-type"></div>
											<input placeholder="0000 0000 0000 0000" class="form-control" ng-model="data['cardnumber']" onkeyup="$cc.validate(event)" />
											<!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
											<!-- <div class="card-valid"> ok &#xea10;</div> -->
											<div class="card-valid"> <i class="fa fa-check"></i> </div>
										</div>
								</ng-form>
						</div>
					</div>	

					<div class="row" style="margin-bottom:10px;" ng-repeat="editables in fields">
						<div class="col-sm-6 col-md-6 col-lg-6" ng-repeat="editable in editables">
							<ng-switch on="editable.name">
								
								<div ng-switch-when="cardexpirationdate">
										<ng-form name="innerForm" ng-class="{'has-error':innerForm.name.$error.required && submit}">
												<label>{{editable.label}}</label>
												<span ng-show="{{editable.mandatory}}" class="text-danger field-error mandatory-label">*</span>
												<input type="text" name="name" class="form-control" ng-model="data[$parent.editable.name]" ng-required="{{editable.mandatory}}">
										</ng-form>
								</div>
								<div ng-switch-when="cardcvc">
									<ng-form name="innerForm" ng-class="{'has-error':innerForm.name.$error.required && submit}">
											<label>{{editable.label}}</label>
											<span ng-show="{{editable.mandatory}}" class="text-danger field-error mandatory-label">*</span>
											<input type="text" name="name" class="form-control" ng-model="data[$parent.editable.name]" ng-required="{{editable.mandatory}}">
									</ng-form>
								</div>
								<div ng-switch-when="cardholdername">
									<ng-form name="innerForm" ng-class="{'has-error':innerForm.name.$error.required && submit}">
											<label>{{editable.label}}</label>
											<span ng-show="{{editable.mandatory}}" class="text-danger field-error mandatory-label">*</span>
											<input type="text" name="name" class="form-control" ng-model="data[$parent.editable.name]" ng-required="{{editable.mandatory}}">
									</ng-form>
								</div>
							</div>	
						</div> 		
					</div>
					

				</div>	
				
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="cancel()" translate="Cancel">Cancel</button>
				<button type="submit" class="btn btn-success" ng-click="save(billingForm.$valid)" translate="Save">Save</button>
			</div>
		</form>
    </script>
{/literal}
