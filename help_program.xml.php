<?php
<object class="help_program" name="help_program" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Help program</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="FrameBorder">fbDefault</property>
  <property name="Height">487</property>
  <property name="IsMaster">0</property>
  <property name="Name">help_program</property>
  <property name="ShowHint">1</property>
  <property name="UseAjax">1</property>
  <property name="Width">772</property>
  <property name="OnCreate">help_programCreate</property>
  <object class="JTTreeView" name="tvMenu" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CaptionField">name</property>
    <property name="Datasource">dsMenu</property>
    <property name="Height">472</property>
    <property name="Items">a:0:{}</property>
    <property name="KeyField">nodo_id</property>
    <property name="Left">8</property>
    <property name="LinkField">link</property>
    <property name="Name">tvMenu</property>
    <property name="ParentField">parent_id</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">6</property>
    <property name="Width">259</property>
    <property name="jsOnClick">tvMenuJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">360</property>
        <property name="Top">400</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlMenu" >
        <property name="Left">18</property>
        <property name="Top">408</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlMenu</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL"><![CDATA[a:11:{i:0;s:17:&quot;Select DISTINCT *&quot;;i:1;s:4:&quot;FROM&quot;;i:2;s:29:&quot;	(Select DISTINCT children.* &quot;;i:3;s:18:&quot;	from virtual_file&quot;;i:4;s:13:&quot;		inner join &quot;;i:5;s:91:&quot;    		(Select * from virtual_file) as children on virtual_file.parent_id = children.nodo_id&quot;;i:6;s:12:&quot;            &quot;;i:7;s:11:&quot;	union all &quot;;i:8;s:4:&quot;    &quot;;i:9;s:80:&quot;	Select * from virtual_file where company_id != 0 OR parent_id = 0) as Tree_view&quot;;i:10;s:13:&quot;Order by name&quot;;}]]></property>
  </object>
  <object class="Datasource" name="dsMenu" >
        <property name="Left">18</property>
        <property name="Top">424</property>
    <property name="DataSet">sqlMenu</property>
    <property name="Name">dsMenu</property>
  </object>
  <object class="JTIFrame" name="fmMain" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">472</property>
    <property name="Left">283</property>
    <property name="Name">fmMain</property>
    <property name="SiteTheme"></property>
    <property name="Top">6</property>
    <property name="Width">483</property>
  </object>
</object>
?>
