<?php
<object class="relation_income" name="relation_income" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Strong Weber - Companies</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Font">
  <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
  <property name="Size"></property>
  </property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">relation_income</property>
  <property name="UseAjax">1</property>
  <property name="Width">381</property>
  <property name="OnCreate">relation_incomeCreate</property>
  <property name="OnShow">relation_incomeShow</property>
  <object class="JTPlatinumGrid" name="gridResults" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:14:{i:0;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:604:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:11:&quot;Client name&quot;;s:9:&quot;DataField&quot;;s:11:&quot;client_name&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:11:&quot;client_name&quot;;s:13:&quot;SortDirection&quot;;s:3:&quot;ASC&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;250&quot;;}&quot;;}i:1;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:535:&quot;a:13:{s:7:&quot;Display&quot;;s:8:&quot;DateOnly&quot;;s:6:&quot;Format&quot;;s:5:&quot;Y-m-d&quot;;s:9:&quot;Alignment&quot;;s:8:&quot;agCenter&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:16:&quot;Invoice&lt;/br&gt;date&quot;;s:9:&quot;DataField&quot;;s:10:&quot;invoice_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;invoice_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:3:&quot;110&quot;;}&quot;;}i:2;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:620:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:14:&quot;Invoice number&quot;;s:9:&quot;DataField&quot;;s:14:&quot;invoice_number&quot;;s:13:&quot;DefaultFilter&quot;;s:8:&quot;Contains&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:14:&quot;invoice_number&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:3:&quot;120&quot;;}&quot;;}i:3;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:579:&quot;a:12:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2F&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;Caption&quot;;s:8:&quot;Subtotal&quot;;s:9:&quot;DataField&quot;;s:12:&quot;subtotal_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:12:&quot;subtotal_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:4;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:618:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2F&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:9:&quot;Transport&quot;;s:9:&quot;DataField&quot;;s:13:&quot;transport_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:13:&quot;transport_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:5;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:598:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:3:&quot;VAT&quot;;s:9:&quot;DataField&quot;;s:7:&quot;tax_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:7:&quot;tax_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:6;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:628:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Other income&quot;;s:9:&quot;DataField&quot;;s:16:&quot;other_income_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:16:&quot;other_income_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:7;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:641:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:16:&quot;Base withholding&quot;;s:9:&quot;DataField&quot;;s:20:&quot;base_withholding_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:20:&quot;base_withholding_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:8;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:639:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:16:&quot;Withholding rate&quot;;s:9:&quot;DataField&quot;;s:19:&quot;withholding_rate_no&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:19:&quot;withholding_rate_no&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:5:&quot;Width&quot;;s:3:&quot;100&quot;;}&quot;;}i:9;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:625:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:11:&quot;Withholding&quot;;s:9:&quot;DataField&quot;;s:15:&quot;withholding_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:15:&quot;withholding_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:10;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:604:&quot;a:14:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;DataFormat&quot;;s:6:&quot;%01.2f&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:9:&quot;Alignment&quot;;s:7:&quot;agRight&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:5:&quot;Total&quot;;s:9:&quot;DataField&quot;;s:9:&quot;total_amt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:9:&quot;total_amt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;b:1;}&quot;;s:5:&quot;Width&quot;;s:2:&quot;80&quot;;}&quot;;}i:11;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:574:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:12:&quot;Account code&quot;;s:9:&quot;DataField&quot;;s:10:&quot;account_cd&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:10:&quot;account_cd&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:3:&quot;110&quot;;}&quot;;}i:12;a:2:{i:0;s:28:&quot;JTPlatinumGridDateTimeColumn&quot;;i:1;s:551:&quot;a:12:{s:7:&quot;Display&quot;;s:8:&quot;DateOnly&quot;;s:6:&quot;Format&quot;;s:5:&quot;Y-m-d&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:21:&quot;Registration&lt;/br&gt;date&quot;;s:9:&quot;DataField&quot;;s:31:&quot;registered_in_acctg_software_dt&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:31:&quot;registered_in_acctg_software_dt&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:3:&quot;110&quot;;}&quot;;}i:13;a:2:{i:0;s:24:&quot;JTPlatinumGridTextColumn&quot;;i:1;s:581:&quot;a:13:{s:14:&quot;ComboBoxEditor&quot;;s:6:&quot;a:0:{}&quot;;s:10:&quot;EditEditor&quot;;s:6:&quot;a:0:{}&quot;;s:20:&quot;LookupComboBoxEditor&quot;;s:26:&quot;a:1:{s:10:&quot;Datasource&quot;;N;}&quot;;s:7:&quot;CanEdit&quot;;b:0;s:9:&quot;CanFilter&quot;;b:0;s:7:&quot;CanMove&quot;;b:0;s:7:&quot;Caption&quot;;s:11:&quot;Document ID&quot;;s:9:&quot;DataField&quot;;s:14:&quot;document_ident&quot;;s:12:&quot;GroupSummary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:4:&quot;Name&quot;;s:14:&quot;document_ident&quot;;s:7:&quot;Summary&quot;;s:98:&quot;a:5:{s:7:&quot;ShowAvg&quot;;i:0;s:9:&quot;ShowCount&quot;;i:0;s:7:&quot;ShowMax&quot;;i:0;s:7:&quot;ShowMin&quot;;i:0;s:7:&quot;ShowSum&quot;;i:0;}&quot;;s:7:&quot;Visible&quot;;b:0;s:5:&quot;Width&quot;;s:3:&quot;110&quot;;}&quot;;}}]]></property>
    <property name="CommandBar">
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    </property>
    <property name="Datasource">dsResults</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">329</property>
    <property name="Name">gridResults</property>
    <property name="OddRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">10</property>
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    <property name="VisiblePageCount">1</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">client_name</property>
    <property name="Top">121</property>
    <property name="Width">366</property>
    <property name="OnSQL">gridResultsSQL</property>
    <property name="OnSummaryData">gridResultsSummaryData</property>
  </object>
  <object class="JTExpandPanel" name="pnParameter" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">115</property>
    <property name="HideText">Hide parameters</property>
    <property name="Name">pnParameter</property>
    <property name="NextControl">gridResults</property>
    <property name="ShowText">Show parameters</property>
    <property name="SiteTheme"></property>
    <property name="Width">364</property>
    <object class="Label" name="lbFrom" >
      <property name="Caption">From</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbFrom</property>
      <property name="Top">37</property>
      <property name="Width">35</property>
    </object>
    <object class="Label" name="lbTo" >
      <property name="Caption">To</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbTo</property>
      <property name="Top">65</property>
      <property name="Width">35</property>
    </object>
    <object class="JTDatePicker" name="From_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">From_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">31</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="JTDatePicker" name="To_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">48</property>
      <property name="Name">To_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">59</property>
      <property name="Width">147</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="CheckBox" name="cbDetail" >
      <property name="Caption">Detailed income</property>
      <property name="Height">21</property>
      <property name="Left">8</property>
      <property name="Name">cbDetail</property>
      <property name="Top">87</property>
      <property name="Width">179</property>
      <property name="jsOnChange">From_dtJSChange</property>
    </object>
    <object class="Image" name="imXLS" >
      <property name="Border">0</property>
      <property name="Height">24</property>
      <property name="Hint">Export</property>
      <property name="ImageSource">images/button/xls.png</property>
      <property name="Left">171</property>
      <property name="Link"></property>
      <property name="LinkTarget"></property>
      <property name="Name">imXLS</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Stretch">1</property>
      <property name="Top">84</property>
      <property name="Width">24</property>
      <property name="OnClick">imXLSClick</property>
    </object>
    <object class="JTRadioButtonList" name="rbDateQuery" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">54</property>
      <property name="ItemIndex">1</property>
      <property name="Items"><![CDATA[a:2:{i:0;s:12:&quot;Invoice date&quot;;i:1;s:17:&quot;Registration date&quot;;}]]></property>
      <property name="Left">205</property>
      <property name="Name">rbDateQuery</property>
      <property name="SelectedItem">Registration date</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">30</property>
      <property name="Width">149</property>
      <property name="jsOnClick">From_dtJSChange</property>
    </object>
  </object>
  <object class="Query" name="sqlResults" >
        <property name="Left">240</property>
        <property name="Top">216</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="Name">sqlResults</property>
    <property name="Order">desc</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:28:&quot;Select * from invoice_issued&quot;;}]]></property>
    <property name="TableName">invoice_issued</property>
  </object>
  <object class="Datasource" name="dsResults" >
        <property name="Left">240</property>
        <property name="Top">232</property>
    <property name="DataSet">sqlResults</property>
    <property name="Name">dsResults</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">256</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
</object>
?>
