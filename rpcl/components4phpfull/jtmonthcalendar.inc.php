<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Month calendar component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTMonthCalendar extends JTThemedGraphicControl
{
    protected $_CurrentMonth;
    protected $_CurrentYear;
    protected $_datasource = null;
    protected $_datafield = '';
    protected $_SelectedDate;
    protected $_jsOnSelectDate = null;
    protected $_OnSelectDate = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 200;

        $dt = @getdate();

        $this->_CurrentMonth = $dt[ 'mon' ];
        $this->_CurrentYear = $dt[ 'year' ];
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function preinit()
    {
        $submitEventValue = $this->input->{$this->JSWrapperHiddenFieldName};
        if( is_object( $submitEventValue ) )
        {
            $selected_year = $this->input->{$this->Name . '_selyear'};
            $selected_month = $this->input->{$this->Name . '_selmonth'};
            $selected_day = $this->input->{$this->Name . '_selday'};

            if( is_object( $selected_year ) && is_object( $selected_month ) && is_object( $selected_day ) )
            {
                $selected_year = $selected_year->asString();
                $selected_month = $selected_month->asString();
                $selected_day = $selected_day->asString();

                if( $this->_OnSelectDate && $this->callEvent( 'OnSelectDate', array( $selected_year, $selected_month, $selected_day ) ) === false )
                    return;

                $selected_date = sprintf( "%04d-%02d-%02d", $selected_year, $selected_month, $selected_day );

                if( $this->_datasource && $this->_datafield )
                    $this->updateDataField( $selected_date );
                else
                    $this->_SelectedDate = $selected_date;
            }
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'monthcal' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_jsOnSelectDate )
        {
            $event = $this->_jsOnSelectDate;

            print( "function $event( Sender, Year, Month, Day )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $contents = '';
        $index = 0;

        $dt = @getdate( @mktime( 0, 0, 0, $this->_CurrentMonth, 1, $this->_CurrentYear ) );
        $start = $dt[ 'wday' ];

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $this->_CurrentMonth, $this->_CurrentYear );
        $end = $days_in_month + $start - 1;

        if( $this->_datasource && $this->_datafield )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
                $selected_date = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_datafield ];
            else
                $selected_date = '';
        }
        else
        {
            $selected_date = $this->_SelectedDate;
        }

        $selected_year = substr( $selected_date, 0, 4 );
        $selected_month = substr( $selected_date, 5, 2 );
        $selected_day = substr( $selected_date, 8, 2 );

        for( $row = 0; $row < 6; ++$row )
        {
            $contents .= '    <tr class="jtmonthcalendarrow jtmonthcalendarrow' . $row . "\">\r\n";

            for( $col = 0; $col < 7; ++$col, ++$index )
            {
                if( $index >= $start && $index <= $end )
                    $day = $index - $start + 1;
                else
                    $day = 'noday';

                if( $selected_year == $this->_CurrentYear && $selected_month == $this->_CurrentMonth && $selected_day == $day )
                    $selectedclass = ' jtmonthcalendarcellselected';
                else
                    $selectedclass = '';

                $cell = '      <td id="' . $this->Name . '_day_' . $day . '" class="jtmonthcalendarcell ' . ( ( $index < $start || $index > $end ) ? 'jtmonthcalendarcell_blank' : 'jtmonthcalendarcell_date' ) . ' jtmonthcalendarcell' . $col . ' jtmonthcalendarrow' . $row . $selectedclass . '" valign="middle">' . "\r\n";

                if( $index >= $start && $index <= $end )
                {
                    $vars = array(
                        'DAY'       => $day,
                        'MONTH'     => $this->_CurrentMonth,
                        'YEAR'      => $this->_CurrentYear,
                        'STYLE'     => $style,
                    );

                    $cell .= $this->generateComponentSectionCode( 'cell', $vars );
                }
                else
                {
                    $cell .= '&nbsp;';
                }

                $contents .= $cell . "\r\n      </td>\r\n";
            }

            $contents .= "    </tr>\r\n";
        }

        $calinfo = cal_info( CAL_GREGORIAN );
        $months = $calinfo[ 'months' ];
        $monthstr = $months[ $this->_CurrentMonth ];

        $vars = array(
            'MONTH'     => $this->_CurrentMonth,
            'MONTHSTR'  => $this->SiteThemeInstance->retrieveString( $monthstr ),
            'YEAR'      => $this->_CurrentYear,
            'CONTENT'   => $contents,
            'STYLE'     => $style,
        );

        print( $this->generateComponentSectionCode( 'calendar', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\"><!--\r\n" );

            $this->dumpBodyJavaScript();

            print( "// -->\r\n" );
            print( "</script>\r\n" );
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        if( $this->_datasource && $this->_datafield )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
                $selected_date = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_datafield ];
            else
                $selected_date = '';
        }
        else
        {
            $selected_date = $this->_SelectedDate;
        }

        $selected_year = substr( $selected_date, 0, 4 );
        $selected_month = substr( $selected_date, 5, 2 );
        $selected_day = substr( $selected_date, 8, 2 );

        if( $this->_OnSelectDate )
            $fieldname = $this->JSWrapperHiddenFieldName;
        else
            $fieldname = '';

        print( "JTMonthCalInitialize( '" . $this->Name . "', '$selected_year', '$selected_month', '$selected_day', document." . $this->owner->Name . ", '" . $fieldname . "', " . GetJTJSEventToString( $this->_jsOnSelectDate ) . " );\r\n" );
    }

    function dumpForAjax()
    {
        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_contents();

        ob_end_clean();

        $contents = str_replace( "\r\n", " ", $contents );
        $contents = str_replace( "\n", " ", $contents );
        $contents = str_replace( '"', '\"', $contents );

        print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );

        $this->dumpBodyJavaScript();
    }

    function getCurrentMonth()
    {
        return $this->_CurrentMonth;
    }

    function setCurrentMonth( $value )
    {
        if( !is_numeric( $value ) || $value < 1 || $value > 12 )
            return;

        $this->_CurrentMonth = (int)$value;
    }

    function getCurrentYear()
    {
        return $this->_CurrentYear;
    }

    function setCurrentYear( $value )
    {
        if( !is_numeric( $value ) || $value < 1000 || $value > 3000 )
            return;

        $this->_CurrentYear = (int)$value;
    }

    function getDataField()
    {
        return $this->_datafield;
    }

    function setDataField( $value )
    {
        $this->_datafield = $value;
    }

    function defaultDataField()
    {
        return '';
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getSelectedDate()
    {
        return $this->_SelectedDate;
    }

    function setSelectedDate( $value )
    {
        if( !empty( $value ) && !preg_match( '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $value ) )
            return;

        $this->_SelectedDate = $value;
    }

    function defaultSelectedDate()
    {
        return '';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getjsOnSelectDate()
    {
        return $this->_jsOnSelectDate;
    }

    function setjsOnSelectDate( $value )
    {
        $this->_jsOnSelectDate = $value;
    }

    function getOnSelectDate()
    {
        return $this->_OnSelectDate;
    }

    function setOnSelectDate( $value )
    {
        $this->_OnSelectDate = $value;
    }
}
?>