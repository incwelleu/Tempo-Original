<?php
<object class="upload_accounting" name="upload_accounting" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Upload accounting</property>
  <property name="DocType">dtXHTML_1_0_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">upload_accounting</property>
  <property name="UseAjax">1</property>
  <property name="Width">711</property>
  <property name="OnCreate">upload_accountingCreate</property>
  <object class="JTPlatinumGrid" name="gridUpload" >
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
    <property name="Columns"><![CDATA[a:10:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:675:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:30:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:1:&quot;4&quot;;}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:12:&quot;year_data_no&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Year of data&quot;;s:9:&quot;DataField&quot;;s:12:&quot;year_data_no&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;year_data_no&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:591:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:13:&quot;Month of data&quot;;s:9:&quot;DataField&quot;;s:13:&quot;month_data_no&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:13:&quot;month_data_no&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;90&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:579:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:14:&quot;HyperlinkField&quot;;s:4:&quot;link&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;File name&quot;;s:9:&quot;DataField&quot;;s:9:&quot;file_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:9:&quot;file_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;300&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:550:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:5:&quot;Notes&quot;;s:9:&quot;DataField&quot;;s:12:&quot;upload_notes&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;upload_notes&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;350&quot;;}&quot;;}i:4;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:556:&quot;a:13:{s:6:&quot;Format&quot;;s:11:&quot;Y-m-d H:i:s&quot;;s:10:&quot;TimeFormat&quot;;s:8:&quot;tt24Hour&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;Caption&quot;;s:17:&quot;Date&lt;/br&gt;uploaded&quot;;s:9:&quot;DataField&quot;;s:9:&quot;upload_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:9:&quot;upload_dt&quot;;s:13:&quot;SortDirection&quot;;s:4:&quot;DESC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;90&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:546:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:11:&quot;Uploaded by&quot;;s:9:&quot;DataField&quot;;s:16:&quot;uploaded_by_user&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:16:&quot;uploaded_by_user&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;90&quot;;}&quot;;}i:6;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:517:&quot;a:11:{s:7:&quot;Display&quot;;s:8:&quot;DateOnly&quot;;s:6:&quot;Format&quot;;s:5:&quot;Y-m-d&quot;;s:10:&quot;TimeFormat&quot;;s:8:&quot;tt24Hour&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:18:&quot;Date&lt;/br&gt;processed&quot;;s:9:&quot;DataField&quot;;s:12:&quot;processed_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;processed_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:549:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Processed by&quot;;s:9:&quot;DataField&quot;;s:17:&quot;processed_by_user&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:17:&quot;processed_by_user&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;90&quot;;}&quot;;}i:8;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:702:&quot;a:18:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanResize&quot;;b:0;s:9:&quot;CanScroll&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Upload Id&quot;;s:9:&quot;DataField&quot;;s:20:&quot;upload_accounting_id&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:20:&quot;upload_accounting_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:665:&quot;a:18:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:14:&quot;HyperlinkField&quot;;s:9:&quot;file_name&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanResize&quot;;b:0;s:9:&quot;CanScroll&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:4:&quot;link&quot;;s:9:&quot;DataField&quot;;s:4:&quot;link&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:4:&quot;link&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}}]]></property>
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
    <property name="Datasource">dsUpload_accounting</property>
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
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">397</property>
    <property name="KeyField">upload_accounting_id</property>
    <property name="Name">gridUpload</property>
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
    <property name="SortBy">upload_dt desc</property>
    <property name="Top">51</property>
    <property name="Width">705</property>
    <property name="OnRowData">gridUploadRowData</property>
    <property name="OnSQL">gridUploadSQL</property>
    <property name="OnUpdate">gridUploadUpdate</property>
    <property name="jsOnRowEditing">gridUploadJSRowEditing</property>
    <property name="jsOnSelect">gridUploadJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winDateProcessed" >
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
    <property name="Caption">winDateProcessed</property>
    <property name="Height">114</property>
    <property name="Left">191</property>
    <property name="Name">winDateProcessed</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">148</property>
    <property name="Width">336</property>
    <object class="Label" name="lbDateProcessed" >
      <property name="Caption">lbRegistration_change</property>
      <property name="Height">13</property>
      <property name="Left">11</property>
      <property name="Name">lbDateProcessed</property>
      <property name="Top">42</property>
      <property name="Width">150</property>
    </object>
    <object class="JTDatePicker" name="date_processed" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">161</property>
      <property name="Name">date_processed</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">36</property>
      <property name="Width">165</property>
    </object>
    <object class="Button" name="btnSaveDateProcessed" >
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">171</property>
      <property name="Name">btnSaveDateProcessed</property>
      <property name="Top">73</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveDateProcessedClick</property>
    </object>
    <object class="Button" name="btnCloseDateProcessed" >
      <property name="Caption">Close</property>
      <property name="Height">25</property>
      <property name="Left">251</property>
      <property name="Name">btnCloseDateProcessed</property>
      <property name="Top">73</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseDateProcessedJSClick</property>
    </object>
  </object>
  <object class="JTToolBar" name="btnUpload" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:1:{s:10:&quot;btnRefresh&quot;;a:3:{i:0;s:7:&quot;Refresh&quot;;i:1;s:1:&quot;1&quot;;i:2;s:0:&quot;&quot;;}}]]></property>
    <property name="Name">btnUpload</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">705</property>
    <property name="OnClick">btnUploadClick</property>
    <property name="jsOnClick">btnUploadJSClick</property>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">240</property>
    <property name="Name">company_id</property>
    <property name="Top">428</property>
    <property name="Width">120</property>
  </object>
  <object class="HiddenField" name="rowUpload" >
    <property name="Height">18</property>
    <property name="Left">370</property>
    <property name="Name">rowUpload</property>
    <property name="Top">428</property>
    <property name="Width">120</property>
  </object>
  <object class="Query" name="sqlUpload_accounting" >
        <property name="Left">40</property>
        <property name="Top">334</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlUpload_accounting</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:31:&quot;Select * from upload_accounting&quot;;}]]></property>
    <property name="TableName">upload_accounting</property>
  </object>
  <object class="Datasource" name="dsUpload_accounting" >
        <property name="Left">40</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlUpload_accounting</property>
    <property name="Name">dsUpload_accounting</property>
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
  <object class="Query" name="sqlCompany" >
        <property name="Left">176</property>
        <property name="Top">334</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany</property>
    <property name="OrderField">short_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:2:{i:0;s:56:&quot;Select company_id, short_name, company_name from company&quot;;i:1;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">176</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="JTDivWindow" name="winUpload_accounting" >
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="AutoScroll">1</property>
    <property name="BorderIcons">
    <property name="Close">0</property>
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="Caption">Upload accounting</property>
    <property name="Height">102</property>
    <property name="Left">404</property>
    <property name="Name">winUpload_accounting</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">268</property>
    <property name="Width">152</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">32</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">428</property>
    <property name="Width">200</property>
  </object>
</object>
?>
