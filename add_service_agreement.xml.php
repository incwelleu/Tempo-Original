<?php
<object class="add_service_agreement" name="add_service_agreement" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Details service agreeement</property>
  <property name="DocType">dtHTML_4_01_Frameset</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">696</property>
  <property name="IsMaster">0</property>
  <property name="Name">add_service_agreement</property>
  <property name="UseAjax">1</property>
  <property name="Width">781</property>
  <property name="OnCreate">add_service_agreementCreate</property>
  <property name="OnShowHeader">add_service_agreementShowHeader</property>
  <object class="CheckListBox" name="proposal_id" >
    <property name="BorderStyle">bsNone</property>
    <property name="Checked">a:3:{i:1;s:4:"Hola";i:2;s:5:"Hello";i:3;s:4:"Ciao";}</property>
    <property name="Columns">2</property>
    <property name="Header">a:0:{}</property>
    <property name="Height">187</property>
    <property name="Items">a:3:{i:0;s:4:"Hola";i:1;s:5:"Hello";i:2;s:3:"Cia";}</property>
    <property name="Left">3</property>
    <property name="Name">proposal_id</property>
    <property name="Top">473</property>
    <property name="Width">654</property>
  </object>
  <object class="JTLabel" name="lbFirst_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">First name</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">3</property>
    <property name="Name">lbFirst_name</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">32</property>
    <property name="Width">58</property>
  </object>
  <object class="JTAdvancedEdit" name="first_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">75</property>
    <property name="MaxLength">100</property>
    <property name="Name">first_name</property>
    <property name="SiteTheme"></property>
    <property name="TabOrder">1</property>
    <property name="Top">29</property>
    <property name="Width">200</property>
  </object>
  <object class="JTAdvancedEdit" name="last_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">403</property>
    <property name="MaxLength">100</property>
    <property name="Name">last_name</property>
    <property name="SiteTheme"></property>
    <property name="TabOrder">2</property>
    <property name="Top">29</property>
    <property name="Width">200</property>
  </object>
  <object class="JTLabel" name="lbLast_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Last name</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">321</property>
    <property name="Name">lbLast_name</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">32</property>
    <property name="Width">67</property>
  </object>
  <object class="JTLabel" name="lbEmail" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Email</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">3</property>
    <property name="Name">lbEmail</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">57</property>
    <property name="Width">58</property>
  </object>
  <object class="JTAdvancedEdit" name="email" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">75</property>
    <property name="MaxLength">255</property>
    <property name="Name">email</property>
    <property name="SiteTheme"></property>
    <property name="TabOrder">3</property>
    <property name="Top">54</property>
    <property name="Width">528</property>
  </object>
  <object class="Memo" name="notes_service_agreement" >
    <property name="Height">99</property>
    <property name="Left">75</property>
    <property name="Lines">a:0:{}</property>
    <property name="Name">notes_service_agreement</property>
    <property name="TabOrder">4</property>
    <property name="Top">82</property>
    <property name="Width">675</property>
  </object>
  <object class="JTLabel" name="lbNotes" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Notes</property>
    <property name="Datasource"></property>
    <property name="Height">14</property>
    <property name="Left">3</property>
    <property name="Name">lbNotes</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">82</property>
    <property name="Width">67</property>
  </object>
  <object class="JTLabel" name="lbServices" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Services</property>
    <property name="Datasource"></property>
    <property name="Height">14</property>
    <property name="Left">3</property>
    <property name="Name">lbServices</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">215</property>
    <property name="Width">67</property>
  </object>
  <object class="Button" name="btnSave" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">619</property>
    <property name="Name">btnSave</property>
    <property name="TabOrder">7</property>
    <property name="Top">436</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveClick</property>
    <property name="jsOnClick">btnSaveJSClick</property>
  </object>
  <object class="Button" name="btnClose" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Cancel</property>
    <property name="Height">25</property>
    <property name="Left">699</property>
    <property name="Name">btnClose</property>
    <property name="TabOrder">8</property>
    <property name="Top">436</property>
    <property name="Width">75</property>
    <property name="OnClick">btnCloseClick</property>
  </object>
  <object class="HiddenField" name="service_agreement_id" >
    <property name="Height">18</property>
    <property name="Left">374</property>
    <property name="Name">service_agreement_id</property>
    <property name="Top">520</property>
    <property name="Width">200</property>
  </object>
  <object class="Label" name="lbTitle" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">Detail service agreement</property>
    <property name="Font">
    <property name="Color">#0c6478</property>
    <property name="Family">Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif</property>
    <property name="Size">15px</property>
    <property name="Weight">normal</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">3</property>
    <property name="Name">lbTitle</property>
    <property name="ParentFont">0</property>
    <property name="Width">315</property>
  </object>
  <object class="JTLabel" name="lbProposal" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Select proposals</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">351</property>
    <property name="Name">lbProposal</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">440</property>
    <property name="Width">107</property>
  </object>
  <object class="Image" name="imSelect_contact" >
    <property name="Autosize">1</property>
    <property name="Border">0</property>
    <property name="Cursor">crPointer</property>
    <property name="Height">16</property>
    <property name="Hint">Select contact</property>
    <property name="ImageSource">images/button/select_16x16.gif</property>
    <property name="Left">608</property>
    <property name="Link"></property>
    <property name="LinkTarget"></property>
    <property name="Name">imSelect_contact</property>
    <property name="ParentShowHint">0</property>
    <property name="ShowHint">1</property>
    <property name="Stretch">1</property>
    <property name="Top">3</property>
    <property name="Width">17</property>
    <property name="jsOnClick">imSelect_contactJSClick</property>
  </object>
  <object class="HiddenField" name="window_hide" >
    <property name="Height">18</property>
    <property name="Left">276</property>
    <property name="Name">window_hide</property>
    <property name="Top">520</property>
    <property name="Value">0</property>
    <property name="Width">91</property>
  </object>
  <object class="JTAdvancedEdit" name="short_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">403</property>
    <property name="MaxLength">100</property>
    <property name="Name">short_name</property>
    <property name="ReadOnly">1</property>
    <property name="SiteTheme"></property>
    <property name="TabStop">0</property>
    <property name="Width">200</property>
  </object>
  <object class="JTLabel" name="lbCompany" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Company</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">321</property>
    <property name="Name">lbCompany</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">3</property>
    <property name="Width">67</property>
  </object>
  <object class="JTDivWindow" name="winSelect_contact" >
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
    <property name="Caption">Select contact</property>
    <property name="Height">350</property>
    <property name="Left">403</property>
    <property name="Name">winSelect_contact</property>
    <property name="SiteTheme"></property>
    <property name="Top">18</property>
    <property name="Width">605</property>
    <object class="JTPlatinumGrid" name="gridContact" >
      <property name="AllowDelete">0</property>
      <property name="AllowInsert">0</property>
      <property name="AllowUpdate">0</property>
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
      <property name="ShowInsertRecord">0</property>
      <property name="ShowPrint">0</property>
      <property name="ShowRefresh">0</property>
      <property name="ShowTopCommandBar">0</property>
      </property>
      <property name="Datasource">dsContact</property>
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
      <property name="Height">327</property>
      <property name="KeyField">contact_id</property>
      <property name="Name">gridContact</property>
      <property name="OddRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Pager">
      <property name="RowsPerPage">10000</property>
      <property name="ShowBottomPager">0</property>
      <property name="ShowPageInfo">0</property>
      <property name="ShowRecordCount">0</property>
      <property name="ShowTopPager">0</property>
      <property name="VisiblePageCount">5</property>
      </property>
      <property name="ReadOnly">1</property>
      <property name="RowDataStyles">a:0:{}</property>
      <property name="RowSelect">1</property>
      <property name="SelectedRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="SiteTheme"></property>
      <property name="SortBy">short_name</property>
      <property name="Top">23</property>
      <property name="Width">605</property>
      <property name="jsOnCommand">gridContactJSCommand</property>
    </object>
    <object class="HiddenField" name="company_id" >
      <property name="Height">18</property>
      <property name="Left">208</property>
      <property name="Name">company_id</property>
      <property name="Top">198</property>
      <property name="Value">0</property>
      <property name="Width">117</property>
    </object>
    <object class="HiddenField" name="contact_id" >
      <property name="Height">18</property>
      <property name="Left">208</property>
      <property name="Name">contact_id</property>
      <property name="Top">222</property>
      <property name="Value">0</property>
      <property name="Width">117</property>
    </object>
  </object>
  <object class="ComboBox" name="cbLanguage" >
    <property name="Height">21</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">456</property>
    <property name="Name">cbLanguage</property>
    <property name="Top">439</property>
    <property name="Width">147</property>
    <property name="OnChange">cbLanguageChange</property>
    <property name="jsOnChange">cbLanguageJSChange</property>
  </object>
  <object class="JTPlatinumGrid" name="gridLine_item" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CanResizeCols">0</property>
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
    <property name="Height">192</property>
    <property name="KeyField">line_item_id</property>
    <property name="Left">3</property>
    <property name="Name">gridLine_item</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">50</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="Top">233</property>
    <property name="Width">770</property>
    <property name="OnCustomEditorGenerate">gridLine_itemCustomEditorGenerate</property>
    <property name="OnDelete">gridLine_itemDelete</property>
    <property name="OnInsert">gridLine_itemInsert</property>
    <property name="OnSummaryData">gridLine_itemSummaryData</property>
    <property name="OnUpdate">gridLine_itemInsert</property>
    <property name="jsOnCustomCommand">gridLine_itemJSCustomCommand</property>
    <property name="jsOnRowEditing">gridLine_itemJSRowEditing</property>
  </object>
  <object class="JTLabel" name="lbBilling_entity" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Billing entity</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">3</property>
    <property name="Name">lbBilling_entity</property>
    <property name="SiteTheme"></property>
    <property name="Top">442</property>
    <property name="Width">67</property>
  </object>
  <object class="ComboBox" name="cbBilling_entity" >
    <property name="Height">21</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">71</property>
    <property name="Name">cbBilling_entity</property>
    <property name="Top">439</property>
    <property name="Width">267</property>
    <property name="OnChange">cbLanguageChange</property>
    <property name="jsOnChange">cbLanguageJSChange</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">34</property>
        <property name="Top">327</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlLine_item" >
        <property name="Left">163</property>
        <property name="Top">296</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlLine_item</property>
    <property name="Params">a:1:{i:0;s:20:"service_agreement_id";}</property>
    <property name="SQL">a:0:{}</property>
    <property name="TableName">line_item</property>
  </object>
  <object class="Datasource" name="dsLine_item" >
        <property name="Left">163</property>
        <property name="Top">312</property>
    <property name="DataSet">sqlLine_item</property>
    <property name="Name">dsLine_item</property>
  </object>
  <object class="Query" name="sqlService" >
        <property name="Left">227</property>
        <property name="Top">296</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService</property>
    <property name="OrderField">description</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:7:{i:0;s:90:"SELECT service.service_id, service.description_en, service_category.service_category_name,";i:1;s:64:"       concat( service_category.service_category_name, '  |   ',";i:2;s:52:"                    service.description_en, '  |  ',";i:3;s:89:"                    FORMAT(service.price_amt, 2), '  |   ', service.notes) as description";i:4;s:110:"FROM service INNER JOIN service_category ON service.service_category_id = service_category.service_category_id";i:5;s:35:"WHERE sort_service_agreement_yn = 1";i:6;s:0:"";}</property>
    <property name="TableName">service</property>
  </object>
  <object class="Datasource" name="dsService" >
        <property name="Left">227</property>
        <property name="Top">312</property>
    <property name="DataSet">sqlService</property>
    <property name="Name">dsService</property>
  </object>
  <object class="Query" name="sqlContact" >
        <property name="Left">307</property>
        <property name="Top">171</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlContact</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:5:{i:0;s:119:"SELECT company.company_id, company.short_name, contact.contact_id, contact.first_name, contact.last_name, contact.email";i:1;s:13:"FROM company ";i:2;s:82:"           INNER JOIN contact ON company.contact_list_id = contact.contact_list_id";i:3;s:0:"";i:4;s:0:"";}</property>
    <property name="TableName">contact</property>
  </object>
  <object class="Datasource" name="dsContact" >
        <property name="Left">307</property>
        <property name="Top">184</property>
    <property name="DataSet">sqlContact</property>
    <property name="Name">dsContact</property>
  </object>
</object>
?>
