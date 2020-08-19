<?php
<object class="company" name="company" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Companies</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="GenerateDocument">0</property>
  <property name="GenerateTable">0</property>
  <property name="Height">475</property>
  <property name="IsMaster">0</property>
  <property name="Name">company</property>
  <property name="UseAjax">1</property>
  <property name="Width">725</property>
  <property name="OnCreate">companyCreate</property>
  <object class="JTPlatinumGrid" name="gridCompany" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:9:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:558:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Company name&quot;;s:9:&quot;DataField&quot;;s:12:&quot;company_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;company_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;250&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:552:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Short name&quot;;s:9:&quot;DataField&quot;;s:10:&quot;short_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;short_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:641:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:12:&quot;country_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:7:&quot;Country&quot;;s:9:&quot;DataField&quot;;s:10:&quot;country_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;country_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:616:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:8:&quot;username&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Username&quot;;s:9:&quot;DataField&quot;;s:7:&quot;user_id&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:7:&quot;user_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:566:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Datahouse ID&quot;;s:9:&quot;DataField&quot;;s:19:&quot;legacy_datahouse_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:19:&quot;legacy_datahouse_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:668:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:20:&quot;account_manager_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:15:&quot;Account manager&quot;;s:9:&quot;DataField&quot;;s:15:&quot;acct_manager_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:15:&quot;acct_manager_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:6;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:689:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:24:&quot;accounting_provider_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:18:&quot;Accountant manager&quot;;s:9:&quot;DataField&quot;;s:22:&quot;accounting_provider_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:22:&quot;accounting_provider_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:677:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:21:&quot;payroll_provider_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:15:&quot;Payroll manager&quot;;s:9:&quot;DataField&quot;;s:19:&quot;payroll_provider_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:19:&quot;payroll_provider_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:8;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:596:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanResize&quot;;b:0;s:7:&quot;Caption&quot;;s:2:&quot;ID&quot;;s:9:&quot;DataField&quot;;s:10:&quot;company_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;company_id&quot;;s:13:&quot;SortDirection&quot;;s:4:&quot;DESC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}}]]></property>
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
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">425</property>
    <property name="KeyField">company_id</property>
    <property name="Left">7</property>
    <property name="Name">gridCompany</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="Visible">0</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">company_id desc</property>
    <property name="Top">45</property>
    <property name="Width">715</property>
    <property name="OnInsert">gridCompanyInsert</property>
    <property name="OnRowEdited">gridCompanyRowEdited</property>
    <property name="OnRowInserted">gridCompanyRowEdited</property>
    <property name="OnSQL">gridCompanySQL</property>
    <property name="OnShow">gridCompanyShow</property>
    <property name="OnUpdate">gridCompanyInsert</property>
    <property name="jsOnSelect">gridCompanyJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winUser" >
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
    <property name="Caption">Assign user</property>
    <property name="Height">96</property>
    <property name="Left">229</property>
    <property name="Name">winUser</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">201</property>
    <property name="Width">320</property>
    <object class="Button" name="btnSaveUser" >
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">156</property>
      <property name="Name">btnSaveUser</property>
      <property name="Top">60</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveUserClick</property>
      <property name="jsOnClick">btnSaveUserJSClick</property>
    </object>
    <object class="Button" name="btnCloseUser" >
      <property name="Caption">Close</property>
      <property name="Height">25</property>
      <property name="Left">232</property>
      <property name="Name">btnCloseUser</property>
      <property name="Top">60</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseUserJSClick</property>
    </object>
    <object class="JTLookupComboBox" name="user_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">107</property>
      <property name="LookupDataField">user_id</property>
      <property name="LookupDataSource">dsUser</property>
      <property name="LookupField">username</property>
      <property name="Name">user_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">30</property>
      <property name="Width">200</property>
    </object>
    <object class="Label" name="lbUser" >
      <property name="Caption">Assign user</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbUser</property>
      <property name="Top">36</property>
      <property name="Width">75</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winParameter" >
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
    <property name="Caption">Accounting parameters</property>
    <property name="Height">208</property>
    <property name="Left">184</property>
    <property name="Name">winParameter</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">153</property>
    <property name="Width">320</property>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Name">company_id</property>
    <property name="Width">123</property>
  </object>
  <object class="HiddenField" name="rowCompany" >
    <property name="Height">18</property>
    <property name="Left">128</property>
    <property name="Name">rowCompany</property>
    <property name="Width">115</property>
  </object>
  <object class="JTToolBar" name="btnCompany" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:6:{s:10:&quot;btnRefresh&quot;;a:3:{i:0;s:7:&quot;Refresh&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;1&quot;;}s:6:&quot;btnAdd&quot;;a:3:{i:0;s:3:&quot;Add&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;2&quot;;}s:7:&quot;btnEdit&quot;;a:3:{i:0;s:4:&quot;Edit&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;3&quot;;}s:9:&quot;btnCancel&quot;;a:3:{i:0;s:6:&quot;Cancel&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;4&quot;;}s:7:&quot;btnSave&quot;;a:3:{i:0;s:4:&quot;Save&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;5&quot;;}s:9:&quot;btnDelete&quot;;a:3:{i:0;s:7:&quot;Deleted&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;6&quot;;}}]]></property>
    <property name="Left">7</property>
    <property name="Name">btnCompany</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">715</property>
    <property name="OnClick">btnCompanyClick</property>
    <property name="jsOnClick">btnCompanyJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">552</property>
        <property name="Top">336</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">561</property>
        <property name="Top">136</property>
    <property name="Images"><![CDATA[a:10:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:27:&quot;images/button/add_16x16.png&quot;;s:1:&quot;3&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;4&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;5&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;6&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;s:1:&quot;7&quot;;s:28:&quot;images/button/user_16x16.png&quot;;s:1:&quot;8&quot;;s:34:&quot;images/button/accounting_16x16.png&quot;;s:1:&quot;9&quot;;s:28:&quot;images/button/bank_16x16.png&quot;;s:2:&quot;10&quot;;s:28:&quot;images/button/view_16x16.png&quot;;}]]></property>
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
    <property name="SQL"><![CDATA[a:2:{i:0;s:21:&quot;SELECT * FROM company&quot;;i:1;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">48</property>
        <property name="Top">279</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="Query" name="sqlUser" >
        <property name="Left">135</property>
        <property name="Top">265</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlUser</property>
    <property name="OrderField">username</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:8:&quot;SELECT *&quot;;i:1;s:17:&quot;FROM vw_user_role&quot;;i:2;s:32:&quot;WHERE role_name = &quot;Client admin&quot;&quot;;}]]></property>
    <property name="TableName">user</property>
  </object>
  <object class="Datasource" name="dsUser" >
        <property name="Left">135</property>
        <property name="Top">281</property>
    <property name="DataSet">sqlUser</property>
    <property name="Name">dsUser</property>
  </object>
</object>
?>
