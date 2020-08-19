<?php
  /* Export Conta Plus
  */
require_once('accounting.php');

class ExportContaPlusLib  {
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

  // private constructor function
  function __construct()
  {
    $this->record_subaccount['cod'] = '';  // cod(12)
    $this->record_subaccount['titulo'] = str_repeat(' ', 40); //titulo(40)
    $this->record_subaccount['nif'] = ''; //nif(15)
    $this->record_subaccount['domicilio'] = str_repeat(' ', 35); //Domicilio(35)
    $this->record_subaccount['poblacion'] = str_repeat(' ', 25); //Poblacion(25)
    $this->record_subaccount['provincia'] = str_repeat(' ', 20); //Provincia(20)
    $this->record_subaccount['codpostal'] = str_repeat(' ', 5); //CodPostal(5)
    $this->record_subaccount['divisa'] = 'F'; //divisa(1)
    $this->record_subaccount['coddivisa'] = 'EUR  '; //Coddivisa(5)
    $this->record_subaccount['documento'] = 'F';  //Documento(1)
    $this->record_subaccount['ajustame'] = 'F'; //Ajustame(1)
    $this->record_subaccount['tipoiva'] = ' '; //TipoIVA(1)
    $this->record_subaccount['proye'] = str_repeat(' ', 9); //Proye(9)
    $this->record_subaccount['subequiv'] = str_repeat(' ', 12); //SubEquiv(12)
    $this->record_subaccount['subcierre'] = str_repeat(' ', 12); //SubCierre(12)
    $this->record_subaccount['linterrump'] = 'F'; // LInterrump(1)
    $this->record_subaccount['segmento'] = str_repeat(' ', 12); //Segmento(12)
    $this->record_subaccount['tpc'] = '0.00'; //TPC(5)
    $this->record_subaccount['recequiv'] = '0.00'; //RecEquiv
    $this->record_subaccount['fax01'] = str_repeat(' ', 15); //Fax01(15)
    $this->record_subaccount['email'] = str_repeat(' ', 50); //email(50)
    $this->record_subaccount['titulol'] = str_repeat(' ', 100); //TituloL(100)
    $this->record_subaccount['segmento'] = str_repeat(' ', 12); //Segmento(12)
    $this->record_subaccount['idnif'] = 'O'; //IdNif(1)
    $this->record_subaccount['codpais'] = ''; //CodPais(2)
    $this->record_subaccount['rep14nif'] = str_repeat(' ', 9); //Rep14NIF(9)
    $this->record_subaccount['rep14nom'] = str_repeat(' ', 40); //Rep14Nom(40)
    $this->record_subaccount['metcobro'] = "F"; //MetCobro(1)
    $this->record_subaccount['metcobfre'] = "F"; //MetCobFre(1)
    $this->record_subaccount['suplido'] = "F"; //Suplido(1)
    $this->record_subaccount['provision'] = "F"; //Provision(1)
    $this->record_subaccount['lesirpf'] = "F"; //lEsIRPF(1)
    $this->record_subaccount['nirpf'] = '0.00'; //nIRPF(5)
    $this->record_subaccount['nclaveirpf'] = '0'; //nClaveIRPF(2)
    $this->record_subaccount['lesmod130'] = 'F'; //lEsMod130(1)
    $this->record_subaccount['ldeducible'] = 'F'; //lDeducible(1)

    $record_movement['asien'] = 0;     //Asien(6)
    $record_movement['fecha'] = '';     //fecha(8)
    $record_movement['subcta'] = '';    //SubCta(12)
    $record_movement['contra'] = '';    //Contra(12)
    $record_movement['ptadebe'] = '0.00';   //PtaDebe(16)
    $record_movement['concepto'] = '';  //Concepto(25)
    $record_movement['ptahaber'] = '0.00';   //PtaHaber(16)
    $record_movement['factura'] = '';   //Factura(8)
    $record_movement['baseimpo'] = '0.00'; //Baseimpo(16)
    $record_movement['iva'] = '0.00'; //Baseimpo(5)
    $record_movement['recequiv'] = '0.00'; //Recequiv(5)
    $record_movement['documento'] = ''; //Documento(10)
    $record_movement['departa'] = ''; //Departa(3)
    $record_movement['clave'] = ''; //Clave(6)
    $record_movement['estado'] = ''; //estado(1)
    $record_movement['ncasado'] = '0'; //ncasado(6)
    $record_movement['tcasado'] = '0'; //tcasado(1)
    $record_movement['trans'] = '0'; //Trans(6)
    $record_movement['cambio'] = '0.000000'; //Cambio(16)
    $record_movement['debeme'] = '0.00'; //DebeMe(16)
    $record_movement['haberme'] = '0.00'; //Departa(16)
    $record_movement['auxiliar'] = ''; //Auxiliar(1)
    $record_movement['serie'] = ''; //Serie(1)
    $record_movement['sucursal'] = ''; //Sucursal(4)
    $record_movement['coddivisa'] = ''; //CodDivisa(5)
    $record_movement['impauxme'] = '0.00'; //ImpAuxMe(16)
    $record_movement['monedauso'] = '2'; //MonedaUso(2)
    $record_movement['eurodebe'] = '0.00'; //EuroDebe(16)
    $record_movement['eurohaber'] = '0.00'; //Eurohaber(16)
    $record_movement['baseeuro'] = '0.00'; //BaseEuro(16)
    $record_movement['noconv'] = 'F'; //NoConv(1)
    $record_movement['numeroinv'] = ''; //NumeroInv(10)
    $record_movement['serie_rt'] = ''; //Serie_RT(1)
    $record_movement['factu_rt'] = '0'; //Factu_RT(8)
    $record_movement['baseimp_rt'] = '0.00'; //BaseImp_RT(16)
    $record_movement['baseimp_rf'] = '0.00'; //BaseImp_RF(16)
    $record_movement['rectifica'] = 'F'; //Rectifica(1)
    $record_movement['fecha_rt'] = ''; //Fecha_RT(8)
    $record_movement['nic'] = 'E'; //Nic(1)
    $record_movement['libre1'] = 'F'; //Libre1(1)
    $record_movement['libre2'] = '0'; //libre2(6)
    $record_movement['linterrump'] = 'F'; //LInterrump(1)
    $record_movement['segactiv'] = ''; //SegActiv(6)
    $record_movement['seggeog'] = ''; //SegGeog(6)
    $record_movement['lrect349'] = 'F'; //lrect349(1)
    $record_movement['fecha_op'] = ''; //Fecha_OP(8)
    $record_movement['fecha_ex'] = ''; //Fecha_EX(8)
    $record_movement['departa5'] = ''; //Departa5(5)
    $record_movement['factura10'] = ''; //Factura10(10)
    $record_movement['porcen_ana'] = '0.00'; //Porcen_Ana(5)
    $record_movement['porcen_seg'] = '0.00'; //Porcen_Seg(5)
    $record_movement['numapunte'] = '0'; //NumApunte(6)
    $record_movement['eurototal'] = '0.00'; //EuroTotal(16)
    $record_movement['razonsoc'] = ''; //RazonSoc(100)
    $record_movement['apellido1'] = ''; //Apellido1(50)
    $record_movement['apellido2'] = ''; //Apellido2(50)
    $record_movement['tipoope'] = ''; //TipoOpe(1)
    $record_movement['nfactick'] = '0'; //nFacTick(8)
    $record_movement['numacuini'] = ''; //NumAcuIni(40)
    $record_movement['numacufin'] = ''; //NumAcuFin(40)
    $record_movement['teridnif'] = '0'; //TerIdNif(1)
    $record_movement['ternif'] = ''; //TerNif(15)
    $record_movement['ternom'] = ''; //TerNom(40)
    $record_movement['ternif14'] = ''; //TerNif14(9)
    $record_movement['tbientran'] = 'F'; //TBienTran(1)
    $record_movement['tbiencod'] = ''; //TBienCod(10)
    $record_movement['transinm'] = 'F'; //TransInm(1)
    $record_movement['metal'] = 'F'; //Metal(1)
    $record_movement['metalimp'] = '0.00'; //MetalImp(16)
    $record_movement['cliente'] = ''; //Cliente(12)
    $record_movement['opbienes'] = '0'; //OpBienes(1)
    $record_movement['facturaex'] = ''; //FacturaEx(40)
    $record_movement['tipofac'] = 'E'; //TipoFac(1)
    $record_movement['tipoiva'] = 'J'; //TipoIva(1)
    $record_movement['guid'] = ''; //Guid(40)
    $record_movement['l340'] = 'F'; //L340(1)
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
         $record['country_cd'] = $query->Fields['iso_cd'];
         $record['rate_no'] = "";
         if($record['account_cd']){
            $this->Save_record_subaccount($record);
		 		 }

         $query->next();
      }

