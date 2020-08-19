<?php
//-----------------------------------------------------------------------
//                 - JomiTech Components For PHP 1.0 -
//                --  JTThemedCustomPanel base class --
//
//             ! Must only be included by jtsitetheme.inc.php !
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
if( !defined( 'JT_STANDALONE' ) )
    use_unit( "templateplugins.inc.php" );

use_unit( 'graphics.inc.php' );
use_unit( "components4phpfull/jtlayout.inc.php" );

abstract class JTThemedCustomPanel extends JTThemedGraphicControl
{
    protected $_Include = "";
    protected $_ActiveLayer = 0;
    protected $_TemplateEngine = "";
    protected $_TemplateFileName = "";

    // For template support.
    protected $_onshowheader = null;
    protected $_OnDumpContents = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->ControlStyle = "csAcceptsControls=1";

        $this->_layout = new JTLayout();
        $this->_layout->_control = $this;
        $this->_layout->Type = ABS_XY_LAYOUT;
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        ob_start();

        $this->renderChildren();

        $content = ob_get_contents();

        ob_end_clean();

        $this->dumpThemedContainerContents( $content );
    }

    abstract protected function dumpThemedContainerContents( $contents );

    protected function alignComponentsWithDropZone( $apply )
    {
        list( $left, $top ) = $this->DropZone;

        if( $apply )
        {
            $left *= -1;
            $top *= -1;
        }

        foreach( $this->controls->items as &$v )
        {
            $v->Left = $v->Left + $left;
            $v->Top = $v->Top + $top;
        }
    }

    protected function renderChildren()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( strlen( $this->_Include ) )
            {
                include( $this->_Include );
            }
            else
            {
                if( !defined( 'JT_STANDALONE' ) )
                {
                    $this->alignComponentsWithDropZone( true );

                    if( strlen( $this->_TemplateEngine ) && strlen( $this->_TemplateFileName ) )
                    {
                        $TemplateClassName = $this->_TemplateEngine;

                        $template = new $TemplateClassName( $this );
                        $template->FileName = $this->_TemplateFileName;
                        $template->initialize();
                        $template->assignComponents();
                        $template->dumpTemplate();
                    }
                    else
                    {
                        $this->Layout->dumpLayoutContents();
                    }

                    $this->alignComponentsWithDropZone( false );
                }
                else
                {
                    $this->callEvent( 'OnDumpContents', array() );
                }
            }
        }
    }

    protected function dumpChildrenForAjax()
    {
        foreach( $this->controls->items as $v )
        {
            if( $v->methodExists( 'dumpForAjax' ) )
            {
                $v->dumpForAjax();
            }
            else
            {
                ob_start();

                $v->show();

                $contents = ob_get_contents();

                ob_end_clean();

                $js = extractjscript( $contents );

                $contents = utf8_encode( $contents );
                $contents = str_replace( "\r\n", ' ', $contents );
                $contents = str_replace( "\n", ' ', $contents );
                $contents = str_replace( '"', '\"', $contents );

                print( "document.getElementById( '" . $v->Name . "_outer' ).innerHTML = \"$contents\";\r\n" );

                $js[ 0 ] = utf8_encode( $js[ 0 ] );

                print( $js[ 0 ] . "\r\n" );
            }
        }

        echo( "JTUpdateAnchors();\r\n" );
    }

    // For template support.
    function dumpHeaderJavaScript()
    {
    }

    function readClientWidth()
    {
        if( $this->SiteThemeInstance )
        {
            $ca = $this->retrieveSetting( 'ClientArea' );
            if( $ca == '' )
            {
                $ca = $this->retrieveSetting( 'DropZone' );
                if( $ca == '' )
                    $ca = '0,0,0,0';
                else
                    $ca .= ',0,0';
            }

            $ca = explode( ',', $ca, 4 );
        }
        else
        {
            $ca = array( 0, 0, 0, 0 );
        }

        return ( $this->Width - ( $ca[ 2 ] + $ca[ 0 ] ) );
    }

    function readClientHeight()
    {
        if( $this->SiteThemeInstance )
        {
            $ca = $this->retrieveSetting( 'ClientArea' );
            if( $ca == '' )
            {
                $ca = $this->retrieveSetting( 'DropZone' );
                if( $ca == '' )
                    $ca = '0,0,0,0';
                else
                    $ca .= ',0,0';
            }

            $ca = explode( ',', $ca, 4 );
        }
        else
        {
            $ca = array( 0, 0, 0, 0 );
        }

        return ( $this->Height - ( $ca[ 3 ] + $ca[ 1 ] ) );
    }

    function readDropZone()
    {
        if( !$this->SiteThemeInstance )
            $result = array( 0, 0 );
        else
            $result = explode( ',', $this->retrieveSetting( 'DropZone' ), 2 );

        return $result;
    }

    function readInclude()
    {
        return $this->_Include;
    }

    function writeInclude( $value )
    {
        $this->_Include = $value;
    }

    function defaultInclude()
    {
        return "";
    }

    function getLayout()
    {
        return $this->readLayout();
    }

    function setLayout( $value )
    {
        $this->writeLayout( $value );
    }

    function getActiveLayer()
    {
        return $this->_ActiveLayer;
    }

    function setActiveLayer( $value )
    {
        $this->_ActiveLayer = $value;
    }

    function defaultActiveLayer()
    {
        return 0;
    }

    function getTemplateEngine()
    {
        return $this->_TemplateEngine;
    }

    function setTemplateEngine( $value )
    {
        $this->_TemplateEngine = $value;
    }

    function defaultTemplateEngine()
    {
        return "";
    }

    function getTemplateFilename()
    {
        return $this->_TemplateFileName;
    }

    function setTemplateFilename( $value )
    {
        $this->_TemplateFileName = $value;
    }

    function defaultTemplateFilename()
    {
        return "";
    }

    function readStartForm()
    {
        return "";
    }

    function readEndForm()
    {
        return "";
    }

    function readOnDumpContents()
    {
        return $this->_OnDumpContents;
    }

    function writeOnDumpContents( $value )
    {
        $this->_OnDumpContents = $value;
    }
}
?>