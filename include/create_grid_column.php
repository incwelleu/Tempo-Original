<?php
/*

  Crea las columnas de los grid


*/
define('TYPE_COLUMN', 'Type_column');
define('ALIGNMENT', 'Alignment');
define('CAN_EDIT', 'CanEdit');
define('CAN_FILTER', 'CanFilter');
define('CAN_MOVE', 'CanMove');
define('CAN_RESIZE', 'CanResize');
define('CAN_SCROLL', 'CanScroll');
define('CAN_SELECT', 'CanSelect');
define('CAN_SORT', 'CanSort');
define('CAPTION', 'Caption');
define('DATA_FIELD', 'DataField');
define('EDITOR_TYPE', 'EditorType');
define('DEFAULT_FILTER', 'DefaultFilter');
define('FILTER_METHOD', 'FilterMethod');
define('FILTER', 'Filter');
define('SHOW_AVG', 'ShowAvg');
define('SHOW_COUNT', 'ShowCount');
define('SHOW_MAX', 'ShowMax');
define('SHOW_MIN', 'ShowMin');
define('SHOW_SUM', 'ShowSum');
define('SHOW_SORT_BUTTON', 'ShowSortButton');
define('VISIBLE', 'Visible');
define('WIDTH', 'Width');

//Column Type Text
define('DATA_FORMAT', 'DataFormat');
define('IS_PASSWORD', 'IsPassword');
define('MAX_LENGTH', 'MaxLength');
define('EDITOR_TYPE', 'EditorType');
define('TEXT_FIELD', 'TextField');
define('FILTER_OPTIONS', 'FilterOptions');
define('COMBOBOX_EDITOR', 'ComboBoxEditor');
define('HYPER_LINK_FIELD', 'HyperlinkField');


//LokokupComboBoxEditor
define('LOOKUP_COMBOBOX', 'LookupComboBoxEditor');
define('DATASOURCE', 'Datasource');
define('VALUE_FIELD', 'ValueField');


//Column Type Date
define('DISPLAY', 'Display'); //DateOnly, DateAndTime, TimeOnly
define('FORMAT', 'Format');   // Y-m-d,  Y-m-d H:i:s
define('TIME_FORMAT', 'TimeFormat');  //tt12Hour, tt24Hour

//Column Type Boolean
define('DISPLAY_FORMAT', 'DisplayFormat'); //CheckBox, Numeric, Text
define('TRUE_TEXT', 'TrueText');
define('FALSE_TEXT', 'FalseText');

//Columna Type Image
define('DATA_TYPE', 'DataType');
define('FILE_NAME_FORMAT', 'FileNameFormat');

//Column Type Memo
define('LIMIT', 'Limit');
define('CHARACTER_LIMIT', 'CharacterLimit');
define('WORD_LIMIT', 'WordLimit');


$GRID_COLUMN_DEFAULT = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', WIDTH => 80);

