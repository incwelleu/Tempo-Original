<?php
<object class="company_tax_account" name="company_tax_account" baseclass="Page">
  <property name="Language">Spanish (Traditional Sort)</property>
  <object class="JTDivWindow" name="winUpload" >
    <object class="JTGroupBox" name="gbParameter" >
      <property name="Caption"><![CDATA[Par&aacute;metros de importaci&oacute;n]]></property>
      <object class="ComboBox" name="col_accounting_code" >
      </object>
      <object class="JTLabel" name="lbAccounting_code" >
        <property name="Caption"><![CDATA[C&oacute;digo de cuenta]]></property>
      </object>
      <object class="JTLabel" name="lbBeginning_row" >
        <property name="Caption">Comenzar en la fila</property>
      </object>
      <object class="JTLabel" name="lbType_operation" >
        <property name="Caption"><![CDATA[Tipo de operaci&oacute;n]]></property>
      </object>
      <object class="JTLabel" name="lbTax_rate" >
        <property name="Caption">Tipo de impuesto</property>
      </object>
      <object class="ComboBox" name="col_type_operation" >
      </object>
      <object class="ComboBox" name="col_tax_rate" >
      </object>
      <object class="JTAdvancedEdit" name="beginning_row" >
      </object>
    </object>
    <object class="Button" name="btnCloseUpload" >
      <property name="Caption">Cerrar</property>
    </object>
    <object class="Button" name="btnImport" >
      <property name="Caption">Importar</property>
    </object>
    <object class="Label" name="lbError" >
    </object>
    <object class="Upload" name="Upload_accounting" >
    </object>
  </object>
  <object class="JTGroupBox" name="cbDefault_account" >
    <object class="Edit" name="account_provider" >
    </object>
    <object class="JTDatePicker" name="accountant_period_last_closed_dt" >
    </object>
    <object class="Label" name="lbAccountant_period_last_closed_dt" >
      <property name="Caption"><![CDATA[Per&iacute;odo cerrado]]></property>
    </object>
    <object class="Label" name="lbDefault_tax_rate" >
      <property name="Caption">Impuesto por defecto</property>
    </object>
    <object class="Label" name="lbTax_regime" >
      <property name="Caption"><![CDATA[R&eacute;gimen fiscal]]></property>
    </object>
    <object class="Label" name="lbDigit_account" >
      <property name="Caption"><![CDATA[D&iacute;gitos subcuentas]]></property>
      <property name="Top">26</property>
    </object>
    <object class="ComboBox" name="tax_rate_id" >
    </object>
    <object class="JTAdvancedEdit" name="digit_account" >
    </object>
    <object class="Label" name="lbAccount_provider" >
      <property name="Caption">Proveedor por defecto</property>
    </object>
    <object class="Label" name="lbAccount_client" >
      <property name="Caption">Cliente por defecto</property>
    </object>
    <object class="Edit" name="account_client" >
    </object>
    <object class="ComboBox" name="tax_regime_id" >
    </object>
    <object class="JTGroupBox" name="gbIncomeAccounts" >
      <property name="Cached">1</property>
      <object class="Label" name="lbAccount_sale" >
        <property name="Caption">Ventas nacionales</property>
      </object>
      <object class="Edit" name="account_sale" >
      </object>
      <object class="Label" name="lbAccount_sale_within_europe" >
        <property name="Caption">Ventas intracomunitarias</property>
      </object>
      <object class="Edit" name="account_sale_within_europe" >
      </object>
      <object class="Label" name="lbAccount_sale_outside_europe" >
        <property name="Caption"><![CDATA[Ventas terceros pa&iacute;ses]]></property>
      </object>
      <object class="Edit" name="account_sale_outside_europe" >
      </object>
      <object class="Label" name="lbAccount_transport" >
        <property name="Caption">Transporte</property>
      </object>
      <object class="Edit" name="account_transport" >
      </object>
      <object class="Label" name="lbOther_income" >
        <property name="Caption">Otros ingresos</property>
      </object>
      <object class="Edit" name="account_other_income" >
      </object>
      <object class="Label" name="lbaccount_client_withholding" >
      </object>
      <object class="Edit" name="account_client_withholding" >
      </object>
    </object>
    <object class="Label" name="lbCompanyCodeAccounting" >
      <property name="Caption"><![CDATA[C&oacute;digo de empresa contable]]></property>
    </object>
    <object class="JTAdvancedEdit" name="company_code_accounting" >
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridCompany_tax_account" >
  </object>
  <object class="JTToolBar" name="btnTaxAccount" >
  </object>
  <object class="HiddenField" name="rowSelected" >
  </object>
  <object class="Button" name="btnClose" >
  </object>
  <object class="Button" name="btnSave" >
    <property name="Caption">Guardar</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">505</property>
        <property name="Top">408</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">568</property>
        <property name="Top">408</property>
  </object>
  <object class="Query" name="sqlCompany_tax_account" >
        <property name="Left">61</property>
        <property name="Top">636</property>
  </object>
  <object class="Datasource" name="dsCompany_tax_account" >
        <property name="Left">61</property>
        <property name="Top">655</property>
  </object>
  <object class="Query" name="sqlTax_type_key" >
        <property name="Left">201</property>
        <property name="Top">638</property>
  </object>
  <object class="Datasource" name="dsTax_type_key" >
        <property name="Left">201</property>
        <property name="Top">657</property>
  </object>
  <object class="Query" name="sqlTax_rate" >
        <property name="Left">317</property>
        <property name="Top">641</property>
  </object>
  <object class="Datasource" name="dsTax_rate" >
        <property name="Left">317</property>
        <property name="Top">660</property>
  </object>
  <object class="Query" name="sqlTax_regime" >
        <property name="Left">64</property>
        <property name="Top">565</property>
  </object>
  <object class="Datasource" name="dsTax_regime" >
        <property name="Left">64</property>
        <property name="Top">582</property>
  </object>
</object>
?>
