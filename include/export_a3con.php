<?php
  /* Export Conta Plus
  */
require_once('accounting.php');

class ExportA3ConLib  {
	var $record_accounting = null;
  var $file_subaccount = "";
  var $file_movement = "";
  var $record_subaccount = array();
  var $record_movement = array();
  var $fromDate = null;
  var $toDate = null;
  var $selectedInvoices = false;
  var $selectedKeysInvoices = null;
  var $createAccount = false;
	var $exportAccounting = false;
	var $signo = "+";

	// Propio de A3
	var $codigo_empresa = "";
	var $formato_fichero = "4";
	var $codigo_pais = "958";  // Otros Paises o Territorios

  // private constructor function
  function __construct()
  {
    $this->record_subaccount['fecha_alta'] = ''; 			// longitud(8) yyyymmdd
    $this->record_subaccount['tipo_registro'] = 'C'; 		// longitud(1)
    $this->record_subaccount['cuenta'] = ''; 				// longitud(12)
    $this->record_subaccount['descripcion'] = ''; 			// longitud(30)
    $this->record_subaccount['actualizar_saldo'] = 'N'; 	// longitud(1) S/N
    $this->record_subaccount['saldo_inicial'] = '+0000000000.00'; // longitud(14)
    $this->record_subaccount['reserva'] = ''; 				// longitud(5)
    $this->record_subaccount['nif'] = ''; 					// longitud(14)
    $this->record_subaccount['siglas'] = '';  				// longitud(2)
    $this->record_subaccount['via'] = ''; 					// longitud(30)
    $this->record_subaccount['numero'] = ''; 				// longitud(5)
    $this->record_subaccount['escalera'] = ''; 				// longitud(2)
		$this->record_subaccount['piso'] = ''; 					// longitud(2)
    $this->record_subaccount['puerta'] = ''; 				//longitud(2)
    $this->record_subaccount['municipio'] = ''; 			// longitud(20)
    $this->record_subaccount['codigo_postal'] = ''; 		// longitud(5)
    $this->record_subaccount['provincia'] = ''; 			// longitud(15)
    $this->record_subaccount['pais'] = '011'; 				// longitud(3)
    $this->record_subaccount['telefono'] = str_repeat(' ', 12); // longitud(12)
    $this->record_subaccount['extension'] = str_repeat(' ', 4); // longitud(4)
    $this->record_subaccount['fax'] = str_repeat(' ', 12); 		// longitud(12)
    $this->record_subaccount['email'] = str_repeat(' ', 30); 	// longitud(30)
    $this->record_subaccount['moneda'] = 'E'; 				// longitud(1)
    $this->record_subaccount['indicador_generado'] = 'N'; 	// longitud(1)

		// Cabecera Factura
    $this->record_movement['fecha_factura'] = '';     		// longitud(8) yyyymmdd
    $this->record_movement['tipo_registro'] = '';     		// longitud(1) Facturas(1) / Abonos(2)
    $this->record_movement['cuenta'] = '';    			  	// longitud(12)
    $this->record_movement['descripcion_cuenta'] = '';      // longitud(30)
    $this->record_movement['tipo_factura'] = '';   			// longitud(1) Ventas(1) / Compras(2) / Bienes Inversion(3)
    $this->record_movement['factura'] = '';           		// longitud(10)
    $this->record_movement['linea_apunte'] = '';      		// longitud(1) Inicio(I) / Intermedia(M) / Ultima(U)
    $this->record_movement['descripcion_apunte'] = ''; 		// longitud(30)
    $this->record_movement['importe_factura'] = '+0000000000.00';  // longitud(14)
    $this->record_movement['reserva'] = '';    				// longitud(139)
    $this->record_movement['moneda'] = 'E'; 				// longitud(1)
    $this->record_movement['indicador_generado'] = 'N';     // longitud(1)

    $this->record_movement['tipo_importe'] = ''; 			// longitud(1)
    $this->record_movement['subtipo_factura'] = ''; 		// longitud(2)
    $this->record_movement['base_imponible'] = '';			// longitud(14)
    $this->record_movement['porcentaje_iva'] = ''; 			// longitud(5)
    $this->record_movement['cuota_iva'] = ''; 				// longitud(14)
    $this->record_movement['porcentaje_recargo'] = ''; 		// longitud(5)
    $this->record_movement['cuota_recargo'] = ''; 			// longitud(14)
    $this->record_movement['porcentaje_retencion'] = ''; 	// longitud(5)
    $this->record_movement['cuota_retencion'] = ''; 		// longitud(14)
    $this->record_movement['impreso'] = '01';				// longitud(2)
    $this->record_movement['impuesto'] = ''; 				// longitud(1) S/N
  }

