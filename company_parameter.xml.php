<?php
<object class="company_parameter" name="company_parameter" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Company parameter</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">503</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_parameter</property>
  <property name="Width">751</property>
  <property name="OnCreate">company_parameterCreate</property>
  <property name="OnShow">company_parameterShow</property>
  <object class="JTPlatinumGrid" name="gridCompany_tax" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowInsert">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:12:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:673:&quot;a:17:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Rate (%) &quot;;s:9:&quot;DataField&quot;;s:7:&quot;rate_no&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:7:&quot;rate_no&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;60&quot;;}&quot;;}i:1;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:560:&quot;a:14:{s:7:&quot;Display&quot;;s:8:&quot;DateOnly&quot;;s:6:&quot;Format&quot;;s:5:&quot;Y-m-d&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Apply of tax&quot;;s:9:&quot;DataField&quot;;s:15:&quot;apply_of_tax_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:15:&quot;apply_of_tax_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:640:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:16:&quot;Account&lt;/br&gt;paid&quot;;s:9:&quot;DataField&quot;;s:12:&quot;account_paid&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;account_paid&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:685:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:31:&quot;Account paid&lt;/br&gt;Taxable person&quot;;s:9:&quot;DataField&quot;;s:27:&quot;account_paid_taxable_person&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:27:&quot;account_paid_taxable_person&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:682:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:30:&quot;Account paid&lt;/br&gt;within europe&quot;;s:9:&quot;DataField&quot;;s:26:&quot;account_paid_within_europe&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:26:&quot;account_paid_within_europe&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:685:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:31:&quot;Account paid&lt;/br&gt;outside europe&quot;;s:9:&quot;DataField&quot;;s:27:&quot;account_paid_outside_europe&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:27:&quot;account_paid_outside_europe&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:6;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:689:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:33:&quot;Account paid&lt;/br&gt;Adqusicion goods&quot;;s:9:&quot;DataField&quot;;s:28:&quot;account_paid_adqusicion_good&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:28:&quot;account_paid_adqusicion_good&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:652:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:20:&quot;Account&lt;/br&gt;received&quot;;s:9:&quot;DataField&quot;;s:16:&quot;account_received&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:16:&quot;account_received&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:8;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:697:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:35:&quot;Account received&lt;/br&gt;Taxable person&quot;;s:9:&quot;DataField&quot;;s:31:&quot;account_received_taxable_person&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:31:&quot;account_received_taxable_person&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:694:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:34:&quot;Account received&lt;/br&gt;within europe&quot;;s:9:&quot;DataField&quot;;s:30:&quot;account_received_within_europe&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:30:&quot;account_received_within_europe&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:10;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:697:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:35:&quot;Account received&lt;/br&gt;outside europe&quot;;s:9:&quot;DataField&quot;;s:31:&quot;account_received_outside_europe&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:31:&quot;account_received_outside_europe&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:11;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:701:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:31:&quot;a:1:{s:9:&quot;MaxLength&quot;;s:2:&quot;12&quot;;}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:9:&quot;CanSelect&quot;;b:0;s:7:&quot;CanSort&quot;;b:0;s:7:&quot;Caption&quot;;s:37:&quot;Account received&lt;/br&gt;adqusicion goods&quot;;s:9:&quot;DataField&quot;;s:32:&quot;account_received_adqusicion_good&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:32:&quot;account_received_adqusicion_good&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}}]]></property>
    <property name="CommandBar">
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="Datasource">dsCompany_tax</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">271</property>
    <property name="KeyField">company_tax_id</property>
    <property name="Left">6</property>
    <property name="Name">gridCompany_tax</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">50</property>
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">50</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">rate_no</property>
    <property name="Top">163</property>
    <property name="Width">740</property>
    <property name="OnSQL">gridCompany_taxSQL</property>
    <property name="OnUpdate">gridCompany_taxUpdate</property>
    <property name="jsOnSelect">gridCompany_taxJSSelect</property>
  </object>
  <object class="Button" name="btnSave_parameter_accounting" >
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">671</property>
    <property name="Name">btnSave_parameter_accounting</property>
    <property name="Top">467</property>
    <property name="Visible">0</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSave_parameter_accountingClick</property>
  </object>
  <object class="JTGroupBox" name="cbDefault_account" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Default account</property>
    <property name="Height">155</property>
    <property name="Left">6</property>
    <property name="Name">cbDefault_account</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Width">740</property>
    <object class="JTDatePicker" name="accountant_period_last_closed_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">21</property>
      <property name="Left">99</property>
      <property name="Name">accountant_period_last_closed_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">102</property>
      <property name="Width">127</property>
    </object>
    <object class="Label" name="lbAccountant_period_last_closed_dt" >
      <property name="Autosize">1</property>
      <property name="Caption">Period last closed</property>
      <property name="Height">13</property>
      <property name="Left">6</property>
      <property name="Name">lbAccountant_period_last_closed_dt</property>
      <property name="Top">106</property>
      <property name="Width">85</property>
    </object>
    <object class="Label" name="lbDefault_tax_rate" >
      <property name="Autosize">1</property>
      <property name="Caption">Default tax rate</property>
      <property name="Height">13</property>
      <property name="Left">6</property>
      <property name="Name">lbDefault_tax_rate</property>
      <property name="Top">77</property>
      <property name="Width">85</property>
    </object>
    <object class="Label" name="lbTax_regime" >
      <property name="Caption">Taxl regime</property>
      <property name="Height">13</property>
      <property name="Left">6</property>
      <property name="Name">lbTax_regime</property>
      <property name="Top">48</property>
      <property name="Width">85</property>
    </object>
    <object class="JTLookupComboBox" name="tax_regime_id" >
      <property name="AllowEmpty">0</property>
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">99</property>
      <property name="LookupDataField">tax_regime_id</property>
      <property name="LookupDataSource">dsTax_regime</property>
      <property name="LookupField">regime_name</property>
      <property name="Name">tax_regime_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">10</property>
      <property name="Top">44</property>
      <property name="Width">127</property>
    </object>
    <object class="Edit" name="account_sale" >
      <property name="Height">19</property>
      <property name="Left">389</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_sale</property>
      <property name="TabOrder">1</property>
      <property name="Top">44</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_sale" >
      <property name="Caption">Account sale</property>
      <property name="Height">13</property>
      <property name="Left">239</property>
      <property name="Name">lbAccount_sale</property>
      <property name="Top">48</property>
      <property name="Width">145</property>
    </object>
    <object class="Label" name="lbAccount_sale_within_europe" >
      <property name="Caption">Account sale within europe</property>
      <property name="Height">13</property>
      <property name="Left">239</property>
      <property name="Name">lbAccount_sale_within_europe</property>
      <property name="Top">77</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_sale_within_europe" >
      <property name="Height">19</property>
      <property name="Left">389</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_sale_within_europe</property>
      <property name="TabOrder">2</property>
      <property name="Top">73</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_sale_outside_europe" >
      <property name="Caption">Account sale outside europe</property>
      <property name="Height">13</property>
      <property name="Left">239</property>
      <property name="Name">lbAccount_sale_outside_europe</property>
      <property name="Top">106</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_sale_outside_europe" >
      <property name="Height">19</property>
      <property name="Left">389</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_sale_outside_europe</property>
      <property name="TabOrder">3</property>
      <property name="Top">102</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_transport" >
      <property name="Caption">Account transport</property>
      <property name="Height">13</property>
      <property name="Left">496</property>
      <property name="Name">lbAccount_transport</property>
      <property name="Top">48</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_transport" >
      <property name="Height">19</property>
      <property name="Left">619</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_transport</property>
      <property name="TabOrder">6</property>
      <property name="Top">44</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbOther_income" >
      <property name="Caption">Account other income</property>
      <property name="Height">13</property>
      <property name="Left">496</property>
      <property name="Name">lbOther_income</property>
      <property name="Top">77</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_other_income" >
      <property name="Height">19</property>
      <property name="Left">619</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_other_income</property>
      <property name="TabOrder">7</property>
      <property name="Top">73</property>
      <property name="Width">90</property>
    </object>
    <object class="Edit" name="account_client" >
      <property name="Height">19</property>
      <property name="Left">389</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_client</property>
      <property name="Top">15</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_client" >
      <property name="Caption">Account client</property>
      <property name="Height">13</property>
      <property name="Left">239</property>
      <property name="Name">lbAccount_client</property>
      <property name="Top">19</property>
      <property name="Width">145</property>
    </object>
    <object class="Label" name="lbAccount_provider" >
      <property name="Caption">Account provider</property>
      <property name="Height">13</property>
      <property name="Left">496</property>
      <property name="Name">lbAccount_provider</property>
      <property name="Top">19</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_provider" >
      <property name="Height">19</property>
      <property name="Left">619</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_provider</property>
      <property name="TabOrder">5</property>
      <property name="Top">15</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbaccount_client_withholding" >
      <property name="Caption">Account client withholding</property>
      <property name="Height">13</property>
      <property name="Left">496</property>
      <property name="Name">lbaccount_client_withholding</property>
      <property name="Top">106</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_client_withholding" >
      <property name="Height">19</property>
      <property name="Left">619</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_client_withholding</property>
      <property name="TabOrder">8</property>
      <property name="Top">102</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_affected_not_subjet" >
      <property name="Caption">Account affected not subjet</property>
      <property name="Height">13</property>
      <property name="Left">239</property>
      <property name="Name">lbAccount_affected_not_subjet</property>
      <property name="Top">134</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_affected_not_subjet_tax" >
      <property name="Height">19</property>
      <property name="Left">389</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_affected_not_subjet_tax</property>
      <property name="TabOrder">4</property>
      <property name="Top">130</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbAccount_endured_not_subjet_tax" >
      <property name="Caption">Account endured not subjet</property>
      <property name="Height">13</property>
      <property name="Left">496</property>
      <property name="Name">lbAccount_endured_not_subjet_tax</property>
      <property name="Top">134</property>
      <property name="Width">145</property>
    </object>
    <object class="Edit" name="account_endured_not_subjet_tax" >
      <property name="Height">19</property>
      <property name="Left">619</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_endured_not_subjet_tax</property>
      <property name="TabOrder">9</property>
      <property name="Top">130</property>
      <property name="Width">90</property>
    </object>
    <object class="Label" name="lbDigit_account" >
      <property name="Autosize">1</property>
      <property name="Caption">Digit account</property>
      <property name="Height">13</property>
      <property name="Left">6</property>
      <property name="Name">lbDigit_account</property>
      <property name="Top">19</property>
      <property name="Width">75</property>
    </object>
    <object class="ComboBox" name="tax_rate_id" >
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">99</property>
      <property name="Name">tax_rate_id</property>
      <property name="Top">73</property>
      <property name="Width">127</property>
    </object>
    <object class="JTAdvancedEdit" name="digit_account" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">99</property>
      <property name="MaxLength">2</property>
      <property name="Name">digit_account</property>
      <property name="SiteTheme"></property>
      <property name="Top">15</property>
      <property name="ValidationRegExp">/[0-9]/</property>
      <property name="Width">51</property>
    </object>
  </object>
  <object class="Button" name="btnClose_parameter_accounting" >
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">591</property>
    <property name="Name">btnClose_parameter_accounting</property>
    <property name="Top">467</property>
    <property name="Visible">0</property>
    <property name="Width">75</property>
    <property name="OnClick">btnClose_parameter_accountingClick</property>
  </object>
  <object class="HiddenField" name="rowCompanyTax" >
    <property name="Height">18</property>
    <property name="Left">574</property>
    <property name="Name">rowCompanyTax</property>
    <property name="Top">290</property>
    <property name="Width">141</property>
  </object>
  <object class="JTToolBar" name="btnCompanyTax" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">27</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:3:{s:7:&quot;btnEdit&quot;;a:3:{i:0;s:4:&quot;Edit&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;3&quot;;}s:7:&quot;btnSave&quot;;a:3:{i:0;s:4:&quot;Save&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;5&quot;;}s:9:&quot;btnCancel&quot;;a:3:{i:0;s:6:&quot;Cancel&quot;;i:1;s:1:&quot;1&quot;;i:2;s:1:&quot;4&quot;;}}]]></property>
    <property name="Left">6</property>
    <property name="Name">btnCompanyTax</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">432</property>
    <property name="Width">740</property>
    <property name="jsOnClick">btnCompanyTaxJSClick</property>
  </object>
  <object class="Query" name="sqlCompany_accounting" >
        <property name="Left">62</property>
        <property name="Top">302</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_accounting</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:53:&quot;Select * from company_accounting WHERE company_id = 0&quot;;}]]></property>
    <property name="TableName">company_accounting</property>
  </object>
  <object class="Datasource" name="dsCompany_accounting" >
        <property name="Left">62</property>
        <property name="Top">319</property>
    <property name="DataSet">sqlCompany_accounting</property>
    <property name="Name">dsCompany_accounting</property>
  </object>
  <object class="Datasource" name="dsTax_regime" >
        <property name="Left">179</property>
        <property name="Top">321</property>
    <property name="DataSet">sqlTax_regime</property>
    <property name="Name">dsTax_regime</property>
  </object>
  <object class="Query" name="sqlTax_regime" >
        <property name="Left">179</property>
        <property name="Top">304</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_regime</property>
    <property name="OrderField">regime_name</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:24:&quot;Select * from tax_regime&quot;;}]]></property>
    <property name="TableName">tax_regime</property>
  </object>
  <object class="Query" name="sqlCompany_tax" >
        <property name="Left">366</property>
        <property name="Top">302</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_tax</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:22:&quot;Select * from tax_rate&quot;;}]]></property>
    <property name="TableName">company_tax</property>
  </object>
  <object class="Datasource" name="dsCompany_tax" >
        <property name="Left">366</property>
        <property name="Top">319</property>
    <property name="DataSet">sqlCompany_tax</property>
    <property name="Name">dsCompany_tax</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">553</property>
        <property name="Top">307</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">453</property>
        <property name="Top">307</property>
    <property name="Images"><![CDATA[a:10:{s:1:&quot;1&quot;;s:31:&quot;images/button/refresh_16x16.png&quot;;s:1:&quot;2&quot;;s:27:&quot;images/button/add_16x16.png&quot;;s:1:&quot;3&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;4&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;5&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;6&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;s:1:&quot;7&quot;;s:28:&quot;images/button/user_16x16.png&quot;;s:1:&quot;8&quot;;s:34:&quot;images/button/accounting_16x16.png&quot;;s:1:&quot;9&quot;;s:28:&quot;images/button/bank_16x16.png&quot;;s:2:&quot;10&quot;;s:28:&quot;images/button/view_16x16.png&quot;;}]]></property>
    <property name="Name">ImageList</property>
  </object>
</object>
?>
