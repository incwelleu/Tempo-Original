<?php
<object class="report_company_tax_model" name="report_company_tax_model" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Report company tax models</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">report_company_tax_model</property>
  <property name="UseAjax">1</property>
  <property name="Width">720</property>
  <property name="OnCreate">report_company_tax_modelCreate</property>
  <object class="JTPlatinumGrid" name="gridData" >
    <property name="AjaxRefreshAll">1</property>
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
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:11:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:565:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Short name&quot;;s:9:&quot;DataField&quot;;s:10:&quot;short_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;short_name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:576:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:14:&quot;tax_model_name&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Model name&quot;;s:9:&quot;DataField&quot;;s:12:&quot;tax_model_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;tax_model_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:575:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:5:&quot;State&quot;;s:9:&quot;DataField&quot;;s:5:&quot;state&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:5:&quot;state&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:552:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:5:&quot;Notes&quot;;s:9:&quot;DataField&quot;;s:5:&quot;notes&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:5:&quot;notes&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;350&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:595:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:0:&quot;&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:18:&quot;Accountant manager&quot;;s:9:&quot;DataField&quot;;s:24:&quot;accounting_provider_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:24:&quot;accounting_provider_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;160&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:561:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:17:&quot;Presentation type&quot;;s:9:&quot;DataField&quot;;s:20:&quot;presentation_type_cd&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:20:&quot;presentation_type_cd&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:6;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:577:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:14:&quot;HyperlinkField&quot;;s:4:&quot;link&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:4:&quot;name&quot;;s:9:&quot;DataField&quot;;s:4:&quot;name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:4:&quot;name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;300&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:509:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:4:&quot;link&quot;;s:9:&quot;DataField&quot;;s:4:&quot;link&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:4:&quot;link&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;}&quot;;}i:8;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:544:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;DataField&quot;;s:10:&quot;company_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;company_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:497:&quot;a:10:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;Caption&quot;;s:6:&quot;key_id&quot;;s:9:&quot;DataField&quot;;s:6:&quot;key_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:6:&quot;key_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;}&quot;;}i:10;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:538:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Model name&quot;;s:9:&quot;DataField&quot;;s:14:&quot;tax_model_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:14:&quot;tax_model_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;}&quot;;}}]]></property>
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
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">377</property>
    <property name="KeyField">key_id</property>
    <property name="Name">gridData</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">500</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">short_name, name</property>
    <property name="Top">69</property>
    <property name="Width">710</property>
    <property name="OnRowData">gridDataRowData</property>
    <property name="jsOnSelect">gridDataJSSelect</property>
  </object>
  <object class="Query" name="sqlCompany_tax_model" >
        <property name="Left">69</property>
        <property name="Top">334</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_tax_model</property>
    <property name="OrderField">company_id, tax_model_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:7:{i:0;s:83:&quot;SELECT DISTINCT company.company_id, company.short_name, company.dh_legacy_tax_type,&quot;;i:1;s:132:&quot;                    company_tax_model.presentation_type_cd, vw_accountant_manager.accounting_provider_name, tax_model.tax_model_name&quot;;i:2;s:12:&quot;FROM company&quot;;i:3;s:99:&quot;                  INNER JOIN company_tax_model ON company.company_id = company_tax_model.company_id&quot;;i:4;s:97:&quot;                  INNER JOIN tax_model ON company_tax_model.tax_model_id = tax_model.tax_model_id&quot;;i:5;s:130:&quot;                  LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id&quot;;i:6;s:0:&quot;&quot;;}]]></property>
  </object>
  <object class="Datasource" name="dsInvoice_accounting" >
        <property name="Left">69</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlCompany_tax_model</property>
    <property name="Name">dsInvoice_accounting</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">664</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">665</property>
        <property name="Top">248</property>
    <property name="Images"><![CDATA[a:8:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;3&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;4&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;5&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;s:1:&quot;6&quot;;s:26:&quot;images/ftp/upload18x18.png&quot;;s:1:&quot;7&quot;;s:23:&quot;images/ftp/zip18x18.png&quot;;s:1:&quot;8&quot;;s:28:&quot;images/button/view_16x16.png&quot;;}]]></property>
    <property name="Name">ImageList</property>
  </object>
  <object class="JTExpandPanel" name="pnParameter" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">69</property>
    <property name="HideText">Hide parameters</property>
    <property name="Name">pnParameter</property>
    <property name="NextControl">gridData</property>
    <property name="ShowText">Show parameters</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Width">708</property>
    <object class="ComboBox" name="cbMonth" >
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">89</property>
      <property name="Name">cbMonth</property>
      <property name="Top">33</property>
      <property name="Width">131</property>
    </object>
    <object class="Label" name="lbMonth" >
      <property name="Caption">Month/Year</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbMonth</property>
      <property name="Top">37</property>
      <property name="Width">75</property>
    </object>
    <object class="Button" name="btnViewdata" >
      <property name="Caption">View data</property>
      <property name="Height">25</property>
      <property name="Left">291</property>
      <property name="Name">btnViewdata</property>
      <property name="Top">31</property>
      <property name="Width">75</property>
      <property name="OnClick">btnViewdataClick</property>
      <property name="jsOnClick">btnViewdataJSClick</property>
    </object>
    <object class="ComboBox" name="cbYear" >
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">224</property>
      <property name="Name">cbYear</property>
      <property name="Top">33</property>
      <property name="Width">59</property>
    </object>
    <object class="Image" name="imXLS" >
      <property name="Border">0</property>
      <property name="Height">24</property>
      <property name="Hint">Export</property>
      <property name="ImageSource">images/button/xls.png</property>
      <property name="Left">371</property>
      <property name="Link"></property>
      <property name="LinkTarget"></property>
      <property name="Name">imXLS</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Stretch">1</property>
      <property name="Top">32</property>
      <property name="Width">24</property>
      <property name="OnClick">imXLSClick</property>
    </object>
  </object>
</object>
?>
