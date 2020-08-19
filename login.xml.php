<?php
<object class="login" name="login" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Font">
  <property name="Color">#ffffff</property>
  <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
  <property name="Size">13px</property>
  </property>
  <property name="GenerateTable">0</property>
  <property name="Height">363</property>
  <property name="IsMaster">0</property>
  <property name="Layout">
  <property name="Rows">1</property>
  </property>
  <property name="Name">login</property>
  <property name="Width">397</property>
  <property name="OnCreate">loginCreate</property>
  <property name="OnShowHeader">loginShowHeader</property>
  <property name="jsOnLoad">loginJSLoad</property>
  <object class="JTDivWindow" name="dwSignIn" >
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
    <property name="Height">206</property>
    <property name="Layer">1</property>
    <property name="Left">11</property>
    <property name="Name">dwSignIn</property>
    <property name="Position">poBrowserCenter</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">113</property>
    <property name="Width">374</property>
    <object class="Label" name="lbCookies" >
      <property name="Caption">Your browser must allow cookies in order to login.</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">10px</property>
      <property name="Style">fsItalic</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">10</property>
      <property name="Name">lbCookies</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="ParentShowHint">0</property>
      <property name="Top">45</property>
      <property name="Width">307</property>
    </object>
    <object class="Label" name="lbUser" >
      <property name="Caption">User name:</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">13px</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">10</property>
      <property name="Name">lbUser</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">79</property>
      <property name="Width">120</property>
    </object>
    <object class="Label" name="lbPassword" >
      <property name="Caption">Password:</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">13px</property>
      </property>
      <property name="Height">13</property>
      <property name="Left">10</property>
      <property name="Name">lbPassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">113</property>
      <property name="Width">120</property>
    </object>
    <object class="Label" name="lbSignIn" >
      <property name="Caption">Sign in</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">18px</property>
      </property>
      <property name="Height">24</property>
      <property name="Left">10</property>
      <property name="Name">lbSignIn</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">23</property>
      <property name="Width">107</property>
    </object>
    <object class="Button" name="BtnLogin" >
      <property name="Caption">Login</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">28</property>
      <property name="Left">48</property>
      <property name="Name">BtnLogin</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">3</property>
      <property name="Top">144</property>
      <property name="Width">130</property>
    </object>
    <object class="Button" name="BtnCancel" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">28</property>
      <property name="Left">192</property>
      <property name="Name">BtnCancel</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">3</property>
      <property name="Top">144</property>
      <property name="Width">130</property>
      <property name="jsOnClick">BtnCancelJSClick</property>
    </object>
    <object class="Edit" name="username" >
      <property name="Cached">1</property>
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">21</property>
      <property name="Left">148</property>
      <property name="Name">username</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">1</property>
      <property name="Top">75</property>
      <property name="Width">195</property>
    </object>
    <object class="Edit" name="password" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">21</property>
      <property name="IsPassword">1</property>
      <property name="Left">148</property>
      <property name="MaxLength">20</property>
      <property name="Name">password</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">2</property>
      <property name="Top">109</property>
      <property name="Width">195</property>
    </object>
    <object class="Label" name="lbError" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Color">#FF0000</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">25</property>
      <property name="Left">10</property>
      <property name="Name">lbError</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">175</property>
      <property name="Width">356</property>
    </object>
    <object class="Label" name="lbChangePassword" >
      <property name="Caption">Change password</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">18px</property>
      </property>
      <property name="Height">24</property>
      <property name="Layer">1</property>
      <property name="Left">10</property>
      <property name="Name">lbChangePassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="ParentShowHint">0</property>
      <property name="Top">23</property>
      <property name="Width">199</property>
    </object>
    <object class="Label" name="lbNewpassword" >
      <property name="Caption">
