<?php
<object class="relation_invoice_accounting" name="relation_invoice_accounting" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">relation_invoice_accounting</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">relation_invoice_accounting</property>
  <property name="UseAjax">1</property>
  <property name="Width">725</property>
  <property name="OnCreate">relation_invoice_accountingCreate</property>
  <object class="JTPlatinumGrid" name="gridData" >
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
    <property name="Columns"><![CDATA[a:3:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:565:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Short name&quot;;s:9:&quot;DataField&quot;;s:10:&quot;short_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;short_name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:595:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:0:&quot;&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:18:&quot;Accountant manager&quot;;s:9:&quot;DataField&quot;;s:24:&quot;accounting_provider_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:24:&quot;accounting_provider_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:544:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;DataField&quot;;s:10:&quot;company_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;company_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}}]]></property>
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
    <property name="Datasource">dsInvoice_accounting</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">352</property>
    <property name="KeyField">company_id</property>
    <property name="Left">7</property>
    <property name="Name">gridData</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">500</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">short_name</property>
    <property name="Top">98</property>
    <property name="Width">705</property>
    <property name="OnSQL">gridDataSQL</property>
  </object>
  <object class="JTExpandPanel" name="pnParameter" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">95</property>
    <property name="HideText">Hide parameters</property>
    <property name="Left">7</property>
    <property name="Name">pnParameter</property>
    <property name="ShowText">Show parameters</property>
    <property name="SiteTheme"></property>
    <property name="Top">3</property>
    <property name="Width">703</property>
    <object class="Label" name="lbFrom" >
      <property name="Caption">From</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbFrom</property>
      <property name="Top">37</property>
      <property name="Width">35</property>
    </object>
    <object class="Label" name="lbTo" >
      <property name="Caption">To</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbTo</property>
      <property name="Top">65</property>
      <property name="Width">35</property>
    </object>
    <object class="JTDatePicker" name="From_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">From_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">31</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="JTDatePicker" name="To_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">To_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">59</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="JTRadioButtonList" name="rbInvoice" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Columns">0</property>
      <property name="Height">50</property>
      <property name="ItemIndex">0</property>
      <property name="Items"><![CDATA[a:2:{i:0;s:14:&quot;Invoice issued&quot;;i:1;s:16:&quot;Invoice received&quot;;}]]></property>
      <property name="Left">217</property>
      <property name="Name">rbInvoice</property>
      <property name="SelectedItem">Invoice issued</property>
      <property name="SiteTheme"></property>
      <property name="Top">31</property>
      <property name="Width">147</property>
      <property name="jsOnClick">From_dtJSChange</property>
    </object>
    <object class="JTRadioButtonList" name="rbStatus" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Columns">0</property>
      <property name="Height">50</property>
      <property name="ItemIndex">0</property>
      <property name="Items"><![CDATA[a:2:{i:0;s:23:&quot;Pending to be accounted&quot;;i:1;s:27:&quot;Without invoices registered&quot;;}]]></property>
      <property name="Left">388</property>
      <property name="Name">rbStatus</property>
      <property name="SelectedItem">Pending to be accounted</property>
      <property name="SiteTheme"></property>
      <property name="Top">31</property>
      <property name="Width">200</property>
      <property name="jsOnClick">From_dtJSChange</property>
    </object>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">288</property>
    <property name="Name">company_id</property>
    <property name="Top">3</property>
    <property name="Width">125</property>
  </object>
  <object class="HiddenField" name="rowUpload" >
    <property name="Height">18</property>
    <property name="Left">424</property>
    <property name="Name">rowUpload</property>
    <property name="Top">3</property>
    <property name="Width">171</property>
  </object>
  <object class="Query" name="sqlInvoice_accounting" >
        <property name="Left">69</property>
        <property name="Top">334</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_accounting</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:5:{i:0;s:9:&quot;SELECT * &quot;;i:1;s:13:&quot;FROM company &quot;;i:2;s:133:&quot;INNER JOIN (SELECT accounting_provider_id AS provider_id, accounting_provider_name FROM vw_accountant_manager) AS accounting_provider&quot;;i:3;s:67:&quot;ON company.accounting_provider_id = accounting_provider.provider_id&quot;;i:4;s:0:&quot;&quot;;}]]></property>
  </object>
  <object class="Datasource" name="dsInvoice_accounting" >
        <property name="Left">69</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlInvoice_accounting</property>
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
</object>
?>
