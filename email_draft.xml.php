<?php
<object class="email_draft" name="email_draft" baseclass="Page">
  <property name="Background"></property>
  <property name="BottomMargin">10%</property>
  <property name="Caption">My emails drafts</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">561</property>
  <property name="IsMaster">0</property>
  <property name="Name">email_draft</property>
  <property name="UseAjax">1</property>
  <property name="Width">716</property>
  <property name="OnCreate">email_draftCreate</property>
  <object class="JTPlatinumGrid" name="gridEmail" >
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
    <property name="Columns">a:11:{i:0;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:542:"a:13:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:5:"Sent?";s:9:"DataField";s:7:"sent_yn";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"sent_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"50";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:637:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:10:"short_name";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:7:"Company";s:9:"DataField";s:13:"to_company_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"to_company_id";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:2;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:529:"a:12:{s:6:"Format";s:11:"Y-m-d H:i:s";s:10:"TimeFormat";s:8:"tt24Hour";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:7:"Created";s:9:"DataField";s:10:"created_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"created_dt";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:3;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:453:"a:10:{s:6:"Format";s:11:"Y-m-d H:i:s";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Sent";s:9:"DataField";s:7:"sent_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"sent_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:589:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:8:"username";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"Created by";s:9:"DataField";s:7:"user_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"user_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:554:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"From";s:9:"DataField";s:10:"from_email";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"from_email";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:564:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:2:"To";s:9:"DataField";s:8:"to_email";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"to_email";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:585:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:10:"First name";s:9:"DataField";s:13:"to_first_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"to_first_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:8;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:564:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:2:"cc";s:9:"DataField";s:8:"cc_email";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"cc_email";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:567:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"200";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:7:"Subject";s:9:"DataField";s:7:"subject";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"subject";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridMemoColumn";i:1;s:410:"a:9:{s:5:"Limit";s:10:"Characters";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Body";s:9:"DataField";s:4:"body";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"body";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}</property>
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
    <property name="Datasource">dsEmail</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">310</property>
    <property name="KeyField">email_id</property>
    <property name="Left">1</property>
    <property name="Name">gridEmail</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">created_dt desc, to_company_id</property>
    <property name="Top">51</property>
    <property name="Width">710</property>
    <property name="OnRowData">gridEmailRowData</property>
    <property name="OnSQL">gridEmailSQL</property>
    <property name="OnShow">gridEmailShow</property>
    <property name="jsOnSelect">gridEmailJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnEmail" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:6:"btnAdd";a:3:{i:0;s:3:"Add";i:1;s:1:"1";i:2;s:1:"2";}}</property>
    <property name="Left">1</property>
    <property name="Name">btnEmail</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">710</property>
    <property name="OnClick">btnEmailClick</property>
    <property name="jsOnClick">btnEmailJSClick</property>
  </object>
  <object class="HiddenField" name="rowEmail" >
    <property name="Height">18</property>
    <property name="Name">rowEmail</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="email_id" >
    <property name="Height">18</property>
    <property name="Left">517</property>
    <property name="Name">email_id</property>
    <property name="Width">200</property>
  </object>
  <object class="JTLabel" name="body_email" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    <property name="Top">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Datasource"></property>
    <property name="Height">797</property>
    <property name="Left">6</property>
    <property name="Name">body_email</property>
    <property name="SiteTheme"></property>
    <property name="Top">369</property>
    <property name="Width">704</property>
    <property name="OnShow">body_emailShow</property>
  </object>
  <object class="JTDivWindow" name="winDesign_email" >
    <property name="Anchors">
    <property name="Bottom">1</property>
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
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">Design email</property>
    <property name="Height">72</property>
    <property name="Left">505</property>
    <property name="Name">winDesign_email</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">237</property>
    <property name="Width">115</property>
  </object>
  <object class="HiddenField" name="email_type" >
    <property name="Height">18</property>
    <property name="Left">272</property>
    <property name="Name">email_type</property>
    <property name="Width">200</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">448</property>
        <property name="Top">128</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlEmail" >
        <property name="Left">144</property>
        <property name="Top">240</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">0</property>
    <property name="LimitStart">50</property>
    <property name="Name">sqlEmail</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:19:"Select * from email";}</property>
    <property name="TableName">email_template</property>
  </object>
  <object class="Datasource" name="dsEmail" >
        <property name="Left">144</property>
        <property name="Top">256</property>
    <property name="DataSet">sqlEmail</property>
    <property name="Name">dsEmail</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">256</property>
        <property name="Top">141</property>
    <property name="Images">a:8:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:35:"images/button/design_html_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlProvider_contact" >
        <property name="Left">231</property>
        <property name="Top">240</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlProvider_contact</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:8:"SELECT *";i:1;s:24:"FROM vw_provider_contact";i:2;s:0:"";}</property>
    <property name="TableName">user</property>
  </object>
  <object class="Datasource" name="dsProvider_contact" >
        <property name="Left">231</property>
        <property name="Top">256</property>
    <property name="DataSet">sqlProvider_contact</property>
    <property name="Name">dsProvider_contact</property>
  </object>
</object>
?>
