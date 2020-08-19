<?php
//-----------------------------------------------------------------------
//               - JomiTech Components For PHP 1.0 Full -
//                          -- Package File --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( 'vcl/vcl.inc.php' );

use_unit( 'designide.inc.php' );

$version = getVersion();

setPackageTitle( 'JomiTech Components For PHP Full ' . $version );
setIconPath( './palette' );

if( function_exists( 'addSplashBitmap' ) )
    addSplashBitmap( 'JomiTech Components For PHP Full ' . $version, 'c4php.bmp' );

use_unit( 'components4phpfull/jtxmldatasource.inc.php' );
use_unit( 'components4phpfull/jtcombobox.inc.php' );
use_unit( 'components4phpfull/jtuserlogin.inc.php' );
use_unit( 'templateplugins.inc.php' );

$FontStyles = array(
    'fsTiny',
    'fsSmall',
    'fsDefault',
    'fsMedium',
    'fsLarge',
    'fsTitle',
    'fsHeading'
);

// Load available themes.
$ThemesList = array();
$dir = 'themes';

$dh = opendir( $dir );

while( false !== ( $filename = readdir( $dh ) ) )
{
    $fullname = "$dir/$filename";
    if( substr( $filename, 0, 1 ) != '.' && is_dir( $fullname ) && $filename != 'common' )
        $ThemesList[] = $filename;
}

closedir( $dh );


$NavBarOrientation = array(
    'noHorizontal',
    'noVertical'
);

$BulletTypes = array(
    'btCircle',
    'btDecimal',
    'btDisc',
    'btLowerAlpha',
    'btLowerRoman',
    'btUnbulleted',
    'btSquare',
    'btUpperAlpha',
    'btUpperRoman',
);

$ExpandPanelStates = array(
    'psHidden',
    'psVisible'
);

$FontList = array(
    'Segoe UI, Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif',
    'Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif',
    'Verdana, Geneva, Arial, Helvetica, sans-serif',
    'Arial, Helvetica, sans-serif',
    'Times New Roman, Times, serif',
    'Courier New, Courier, mono'
);

$BorderStyles = array(
    'Dashed',
    'Dotted',
    'Double',
    'Groove',
    'Inset',
    'Outset',
    'None',
    'Ridge',
    'Solid',
);

$MonthNums = array(
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10',
    '11',
    '12',
);

global $TemplateManager;

registerComponents( 'JomiTech Authentication Controls', array( 'JTAuthRegistration' ), 'components4phpfull/jtauthregistration.inc.php' );
registerComponents( 'JomiTech Authentication Controls', array( 'JTUserLogin' ), 'components4phpfull/jtuserlogin.inc.php' );
registerComponents( 'JomiTech Authentication Controls', array( 'JTUserLoginView' ), 'components4phpfull/jtuserloginview.inc.php' );

registerComponents( 'JomiTech Data Access Controls', array( 'JTPDODatabase' ), 'components4phpfull/jtpdodatabase.inc.php' );
registerComponents( 'JomiTech Data Access Controls', array( 'JTXMLDataSource' ), 'components4phpfull/jtxmldatasource.inc.php' );

registerComponents( 'JomiTech Feed Controls', array( 'JTAtomFeed' ), 'components4phpfull/jtatomfeed.inc.php' );
registerComponents( 'JomiTech Feed Controls', array( 'JTRSSFeed' ), 'components4phpfull/jtrssfeed.inc.php' );

registerComponents( 'JomiTech Input Controls', array( 'JTInputValidator' ), 'components4phpfull/jtinputvalidator.inc.php' );

registerComponents( 'JomiTech Internet Controls', array( 'JTSendEmail' ), 'components4phpfull/jtsendemail.inc.php' );

registerComponents( 'JomiTech Miscellaneous Controls', array( 'JTPCRegEx' ), 'components4phpfull/jtpcregex.inc.php' );

