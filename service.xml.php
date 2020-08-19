<?php
<object class="service" name="service" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Services</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">499</property>
  <property name="IsMaster">0</property>
  <property name="Name">service</property>
  <property name="UseAjax">1</property>
  <property name="Width">725</property>
  <property name="OnCreate">serviceCreate</property>
  <object class="JTPlatinumGrid" name="gridService" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:13:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:796:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:14:"LookupComboBox";s:20:"LookupComboBoxEditor";s:140:"a:3:{s:10:"Datasource";s:18:"dsService_category";s:9:"TextField";s:21:"service_category_name";s:10:"ValueField";s:19:"service_category_id";}";s:9:"TextField";s:21:"service_category_name";s:7:"CanMove";b:0;s:7:"Caption";s:8:"Category";s:9:"DataField";s:19:"service_category_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:19:"service_category_id";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"110";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:588:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:11:"Description";s:9:"DataField";s:14:"description_en";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"description_en";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:608:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:12:"Price amount";s:9:"DataField";s:9:"price_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"price_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:525:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:5:"Notes";s:9:"DataField";s:5:"notes";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:5:"notes";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:561:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:4:"Sort";s:9:"DataField";s:7:"sort_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"sort_no";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"40";}";}i:5;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:584:"a:12:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:26:"Sort Service</br>Agreement";s:9:"DataField";s:25:"sort_service_agreement_yn";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:25:"sort_service_agreement_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:560:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:12:"Service type";s:9:"DataField";s:15:"service_type_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"service_type_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:7;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:526:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:16:"With supplement?";s:9:"DataField";s:18:"with_supplement_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:18:"with_supplement_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:8;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:517:"a:12:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:3:"Old";s:9:"DataField";s:6:"old_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:6:"old_yn";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"40";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:595:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:21:"Commission</br>amount";s:9:"DataField";s:14:"commission_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"commission_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:617:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:28:"Future</br>commission amount";s:9:"DataField";s:21:"future_commission_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:21:"future_commission_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:11;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:620:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.0f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:20:"Number of</br>months";s:9:"DataField";s:27:"future_commission_months_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:27:"future_commission_months_no";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"60";}";}i:12;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:562:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:2:"ID";s:9:"DataField";s:10:"service_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"service_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:2:"50";}";}}]]></property>
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
    <property name="Datasource">dsService</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">445</property>
    <property name="KeyField">service_id</property>
    <property name="Name">gridService</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">500</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">service_category_id, old_yn, sort_no</property>
    <property name="Top">51</property>
    <property name="Width">720</property>
    <property name="OnSQL">gridServiceSQL</property>
    <property name="OnShow">gridServiceShow</property>
    <property name="jsOnRowInserted">gridServiceJSRowInserted</property>
  </object>
  <object class="JTToolBar" name="btnService" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnService</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">720</property>
    <property name="OnClick">btnServiceClick</property>
    <property name="jsOnClick">btnServiceJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">24</property>
        <property name="Top">440</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">648</property>
        <property name="Top">176</property>
    <property name="Images">a:10:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:32:"images/button/calendar_16x16.png";s:1:"9";s:28:"images/button/view_16x16.png";s:2:"10";s:27:"images/button/xls_16x16.gif";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlService" >
        <property name="Left">121</property>
        <property name="Top">376</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:57:"Select service.*, service_category.service_category_name ";i:1;s:109:"From service LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id";}</property>
    <property name="TableName">service</property>
  </object>
  <object class="Datasource" name="dsService" >
        <property name="Left">121</property>
        <property name="Top">392</property>
    <property name="DataSet">sqlService</property>
    <property name="Name">dsService</property>
  </object>
  <object class="Query" name="sqlService_category" >
        <property name="Left">193</property>
        <property name="Top">376</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlService_category</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:30:"Select * from service_category";}</property>
    <property name="TableName">service</property>
  </object>
  <object class="Datasource" name="dsService_category" >
        <property name="Left">193</property>
        <property name="Top">392</property>
    <property name="DataSet">sqlService_category</property>
    <property name="Name">dsService_category</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">481</property>
    <property name="Width">200</property>
  </object>
</object>
?>
