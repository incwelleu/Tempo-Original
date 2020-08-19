<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");
require_once("include/geoiploc.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");

//Class definition
class service_agreement extends fmstrong
{
    public $sqlPayment_method_billing = null;
    public $dsPayment_method_billing = null;
    public $sqlService_agreement_paid = null;
    public $dsService_agreement_paid = null;
    public $lbPaid_amt = null;
    public $paid_amt = null;
    public $lbBank_account = null;
    public $bank_account_id = null;
    public $sqlCompany_bank_account = null;
    public $dsCompany_bank_account = null;
    public $lbPayment_method = null;
    public $sqlPayment_method = null;
    public $dsPayment_method = null;
    public $btnSavePayment = null;
    public $paid_by = null;
    public $lbPaid_by = null;
    public $lbPaid_dt = null;
    public $paid_dt = null;
    public $lbCopylink = null;
    public $copy_link = null;
    public $winProcess = null;
    public $btnServiceAgreement = null;
    public $ImageList = null;
    public $service_agreement_id = null;
    public $sqlService_agreement = null;
    public $dsService_agreement = null;
    public $SiteTheme = null;
    public $SelectedKeysField = null;
    public $status_cd = null;
    public $payment_method_id = null;
    public $gridService_agreement = null;
    public $gridService_agreement_paid = null;
    public $cbShowInvoicedCanceled = null;
    public $billing_entity_id = null;