registerComponents( 'JomiTech Navigation Controls', array( 'JTCategoryButtons' ), 'components4phpfull/jtcategorybuttons.inc.php' );
registerComponents( 'JomiTech Navigation Controls', array( 'JTHorzNavigationBar' ), 'components4phpfull/jthnavbar.inc.php' );
registerComponents( 'JomiTech Navigation Controls', array( 'JTMenu' ), 'components4phpfull/jtmenu.inc.php' );
registerComponents( 'JomiTech Navigation Controls', array( 'JTMenuBar' ), 'components4phpfull/jtmenubar.inc.php' );
registerComponents( 'JomiTech Navigation Controls', array( 'JTNavigationBar' ), 'components4phpfull/jtnavbar.inc.php' );
registerComponents( 'JomiTech Navigation Controls', array( 'JTVertNavigationBar' ), 'components4phpfull/jtvnavbar.inc.php' );

registerComponents( 'JomiTech Output Controls', array( 'JTHeaderCode' ), 'components4phpfull/jtheadercode.inc.php' );
registerComponents( 'JomiTech Output Controls', array( 'JTJavaScript' ), 'components4phpfull/jtjavascript.inc.php' );
registerComponents( 'JomiTech Output Controls', array( 'JTRawOutput' ), 'components4phpfull/jtrawoutput.inc.php' );
registerComponents( 'JomiTech Output Controls', array( 'JTTemplatePanel' ), 'components4phpfull/jttemplatepanel.inc.php' );

registerComponents( 'JomiTech Visual Controls', array( 'JTSiteTheme' ), 'components4phpfull/jtsitetheme.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTAdRotator' ), 'components4phpfull/jtadrotator.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTAdvancedEdit' ), 'components4phpfull/jtadvancededit.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTAjaxWaitPopup' ), 'components4phpfull/jtajaxwaitpopup.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTBevel' ), 'components4phpfull/jtbevel.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTBlobImage' ), 'components4phpfull/jtblobimage.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTBulletList' ), 'components4phpfull/jtbulletlist.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTCheckBoxList' ), 'components4phpfull/jtcheckboxlist.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTClock' ), 'components4phpfull/jtclock.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTComboBox' ), 'components4phpfull/jtcombobox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTDatePicker' ), 'components4phpfull/jtdatepicker.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTDateTimePicker' ), 'components4phpfull/jtdatetimepicker.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTDivWindow' ), 'components4phpfull/jtdivwindow.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTEventCalendar' ), 'components4phpfull/jteventcalendar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTExpandPanel' ), 'components4phpfull/jtexpandpanel.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTExplanationPopup' ), 'components4phpfull/jtexplanationpopup.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTGrid' ), 'components4phpfull/jtgrid.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTGroupBox' ), 'components4phpfull/jtgroupbox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTHorizontalLine' ), 'components4phpfull/jthorizontalline.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTIFrame' ), 'components4phpfull/jtiframe.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTImageMap' ), 'components4phpfull/jtimagemap.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTImageSubmit' ), 'components4phpfull/jtimagesubmit.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTLabel' ), 'components4phpfull/jtlabel.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTLookupLabel' ), 'components4phpfull/jtlookuplabel.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTJSWindow' ), 'components4phpfull/jtjswindow.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTLargerImage' ), 'components4phpfull/jtlargerimage.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTLookupComboBox' ), 'components4phpfull/jtlookupcombobox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTLookupListBox' ), 'components4phpfull/jtlookuplistbox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTMonthCalendar' ), 'components4phpfull/jtmonthcalendar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTNewsControl' ), 'components4phpfull/jtnewscontrol.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTObjectControl' ), 'components4phpfull/jtobjectcontrol.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTPageControl' ), 'components4phpfull/jtpagecontrol.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTPanel' ), 'components4phpfull/jtpanel.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTPHPPaintBox' ), 'components4phpfull/jtphppaintbox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTProgressBar' ), 'components4phpfull/jtprogressbar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTRadioButtonList' ), 'components4phpfull/jtradiobuttonlist.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTScrollBox' ), 'components4phpfull/jtscrollbox.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTSectionBar' ), 'components4phpfull/jtsectionbar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTStatusBar' ), 'components4phpfull/jtstatusbar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTSurvey' ), 'components4phpfull/jtsurvey.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTTabControl' ), 'components4phpfull/jttabcontrol.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTTable' ), 'components4phpfull/jttable.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTTimePicker' ), 'components4phpfull/jttimepicker.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTToolBar' ), 'components4phpfull/jttoolbar.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTTreeView' ), 'components4phpfull/jttreeview.inc.php' );
registerComponents( 'JomiTech Visual Controls', array( 'JTVerticalLine' ), 'components4phpfull/jtverticalline.inc.php' );

