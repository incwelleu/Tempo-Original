<?php
<object class="company_client_edit" name="company_client_edit" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Client</property>
  <property name="DocType">dtHTML_4_01_Frameset</property>
  <property name="Height">479</property>
  <property name="IsMaster">0</property>
  <property name="Name">company_client_edit</property>
  <property name="ShowHint">1</property>
  <property name="UseAjax">1</property>
  <property name="Width">684</property>
  <property name="OnCreate">company_client_editCreate</property>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">456</property>
    <property name="Name">company_id</property>
    <property name="Top">392</property>
    <property name="Value">0</property>
    <property name="Width">107</property>
  </object>
  <object class="HiddenField" name="company_client_id" >
    <property name="Height">18</property>
    <property name="Left">456</property>
    <property name="Name">company_client_id</property>
    <property name="Top">368</property>
    <property name="Value">0</property>
    <property name="Width">107</property>
  </object>
  <object class="Query" name="sqlCompany_client" >
        <property name="Left">32</property>
        <property name="Top">360</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_client</property>
    <property name="Params">a:1:{i:0;s:17:"company_client_id";}</property>
    <property name="SQL">a:2:{i:0;s:28:"SELECT * FROM company_client";i:1;s:27:"WHERE company_client_id = ?";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Datasource" name="dsCompany_client" >
        <property name="Left">32</property>
        <property name="Top">376</property>
    <property name="DataSet">sqlCompany_client</property>
    <property name="Name">dsCompany_client</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">368</property>
        <property name="Top">368</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">135</property>
        <property name="Top">357</property>
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
        <property name="Left">135</property>
        <property name="Top">370</property>
    <property name="DataSet">sqlTax_type_key</property>
    <property name="Name">dsTax_type_key</property>
  </object>
  <object class="Query" name="sqlCompany_join_client" >
        <property name="Left">248</property>
        <property name="Top">360</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_join_client</property>
    <property name="OrderField">client_name</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:3:{i:0;s:95:"SELECT company_client_id, client_name, tax_ident, CONCAT(client_name, " ", tax_ident) as client";i:1;s:20:"FROM company_client ";i:2;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Datasource" name="dsCompany_join_client" >
        <property name="Left">248</property>
        <property name="Top">376</property>
    <property name="DataSet">sqlCompany_join_client</property>
    <property name="Name">dsCompany_join_client</property>
  </object>
  <object class="JTDivWindow" name="winCompany_client_edit" >
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
    <property name="Height">355</property>
    <property name="Left">8</property>
    <property name="Name">winCompany_client_edit</property>
    <property name="SiteTheme"></property>
    <property name="StartVisible">1</property>
    <property name="Top">7</property>
    <property name="Width">571</property>
    <object class="JTLabel" name="lbTax_ident" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Tax ID</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">16</property>
      <property name="Name">lbTax_ident</property>
      <property name="SiteTheme"></property>
      <property name="Top">61</property>
      <property name="Width">43</property>
    </object>
    <object class="JTAdvancedEdit" name="tax_ident" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">tax_ident</property>
      <property name="DataSource">dsCompany_client</property>
      <property name="Height">24</property>
      <property name="Left">119</property>
      <property name="Name">tax_ident</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">2</property>
      <property name="Top">57</property>
      <property name="Width">130</property>
    </object>
    <object class="JTLabel" name="lbClient_name" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Client name</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">16</property>
      <property name="Name">lbClient_name</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">88</property>
      <property name="Width">100</property>
    </object>
    <object class="JTAdvancedEdit" name="client_name" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">client_name</property>
      <property name="DataSource">dsCompany_client</property>
      <property name="Height">24</property>
      <property name="Left">119</property>
      <property name="Name">client_name</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="TabOrder">3</property>
      <property name="Top">84</property>
      <property name="Width">348</property>
    </object>
    <object class="JTGroupBox" name="gbInvoice_address" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Invoice address</property>
      <property name="Height">167</property>
      <property name="Left">16</property>
      <property name="Name">gbInvoice_address</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">110</property>
      <property name="Width">451</property>
      <object class="JTAdvancedEdit" name="address_floor" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_floor</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">248</property>
        <property name="MaxLength">2</property>
        <property name="Name">address_floor</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">7</property>
        <property name="Top">64</property>
        <property name="Width">43</property>
      </object>
      <object class="JTAdvancedEdit" name="address_door" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_door</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">408</property>
        <property name="MaxLength">2</property>
        <property name="Name">address_door</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">8</property>
        <property name="Top">64</property>
        <property name="Width">43</property>
      </object>
      <object class="JTAdvancedEdit" name="address_city" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_city</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">110</property>
        <property name="MaxLength">50</property>
        <property name="Name">address_city</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">9</property>
        <property name="Top">88</property>
        <property name="Width">333</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_street" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Street address</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbRegaddress_street</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">42</property>
        <property name="Width">80</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_street_no" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Number</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbRegaddress_street_no</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">65</property>
        <property name="Width">80</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_city" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">City</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbRegaddress_city</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">89</property>
        <property name="Width">58</property>
      </object>
      <object class="JTAdvancedEdit" name="address_street_no" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_street_no</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">110</property>
        <property name="MaxLength">5</property>
        <property name="Name">address_street_no</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">6</property>
        <property name="Top">64</property>
        <property name="Width">51</property>
      </object>
      <object class="JTLookupComboBox" name="address_street_type_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_street_type_id</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">24</property>
        <property name="Left">110</property>
        <property name="LookupDataField">street_type_id</property>
        <property name="LookupDataSource">dmCompany.dsStreet_type</property>
        <property name="LookupField">description</property>
        <property name="Name">address_street_type_id</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">4</property>
        <property name="Top">16</property>
        <property name="Width">123</property>
      </object>
      <object class="JTAdvancedEdit" name="address_street" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_street</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">110</property>
        <property name="MaxLength">40</property>
        <property name="Name">address_street</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="TabOrder">5</property>
        <property name="Top">41</property>
        <property name="Width">333</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_floor" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Floor</property>
        <property name="CssClass">reg</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">201</property>
        <property name="Name">lbRegaddress_floor</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">65</property>
        <property name="Width">43</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_door" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Door</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">344</property>
        <property name="Name">lbRegaddress_door</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">65</property>
        <property name="Width">51</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_province" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Province</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbRegaddress_province</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">113</property>
        <property name="Width">80</property>
      </object>
      <object class="JTAdvancedEdit" name="address_province" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">address_province</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">110</property>
        <property name="MaxLength">25</property>
        <property name="Name">address_province</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">10</property>
        <property name="Top">112</property>
        <property name="Width">333</property>
      </object>
      <object class="JTLabel" name="lbStreet_type" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Street type</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbStreet_type</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">19</property>
        <property name="Width">80</property>
      </object>
      <object class="JTLabel" name="lbRegaddress_post_code" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Post code</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">7</property>
        <property name="Name">lbRegaddress_post_code</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">138</property>
        <property name="Width">80</property>
      </object>
      <object class="JTAdvancedEdit" name="postal_cd" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">postal_cd</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">110</property>
        <property name="MaxLength">15</property>
        <property name="Name">postal_cd</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">11</property>
        <property name="Top">137</property>
        <property name="Width">85</property>
      </object>
      <object class="JTLookupComboBox" name="country_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="DataField">country_id</property>
        <property name="DataSource">dsCompany_client</property>
        <property name="Height">21</property>
        <property name="Left">295</property>
        <property name="LookupDataField">country_id</property>
        <property name="LookupDataSource">dmCompany.dsCountry</property>
        <property name="LookupField">country_name</property>
        <property name="Name">country_id</property>
        <property name="SelectedValue">0</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="TabOrder">12</property>
        <property name="Top">137</property>
        <property name="Width">156</property>
      </object>
      <object class="JTLabel" name="lbCountry" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Country</property>
        <property name="Datasource"></property>
        <property name="Height">15</property>
        <property name="Left">224</property>
        <property name="Name">lbCountry</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">140</property>
        <property name="Width">50</property>
      </object>
      <object class="JTLabel" name="lbFillAs" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Fill in as</property>
        <property name="Datasource"></property>
        <property name="Height">18</property>
        <property name="Left">254</property>
        <property name="Name">lbFillAs</property>
        <property name="SiteTheme"></property>
        <property name="Top">19</property>
        <property name="Visible">0</property>
        <property name="Width">57</property>
      </object>
      <object class="ComboBox" name="cbAddress" >
        <property name="Height">21</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:0:{}</property>
        <property name="Left">330</property>
        <property name="Name">cbAddress</property>
        <property name="Top">16</property>
        <property name="Visible">0</property>
        <property name="Width">121</property>
        <property name="OnChange">cbAddressChange</property>
        <property name="jsOnChange">cbAddressJSChange</property>
      </object>
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
      <property name="Left">16</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">296</property>
      <property name="Width">95</property>
    </object>
    <object class="JTLabel" name="lbTax_type" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Type output tax</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">16</property>
      <property name="Name">lbTax_type</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">324</property>
      <property name="Width">95</property>
    </object>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">payment_method_id</property>
      <property name="DataSource">dsCompany_client</property>
      <property name="Height">21</property>
      <property name="Left">119</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dmCompany.dsPayment_method</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">13</property>
      <property name="Top">293</property>
      <property name="Width">260</property>
    </object>
    <object class="JTLookupComboBox" name="tax_type_key_id" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">tax_type_key_id</property>
      <property name="DataSource">dsCompany_client</property>
      <property name="Height">21</property>
      <property name="Left">119</property>
      <property name="LookupDataField">tax_type_key_id</property>
      <property name="LookupDataSource">dsTax_type_key</property>
      <property name="LookupField">tax_type_name</property>
      <property name="Name">tax_type_key_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">14</property>
      <property name="Top">321</property>
      <property name="Width">260</property>
    </object>
    <object class="Button" name="btnSave" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">400</property>
      <property name="Name">btnSave</property>
      <property name="TabOrder">15</property>
      <property name="Top">317</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveClick</property>
    </object>
    <object class="Button" name="btnClose" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">480</property>
      <property name="Name">btnClose</property>
      <property name="TabOrder">16</property>
      <property name="Top">317</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseClick</property>
    </object>
    <object class="JTLabel" name="lbSeleced_client_id" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Assign invoice data</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Left">16</property>
      <property name="Name">lbSeleced_client_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">34</property>
      <property name="Visible">0</property>
      <property name="Width">95</property>
    </object>
    <object class="JTLookupComboBox" name="selected_cliente_id" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField">payment_method_id</property>
      <property name="Height">21</property>
      <property name="Left">119</property>
      <property name="LookupDataField">company_client_id</property>
      <property name="LookupDataSource">dsCompany_join_client</property>
      <property name="LookupField">client_name</property>
      <property name="Name">selected_cliente_id</property>
      <property name="SelectedValue">0</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">1</property>
      <property name="Top">31</property>
      <property name="Visible">0</property>
      <property name="Width">348</property>
      <property name="jsOnChange">selected_cliente_idJSChange</property>
    </object>
  </object>
</object>
?>
