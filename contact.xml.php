<?php
<object class="contact" name="contact" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Contact</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">contact</property>
  <property name="UseAjax">1</property>
  <property name="Width">742</property>
  <property name="OnCreate">contactCreate</property>
  <object class="JTPlatinumGrid" name="gridContacts" >
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
    <property name="Columns"><![CDATA[a:13:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:579:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:10:"First name";s:9:"DataField";s:10:"first_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"first_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:606:"a:11:{s:14:"ComboBoxEditor";s:23:"a:1:{s:6:"Values";b:0;}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:13:"FilterOptions";b:0;s:20:"LookupComboBoxEditor";s:52:"a:2:{s:10:"Datasource";N;s:14:"PopulateFilter";b:1;}";s:7:"CanMove";b:0;s:7:"Caption";s:9:"Last name";s:9:"DataField";s:9:"last_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"last_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:525:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:5:"Email";s:9:"DataField";s:5:"email";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:5:"email";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:546:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:11:"Fixed phone";s:9:"DataField";s:11:"fixed_phone";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"fixed_phone";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:549:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"100";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:12:"Mobile phone";s:9:"DataField";s:12:"mobile_phone";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"mobile_phone";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:533:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"20";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:552:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:4:"Type";s:9:"DataField";s:15:"contact_type_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"contact_type_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:7;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:568:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:25:"Receive email<br/>billing";s:9:"DataField";s:34:"receive_standard_billing_emails_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:34:"receive_standard_billing_emails_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"110";}";}i:8;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:577:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:28:"Receive email<br/>accounting";s:9:"DataField";s:37:"receive_standard_accounting_emails_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:37:"receive_standard_accounting_emails_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:9;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:584:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:33:"Receive reminders </br>accounting";s:9:"DataField";s:38:"reminder_standard_accounting_emails_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:38:"reminder_standard_accounting_emails_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:10;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:557:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:25:"Receive email<br/>payroll";s:9:"DataField";s:29:"receive_standard_hr_emails_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:29:"receive_standard_hr_emails_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:11;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:580:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:2:"Si";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:37:"Receive reminders </br>personal taxes";s:9:"DataField";s:35:"reminder_standard_personal_taxes_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:35:"reminder_standard_personal_taxes_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:12;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:716:"a:19:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:10:"Contact ID";s:9:"DataField";s:10:"contact_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"contact_id";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}]]></property>
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
    <property name="Datasource">dsContact</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
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
    <property name="KeyField">contact_id</property>
    <property name="Name">gridContacts</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">contact_id desc</property>
    <property name="Top">49</property>
    <property name="Width">735</property>
    <property name="OnDelete">gridContactsDelete</property>
    <property name="OnInsert">gridContactsInsert</property>
    <property name="OnRowData">gridContactsRowData</property>
    <property name="OnSQL">gridContactsSQL</property>
    <property name="OnShow">gridContactsShow</property>
    <property name="OnUpdate">gridContactsInsert</property>
    <property name="jsOnDataLoad">gridContactsJSDataLoad</property>
    <property name="jsOnRowEdited">gridContactsJSRowEdited</property>
    <property name="jsOnRowEditing">gridContactsJSRowEditing</property>
    <property name="jsOnRowInserted">gridContactsJSRowEdited</property>
    <property name="jsOnSelect">gridContactsJSSelect</property>
  </object>
  <object class="HiddenField" name="rowContact" >
    <property name="Height">18</property>
    <property name="Left">536</property>
    <property name="Name">rowContact</property>
    <property name="Width">171</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">232</property>
        <property name="Top">344</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">417</property>
        <property name="Top">312</property>
    <property name="Images">a:8:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlContact" >
        <property name="Left">104</property>
        <property name="Top">336</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlContact</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:21:"Select * from contact";}</property>
    <property name="TableName">contact</property>
  </object>
  <object class="Datasource" name="dsContact" >
        <property name="Left">104</property>
        <property name="Top">355</property>
    <property name="DataSet">sqlContact</property>
    <property name="Name">dsContact</property>
  </object>
  <object class="JTToolBar" name="btnContact" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnContact</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">735</property>
    <property name="jsOnClick">btnContactJSClick</property>
  </object>
</object>
?>
