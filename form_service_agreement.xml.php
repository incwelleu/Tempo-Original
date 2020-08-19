<?php
<object class="form_service_agreement" name="form_service_agreement" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Background"></property>
  <property name="Caption">Service Agreement</property>
  <property name="DocType">dtHTML_4_01_Strict</property>
  <property name="Encoding">Unicode (UTF-8)            |utf-8</property>
  <property name="Font">
  <property name="Size">9pt</property>
  </property>
  <property name="Height">1378</property>
  <property name="IsMaster">0</property>
  <property name="Layout">
  <property name="Type">REL_XY_LAYOUT</property>
  </property>
  <property name="Name">form_service_agreement</property>
  <property name="UseAjax">1</property>
  <property name="Width">802</property>
  <property name="OnCreate">form_service_agreementCreate</property>
  <property name="OnShowHeader">form_service_agreementShowHeader</property>
  <property name="jsOnLoad">form_service_agreementJSLoad</property>
  <object class="JTLabel" name="lbLOPD" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Datasource"></property>
    <property name="Height">247</property>
    <property name="Left">9</property>
    <property name="Name">lbLOPD</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Color">blanck</property>
    <property name="Size">9pt</property>
    </property>
    <property name="TabStop">0</property>
    <property name="Top">1075</property>
    <property name="Width">771</property>
  </object>
  <object class="Memo" name="notes_service_agreement" >
    <property name="BorderStyle">bsNone</property>
    <property name="Font">
    <property name="Size">10pt</property>
    </property>
    <property name="Height">136</property>
    <property name="Left">9</property>
    <property name="Lines">a:0:{}</property>
    <property name="MaxLength">1024</property>
    <property name="Name">notes_service_agreement</property>
    <property name="ParentFont">0</property>
    <property name="TabStop">0</property>
    <property name="Top">596</property>
    <property name="Width">770</property>
  </object>
  <object class="JTPlatinumGrid" name="gridLine_item" >
    <property name="AllowDelete">0</property>
    <property name="AllowInsert">0</property>
    <property name="AllowUpdate">0</property>
    <property name="Anchors">
    <property name="Relative">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="CanDragSelect">0</property>
    <property name="CanMoveCols">0</property>
    <property name="CanMultiColumnSort">0</property>
    <property name="CanRangeSelect">0</property>
    <property name="CanResizeCols">0</property>
    <property name="CellData">a:0:{}</property>
    <property name="Columns"><![CDATA[a:4:{i:0;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:554:"a:11:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:28:"<strong>Description</strong>";s:9:"DataField";s:11:"description";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"description";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"430";}";}i:1;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:631:"a:14:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:25:"<strong>Quantity</strong>";s:9:"DataField";s:11:"quantity_no";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:11:"quantity_no";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:2:"80";}";}i:2;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:649:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:22:"<strong>Price</strong>";s:9:"DataField";s:9:"price_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"price_amt";s:14:"ShowSortButton";b:0;s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:5:"Width";s:3:"110";}";}i:3;a:2:{i:0;s:24:"JTPlatinumGridTextColumn";i:1;s:641:"a:15:{s:14:"ComboBoxEditor";s:6:"a:0:{}";s:10:"DataFormat";s:6:"%01.2f";s:10:"EditEditor";s:6:"a:0:{}";s:20:"LookupComboBoxEditor";s:26:"a:1:{s:10:"Datasource";N;}";s:9:"Alignment";s:7:"agRight";s:7:"CanEdit";b:0;s:9:"CanFilter";b:0;s:7:"CanMove";b:0;s:7:"CanSort";b:0;s:7:"Caption";s:22:"<strong>Total</strong>";s:9:"DataField";s:9:"total_amt";s:12:"GroupSummary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";i:0;}";s:4:"Name";s:9:"total_amt";s:7:"Summary";s:98:"a:5:{s:7:"ShowAvg";i:0;s:9:"ShowCount";i:0;s:7:"ShowMax";i:0;s:7:"ShowMin";i:0;s:7:"ShowSum";b:1;}";s:5:"Width";s:3:"110";}";}}]]></property>
    <property name="CommandBar">
    <property name="ExportAllRecords">0</property>
    <property name="PrintAllRecords">0</property>
    <property name="ShowBottomCommandBar">0</property>
    <property name="ShowExportCSV">0</property>
    <property name="ShowExportPDF">0</property>
    <property name="ShowExportXLS">0</property>
    <property name="ShowInsertRecord">0</property>
    <property name="ShowPrint">0</property>
    <property name="ShowRefresh">0</property>
    <property name="ShowTopCommandBar">0</property>
    </property>
    <property name="EvenRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="FillWidth">0</property>
    <property name="GridLines">
    <property name="Vertical">0</property>
    </property>
    <property name="Header">
    <property name="FilterDelay">0</property>
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    <property name="ShowFilterBar">0</property>
    <property name="ShowGroupBar">0</property>
    <property name="SimpleFilter">0</property>
    </property>
    <property name="Height">203</property>
    <property name="Left">9</property>
    <property name="Name">gridLine_item</property>
    <property name="OddRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="Pager">
    <property name="ShowBottomPager">0</property>
    <property name="ShowPageInfo">0</property>
    <property name="ShowRecordCount">0</property>
    <property name="ShowTopPager">0</property>
    <property name="Visible">0</property>
    <property name="VisiblePageCount">1</property>
    </property>
    <property name="ReadOnly">1</property>
    <property name="RowDataStyles">a:0:{}</property>
    <property name="RowSelect">1</property>
    <property name="SelectedRowStyle">
    <property name="Font">a:9:{s:6:"Family";s:0:"";s:4:"Size";s:0:"";s:10:"LineHeight";s:0:"";s:5:"Style";s:0:"";s:4:"Case";s:0:"";s:7:"Variant";s:0:"";s:5:"Color";s:0:"";s:5:"Align";s:6:"taNone";s:6:"Weight";s:0:"";}</property>
    </property>
    <property name="ShowSelectColumn">0</property>
    <property name="SiteTheme"></property>
    <property name="TabOrder">13</property>
    <property name="Top">366</property>
    <property name="UTF8">0</property>
    <property name="Width">771</property>
    <property name="OnRowData">gridLine_itemRowData</property>
    <property name="OnSummaryData">gridLine_itemSummaryData</property>
  </object>
  <object class="JTLabel" name="lbNotes" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">NOTES</property>
    <property name="Datasource"></property>
    <property name="Height">14</property>
    <property name="Left">9</property>
    <property name="Name">lbNotes</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="Top">578</property>
    <property name="Width">67</property>
  </object>
  <object class="JTLabel" name="lbServiceAgreement" >
    <property name="Anchors">
    <property name="Left">0</property>
    <property name="Top">0</property>
    </property>
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Service Agreement</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">299</property>
    <property name="Name">lbServiceAgreement</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="StyleFont">
    <property name="Align">taCenter</property>
    <property name="Color">#336699</property>
    <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
    <property name="Size">12pt</property>
    <property name="Weight">bold</property>
    </property>
    <property name="Top">76</property>
    <property name="Width">235</property>
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
  <object class="Label" name="logo" >
    <property name="Autosize">1</property>
    <property name="Height">43</property>
    <property name="Name">logo</property>
    <property name="Style">.logo</property>
    <property name="Width">275</property>
  </object>
  <object class="JTGroupBox" name="gbPersonal" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">CONTACT INFORMATION</property>
    <property name="Height">223</property>
    <property name="Left">9</property>
    <property name="Name">gbPersonal</property>
    <property name="SiteTheme"></property>
    <property name="Top">116</property>
    <property name="Width">770</property>
    <object class="JTLabel" name="lbFirst_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">First name (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbFirst_name</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">20</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="first_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">100</property>
      <property name="Name">first_name</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">1</property>
      <property name="Top">17</property>
      <property name="Width">250</property>
    </object>
    <object class="JTLabel" name="lbLast_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Last name (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">385</property>
      <property name="Name">lbLast_name</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">20</property>
      <property name="Width">91</property>
    </object>
    <object class="JTAdvancedEdit" name="last_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">510</property>
      <property name="MaxLength">100</property>
      <property name="Name">last_name</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">2</property>
      <property name="Top">17</property>
      <property name="Width">250</property>
    </object>
    <object class="JTLabel" name="lbPassport_num" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Passport No (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbPassport_num</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">45</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="passport_num" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">20</property>
      <property name="Name">passport_num</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">3</property>
      <property name="Top">43</property>
      <property name="Width">250</property>
    </object>
    <object class="JTLabel" name="lbCompany" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Company name</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbCompany</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">85</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="company_name" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">200</property>
      <property name="Name">company_name</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">5</property>
      <property name="Top">82</property>
      <property name="Width">363</property>
    </object>
    <object class="JTHorizontalLine" name="JTHorizontalLine1" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">9</property>
      <property name="Left">6</property>
      <property name="Name">JTHorizontalLine1</property>
      <property name="SiteTheme"></property>
      <property name="Top">74</property>
      <property name="Width">754</property>
    </object>
    <object class="JTLabel" name="lbVat" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Tax ID/VAT No</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">491</property>
      <property name="Name">lbVat</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">85</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="vat_num" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">600</property>
      <property name="MaxLength">20</property>
      <property name="Name">vat_num</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">6</property>
      <property name="Top">82</property>
      <property name="Width">160</property>
    </object>
    <object class="JTLabel" name="lbAddress" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Mailing Address (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbAddress</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">113</property>
      <property name="Width">107</property>
    </object>
    <object class="JTAdvancedEdit" name="address" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">255</property>
      <property name="Name">address</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">7</property>
      <property name="Top">110</property>
      <property name="Width">643</property>
    </object>
    <object class="JTLabel" name="lbCity" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">City/Town (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbCity</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">140</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="city" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">50</property>
      <property name="Name">city</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">8</property>
      <property name="Top">137</property>
      <property name="Width">250</property>
    </object>
    <object class="JTAdvancedEdit" name="postcode" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">15</property>
      <property name="Name">postcode</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">9</property>
      <property name="Top">164</property>
      <property name="Width">73</property>
    </object>
    <object class="JTLabel" name="lbPostcode" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Postcode (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbPostcode</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">167</property>
      <property name="Width">83</property>
    </object>
    <object class="JTLabel" name="lbCountry" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Country (*)</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">385</property>
      <property name="Name">lbCountry</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">167</property>
      <property name="Width">80</property>
    </object>
    <object class="JTLookupComboBox" name="country_id" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">511</property>
      <property name="LookupDataField">country_id</property>
      <property name="LookupDataSource">dsCountry</property>
      <property name="LookupField">country_name</property>
      <property name="Name">country_id</property>
      <property name="SiteTheme">SiteTheme</property>
      <property name="StyleFont">
      <property name="Size">10pt</property>
      </property>
      <property name="TabOrder">10</property>
      <property name="Top">164</property>
      <property name="Width">189</property>
    </object>
    <object class="JTLabel" name="lbPhone" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Phone</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">7</property>
      <property name="Name">lbPhone</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">196</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="phone" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">117</property>
      <property name="MaxLength">30</property>
      <property name="Name">phone</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">11</property>
      <property name="Top">193</property>
      <property name="Width">171</property>
    </object>
    <object class="JTLabel" name="lbMobile" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Mobile/Cell</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">385</property>
      <property name="Name">lbMobile</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">196</property>
      <property name="Width">76</property>
    </object>
    <object class="JTAdvancedEdit" name="mobile" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">511</property>
      <property name="MaxLength">30</property>
      <property name="Name">mobile</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">12</property>
      <property name="Top">193</property>
      <property name="Width">187</property>
    </object>
    <object class="JTAdvancedEdit" name="email" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">21</property>
      <property name="Left">510</property>
      <property name="Name">email</property>
      <property name="ReadOnly">1</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">4</property>
      <property name="Top">43</property>
      <property name="Width">250</property>
    </object>
    <object class="JTLabel" name="lbEmail" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Email</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">385</property>
      <property name="Name">lbEmail</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">46</property>
      <property name="Width">46</property>
    </object>
    <object class="JTLabel" name="lbProvince" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Caption">Province</property>
      <property name="Datasource"></property>
      <property name="Height">18</property>
      <property name="Left">385</property>
      <property name="Name">lbProvince</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Color">#282828</property>
      <property name="Family">Arial, Helvetica, sans-serif</property>
      <property name="Size">9pt</property>
      </property>
      <property name="Top">140</property>
      <property name="Width">99</property>
    </object>
    <object class="JTAdvancedEdit" name="province" >
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Height">24</property>
      <property name="Left">511</property>
      <property name="MaxLength">50</property>
      <property name="Name">province</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabOrder">8</property>
      <property name="Top">137</property>
      <property name="Width">250</property>
    </object>
  </object>
  <object class="CheckBox" name="cbLOPD" >
    <property name="Font">
    <property name="Color">black</property>
    <property name="Family">Arial, Helvetica, sans-serif</property>
    <property name="Size">9pt</property>
    </property>
    <property name="Height">22</property>
    <property name="Left">5</property>
    <property name="Name">cbLOPD</property>
    <property name="ParentFont">0</property>
    <property name="TabOrder">15</property>
    <property name="Top">1336</property>
    <property name="Width">619</property>
    <property name="jsOnChange">cbLOPDJSChange</property>
  </object>
  <object class="Button" name="btnSubmitForm" >
    <property name="ButtonType">btNormal</property>
    <property name="Caption">Submit</property>
    <property name="Font">
    <property name="Family">Arial, Helvetica, sans-serif</property>
    <property name="Size">9pt</property>
    </property>
    <property name="Height">26</property>
    <property name="Left">705</property>
    <property name="Name">btnSubmitForm</property>
    <property name="ParentFont">0</property>
    <property name="TabOrder">16</property>
    <property name="Top">1336</property>
    <property name="Width">75</property>
    <property name="OnClick">btnSubmitFormClick</property>
    <property name="jsOnClick">btnSubmitFormJSClick</property>
  </object>
  <object class="JTLabel" name="lbFieldRequired" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">Fields marked with an asterisk (*) are required.</property>
    <property name="Datasource"></property>
    <property name="Height">18</property>
    <property name="Left">9</property>
    <property name="Name">lbFieldRequired</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Color">#336699</property>
    <property name="Size">9pt</property>
    </property>
    <property name="Top">98</property>
    <property name="Width">483</property>
  </object>
  <object class="JTGroupBox" name="gbBank" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">BANK ACCOUNT INFORMATION</property>
    <property name="Height">331</property>
    <property name="Left">9</property>
    <property name="Name">gbBank</property>
    <property name="SiteTheme">SiteTheme</property>
    <property name="Top">741</property>
    <property name="Width">770</property>
    <object class="JTLabel" name="lbBank" >
      <property name="Anchors">
      <property name="Bottom">1</property>
      <property name="Relative">0</property>
      <property name="Right">1</property>
      </property>
      <property name="AnchorsWorkaround">--Workaround--</property>
      <property name="Datasource"></property>
      <property name="Height">301</property>
      <property name="Left">7</property>
      <property name="Name">lbBank</property>
      <property name="SiteTheme"></property>
      <property name="StyleFont">
      <property name="Size">9pt</property>
      </property>
      <property name="TabStop">0</property>
      <property name="Top">19</property>
      <property name="Width">753</property>
    </object>
  </object>
  <object class="JTLabel" name="lbServices" >
    <property name="AnchorsWorkaround">--Workaround--</property>
    <property name="Caption">SERVICES</property>
    <property name="Datasource"></property>
    <property name="Height">14</property>
    <property name="Left">9</property>
    <property name="Name">lbServices</property>
    <property name="SiteTheme"></property>
    <property name="StyleFont">
    <property name="Size">9pt</property>
    </property>
    <property name="TabStop">0</property>
    <property name="Top">347</property>
    <property name="Width">67</property>
  </object>
  <object class="HiddenField" name="service_agreement_id" >
    <property name="Height">18</property>
    <property name="Left">514</property>
    <property name="Name">service_agreement_id</property>
    <property name="Value">0</property>
    <property name="Width">200</property>
  </object>
  <object class="Query" name="sqlAccountant_manager" >
        <property name="Left">589</property>
        <property name="Top">24</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlAccountant_manager</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:2:{i:0;s:32:"SELECT * FROM vw_account_manager";i:1;s:0:"";}</property>
  </object>
  <object class="StyleSheet" name="StyleSheet" >
        <property name="Left">424</property>
        <property name="Top">16</property>
    <property name="FileName">css/incwell.css</property>
    <property name="IncludeID">1</property>
    <property name="IncludeStandard">1</property>
    <property name="IncludeSubStyle">1</property>
    <property name="Name">StyleSheet</property>
  </object>
  <object class="JTSiteTheme" name="SiteTheme" >
        <property name="Left">488</property>
        <property name="Top">16</property>
    <property name="Name">SiteTheme</property>
    <property name="Theme">lightgrey</property>
  </object>
  <object class="Query" name="sqlCountry" >
        <property name="Left">369</property>
        <property name="Top">7</property>
    <property name="Active">1</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="HasAutoInc">0</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlCountry</property>
    <property name="OrderField">en</property>
    <property name="Params">a:0:{}</property>
    <property name="SQL">a:3:{i:0;s:37:"SELECT country_id, en AS country_name";i:1;s:12:"FROM country";i:2;s:0:"";}</property>
    <property name="TableName">country</property>
  </object>
  <object class="Datasource" name="dsCountry" >
        <property name="Left">369</property>
        <property name="Top">23</property>
    <property name="DataSet">sqlCountry</property>
    <property name="Name">dsCountry</property>
  </object>
  <object class="Datasource" name="dsAccountant_manager" >
        <property name="Left">589</property>
        <property name="Top">40</property>
    <property name="DataSet">sqlAccountant_manager</property>
    <property name="Name">dsAccountant_manager</property>
  </object>
  <object class="Query" name="sqlLine_item" >
        <property name="Left">731</property>
        <property name="Top">16</property>
    <property name="Database">connectionDB.DbConnection</property>
    <property name="LimitCount">-1</property>
    <property name="LimitStart">-1</property>
    <property name="Name">sqlLine_item</property>
    <property name="Params">a:1:{i:0;s:20:"service_agreement_id";}</property>
    <property name="SQL">a:0:{}</property>
    <property name="TableName">line_item</property>
  </object>
  <object class="Datasource" name="dsLine_item" >
        <property name="Left">732</property>
        <property name="Top">32</property>
    <property name="DataSet">sqlLine_item</property>
    <property name="Name">dsLine_item</property>
  </object>
  <object class="Label" name="lbAccount_manager" >
    <property name="Alignment">agRight</property>
    <property name="Font">
    <property name="Align">taRight</property>
    <property name="Color">#336699</property>
    <property name="Family">Verdana, Geneva, Arial, Helvetica, sans-serif</property>
    <property name="Size">9pt</property>
    </property>
    <property name="Height">13</property>
    <property name="Left">457</property>
    <property name="Name">lbAccount_manager</property>
    <property name="ParentColor">0</property>
    <property name="ParentFont">0</property>
    <property name="ParentShowHint">0</property>
    <property name="Top">98</property>
    <property name="Width">322</property>
  </object>
</object>
?>
