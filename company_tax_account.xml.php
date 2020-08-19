<?php
<object class="company_tax_account" name="company_tax_account" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Parameters accounting</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">713</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_tax_account</property>
  <property name="UseAjax">1</property>
  <property name="Width">600</property>
  <property name="OnCreate">company_tax_accountCreate</property>
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
    <property name="Caption">Upload account</property>
    <property name="Height">179</property>
    <property name="Left">127</property>
    <property name="Name">winUpload</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">335</property>
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
      <object class="ComboBox" name="col_accounting_code" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items"><![CDATA[a:27:{i:0;s:0:&quot;&quot;;i:1;s:1:&quot;A&quot;;i:2;s:1:&quot;B&quot;;i:3;s:1:&quot;C&quot;;i:4;s:1:&quot;D&quot;;i:5;s:1:&quot;E&quot;;i:6;s:1:&quot;F&quot;;i:7;s:1:&quot;G&quot;;i:8;s:1:&quot;H&quot;;i:9;s:1:&quot;I&quot;;i:10;s:1:&quot;J&quot;;i:11;s:1:&quot;K&quot;;i:12;s:1:&quot;L&quot;;i:13;s:1:&quot;M&quot;;i:14;s:1:&quot;N&quot;;i:15;s:1:&quot;O&quot;;i:16;s:1:&quot;P&quot;;i:17;s:1:&quot;Q&quot;;i:18;s:1:&quot;R&quot;;i:19;s:1:&quot;S&quot;;i:20;s:1:&quot;T&quot;;i:21;s:1:&quot;U&quot;;i:22;s:1:&quot;V&quot;;i:23;s:1:&quot;W&quot;;i:24;s:1:&quot;X&quot;;i:25;s:1:&quot;Y&quot;;i:26;s:1:&quot;Z&quot;;}]]></property>
        <property name="Left">123</property>
        <property name="Name">col_accounting_code</property>
        <property name="TabOrder">2</property>
        <property name="Top">18</property>
        <property name="Width">44</property>
      </object>
      <object class="JTLabel" name="lbAccounting_code" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Accounting Code</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbAccounting_code</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">107</property>
      </object>
      <object class="JTLabel" name="lbBeginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Beginning of row</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">178</property>
        <property name="Name">lbBeginning_row</property>
        <property name="SiteTheme"></property>
        <property name="Top">50</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbType_operation" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Type of operation</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">178</property>
        <property name="Name">lbType_operation</property>
        <property name="SiteTheme"></property>
        <property name="Top">20</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTax_rate" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax rate</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbTax_rate</property>
        <property name="SiteTheme"></property>
        <property name="Top">50</property>
        <property name="Width">91</property>
      </object>
      <object class="ComboBox" name="col_type_operation" >
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items"><![CDATA[a:27:{i:0;s:0:&quot;&quot;;i:1;s:1:&quot;A&quot;;i:2;s:1:&quot;B&quot;;i:3;s:1:&quot;C&quot;;i:4;s:1:&quot;D&quot;;i:5;s:1:&quot;E&quot;;i:6;s:1:&quot;F&quot;;i:7;s:1:&quot;G&quot;;i:8;s:1:&quot;H&quot;;i:9;s:1:&quot;I&quot;;i:10;s:1:&quot;J&quot;;i:11;s:1:&quot;K&quot;;i:12;s:1:&quot;L&quot;;i:13;s:1:&quot;M&quot;;i:14;s:1:&quot;N&quot;;i:15;s:1:&quot;O&quot;;i:16;s:1:&quot;P&quot;;i:17;s:1:&quot;Q&quot;;i:18;s:1:&quot;R&quot;;i:19;s:1:&quot;S&quot;;i:20;s:1:&quot;T&quot;;i:21;s:1:&quot;U&quot;;i:22;s:1:&quot;V&quot;;i:23;s:1:&quot;W&quot;;i:24;s:1:&quot;X&quot;;i:25;s:1:&quot;Y&quot;;i:26;s:1:&quot;Z&quot;;}]]></property>
        <property name="Left">178</property>
        <property name="Name">col_type_operation</property>
        <property name="TabOrder">3</property>
        <property name="Top">18</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_tax_rate" >
        <property name="Height">21</property>
        <property name="ItemIndex">0</property>
        <property name="Items"><![CDATA[a:27:{i:0;s:0:&quot;&quot;;i:1;s:1:&quot;A&quot;;i:2;s:1:&quot;B&quot;;i:3;s:1:&quot;C&quot;;i:4;s:1:&quot;D&quot;;i:5;s:1:&quot;E&quot;;i:6;s:1:&quot;F&quot;;i:7;s:1:&quot;G&quot;;i:8;s:1:&quot;H&quot;;i:9;s:1:&quot;I&quot;;i:10;s:1:&quot;J&quot;;i:11;s:1:&quot;K&quot;;i:12;s:1:&quot;L&quot;;i:13;s:1:&quot;M&quot;;i:14;s:1:&quot;N&quot;;i:15;s:1:&quot;O&quot;;i:16;s:1:&quot;P&quot;;i:17;s:1:&quot;Q&quot;;i:18;s:1:&quot;R&quot;;i:19;s:1:&quot;S&quot;;i:20;s:1:&quot;T&quot;;i:21;s:1:&quot;U&quot;;i:22;s:1:&quot;V&quot;;i:23;s:1:&quot;W&quot;;i:24;s:1:&quot;X&quot;;i:25;s:1:&quot;Y&quot;;i:26;s:1:&quot;Z&quot;;}]]></property>
        <property name="Left">123</property>
        <property name="Name">col_tax_rate</property>
        <property name="TabOrder">4</property>
        <property name="Top">50</property>
        <property name="Width">44</property>
      </object>
      <object class="JTAdvancedEdit" name="beginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">21</property>
        <property name="Left">163</property>
        <property name="MaxLength">3</property>
        <property name="Name">beginning_row</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">5</property>
        <property name="Text">0</property>
        <property name="Top">50</property>
        <property name="ValidationRegExp">/[0-9]/</property>
        <property name="Width">44</property>
      </object>
    </object>
    <object class="Button" name="btnCloseUpload" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">22</property>
      <property name="Left">297</property>
      <property name="Name">btnCloseUpload</property>
      <property name="TabOrder">7</property>
      <property name="Top">148</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseUploadJSClick</property>
    </object>
    <object class="Button" name="btnImport" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Import</property>
      <property name="Height">22</property>
      <property name="Left">215</property>
      <property name="Name">btnImport</property>
      <property name="TabOrder">6</property>
      <property name="Top">148</property>
      <property name="Width">75</property>
      <property name="OnClick">btnImportClick</property>
    </object>
    <object class="Label" name="lbError" >
      <property name="Height">13</property>
      <property name="Left">9</property>
      <property name="Name">lbError</property>
      <property name="Top">153</property>
      <property name="Width">190</property>
    </object>
    <object class="Upload" name="Upload_accounting" >
      <property name="Height">21</property>
      <property name="Left">9</property>
      <property name="Name">Upload_accounting</property>
      <property name="Top">29</property>
      <property name="Width">363</property>
    </object>
  </object>
  <object class="JTGroupBox" name="cbDefault_account" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Accounting parameters</property>
    <property name="Height">235</property>
    <property name="Left">7</property>
    <property name="Name">cbDefault_account</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">23</property>
    <property name="Width">575</property>
    <object class="Edit" name="account_provider" >
      <property name="Height">19</property>
      <property name="Left">153</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_provider</property>
      <property name="TabOrder">6</property>
      <property name="Top">166</property>
      <property name="Width">90</property>
    </object>
    <object class="JTDatePicker" name="accountant_period_last_closed_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">21</property>
      <property name="Left">153</property>
      <property name="Name">accountant_period_last_closed_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">107</property>
      <property name="Width">127</property>
    </object>
    <object class="Label" name="lbAccountant_period_last_closed_dt" >
      <property name="Caption">Period last closed</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbAccountant_period_last_closed_dt</property>
      <property name="Top">111</property>
      <property name="Width">130</property>
    </object>
    <object class="Label" name="lbDefault_tax_rate" >
      <property name="Caption">Default tax rate</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbDefault_tax_rate</property>
      <property name="Top">82</property>
      <property name="Width">130</property>
    </object>
    <object class="Label" name="lbTax_regime" >
      <property name="Caption">Tax regime</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbTax_regime</property>
      <property name="Top">53</property>
      <property name="Width">130</property>
    </object>
    <object class="Label" name="lbDigit_account" >
      <property name="Caption">Digit account</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbDigit_account</property>
      <property name="Top">25</property>
      <property name="Width">130</property>
    </object>
    <object class="ComboBox" name="tax_rate_id" >
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">153</property>
      <property name="Name">tax_rate_id</property>
      <property name="TabOrder">3</property>
      <property name="Top">78</property>
      <property name="Width">127</property>
    </object>
    <object class="JTAdvancedEdit" name="digit_account" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">153</property>
      <property name="MaxLength">2</property>
      <property name="Name">digit_account</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">1</property>
      <property name="Top">20</property>
      <property name="ValidationRegExp">/[0-9]/</property>
      <property name="Width">51</property>
    </object>
    <object class="Label" name="lbAccount_provider" >
      <property name="Caption">Default provider account</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbAccount_provider</property>
      <property name="Top">169</property>
      <property name="Width">130</property>
    </object>
    <object class="Label" name="lbAccount_client" >
      <property name="Caption">Default client account</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbAccount_client</property>
      <property name="Top">142</property>
      <property name="Width">130</property>
    </object>
    <object class="Edit" name="account_client" >
      <property name="Height">19</property>
      <property name="Left">153</property>
      <property name="MaxLength">12</property>
      <property name="Name">account_client</property>
      <property name="TabOrder">5</property>
      <property name="Top">136</property>
      <property name="Width">90</property>
    </object>
    <object class="ComboBox" name="tax_regime_id" >
      <property name="Height">22</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">153</property>
      <property name="Name">tax_regime_id</property>
      <property name="TabOrder">2</property>
      <property name="Top">48</property>
      <property name="Width">127</property>
      <property name="OnChange">tax_regime_idChange</property>
    </object>
    <object class="JTGroupBox" name="gbIncomeAccounts" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Income accounts</property>
      <property name="Height">201</property>
      <property name="Left">302</property>
      <property name="Name">gbIncomeAccounts</property>
      <property name="SiteTheme"></property>
      <property name="Top">20</property>
      <property name="Width">260</property>
      <object class="Label" name="lbAccount_sale" >
        <property name="Caption">Account of sale</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbAccount_sale</property>
        <property name="Top">22</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_sale" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_sale</property>
        <property name="TabOrder">7</property>
        <property name="Top">19</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbAccount_sale_within_europe" >
        <property name="Caption">Account sale within europe</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbAccount_sale_within_europe</property>
        <property name="Top">51</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_sale_within_europe" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_sale_within_europe</property>
        <property name="TabOrder">8</property>
        <property name="Top">48</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbAccount_sale_outside_europe" >
        <property name="Caption">Account sale outside europe</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbAccount_sale_outside_europe</property>
        <property name="Top">81</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_sale_outside_europe" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_sale_outside_europe</property>
        <property name="TabOrder">9</property>
        <property name="Top">78</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbAccount_transport" >
        <property name="Caption">Account transport</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbAccount_transport</property>
        <property name="Top">112</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_transport" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_transport</property>
        <property name="TabOrder">9</property>
        <property name="Top">109</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbOther_income" >
        <property name="Caption">Account other income</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbOther_income</property>
        <property name="Top">141</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_other_income" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_other_income</property>
        <property name="TabOrder">10</property>
        <property name="Top">138</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbaccount_client_withholding" >
        <property name="Caption">Retenciones de clientes</property>
        <property name="Height">13</property>
        <property name="Left">10</property>
        <property name="Name">lbaccount_client_withholding</property>
        <property name="Top">168</property>
        <property name="Width">145</property>
      </object>
      <object class="Edit" name="account_client_withholding" >
        <property name="Height">19</property>
        <property name="Left">162</property>
        <property name="MaxLength">12</property>
        <property name="Name">account_client_withholding</property>
        <property name="TabOrder">11</property>
        <property name="Top">165</property>
        <property name="Width">90</property>
      </object>
    </object>
    <object class="Label" name="lbCompanyCodeAccounting" >
      <property name="Caption">Company code accounting</property>
      <property name="Height">13</property>
      <property name="Left">13</property>
      <property name="Name">lbCompanyCodeAccounting</property>
      <property name="Top">201</property>
      <property name="Width">130</property>
    </object>
    <object class="JTAdvancedEdit" name="company_code_accounting" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">153</property>
      <property name="MaskChar"></property>
      <property name="MaxLength">5</property>
      <property name="Name">company_code_accounting</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">1</property>
      <property name="Top">196</property>
      <property name="ValidationRegExp">/[0-9]/</property>
      <property name="Width">90</property>
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridCompany_tax_account" >
    <property name="AjaxRefreshAll">1</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns">a:0:{}</property>
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
    <property name="Datasource">dsCompany_tax_account</property>
    <property name="EvenRowStyle">
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    </property>
    <property name="FillWidth">0</property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font"><![CDATA[a:9:{s:6:&quot;Family&quot;;s:0:&quot;&quot;;s:4:&quot;Size&quot;;s:0:&quot;&quot;;s:10:&quot;LineHeight&quot;;s:0:&quot;&quot;;s:5:&quot;Style&quot;;s:0:&quot;&quot;;s:4:&quot;Case&quot;;s:0:&quot;&quot;;s:7:&quot;Variant&quot;;s:0:&quot;&quot;;s:5:&quot;Color&quot;;s:0:&quot;&quot;;s:5:&quot;Align&quot;;s:6:&quot;taNone&quot;;s:6:&quot;Weight&quot;;s:0:&quot;&quot;;}]]></property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    <property name="Visible">0</property>
    </property>
    <property name="Height">275</property>
    <property name="KeyField">company_tax_account_id</property>
    <property name="Left">7</property>
    <property name="Name">gridCompany_tax_account</property>
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
    <property name="SiteTheme">SiteTheme</property>
    <property name="SortBy">account_cd</property>
    <property name="TabOrder">12</property>
    <property name="Top">290</property>
    <property name="Width">575</property>
    <property name="OnInsert">gridCompany_tax_accountUpdate</property>
    <property name="OnUpdate">gridCompany_tax_accountUpdate</property>
    <property name="jsOnSelect">gridCompany_tax_accountJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnTaxAccount" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">30</property>
    <property name="ImageList">ImageList</property>
    <property name="Items"><![CDATA[a:1:{s:13:&quot;JTToolButton1&quot;;a:3:{i:0;s:13:&quot;JTToolButton1&quot;;i:1;s:1:&quot;1&quot;;i:2;s:0:&quot;&quot;;}}]]></property>
    <property name="Left">7</property>
    <property name="Name">btnTaxAccount</property>
    <property name="SiteTheme"></property>
    <property name="Top">268</property>
    <property name="Width">575</property>
    <property name="OnClick">btnTaxAccountClick</property>
    <property name="jsOnClick">btnTaxAccountJSClick</property>
  </object>
  <object class="HiddenField" name="rowSelected" >
    <property name="Height">18</property>
    <property name="Left">464</property>
    <property name="Name">rowSelected</property>
    <property name="Width">200</property>
  </object>
  <object class="Button" name="btnClose" >
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">424</property>
    <property name="Name">btnClose</property>
    <property name="Top">576</property>
    <property name="Visible">0</property>
    <property name="Width">75</property>
  </object>
  <object class="Button" name="btnSave" >
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">507</property>
    <property name="Name">btnSave</property>
    <property name="Top">576</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveClick</property>
    <property name="jsOnClick">btnSaveJSClick</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">505</property>
        <property name="Top">408</property>
    <property name="Images"><![CDATA[a:5:{s:1:&quot;1&quot;;s:27:&quot;images/button/add_16x16.png&quot;;s:1:&quot;2&quot;;s:28:&quot;images/button/edit_16x16.png&quot;;s:1:&quot;3&quot;;s:30:&quot;images/button/cancel_16x16.png&quot;;s:1:&quot;4&quot;;s:28:&quot;images/button/save_16x16.png&quot;;s:1:&quot;5&quot;;s:30:&quot;images/button/delete_16x16.png&quot;;}]]></property>
    <property name="Name">ImageList</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">568</property>
        <property name="Top">408</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCompany_tax_account" >
        <property name="Left">61</property>
        <property name="Top">636</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_tax_account</property>
    <property name="Params"><![CDATA[a:1:{i:0;s:10:&quot;company_id&quot;;}]]></property>
    <property name="SQL"><![CDATA[a:5:{i:0;s:74:&quot;SELECT company_tax_account.*, tax_type_key.tax_type_name, tax_rate.rate_no&quot;;i:1;s:25:&quot;FROM company_tax_account &quot;;i:2;s:93:&quot;INNER JOIN tax_type_key ON company_tax_account.tax_type_key_id = tax_type_key.tax_type_key_id&quot;;i:3;s:77:&quot;INNER JOIN tax_rate ON company_tax_account.tax_rate_id = tax_rate.tax_rate_id&quot;;i:4;s:40:&quot;WHERE company_tax_account.company_id = ?&quot;;}]]></property>
    <property name="TableName">company_tax_account</property>
  </object>
  <object class="Datasource" name="dsCompany_tax_account" >
        <property name="Left">61</property>
        <property name="Top">655</property>
    <property name="DataSet">sqlCompany_tax_account</property>
    <property name="Name">dsCompany_tax_account</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">201</property>
        <property name="Top">638</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_type_key</property>
    <property name="Params"><![CDATA[a:1:{i:0;s:10:&quot;country_id&quot;;}]]></property>
    <property name="SQL"><![CDATA[a:4:{i:0;s:8:&quot;SELECT *&quot;;i:1;s:17:&quot;FROM tax_type_key&quot;;i:2;s:20:&quot;Where country_id = ?&quot;;i:3;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">tax_type_key</property>
  </object>
  <object class="Datasource" name="dsTax_type_key" >
        <property name="Left">201</property>
        <property name="Top">657</property>
    <property name="DataSet">sqlTax_type_key</property>
    <property name="Name">dsTax_type_key</property>
  </object>
  <object class="Query" name="sqlTax_rate" >
        <property name="Left">317</property>
        <property name="Top">641</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_rate</property>
    <property name="OrderField">tax_regime_id, rate_no</property>
    <property name="Params"><![CDATA[a:1:{i:0;s:10:&quot;country_id&quot;;}]]></property>
    <property name="SQL"><![CDATA[a:4:{i:0;s:33:&quot;Select * from vw_tax_rate_country&quot;;i:1;s:20:&quot;Where country_id = ?&quot;;i:2;s:0:&quot;&quot;;i:3;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">tax_rate</property>
  </object>
  <object class="Datasource" name="dsTax_rate" >
        <property name="Left">317</property>
        <property name="Top">660</property>
    <property name="DataSet">sqlTax_rate</property>
    <property name="Name">dsTax_rate</property>
  </object>
  <object class="Query" name="sqlTax_regime" >
        <property name="Left">64</property>
        <property name="Top">565</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_regime</property>
    <property name="OrderField">regime_name</property>
    <property name="Params"><![CDATA[a:1:{i:0;s:10:&quot;country_id&quot;;}]]></property>
    <property name="SQL"><![CDATA[a:2:{i:0;s:24:&quot;Select * from tax_regime&quot;;i:1;s:20:&quot;Where country_id = ?&quot;;}]]></property>
    <property name="TableName">tax_regime</property>
  </object>
  <object class="Datasource" name="dsTax_regime" >
        <property name="Left">64</property>
        <property name="Top">582</property>
    <property name="DataSet">sqlTax_regime</property>
    <property name="Name">dsTax_regime</property>
  </object>
</object>
?>