//Columnas Predefinidas
$GRID_COLUMN = array( 'company_id' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_SHORT_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                							WIDTH => 100),
										  'company_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_COMPANY_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                							WIDTH => 200),
											'short_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_SHORT_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                							WIDTH => 100),
											'description' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_DESCRIPTION,
                                              DEFAULT_FILTER => 'Contains',
                                              MAX_LENGTH => 100,
                                							WIDTH => 300),
											'description_service' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
																							DATA_FIELD => 'description',
                                              CAPTION => SW_CAPTION_DESCRIPTION,
                                              DEFAULT_FILTER => 'Contains',
                                              MAX_LENGTH => 255,
                                							WIDTH => 300),
											'quantity_no' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_QUANTITY,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 60),
											'price_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PRICE,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 70),
											'subtotal_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_SUBTOTAL,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 70, SHOW_SUM => True),
											'total_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TOTAL,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 70, SHOW_SUM => True),
											'paid_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PAID,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 70, SHOW_SUM => True),
											'pending_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PENDING_AMOUNT,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 70, SHOW_SUM => True),
                      'commission_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								                        ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
                                              CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_COMMISSION,
                                              DEFAULT_FILTER => 'Equal',
                                              DATA_FORMAT => '%01.2f',
                                              WIDTH => 70, SHOW_SUM => True),
											'created_by_user_id' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_CREATED_BY,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'Edit',
                                              TEXT_FIELD => 'username',
                                							WIDTH => 70,
                                              CAN_EDIT => false),
											'username' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_USER,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'Edit',
                                              TEXT_FIELD => 'username',
                                							WIDTH => 70,
                                              CAN_EDIT => false),
											'status_cd' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_STATUS_CD,
                                              DEFAULT_FILTER => 'Equal',
																							EDITOR_TYPE => 'ComboBox',
                                							WIDTH => 80),
											'created_dt' => array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                      												ALIGNMENT => 'agCenter',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_CREATED_DT,
                                              DEFAULT_FILTER => 'Contains',
                                              DISPLAY => 'DateOnly',
                                              FORMAT => 'Y-m-d H:i:s',
                                              TIME_FORMAT => 'tt24Hour',
                                							WIDTH => 100,
                                              CAN_EDIT => false),
											'paid_dt' => array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                      												ALIGNMENT => 'agCenter',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PAID_DT,
                                              DEFAULT_FILTER => 'Contains',
                                              DISPLAY => 'DateOnly',
                                              FORMAT => 'Y-m-d',
                                              TIME_FORMAT => 'tt24Hour',
                                							WIDTH => 90),
										  'invoice_number' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_INVOICE_NUMBER,
                                              DEFAULT_FILTER => 'Contains',
                                              MAX_LENGTH => 20,
                                							WIDTH => 90),
											'invoice_dt' => array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                      												ALIGNMENT => 'agCenter',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_INVOICE_DT,
                                              DEFAULT_FILTER => 'Contains',
                                              DISPLAY => 'DateOnly',
                                              FORMAT => 'Y-m-d',
                                              TIME_FORMAT => 'tt24Hour',
                                							WIDTH => 90),
										  'first_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_FIRST_NAME,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 150),
										  'last_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_LAST_NAME,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 150),
										  'email' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_EMAIL,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 200),
											'base_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_BASE_TAX,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 100, SHOW_SUM => True),
											'rate_no' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TAX_RATE,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 80),
											'tax_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TAX,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 100, SHOW_SUM => True),
											'base_withholding_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_BASE_WITHHOLDING,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 100, SHOW_SUM => True),
											'other_income_amt' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                      												ALIGNMENT => 'agRight',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_OTHER_INCOME,
                                              DEFAULT_FILTER => 'Equals',
                                              DATA_FORMAT => '%01.2f',
                                							WIDTH => 100, SHOW_SUM => True),
											'service_category_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_SERVICE_CATEGORY_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'ComboBox',
                                              MAX_LENGTH => 100,
                                							WIDTH => 120),
											'service_type_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_SERVICE_TYPE,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'ComboBox',
                                              MAX_LENGTH => 100,
                                							WIDTH => 80),
										  'tax_ident_type_cd' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_DOCUMENT_TYPE,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                              MAX_LENGTH => 20,
                                							WIDTH => 150),
										  'tax_ident' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TAX_IDENT,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                              MAX_LENGTH => 20,
                                							WIDTH => 100),
										  'client_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_CLIENT_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                              MAX_LENGTH => 200,
                                							WIDTH => 200),
											'payment_method_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PAYMENT_METHOD,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'ComboBox',
                                              MAX_LENGTH => 100,
                                							WIDTH => 150),
											'contact_id' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_CONTACT_NAME,
                                              DEFAULT_FILTER => 'Contains',
																							EDITOR_TYPE => 'LookupComboBox',
                                							WIDTH => 100),
											'invoice_pdf' => array(TYPE_COLUMN => 'JTPlatinumGridImageColumn',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => '',
                                              DATA_TYPE => 'FileName',
                                							WIDTH => 32),
											'link' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                                              CAN_EDIT => False,
																							CAN_MOVE => False,
                                              CAPTION => '',
                                							WIDTH => 0,
                                              VISIBLE => False),
											'account_manager_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_ACCOUNT_MANAGER,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 110,
                                              CAN_EDIT => false),
											'accounting_provider_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_ACCOUNTANT_MANAGER,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 110,
                                              CAN_EDIT => false),
											'payroll_provider_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_PAYROLL_MANAGER,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 110,
                                              CAN_EDIT => false),
											'tax_type_name' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TYPE_OPERATION,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 110,
                                              CAN_EDIT => false),
											'account_cd' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_TYPE_OPERATION,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 110,
                                              CAN_EDIT => false),
                      'service_id' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									                      CAN_FILTER => False, CAN_SELECT => False,
      								                        CAN_SORT => False, CAPTION => '',
                                              VISIBLE => FALSE),
                      'notes_memo' => array(TYPE_COLUMN => 'JTPlatinumGridMemoColumn', ALIGNMENT => 'agLeft',
      									                      CAN_FILTER => False, CAN_SELECT => False,
      								                        CAN_SORT => False, CAPTION => SW_CAPTION_NOTES, WIDTH => 200,
                                              VISIBLE => True, DATA_FIELD => 'notes', CHARACTER_LIMIT => 250),
											'mobile_phone' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_MOBILE_PHONE,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 100),
											'fixed_phone' => array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
																							CAN_MOVE => False,
                                              CAPTION => SW_CAPTION_FIXED_PHONE,
                                              DEFAULT_FILTER => 'Contains',
                                							WIDTH => 100)
										);