      //VAT Account
      $record = array();
      $sql = "SELECT * FROM vw_company_tax_account WHERE company_id = {$company_id} ORDER BY account_cd ";
      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->open();

      While( ! $query->EOF)
      {
         $record['account_cd'] = trim($query->Fields['account_cd']);
         $record['account_name'] = utf8_decode($query->Fields['tax_type_name']);
         $record['tax_type_cd'] = $query->Fields['tax_type_cd'];
         $record['rate_no'] = $query->Fields['rate_no'];
         $record['currency_cd'] = "EUR";
         $record['tax_ident'] = "";
         $record['postal_cd'] = "";
         $record['country_cd'] = "";

         if($record['account_cd'])
            $this->Save_record_subaccount($record);
         $query->next();
      }
  }


	function export_Subaccount_ProviderTax()
	{
		Global $connectionDB;
		$company_id = $_SESSION['company_id'];

		$sql = "SELECT company_provider.*, country.iso_cd, MID(expense_type.account_expense_cd,1,2) as prefix
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
			$record['country_cd'] = $query->Fields['iso_cd'];
			$record['rate_no'] = "";
			if ($record['account_cd']) $this->Save_record_subaccount($record);

			//Account Expense
			if ($query->Fields['account_expense_cd']){
				$record['account_cd'] = $query->Fields['account_expense_cd'];
				$record['tax_ident']  = "";
				$record['postal_cd']  = "";
				$record['country_cd'] = "";
				$this->Save_record_subaccount($record);
			}

			//Account Other Expense
			if ($query->Fields['account_other_expense_cd']){
				$record['account_cd'] = $query->Fields['account_other_expense_cd'];
				$record['tax_ident']  = "";
				$record['postal_cd']  = "";
				$record['country_cd'] = "";
				$this->Save_record_subaccount($record);
			}

			//Account Withholding
			if ($query->Fields['account_withholding_cd']){
				$record['account_cd'] = $query->Fields['account_withholding_cd'];
				$record['tax_ident']  = "";
				$record['postal_cd']  = "";
				$record['country_cd'] = "";
				$this->Save_record_subaccount($record);
			}
			$query->next();
		}

		//VAT Account
		$record = array();
		$record['create_date'] = $this->fromDate;
		$sql = "SELECT * FROM vw_company_tax_account WHERE company_id = {$company_id} ORDER BY account_cd ";
		$query = New Query();
		$query->Database = $connectionDB->DbConnection;
		$query->SQL = $sql;
		$query->LimitStart = -1;
		$query->LimitCount = -1;
		$query->open();

		While (!$query->EOF){
			$record['account_cd'] = trim($query->Fields['account_cd']);
			$record['account_name'] = utf8_decode($query->Fields['tax_type_name']);
			$record['tax_type_cd'] = $query->Fields['tax_type_cd'];
			$record['rate_no'] = $query->Fields['rate_no'];
			$record['tax_ident']  = "";
			$record['postal_cd']  = "";
			$record['country_cd'] = "";

			if ($record['account_cd']) $this->Save_record_subaccount($record);
			$query->next();
		}
	}


  function Save_record_subaccount($record)
  {

    $this->record_subaccount['cod'] = $record['account_cd'];
    $this->record_subaccount['titulo'] = $record['account_name'] ? $record['account_name'] : "";
    $this->record_subaccount['nif'] = $record['tax_ident'] ? $record['tax_ident'] : "";
    $this->record_subaccount['codpostal'] = $record['postal_cd'] ? $record['postal_cd'] : "";
    $this->record_subaccount['codpais'] = $record['country_cd'] ? $record['country_cd'] : "";
    $this->record_subaccount['tipoiva'] = $record['tax_type_cd'] ? $record['tax_type_cd'] : "";

    $rate_no = ($record['rate_no'] != "") ? number_format($record['rate_no'], 2, '.', '') : "";
    $this->record_subaccount['tpc'] = $rate_no; //IVA
    $this->Add_record_subaccount();
  }

  function Add_record_subaccount()
  {
    if ($this->file_subaccount) {
      $fp = fopen($this->file_subaccount, "a+");

      $file_line = sw_repeat_character($this->record_subaccount['cod'], 12, "R", " ");
      $file_line .= sw_repeat_character(substr($this->record_subaccount['titulo'], 0, 40), 40, "R", " ");
      $file_line .= sw_repeat_character(substr($this->record_subaccount['nif'], 0, 15), 15, "R", " ");
      $file_line .= sw_repeat_character($this->record_subaccount['domicilio'], 35, "R", " ");   //Domicilio(35)
      $file_line .= sw_repeat_character($this->record_subaccount['poblacion'], 25, "R", " ");   //Poblacion(25)
      $file_line .= sw_repeat_character($this->record_subaccount['provincia'], 20, "R", " ");   //Provincia(20)
      $file_line .= sw_repeat_character(substr($this->record_subaccount['codpostal'], 0, 5), 5, "R", " ");   //CodPostal(5)
      $file_line .= sw_repeat_character($this->record_subaccount['divisa'], 1, "L", " ");   //divisa(1)
      $file_line .= sw_repeat_character($this->record_subaccount['coddivisa'], 5, "R", " ");   //Coddivisa(5)
      $file_line .= sw_repeat_character($this->record_subaccount['documento'], 1, "R", " ");   //Documento(5)
      $file_line .= sw_repeat_character($this->record_subaccount['ajustame'], 1, "R", " ");   //Ajustame(1)
      $file_line .= sw_repeat_character($this->record_subaccount['tipoiva'], 1, "R", " ");   //TipoIva(1)
      $file_line .= sw_repeat_character($this->record_subaccount['proye'], 9, "R", " ");   //Proye(9)
      $file_line .= sw_repeat_character($this->record_subaccount['subequiv'], 12, "R", " ");   //SubEquiv(12)
      $file_line .= sw_repeat_character($this->record_subaccount['subcierre'], 12, "R", " ");   //SubCierre(12) LInterrump(1)
      $file_line .= sw_repeat_character($this->record_subaccount['linterrump'], 1, "R", " ");   //LInterrump(1)
      $file_line .= sw_repeat_character($this->record_subaccount['segmento'], 12, "R", " ");   //Segmento(12)
      $file_line .= sw_repeat_character($this->record_subaccount['tpc'], 5, "L", " ");   //TPC(5)
      $file_line .= sw_repeat_character($this->record_subaccount['recequiv'], 5, "L", " ");   //RecEquiv(5)
      $file_line .= sw_repeat_character($this->record_subaccount['fax01'], 15, "R", " ");   //Fax01(15)
      $file_line .= sw_repeat_character($this->record_subaccount['email'], 50, "R", " ");   //email(50)
      $file_line .= sw_repeat_character($this->record_subaccount['titulol'], 100, "R", " ");   //TituloL(100)
      $file_line .= sw_repeat_character($this->record_subaccount['idnif'], 1, "L", " ");   //IdNif(1)
      $file_line .= sw_repeat_character($this->record_subaccount['iso_cd'], 2, "L", " ");   //CodPais(2)
      $file_line .= sw_repeat_character($this->record_subaccount['rep14nif'], 9, "R", " ");   //Rep14NIF(9)
      $file_line .= sw_repeat_character($this->record_subaccount['rep14nom'], 40, "R", " ");   //Rep14Nom(40)
      $file_line .= sw_repeat_character($this->record_subaccount['metcobro'], 1, "L", " ");   //MetCobro(1)
      $file_line .= sw_repeat_character($this->record_subaccount['metcobfre'], 1, "L", " ");   //MetCobFre(1)
      $file_line .= sw_repeat_character($this->record_subaccount['suplido'], 1, "L", " ");   //Suplido(1)
      $file_line .= sw_repeat_character($this->record_subaccount['provision'], 1, "L", " ");   //Provision(1)
      $file_line .= sw_repeat_character($this->record_subaccount['lesirpf'], 1, "L", " ");   //lEsIRPF(1)
      $file_line .= sw_repeat_character($this->record_subaccount['nirpf'], 5, "L", " ");   //nIRPF(5)
      $file_line .= sw_repeat_character($this->record_subaccount['nclaveirpf'], 2, "L", " ");   //nClaveIRPF(2)
      $file_line .= sw_repeat_character($this->record_subaccount['lesmod130'], 1, "L", " ");   //lEsMod130(1)
      $file_line .= sw_repeat_character($this->record_subaccount['ldeducible'], 1, "L", " ");   //lDeducible(1)
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

					$this->Increase_seat();
					$tax_amt = 0;
					$total_amt = (floatval($record["subtotal_amt"]) +
					floatval($record["transport_amt"]) +
					floatval($record["tax_amt"]) +
					floatval($record["other_income_amt"])) -
					floatval($record["withholding_amt"]);

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
					$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['client_name']);

					//Save line 430
					$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);

					//Save line 473 withholding
					if(floatval($record['withholding_amt']) != 0)
					{
						 $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $this->record_accounting["account_client_withholding"];
						 $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $record['withholding_amt'];
						 $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";

						 $this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);
					}

					//Save lines 477
					$sql = "SELECT * FROM invoice_issued_tax " .
					"WHERE invoice_issued_id = {$record['invoice_issued_id']} ";

					$query_tax = New Query();
					$query_tax->Database = $connectionDB->DbConnection;
					$query_tax->SQL = $sql;
					$query_tax->LimitStart = -1;
					$query_tax->LimitCount = -1;
					$query_tax->open();

					While( ! $query_tax->EOF)
					{
						 $record_tax = $query_tax->fieldbuffer;

						 $return_tax = $this->get_tax_account($record, $record_tax, $this->record_accounting, $GLOBAL_INVOICE_ACCOUNTING, $this);

						 $query_tax->next();
					}

					//Save lines 705 o 700
					//Trasport
					$sale_amt = floatval($record['subtotal_amt']) +
					floatval($record['transport_amt']) +
					floatval($record['other_income_amt']);
					if(($this->record_accounting["account_transport"]) && ($record['transport_amt'] != 0))
					{
						 $sale_amt -= floatval($record['transport_amt']);

						 //Save lines 705 Sale
						 $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $this->record_accounting['account_transport'];
						 $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $record['transport_amt'];
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['client_name']);

						 $this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);
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
						 $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $account_code;
						 $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
						 $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $record['other_income_amt'];
						 $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
						 $GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['client_name']);

						 $this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);

						 //Create account Supplied
						 $record_subaccount['account_cd'] = $account_code;
						 $record_subaccount['account_name'] = utf8_decode($record['client_name']);
						 $record_subaccount['tax_ident'] = $record['tax_ident'];
						 $record_subaccount['postal_cd'] = $record['postal_cd'];
						 $record_subaccount['currency_cd'] = "EUR";
						 $record_subaccount['country_cd'] = $record['iso_cd'];
						 $record_subaccount['rate_no'] = "";

						 if($record_subaccount['account_cd'])
								$this->Save_record_subaccount($record_subaccount);
					}

					//Save lines 705 Sale
					$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $account_sale;
					$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
					$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $sale_amt;
					$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['client_name']);

					$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);

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
									tax_type_key.tax_type_binding_id, 'invoice_provider' as type
					 FROM invoice_received
								INNER JOIN company_provider ON invoice_received.company_provider_id = company_provider.company_provider_id
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

				$this->Increase_seat();
				$tax_amt = 0;
				$total_amt = (floatval($record["subtotal_amt"]) +
											floatval($record["transport_amt"]) +
											floatval($record["tax_amt"]) +
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
				$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $total_amt;
				$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['provider_name']);

				//Save line 400
				$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);

				//Save line 4751 withholding
				if (floatval($record['withholding_amt']) != 0) {
					$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_withholding_cd"];
					$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
					$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $record['withholding_amt'];
					$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
					$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";

					$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);
				}

				//Total Expense
				$expense_amt = floatval($record['subtotal_amt']) +
											 floatval($record['transport_amt']) +
											 floatval($record['other_expense_amt']);

				//Save lines 472
				$sql = "SELECT * FROM invoice_received_tax " .
							 "WHERE invoice_received_id = {$record['invoice_received_id']}";

				$query_tax = New Query();
				$query_tax->Database = $connectionDB->DbConnection;
				$query_tax->SQL = $sql;
				$query_tax->LimitStart = -1;
				$query_tax->LimitCount = -1;
				$query_tax->open();

				While (!$query_tax->EOF){
					$record_tax = $query_tax->fieldbuffer;

					/* Si el tipo de Operacion son
						C => Deducible en adquisiciones intracomunitarias de bienes
						Z => Deducible en adquisiciones intracomunitarias de servicios
						P => Deducible por inversiÃ³n del sujeto pasivo
						K => No Deducible
					*/
					if (array_search($record['tax_type_cd'], $GLOBAL_SPECIAL_ACCOUNT_VAT) !== False) {
						$expense_amt += floatval($record_tax['tax_amt']);
					}

					$return_tax = $this->get_tax_account($record, $record_tax, $this->record_accounting, $GLOBAL_INVOICE_ACCOUNTING, $this);

					$query_tax->next();
				}

				//Other Expense
				if ((($this->record_accounting["account_other_expense"]) || ($record["account_other_expense_cd"])) &&
						($record['other_expense_amt']!=0)) {
						$expense_amt -= floatval($record['other_expense_amt']);

						$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_other_expense_cd"] ? $record["account_other_expense_cd"] : $this->record_accounting['account_other_expense'];
						$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
						$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $record['other_expense_amt'];
						$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
						$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
						$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
						$GLOBAL_INVOICE_ACCOUNTING['account_name'] = utf8_decode($record['provider_name']);

						$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);
				}

				//Save lines 600 Sale
				$GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record['account_expense_cd'];
				$GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
				$GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $expense_amt;
				$GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";
				$GLOBAL_INVOICE_ACCOUNTING['account_name'] = ($record['provider_name']);

				$this->Save_record_movement($record, $GLOBAL_INVOICE_ACCOUNTING);

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


  function Increase_seat()
  {
    ++$this->record_movement['asien'];
  }

	function get_tax_account($record_invoice, $record_tax, $record_accounting, $GLOBAL_INVOICE_ACCOUNTING, $export)
	{
  	Global $connectionDB;

  	$vat_include_yn = false;
  	$result = array();
  	$where = "(company_id = {$record_invoice['company_id']}) AND
				(tax_type_key_id = {$record_invoice['tax_type_key_id']}) AND
				((apply_of_tax_dt <= '{$record_invoice['invoice_dt']}') OR (apply_of_tax_dt IS NULL))";

		/* Si el tipo de Operacion son
			C => Deducible en adquisiciones intracomunitarias de bienes
	  	Z => Deducible en adquisiciones intracomunitarias de servicios
	  	P => Deducible por inversión del sujeto pasivo
	  	J => Deducible No Sujeto
  		K => No Deducible
		*/

		$regime_general_yn = ($record_invoice['tax_type_cd'] == 'G' || $record_invoice['tax_type_cd'] == 'O' ||
										  		$record_invoice['tax_type_cd'] == 'J' || $record_invoice['tax_type_cd'] == 'K');
  	if ($regime_general_yn) {
	  	$where .= " AND (tax_rate_id = {$record_tax['tax_rate_id']})";
  	}

  	If ($record_invoice['tax_type_cd'] != '0'){
			$record = sw_get_data_table("vw_company_tax_account", $where);
			$result['account_cd'] = $record['account_cd'];

			if ($regime_general_yn){
				$result['base_amt'] = $record_tax['base_amt'];
				$result['tax_amt']  = $record_invoice['tax_type_cd'] != 'K' ? $record_tax['tax_amt'] : 0;
				$result['rate_no']  = $record_invoice['tax_type_cd'] == 'J' ? 0 : $record['rate_no'];
				$result['overhead_rate_no'] = $record_invoice['tax_type_cd'] == 'J' ? 0 : $record_tax['overhead_rate_no'];
			}else {
				$result['base_amt'] = floatval($record_invoice["subtotal_amt"] + $record_invoice["transport_amt"] - $record_invoice["discount_amt"]);
				$result['tax_amt']  = floatval($result['base_amt'] * ($record['rate_no']/100));
				$result['rate_no']  = $record['rate_no'];
				$result['overhead_rate_no'] = 0;
			}

			$result['active_amt'] = $record['type_tax_cd'] == GLOBAL_INPUT_TAX ? $result['tax_amt'] : "";
			$result['pasive_amt'] = $record['type_tax_cd'] == GLOBAL_OUTPUT_TAX ? $result['tax_amt'] : "";

			$GLOBAL_INVOICE_ACCOUNTING['account_cd']  			= $result['account_cd'];
			$GLOBAL_INVOICE_ACCOUNTING['counterpart'] 			= $record_invoice['account_cd'];
			$GLOBAL_INVOICE_ACCOUNTING['active_amt']  			= $result['active_amt'];
			$GLOBAL_INVOICE_ACCOUNTING['pasive_amt']  			= $result['pasive_amt'];
			$GLOBAL_INVOICE_ACCOUNTING['base_amt']    			= $result['base_amt'];
			$GLOBAL_INVOICE_ACCOUNTING['rate_no']     		 	= $result['rate_no'];
			$GLOBAL_INVOICE_ACCOUNTING['overhead_rate_no'] 	= $result['overhead_rate_no'];
			$GLOBAL_INVOICE_ACCOUNTING['account_name'] 			= $record['tax_type_name'];

			$export->Save_record_movement($record_invoice, $GLOBAL_INVOICE_ACCOUNTING);

			if ($record['tax_type_binding_id'] != 0){
	  		$where = "(company_id = {$record_invoice['company_id']}) AND
									(tax_type_key_id = {$record['tax_type_binding_id']}) AND
									(tax_rate_id = {$record['tax_rate_id']})";
	  		$record_binding = sw_get_data_table("vw_company_tax_account", $where);
	  		$result['account_cd'] = $record_binding['account_cd'];
	  		$result['active_amt'] = $record_binding['type_tax_cd'] == GLOBAL_INPUT_TAX ? $result['tax_amt'] : "";
	  		$result['pasive_amt'] = $record_binding['type_tax_cd'] == GLOBAL_OUTPUT_TAX ? $result['tax_amt'] : "";

	  		$GLOBAL_INVOICE_ACCOUNTING['account_cd']  = $result['account_cd'];
	  		$GLOBAL_INVOICE_ACCOUNTING['active_amt']  = $result['active_amt'];
	  		$GLOBAL_INVOICE_ACCOUNTING['pasive_amt']  = $result['pasive_amt'];
	  		$GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $result['base_amt'];
	  		$GLOBAL_INVOICE_ACCOUNTING['rate_no']     = $result['rate_no'];
				$GLOBAL_INVOICE_ACCOUNTING['account_name'] = $record['tax_type_name'];
	  		$export->Save_record_movement($record_invoice, $GLOBAL_INVOICE_ACCOUNTING);
			}
  	}
  	return $result;
	}

  function Save_record_movement($record_invoice, $invoice_accounting)
  {
    $tipofac = " ";
    if ($record_invoice['type'] == 'invoice_client') $tipofac = "E";
    else if ($record_invoice['type'] == 'invoice_provider') $tipofac = "R";

    $this->record_movement['fecha'] = str_replace('-', '', $record_invoice['registered_in_acctg_software_dt']);    //Fecha
    $this->record_movement['subcta'] = $invoice_accounting['account_cd']; //SubCuenta
    $this->record_movement['contra'] = $invoice_accounting['counterpart'];
    $this->record_movement['concepto'] = substr($invoice_accounting['concept'], 0, 25); // Concepto del asiento
    $this->record_movement['factura'] = $this->invoice_number($invoice_accounting['invoice_number']); //Factura

    $rate_no = ($invoice_accounting['rate_no'] != "") ? number_format($invoice_accounting['rate_no'], 2, '.', '') : "0.00";
    $this->record_movement['iva'] = $rate_no; //IVA
		$this->record_movement['recequiv'] = $invoice_accounting['overhead_rate_no'];
    $this->record_movement['documento'] = $tipofac == "E" ? $this->record_movement['factura'] : substr($invoice_accounting['document_ident'],0,10); //Documento(10)
    $this->record_movement['auxiliar'] = " "; //(floatval($record["tax_amt"]) == 0) ? "*": " "; //Auxiliar
    $this->record_movement['monedauso'] = "2"; //MonedaUso

    $active_amt = ($invoice_accounting['active_amt'] != "") ? number_format($invoice_accounting['active_amt'], 2, '.', '') : "0.00";
    $pasive_amt = ($invoice_accounting['pasive_amt'] != "") ? number_format($invoice_accounting['pasive_amt'], 2, '.', '') : "0.00";
    $base_amt   = ($invoice_accounting['base_amt'] != "") ? number_format($invoice_accounting['base_amt'], 2, '.', '') : "0.00";

    $this->record_movement['eurodebe'] = $active_amt; //EuroDebe
    $this->record_movement['eurohaber'] = $pasive_amt; //EuroHaber
    $this->record_movement['baseeuro'] = $base_amt; //BaseEuro
    $this->record_movement['fecha_op'] = str_replace('-', '', $record_invoice['registered_in_acctg_software_dt']); //Fecha_OP(8)
    $this->record_movement['fecha_ex'] = str_replace('-', '', $record_invoice['invoice_dt']); //Fecha_EX(8)
    $this->record_movement['facturaex'] = $invoice_accounting['invoice_number']; //FacturaEx(40)

    $this->record_movement['tipofac'] = $tipofac; //TipoFac(1)

    $this->record_movement['tipoiva'] = $record_invoice['tax_type_cd']; //TipoIva(1)
    $this->record_movement['l340'] = "T"; //L340

    $this->Add_record_movement();
  }

  function invoice_number($invoice)
  {
    $invoice = substr(strrev($invoice), 0, 8);
    $value = str_split($invoice);
    foreach ($value as $string) {
      if (is_numeric($string)) {
        $return .= $string;
      }else break;
    }
    return strrev($return);
  }

  function Add_record_movement()
  {
    if ($this->file_movement) {
      $fp = fopen($this->file_movement, "a+");

      $file_line = sw_repeat_character($this->record_movement['asien'], 6, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['fecha'], 8, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['subcta'], 12, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['contra'], 12, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ptadebe'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['concepto'], 25, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ptahaber'], 16, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['factura'], 8, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['baseimpo'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['iva'], 5, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['recequiv'], 5, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['documento'], 10, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['departa'], 3, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['clave'], 6, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['estado'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ncasado'], 6, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['tcasado'], 1, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['trans'], 6, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['cambio'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['debeme'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['haberme'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['auxiliar'], 1, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['serie'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['sucursal'], 4, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['coddivisa'], 5, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['impauxme'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['monedauso'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['eurodebe'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['eurohaber'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['baseeuro'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['noconv'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['numeroinv'], 10, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['serie_rt'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['factu_rt'], 8, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['baseimp_rt'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['baseimp_rf'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['rectifica'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['fecha_rt'], 8, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['nic'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['libre1'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['libre2'], 6, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['linterrump'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['segactiv'], 6, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['seggeog'], 6, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['lrect349'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['fecha_op'], 8, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['fecha_ex'], 8, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['departa5'], 5, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['factura10'], 10, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['porcen_ana'], 5, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['porcen_seg'], 5, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['numapunte'], 6, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['eurototal'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['razonsoc'], 100, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['apellido1'], 50, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['apellido2'], 50, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tipoope'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['nfactick'], 8, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['numacuini'], 40, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['numacufin'], 40, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['teridnif'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ternif'], 15, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ternom'], 40, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['ternif14'], 9, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tbientran'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tbiencod'], 10, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['transinm'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['metal'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['metalimp'], 16, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['cliente'], 12, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['opbienes'], 1, "L", " ");
      $file_line .= sw_repeat_character($this->record_movement['facturaex'], 40, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tipofac'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['tipoiva'], 1, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['guid'], 40, "R", " ");
      $file_line .= sw_repeat_character($this->record_movement['l340'], 1, "R", " ");
      $file_line .= "\r\n";

      fwrite($fp, $file_line);
      fclose($fp);
     }
  }

	function create_zip_file($filezip)
	{
		$zip = new zipArchiveLib();
		$zip->addFile($this->file_subaccount, "XSubCta.txt");
		$zip->addFile($this->file_movement, "XDiario.txt");
		$zip->saveZip($filezip);
		$zip->downloadZip($filezip);
	}

}
?>