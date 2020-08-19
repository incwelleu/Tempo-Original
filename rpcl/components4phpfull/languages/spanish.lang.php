<?php
$XLMLanguage = "Spanish (Traditional Sort)";

$format_money_mysql = 'de_DE';

// Server FTP
$lblCreateDirectory = "Crear directorio";
$lblCurrentDirectory = "Directorio actual";
$lblDate = "Fecha";
$lblDeleteFile = "Borrar fichero";
$lblDeleteFileMsg = utf8_encode("¿Desea eliminar los archivos seleccionados?");
$lblName = "Nombre";
$lblSize = utf8_encode("Tamaño");
$lblFileType = "Tipo";
$lblUploadedBy = "Subido por";
$lblUp = "Directorio anterior";
$lblUploadFile = "Subir ficheros";
$lblDownload = "Descargar archivo";
$lblReplaceFileName = "Reemplazar nombre de archivo";
$lblCreateExercise = "Crear ejercicio";
$lblFileSuccessUpload = "Proceso de subida de archivos finalizado";
$lblSearchFile = "Buscar";
$lblStatus = "Estado";
$lblCleanClientShortName = "Limpiar shortname de cliente";

//Error de archivo del FTP
$lblFileCouldNotBeUploaded = "Los archivos no pueden ser actualizados";
$lblFileErrorMoveFileUploaded = "Error al copiar el archivo en el directorio";
$lblFileErrorDirExists = "El directorio ya existe";
$lblFileErrorCompany = "Error: El archivo no coincide con ningún nombre corto de empresa";
$lblFileErrorParentTree = "Error: el archivo no corresponde a este directorio";
$lblFileMsgNotIncludeDraft = utf8_encode("La empresa no tiene asignado contacto con correo electrónico");
$lblFileViewDraftEmailMsg = utf8_encode("Se han generado los borradores de correo electrónico. ¿Desea ver la lista?");
$lblFileViewDraftEmailBeforeMsg = utf8_encode("Tiene correo electrónico creados anteriormente. ¿Desea ver la lista?");
$lblFileErrorCompanyUserName = utf8_encode("El archivo que subiste ha creado un correo electrónico estándar.</br>Este correo electrónico es incorrecto y debe eliminarse porque no ha creado un 'User name' para este cliente en Empresas->Detalles");

$lblHelp = "Ayuda";
$lblNoHelp = "No hay ayuda";

$MonthLetter = array("1"=>"Enero",
                     "2"=>"Febrero",
                     "3"=>"Marzo",
                     "4"=>"Abril",
                     "5"=>"Mayo",
                     "6"=>"Junio",
                     "7"=>"Julio",
                     "8"=>"Agosto",
                     "9"=>"Septiembre",
                     "10"=>"Octubre",
                     "11"=>"Noviembre",
                     "12"=>"Diciembre");

//Status user
$GLOBAL_STATUS_CODE = Array('a'=>"Activo", 'i'=>"Inactivo");
$GLOBAL_USER_STATUS_CODE = Array('a' => "Activo",
																 'c' => "Sin acceso (dejado a otro proveedor: no satisfecho con el servicio)",
																 'k' => "Sin acceso (eliminado - facturas impagas)",
																 'i' => "Sin acceso (servicio interrumpido en buenos términos)",
																 'p' => "Sin acceso (dejado a otro proveedor: precio o ubicación)");

//Type contact
$GLOBAL_CONTACT_TYPE_COMPANY = Array(0=>'', 1=>'Administrador', 2=>'Socio', 3=>'Empleado');
$GLOBAL_CONTACT_TYPE_PERSONAL = Array(0=>'', 10=>'Titular', 11=>'Conyugue', 12=>'Hijo', 13=>'Hija', 14=>'Madre', 15=>'Padre', 16=>'Suegra', 17=>'Suegro');

//status company
$GLOBAL_STATUS_COMPANY = Array('a'=>"Active", 'c'=>"Otro proveedor", 'k'=>"Expulsado", 'i'=>"Inactivo");
$GLOBAL_DOCUMENT_TYPE = Array(0=>'', 1=>'NIF - Empresa', 2=>'NIF - Personal', 3=>'NIF - No residente', 4=>'Pasaporte', 5=>'Doc. Extranjero');
$GLOBAL_INVOICE_ADDRESS = Array(0=>'', 1=>'Domicilio social', 2=>utf8_encode('Dirección de envio'));

