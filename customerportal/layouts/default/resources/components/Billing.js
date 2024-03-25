/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 ************************************************************************************/

function Billing_IndexView_Component($scope, $api, $webapp, $modal, $translatePartialLoader) {

  if ($translatePartialLoader !== undefined) {
    $translatePartialLoader.addPart('home');
    $translatePartialLoader.addPart('Billing');
  }

  var availableModules = JSON.parse(localStorage.getItem('modules'));
  var currentModule = 'Billing';
  //set creatable true
  if (availableModules !== null && availableModules[currentModule]) {
    $scope.isCreatable = availableModules[currentModule].create;
    $scope.filterPermissions = availableModules[currentModule].recordvisibility;
  }

  angular.extend(this, new Portal_IndexView_Component($scope, $api, $webapp));
  $scope.searchQ = {
    onlymine: true
  }

  $scope.$on('editRecordModalBilling.Template', function () {
    $modal.open({
      templateUrl: 'editRecordModalBilling.template',
      controller: Billing_EditView_Component,
      backdrop: 'static',
      keyboard: 'false',
      resolve: {
        record: function () {
          return {};
        },
        api: function () {
          return $api;
        },
        webapp: function () {
          return $webapp;
        },
        module: function () {
          return 'Billing';
        },
        language: function () {
          return $scope.$parent.language;
        },
        editStatus: function () {
          return false;
        }
      }
    });
  });

  $scope.searchQ = {
    onlymine: true
  }
  $scope.isCreateable = true;
  $scope.viewLoading = true;

  /* 	Nikola - not needed as there is no search function
  
    $scope.$watch('searchQ.folder', function (nvalue, ovalue) {
      if (nvalue != ovalue) {
        $scope.loadRecords();
      }
    }); */

  $scope.create = function () {
    var modalInstance = $modal.open({
      templateUrl: 'editRecordModalBilling.template',
      controller: Billing_EditView_Component,
      backdrop: 'static',
      keyboard: 'false',
      resolve: {
        record: function () {
          return {};
        },
        api: function () {
          return $api;
        },
        webapp: function () {
          return $webapp;
        },
        module: function () {
          return $scope.module;
        },
        language: function () {
          return $scope.$parent.language;
        },
        editStatus: function () {
          return false;
        }
      }
    });
  }

  /* Nikola this is maybe not nedded */
  $scope.checkRecordsVisibility = function (filterValue) {
    var returnValue;
    switch (filterValue) {
      case "1":
        returnValue = true;
        break;
      case "0":
        returnValue = false;
        break;
      case "2":
        returnValue = false;
        break;
      default:
        returnValue = false;
    }
    return returnValue;
  }

}






