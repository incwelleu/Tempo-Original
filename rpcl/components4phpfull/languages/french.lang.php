<?php
  $XLMLanguage = "French (France)";

  $format_money_mysql = 'de_DE';

	//Server FTP
	$lblCreateDirectory	= utf8_encode("Cr�er le r�pertoire");
	$lblCurrentDirectory=utf8_encode("R�pertoire actuel");
	$lblDate	= "Date";
	$lblDeleteFile	= "Supprimer le fichier";
	$lblDeleteFileMsg = "Want to delete the selected files?";
	$lblName = "Nom";
	$lblSize = "Taille";
	$lblFileType = "Type";
	$lblUploadedBy = utf8_encode("T�l�charg� par");
	$lblUp = utf8_encode("R�pertoire pr�c�dent");
	$lblUploadFile = utf8_encode("T�l�charger des fichiers");
	$lblDownload = utf8_encode("T�l�charger le fichier");
	$lblReplaceFileName = "Remplacer le nom du fichier";
	$lblCreateExercise = utf8_encode("Nouvelle ann�e");
	$lblFileSuccessUpload = utf8_encode("Processus de t�l�chargement de fichier termin�");
	$lblSearchFile = "Rechercher";
	$lblStatus = "Statut";
	$lblCleanClientShortName = "Nettoyer le nom court du client";


  //Error file of FTP
	$lblFileCouldNotBeUploaded = utf8_encode("Le fichier n'a pas pu �tre t�l�charg�");
	$lblFileErrorMoveFileUploaded = utf8_encode("Impossible de copier le fichier dans le r�pertoire");
	$lblFileErrorDirExists = utf8_encode("Le r�pertoire existe d�j�");
	$lblFileErrorCompany = utf8_encode("Erreur: ce fichier ne correspond � aucun nom abr�g� d'entreprise");
	$lblFileErrorParentTree = utf8_encode("Erreur: ce fichier ne correspond pas � ce r�pertoire");
	$lblFileMsgNotIncludeDraft = utf8_encode("Aucune adresse e-mail de contact assign�e � cette soci�t�");
	$lblFileViewDraftEmailMsg = utf8_encode("Vos t�l�chargements ont cr�� des emails. Voir la liste?");
	$lblFileViewDraftEmailBeforeMsg = utf8_encode("Vous avez des courriels cr��s � partir d'avant. Voir la liste?");
  $lblFileErrorCompanyUserName = utf8_encode("Le fichier que vous avez t�l�charg� a cr�� un courrier �lectronique standard.</br>Cet email est erron� et doit �tre supprim� car vous n'avez pas cr�� de Nom d'utilisateur pour ce client dans Soci�t�->D�tails");

	$lblHelp = "Aide";
	$lblNoHelp = "Aucune aide";

	$MonthLetter = array("1" => "Janvier",
					"2" => utf8_encode("F�vrier"),
					"3" => "Mars",
					"4" => "Avril",
					"5" => "Mai",
					"6" => "Juin",
					"7" => "Juillet",
					"8" => utf8_encode("Ao�t"),
					"9" => "Septembre",
					"10" => "Octobre",
					"11" => "Novembre",
					"12" => utf8_encode("D�cembre"));

  //Status user
  $GLOBAL_STATUS_CODE = Array ('a' => "Actif", 'i' => "Inactif");
  $GLOBAL_USER_STATUS_CODE = Array('a' => "Activer",
																	 'c' => utf8_encode("Pas d'acc�s (laiss� � un autre fournisseur: pas satisfait du service)"),
																	 'k' => utf8_encode("Pas d'acc�s (Kicked out - factures impay�es)"),
																	 'i' => utf8_encode("Pas d'acc�s (Service interrompu en bonnes conditions)"),
																	 'p' => utf8_encode("Pas d'acc�s (laiss� � un autre fournisseur: prix ou emplacement)"));

  //Type contact
  $GLOBAL_CONTACT_TYPE_COMPANY = Array(0 => '', 1 => 'Administrateur ', 2 =>' Partenaire ', 3 =>utf8_encode(' Employ� '));
  $GLOBAL_CONTACT_TYPE_PERSONAL = Array(0 => '', 0 => 'Titulaire', 11 => 'Conjoint', 12 => 'Fils', 13 => 'Fille', 14 => utf8_encode('M�re') , 17 => utf8_encode('beau-p�re'));

  //status company
  $GLOBAL_STATUS_COMPANY = Array('a' => "Active", 'c' => "Un autre fournisseur", 'k' => utf8_encode("Explus�"), 'i' => "Inactif");
  $GLOBAL_DOCUMENT_TYPE = Array(0=> '', 1 => 'Company tax ID' , 2 => 'ID de taxe personnelle', 3 => utf8_encode('TVA non r�sidente'), 4 => 'Passeport', 5 => utf8_encode('TVA �trang�re'));
  $GLOBAL_INVOICE_ADDRESS = Array(0=> '', 1 => utf8_encode('adresse enregistr�e'), 2 => 'adresse mail');

  //Buttons
	define (btnRefresh, "Actualiser");
	define (btnFilter, "Filtre");
	define (btnCustomFilter, utf8_encode("Filtre personnalis�"));
	define (btnAdd, "Ajouter");
	define (btnDelete, "Effacer");
	define (btnEdit, "Modifier");
	define (btnCancel, "Annuler");
	define (btnSave, "Sauver");
	define (btnDetail, utf8_encode("D�tail"));
	define (btnUnMark, utf8_encode("Non marqu�"));
	define (btnCreate, utf8_encode("Cr�er"));
	define (btnImportExcel, utf8_encode("Importer � partir d'Excel"));
	define (btnExportAccounting, utf8_encode("Exporter pour la comptabilit�"));
	define (btnImportAccounting, utf8_encode("Importer le code de comptabilit�"));
	define (btnRegistrationChange, utf8_encode("Modifier la date d'enregistrement"));
	define (btnProvider, "Fournisseurs");
	define (btnClient, "Clients");
	define (btnBank, "Comptes bancaires");
	define (btnReturnPage, "Page de retour");
	define (btnClose, "Fermer");
	define (btnRecoverPassword, utf8_encode("R�cup�rer le mot de passe"));
	define (btnDateProcessed, "Date de traitement");
	define (btnUpdateClientInvoice, utf8_encode("Mettre � jour les factures client"));
	define (btnMergeClient, utf8_encode("Fusionner le client dupliqu�"));
	define (btnUpdateProviderInvoice, utf8_encode("Mettre � jour les factures du fournisseur"));
	define (btnMergeProvider, "Fusionner le fournisseur en double");
	define (btnChangeTypeTax, "Modifier la taxe de sortie");
	define (btnSendEmail, utf8_encode("Envoyer les emails coch�s"));
	define (btnDownloadCompanyFile, utf8_encode("T�l�charger tous les fichiers de la soci�t�"));
	define (btnUnMarkTaxModel, utf8_encode("D�s�lectionner les mod�les d'imposition"));
	define (btnTaxAccountDefault, utf8_encode("Comptes de taxes par d�faut"));
	define (btnAddService, "Ajouter des services");
	define (btnWorkCompleted, utf8_encode("Travail termin� pour les �l�ments s�lectionn�s"));
	define (btnInvoiceAddress, "Adresse de facturation");
	define (btnInvoice, "Facture");
	define (btnCreateMonthlyInvoice, utf8_encode("Cr�er des factures mensuelles"));
	define (btnDiscountingSupplement, utf8_encode("R�duire par le montant du suppl�ment"));
	define (btnPaid, utf8_encode("Marquer comme pay�"));
	define (btnUnPaid, "Anuler: Incobrable");
	define (btnExportXLS, "Exporter vers Excel");
	define (btnSendStandardEmail, "Envoyer un email standard");;
	define(btnDownloadHiringForm, utf8_encode("Obtenir un formulaire d'embauche"));
	define(btnDownLoadTerminationForm, utf8_encode("Obtenir le formulaire de r�siliation"));
	define(btnDown145Form, "Obtenir le formulaire 145");
  define(btnAmtSmall, "Annuler: montant trop petit");
	define(btnZeroTotal, utf8_encode("Annuler divers: total z�ro"));
	define(btnCreateCreditNote, "Cr�er une facture de cr�dit");
	define(btnSendEmailUnpaid, "Send UNPAID email");
	define(btnChangeAccountManager, "hanger de compte");
  define(btnChangeAccountant, utf8_encode("Changer de comptabilit�"));
  define(btnChangePayroll, "Changement conseiller de travail");

  //Titles Pages
	define (Title_Invoice_issued, utf8_encode("Factures �mises"));
	define (Title_Invoice_receive, "Factures re�ues");
	define (Title_Provider, "Fournisseurs");
	define (Title_Client, "Clients");
	define (Title_Company, utf8_encode("Soci�t�"));
	define (Title_Bank_Account, "Comptes bancaires");
	define (Title_User, "Utilisateurs");
	define (Title_Contact, "Contacts");
	define (Title_Provider_Contact, utf8_encode("Contacts d'administration"));
	define (Title_Help_content, utf8_encode("Contenu de l'aide"));
	define (Title_Standard_Email_Clients, "E-mails standards aux clients");
	define (Title_Standard_Email_Internal, "E-mails standards internes");
	define (Title_Upload_Accounting, utf8_encode("Charger la comptabilit�"));
	define (Title_Relation_Account_Manager, "Gestionnaires de comptes/ clients");
	define (Title_EmailDraft, "Mes e-mails");
	define (Title_EmailSent, utf8_encode("Mes e-mails envoy�s"));
	define (Title_EmailAll, "Tous les e-mails");
	define (Title_TaxModel, utf8_encode("Mod�les de taxes"));
	define (Title_Parameters_Accounting, utf8_encode("Comptabilit� des param�tres"));
	define (Title_Service, "Services");
	define (Title_Invoicing, "Facturation");
	define (Title_Payments, "Paiements");
	define (Title_Setting, utf8_encode("Param�tres"));
	define (Title_Regular_service_client, utf8_encode("Clients du service r�gulier"));
	define (Title_Service_tracker, "Suivi de service");

  //Menssage General
	$lbSelectValue = utf8_encode("S�lectionner la valeur");
	$lbDeleteInformationMsg = utf8_encode("Voulez-vous supprimer l'information s�lectionn�e?");
	$lbSpecifyValueMsg = utf8_encode("Vous devez sp�cifier une valeur dans le champ.");
	$lbRecoverPasswordMsg = utf8_encode("Vous voulez r�cup�rer le mot de passe pour l'utilisateur s�lectionn�?");
	$lbRecoveredDefaultPasswordMsg = utf8_encode("Le mot de passe par d�faut a �t� r�cup�r�");
	$lbEmailErrorMsg = utf8_encode("Le format de l'email n'est pas correct");
	$lbNumberErrorMsg = utf8_encode("Le format num�rique n'est pas correct");
	$lbUpdateClientInvoiceMsg = utf8_encode("Mettre � jour les factures clients s�lectionn�es?");
	$lbMergeClientMsg = utf8_encode("Fusionner les clients sp�cifi�s?");
	$lbUpdateProviderInvoiceMsg = utf8_encode("Mettre � jour les factures du fournisseur s�lectionn�?");
	$lbMergeProviderMsg = utf8_encode("Fusionner les fournisseurs sp�cifi�s?");
	$lbRequiredFieldError = "Champs obligatoires";
	$lbCreateClientMsg = utf8_encode("Vous voulez cr�er le client?");

  //Message Invoice
  $lbInvoiceIsAlreadyCreate_error = utf8_encode("Le num�ro de facture est d�j� cr��");
	$lbInvoiceDateInvalid = utf8_encode("La date de facturation n'est pas valide.");
	$lbSelectClient_error = utf8_encode("Vous devez s�lectionner le client");
	$lbSelectProvider_error = utf8_encode("Vous devez s�lectionner le fournisseur");
	$lbUnmarkSelectedInvoiceMsg = utf8_encode("Marquer / D�cocher les factures s�lectionn�es enregistr�es en comptabilit�?");
	$lbUnpaidSelectInvoiceMsg = utf8_encode("Marquer / D�cocher s�lectionn� comme facture impay�e?");

  //Message User
  $lbChangeUserAdmin_error = utf8_encode("Vous ne pouvez pas changer l'utilisateur administrateur.");
	$lbUserLogin_error = utf8_encode("Le nom d'utilisateur et le mot de passe saisis ne correspondent pas � ceux du fichier.");
	$lbUserInactive_error = utf8_encode("Votre compte n'est plus actif.");
	$lbUserNameNotAvailable_error = utf8_encode("Le nom d'utilisateur n'est pas disponible.");
	$lbUserNameNotEmpty_error = utf8_encode("Le nom d'utilisateur ne peut pas �tre vide");
	$lbUserRolesNotEmpty_error = utf8_encode("Attribuer un r�le � l'utilisateur.");

  //Message Company
  $lbCompanyCompanyName_error = utf8_encode("Le nom complet de l'entreprise n'est pas valide.");
	$lbCompanyDocumentType_error = utf8_encode("Le type de document n'est pas valide.");
	$lbCompanyTaxIdent_error = utf8_encode("L'identifiant de taxe n'est pas valide.");
	$lbCompanyTaxIdentExist = utf8_encode("L'identifiant de taxe existe d�j�.");
	$lbCompanyShortNameNotAvailable_error = utf8_encode("Le nom court n'est pas valide.");
	$lbCompanyShortNameAlreadyExists_error = utf8_encode("Le nom court existe d�j�.");

 	$lbCompanyLegacy_datahouse_error = utf8_encode("L'ID du datacenter n'est pas disponible, appartient {$short_name}");
	$lbCompanyCountry_error = utf8_encode("Le pays n'est pas valide.");
	$lbCompanyPaymentMethod_error = utf8_encode("Le mode de paiement n'est pas valide.");
	$lbCompanyBillingEntity_error = utf8_encode("L'entit� de facturation n'est pas valide.");


  $lbCompanyCompanyStreet_Type = utf8_encode("Le type de rue n'est pas valide.");
	$lbCompanyCompanyMail_Street = utf8_encode("L'adresse de la rue n'est pas valide.");
	$lbCompanyCompanyMail_City = utf8_encode("La ville n'est pas valide.");
	$lbCompanyCompanyMail_Province = utf8_encode("La province n'est pas valide.");
	$lbCompanyCompanyMail_PostCode = utf8_encode("Le code postal n'est pas valide.");

  $lbCompanyConstDate_error = utf8_encode("La date de constitution n'est pas valide.");
	$lbCompanyConstNotary_error = utf8_encode("Le nom du notaire n'est pas valide.");
	$lbCompanyConstTomo_error = utf8_encode("Le Tomo n'est pas valide.");
	$lbCompanyConstFolio_error = utf8_encode("Le folio n'est pas valide.");
	$lbCompanyConstHoja_error = utf8_encode("Le Hoja n'est pas valide.");


  //Message Upload file
  $lbUploadFileExists_error = utf8_encode("Le fichier existe d�j�, t�l�charg� une copie de");

  //Type regimen tax
	$type_output_tax = array (0 => utf8_encode("R�gimes g�n�raux"), 1 => "Personne imposable", 2 => "Non soumis", 3 => "Pas de taxe");
	$type_input_tax = array (0 => utf8_encode("R�gime g�n�ral"), 1 => "Personne imposable", 2 => "Non sujet", 3 => "Non imposable");
	$period_type = Array (0 => '', 1 => 'Mensuel', 3 => 'Trimestriel', 6 => 'Semestriel', 12 => 'Annuel');
	$tax_model_state = array (0 => "Sans soumettre", 1 => "Soumis");

  //Template Import
	$template_import_invoice = array(0=>"",1=>utf8_encode("Notre template"), 2=>"G-Accon pour Xero");
	$download_our_template = utf8_encode("T�l�chargez notre template");


  //Email Template
	$lbClientWithoutContactMarked = utf8_encode("Clients sans contacts marqu�s");
	$Trigger_type_cd = array ( 'UPL' => utf8_encode('T�l�charger FTP'), 'FIE' => 'Changement champ', 'MAN' => 'Manuel', 'NON' => 'None', 'SCH' => 'Scheduled');
	$email_to_cd = array ( 'ACC' => utf8_encode('Recevoir la comptabilit�'), 'PAY' => 'Recevoir la paie', 'BIL' => 'Recevoir la facturation', 'ACR' => utf8_encode("Rappel comptabilit�"), 'TXR' => utf8_encode("Rappel des imp�ts personnels"));

  //Email draft
  $lbEmailMessageSend = utf8_encode("Etes-vous s�r de vouloir envoyer tous les emails qui ont �t� v�rifi�s?");
	$lbChangeEmailTemplateMsg = utf8_encode("Si vous confirmez que la modification supprimera tout le contenu du mail. Voulez-vous changer le mod�le d'email?");

	//Company
	$SW_COMPANY_TAB = array(array(utf8_encode('D�tails'), 'TabDetails', 1),
							array('Adresse de facturation', 'TabInvoiceAddress', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
							array('Contacts', 'TabContacts', 1),
							array('Comptes bancaires', 'TabBankAccounts', 1),
							array('Tax models', 'TabTaxModels', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
							array(utf8_encode('Param�tres comptabilit�'), 'TabAccounting', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])));

  //Service Agreement
  $SW_STATUS_SERVICE_AGREEMENT_CD = array(SW_STATUS_SVC_NEW => "New",
										SW_STATUS_SVC_SENT => utf8_encode("Envoy�"),
										SW_STATUS_SVC_ACCEPTED => utf8_encode("Accept�"),
										SW_STATUS_SVC_REJECTED => utf8_encode("Annul�"),
										SW_STATUS_SVC_PAID => utf8_encode("Pay�"),
										SW_STATUS_SVC_INVOICED => utf8_encode("Factur�"));
	$lbPaidServiceAgreementMsg = "Vous voulez payer le contrat de service?";
	$lbPaidServiceAgreement_error = utf8_encode("Le paiement est comptabilis�");
	$lbShowInvoicedAndCanceled = utf8_encode("Montrer factur� et annul�");

  //Line items
  $SW_STATUS_LINE_ITEM_CD = array(SW_STATUS_LI_SERVICE => "Services", SW_STATUS_LI_PROFORMA => "Proforma", SW_STATUS_LI_TO_INVOICE => "Pour facturer", SW_STATUS_LI_INVOICED => utf8_encode("Factur�"));;
  define('SW_MESSAGE_ERROR_WITHOUT_SERVICE', utf8_encode('Vous devez s�lectionner un service'));

  //Invoice Issued
  $SW_STASTUS_INVOICE_ISSUED_CD = array (SW_STATUS_IS_OPEN => "Open", SW_STATUS_IS_CLOSE => utf8_encode('Ferm�'), SW_STATUS_IS_UNPAID => 'Incobrable', SW_STATUS_TOO_SMALL => 'Trop petit', SW_STATUS_ZERO_TOTAL => utf8_encode('Total z�ro'));

	//Invoicing
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_INVOICES_TAB = array(array(utf8_encode('Service r�gulier'), 'TabService', 1),
  							array(utf8_encode('� Facturer'), 'TabToInvoice', 1),
  							array(utf8_encode('Factur�'), 'TabInvoiced', 1),
                           array('Commissions', 'TabCommission', 1),
                           array(utf8_encode('Commissions ant�rieures'), 'TabPastCommission', 0));

	//Payments
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_PAYMENTS_TAB = array(array(utf8_encode('Factures impay�es'), 'TabUnpaid', 1), array('Paiements', 'TabPayments', 1));

  //Boolean
  define(SW_CAPTION_YES, 'Oui');
  define(SW_CAPTION_NO, 'Non');

  //Caption Default
	define (SW_CAPTION_COMPANY_NAME, utf8_encode("Nom de l'entreprise"));
	define(SW_CAPTION_SHORT_NAME, 'Entreprise');
	define(SW_CAPTION_SERVICE, 'Service');
	define(SW_CAPTION_SERVICE_CATEGORY_NAME, utf8_encode('Cat�gorie'));
	define(SW_CAPTION_DESCRIPTION, 'Description');
	define(SW_CAPTION_QUANTITY, utf8_encode('Quantit�'));
	define(SW_CAPTION_PRICE, 'Prix');
	define(SW_CAPTION_SUBTOTAL, 'Sous-total');
	define(SW_CAPTION_TOTAL, 'Total');
	define(SW_CAPTION_OTHER_INCOME, 'Autres revenus');
	define(SW_CAPTION_NOTES, 'Notes');
	define(SW_CAPTION_SERVICE_TYPE, 'Type de service');
	define(SW_CAPTION_STATUS_CD, 'Statut');
	define(SW_CAPTION_CREATED_BY, utf8_encode('Cr�� par'));
	define(SW_CAPTION_CREATED_DT, utf8_encode('Date de cr�ation'));
	define(SW_CAPTION_ACCOUNT_CD, 'Comptabilisation du compte');
	define(SW_CAPTION_TAX_TYPE, utf8_encode("Type d'op�ration"));
	define(SW_CAPTION_TYPE_OUTPUT_TAX, 'Type de taxe de sortie');
	define(SW_CAPTION_TYPE_INPUT_TAX, utf8_encode("Type de taxe d'entr�e"));
	define(SW_CAPTION_BASE_TAX, 'Montant de base');
	define(SW_CAPTION_TAX_RATE, utf8_encode("Taux d'imposition"));
	define(SW_CAPTION_TAX, 'TVA');
	define(SW_CAPTION_BASE_WITHHOLDING, 'Retenue');
	define(SW_CAPTION_INVOICE_DT, 'Date de facturation');
	define(SW_CAPTION_FREQUENCY, utf8_encode('Fr�quence'));
	define(SW_CAPTION_START_DT, utf8_encode('Date de d�but'));
	define(SW_CAPTION_END_DT, 'Date de fin');
	define(SW_CAPTION_CHARGE_TO, utf8_encode('Imputer �'));
	define(SW_CAPTION_SUPPLEMENT_YN, utf8_encode('Avec suppl�ment?'));
	define(SW_CAPTION_SUPPLEMENT, utf8_encode("Suppl'ment"));
	define(SW_CAPTION_SORT_SERVICE_AGREEMENT_YN, 'Montrer </ br> contrat de service?');
	define(SW_CAPTION_COMPLETED_YN, utf8_encode('Travail termin�?'));
	define(SW_CAPTION_COMPLETED_DT, 'Date de fin');
	define(SW_CAPTION_COMMISSION, 'Original </ br> commission');
	define(SW_CAPTION_FUTURE_COMMISSION, 'Commission');
	define(SW_CAPTION_FIRST_NAME, utf8_encode('Pr�nom'));
	define(SW_CAPTION_LAST_NAME, 'Nom de famille');
	define(SW_CAPTION_EMAIL, 'E-mail');
	define(SW_CAPTION_PAID_DT, 'Date de paiement');
	define(SW_CAPTION_PAID_YN, utf8_encode('Pay�?'));
	define(SW_CAPTION_PAID, utf8_encode('Pay�'));
	define(SW_CAPTION_PAID_BY, utf8_encode('Pay� par / informations bancaires'));
	define(SW_CAPTION_PAID_AMT, utf8_encode('Montant pay�'));
	define(SW_CAPTION_PAYMENT_METHOD, utf8_encode('M�thode de paiement'));
	define(SW_CAPTION_BANK_ACCOUNT, 'Compte bancaire');
	define(SW_CAPTION_BILLING_ENTITY, utf8_encode('Entit� de</br>facturation'));
	define(SW_CAPTION_ONLINE_ACCESS, utf8_encode('Acc�s en ligne'));
	define(SW_CAPTION_COPY_LINK, 'Copier le lien');
	define(SW_CAPTION_ACCOUNTED_YN, utf8_encode('Comptablis�'));
	define(SW_CAPTION_PENDING_AMOUNT, 'En attente');
	define(SW_CAPTION_CLIENT, 'Client');
	define(SW_CAPTION_CLIENT_NAME, 'Nom du client');
  define(SW_CAPTION_DOCUMENT_TYPE, 'Type de document');
	define(SW_CAPTION_TAX_IDENT, 'ID TVA');
	define(SW_CAPTION_STREET_TYPE, 'Type de rue');
	define(SW_CAPTION_ADDRESS, 'Adresse');
	define(SW_CAPTION_ADDRESS_NUMBER, 'Numbre');
	define(SW_CAPTION_ADDRESS_FLOOR, 'Etage');
	define(SW_CAPTION_ADDRESS_DOOR, 'Porte');
	define(SW_CAPTION_ADDRESS_CITY, 'Ville');
	define(SW_CAPTION_ADDRESS_PROVINCE, 'Province');
	define(SW_CAPTION_POST_CODE, 'Code postal');
	define(SW_CAPTION_COUNTRY, 'Pays');
	define(SW_CAPTION_INVOICE_NUMBER, utf8_encode('Num�ro de facture'));
	define(SW_CAPTION_DATE, 'Date');
	define(SW_CAPTION_SORT_NO, 'Trier');
	define(SW_CAPTION_PROVISION_FONDO_AMT, utf8_encode('Financement'));
	define(SW_CAPTION_PAY_AMT, utf8_encode('Total � payer'));
	define(SW_CAPTION_CONTACT_NAME, 'Nom du contact');
	define(SW_CAPTION_ACCOUNT_MANAGER, 'Gestionnaire de compte');
	define(SW_CAPTION_ACCOUNTANT_MANAGER, 'Gestionnaire comptable');
	define(SW_CAPTION_PAYROLL_MANAGER, 'Gestionnaire de paie');
	define(SW_CAPTION_TYPE_OPERATION, utf8_encode('Op�ration de type'));
	define(SW_CAPTION_NUMMER_MONTH, 'Nombre </ br> de mois');
	define(SW_CAPTION_TAX_MODEL, utf8_encode('Mod�le de taxe'));
	define(SW_INCLUDE_INACTIVE_USER, 'Inclure les utilisateurs inactifs');
	define(SW_SHOW_CANCELED_INVOICES, utf8_encode('Afficher les factures annul�es'));
	define(SW_CAPTION_MOBILE_PHONE, utf8_encode('T�l�phone mobile'));
	define(SW_CAPTION_FIXED_PHONE, utf8_encode('T�l�phone fixe'));
	define(SW_INCLUDE_SERVICES_ENDED, utf8_encode("Inclure les services termin�s"));
	define(SW_CAPTION_TYPE_EXPENSE, utf8_encode('Type de d�penses'));
	define(SW_CAPTION_ACCOUNT_EXPENSE, 'Compte </ br> frais');
	define(SW_CAPTION_ACCOUNT_OTHER_EXPENSE, utf8_encode('Compte </ br> autre d�pense'));
	define(SW_CAPTION_ACCOUNT_WITHHOLDING, 'Compte </ br> Retenue');
	define(SW_CAPTION_CONSTITUTION_DT, 'Date de constitution');
	define(SW_SHOW_WORK_COMPLETED, utf8_encode('Inclure le travail termin�'));
  define(SW_CAPTION_REGADDRESS, 'Reg: Adresse');
  define(SW_CAPTION_REGCITY, 'Reg: Ville');
  define(SW_CAPTION_MAILCOUNTRY, 'Mail: Pays');
  define(SW_CAPTION_REGISTERED_ADDRESS, utf8_encode("Adresse enregistr�e"));
  define(SW_CAPTION_MAILING_ADDRESS, utf8_encode("Adresse postale (si diff�rente de l'adresse enregistr�e)"));
  define(SW_CAPTION_USER, utf8_encode("l'usager"));

	// Error
  define(SW_ERROR_RECEIVE_EMAIL_BILLING, utf8_encode('Au moins un contact doit avoir coch� la case <b>Recevoir la facturation par courrier �lectronique</b>.'));
	define(SW_ERROR_FILE_EXCEL_FORMAT, utf8_encode("Le fichier s�lectionn� doit �tre au format Excel"));
	define(SW_ERROR_FILE_IMPORT, utf8_encode("Erreur lors de l'importation du fichier"));

?>
