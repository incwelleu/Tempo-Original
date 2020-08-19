<?php
error_reporting(E_ERROR | E_PARSE);
ini_set("session.gc_maxlifetime","28800");
date_default_timezone_set("Europe/Madrid");
setlocale(LC_MONETARY, 'es_ES');

//set_time_limit(300); // At the beginning of the page

//ini_set("session.use_trans_sid","0");

//ini_set("session.use_only_cookies","1");

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);


// Configuration Server
//$DbHost = 'localhost:/tmp/mysql5.sock';   //Server DB   //'wapiti2.db.9731692.hostedresource.com';
//$DbUser = 'dbo534790602';        //User DB     //'wapiti2';
//$DbPass = 'yunk1k1K';    //Password User DB //'yunk1k1#K';
//$DbName = 'db534790602'; //DB Name


$DbHost = 'localhost';  //Server DB
$DbUser = 'root'; //User DB
$DbPass = ''; //Password User DB
$DbName = 'temposw'; //DB Name


$password_user = 'delano88';
$password_admin = 'tempo2014';

//Company default
$company_country_default = 724;
$company_payment_default = 'TR';

//Home page
$homepage = "ten_most_recent_file.php";
$homepage_adm = "ftp.php";

//Account email
$email_username = "clientarea@incwell.eu";
$email_password = 'tempo_2018';
$email_notify = 'tstrong@strongabogados.com';

$email_DKIM_domain = "incwell.eu";
$email_DKIM_private_string = "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAreMFYJeMLakGZmK1h3HYu3jLaVVohJ0kwCgj/GE2c/bjknn/zSrOD3ZV3wWy6EspL/zxd+9SPQvseUofeGvO++FZNA75F2PfTKVW+2aZloPaqEjw9+4c/VveuWfWtALLndCWgj3kUpxyro8PoxBxzCXox+mxGNLAmUoA0tfSWG9Ly+Ca5ANIfNpNRitPxVOHeybsaGRb1Q+cOsHrzyLlNLGLVDi16DE1QfjLOsOreuWjypMrjhOa6D0fVemT81FWnXqIDRALcQPjMysQW8m9JFQSbtth/Wf7GSqdg0fvzBNv8+vt7atG/1wZs7ujyBOG49mM2GhuDMTXA2FmsH27XQIDAQAB";
$email_DKIM_selector = "google";

//Upload
$TempDir = "tmp";

//Email Template
$trigger_file_directory_cd = array('ACCOUNTING' => 'balances',
                                   'CLIENTS' => 'clientes',
                                   'INVOICES' => 'facturacion',
                                   'PAYROLL' => 'laboral',
                                   'TAX_FORMS' => 'modelos',
                                   'TAX_NOTIFICATIONS' => 'notificaciones',
                                   'VIRTUAL OFFICE' => 'virtual office');

$email_from_template = array('se_hr_email' => 'HR',
                             'se_accounting_email' => 'Accountant',
                             'se_billing_email' => 'Invoices',
                             'se_virtual_office_email' => 'Virtual office',
                             'se_personal_tax_email' => 'Personal Taxes');

$email_to_cd_template = array('ACC' => 'receive_standard_accounting_emails_yn',
                              'PAY' => 'receive_standard_hr_emails_yn',
                              'BIL' => 'receive_standard_billing_emails_yn',
                              'ACR' => 'reminder_standard_accounting_emails_yn',
                              'TXR' => 'reminder_standard_personal_taxes_yn',
                              'ACM' => 'acct_manager_id',
                              'ACP' => 'accounting_provider_id',
                              'PYP' => 'payroll_provider_id');

$notify_change_account_manager = array('acct_manager_id', 'payroll_provider_id', 'accounting_provider_id');

//Virtual File
$VirtualFile = '../a7f5h3q9';
$Upload_accounting = '/upload';
$Directory_client_ftp_server = array("privado", "real estate", "immigration", "notificaciones", "virtual office");


//Directorio del FTP SERVER
define('TMP_INVOICE_RECEIVED_UPLOAD', '/facturacion/gastos');
define('TMP_INVOICE_ISSUED_UPLOAD', '/facturacion/ingresos');
define('TMP_SERVICE_AGREEMENT_UPLOAD', '/facturacion/service agreement');
define('TMP_PROPOSAL_UPLOAD', '/docs/proposals');
define('TMP_EMPLOYEE_UPLOAD', '/docs/employees');
define('TMP_ACCOUNTING_UPLOAD', '/docs/accounting');
define('TMP_CLIENT_FTP_SERVER', '/clientes');
define('TMP_INVOICE_STRONG', '/facturacion');

