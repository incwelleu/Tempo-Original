<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                --  JTThemedGraphicControl base class --
//
//             ! Must only be included by jtsitetheme.inc.php !
//
//              Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
abstract class JTThemedGraphicControl extends CustomControl
{
    private $SiteTheme;
    public $SiteThemeInstance;
    protected $_DumpDimensions = true;

    protected $_Anchors = null;
    protected $_Skin = 'default';
    protected $_StyleFont = null;
    protected $_cssClass = '';
    protected $_TabOrder = 0;
    protected $_TabStop = true;

    protected $OwnerInstance = null;

    function __construct( $aowner = null )
    {
        $this->OwnerInstance = $aowner;

        if( defined( 'JT_STANDALONE' ) )
            $aowner = null;

        parent::__construct( $aowner );

        // Nasty hack.
        if( basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) == 'getclassinfo.php' )
            $this->ControlState |= csDesigning;

        $this->_StyleFont = new JTFont();
        $this->_StyleFont->_control = $this;

        if( !defined( 'NO_VCL' ) )
        {
            $this->ControlStyle = 'csRenderOwner=1';
            $this->ControlStyle = 'csRenderAlso=JTSiteTheme';
        }

        $this->_layout = new JTLayout();
        $this->_layout->_control = $this;

        $this->_Anchors = new JTAnchors( $this );
    }

    function dumpContents( $dumpFooter = true )
    {
        if( !$this->initializeSkin( $error ) )
        {
            JTSiteTheme::PrintNoSiteTheme( $this->Width, $this->Height, $error );
            return;
        }

        $this->callEvent( 'onshow', array() );

        $this->dumpThemedContents();

        if( $dumpFooter )
            $this->dumpControlFooter();
    }

    abstract protected function dumpThemedContents();

    protected function dumpControlFooter()
    {
    }

    function readStyleFont()
    {
        return $this->_StyleFont;
    }

    function writeStyleFont( $value )
    {
        if( is_object( $value ) )
            $this->_StyleFont = $value;
    }

    function getCssClass()
    {
        return $this->_cssClass;
    }

    function setCssClass( $value )
    {
        $this->_cssClass = $value;
    }

    function defaultCssClass()
    {
        return '';
    }

    function getAnchors()
    {
        return $this->_Anchors;
    }

    function setAnchors( $value )
    {
        if( is_object( $value ) )
            $this->_Anchors = $value;
    }

    function getAnchorsWorkaround()
    {
        return '--Workaround--';
    }

    function setAnchorsWorkaround( $value )
    {
    }

    function getSiteTheme()
    {
        return $this->SiteTheme;
    }

    function setSiteTheme( $value )
    {
        $this->SiteTheme = $value;
    }

    function getSkin()
    {
        return $this->_Skin;
    }

    function setSkin( $value )
    {
        if( strlen( $value ) == 0 )
            $value = 'default';

        $this->_Skin = $value;
    }

    function defaultSkin()
    {
        return 'default';
    }

    function getHelp()
    {
        return get_class( $this );
    }

    function setHelp( $value )
    {
    }

    function defaultHelp()
    {
        return get_class( $this );
    }

    function readMenuButtons()
    {
        return array();
    }

    function writeMenuButtons( $value )
    {
    }

    function readDumpDimensions()
    {
        return $this->_DumpDimensions;
    }

    function writeDumpDimensions( $value )
    {
        $this->_DumpDimensions = $value;
    }

    function readTabOrder()
    {
        return $this->_TabOrder;
    }

    function writeTabOrder( $value )
    {
        if( !is_numeric( $value ) )
            return;

        $this->_TabOrder = $value;
    }

    function defaultTabOrder()
    {
        return 0;
    }

    function readTabStop()
    {
        return $this->_TabStop;
    }

    function writeTabStop( $value )
    {
        $this->_TabStop = ( $value ? true : 0 );
    }

    function defaultTabStop()
    {
        return true;
    }

    function getVisible()
    {
        return $this->readVisible();
    }

    function setVisible( $value )
    {
        $this->writeVisible( $value );
    }

    protected function resolveSiteThemeInstance()
    {
        global $JTSiteThemeGlobalInstance;

        if( !$this->SiteThemeInstance && isset( $JTSiteThemeGlobalInstance ) )
            $this->SiteThemeInstance = $JTSiteThemeGlobalInstance;

        if( !$this->SiteThemeInstance )
            $this->SiteThemeInstance = $this->propertyToObject( $this->SiteTheme );

        if( !is_object( $this->SiteThemeInstance ) || !( $this->SiteThemeInstance instanceof JTSiteTheme) )
            $this->SiteThemeInstance = null;
    }

    protected function propertyToObject( $value )
    {
        if( !empty( $value ) )
        {
            if( !is_object( $value ) )
            {
                $form = $this->owner;

                if( strpos( $value, '.' ) )
                {
                    $pieces = explode( '.', $value );
                    $form = $pieces[0];

                    global $$form;

                    $form = $$form;

                    $value = $pieces[1];
                }

                if( !is_object( $form ) )
                    return null;

                if( ( $this->ControlState & csDesigning ) != csDesigning )
                {
                    if( is_object( $form->$value ) )
                        $value = $form->$value;
                }
                else
                {
                    if( isset( $GLOBALS[ $value ] ) )
                        $value = $GLOBALS[ $value ];
                }
            }
        }

        return $value;
    }

    protected function initializeSkin( &$error )
    {
        $error = '';

        $this->resolveSiteThemeInstance();

        if( !$this->SiteThemeInstance )
        {
            $error = JT_NO_SITETHEME_MESSAGE;
            return false;
        }

        if( !$this->SiteThemeInstance->loadComponentTheme( get_class( $this ) ) )
        {
            $error = 'Failed to load ' . get_class( $this ) . ' component theme.';
            return false;
        }

        return true;
    }

    protected function retrieveSetting( $name )
    {
        return $this->SiteThemeInstance->retrieveSetting( $this, $name );
    }

    protected function retrieveString( $name )
    {
        return $this->SiteThemeInstance->retrieveString( $name );
    }

    function generateComponentSectionCode( $section, $vars )
    {
        $vars[ 'NAME' ] = $this->_name;
        $vars[ 'CURSOR' ] = strtolower( substr( $this->_cursor, 2 ) );

        $vars[ 'CSSCLASS' ] = $this->_cssClass;

        if( $this->_DumpDimensions )
        {
            $vars[ 'WIDTH' ] = $this->Width . 'px';
            $vars[ 'HEIGHT' ] = $this->Height . 'px';
        }
        else
        {
            $vars[ 'WIDTH' ] = '100%';
            $vars[ 'HEIGHT' ] = '100%';
        }

       return $this->SiteThemeInstance->generateComponentSectionCode( $this, $section, $vars );
    }

    function fixupPropertyAndCheck( $value, $type )
    {
        $result = $this->fixupProperty( $value );

        if( ( $this->ControlState & csDesigning ) != csDesigning && is_object( $result ) )
        {
            if( !$result->inheritsFrom( $type ) )
                throw new Exception( $this->Name . ' property type mismatch, expected ' . $type . ', received ' . get_class( $result ) );
        }

        return $result;
    }

    function serialize()
    {
        parent::serialize();

        $owner = $this->readOwner();
        if( $owner )
        {
            $prefix = $owner->readNamePath() . '.' . $this->Name . '.ExtraProperties.';

            $_SESSION[ $prefix . 'DumpDimensions' ] = $this->_DumpDimensions;
        }
    }

    function unserialize()
    {
        parent::unserialize();

        $owner = $this->readOwner();
        if( $owner )
        {
            $prefix = $owner->readNamePath() . '.' . $this->Name . '.ExtraProperties.';

            if( isset( $_SESSION[ $prefix . 'DumpDimensions' ] ) )
                $this->_DumpDimensions = $_SESSION[ $prefix . 'DumpDimensions' ];
        }
    }

    function callEvent( $event, $params )
    {
        if( defined( 'JT_STANDALONE' ) )
        {
            $ievent = '_' . $event;
            $event = $this->$ievent;
            if( $event )
            {
                if( $this->OwnerInstance )
                    return $this->OwnerInstance->$event( $this, $params );
                else
                    return call_user_func( $event, $this, $params );
            }
            else
            {
                return false;
            }
        }
        else
        {
            return parent::callEvent( $event, $params );
        }
    }

    protected function dumpDateLocalization()
    {
        if( !defined( 'JT_DATENAMES' ) )
        {
            $this->resolveSiteThemeInstance();

            if( $this->SiteThemeInstance )
            {
                $monthNames = array(
                    $this->SiteThemeInstance->retrieveString( "January" ),
                    $this->SiteThemeInstance->retrieveString( "February" ),
                    $this->SiteThemeInstance->retrieveString( "March" ),
                    $this->SiteThemeInstance->retrieveString( "April" ),
                    $this->SiteThemeInstance->retrieveString( "May" ),
                    $this->SiteThemeInstance->retrieveString( "June" ),
                    $this->SiteThemeInstance->retrieveString( "July" ),
                    $this->SiteThemeInstance->retrieveString( "August" ),
                    $this->SiteThemeInstance->retrieveString( "September" ),
                    $this->SiteThemeInstance->retrieveString( "October" ),
                    $this->SiteThemeInstance->retrieveString( "November" ),
                    $this->SiteThemeInstance->retrieveString( "December" ),
                );

                echo( "if (typeof (monthNames) == \"undefined\")\r\n" );
                echo( "    monthNames = " . json_encode( $monthNames ) . ";\r\n" );

                $abbrevMonthNames = array(
                    $this->SiteThemeInstance->retrieveString( "Jan" ),
                    $this->SiteThemeInstance->retrieveString( "Feb" ),
                    $this->SiteThemeInstance->retrieveString( "Mar" ),
                    $this->SiteThemeInstance->retrieveString( "Apr" ),
                    $this->SiteThemeInstance->retrieveString( "May" ),
                    $this->SiteThemeInstance->retrieveString( "Jun" ),
                    $this->SiteThemeInstance->retrieveString( "Jul" ),
                    $this->SiteThemeInstance->retrieveString( "Aug" ),
                    $this->SiteThemeInstance->retrieveString( "Sep" ),
                    $this->SiteThemeInstance->retrieveString( "Oct" ),
                    $this->SiteThemeInstance->retrieveString( "Nov" ),
                    $this->SiteThemeInstance->retrieveString( "Dec" ),
                );

                echo( "if (typeof (abbrevMonthNames) == \"undefined\")\r\n" );
                echo( "    abbrevMonthNames = " . json_encode( $abbrevMonthNames ) . ";\r\n" );

                $dayNames = array(
                    $this->SiteThemeInstance->retrieveString( "Sunday" ),
                    $this->SiteThemeInstance->retrieveString( "Monday" ),
                    $this->SiteThemeInstance->retrieveString( "Tuesday" ),
                    $this->SiteThemeInstance->retrieveString( "Wednesday" ),
                    $this->SiteThemeInstance->retrieveString( "Thursday" ),
                    $this->SiteThemeInstance->retrieveString( "Friday" ),
                    $this->SiteThemeInstance->retrieveString( "Saturday" ),
                );
                //print_r( $dayNames );
                echo( "if (typeof (dayNames) == \"undefined\")\r\n" );
                echo( "    dayNames = " . json_encode( $dayNames ) . ";\r\n" );

                $abbrevDayNames = array(
                    $this->SiteThemeInstance->retrieveString( "Sun" ),
                    $this->SiteThemeInstance->retrieveString( "Mon" ),
                    $this->SiteThemeInstance->retrieveString( "Tue" ),
                    $this->SiteThemeInstance->retrieveString( "Wed" ),
                    $this->SiteThemeInstance->retrieveString( "Thu" ),
                    $this->SiteThemeInstance->retrieveString( "Fri" ),
                    $this->SiteThemeInstance->retrieveString( "Sat" ),
                );

                echo( "if (typeof (abbrevDayNames) == \"undefined\")\r\n" );
                echo( "    abbrevDayNames = " . json_encode( $abbrevDayNames ) . ";\r\n" );

                $singleDayNames = array(
                    $this->SiteThemeInstance->retrieveString( "SundaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "MondaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "TuesdaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "WednesdaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "ThursdaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "FridaySingle" ),
                    $this->SiteThemeInstance->retrieveString( "SaturdaySingle" ),
                );

                echo( "if (typeof (singleDayNames) == \"undefined\")\r\n" );
                echo( "    singleDayNames = " . json_encode( $singleDayNames ) . ";\r\n" );

                define( 'JT_DATENAMES', 1 );
            }
        }
    }
}