//Buttons
define(btnRefresh, "Actualizar");
define(btnFilter, "Filtrar");
define(btnCustomFilter, "Filtro Personalizado");
define(btnAdd, "Agregar");
define(btnDelete, "Eliminar");
define(btnEdit, "Editar");
define(btnCancel, "Cancelar");
define(btnSave, "Guardar");
define(btnDetail, "Detalle");
define(btnUnMark, "Desmarcar");
define(btnCreate, "Crear");
define(btnImportExcel, "Importar desde excel");
define(btnExportAccounting, "Exportar a contabilidad");
define(btnExportAccounting, "Exportar a contabilidad");
define(btnImportAccounting, utf8_encode("Importar códigos contables"));
define(btnRegistrationChange, "Cambio fecha registro");
define(btnProvider, "Proveedores");
define(btnClient, "Clientes");
define(btnBank, "Cuentas bancarias");
define(btnReturnPage, utf8_encode("Retornar página"));
define(btnClose, "Cerrar");
define(btnRecoverPassword, "Recuperar clave");
define(btnDateProcessed, "Fecha proceso");
define(btnUpdateClientInvoice, "Actualizar facturas de clientes");
define(btnMergeClient, "Fusionar cliente duplicados");
define(btnChangeTypeTax, "Cambio tipo impuesto");
define(btnUpdateProviderInvoice, "Actualizar facturas de proveedores");
define(btnMergeProvider, "Fusionar proveedor duplicados");
define(btnSendEmail, "Enviar correos seleccionados");
define(btnDownloadCompanyFile, "Descargar todos los archivos de la empresa");
define(btnUnMarkTaxModel, "Desmarcar Modelos");
define(btnTaxAccountDefault, "Cuentas IVA por defecto");
define(btnAddService, "Agregar servicios");
define(btnWorkCompleted, "Trabajo finalizado de los registros seleccionados");
define(btnInvoiceAddress, utf8_encode("Dirección facturación"));
define(btnInvoice, utf8_encode("Facturación"));
define(btnCreateMonthlyInvoice, "Crear facturas mensuales");
define(btnDiscountingSupplement, "Reducir el importe de los suplidos");
define(btnPaid, "Marcar como pago");
define(btnUnPaid, "Cancel: Incobrable");
define(btnExportXLS, "Exportar a Excel");
define(btnSendStandardEmail, utf8_encode("Enviar correo estándar"));
define(btnDownloadHiringForm, "Descargar formulario de alta");
define(btnDownLoadTerminationForm, "Descargar formulario de baja");
define(btnDown145Form, "Descargar modelo 145");
define(btnAmtSmall, utf8_encode("Cancelar: cantidad demasiado pequeña"));
define(btnZeroTotal, "Cancelar varios: total cero");
define(btnCreateCreditNote, "Crear factura de abono");
define(btnSendEmailUnpaid, "Send UNPAID email");
define(btnChangeAccountManager, "Cambiar administrador de cuenta");
define(btnChangeAccountant, "Carbiar contable");
define(btnChangePayroll, "Cambiar asesor laboral");

//Titles Pages
define(Title_Invoice_issued, "Facturas emitidas");
define(Title_Invoice_receive, "Facturas recibidas");
define(Title_Provider, "Proveedores");
define(Title_Client, "Clientes");
define(Title_Company, "Empresa");
define(Title_Bank_Account, "Cuentas bancarias");
define(Title_User, "Usuarios");
define(Title_Contact, "Contactos");
define(Title_Provider_Contact, "Contactos administradores");
define(Title_Help_content, "Contenido de ayuda");
define(Title_Standard_Email_Clients, utf8_encode("Emails estándar de clientes"));
define(Title_Standard_Email_Internal, utf8_encode("Emails estándar internos"));
define(Title_Upload_Accounting, "Sube archivos de contabilidad");
define(Title_Relation_Account_Manager, utf8_encode("Administradores de cuentas / Clientes"));
define(Title_EmailDraft, "Mis correos borradores");
define(Title_EmailSent, "Mis correos enviados");
define(Title_EmailAll, "Todos los correos");
define(Title_TaxModel, "Modelos fiscales");
define(Title_Parameters_Accounting, utf8_encode("Parámetros de contabilidad"));
define(Title_Service, "Servicios");
define(Title_Invoicing, utf8_encode("Facturación"));
define(Title_Payments, "Pagos");
define(Title_Setting, utf8_encode("Configuración"));
define(Title_Regular_service_client, "Clientes con servicios regulares");
define(Title_Service_tracker, "Segumiento de servicio");
define(Title_Upload_employee, "Subir formularios de alta y baja y modelo 145");

