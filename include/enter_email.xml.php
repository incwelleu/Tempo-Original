<?php
<object class="enter_email" name="enter_email" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Enter email</property>
  <property name="DocType">dtNone</property>
  <property name="Height">116</property>
  <property name="IsMaster">0</property>
  <property name="Name">enter_email</property>
  <property name="Width">475</property>
  <property name="OnShow">enter_emailShow</property>
  <object class="JTAdvancedEdit" name="get_confirm_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">21</property>
    <property name="Left">105</property>
    <property name="Name">get_confirm_email</property>
    <property name="SiteTheme"></property>
    <property name="Top">37</property>
    <property name="Width">355</property>
    <property name="jsOnChange">get_confirm_emailJSKeyUp</property>
    <property name="jsOnKeyUp">get_confirm_emailJSKeyUp</property>
  </object>
  <object class="JTAdvancedEdit" name="get_enter_email" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Height">21</property>
    <property name="Left">105</property>
    <property name="Name">get_enter_email</property>
    <property name="SiteTheme"></property>
    <property name="Top">5</property>
    <property name="Width">355</property>
    <property name="jsOnChange">get_confirm_emailJSKeyUp</property>
    <property name="jsOnKeyUp">get_confirm_emailJSKeyUp</property>
  </object>
  <object class="Label" name="lbEnter_email" >
    <property name="Caption">Enter Email</property>
    <property name="Height">13</property>
    <property name="Left">12</property>
    <property name="Name">lbEnter_email</property>
    <property name="Top">9</property>
    <property name="Width">75</property>
  </object>
  <object class="Label" name="lbConfirm_email" >
    <property name="Caption">Confirm Email</property>
    <property name="Height">13</property>
    <property name="Left">12</property>
    <property name="Name">lbConfirm_email</property>
    <property name="Top">45</property>
    <property name="Width">75</property>
  </object>
  <object class="Button" name="btnEnter_email" >
    <property name="Caption">Submit</property>
    <property name="Enabled">0</property>
    <property name="Height">25</property>
    <property name="Left">305</property>
    <property name="Name">btnEnter_email</property>
    <property name="Top">70</property>
    <property name="Width">75</property>
  </object>
  <object class="Button" name="btnClose_email" >
    <property name="Caption">Close</property>
    <property name="Height">25</property>
    <property name="Left">385</property>
    <property name="Name">btnClose_email</property>
    <property name="Top">70</property>
    <property name="Width">75</property>
  </object>
  <object class="Label" name="lbError_email" >
    <property name="Autosize">1</property>
    <property name="Font">
    <property name="Color">Red</property>
    </property>
    <property name="Height">13</property>
    <property name="Left">12</property>
    <property name="Name">lbError_email</property>
    <property name="ParentFont">0</property>
    <property name="Top">76</property>
    <property name="Width">267</property>
  </object>
</object>
?>