    function service_agreementCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->Parameter();
    }


    function Parameter()
    {
      Global $language, $SW_STATUS_SERVICE_AGREEMENT_CD, $lbShowInvoicedAndCanceled;

      if (!$this->gridService_agreement->inSession('')){
      	$this->CreatedColumnGrid();
				$this->CreatedColumnGridPaid();
      }

      Define('COL_ACCOUNTED', $this->gridService_agreement_paid->findColumnByName('accounted_yn'));
      Define('COL_STATUS', $this->gridService_agreement->findColumnByName('status_cd'));
      Define('COL_BILLING_ENTITY', $this->gridService_agreement->findColumnByName('billing_entity_id'));
      Define('COL_IMG', $this->gridService_agreement->findColumnByName('img'));

      $this->lbTitle->Caption = "Service agreement";
      $this->lbTitle->Visible = True;
      $this->cbShowInvoicedCanceled->Caption = $lbShowInvoicedAndCanceled;
      $this->winProcess->Hide();

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "9");
      $items['btnAdd'] = array(btnAdd, 1, "2");
      $items['btnDelete'] = array(btnDelete, 1, "6");
      $items['btnEdit'] = array(btnEdit, 1, "3");
      $items['btnSubmitted'] = array("Copy link", 1);
      $items['btnRejected'] = array(btnCancel, 1);
      $items['btnPaid'] = array(btnPaid, 1);
      $this->btnServiceAgreement->Items = $items;

			$sql = "SELECT payment_method_id, {$language} as payment_method_name
							FROM payment_method
							ORDER BY {$language}";
      $this->sqlPayment_method->Active = False;
      $this->sqlPayment_method->SQL = $sql;
      $this->sqlPayment_method->Active = True;

     	$this->sqlPayment_method_billing->Active = False;
     	$this->sqlPayment_method_billing->SQL = $sql;
     	$this->sqlPayment_method_billing->Active = True;
    }


		function CreatedColumnGrid()
    {
    	Global $SW_STATUS_SERVICE_AGREEMENT_CD;

      $this->gridService_agreement->Datasource->DataSet->close();
    	$this->gridService_agreement->Columns = array();
      sw_view_filter_grid($this->gridService_agreement);
      $this->gridService_agreement->Header->ShowFilterBar = False;

      $record = $SW_STATUS_SERVICE_AGREEMENT_CD;
      array_unshift($record, "");
      $columns[] = sw_create_grid_column('status_cd', $this->gridService_agreement, array(FILTER_OPTIONS => $record));
      $columns[] = sw_create_grid_column('created_dt', $this->gridService_agreement);

			$property = array(FILTER => $_SESSION['username']);
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridService_agreement, $property);

      $columns[] = sw_create_grid_column('accepted_dt', $this->gridService_agreement);
      $columns[] = sw_create_grid_column('first_name', $this->gridService_agreement, array(WIDTH => 100));
      $columns[] = sw_create_grid_column('last_name', $this->gridService_agreement, array(WIDTH => 100));
      $columns[] = sw_create_grid_column('company_id', $this->gridService_agreement, array(TEXT_FIELD=>'short_name'));
      $columns[] = sw_create_grid_column('total_amt', $this->gridService_agreement);
      $columns[] = sw_create_grid_column('paid_amt', $this->gridService_agreement);
      $columns[] = sw_create_grid_column('pending_amt', $this->gridService_agreement);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_ACCEPTED], DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 90, CAN_EDIT => false);
      $columns[] = sw_create_grid_column('accepted_yn', $this->gridService_agreement, $property);
      $columns[] = sw_create_grid_column('email', $this->gridService_agreement);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								  CAPTION => 'Client IP',
                        WIDTH => 90, CAN_EDIT => false);
      $columns[] = sw_create_grid_column('remote_address', $this->gridService_agreement, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								  CAPTION => 'Client country',
                        WIDTH => 100, CAN_EDIT => false);
      $columns[] = sw_create_grid_column('country_address', $this->gridService_agreement, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridImageColumn', CAPTION => '', 'DataType' => 'FileName', WIDTH => 25);
      $columns[] = sw_create_grid_column('img', $this->gridService_agreement, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '', VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('service_agreement_id', $this->gridService_agreement, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '', VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('billing_entity_id', $this->gridService_agreement, $property);

    	$this->gridService_agreement->Columns = $columns;
      $this->gridService_agreement->ReadOnly = True;
	  	$this->gridService_agreement->Header->ShowFilterBar = True;
      $this->gridService_agreement->SortBy = 'created_dt desc';
      $this->gridService_agreement->Datasource->DataSet->open();
      $this->gridService_agreement->init();
    }


    //Created column paid
		function CreatedColumnGridPaid()
    {
      $this->gridService_agreement_paid->Datasource->DataSet->close();
    	$this->gridService_agreement_paid->Columns = array();


      $columns[] = sw_create_grid_column('paid_dt', $this->gridService_agreement_paid, array(CAN_EDIT => false));
			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      									CAPTION => SW_CAPTION_PAID_BY, WIDTH => 200,
                        DEFAULT_FILTER => 'Contains', CAN_EDIT => false);
      $columns[] = sw_create_grid_column('paid_by', $this->gridService_agreement_paid, $property);
      $columns[] = sw_create_grid_column('paid_amt', $this->gridService_agreement_paid);

			$property = array(CAN_EDIT => false);
      $columns[] = sw_create_grid_column('payment_method_name', $this->gridService_agreement_paid, $property);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      									CAPTION => SW_CAPTION_BANK_ACCOUNT, WIDTH => 200,
                        DEFAULT_FILTER => 'Contains', CAN_EDIT => false);
      $columns[] = sw_create_grid_column('bank_account_name', $this->gridService_agreement_paid, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridService_agreement_paid);
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridService_agreement_paid);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => SW_CAPTION_ACCOUNTED_YN, DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 90 );
      $columns[] = sw_create_grid_column('accounted_yn', $this->gridService_agreement_paid, $property);

    	$this->gridService_agreement_paid->Columns = $columns;
      $this->gridService_agreement_paid->ReadOnly = False;
      $this->gridService_agreement_paid->SortBy = 'paid_dt';
      $this->gridService_agreement_paid->Datasource->DataSet->open();
    }

    function btnServiceAgreementJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
        var info = getEventTarget( event ).id.split( "_" );
        var toolButton = info[ 0 ];
        var toolButtonName = info[ 1 ];

        if (toolButton == 'btnServiceAgreement'){
        	if (toolButtonName == 'btnFilter') {
          	gridService_agreement.deselectAll();
						gridService_agreement._showWaitWindow();
          	params = [0];
        		<?php echo $this->gridService_agreement->ajaxCall('filter_grid', array(), array($this->gridService_agreement->Name)); ?>
          	return false;
        	}
          else if ((toolButtonName == 'btnDelete') ||
          					(toolButtonName == 'btnSubmitted') ||
              			(toolButtonName == 'btnRejected') ||
                    (toolButtonName == 'btnPaid')) {
            	var keys = [];
            	for (var row in gridService_agreement.SelectedCells) {
              	if (typeof(gridService_agreement.SelectedCells[row]) != "function" &&
                		(gridService_agreement.SelectedCells[row] != '') &&
                    (gridService_agreement.SelectedCells[row] != null)) {
                  keys.push(gridService_agreement.getPrimaryKey(row));
              	}
            	}

            	if (findObj('SelectedKeysField').value = keys.join(',')){
              	if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
            	}
            	else return false;
          }
        	return true;
        }
        //end
        <?php
    }

    function btnServiceAgreementClick($sender, $params)
    {
    	Global $SW_STATUS_SERVICE_AGREEMENT_CD;

      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );
      $status_cd = $this->status_cd->Value;

      if (($toolButtonName == 'btnAdd') || ($toolButtonName == 'btnEdit')) {
        $primaryKey = ($toolButtonName == 'btnAdd') ? 0 : $this->service_agreement_id->Value;
        redirect_url("add_service_agreement.php?ID={$primaryKey}");
      }else if ($toolButtonName == 'btnDelete') {
        $this->DeleteServiceAgreement();
      }else if ($toolButtonName == 'btnSubmitted'){
        $this->CopyLink();
      }else if ($toolButtonName == 'btnRejected' &&
      					($status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_SENT] ||
                 $status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_ACCEPTED] ||
                 $status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_REJECTED])) {
        $this->RejectedServiceAgreement();
      }else if ($toolButtonName == 'btnPaid' &&
		  					($status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_SENT] ||
                 $status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_ACCEPTED] ||
		   					 $status_cd == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_PAID])) {
      	$this->PaidServiceAgreement();
      }
    }

    function CopyLink()
    {
      if ($record = sw_get_data_table("service_agreement", "service_agreement_id = {$this->service_agreement_id->Value}", "status_cd, login_data")){

        if ($record['login_data'] == ""){
          $record['login_data'] = md5( uniqid( rand(), true ) . time() );
        }

        if (!$record['accepted_yn']){
      	  $record['status_cd'] = ($record['status_cd'] == SW_STATUS_SVC_NEW) ? SW_STATUS_SVC_SENT : $record['status_cd'];

      	  sw_update_table("service_agreement", $record, "service_agreement_id = {$this->service_agreement_id->Value}");

      	  $link = $_SERVER["HTTPS"] === 'on' ? 'https://' : 'http://';
      	  $link .= $_SERVER[ 'HTTP_HOST' ];
      	  $link .= rtrim( dirname( $_SERVER[ 'PHP_SELF' ] ), '/\\' ) . "/form_service_agreement.php?ID={$this->service_agreement_id->Value}&login={$record['login_data']}";
      	  $this->copy_link->Text = $link;
          $this->winProcess->Height = 90;
          $this->winProcess->Width = 620;
          $this->winProcess->Caption = 	SW_CAPTION_COPY_LINK;
      	  $this->winProcess->ActiveLayer = 'CopyLink';
      	  $this->winProcess->ShowModal();
        }
      }
    }

    function DeleteServiceAgreement()
    {
    	if ($this->SelectedKeysField->Value){
      	Global $connectionDB;
      	$sql = "DELETE FROM service_agreement
              	WHERE status_cd = '" . SW_STATUS_SVC_NEW . "' AND service_agreement_id in ({$this->SelectedKeysField->Value})";

      	$connectionDB->DbConnection->BeginTrans();
      	$connectionDB->DbConnection->execute($sql);
      	$connectionDB->DbConnection->CompleteTrans();
      	$this->gridService_agreement->writeSelectedCells(array());
      	$this->service_agreement_id->Value = 0;
      }
    }


    function RestoreStatusNew($sender, $params)
    {
    	$service_agreement_id = $params[0];
      Global $connectionDB;
      $sql = "UPDATE service_agreement SET status_cd = '" . SW_STATUS_SVC_NEW .
      		   "' WHERE status_cd = '" . SW_STATUS_SVC_SENT . "' AND service_agreement_id in ({$service_agreement_id})";

      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->gridService_agreement->writeSelectedCells(array());
      $this->service_agreement_id->Value = 0;
    }


    Function PaidServiceAgreement()
    {
    	if ($this->SelectedKeysField->Value){
      	GLOBAL $SW_COMPANY_STRONG, $language;

		 		//Query with Payment method language
				$sql = "SELECT payment_method_id, {$language} as payment_method_name
								FROM payment_method
								WHERE billing_entity_id = {$this->billing_entity_id->Value}
								ORDER BY {$language}";
     		$this->sqlPayment_method_billing->Active = False;
     		$this->sqlPayment_method_billing->SQL = $sql;
     		$this->sqlPayment_method_billing->Active = True;

        $this->lbPaid_amt->Caption = SW_CAPTION_PAID_AMT;
        $this->lbPaid_by->Caption = SW_CAPTION_PAID_BY;
        $this->lbPaid_dt->Caption = SW_CAPTION_PAID_DT;
        $this->lbPayment_method->Caption = SW_CAPTION_PAYMENT_METHOD;
        $this->lbBank_account->Caption = SW_CAPTION_BANK_ACCOUNT;

      	$this->sqlCompany_bank_account->close();
      	$where = "company.company_id = service_agreement.company_id AND service_agreement.service_agreement_id in ({$this->SelectedKeysField->Value})";
      	$record = sw_get_data_table("company, service_agreement", $where, "company.country_id");
        if (!$record['country_id']) $record['country_id'] = '724';
        $this->sqlCompany_bank_account->Params = array($SW_COMPANY_STRONG[$record['country_id']]);
				$this->sqlCompany_bank_account->open();

    		$this->paid_dt->date = date('Y-m-d');
      	$this->paid_by->Text = '';
      	$this->paid_amt->Text = '';
        $this->winProcess->Height = 180;
        $this->winProcess->Width = 560;
      	$this->winProcess->Caption = SW_CAPTION_PAID;
      	$this->winProcess->ActiveLayer = 'Paid';
      	$this->winProcess->ShowModal();
      }
    }

    function btnSavePaymentClick($sender, $params)
    {
      $where = "service_agreement_id in ({$this->SelectedKeysField->Value}) AND with_supplement_yn = 1";
      $record = sw_get_data_table("line_item", $where);
      $future_invoice_dt = $this->paid_dt->date < date('Y-m-d') ? date('Y-m-d') : $this->paid_dt->date;
      $future_invoice_dt = !$record ? sw_future_invoice_date($future_invoice_dt) : "";

      //Insert Service Agreement Paid
      $record_paid['service_agreement_id'] = $this->SelectedKeysField->Value;
      $record_paid['payment_method_id'] 	 = $this->payment_method_id->SelectedValue;
      $record_paid['bank_account_id'] 		 = $this->bank_account_id->SelectedValue;
      $record_paid['paid_dt'] 						 = $this->paid_dt->Date;
      $record_paid['paid_by'] 						 = $this->paid_by->Text;
      $record_paid['paid_amt'] 						 = sw_convert_comma_point($this->paid_amt->Text);
      $record_paid['created_by_user_id'] 	 = $_SESSION['user_id'];
      $record_paid['created_dt'] 	 				 = date('Y-m-d H:i:s');

      sw_insert_table("invoice_issued_paid", $record_paid);
      $this->UpdateServiceAgreementPaid($this->SelectedKeysField->Value, $future_invoice_dt);
    }


    function UpdateServiceAgreementPaid($service_agreement_id, $future_invoice_dt = '')
    {
      Global $connectionDB;
      $connectionDB->DbConnection->BeginTrans();

//                  line_item.future_invoice_dt = CASE IfNull(invoice_issued_paid.paid_amt, 0) WHEN 0 THEN '' ELSE '" . $future_invoice_dt . "' END

      //Update Service Agreement
			$sql = "UPDATE service_agreement
      					INNER JOIN line_item ON service_agreement.service_agreement_id = line_item.service_agreement_id
       					LEFT JOIN
             				(SELECT service_agreement_id, MAX(paid_dt) AS paid_dt, SUM(paid_amt) AS paid_amt
              			FROM invoice_issued_paid
              			WHERE service_agreement_id in ({$service_agreement_id})
              			GROUP BY service_agreement_id) invoice_issued_paid
       					ON service_agreement.service_agreement_id = invoice_issued_paid.service_agreement_id
						  SET service_agreement.status_cd = CASE WHEN invoice_issued_paid.paid_amt != 0 THEN '" . SW_STATUS_SVC_PAID . "'
                                                     WHEN service_agreement.accepted_yn = 1 THEN '" . SW_STATUS_SVC_ACCEPTED . "' ELSE '" . SW_STATUS_SVC_SENT . "' END,
              		service_agreement.paid_dt = CASE WHEN invoice_issued_paid.paid_amt >= service_agreement.total_amt THEN invoice_issued_paid.paid_dt ELSE service_agreement.paid_dt END,
              		service_agreement.paid_yn = CASE WHEN invoice_issued_paid.paid_amt >= service_agreement.total_amt THEN 1 ELSE 0 END,
              		service_agreement.paid_amt = IfNull(invoice_issued_paid.paid_amt, 0),
                  line_item.status_cd = CASE IfNull(invoice_issued_paid.paid_amt, 0) WHEN 0 THEN '" . SW_STATUS_LI_PROFORMA . "' ELSE '" . SW_STATUS_LI_TO_INVOICE . "' END,
                  line_item.company_id = service_agreement.company_id
              WHERE (service_agreement.status_cd = '" . SW_STATUS_SVC_SENT . "' OR
              			 service_agreement.status_cd = '" . SW_STATUS_SVC_ACCEPTED . "' OR
                     service_agreement.status_cd = '" . SW_STATUS_SVC_PAID . "') AND
              			service_agreement.service_agreement_id in ({$service_agreement_id})";

      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
    }

    function RejectedServiceAgreement()
    {
      Global $connectionDB;
      $sql = "UPDATE service_agreement
              SET status_cd = CASE WHEN status_cd = '" . SW_STATUS_SVC_REJECTED . "' AND accepted_yn = 0 THEN '" . SW_STATUS_SVC_SENT . "'
                                   WHEN status_cd = '" . SW_STATUS_SVC_REJECTED . "' AND accepted_yn = 1 THEN '" . SW_STATUS_SVC_ACCEPTED . "'
                                   ELSE '" . SW_STATUS_SVC_REJECTED . "' END
              WHERE (status_cd = '" . SW_STATUS_SVC_SENT . "' OR
                     status_cd = '" . SW_STATUS_SVC_ACCEPTED . "' OR
                     status_cd = '" . SW_STATUS_SVC_REJECTED . "') AND
                    service_agreement_id in ({$this->SelectedKeysField->Value})";

      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->gridService_agreement->writeSelectedCells(array());
      $this->service_agreement_id->Value = 0;
    }

    function gridService_agreementJSSelect($sender, $params)
    {
      Global $SW_STATUS_SERVICE_AGREEMENT_CD;
        ?>
        //begin js
        var status = gridService_agreement.getCellHTML(row, <?php echo COL_STATUS; ?>);
        document.getElementById("service_agreement_id").value = gridService_agreement.getSelectedPrimaryKey(row);
        document.getElementById("billing_entity_id").value = gridService_agreement.getCellHTML(row, <?php echo COL_BILLING_ENTITY; ?>);
        if (selected){
        	document.getElementById("status_cd").value = status;
        }

        if ((col == <?php echo COL_IMG;?>) && status == "<?php echo $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_SENT];?>")
        {
          params = [document.getElementById("service_agreement_id").value];
        	<?php
          	echo $this->btnServiceAgreement->ajaxCall("RestoreStatusNew", array(), array('gridService_agreement'));
          ?>
//          return false;
        }
        //end
        <?php
    }


    function gridService_agreementRowData($sender, $params)
    {
      Global $SW_STATUS_SERVICE_AGREEMENT_CD, $VirtualFile;
      $fields = &$params[ 1 ];

      $fields['img'] = '';
      if ($fields[ "status_cd" ] == SW_STATUS_SVC_SENT)
      {
        $fields['img'] = 'images/button/refresh_16x16.png';
      }

      $fields[ "status_cd" ] = $SW_STATUS_SERVICE_AGREEMENT_CD[$fields[ "status_cd" ]];

      //Get Country IP
      if ($fields['remote_address']){
         $fields['country_address'] = getCountryFromIP($fields['remote_address'], "name");
      }
    }


    function gridService_agreementSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT service_agreement.*,
                    (service_agreement.total_amt - service_agreement.paid_amt) AS pending_amt,
                    user.username, company.short_name
      			  FROM service_agreement
              	LEFT JOIN user ON service_agreement.created_by_user_id = user.user_id
                LEFT JOIN (Select company_id, short_name from company) AS company ON service_agreement.company_id = company.company_id";

      $filterSql = $this->FilterStatus($filterSql);

      //Hide invoiced and canceled
      if (!$this->cbShowInvoicedCanceled->Checked){
        $filterSql .= $filterSql ? " AND " : "";
        $filterSql .= "(NOT service_agreement.status_cd IN ('" . SW_STATUS_SVC_REJECTED . "','" . SW_STATUS_SVC_INVOICED . "'))";
      }

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql)))
          $sql .= " WHERE " . $filterSql;

      $orderby = "";
      if ($sortSql) {
				$orderby .= (" ORDER by " . $sortSql);
			}

      $this->gridService_agreement->Datasource->DataSet->SQL = $sql . $orderby;

    }


    function FilterStatus($filterSql)
    {
      $Column = $this->gridService_agreement->Columns[$this->gridService_agreement->findColumnByFieldName('status_cd')];
      if (($Column->Filter))
      {
        Global $SW_STATUS_SERVICE_AGREEMENT_CD;

        $index = (string)array_search($Column->Filter, $SW_STATUS_SERVICE_AGREEMENT_CD);
        $value = $SW_STATUS_SERVICE_AGREEMENT_CD[$index];
        $filterSql = "service_agreement." . str_replace($value, $index, $filterSql);
      }

      return $filterSql;
    }

    function service_agreementShowHeader($sender, $params)
    {
      echo SW_HEADER_HTML;
      echo SW_HEADER_HTML;
    }



    function gridService_agreement_paidSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

    	GLOBAL $language;

			$sql = "SELECT invoice_issued_paid.*, company_bank_account.bank_account_name,
      				payment_method.{$language} as payment_method_name, user.username
							FROM invoice_issued_paid
       						LEFT JOIN user ON invoice_issued_paid.created_by_user_id = user.user_id
     							LEFT JOIN company_bank_account ON invoice_issued_paid.bank_account_id = company_bank_account.bank_account_id
     							LEFT JOIN payment_method ON invoice_issued_paid.payment_method_id = payment_method.payment_method_id
							WHERE invoice_issued_paid.service_agreement_id = {$this->service_agreement_id->Value} ";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY $sortSql";

    	$this->gridService_agreement_paid->Datasource->DataSet->SQL = $sql;
    }


    function gridService_agreement_paidDelete($sender, $params)
    {
    	$paid = implode(",", $params[ 0 ]);

      sw_delete_table("invoice_issued_paid", "accounted_yn = 0 AND invoice_issued_paid_id in ({$paid})");
			$this->UpdateServiceAgreementPaid($this->service_agreement_id->Value);
    }

    function gridService_agreement_paidJSRowDeleting($sender, $params)
    {
    	Global $lbPaidServiceAgreement_error;
        ?>
        //begin js
				var accounted = gridService_agreement_paid.getCellHTML(row, <?php echo COL_ACCOUNTED; ?>);

        if (accounted.indexOf("checked") !== -1){
        	msgError = "<?php echo $lbPaidServiceAgreement_error; ?>";
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
          return false;
        }
        return true;
        //end
        <?php
    }

    function gridService_agreement_paidUpdate($sender, $params)
    {
    	$paid = $params[ 0 ];
    	$fields = $params[ 1 ];

      sw_update_table("invoice_issued_paid", $fields, "invoice_issued_paid_id in ({$paid})");
			$this->UpdateServiceAgreementPaid($this->service_agreement_id->Value);
    }

    function gridService_agreement_paidShow($sender, $params)
    {
    	Global $SW_STATUS_SERVICE_AGREEMENT_CD;

      $this->gridService_agreement_paid->ReadOnly = ($this->status_cd->Value == $SW_STATUS_SERVICE_AGREEMENT_CD[SW_STATUS_SVC_INVOICED]);
			$this->gridService_agreement_paid->AllowDelete = !$this->gridService_agreement_paid->ReadOnly;
      $this->gridService_agreement_paid->ShowEditColumn = !$this->gridService_agreement_paid->ReadOnly;
    }


    function gridService_agreementSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
    }

    function winProcessJSShow($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("paid_amt").focus();
        //end
        <?php
    }

    function cbShowInvoicedCanceledJSClick($sender, $params)
    {
        ?>
        //begin js
        gridService_agreement.Refresh();
        //end
        <?php
    }


}

global $application;

global $service_agreement;

//Creates the form
$service_agreement=new service_agreement($application);

//Read from resource file
$service_agreement->loadResource(__FILE__);

//Shows the form
$service_agreement->show();

?>