{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
<div class="cp-table-container" ng-hide="!pageInitialized || records.length" style="padding: 5px;">
  <div class="alert alert-warning" style="margin: 2px 0;" ng-show="pageInitialized">
    {{'No records found.'|translate}}
  </div>
</div>
<div class="cp-table-container" ng-show="records">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div class="panel panel-transparent">
        <div class="panel-table-body">
          <div class="table-responsive" style="overflow-x: visible;">
            <!--Nikola - present  Products as cards instead of table  -->
            <div ng-hide="module=='Products'" class="dataTables_wrapper form-inline no-footer">
              <table class="table table-hover table-condensed table-detailed dataTable no-footer" id="detailedTable"
                role="grid">
               <thead>
                
                  <thead>
                    <tr class="listViewHeaders">
                      <th ng-repeat="header in headers|limitTo:10" ng-hide="header=='id'" rowspan="1" colspan="1">
                        <a href="javascript:void(0);" class="listViewHeaderValues" ng-click="setSortOrder(header)"
                          data-nextsortorderval="ASC" data-columnname="{{header}}">{{header}}&nbsp;</a>
                        <span class="text-primary"
                          ng-class="{'glyphicon glyphicon-chevron-down':header==OrderBy && !reverse,'glyphicon glyphicon-chevron-up':header==OrderBy && reverse}"></span>
                      </th>
                      <th ng-if="module == 'Documents'" rowspan="1" colspan="1">
                        <a ng-if="module == 'Documents'" href="javascript:void(0);" translate="Actions"
                          class="listViewHeaderValues" ng-click="sortOrder(Subject)" data-nextsortorderval="ASC"
                          data-columnname="{{header}}">Actions</a>
                      </th>
                    </tr>
                  </thead>
                </thead>
                <tbody>
                  <tr class="listViewEntries" ng-repeat="record in records" total-items="totalPages"
                    current-page="currentPage">
                    <td ng-repeat="header in headers|limitTo:10" ng-hide="header=='id'" class="v-align-middle medium"
                      nowrap=" " ng-click="ChangeLocation(record)">
                      <ng-switch on="record[header].type">
                        <a ng-href="index.php?module={{module}}&view=Detail&id={{record.id}} "></a>
                        <span title="{{record[header]}}" 
                          ng-switch-default>{{record[header]|limitTo:25}}{{record[header].length > 25 ? '...'
                          :''}}</span>
                      </ng-switch>
                    </td>
                    <td ng-if="module=='Documents'">
                      <button ng-if=" module='Documents' && record.Type!=='' && record.documentExists "
                        ng-click="downloadFile(record.id) " class="btn btn-primary ">{{'Download'|translate}}</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            
            <!--This is new part related to Products module-->
            <div ng-show="module=='Products'" class="dataTables_wrapper form-inline no-footer">
                <div class="row">
                  <div class="col-lg-2 col-md-4 col-xs-12 col-sm-4" ng-repeat="record in records track by $index" total-items="totalPages" current-page="currentPage">
                        
                    
                      <div class="tile pt-inner">
                          <div class="pti-header"  style="background-color: {{record['color']}} !important;">
                            <img src="{{record['url']}}" style="height:100px;" alt="Product image">
                            
                            <div class="ptih-title">{{record['Product Name']}}</div>
                          </div>
                          <div class="pti-body">
                            <div class="ptib-item">
                              {{headers[1]}}:{{record[headers[1]]}}
                            </div>
                            <div class="ptib-item">
                              {{headers[3]}}:{{record[headers[3]]}}
                            </div>
                            <div class="ptib-item">
                              <h2> {{record['Unit Price']}}<small>EUR | mo</small></h2>
                            </div>
                          </div>
                          <div class="pti-footer">
                            <a href style="background-color: {{record['color']}} !important;" >Buy</a>
                          </div>
                        </div>
                      </div>
                    
                    <!-- <div class="wrapper">
                      <div class="product-img">
                        <img src="{{record['url']}}" height="420" width="327">
                      </div>
                      <div class="product-info">
                        <div class="product-text">
                          <h1>{{record['Product Name']}}</h1>
                          <h2>by studio and friends</h2>
                          <p>Harvest Vases are a reinterpretation<br> of peeled fruits and vegetables as<br> functional objects. The surfaces<br> appear to be sliced and pulled aside,<br> allowing room for growth. </p>
                        </div>
                        <div class="product-price-btn">
                          <p><span>{{record['Unit Price']}}</span>$</p>
                          <button type="button">buy now</button>
                        </div>
                      </div>
                    </div> -->
                    
       
                    </div>
                
             
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{/literal}