  function export_Subaccount_ClientTax(){
      Global $connectionDB;
      $company_id = $_SESSION['company_id'];

      $where = " (company_client.company_id = {$company_id}) ";
      if($this->selectedInvoices && $this->selectedKeysInvoices)
      {
         $where .= " AND (invoice_issued_id in ({$this->selectedKeysInvoices})) ";
      }
      else
         $where .= " AND (invoice_issued.registered_in_acctg_software_dt BETWEEN '{$this->fromDate}' AND '{$this->toDate}') ";

      $sql = "SELECT DISTINCT company_client.*, country.*
             	FROM company_client
                  INNER JOIN invoice_issued ON company_client.company_client_id = invoice_issued.company_client_id
                  LEFT JOIN country ON company_client.country_id = country.country_id
             	WHERE {$where}
              ORDER BY account_cd ";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->open();

      While(!$query->EOF)
      {
      	$record['account_cd'] = trim($query->Fields['account_cd']);
        if(($this->createAccount) && ($record['account_cd'] == ""))
        {
        	$record['account_cd'] = sw_create_account($company_id, "company_client", "430", $this->record_accounting['digit_account'], "company_client_id = {$query->Fields['company_client_id']}");
        }

				$record['account_name'] = utf8_decode($query->Fields['client_name']);
        $record['tax_ident'] = $query->Fields['tax_ident'];
        $record['postal_cd'] = $query->Fields['postal_cd'];
        $record['currency_cd'] = "EUR";
        $record['country_cd'] = $query->Fields['a3_cd'];
        $record['rate_no'] = "";

        $this->Save_record_subaccount($record);

        $query->next();
      }
  }


	function export_Subaccount_ProviderTax()
	{
		Global $connectionDB;
		$company_id = $_SESSION['company_id'];

		$sql = "SELECT company_provider.*, country.iso_cd, MID(expense_type.account_expense_cd,1,2) as prefix, country.a3_cd
			  FROM company_provider
			  INNER JOIN country ON company_provider.country_id = country.country_id
			  INNER JOIN expense_type ON company_provider.expense_type_id = expense_type.expense_type_id
			  WHERE company_provider.company_id = {$company_id} ORDER BY company_provider.account_cd ";

		$query = New Query();
		$query->Database = $connectionDB->DbConnection;
		$query->SQL = $sql;
		$query->LimitStart = -1;
		$query->LimitCount = -1;
		$query->open();

		While (!$query->EOF){
			$record['account_cd'] = trim($query->Fields['account_cd']);
			$prefix = ($query->Fields['prefix'] === "60") ? "400" : "410";

			if (($this->createAccount) && ($record['account_cd'] == "")) {
			  $record['account_cd'] = sw_create_account($company_id, "company_provider", $prefix, $this->record_accounting['digit_account'], "company_provider_id = {$query->Fields['company_provider_id']}");
			}

			$record['create_date'] = $this->fromDate;
			$record['account_name'] = utf8_decode($query->Fields['provider_name']);
			$record['tax_ident'] = $query->Fields['tax_ident'];
			$record['postal_cd'] = $query->Fields['postal_cd'];
			$record['country_cd'] = $query->Fields['a3_cd'];
			$record['rate_no'] = 0;

			$this->Save_record_subaccount($record);

			$query->next();
		}

	}

  function Save_record_subaccount($record)
  {
    $this->record_subaccount['cuenta'] = $record['account_cd'];
    $this->record_subaccount['descripcion'] = $record['account_name'] ? $record['account_name'] : "";
    $this->record_subaccount['nif'] = $record['tax_ident'] ? substr($record['tax_ident'], 0, 14) : "";
    $this->record_subaccount['codigo_postal'] = $record['postal_cd'] ? substr($record['postal_cd'], 0, 5) : "";
    $this->record_subaccount['fecha_alta'] = $record['create_date'] ? str_replace('-', '', $record['create_date']) : str_replace('-', '', $this->fromDate);
		$this->record_subaccount['pais'] = $record['country_cd'] ? $record['country_cd'] : $this->codigo_pais;

	  $this->Add_record_subaccount();
  }

  function Add_record_subaccount()
  {
    if ($this->file_movement) {
      $fp = fopen($this->file_movement, "a+");

      $file_line = $this->formato_fichero;
      $file_line .= sw_repeat_character($this->codigo_empresa, 5, "L", "0");
      $file_line .= sw_repeat_character($this->record_subaccount['fecha_alta'], 8, "R", " ");
      $file_line .= $this->record_subaccount['tipo_registro'];
      $file_line .= sw_repeat_character($this->record_subaccount['cuenta'], 12, "R", "0");
      $file_line .= sw_repeat_character(substr($this->record_subaccount['descripcion'], 0, 30), 30, "R", " ");
      $file_line .= $this->record_subaccount['actualizar_saldo'];
      $file_line .= $this->record_subaccount['saldo_inicial'];
      $file_line .= sw_repeat_character($this->record_subaccount['reserva'], 5, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['nif'], 14, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['siglas'], 2, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['via'], 30, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['numero'], 5, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['escalera'], 2, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['piso'], 2, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['puerta'], 2, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['municipio'], 20, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['codigo_postal'], 5, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['provincia'], 15, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['pais'], 3, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['telefono'], 12, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['extension'], 4, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['fax'], 12, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['email'], 30, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['reserva'], 17, "R", " ");
      $file_line .= $this->record_subaccount['moneda'];
      $file_line .= $this->record_subaccount['indicador_generado'];
      $file_line .= "\r\n";

      fwrite($fp, $file_line);
      fclose($fp);
    }
  }

