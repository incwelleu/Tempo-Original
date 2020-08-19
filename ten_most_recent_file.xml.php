<?php
<object class="ten_most_recent_file" name="ten_most_recent_file" baseclass="Page">
  <property name="Background"></property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Font">
  <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
  <property name="Size"></property>
  </property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">ten_most_recent_file</property>
  <property name="UseAjax">1</property>
  <property name="Width">727</property>
  <property name="OnCreate">ten_most_recent_fileCreate</property>
  <property name="OnShow">ten_most_recent_fileShow</property>
  <object class="JTBevel" name="pnInformation" >
    <property name="Anchors">
    <property name="Left">0</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">225</property>
    <property name="Left">397</property>
    <property name="Name">pnInformation</property>
    <property name="SiteTheme"></property>
    <property name="Width">323</property>
    <object class="JTDivWindow" name="winInformation" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative"></property>
      <property name="Right">1</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="BorderIcons">
      <property name="Close">0</property>
      <property name="Help">0</property>
      <property name="Maximize">0</property>
      <property name="Minimize">0</property>
      </property>
      <property name="BorderStyle">bsNone</property>
      <property name="Height">221</property>
      <property name="Name">winInformation</property>
      <property name="SiteTheme"></property>
      <property name="StartVisible">1</property>
      <property name="Width">321</property>
      <property name="jsOnShow">winInformationJSShow</property>
      <object class="Label" name="lbTitulo" >
        <property name="Height">20</property>
        <property name="Name">lbTitulo</property>
        <property name="Style">jtbb jtdivwindowtitlebar jtdivwindowtitlebar_bsSingle</property>
        <property name="Width">321</property>
      </object>
      <object class="Label" name="lbAcct_manager" >
        <property name="Caption"><![CDATA[<STRONG>Account manager:</STRONG>]]></property>
        <property name="Height">27</property>
        <property name="Left">5</property>
        <property name="Name">lbAcct_manager</property>
        <property name="Top">28</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbHR_manager" >
        <property name="Caption"><![CDATA[<STRONG>Human resources team:</STRONG>]]></property>
        <property name="Height">15</property>
        <property name="Left">5</property>
        <property name="Name">lbHR_manager</property>
        <property name="Top">64</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbOverview_payroll" >
        <property name="Caption">Overview of payroll service</property>
        <property name="Height">15</property>
        <property name="Left">5</property>
        <property name="LinkTarget">fmMain</property>
        <property name="Name">lbOverview_payroll</property>
        <property name="Top">85</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbAccounting_team" >
        <property name="Caption"><![CDATA[<STRONG>Accounting team:</STRONG>]]></property>
        <property name="Height">15</property>
        <property name="Left">5</property>
        <property name="Name">lbAccounting_team</property>
        <property name="Top">109</property>
        <property name="Width">310</property>
      </object>
      <object class="Label" name="lbOverview_accounting" >
        <property name="Caption">Overview of accounting service</property>
        <property name="Height">15</property>
        <property name="Left">5</property>
        <property name="LinkTarget">fmMain</property>
        <property name="Name">lbOverview_accounting</property>
        <property name="Top">136</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbOur_phone" >
        <property name="Caption"><![CDATA[<STRONG>Our phone:</STRONG>  935 218 522]]></property>
        <property name="Height">15</property>
        <property name="Left">5</property>
        <property name="Name">lbOur_phone</property>
        <property name="Top">160</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbGive_feedback" >
        <property name="Caption"><![CDATA[<STRONG>Give feedback about our service or client area:</STRONG>]]></property>
        <property name="Height">31</property>
        <property name="Left">5</property>
        <property name="Name">lbGive_feedback</property>
        <property name="Top">182</property>
        <property name="Visible">0</property>
        <property name="Width">300</property>
      </object>
      <object class="Label" name="lbYourContacts" >
        <property name="Autosize">1</property>
        <property name="Caption">Your contacts</property>
        <property name="Font">
        <property name="Size">12px</property>
        <property name="Weight">bold</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">5</property>
        <property name="Name">lbYourContacts</property>
        <property name="ParentFont">0</property>
        <property name="Top">3</property>
        <property name="Width">235</property>
      </object>
    </object>
  </object>
  <object class="JTPanel" name="pnNews" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">208</property>
    <property name="Include">news.php</property>
    <property name="Left">-1</property>
    <property name="Name">pnNews</property>
    <property name="SiteTheme"></property>
    <property name="Top">242</property>
    <property name="Width">721</property>
  </object>
  <object class="JTPlatinumGrid" name="gridDocuments" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:1:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:622:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:14:"HyperlinkField";s:4:"link";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:4:"name";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:4:"name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}}</property>
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
    <property name="Datasource">dsDocuments</property>
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
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">225</property>
    <property name="KeyField">nodo_id</property>
    <property name="Name">gridDocuments</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">10</property>
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">1</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Width">391</property>
    <property name="OnSQL">gridDocumentsSQL</property>
  </object>
  <object class="Label" name="lbLastTen" >
    <property name="Autosize">1</property>
    <property name="Caption">Ten most recent files</property>
    <property name="Font">
    <property name="Size">12px</property>
    <property name="Weight">bold</property>
    </property>
    <property name="Height">13</property>
    <property name="Left">5</property>
    <property name="Name">lbLastTen</property>
    <property name="ParentFont">0</property>
    <property name="Top">4</property>
    <property name="Width">235</property>
  </object>
  <object class="Query" name="sqlDocuments" >
        <property name="Left">32</property>
        <property name="Top">128</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="Name">sqlDocuments</property>
    <property name="Order">desc</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:26:"Select * from Virtual_file";i:1;s:0:"";}</property>
    <property name="TableName">virtual_file</property>
  </object>
  <object class="Datasource" name="dsDocuments" >
        <property name="Left">32</property>
        <property name="Top">144</property>
    <property name="DataSet">sqlDocuments</property>
    <property name="Name">dsDocuments</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">528</property>
        <property name="Top">256</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
</object>
?>
