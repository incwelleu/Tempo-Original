<?php
<object class="company" name="company" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Company</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Height">460</property>
  <property name="IsMaster">0</property>
  <property name="Name">company</property>
  <property name="UseAjax">1</property>
  <property name="Width">807</property>
  <property name="OnCreate">companyCreate</property>
  <object class="JTTabControl" name="TabCompany" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">31</property>
    <property name="Name">TabCompany</property>
    <property name="SiteTheme"></property>
    <property name="TabIndex">0</property>
    <property name="Tabs"><![CDATA[a:4:{i:0;a:3:{i:0;s:11:&quot;JTTabSheet1&quot;;i:1;s:11:&quot;JTTabSheet1&quot;;i:2;s:1:&quot;1&quot;;}i:1;a:3:{i:0;s:11:&quot;JTTabSheet2&quot;;i:1;s:11:&quot;JTTabSheet2&quot;;i:2;s:1:&quot;1&quot;;}i:2;a:3:{i:0;s:11:&quot;JTTabSheet3&quot;;i:1;s:11:&quot;JTTabSheet3&quot;;i:2;s:1:&quot;1&quot;;}i:3;a:3:{i:0;s:11:&quot;JTTabSheet4&quot;;i:1;s:11:&quot;JTTabSheet4&quot;;i:2;s:1:&quot;1&quot;;}}]]></property>
    <property name="Top">26</property>
    <property name="Width">800</property>
    <property name="jsOnChange">TabCompanyJSChange</property>
  </object>
  <object class="JTIFrame" name="fmCompany" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">400</property>
    <property name="Left">3</property>
    <property name="Name">fmCompany</property>
    <property name="ShowBorder">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">57</property>
    <property name="Width">800</property>
  </object>
  <object class="HiddenField" name="active_tab" >
    <property name="Height">18</property>
    <property name="Left">432</property>
    <property name="Name">active_tab</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="company_id" >
    <property name="Height">18</property>
    <property name="Left">275</property>
    <property name="Name">company_id</property>
    <property name="Width">109</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">559</property>
        <property name="Top">800</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
</object>
?>
