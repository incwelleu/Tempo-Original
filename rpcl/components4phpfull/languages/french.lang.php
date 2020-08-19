<?php
  $XLMLanguage = "French (France)";

  $format_money_mysql = 'de_DE';

	//Server FTP
	$lblCreateDirectory	= utf8_encode("Créer le répertoire");
	$lblCurrentDirectory=utf8_encode("Répertoire actuel");
	$lblDate	= "Date";
	$lblDeleteFile	= "Supprimer le fichier";
	$lblDeleteFileMsg = "Want to delete the selected files?";
	$lblName = "Nom";
	$lblSize = "Taille";
	$lblFileType = "Type";
	$lblUploadedBy = utf8_encode("Téléchargé par");
	$lblUp = utf8_encode("Répertoire précédent");
	$lblUploadFile = utf8_encode("Télécharger des fichiers");
	$lblDownload = utf8_encode("Télécharger le fichier");
	$lblReplaceFileName = "Remplacer le nom du fichier";
	$lblCreateExercise = utf8_encode("Nouvelle année");
	$lblFileSuccessUpload = utf8_encode("Processus de téléchargement de fichier terminé");
	$lblSearchFile = "Rechercher";
	$lblStatus = "Statut";
	$lblCleanClientShortName = "Nettoyer le nom court du client";


  //Error file of FTP
	$lblFileCouldNotBeUploaded = utf8_encode("Le fichier n'a pas pu être téléchargé");
	$lblFileErrorMoveFileUploaded = utf8_encode("Impossible de copier le fichier dans le répertoire");
	$lblFileErrorDirExists = utf8_encode("Le répertoire existe déjà");
	$lblFileErrorCompany = utf8_encode("Erreur: ce fichier ne correspond à aucun nom abrégé d'entreprise");
	$lblFileErrorParentTree = utf8_encode("Erreur: ce fichier ne correspond pas à ce répertoire");
	$lblFileMsgNotIncludeDraft = utf8_encode("Aucune adresse e-mail de contact assignée à cette société");
	$lblFileViewDraftEmailMsg = utf8_encode("Vos téléchargements ont créé des emails. Voir la liste?");
	$lblFileViewDraftEmailBeforeMsg = utf8_encode("Vous avez des courriels créés à partir d'avant. Voir la liste?");
  $lblFileErrorCompanyUserName = utf8_encode("Le fichier que vous avez téléchargé a créé un courrier électronique standard.</br>Cet email est erroné et doit être supprimé car vous n'avez pas créé de Nom d'utilisateur pour ce client dans Société->Détails");

	$lblHelp = "Aide";
	$lblNoHelp = "Aucune aide";

	$MonthLetter = array("1" => "Janvier",
					"2" => utf8_encode("Février"),
					"3" => "Mars",
					"4" => "Avril",
					"5" => "Mai",
					"6" => "Juin",
					"7" => "Juillet",
					"8" => utf8_encode("Août"),
					"9" => "Septembre",
					"10" => "Octobre",
					"11" => "Novembre",
					"12" => utf8_encode("Décembre"));

  //Status user
  $GLOBAL_STATUS_CODE = Array ('a' => "Actif", 'i' => "Inactif");
  $GLOBAL_USER_STATUS_CODE = Array('a' => "Activer",
																	 'c' => utf8_encode("Pas d'accès (laissé à un autre fournisseur: pas satisfait du service)"),
																	 'k' => utf8_encode("Pas d'accès (Kicked out - factures impayées)"),
																	 'i' => utf8_encode("Pas d'accès (Service interrompu en bonnes conditions)"),
																	 'p' => utf8_encode("Pas d'accès (laissé à un autre fournisseur: prix ou emplacement)"));

  //Type contact
  $GLOBAL_CONTACT_TYPE_COMPANY = Array(0 => '', 1 => 'Administrateur ', 2 =>' Partenaire ', 3 =>utf8_encode(' Employé '));
  $GLOBAL_CONTACT_TYPE_PERSONAL = Array(0 => '', 0 => 'Titulaire', 11 => 'Conjoint', 12 => 'Fils', 13 => 'Fille', 14 => utf8_encode('Mère') , 17 => utf8_encode('beau-père'));

  //status company
  $GLOBAL_STATUS_COMPANY = Array('a' => "Active", 'c' => "Un autre fournisseur", 'k' => utf8_encode("Explusé"), 'i' => "Inactif");
  $GLOBAL_DOCUMENT_TYPE = Array(0=> '', 1 => 'Company tax ID' , 2 => 'ID de taxe personnelle', 3 => utf8_encode('TVA non résidente'), 4 => 'Passeport', 5 => utf8_encode('TVA étrangère'));
  $GLOBAL_INVOICE_ADDRESS = Array(0=> '', 1 => utf8_encode('adresse enregistrée'), 2 => 'adresse mail');

  //Buttons
	define (btnRefresh, "Actualiser");
	define (btnFilter, "Filtre");
	define (btnCustomFilter, utf8_encode("Filtre personnalisé"));
	define (btnAdd, "Ajouter");
	define (btnDelete, "Effacer");
	define (btnEdit, "Modifier");
	define (btnCancel, "Annuler");
	define (btnSave, "Sauver");
	define (btnDetail, utf8_encode("Détail"));
	define (btnUnMark, utf8_encode("Non marqué"));
	define (btnCreate, utf8_encode("Créer"));
	define (btnImportExcel, utf8_encode("Importer à partir d'Excel"));
	define (btnExportAccounting, utf8_encode("Exporter pour la comptabilité"));
	define (btnImportAccounting, utf8_encode("Importer le code de comptabilité"));
	define (btnRegistrationChange, utf8_encode("Modifier la date d'enregistrement"));
	define (btnProvider, "Fournisseurs");
	define (btnClient, "Clients");
	define (btnBank, "Comptes bancaires");
	define (btnReturnPage, "Page de retour");
	define (btnClose, "Fermer");
	define (btnRecoverPassword, utf8_encode("Récupérer le mot de passe"));
	define (btnDateProcessed, "Date de traitement");
	define (btnUpdateClientInvoice, utf8_encode("Mettre à jour les factures client"));
	define (btnMergeClient, utf8_encode("Fusionner le client dupliqué"));
	define (btnUpdateProviderInvoice, utf8_encode("Mettre à jour les factures du fournisseur"));
	define (btnMergeProvider, "Fusionner le fournisseur en double");
	define (btnChangeTypeTax, "Modifier la taxe de sortie");
	define (btnSendEmail, utf8_encode("Envoyer les emails cochés"));
	define (btnDownloadCompanyFile, utf8_encode("Télécharger tous les fichiers de la société"));
	define (btnUnMarkTaxModel, utf8_encode("Désélectionner les modèles d'imposition"));
	define (btnTaxAccountDefault, utf8_encode("Comptes de taxes par défaut"));
	define (btnAddService, "Ajouter des services");
	define (btnWorkCompleted, utf8_encode("Travail terminé pour les éléments sélectionnés"));
	define (btnInvoiceAddress, "Adresse de facturation");
	define (btnInvoice, "Facture");
	define (btnCreateMonthlyInvoice, utf8_encode("Créer des factures mensuelles"));
	define (btnDiscountingSupplement, utf8_encode("Réduire par le montant du supplément"));
	define (btnPaid, utf8_encode("Marquer comme payé"));
	define (btnUnPaid, "Anuler: Incobrable");
	define (btnExportXLS, "Exporter vers Excel");
	define (btnSendStandardEmail, "Envoyer un email standard");;
	define(btnDownloadHiringForm, utf8_encode("Obtenir un formulaire d'embauche"));
	define(btnDownLoadTerminationForm, utf8_encode("Obtenir le formulaire de résiliation"));
	define(btnDown145Form, "Obtenir le formulaire 145");
  define(btnAmtSmall, "Annuler: montant trop petit");
	define(btnZeroTotal, utf8_encode("Annuler divers: total zéro"));
	define(btnCreateCreditNote, "Créer une facture de crédit");
	define(btnSendEmailUnpaid, "Send UNPAID email");
	define(btnChangeAccountManager, "hanger de compte");
  define(btnChangeAccountant, utf8_encode("Changer de comptabilité"));
  define(btnChangePayroll, "Changement conseiller de travail");

  //Titles Pages
	define (Title_Invoice_issued, utf8_encode("Factures émises"));
	define (Title_Invoice_receive, "Factures reçues");
	define (Title_Provider, "Fournisseurs");
	define (Title_Client, "Clients");
	define (Title_Company, utf8_encode("Société"));
	define (Title_Bank_Account, "Comptes bancaires");
	define (Title_User, "Utilisateurs");
	define (Title_Contact, "Contacts");
	define (Title_Provider_Contact, utf8_encode("Contacts d'administration"));
	define (Title_Help_content, utf8_encode("Contenu de l'aide"));
	define (Title_Standard_Email_Clients, "E-mails standards aux clients");
	define (Title_Standard_Email_Internal, "E-mails standards internes");
	define (Title_Upload_Accounting, utf8_encode("Charger la comptabilité"));
	define (Title_Relation_Account_Manager, "Gestionnaires de comptes/ clients");
	define (Title_EmailDraft, "Mes e-mails");
	define (Title_EmailSent, utf8_encode("Mes e-mails envoyés"));
	define (Title_EmailAll, "Tous les e-mails");
	define (Title_TaxModel, utf8_encode("Modèles de taxes"));
	define (Title_Parameters_Accounting, utf8_encode("Comptabilité des paramètres"));
	define (Title_Service, "Services");
	define (Title_Invoicing, "Facturation");
	define (Title_Payments, "Paiements");
	define (Title_Setting, utf8_encode("Paramètres"));
	define (Title_Regular_service_client, utf8_encode("Clients du service régulier"));
	define (Title_Service_tracker, "Suivi de service");

  //Menssage General
	$lbSelectValue = utf8_encode("Sélectionner la valeur");
	$lbDeleteInformationMsg = utf8_encode("Voulez-vous supprimer l'information sélectionnée?");
	$lbSpecifyValueMsg = utf8_encode("Vous devez spécifier une valeur dans le champ.");
	$lbRecoverPasswordMsg = utf8_encode("Vous voulez récupérer le mot de passe pour l'utilisateur sélectionné?");
	$lbRecoveredDefaultPasswordMsg = utf8_encode("Le mot de passe par défaut a été récupéré");
	$lbEmailErrorMsg = utf8_encode("Le format de l'email n'est pas correct");
	$lbNumberErrorMsg = utf8_encode("Le format numérique n'est pas correct");
	$lbUpdateClientInvoiceMsg = utf8_encode("Mettre à jour les factures clients sélectionnées?");
	$lbMergeClientMsg = utf8_encode("Fusionner les clients spécifiés?");
	$lbUpdateProviderInvoiceMsg = utf8_encode("Mettre à jour les factures du fournisseur sélectionné?");
	$lbMergeProviderMsg = utf8_encode("Fusionner les fournisseurs spécifiés?");
	$lbRequiredFieldError = "Champs obligatoires";
	$lbCreateClientMsg = utf8_encode("Vous voulez créer le client?");

  //Message Invoice
  $lbInvoiceIsAlreadyCreate_error = utf8_encode("Le numéro de facture est déjà créé");
	$lbInvoiceDateInvalid = utf8_encode("La date de facturation n'est pas valide.");
	$lbSelectClient_error = utf8_encode("Vous devez sélectionner le client");
	$lbSelectProvider_error = utf8_encode("Vous devez sélectionner le fournisseur");
	$lbUnmarkSelectedInvoiceMsg = utf8_encode("Marquer / Décocher les factures sélectionnées enregistrées en comptabilité?");
	$lbUnpaidSelectInvoiceMsg = utf8_encode("Marquer / Décocher sélectionné comme facture impayée?");

  //Message User
  $lbChangeUserAdmin_error = utf8_encode("Vous ne pouvez pas changer l'utilisateur administrateur.");
	$lbUserLogin_error = utf8_encode("Le nom d'utilisateur et le mot de passe saisis ne correspondent pas à ceux du fichier.");
	$lbUserInactive_error = utf8_encode("Votre compte n'est plus actif.");
	$lbUserNameNotAvailable_error = utf8_encode("Le nom d'utilisateur n'est pas disponible.");
	$lbUserNameNotEmpty_error = utf8_encode("Le nom d'utilisateur ne peut pas être vide");
	$lbUserRolesNotEmpty_error = utf8_encode("Attribuer un rôle à l'utilisateur.");

  //Message Company
  $lbCompanyCompanyName_error = utf8_encode("Le nom complet de l'entreprise n'est pas valide.");
	$lbCompanyDocumentType_error = utf8_encode("Le type de document n'est pas valide.");
	$lbCompanyTaxIdent_error = utf8_encode("L'identifiant de taxe n'est pas valide.");
	$lbCompanyTaxIdentExist = utf8_encode("L'identifiant de taxe existe déjà.");
	$lbCompanyShortNameNotAvailable_error = utf8_encode("Le nom court n'est pas valide.");
	$lbCompanyShortNameAlreadyExists_error = utf8_encode("Le nom court existe déjà.");

 	$lbCompanyLegacy_datahouse_error = utf8_encode("L'ID du datacenter n'est pas disponible, appartient {$short_name}");
	$lbCompanyCountry_error = utf8_encode("Le pays n'est pas valide.");
	$lbCompanyPaymentMethod_error = utf8_encode("Le mode de paiement n'est pas valide.");
	$lbCompanyBillingEntity_error = utf8_encode("L'entité de facturation n'est pas valide.");


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
  $lbUploadFileExists_error = utf8_encode("Le fichier existe déjà, téléchargé une copie de");

  //Type regimen tax
	$type_output_tax = array (0 => utf8_encode("Régimes généraux"), 1 => "Personne imposable", 2 => "Non soumis", 3 => "Pas de taxe");
	$type_input_tax = array (0 => utf8_encode("Régime général"), 1 => "Personne imposable", 2 => "Non sujet", 3 => "Non imposable");
	$period_type = Array (0 => '', 1 => 'Mensuel', 3 => 'Trimestriel', 6 => 'Semestriel', 12 => 'Annuel');
	$tax_model_state = array (0 => "Sans soumettre", 1 => "Soumis");

  //Template Import
	$template_import_invoice = array(0=>"",1=>utf8_encode("Notre template"), 2=>"G-Accon pour Xero");
	$download_our_template = utf8_encode("Téléchargez notre template");


  //Email Template
	$lbClientWithoutContactMarked = utf8_encode("Clients sans contacts marqués");
	$Trigger_type_cd = array ( 'UPL' => utf8_encode('Télécharger FTP'), 'FIE' => 'Changement champ', 'MAN' => 'Manuel', 'NON' => 'None', 'SCH' => 'Scheduled');
	$email_to_cd = array ( 'ACC' => utf8_encode('Recevoir la comptabilité'), 'PAY' => 'Recevoir la paie', 'BIL' => 'Recevoir la facturation', 'ACR' => utf8_encode("Rappel comptabilité"), 'TXR' => utf8_encode("Rappel des impôts personnels"));

  //Email draft
  $lbEmailMessageSend = utf8_encode("Etes-vous sûr de vouloir envoyer tous les emails qui ont été vérifiés?");
	$lbChangeEmailTemplateMsg = utf8_encode("Si vous confirmez que la modification supprimera tout le contenu du mail. Voulez-vous changer le modèle d'email?");

	//Company
	$SW_COMPANY_TAB = array(array(utf8_encode('Détails'), 'TabDetails', 1),
							array('Adresse de facturation', 'TabInvoiceAddress', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
							array('Contacts', 'TabContacts', 1),
							array('Comptes bancaires', 'TabBankAccounts', 1),
							array('Tax models', 'TabTaxModels', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])),
							array(utf8_encode('Paramètres comptabilité'), 'TabAccounting', ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'])));

  //Service Agreement
  $SW_STATUS_SERVICE_AGREEMENT_CD = array(SW_STATUS_SVC_NEW => "New",
										SW_STATUS_SVC_SENT => utf8_encode("Envoyé"),
										SW_STATUS_SVC_ACCEPTED => utf8_encode("Accepté"),
										SW_STATUS_SVC_REJECTED => utf8_encode("Annulé"),
										SW_STATUS_SVC_PAID => utf8_encode("Payé"),
										SW_STATUS_SVC_INVOICED => utf8_encode("Facturé"));
	$lbPaidServiceAgreementMsg = "Vous voulez payer le contrat de service?";
	$lbPaidServiceAgreement_error = utf8_encode("Le paiement est comptabilisé");
	$lbShowInvoicedAndCanceled = utf8_encode("Montrer facturé et annulé");

  //Line items
  $SW_STATUS_LINE_ITEM_CD = array(SW_STATUS_LI_SERVICE => "Services", SW_STATUS_LI_PROFORMA => "Proforma", SW_STATUS_LI_TO_INVOICE => "Pour facturer", SW_STATUS_LI_INVOICED => utf8_encode("Facturé"));;
  define('SW_MESSAGE_ERROR_WITHOUT_SERVICE', utf8_encode('Vous devez sélectionner un service'));

  //Invoice Issued
  $SW_STASTUS_INVOICE_ISSUED_CD = array (SW_STATUS_IS_OPEN => "Open", SW_STATUS_IS_CLOSE => utf8_encode('Fermé'), SW_STATUS_IS_UNPAID => 'Incobrable', SW_STATUS_TOO_SMALL => 'Trop petit', SW_STATUS_ZERO_TOTAL => utf8_encode('Total zéro'));

	//Invoicing
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_INVOICES_TAB = array(array(utf8_encode('Service régulier'), 'TabService', 1),
  							array(utf8_encode('à Facturer'), 'TabToInvoice', 1),
  							array(utf8_encode('Facturé'), 'TabInvoiced', 1),
                           array('Commissions', 'TabCommission', 1),
                           array(utf8_encode('Commissions antérieures'), 'TabPastCommission', 0));

	//Payments
  // array[0] => Caption
  // array[1] => Tab name
  // array[3] => Visible
  $SW_PAYMENTS_TAB = array(array(utf8_encode('Factures impayées'), 'TabUnpaid', 1), array('Paiements', 'TabPayments', 1));

  //Boolean
  define(SW_CAPTION_YES, 'Oui');
  define(SW_CAPTION_NO, 'Non');

  //Caption Default
	define (SW_CAPTION_COMPANY_NAME, utf8_encode("Nom de l'entreprise"));
	define(SW_CAPTION_SHORT_NAME, 'Entreprise');
	define(SW_CAPTION_SERVICE, 'Service');
	define(SW_CAPTION_SERVICE_CATEGORY_NAME, utf8_encode('Catégorie'));
	define(SW_CAPTION_DESCRIPTION, 'Description');
	define(SW_CAPTION_QUANTITY, utf8_encode('Quantité'));
	define(SW_CAPTION_PRICE, 'Prix');
	define(SW_CAPTION_SUBTOTAL, 'Sous-total');
	define(SW_CAPTION_TOTAL, 'Total');
	define(SW_CAPTION_OTHER_INCOME, 'Autres revenus');
	define(SW_CAPTION_NOTES, 'Notes');
	define(SW_CAPTION_SERVICE_TYPE, 'Type de service');
	define(SW_CAPTION_STATUS_CD, 'Statut');
	define(SW_CAPTION_CREATED_BY, utf8_encode('Créé par'));
	define(SW_CAPTION_CREATED_DT, utf8_encode('Date de création'));
	define(SW_CAPTION_ACCOUNT_CD, 'Comptabilisation du compte');
	define(SW_CAPTION_TAX_TYPE, utf8_encode("Type d'opération"));
	define(SW_CAPTION_TYPE_OUTPUT_TAX, 'Type de taxe de sortie');
	define(SW_CAPTION_TYPE_INPUT_TAX, utf8_encode("Type de taxe d'entrée"));
	define(SW_CAPTION_BASE_TAX, 'Montant de base');
	define(SW_CAPTION_TAX_RATE, utf8_encode("Taux d'imposition"));
	define(SW_CAPTION_TAX, 'TVA');
	define(SW_CAPTION_BASE_WITHHOLDING, 'Retenue');
	define(SW_CAPTION_INVOICE_DT, 'Date de facturation');
	define(SW_CAPTION_FREQUENCY, utf8_encode('Fréquence'));
	define(SW_CAPTION_START_DT, utf8_encode('Date de début'));
	define(SW_CAPTION_END_DT, 'Date de fin');
	define(SW_CAPTION_CHARGE_TO, utf8_encode('Imputer à'));
	define(SW_CAPTION_SUPPLEMENT_YN, utf8_encode('Avec supplément?'));
	define(SW_CAPTION_SUPPLEMENT, utf8_encode("Suppl'ment"));
	define(SW_CAPTION_SORT_SERVICE_AGREEMENT_YN, 'Montrer </ br> contrat de service?');
	define(SW_CAPTION_COMPLETED_YN, utf8_encode('Travail terminé?'));
	define(SW_CAPTION_COMPLETED_DT, 'Date de fin');
	define(SW_CAPTION_COMMISSION, 'Original </ br> commission');
	define(SW_CAPTION_FUTURE_COMMISSION, 'Commission');
	define(SW_CAPTION_FIRST_NAME, utf8_encode('Prénom'));
	define(SW_CAPTION_LAST_NAME, 'Nom de famille');
	define(SW_CAPTION_EMAIL, 'E-mail');
	define(SW_CAPTION_PAID_DT, 'Date de paiement');
	define(SW_CAPTION_PAID_YN, utf8_encode('Payé?'));
	define(SW_CAPTION_PAID, utf8_encode('Payé'));
	define(SW_CAPTION_PAID_BY, utf8_encode('Payé par / informations bancaires'));
	define(SW_CAPTION_PAID_AMT, utf8_encode('Montant payé'));
	define(SW_CAPTION_PAYMENT_METHOD, utf8_encode('Méthode de paiement'));
	define(SW_CAPTION_BANK_ACCOUNT, 'Compte bancaire');
	define(SW_CAPTION_BILLING_ENTITY, utf8_encode('Entité de</br>facturation'));
	define(SW_CAPTION_ONLINE_ACCESS, utf8_encode('Accès en ligne'));
	define(SW_CAPTION_COPY_LINK, 'Copier le lien');
	define(SW_CAPTION_ACCOUNTED_YN, utf8_encode('Comptablisé'));
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
	define(SW_CAPTION_INVOICE_NUMBER, utf8_encode('Numéro de facture'));
	define(SW_CAPTION_DATE, 'Date');
	define(SW_CAPTION_SORT_NO, 'Trier');
	define(SW_CAPTION_PROVISION_FONDO_AMT, utf8_encode('Financement'));
	define(SW_CAPTION_PAY_AMT, utf8_encode('Total à payer'));
	define(SW_CAPTION_CONTACT_NAME, 'Nom du contact');
	define(SW_CAPTION_ACCOUNT_MANAGER, 'Gestionnaire de compte');
	define(SW_CAPTION_ACCOUNTANT_MANAGER, 'Gestionnaire comptable');
	define(SW_CAPTION_PAYROLL_MANAGER, 'Gestionnaire de paie');
	define(SW_CAPTION_TYPE_OPERATION, utf8_encode('Opération de type'));
	define(SW_CAPTION_NUMMER_MONTH, 'Nombre </ br> de mois');
	define(SW_CAPTION_TAX_MODEL, utf8_encode('Modèle de taxe'));
	define(SW_INCLUDE_INACTIVE_USER, 'Inclure les utilisateurs inactifs');
	define(SW_SHOW_CANCELED_INVOICES, utf8_encode('Afficher les factures annulées'));
	define(SW_CAPTION_MOBILE_PHONE, utf8_encode('Téléphone mobile'));
	define(SW_CAPTION_FIXED_PHONE, utf8_encode('Téléphone fixe'));
	define(SW_INCLUDE_SERVICES_ENDED, utf8_encode("Inclure les services terminés"));
	define(SW_CAPTION_TYPE_EXPENSE, utf8_encode('Type de dépenses'));
	define(SW_CAPTION_ACCOUNT_EXPENSE, 'Compte </ br> frais');
	define(SW_CAPTION_ACCOUNT_OTHER_EXPENSE, utf8_encode('Compte </ br> autre dépense'));
	define(SW_CAPTION_ACCOUNT_WITHHOLDING, 'Compte </ br> Retenue');
	define(SW_CAPTION_CONSTITUTION_DT, 'Date de constitution');
	define(SW_SHOW_WORK_COMPLETED, utf8_encode('Inclure le travail terminé'));
  define(SW_CAPTION_REGADDRESS, 'Reg: Adresse');
  define(SW_CAPTION_REGCITY, 'Reg: Ville');
  define(SW_CAPTION_MAILCOUNTRY, 'Mail: Pays');
  define(SW_CAPTION_REGISTERED_ADDRESS, utf8_encode("Adresse enregistrée"));
  define(SW_CAPTION_MAILING_ADDRESS, utf8_encode("Adresse postale (si différente de l'adresse enregistrée)"));
  define(SW_CAPTION_USER, utf8_encode("l'usager"));

	// Error
  define(SW_ERROR_RECEIVE_EMAIL_BILLING, utf8_encode('Au moins un contact doit avoir coché la case <b>Recevoir la facturation par courrier électronique</b>.'));
	define(SW_ERROR_FILE_EXCEL_FORMAT, utf8_encode("Le fichier sélectionné doit être au format Excel"));
	define(SW_ERROR_FILE_IMPORT, utf8_encode("Erreur lors de l'importation du fichier"));

?>
