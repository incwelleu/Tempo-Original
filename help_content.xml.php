<?php
<object class="help_content" name="help_content" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">help content</property>
  <property name="DocType">dtNone</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">help_content</property>
  <property name="UseAjax">1</property>
  <property name="Width">722</property>
  <property name="OnCreate">help_contentCreate</property>
  <object class="JTDivWindow" name="winProcess" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative"></property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="BorderIcons">
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">Design answer</property>
    <property name="Height">352</property>
    <property name="Left">32</property>
    <property name="Name">winProcess</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">67</property>
    <property name="Width">659</property>
  </object>
  <object class="JTPlatinumGrid" name="gridHelp_content" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:12:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:641:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:9:&quot;TextField&quot;;s:12:&quot;country_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:7:&quot;Country&quot;;s:9:&quot;DataField&quot;;s:10:&quot;country_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;country_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;110&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:654:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:14:&quot;directory_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Directory&quot;;s:9:&quot;DataField&quot;;s:12:&quot;directory_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;directory_id&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:629:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditorType&quot;;s:8:&quot;ComboBox&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:13:&quot;category_name&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Category&quot;;s:9:&quot;DataField&quot;;s:16:&quot;help_category_id&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:16:&quot;help_category_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:3;a:2:{i:0;s:27:&quot;JTPlatinumGridBooleanColumn&quot;;i:1;s:560:&quot;a:12:{s:13:&quot;DisplayFormat&quot;;s:8:&quot;CheckBox&quot;;s:9:&quot;FalseText&quot;;s:2:&quot;No&quot;;s:8:&quot;TrueText&quot;;s:3:&quot;Yes&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:15:&quot;Clients can see&quot;;s:9:&quot;DataField&quot;;s:18:&quot;clients_can_see_yn&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:18:&quot;clients_can_see_yn&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:570:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;100&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Question&quot;;s:9:&quot;DataField&quot;;s:8:&quot;question&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:8:&quot;question&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;350&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridMemoColumn&quot;;i:1;s:463:&quot;a:11:{s:5:&quot;Limit&quot;;s:10:&quot;Characters&quot;;s:9:&quot;WordLimit&quot;;s:1:&quot;0&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:6:&quot;Answer&quot;;s:9:&quot;DataField&quot;;s:6:&quot;answer&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:6:&quot;answer&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;350&quot;;}&quot;;}i:6;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:599:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:4:&quot;Sort&quot;;s:9:&quot;DataField&quot;;s:7:&quot;sort_no&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:7:&quot;sort_no&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;60&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:622:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:11:&quot;user_create&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Created by&quot;;s:9:&quot;DataField&quot;;s:18:&quot;created_by_user_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:18:&quot;created_by_user_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:8;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:449:&quot;a:10:{s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:13:&quot;Creation date&quot;;s:9:&quot;DataField&quot;;s:11:&quot;creation_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:11:&quot;creation_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:617:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;TextField&quot;;s:13:&quot;user_modified&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Modified&quot;;s:9:&quot;DataField&quot;;s:16:&quot;last_mod_user_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:16:&quot;last_mod_user_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:10;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:449:&quot;a:10:{s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:13:&quot;Modified date&quot;;s:9:&quot;DataField&quot;;s:11:&quot;last_mod_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:11:&quot;last_mod_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:11;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:548:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;DataField&quot;;s:15:&quot;help_content_id&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:15:&quot;help_content_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}}]]></property>
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
    <property name="Datasource">dsHelp_content</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">398</property>
    <property name="KeyField">help_content_id</property>
    <property name="Name">gridHelp_content</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="SortBy">directory_id, sort_no</property>
    <property name="Top">52</property>
    <property name="Width">715</property>
    <property name="OnInsert">gridHelp_contentInsert</property>
    <property name="OnRowData">gridHelp_contentRowData</property>
    <property name="OnSQL">gridHelp_contentSQL</property>
    <property name="OnShow">gridHelp_contentShow</property>
    <property name="OnUpdate">gridHelp_contentUpdate</property>
    <property name="jsOnSelect">gridHelp_contentJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnHelp" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:1:{s:10:&quot;btnRefresh&quot;;a:3:{i:0;s:7:&quot;Refresh&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;1&quot;;}}]]></property>
    <property name="Name">btnHelp</property>
    <property name="SiteTheme"></property>
    <property name="Top">23</property>
    <property name="Width">715</property>
    <property name="OnClick">btnHelpClick</property>
    <property name="jsOnClick">btnHelpJSClick</property>
  </object>
  <object class="HiddenField" name="rowHelp" >
    <property name="Height">18</property>
    <property name="Left">600</property>
    <property name="Name">rowHelp</property>
    <property name="Width">107</property>
  </object>
  <object class="HiddenField" name="type_help" >
    <property name="Height">18</property>
    <property name="Left">384</property>
    <property name="Name">type_help</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">536</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlHelp_content" >
        <property name="Left">32</property>
        <property name="Top">296</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlHelp_content</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:26:&quot;Select * from help_content&quot;;}]]></property>
    <property name="TableName">help_content</property>
  </object>
  <object class="Datasource" name="dsHelp_content" >
        <property name="Left">32</property>
        <property name="Top">312</property>
    <property name="DataSet">sqlHelp_content</property>
    <property name="Name">dsHelp_content</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">603</property>
        <property name="Top">140</property>
    <property name="Images"><![CDATA[a:8:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:27:&quot;images/button/add_16x16.png&quot;;s:1:&quot;3&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;4&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;5&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;6&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;s:1:&quot;7&quot;;s:35:&quot;images/button/design_html_16x16.png&quot;;s:1:&quot;8&quot;;s:28:&quot;images/button/view_16x16.png&quot;;}]]></property>
    <property name="Name">ImageList</property>
  </object>
</object>
?>
