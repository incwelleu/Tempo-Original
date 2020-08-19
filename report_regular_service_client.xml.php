<?php
<object class="report_regular_service_client" name="report_regular_service_client" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Regular service clients</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="GenerateDocument">0</property>
  <property name="GenerateTable">0</property>
  <property name="Height">526</property>
  <property name="IsMaster">0</property>
  <property name="Name">report_regular_service_client</property>
  <property name="UseAjax">1</property>
  <property name="Width">723</property>
  <property name="OnCreate">report_regular_service_clientCreate</property>
  <property name="OnShowHeader">report_regular_service_clientShowHeader</property>
  <property name="jsOnLoad">report_regular_service_clientJSLoad</property>
  <object class="JTDivWindow" name="winEmail" >
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
    <property name="Caption">winEmail</property>
    <property name="Height">498</property>
    <property name="Left">28</property>
    <property name="Name">winEmail</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">9</property>
    <property name="Width">667</property>
    <object class="JTLabel" name="lbSubject" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Subject</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">11</property>
      <property name="Name">lbSubject</property>
      <property name="SiteTheme"></property>
      <property name="Top">59</property>
      <property name="Width">100</property>
    </object>
    <object class="JTAdvancedEdit" name="subject" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">125</property>
      <property name="MaxLength">200</property>
      <property name="Name">subject</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">2</property>
      <property name="Top">56</property>
      <property name="Width">529</property>
    </object>
    <object class="Memo" name="body_template" >
      <property name="Height">251</property>
      <property name="Left">11</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">body_template</property>
      <property name="TabOrder">3</property>
      <property name="Top">83</property>
      <property name="Width">643</property>
    </object>
    <object class="Button" name="btnClose" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">btnClose</property>
      <property name="Height">25</property>
      <property name="Left">574</property>
      <property name="Name">btnClose</property>
      <property name="TabOrder">5</property>
      <property name="Top">459</property>
      <property name="Width">80</property>
      <property name="OnClick">btnCloseClick</property>
    </object>
    <object class="JTLabel" name="lbTemplate" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Template</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">11</property>
      <property name="Name">lbTemplate</property>
      <property name="SiteTheme"></property>
      <property name="Top">32</property>
      <property name="Width">83</property>
    </object>
    <object class="ComboBox" name="email_template_id" >
      <property name="Height">22</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">125</property>
      <property name="Name">email_template_id</property>
      <property name="TabOrder">1</property>
      <property name="Top">30</property>
      <property name="Width">530</property>
      <property name="OnChange">email_template_idChange</property>
    </object>
    <object class="Button" name="btnSave" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">btnSave</property>
      <property name="Enabled">0</property>
      <property name="Height">25</property>
      <property name="Left">474</property>
      <property name="Name">btnSave</property>
      <property name="TabOrder">4</property>
      <property name="Top">459</property>
      <property name="Width">93</property>
      <property name="OnClick">btnSaveClick</property>
    </object>
    <object class="JTLabel" name="lbContact" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Clients without contacts with {$rec} marked</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">11</property>
      <property name="Name">lbContact</property>
      <property name="ParentColor">0</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">red</property>
      <property name="Weight">bold</property>
      </property>
      <property name="Top">352</property>
      <property name="Visible">0</property>
      <property name="Width">411</property>
    </object>
    <object class="ListBox" name="cbContact" >
      <property name="Font">
      <property name="Color">Red</property>
      </property>
      <property name="Height">113</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">11</property>
      <property name="Name">cbContact</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">371</property>
      <property name="Visible">0</property>
      <property name="Width">250</property>
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridCompany" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:10:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:576:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Company name";s:9:"DataField";s:12:"company_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"company_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:570:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"Short name";s:9:"DataField";s:10:"short_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"short_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:659:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:12:"country_name";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:7:"Country";s:9:"DataField";s:10:"country_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"country_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:525:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:668:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:20:"account_manager_name";s:7:"CanMove";b:0;s:7:"Caption";s:15:"Account manager";s:9:"DataField";s:15:"acct_manager_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"acct_manager_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:689:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:24:"accounting_provider_name";s:7:"CanMove";b:0;s:7:"Caption";s:18:"Accountant manager";s:9:"DataField";s:22:"accounting_provider_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:22:"accounting_provider_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:677:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:21:"payroll_provider_name";s:7:"CanMove";b:0;s:7:"Caption";s:15:"Payroll manager";s:9:"DataField";s:19:"payroll_provider_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:19:"payroll_provider_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:674:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:9:"TextField";s:8:"username";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"Created by";s:9:"DataField";s:18:"created_by_user_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:18:"created_by_user_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:8;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:426:"a:9:{s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Created date";s:9:"DataField";s:10:"created_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"created_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:582:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:7:"Caption";s:2:"ID";s:9:"DataField";s:10:"company_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"company_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:2:"80";}";}}</property>
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
    <property name="Datasource">dsCompany</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">395</property>
    <property name="KeyField">company_id</property>
    <property name="Name">gridCompany</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">1000</property>
    <property name="ShowTopPager">0</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">124</property>
    <property name="Width">715</property>
    <property name="OnRowData">gridCompanyRowData</property>
    <property name="OnSQL">gridCompanySQL</property>
    <property name="OnShow">gridCompanyShow</property>
    <property name="jsOnSelect">gridCompanyJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winChange" >
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
    <property name="Caption">winChange</property>
    <property name="Height">107</property>
    <property name="Left">127</property>
    <property name="Name">winChange</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">145</property>
    <property name="Width">275</property>
    <object class="Button" name="btnCloseChange" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">btnCloseChange</property>
      <property name="Height">25</property>
      <property name="Left">182</property>
      <property name="Name">btnCloseChange</property>
      <property name="TabOrder">5</property>
      <property name="Top">65</property>
      <property name="Width">80</property>
      <property name="OnClick">btnCloseChangeClick</property>
    </object>
    <object class="JTLabel" name="lbChange" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">lbChange</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">11</property>
      <property name="Name">lbChange</property>
      <property name="SiteTheme"></property>
      <property name="Top">32</property>
      <property name="Width">83</property>
    </object>
    <object class="ComboBox" name="cbChange" >
      <property name="Height">22</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">82</property>
      <property name="Name">cbChange</property>
      <property name="TabOrder">1</property>
      <property name="Top">30</property>
      <property name="Width">180</property>
    </object>
    <object class="Button" name="btnChange" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">btnChange</property>
      <property name="Height">25</property>
      <property name="Left">82</property>
      <property name="Name">btnChange</property>
      <property name="TabOrder">4</property>
      <property name="Top">65</property>
      <property name="Width">93</property>
      <property name="OnClick">btnChangeClick</property>
    </object>
  </object>
  <object class="JTToolBar" name="btnCompany" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnCompany</property>
    <property name="SiteTheme"></property>
    <property name="Top">100</property>
    <property name="Width">715</property>
    <property name="OnClick">btnCompanyClick</property>
    <property name="jsOnClick">btnCompanyJSClick</property>
  </object>
  <object class="JTGroupBox" name="gbServiceType" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">gbServiceType</property>
    <property name="Height">70</property>
    <property name="Name">gbServiceType</property>
    <property name="SiteTheme"></property>
    <property name="Top">24</property>
    <property name="Width">715</property>
    <object class="JTCheckBoxList" name="service_type_id" >
      <property name="Anchors">
      <property name="Bottom">1</property>
      <property name="Relative">0</property>
      <property name="Right">1</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Columns">1</property>
      <property name="Height">19</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">3</property>
      <property name="Name">service_type_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="Top">43</property>
      <property name="Width">701</property>
      <property name="jsOnClick">cbIncludeInactiveJSChange</property>
    </object>
    <object class="CheckBox" name="cbIncludeServicesEnded" >
      <property name="Caption">Include services ended</property>
      <property name="Font">
      <property name="Size">9pt</property>
      </property>
      <property name="Height">19</property>
      <property name="Left">3</property>
      <property name="Name">cbIncludeServicesEnded</property>
      <property name="ParentFont">0</property>
      <property name="Top">17</property>
      <property name="Width">346</property>
      <property name="jsOnChange">cbIncludeInactiveJSChange</property>
    </object>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">592</property>
    <property name="Name">company_id</property>
    <property name="Width">123</property>
  </object>
  <object class="HiddenField" name="rowCompany" >
    <property name="Height">18</property>
    <property name="Left">264</property>
    <property name="Name">rowCompany</property>
    <property name="Width">115</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">384</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Width">200</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">552</property>
        <property name="Top">336</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">457</property>
        <property name="Top">400</property>
    <property name="Images">a:4:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:28:"images/button/view_16x16.png";s:1:"3";s:27:"images/button/xls_16X16.png";s:1:"4";s:29:"images/button/email_16X16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlCompany" >
        <property name="Left">48</property>
        <property name="Top">260</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:21:"SELECT * FROM company";i:1;s:0:"";}</property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">48</property>
        <property name="Top">279</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
</object>
?>
