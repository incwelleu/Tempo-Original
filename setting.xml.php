<?php
<object class="fmSetting" name="fmSetting" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Settings</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">693</property>
  <property name="IsMaster">0</property>
  <property name="Name">fmSetting</property>
  <property name="ShowHint">1</property>
  <property name="UseAjax">1</property>
  <property name="Width">902</property>
  <property name="OnCreate">fmSettingCreate</property>
  <property name="OnShowHeader">fmSettingShowHeader</property>
  <object class="JTPageControl" name="pcSetting" >
    <property name="ActiveLayer">TabInvoice</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">563</property>
    <property name="Name">pcSetting</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="TabIndex">2</property>
    <property name="Tabs">a:3:{i:0;a:3:{i:0;s:14:"Standard email";i:1;s:16:"TabStandardEmail";i:2;s:1:"1";}i:1;a:3:{i:0;s:17:"Service agreement";i:1;s:19:"TabServiceAgreement";i:2;s:1:"1";}i:2;a:3:{i:0;s:7:"Invoice";i:1;s:10:"TabInvoice";i:2;s:1:"1";}}</property>
    <property name="Top">99</property>
    <property name="Width">895</property>
    <object class="JTGroupBox" name="gbOtherEmails" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Other emails</property>
      <property name="Height">148</property>
      <property name="Layer">TabStandardEmail</property>
      <property name="Left">448</property>
      <property name="Name">gbOtherEmails</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">43</property>
      <property name="Width">400</property>
      <object class="JTLabel" name="lbDirector_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Director email</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Hint">Default Account manager in Ten Most Recent screen, Sender of Christmas email</property>
        <property name="Left">8</property>
        <property name="Name">lbDirector_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">46</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_director_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_director_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">181</property>
        <property name="Name">se_director_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">5</property>
        <property name="Top">44</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="JTLabel" name="lbTech_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tech support</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbTech_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">97</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_tech_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_tech_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">181</property>
        <property name="Name">se_tech_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">7</property>
        <property name="Top">95</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="JTLabel" name="lbInternal_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">"From" internal</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbInternal_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">71</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_internal_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_internal_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Hint">The"from" email for "Standard emails internal"</property>
        <property name="Left">181</property>
        <property name="Name">se_internal_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">6</property>
        <property name="Top">70</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="JTLabel" name="lbOfficePhoneNumber" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Office phone number</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbOfficePhoneNumber</property>
        <property name="SiteTheme"></property>
        <property name="Top">122</property>
        <property name="Width">110</property>
      </object>
      <object class="JTAdvancedEdit" name="se_our_phone" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_our_phone</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">181</property>
        <property name="Name">se_our_phone</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">8</property>
        <property name="Top">121</property>
        <property name="Width">200</property>
      </object>
      <object class="JTLabel" name="lbDirector_name" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Director's name</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbDirector_name</property>
        <property name="SiteTheme"></property>
        <property name="Top">21</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_director_name" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_director_name</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">181</property>
        <property name="Name">se_director_name</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">5</property>
        <property name="Top">20</property>
        <property name="Width">200</property>
      </object>
    </object>
    <object class="JTGroupBox" name="gbEmail_from_notify" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">"From" notification emails</property>
      <property name="Height">150</property>
      <property name="Layer">TabStandardEmail</property>
      <property name="Left">11</property>
      <property name="Name">gbEmail_from_notify</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">41</property>
      <property name="Width">400</property>
      <object class="JTLabel" name="lbHR_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">HR</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbHR_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">23</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_hr_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_hr_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">100</property>
        <property name="Name">se_hr_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">4</property>
        <property name="Top">21</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="Label" name="lbse_hr_email_error" >
        <property name="Alignment">agLeft</property>
        <property name="Autosize">1</property>
        <property name="Font">
        <property name="Color">Red</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">325</property>
        <property name="Name">lbse_hr_email_error</property>
        <property name="ParentFont">0</property>
        <property name="Top">26</property>
        <property name="Width">75</property>
      </object>
      <object class="JTLabel" name="lbAccounting_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Accounting</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbAccounting_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">48</property>
        <property name="Width">90</property>
      </object>
      <object class="Label" name="lbse_accounting_email_error" >
        <property name="Alignment">agLeft</property>
        <property name="Autosize">1</property>
        <property name="Font">
        <property name="Color">Red</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">325</property>
        <property name="Name">lbse_accounting_email_error</property>
        <property name="ParentFont">0</property>
        <property name="Top">50</property>
        <property name="Width">75</property>
      </object>
      <object class="JTAdvancedEdit" name="se_accounting_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_accounting_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">100</property>
        <property name="Name">se_accounting_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">4</property>
        <property name="Top">45</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="JTLabel" name="lbBilling_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Billing</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbBilling_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">73</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_billing_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_billing_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">100</property>
        <property name="Name">se_billing_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">4</property>
        <property name="Top">71</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="Label" name="lbse_billing_email_error" >
        <property name="Alignment">agLeft</property>
        <property name="Autosize">1</property>
        <property name="Font">
        <property name="Color">Red</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">325</property>
        <property name="Name">lbse_billing_email_error</property>
        <property name="ParentFont">0</property>
        <property name="Top">76</property>
        <property name="Width">75</property>
      </object>
      <object class="JTLabel" name="lbVirtualOffice_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Virtual office</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbVirtualOffice_email</property>
        <property name="SiteTheme"></property>
        <property name="Top">99</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_virtual_office_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_virtual_office_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">100</property>
        <property name="Name">se_virtual_office_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">4</property>
        <property name="Top">98</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="Label" name="lbse_virtual_office_email_error" >
        <property name="Alignment">agLeft</property>
        <property name="Autosize">1</property>
        <property name="Font">
        <property name="Color">Red</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">325</property>
        <property name="Name">lbse_virtual_office_email_error</property>
        <property name="ParentFont">0</property>
        <property name="Top">102</property>
        <property name="Width">75</property>
      </object>
      <object class="JTLabel" name="lbPersonalTax" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Personal taxes</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">8</property>
        <property name="Name">lbPersonalTax</property>
        <property name="SiteTheme"></property>
        <property name="Top">124</property>
        <property name="Width">90</property>
      </object>
      <object class="JTAdvancedEdit" name="se_personal_tax_email" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">se_personal_tax_email</property>
        <property name="DataSource">dsSetting</property>
        <property name="Height">21</property>
        <property name="Left">100</property>
        <property name="Name">se_personal_tax_email</property>
        <property name="SiteTheme"></property>
        <property name="TabOrder">4</property>
        <property name="Top">123</property>
        <property name="Width">200</property>
        <property name="jsOnChange">validate_emailJSChange</property>
      </object>
      <object class="Label" name="lbse_personal_tax_email_error" >
        <property name="Alignment">agLeft</property>
        <property name="Autosize">1</property>
        <property name="Font">
        <property name="Color">Red</property>
        </property>
        <property name="Height">13</property>
        <property name="Left">325</property>
        <property name="Name">lbse_personal_tax_email_error</property>
        <property name="ParentFont">0</property>
        <property name="Top">127</property>
        <property name="Width">75</property>
      </object>
    </object>
    <object class="Memo" name="sa_bank_details" >
      <property name="DataField">sa_bank_details</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">203</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">sa_bank_details</property>
      <property name="TabOrder">1</property>
      <property name="Top">102</property>
      <property name="Width">867</property>
    </object>
    <object class="JTLabel" name="lbBank_details" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Bank details</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">lbBank_details</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">82</property>
      <property name="Width">100</property>
    </object>
    <object class="Memo" name="sa_LOPD" >
      <property name="DataField">sa_LOPD</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">155</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">sa_LOPD</property>
      <property name="TabOrder">2</property>
      <property name="Top">338</property>
      <property name="Width">867</property>
    </object>
    <object class="JTLabel" name="lbLOPD" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Message LOPD</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">lbLOPD</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">320</property>
      <property name="Width">100</property>
    </object>
    <object class="JTLabel" name="lbAccept_message_service_agreement" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Accept message service agreement</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">lbAccept_message_service_agreement</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">516</property>
      <property name="Width">339</property>
    </object>
    <object class="JTAdvancedEdit" name="sa_accept_message_service_agreement" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">sa_accept_message_service_agreement</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">24</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">sa_accept_message_service_agreement</property>
      <property name="SiteTheme"></property>
      <property name="Top">534</property>
      <property name="Width">867</property>
    </object>
    <object class="JTLabel" name="lbStandardEmail_foot" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Standard email footer</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabStandardEmail</property>
      <property name="Left">11</property>
      <property name="Name">lbStandardEmail_foot</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">208</property>
      <property name="Width">219</property>
    </object>
    <object class="Memo" name="se_standard_email_foot" >
      <property name="DataField">se_standard_email_foot</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">323</property>
      <property name="Layer">TabStandardEmail</property>
      <property name="Left">11</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">se_standard_email_foot</property>
      <property name="TabOrder">2</property>
      <property name="Top">224</property>
      <property name="Width">867</property>
    </object>
    <object class="JTLabel" name="lbInvoiceFormat" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Invoice format</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">4</property>
      <property name="Name">lbInvoiceFormat</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">82</property>
      <property name="Width">100</property>
    </object>
    <object class="Memo" name="biller_address" >
      <property name="DataField">biller_address</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">446</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">4</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">biller_address</property>
      <property name="Top">106</property>
      <property name="Width">874</property>
    </object>
    <object class="JTLabel" name="lbDirProposal" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Directory of proposal documents</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">lbDirProposal</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">39</property>
      <property name="Width">339</property>
    </object>
    <object class="JTAdvancedEdit" name="JTAdvancedEdit1" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">dir_proposal</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">24</property>
      <property name="Layer">TabServiceAgreement</property>
      <property name="Left">11</property>
      <property name="Name">JTAdvancedEdit1</property>
      <property name="SiteTheme"></property>
      <property name="Top">56</property>
      <property name="Width">867</property>
    </object>
    <object class="JTLabel" name="lbPayment_method" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Payment method</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">4</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">48</property>
      <property name="Width">131</property>
    </object>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">payment_method_id</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">21</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">143</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dsPayment_method</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">13</property>
      <property name="Top">45</property>
      <property name="Width">260</property>
    </object>
    <object class="JTLabel" name="lbSerie" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Credit note series</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">436</property>
      <property name="Name">lbSerie</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Weight">bold</property>
      </property>
      <property name="Top">48</property>
      <property name="Width">115</property>
    </object>
    <object class="JTAdvancedEdit" name="serie_credit_note" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">serie_credit_note</property>
      <property name="DataSource">dsSetting</property>
      <property name="Height">24</property>
      <property name="Layer">TabInvoice</property>
      <property name="Left">559</property>
      <property name="Name">serie_credit_note</property>
      <property name="SiteTheme"></property>
      <property name="Top">45</property>
      <property name="Width">91</property>
    </object>
  </object>
  <object class="JTPanel" name="pnBilling_entity" >
    <property name="Anchors">
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">68</property>
    <property name="Name">pnBilling_entity</property>
    <property name="SiteTheme"></property>
    <property name="Top">24</property>
    <property name="Width">895</property>
    <object class="JTLabel" name="lbBilling_entity" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Billing entity</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">9</property>
      <property name="Name">lbBilling_entity</property>
      <property name="SiteTheme"></property>
      <property name="Top">12</property>
      <property name="Width">90</property>
    </object>
    <object class="ComboBox" name="cbBilling_entity" >
      <property name="Height">24</property>
      <property name="ItemIndex">1</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">111</property>
      <property name="Name">cbBilling_entity</property>
      <property name="Top">9</property>
      <property name="Width">283</property>
      <property name="OnChange">cbBilling_entityChange</property>
    </object>
    <object class="JTLabel" name="JTLabel1" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Company invoices</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">9</property>
      <property name="Name">JTLabel1</property>
      <property name="SiteTheme"></property>
      <property name="Top">44</property>
      <property name="Width">90</property>
    </object>
    <object class="JTLookupComboBox" name="company_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">company_id</property>
      <property name="DataSource">dsBilling_entity</property>
      <property name="Height">24</property>
      <property name="Left">111</property>
      <property name="LookupDataField">company_id</property>
      <property name="LookupDataSource">dsCompany</property>
      <property name="LookupField">short_name</property>
      <property name="Name">company_id</property>
      <property name="SelectedValue">-1</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">38</property>
      <property name="Width">283</property>
    </object>
    <object class="Button" name="btnSaveSetting" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">403</property>
      <property name="Name">btnSaveSetting</property>
      <property name="Top">34</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveSettingClick</property>
    </object>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">24</property>
        <property name="Top">711</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlSetting" >
        <property name="Left">88</property>
        <property name="Top">673</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlSetting</property>
    <property name="Params">a:1:{i:0;s:17:"billing_entity_id";}</property>
    <property name="SQL">a:3:{i:0;s:21:"SELECT * FROM setting";i:1;s:27:"WHERE billing_entity_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">setting</property>
  </object>
  <object class="Datasource" name="dsSetting" >
        <property name="Left">88</property>
        <property name="Top">687</property>
    <property name="DataSet">sqlSetting</property>
    <property name="Name">dsSetting</property>
  </object>
  <object class="Query" name="sqlBilling_entity" >
        <property name="Left">168</property>
        <property name="Top">673</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlBilling_entity</property>
    <property name="Params">a:1:{i:0;s:17:"billing_entity_id";}</property>
    <property name="SQL">a:3:{i:0;s:28:"SELECT * FROM billing_entity";i:1;s:27:"Where billing_entity_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">setting</property>
  </object>
  <object class="Datasource" name="dsBilling_entity" >
        <property name="Left">168</property>
        <property name="Top">687</property>
    <property name="DataSet">sqlBilling_entity</property>
    <property name="Name">dsBilling_entity</property>
  </object>
  <object class="Query" name="sqlCompany" >
        <property name="Left">256</property>
        <property name="Top">677</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:4:{i:0;s:21:"SELECT * FROM company";i:1;s:24:"Where company_id  in (?)";i:2;s:18:"Order by shortname";i:3;s:0:"";}</property>
    <property name="TableName">company</property>
  </object>
  <object class="Datasource" name="dsCompany" >
        <property name="Left">256</property>
        <property name="Top">687</property>
    <property name="DataSet">sqlCompany</property>
    <property name="Name">dsCompany</property>
  </object>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">369</property>
        <property name="Top">666</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayment_method</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:45:"SELECT payment_method_id, payment_method_name";i:1;s:19:"FROM payment_method";i:2;s:0:"";}</property>
    <property name="TableName">payment_method</property>
  </object>
  <object class="Datasource" name="dsPayment_method" >
        <property name="Left">369</property>
        <property name="Top">682</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
</object>
?>
