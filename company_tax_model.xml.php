<?php
<object class="company_tax_model" name="company_tax_model" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Company tax models</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">496</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_tax_model</property>
  <property name="UseAjax">1</property>
  <property name="Width">779</property>
  <property name="OnCreate">company_tax_modelCreate</property>
  <property name="OnShow">company_tax_modelShow</property>
  <object class="JTPlatinumGrid" name="gridCompany_tax_model" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:7:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:571:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:9:"Tax model";s:9:"DataField";s:14:"tax_model_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"tax_model_name";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:635:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:12:"Presentation";s:9:"DataField";s:20:"presentation_type_cd";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:20:"presentation_type_cd";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:525:"a:10:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"255";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"Caption";s:5:"Notes";s:9:"DataField";s:5:"notes";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:5:"notes";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:3;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:528:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:16:"Submit tax model";s:9:"DataField";s:19:"submit_tax_model_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:19:"submit_tax_model_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:557:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Description";s:9:"DataField";s:11:"description";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"description";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"320";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:552:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:9:"Tax model";s:9:"DataField";s:12:"tax_model_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"tax_model_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:596:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:20:"company_tax_model_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:20:"company_tax_model_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}</property>
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
    <property name="Datasource">dsCompany_tax_model</property>
    <property name="DetailView">
    <property name="DetailField">tax_model_id</property>
    <property name="DetailGrid">gridVirtual_file</property>
    <property name="Enabled">1</property>
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="Visible">0</property>
    </property>
    <property name="Height">443</property>
    <property name="KeyField">company_tax_model_id</property>
    <property name="Name">gridCompany_tax_model</property>
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
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">presentation_type_cd, tax_model_name</property>
    <property name="Top">50</property>
    <property name="Width">770</property>
    <property name="OnRowData">gridCompany_tax_modelRowData</property>
    <property name="OnSQL">gridCompany_tax_modelSQL</property>
    <property name="OnShow">gridCompany_tax_modelShow</property>
    <property name="jsOnRowEditing">gridCompany_tax_modelJSRowEditing</property>
    <property name="jsOnSelect">gridCompany_tax_modelJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnTaxModel" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnTaxModel</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">770</property>
    <property name="OnClick">btnTaxModelClick</property>
    <property name="jsOnClick">btnTaxModelJSClick</property>
  </object>
  <object class="JTPlatinumGrid" name="gridVirtual_file" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Top">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:3:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:621:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:14:"HyperlinkField";s:4:"link";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:9:"Tax model";s:9:"DataField";s:4:"name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"name";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"300";}";}i:1;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:464:"a:10:{s:6:"Format";s:11:"Y-m-d H:i:s";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:16:"Upload file date";s:9:"DataField";s:10:"created_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"created_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:596:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:7:"Caption";s:12:"tax_model_id";s:9:"DataField";s:12:"tax_model_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"tax_model_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}</property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsVirtual_file</property>
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
    <property name="Height">161</property>
    <property name="KeyField">nodo_id</property>
    <property name="Left">51</property>
    <property name="Name">gridVirtual_file</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">name desc</property>
    <property name="Top">251</property>
    <property name="Visible">0</property>
    <property name="Width">519</property>
    <property name="OnSQL">gridVirtual_fileSQL</property>
    <property name="jsOnSelect">gridVirtual_fileJSSelect</property>
  </object>
  <object class="HiddenField" name="tax_model_id" >
    <property name="Height">18</property>
    <property name="Left">64</property>
    <property name="Name">tax_model_id</property>
    <property name="Top">376</property>
    <property name="Width">200</property>
  </object>
  <object class="JTDivWindow" name="winAddTaxModel" >
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
    <property name="Caption">Add tax models</property>
    <property name="Height">43</property>
    <property name="Left">642</property>
    <property name="Name">winAddTaxModel</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">328</property>
    <property name="Width">91</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">720</property>
        <property name="Top">424</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany_tax_model" >
        <property name="Left">352</property>
        <property name="Top">102</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_tax_model</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:42:"SELECT company_tax_model.*, tax_model_name";i:1;s:102:"FROM company_tax_model INNER JOIN tax_model ON company_tax_model.tax_model_id = tax_model.tax_model_id";}</property>
    <property name="TableName">company_tax_model</property>
  </object>
  <object class="Datasource" name="dsCompany_tax_model" >
        <property name="Left">352</property>
        <property name="Top">118</property>
    <property name="DataSet">sqlCompany_tax_model</property>
    <property name="Name">dsCompany_tax_model</property>
  </object>
  <object class="Query" name="sqlVirtual_file" >
        <property name="Left">416</property>
        <property name="Top">334</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlVirtual_file</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:5:{i:0;s:138:"SELECT DISTINCT tax_model_id, virtual_file.company_id, virtual_file.nodo_id, virtual_file.name, virtual_file.created_dt, virtual_file.link";i:1;s:17:"FROM virtual_file";i:2;s:106:"     INNER JOIN tax_model on (LOCATE(CONCAT(" ", tax_model.`tax_model_name`, " "), virtual_file.name) > 0)";i:3;s:42:"WHERE virtual_file.link like '%/modelos/%'";i:4;s:0:"";}]]></property>
    <property name="TableName">virtual_file</property>
  </object>
  <object class="Datasource" name="dsVirtual_file" >
        <property name="Left">416</property>
        <property name="Top">350</property>
    <property name="DataSet">sqlVirtual_file</property>
    <property name="Name">dsVirtual_file</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">16</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Top">475</property>
    <property name="Width">200</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">600</property>
        <property name="Top">248</property>
    <property name="Images">a:7:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
</object>
?>