class JTAnchors extends Persistent
{
    protected $_Left = true;
    protected $_Top = true;
    protected $_Right = 0;
    protected $_Bottom = 0;
    protected $_Relative = true;

    protected $_Owner = null;

    function __construct( $aowner )
    {
        parent::__construct();

        $this->_Owner = $aowner;
    }

    function readOwner()
    {
        return $this->_Owner;
    }

    function getLeft()
    {
        return $this->_Left;
    }

    function setLeft( $value )
    {
        $this->_Left = $value;
    }

    function defaultLeft()
    {
        return true;
    }

    function getTop()
    {
        return $this->_Top;
    }

    function setTop( $value )
    {
        $this->_Top = $value;
    }

    function defaultTop()
    {
        return true;
    }

    function getRight()
    {
        return $this->_Right;
    }

    function setRight( $value )
    {
        $this->_Right = $value;
    }

    function defaultRight()
    {
        return 0;
    }

    function getBottom()
    {
        return $this->_Bottom;
    }

    function setBottom( $value )
    {
        $this->_Bottom = $value;
    }

    function defaultBottom()
    {
        return 0;
    }

    function getRelative()
    {
        return $this->_Relative;
    }

    function setRelative( $value )
    {
        $this->_Relative = $value;
    }

    function defaultRelative()
    {
        return true;
    }
}
?>