New Password:</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">13px</property>
      </property>
      <property name="Height">13</property>
      <property name="Layer">1</property>
      <property name="Left">10</property>
      <property name="Name">lbNewpassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">79</property>
      <property name="Width">120</property>
    </object>
    <object class="Edit" name="newpassword" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">21</property>
      <property name="IsPassword">1</property>
      <property name="Layer">1</property>
      <property name="Left">183</property>
      <property name="MaxLength">20</property>
      <property name="Name">newpassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">1</property>
      <property name="Top">75</property>
      <property name="Width">179</property>
    </object>
    <object class="Edit" name="confirmpassword" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">21</property>
      <property name="IsPassword">1</property>
      <property name="Layer">1</property>
      <property name="Left">183</property>
      <property name="MaxLength">20</property>
      <property name="Name">confirmpassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">2</property>
      <property name="Top">109</property>
      <property name="Width">179</property>
    </object>
    <object class="Label" name="lbConfirmpassword" >
      <property name="Caption">Confirm New Password:</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">13px</property>
      </property>
      <property name="Height">13</property>
      <property name="Layer">1</property>
      <property name="Left">10</property>
      <property name="Name">lbConfirmpassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">113</property>
      <property name="Width">165</property>
    </object>
    <object class="Button" name="BtnChange" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Change</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">28</property>
      <property name="Layer">1</property>
      <property name="Left">48</property>
      <property name="Name">BtnChange</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">3</property>
      <property name="Top">144</property>
      <property name="Width">130</property>
      <property name="OnClick">BtnChangeClick</property>
    </object>
    <object class="Button" name="BtnCancelPassword" >
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Cancel</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">28</property>
      <property name="Layer">1</property>
      <property name="Left">192</property>
      <property name="Name">BtnCancelPassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="TabOrder">3</property>
      <property name="Top">144</property>
      <property name="Width">130</property>
      <property name="OnClick">BtnCancelPasswordClick</property>
    </object>
    <object class="Label" name="lbErrorChange" >
      <property name="Color">#ffffff</property>
      <property name="Font">
      <property name="Color">#FF0000</property>
      <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
      </property>
      <property name="Height">25</property>
      <property name="Layer">1</property>
      <property name="Left">10</property>
      <property name="Name">lbErrorChange</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">175</property>
      <property name="Visible">0</property>
      <property name="Width">356</property>
    </object>
    <object class="Label" name="lbLenpassword" >
      <property name="Caption">Use only letters and numbers. Must be between 4 and 20 characters long.</property>
      <property name="Font">
      <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
      <property name="Size">10px</property>
      <property name="Style">fsItalic</property>
      </property>
      <property name="Height">13</property>
      <property name="Layer">1</property>
      <property name="Left">10</property>
      <property name="Name">lbLenpassword</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">45</property>
      <property name="Width">355</property>
    </object>
  </object>
  <object class="Label" name="logo" >
    <property name="Autosize">1</property>
    <property name="Font">
    <property name="Color">black</property>
    </property>
    <property name="Height">35</property>
    <property name="Name">logo</property>
    <property name="ParentColor">0</property>
    <property name="ParentFont">0</property>
    <property name="Style">.logo</property>
    <property name="Width">307</property>
    <property name="jsOnClick">BtnCancelJSClick</property>
  </object>
  <object class="Label" name="subtitle" >
    <property name="Autosize">1</property>
    <property name="Caption">Business and legal solutions in Spain</property>
    <property name="Font">
    <property name="Color">black</property>
    <property name="Family">Verdana, Arial, Helvetica, sans-serif</property>
    </property>
    <property name="Height">19</property>
    <property name="Name">subtitle</property>
    <property name="ParentColor">0</property>
    <property name="ParentFont">0</property>
    <property name="ParentShowHint">0</property>
    <property name="Style">.subtitle</property>
    <property name="Top">56</property>
    <property name="Width">308</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">32</property>
        <property name="Top">312</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="StyleSheet" name="StyleSheet" >
        <property name="Left">344</property>
        <property name="Top">16</property>
    <property name="FileName">css/strongabogados.css</property>
    <property name="IncludeID">1</property>
    <property name="IncludeStandard">1</property>
    <property name="IncludeSubStyle">1</property>
    <property name="Name">StyleSheet</property>
  </object>
</object>
?>
