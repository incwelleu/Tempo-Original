<?php
<object class="invoice" name="invoice" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Invoice</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">411</property>
  <property name="IsMaster">0</property>
  <property name="Name">invoice</property>
  <property name="UseAjax">1</property>
  <property name="Width">685</property>
  <property name="OnCreate">invoiceCreate</property>
  <property name="jsOnLoad">invoiceJSLoad</property>
  <object class="JTDivWindow" name="winWorkCompleted" >
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
    <property name="Caption">Work completed</property>
    <property name="Height">130</property>
    <property name="Left">12</property>
    <property name="Name">winWorkCompleted</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">184</property>
    <property name="Width">300</property>
    <property name="OnShow">winWorkCompletedShow</property>
    <object class="JTLabel" name="lbWork_completed_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Work completed date</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">13</property>
      <property name="Name">lbWork_completed_dt</property>
      <property name="SiteTheme"></property>
      <property name="Top">62</property>
      <property name="Width">139</property>
    </object>
    <object class="CheckBox" name="work_completed_yn" >
      <property name="Caption">Work completed?</property>
      <property name="Height">21</property>
      <property name="Left">9</property>
      <property name="Name">work_completed_yn</property>
      <property name="Top">32</property>
      <property name="Width">121</property>
    </object>
    <object class="JTDatePicker" name="work_completed_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">76</property>
      <property name="Name">work_completed_dt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">59</property>
      <property name="Width">120</property>
    </object>
    <object class="Button" name="btnSaveWorkCompleted" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">211</property>
      <property name="Name">btnSaveWorkCompleted</property>
      <property name="TabOrder">6</property>
      <property name="Top">91</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveWorkCompletedClick</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winProcess" >
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="BorderIcons">
    <property name="Close">0</property>
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="Caption">winProcess</property>
    <property name="Height">165</property>
    <property name="Left">83</property>
    <property name="Name">winProcess</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">176</property>
    <property name="Width">333</property>
  </object>
  <object class="JTPlatinumGrid" name="gridInvoice" >
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
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsInvoice</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="Visible">0</property>
    </property>
    <property name="Height">323</property>
    <property name="KeyField">line_item_id</property>
    <property name="Name">gridInvoice</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">200</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">78</property>
    <property name="Width">680</property>
    <property name="OnCustomEditorGenerate">gridInvoiceCustomEditorGenerate</property>
    <property name="OnCustomFieldGenerate">gridInvoiceCustomFieldGenerate</property>
    <property name="OnInsert">gridInvoiceUpdate</property>
    <property name="OnRowData">gridInvoiceRowData</property>
    <property name="OnSQL">gridInvoiceSQL</property>
    <property name="OnShow">gridInvoiceShow</property>
    <property name="OnSummaryData">gridInvoiceSummaryData</property>
    <property name="OnUpdate">gridInvoiceUpdate</property>
    <property name="jsOnRowEdited">gridInvoiceJSRowEdited</property>
    <property name="jsOnRowEditing">gridInvoiceJSRowEditing</property>
    <property name="jsOnRowInserted">gridInvoiceJSRowEdited</property>
    <property name="jsOnSelect">gridInvoiceJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winInvoice" >
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="BorderIcons">
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="Caption">Invoice</property>
    <property name="Height">157</property>
    <property name="Left">133</property>
    <property name="Name">winInvoice</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">127</property>
    <property name="Width">347</property>
    <property name="OnShow">winInvoiceShow</property>
    <object class="Button" name="btnCreateInvoice" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">262</property>
      <property name="Name">btnCreateInvoice</property>
      <property name="Top">116</property>
      <property name="Width">72</property>
      <property name="OnClick">btnCreateInvoiceClick</property>
    </object>
    <object class="JTLookupLabel" name="lbInvoice_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Invoice date</property>
      <property name="Database"></property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">16</property>
      <property name="Name">lbInvoice_dt</property>
      <property name="SiteTheme"></property>
      <property name="Top">79</property>
      <property name="Width">91</property>
    </object>
    <object class="JTDatePicker" name="invoice_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">115</property>
      <property name="Name">invoice_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">76</property>
      <property name="Width">123</property>
    </object>
    <object class="JTLabel" name="lbBilling_entity" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Billing entity</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">16</property>
      <property name="Name">lbBilling_entity</property>
      <property name="SiteTheme"></property>
      <property name="Top">46</property>
      <property name="Width">90</property>
    </object>
    <object class="ComboBox" name="cbBilling_entity" >
      <property name="Height">24</property>
      <property name="ItemIndex">1</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">115</property>
      <property name="Name">cbBilling_entity</property>
      <property name="Top">40</property>
      <property name="Width">219</property>
    </object>
  </object>
  <object class="JTTabControl" name="TabInvoice" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">33</property>
    <property name="Name">TabInvoice</property>
    <property name="SiteTheme"></property>
    <property name="TabIndex">0</property>
    <property name="Tabs">a:4:{i:0;a:3:{i:0;s:11:"JTTabSheet1";i:1;s:11:"JTTabSheet1";i:2;s:1:"1";}i:1;a:3:{i:0;s:11:"JTTabSheet2";i:1;s:11:"JTTabSheet2";i:2;s:1:"0";}i:2;a:3:{i:0;s:11:"JTTabSheet3";i:1;s:11:"JTTabSheet3";i:2;s:1:"1";}i:3;a:3:{i:0;s:11:"JTTabSheet4";i:1;s:11:"JTTabSheet4";i:2;s:1:"1";}}</property>
    <property name="Top">20</property>
    <property name="Width">680</property>
    <property name="jsOnChange">TabInvoiceJSChange</property>
  </object>
  <object class="JTToolBar" name="btnInvoices" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnInvoices</property>
    <property name="SiteTheme"></property>
    <property name="Top">50</property>
    <property name="Width">680</property>
    <property name="OnClick">btnInvoicesClick</property>
    <property name="jsOnClick">btnInvoicesJSClick</property>
  </object>
  <object class="HiddenField" name="active_tab" >
    <property name="Height">18</property>
    <property name="Left">360</property>
    <property name="Name">active_tab</property>
    <property name="Top">408</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">112</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">408</property>
    <property name="Width">200</property>
  </object>
  <object class="CheckBox" name="cbIncludeServicesEnded" >
    <property name="Caption">Include services ended</property>
    <property name="Font">
    <property name="Size">9pt</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">320</property>
    <property name="Name">cbIncludeServicesEnded</property>
    <property name="ParentFont">0</property>
    <property name="Width">346</property>
    <property name="jsOnChange">cbIncludeServicesEndedJSChange</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">624</property>
        <property name="Top">288</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlInvoice" >
        <property name="Left">64</property>
        <property name="Top">286</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:23:"Select * from line_item";i:1;s:22:"Where status_cd = '99'";}</property>
    <property name="TableName">line_item</property>
  </object>
  <object class="Datasource" name="dsInvoice" >
        <property name="Left">64</property>
        <property name="Top">308</property>
    <property name="DataSet">sqlInvoice</property>
    <property name="Name">dsInvoice</property>
  </object>
  <object class="Query" name="sqlCompany" >
        <property name="Left">160</property>
        <property name="Top">286</property>
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
        <property name="Left">160</property>
        <property name="Top">305</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">440</property>
        <property name="Top">336</property>
    <property name="Images">a:8:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:28:"images/button/view_16x16.png";s:1:"8";s:27:"images/button/xls_16x16.gif";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlProvider_contact" >
        <property name="Left">520</property>
        <property name="Top">278</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlProvider_contact</property>
    <property name="OrderField">provider_contact_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:53:"Select vw_provider_contact.* from vw_provider_contact";i:1;s:21:"Where status_cd = 'a'";}</property>
    <property name="TableName">provider_contact</property>
  </object>
  <object class="Datasource" name="dsProvider_contact" >
        <property name="Left">520</property>
        <property name="Top">294</property>
    <property name="DataSet">sqlProvider_contact</property>
    <property name="Name">dsProvider_contact</property>
  </object>
</object>
?>
