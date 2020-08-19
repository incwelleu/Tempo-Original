<?php
	/*
	*   Plantilla de importar excel a Invoice
	*/

require_once('include/PHPExcel.php');
require_once("include/functions.php");
require_once('include/accounting.php');

class ImportTempoTemplate {

	var $company_id;
	var $objPHPExcel;
	var $worksheet;
	var $row;
	var $rows;
	var $file;
	var $fileError;

	// Columns
	var $col_invoice_date = 2;
	var $col_invoice_number = 3;
	var $col_tax_ident = 4;
	var $col_name = 5;
	var $col_subtotal_amount = 7;
	var $col_tax_rate = 8;
	var $col_tax_amount = 9;
	var $col_total_amount = 10;
	var $col_base_withholding_amount = 11;
	var $col_withholding_rate = 12;
	var $col_other_amount = 0;
	var $col_transport_amount = 0;
	var $col_document_id = 0;

  var $beginning_row = 11;
	var $registration_date = "";

  var $invoice_date_tmp = "";
  var $invoice_number_tmp = "";
  var $invoice_taxid_tmp = "";

  function __construct($company_id, $objPHPExcel, $fileError){

		$this->company_id = $company_id;
		$this->objPHPExcel = $objPHPExcel;

    $this->worksheet = $this->objPHPExcel->getActiveSheet();
    $this->rows = $this->worksheet->getHighestRow();

    $this->fileError = $fileError;
	}

