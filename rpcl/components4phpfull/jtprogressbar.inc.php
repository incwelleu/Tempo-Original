<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Progress bar component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTProgressBar extends JTThemedGraphicControl
{
    protected $_Max = 100;
    protected $_Min = 0;
    protected $_Position = 0;
    protected $_Step = 10;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 350;
        $this->Height = 18;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            echo( $this->SiteThemeInstance->generateComponentCSSCode( 'progressbar' ) );
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        echo( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $pwidth = round( ( $this->_Position * 100 ) / ( $this->_Max - $this->_Min ), 2 );

        $vars = array(
            'PWIDTH'        => $pwidth,
        );

        echo( $this->generateComponentSectionCode( 'progressbar', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            echo( "<script language=\"JavaScript\" type=\"text/javascript\"><!--\r\n" );

            $this->dumpBodyJavaScript();

            echo( "// -->\r\n" );
            echo( "</script>\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        echo( "JTProgressBarInitialize( '" . $this->Name . "', " . $this->_Max . ", " . $this->_Min . ", " . $this->_Position . ", " . $this->_Step . " );\r\n" );
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

        echo( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );

        $this->dumpBodyJavaScript();
    }

    function StepBy( $increment )
    {
        $this->_Position += $increment;

        while( $this->_Position > $this->_Max )
            $this->_Position = $this->_Min + ( $this->_Position - $this->_Max );
    }

    function StepIt()
    {
        $this->StepBy( $this->_Step );
    }

    function getMax()
    {
        return $this->_Max;
    }

    function setMax( $value )
    {
        if( is_numeric( $value ) && $value > $this->_Min )
            $this->_Max = $value;
    }

    function defaultMax()
    {
        return 100;
    }

    function getMin()
    {
        return $this->_Min;
    }

    function setMin( $value )
    {
        if( is_numeric( $value ) && $value < $this->_Max )
            $this->_Min = $value;
    }

    function defaultMin()
    {
        return 0;
    }

    function getPosition()
    {
        return $this->_Position;
    }

    function setPosition( $value )
    {
        if( is_numeric( $value ) && $value >= $this->_Min && $value <= $this->_Max )
            $this->_Position = $value;
    }

    function defaultPosition()
    {
        return 0;
    }

    function getStep()
    {
        return $this->_Step;
    }

    function setStep( $value )
    {
        if( is_numeric( $value ) )
            $this->_Step = $value;
    }

    function defaultStep()
    {
        return 10;
    }
}
?>