registerPropertyValues( 'JTSiteTheme', 'Theme', $ThemesList );

registerBooleanProperty( 'JTThemedGraphicControl', 'Anchors.Left' );
registerBooleanProperty( 'JTThemedGraphicControl', 'Anchors.Top' );
registerBooleanProperty( 'JTThemedGraphicControl', 'Anchors.Right' );
registerBooleanProperty( 'JTThemedGraphicControl', 'Anchors.Bottom' );
registerBooleanProperty( 'JTThemedGraphicControl', 'Anchors.Relative' );
registerPropertyValues( 'JTThemedGraphicControl', 'SiteTheme', array( 'JTSiteTheme' ) );
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Family', $FontList );
registerPropertyEditor( 'JTThemedGraphicControl', 'StyleFont.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Align', array('taNone','taLeft','taRight','taCenter','taJustify'));
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Case', array('caCapitalize','caUpperCase','caLowerCase','caNone'));
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Style', array('fsNormal','fsItalic','fsOblique'));
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Variant', array('vaNormal','vaSmallCaps'));
registerPropertyValues( 'JTThemedGraphicControl', 'StyleFont.Weight', array('normal','bold','bolder','lighter','100','200','300','400','500','600','700','800','900'));

registerPropertyValues( 'JTThemedCustomPanel', 'Layout.Type', array( 'JTANCHOR_LAYOUT', 'ABS_XY_LAYOUT', 'XY_LAYOUT', 'FLOW_LAYOUT', 'GRIDBAG_LAYOUT', 'ROW_LAYOUT', 'COL_LAYOUT' ) );
registerPropertyValues( 'JTThemedCustomPanel', 'TemplateEngine', $TemplateManager->getEngines() );
registerPropertyEditor( 'JTThemedCustomPanel', 'TemplateFilename', 'TFilenamePropertyEditor', 'native' );

