<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Event calendar component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( 'dbtables.inc.php' );

class JTEventCalendar extends JTThemedGraphicControl
{
    protected $_Database = null;
    protected $_TableName = '';
    protected $_ExtraQuerySQL = '';
    protected $_TitleField = '';
    protected $_DateField = '';
    protected $_LinkField = '';
    protected $_Events = array();
    protected $_CurrentMonth;
    protected $_CurrentYear;
    protected $_PrependURL = '';

    protected $_TempEventArray;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 590;
        $this->Height = 400;

        $dt = getdate();

        $this->_CurrentMonth = $dt[ 'mon' ];
        $this->_CurrentYear = $dt[ 'year' ];
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatabase( $this->_Database );

        $this->_ExtraQuerySQL = '';
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'eventcal' ) );
    }

    protected function dumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $contents = '';
        $index = 0;

        $dt = getdate( mktime( 0, 0, 0, $this->_CurrentMonth, 1, $this->_CurrentYear ) );
        $start = $dt[ 'wday' ];

        $days_in_month = cal_days_in_month( CAL_GREGORIAN, $this->_CurrentMonth, $this->_CurrentYear );
        $end = $days_in_month + $start - 1;

        if( $this->_Database && $this->_TableName != '' && $this->_TitleField != '' && $this->_DateField != '' )
        {
            $eventlisting = array();

            if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_Database->Connected )
            {
                $fields = $this->_TitleField . ',' . $this->_DateField;
                if( $this->_LinkField )
                    $fields .= ',' . $this->_LinkField;

                $query = sprintf( 'SELECT %s FROM %s WHERE %s >= %d%02d01 AND %s <= %d%02d%02d %s', $fields, $this->_TableName, $this->_DateField, $this->_CurrentYear, $this->_CurrentMonth, $this->_DateField, $this->_CurrentYear, $this->_CurrentMonth, $days_in_month, $this->_ExtraQuerySQL );

                $queryObject = new Query();
                $queryObject->Database = $this->_Database;
                $queryObject->LimitStart = '-1';
                $queryObject->LimitCount = '-1';
                $queryObject->SQL = array( $query );
                $queryObject->Active = true;

                for( $queryObject->First(); !$queryObject->EOF; $queryObject->Next() )
                    $eventlisting[] = array( $queryObject->AssociativeFieldValues[ $this->_TitleField ], $queryObject->AssociativeFieldValues[ $this->_DateField ], ( $this->_LinkField != '' ) ? $queryObject->AssociativeFieldValues[ $this->_LinkField ] : '' );
            }
        }
        else
        {
            $eventlisting = array_filter( $this->_Events, array( $this, 'filterEvents' ) );
        }

        $events_by_day = array();

        foreach( $eventlisting as $event )
        {
            $day = (int)substr( $event[ 1 ], 8, 2 );

            if( isset( $events_by_day[ $day ] ) )
                array_push( $events_by_day[ $day ], $event );
            else
                $events_by_day[ $day ] = array( $event );
        }

        for( $row = 0; $row < 6; ++$row )
        {
            $contents .= '    <tr class="jteventcalendarrow jteventcalendarrow' . $row . "\">\r\n";

            for( $col = 0; $col < 7; ++$col, ++$index )
            {
                $cell = '      <td class="jteventcalendarcell ' . ( ( $index < $start || $index > $end ) ? 'jteventcalendarcell_blank' : 'jteventcalendarcell_date' ) . ' jteventcalendarcell' . $col . ' jteventcalendarrow' . $row . '" valign="top">' . "\r\n";

                if( $index >= $start && $index <= $end )
                {
                    $day = $index - $start + 1;
                    $cell_contents = '';

                    if( isset( $events_by_day[ $day ] ) )
                    {
                        $this->_TempEventArray = $events_by_day[ $day ];

                        uksort( $this->_TempEventArray, array( $this, 'sortEvents' ) );

                        foreach( $this->_TempEventArray as $event )
                        {
                            $vars = array(
                                'TITLE'     => $event[ 0 ],
                                'DATE'      => $event[ 1 ],
                            );

                            $event_html = $this->generateComponentSectionCode( 'event', $vars );

                            if( $event[ 2 ] != '' )
                            {
                                $vars[ 'LINK' ] = $this->_PrependURL . $event[ 2 ];
                                $vars[ 'CONTENT' ] = $event_html;

                                $event_html = $this->generateComponentSectionCode( 'eventlink', $vars );
                            }

                            $cell_contents .= $event_html;
                        }
                    }

                    $vars = array(
                        'DAY'       => $day,
                        'MONTH'     => $this->_CurrentMonth,
                        'YEAR'      => $this->_CurrentYear,
                        'CONTENT'   => $cell_contents,
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
            'MONTHSTR'  => $this->SiteThemeInstance->RetrieveString( $monthstr ),
            'YEAR'      => $this->_CurrentYear,
            'CONTENT'   => $contents,
        );

        print( $this->generateComponentSectionCode( 'calendar', $vars ) );
    }

    protected function filterEvents( $event )
    {
        $ed = $event[ 1 ];

        $year = substr( $ed, 0, 4 );
        $month = substr( $ed, 5, 2 );

        return ( $year == $this->_CurrentYear && $month == $this->_CurrentMonth );
    }

    protected function sortEvents( $k1, $k2 )
    {
        $e1 = $this->_TempEventArray[ $k1 ];
        $e2 = $this->_TempEventArray[ $k2 ];

        if( $e1[ 1 ] == $e2[ 1 ] )
            return ( $k1 - $k2 );

        return ( $e1[ 1 ] < $e2[ 1 ] ) ? -1 : 1;
    }

    function getCurrentMonth()
    {
        return $this->_CurrentMonth;
    }

    function setCurrentMonth( $value )
    {
        if( !is_numeric( $value ) || $value < 1 || $value > 12 )
            return;

        $this->_CurrentMonth = $value;
    }

    function getCurrentYear()
    {
        return $this->_CurrentYear;
    }

    function setCurrentYear( $value )
    {
        if( !is_numeric( $value ) || $value < 1000 || $value > 3000 )
            return;

        $this->_CurrentYear = $value;
    }

    function getDatabase()
    {
        return $this->_Database;
    }

    function setDatabase( $value )
    {
        $this->_Database = $this->fixupPropertyAndCheck( $value, 'Database' );
    }

    function defaultDatabase()
    {
        return null;
    }

    function getDateField()
    {
        return $this->_DateField;
    }

    function setDateField( $value )
    {
        $this->_DateField = $value;
    }

    function defaultDateField()
    {
        return '';
    }

    function getEvents()
    {
        return $this->_Events;
    }

    function setEvents( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );
        }

        $this->_Events = $value;
    }

    function getExtraQuerySQL()
    {
        return $this->_ExtraQuerySQL;
    }

    function setExtraQuerySQL( $value )
    {
        $this->_ExtraQuerySQL = $value;
    }

    function defaultExtraQuerySQL()
    {
        return '';
    }

    function getLinkField()
    {
        return $this->_LinkField;
    }

    function setLinkField( $value )
    {
        $this->_LinkField = $value;
    }

    function defaultLinkField()
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

    function getTableName()
    {
        return $this->_TableName;
    }

    function setTableName( $value )
    {
        $this->_TableName = $value;
    }

    function defaultTableName()
    {
        return '';
    }

    function getTitleField()
    {
        return $this->_TitleField;
    }

    function setTitleField( $value )
    {
        $this->_TitleField = $value;
    }

    function defaultTitleField()
    {
        return '';
    }

    function getPrependURL()
    {
        return $this->_PrependURL;
    }

    function setPrependURL( $value )
    {
        $this->_PrependURL = $value;
    }

    function defaultPrependURL()
    {
        return '';
    }
}
?>
