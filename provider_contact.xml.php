<?php
<object class="provider_contact" name="provider_contact" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Provider contact</property>
  <property name="DocType">dtHTML_4_01_Transitional</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">provider_contact</property>
  <property name="UseAjax">1</property>
  <property name="Width">712</property>
  <property name="OnCreate">provider_contactCreate</property>
  <object class="JTPlatinumGrid" name="gridProvider_contact" >
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
    <property name="Columns"><![CDATA[a:13:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:610:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;100&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;First name&quot;;s:9:&quot;DataField&quot;;s:10:&quot;first_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;first_name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:1;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:637:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:23:&quot;a:1:{s:6:&quot;Values&quot;;b:0;}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;100&quot;;}&quot;;s:13:&quot;FilterOptions&quot;;b:0;s:20:&quot;LookupComboBoxEditor&quot;;s:52:&quot;a:2:{s:10:&quot;Datasource&quot;;N;s:14:&quot;PopulateFilter&quot;;b:1;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Last name&quot;;s:9:&quot;DataField&quot;;s:9:&quot;last_name&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:9:&quot;last_name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;150&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:575:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;255&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Office email&quot;;s:9:&quot;DataField&quot;;s:8:&quot;sw_email&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:8:&quot;sw_email&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:579:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;255&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Home email&quot;;s:9:&quot;DataField&quot;;s:10:&quot;home_email&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;home_email&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;200&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:546:&quot;a:10:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;100&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:11:&quot;Fixed phone&quot;;s:9:&quot;DataField&quot;;s:11:&quot;fixed_phone&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:11:&quot;fixed_phone&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:549:&quot;a:10:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:32:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:3:&quot;100&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Mobile phone&quot;;s:9:&quot;DataField&quot;;s:12:&quot;mobile_phone&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;mobile_phone&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:6;a:2:{i:0;s:27:&quot;JTPlatinumGridBooleanColumn&quot;;i:1;s:529:&quot;a:11:{s:13:&quot;DisplayFormat&quot;;s:8:&quot;CheckBox&quot;;s:9:&quot;FalseText&quot;;s:2:&quot;No&quot;;s:8:&quot;TrueText&quot;;s:3:&quot;Yes&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:19:&quot;Account&lt;/br&gt;manager&quot;;s:9:&quot;DataField&quot;;s:18:&quot;account_manager_yn&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:18:&quot;account_manager_yn&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:7;a:2:{i:0;s:27:&quot;JTPlatinumGridBooleanColumn&quot;;i:1;s:539:&quot;a:11:{s:13:&quot;DisplayFormat&quot;;s:8:&quot;CheckBox&quot;;s:9:&quot;FalseText&quot;;s:2:&quot;No&quot;;s:8:&quot;TrueText&quot;;s:3:&quot;Yes&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:23:&quot;Accountant&lt;/br&gt;manager &quot;;s:9:&quot;DataField&quot;;s:21:&quot;accountant_manager_yn&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:21:&quot;accountant_manager_yn&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:8;a:2:{i:0;s:27:&quot;JTPlatinumGridBooleanColumn&quot;;i:1;s:529:&quot;a:11:{s:13:&quot;DisplayFormat&quot;;s:8:&quot;CheckBox&quot;;s:9:&quot;FalseText&quot;;s:2:&quot;No&quot;;s:8:&quot;TrueText&quot;;s:3:&quot;Yes&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:19:&quot;Payroll&lt;/br&gt;manager&quot;;s:9:&quot;DataField&quot;;s:18:&quot;payroll_manager_yn&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:18:&quot;payroll_manager_yn&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:524:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:6:&quot;Status&quot;;s:9:&quot;DataField&quot;;s:9:&quot;status_cd&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:9:&quot;status_cd&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:10;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:525:&quot;a:11:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;User name&quot;;s:9:&quot;DataField&quot;;s:8:&quot;username&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:8:&quot;username&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:11;a:2:{i:0;s:27:&quot;JTPlatinumGridBooleanColumn&quot;;i:1;s:543:&quot;a:13:{s:13:&quot;DisplayFormat&quot;;s:8:&quot;CheckBox&quot;;s:9:&quot;FalseText&quot;;s:2:&quot;No&quot;;s:8:&quot;TrueText&quot;;s:3:&quot;Yes&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Provider?&quot;;s:9:&quot;DataField&quot;;s:10:&quot;isProvider&quot;;s:13:&quot;DefaultFilter&quot;;s:6:&quot;Equals&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;isProvider&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:12;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:702:&quot;a:18:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanResize&quot;;b:0;s:9:&quot;CanScroll&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:10:&quot;Contact ID&quot;;s:9:&quot;DataField&quot;;s:19:&quot;provider_contact_id&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:19:&quot;provider_contact_id&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:1:&quot;0&quot;;}&quot;;}}]]></property>
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
    <property name="Datasource">dsProvider_contact</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">400</property>
    <property name="KeyField">provider_contact_id</property>
    <property name="Name">gridProvider_contact</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">100</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">first_name, last_name</property>
    <property name="Top">50</property>
    <property name="Width">705</property>
    <property name="OnInsert">gridProvider_contactInsert</property>
    <property name="OnRowData">gridProvider_contactRowData</property>
    <property name="OnSQL">gridProvider_contactSQL</property>
    <property name="OnShow">gridProvider_contactShow</property>
    <property name="OnUpdate">gridProvider_contactInsert</property>
    <property name="jsOnRowEdited">gridProvider_contactJSRowEdited</property>
    <property name="jsOnSelect">gridProvider_contactJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnContact" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:1:{s:10:&quot;btnRefresh&quot;;a:3:{i:0;s:7:&quot;Refresh&quot;;i:1;s:1:&quot;1&quot;;i:2;s:0:&quot;&quot;;}}]]></property>
    <property name="Name">btnContact</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">23</property>
    <property name="Width">705</property>
    <property name="OnClick">btnContactClick</property>
    <property name="jsOnClick">btnContactJSClick</property>
  </object>
  <object class="HiddenField" name="rowContact" >
    <property name="Height">18</property>
    <property name="Left">520</property>
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
        <property name="Left">577</property>
        <property name="Top">232</property>
    <property name="Images"><![CDATA[a:8:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:27:&quot;images/button/add_16x16.png&quot;;s:1:&quot;3&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;4&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;5&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;6&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;s:1:&quot;7&quot;;s:31:&quot;images/button/invoice_16x16.png&quot;;s:1:&quot;8&quot;;s:28:&quot;images/button/view_16x16.png&quot;;}]]></property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlProvider_contact" >
        <property name="Left">104</property>
        <property name="Top">336</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlProvider_contact</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:30:&quot;Select * from provider_contact&quot;;}]]></property>
    <property name="TableName">provider_contact</property>
  </object>
  <object class="Datasource" name="dsProvider_contact" >
        <property name="Left">104</property>
        <property name="Top">355</property>
    <property name="DataSet">sqlProvider_contact</property>
    <property name="Name">dsProvider_contact</property>
  </object>
  <object class="CheckBox" name="cbIncludeInactive" >
    <property name="Caption">Include inactive users</property>
    <property name="Font">
    <property name="Size">12px</property>
    </property>
    <property name="Height">18</property>
    <property name="Left">288</property>
    <property name="Name">cbIncludeInactive</property>
    <property name="ParentFont">0</property>
    <property name="Width">203</property>
    <property name="jsOnChange">cbIncludeInactiveJSChange</property>
  </object>
</object>
?>
