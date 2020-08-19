<?php
<object class="user_setting" name="user_setting" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">user setting</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">424</property>
  <property name="IsMaster">0</property>
  <property name="Name">user_setting</property>
  <property name="Width">567</property>
  <property name="OnCreate">user_settingCreate</property>
  <property name="OnShow">user_settingShow</property>
  <object class="JTGroupBox" name="gbPermits" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Permits</property>
    <property name="Height">115</property>
    <property name="Left">8</property>
    <property name="Name">gbPermits</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">298</property>
    <property name="Visible">0</property>
    <property name="Width">299</property>
    <object class="CheckBox" name="can_see_real_estate_yn" >
      <property name="Caption">Can see real estate</property>
      <property name="Height">21</property>
      <property name="Left">171</property>
      <property name="Name">can_see_real_estate_yn</property>
      <property name="TabOrder">19</property>
      <property name="Top">41</property>
      <property name="Width">125</property>
    </object>
    <object class="CheckBox" name="can_see_employee_general_yn" >
      <property name="Caption">Can see Employees</property>
      <property name="Height">21</property>
      <property name="Left">3</property>
      <property name="Name">can_see_employee_general_yn</property>
      <property name="TabOrder">15</property>
      <property name="Top">41</property>
      <property name="Width">162</property>
    </object>
    <object class="CheckBox" name="can_see_accounting_yn" >
      <property name="Caption">Can see accounting</property>
      <property name="Height">21</property>
      <property name="Left">3</property>
      <property name="Name">can_see_accounting_yn</property>
      <property name="TabOrder">17</property>
      <property name="Top">89</property>
      <property name="Width">125</property>
    </object>
    <object class="CheckBox" name="can_see_companies_yn" >
      <property name="Caption">Can see Companies</property>
      <property name="Height">21</property>
      <property name="Left">3</property>
      <property name="Name">can_see_companies_yn</property>
      <property name="TabOrder">14</property>
      <property name="Top">17</property>
      <property name="Width">162</property>
    </object>
    <object class="CheckBox" name="can_modify_employee_payroll_yn" >
      <property name="Caption">Can modify employee payroll</property>
      <property name="Height">21</property>
      <property name="Left">3</property>
      <property name="Name">can_modify_employee_payroll_yn</property>
      <property name="TabOrder">16</property>
      <property name="Top">65</property>
      <property name="Width">162</property>
    </object>
    <object class="CheckBox" name="can_see_immigration_yn" >
      <property name="Caption">Can see immigration</property>
      <property name="Height">22</property>
      <property name="Left">171</property>
      <property name="Name">can_see_immigration_yn</property>
      <property name="TabOrder">20</property>
      <property name="Top">65</property>
      <property name="Width">123</property>
    </object>
    <object class="CheckBox" name="can_see_tax_forms_yn" >
      <property name="Caption">Can see tax forms</property>
      <property name="Height">21</property>
      <property name="Left">171</property>
      <property name="Name">can_see_tax_forms_yn</property>
      <property name="TabOrder">18</property>
      <property name="Top">17</property>
      <property name="Width">125</property>
    </object>
  </object>
  <object class="JTGroupBox" name="gbContact" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Contact</property>
    <property name="Height">162</property>
    <property name="Left">8</property>
    <property name="Name">gbContact</property>
    <property name="SiteTheme"></property>
    <property name="Top">25</property>
    <property name="Width">551</property>
    <object class="Label" name="lbfirst_name" >
      <property name="Caption">First name</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbfirst_name</property>
      <property name="Top">19</property>
      <property name="Width">67</property>
    </object>
    <object class="JTAdvancedEdit" name="first_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">86</property>
      <property name="Name">first_name</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">2</property>
      <property name="Top">15</property>
      <property name="Width">165</property>
    </object>
    <object class="Label" name="lbLast_name" >
      <property name="Caption">Last name</property>
      <property name="Height">13</property>
      <property name="Left">276</property>
      <property name="Name">lbLast_name</property>
      <property name="Top">19</property>
      <property name="Width">75</property>
    </object>
    <object class="JTAdvancedEdit" name="last_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">351</property>
      <property name="Name">last_name</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">3</property>
      <property name="Top">15</property>
      <property name="Width">165</property>
    </object>
    <object class="Label" name="lbFirstname_error" >
      <property name="Alignment">agLeft</property>
      <property name="Autosize">1</property>
      <property name="Caption">lbFirstname_error</property>
      <property name="Font">
      <property name="Color">Red</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbFirstname_error</property>
      <property name="ParentFont">0</property>
      <property name="Top">37</property>
      <property name="Width">243</property>
    </object>
    <object class="Label" name="lbLastname_error" >
      <property name="Alignment">agLeft</property>
      <property name="Autosize">1</property>
      <property name="Caption">lbLastname_error</property>
      <property name="Font">
      <property name="Color">Red</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">276</property>
      <property name="Name">lbLastname_error</property>
      <property name="ParentFont">0</property>
      <property name="Top">37</property>
      <property name="Width">249</property>
    </object>
    <object class="Label" name="lbEmail" >
      <property name="Caption">Email</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbEmail</property>
      <property name="Top">56</property>
      <property name="Width">67</property>
    </object>
    <object class="JTAdvancedEdit" name="email" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">86</property>
      <property name="Name">email</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">4</property>
      <property name="Top">52</property>
      <property name="Width">430</property>
      <property name="jsOnChange">emailJSChange</property>
    </object>
    <object class="Label" name="lbEmail_error" >
      <property name="Alignment">agLeft</property>
      <property name="Autosize">1</property>
      <property name="Caption">lbEmail_error</property>
      <property name="Font">
      <property name="Color">Red</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbEmail_error</property>
      <property name="ParentFont">0</property>
      <property name="Top">74</property>
      <property name="Width">517</property>
    </object>
    <object class="Label" name="lbPhone" >
      <property name="Caption">Phone</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbPhone</property>
      <property name="Top">92</property>
      <property name="Width">67</property>
    </object>
    <object class="JTAdvancedEdit" name="fixed_phone" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">86</property>
      <property name="Name">fixed_phone</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">5</property>
      <property name="Top">88</property>
      <property name="Width">165</property>
    </object>
    <object class="Label" name="lbCell" >
      <property name="Caption">Cell phone</property>
      <property name="Height">13</property>
      <property name="Left">276</property>
      <property name="Name">lbCell</property>
      <property name="Top">92</property>
      <property name="Width">75</property>
    </object>
    <object class="JTAdvancedEdit" name="mobile_phone" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">351</property>
      <property name="Name">mobile_phone</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">6</property>
      <property name="Top">88</property>
      <property name="Width">165</property>
    </object>
  </object>
  <object class="JTGroupBox" name="gbCompany" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Company</property>
    <property name="Height">107</property>
    <property name="Left">8</property>
    <property name="Name">gbCompany</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">189</property>
    <property name="Width">551</property>
    <object class="Label" name="lbCompany_name" >
      <property name="Caption">Company full name</property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbCompany_name</property>
      <property name="Top">21</property>
      <property name="Width">107</property>
    </object>
    <object class="JTAdvancedEdit" name="company_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">124</property>
      <property name="Name">company_name</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">10</property>
      <property name="Top">17</property>
      <property name="Width">415</property>
    </object>
    <object class="Label" name="lbCompany_name_error" >
      <property name="Alignment">agLeft</property>
      <property name="Autosize">1</property>
      <property name="Caption">lbCompany_name_error</property>
      <property name="Font">
      <property name="Color">Red</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">8</property>
      <property name="Name">lbCompany_name_error</property>
      <property name="ParentFont">0</property>
      <property name="Top">39</property>
      <property name="Width">531</property>
    </object>
    <object class="Label" name="lbAcct_manager" >
      <property name="Caption">Account manager</property>
      <property name="Height">11</property>
      <property name="Left">8</property>
      <property name="Name">lbAcct_manager</property>
      <property name="Top">58</property>
      <property name="Width">160</property>
    </object>
    <object class="JTComboBox" name="acct_manager_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="AutoDropDown">1</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">8</property>
      <property name="LookupDatasource">dsAccount_manager</property>
      <property name="LookupTextField">account_manager_name</property>
      <property name="LookupValueField">acct_manager_id</property>
      <property name="Name">acct_manager_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">11</property>
      <property name="Top">75</property>
      <property name="Width">160</property>
    </object>
    <object class="Label" name="lbAccounting_provider_id" >
      <property name="Caption">Accountant manager</property>
      <property name="Height">11</property>
      <property name="Left">194</property>
      <property name="Name">lbAccounting_provider_id</property>
      <property name="Top">58</property>
      <property name="Width">160</property>
    </object>
    <object class="JTComboBox" name="accounting_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="AutoDropDown">1</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">194</property>
      <property name="LookupDatasource">dsAccountant_manager</property>
      <property name="LookupTextField">accounting_provider_name</property>
      <property name="LookupValueField">accounting_provider_id</property>
      <property name="Name">accounting_provider_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">12</property>
      <property name="Top">75</property>
      <property name="Width">160</property>
    </object>
    <object class="Label" name="lbPayroll_provider_id" >
      <property name="Caption">Payroll manager</property>
      <property name="Height">11</property>
      <property name="Left">379</property>
      <property name="Name">lbPayroll_provider_id</property>
      <property name="Top">58</property>
      <property name="Width">160</property>
    </object>
    <object class="JTComboBox" name="payroll_provider_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="AutoDropDown">1</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">21</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">379</property>
      <property name="LookupDatasource">dsPayroll_manager</property>
      <property name="LookupTextField">payroll_provider_name</property>
      <property name="LookupValueField">payroll_provider_id</property>
      <property name="Name">payroll_provider_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">13</property>
      <property name="Top">75</property>
      <property name="Width">160</property>
    </object>
  </object>
  <object class="Datasource" name="dsAccountant_manager" >
        <property name="Left">61</property>
        <property name="Top">357</property>
    <property name="DataSet">sqlAccountant_manager</property>
    <property name="Name">dsAccountant_manager</property>
  </object>
  <object class="Query" name="sqlAccountant_manager" >
        <property name="Left">61</property>
        <property name="Top">368</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlAccountant_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:35:"SELECT * FROM vw_accountant_manager";i:1;s:0:"";}</property>
  </object>
  <object class="Datasource" name="dsAccount_manager" >
        <property name="Left">177</property>
        <property name="Top">357</property>
    <property name="DataSet">sqlAccount_manager</property>
    <property name="Name">dsAccount_manager</property>
  </object>
  <object class="Query" name="sqlAccount_manager" >
        <property name="Left">177</property>
        <property name="Top">370</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlAccount_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:32:"SELECT * FROM vw_account_manager";}</property>
  </object>
  <object class="Datasource" name="dsPayroll_manager" >
        <property name="Left">278</property>
        <property name="Top">357</property>
    <property name="DataSet">sqlPayroll_manager</property>
    <property name="Name">dsPayroll_manager</property>
  </object>
  <object class="Query" name="sqlPayroll_manager" >
        <property name="Left">278</property>
        <property name="Top">370</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayroll_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:32:"SELECT * FROM vw_payroll_manager";}</property>
  </object>
  <object class="Label" name="lbUsername" >
    <property name="Caption">User name</property>
    <property name="Height">13</property>
    <property name="Left">8</property>
    <property name="Name">lbUsername</property>
    <property name="Top">6</property>
    <property name="Width">67</property>
  </object>
  <object class="JTAdvancedEdit" name="username" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">21</property>
    <property name="Left">94</property>
    <property name="Name">username</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Case">caLowerCase</property>
    </property>
    <property name="TabOrder">1</property>
    <property name="Top">2</property>
    <property name="ValidationRegExp">^[A-Z0-9 ]*$</property>
    <property name="Width">165</property>
  </object>
  <object class="Label" name="lbUsername_error" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">lbUsername_error</property>
    <property name="Font">
    <property name="Color">Red</property>
    </property>
    <property name="Height">13</property>
    <property name="Left">270</property>
    <property name="Name">lbUsername_error</property>
    <property name="ParentFont">0</property>
    <property name="Top">6</property>
    <property name="Width">289</property>
  </object>
  <object class="Button" name="btnClose_setting" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">484</property>
    <property name="Name">btnClose_setting</property>
    <property name="TabOrder">23</property>
    <property name="Top">387</property>
    <property name="Width">75</property>
    <property name="OnClick">btnClose_settingClick</property>
  </object>
  <object class="JTGroupBox" name="gbRoles" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Roles</property>
    <property name="Height">58</property>
    <property name="Left">316</property>
    <property name="Name">gbRoles</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">298</property>
    <property name="Width">243</property>
    <object class="JTCheckBoxList" name="cbRoles" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Columns">2</property>
      <property name="Height">43</property>
      <property name="Items">a:4:{i:0;a:2:{i:0;s:10:"Superadmin";i:1;s:1:"0";}i:1;a:2:{i:0;s:8:"Provider";i:1;s:1:"0";}i:2;a:2:{i:0;s:12:"Client admin";i:1;s:1:"0";}i:3;a:2:{i:0;s:11:"Client user";i:1;s:1:"0";}}</property>
      <property name="Left">8</property>
      <property name="Name">cbRoles</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">21</property>
      <property name="Top">15</property>
      <property name="Width">226</property>
    </object>
  </object>
  <object class="Button" name="btnSave_setting" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">404</property>
    <property name="Name">btnSave_setting</property>
    <property name="TabOrder">22</property>
    <property name="Top">387</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSave_settingClick</property>
  </object>
  <object class="JTGroupBox" name="gbReceive_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Receive emails about</property>
    <property name="Height">39</property>
    <property name="Left">16</property>
    <property name="Name">gbReceive_email</property>
    <property name="SiteTheme"></property>
    <property name="Top">138</property>
    <property name="Width">534</property>
    <object class="CheckBox" name="receive_standard_billing_emails_yn" >
      <property name="Caption">Billing</property>
      <property name="Checked">1</property>
      <property name="Height">21</property>
      <property name="Left">6</property>
      <property name="Name">receive_standard_billing_emails_yn</property>
      <property name="TabOrder">7</property>
      <property name="Top">14</property>
      <property name="Width">147</property>
    </object>
    <object class="CheckBox" name="receive_standard_accounting_emails_yn" >
      <property name="Caption">Accounting</property>
      <property name="Checked">1</property>
      <property name="Height">21</property>
      <property name="Left">193</property>
      <property name="Name">receive_standard_accounting_emails_yn</property>
      <property name="TabOrder">8</property>
      <property name="Top">14</property>
      <property name="Width">131</property>
    </object>
    <object class="CheckBox" name="receive_standard_hr_emails_yn" >
      <property name="Caption">Payroll</property>
      <property name="Checked">1</property>
      <property name="Height">21</property>
      <property name="Left">377</property>
      <property name="Name">receive_standard_hr_emails_yn</property>
      <property name="TabOrder">9</property>
      <property name="Top">14</property>
      <property name="Width">131</property>
    </object>
  </object>
  <object class="Query" name="sqlContact" >
        <property name="Left">512</property>
        <property name="Top">50</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlContact</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:21:"Select * from contact";}</property>
    <property name="TableName">contact</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">512</property>
        <property name="Top">107</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Label" name="lbRole_error" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">lbRole_error</property>
    <property name="Font">
    <property name="Color">Red</property>
    </property>
    <property name="Height">13</property>
    <property name="Left">316</property>
    <property name="Name">lbRole_error</property>
    <property name="ParentFont">0</property>
    <property name="Top">363</property>
    <property name="Width">243</property>
  </object>
</object>
?>
