<?php
<object class="ftp" name="ftp" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Server FTP</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">529</property>
  <property name="IsMaster">0</property>
  <property name="Name">ftp</property>
  <property name="UseAjax">1</property>
  <property name="Width">689</property>
  <property name="OnCreate">ftpCreate</property>
  <property name="OnShow">ftpShow</property>
  <property name="jsOnLoad">ftpJSLoad</property>
  <object class="JTPlatinumGrid" name="gridFolder" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:9:{i:0;a:2:{i:0;s:25:"JTPlatinumGridImageColumn";i:1;s:408:"a:9:{s:8:"DataType";s:8:"FileName";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:4:"icon";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";b:1;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"icon";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"32";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:615:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:14:"HyperlinkField";s:4:"link";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Name";s:9:"DataField";s:4:"name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"name";s:13:"SortDirection";s:3:"ASC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"350";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:581:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:4:"Size";s:9:"DataField";s:4:"size";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"size";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:533:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Type";s:9:"DataField";s:4:"type";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"type";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:533:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:4:"Date";s:9:"DataField";s:4:"date";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"date";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"115";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:549:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Uploaded by";s:9:"DataField";s:8:"username";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"username";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:656:"a:18:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:3:"dir";s:9:"DataField";s:3:"dir";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:3:"dir";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:692:"a:18:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:14:"HyperlinkField";s:4:"name";s:15:"HyperlinkFormat";s:21:"serverftp.php?name=%s";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:4:"link";s:9:"DataField";s:4:"link";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"link";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:8;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:475:"a:9:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"DataField";s:9:"item_name";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"item_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}</property>
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
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">476</property>
    <property name="KeyField">item_name</property>
    <property name="Name">gridFolder</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">10000</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">1</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="SiteTheme"></property>
    <property name="SortBy">dir desc, name</property>
    <property name="Top">53</property>
    <property name="Width">686</property>
    <property name="OnUpdate">gridFolderUpdate</property>
    <property name="jsOnSelect">gridFolderJSSelect</property>
  </object>
  <object class="JTDivWindow" name="winProcess" >
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="AutoScroll">1</property>
    <property name="BorderIcons">
    <property name="Close">0</property>
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="Caption">Process</property>
    <property name="Height">120</property>
    <property name="Left">95</property>
    <property name="Name">winProcess</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">269</property>
    <property name="Width">500</property>
    <object class="Label" name="lbCreateExercise" >
      <property name="Caption">lbCreateExercise</property>
      <property name="Font">
      <property name="Weight">bold</property>
      </property>
      <property name="Height">13</property>
      <property name="Layer">2</property>
      <property name="Left">12</property>
      <property name="Name">lbCreateExercise</property>
      <property name="ParentFont">0</property>
      <property name="Top">46</property>
      <property name="Width">130</property>
    </object>
    <object class="Label" name="lbCreateDirectory" >
      <property name="Caption">lbCreateDirectory</property>
      <property name="Font">
      <property name="Weight">bold</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">12</property>
      <property name="Name">lbCreateDirectory</property>
      <property name="ParentFont">0</property>
      <property name="Top">46</property>
      <property name="Width">131</property>
    </object>
    <object class="JTAdvancedEdit" name="DirCreate" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">162</property>
      <property name="Name">DirCreate</property>
      <property name="SiteTheme"></property>
      <property name="Top">41</property>
      <property name="ValidationRegExp">^[A-Z0-9 ]*$</property>
      <property name="Width">323</property>
    </object>
    <object class="Button" name="btnCreate" >
      <property name="Caption">Create</property>
      <property name="Height">25</property>
      <property name="Left">332</property>
      <property name="Name">btnCreate</property>
      <property name="Top">83</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCreateClick</property>
    </object>
    <object class="Button" name="btnClose" >
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">410</property>
      <property name="Name">btnClose</property>
      <property name="Top">83</property>
      <property name="Width">75</property>
    </object>
    <object class="JTLabel" name="lbSearchString" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Search string</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">1</property>
      <property name="Left">12</property>
      <property name="Name">lbSearchString</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">43</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbReplaceString" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Replace string</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">1</property>
      <property name="Left">12</property>
      <property name="Name">lbReplaceString</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">75</property>
      <property name="Width">80</property>
    </object>
    <object class="JTAdvancedEdit" name="search_string" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">1</property>
      <property name="Left">101</property>
      <property name="MaskChar"></property>
      <property name="Name">search_string</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">43</property>
      <property name="ValidationRegExp">^[A-Z0-9 ]*$</property>
      <property name="Width">283</property>
    </object>
    <object class="JTAdvancedEdit" name="replace_string" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">1</property>
      <property name="Left">101</property>
      <property name="Name">replace_string</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">75</property>
      <property name="ValidationRegExp">^[A-Z0-9 ]*$</property>
      <property name="Width">283</property>
    </object>
    <object class="Button" name="btnReplace" >
      <property name="Caption">Replace</property>
      <property name="Height">25</property>
      <property name="Layer">1</property>
      <property name="Left">415</property>
      <property name="Name">btnReplace</property>
      <property name="Top">39</property>
      <property name="Width">75</property>
      <property name="OnClick">btnReplaceClick</property>
    </object>
    <object class="Button" name="btnCloseReplace" >
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Layer">1</property>
      <property name="Left">415</property>
      <property name="Name">btnCloseReplace</property>
      <property name="Top">72</property>
      <property name="Width">75</property>
    </object>
    <object class="JTAdvancedEdit" name="create_exercise" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">2</property>
      <property name="Left">149</property>
      <property name="MaxLength">4</property>
      <property name="Name">create_exercise</property>
      <property name="SiteTheme"></property>
      <property name="Text">2014</property>
      <property name="Top">43</property>
      <property name="ValidationRegExp"><![CDATA[/^\d{4}$/]]></property>
      <property name="Width">51</property>
    </object>
    <object class="Button" name="btnCreateExercise" >
      <property name="Caption">Create</property>
      <property name="Height">25</property>
      <property name="Layer">2</property>
      <property name="Left">101</property>
      <property name="Name">btnCreateExercise</property>
      <property name="Top">75</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCreateExerciseClick</property>
    </object>
    <object class="Button" name="btnCloseExercise" >
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Layer">2</property>
      <property name="Left">179</property>
      <property name="Name">btnCloseExercise</property>
      <property name="Top">75</property>
      <property name="Width">75</property>
    </object>
  </object>
  <object class="JTLabel" name="lbDirectory" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">lbDirectory</property>
    <property name="Datasource"></property>
    <property name="Height">19</property>
    <property name="Name">lbDirectory</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Style">fsItalic</property>
    <property name="Weight">bolder</property>
    </property>
    <property name="Width">408</property>
  </object>
  <object class="HiddenField" name="directory_ftp" >
    <property name="Height">18</property>
    <property name="Left">442</property>
    <property name="Name">directory_ftp</property>
    <property name="Width">200</property>
  </object>
  <object class="JTToolBar" name="btnFTP" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">23</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:13:"JTToolButton1";a:3:{i:0;s:13:"JTToolButton1";i:1;s:1:"1";i:2;s:0:"";}}</property>
    <property name="Name">btnFTP</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">686</property>
    <property name="OnClick">btnFTPClick</property>
    <property name="jsOnClick">btnFTPJSClick</property>
  </object>
  <object class="JTLabel" name="lbSearch" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Search</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">5</property>
    <property name="Name">lbSearch</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Weight">bold</property>
    </property>
    <property name="Top">75</property>
    <property name="Visible">0</property>
    <property name="Width">59</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">304</property>
        <property name="Top">456</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">400</property>
        <property name="Top">467</property>
    <property name="Images">a:6:{s:1:"2";s:25:"images/ftp/prior18x18.png";s:1:"3";s:23:"images/ftp/add18x18.png";s:1:"4";s:26:"images/ftp/delete18x18.png";s:1:"0";s:26:"images/ftp/folder18x18.png";s:1:"1";s:26:"images/ftp/upload18x18.png";s:1:"5";s:23:"images/ftp/zip18x18.png";}</property>
    <property name="Name">ImageList</property>
  </object>
</object>
?>
