<?php
<object class="fmstrong" name="fmstrong" baseclass="Page">
  <property name="Background"></property>
  <property name="Caption">Fmstrong</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Height">430</property>
  <property name="IsMaster">1</property>
  <property name="Name">fmstrong</property>
  <property name="Width">611</property>
  <property name="OnShowHeader">fmstrongShowHeader</property>
  <property name="jsOnLoad">fmstrongJSLoad</property>
  <object class="HiddenField" name="msgSuccess" >
    <property name="Height">18</property>
    <property name="Left">208</property>
    <property name="Name">msgSuccess</property>
    <property name="Top">64</property>
    <property name="Width">200</property>
  </object>
  <object class="HiddenField" name="msgError" >
    <property name="Height">18</property>
    <property name="Left">208</property>
    <property name="Name">msgError</property>
    <property name="Top">32</property>
    <property name="Width">200</property>
    <property name="jsOnChange">msgErrorJSChange</property>
  </object>
  <object class="HiddenField" name="msgWarning" >
    <property name="Height">18</property>
    <property name="Left">208</property>
    <property name="Name">msgWarning</property>
    <property name="Top">104</property>
    <property name="Width">200</property>
  </object>
  <object class="Label" name="lbTitle" >
    <property name="Alignment">agLeft</property>
    <property name="Autosize">1</property>
    <property name="Caption">lbTitle</property>
    <property name="Font">
    <property name="Color">#0c6478</property>
    <property name="Family">Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif</property>
    <property name="Size">15px</property>
    </property>
    <property name="Height">19</property>
    <property name="Left">7</property>
    <property name="Name">lbTitle</property>
    <property name="ParentFont">0</property>
    <property name="Visible">0</property>
    <property name="Width">438</property>
    <property name="OnShow">lbTitleShow</property>
  </object>
</object>
?>
