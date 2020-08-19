<?php
<object class="add_service_item_company" name="add_service_item_company" baseclass="Page">
  <property name="Background"></property>
  <property name="DocType">dtNone</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">489</property>
  <property name="IsMaster">0</property>
  <property name="Name">add_service_item_company</property>
  <property name="Width">649</property>
  <property name="OnCreate">add_service_item_companyCreate</property>
  <object class="Button" name="btnSaveService" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">478</property>
    <property name="Name">btnSaveService</property>
    <property name="Top">439</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveServiceClick</property>
    <property name="jsOnClick">btnSaveServiceJSClick</property>
  </object>
  <object class="JTPlatinumGrid" name="gridService" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:0:{}</property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsService</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">395</property>
    <property name="KeyField">service_id</property>
    <property name="Left">6</property>
    <property name="Name">gridService</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">description</property>
    <property name="Top">33</property>
    <property name="Width">627</property>
  </object>
  <object class="Label" name="lbCompany" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">Company</property>
    <property name="Font">
    <property name="Color">#34596E</property>
    <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
    <property name="Style">fsNormal</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">6</property>
    <property name="Name">lbCompany</property>
    <property name="ParentFont">0</property>
    <property name="Top">9</property>
    <property name="Width">59</property>
  </object>
  <object class="JTLookupComboBox" name="cbCompany" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">21</property>
    <property name="Left">77</property>
    <property name="LookupDataField">company_id</property>
    <property name="LookupDataSource">dsCompany</property>
    <property name="LookupField">short_name</property>
    <property name="Name">cbCompany</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">12px</property>
    </property>
    <property name="Top">7</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="SelectedKeysService" >
    <property name="Height">18</property>
    <property name="Left">248</property>
    <property name="Name">SelectedKeysService</property>
    <property name="Top">432</property>
    <property name="Width">200</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">16</property>
        <property name="Top">432</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany" >
        <property name="Left">120</property>
        <property name="Top">430</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany</property>
    <property name="OrderField">short_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:21:&quot;Select * from company&quot;;}]]></property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">120</property>
        <property name="Top">443</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="Query" name="sqlService" >
        <property name="Left">187</property>
        <property name="Top">432</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService</property>
    <property name="OrderField">description</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:6:{i:0;s:66:&quot;SELECT service.service_id, service_category.service_category_name,&quot;;i:1;s:52:&quot;             service.description_en,  as description&quot;;i:2;s:13:&quot;FROM service &quot;;i:3;s:96:&quot;LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id&quot;;i:4;s:0:&quot;&quot;;i:5;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">service</property>
  </object>
  <object class="Datasource" name="dsService" >
        <property name="Left">187</property>
        <property name="Top">443</property>
    <property name="DataSet">sqlService</property>
    <property name="Name">dsService</property>
  </object>
  <object class="Button" name="btnClose" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">558</property>
    <property name="Name">btnClose</property>
    <property name="Top">439</property>
    <property name="Width">75</property>
    <property name="OnClick">btnCloseClick</property>
  </object>
</object>
?>