function Billing_EditView_Component($scope, $modalInstance, record, api, webapp, module, $http, $translatePartialLoader, ngProgress, language, $filter, editStatus) {
  $scope.data = {};
  $scope.editRecord = angular.copy(record);
  $scope.structure = null;
  if ($translatePartialLoader !== undefined) {
    $translatePartialLoader.addPart('Billing');
  }

  function splitFields(arr, size) {
    var newArr = [];
    for (var i = 0; i < arr.length; i += size) {
      newArr.push(arr.slice(i, i + size));
    }
    return newArr;
  }

  if (!editStatus) {
    api.get(module + '/DescribeModule', {
      language: language
    })
      .success(function (structure) {
        var editables = [];
        var editablesText = [];
        $scope.timeLabels = [];
        $scope.multipicklistFields = [];
        //$scope.referenceFields = [];
        //$scope.nonAvailableReferenceFields = [];
        $scope.descriptionEnabled = false;
        $scope.disabledFields = [];
        angular.forEach(structure.describe.fields, function (field) {
          //If not editable push the field to disabledFields
          if (!field.editable) {
            $scope.disabledFields[field.name] = true;
          }

          if (field.name !== 'contact_id' && field.name !== 'parent_id' && field.name !== 'assigned_user_id' && field.name !== 'related_to' && field.editable && field.type.name !== "text") {
            //If not editable push the field to disabledFields
            if (!field.editable) {
              $scope.disabledFields[field.name] = true;
            }
            if (field.type.name == 'string' && field.editable) {
              $scope.data[field.name] = field.default;
              if (field.name == 'billingname') {
                $scope.billingNameLabel = field.label;
                $scope.data['billingname'] = field.default;
              }
              if (field.name == 'cardnumber') {
                $scope.cardNumberLabel = field.label;
              }
            }

            if (field.type.name == 'integer' && field.editable) {

              $scope.data[field.name] = field.default;

            }

            if (field.type.name == 'phone' || field.type.name == 'skype' && field.editable) {
              $scope.data[field.name] = field.default;
            }

            if (field.type.name == 'boolean' && field.editable) {
              if (field.default == "on") {
                $scope.data[field.name] = true;
              } else {
                $scope.data[field.name] = false;
              }
            }

            if (field.type.name == 'email' && field.editable) {
              $scope.data[field.name] = field.default;
            }

            if (field.type.name == 'url' && field.editable) {
              $scope.data[field.name] = field.default;
            }

            if (field.type.name == 'double' && field.editable) {
              $scope.data[field.name] = field.default;
            }

            if (field.type.name == 'currency' && field.editable) {
              $scope.data[field.name] = field.default;
            }



            if (field.type.name == 'multipicklist' && field.editable) {
              $scope.multipicklistFields.push(field.name);
              var defaultValues = [];
              if (field.default !== null) {
                defaultValues = field.default.split(' |##| ');
              }
              var selectedValues = [];
              if (defaultValues.length !== 0) {
                angular.forEach(defaultValues, function (values, i) {
                  var o = {};
                  o.label = defaultValues[i];
                  o.value = defaultValues[i];
                  selectedValues.push(o);
                });
              }
              $scope.data[field.name] = selectedValues;
            }

            if (field.type.name == 'picklist' && field.editable) {
              var continueLoop = true;
              var defaultValue = field.default;
              angular.forEach(field.type.picklistValues, function (pickList, i) {
                if (continueLoop) {
                  if (defaultValue !== '' && pickList.value == defaultValue) {
                    field.value = field.type.picklistValues[i];
                    field.index = i;
                    continueLoop = false;
                  } else if (defaultValue === '') {
                    field.value = field.type.picklistValues[i];
                    field.defaultIndex = i;
                    continueLoop = false;
                  }
                }
              });
              if (field.index === undefined) {
                $scope.data[field.name] = field.type.picklistValues[0].value;
              } else {
                $scope.data[field.name] = field.type.picklistValues[field.index].value;
              }
            }
            if (field.name !== 'billingname' && field.name !== 'cardnumber') {
              editables.push(field)
            }
          }
          if (field.type.name === "text" && field.editable) {
            $scope.data[field.name] = field.default;
            editablesText.push(field);
          }
        });
        var newEditables = [];
        angular.forEach(editables, function (field, i) {
          var isDeleted = false;
          if (field.type.name === "reference") {
            if (field.type.refersTo[0] === undefined || availableModules[field.type.refersTo[0]] === undefined) {
              isDeleted = true;
            }
          }
          if (!isDeleted) {
            /* if (field.type.name === "reference") {
              $scope.referenceFields.push(field.name);
            } */
            newEditables.push(field);
          }
        });
        editables = newEditables;
        $scope.fields = splitFields(editables, 2);
        if (editablesText.length !== 0) {
          $scope.textFieldsEnabled = true;
          $scope.editableText = editablesText;
        }
      });

  }

  $scope.save = function () {
      

    if ($scope.multipicklistFields.length !== 0) {
      angular.forEach($scope.multipicklistFields, function (label) {
        var choosenValues = $scope.data[label];
        var transformedValues = [];
        angular.forEach(choosenValues, function (values, i) {
          if (values.value !== '')
            transformedValues.push(values.value)
        });
        $scope.data[label] = '';
        if (transformedValues.length > 0) {
          $scope.data[label] = transformedValues;
        }
      });
    }

    
    // Filtering non-editable fields from POST data.
    angular.forEach($scope.data, function (data, i) {

      if ($scope.disabledFields[i]) {
        delete ($scope.data[i]);
      }
    });
    webapp.busy();
    if ($scope.data['billingid'] !== undefined) {
      $scope.data['billingid'] = $scope.data['billingid'].id;
    }
    
    var params = {
      record: $scope.data
    }

    if (editStatus)
      params.recordId = $scope.editRecord.id;
      $modalInstance.close($scope.data);
      api.post(module + '/SaveRecord', params)
      .success(function (savedRecord) {
        webapp.busy(false);
        $modalInstance.dismiss('cancel');
        if (savedRecord.record !== undefined) {
          var id = savedRecord.record.id.split('x');
          window.location.href = 'index.php?module=Billing&view=Detail&id=' + savedRecord.record.id;
        }
        if (savedRecord.record === undefined) {
          alert(savedRecord.message);
        }
      });
  }

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  }

  if (editStatus) {
		var editFields = [];
		var editableTextFields = [];
		/* $scope.referenceFields = [];
		$scope.nonAvailableReferenceFields = []; */
		$scope.multipicklistFields = [];
		//$scope.timeLabels = [];
		$scope.header = record.identifierName.label;
		$scope.modalTitle = record[ $scope.header ]
		$scope.disabledFields = [];
		api.get(module + '/DescribeModule')
				.success(function (describe) {
					var editableFields = describe.describe.fields;
					$scope.data[ 'billingname' ] = record[ record.identifierName.label ];
					angular.forEach(editableFields, function (field) {
						//If not editable push the field to disabledFields
						if (!field.editable) {
							$scope.disabledFields[ field.name ] = true;
						}
						if (field.name !== 'contact_id' && field.name !== 'parent_id' && field.name !== 'assigned_user_id' && field.name !== 'related_to' && field.type.name !== 'text' && field.editable) {
							if (field.type.name == 'string') {
								if (field.name == 'billingname') {
									$scope.billingNameLabel = field.label;
								}
                if (field.name == 'cardnumber') {
                  $scope.cardNumberLabel = field.label;
                }
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'integer') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'phone' || field.type.name == 'skype') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'boolean') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = false;
								}
								if (record[ field.label ] == "Yes" || field.default == "on") {
									$scope.data[ field.name ] = true;
								} else {
									$scope.data[ field.name ] = false;
								}
							}

							if (field.type.name == 'email') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'url') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

					
							

							if (field.type.name == 'currency') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'picklist') {
								var continueLoop = true;
								var defaultValue = field.default;
								angular.forEach(field.type.picklistValues, function (pickList, i) {
									if (continueLoop) {
										if (pickList.label == record[ field.label ] && record[ field.label ] !== '') {
											field.value = field.type.picklistValues[ i ];
											field.index = i;
											continueLoop = false;
										} else if (record[ field.label ] == '' && pickList.value == defaultValue) {
											field.value = field.type.picklistValues[ i ];
											field.index = i;
											continueLoop = false;
										}
									}
								});
								if (field.index === undefined) {
									$scope.data[ field.name ] = field.type.picklistValues[ 0 ].value;
								} else {
									$scope.data[ field.name ] = field.type.picklistValues[ field.index ].value;
								}
							}

							if (field.type.name == 'multipicklist') {
								$scope.multipicklistFields.push(field.name);
								var defaultValues = [];
								var recordValues = record[ field.label ].split(',');
								if (field.default !== null) {
									defaultValues = field.default.split(' |##| ');
								}
								var selectedValues = [];
								if (recordValues.length > 0 && recordValues[ 0 ] !== '') {
									angular.forEach(recordValues, function (values, i) {
										var o = {};
										o.label = values;
										o.value = values;
										selectedValues.push(o);
									});
								} else if ((recordValues.length > 0 || recordValues[ 0 ] !== '') && defaultValues.length > 0) {
									angular.forEach(defaultValues, function (values, i) {
										var o = {};
										o.label = values;
										o.value = values;
										selectedValues.push(o);
									});
								}
								$scope.data[ field.name ] = selectedValues;
							}

		

						
							if (field.name !== 'billingname') {
								editFields.push(field)
							}
						}
						if (field.type.name === "text" && field.editable) {
							editableTextFields.push(field);
							if (record[ field.label ] !== '') {
								$scope.data[ field.name ] = record[ field.label ];
							} else {
								$scope.data[ field.name ] = field.default;
							}
						}
					});

					var newEditFields = [];
					angular.forEach(editFields, function (field, i) {
						var isDeleted = false;
						
						if (!isDeleted) {
							
							newEditFields.push(field);
						}
						
					});
					editFields = newEditFields;
					$scope.fields = splitFields(editFields, 2);
					if (editableTextFields.length !== 0) {
						$scope.textFieldsEnabled = true;
						$scope.editableText = editableTextFields;
					}
				})
	}

}