  function export_Invoice_Issued()
  {
		Global $connectionDB, $GLOBAL_INVOICE_ACCOUNTING;

		$company_id = $_SESSION['company_id'];
		list($year, $month, $day) = explode('-', $this->toDate);
		$year = $year? $year: Date('Y');


		$where = " (invoice_issued.company_id = {$company_id}) ";
		if($this->selectedInvoices && $this->selectedKeysInvoices)
		{
			 $where .= " AND (invoice_issued_id in ({$this->selectedKeysInvoices})) ";
		}
		else
			 $where .= " AND (invoice_issued.registered_in_acctg_software_dt BETWEEN '{$this->fromDate}' AND '{$this->toDate}') ";

		$sql = "SELECT invoice_issued.*, company_client.account_cd, company_client.postal_cd,
									company_client.country_id, country.community_european_yn, country.iso_cd,
									tax_type_key.tax_type_key_id, tax_type_key.tax_type_cd, tax_type_key.type_tax_cd,
									tax_type_key.tax_type_binding_id, 'invoice_client' as type
					 FROM invoice_issued
								INNER JOIN company_client ON invoice_issued.company_client_id = company_client.company_client_id
								LEFT JOIN country ON company_client.country_id = country.country_id
								LEFT JOIN tax_type_key ON company_client.tax_type_key_id = tax_type_key.tax_type_key_id
					 WHERE {$where}
					 ORDER BY invoice_issued.invoice_dt, invoice_issued.invoice_number ";

		$query = New Query();
		$query->Database = $connectionDB->DbConnection;
		$query->SQL = $sql;
		$query->LimitStart = -1;
		$query->LimitCount = -1;
		$query->open();

		$count = 0;
		$document_ident = sw_get_last_document_issued($year);
		$invoice_issued_id = 0;

		While( ! $query->EOF)
		{
			 $record = $query->fieldbuffer;
			 if(($this->exportAccounting) || ( !$record["accounted_yn"]))
			 {
					//Initialize data
					if( !$record['document_ident'])
				  $record['document_ident'] = ++$document_ident;
					foreach($GLOBAL_INVOICE_ACCOUNTING as $key=>$value)
					{
						 $GLOBAL_INVOICE_ACCOUNTING[$key] = $record[$key]? $record[$key]: " ";
					}

					//Assign value
					$invoice_date = explode('-', $record['invoice_dt']);
					$registration_dt = explode('-', $record['registered_in_acctg_software_dt']);
					$invoice_dt = $invoice_date[0] . $invoice_date[1] . $invoice_date[2];
					//Verify date, if quarter is diferent
					if(($registration_dt[0] != $invoice_date[0]) || (sw_quarter_date($record['invoice_dt']) != sw_quarter_date($record['registered_in_acctg_software_dt'])))
					{
						 $invoice_dt = $registration_dt[0] . $registration_dt[1] . $registration_dt[2];
					}

					$invoice_issued_id = $record["invoice_issued_id"];
					$GLOBAL_INVOICE_ACCOUNTING['invoice_dt'] = $invoice_dt;
					$GLOBAL_INVOICE_ACCOUNTING["invoice_number"] = $record["invoice_number"];

					//Accounting account
					$account_code = $record["account_cd"]? $record["account_cd"]: " ";
					$record["account_cd"] = (($account_code == " ") && ($this->record_accounting['account_client']))? $this->record_accounting['account_client']: $account_code;
					$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_cd"];

					//Sales account
					$country_id = $_SESSION['country_id'];
					$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $this->record_accounting['account_sale']? $this->record_accounting['account_sale']: GLOBAL_ACCOUNT_SALE;
					if($record['country_id'] != $this->record_accounting['country_id'])
					{
						 if($record['community_european_yn'])
						 {
								$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $this->record_accounting['account_sale_within_europe']? $this->record_accounting['account_sale_within_europe']: $GLOBAL_INVOICE_ACCOUNTING['counterpart'];
						 }
						 else
						 {
								$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $this->record_accounting['account_sale_outside_europe']? $this->record_accounting['account_sale_outside_europe']: $GLOBAL_INVOICE_ACCOUNTING['counterpart'];
						 }
					}
					$account_sale = $GLOBAL_INVOICE_ACCOUNTING['counterpart'];

					$GLOBAL_INVOICE_ACCOUNTING['concept'] = utf8_encode("FR.Nº ") . $record['invoice_number'];
					$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $total_amt;
					$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = 0;
					$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = 0;
					$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = 0;
					$GLOBAL_INVOICE_ACCOUNTING['overhead_amt'] = 0;

					$GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['client_name'];
					$record['withholding'] = floatval($record['withholding_amt']) != 0;

					// Parametros propios de A3
					$record['linea_apunte'] = "I";

					//Save line 430
					$this->cabecera_factura($record, $GLOBAL_INVOICE_ACCOUNTING);

					//Save lines 477
					$sql = "SELECT * FROM invoice_issued_tax " .
					       "WHERE invoice_issued_id = {$record['invoice_issued_id']}
								 ORDER BY rate_no";

					$query_tax = New Query();
					$query_tax->Database = $connectionDB->DbConnection;
					$query_tax->SQL = $sql;
					$query_tax->LimitStart = -1;
					$query_tax->LimitCount = -1;
					$query_tax->open();

					$tax_amt   = 0;
					$sale_amt  = floatval($record['transport_amt']) + floatval($record['other_income_amt']);
          $total_tax = floatval($record["tax_amt"]);
					While (!$query_tax->EOF)
					{
						 $record_tax = $query_tax->fieldbuffer;
						 $tax_amt  += floatval($record_tax['tax_amt']);
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt']  			= $record_tax['tax_amt'];
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt']    			= $record_tax['base_amt'];
						 $GLOBAL_INVOICE_ACCOUNTING['rate_no']     			= $record_tax['rate_no'];
						 $GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = $record_tax['overhead_rate_no'];
					   $GLOBAL_INVOICE_ACCOUNTING['overhead_amt'] 		= $record_tax['overhead_amt'];

						 $record['linea_apunte'] = round($tax_amt, 2) == round($total_tax, 2) && $sale_amt == 0 ? "U" : "M";
					   $this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);

						 $query_tax->next();
					}

					//Save lines 705 o 700
					//Trasport
					if(($this->record_accounting["account_transport"]) && ($record['transport_amt'] != 0))
					{
						 $sale_amt -= floatval($record['transport_amt']);

						 //Save lines 705 Sale
						 $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $this->record_accounting['account_transport'];
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $record['transport_amt'];
			    	 $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = "";
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
						 $GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = "";
					   $GLOBAL_INVOICE_ACCOUNTING['overhead_amt'] 		= "";

						 $GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['client_name'];

						 $record['linea_apunte'] = $sale_amt <> 0 ? "M" : "U";

						 $this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);
					}

					//Other Income
					if(($this->record_accounting["account_other_income"]) && ($record['other_income_amt'] != 0))
					{
						 $sale_amt -= floatval($record['other_income_amt']);

						 //Asigno el mismo codigo para suplidos
						 $account_code = $this->record_accounting['account_other_income'];
						 if(strlen($account_code) < $this->record_accounting['digit_account'])
						 {
								$account_income = str_split($account_code);
								$account_code = $record["account_cd"];
								foreach($account_income as $key=>$value)
								{
									 $account_code = substr_replace($account_code, $value, $key, 1);
								}
						 }
						 $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $account_code;
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $record['other_income_amt'];
			    	 $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = "";
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
						 $GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = "";
					   $GLOBAL_INVOICE_ACCOUNTING['overhead_amt'] 		= "";

						 $GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['client_name'];

						 $record['linea_apunte'] = $sale_amt <> 0 ? "M" : "U";

						 $this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);
					}

