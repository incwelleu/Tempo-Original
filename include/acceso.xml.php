<?php
<object class="acceso" name="acceso" baseclass="DataModule">
  <property name="Cached"></property>
  <property name="Height">170</property>
  <property name="Name">acceso</property>
  <property name="Width">218</property>
  <object class="JTUserLogin" name="Login_user" >
        <property name="Left">27</property>
        <property name="Top">13</property>
    <property name="CookieExpirySeconds">28800</property>
    <property name="CookieName">StrongWeber</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="Hash">Custom</property>
    <property name="LoggedInUser"></property>
    <property name="LoginIDField">login_data</property>
    <property name="Name">Login_user</property>
    <property name="PasswordField">password</property>
    <property name="UserNameField">username</property>
    <property name="UserTable">user</property>
    <property name="OnCustomHash">Login_userCustomHash</property>
    <property name="OnLoggedOut">Login_userLoggedOut</property>
    <property name="OnLogin">Login_userLogin</property>
  </object>
  <object class="Query" name="sqlUser" >
        <property name="Left">104</property>
        <property name="Top">16</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlUser</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:0:{}</property>
    <property name="TableName">user</property>
  </object>
</object>
?>