//
//	$column_name  => Field name in Table
//  $grid 				=> Grid of Column
//  $property_column => Property column
function sw_create_grid_column($column_name, $grid, $property_column)
{
  Global $GRID_COLUMN, $GRID_COLUMN_DEFAULT;


  if (!$grid_column = $GRID_COLUMN[$column_name]){
  	$grid_column = $property_column;
    if (!$grid_column){
    	$grid_column = $GRID_COLUMN_DEFAULT;
      $grid_column[CAPTION] = $column_name;
    }
  }

  $grid_column = $grid_column && $property_column ? array_merge($grid_column, $property_column) : $grid_column;

  if ($grid_column){
  	$column_type = $grid_column[TYPE_COLUMN] ? $grid_column[TYPE_COLUMN] : 'JTPlatinumGridTextColumn';
    unset($grid_column[TYPE_COLUMN]);
		$eval = "\$column = new $column_type(\$grid);";
  	eval($eval);

		$column->DataField = $column_name;
		$column->Name = $column_name;

  	//Default Value
  	foreach ($grid_column as $property => $value){
    	if ($property == IS_PASSWORD || $property == MAX_LENGTH){
    		$eval = "\$column->EditEditor->$property = ";
      }else if ($property == SHOW_AVG || $property == SHOW_COUNT ||
      					$property == SHOW_MAX || $property == SHOW_MIN ||
								$property == SHOW_SUM) {
    		$eval = "\$column->Summary->$property = ";
      }else if ($property == LOOKUP_COMBOBOX){
      	foreach ($value as $lookup_property => $property_value){
    			$eval = "\$column->". LOOKUP_COMBOBOX ."->\$lookup_property = \$property_value;";
  				eval($eval);
        }
    		$value = null;
      }else if ($property == COMBOBOX_EDITOR){
      	if (!array_key_exists('0', $value)) {
        	$filter = array_merge(array(0=>''), $value);
        }
      	$eval = "\$column->FilterOptions = \$filter;";
        eval($eval);
    		$eval = "\$column->". COMBOBOX_EDITOR ."->Values = ";
      }else{
    		$eval = "\$column->$property = ";
      }
      $eval .= is_string($value) ? "'{$value}';" : "\$value;";
      if (!is_null($value)) eval($eval);
  	}
  }
	return $column;
}


?>