<?php
<object class="invoice_issued" name="invoice_issued" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Invoices issued</property>
  <property name="DocType">dtHTML_4_01_Transitional</property>
  <property name="Height">700</property>
  <property name="IsMaster">0</property>
  <property name="Name">invoice_issued</property>
  <property name="UseAjax">1</property>
  <property name="Width">970</property>
  <property name="OnCreate">invoice_issuedCreate</property>
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
    <property name="Caption">Upload invoice issued</property>
    <property name="Height">338</property>
    <property name="Left">499</property>
    <property name="Name">winUpload</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">157</property>
    <property name="Width">450</property>
    <object class="JTGroupBox" name="gbParameter" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Parameter import</property>
      <property name="Height">245</property>
      <property name="Left">8</property>
      <property name="Name">gbParameter</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">50</property>
      <property name="Width">435</property>
      <object class="JTLabel" name="lbBeginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Beginning of row</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbBeginning_row</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">220</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbWithholding_rate" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Cached">1</property>
        <property name="Caption">Withholding Rate (%)</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbWithholding_rate</property>
        <property name="SiteTheme"></property>
        <property name="Top">170</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTotal_amount" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Total amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbTotal_amount</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">144</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTax_percentage" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax rate (%)</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbTax_percentage</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">120</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTransport_amount" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Transport amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbTransport_amount</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">96</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbClient_name_import" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Client name</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbClient_name_import</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">72</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbCol_invoice_number" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Invoice number</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">222</property>
        <property name="Name">lbCol_invoice_number</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">48</property>
        <property name="Width">130</property>
      </object>
      <object class="ComboBox" name="col_withholding_rate" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_withholding_rate</property>
        <property name="Top">168</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_total_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_total_amount</property>
        <property name="Top">144</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_tax_rate" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_tax_rate</property>
        <property name="Top">120</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_transport_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_transport_amount</property>
        <property name="Top">96</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_client_name" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_client_name</property>
        <property name="Top">72</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_invoice_number" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">391</property>
        <property name="Name">col_invoice_number</property>
        <property name="Top">48</property>
        <property name="Width">44</property>
      </object>
      <object class="Upload" name="Upload" >
        <property name="Cursor">crPointer</property>
        <property name="Enabled">0</property>
        <property name="Height">21</property>
        <property name="Left">8</property>
        <property name="Name">Upload</property>
        <property name="Top">21</property>
        <property name="Visible">0</property>
        <property name="Width">418</property>
      </object>
      <object class="JTLabel" name="lbTax_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax ID</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbTax_id</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">72</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbSubtotal_amount" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Subtotal amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbSubtotal_amount</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">96</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbTax_amount" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Tax amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbTax_amount</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">144</property>
        <property name="Width">130</property>
      </object>
      <object class="JTLabel" name="lbInvoice_date" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Invoice date</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbInvoice_date</property>
        <property name="SiteTheme">SiteTheme</property>
        <property name="Top">48</property>
        <property name="Width">130</property>
      </object>
      <object class="ComboBox" name="col_invoice_date" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_invoice_date</property>
        <property name="Top">48</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_tax_ident" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_tax_ident</property>
        <property name="Top">72</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_subtotal_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_subtotal_amount</property>
        <property name="Top">96</property>
        <property name="Width">44</property>
      </object>
      <object class="ComboBox" name="col_tax_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_tax_amount</property>
        <property name="Top">144</property>
        <property name="Width">44</property>
      </object>
      <object class="JTLabel" name="lbOther_income_amount" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Other income amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbOther_income_amount</property>
        <property name="SiteTheme"></property>
        <property name="Top">120</property>
        <property name="Width">130</property>
      </object>
      <object class="ComboBox" name="col_other_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_other_amount</property>
        <property name="Top">120</property>
        <property name="Width">44</property>
      </object>
      <object class="JTDatePicker" name="registration_dt" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Date"></property>
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="Left">121</property>
        <property name="Name">registration_dt</property>
        <property name="SiteTheme"></property>
        <property name="StyleFont">
        <property name="Size">11px</property>
        </property>
        <property name="Top">218</property>
        <property name="Width">89</property>
      </object>
      <object class="JTLabel" name="lbRegistration_dt" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Registration date</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbRegistration_dt</property>
        <property name="SiteTheme"></property>
        <property name="Top">220</property>
        <property name="Width">102</property>
      </object>
      <object class="JTLabel" name="lbDocument_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Document ID</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbDocument_id</property>
        <property name="SiteTheme"></property>
        <property name="Top">194</property>
        <property name="Width">130</property>
      </object>
      <object class="ComboBox" name="col_document_id" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_document_id</property>
        <property name="Top">192</property>
        <property name="Width">44</property>
      </object>
      <object class="JTLabel" name="lbBase_withholding1" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Caption">Base for Withholding Tax Amount</property>
        <property name="Datasource"></property>
        <property name="Height">16</property>
        <property name="Left">8</property>
        <property name="Name">lbBase_withholding1</property>
        <property name="SiteTheme"></property>
        <property name="Top">170</property>
        <property name="Width">140</property>
      </object>
      <object class="ComboBox" name="col_base_withholding_amount" >
        <property name="Enabled">0</property>
        <property name="Height">20</property>
        <property name="ItemIndex">0</property>
        <property name="Items">a:27:{i:0;s:0:"";i:1;s:1:"A";i:2;s:1:"B";i:3;s:1:"C";i:4;s:1:"D";i:5;s:1:"E";i:6;s:1:"F";i:7;s:1:"G";i:8;s:1:"H";i:9;s:1:"I";i:10;s:1:"J";i:11;s:1:"K";i:12;s:1:"L";i:13;s:1:"M";i:14;s:1:"N";i:15;s:1:"O";i:16;s:1:"P";i:17;s:1:"Q";i:18;s:1:"R";i:19;s:1:"S";i:20;s:1:"T";i:21;s:1:"U";i:22;s:1:"V";i:23;s:1:"W";i:24;s:1:"X";i:25;s:1:"Y";i:26;s:1:"Z";}</property>
        <property name="Left">166</property>
        <property name="Name">col_base_withholding_amount</property>
        <property name="Top">168</property>
        <property name="Width">44</property>
      </object>
      <object class="JTAdvancedEdit" name="beginning_row" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">22</property>
        <property name="Left">371</property>
        <property name="MaxLength">3</property>
        <property name="Name">beginning_row</property>
        <property name="SiteTheme"></property>
        <property name="Top">220</property>
        <property name="Width">64</property>
      </object>
    </object>
    <object class="Button" name="btnCloseUpload" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">22</property>
      <property name="Left">368</property>
      <property name="Name">btnCloseUpload</property>
      <property name="Top">305</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseUploadClick</property>
    </object>
    <object class="Button" name="btnImport" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Import</property>
      <property name="Height">22</property>
      <property name="Left">290</property>
      <property name="Name">btnImport</property>
      <property name="Top">305</property>
      <property name="Width">75</property>
      <property name="OnClick">btnImportClick</property>
    </object>
    <object class="JTLabel" name="lbSelectTemplate" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Select template</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">8</property>
      <property name="Name">lbSelectTemplate</property>
      <property name="SiteTheme"></property>
      <property name="Top">31</property>
      <property name="Width">100</property>
    </object>
    <object class="ComboBox" name="cbTemplateImport" >
      <property name="Height">20</property>
      <property name="ItemIndex">0</property>
      <property name="Items">a:0:{}</property>
      <property name="Left">165</property>
      <property name="Name">cbTemplateImport</property>
      <property name="Top">30</property>
      <property name="Width">278</property>
      <property name="jsOnChange">cbTemplateImportJSChange</property>
    </object>
    <object class="Label" name="lbDownloadOurTemplate" >
      <property name="Caption">lbDownloadOurTemplate</property>
      <property name="Height">13</property>
      <property name="Left">10</property>
      <property name="Name">lbDownloadOurTemplate</property>
      <property name="Top">310</property>
      <property name="Width">257</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winExport" >
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
    <property name="Caption">Export accounting</property>
    <property name="Height">219</property>
    <property name="Left">720</property>
    <property name="Name">winExport</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">343</property>
    <property name="Width">234</property>
    <object class="JTLabel" name="lbFromExport" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">From</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">13</property>
      <property name="Name">lbFromExport</property>
      <property name="SiteTheme"></property>
      <property name="Top">60</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLabel" name="lbToExport" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">To</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">13</property>
      <property name="Name">lbToExport</property>
      <property name="SiteTheme"></property>
      <property name="Top">85</property>
      <property name="Width">80</property>
    </object>
    <object class="CheckBox" name="cbExportAccounting" >
      <property name="Caption">Exporting posted invoices</property>
      <property name="Height">21</property>
      <property name="Left">13</property>
      <property name="Name">cbExportAccounting</property>
      <property name="TabOrder">4</property>
      <property name="Top">130</property>
      <property name="Width">212</property>
    </object>
    <object class="Button" name="BtnCloseExport" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">25</property>
      <property name="Left">150</property>
      <property name="Name">BtnCloseExport</property>
      <property name="Top">179</property>
      <property name="Width">75</property>
      <property name="OnClick">BtnCloseExportClick</property>
    </object>
    <object class="Button" name="BtnExport" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Export</property>
      <property name="Height">25</property>
      <property name="Left">69</property>
      <property name="Name">BtnExport</property>
      <property name="TabOrder">6</property>
      <property name="Top">179</property>
      <property name="Width">75</property>
      <property name="OnClick">BtnExportClick</property>
    </object>
    <object class="CheckBox" name="cbCreateAccount" >
      <property name="Caption">Create account accounting</property>
      <property name="Height">21</property>
      <property name="Left">13</property>
      <property name="Name">cbCreateAccount</property>
      <property name="TabOrder">5</property>
      <property name="Top">153</property>
      <property name="Width">212</property>
    </object>
    <object class="JTDatePicker" name="dtFromExport" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">21</property>
      <property name="Left">94</property>
      <property name="Name">dtFromExport</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">58</property>
      <property name="Width">125</property>
    </object>
    <object class="JTDatePicker" name="dtToExport" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">21</property>
      <property name="Left">94</property>
      <property name="Name">dtToExport</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">84</property>
      <property name="Width">125</property>
    </object>
    <object class="CheckBox" name="cbExportSelectedInvoices" >
      <property name="Caption">Export selected invoices</property>
      <property name="Height">21</property>
      <property name="Left">13</property>
      <property name="Name">cbExportSelectedInvoices</property>
      <property name="TabOrder">3</property>
      <property name="Top">106</property>
      <property name="Width">206</property>
    </object>
    <object class="Label" name="lbTypeExport" >
      <property name="Autosize">1</property>
      <property name="Caption">Type of export</property>
      <property name="Height">16</property>
      <property name="Left">13</property>
      <property name="Name">lbTypeExport</property>
      <property name="Top">34</property>
      <property name="Width">75</property>
    </object>
    <object class="JTComboBox" name="cbTypeExport" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="DataField"></property>
      <property name="Datasource"></property>
      <property name="Height">24</property>
      <property name="Items">a:2:{i:0;s:5:"A3Con";i:1;s:9:"ContaPlus";}</property>
      <property name="Left">94</property>
      <property name="LookupDatasource"></property>
      <property name="LookupTextField"></property>
      <property name="LookupValueField"></property>
      <property name="Name">cbTypeExport</property>
      <property name="SiteTheme"></property>
      <property name="Top">33</property>
      <property name="Width">125</property>
    </object>
  </object>
  <object class="JTDivWindow" name="winPaid" >
    <property name="ActiveLayer">Paid</property>
    <property name="Anchors">
    <property name="Relative"></property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="BorderIcons">
    <property name="Help">0</property>
    <property name="Maximize">0</property>
    <property name="Minimize">0</property>
    </property>
    <property name="BorderStyle">bsSingle</property>
    <property name="Caption">Paid</property>
    <property name="Height">180</property>
    <property name="Layer">Paid</property>
    <property name="Left">407</property>
    <property name="Name">winPaid</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">105</property>
    <property name="Width">547</property>
    <property name="jsOnShow">winPaidJSShow</property>
    <object class="JTAdvancedEdit" name="paid_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">134</property>
      <property name="MaxLength">15</property>
      <property name="Name">paid_amt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="TabOrder">1</property>
      <property name="Top">32</property>
      <property name="Width">114</property>
    </object>
    <object class="JTLabel" name="lbPaid_amt" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Paid amount</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_amt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">35</property>
      <property name="Width">115</property>
    </object>
    <object class="JTDatePicker" name="paid_dt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Layer">Paid</property>
      <property name="Left">134</property>
      <property name="Name">paid_dt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">2</property>
      <property name="Top">58</property>
      <property name="Width">115</property>
    </object>
    <object class="Label" name="lbPaid_dt" >
      <property name="Caption">Paid date</property>
      <property name="Height">13</property>
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_dt</property>
      <property name="Top">64</property>
      <property name="Width">115</property>
    </object>
    <object class="Label" name="lbPaid_by" >
      <property name="Caption">Paid by</property>
      <property name="Height">13</property>
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPaid_by</property>
      <property name="Top">92</property>
      <property name="Width">115</property>
    </object>
    <object class="JTAdvancedEdit" name="paid_by" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Layer">Paid</property>
      <property name="Left">134</property>
      <property name="Name">paid_by</property>
      <property name="SiteTheme"></property>
      <property name="TabOrder">3</property>
      <property name="Top">86</property>
      <property name="Width">391</property>
    </object>
    <object class="Button" name="btnSavePayment" >
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Layer">Paid</property>
      <property name="Left">458</property>
      <property name="Name">btnSavePayment</property>
      <property name="Top">141</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSavePaymentClick</property>
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
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbPayment_method</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">119</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="payment_method_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">134</property>
      <property name="LookupDataField">payment_method_id</property>
      <property name="LookupDataSource">dsPayment_method</property>
      <property name="LookupField">payment_method_name</property>
      <property name="Name">payment_method_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">116</property>
      <property name="Width">200</property>
    </object>
    <object class="JTLabel" name="lbBank_account" >
      <property name="Anchors">
      <property name="Left">0</property>
      <property name="Relative">0</property>
      <property name="Top">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Bank account</property>
      <property name="Datasource"></property>
      <property name="Height">15</property>
      <property name="Layer">Paid</property>
      <property name="Left">11</property>
      <property name="Name">lbBank_account</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">148</property>
      <property name="Width">115</property>
    </object>
    <object class="JTLookupComboBox" name="bank_account_id" >
      <property name="AllowEmpty">0</property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Layer">Paid</property>
      <property name="Left">134</property>
      <property name="LookupDataField">bank_account_id</property>
      <property name="LookupDataSource">dsCompany_bank_account</property>
      <property name="LookupField">bank_account_name</property>
      <property name="Name">bank_account_id</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="TabOrder">5</property>
      <property name="Top">145</property>
      <property name="Width">200</property>
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridInvoice_issued_paid" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowInsert">0</property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanSelect">0</property>
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
    <property name="Datasource">dsInvoice_issued_paid</property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Horizontal">0</property>
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">133</property>
    <property name="KeyField">invoice_issued_paid_id</property>
    <property name="Left">448</property>
    <property name="Name">gridInvoice_issued_paid</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowPageInfo">0</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowEditColumn">1</property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="Top">518</property>
    <property name="Visible">0</property>
    <property name="Width">491</property>
    <property name="OnDelete">gridInvoice_issued_paidDelete</property>
    <property name="OnSQL">gridInvoice_issued_paidSQL</property>
    <property name="OnUpdate">gridInvoice_issued_paidUpdate</property>
  </object>
  <object class="JTDivWindow" name="winRegistrationChange" >
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
    <property name="Caption">winRegistrationChange</property>
    <property name="Height">114</property>
    <property name="Left">26</property>
    <property name="Name">winRegistrationChange</property>
    <property name="Position">poParentCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">527</property>
    <property name="Width">336</property>
    <object class="JTDatePicker" name="registration_change" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date"></property>
      <property name="Height">24</property>
      <property name="Left">157</property>
      <property name="Name">registration_change</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">11px</property>
      </property>
      <property name="Top">36</property>
      <property name="Width">165</property>
    </object>
    <object class="Button" name="btnCloseRegistration" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Close</property>
      <property name="Height">25</property>
      <property name="Left">247</property>
      <property name="Name">btnCloseRegistration</property>
      <property name="Top">73</property>
      <property name="Width">75</property>
      <property name="jsOnClick">btnCloseRegistrationJSClick</property>
    </object>
    <object class="Label" name="lbRegistration_change" >
      <property name="Caption">lbRegistration_change</property>
      <property name="Height">13</property>
      <property name="Left">9</property>
      <property name="Name">lbRegistration_change</property>
      <property name="Top">42</property>
      <property name="Width">150</property>
    </object>
    <object class="Button" name="btnSaveRegistration" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">167</property>
      <property name="Name">btnSaveRegistration</property>
      <property name="Top">73</property>
      <property name="Width">75</property>
      <property name="OnClick">btnSaveRegistrationClick</property>
    </object>
  </object>
  <object class="JTPlatinumGrid" name="gridInvoice_issued" >
    <property name="AjaxRefreshAll">1</property>
    <property name="AllowInsert">0</property>
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanMoveCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:27:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:598:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:30:"a:1:{s:9:"MaxLength";s:1:"4";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Invoice year";s:9:"DataField";s:12:"invoice_year";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"invoice_year";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:607:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"20";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:14:"Invoice number";s:9:"DataField";s:14:"invoice_number";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"invoice_number";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:2;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:461:"a:10:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Invoice date";s:9:"DataField";s:10:"invoice_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"invoice_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:3;a:2:{i:0;s:25:"JTPlatinumGridImageColumn";i:1;s:433:"a:10:{s:8:"DataType";s:8:"FileName";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:9:"DataField";s:7:"img_pdf";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"img_pdf";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"32";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:586:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:31:"a:1:{s:9:"MaxLength";s:2:"20";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:6:"Tax ID";s:9:"DataField";s:9:"tax_ident";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"tax_ident";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:600:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:32:"a:1:{s:9:"MaxLength";s:3:"200";}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Client name";s:9:"DataField";s:11:"client_name";s:13:"DefaultFilter";s:8:"Contains";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"client_name";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"250";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:629:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:8:"Subtotal";s:9:"DataField";s:12:"subtotal_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"subtotal_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:7;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:631:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:8:"Shipping";s:9:"DataField";s:13:"transport_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"transport_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:8;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:612:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:3:"VAT";s:9:"DataField";s:7:"tax_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"tax_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"70";}";}i:9;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:629:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:8:"Overhead";s:9:"DataField";s:12:"overhead_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"overhead_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"70";}";}i:10;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:646:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:16:"Other</br>income";s:9:"DataField";s:16:"other_income_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:16:"other_income_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:11;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:641:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Withholding";s:9:"DataField";s:15:"withholding_amt";s:13:"DefaultFilter";s:8:"EndsWith";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"withholding_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:12;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:618:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:5:"Total";s:9:"DataField";s:9:"total_amt";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"total_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:13;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:582:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:5:"Paid ";s:9:"DataField";s:8:"paid_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"paid_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:14;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:598:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:9:"Pendiente";s:9:"DataField";s:13:"pendiente_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:13:"pendiente_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:2:"80";}";}i:15;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:570:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Account code";s:9:"DataField";s:10:"account_cd";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"account_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"100";}";}i:16;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:562:"a:11:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:26:"Registered</br>accountant ";s:9:"DataField";s:31:"registered_in_acctg_software_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:31:"registered_in_acctg_software_dt";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:17;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:620:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanMove";b:0;s:7:"Caption";s:11:"Document ID";s:9:"DataField";s:14:"document_ident";s:13:"DefaultFilter";s:6:"Equals";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:14:"document_ident";s:13:"SortDirection";s:4:"DESC";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:18;a:2:{i:0;s:27:"JTPlatinumGridBooleanColumn";i:1;s:508:"a:11:{s:13:"DisplayFormat";s:8:"CheckBox";s:9:"FalseText";s:2:"No";s:8:"TrueText";s:3:"Yes";s:9:"Alignment";s:8:"agCenter";s:7:"CanMove";b:0;s:7:"Caption";s:10:"Accounted?";s:9:"DataField";s:12:"accounted_yn";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"accounted_yn";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:19;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:487:"a:11:{s:7:"Display";s:8:"DateOnly";s:6:"Format";s:5:"Y-m-d";s:9:"Alignment";s:8:"agCenter";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:11:"Export date";s:9:"DataField";s:9:"export_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"export_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:20;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:524:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:6:"Status";s:9:"DataField";s:9:"status_cd";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"status_cd";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"50";}";}i:21;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:556:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:8:"username";s:7:"CanEdit";b:0;s:7:"Caption";s:10:"Created by";s:9:"DataField";s:15:"created_user_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:15:"created_user_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:22;a:2:{i:0;s:28:"JTPlatinumGridDateTimeColumn";i:1;s:438:"a:9:{s:6:"Format";s:11:"Y-m-d H:i:s";s:7:"CanEdit";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:12:"Created date";s:9:"DataField";s:10:"created_dt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"created_dt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:23;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:572:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"DataField";s:17:"company_client_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:17:"company_client_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:24;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:572:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"DataField";s:17:"invoice_issued_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:17:"invoice_issued_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:25;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:558:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"DataField";s:10:"company_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:10:"company_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:26;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:524:"a:12:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"DataField";s:4:"link";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:4:"link";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;}";}}]]></property>
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
    <property name="Datasource">dsInvoice_issued</property>
    <property name="DetailValue">invoice_issued_id</property>
    <property name="DetailView">
    <property name="DetailField">invoice_issued_id</property>
    <property name="DetailGrid">gridInvoice_issued_paid</property>
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    </property>
    <property name="Height">639</property>
    <property name="KeyField">invoice_issued_id</property>
    <property name="Name">gridInvoice_issued</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="RowsPerPage">50</property>
    <property name="ShowTopPager">0</property>
    <property name="VisiblePageCount">5</property>
    </property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="SiteTheme"></property>
    <property name="SortBy">registered_in_acctg_software_dt desc, document_ident desc</property>
    <property name="Top">56</property>
    <property name="Width">962</property>
    <property name="OnDelete">gridInvoice_issuedDelete</property>
    <property name="OnRowData">gridInvoice_issuedRowData</property>
    <property name="OnRowEdited">gridInvoice_issuedRowEdited</property>
    <property name="OnSQL">gridInvoice_issuedSQL</property>
    <property name="OnSummaryData">gridInvoice_issuedSummaryData</property>
    <property name="jsOnSelect">gridInvoice_issuedJSSelect</property>
  </object>
  <object class="JTToolBar" name="btnInvoices" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">31</property>
    <property name="ImageList">ImageList</property>
    <property name="Items">a:1:{s:10:"btnRefresh";a:3:{i:0;s:7:"Refresh";i:1;s:1:"1";i:2;s:1:"1";}}</property>
    <property name="Name">btnInvoices</property>
    <property name="SiteTheme"></property>
    <property name="Top">25</property>
    <property name="Width">962</property>
    <property name="OnClick">btnInvoicesClick</property>
    <property name="jsOnClick">btnInvoicesJSClick</property>
  </object>
  <object class="JTDivWindow" name="winDetail" >
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
    <property name="Caption">Detail</property>
    <property name="Height">483</property>
    <property name="Left">59</property>
    <property name="Name">winDetail</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme"></property>
    <property name="Top">108</property>
    <property name="Width">770</property>
    <object class="JTGroupBox" name="gbData" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Client data</property>
      <property name="Height">97</property>
      <property name="Left">10</property>
      <property name="Name">gbData</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">26</property>
      <property name="Width">749</property>
      <object class="Label" name="lbclient_id" >
        <property name="Caption">Client ID</property>
        <property name="Height">13</property>
        <property name="Left">6</property>
        <property name="Name">lbclient_id</property>
        <property name="Top">21</property>
        <property name="Width">67</property>
      </object>
      <object class="Label" name="lbclient_name" >
        <property name="Caption">Client name</property>
        <property name="Height">13</property>
        <property name="Left">6</property>
        <property name="Name">lbclient_name</property>
        <property name="Top">47</property>
        <property name="Width">82</property>
      </object>
      <object class="Label" name="lbtax_ident" >
        <property name="Caption">Tax ID</property>
        <property name="Height">13</property>
        <property name="Left">6</property>
        <property name="Name">lbtax_ident</property>
        <property name="Top">72</property>
        <property name="Width">82</property>
      </object>
      <object class="JTAdvancedEdit" name="client_name" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">24</property>
        <property name="Left">92</property>
        <property name="MaxLength">200</property>
        <property name="Name">client_name</property>
        <property name="SiteTheme"></property>
        <property name="Top">41</property>
        <property name="Width">636</property>
      </object>
      <object class="JTAdvancedEdit" name="tax_ident" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">24</property>
        <property name="Left">92</property>
        <property name="MaxLength">20</property>
        <property name="Name">tax_ident</property>
        <property name="SiteTheme"></property>
        <property name="Text">AAAAAAAAAAAAAAAAAAAB</property>
        <property name="Top">66</property>
        <property name="Width">147</property>
      </object>
      <object class="Image" name="add_client" >
        <property name="Autosize">1</property>
        <property name="Border">0</property>
        <property name="Cursor">crPointer</property>
        <property name="Height">16</property>
        <property name="Hint">Add client</property>
        <property name="ImageSource">images/button/add_16x16.png</property>
        <property name="Left">72</property>
        <property name="Link"></property>
        <property name="LinkTarget"></property>
        <property name="Name">add_client</property>
        <property name="ParentShowHint">0</property>
        <property name="ShowHint">1</property>
        <property name="Top">19</property>
        <property name="Width">16</property>
        <property name="OnClick">add_clientClick</property>
      </object>
      <object class="JTLookupComboBox" name="company_client_id" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">24</property>
        <property name="Left">92</property>
        <property name="LookupDataField">company_client_id</property>
        <property name="LookupDataSource">dsCompany_client</property>
        <property name="LookupField">client_name</property>
        <property name="Name">company_client_id</property>
        <property name="SiteTheme"></property>
        <property name="Top">15</property>
        <property name="Width">643</property>
        <property name="jsOnChange">company_client_idJSChange</property>
      </object>
    </object>
    <object class="JTAdvancedEdit" name="subtotal_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">subtotal_amt</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">131</property>
      <property name="Width">100</property>
    </object>
    <object class="JTAdvancedEdit" name="tax_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">tax_amt</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">155</property>
      <property name="Width">100</property>
    </object>
    <object class="JTGroupBox" name="gbInvoice" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Invoice data</property>
      <property name="Height">68</property>
      <property name="Left">10</property>
      <property name="Name">gbInvoice</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="Top">133</property>
      <property name="Width">442</property>
      <object class="Label" name="lbInvoice_number" >
        <property name="Autosize">1</property>
        <property name="Caption">Invoice number</property>
        <property name="Height">13</property>
        <property name="Left">8</property>
        <property name="Name">lbInvoice_number</property>
        <property name="Top">20</property>
        <property name="Width">95</property>
      </object>
      <object class="JTAdvancedEdit" name="invoice_number" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Height">24</property>
        <property name="Left">110</property>
        <property name="Name">invoice_number</property>
        <property name="SiteTheme"></property>
        <property name="Top">14</property>
        <property name="Width">320</property>
        <property name="jsOnChange">invoice_numberJSChange</property>
      </object>
      <object class="Label" name="lbInvoice_dt" >
        <property name="Caption">Invoice date</property>
        <property name="Height">13</property>
        <property name="Left">8</property>
        <property name="Name">lbInvoice_dt</property>
        <property name="Top">46</property>
        <property name="Width">95</property>
      </object>
      <object class="JTDatePicker" name="invoice_dt" >
        <property name="AnchorsWorkaround">--Workaround--</property>
        <property name="Date">2012-12-01</property>
        <property name="Height">24</property>
        <property name="Left">110</property>
        <property name="Name">invoice_dt</property>
        <property name="SiteTheme"></property>
        <property name="StyleFont">
        <property name="Size">12px</property>
        </property>
        <property name="Top">40</property>
        <property name="Width">99</property>
        <property name="jsOnChange">invoice_numberJSChange</property>
      </object>
    </object>
    <object class="JTLabel" name="lbSubtota_amt" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption"><![CDATA[Subtotal&nbspamount]]></property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbSubtota_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">132</property>
      <property name="Width">91</property>
    </object>
    <object class="JTLabel" name="lbTax_amt" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">VAT</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbTax_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">156</property>
      <property name="Width">91</property>
    </object>
    <object class="JTAdvancedEdit" name="total_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">total_amt</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">301</property>
      <property name="Width">100</property>
    </object>
    <object class="JTLabel" name="lbTotal_amt" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Total amount</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbTotal_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">302</property>
      <property name="Width">91</property>
    </object>
    <object class="JTLabel" name="lbOther_expense_amt" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Other income / Supplement</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbOther_expense_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">206</property>
      <property name="Width">132</property>
    </object>
    <object class="JTAdvancedEdit" name="other_income_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="MaxLength">15</property>
      <property name="Name">other_income_amt</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">205</property>
      <property name="Width">100</property>
      <property name="jsOnChange">other_income_amtJSChange</property>
    </object>
    <object class="JTLabel" name="lbBase_withholding" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Base withholding</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbBase_withholding</property>
      <property name="SiteTheme"></property>
      <property name="Top">230</property>
      <property name="Width">110</property>
    </object>
    <object class="JTAdvancedEdit" name="base_withholding_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="MaxLength">15</property>
      <property name="Name">base_withholding_amt</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">229</property>
      <property name="Width">100</property>
      <property name="jsOnChange">base_withholding_amtJSChange</property>
    </object>
    <object class="JTLabel" name="lbWithholding_rate_no" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Withholding rate (%)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbWithholding_rate_no</property>
      <property name="SiteTheme"></property>
      <property name="Top">254</property>
      <property name="Width">110</property>
    </object>
    <object class="JTAdvancedEdit" name="withholding_rate_no" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="MaxLength">15</property>
      <property name="Name">withholding_rate_no</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">253</property>
      <property name="Width">100</property>
      <property name="jsOnChange">withholding_rate_noJSChange</property>
    </object>
    <object class="JTLabel" name="lbwithholding_amt" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Withholding amount</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbwithholding_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">278</property>
      <property name="Width">110</property>
    </object>
    <object class="JTAdvancedEdit" name="withholding_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">withholding_amt</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">277</property>
      <property name="Width">100</property>
    </object>
    <object class="JTPlatinumGrid" name="gridInvoice_issued_tax" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="CanDragSelect">0</property>
      <property name="CanMoveCols">0</property>
      <property name="CanMultiColumnSort">0</property>
      <property name="CanRangeSelect">0</property>
      <property name="CanResizeCols">0</property>
      <property name="CellData">a:0:{}</property>
      <property name="Columns">a:7:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:629:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:11:"Base amount";s:9:"DataField";s:8:"base_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:8:"base_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"90";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:788:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:14:"LookupComboBox";s:20:"LookupComboBoxEditor";s:144:"a:4:{s:10:"Datasource";s:10:"dsTax_rate";s:14:"PopulateFilter";b:1;s:9:"TextField";s:15:"tax_description";s:10:"ValueField";s:11:"tax_rate_id";}";s:9:"TextField";s:7:"rate_no";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:5:"Rate ";s:9:"DataField";s:11:"tax_rate_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"tax_rate_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"85";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:722:"a:17:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:10:"EditorType";s:8:"ComboBox";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"TextField";s:16:"overhead_rate_no";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:13:"Overhead rate";s:9:"DataField";s:16:"overhead_rate_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:16:"overhead_rate_no";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"85";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:662:"a:17:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:3:"VAT";s:9:"DataField";s:7:"tax_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"tax_amt";s:14:"ShowSortButton";b:0;s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:4;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:653:"a:16:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:8:"Overhead";s:9:"DataField";s:12:"overhead_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:12:"overhead_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:5;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:666:"a:18:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:9:"CanResize";b:0;s:9:"CanScroll";b:0;s:9:"CanSelect";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:7:"Rate no";s:9:"DataField";s:7:"rate_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:7:"rate_no";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}i:6;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:603:"a:13:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"Caption";s:21:"invoice_issued_tax_id";s:9:"DataField";s:21:"invoice_issued_tax_id";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:21:"invoice_issued_tax_id";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:7:"Visible";b:0;s:5:"Width";s:1:"0";}";}}</property>
      <property name="CommandBar">
      <property name="ShowBottomCommandBar">0</property>
      <property name="ShowExportCSV">0</property>
      <property name="ShowExportPDF">0</property>
      <property name="ShowExportXLS">0</property>
      <property name="ShowPrint">0</property>
      <property name="ShowTopCommandBar">0</property>
      </property>
      <property name="EvenRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="FillWidth">0</property>
      <property name="GridLines">
      <property name="Vertical">0</property>
      </property>
      <property name="Header">
      <property name="FilterDelay">0</property>
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      <property name="ShowFilterBar">0</property>
      <property name="ShowGroupBar">0</property>
      <property name="SimpleFilter">0</property>
      </property>
      <property name="Height">132</property>
      <property name="KeyField">invoice_issued_tax_id</property>
      <property name="Left">10</property>
      <property name="Name">gridInvoice_issued_tax</property>
      <property name="OddRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="Pager">
      <property name="ShowBottomPager">0</property>
      <property name="ShowPageInfo">0</property>
      <property name="ShowRecordCount">0</property>
      <property name="ShowTopPager">0</property>
      <property name="Visible">0</property>
      <property name="VisiblePageCount">1</property>
      </property>
      <property name="RowDataStyles">a:0:{}</property>
      <property name="RowSelect">1</property>
      <property name="SelectedRowStyle">
      <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
      </property>
      <property name="SiteTheme"></property>
      <property name="Top">214</property>
      <property name="UTF8">0</property>
      <property name="Width">477</property>
      <property name="OnDelete">gridInvoice_issued_taxDelete</property>
      <property name="OnInsert">gridInvoice_issued_taxInsert</property>
      <property name="OnUpdate">gridInvoice_issued_taxInsert</property>
      <property name="jsOnDataLoad">gridInvoice_issued_taxJSDataLoad</property>
      <property name="jsOnSelect">gridInvoice_issued_taxJSSelect</property>
    </object>
    <object class="JTToolBar" name="btnTaxes" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">29</property>
      <property name="ImageList">ImageList</property>
      <property name="Items">a:5:{s:6:"btnAdd";a:3:{i:0;s:3:"Add";i:1;s:1:"1";i:2;s:1:"2";}s:9:"btnDelete";a:3:{i:0;s:6:"Delete";i:1;s:1:"1";i:2;s:1:"6";}s:7:"btnEdit";a:3:{i:0;s:4:"Edit";i:1;s:1:"1";i:2;s:1:"3";}s:7:"btnSave";a:3:{i:0;s:4:"Save";i:1;s:1:"1";i:2;s:1:"5";}s:9:"btnCancel";a:3:{i:0;s:6:"Cancel";i:1;s:1:"1";i:2;s:1:"4";}}</property>
      <property name="Left">10</property>
      <property name="Name">btnTaxes</property>
      <property name="SiteTheme"></property>
      <property name="Top">350</property>
      <property name="Width">477</property>
      <property name="jsOnClick">btnTaxesJSClick</property>
    </object>
    <object class="Button" name="BtnAgreeInvoiceDetail" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Save</property>
      <property name="Height">25</property>
      <property name="Left">602</property>
      <property name="Name">BtnAgreeInvoiceDetail</property>
      <property name="Top">445</property>
      <property name="Width">75</property>
      <property name="OnClick">BtnAgreeInvoiceDetailClick</property>
    </object>
    <object class="Button" name="btnCloseInvoiceDetail" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Height">25</property>
      <property name="Left">684</property>
      <property name="Name">btnCloseInvoiceDetail</property>
      <property name="Top">445</property>
      <property name="Width">75</property>
      <property name="OnClick">btnCloseInvoiceDetailClick</property>
    </object>
    <object class="Label" name="lbAttached_invoice" >
      <property name="Caption">Attach invoice</property>
      <property name="Height">13</property>
      <property name="Left">10</property>
      <property name="Name">lbAttached_invoice</property>
      <property name="Top">398</property>
      <property name="Width">82</property>
    </object>
    <object class="Upload" name="Attached" >
      <property name="Accept">*.pdf</property>
      <property name="Height">21</property>
      <property name="Hint">Attach invoice</property>
      <property name="Left">119</property>
      <property name="Name">Attached</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Style">.fileContainer</property>
      <property name="Top">394</property>
      <property name="Width">630</property>
    </object>
    <object class="Label" name="lbRegistration_date" >
      <property name="Caption">Registration date</property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbRegistration_date</property>
      <property name="Top">336</property>
      <property name="Width">110</property>
    </object>
    <object class="JTDatePicker" name="registration_date" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Date">2012-12-01</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">registration_date</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">12px</property>
      </property>
      <property name="Top">335</property>
      <property name="Width">102</property>
    </object>
    <object class="JTLabel" name="lbDocument_ident" >
      <property name="Anchors">
      <property name="Relative">0</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Document ID</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbDocument_ident</property>
      <property name="SiteTheme"></property>
      <property name="Top">362</property>
      <property name="Width">91</property>
    </object>
    <object class="JTAdvancedEdit" name="document_ident" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">document_ident</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">361</property>
      <property name="Width">100</property>
    </object>
    <object class="Label" name="lbError" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Color">#FF0000</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">18</property>
      <property name="Left">10</property>
      <property name="Name">lbError</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">421</property>
      <property name="Width">739</property>
    </object>
    <object class="Image" name="imgOpenInvoice" >
      <property name="Autosize">1</property>
      <property name="Border">0</property>
      <property name="Height">18</property>
      <property name="Hint">open invoice</property>
      <property name="ImageSource">images/ftp/pdf.gif</property>
      <property name="Left">96</property>
      <property name="Link"></property>
      <property name="LinkTarget">_blank</property>
      <property name="Name">imgOpenInvoice</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Stretch">1</property>
      <property name="Top">395</property>
      <property name="Visible">0</property>
      <property name="Width">18</property>
    </object>
    <object class="JTLabel" name="lbOverhead_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Overhead amount</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">500</property>
      <property name="Name">lbOverhead_amt</property>
      <property name="SiteTheme"></property>
      <property name="Top">181</property>
      <property name="Width">123</property>
    </object>
    <object class="JTAdvancedEdit" name="overhead_amt" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Enabled">0</property>
      <property name="Height">21</property>
      <property name="Left">656</property>
      <property name="Name">overhead_amt</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Align">taRight</property>
      </property>
      <property name="Top">180</property>
      <property name="Width">100</property>
    </object>
  </object>
  <object class="HiddenField" name="invoice_issued_id" >
    <property name="Height">18</property>
    <property name="Left">347</property>
    <property name="Name">invoice_issued_id</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="rowTax" >
    <property name="Height">18</property>
    <property name="Left">215</property>
    <property name="Name">rowTax</property>
    <property name="Width">100</property>
  </object>
  <object class="HiddenField" name="SelectedKeysField" >
    <property name="Height">18</property>
    <property name="Left">550</property>
    <property name="Name">SelectedKeysField</property>
    <property name="Width">200</property>
  </object>
  <object class="Query" name="sqlInvoice_issued_tax" >
        <property name="Left">694</property>
        <property name="Top">626</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued_tax</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:32:"Select * from invoice_issued_tax";}</property>
    <property name="TableName">invoice_issued_tax</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued_tax" >
        <property name="Left">694</property>
        <property name="Top">640</property>
    <property name="DataSet">sqlInvoice_issued_tax</property>
    <property name="Name">dsInvoice_issued_tax</property>
  </object>
  <object class="Query" name="sqlInvoice_issued" >
        <property name="Left">590</property>
        <property name="Top">626</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:1:{i:0;s:28:"Select * from invoice_issued";}</property>
    <property name="TableName">invoice_issued</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued" >
        <property name="Left">590</property>
        <property name="Top">640</property>
    <property name="DataSet">sqlInvoice_issued</property>
    <property name="Name">dsInvoice_issued</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">800</property>
        <property name="Top">632</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="ImageList" name="ImageList" >
        <property name="Left">880</property>
        <property name="Top">632</property>
    <property name="Images">a:9:{s:1:"1";s:31:"images/button/refresh_16x16.png";s:1:"2";s:27:"images/button/add_16x16.png";s:1:"3";s:28:"images/button/edit_16x16.png";s:1:"4";s:30:"images/button/cancel_16x16.png";s:1:"5";s:28:"images/button/save_16x16.png";s:1:"6";s:30:"images/button/delete_16x16.png";s:1:"7";s:31:"images/button/invoice_16x16.png";s:1:"8";s:32:"images/button/calendar_16x16.png";s:1:"9";s:28:"images/button/view_16x16.png";}</property>
    <property name="Name">ImageList</property>
  </object>
  <object class="Datasource" name="dsTax_rate" >
        <property name="Left">416</property>
        <property name="Top">644</property>
    <property name="DataSet">sqlTax_rate</property>
    <property name="Name">dsTax_rate</property>
  </object>
  <object class="Query" name="sqlTax_rate" >
        <property name="Left">416</property>
        <property name="Top">627</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlTax_rate</property>
    <property name="OrderField">tax_regime_id, rate_no</property>
    <property name="Params">a:1:{i:0;s:10:"country_id";}</property>
    <property name="SQL">a:3:{i:0;s:33:"Select * from vw_tax_rate_country";i:1;s:20:"Where country_id = ?";i:2;s:0:"";}</property>
    <property name="TableName">tax_rate</property>
  </object>
  <object class="Query" name="sqlCompany_client" >
        <property name="Left">494</property>
        <property name="Top">626</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_client</property>
    <property name="OrderField">client_name</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:2:{i:0;s:29:"SELECT  * FROM company_client";i:1;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_client</property>
  </object>
  <object class="Datasource" name="dsCompany_client" >
        <property name="Left">494</property>
        <property name="Top">640</property>
    <property name="DataSet">sqlCompany_client</property>
    <property name="Name">dsCompany_client</property>
  </object>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">54</property>
        <property name="Top">626</property>
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
        <property name="Left">54</property>
        <property name="Top">642</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
  <object class="Query" name="sqlInvoice_issued_paid" >
        <property name="Left">178</property>
        <property name="Top">626</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlInvoice_issued_paid</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:33:"Select * from invoice_issued_paid";i:1;s:18:"Where paid_amt = 1";}</property>
    <property name="TableName">invoice_issued_paid</property>
  </object>
  <object class="Datasource" name="dsInvoice_issued_paid" >
        <property name="Left">178</property>
        <property name="Top">642</property>
    <property name="DataSet">sqlInvoice_issued_paid</property>
    <property name="Name">dsInvoice_issued_paid</property>
  </object>
  <object class="Query" name="sqlCompany_bank_account" >
        <property name="Left">310</property>
        <property name="Top">626</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCompany_bank_account</property>
    <property name="Order">desc</property>
    <property name="OrderField">is_primary_account_yn</property>
    <property name="Params">a:1:{i:0;s:10:"company_id";}</property>
    <property name="SQL">a:3:{i:0;s:8:"SELECT *";i:1;s:25:"FROM company_bank_account";i:2;s:20:"WHERE company_id = ?";}</property>
    <property name="TableName">company_bank_account</property>
  </object>
  <object class="Datasource" name="dsCompany_bank_account" >
        <property name="Left">310</property>
        <property name="Top">642</property>
    <property name="DataSet">sqlCompany_bank_account</property>
    <property name="Name">dsCompany_bank_account</property>
  </object>
  <object class="StyleSheet" name="StyleSheet1" >
        <property name="Left">56</property>
        <property name="Top">0</property>
    <property name="Name">StyleSheet1</property>
  </object>
</object>
?>
