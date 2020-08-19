<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- Template panel control --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "extctrls.inc.php" );
use_unit( "templateplugins.inc.php" );

class JTTemplatePanel extends CustomPanel
{
    protected $_TemplateEngine = '';
    protected $_TemplateFilename = '';

    // For template support.
    protected $_onshowheader = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 200;
        $this->ControlStyle = "csAcceptsControls=1";
    }

    function dumpContents()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            $tclassname = $this->TemplateEngine;

            if( !empty( $tclassname ) && !empty( $this->_TemplateFilename ) )
            {
                $template = new $tclassname( $this );
                $template->FileName = $this->_TemplateFilename;

                $template->initialize();
                $template->assignComponents();
                $template->dumpTemplate();
            }
        }
    }

    // For template support.
    function dumpHeaderJavaScript()
    {
    }

    function readStartForm()
    {
        return "";
    }

    function readEndForm()
    {
        return "";
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
        return '';
    }

    function getTemplateFilename()
    {
        return $this->_TemplateFilename;
    }

    function setTemplateFilename( $value )
    {
        $this->_TemplateFilename = $value;
    }

    function defaultTemplateFilename()
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
}
?>