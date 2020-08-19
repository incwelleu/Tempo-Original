<?php
<object class="user" name="user" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Users</property>
  <property name="DocType">dtHTML_4_01_Transitional</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">user</property>
  <property name="UseAjax">1</property>
  <property name="Width">709</property>
  <property name="OnCreate">userCreate</property>
  <property name="OnShow">userShow</property>
  <object class="JTPlatinumGrid" name="gridUsers" >
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
    <property name="Columns"><![CDATA[a:15:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:544:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:9:"User name";s:9:"DataField";s:8:"username";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"username";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:747:"a:13:{s:14:"ComboBoxEditor";s:69:"a:1:{s:6:"Values";a:2:{s:1:"a";s:6:"Active";s:1:"i";s:8:"Inactive";}}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:13:"FilterOptions";a:4:{s:1:"a";s:6:"Active";s:1:"i";s:8:"Inactive";s:1:"o";s:10:"Old client";s:0:"";s:0:"";}s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:9:"status_cd";s:7:"CanMove";b:0;s:7:"Caption";s:6:"Status";s:9:"DataField";s:9:"status_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"status_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:548:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:8:"Language";s:9:"DataField";s:11:"language_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"language_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:3;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:519:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:21:"Can see</br>Employee?";s:9:"DataField";s:27:"can_see_employee_general_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:27:"can_see_employee_general_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"110";}";}i:4;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:508:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:5:"False";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:22:"Can see</br>Companies?";s:9:"DataField";s:20:"can_see_companies_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:20:"can_see_companies_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:5;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:553:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:32:"Can modify</br>employee payroll?";s:9:"DataField";s:30:"can_modify_employee_payroll_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:30:"can_modify_employee_payroll_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:2:"90";}";}i:6;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:508:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:23:"Can see</br>accounting?";s:9:"DataField";s:21:"can_see_accounting_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:21:"can_see_accounting_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:7;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:505:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:22:"Can see<br/>tax forms?";s:9:"DataField";s:20:"can_see_tax_forms_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:20:"can_see_tax_forms_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:8;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:511:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:24:"Can see</br>real estate?";s:9:"DataField";s:22:"can_see_real_estate_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:22:"can_see_real_estate_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:9;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:511:"a:10:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:7:"CanMove";b:0;s:7:"Caption";s:24:"Can see</br>immigration?";s:9:"DataField";s:22:"can_see_immigration_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:22:"can_see_immigration_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:589:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:16:"created_username";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:10:"Created by";s:9:"DataField";s:18:"created_by_user_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:18:"created_by_user_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:11;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:543:"a:13:{s:6:"Format";s:11:"Y-m-d H:i:s";s:10:"TimeFormat";s:8:"tt24Hour";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:12:"Date created";s:9:"DataField";s:10:"created_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"created_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:12;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:537:"a:13:{s:6:"Format";s:11:"Y-m-d H:i:s";s:10:"TimeFormat";s:8:"tt24Hour";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:12:"Last session";s:9:"DataField";s:8:"login_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"login_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:13;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:539:"a:12:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:10:"TimeFormat";s:8:"tt24Hour";s:9:"Alignment";s:8:"agCenter";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:14:"Block</br>date";s:9:"DataField";s:15:"status_block_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"status_block_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:14;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:704:"a:19:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:7:"User Id";s:9:"DataField";s:7:"user_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"user_id";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}]]></property>
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
    <property name="Datasource">dsUser</property>
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
    <property name="Height">397</property>
    <property name="KeyField">user_id</property>
    <property name="Name">gridUsers</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">user_id desc</property>
    <property name="Top">53</property>
    <property name="Width">705</property>
    <property name="OnInsert">gridUsersInsert</property>
    <property name="OnRowData">gridUsersRowData</property>
    <property name="OnRowEdited">gridUsersRowEdited</property>
    <property name="OnRowInserted">gridUsersRowEdited</property>
    <property name="OnSQL">gridUsersSQL</property>
    <property name="OnShow">gridUsersShow</property>
    <property name="OnUpdate">gridUsersInsert</property>
    <property name="jsOnDataLoad">gridUsersJSDataLoad</property>
    <property name="jsOnRowEditing">gridUsersJSRowEditing</property>
    <property name="jsOnSelect">gridUsersJSSelect</property>
  </object>
  <object class="HiddenField" name="rowUser" >
    <property name="Height">18</property>
    <property name="Left">368</property>
    <property name="Name">rowUser</property>
    <property name="Width">171</property>
  </object>
  <object class="HiddenField" name="user_id" >
    <property name="Height">18</property>
    <property name="Left">552</property>
    <property name="Name">user_id</property>
    <property name="Width">131</property>
  </object>
  <object class="Query" name="sqlUser" >
        <property name="Left">56</property>
        <property name="Top">246</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlUser</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:23:"Select user.* from user";}</property>
    <property name="TableName">user</property>
  </object>
  <object class="Datasource" name="dsUser" >
        <property name="Left">56</property>
        <property name="Top">262</property>
    <property name="DataSet">sqlUser</property>
    <property name="Name">dsUser</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">192</property>
        <property name="Top">360</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">569</property>
        <property name="Top">264</property>
    <property name="Images">a:9:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";s:1:"9";s:27:"images/button/xls_16X16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="JTToolBar" name="btnUser" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnUser</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">705</property>
    <property name="OnClick">btnUserClick</property>
    <property name="OnShow">btnUserShow</property>
    <property name="jsOnClick">btnUserJSClick</property>
  </object>
  <object class="JTDivWindow" name="winUser_setting" >
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
    <property name="Caption">User data</property>
    <property name="Height">81</property>
    <property name="Left">453</property>
    <property name="Name">winUser_setting</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">307</property>
    <property name="Width">101</property>
  </object>
</object>
?>
