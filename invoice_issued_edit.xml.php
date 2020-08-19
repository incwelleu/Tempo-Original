<?php
<object class="invoice_issued_edit" name="invoice_issued_edit" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Invoice issued</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">667</property>
  <property name="IsMaster">0</property>
  <property name="Name">invoice_issued_edit</property>
  <property name="ShowHint">1</property>
  <property name="UseAjax">1</property>
  <property name="Width">800</property>
  <property name="OnCreate">invoice_issued_editCreate</property>
  <object class="JTPlatinumGrid" name="gridLine_item" >
    <property name="Anchors">
    <property name="Relative">0</property>
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
    <property name="Height">283</property>
    <property name="KeyField">line_item_id</property>
    <property name="Left">7</property>
    <property name="Name">gridLine_item</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">3</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">130</property>
    <property name="Width">779</property>
    <property name="OnCustomCommand">gridLine_itemCustomCommand</property>
    <property name="OnCustomEditorGenerate">gridLine_itemCustomEditorGenerate</property>
    <property name="OnDelete">gridLine_itemDelete</property>
    <property name="OnInsert">gridLine_itemInsert</property>
    <property name="OnShow">gridLine_itemShow</property>
    <property name="OnSummaryData">gridLine_itemSummaryData</property>
    <property name="OnUpdate">gridLine_itemInsert</property>
    <property name="jsOnCustomCommand">gridLine_itemJSCustomCommand</property>
    <property name="jsOnRowEdited">gridLine_itemJSRowEdited</property>
    <property name="jsOnRowEditing">gridLine_itemJSRowEditing</property>
    <property name="jsOnRowInserted">gridLine_itemJSRowEdited</property>
  </object>
  <object class="Memo" name="notes" >
    <property name="Height">78</property>
    <property name="Left">7</property>
    <property name="Lines">a:0:{}</property>
    <property name="Name">notes</property>
    <property name="Top">577</property>
    <property name="Width">435</property>
  </object>
  <object class="JTLabel" name="lbInvoice_number" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">lbInvoice_number</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">467</property>
    <property name="Name">lbInvoice_number</property>
    <property name="SiteTheme"></property>
    <property name="Top">26</property>
    <property name="Width">95</property>
  </object>
  <object class="JTLabel" name="lbInvoice_dt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">lbInvoice_dt</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">467</property>
    <property name="Name">lbInvoice_dt</property>
    <property name="SiteTheme"></property>
    <property name="Top">53</property>
    <property name="Width">95</property>
  </object>
  <object class="Label" name="lbTax_ident" >
    <property name="Caption">Tax ID</property>
    <property name="Height">13</property>
    <property name="Left">7</property>
    <property name="Name">lbTax_ident</property>
    <property name="Top">56</property>
    <property name="Width">67</property>
  </object>
  <object class="JTAdvancedEdit" name="tax_ident" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">85</property>
    <property name="MaxLength">20</property>
    <property name="Name">tax_ident</property>
    <property name="SiteTheme"></property>
    <property name="Top">50</property>
    <property name="Width">147</property>
    <property name="jsOnChange">tax_identJSChange</property>
  </object>
  <object class="JTAdvancedEdit" name="client_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">85</property>
    <property name="MaxLength">200</property>
    <property name="Name">client_name</property>
    <property name="SiteTheme"></property>
    <property name="Top">76</property>
    <property name="Width">350</property>
  </object>
  <object class="JTLookupComboBox" name="company_client_id" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="DataField">company_client_id</property>
    <property name="DataSource">dsInvoice_issued</property>
    <property name="Height">24</property>
    <property name="Left">85</property>
    <property name="LookupDataField">company_client_id</property>
    <property name="LookupDataSource">dsCompany_client</property>
    <property name="LookupField">client_name</property>
    <property name="Name">company_client_id</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">350</property>
    <property name="jsOnChange">company_client_idJSChange</property>
  </object>
  <object class="Image" name="add_client" >
    <property name="Autosize">1</property>
    <property name="Border">0</property>
    <property name="Cursor">crPointer</property>
    <property name="Height">16</property>
    <property name="Hint">Add client</property>
    <property name="ImageSource">images/button/add_16x16.png</property>
    <property name="Left">62</property>
    <property name="Link"></property>
    <property name="LinkTarget"></property>
    <property name="Name">add_client</property>
    <property name="ParentShowHint">0</property>
    <property name="ShowHint">1</property>
    <property name="Top">27</property>
    <property name="Width">16</property>
  </object>
  <object class="Label" name="lbAddress" >
    <property name="Caption">Address</property>
    <property name="Height">13</property>
    <property name="Left">7</property>
    <property name="Name">lbAddress</property>
    <property name="Top">107</property>
    <property name="Width">67</property>
  </object>
  <object class="JTAdvancedEdit" name="address" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Enabled">0</property>
    <property name="Height">24</property>
    <property name="Left">85</property>
    <property name="MaxLength">20</property>
    <property name="Name">address</property>
    <property name="SiteTheme"></property>
    <property name="Top">101</property>
    <property name="Width">350</property>
  </object>
  <object class="JTAdvancedEdit" name="invoice_number" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="DataField">invoice_number</property>
    <property name="DataSource">dsInvoice_issued</property>
    <property name="Height">24</property>
    <property name="Left">567</property>
    <property name="MaxLength">30</property>
    <property name="Name">invoice_number</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">128</property>
  </object>
  <object class="JTDatePicker" name="invoice_dt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="DataField">invoice_dt</property>
    <property name="DataSource">dsInvoice_issued</property>
    <property name="Date"></property>
    <property name="Height">24</property>
    <property name="Left">567</property>
    <property name="Name">invoice_dt</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="Top">50</property>
    <property name="Width">128</property>
  </object>
  <object class="JTLabel" name="lbClient" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Client ID</property>
    <property name="Datasource"></property>
    <property name="Height">13</property>
    <property name="Left">7</property>
    <property name="Name">lbClient</property>
    <property name="SiteTheme"></property>
    <property name="Top">29</property>
    <property name="Width">51</property>
  </object>
  <object class="JTLabel" name="lbClient_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Client_name</property>
    <property name="Datasource"></property>
    <property name="Height">13</property>
    <property name="Left">7</property>
    <property name="Name">lbClient_name</property>
    <property name="SiteTheme"></property>
    <property name="Top">82</property>
    <property name="Width">67</property>
  </object>
  <object class="JTPlatinumGrid" name="gridSupplement" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CanRangeSelect">0</property>
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
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">131</property>
    <property name="KeyField">line_item_id</property>
    <property name="Left">7</property>
    <property name="Name">gridSupplement</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    <property name="VisiblePageCount">3</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">420</property>
    <property name="Width">435</property>
    <property name="OnCustomEditorGenerate">gridLine_itemCustomEditorGenerate</property>
    <property name="OnDelete">gridLine_itemDelete</property>
    <property name="OnInsert">gridLine_itemInsert</property>
    <property name="OnShow">gridLine_itemShow</property>
    <property name="OnSummaryData">gridLine_itemSummaryData</property>
    <property name="OnUpdate">gridLine_itemInsert</property>
    <property name="jsOnCustomCommand">gridLine_itemJSCustomCommand</property>
    <property name="jsOnRowEdited">gridLine_itemJSRowEdited</property>
    <property name="jsOnRowEditing">gridSupplementJSRowEditing</property>
    <property name="jsOnRowInserted">gridLine_itemJSRowEdited</property>
  </object>
  <object class="JTPlatinumGrid" name="gridInvoice_issued_tax" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CanResizeCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:0:{}</property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsInvoice_issued_tax</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">91</property>
    <property name="KeyField">invoice_issued_tax_id</property>
    <property name="Left">461</property>
    <property name="Name">gridInvoice_issued_tax</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
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
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="Top">420</property>
    <property name="UTF8">0</property>
    <property name="Width">326</property>
    <property name="OnSummaryData">gridLine_itemSummaryData</property>
  </object>
  <object class="Button" name="btnSave" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">btnSave</property>
    <property name="Height">25</property>
    <property name="Left">631</property>
    <property name="Name">btnSave</property>
    <property name="Top">630</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveClick</property>
    <property name="jsOnClick">btnSaveJSClick</property>
  </object>
  <object class="Button" name="btnClose" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">btnClose</property>
    <property name="Height">25</property>
    <property name="Left">714</property>
    <property name="Name">btnClose</property>
    <property name="Top">630</property>
    <property name="Width">75</property>
    <property name="OnClick">btnCloseClick</property>
  </object>
  <object class="JTLabel" name="lbNotes" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">lbNotes</property>
    <property name="Datasource"></property>
    <property name="Height">13</property>
    <property name="Left">7</property>
    <property name="Name">lbNotes</property>
    <property name="SiteTheme"></property>
    <property name="Top">559</property>
    <property name="Width">100</property>
  </object>
  <object class="HiddenField" name="invoice_issued_id" >
    <property name="Height">18</property>
    <property name="Name">invoice_issued_id</property>
    <property name="Top">648</property>
    <property name="Value">0</property>
    <property name="Width">115</property>
  </object>
  <object class="Label" name="lbTax_type" >
    <property name="Caption">Tax type</property>
    <property name="Height">13</property>
    <property name="Left">467</property>
    <property name="Name">lbTax_type</property>
    <property name="Top">106</property>
    <property name="Width">95</property>
  </object>
  <object class="JTLabel" name="lbPayment_method" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Payment method</property>
    <property name="Datasource"></property>
    <property name="Height">15</property>
    <property name="Left">467</property>
    <property name="Name">lbPayment_method</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">81</property>
    <property name="Width">95</property>
  </object>
  <object class="JTLookupComboBox" name="payment_method_id" >
    <property name="AllowEmpty">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="DataField">payment_method_id</property>
    <property name="DataSource">dsInvoice_issued</property>
    <property name="Height">21</property>
    <property name="Left">567</property>
    <property name="LookupDataField">payment_method_id</property>
    <property name="LookupDataSource">dsPayment_method</property>
    <property name="LookupField">payment_method_name</property>
    <property name="Name">payment_method_id</property>
    <property name="SelectedValue">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="TabOrder">20</property>
    <property name="Top">78</property>
    <property name="Width">220</property>
  </object>
  <object class="JTLookupComboBox" name="tax_type_key_id" >
    <property name="AllowEmpty">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="DataField">tax_type_key_id</property>
    <property name="DataSource">dsInvoice_issued</property>
    <property name="Height">21</property>
    <property name="Left">567</property>
    <property name="LookupDataField">tax_type_key_id</property>
    <property name="LookupDataSource">dsTax_type_key</property>
    <property name="LookupField">tax_type_name</property>
    <property name="Name">tax_type_key_id</property>
    <property name="SelectedValue">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="TabOrder">20</property>
    <property name="Top">103</property>
    <property name="Width">220</property>
    <property name="jsOnChange">tax_type_key_idJSChange</property>
  </object>
  <object class="JTLabel" name="lbTotal_amt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">lbTotal_amty</property>
    <property name="Datasource"></property>
    <property name="Height">19</property>
    <property name="Left">461</property>
    <property name="Name">lbTotal_amt</property>
    <property name="SiteTheme"></property>
    <property name="TextClass">fsLarge</property>
    <property name="Top">522</property>
    <property name="Width">100</property>
  </object>
  <object class="JTAdvancedEdit" name="total_amt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">27</property>
    <property name="Left">637</property>
    <property name="Name">total_amt</property>
    <property name="ReadOnly">1</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Align">taRight</property>
    <property name="Size">16px</property>
    </property>
    <property name="Top">518</property>
    <property name="Width">150</property>
  </object>
  <object class="HiddenField" name="supplement_amt" >
    <property name="Height">18</property>
    <property name="Left">328</property>
    <property name="Name">supplement_amt</property>
    <property name="Top">648</property>
    <property name="Width">107</property>
  </object>
  <object class="HiddenField" name="subtotal_amt" >
    <property name="Height">18</property>
    <property name="Left">119</property>
    <property name="Name">subtotal_amt</property>
    <property name="Top">648</property>
    <property name="Value">0</property>
    <property name="Width">99</property>
  </object>
  <object class="HiddenField" name="tax_amt" >
    <property name="Height">18</property>
    <property name="Left">224</property>
    <property name="Name">tax_amt</property>
    <property name="Top">648</property>
    <property name="Width">99</property>
  </object>
  <object class="Datasource" name="dsService" >
        <property name="Left">738</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlService</property>
    <property name="Name">dsService</property>
  </object>
  <object class="Datasource" name="dsTax_type_key" >
        <property name="Left">654</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlTax_type_key</property>
    <property name="Name">dsTax_type_key</property>
  </object>
  <object class="Datasource" name="dsCompany_client" >
        <property name="Left">544</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlCompany_client</property>
    <property name="Name">dsCompany_client</property>
  </object>
  <object class="Datasource" name="dsTax_rate" >
        <property name="Left">447</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlTax_rate</property>
    <property name="Name">dsTax_rate</property>
  </object>
  <object class="Datasource" name="dsSupplement" >
        <property name="Left">335</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlSupplement</property>
    <property name="Name">dsSupplement</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued_tax" >
        <property name="Left">237</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlInvoice_issued_tax</property>
    <property name="Name">dsInvoice_issued_tax</property>
  </object>
  <object class="Datasource" name="dsLine_item" >
        <property name="Left">135</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlLine_item</property>
    <property name="Name">dsLine_item</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued" >
        <property name="Left">45</property>
        <property name="Top">340</property>
    <property name="DataSet">sqlInvoice_issued</property>
    <property name="Name">dsInvoice_issued</property>
  </object>
  <object class="Query" name="sqlService" >
        <property name="Left">738</property>
        <property name="Top">324</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService</property>
    <property name="OrderField">service_category_name, description</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:7:{i:0;s:90:"SELECT service.service_id, service.description_en, service_category.service_category_name,";i:1;s:47:"       concat( service.description_en, '  |  ',";i:2;s:112:"                    FORMAT(IFNull(service.price_amt, 0), 2), '  |   ', IFNULL(service.notes, "")) AS description";i:3;s:13:"FROM service ";i:4;s:96:"LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id";i:5;s:0:"";i:6;s:0:"";}</property>
    <property name="TableName">service</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">654</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_type_key</property>
    <property name="OrderField">tax_type_key_id</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:26:"SELECT * FROM tax_type_key";i:1;s:41:"WHERE type_tax_cd = 1 AND country_id = ? ";}</property>
    <property name="TableName">tax_type_key</property>
  </object>
  <object class="Query" name="sqlCompany_client" >
        <property name="Left">544</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_client</property>
    <property name="OrderField">client_name</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:2:{i:0;s:28:"SELECT * FROM company_client";i:1;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Query" name="sqlTax_rate" >
        <property name="Left">447</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_rate</property>
    <property name="OrderField">tax_regime_id, rate_no</property>
    <property name="Params">a:1:{i:0;s:13:"tax_regime_id";}</property>
    <property name="SQL">a:3:{i:0;s:33:"Select * from vw_tax_rate_country";i:1;s:23:"Where tax_regime_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">tax_rate</property>
  </object>
  <object class="Query" name="sqlSupplement" >
        <property name="Left">335</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlSupplement</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:23:"Select * from line_item";i:1;s:27:"Where invoice_issued_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">line_item</property>
  </object>
  <object class="Query" name="sqlInvoice_issued_tax" >
        <property name="Left">237</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued_tax</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:32:"Select * from invoice_issued_tax";}</property>
    <property name="TableName">invoice_issued_tax</property>
  </object>
  <object class="Query" name="sqlLine_item" >
        <property name="Left">135</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlLine_item</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:23:"Select * from line_item";i:1;s:27:"Where invoice_issued_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">line_item</property>
  </object>
  <object class="Query" name="sqlInvoice_issued" >
        <property name="Left">45</property>
        <property name="Top">324</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:28:"Select * from invoice_issued";}</property>
    <property name="TableName">invoice_issued</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">743</property>
        <property name="Top">10</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="JTLabel" name="lbPaid" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption"><![CDATA[Provisión de fondo]]></property>
    <property name="Datasource"></property>
    <property name="Height">19</property>
    <property name="Left">461</property>
    <property name="Name">lbPaid</property>
    <property name="SiteTheme"></property>
    <property name="TextClass">fsLarge</property>
    <property name="Top">553</property>
    <property name="Width">171</property>
  </object>
  <object class="JTAdvancedEdit" name="paid_amt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">27</property>
    <property name="Left">637</property>
    <property name="Name">paid_amt</property>
    <property name="ReadOnly">1</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Align">taRight</property>
    <property name="Size">16px</property>
    </property>
    <property name="Top">549</property>
    <property name="Width">150</property>
  </object>
  <object class="JTLabel" name="lbPay" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Total a pagar</property>
    <property name="Datasource"></property>
    <property name="Height">19</property>
    <property name="Left">461</property>
    <property name="Name">lbPay</property>
    <property name="SiteTheme"></property>
    <property name="TextClass">fsLarge</property>
    <property name="Top">584</property>
    <property name="Width">100</property>
  </object>
  <object class="JTAdvancedEdit" name="pay_amt" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">27</property>
    <property name="Left">637</property>
    <property name="Name">pay_amt</property>
    <property name="ReadOnly">1</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Align">taRight</property>
    <property name="Size">16px</property>
    </property>
    <property name="Top">580</property>
    <property name="Width">150</property>
  </object>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">121</property>
        <property name="Top">186</property>
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
        <property name="Left">121</property>
        <property name="Top">202</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
</object>
?>
