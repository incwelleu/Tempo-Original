<?php
<object class="company_details" name="company_details" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Company details</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">752</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_details</property>
  <property name="UseAjax">1</property>
  <property name="Width">900</property>
  <property name="OnCreate">company_detailsCreate</property>
  <property name="OnShow">company_detailsShow</property>
  <property name="OnShowHeader">company_detailsShowHeader</property>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">519</property>
    <property name="Name">company_id</property>
    <property name="Top">-26</property>
    <property name="Value">0</property>
    <property name="Width">91</property>
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
    <property name="Top">3</property>
    <property name="Width">890</property>
    <property name="OnClick">btnCompanyClick</property>
    <property name="jsOnClick">btnCompanyJSClick</property>
  </object>
  <object class="HiddenField" name="contact_list_id" >
    <property name="Height">16</property>
    <property name="Left">630</property>
    <property name="Name">contact_list_id</property>
    <property name="Top">-25</property>
    <property name="Value">0</property>
    <property name="Width">110</property>
  </object>
  <object class="JTLabel" name="lbCompany_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Company full name</property>
    <property name="Datasource"></property>
    <property name="Height">15</property>
    <property name="Left">5</property>
    <property name="Name">lbCompany_name</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">40</property>
    <property name="Width">100</property>
  </object>
  <object class="JTGroupBox" name="gbConstitution" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Constitution</property>
    <property name="Height">358</property>
    <property name="Left">5</property>
    <property name="Name">gbConstitution</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">382</property>
    <property name="Width">451</property>
    <object class="JTDatePicker" name="const_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">59</property>
      <property name="Name">const_dt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">25</property>
      <property name="Top">18</property>
      <property name="Width">91</property>
    </object>
    <object class="JTLabel" name="lbConst_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Date</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">6</property>
      <property name="Name">lbConst_dt</property>
      <property name="SiteTheme"></property>
      <property name="Top">21</property>
      <property name="Width">43</property>
    </object>
    <object class="JTLabel" name="lbConst_notary" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Notary</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">167</property>
      <property name="Name">lbConst_notary</property>
      <property name="SiteTheme"></property>
      <property name="Top">18</property>
      <property name="Width">43</property>
    </object>
    <object class="JTAdvancedEdit" name="const_notary" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">224</property>
      <property name="MaxLength">50</property>
      <property name="Name">const_notary</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">26</property>
      <property name="Top">15</property>
      <property name="Width">219</property>
    </object>
    <object class="JTAdvancedEdit" name="tomo" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">59</property>
      <property name="MaxLength">10</property>
      <property name="Name">tomo</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">27</property>
      <property name="Top">43</property>
      <property name="Width">91</property>
    </object>
    <object class="JTLabel" name="lbTomo" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Tomo</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">6</property>
      <property name="Name">lbTomo</property>
      <property name="SiteTheme"></property>
      <property name="Top">46</property>
      <property name="Width">45</property>
    </object>
    <object class="JTLabel" name="lbFolio" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Folio</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">167</property>
      <property name="Name">lbFolio</property>
      <property name="SiteTheme"></property>
      <property name="Top">46</property>
      <property name="Width">56</property>
    </object>
    <object class="JTAdvancedEdit" name="folio" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">224</property>
      <property name="MaxLength">10</property>
      <property name="Name">folio</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">28</property>
      <property name="Top">43</property>
      <property name="Width">65</property>
    </object>
    <object class="JTLabel" name="lbHoja" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Hoja</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">309</property>
      <property name="Name">lbHoja</property>
      <property name="SiteTheme"></property>
      <property name="Top">46</property>
      <property name="Width">43</property>
    </object>
    <object class="JTPlatinumGrid" name="gridCompany_activity_code" >
      <property name="AllowInsert">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="CanDragSelect">0</property>
      <property name="CanMoveCols">0</property>
      <property name="CanMultiColumnSort">0</property>
      <property name="CellData">a:0:{}</property>
      <property name="Columns">a:7:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:603:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:17:"Economic activity";s:9:"DataField";s:22:"economic_activity_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:22:"economic_activity_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"180";}";}i:1;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:486:"a:11:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:9:"Alignment";s:8:"agCenter";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"Start date";s:9:"DataField";s:8:"start_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"start_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"78";}";}i:2;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:510:"a:12:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:9:"Alignment";s:8:"agCenter";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:8:"End date";s:9:"DataField";s:6:"end_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:6:"end_dt";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"78";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:566:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:3:"IAE";s:9:"DataField";s:6:"iae_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:6:"iae_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"50";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:569:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"CNAE";s:9:"DataField";s:7:"cnae_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"cnae_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"50";}";}i:5;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:547:"a:13:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Main";s:9:"DataField";s:16:"main_activity_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:16:"main_activity_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"40";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:566:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"DataField";s:24:"company_activity_code_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:24:"company_activity_code_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}</property>
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
      <property name="Datasource">dsCompany_activity_code</property>
      <property name="EvenRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Header">
      <property name="FilterDelay">0</property>
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      <property name="ShowFilterBar">0</property>
      <property name="ShowGroupBar">0</property>
      <property name="SimpleFilter">0</property>
      </property>
      <property name="Height">128</property>
      <property name="KeyField">company_activity_code_id</property>
      <property name="Left">1</property>
      <property name="Name">gridCompany_activity_code</property>
      <property name="OddRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Pager">
      <property name="ShowBottomPager">0</property>
      <property name="ShowPageInfo">0</property>
      <property name="ShowTopPager">0</property>
      </property>
      <property name="RowDataStyles">a:0:{}</property>
      <property name="RowSelect">1</property>
      <property name="SelectedRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="SortBy">end_dt</property>
      <property name="Top">201</property>
      <property name="Width">437</property>
      <property name="OnRowData">gridCompany_activity_codeRowData</property>
    </object>
    <object class="JTPlatinumGrid" name="gridCompany_administrator" >
      <property name="AllowDelete">0</property>
      <property name="AllowInsert">0</property>
      <property name="AllowUpdate">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="CanDragSelect">0</property>
      <property name="CanMoveCols">0</property>
      <property name="CanMultiColumnSort">0</property>
      <property name="CellData">a:0:{}</property>
      <property name="Columns">a:4:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:554:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"First name";s:9:"DataField";s:10:"first_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"first_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:548:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:9:"Last name";s:9:"DataField";s:9:"last_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"last_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:545:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:538:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"DataField";s:10:"contact_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"contact_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}</property>
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
      <property name="Datasource">dsCompany_administrator</property>
      <property name="EvenRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Header">
      <property name="FilterDelay">0</property>
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      <property name="ShowFilterBar">0</property>
      <property name="ShowGroupBar">0</property>
      <property name="SimpleFilter">0</property>
      </property>
      <property name="Height">99</property>
      <property name="KeyField">contact_id</property>
      <property name="Left">1</property>
      <property name="Name">gridCompany_administrator</property>
      <property name="OddRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Pager">
      <property name="ShowBottomPager">0</property>
      <property name="ShowPageInfo">0</property>
      <property name="ShowRecordCount">0</property>
      <property name="ShowTopPager">0</property>
      <property name="Visible">0</property>
      </property>
      <property name="ReadOnly">1</property>
      <property name="RowDataStyles">a:0:{}</property>
      <property name="RowSelect">1</property>
      <property name="SelectedRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="ShowSelectColumn">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">91</property>
      <property name="Width">437</property>
    </object>
    <object class="JTLabel" name="lbAdministrators" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Administrators</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">6</property>
      <property name="Name">lbAdministrators</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">73</property>
      <property name="Width">100</property>
    </object>
    <object class="HiddenField" name="company_activity_code_id" >
      <property name="Height">18</property>
      <property name="Left">198</property>
      <property name="Name">company_activity_code_id</property>
      <property name="Top">73</property>
      <property name="Value">0</property>
      <property name="Width">200</property>
    </object>
    <object class="JTAdvancedEdit" name="hoja" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">371</property>
      <property name="MaxLength">10</property>
      <property name="Name">hoja</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">29</property>
      <property name="Top">43</property>
      <property name="Width">72</property>
    </object>
    <object class="JTToolBar" name="btnActivity" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">27</property>
      <property name="ImageList">ImageList</property>
      <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
      <property name="Left">1</property>
      <property name="Name">btnActivity</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">328</property>
      <property name="Width">437</property>
      <property name="OnClick">btnActivityClick</property>
      <property name="jsOnClick">btnActivityJSClick</property>
    </object>
  </object>
  <object class="Memo" name="notes_me" >
    <property name="Height">392</property>
    <property name="Left">464</property>
    <property name="Lines">a:0:{}</property>
    <property name="Name">notes_me</property>
    <property name="TabOrder">25</property>
    <property name="Top">319</property>
    <property name="Width">419</property>
  </object>
  <object class="JTGroupBox" name="gbRegistered_address" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Registered address</property>
    <property name="Height">163</property>
    <property name="Left">5</property>
    <property name="Name">gbRegistered_address</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">89</property>
    <property name="Width">451</property>
    <object class="JTAdvancedEdit" name="regaddress_floor" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">231</property>
      <property name="MaxLength">2</property>
      <property name="Name">regaddress_floor</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">8</property>
      <property name="Top">64</property>
      <property name="Width">43</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_door" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">400</property>
      <property name="MaxLength">2</property>
      <property name="Name">regaddress_door</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">9</property>
      <property name="Top">64</property>
      <property name="Width">43</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_city" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">110</property>
      <property name="MaxLength">50</property>
      <property name="Name">regaddress_city</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">10</property>
      <property name="Top">88</property>
      <property name="Width">333</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_street" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Street address</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbRegaddress_street</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">42</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_street_no" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Number</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbRegaddress_street_no</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">65</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_city" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">City</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbRegaddress_city</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">89</property>
      <property name="Width">58</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_street_no" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">110</property>
      <property name="MaxLength">5</property>
      <property name="Name">regaddress_street_no</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">6</property>
      <property name="Top">64</property>
      <property name="Width">51</property>
    </object>
    <object class="JTLookupComboBox" name="regaddress_street_type_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">regaddress_street_type_id</property>
      <property name="Height">24</property>
      <property name="Left">110</property>
      <property name="LookupDataField">street_type_id</property>
      <property name="LookupDataSource">dmCompany.dsStreet_type</property>
      <property name="LookupField">description</property>
      <property name="Name">regaddress_street_type_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">16</property>
      <property name="Width">123</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_street" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">110</property>
      <property name="MaxLength">40</property>
      <property name="Name">regaddress_street</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">5</property>
      <property name="Top">41</property>
      <property name="Width">333</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_floor" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Floor</property>
      <property name="CssClass">reg</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">184</property>
      <property name="Name">lbRegaddress_floor</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">65</property>
      <property name="Width">43</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_door" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Door</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">322</property>
      <property name="Name">lbRegaddress_door</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">65</property>
      <property name="Width">51</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_province" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Province</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbRegaddress_province</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">113</property>
      <property name="Width">80</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_province" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">110</property>
      <property name="MaxLength">25</property>
      <property name="Name">regaddress_province</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">11</property>
      <property name="Top">112</property>
      <property name="Width">333</property>
    </object>
    <object class="JTLabel" name="lbStreet_type" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Street type</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbStreet_type</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">19</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbRegaddress_post_code" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Post code</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbRegaddress_post_code</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">137</property>
      <property name="Width">80</property>
    </object>
    <object class="JTAdvancedEdit" name="regaddress_post_code" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">110</property>
      <property name="MaxLength">15</property>
      <property name="Name">regaddress_post_code</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">12</property>
      <property name="Top">136</property>
      <property name="Width">85</property>
    </object>
    <object class="JTLookupComboBox" name="country_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">country_id</property>
      <property name="Height">21</property>
      <property name="Left">287</property>
      <property name="LookupDataField">country_id</property>
      <property name="LookupDataSource">dmCompany.dsCountry</property>
      <property name="LookupField">country_name</property>
      <property name="Name">country_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">13</property>
      <property name="Top">136</property>
      <property name="Visible">0</property>
      <property name="Width">156</property>
    </object>
    <object class="JTLabel" name="lbCountry_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Country</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">224</property>
      <property name="Name">lbCountry_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">139</property>
      <property name="Visible">0</property>
      <property name="Width">50</property>
    </object>
    <object class="JTLabel" name="lbFillAs" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Fill in as</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">254</property>
      <property name="Name">lbFillAs</property>
      <property name="SiteTheme"></property>
      <property name="Top">19</property>
      <property name="Width">57</property>
    </object>
    <object class="ComboBox" name="cbAddress" >
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">322</property>
      <property name="Name">cbAddress</property>
      <property name="Top">16</property>
      <property name="Width">121</property>
      <property name="OnChange">cbAddressChange</property>
      <property name="jsOnChange">cbAddressJSChange</property>
    </object>
  </object>
  <object class="ComboBox" name="tax_ident_type_cd" >
    <property name="DataField">tax_ident_type_cd</property>
    <property name="Height">21</property>
    <property name="ItemIndex">0</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">107</property>
    <property name="Name">tax_ident_type_cd</property>
    <property name="TabOrder">2</property>
    <property name="Top">63</property>
    <property name="Width">143</property>
  </object>
  <object class="JTAdvancedEdit" name="company_name" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">107</property>
    <property name="Name">company_name</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="TabOrder">1</property>
    <property name="Top">36</property>
    <property name="Width">291</property>
  </object>
  <object class="JTGroupBox" name="gbParameter" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Parameter</property>
    <property name="Height">197</property>
    <property name="Left">464</property>
    <property name="Name">gbParameter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">89</property>
    <property name="Width">277</property>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">payment_method_id</property>
      <property name="Height">21</property>
      <property name="Left">120</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dmCompany.dsPayment_method</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">20</property>
      <property name="Top">65</property>
      <property name="Visible">0</property>
      <property name="Width">145</property>
    </object>
    <object class="JTLabel" name="lbPayment_method" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Payment method</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">170</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">68</property>
      <property name="Visible">0</property>
      <property name="Width">94</property>
    </object>
    <object class="JTLabel" name="lbUsername" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">User name</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbUsername</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">68</property>
      <property name="Width">76</property>
    </object>
    <object class="JTLookupComboBox" name="user_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">user_id</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="LookupDataField">user_id</property>
      <property name="LookupDataSource">dmCompany.dsUser</property>
      <property name="LookupField">username</property>
      <property name="Name">user_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">21</property>
      <property name="Top">65</property>
      <property name="Width">145</property>
    </object>
    <object class="JTAdvancedEdit" name="short_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="MaxLength">50</property>
      <property name="Name">short_name</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">19</property>
      <property name="Top">40</property>
      <property name="ValidationRegExp">^[A-Z0-9 ]*$</property>
      <property name="Width">145</property>
    </object>
    <object class="JTLabel" name="lbShort_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Short name</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbShort_name</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">45</property>
      <property name="Width">76</property>
    </object>
    <object class="JTLabel" name="lbAcct_manager_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Account manager</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbAcct_manager_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">93</property>
      <property name="Width">91</property>
    </object>
    <object class="JTLookupComboBox" name="acct_manager_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">acct_manager_id</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="LookupDataField">acct_manager_id</property>
      <property name="LookupDataSource">dmCompany.dsAccount_manager</property>
      <property name="LookupField">account_manager_name</property>
      <property name="Name">acct_manager_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">22</property>
      <property name="Top">89</property>
      <property name="Width">145</property>
    </object>
    <object class="JTLabel" name="lbAccounting_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Accounting provider</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbAccounting_provider_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">118</property>
      <property name="Width">100</property>
    </object>
    <object class="JTLookupComboBox" name="accounting_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">accounting_provider_id</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="LookupDataField">accounting_provider_id</property>
      <property name="LookupDataSource">dmCompany.dsAccountant_manager</property>
      <property name="LookupField">accounting_provider_name</property>
      <property name="Name">accounting_provider_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">23</property>
      <property name="Top">114</property>
      <property name="Width">145</property>
    </object>
    <object class="JTLabel" name="lbPayroll_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Payroll provider</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbPayroll_provider_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">143</property>
      <property name="Width">100</property>
    </object>
    <object class="JTLookupComboBox" name="payroll_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">payroll_provider_id</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="LookupDataField">payroll_provider_id</property>
      <property name="LookupDataSource">dmCompany.dsPayroll_manager</property>
      <property name="LookupField">payroll_provider_name</property>
      <property name="Name">payroll_provider_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">24</property>
      <property name="Top">139</property>
      <property name="Width">145</property>
    </object>
    <object class="CheckBox" name="is_default_company_yn" >
      <property name="Alignment">agLeft</property>
      <property name="Caption">Show this company first</property>
      <property name="Height">21</property>
      <property name="Left">6</property>
      <property name="Name">is_default_company_yn</property>
      <property name="TabOrder">13</property>
      <property name="Top">16</property>
      <property name="Width">155</property>
    </object>
    <object class="JTLabel" name="lbBilling_entity" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Billing entity</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">6</property>
      <property name="Name">lbBilling_entity</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">168</property>
      <property name="Width">100</property>
    </object>
    <object class="JTLookupComboBox" name="billing_entity_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">billing_entity_id</property>
      <property name="Height">24</property>
      <property name="Left">120</property>
      <property name="LookupDataField">billing_entity_id</property>
      <property name="LookupDataSource">dsBilling_entity</property>
      <property name="LookupField">billing_entity_name</property>
      <property name="Name">billing_entity_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">24</property>
      <property name="Top">164</property>
      <property name="Width">145</property>
    </object>
  </object>
  <object class="JTLabel" name="lbTax_ident_type_cd" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Document type</property>
    <property name="Datasource"></property>
    <property name="Height">15</property>
    <property name="Left">5</property>
    <property name="Name">lbTax_ident_type_cd</property>
    <property name="SiteTheme"></property>
    <property name="Top">65</property>
    <property name="Width">100</property>
  </object>
  <object class="JTLabel" name="lbTax_ident" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Tax ID</property>
    <property name="Datasource"></property>
    <property name="Height">15</property>
    <property name="Left">266</property>
    <property name="Name">lbTax_ident</property>
    <property name="SiteTheme"></property>
    <property name="Top">65</property>
    <property name="Width">43</property>
  </object>
  <object class="JTAdvancedEdit" name="tax_ident" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">313</property>
    <property name="Name">tax_ident</property>
    <property name="SiteTheme"></property>
    <property name="TabOrder">3</property>
    <property name="Top">62</property>
    <property name="Width">130</property>
  </object>
  <object class="JTGroupBox" name="gbCreated" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Created by</property>
    <property name="Height">51</property>
    <property name="Left">464</property>
    <property name="Name">gbCreated</property>
    <property name="SiteTheme"></property>
    <property name="Top">33</property>
    <property name="Width">277</property>
    <object class="JTAdvancedEdit" name="created_by_user" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">6</property>
      <property name="Name">created_by_user</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">21</property>
      <property name="Width">134</property>
    </object>
    <object class="JTAdvancedEdit" name="created_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">156</property>
      <property name="Name">created_dt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">21</property>
      <property name="Width">109</property>
    </object>
  </object>
  <object class="JTGroupBox" name="gbMailing_address" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Mailing address</property>
    <property name="Height">118</property>
    <property name="Left">5</property>
    <property name="Name">gbMailing_address</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">257</property>
    <property name="Width">451</property>
    <object class="JTLabel" name="lbMail_street_address" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Street address</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbMail_street_address</property>
      <property name="SiteTheme"></property>
      <property name="Top">18</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbMail_city" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">City</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbMail_city</property>
      <property name="SiteTheme"></property>
      <property name="Top">42</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbMail_province" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Province</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbMail_province</property>
      <property name="SiteTheme"></property>
      <property name="Top">65</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbMail_post_code" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Post code</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbMail_post_code</property>
      <property name="SiteTheme"></property>
      <property name="Top">90</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbMail_country_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Country</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">224</property>
      <property name="Name">lbMail_country_id</property>
      <property name="SiteTheme"></property>
      <property name="Top">90</property>
      <property name="Width">50</property>
    </object>
    <object class="JTAdvancedEdit" name="mail_city" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">109</property>
      <property name="MaxLength">25</property>
      <property name="Name">mail_city</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">15</property>
      <property name="Top">39</property>
      <property name="Width">334</property>
    </object>
    <object class="JTAdvancedEdit" name="mail_post_code" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">109</property>
      <property name="MaxLength">15</property>
      <property name="Name">mail_post_code</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">17</property>
      <property name="Top">87</property>
      <property name="Width">85</property>
    </object>
    <object class="JTAdvancedEdit" name="mail_street_address" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">109</property>
      <property name="MaxLength">255</property>
      <property name="Name">mail_street_address</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">14</property>
      <property name="Top">15</property>
      <property name="Width">334</property>
    </object>
    <object class="JTAdvancedEdit" name="mail_province" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">109</property>
      <property name="MaxLength">25</property>
      <property name="Name">mail_province</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">16</property>
      <property name="Top">62</property>
      <property name="Width">334</property>
    </object>
    <object class="JTLookupComboBox" name="mail_country_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">mail_country_id</property>
      <property name="Height">24</property>
      <property name="Left">283</property>
      <property name="LookupDataField">country_id</property>
      <property name="LookupDataSource">dmCompany.dsCountry</property>
      <property name="LookupField">country_name</property>
      <property name="Name">mail_country_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">18</property>
      <property name="Top">90</property>
      <property name="Width">160</property>
    </object>
  </object>
  <object class="JTAdvancedEdit" name="company_cd" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Enabled">0</property>
    <property name="Height">24</property>
    <property name="Left">409</property>
    <property name="Name">company_cd</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Align">taRight</property>
    <property name="Size">11px</property>
    </property>
    <property name="Top">36</property>
    <property name="Width">34</property>
  </object>
  <object class="Image" name="btnCreateNew" >
    <property name="Autosize">1</property>
    <property name="Border">0</property>
    <property name="Enabled">0</property>
    <property name="Height">16</property>
    <property name="Hint">Create new user</property>
    <property name="ImageSource">images/button/add_16x16_disable.png</property>
    <property name="Layer">TabDetails</property>
    <property name="Left">562</property>
    <property name="Link"></property>
    <property name="LinkTarget"></property>
    <property name="Name">btnCreateNew</property>
    <property name="ParentShowHint">0</property>
    <property name="ShowHint">1</property>
    <property name="Top">156</property>
    <property name="Width">16</property>
    <property name="OnClick">btnCreateNewClick</property>
  </object>
  <object class="Image" name="btnAddNote" >
    <property name="Autosize">1</property>
    <property name="Border">0</property>
    <property name="Height">16</property>
    <property name="Hint">Add note</property>
    <property name="ImageSource">images/button/add_16x16.png</property>
    <property name="Left">508</property>
    <property name="Link"></property>
    <property name="LinkTarget"></property>
    <property name="Name">btnAddNote</property>
    <property name="ParentShowHint">0</property>
    <property name="ShowHint">1</property>
    <property name="Top">298</property>
    <property name="Width">16</property>
    <property name="jsOnClick">btnAddNoteJSClick</property>
  </object>
  <object class="JTLabel" name="lbNotes" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Notes</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">464</property>
    <property name="Name">lbNotes</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">298</property>
    <property name="Width">35</property>
  </object>
  <object class="JTDivWindow" name="winCompanyTemp" >
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
    <property name="Caption">winCompanyTemp</property>
    <property name="Height">52</property>
    <property name="Left">199</property>
    <property name="Name">winCompanyTemp</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">763</property>
    <property name="Width">51</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">489</property>
        <property name="Top">800</property>
    <property name="Images">a:10:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:28:"images/button/user_16x16.png";s:1:"8";s:34:"images/button/accounting_16x16.png";s:1:"9";s:28:"images/button/bank_16x16.png";s:2:"10";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">559</property>
        <property name="Top">800</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Datasource" name="dsCompany_activity_code" >
        <property name="Left">232</property>
        <property name="Top">551</property>
    <property name="DataSet">sqlCompany_activity_code</property>
    <property name="Name">dsCompany_activity_code</property>
  </object>
  <object class="Query" name="sqlCompany_activity_code" >
        <property name="Left">232</property>
        <property name="Top">536</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_activity_code</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:4:{i:0;s:33:"SELECT * FROM vw_company_activity";i:1;s:20:"WHERE company_id = ?";i:2;s:0:"";i:3;s:0:"";}</property>
    <property name="TableName">company_activity_code</property>
  </object>
  <object class="Datasource" name="dsCompany_administrator" >
        <property name="Left">88</property>
        <property name="Top">535</property>
    <property name="DataSet">sqlCompany_administrator</property>
    <property name="Name">dsCompany_administrator</property>
  </object>
  <object class="Query" name="sqlCompany_administrator" >
        <property name="Left">88</property>
        <property name="Top">521</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_administrator</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:4:{i:0;s:38:"SELECT * FROM vw_company_administrator";i:1;s:20:"WHERE company_id = ?";i:2;s:0:"";i:3;s:0:"";}</property>
    <property name="TableName">vw_company_administrator</property>
  </object>
  <object class="Query" name="sqlBilling_entity" >
        <property name="Left">792</property>
        <property name="Top">97</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlBilling_entity</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:4:{i:0;s:28:"SELECT * FROM billing_entity";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}</property>
    <property name="TableName">billing_entity</property>
  </object>
  <object class="Datasource" name="dsBilling_entity" >
        <property name="Left">792</property>
        <property name="Top">114</property>
    <property name="DataSet">sqlBilling_entity</property>
    <property name="Name">dsBilling_entity</property>
  </object>
</object>
?>
