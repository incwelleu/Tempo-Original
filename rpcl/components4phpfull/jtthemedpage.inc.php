<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- Themed page class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "forms.inc.php" );
use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTThemedPage extends Page
{
    protected $_SiteThemeInstance = null;
    protected $_Skin = 'default';

    function __construct( $parent = null )
    {
        parent::__construct( $parent );
    }

    // Dump the page header code.
    function dumpChildrenHeaderCode()
    {
        if( $this->_SiteThemeInstance )
            print( $this->_SiteThemeInstance->generatePageCSSCode() );

        parent::dumpChildrenHeaderCode();
    }

    // Dump the page code inside a centered table cell.
    function dumpChildren()
    {
        if( !$this->_SiteThemeInstance )
        {
            JTSiteTheme::PrintNoSiteTheme( '100%', '100%', $this->Name . '::SiteTheme property not initialized to a valid JTSiteTheme instance.' );
            return;
        }

        if( !$this->_SiteThemeInstance->loadComponentTheme( 'JTThemedPage' ) )
        {
            JTSiteTheme::PrintNoSiteTheme( '100%', '100%', 'Failed to load page theme file (JTThemedPage.xml).' );
            return;
        }

        ob_start();

        parent::dumpChildren();

        $content = ob_get_contents();

        ob_end_clean();

        $vars = array(
            'CONTENT'       => $content
        );

        print( $this->_SiteThemeInstance->generateSectionCode( 'JTThemedPage', $this->_Skin, 'page', $vars ) );
    }

    function classParent()
    {
        // Override the classParent function so that the descendant class thinks that we are the Page class.
        if( parent::classParent() == 'JTThemedPage' )
            return 'Page';
        else
            return parent::classParent();
    }

    function getSiteThemeInstance()
    {
        return $this->_SiteThemeInstance;
    }

    function setSiteThemeInstance( $value )
    {
        $this->_SiteThemeInstance = $value;
    }

    function getSkin()
    {
        return $this->_Skin;
    }

    function setSkin( $value )
    {
        $this->_Skin = $value;
    }

    function defaultSkin()
    {
        return 'default';
    }
}
?>