	function import_invoice_issued_excel(){

      for($this->row = ( $this->beginning_row ? $this->beginning_row : 2); $this->row <= $this->rows; $this->row++)
      {
				$invoice_date = ($this->col_invoice_date)? $this->worksheet->getCellByColumnAndRow($this->col_invoice_date - 1, $this->row)->getCalculatedValue(): "";
				if (strlen($invoice_date) != 0 && gettype($invoice_date) !== 'string')
        {
        	$invoice_date = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($invoice_date));
        }
        $invoice_number = ($this->col_invoice_number) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_invoice_number - 1, $this->row)->getCalculatedValue()), 0, 50): "";
        $tax_ident = ($this->col_tax_ident) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_tax_ident - 1, $this->row)->getCalculatedValue()), 0, 20): "";
        $tax_ident = sw_clean_caracter_tax_ident($tax_ident);
        $name 			= ($this->col_name) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_name - 1, $this->row)->getCalculatedValue()), 0, 200): "";
        $subtotal_amount = ($this->col_subtotal_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_subtotal_amount - 1, $this->row)->getCalculatedValue()): "0";
        $transport_amount = ($this->col_transport_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_transport_amount - 1, $this->row)->getCalculatedValue()): "0";
        $other_amount = ($this->col_other_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_other_amount - 1, $this->row)->getCalculatedValue()): "0";
				$tax_rate_no = ($this->col_tax_rate) ? trim($this->worksheet->getCellByColumnAndRow($this->col_tax_rate - 1, $this->row)->getCalculatedValue()): "0";
        $tax_rate_no = ($tax_rate_no < 1) ? round($tax_rate_no * 100, 2): $tax_rate_no;
        $tax_amount = ($this->col_tax_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_tax_amount - 1, $this->row)->getCalculatedValue()): "0";
        $base_withholding_amount = ($this->col_base_withholding_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_base_withholding_amount - 1, $this->row)->getCalculatedValue()): "0";
        $withholding_rate_no = ($this->col_withholding_rate) ? trim($this->worksheet->getCellByColumnAndRow($this->col_withholding_rate - 1, $this->row)->getCalculatedValue()): "0";
        $withholding_rate_no = ($withholding_rate_no < 1)? $withholding_rate_no * 100: $withholding_rate_no;
        $total_amount = ($this->col_total_amount)? trim($this->worksheet->getCellByColumnAndRow($this->col_total_amount - 1, $this->row)->getCalculatedValue()): "0";
        $document_id = ($this->col_document_id)? trim($this->worksheet->getCellByColumnAndRow($this->col_document_id - 1, $this->row)->getCalculatedValue()): "0";

        list($year, $month, $day) = explode('-', $invoice_date);
        if ( (strlen($invoice_date) != 0) &&
				 			$this->checkInvoiceDate($invoice_date) &&
				 	  	$this->checkInvoiceNumber($invoice_number) &&
							$this->checkTaxId($tax_ident) &&
							$this->checkTaxRate($tax_rate_no))
        {
        	//Insert client company
          $sql = "(company_id = {$this->company_id}) AND (tax_ident = '{$tax_ident}') ";
          if (!$record_client = sw_get_data_table('company_client', $sql))
          {
          	$record_client['company_id'] 	= $this->company_id;
            $record_client['tax_ident'] 	= $tax_ident;
          	$record_client['client_name'] = ($name = !mb_check_encoding($name, 'UTF-8') ? strtoupper(utf8_encode($name)) : strtoupper($name));
            $record_client['country_id'] 	= sw_country_tax_ident($record['tax_ident']);

            sw_insert_table("company_client", $record_client);
            $record_client = sw_get_data_table('company_client', $sql);
          }

          $company_client_id = $record_client['company_client_id'];

          $sqlInvoice = "(company_id = {$this->company_id}) AND
									  		(invoice_number = '{$invoice_number}') AND
												(invoice_dt = '{$invoice_date}') AND
												(tax_ident = '{$tax_ident}') ";
					$record = sw_get_data_table('invoice_issued', $sqlInvoice);
          if (!isset($record['accounted_yn']) || !$record['accounted_yn'])
					{
						// Si la factura existe la elimino, para empezar desde cero
						if ($record['invoice_issued_id'] &&
								(($invoice_date != $this->invoice_date_tmp) ||
							  ($invoice_number != $this->invoice_number_tmp) ||
								($tax_ident != $this->invoice_taxid_tmp)))
						{
							sw_delete_table('invoice_issued_tax', "(invoice_issued_id = {$record['invoice_issued_id']})");

						  $record['subtotal_amt'] 				= 0;
							$record['transport_amt'] 				= 0;
							$record['other_income_amt'] 		= 0;
              $record['base_withholding_amt'] = 0;
              $record['withholding_rate_no'] 	= 0;
              $record['withholding_amt'] 			= 0;
              $record['tax_amt'] 							= 0;
              $record['total_amt'] 						= 0;
						}

            $record['company_id'] 				= $this->company_id;
            $record['created_by_user_id'] = $_SESSION['user_id'];
            $record['invoice_number'] 		= strtoupper($invoice_number);
            $record['invoice_dt'] 				= $invoice_date;
            $record['company_client_id'] 	= $company_client_id;
            $record['tax_ident'] 					= $record_client['tax_ident'];
            $record['client_name'] 				= $name;

            //Assign registered accountant
            sw_assign_registered_accountant($record, $this->registration_date);

            list($year, $month, $day) = explode('-', $record['registered_in_acctg_software_dt']);
            $document_id = ($document_id)? $document_id: sw_get_last_document_issued($year) + 1;
            $record['document_ident'] = ($record['document_ident'])? $record['document_ident']: $document_id;

            if (!$record['invoice_issued_id'])
            {
            	$record['created_dt'] = date('Y-m-d H:i:s');
              sw_insert_table("invoice_issued", $record);
						}

            if ($record_invoice = sw_get_data_table('invoice_issued', $sqlInvoice))
            {
            	$record['invoice_issued_id'] = $record_invoice['invoice_issued_id'];

              //search invoice tax
							$record_tax_rate = sw_get_tax_rate($tax_rate_no);
            	if ($record_tax_rate && $subtotal_amount != 0)
              {
              	$sql_tax = "(invoice_issued_id = {$record['invoice_issued_id']}) AND (tax_rate_id = {$record_tax_rate['tax_rate_id']})";
                if (!$record_tax = sw_get_data_table('invoice_issued_tax', $sql_tax))
                {
                	$record_tax['invoice_issued_id'] 	= $record['invoice_issued_id'];
                  $record_tax['tax_rate_id'] 				= $record_tax_rate['tax_rate_id'];
                  $record_tax['rate_no'] 						= $record_tax_rate['rate_no'];
                  $record_tax['base_amt'] 					= round(floatval($subtotal_amount) + floatval($transport_amount), 2);
                  $record_tax['tax_amt'] 						= round($record_tax['base_amt'] * ($record_tax['rate_no'] / 100), 2);

                  sw_insert_table("invoice_issued_tax", $record_tax);
								}
                else {
									$record_tax['base_amt'] += round(floatval($subtotal_amount) + floatval($transport_amount), 2);
                  $record_tax['tax_amt'] = round($record_tax['base_amt'] * ($record_tax['rate_no'] / 100), 2);
                  sw_update_table("invoice_issued_tax", $record_tax, $sql_tax);
							 	}
							}

						 	$record['subtotal_amt'] += round(floatval($subtotal_amount), 2);
						 	$record['transport_amt'] += round(floatval($transport_amount), 2);
						 	$record['other_income_amt'] += round(floatval($other_income_amount), 2);

							$record['base_withholding_amt'] += round(floatval($base_withholding_amount), 2);
						 	$record['withholding_rate_no'] += round(floatval($withholding_rate_no), 2);
						 	$record['withholding_amt'] += round((floatval($base_withholding_amount) * (floatval($withholding_rate_no) / 100)), 2);

              $this->invoice_date_tmp = $invoice_date;
              $this->invoice_number_tmp = $invoice_number;
							$this->invoice_taxid_tmp = $tax_ident;

							$tax_amount = sw_get_data_table('invoice_issued_tax', "(invoice_issued_id = {$record['invoice_issued_id']})", "SUM(tax_amt) AS tax_amt");
							$record['tax_amt'] = $tax_amount['tax_amt'];

							$record['total_amt'] = ($record['subtotal_amt'] + $record['tax_amt'] + $record['other_income_amt'] + $record['transport_amt']) - $record['withholding_amt'];

							$sql = "(invoice_issued_id = {$record['invoice_issued_id']})";
              sw_update_table("invoice_issued", $record, $sql);
						}
					}
			 }
		}

		Unset($this->worksheet);
	}


	function import_invoice_received_excel(){

		for($this->row = ( $this->beginning_row ? $this->beginning_row : 2); $this->row <= $this->rows; $this->row++)
		{
			$invoice_date = ($this->col_invoice_date)? $this->worksheet->getCellByColumnAndRow($this->col_invoice_date - 1, $this->row)->getCalculatedValue(): "";
      if (strlen($invoice_date) != 0 && gettype($invoice_date) !== 'string')
      {
      	$invoice_date = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($invoice_date));
			}
      $invoice_number = ($this->col_invoice_number) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_invoice_number - 1, $this->row)->getCalculatedValue()), 0, 50): "";
			$tax_ident = ($this->col_tax_ident) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_tax_ident - 1, $this->row)->getCalculatedValue()), 0, 20): "";
			$tax_ident = sw_clean_caracter_tax_ident($tax_ident);
			$name = ($this->col_name) ? substr(trim($this->worksheet->getCellByColumnAndRow($this->col_name - 1, $this->row)->getCalculatedValue()), 0, 200): "";
			$subtotal_amount = ($this->col_subtotal_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_subtotal_amount - 1, $this->row)->getCalculatedValue()): "0";
			$transport_amount = ($this->col_transport_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_transport_amount - 1, $this->row)->getCalculatedValue()): "0";
    	$other_amount = ($this->col_other_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_other_amount - 1, $this->row)->getCalculatedValue()): "0";
			$tax_rate_no = ($this->col_tax_rate) ? trim($this->worksheet->getCellByColumnAndRow($this->col_tax_rate - 1, $this->row)->getCalculatedValue()): "0";
      $tax_rate_no = ($tax_rate_no < 1) ? round($tax_rate_no * 100, 2): $tax_rate_no;
      $tax_amount = ($this->col_tax_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_tax_amount - 1, $this->row)->getCalculatedValue()): "0";
      $base_withholding_amount = ($this->col_base_withholding_amount) ? trim($this->worksheet->getCellByColumnAndRow($this->col_base_withholding_amount - 1, $this->row)->getCalculatedValue()): "0";
      $withholding_rate_no = ($this->col_withholding_rate) ? trim($this->worksheet->getCellByColumnAndRow($this->col_withholding_rate - 1, $this->row)->getCalculatedValue()): "0";
      $withholding_rate_no = ($withholding_rate_no < 1)? $withholding_rate_no * 100: $withholding_rate_no;
      $total_amount = ($this->col_total_amount)? trim($this->worksheet->getCellByColumnAndRow($this->col_total_amount - 1, $this->row)->getCalculatedValue()): "0";
      $document_id = ($this->col_document_id)? trim($this->worksheet->getCellByColumnAndRow($this->col_document_id - 1, $this->row)->getCalculatedValue()): "0";

      list($year, $month, $day) = explode('-', $invoice_date);
      if ( (strlen($invoice_date) != 0) &&
						$this->checkInvoiceDate($invoice_date) &&
				 	  $this->checkInvoiceNumber($invoice_number) &&
						$this->checkTaxId($tax_ident) &&
						$this->checkTaxRate($tax_rate_no))
			{
				//Insert provider company
        $sql = "(company_id = {$this->company_id}) AND (tax_ident = '{$tax_ident}') ";
        if (!$record_provider = sw_get_data_table('company_provider', $sql))
        {
					$record_provider['company_id'] 		= $this->company_id;
          $record_provider['tax_ident'] 		= $tax_ident;
          $record_provider['provider_name'] = ($name = !mb_check_encoding($name, 'UTF-8') ? strtoupper(utf8_encode($name)) : strtoupper($name));
          $record_provider['country_id'] 		= sw_country_tax_ident($record_provider['tax_ident']);

					sw_insert_table("company_provider", $record_provider);
					$record_provider = sw_get_data_table('company_provider', $sql);
				}

				$company_provider_id = $record_provider['company_provider_id'];

				$sqlInvoice = "(company_id = {$this->company_id}) AND
										(invoice_number = '{$invoice_number}') AND
										(invoice_dt = '{$invoice_date}') AND
										(tax_ident = '{$tax_ident}') ";
				$record = sw_get_data_table('invoice_received', $sqlInvoice);
				if (!isset($record['accounted_yn']) || !$record['accounted_yn'])
				{
					// Si la factura existe la elimino, para empezar desde cero
					if ($record['invoice_received_id'] &&
							(($invoice_date != $this->invoice_date_tmp) ||
							($invoice_number != $this->invoice_number_tmp) ||
							($tax_ident != $this->invoice_taxid_tmp)))
					{
						sw_delete_table('invoice_received_tax', "(invoice_received_id = {$record['invoice_received_id']})");

						$record['subtotal_amt'] 				= 0;
						$record['transport_amt'] 				= 0;
						$record['other_expense_amt'] 		= 0;
						$record['base_withholding_amt'] = 0;
						$record['withholding_rate_no'] 	= 0;
						$record['withholding_amt'] 			= 0;
						$record['tax_amt'] 							= 0;
						$record['total_amt'] 						= 0;
					}

					//Assign value
					$record['company_id'] 					= $this->company_id;
					$record['created_by_user_id'] 	= $_SESSION['user_id'];
					$record['invoice_number'] 			= strtoupper($invoice_number);
					$record['invoice_dt'] 					= $invoice_date;
					$record['company_provider_id'] 	= $company_provider_id;
					$record['tax_ident'] 						= $record_provider['tax_ident'];
					$record['provider_name'] 				= $name;
					$record['expense_type_id']     	= $record_provider['expense_type_id'];

					//Assign registered accountant
					sw_assign_registered_accountant($record, $this->registration_date);

					list($year, $month, $day) = explode('-', $record['registered_in_acctg_software_dt']);
					$document_id = ($document_id)? $document_id: sw_get_last_document_received($year) + 1;
					$record['document_ident'] = ($record['document_ident'])? $record['document_ident']: $document_id;


					if (!$record['invoice_received_id'])
					{
						$record['created_dt'] = date('Y-m-d H:i:s');
						sw_insert_table("invoice_received", $record);
					}

					if ($record_invoice = sw_get_data_table('invoice_received', $sqlInvoice))
					{
						$record['invoice_received_id'] = $record_invoice['invoice_received_id'];

						//search invoice tax
						$record_tax_rate = sw_get_tax_rate($tax_rate_no);
            if ($record_tax_rate && $subtotal_amount != 0)
						{
							$sql_tax = "(invoice_received_id = {$record['invoice_received_id']}) AND (tax_rate_id = {$record_tax_rate['tax_rate_id']})";
							if (!$record_tax = sw_get_data_table('invoice_received_tax', $sql_tax))
							{
								$record_tax['invoice_received_id'] = $record_invoice['invoice_received_id'];
								$record_tax['tax_rate_id'] = $record_tax_rate['tax_rate_id'];
								$record_tax['rate_no'] = $record_tax_rate['rate_no'];
								$record_tax['base_amt'] = round(floatval($subtotal_amount) + floatval($transport_amount), 2);
								$record_tax['tax_amt'] = round($record_tax['base_amt'] * ($record_tax['rate_no']/100), 2);
								sw_insert_table("invoice_received_tax", $record_tax);
							}
							else {
								$record_tax['base_amt'] += round(floatval($subtotal_amount) + floatval($transport_amount), 2);
								$record_tax['tax_amt'] = round($record_tax['base_amt'] * ($record_tax['rate_no']/100), 2);
								sw_update_table("invoice_received_tax", $record_tax, $sql_tax);
						 	}
						}

						$record['subtotal_amt']     += round(floatval($subtotal_amount), 2);
						$record['transport_amt']    += round(floatval($transport_amount), 2);
						$record['other_expense_amt'] += round(floatval($other_expense_amount), 2);

						$record['base_withholding_amt'] += round(floatval($base_withholding_amount), 2);
						$record['withholding_rate_no']  += round(floatval($withholding_rate_no), 2);
						$record['withholding_amt'] += round((floatval($base_withholding_amount) * (floatval($withholding_rate_no)/100)), 2);

            $this->invoice_date_tmp = $invoice_date;
            $this->invoice_number_tmp = $invoice_number;
						$this->invoice_taxid_tmp = $tax_ident;

						$tax_amount = sw_get_data_table('invoice_received_tax', "(invoice_received_id = {$record['invoice_received_id']})", "SUM(tax_amt) AS tax_amt");
						$record['tax_amt'] = $tax_amount['tax_amt'];

						$record['total_amt'] = ($record['subtotal_amt'] + $record['tax_amt'] + $record['other_expense_amt']) - $record['withholding_amt'];

						$sql = "(invoice_received_id = {$record['invoice_received_id']})";
						sw_update_table("invoice_received", $record, $sql);
					}
		 		}
      }
		}

		Unset($this->worksheet);
	}


  function checkInvoiceDate($invoice_date){

		 list($year, $month, $day) = explode('-', $invoice_date);
		 if (!checkdate($month, $day, $year)){

		 		list($year, $month, $day) = explode('/', $invoice_date);
				if (!checkdate($month, $day, $year)){

					$this->logError("La fecha de la factura no es correcta " . $invoice_date);
					return false;
				}
		 }
		 return true;
	}


  function checkInvoiceNumber($invoice_number){

	   if (strlen($invoice_number) == 0) {
				$this->logError(utf8_encode("El número de factura esta en blanco"));
				return false;
		 }
		 return true;
	}

  function checkTaxId($tax_ident){

	   if (strlen($tax_ident) == 0) {
				$this->logError("El identificador del cliente esta en blanco");
				return false;
		 }
		 return true;
	}

  function checkTaxRate($tax_rate_no){

	   $record_tax_rate = sw_get_tax_rate($tax_rate_no);
	   if (!$record_tax_rate) {
				$this->logError(utf8_encode("El porcentaje de impuesto no es válido ") . $tax_rate_no);
				return false;
		 }
		 return true;
	}


	function logError($message){

		$fp = fopen($this->fileError, "a+");

		$file_line = utf8_encode("línea {$this->row}: ") . $message . "\r\n";

		fwrite($fp, $file_line);
		fclose($fp);
	}


	function create_zip_file($filezip)
	{
		$zip = new zipArchiveLib();
		$zip->addFile($this->fileError, "Fichero errores de importacion de excel.txt");
		$zip->saveZip($filezip);
		$zip->downloadZip($filezip);
	}

}
?>