registerPropertyValues( 'JTAdRotator', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTAdvancedEdit', 'DataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTAdvancedEdit', 'Enabled' );
registerBooleanProperty( 'JTAdvancedEdit', 'IsPassword' );
registerBooleanProperty( 'JTAdvancedEdit', 'ReadOnly' );
registerBooleanProperty( 'JTAdvancedEdit', 'TabStop' );

registerPropertyValues( 'JTAuthRegistration', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTBaseFeed', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTBlobImage', 'Database', array( 'Database' ) );
registerPropertyValues( 'JTBlobImage', 'KeyDataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTBulletList', 'BulletType', $BulletTypes );
registerPropertyValues( 'JTBulletList', 'TextClass', $FontStyles );
registerPropertyValues( 'JTBulletList', 'Datasource', array( 'Datasource' ) );
registerBooleanProperty( 'JTBulletList', 'TabStop' );

registerBooleanProperty( 'JTCategoryButtons', 'TabStop' );

registerPropertyValues( 'JTCheckBoxList', 'DataSource', array( 'Datasource' ) );
registerPropertyValues( 'JTCheckBoxList', 'TextClass', $FontStyles );
registerBooleanProperty( 'JTCheckBoxList', 'TabStop' );

registerPropertyValues( 'JTClock', 'Type', array( 'Analog', 'Digital' ) );

registerBooleanProperty( 'JTComboBox', 'AutoDropDown' );
registerPropertyValues( 'JTComboBox', 'DataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTComboBox', 'Enabled' );
registerPropertyEditor( 'JTComboBox', 'Items', 'TValueListPropertyEditor', 'native' );
registerPropertyValues( 'JTComboBox', 'LookupDataSource', array( 'Datasource' ) );
registerPropertyValues( 'JTComboBox', 'Style', array( JTComboBox::DropDown, JTComboBox::DropDownList ) );
registerBooleanProperty( 'JTComboBox', 'TabStop' );

registerPropertyValues( 'JTDateTimePicker', 'DataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTDateTimePicker', 'AllowTyping' );

registerBooleanProperty( 'JTDatePicker', 'AllowTyping' );

registerBooleanProperty( 'JTDivWindow', 'AutoScroll' );
registerBooleanProperty( 'JTDivWindow', 'BorderIcons.Close' );
registerBooleanProperty( 'JTDivWindow', 'BorderIcons.Help' );
registerBooleanProperty( 'JTDivWindow', 'BorderIcons.Maximize' );
registerBooleanProperty( 'JTDivWindow', 'BorderIcons.Minimize' );
registerBooleanProperty( 'JTDivWindow', 'StartVisible' );
registerPropertyValues( 'JTDivWindow', 'BorderStyle', array( 'bsSingle', 'bsSizeable', 'bsNone' ) );
registerPropertyValues( 'JTDivWindow', 'Position', array( 'poDesigned', 'poDefaultPosOnly', 'poParentCenter', 'poBrowserCenter' ) );

registerPropertyValues( 'JTEventCalendar', 'Database', array( 'Database' ) );
registerPropertyValues( 'JTEventCalendar', 'CurrentMonth', $MonthNums );

registerPropertyValues( 'JTExpandPanel', 'PanelState', $ExpandPanelStates );
registerPropertyValues( 'JTExpandPanel', 'BorderStyle', $BorderStyles );
registerPropertyEditor( 'JTExpandPanel', 'BorderColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTExpandPanel', 'ControlBar.BorderStyle', $BorderStyles );
registerPropertyEditor( 'JTExpandPanel', 'ControlBar.BorderColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyEditor( 'JTExpandPanel', 'ControlBar.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTExpandPanel', 'NextControl', array( 'Control' ) );

registerPropertyEditor( 'JTExplanationPopup', 'Help', 'TJTHelpIntegratorEditor', 'native' );
registerPropertyValues( 'JTExplanationPopup', 'SiteTheme', array( 'JTSiteTheme' ) );

registerPropertyEditor( 'JTHorizontalLine', 'LineColor', 'TJTWebColorPropertyEditor', 'native' );

registerPropertyValues( 'JTGrid', 'DataSource', array( 'Datasource' ) );
registerPropertyEditor( 'JTGrid', 'HeaderColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'HeaderFont.Family', $FontList );
registerPropertyEditor( 'JTGrid', 'HeaderFont.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'HeaderFont.Align', array('taNone','taLeft','taRight','taCenter','taJustify'));
registerPropertyValues( 'JTGrid', 'HeaderFont.Case', array('caCapitalize','caUpperCase','caLowerCase','caNone'));
registerPropertyValues( 'JTGrid', 'HeaderFont.Style', array('fsNormal','fsItalic','fsOblique'));
registerPropertyValues( 'JTGrid', 'HeaderFont.Variant', array('vaNormal','vaSmallCaps'));
registerPropertyValues( 'JTGrid', 'HeaderFont.Weight', array('normal','bold','bolder','lighter','100','200','300','400','500','600','700','800','900'));
registerPropertyEditor( 'JTGrid', 'EvenRowColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'EvenRowFont.Family', $FontList );
registerPropertyEditor( 'JTGrid', 'EvenRowFont.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'EvenRowFont.Align', array('taNone','taLeft','taRight','taCenter','taJustify'));
registerPropertyValues( 'JTGrid', 'EvenRowFont.Case', array('caCapitalize','caUpperCase','caLowerCase','caNone'));
registerPropertyValues( 'JTGrid', 'EvenRowFont.Style', array('fsNormal','fsItalic','fsOblique'));
registerPropertyValues( 'JTGrid', 'EvenRowFont.Variant', array('vaNormal','vaSmallCaps'));
registerPropertyValues( 'JTGrid', 'EvenRowFont.Weight', array('normal','bold','bolder','lighter','100','200','300','400','500','600','700','800','900'));
registerPropertyEditor( 'JTGrid', 'OddRowColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'OddRowFont.Family', $FontList );
registerPropertyEditor( 'JTGrid', 'OddRowFont.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'OddRowFont.Align', array('taNone','taLeft','taRight','taCenter','taJustify'));
registerPropertyValues( 'JTGrid', 'OddRowFont.Case', array('caCapitalize','caUpperCase','caLowerCase','caNone'));
registerPropertyValues( 'JTGrid', 'OddRowFont.Style', array('fsNormal','fsItalic','fsOblique'));
registerPropertyValues( 'JTGrid', 'OddRowFont.Variant', array('vaNormal','vaSmallCaps'));
registerPropertyValues( 'JTGrid', 'OddRowFont.Weight', array('normal','bold','bolder','lighter','100','200','300','400','500','600','700','800','900'));
registerPropertyEditor( 'JTGrid', 'SelectedRowColor', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Family', $FontList );
registerPropertyEditor( 'JTGrid', 'SelectedRowFont.Color', 'TJTWebColorPropertyEditor', 'native' );
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Align', array('taNone','taLeft','taRight','taCenter','taJustify'));
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Case', array('caCapitalize','caUpperCase','caLowerCase','caNone'));
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Style', array('fsNormal','fsItalic','fsOblique'));
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Variant', array('vaNormal','vaSmallCaps'));
registerPropertyValues( 'JTGrid', 'SelectedRowFont.Weight', array('normal','bold','bolder','lighter','100','200','300','400','500','600','700','800','900'));
registerBooleanProperty( 'JTGrid', 'CanSelect' );
registerBooleanProperty( 'JTGrid', 'ShowHeader' );
registerBooleanProperty( 'JTGrid', 'ReadOnly' );
registerBooleanProperty( 'JTGrid', 'ColumnClick' );
registerBooleanProperty( 'JTGrid', 'RowSelect' );
registerBooleanProperty( 'JTGrid', 'ShouldScroll' );
registerBooleanProperty( 'JTGrid', 'ShouldHorzScroll' );
registerBooleanProperty( 'JTGrid', 'TabStop' );

registerPropertyEditor( 'JTHeaderCode', 'Code', 'TJTCodePropertyEditor', 'native' );
registerPropertyEditor( 'JTHeaderCode', 'Help', 'TJTHelpIntegratorEditor', 'native' );

registerPropertyEditor( 'JTHorzNavigationBar', 'Items', 'TJTNavBarPropertyEditor', 'native' );
registerPropertyValues( 'JTHorzNavigationBar', 'ImageList', array( 'ImageList' ) );
registerBooleanProperty( 'JTHorzNavigationBar', 'ShowSubNav' );
registerBooleanProperty( 'JTHorzNavigationBar', 'TabStop' );

registerPropertyValues( 'JTIFrame', 'ScrollBars', array( 'auto', 'no', 'yes' ) );
registerBooleanProperty( 'JTIFrame', 'ShowBorder' );

registerPropertyEditor( 'JTImageMap', 'ImageSource', 'TImagePropertyEditor', 'native' );
registerBooleanProperty( 'JTImageMap', 'Stretch' );

registerPropertyEditor( 'JTImageSubmit', 'ImageSource', 'TImagePropertyEditor', 'native' );

registerBooleanProperty( 'JTInputValidator', 'CanBeEmpty' );
registerPropertyValues( 'JTInputValidator', 'Control', array( 'Control' ) );
registerBooleanProperty( 'JTInputValidator', 'EscapeHTML' );
registerPropertyEditor( 'JTInputValidator', 'Help', 'TJTHelpIntegratorEditor', 'native' );
registerBooleanProperty( 'JTInputValidator', 'RemoveTags' );
registerPropertyValues( 'JTInputValidator', 'SiteTheme', array( 'JTSiteTheme' ) );
registerPropertyValues( 'JTInputValidator', 'Type', array( 'itAnything', 'itNumeric' ) );

registerPropertyValues( 'JTJavaScript', 'Location', array( 'jsBody', 'jsHead' ) );
registerPropertyEditor( 'JTJavaScript', 'Help', 'TJTHelpIntegratorEditor', 'native' );

registerPropertyEditor( 'JTJSWindow', 'Help', 'TJTHelpIntegratorEditor', 'native' );
registerBooleanProperty( 'JTJSWindow', 'Resizeable' );
registerBooleanProperty( 'JTJSWindow', 'ShowAddressBar' );
registerBooleanProperty( 'JTJSWindow', 'ShowMenuBar' );
registerBooleanProperty( 'JTJSWindow', 'ShowScrollbars' );
registerBooleanProperty( 'JTJSWindow', 'ShowStatusbar' );
registerBooleanProperty( 'JTJSWindow', 'ShowToolbar' );

registerPropertyEditor( 'JTLabel', 'Caption', 'THTMLPropertyEditor', 'native' );
registerPropertyValues( 'JTLabel', 'TextClass', $FontStyles );
registerBooleanProperty( 'JTLabel', 'TabStop' );

registerPropertyValues( 'JTLookupLabel', 'Database', array( 'Database' ) );

registerPropertyValues( 'JTLargerImage', 'DataSource', array( 'Datasource' ) );
registerPropertyEditor( 'JTLargerImage', 'SmallImageSource', 'TImagePropertyEditor', 'native' );
registerPropertyEditor( 'JTLargerImage', 'LargeImageSource', 'TImagePropertyEditor', 'native' );

registerBooleanProperty( 'JTLookupComboBox', 'AllowEmpty' );
registerPropertyValues( 'JTLookupComboBox', 'DataSource', array( 'Datasource' ) );
registerPropertyValues( 'JTLookupComboBox', 'LookupDataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTLookupComboBox', 'Enabled' );
/*registerBooleanProperty( 'JTLookupComboBox', 'ReadOnly' );*/
registerBooleanProperty( 'JTLookupComboBox', 'TabStop' );

registerBooleanProperty( 'JTLookupListBox', 'AllowEmpty' );
registerPropertyValues( 'JTLookupListBox', 'DataSource', array( 'Datasource' ) );
registerPropertyValues( 'JTLookupListBox', 'LookupDataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTLookupListBox', 'Enabled' );
registerBooleanProperty( 'JTLookupListBox', 'ReadOnly' );
registerBooleanProperty( 'JTLookupListBox', 'TabStop' );

registerPropertyValues( 'JTMenu', 'Control', array( 'JTThemedGraphicControl::MenuButtons' ) );
registerPropertyValues( 'JTMenu', 'ImageList', array( 'ImageList' ) );

registerPropertyValues( 'JTMenuBar', 'ImageList', array( 'ImageList' ) );

registerPropertyValues( 'JTMonthCalendar', 'CurrentMonth', $MonthNums );
registerPropertyValues( 'JTMonthCalendar', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTNavigationBar', 'Orientation', $NavBarOrientation );
registerPropertyValues( 'JTNavigationBar', 'ImageList', array( 'ImageList' ) );
registerBooleanProperty( 'JTNavigationBar', 'ShowSubNav' );
registerBooleanProperty( 'JTNavigationBar', 'TabStop' );

registerPropertyValues( 'JTNewsControl', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTPDODatabase', 'DriverName', array( 'DB_LIB', 'Firebird', 'IBM DB2', 'Informix', 'MySQL', 'Oracle', 'ODBC', 'PostgreSQL', 'SQLite' ) );

registerPropertyValues( 'JTPHPPaintBox', 'ImageType', array( 'itGIF', 'itJPG', 'itPNG' ) );

registerPropertyValues( 'JTRadioButtonList', 'DataSource', array( 'Datasource' ) );
registerPropertyEditor( 'JTRadioButtonList', 'Items', 'TJTStringArrayPropertyEditor', 'native' );
registerPropertyValues( 'JTRadioButtonList', 'TextClass', $FontStyles );
registerBooleanProperty( 'JTRadioButtonList', 'TabStop' );

registerBooleanProperty( 'JTScrollBox', 'AlwaysShowScrollbars' );
registerBooleanProperty( 'JTScrollBox', 'TabStop' );

registerPropertyEditor( 'JTSectionBar', 'Sections', 'TJTPageControlPropertyEditor', 'native' );

registerPropertyEditor( 'JTSendEmail', 'AdditionalHeaders', 'TJTStringArrayPropertyEditor', 'native' );
registerPropertyEditor( 'JTSendEmail', 'Help', 'TJTHelpIntegratorEditor', 'native' );

registerPropertyValues( 'JTSurvey', 'DataSource', array( 'Datasource' ) );
registerBooleanProperty( 'JTSurvey', 'SetCookie' );

registerPropertyEditor( 'JTTable', 'BackgroundImage', 'TImagePropertyEditor', 'native' );

registerPropertyEditor( 'JTTemplatePanel', 'Help', 'TJTHelpIntegratorEditor', 'native' );
registerPropertyValues( 'JTTemplatePanel', 'TemplateEngine', $TemplateManager->getEngines() );

registerPropertyValues( 'JTTimePicker', 'TimeType', array( 'tt12Hour', 'tt24Hour' ) );
registerPropertyValues( 'JTTimePicker', 'DataSource', array( 'Datasource' ) );

registerPropertyValues( 'JTToolbar', 'ImageList', array( 'ImageList' ) );

registerPropertyEditor( 'JTTreeView', 'Items', 'TItemsPropertyEditor', 'native' );
registerBooleanProperty( 'JTTreeView', 'TabStop' );

registerPropertyValues( 'JTUserLogin', 'Database', array( 'Database' ) );

registerPropertyValues( 'JTUserLogin', 'Hash', array(
    JTUserLogin::HashCustom,
    JTUserLogin::HashMD5,
    JTUserLogin::HashNone,
    JTUserLogin::HashSHA256,
    JTUserLogin::HashSHA512 ) );

registerPropertyValues( 'JTUserLogin', 'LoginType', array(
    JTUserLogin::Cookie,
    JTUserLogin::Form ) );

registerBooleanProperty( 'JTUserLoginView', 'ShowLogin' );
registerBooleanProperty( 'JTUserLoginView', 'ShowLogout' );
registerBooleanProperty( 'JTUserLoginView', 'ShowRegister' );
registerBooleanProperty( 'JTUserLoginView', 'TabStop' );
registerPropertyValues( 'JTUserLoginView', 'UserLogin', array( 'JTUserLogin' ) );

registerPropertyEditor( 'JTVerticalLine', 'LineColor', 'TJTWebColorPropertyEditor', 'native' );

registerPropertyValues( 'JTVertNavigationBar', 'ImageList', array( 'ImageList' ) );
registerBooleanProperty( 'JTVertNavigationBar', 'ShowCaption' );
registerBooleanProperty( 'JTVertNavigationBar', 'TabStop' );

registerPropertyValues( 'JTXMLDataSource', 'Driver', array_keys( $JTXMLDataSourceDrivers ) );
registerPropertyEditor( 'JTXMLDataSource', 'Help', 'TJTHelpIntegratorEditor', 'native' );

registerAsset(
    array(
        'JTAuthRegistration',
        'JTUserLoginView',
        'JTAtomFeed',
        'JTRSSFeed',
        'JTCategoryButtons',
        'JTHorzNavigationBar',
        'JTMenu',
        'JTMenuBar',
        'JTNavigationBar',
        'JTVertNavigationBar',
        'JTSiteTheme',
        'JTAdRotator',
        'JTAdvancedEdit',
        'JTAjaxWaitPopup',
        'JTBevel',
        'JTBlobImage',
        'JTBulletList',
        'JTCheckBoxList',
        'JTClock',
        'JTComboBox',
        'JTDatePicker',
        'JTDateTimePicker',
        'JTDivWindow',
        'JTEventCalendar',
        'JTExpandPanel',
        'JTExplanationPopup',
        'JTGrid',
        'JTGroupBox',
        'JTHorizontalLine',
        'JTIFrame',
        'JTImageMap',
        'JTImageSubmit',
        'JTLabel',
        'JTLookupLabel',
        'JTJSWindow',
        'JTLargerImage',
        'JTLookupComboBox',
        'JTLookupListBox',
        'JTMonthCalendar',
        'JTNewsControl',
        'JTObjectControl',
        'JTPageControl',
        'JTPanel',
        'JTPHPPaintBox',
        'JTProgressBar',
        'JTRadioButtonList',
        'JTScrollBox',
        'JTSectionBar',
        'JTStatusBar',
        'JTSurvey',
        'JTTabControl',
        'JTTable',
        'JTTimePicker',
        'JTToolBar',
        'JTTreeView',
        'JTVerticalLine',
    ),
    array(
        'components4phpfull',
    ) );

function getVersion()
{
    if( file_exists( 'version.txt' ) )
        $version = @file_get_contents( 'version.txt' );
    else
        $version = '';

    if( $version && preg_match( '/^Components For PHP Full ([0-9\.]+)/', $version, $matches ) )
        return $matches[ 1 ];
    else
        return "";
}
?>