// KEYWORD EMAIL TEMPLATE
define('KEYWORD_EMAIL_TEMPLATE_UNPAID', 'UNPAID');

//EDIT FORMAT
define('SW_MASK_EMAIL', "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,10})+$/");
define('SW_MASK_NUMBER', "/^(\d{1,3})*\d{1,3}(\.\d+)?$/");


/*
		Strong Abogados companies by country

    572 => Strong Weber
    1303 => Corporate And People
    1221 => Spaincorp LLC (380 is Italy)

*/
$SW_COMPANY_STRONG = array('724' => 1983, '380' => 1221);


// STATUS CODE

//Service Agreement
define(SW_STATUS_SVC_NEW, 'NW');
define(SW_STATUS_SVC_SENT, 'SN');
define(SW_STATUS_SVC_ACCEPTED, 'AC');
define(SW_STATUS_SVC_REJECTED, 'RJ');
define(SW_STATUS_SVC_PAID, 'PD');
define(SW_STATUS_SVC_INVOICED, 'IV');

//Line Item
define(SW_STATUS_LI_SERVICE, 'SV');
define(SW_STATUS_LI_PROFORMA, 'PF');
define(SW_STATUS_LI_TO_INVOICE, 'TI');
define(SW_STATUS_LI_INVOICED, 'IV');

//Invoice Issued
define(SW_STATUS_IS_OPEN, 'OP');  // Open
define(SW_STATUS_IS_CLOSE, 'CL'); // Close
define(SW_STATUS_IS_UNPAID, 'UP'); // Unpaid
define(SW_STATUS_TOO_SMALL, 'TS'); // Too Small
define(SW_STATUS_ZERO_TOTAL, 'ZT'); // Zero Total


//Styles
$StyleTheme = 'lightgrey';
$Email_format = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,10})+$/";


$array_xls = array(0=>"",1=>"A",2=>"B",3=>"C",4=>"D",5=>"E",6=>"F",7=>"G",8=>"H",9=>"I",10=>"J",11=>"K",12=>"L",13=>"M",14=>"N",15=>"O",16=>"P",17=>"Q",18=>"R",19=>"S",20=>"T",21=>"U",22=>"V",23=>"W",24=>"X",25=>"Y",26=>"Z");

//Template import
$template_invoice_strong = array(
					0=>array("col_invoice_date"=>0, "col_invoice_number"=>0, "col_tax_ident"=>0, "col_client_name"=>0,
						  "col_subtotal_amount"=>0, "col_tax_rate"=>0, "col_tax_amount"=>0, "col_total_amount"=>0,
						  "col_base_withholding_amount"=>0, "col_withholding_rate"=>0, "beginning_row"=>0),
					1=>array("col_invoice_date"=>2, "col_invoice_number"=>3, "col_tax_ident"=>4, "col_client_name"=>5,
						"col_subtotal_amount"=>7, "col_tax_rate"=>8, "col_tax_amount"=>9, "col_total_amount"=>10,
					  	"col_base_withholding_amount"=>11, "col_withholding_rate"=>12, "beginning_row"=>11),
					2=>array("col_invoice_date"=>2, "col_invoice_number"=>3, "col_tax_ident"=>4, "col_client_name"=>5,
						"col_subtotal_amount"=>20, "col_tax_rate"=>21, "col_tax_amount"=>22, "col_total_amount"=>23,
						"col_base_withholding_amount"=>24, "col_withholding_rate"=>25, "beginning_row"=>3));

$aLegacyTaxType = array(0=>"",
                      7=>"autonomo",
                      9=>"branch",
                      2=>"contabilidad",
                      4=>"contab-canarias",
                      35=>"immigration",
                      6=>"impuestos solo",
                      26=>"indiv noresidente",
                      24=>"indiv residente",
                      98=>"no recoger cartas",
                      20=>"nominas solo",
                      15=>"nonresCCC",
                      21=>"nonresCCC-old",
                      11=>"nonresIntrastat",
                      13=>"nonresVAT",
                      22=>"nonresVAT-old",
                      19=>"nontrading",
                      17=>"nontrad-parte",
                      30=>"oficina virtual",
                      23=>"otros",
                      50=>"solo constitucion",
                      40=>"real estate");


?>