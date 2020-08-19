<?php
<object class="connectionDB" name="connectionDB" baseclass="DataModule">
  <property name="Height">150</property>
  <property name="Name">connectionDB</property>
  <property name="Width">196</property>
  <object class="Database" name="DbConnection" >
        <property name="Left">56</property>
        <property name="Top">16</property>
    <property name="Connected"></property>
    <property name="DriverName">mysql</property>
    <property name="Name">DbConnection</property>
    <property name="OnCustomConnect">DbConnectionCustomConnect</property>
  </object>
</object>
?>
