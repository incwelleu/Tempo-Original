<?php
<object class="dmCompany" name="dmCompany" baseclass="DataModule">
  <property name="Height">365</property>
  <property name="Name">dmCompany</property>
  <property name="Width">678</property>
  <object class="Query" name="sqlPayment_method" >
        <property name="Left">41</property>
        <property name="Top">26</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlPayment_method</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:45:&quot;SELECT payment_method_id, payment_method_name&quot;;i:1;s:19:&quot;FROM payment_method&quot;;i:2;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">payment_method</property>
  </object>
  <object class="Datasource" name="dsPayment_method" >
        <property name="Left">41</property>
        <property name="Top">42</property>
    <property name="DataSet">sqlPayment_method</property>
    <property name="Name">dsPayment_method</property>
  </object>
  <object class="Query" name="sqlCountry" >
        <property name="Left">169</property>
        <property name="Top">23</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCountry</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:46:&quot;SELECT country_id, {$language} as country_name&quot;;i:1;s:12:&quot;FROM country&quot;;i:2;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">country</property>
  </object>
  <object class="Datasource" name="dsCountry" >
        <property name="Left">169</property>
        <property name="Top">39</property>
    <property name="DataSet">sqlCountry</property>
    <property name="Name">dsCountry</property>
  </object>
  <object class="Query" name="sqlUser" >
        <property name="Left">39</property>
        <property name="Top">114</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlUser</property>
    <property name="OrderField">username</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:8:&quot;SELECT *&quot;;i:1;s:17:&quot;FROM vw_user_role&quot;;i:2;s:32:&quot;WHERE role_name = &quot;Client admin&quot;&quot;;}]]></property>
    <property name="TableName">user</property>
  </object>
  <object class="Datasource" name="dsUser" >
        <property name="Left">39</property>
        <property name="Top">130</property>
    <property name="DataSet">sqlUser</property>
    <property name="Name">dsUser</property>
  </object>
  <object class="Query" name="vw_account_manager" >
        <property name="Left">39</property>
        <property name="Top">201</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">vw_account_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:8:&quot;SELECT *&quot;;i:1;s:23:&quot;FROM vw_account_manager&quot;;i:2;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">vw_account_manager</property>
  </object>
  <object class="Datasource" name="dsAccount_manager" >
        <property name="Left">39</property>
        <property name="Top">217</property>
    <property name="DataSet">vw_account_manager</property>
    <property name="Name">dsAccount_manager</property>
  </object>
  <object class="Query" name="vw_accountant_manager" >
        <property name="Left">163</property>
        <property name="Top">201</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">vw_accountant_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:3:{i:0;s:8:&quot;SELECT *&quot;;i:1;s:26:&quot;FROM vw_accountant_manager&quot;;i:2;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">vw_account_manager</property>
  </object>
  <object class="Datasource" name="dsAccountant_manager" >
        <property name="Left">163</property>
        <property name="Top">217</property>
    <property name="DataSet">vw_accountant_manager</property>
    <property name="Name">dsAccountant_manager</property>
  </object>
  <object class="Query" name="vw_payroll_manager" >
        <property name="Left">307</property>
        <property name="Top">201</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">vw_payroll_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:1:{i:0;s:32:&quot;Select * From vw_payroll_manager&quot;;}]]></property>
    <property name="TableName">vw_payroll_manager</property>
  </object>
  <object class="Datasource" name="dsPayroll_manager" >
        <property name="Left">307</property>
        <property name="Top">217</property>
    <property name="DataSet">vw_payroll_manager</property>
    <property name="Name">dsPayroll_manager</property>
  </object>
  <object class="Query" name="sqlStreet_type" >
        <property name="Left">168</property>
        <property name="Top">112</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlStreet_type</property>
    <property name="OrderField">description</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:2:{i:0;s:25:&quot;Select * from street_type&quot;;i:1;s:0:&quot;&quot;;}]]></property>
    <property name="TableName">street_type</property>
  </object>
  <object class="Datasource" name="dsStreet_type" >
        <property name="Left">168</property>
        <property name="Top">128</property>
    <property name="DataSet">sqlStreet_type</property>
    <property name="Name">dsStreet_type</property>
  </object>
</object>
?>
