<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- JTThemedComponent base class --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

abstract class JTThemedComponent extends Component
{
    private $SiteTheme;
    protected $SiteThemeInstance;

    protected $_cssClass = '';
    protected $_Skin = 'default';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
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

    function generateComponentSectionCode( $section, $vars )
    {
        $vars[ 'NAME' ] = $this->Name;
        $vars[ 'CSSCLASS' ] = $this->_cssClass;

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
}
?>
