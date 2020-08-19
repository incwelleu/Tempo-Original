<?php
<object class="report_service_tracker" name="report_service_tracker" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Report service tracker</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="GenerateDocument">0</property>
  <property name="GenerateTable">0</property>
  <property name="Height">526</property>
  <property name="IsMaster">0</property>
  <property name="Name">report_service_tracker</property>
  <property name="UseAjax">1</property>
  <property name="Width">723</property>
  <property name="OnCreate">report_service_trackerCreate</property>
  <property name="OnShowHeader">report_service_trackerShowHeader</property>
  <property name="jsOnLoad">report_service_trackerJSLoad</property>
  <object class="JTDivWindow" name="winProcess" >
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
    <property name="Caption">winProcess</property>
    <property name="Height">498</property>
    <property name="Left">28</property>
    <property name="Name">winProcess</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">17</property>
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
      <property name="Top">85</property>
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
  <object class="JTGroupBox" name="gbServiceType" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">gbServiceType</property>
    <property name="Height">73</property>
    <property name="Name">gbServiceType</property>
    <property name="SiteTheme"></property>
    <property name="Top">22</property>
    <property name="Width">715</property>
    <object class="CheckBox" name="cbIncludeInactive" >
      <property name="Caption">Include inactive users</property>
      <property name="Font">
      <property name="Size">9pt</property>
      </property>
      <property name="Height">18</property>
      <property name="Left">5</property>
      <property name="Name">cbIncludeInactive</property>
      <property name="ParentFont">0</property>
      <property name="Top">17</property>
      <property name="Width">203</property>
      <property name="jsOnChange">cbIncludeInactiveJSChange</property>
    </object>
    <object class="CheckBox" name="cbShowWorkCompleted" >
      <property name="Caption">Show work completed</property>
      <property name="Font">
      <property name="Size">9pt</property>
      </property>
      <property name="Height">18</property>
      <property name="Left">5</property>
      <property name="Name">cbShowWorkCompleted</property>
      <property name="ParentFont">0</property>
      <property name="Top">43</property>
      <property name="Width">203</property>
      <property name="jsOnChange">cbIncludeInactiveJSChange</property>
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
    <property name="Items"><![CDATA[a:1:{s:10:&quot;btnRefresh&quot;;a:3:{i:0;s:7:&quot;Refresh&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;1&quot;;}}]]></property>
    <property name="Name">btnCompany</property>
    <property name="SiteTheme"></property>
    <property name="Top">98</property>
    <property name="Width">715</property>
    <property name="OnClick">btnCompanyClick</property>
    <property name="jsOnClick">btnCompanyJSClick</property>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">240</property>
    <property name="Name">company_id</property>
    <property name="Width">123</property>
  </object>
  <object class="HiddenField" name="rowCompany" >
    <property name="Height">18</property>
    <property name="Left">600</property>
    <property name="Name">rowCompany</property>
    <property name="Width">115</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">384</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Width">200</property>
  </object>
  <object class="JTRadioButtonList" name="service_type_id" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Columns">4</property>
    <property name="Height">59</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">220</property>
    <property name="Name">service_type_id</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">29</property>
    <property name="Width">487</property>
    <property name="jsOnClick">service_type_idJSClick</property>
  </object>
  <object class="JTPlatinumGrid" name="gridCompany" >
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
    <property name="CanMoveCols">0</property>
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
    <property name="Datasource">dsCompany</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">386</property>
    <property name="KeyField">line_item_id</property>
    <property name="Name">gridCompany</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">129</property>
    <property name="Width">715</property>
    <property name="OnRowData">gridCompanyRowData</property>
    <property name="OnSQL">gridCompanySQL</property>
    <property name="OnShow">gridCompanyShow</property>
    <property name="jsOnSelect">gridCompanyJSSelect</property>
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
    <property name="Images"><![CDATA[a:3:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:28:&quot;images/button/view_16x16.png&quot;;s:1:&quot;3&quot;;s:27:&quot;images/button/xls_16X16.png&quot;;}]]></property>
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
</object>
?>
