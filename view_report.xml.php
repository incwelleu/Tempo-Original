<?php
<object class="view_report" name="view_report" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">view report</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">view_report</property>
  <property name="UseAjax">1</property>
  <property name="Width">720</property>
  <property name="OnCreate">view_reportCreate</property>
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
    <property name="Columns">a:0:{}</property>
    <property name="CommandBar">
    <property name="ExportAllRecords">1</property>
    <property name="PrintAllRecords">0</property>
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    </property>
    <property name="Datasource">dsResult</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">395</property>
    <property name="Name">gridData</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">200</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">51</property>
    <property name="Width">717</property>
    <property name="OnRowData">gridDataRowData</property>
    <property name="OnSQL">gridDataSQL</property>
    <property name="OnSummaryData">gridDataSummaryData</property>
    <property name="jsOnSelect">gridDataJSSelect</property>
  </object>
  <object class="HiddenField" name="report_id" >
    <property name="Height">18</property>
    <property name="Left">392</property>
    <property name="Name">report_id</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="JTToolBar" name="btnViewReport" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"2";}}</property>
    <property name="Name">btnViewReport</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">23</property>
    <property name="Width">717</property>
    <property name="OnClick">btnViewReportClick</property>
    <property name="jsOnClick">btnViewReportJSClick</property>
  </object>
  <object class="Query" name="sqlResult" >
        <property name="Left">69</property>
        <property name="Top">334</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlResult</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:20:"Select * from report";}</property>
    <property name="TableName">report</property>
  </object>
  <object class="Datasource" name="dsResult" >
        <property name="Left">69</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlResult</property>
    <property name="Name">dsResult</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">664</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">545</property>
        <property name="Top">256</property>
    <property name="Images">a:2:{s:1:"9";s:27:"images/button/xls_16X16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
</object>
?>
