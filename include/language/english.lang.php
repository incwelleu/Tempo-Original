<?php
  $XLMLanguage = "(default)";

  $format_money_mysql = 'de_DE';

	//Server FTP
	$lblCreateDirectory	= "Create Directory";
	$lblCurrentDirectory="Current directory";
	$lblDate	= "Date";
	$lblDeleteFile	= "Delete file";
  $lblDeleteFileMsg = "Want to delete the selected files?";
	$lblName = "Name";
	$lblSize = "Size";
	$lblFileType = "Type";
  $lblUploadedBy = "Uploaded by";
	$lblUp = "Previous Directory";
	$lblUploadFile	= "Upload files";
	$lblDownload = "Download file";
  $lblReplaceFileName = "Replace file name";
  $lblCreateExercise = "New year";
  $lblFileSuccessUpload = "File upload process completed";
  $lblSearchFile = "Search";
	$lblCleanClientShortName = "Clean client shortname";

  //Error file of FTP
	$lblFileCouldNotBeUploaded = "File could not be uploaded";
  $lblFileErrorMoveFileUploaded = "Failed to copy the file to the directory";
  $lblFileErrorDirExists = "The directory already exists";
  $lblFileErrorCompany = "Error: this file does not match any company short name";
  $lblFileErrorParentTree = "Error: this file does not correspond to this directory";
  $lblFileMsgNotIncludeDraft = "No contact email assigned for this company";
  $lblFileViewDraftEmailMsg = "Your uploads have created emails. See list?";
  $lblFileViewDraftEmailBeforeMsg = "You have emails created from before. See list?";
  $lblFileErrorCompanyUserName = "Error: The file you uploaded has created a standard email.</br>This email is wrong and should be deleted because you have not created a 'User name' for this client in Company->Details";

  $lblHelp = "Help";
  $lblNoHelp = "No help";

  $MonthLetter = array( "1"=>"January",
                  "2"=>"February",
                  "3"=>"March",
                  "4"=>"April",
                  "5"=>"May",
                  "6"=>"June",
                  "7"=>"July",
                  "8"=>"August",
                  "9"=>"September",
                  "10"=>"October",
                  "11"=>"November",
                  "12"=>"December");

  //Status user
  $GLOBAL_STATUS_CODE = Array('a' => "Active", 'i' => "Inactive");
  $GLOBAL_USER_STATUS_CODE = Array('a' => "Active",
																	 'c' => "No access (Left to another provider: not happy with service)",
																	 'k' => "No access (Kicked out - unpaid invoices)",
																	 'i' => "No access (Stopped service on good terms)",
																	 'p' => "No access (Left to another provider: price or location)");

  //Type contact
  $GLOBAL_CONTACT_TYPE_COMPANY = Array(0 => '', 1 => 'Administrator', 2 => 'Partner', 3 => 'Employee');
  $GLOBAL_CONTACT_TYPE_PERSONAL = Array(0 => '', 10 => 'Titular', 11 => 'Spouse', 12 => 'Son', 13 => 'Daughter', 14 => 'Mother', 15 => 'Father', 16 => 'Mother in law', 17 => 'Father in law');

  //status company
  $GLOBAL_STATUS_COMPANY = Array('a' => "Active", 'c' => "Another provider", 'k' => "Kicked out", 'i' => "Inactive");
  $GLOBAL_DOCUMENT_TYPE = Array(0=> '', 1 => 'Company tax ID' , 2 => 'Personal tax ID', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT');
  $GLOBAL_INVOICE_ADDRESS = Array(0=> '', 1 => 'Registered address', 2 => 'Mailing address');

  //Buttons
  define(btnRefresh, "Refresh");
  define(btnFilter, "Filter");
  define(btnCustomFilter, "Custom filter");
  define(btnAdd, "Add");
  define(btnDelete, "Delete");
  define(btnEdit, "Edit");
  define(btnCancel, "Cancel");
  define(btnSave, "Save");
  define(btnDetail, "Detail");
  define(btnUnMark, "Unmark");
  define(btnCreate, "Create");
  define(btnImportExcel, "Import from Excel");
  define(btnExportAccounting, "Export for accounting");
  define(btnImportAccounting, "Import accounting code");
  define(btnRegistrationChange, "Change registration date");
  define(btnProvider, "Providers");
  define(btnClient, "Clients");
  define(btnBank, "Bank accounts");
  define(btnReturnPage, "Return page");
  define(btnClose, "Close");
  define(btnRecoverPassword, "Recover password");
  define(btnDateProcessed, "Processed date");
  define(btnUpdateClientInvoice, "Update client invoices");
  define(btnMergeClient, "Merge duplicate client");
  define(btnUpdateProviderInvoice, "Update provider invoices");
  define(btnMergeProvider, "Merge duplicate provider");
  define(btnChangeTypeTax, "Change Output tax");
  define(btnSendEmail, "Send checked emails");
  define(btnDownloadCompanyFile, "Download all files in the company");
  define(btnUnMarkTaxModel, "Unmark tax models");
  define(btnTaxAccountDefault, "Tax Accounts for default");
  define(btnAddService, "Add services");
  define(btnWorkCompleted, "Work completed for selected items");
  define(btnInvoiceAddress, "Invoice address");
  define(btnInvoice, "Invoice");
  define(btnCreateMonthlyInvoice, "Create monthly invoices");
  define(btnDiscountingSupplement, "Reduce by supplement amount");
  define(btnPaid, "Mark as paid");
  define(btnUnPaid, "Cancel: Incobrable");
  define(btnExportXLS, "Export to Excel");
  define(btnSendStandardEmail, "Send standard email");
  define(btnDownloadHiringForm, "Get hiring form");
  define(btnDownLoadTerminationForm, "Get termination form");
  define(btnDown145Form, "Get 145 form");
  define(btnAmtSmall, "Cancel: Amount too small");
	define(btnZeroTotal, "Cancel various: zero total");
	define(btnCreateCreditNote, "Create credit note");
	define(btnSendEmailUnpaid, "Send UNPAID email");
	define(btnSendEmailUnpaid2, "Send UNPAID2 email");
	define(btnChangeAccountManager, "Change account manager");
  define(btnChangeAccountant, "Change accountant");
  define(btnChangePayroll, "Change payroll");

  //Titles Pages
  define(Title_Invoice_issued, "Invoices issued");
  define(Title_Invoice_receive, "Invoices received");
  define(Title_Provider, "Providers");
  define(Title_Client, "Clients");
  define(Title_Company, "Company");
  define(Title_Bank_Account, "Bank accounts");
  define(Title_User, "Users");
  define(Title_Contact, "Contacts");
  define(Title_Provider_Contact, "Admin contacts");
  define(Title_Help_content, "Help content");
  define(Title_Standard_Email_Clients, "Standard emails to clients");
  define(Title_Standard_Email_Internal, "Standard emails internal");
  define(Title_Upload_Accounting, "Upload accounting");
  define(Title_Relation_Account_Manager, "Account managers / clients");
  define(Title_EmailDraft, "My email drafts");
  define(Title_EmailSent, "My sent emails");
  define(Title_EmailAll, "All emails");
  define(Title_TaxModel, "Tax models");
  define(Title_Parameters_Accounting, "Parameters accounting");
  define(Title_Service, "Services");
  define(Title_Invoicing, "Invoicing");
  define(Title_Payments, "Payments");
  define(Title_Setting, "Settings");
  define(Title_Regular_service_client, "Regular service clients");
  define(Title_Service_tracker, "Service tracker");
  define(Title_Upload_employee, "Upload hiring and termination forms");

  //Menssage General
  $lbSelectValue = "Select value";
  $lbDeleteInformationMsg = "Want to delete the selected information?";
  $lbSpecifyValueMsg = "You need to specify a value in the field.";
  $lbRecoverPasswordMsg = "You want to recover the password to the selected user?";
  $lbRecoveredDefaultPasswordMsg = "The default password has been recovered";
  $lbEmailErrorMsg = "Email format is not correct";
  $lbNumberErrorMsg = "Number format is not correct";
  $lbUpdateClientInvoiceMsg = "Update customer invoices selected?";
  $lbMergeClientMsg = "Merge the specified clients?";
  $lbUpdateProviderInvoiceMsg = "Update provider invoices selected?";
  $lbMergeProviderMsg = "Merge the specified providers?";
  $lbRequiredFieldError = "Required fields";
  $lbCreateClientMsg = "You want to create the client?";

  //Message Invoice
  $lbInvoiceIsAlreadyCreate_error = "Invoice number is already created";
  $lbInvoiceDateInvalid = "The invoice date is not valid.";
  $lbSelectClient_error = "You must select the client";
  $lbSelectProvider_error = "You must select the provider";
  $lbUnmarkSelectedInvoiceMsg = "Mark / Unmark the selected invoices recorded in accounting?";
  $lbUnpaidSelectInvoiceMsg = "Mark/Unmark selected as unpaid invoices?";

  //Message User
  $lbChangeUserAdmin_error = "You can not change the admin user.";
  $lbUserLogin_error = "The username and password entered do not match those on file.";
  $lbUserInactive_error = "Your account is no longer active.";
  $lbUserNameNotAvailable_error = "The username is not available.";
  $lbUserNameNotEmpty_error = "The user name can not be empty";
  $lbUserRolesNotEmpty_error = "Assign a role to the user.";

  //Message Company
  $lbCompanyCompanyName_error = "The company full name is not valid.";
  $lbCompanyDocumentType_error = "The document type is not valid.";
  $lbCompanyTaxIdent_error = "The tax ID is not valid.";
  $lbCompanyTaxIdentExist = "The tax ID already exists.";
  $lbCompanyShortNameNotAvailable_error = "The short name is not valid.";
  $lbCompanyShortNameAlreadyExists_error = "The short name already exists.";

  $lbCompanyLegacy_datahouse_error = "Datahouse ID is not available, belongs {$short_name}";
  $lbCompanyCountry_error = "The country not valid.";
  $lbCompanyPaymentMethod_error = "The payment method is not valid.";
  $lbCompanyBillingEntity_error = "The billing entity is not valid.";

  $lbCompanyCompanyStreet_Type = "The street type is not valid.";
  $lbCompanyCompanyMail_Street = "The street address is not valid.";
  $lbCompanyCompanyMail_City = "The city is not valid.";
  $lbCompanyCompanyMail_Province = "The province is not valid.";
  $lbCompanyCompanyMail_PostCode = "The post code is not valid.";

  $lbCompanyConstDate_error = "The constitution date is not valid.";
  $lbCompanyConstNotary_error = "The notary name is not valid.";
  $lbCompanyConstTomo_error = "The Tomo is not valid.";
  $lbCompanyConstFolio_error = "The Folio is not valid.";
  $lbCompanyConstHoja_error = "The Hoja is not valid.";


  //Message Upload file
  $lbUploadFileExists_error = "The file already exists, uploaded a copy of ";
  $MessageEmailUploadFile 	= "An email has been sent to ";

  //Type regimen tax
  $type_output_tax = array(0=>"General regimen",1=>"Taxable person",2=>"Not subject",3=>"Not Tax");
  $type_input_tax  = array(0=>"General regimen",1=>"Taxable person",2=>"Not subject",3=>"Not Tax");
  $period_type = Array(0=>'', 1=>'Monthly', 3=>'Quarterly', 6=>'Semiannual', 12=>'Annual');
  $tax_model_state = array(0=>"Without submitting", 1=>"Submitted");

  //Template Import
  $template_import_invoice = array(0=>"",1=>"Our template",2=>"G-Accon for Xero");
	$download_our_template = "Download our template";

  //Email Template
  $lbClientWithoutContactMarked = "Clients without contacts marked";
  $trigger_type_cd = array('UPL' => 'FTP upload', 'FIE' => 'Field change', 'MAN' => 'Manual', 'NON' => 'None', 'SCH' => 'Scheduled');
  $email_to_cd = array('ACC' => 'Receive accounting', 'PAY' => 'Receive payroll', 'BIL' => 'Receive billing', 'ACR' => "Reminders accounting", 'TXR' => "Reminders personal taxes");

  //Email draft
  $lbEmailMessageSend = "Are you sure you want to send all the emails that are checked?";
  $lbChangeEmailTemplateMsg = "If you confirm the change will remove all the contents of the mail. Do you want to change the email template?";

	//Company
  $SW_COMPANY_TAB = array(array('Details', 'TabDetails', 1),
													 array('Invoice address', 'TabInvoiceAddress', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
  												 array('Contacts', 'TabContacts', 1),
  												 array('Bank accounts', 'TabBankAccounts', 1),
                           array('Tax models', 'TabTaxModels', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
                           array('Parameters accounting', 'TabAccounting', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])));

  //Service Agreement
  $SW_STATUS_SERVICE_AGREEMENT_CD = array(SW_STATUS_SVC_NEW => "New",
  																		 SW_STATUS_SVC_SENT => "Sent",
                                       SW_STATUS_SVC_ACCEPTED => "Accepted",
                                       SW_STATUS_SVC_REJECTED => "Canceled",
                                       SW_STATUS_SVC_PAID => "Paid",
                                       SW_STATUS_SVC_INVOICED => "Invoiced");
  $lbPaidServiceAgreementMsg = "You want to pay the service agreement?";
  $lbPaidServiceAgreement_error = "The payment is accounted";
  $lbShowInvoicedAndCanceled = "Show Invoiced and Canceled";

  //Line items
  $SW_STATUS_LINE_ITEM_CD = array(SW_STATUS_LI_SERVICE=>"Services", SW_STATUS_LI_PROFORMA=>"Proforma", SW_STATUS_LI_TO_INVOICE=>"To Invoice", SW_STATUS_LI_INVOICED=>"Invoiced");
  define('SW_MESSAGE_ERROR_WITHOUT_SERVICE', 'You must select a service');

  //Invoice Issued
	$SW_STASTUS_INVOICE_ISSUED_CD = array (SW_STATUS_IS_OPEN => "Open", SW_STATUS_IS_CLOSE => 'Closed', SW_STATUS_IS_UNPAID => 'Incobrable', SW_STATUS_TOO_SMALL =>  'Too small', SW_STATUS_ZERO_TOTAL =>  'Zero total');

	//Invoicing
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_INVOICES_TAB = array(array('Regular service', 'TabService', 1),
  												 array('To invoice', 'TabToInvoice', 1),
  												 array('Invoiced', 'TabInvoiced', 1),
                           array('Commissions', 'TabCommission', 1),
                           array('Past commissions', 'TabPastCommission', 0));

	//Payments
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_PAYMENTS_TAB = array(array('Unpaid invoices', 'TabUnpaid', 1), array('Payments', 'TabPayments', 1));

  //Boolean
  define(SW_CAPTION_YES, 'Yes');
  define(SW_CAPTION_NO, 'No');

  //Caption Default
	define(SW_CAPTION_COMPANY_NAME, 'Company name');
	define(SW_CAPTION_SHORT_NAME, 'Company');
	define(SW_CAPTION_SERVICE, 'Service');
	define(SW_CAPTION_SERVICE_CATEGORY_NAME, 'Category');
	define(SW_CAPTION_DESCRIPTION, 'Description');
	define(SW_CAPTION_QUANTITY, 'Quantity');
	define(SW_CAPTION_PRICE, 'Price');
	define(SW_CAPTION_SUBTOTAL, 'Subtotal');
	define(SW_CAPTION_TOTAL, 'Total');
  define(SW_CAPTION_OTHER_INCOME, 'Other income');
	define(SW_CAPTION_NOTES, 'Notes');
	define(SW_CAPTION_SERVICE_TYPE, 'Service type');
	define(SW_CAPTION_STATUS_CD, 'Status');
  define(SW_CAPTION_CREATED_BY, 'Created by');
	define(SW_CAPTION_CREATED_DT, 'Created date');
  define(SW_CAPTION_ACCOUNT_CD, 'Account accounting');
  define(SW_CAPTION_TAX_TYPE, 'Type of operation');
  define(SW_CAPTION_TYPE_OUTPUT_TAX, 'Type output tax');
  define(SW_CAPTION_TYPE_INPUT_TAX, 'Type input tax');
  define(SW_CAPTION_BASE_TAX, 'Base amount');
  define(SW_CAPTION_TAX_RATE, 'Tax rate');
	define(SW_CAPTION_TAX, 'VAT');
	define(SW_CAPTION_BASE_WITHHOLDING, 'Withholding');
  define(SW_CAPTION_INVOICE_DT, 'Invoice date');
  define(SW_CAPTION_FREQUENCY, 'Frequency');
  define(SW_CAPTION_START_DT, 'Start date');
  define(SW_CAPTION_END_DT, 'End date');
  define(SW_CAPTION_CHARGE_TO, 'Charge to');
  define(SW_CAPTION_SUPPLEMENT_YN, 'With supplement?');
  define(SW_CAPTION_SUPPLEMENT, 'Supplement');
  define(SW_CAPTION_SORT_SERVICE_AGREEMENT_YN, 'Show</br>Service agreement?');
  define(SW_CAPTION_COMPLETED_YN, 'Work completed?');
  define(SW_CAPTION_COMPLETED_DT, 'Completed date');
  define(SW_CAPTION_COMMISSION, 'Original</br>commission');
  define(SW_CAPTION_FUTURE_COMMISSION, 'Commission');
	define(SW_CAPTION_FIRST_NAME, 'First name');
	define(SW_CAPTION_LAST_NAME, 'Last name');
	define(SW_CAPTION_EMAIL, 'Email');
  define(SW_CAPTION_PAID_DT, 'Paid date');
  define(SW_CAPTION_PAID_YN, 'Paid?');
	define(SW_CAPTION_PAID, 'Paid');
	define(SW_CAPTION_PAID_BY, 'Paid by / bank info');
	define(SW_CAPTION_PAID_AMT, 'Paid amount');
  define(SW_CAPTION_PAYMENT_METHOD, 'Payment method');
	define(SW_CAPTION_BANK_ACCOUNT, 'Bank account');
	define(SW_CAPTION_BILLING_ENTITY, 'Billing</br>entity');
	define(SW_CAPTION_ONLINE_ACCESS, 'Online access');
	define(SW_CAPTION_COPY_LINK, 'Copy link');
	define(SW_CAPTION_ACCOUNTED_YN, 'Accounted');
  define(SW_CAPTION_PENDING_AMOUNT, 'Pending');
  define(SW_CAPTION_CLIENT, 'Client');
  define(SW_CAPTION_CLIENT_NAME, 'Client name');
  define(SW_CAPTION_DOCUMENT_TYPE, 'Document type');
  define(SW_CAPTION_TAX_IDENT, 'Tax ID');
	define(SW_CAPTION_STREET_TYPE, 'Street type');
  define(SW_CAPTION_ADDRESS, 'Address');
  define(SW_CAPTION_ADDRESS_NUMBER, 'Number');
  define(SW_CAPTION_ADDRESS_FLOOR, 'Floor');
  define(SW_CAPTION_ADDRESS_DOOR, 'Door');
  define(SW_CAPTION_ADDRESS_CITY, 'City');
  define(SW_CAPTION_ADDRESS_PROVINCE, 'Province');
  define(SW_CAPTION_POST_CODE, 'Post code');
  define(SW_CAPTION_COUNTRY, 'Country');
  define(SW_CAPTION_INVOICE_NUMBER, utf8_encode('Invoice #'));
  define(SW_CAPTION_CREDIT_NOTE, 'Credit note');
  define(SW_CAPTION_DATE, 'Fecha');
  define(SW_CAPTION_SORT_NO, 'Sort');
  define(SW_CAPTION_PROVISION_FONDO_AMT, utf8_encode('Provisión de fondos'));
  define(SW_CAPTION_PAY_AMT, 'Total to pay');
  define(SW_CAPTION_CONTACT_NAME, 'Contact name');
  define(SW_CAPTION_ACCOUNT_MANAGER, 'Account manager');
  define(SW_CAPTION_ACCOUNTANT_MANAGER, 'Accountant manager');
  define(SW_CAPTION_PAYROLL_MANAGER, 'Payroll manager');
  define(SW_CAPTION_TYPE_OPERATION, 'Type operation');
  define(SW_CAPTION_NUMMER_MONTH, 'Number</br>of months');
  define(SW_CAPTION_TAX_MODEL, 'Tax model');
  define(SW_INCLUDE_INACTIVE_USER, 'Include inactive users');
  define(SW_SHOW_CANCELED_INVOICES, 'Show canceled invoices');
  define(SW_CAPTION_MOBILE_PHONE, 'Mobile phone');
  define(SW_CAPTION_FIXED_PHONE, 'Fixed phone');
  define(SW_INCLUDE_SERVICES_ENDED, "Include services ended");
  define(SW_CAPTION_TYPE_EXPENSE, 'Expense type');
  define(SW_CAPTION_ACCOUNT_EXPENSE, 'Account</br>expense');
  define(SW_CAPTION_ACCOUNT_OTHER_EXPENSE, 'Account</br>other expense');
  define(SW_CAPTION_ACCOUNT_WITHHOLDING, 'Account</br>Withholding');
  define(SW_CAPTION_CONSTITUTION_DT, 'Constitution date');
  define(SW_SHOW_WORK_COMPLETED, 'Include work completed');
  define(SW_CAPTION_REGADDRESS, 'Reg: Address');
  define(SW_CAPTION_REGCITY, 'Reg: City');
  define(SW_CAPTION_MAILCOUNTRY, 'Mail: Country');
  define(SW_CAPTION_REGISTERED_ADDRESS, utf8_encode("Registered address"));
  define(SW_CAPTION_MAILING_ADDRESS, 'Mailing address (if different from Registered address)');
  define(SW_CAPTION_USER, 'User');
  define(SW_CAPTION_LAST_INVOICE, 'Last invoice:');
  define(SW_CAPTION_STATUS, 'Status:');

	// Error
  define(SW_ERROR_RECEIVE_EMAIL_BILLING, "At least one contact must have <b>Receive email billing</b> checked.");
  define(SW_ERROR_FILE_EXCEL_FORMAT, "The selected file must be in excel format");
  define(SW_ERROR_FILE_IMPORT, "Error in file import");
  define(SW_ERROR_DELETE_COMPANY_INVOICE, "Company cannot be deleted because it has linked invoices (issued or received)");

?>