//Menssage General
$lbSelectValue = "Seleccionar valor";
$lbDeleteInformationMsg = utf8_encode("¿Desea eliminar la información seleccionada?");
$lbSpecifyValueMsg = utf8_encode("Es necesario que especifique un valor en el campo.");
$lbRecoverPasswordMsg = utf8_encode("¿Desea recuperar la contraseña al usuario seleccionado?");
$lbRecoveredDefaultPasswordMsg = utf8_encode("La contraseña por defecto se ha recuperado");
$lbEmailErrorMsg = "Formato del Email, no es correcto";
$lbNumberErrorMsg = "Formato del numero, no es correcto";
$lbUpdateClientInvoiceMsg = utf8_encode("¿Actualizar facturas de los clientes seleccionados?");
$lbMergeClientMsg = utf8_encode("¿Fusionar los clientes especificados?");
$lbUpdateProviderInvoiceMsg = utf8_encode("¿Actualizar facturas de los proveedores seleccionados?");
$lbMergeProviderMsg = utf8_encode("¿Fusionar los proveedores especificados?");
$lbRequiredFieldError = "Campos obligatorios";
$lbCreateClientMsg = utf8_encode("¿Desea crear el cliente?");

//Message Invoice
$lbInvoiceIsAlreadyCreate_error = utf8_encode("Número de factura ya existe");
$lbInvoiceDateInvalid = utf8_encode("La fecha de factura no es válida");
$lbSelectClient_error = "Usted debe seleccionar el cliente";
$lbSelectProvider_error = "Usted debe seleccionar el proveedor";
$lbUnmarkSelectedInvoiceMsg = utf8_encode("¿Marcar/Desmarcar facturas seleccionadas como contabilizadas?");
$lbUnpaidSelectInvoiceMsg = utf8_encode("¿Marcar/Desmarcar facturas seleccionadas como impagadas?");

//Message user
$lbChangeUserAdmin_error = "No puede modificar el usuario admin";
$lbUserLogin_error = utf8_encode("El nombre de usuario y la contraseña introducidos no coinciden con los de archivo.");
$lbUserInactive_error = utf8_encode("Su cuenta ya no está activa.");
$lbUserNameNotAvailable_error = utf8_encode("El nombre de usuario no está disponible.");
$lbUserNameNotEmpty_error = utf8_encode("El nombre de usuario no puede estar vacío.");
$lbUserRolesNotEmpty_error = "Debe asignar un role para al usuario.";

//Message Company
$lbCompanyCompanyName_error = utf8_encode("El nombre de la empresa no es válido.");
$lbCompanyDocumentType_error = utf8_encode("El tipo de documento no es válido.");
$lbCompanyTaxIdent_error = utf8_encode("El número de NIF no es válido.");
$lbCompanyTaxIdentExist = utf8_encode("El número de NIF ya existe.");
$lbCompanyShortNameNotAvailable_error = utf8_encode("El nombre corto de la empresa no es válido.");
$lbCompanyShortNameAlreadyExists_error = utf8_encode("Existe una empresa con ese nombre corto.");
$lbCompanyLegacy_datahouse_error = "Datahouse ID no esta disponible, pertenece ha {$short_name}";
$lbCompanyCountry_error = utf8_encode("El país especificado no valido.");
$lbCompanyPaymentMethod_error = utf8_encode("La forma de pago no es válida.");
$lbCompanyBillingEntity_error = utf8_encode("La entidad de facturación no es válida.");

$lbCompanyCompanyStreet_Type = utf8_encode("El tipo de calle no es válido.");
$lbCompanyCompanyMail_Street = utf8_encode("La dirección no es válida.");
$lbCompanyCompanyMail_City = utf8_encode("El municipio no es válido.");
$lbCompanyCompanyMail_Province = utf8_encode("La provincia no es válida.");
$lbCompanyCompanyMail_PostCode = utf8_encode("El código postal no es válida.");

