<?php
<object class="add_company_activity_code" name="add_company_activity_code" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Add company economic activity</property>
  <property name="DocType">dtNone</property>
  <property name="Height">145</property>
  <property name="IsMaster">0</property>
  <property name="Name">add_company_activity_code</property>
  <property name="Width">440</property>
  <property name="OnCreate">add_company_activity_codeCreate</property>
  <object class="JTLabel" name="lbEconomic_activity" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Economic activity</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">11</property>
    <property name="Name">lbEconomic_activity</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">10</property>
    <property name="Width">100</property>
  </object>
  <object class="JTLabel" name="lbCNAE" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">CNAE</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">11</property>
    <property name="Name">lbCNAE</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">36</property>
    <property name="Width">100</property>
  </object>
  <object class="CheckBox" name="main_activity_yn" >
    <property name="Caption">Main activity</property>
    <property name="Height">17</property>
    <property name="Left">7</property>
    <property name="Name">main_activity_yn</property>
    <property name="TabOrder">3</property>
    <property name="Top">59</property>
    <property name="Width">100</property>
  </object>
  <object class="ComboBox" name="activity_code_id" >
    <property name="Height">21</property>
    <property name="Items"><![CDATA[a:2:{i:2;s:7:&quot;2323232&quot;;i:1;s:7:&quot;wqwqwqw&quot;;}]]></property>
    <property name="Left">124</property>
    <property name="Name">activity_code_id</property>
    <property name="Sorted">1</property>
    <property name="TabOrder">1</property>
    <property name="Top">9</property>
    <property name="Width">299</property>
  </object>
  <object class="ComboBox" name="cnae_code_id" >
    <property name="Height">21</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">124</property>
    <property name="Name">cnae_code_id</property>
    <property name="TabOrder">2</property>
    <property name="Top">35</property>
    <property name="Width">299</property>
  </object>
  <object class="Button" name="btnClose" >
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">352</property>
    <property name="Name">btnClose</property>
    <property name="TabOrder">7</property>
    <property name="Top">103</property>
    <property name="Width">75</property>
  </object>
  <object class="Button" name="btnSave" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">272</property>
    <property name="Name">btnSave</property>
    <property name="TabOrder">6</property>
    <property name="Top">103</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveClick</property>
    <property name="jsOnClick">btnSaveJSClick</property>
  </object>
  <object class="JTLabel" name="lbStart_dt" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Start date</property>
    <property name="Datasource"></property>
    <property name="Height">21</property>
    <property name="Left">11</property>
    <property name="Name">lbStart_dt</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">83</property>
    <property name="Width">67</property>
  </object>
  <object class="JTDatePicker" name="start_dt" >
    <property name="AllowTyping">1</property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Date"></property>
    <property name="Height">21</property>
    <property name="Left">124</property>
    <property name="Name">start_dt</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="TabOrder">4</property>
    <property name="Top">83</property>
    <property name="Width">110</property>
  </object>
  <object class="JTLabel" name="lbEnd_dt" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">End date</property>
    <property name="Datasource"></property>
    <property name="Height">21</property>
    <property name="Left">11</property>
    <property name="Name">lbEnd_dt</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">107</property>
    <property name="Width">67</property>
  </object>
  <object class="JTDatePicker" name="end_dt" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Date"></property>
    <property name="Height">21</property>
    <property name="Left">124</property>
    <property name="Name">end_dt</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="TabOrder">5</property>
    <property name="Top">107</property>
    <property name="Width">110</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">24</property>
        <property name="Top">195</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
</object>
?>