					//Save lines 705 Sale
					$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = GLOBAL_ACCOUNT_OTHER_INCOME;
				 	$GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $sale_amt;
			    $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = "";
					$GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
				 	$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['overhead_amt'] 		= "";

					$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['client_name']);

					if ($sale_amt <> 0){
						$record['linea_apunte'] = "U";
						$this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);
					}

					//Last document_ident
					if( ! $record['accounted_yn'])
					{
						 $record['export_dt'] = date('Y-m-d H:i:s');
					}

					$fieldValues['accounted_yn'] = 1;
					$fieldValues['status_cd'] = SW_STATUS_IS_CLOSE;
					$fieldValues['export_dt'] = $record['export_dt'];
					$fieldValues['document_ident'] = $GLOBAL_INVOICE_ACCOUNTING['document_ident'];
					sw_update_table("invoice_issued", $fieldValues, "invoice_issued_id = {$record['invoice_issued_id']}");
			 }

			 $query->next();
		}
  }

	function export_Invoice_received()
	{
		Global $connectionDB, $GLOBAL_INVOICE_ACCOUNTING, $GLOBAL_SPECIAL_ACCOUNT_VAT;

		$company_id = $_SESSION['company_id'];
		list( $year, $month, $day ) = explode( '-', $this->toDate);
		$year = $year ? $year : Date('Y');

		$where = " (invoice_received.company_id = {$company_id}) ";
		if ($this->selectedInvoices && $this->selectedKeysInvoices){
			$where .= " AND (invoice_received_id in ({$this->selectedKeysInvoices})) ";
		}
		else $where .= " AND (invoice_received.registered_in_acctg_software_dt BETWEEN '{$this->fromDate}' AND '{$this->toDate}') ";

		$sql = "SELECT invoice_received.*, company_provider.expense_type_id AS expense_type_provider_id,
									company_provider.account_cd, company_provider.account_expense_cd,
									company_provider.account_other_expense_cd, company_provider.account_withholding_cd,
									company_provider.country_id, country.community_european_yn,
									tax_type_key.tax_type_key_id, tax_type_key.tax_type_cd, tax_type_key.type_tax_cd,
									tax_type_key.tax_type_binding_id, 'invoice_provider' AS type, tax_rate.rate_no AS rate_no_default
					 FROM invoice_received
								INNER JOIN company_provider ON invoice_received.company_provider_id = company_provider.company_provider_id
								LEFT JOIN company_accounting ON invoice_received.company_id = company_accounting.company_id
								LEFT JOIN tax_rate ON company_accounting.tax_rate_id = tax_rate.tax_rate_id
								LEFT JOIN country ON company_provider.country_id = country.country_id
								LEFT JOIN tax_type_key ON company_provider.tax_type_key_id = tax_type_key.tax_type_key_id
					 WHERE {$where}
					 ORDER BY invoice_received.registered_in_acctg_software_dt, invoice_received.invoice_number";

		$query = New Query();
		$query->Database = $connectionDB->DbConnection;
		$query->SQL = $sql;
		$query->LimitStart = -1;
		$query->LimitCount = -1;
		$query->open();

		$count = 0;
		$document_ident = sw_get_last_document_received($year);
		$invoice_received_id = 0;

		While (!$query->EOF){
			$record = $query->fieldbuffer;
			if (($this->exportAccounting) || (!$record["accounted_yn"])){

				//Initialize data
				if (!$record['document_ident']) $record['document_ident'] = ++$document_ident;
				foreach ($GLOBAL_INVOICE_ACCOUNTING as $key => $value) {
					$GLOBAL_INVOICE_ACCOUNTING[$key] = $record[$key] ? $record[$key] : " ";
				}

				$tax_amt = 0;
				$total_amt = (floatval($record["subtotal_amt"]) +
											floatval($record["transport_amt"]) +
											floatval($record["tax_amt"]) +
											floatval($record["overhead_amt"]) +
											floatval($record["other_expense_amt"])) -
											floatval($record["withholding_amt"]);

				//Assign value
				$invoice_date = explode('-', $record['invoice_dt']);
				$registration_dt = explode('-', $record['registered_in_acctg_software_dt']);
				$invoice_dt = $invoice_date[0] . $invoice_date[1] . $invoice_date[2];
				//Verify date, if quarter is diferent
				if (($registration_dt[0]!=$invoice_date[0]) || (sw_quarter_date($record['invoice_dt']) != sw_quarter_date($record['registered_in_acctg_software_dt']))){
					$invoice_dt = $registration_dt[0] . $registration_dt[1] . $registration_dt[2];
				}

				$invoice_received_id = $record["invoice_received_id"];
				$GLOBAL_INVOICE_ACCOUNTING['invoice_dt'] = $invoice_dt;
				$GLOBAL_INVOICE_ACCOUNTING["invoice_number"] = $record["invoice_number"];

				//Accounting account
				$account_code = $record["account_cd"] ? $record["account_cd"] : " ";
				$record["account_cd"] = (($account_code == " ") && ($this->record_accounting['account_provider'])) ? $this->record_accounting['account_provider'] : $account_code;
				$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_cd"];

				$record['account_expense_cd'] = sw_get_account_expense($record, $this->record_accounting['digit_account']);
				$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record['account_expense_cd'];

				$GLOBAL_INVOICE_ACCOUNTING['concept'] = utf8_encode("FR.Nº ") . $record['invoice_number'];
				$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $total_amt;
				$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = 0;
				$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = 0;
			 	$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = 0;
				$GLOBAL_INVOICE_ACCOUNTING['overhead_amt']		 = 0;

				$GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['provider_name'];
				$record['withholding'] = floatval($record['withholding_amt']) != 0;

				// Parametros propios de A3
				$record['linea_apunte'] = "I";

				//Save line 400
				$this->cabecera_factura($record, $GLOBAL_INVOICE_ACCOUNTING);

				//Total Expense
				$expense_amt = floatval($record['transport_amt']) + floatval($record['other_expense_amt']);

				//Save lines 472
				$sql = "SELECT * FROM invoice_received_tax " .
							 "WHERE invoice_received_id = {$record['invoice_received_id']}
							 ORDER BY rate_no";

				$query_tax = New Query();
				$query_tax->Database = $connectionDB->DbConnection;
				$query_tax->SQL = $sql;
				$query_tax->LimitStart = -1;
				$query_tax->LimitCount = -1;
				$query_tax->open();

				$tax_amt = 0;
				$total_tax = floatval($record["tax_amt"]);
				While (!$query_tax->EOF){
					 $record_tax = $query_tax->fieldbuffer;

					 $tax_amt  += floatval($record_tax['tax_amt']);
					 $GLOBAL_INVOICE_ACCOUNTING['active_amt']  			= $record_tax['tax_amt'];
					 $GLOBAL_INVOICE_ACCOUNTING['base_amt']    			= $record_tax['base_amt'];
					 $GLOBAL_INVOICE_ACCOUNTING['rate_no']     			= $record_tax['rate_no'];
					 $GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] = $record_tax['overhead_rate_no'];
					 $GLOBAL_INVOICE_ACCOUNTING['overhead_amt']			= $record_tax['overhead_amt'];

					 $record['linea_apunte'] = round($tax_amt,2) == round($total_tax, 2) && $expense_amt == 0 ? "U" : "M";
					 $this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);

					 $query_tax->next();

				}

				//Other Expense
				if ((($this->record_accounting["account_other_expense"]) || ($record["account_other_expense_cd"])) &&
						($record['other_expense_amt']!=0)) {
						$expense_amt -= floatval($record['other_expense_amt']);

						$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_other_expense_cd"] ? $record["account_other_expense_cd"] : $this->record_accounting['account_other_expense'];
						$GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $record['other_expense_amt'];
			    	$GLOBAL_INVOICE_ACCOUNTING['rate_no']     = "";
						$GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
					 	$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] 	= "";
					 	$GLOBAL_INVOICE_ACCOUNTING['overhead_amt']			= "";

						$GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['provider_name'];

						$record['linea_apunte'] = $sale_amt <> 0 ? "M" : "U";

						$this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);
				}

				//Save lines 600 Sale
				$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record['account_expense_cd'];
			 	$GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $expense_amt;
		    $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = "";
				$GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
				$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] 	= "";
				$GLOBAL_INVOICE_ACCOUNTING['overhead_amt']			= "";

				$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['provider_name']);

				if ($expense_amt <> 0){
					$record['linea_apunte'] = "U";
					$this->detalle_factura($record, $GLOBAL_INVOICE_ACCOUNTING);
				}


				//Last document_ident
				if (!$record['accounted_yn']){
					$record['export_dt'] = date('Y-m-d H:i:s');
				}

				$fieldValues['accounted_yn'] = 1;
				$fieldValues['export_dt'] = $record['export_dt'];
				$fieldValues['document_ident'] = $GLOBAL_INVOICE_ACCOUNTING['document_ident'];
				sw_update_table("invoice_received", $fieldValues, "invoice_received_id = {$record['invoice_received_id']}");
			}

			$query->next();
		}

	}


	//Creo la cabecera de factura
  function cabecera_factura($record_invoice, $invoice_accounting){

    if ($record_invoice['type'] == 'invoice_client') $this->record_movement['tipo_factura'] = 1;
    else if ($record_invoice['type'] == 'invoice_provider' && substr($invoice_accounting['counterpart'], 0, 1) == '6') {$this->record_movement['tipo_factura'] = 2;}
    else $this->record_movement['tipo_factura'] = 3;

    $this->record_movement['fecha_factura'] = str_replace('-', '', $invoice_accounting['invoice_dt']);
    $this->record_movement['tipo_registro'] = floatval($record_invoice['total_amt']) >= 0 ? 1 : 2;
    $this->record_movement['cuenta'] = $invoice_accounting['account_cd'];
		$descripcion_cuenta = $this->record_movement['tipo_factura'] == 1 ? $record_invoice['client_name'] : $record_invoice['provider_name'];
    $this->record_movement['descripcion_cuenta'] = substr(utf8_decode($descripcion_cuenta), 0, 30);
    $this->record_movement['factura'] = substr(utf8_decode($invoice_accounting["invoice_number"]), -10);
		$this->record_movement['linea_apunte'] = $record_invoice['linea_apunte'];

    $this->record_movement['descripcion_apunte'] = substr(utf8_decode($invoice_accounting['concept']), 0, 30);

		$this->signo = '+';

    $this->record_movement['importe_factura'] = $this->signo . sw_repeat_character(number_format(abs($record_invoice['total_amt']), 2, '.', ''), 13, "L", "0");
    $this->record_movement['moneda'] = 'E';
    $this->record_movement['indicador_generado'] = 'N';

    if ($this->file_movement) {
      $fp = fopen($this->file_movement, "a+");
      $file_line = $this->formato_fichero;
      $file_line .= sw_repeat_character($this->codigo_empresa, 5, "L", "0");
      $file_line .= sw_repeat_character($this->record_movement['fecha_factura'], 8, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['tipo_registro'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['cuenta'], 12, "R", "0");
      $file_line .= sw_repeat_character($this->record_movement['descripcion_cuenta'], 30, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tipo_factura'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['factura'], 10, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['linea_apunte'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['descripcion_apunte'], 30, "R", " ");
      $file_line .= $this->record_movement['importe_factura'];
      $file_line .= sw_repeat_character($this->record_movement['reserva'], 139, "R", " ");
      $file_line .= $this->record_movement['moneda'];
      $file_line .= $this->record_movement['indicador_generado'];
      $file_line .= "\r\n";

      fwrite($fp, $file_line);
      fclose($fp);
		}

  }


  //Creo la cabecera de factura
  function detalle_factura(&$record_invoice, &$invoice_accounting){

		$this->record_movement['tipo_registro'] = '9';
		$this->record_movement['cuenta'] = $invoice_accounting['counterpart'];
		$this->record_movement['linea_apunte'] = $record_invoice['linea_apunte'];
		$this->record_movement['descripcion_cuenta'] = substr($invoice_accounting['account_name'], 0, 30);

		$this->obtenerTipoOperacion($record_invoice, $invoice_accounting);

		// Datos de retencion
		$this->record_movement['tipo_importe'] = floatval($invoice_accounting['base_amt'])>= 0 ? 'C' : 'A';
		$this->signo = floatval($invoice_accounting['base_amt']) >= 0 ? '+' : '-';
		$this->record_movement['porcentaje_retencion'] = '';
		$this->record_movement['cuota_retencion'] = '';
		if ($record_invoice['withholding'] && floatval($record_invoice['withholding_amt']) != 0){
			$record_invoice['withholding'] = false;
			$this->record_movement['porcentaje_retencion'] = sw_repeat_character(number_format($record_invoice['withholding_rate_no'], 2, '.', ''), 5, "L", "0");
			$this->record_movement['cuota_retencion'] = $this->signo . sw_repeat_character(number_format(abs($record_invoice['withholding_amt']), 2, '.', ''), 13, "L", "0");
		}

		$importe_apunte = $invoice_accounting['active_amt'] == '' ? 0 : floatval($invoice_accounting['active_amt']);

    $this->record_movement['base_imponible'] = $this->signo . sw_repeat_character(number_format(abs($invoice_accounting['base_amt']), 2, '.', ''), 13, "L", "0");
    $this->record_movement['porcentaje_iva'] = $invoice_accounting['rate_no'] == "" ? sw_repeat_character($invoice_accounting['rate_no'], 5, "L", " ") : sw_repeat_character(number_format($invoice_accounting['rate_no'], 2, '.', ''), 5, "L", "0");
    $this->record_movement['cuota_iva'] = $this->signo . sw_repeat_character(number_format(abs($importe_apunte), 2, '.', ''), 13, "L", "0");

    $this->record_movement['porcentaje_recargo'] = $invoice_accounting['overhead_rate_no'] == "" ? sw_repeat_character($invoice_accounting['overhead_rate_no'], 5, "L", " ") : sw_repeat_character(number_format($invoice_accounting['overhead_rate_no'], 2, '.', ''), 5, "L", "0");
    $this->record_movement['cuota_recargo'] = $invoice_accounting['overhead_amt'] == "" ? sw_repeat_character($this->record_movement['cuota_recargo'], 14, "R", " ") : $this->signo . sw_repeat_character(number_format(abs($invoice_accounting['overhead_amt']), 2, '.', ''), 13, "L", "0");

    $this->record_movement['moneda'] = 'E';
    $this->record_movement['indicador_generado'] = 'N';

    if ($this->file_movement) {
			$fp = fopen($this->file_movement, "a+");
			$file_line = $this->formato_fichero;
			$file_line .= sw_repeat_character($this->codigo_empresa, 5, "L", "0");
			$file_line .= sw_repeat_character($this->record_movement['fecha_factura'], 8, "L", " ");
			$file_line .= sw_repeat_character($this->record_movement['tipo_registro'], 1, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['cuenta'], 12, "R", "0");
			$file_line .= sw_repeat_character($this->record_movement['descripcion_cuenta'], 30, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['tipo_importe'], 1, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['factura'], 10, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['linea_apunte'], 1, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['descripcion_apunte'], 30, "R", " ");
			$file_line .= $this->record_movement['subtipo_factura'];
			$file_line .= $this->record_movement['base_imponible'];
			$file_line .= $this->record_movement['porcentaje_iva'];
			$file_line .= $this->record_movement['cuota_iva'];
			$file_line .= $this->record_movement['porcentaje_recargo'];
			$file_line .= $this->record_movement['cuota_recargo'];
			$file_line .= sw_repeat_character($this->record_movement['porcentaje_retencion'], 5, "R", " ");
			$file_line .= sw_repeat_character($this->record_movement['cuota_retencion'], 14, "R", " ");
			$file_line .= $this->record_movement['impreso'];
			$file_line .= $this->record_movement['impuesto'];
			$file_line .= sw_repeat_character($this->record_movement['reserva'], 77, "R", " ");
			$file_line .= $this->record_movement['moneda'];
			$file_line .= $this->record_movement['indicador_generado'];
			$file_line .= "\r\n";

			fwrite($fp, $file_line);
			fclose($fp);
		}

  }

  function obtenerTipoOperacion($record_invoice, &$invoice_accounting){
    $this->record_movement['impuesto'] = $invoice_accounting['rate_no'] == "" ? 'N' : 'S'; //	longitud(1) S/N
		$this->record_movement['impreso'] = '01';

		// Facturas Emitidas
    if ($record_invoice['type'] == 'invoice_client'){
			// Regimén General
			if ($record_invoice['tax_type_cd'] == 'G') {
				$this->record_movement['subtipo_factura'] = '01';
				// 415 Especidicar si afecta al modelo 415
			}
			// Entregas Intracomunitatia Exentas de bienes o servicios
			else if ($record_invoice['tax_type_cd'] == 'Y' || $record_invoice['tax_type_cd'] == 'X') {
				$this->record_movement['subtipo_factura'] = '03';
				$this->record_movement['impreso'] = '02';
				if ($record_invoice['tax_type_cd'] == 'Y'){ $this->record_movement['impreso'] = '11';} // Modelo 349 Servicio
			}
			// Devengado No Sujeto
			else if ($record_invoice['tax_type_cd'] == 'J' )
			{
    	  $this->record_movement['impuesto'] = 'S'; //	longitud(1) S/N
				$this->record_movement['subtipo_factura'] = '08';  // cambie de 07 por 08
					$this->record_movement['impreso'] = '01'; // Modelo 347
				// Modelo 347 No Comunitario
				//if (!$record_invoice['community_european_yn']) {
				//	$this->record_movement['impreso'] = '01'; // Modelo 347
			  //}
			}
			// Inversión del sujeto pasivo
			else if ($record_invoice['tax_type_cd'] == 'P' )
			{
    	  $this->record_movement['impuesto'] = 'N'; //	longitud(1) S/N
				$this->record_movement['subtipo_factura'] = '08';
				// Modelo 347 No Comunitario
				if (!$record_invoice['community_european_yn']) {
					$this->record_movement['impreso'] = '01'; // Modelo 347
			  }
			}
			// Devengado en Exportaciones
			else if ($record_invoice['tax_type_cd'] == 'E') {
				// Canarias, Ceuta y Melilla // Colocar el regimen EspaÃ±a
				if ($record_invoice['country_id'] == 1200 || $record_invoice['country_id'] == 1201){
						$this->record_movement['subtipo_factura'] = '05';
				// Tercero paises
				} else {
					$this->record_movement['subtipo_factura'] = '06';
				}
			}
		}
		// Facturas Recibidas
		else {
		  // Se calcula la cuota para las Intracomunitarias y Inversión del sujeto pasivo
			if (($record_invoice['tax_type_cd'] == 'C' ||
					 $record_invoice['tax_type_cd'] == 'Z' ||
					 $record_invoice['tax_type_cd'] == 'P') && $this->record_movement['impuesto'] == 'S') {
				$invoice_accounting['active_amt'] = floatval($invoice_accounting['base_amt'] * ($record_invoice['rate_no_default']/100));
		    $invoice_accounting['rate_no'] = $record_invoice['rate_no_default'];
      }

			// Regimen General y Deducible No Sujeto
			if ($record_invoice['tax_type_cd'] == 'O') {
				$this->record_movement['subtipo_factura'] = '01';

				// Retenciones
				if ($record_invoice['withholding'] && floatval($record_invoice['withholding_amt']) != 0){
					// Modelo 115
					if (substr($record_invoice['account_expense_cd'], 0, 3) == '621'){
					   $this->record_movement['impreso'] = '03';
					}
					// Modelo 111
					else if (substr($record_invoice['account_expense_cd'], 0, 3) == '623'){
						if (GLOBAL_PROFESSIONAL_WITHHOLDING == floatval($record_invoice['withholding_rate_no'])){
					      $this->record_movement['impreso'] = '05';
						 } else {
					      $this->record_movement['impreso'] = '14';
						 }
					}
				}
			}
			// Deducible en adquisiciones intracomunitarias de bienes
			else if ($record_invoice['tax_type_cd'] == 'C' && $this->record_movement['impuesto'] == 'S') {
				$this->record_movement['subtipo_factura'] = '03';
				$this->record_movement['impreso'] = '02';
			}
			else if ($record_invoice['tax_type_cd'] == 'Z' && $this->record_movement['impuesto'] == 'S') {
				$this->record_movement['subtipo_factura'] = '08';
				$this->record_movement['impreso'] = '11';
			}
			// Deducible por inversión del sujeto pasivo
			else if ($record_invoice['tax_type_cd'] == 'P' && $this->record_movement['impuesto'] == 'S') {
				$this->record_movement['subtipo_factura'] = '04';
			}
			// Adquisiciones de comerciantes minoristas
			else if ($record_invoice['tax_type_cd'] == 'M' && $this->record_movement['impuesto'] == 'S') {
				$this->record_movement['subtipo_factura'] = '05'; }
			// Deducible en importaciones
			else if ($record_invoice['tax_type_cd'] == 'I' && $this->record_movement['impuesto'] == 'S') {
				$this->record_movement['subtipo_factura'] = '06';
			}
			// No Deducible / Sin Impuesto
			else if ($record_invoice['tax_type_cd'] == 'K' ||
							 $record_invoice['tax_type_cd'] == '0' ||
							 $this->record_movement['impuesto'] == 'N') {
				$this->record_movement['subtipo_factura'] = '07';
			}
		}
  }

  function create_zip_file($filezip)
  {
		$zip = new zipArchiveLib();
		$zip->addFile($this->file_movement, "SUENLACE.DAT");
		$zip->saveZip($filezip);
		$zip->downloadZip($filezip);
  }
}
?>