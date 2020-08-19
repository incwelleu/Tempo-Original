<?php
<object class="main" name="main" baseclass="Page">
  <property name="Background"></property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Font">
  <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
  </property>
  <property name="Height">486</property>
  <property name="IsMaster">0</property>
  <property name="Name">main</property>
  <property name="ShowHint">1</property>
  <property name="UseAjax">1</property>
  <property name="Width">666</property>
  <property name="OnCreate">mainCreate</property>
  <property name="OnShowHeader">mainShowHeader</property>
  <property name="jsOnLoad">mainJSLoad</property>
  <object class="Label" name="lbCompany" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">Company:</property>
    <property name="Font">
    <property name="Color">#34596E</property>
    <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
    <property name="Style">fsNormal</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">5</property>
    <property name="Name">lbCompany</property>
    <property name="ParentFont">0</property>
    <property name="Top">78</property>
    <property name="Width">59</property>
  </object>
  <object class="ComboBox" name="cbCompany" >
    <property name="Font">
    <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
    <property name="Size">12px</property>
    </property>
    <property name="Height">21</property>
    <property name="Hint">Select company</property>
    <property name="Items">a:0:{}</property>
    <property name="Left">69</property>
    <property name="Name">cbCompany</property>
    <property name="ParentFont">0</property>
    <property name="ParentShowHint">0</property>
    <property name="ShowHint">1</property>
    <property name="Top">76</property>
    <property name="Width">203</property>
    <property name="OnChange">cbCompanyChange</property>
  </object>
  <object class="JTIFrame" name="fmMain" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">381</property>
    <property name="Left">303</property>
    <property name="Name">fmMain</property>
    <property name="ShowBorder">0</property>
    <property name="SiteTheme"></property>
    <property name="Top">100</property>
    <property name="Width">363</property>
  </object>
  <object class="JTPanel" name="pnClient" >
    <property name="Anchors">
    <property name="Left">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">74</property>
    <property name="Left">300</property>
    <property name="Name">pnClient</property>
    <property name="ParentColor">0</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Width">366</property>
    <object class="Label" name="changepassword" >
      <property name="Alignment">agRight</property>
      <property name="Caption">Change password</property>
      <property name="Cursor">crPointer</property>
      <property name="DesignColor">#34596E</property>
      <property name="Font">
      <property name="Align">taRight</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">13</property>
      <property name="Hint">Change password</property>
      <property name="Left">226</property>
      <property name="Name">changepassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Style">.label-ref</property>
      <property name="Top">31</property>
      <property name="Width">135</property>
      <property name="OnClick">changepasswordClick</property>
    </object>
    <object class="Label" name="lbUser" >
      <property name="Alignment">agRight</property>
      <property name="Caption">lbUser</property>
      <property name="Color">#34596E</property>
      <property name="Font">
      <property name="Align">taRight</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">100</property>
      <property name="Name">lbUser</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="ParentShowHint">0</property>
      <property name="Style">.label</property>
      <property name="Top">7</property>
      <property name="Width">261</property>
    </object>
    <object class="Label" name="lbLogout" >
      <property name="Alignment">agRight</property>
      <property name="Caption">Logout</property>
      <property name="Cursor">crPointer</property>
      <property name="DesignColor">#34596E</property>
      <property name="Font">
      <property name="Align">taRight</property>
      <property name="Color">#ffffff</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">18</property>
      <property name="Left">211</property>
      <property name="Name">lbLogout</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="ParentShowHint">0</property>
      <property name="ShowHint">1</property>
      <property name="Style">.label-ref</property>
      <property name="Top">56</property>
      <property name="Width">150</property>
      <property name="OnClick">lbLogoutClick</property>
    </object>
  </object>
  <object class="Label" name="logo" >
    <property name="Autosize">1</property>
    <property name="Height">43</property>
    <property name="Name">logo</property>
    <property name="Style">.logo</property>
    <property name="Width">275</property>
    <property name="jsOnClick">logoJSClick</property>
  </object>
  <object class="Label" name="subtitle" >
    <property name="Autosize">1</property>
    <property name="Caption">Business and legal solutions in Spain</property>
    <property name="Height">13</property>
    <property name="Name">subtitle</property>
    <property name="ParentShowHint">0</property>
    <property name="Style">.subtitle</property>
    <property name="Width">243</property>
  </object>
  <object class="HiddenField" name="menu" >
    <property name="Height">18</property>
    <property name="Left">5</property>
    <property name="Name">menu</property>
    <property name="Top">399</property>
    <property name="Value">0</property>
    <property name="Width">99</property>
  </object>
  <object class="JTTreeView" name="tvMenu" >
    <property name="Anchors">
    <property name="Bottom">1</property>
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CaptionField">name</property>
    <property name="Datasource">dsMenu</property>
    <property name="Height">381</property>
    <property name="Items">a:0:{}</property>
    <property name="KeyField">nodo_id</property>
    <property name="LinkField">link</property>
    <property name="Name">tvMenu</property>
    <property name="ParentField">parent_id</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">100</property>
    <property name="Width">288</property>
    <property name="OnClick">tvMenuClick</property>
    <property name="jsOnClick">tvMenuJSClick</property>
  </object>
  <object class="JTLabel" name="lbStatusCompany" >
    <property name="Anchors">
    <property name="Relative">0</property>
    <property name="Right">1</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">488</property>
    <property name="Name">lbStatusCompany</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Color">red</property>
    <property name="Size">12px</property>
    </property>
    <property name="Top">78</property>
    <property name="Width">173</property>
  </object>
  <object class="HiddenField" name="msgWarning" >
    <property name="Height">18</property>
    <property name="Name">msgWarning</property>
    <property name="Top">48</property>
    <property name="Width">200</property>
  </object>
  <object class="Image" name="imRefresh" >
    <property name="Autosize">1</property>
    <property name="Border">0</property>
    <property name="Cursor">crPointer</property>
    <property name="Height">16</property>
    <property name="Hint">Refresh</property>
    <property name="ImageSource">images/button/refresh_16x16.png</property>
    <property name="Left">277</property>
    <property name="Link"></property>
    <property name="LinkTarget"></property>
    <property name="Name">imRefresh</property>
    <property name="Top">78</property>
    <property name="Width">16</property>
    <property name="jsOnClick">imRefreshJSClick</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">376</property>
        <property name="Top">8</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="StyleSheet" name="StyleSheet" >
        <property name="Left">448</property>
        <property name="Top">8</property>
    <property name="FileName">css/strongabogados.css</property>
    <property name="IncludeID">1</property>
    <property name="IncludeStandard">1</property>
    <property name="IncludeSubStyle">1</property>
    <property name="Name">StyleSheet</property>
  </object>
  <object class="Query" name="sqlMenu" >
        <property name="Left">18</property>
        <property name="Top">408</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlMenu</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:11:{i:0;s:17:"Select DISTINCT *";i:1;s:4:"FROM";i:2;s:29:"	(Select DISTINCT children.* ";i:3;s:18:"	from virtual_file";i:4;s:13:"		inner join ";i:5;s:91:"    		(Select * from virtual_file) as children on virtual_file.parent_id = children.nodo_id";i:6;s:12:"            ";i:7;s:11:"	union all ";i:8;s:4:"    ";i:9;s:80:"	Select * from virtual_file where company_id != 0 OR parent_id = 0) as Tree_view";i:10;s:13:"Order by name";}</property>
  </object>
  <object class="Datasource" name="dsMenu" >
        <property name="Left">18</property>
        <property name="Top">424</property>
    <property name="DataSet">sqlMenu</property>
    <property name="Name">dsMenu</property>
  </object>
  <object class="JTLabel" name="lbLastInvoice" >
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">303</property>
    <property name="Name">lbLastInvoice</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">12px</property>
    </property>
    <property name="Top">78</property>
    <property name="Width">175</property>
  </object>
</object>
?>