$lbCompanyConstDate_error = utf8_encode("La fecha de constitución no es válida.");
$lbCompanyConstNotary_error = utf8_encode("El nombre del notario no es válido.");;
$lbCompanyConstTomo_error = utf8_encode("El Tomo no es válido.");
$lbCompanyConstFolio_error = utf8_encode("El Folio no es válido.");
$lbCompanyConstHoja_error = utf8_encode("La Hoja no es válida.");

//Message Upload file
$lbUploadFileExists_error = "El archivo ya existe, se ha subido una copia de ";
$MessageEmailUploadFile = "Se ha enviado un correo electrónico a ";

//Type regimen tax
$type_output_tax = array(0=>utf8_encode("Régimen general"), 1=>"Inv. Sujeto Pasivo", 2=>"Exento", 3=>"Sin Impuesto");
$type_input_tax = array(0=>utf8_encode("Régimen general"), 1=>"Inv. Sujeto Pasivo", 2=>"Exento", 3=>"Sin Impuesto");
$period_type = Array(0=>'', 1=>'Mensual', 3=>'Trimestral', 6=>'Semestral', 12=>'Anual');
$tax_model_state = array(0=>"Sin presentar", 1=>"Presentado");

//Template Import
$template_import_invoice = array(0=>"", 1=>utf8_encode("Nuestra plantilla"), 2=>"G-Accon para Xero");
$download_our_template = utf8_encode("Descargue nuestra plantilla");

//Email Template
$lbClientWithoutContactMarked = "Clientes sin contactos marcado con";
$trigger_type_cd = array('UPL'=>'FTP upload', 'FIE'=>'Cambio de campo', 'MAN'=>'Manual', 'NON'=>'None', 'SCH'=>'Programado');
$email_to_cd = array('ACC'=>'Recibe contabilidad', 'PAY'=>'Recibe laboral', 'BIL'=>utf8_encode('Recibe facturación'), 'ACR'=>'Recordatorio contabilidad', 'TXR'=>'Recordatorio Impuestos Personales');

//Email draft
$lbEmailMessageSend = utf8_encode("¿Está seguro que desea enviar todos los correos electrónicos que haz seleccionado?");
$lbChangeEmailTemplateMsg = utf8_encode("Si confirma el cambio se eliminará todo el contenido del correo.  ¿Desea cambiar la plantilla del correo electrónico?");

//Company
$SW_COMPANY_TAB = array(array('Detalle', 'TabDetails', 1),
                              array(utf8_encode("Dirección facturación"), 'TabInvoiceAddress', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
                                    array('Contactos', 'TabContacts', 1),
                                          array('Cuentas bancarias', 'TabBankAccounts', 1),
                                                array('Modelos de impuestos', 'TabTaxModels', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
                                                      array('Parametros contables', 'TabAccounting', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])));

//Service Agreement
$SW_STATUS_SERVICE_AGREEMENT_CD = array(SW_STATUS_SVC_NEW=>"Nuevo",
                                        SW_STATUS_SVC_SENT=>"Enviado",
                                        SW_STATUS_SVC_ACCEPTED=>"Aceptado",
                                        SW_STATUS_SVC_REJECTED=>"Cancelado",
                                        SW_STATUS_SVC_PAID=>"Pagado",
                                        SW_STATUS_SVC_INVOICED=>"Facturado");
$lbPaidServiceAgreementMsg = utf8_encode("¿Desea realizar el pagó en el service agreement?");
$lbPaidServiceAgreement_error = utf8_encode("El pagó esta contabilizado");
$lbShowInvoicedAndCanceled = "Mostrar facturados y cancelados";

//Line items
$SW_STATUS_LINE_ITEM_CD = array(SW_STATUS_LI_SERVICE=>"Servicios", SW_STATUS_LI_PROFORMA=>"Proforma", SW_STATUS_LI_TO_INVOICE=>"Para Facturar", SW_STATUS_LI_INVOICED=>"Facturado");
define('SW_MESSAGE_ERROR_WITHOUT_SERVICE', 'Debe seleccionar un servicio');

//Invoice Issued
$SW_STASTUS_INVOICE_ISSUED_CD = array(SW_STATUS_IS_OPEN=>"Abierta", SW_STATUS_IS_CLOSE=>'Cerrada', SW_STATUS_IS_UNPAID=>'Incobrable', SW_STATUS_TOO_SMALL=>'Too small', SW_STATUS_ZERO_TOTAL=>'Zero total');

