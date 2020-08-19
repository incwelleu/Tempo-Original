<?php
<object class="company_client" name="company_client" baseclass="Page">
  <property name="Background"></property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">450</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_client</property>
  <property name="UseAjax">1</property>
  <property name="Width">713</property>
  <property name="OnCreate">company_clientCreate</property>
  <object class="JTDivWindow" name="winMergeClient" >
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
    <property name="Caption">Merge client</property>
    <property name="Height">180</property>
    <property name="Left">139</property>
    <property name="Name">winMergeClient</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">187</property>
    <property name="Width">395</property>
    <object class="JTLabel" name="lbMessage_merge" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption"><![CDATA[If the same client appears twice, use this button to delete one entry ("Source") and transfer the invoices linked to that entry to the correct entry ("Target").<BR>]]></property>
      <property name="Datasource"></property>
      <property name="Height">48</property>
      <property name="Left">8</property>
      <property name="Name">lbMessage_merge</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taJustify</property>
      </property>
      <property name="Top">29</property>
      <property name="Width">375</property>
    </object>
    <object class="Button" name="btnCloseMerge" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">25</property>
      <property name="Left">308</property>
      <property name="Name">btnCloseMerge</property>
      <property name="Top">147</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseMergeJSClick</property>
    </object>
    <object class="Button" name="btnSaveMerge" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">228</property>
      <property name="Name">btnSaveMerge</property>
      <property name="Top">147</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveMergeClick</property>
      <property name="jsOnClick">btnSaveMergeJSClick</property>
    </object>
    <object class="Label" name="lbSourceClient" >
      <property name="Caption">Source client</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbSourceClient</property>
      <property name="Top">91</property>
      <property name="Width">75</property>
    </object>
    <object class="Label" name="lbTargetClient" >
      <property name="Caption">Target client</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbTargetClient</property>
      <property name="Top">121</property>
      <property name="Width">75</property>
    </object>
    <object class="JTLookupComboBox" name="cbSourceClient" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">88</property>
      <property name="LookupDataField">company_client_id</property>
      <property name="LookupDataSource">dsMerge_client</property>
      <property name="LookupField">client</property>
      <property name="Name">cbSourceClient</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">86</property>
      <property name="Width">295</property>
    </object>
    <object class="JTLookupComboBox" name="cbTargetClient" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">88</property>
      <property name="LookupDataField">company_client_id</property>
      <property name="LookupDataSource">dsMerge_client</property>
      <property name="LookupField">client</property>
      <property name="Name">cbTargetClient</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">115</property>
      <property name="Width">295</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winTypeTax" >
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
    <property name="Caption">winTypeTax</property>
    <property name="Height">107</property>
    <property name="Left">125</property>
    <property name="Name">winTypeTax</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">73</property>
    <property name="Width">454</property>
    <object class="JTLabel" name="lbTypeOutputTax" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">lbTypeOutputTax</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">14</property>
      <property name="Name">lbTypeOutputTax</property>
      <property name="SiteTheme"></property>
      <property name="Top">38</property>
      <property name="Width">147</property>
    </object>
    <object class="Button" name="btnSaveOutputTax" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">288</property>
      <property name="Name">btnSaveOutputTax</property>
      <property name="Top">69</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveOutputTaxClick</property>
    </object>
    <object class="Button" name="btnCloseOutputTax" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">368</property>
      <property name="Name">btnCloseOutputTax</property>
      <property name="Top">69</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseOutputTaxJSClick</property>
    </object>
    <object class="JTComboBox" name="tax_type_key_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">24</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">174</property>
      <property name="LookupDatasource">dsTax_type_key</property>
      <property name="LookupTextField">tax_type_name</property>
      <property name="LookupValueField">tax_type_key_id</property>
      <property name="Name">tax_type_key_id</property>
      <property name="SiteTheme"></property>
      <property name="Top">35</property>
      <property name="Width">269</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winUpload" >
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
    <property name="Caption">Upload client</property>
    <property name="Height">179</property>
    <property name="Left">189</property>
    <property name="Name">winUpload</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">65</property>
    <property name="Width">379</property>
    <object class="JTGroupBox" name="gbParameter" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Parameter import</property>
      <property name="Height">86</property>
      <property name="Left">9</property>
      <property name="Name">gbParameter</property>
      <property name="SiteTheme"></property>
      <property name="Top">55</property>
      <property name="Width">363</property>
      <object class="JTLabel" name="lbAccounting_code" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Accounting Code</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">176</property>
        <property name="Name">lbAccounting_code</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbBeginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Beginning of row</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">176</property>
        <property name="Name">lbBeginning_row</property>
        <property name="SiteTheme"></property>
        <property name="Top">57</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTax_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax ID</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbTax_id</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">100</property>
      </object>
      <object class="JTLabel" name="lbClient_name" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Client Name</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbClient_name</property>
        <property name="SiteTheme"></property>
        <property name="Top">57</property>
        <property name="Width">91</property>
      </object>
      <object class="ComboBox" name="col_tax_ident" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">117</property>
        <property name="Name">col_tax_ident</property>
        <property name="Top">17</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_client_name" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">117</property>
        <property name="Name">col_client_name</property>
        <property name="Top">54</property>
        <property name="Width">44</property>
      </object>
      <object class="UpDown" name="beginning_row" >
        <property name="Height">21</property>
        <property name="Left">307</property>
        <property name="Min">1</property>
        <property name="Name">beginning_row</property>
        <property name="Position">1</property>
        <property name="Top">54</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_accounting_code" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">307</property>
        <property name="Name">col_accounting_code</property>
        <property name="Top">17</property>
        <property name="Width">44</property>
      </object>
    </object>
    <object class="Button" name="btnClose" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">22</property>
      <property name="Left">297</property>
      <property name="Name">btnClose</property>
      <property name="Top">149</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseClick</property>
      <property name="jsOnClick">btnCloseJSClick</property>
    </object>
    <object class="Upload" name="Upload" >
      <property name="Height">21</property>
      <property name="Left">9</property>
      <property name="Name">Upload</property>
      <property name="Top">31</property>
      <property name="Width">363</property>
    </object>
    <object class="Button" name="btnImport" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Import</property>
      <property name="Height">22</property>
      <property name="Left">218</property>
      <property name="Name">btnImport</property>
      <property name="Top">149</property>
      <property name="Width">75</property>
      <property name="OnClick">btnImportClick</property>
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridCompany_client" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:8:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:589:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"20";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:602:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"200";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:11:"Client name";s:9:"DataField";s:11:"client_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"client_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"200";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:637:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:12:"country_name";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:7:"Country";s:9:"DataField";s:10:"country_id";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"country_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"150";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:594:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"10";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:11:"Postal code";s:9:"DataField";s:9:"postal_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"postal_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:767:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:14:"LookupComboBox";s:20:"LookupComboBoxEditor";s:150:"a:4:{s:10:"Datasource";s:14:"dsTax_type_key";s:14:"PopulateFilter";b:1;s:9:"TextField";s:13:"tax_type_name";s:10:"ValueField";s:15:"tax_type_key_id";}";s:9:"TextField";s:13:"tax_type_name";s:7:"CanMove";b:0;s:7:"Caption";s:15:"Type output tax";s:9:"DataField";s:15:"tax_type_key_id";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"tax_type_key_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:600:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"12";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"Caption";s:12:"Account code";s:9:"DataField";s:10:"account_cd";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"account_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"120";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:642:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:17:"company_client_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:17:"company_client_id";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:628:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:10:"company id";s:9:"DataField";s:10:"company_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"company_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}</property>
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
    <property name="Datasource">dsCompany_client</property>
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
    <property name="Height">395</property>
    <property name="KeyField">company_client_id</property>
    <property name="Name">gridCompany_client</property>
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
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">company_client_id desc</property>
    <property name="Top">47</property>
    <property name="Width">705</property>
    <property name="OnDelete">gridCompany_clientDelete</property>
    <property name="OnInsert">gridCompany_clientInsert</property>
    <property name="OnRowEdited">gridCompany_clientRowInserted</property>
    <property name="OnRowInserted">gridCompany_clientRowInserted</property>
    <property name="OnSQL">gridCompany_clientSQL</property>
    <property name="OnShow">gridCompany_clientShow</property>
    <property name="OnUpdate">gridCompany_clientInsert</property>
    <property name="jsOnDataLoad">gridCompany_clientJSDataLoad</property>
    <property name="jsOnSelect">gridCompany_clientJSSelect</property>
  </object>
  <object class="HiddenField" name="rowClient" >
    <property name="Height">18</property>
    <property name="Left">451</property>
    <property name="Name">rowClient</property>
    <property name="Width">200</property>
  </object>
  <object class="JTToolBar" name="btnClient" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">29</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnClient</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">23</property>
    <property name="Width">705</property>
    <property name="OnClick">btnClientClick</property>
    <property name="jsOnClick">btnClientJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">520</property>
        <property name="Top">200</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany_client" >
        <property name="Left">616</property>
        <property name="Top">360</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_client</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:28:"Select * from company_client";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Datasource" name="dsCompany_client" >
        <property name="Left">616</property>
        <property name="Top">376</property>
    <property name="DataSet">sqlCompany_client</property>
    <property name="Name">dsCompany_client</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">617</property>
        <property name="Top">304</property>
    <property name="Images">a:7:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"8";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Query" name="sqlMerge_client" >
        <property name="Left">63</property>
        <property name="Top">325</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlMerge_client</property>
    <property name="OrderField">client_name</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:3:{i:0;s:70:"SELECT company_client.*, CONCAT(client_name, ' ', tax_ident) AS client";i:1;s:19:"FROM company_client";i:2;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Datasource" name="dsMerge_client" >
        <property name="Left">63</property>
        <property name="Top">338</property>
    <property name="DataSet">sqlMerge_client</property>
    <property name="Name">dsMerge_client</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">159</property>
        <property name="Top">325</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_type_key</property>
    <property name="OrderField">tax_type_key_id</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:26:"SELECT * FROM tax_type_key";i:1;s:41:"WHERE type_tax_cd = 1 AND country_id = ? ";}</property>
    <property name="TableName">tax_type_key</property>
  </object>
  <object class="Datasource" name="dsTax_type_key" >
        <property name="Left">159</property>
        <property name="Top">338</property>
    <property name="DataSet">sqlTax_type_key</property>
    <property name="Name">dsTax_type_key</property>
  </object>
</object>
?>
