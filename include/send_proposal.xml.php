<?php
<object class="send_proposal" name="send_proposal" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Send proposals</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">397</property>
  <property name="IsMaster">0</property>
  <property name="Name">send_proposal</property>
  <property name="TemplateEngine">SmartyTemplate</property>
  <property name="TemplateFilename">../html/template.html</property>
  <property name="UseAjax">1</property>
  <property name="Width">630</property>
  <property name="OnCreate">send_proposalCreate</property>
  <object class="Label" name="Label1" >
    <property name="Caption">Titulo</property>
    <property name="Height">13</property>
    <property name="Left">9</property>
    <property name="Name">Label1</property>
    <property name="Top">8</property>
    <property name="Width">75</property>
  </object>
  <object class="JTNavigationBar" name="JTNavigationBar1" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CssClass">.toolbar</property>
    <property name="Height">43</property>
    <property name="ImageList"></property>
    <property name="Items"><![CDATA[a:7:{s:15:&quot;JTNavBarButton1&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton1&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton2&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton2&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton3&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton3&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton4&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton4&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton5&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton5&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton6&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton6&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}s:15:&quot;JTNavBarButton7&quot;;a:4:{i:0;s:15:&quot;JTNavBarButton7&quot;;i:1;s:0:&quot;&quot;;i:2;a:0:{}i:3;s:0:&quot;&quot;;}}]]></property>
    <property name="Left">9</property>
    <property name="Name">JTNavigationBar1</property>
    <property name="SiteTheme"></property>
    <property name="Top">8</property>
    <property name="Width">613</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">48</property>
        <property name="Top">336</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlData" >
        <property name="Left">48</property>
        <property name="Top">260</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlData</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:5:{i:0;s:65:&quot;SELECT service_proposal.*, service_category.service_category_name&quot;;i:1;s:35:&quot;              FROM service_proposal&quot;;i:2;s:28:&quot;                  INNER JOIN&quot;;i:3;s:124:&quot;                    (SELECT service_category_id AS type_id, service_category_name FROM service_category) AS service_category&quot;;i:4;s:84:&quot;                  ON service_category.type_id = service_proposal.service_category_id&quot;;}]]></property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsData" >
        <property name="Left">48</property>
        <property name="Top">275</property>
    <property name="DataSet">sqlData</property>
    <property name="Name">dsData</property>
  </object>
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
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:2:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:672:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:21:&quot;service_category_name&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:16:&quot;Service category&quot;;s:9:&quot;DataField&quot;;s:19:&quot;service_category_id&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:19:&quot;service_category_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:571:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Proposal&quot;;s:9:&quot;DataField&quot;;s:13:&quot;proposal_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:13:&quot;proposal_name&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;}&quot;;}}]]></property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    </property>
    <property name="Datasource">dsData</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">317</property>
    <property name="KeyField">service_proposal_id</property>
    <property name="Left">9</property>
    <property name="Name">gridData</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme"></property>
    <property name="Top">40</property>
    <property name="Width">611</property>
    <property name="OnSort">gridDataSort</property>
  </object>
</object>
?>
