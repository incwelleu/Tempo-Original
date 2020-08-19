<?php
<object class="email_edit" name="email_edit" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Email edit</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">453</property>
  <property name="IsMaster">0</property>
  <property name="Name">email_edit</property>
  <property name="Width">694</property>
  <property name="OnCreate">email_editCreate</property>
  <property name="OnShow">email_editShow</property>
  <property name="OnShowHeader">email_editShowHeader</property>
  <object class="Memo" name="body" >
    <property name="Height">273</property>
    <property name="Left">8</property>
    <property name="Lines">a:0:{}</property>
    <property name="Name">body</property>
    <property name="Style">textarea</property>
    <property name="Top">131</property>
    <property name="Width">676</property>
  </object>
  <object class="JTLabel" name="lbFrom_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">From</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">lbFrom_email</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">33</property>
    <property name="Width">60</property>
  </object>
  <object class="JTAdvancedEdit" name="to_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">76</property>
    <property name="MaxLength">255</property>
    <property name="Name">to_email</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="Top">54</property>
    <property name="Width">603</property>
  </object>
  <object class="JTLabel" name="lbTo_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">To</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">lbTo_email</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">57</property>
    <property name="Width">60</property>
  </object>
  <object class="JTLabel" name="lbCc" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Cc</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">lbCc</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">81</property>
    <property name="Width">60</property>
  </object>
  <object class="JTAdvancedEdit" name="cc_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">76</property>
    <property name="MaxLength">255</property>
    <property name="Name">cc_email</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="Top">78</property>
    <property name="Width">603</property>
  </object>
  <object class="JTLabel" name="lbTemplate" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Template</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">lbTemplate</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">7</property>
    <property name="Width">60</property>
  </object>
  <object class="JTLabel" name="lbSubject" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Subject</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">8</property>
    <property name="Name">lbSubject</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">105</property>
    <property name="Width">60</property>
  </object>
  <object class="JTAdvancedEdit" name="subject" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">24</property>
    <property name="Left">76</property>
    <property name="MaxLength">200</property>
    <property name="Name">subject</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="Top">102</property>
    <property name="Width">603</property>
  </object>
  <object class="JTAdvancedEdit" name="from_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Enabled">0</property>
    <property name="Height">24</property>
    <property name="Left">76</property>
    <property name="Name">from_email</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Size">11px</property>
    </property>
    <property name="Top">30</property>
    <property name="Width">603</property>
  </object>
  <object class="ComboBox" name="email_template_id" >
    <property name="Enabled">0</property>
    <property name="Height">21</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">76</property>
    <property name="Name">email_template_id</property>
    <property name="Top">6</property>
    <property name="Width">363</property>
    <property name="OnChange">email_template_idChange</property>
    <property name="jsOnChange">email_template_idJSChange</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">624</property>
        <property name="Top">8</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlEmail_template" >
        <property name="Left">48</property>
        <property name="Top">336</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlEmail_template</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:53:&quot;Select email_template_id, subject from email_template&quot;;i:1;s:22:&quot;Where to_client_yn = 1&quot;;i:2;s:16:&quot;Order by subject&quot;;}]]></property>
    <property name="TableName">email_template</property>
  </object>
  <object class="Datasource" name="dsEmail_template" >
        <property name="Left">48</property>
        <property name="Top">352</property>
    <property name="DataSet">sqlEmail_template</property>
    <property name="Name">dsEmail_template</property>
  </object>
  <object class="Query" name="sqlEmail" >
        <property name="Left">128</property>
        <property name="Top">336</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlEmail</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:19:&quot;Select * from email&quot;;}]]></property>
    <property name="TableName">email_template</property>
  </object>
  <object class="Datasource" name="dsEmail" >
        <property name="Left">128</property>
        <property name="Top">352</property>
    <property name="DataSet">sqlEmail</property>
    <property name="Name">dsEmail</property>
  </object>
  <object class="Button" name="btnCloseEmailEdit" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">609</property>
    <property name="Name">btnCloseEmailEdit</property>
    <property name="TabOrder">23</property>
    <property name="Top">426</property>
    <property name="Width">75</property>
    <property name="OnClick">btnCloseEmailEditClick</property>
  </object>
  <object class="Button" name="btnSaveEmailEdit" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Save</property>
    <property name="Height">25</property>
    <property name="Left">529</property>
    <property name="Name">btnSaveEmailEdit</property>
    <property name="TabOrder">22</property>
    <property name="Top">426</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSaveEmailEditClick</property>
  </object>
</object>
?>
