<?php
<object class="service_agreement" name="service_agreement" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Service agreement</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">457</property>
  <property name="IsMaster">0</property>
  <property name="Name">service_agreement</property>
  <property name="UseAjax">1</property>
  <property name="Width">727</property>
  <property name="OnCreate">service_agreementCreate</property>
  <property name="OnShowHeader">service_agreementShowHeader</property>
  <object class="JTPlatinumGrid" name="gridService_agreement" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
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
    <property name="Datasource">dsService_agreement</property>
    <property name="DetailValue">service_agreement_id</property>
    <property name="DetailView">
    <property name="DetailField">service_agreement_id</property>
    <property name="DetailGrid">gridService_agreement_paid</property>
    <property name="Enabled">1</property>
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">403</property>
    <property name="KeyField">service_agreement_id</property>
    <property name="Name">gridService_agreement</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">200</property>
    <property name="ShowTopPager">0</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">created_dt</property>
    <property name="Top">51</property>
    <property name="Width">720</property>
    <property name="OnRowData">gridService_agreementRowData</property>
    <property name="OnSQL">gridService_agreementSQL</property>
    <property name="OnSummaryData">gridService_agreementSummaryData</property>
    <property name="jsOnSelect">gridService_agreementJSSelect</property>
  </object>
  <object class="JTPlatinumGrid" name="gridService_agreement_paid" >
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
    <property name="Datasource">dsService_agreement_paid</property>
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
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">133</property>
    <property name="KeyField">invoice_issued_paid_id</property>
    <property name="Left">118</property>
    <property name="Name">gridService_agreement_paid</property>
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
    <property name="Top">457</property>
    <property name="Visible">0</property>
    <property name="Width">491</property>
    <property name="OnDelete">gridService_agreement_paidDelete</property>
    <property name="OnSQL">gridService_agreement_paidSQL</property>
    <property name="OnShow">gridService_agreement_paidShow</property>
    <property name="OnUpdate">gridService_agreement_paidUpdate</property>
    <property name="jsOnRowDeleting">gridService_agreement_paidJSRowDeleting</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">476</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="service_agreement_id" >
    <property name="Height">18</property>
    <property name="Left">280</property>
    <property name="Name">service_agreement_id</property>
    <property name="Top">476</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="status_cd" >
    <property name="Height">18</property>
    <property name="Left">512</property>
    <property name="Name">status_cd</property>
    <property name="Top">476</property>
    <property name="Width">200</property>
  </object>
  <object class="CheckBox" name="cbShowInvoicedCanceled" >
    <property name="Caption">Show Invoiced and Canceled</property>
    <property name="Font">
    <property name="Size">9pt</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">256</property>
    <property name="Name">cbShowInvoicedCanceled</property>
    <property name="ParentFont">0</property>
    <property name="Width">321</property>
    <property name="jsOnClick">cbShowInvoicedCanceledJSClick</property>
  </object>
  <object class="JTDivWindow" name="winProcess" >
    <property name="ActiveLayer">Paid</property>
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
    <property name="Caption">Copy link</property>
    <property name="Height">180</property>
    <property name="Layer">Paid</property>
    <property name="Left">44</property>
    <property name="Name">winProcess</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">265</property>
    <property name="Width">616</property>
    <property name="jsOnShow">winProcessJSShow</property>
    <object class="JTAdvancedEdit" name="paid_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">153</property>
      <property name="MaxLength">15</property>
      <property name="Name">paid_amt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="TabOrder">1</property>
      <property name="Top">32</property>
      <property name="Width">100</property>
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
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_amt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">35</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLabel" name="lbCopylink" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Copy this link</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">CopyLink</property>
      <property name="Left">17</property>
      <property name="Name">lbCopylink</property>
      <property name="SiteTheme"></property>
      <property name="Top">48</property>
      <property name="Width">75</property>
    </object>
    <object class="JTAdvancedEdit" name="copy_link" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">CopyLink</property>
      <property name="Left">122</property>
      <property name="Name">copy_link</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="Top">45</property>
      <property name="Width">491</property>
    </object>
    <object class="JTDatePicker" name="paid_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Layer">Paid</property>
      <property name="Left">153</property>
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
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_dt</property>
      <property name="Top">65</property>
      <property name="Width">115</property>
    </object>
    <object class="Label" name="lbPaid_by" >
      <property name="Caption">Paid by</property>
      <property name="Height">13</property>
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_by</property>
      <property name="Top">93</property>
      <property name="Width">115</property>
    </object>
    <object class="JTAdvancedEdit" name="paid_by" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">Paid</property>
      <property name="Left">153</property>
      <property name="Name">paid_by</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">3</property>
      <property name="Top">87</property>
      <property name="Width">379</property>
    </object>
    <object class="Button" name="btnSavePayment" >
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Layer">Paid</property>
      <property name="Left">458</property>
      <property name="Name">btnSavePayment</property>
      <property name="Top">139</property>
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
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">122</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">153</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dsPayment_method_billing</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">116</property>
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
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbBank_account</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">146</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="bank_account_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">153</property>
      <property name="LookupDataField">bank_account_id</property>
      <property name="LookupDataSource">dsCompany_bank_account</property>
      <property name="LookupField">bank_account_name</property>
      <property name="Name">bank_account_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">5</property>
      <property name="Top">143</property>
      <property name="Width">200</property>
    </object>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">176</property>
        <property name="Top">544</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlService_agreement" >
        <property name="Left">54</property>
        <property name="Top">459</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService_agreement</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:4:{i:0;s:76:"SELECT service_agreement.*, vw_provider_contact.username, company.short_name";i:1;s:22:"FROM service_agreement";i:2;s:115:"    LEFT JOIN vw_provider_contact ON service_agreement.created_by_user_id = vw_provider_contact.provider_contact_id";i:3;s:122:"    LEFT JOIN (Select company_id, short_name from company) AS company ON service_agreement.company_id = company.company_id";}</property>
    <property name="TableName">service_agreement</property>
  </object>
  <object class="Datasource" name="dsService_agreement" >
        <property name="Left">54</property>
        <property name="Top">472</property>
    <property name="DataSet">sqlService_agreement</property>
    <property name="Name">dsService_agreement</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">648</property>
        <property name="Top">176</property>
    <property name="Images">a:9:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:32:"images/button/calendar_16x16.png";s:1:"9";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">174</property>
        <property name="Top">458</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayment_method</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:45:"SELECT payment_method_id, payment_method_name";i:1;s:19:"FROM payment_method";i:2;s:0:"";}</property>
    <property name="TableName">payment_method</property>
  </object>
  <object class="Datasource" name="dsPayment_method" >
        <property name="Left">174</property>
        <property name="Top">474</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
  <object class="Query" name="sqlCompany_bank_account" >
        <property name="Left">310</property>
        <property name="Top">458</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_bank_account</property>
    <property name="Order">desc</property>
    <property name="OrderField">is_primary_account_yn</property>
    <property name="Params">a:1:{i:0;s:1:"0";}</property>
    <property name="SQL">a:3:{i:0;s:8:"SELECT *";i:1;s:25:"FROM company_bank_account";i:2;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_bank_account</property>
  </object>
  <object class="Datasource" name="dsCompany_bank_account" >
        <property name="Left">310</property>
        <property name="Top">474</property>
    <property name="DataSet">sqlCompany_bank_account</property>
    <property name="Name">dsCompany_bank_account</property>
  </object>
  <object class="Query" name="sqlService_agreement_paid" >
        <property name="Left">58</property>
        <property name="Top">550</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService_agreement_paid</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:33:"Select * from invoice_issued_paid";i:1;s:18:"Where paid_amt = 1";}</property>
    <property name="TableName">invoice_issued_paid</property>
  </object>
  <object class="Datasource" name="dsService_agreement_paid" >
        <property name="Left">58</property>
        <property name="Top">560</property>
    <property name="DataSet">sqlService_agreement_paid</property>
    <property name="Name">dsService_agreement_paid</property>
  </object>
  <object class="JTToolBar" name="btnServiceAgreement" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnServiceAgreement</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">720</property>
    <property name="OnClick">btnServiceAgreementClick</property>
    <property name="jsOnClick">btnServiceAgreementJSClick</property>
  </object>
  <object class="HiddenField" name="billing_entity_id" >
    <property name="Height">18</property>
    <property name="Left">512</property>
    <property name="Name">billing_entity_id</property>
    <property name="Top">460</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="Query" name="sqlPayment_method_billing" >
        <property name="Left">646</property>
        <property name="Top">458</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayment_method_billing</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:45:"SELECT payment_method_id, payment_method_name";i:1;s:19:"FROM payment_method";i:2;s:0:"";}</property>
    <property name="TableName">payment_method</property>
  </object>
  <object class="Datasource" name="dsPayment_method_billing" >
        <property name="Left">646</property>
        <property name="Top">474</property>
    <property name="DataSet">sqlPayment_method_billing</property>
    <property name="Name">dsPayment_method_billing</property>
  </object>
</object>
?>