//Invoicing
// array[0] => Caption
// array[1] => Tab name
// array[3] => Visible
$SW_INVOICES_TAB = array(array('Servicios regulares', 'TabService', 1),
                               array('Para facturar', 'TabToInvoice', 1),
                                     array('Facturado', 'TabInvoiced', 1),
                                           array('Comisiones', 'TabCommission', 1),
                                                 array('Comisiones anteriores', 'TabPastCommission', 0));

//Payments
// array[0] => Caption
// array[1] => Tab name
// array[3] => Visible
$SW_PAYMENTS_TAB = array(array('Facturas pendientes de pago', 'TabUnpaid', 1), array('Pagos', 'TabPayments', 1));

//Boolean
define(SW_CAPTION_YES, 'Si');
define(SW_CAPTION_NO, 'No');

//Caption Default
define(SW_CAPTION_COMPANY_NAME, 'Nombre empresa');
define(SW_CAPTION_SHORT_NAME, 'Empresa');
define(SW_CAPTION_SERVICE, 'Servicio');
define(SW_CAPTION_SERVICE_CATEGORY_NAME, 'Categoria');
define(SW_CAPTION_DESCRIPTION, utf8_encode('Descripción'));
define(SW_CAPTION_QUANTITY, 'Cantidad');
define(SW_CAPTION_PRICE, 'Precio');
define(SW_CAPTION_SUBTOTAL, 'Subtotal');
define(SW_CAPTION_TOTAL, 'Total');
define(SW_CAPTION_OTHER_INCOME, 'Otros ingresos');
define(SW_CAPTION_NOTES, 'Notas');
define(SW_CAPTION_SERVICE_TYPE, 'Tipo servicio');
define(SW_CAPTION_STATUS_CD, 'Estado');
define(SW_CAPTION_CREATED_BY, 'Creado por');
define(SW_CAPTION_CREATED_DT, utf8_encode('Fecha de creación'));
define(SW_CAPTION_ACCOUNT_CD, 'Cuenta contable');
define(SW_CAPTION_TAX_TYPE, utf8_encode('Tipo de operación'));
define(SW_CAPTION_TYPE_OUTPUT_TAX, 'Impuesto repercutido');
define(SW_CAPTION_TYPE_INPUT_TAX, 'Impuesto soportado');
define(SW_CAPTION_BASE_TAX, 'Base imponible');
define(SW_CAPTION_TAX_RATE, 'Tipo impuesto');
define(SW_CAPTION_TAX, 'Impuesto');
define(SW_CAPTION_BASE_WITHHOLDING, utf8_encode('Retención'));
define(SW_CAPTION_INVOICE_NUMBER, utf8_encode('Nº factura'));
define(SW_CAPTION_CREDIT_NOTE, utf8_encode('Nº abono'));
define(SW_CAPTION_INVOICE_DT, 'Fecha factura');
define(SW_CAPTION_FREQUENCY, 'Frecuencia');
define(SW_CAPTION_START_DT, 'Fecha Inicio');
define(SW_CAPTION_END_DT, 'Fecha final');
define(SW_CAPTION_CHARGE_TO, 'Cobrado por');
define(SW_CAPTION_SUPPLEMENT_YN, 'Con suplidos?');
define(SW_CAPTION_SUPPLEMENT, 'Suplidos');
define(SW_CAPTION_SORT_SERVICE_AGREEMENT_YN, 'Mostrar</br>Service agreement?');
define(SW_CAPTION_COMPLETED_YN, utf8_encode('Trabajo finalizado?'));
define(SW_CAPTION_COMPLETED_DT, utf8_encode('Fecha finalización'));
define(SW_CAPTION_COMMISSION, utf8_encode('Comisión</br>original'));
define(SW_CAPTION_FUTURE_COMMISSION, utf8_encode('Comisión'));
define(SW_CAPTION_FIRST_NAME, 'Nombre');
define(SW_CAPTION_LAST_NAME, 'Apellidos');
define(SW_CAPTION_EMAIL, 'Email');
define(SW_CAPTION_PAID_DT, 'Fecha pago');
define(SW_CAPTION_PAID_YN, 'Pagado?');
define(SW_CAPTION_PAID, 'Pagos');
define(SW_CAPTION_PAID_BY, 'Pago por');
define(SW_CAPTION_PAID_AMT, 'Importe del pago');
define(SW_CAPTION_PAYMENT_METHOD, 'Forma de pago');
define(SW_CAPTION_BANK_ACCOUNT, 'Cuenta bancaria');
define(SW_CAPTION_BILLING_ENTITY, utf8_encode('Empresa de</br>facturación'));
define(SW_CAPTION_ONLINE_ACCESS, 'Acceso en line');
define(SW_CAPTION_COPY_LINK, 'Copiar enlace');
define(SW_CAPTION_ACCOUNTED_YN, 'Contabilizado');
define(SW_CAPTION_PENDING_AMOUNT, 'Pendiente');
define(SW_CAPTION_CLIENT, 'Cliente');
define(SW_CAPTION_CLIENT_NAME, 'Nombre');
define(SW_CAPTION_DOCUMENT_TYPE, 'Tipo de documento');
define(SW_CAPTION_TAX_IDENT, 'NIF');
define(SW_CAPTION_STREET_TYPE, 'Tipo de calle');
define(SW_CAPTION_ADDRESS, utf8_encode('Dirección'));
define(SW_CAPTION_ADDRESS_NUMBER, utf8_encode('Número'));
define(SW_CAPTION_ADDRESS_FLOOR, 'Piso');
define(SW_CAPTION_ADDRESS_DOOR, 'Puerta');
define(SW_CAPTION_ADDRESS_CITY, 'Ciudad');
define(SW_CAPTION_ADDRESS_PROVINCE, 'Provincia');
define(SW_CAPTION_POST_CODE, utf8_encode('Código postal'));
define(SW_CAPTION_COUNTRY, utf8_encode('País'));
define(SW_CAPTION_DATE, 'Fecha');
define(SW_CAPTION_SORT_NO, 'Orden');
define(SW_CAPTION_PROVISION_FONDO_AMT, utf8_encode('Provisión de fondos'));
define(SW_CAPTION_PAY_AMT, 'Total a pagar');
define(SW_CAPTION_CONTACT_NAME, 'Nombre de contacto');
define(SW_CAPTION_ACCOUNT_MANAGER, 'Administrador de cuenta');
define(SW_CAPTION_ACCOUNTANT_MANAGER, 'Contable');
define(SW_CAPTION_PAYROLL_MANAGER, 'Asesor laboral');
define(SW_CAPTION_TYPE_OPERATION, utf8_encode('Tipo operación'));
define(SW_CAPTION_NUMMER_MONTH, 'Numero</br>de meses');
define(SW_CAPTION_TAX_MODEL, 'Modelo fiscal');
define(SW_INCLUDE_INACTIVE_USER, 'Incluir usuarios inactivos');
define(SW_SHOW_CANCELED_INVOICES, 'Mostrar facturas canceladas');
define(SW_CAPTION_MOBILE_PHONE, utf8_encode('Teléfono movíl'));
define(SW_CAPTION_FIXED_PHONE, utf8_encode('Teléfono fijo'));
define(SW_INCLUDE_SERVICES_ENDED, "Incluir servicios finalizados");
define(SW_CAPTION_TYPE_EXPENSE, 'Tipo de gasto');
define(SW_CAPTION_ACCOUNT_EXPENSE, 'Cuenta</br>gastos');
define(SW_CAPTION_ACCOUNT_OTHER_EXPENSE, 'Cuenta</br>otros gastos');
define(SW_CAPTION_ACCOUNT_WITHHOLDING, 'Cuenta</br>retensiones');
define(SW_CAPTION_CONSTITUTION_DT, utf8_encode('Fecha constitución'));
define(SW_SHOW_WORK_COMPLETED, 'Incluir trabajos terminados');
define(SW_CAPTION_REGADDRESS, 'Res: Address');
define(SW_CAPTION_REGCITY, 'Res: City');
define(SW_CAPTION_MAILCOUNTRY, utf8_encode('Mail: País'));
define(SW_CAPTION_REGISTERED_ADDRESS, utf8_encode("Dirección registrada"));
define(SW_CAPTION_MAILING_ADDRESS, utf8_encode('Dirección postal (Si es diferente de la dirección registrada)'));
define(SW_CAPTION_USER, 'Usuario');

// Error
define(SW_ERROR_RECEIVE_EMAIL_BILLING, utf8_encode('Al menos un contacto debe tener marcado <b>Recibir facturación por correo electrónico</b>.'));
define(SW_ERROR_FILE_EXCEL_FORMAT, "El archivo seleccionado debe estar en formato Excel");
define(SW_ERROR_FILE_IMPORT, utf8_encode("Error en la importación del archivo"));


?>