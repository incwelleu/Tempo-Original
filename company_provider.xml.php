<?php
<object class="company_provider" name="company_provider" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Strong Weber - Company provider</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_provider</property>
  <property name="UseAjax">1</property>
  <property name="Width">715</property>
  <property name="OnCreate">company_providerCreate</property>
  <property name="OnShow">company_providerShow</property>
  <object class="JTPlatinumGrid" name="gridCompany_provider" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:12:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:589:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"20";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:608:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"200";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:13:"Provider name";s:9:"DataField";s:13:"provider_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"provider_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:663:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:12:"country_name";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:7:"Country";s:9:"DataField";s:10:"country_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"country_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:594:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"10";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:11:"Postal code";s:9:"DataField";s:9:"postal_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"postal_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:653:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:12:"expense_name";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:12:"Expense type";s:9:"DataField";s:15:"expense_type_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"expense_type_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:740:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:14:"LookupComboBox";s:20:"LookupComboBoxEditor";s:124:"a:3:{s:10:"Datasource";s:14:"dsTax_type_key";s:9:"TextField";s:13:"tax_type_name";s:10:"ValueField";s:15:"tax_type_key_id";}";s:9:"TextField";s:13:"tax_type_name";s:7:"CanMove";b:0;s:7:"Caption";s:14:"Type input tax";s:9:"DataField";s:15:"tax_type_key_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"tax_type_key_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:600:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"12";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:12:"Account code";s:9:"DataField";s:10:"account_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"account_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:623:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"12";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:19:"Account</br>expense";s:9:"DataField";s:18:"account_expense_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:18:"account_expense_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:8;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:641:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"12";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:25:"Account</br>other expense";s:9:"DataField";s:24:"account_other_expense_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:24:"account_other_expense_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:635:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"12";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:23:"Account</br>withholding";s:9:"DataField";s:22:"account_withholding_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:22:"account_withholding_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:626:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:19:"company_provider_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:19:"company_provider_id";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}i:11;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:628:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:10:"company id";s:9:"DataField";s:10:"company_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"company_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}]]></property>
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
    <property name="Datasource">dsCompany_provider</property>
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
    <property name="Height">395</property>
    <property name="KeyField">company_provider_id</property>
    <property name="Name">gridCompany_provider</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">500</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">company_provider_id desc</property>
    <property name="Top">47</property>
    <property name="Width">705</property>
    <property name="OnDelete">gridCompany_providerDelete</property>
    <property name="OnInsert">gridCompany_providerInsert</property>
    <property name="OnRowEdited">gridCompany_providerRowEdited</property>
    <property name="OnRowInserted">gridCompany_providerRowEdited</property>
    <property name="OnSQL">gridCompany_providerSQL</property>
    <property name="OnShow">gridCompany_providerShow</property>
    <property name="OnUpdate">gridCompany_providerInsert</property>
    <property name="jsOnDataLoad">gridCompany_providerJSDataLoad</property>
    <property name="jsOnSelect">gridCompany_providerJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winMergeProvider" >
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
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">Merge client</property>
    <property name="Height">180</property>
    <property name="Left">222</property>
    <property name="Name">winMergeProvider</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">174</property>
    <property name="Width">411</property>
    <object class="Button" name="btnSaveMerge" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">249</property>
      <property name="Name">btnSaveMerge</property>
      <property name="Top">147</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveMergeClick</property>
      <property name="jsOnClick">btnSaveMergeJSClick</property>
    </object>
    <object class="Button" name="btnCloseMerge" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">328</property>
      <property name="Name">btnCloseMerge</property>
      <property name="Top">147</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseMergeJSClick</property>
    </object>
    <object class="Label" name="lbSourceProvider" >
      <property name="Caption">Source provider</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbSourceProvider</property>
      <property name="Top">91</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbTargetProvider" >
      <property name="Caption">Target provider</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbTargetProvider</property>
      <property name="Top">121</property>
      <property name="Width">90</property>
    </object>
    <object class="JTLookupComboBox" name="cbSourceProvider" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">108</property>
      <property name="LookupDataField">company_provider_id</property>
      <property name="LookupDataSource">dsMerge_provider</property>
      <property name="LookupField">provider</property>
      <property name="Name">cbSourceProvider</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">86</property>
      <property name="Width">295</property>
    </object>
    <object class="JTLookupComboBox" name="cbTargetProvider" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">108</property>
      <property name="LookupDataField">company_provider_id</property>
      <property name="LookupDataSource">dsMerge_provider</property>
      <property name="LookupField">provider</property>
      <property name="Name">cbTargetProvider</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">115</property>
      <property name="Width">295</property>
    </object>
    <object class="JTLabel" name="lbMessage_merge" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption"><![CDATA[If the same&nbsp;provider appears twice, use this button to delete one entry ("Source") and transfer the invoices linked to that entry to the correct entry ("Target").<BR>]]></property>
      <property name="Datasource"></property>
      <property name="Height">48</property>
      <property name="Left">8</property>
      <property name="Name">lbMessage_merge</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taJustify</property>
      </property>
      <property name="Top">28</property>
      <property name="Width">375</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winTypeTax" >
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
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">winTypeTax</property>
    <property name="Height">107</property>
    <property name="Left">115</property>
    <property name="Name">winTypeTax</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">71</property>
    <property name="Width">454</property>
    <object class="JTLabel" name="lbTypeInputTax" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">lbTypeInputTax</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">14</property>
      <property name="Name">lbTypeInputTax</property>
      <property name="SiteTheme"></property>
      <property name="Top">38</property>
      <property name="Width">147</property>
    </object>
    <object class="Button" name="btnSaveInputTax" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">287</property>
      <property name="Name">btnSaveInputTax</property>
      <property name="Top">66</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveInputTaxClick</property>
    </object>
    <object class="Button" name="btnCloseInputTax" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">366</property>
      <property name="Name">btnCloseInputTax</property>
      <property name="Top">66</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseInputTaxJSClick</property>
      <property name="jsOnClick">btnCloseInputTaxJSClick</property>
    </object>
    <object class="JTComboBox" name="tax_type_key_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">24</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">172</property>
      <property name="LookupDatasource">dsTax_type_key</property>
      <property name="LookupTextField">tax_type_name</property>
      <property name="LookupValueField">tax_type_key_id</property>
      <property name="Name">tax_type_key_id</property>
      <property name="SiteTheme"></property>
      <property name="Top">35</property>
      <property name="Width">269</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winUpload" >
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
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">Upload provider</property>
    <property name="Height">179</property>
    <property name="Left">45</property>
    <property name="Name">winUpload</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">71</property>
    <property name="Width">379</property>
    <object class="Button" name="btnClose" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">22</property>
      <property name="Left">291</property>
      <property name="Name">btnClose</property>
      <property name="Top">149</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseClick</property>
      <property name="jsOnClick">btnCloseJSClick</property>
    </object>
    <object class="Upload" name="Upload" >
      <property name="Height">21</property>
      <property name="Left">9</property>
      <property name="Name">Upload</property>
      <property name="Top">30</property>
      <property name="Width">363</property>
    </object>
    <object class="Button" name="btnImport" >
      <property name="Action">n</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Import</property>
      <property name="Height">22</property>
      <property name="Left">211</property>
      <property name="Name">btnImport</property>
      <property name="Top">149</property>
      <property name="Width">75</property>
      <property name="OnClick">btnImportClick</property>
    </object>
    <object class="JTGroupBox" name="gbParameter" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Parameter import</property>
      <property name="Height">86</property>
      <property name="Left">9</property>
      <property name="Name">gbParameter</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">57</property>
      <property name="Width">363</property>
      <object class="JTLabel" name="lbAccounting_code" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Accounting Code</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">178</property>
        <property name="Name">lbAccounting_code</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">91</property>
      </object>
      <object class="JTLabel" name="lbBeginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Beginning of row</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">178</property>
        <property name="Name">lbBeginning_row</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">57</property>
        <property name="Width">80</property>
      </object>
      <object class="JTLabel" name="lbTax_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax ID</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbTax_id</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">100</property>
      </object>
      <object class="JTLabel" name="lbProvider_name" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Provider Name</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbProvider_name</property>
        <property name="SiteTheme"></property>
        <property name="Top">57</property>
        <property name="Width">107</property>
      </object>
      <object class="UpDown" name="beginning_row" >
        <property name="Height">21</property>
        <property name="Left">308</property>
        <property name="Min">1</property>
        <property name="Name">beginning_row</property>
        <property name="Position">1</property>
        <property name="Top">52</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_tax_ident" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">124</property>
        <property name="Name">col_tax_ident</property>
        <property name="Top">17</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_accounting_code" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">308</property>
        <property name="Name">col_accounting_code</property>
        <property name="Top">17</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_provider_name" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">124</property>
        <property name="Name">col_provider_name</property>
        <property name="Top">55</property>
        <property name="Width">44</property>
      </object>
    </object>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">393</property>
    <property name="Name">company_id</property>
    <property name="Value">0</property>
    <property name="Width">125</property>
  </object>
  <object class="HiddenField" name="rowProvider" >
    <property name="Height">18</property>
    <property name="Left">550</property>
    <property name="Name">rowProvider</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="JTToolBar" name="btnProvider" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnProvider</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">23</property>
    <property name="Width">705</property>
    <property name="OnClick">btnProviderClick</property>
    <property name="jsOnClick">btnProviderJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">664</property>
        <property name="Top">400</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany_provider" >
        <property name="Left">512</property>
        <property name="Top">384</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_provider</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:30:"Select * from company_provider";}</property>
    <property name="TableName">company_provider</property>
  </object>
  <object class="Datasource" name="dsCompany_provider" >
        <property name="Left">512</property>
        <property name="Top">400</property>
    <property name="DataSet">sqlCompany_provider</property>
    <property name="Name">dsCompany_provider</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">601</property>
        <property name="Top">400</property>
    <property name="Images">a:8:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlMerge_provider" >
        <property name="Left">167</property>
        <property name="Top">373</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlMerge_provider</property>
    <property name="OrderField">provider_name</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:3:{i:0;s:76:"SELECT company_provider.*, CONCAT(provider_name, ' ', tax_ident) AS provider";i:1;s:21:"FROM company_provider";i:2;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_provider</property>
  </object>
  <object class="Datasource" name="dsMerge_provider" >
        <property name="Left">167</property>
        <property name="Top">386</property>
    <property name="DataSet">sqlMerge_provider</property>
    <property name="Name">dsMerge_provider</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">287</property>
        <property name="Top">373</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_type_key</property>
    <property name="OrderField">tax_type_key_id</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:26:"SELECT * FROM tax_type_key";i:1;s:41:"WHERE type_tax_cd = 2 AND country_id = ? ";}</property>
    <property name="TableName">tax_type_key</property>
  </object>
  <object class="Datasource" name="dsTax_type_key" >
        <property name="Left">287</property>
        <property name="Top">386</property>
    <property name="DataSet">sqlTax_type_key</property>
    <property name="Name">dsTax_type_key</property>
  </object>
</object>
?>