var $cc = {}
$cc.validate = function (e) {

  //if the input is empty reset the indicators to their default classes
  if (e.target.value == '') {
    e.target.previousElementSibling.className = 'card-type';
    e.target.nextElementSibling.className = 'card-valid';
    return
  }

  //Retrieve the value of the input and remove all non-number characters
  var number = String(e.target.value);
  var cleanNumber = '';
  for (var i = 0; i < number.length; i++) {
    if (/^[0-9]+$/.test(number.charAt(i))) {
      cleanNumber += number.charAt(i);
    }
  }

  //Only parse and correct the input value if the key pressed isn't backspace.
  if (e.key != 'Backspace') {
    //Format the value to include spaces in the correct locations
    var formatNumber = '';
    for (var i = 0; i < cleanNumber.length; i++) {
      if (i == 3 || i == 7 || i == 11) {
        formatNumber = formatNumber + cleanNumber.charAt(i) + ' '
      } else {
        formatNumber += cleanNumber.charAt(i)
      }
    }
    e.target.value = formatNumber;
  }

  //run the Luhn algorithm on the number if it is at least equal to the shortest card length
  if (cleanNumber.length >= 12) {
    var isLuhn = luhn(cleanNumber);
  }

  function luhn(number) {
    var numberArray = number.split('').reverse();
    for (var i = 0; i < numberArray.length; i++) {
      if (i % 2 != 0) {
        numberArray[i] = numberArray[i] * 2;
        if (numberArray[i] > 9) {
          numberArray[i] = parseInt(String(numberArray[i]).charAt(0)) + parseInt(String(numberArray[i]).charAt(1))
        }
      }
    }
    var sum = 0;
    for (var i = 1; i < numberArray.length; i++) {
      sum += parseInt(numberArray[i]);
    }
    sum = sum * 9 % 10;
    if (numberArray[0] == sum) {
      return true
    } else {
      return false
    }
  }

  //if the number passes the Luhn algorithm add the class 'active'
  if (isLuhn == true) {
    e.target.nextElementSibling.className = 'card-valid active'
  } else {
    e.target.nextElementSibling.className = 'card-valid'
  }

  var card_types = [
    {
      name: 'amex',
      pattern: /^3[47]/,
      valid_length: [15]
    }, {
      name: 'diners_club_carte_blanche',
      pattern: /^30[0-5]/,
      valid_length: [14]
    }, {
      name: 'diners_club_international',
      pattern: /^36/,
      valid_length: [14]
    }, {
      name: 'jcb',
      pattern: /^35(2[89]|[3-8][0-9])/,
      valid_length: [16]
    }, {
      name: 'laser',
      pattern: /^(6304|670[69]|6771)/,
      valid_length: [16, 17, 18, 19]
    }, {
      name: 'visa_electron',
      pattern: /^(4026|417500|4508|4844|491(3|7))/,
      valid_length: [16]
    }, {
      name: 'visa',
      pattern: /^4/,
      valid_length: [16]
    }, {
      name: 'mastercard',
      pattern: /^5[1-5]/,
      valid_length: [16]
    }, {
      name: 'maestro',
      pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
      valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
    }, {
      name: 'discover',
      pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
      valid_length: [16]
    }
  ];

  //test the number against each of the above card types and regular expressions
  for (var i = 0; i < card_types.length; i++) {
    if (number.match(card_types[i].pattern)) {
      //if a match is found add the card type as a class
      e.target.previousElementSibling.className = 'card-type ' + card_types[i].name;
    }
  }
}

