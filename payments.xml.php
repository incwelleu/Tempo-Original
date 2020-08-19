<?php
<object class="payments" name="payments" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Payments</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">436</property>
  <property name="IsMaster">0</property>
  <property name="Name">payments</property>
  <property name="UseAjax">1</property>
  <property name="Width">681</property>
  <property name="OnCreate">paymentsCreate</property>
  <object class="JTPlatinumGrid" name="gridInvoice_issued_paid" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowInsert">0</property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:0:{}</property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsInvoice_issued_paid</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">133</property>
    <property name="KeyField">invoice_issued_paid_id</property>
    <property name="Left">88</property>
    <property name="Name">gridInvoice_issued_paid</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="Top">259</property>
    <property name="Visible">0</property>
    <property name="Width">491</property>
    <property name="OnDelete">gridInvoice_issued_paidDelete</property>
    <property name="OnSQL">gridInvoice_issued_paidSQL</property>
    <property name="OnShow">gridInvoice_issued_paidShow</property>
    <property name="OnUpdate">gridInvoice_issued_paidUpdate</property>
  </object>
  <object class="JTPlatinumGrid" name="gridPayments" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:1:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:478:"a:7:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:13:"FilterOptions";a:2:{i:1;s:3:"LLC";i:2;s:2:"SL";}s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:25:"JTPlatinumGridTextColumn1";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";}";}}</property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsPayments</property>
    <property name="DetailValue">invoice_issued_id</property>
    <property name="DetailView">
    <property name="DetailField">invoice_issued_id</property>
    <property name="DetailGrid">gridInvoice_issued_paid</property>
    <property name="Enabled">1</property>
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">339</property>
    <property name="Name">gridPayments</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">500</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">86</property>
    <property name="Width">680</property>
    <property name="OnRowData">gridPaymentsRowData</property>
    <property name="OnSQL">gridPaymentsSQL</property>
    <property name="OnSummaryData">gridPaymentsSummaryData</property>
    <property name="OnUpdate">gridPaymentsUpdate</property>
    <property name="jsOnSelect">gridPaymentsJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winProcess" >
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="BorderIcons">
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">winProcess</property>
    <property name="Height">180</property>
    <property name="Left">32</property>
    <property name="Name">winProcess</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">431</property>
    <property name="Width">540</property>
    <object class="JTAdvancedEdit" name="paid_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">135</property>
      <property name="MaxLength">15</property>
      <property name="Name">paid_amt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="TabOrder">1</property>
      <property name="Top">33</property>
      <property name="Width">114</property>
    </object>
    <object class="JTLabel" name="lbPaid_amt" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Paid amount</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">12</property>
      <property name="Name">lbPaid_amt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">36</property>
      <property name="Width">115</property>
    </object>
    <object class="JTDatePicker" name="paid_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">135</property>
      <property name="Name">paid_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">2</property>
      <property name="Top">59</property>
      <property name="Width">115</property>
    </object>
    <object class="Label" name="lbPaid_dt" >
      <property name="Caption">Paid date</property>
      <property name="Height">13</property>
      <property name="Left">12</property>
      <property name="Name">lbPaid_dt</property>
      <property name="Top">65</property>
      <property name="Width">115</property>
    </object>
    <object class="Label" name="lbPaid_by" >
      <property name="Caption">Paid by</property>
      <property name="Height">13</property>
      <property name="Left">12</property>
      <property name="Name">lbPaid_by</property>
      <property name="Top">93</property>
      <property name="Width">115</property>
    </object>
    <object class="JTAdvancedEdit" name="paid_by" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">135</property>
      <property name="Name">paid_by</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">3</property>
      <property name="Top">87</property>
      <property name="Width">391</property>
    </object>
    <object class="Button" name="btnSavePayment" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">451</property>
      <property name="Name">btnSavePayment</property>
      <property name="Top">142</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSavePaymentClick</property>
    </object>
    <object class="JTLabel" name="lbPayment_method" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Payment method</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">12</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">120</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">135</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dsPayment_method</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">117</property>
      <property name="Width">200</property>
    </object>
    <object class="JTLabel" name="lbBank_account" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Bank account</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">12</property>
      <property name="Name">lbBank_account</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">149</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="bank_account_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">135</property>
      <property name="LookupDataField">bank_account_id</property>
      <property name="LookupDataSource">dsCompany_bank_account</property>
      <property name="LookupField">bank_account_name</property>
      <property name="Name">bank_account_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">5</property>
      <property name="Top">146</property>
      <property name="Width">200</property>
    </object>
  </object>
  <object class="JTTabControl" name="TabPayments" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">31</property>
    <property name="Name">TabPayments</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="TabIndex">0</property>
    <property name="Tabs">a:2:{i:0;a:3:{i:0;s:11:"JTTabSheet1";i:1;s:11:"JTTabSheet1";i:2;s:1:"1";}i:1;a:3:{i:0;s:11:"JTTabSheet2";i:1;s:11:"JTTabSheet2";i:2;s:1:"1";}}</property>
    <property name="Top">20</property>
    <property name="Width">680</property>
    <property name="jsOnChange">TabPaymentsJSChange</property>
  </object>
  <object class="HiddenField" name="active_tab" >
    <property name="Height">18</property>
    <property name="Left">401</property>
    <property name="Name">active_tab</property>
    <property name="Top">424</property>
    <property name="Width">157</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">240</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">424</property>
    <property name="Width">115</property>
  </object>
  <object class="HiddenField" name="invoice_issued_id" >
    <property name="Height">18</property>
    <property name="Left">108</property>
    <property name="Name">invoice_issued_id</property>
    <property name="Top">424</property>
    <property name="Value">0</property>
    <property name="Width">117</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">32</property>
        <property name="Top">144</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany" >
        <property name="Left">600</property>
        <property name="Top">158</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany</property>
    <property name="OrderField">short_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:21:"Select * from company";}</property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">600</property>
        <property name="Top">177</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="Query" name="sqlPayments" >
        <property name="Left">112</property>
        <property name="Top">166</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayments</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:28:"Select * from invoice_issued";i:1;s:21:"Where status_cd = '';";}</property>
    <property name="TableName">invoice_issued</property>
  </object>
  <object class="Datasource" name="dsPayments" >
        <property name="Left">112</property>
        <property name="Top">188</property>
    <property name="DataSet">sqlPayments</property>
    <property name="Name">dsPayments</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">600</property>
        <property name="Top">344</property>
    <property name="Images">a:8:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:28:"images/button/view_16x16.png";s:1:"8";s:27:"images/button/xls_16X16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">343</property>
        <property name="Top">170</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayment_method</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:45:"SELECT payment_method_id, payment_method_name";i:1;s:19:"FROM payment_method";}</property>
    <property name="TableName">payment_method</property>
  </object>
  <object class="Datasource" name="dsPayment_method" >
        <property name="Left">343</property>
        <property name="Top">187</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
  <object class="Query" name="sqlCompany_bank_account" >
        <property name="Left">471</property>
        <property name="Top">170</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_bank_account</property>
    <property name="Order">desc</property>
    <property name="OrderField">is_primary_account_yn</property>
    <property name="Params">a:1:{i:0;s:1:"0";}</property>
    <property name="SQL">a:3:{i:0;s:8:"SELECT *";i:1;s:25:"FROM company_bank_account";i:2;s:23:"WHERE company_id in (?)";}</property>
    <property name="TableName">company_bank_account</property>
  </object>
  <object class="Datasource" name="dsCompany_bank_account" >
        <property name="Left">471</property>
        <property name="Top">186</property>
    <property name="DataSet">sqlCompany_bank_account</property>
    <property name="Name">dsCompany_bank_account</property>
  </object>
  <object class="Query" name="sqlInvoice_issued_paid" >
        <property name="Left">226</property>
        <property name="Top">169</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued_paid</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:33:"Select * from invoice_issued_paid";i:1;s:18:"Where paid_amt = 1";}</property>
    <property name="TableName">invoice_issued_paid</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued_paid" >
        <property name="Left">226</property>
        <property name="Top">185</property>
    <property name="DataSet">sqlInvoice_issued_paid</property>
    <property name="Name">dsInvoice_issued_paid</property>
  </object>
  <object class="CheckBox" name="cbShowCanceledInvoices" >
    <property name="Caption">Show canceled invoices</property>
    <property name="Font">
    <property name="Size">9pt</property>
    </property>
    <property name="Height">18</property>
    <property name="Left">265</property>
    <property name="Name">cbShowCanceledInvoices</property>
    <property name="ParentFont">0</property>
    <property name="Width">299</property>
    <property name="jsOnChange">cbShowCanceledInvoicesJSChange</property>
  </object>
  <object class="JTToolBar" name="btnPayments" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:13:"JTToolButton1";a:3:{i:0;s:13:"JTToolButton1";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnPayments</property>
    <property name="SiteTheme"></property>
    <property name="Top">55</property>
    <property name="Width">680</property>
    <property name="OnClick">btnPaymentsClick</property>
    <property name="jsOnClick">btnPaymentsJSClick</property>
  </object>
</object>
?>
