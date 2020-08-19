<?php
<object class="relation_expense_received" name="relation_expense_received" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Strong Weber - Companies</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Font">
  <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
  <property name="Size"></property>
  </property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">relation_expense_received</property>
  <property name="UseAjax">1</property>
  <property name="Width">460</property>
  <property name="OnCreate">relation_expense_receivedCreate</property>
  <property name="OnShow">relation_expense_receivedShow</property>
  <object class="JTPlatinumGrid" name="gridResults" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:19:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:610:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:13:"Provider name";s:9:"DataField";s:13:"provider_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"provider_name";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:651:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:12:"expense_name";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Expense type";s:9:"DataField";s:15:"expense_type_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"expense_type_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:654:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:13:"tax_type_name";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:14:"Tax output tax";s:9:"DataField";s:15:"tax_type_key_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"tax_type_key_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}i:3;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:537:"a:13:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:18:"Invoice </br> date";s:9:"DataField";s:10:"invoice_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"invoice_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:3:"110";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:620:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:14:"Invoice number";s:9:"DataField";s:14:"invoice_number";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"invoice_number";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:3:"120";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:597:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2F";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:8:"Subtotal";s:9:"DataField";s:12:"subtotal_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"subtotal_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:598:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:3:"VAT";s:9:"DataField";s:7:"tax_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"tax_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:631:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:13:"Other expense";s:9:"DataField";s:17:"other_expense_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:17:"other_expense_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:8;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:641:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:16:"Base Withholding";s:9:"DataField";s:20:"base_withholding_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:20:"base_withholding_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:3:"100";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:639:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:16:"Withholding rate";s:9:"DataField";s:19:"withholding_rate_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:19:"withholding_rate_no";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:625:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Withholding";s:9:"DataField";s:15:"withholding_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"withholding_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:11;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:604:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:5:"Total";s:9:"DataField";s:9:"total_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"total_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:12;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:545:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:13;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:551:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Postal code";s:9:"DataField";s:9:"postal_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"postal_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:14;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:556:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Account code";s:9:"DataField";s:10:"account_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"account_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"115";}";}i:15;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:557:"a:12:{s:7:"Display";s:8:"DateOnly";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:21:"Registration</br>date";s:9:"DataField";s:31:"registered_in_acctg_software_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:31:"registered_in_acctg_software_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:3:"110";}";}i:16;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:581:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Document ID";s:9:"DataField";s:14:"document_ident";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"document_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:3:"110";}";}i:17;a:2:{i:0;s:25:"JTPlatinumGridImageColumn";i:1;s:471:"a:12:{s:8:"DataType";s:8:"FileName";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:7:"img_pdf";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"img_pdf";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:2:"32";}";}i:18;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:602:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:4:"link";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"link";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}]]></property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    </property>
    <property name="Datasource">dsResults</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">329</property>
    <property name="Left">-1</property>
    <property name="Name">gridResults</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">10</property>
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    <property name="VisiblePageCount">1</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">provider_name</property>
    <property name="Top">121</property>
    <property name="Width">451</property>
    <property name="OnRowData">gridResultsRowData</property>
    <property name="OnSQL">gridResultsSQL</property>
    <property name="OnSummaryData">gridResultsSummaryData</property>
    <property name="jsOnSelect">gridResultsJSSelect</property>
  </object>
  <object class="JTExpandPanel" name="pnParameter" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">115</property>
    <property name="HideText">Hide parameters</property>
    <property name="Name">pnParameter</property>
    <property name="NextControl">gridResults</property>
    <property name="ShowText">Show parameters</property>
    <property name="SiteTheme"></property>
    <property name="Width">450</property>
    <object class="Label" name="lbFrom" >
      <property name="Caption">From</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbFrom</property>
      <property name="Top">37</property>
      <property name="Width">35</property>
    </object>
    <object class="Label" name="lbTo" >
      <property name="Caption">To</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbTo</property>
      <property name="Top">65</property>
      <property name="Width">35</property>
    </object>
    <object class="JTDatePicker" name="From_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">From_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">31</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="JTDatePicker" name="To_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">To_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">59</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="CheckBox" name="cbDetail" >
      <property name="Cached">1</property>
      <property name="Caption">Detailed expenses</property>
      <property name="Height">21</property>
      <property name="Left">8</property>
      <property name="Name">cbDetail</property>
      <property name="Top">87</property>
      <property name="Width">179</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="Image" name="imXLS" >
      <property name="Border">0</property>
      <property name="Cached">1</property>
      <property name="Height">24</property>
      <property name="Hint">Export</property>
      <property name="ImageSource">images/button/xls.png</property>
      <property name="Left">171</property>
      <property name="Link"></property>
      <property name="LinkTarget"></property>
      <property name="Name">imXLS</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Stretch">1</property>
      <property name="Top">84</property>
      <property name="Width">24</property>
      <property name="OnClick">imXLSClick</property>
    </object>
    <object class="JTRadioButtonList" name="rbDateQuery" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Columns">0</property>
      <property name="Height">54</property>
      <property name="ItemIndex">0</property>
      <property name="Items">a:2:{i:0;s:12:"Invoice date";i:1;s:17:"Registration date";}</property>
      <property name="Left">211</property>
      <property name="Name">rbDateQuery</property>
      <property name="SelectedItem">Invoice date</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">31</property>
      <property name="Width">149</property>
      <property name="jsOnClick">From_dtJSChange</property>
    </object>
  </object>
  <object class="Query" name="sqlResults" >
        <property name="Left">240</property>
        <property name="Top">216</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="Name">sqlResults</property>
    <property name="Order">desc</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:31:"Select * from invoice_received ";}</property>
    <property name="TableName">virtual_file</property>
  </object>
  <object class="Datasource" name="dsResults" >
        <property name="Left">240</property>
        <property name="Top">232</property>
    <property name="DataSet">sqlResults</property>
    <property name="Name">dsResults</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">256</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlExpense_type" >
        <property name="Left">113</property>
        <property name="Top">225</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlExpense_type</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:39:"Select expense_type.* from expense_type";}</property>
    <property name="TableName">expense_type</property>
  </object>
  <object class="Datasource" name="dsExpense_type" >
        <property name="Left">113</property>
        <property name="Top">241</property>
    <property name="DataSet">sqlExpense_type</property>
    <property name="Name">dsExpense_type</property>
  </object>
</object>
?>