$cc.expiry = function (e) {
  if (e.key != 'Backspace') {
    var number = String(this.value);

    //remove all non-number character from the value
    var cleanNumber = '';
    for (var i = 0; i < number.length; i++) {
      if (i == 1 && number.charAt(i) == '/') {
        cleanNumber = 0 + number.charAt(0);
      }
      if (/^[0-9]+$/.test(number.charAt(i))) {
        cleanNumber += number.charAt(i);
      }
    }

    var formattedMonth = ''
    for (var i = 0; i < cleanNumber.length; i++) {
      if (/^[0-9]+$/.test(cleanNumber.charAt(i))) {
        //if the number is greater than 1 append a zero to force a 2 digit month
        if (i == 0 && cleanNumber.charAt(i) > 1) {
          formattedMonth += 0;
          formattedMonth += cleanNumber.charAt(i);
          formattedMonth += '/';
        }
        //add a '/' after the second number
        else if (i == 1) {
          formattedMonth += cleanNumber.charAt(i);
          formattedMonth += '/';
        }
        //force a 4 digit year
        else if (i == 2 && cleanNumber.charAt(i) < 2) {
          formattedMonth += '20' + cleanNumber.charAt(i);
        } else {
          formattedMonth += cleanNumber.charAt(i);
        }

      }
    }
    this.value = formattedMonth;
  }
}

