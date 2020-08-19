<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                        -- Clock component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTClock extends JTThemedGraphicControl
{
    protected $_TextClass = 'fsDefault';
    protected $_Type = 'Digital';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 230;
        $this->Height = 128;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'label' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'clock' ) );
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
            $style = " $style";

        $vars = array(
            'TEXTCLASS' => $this->_TextClass,
            'STYLE'     => $style,
        );

        print( $this->generateComponentSectionCode( strtolower( $this->_Type ), $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\"><!--\r\n" );

            $this->dumpBodyJavaScript();

            print( "// -->\r\n" );
            print( "</script>\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        print( 'JTClockInitialize( "' . $this->Name . "\", \"" . $this->_Type . "\" );\r\n" );
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

    function getTextClass()
    {
        return $this->_TextClass;
    }

    function setTextClass( $value )
    {
        $this->_TextClass = $value;
    }

    function defaultTextClass()
    {
        return 'fsDefault';
    }

    function getType()
    {
        return $this->_Type;
    }

    function setType( $value )
    {
        $this->_Type = $value;
    }

    function defaultType()
    {
        return 'Digital';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }
}
?>