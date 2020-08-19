<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//               -- Basic JTLayout-supporting page class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "forms.inc.php" );
use_unit( "components4phpfull/jtlayout.inc.php" );

class JTBasicPage extends Page
{
    protected $_MinWidth = '';
    protected $_MinHeight = '';

    function __construct( $parent = null )
    {
        parent::__construct( $parent );

        $this->_layout = new JTLayout();
        $this->_layout->_control = $this;
        $this->_layout->Type = JTANCHOR_LAYOUT;
    }

    function dumpChildrenHeaderCode($return_contents=false)
    {
        $result = parent::dumpChildrenHeaderCode($return_contents);

        if( $this->Layout->Type == JTANCHOR_LAYOUT )
        {
            $content = '<script language="JavaScript" type="text/javascript"><!--' . "\r\n";
            $content .= "JTInitAnchorUpdate();\r\n";
            $content .= "// -->\r\n";
            $content .= "</script>\r\n";

            if( $return_contents )
                $result .= $content;
            else
                print( $content );
        }

        return $result;
    }

    function dumpChildren()
    {
        $width="";
        $height="";
        $color="";

        $alignment="";

        // fixup to allow initialization of visual stuff in case
        // if non-visual Q lib classes are used

        if (defined('QOOXDOO'))
        {
                echo "\n"
                   . "<script type=\"text/javascript\">\n"
                   . "    var d = qx.ui.core.ClientDocument.getInstance();\n"
                // If overflow is active, cursor is not shown on the edit controls
                // . "    d.setOverflow(\"scrollY\");\n"
                   . "    d.setBackgroundColor(null);\n"
                   . "</script>\n";
        }

        switch ($this->_alignment)
        {
                case agNone: $alignment=""; break;
                case agLeft: $alignment=" align=\"Left\" "; break;
                case agCenter: $alignment=" align=\"Center\" "; break;
                case agRight: $alignment=" align=\"Right\" "; break;
        }

        if ($this->Color!="") $color=" bgcolor=\"$this->Color\" ";
        if ($this->Background!="") $background=" background=\"$this->Background\" ";
        if ($this->Width!="") $width=" width=\"$this->Width\" ";
        if ($this->Height!="") $height=" style=\"height:".$this->Height."px\" ";

        if (($this->ControlState & csDesigning) != csDesigning)
        {
            if (($this->Layout->Type==GRIDBAG_LAYOUT) || ($this->Layout->Type==ROW_LAYOUT) || ($this->Layout->Type==COL_LAYOUT))
            {
                $width=" width=\"100%\" ";
//                $height="";
            }
        }

        if( $this->Layout->Type == JTANCHOR_LAYOUT && ( strlen( $this->_MinWidth ) || strlen( $this->_MinHeight ) ) )
        {
            if( strlen( $this->_MinWidth ) )
            {
                $we = "width: expression(document.body.clientWidth < " . $this->_MinWidth . " ? '" . $this->_MinWidth . "px' : '100%' ); ";
                $w = 'min-width: ' . $this->_MinWidth . 'px; ';
            }

            if( strlen( $this->_MinHeight ) )
            {
                $he = "height: expression(document.body.clientHeight < " . $this->_MinHeight . " ? '" . $this->_MinHeight . "px' : '100%' ); ";
                $h = 'min-height: ' . $this->_MinHeight . 'px;';
            }

            print( '<div style="position: absolute; left: 0px; top: 0px; ' . $we . $he . 'width: 100%; height: 100%; ' . $w . $h . "\">\r\n" );
        }

//        echo "\n<table $width $height border=\"0\" cellpadding=\"0\" cellspacing=\"0\" $color $alignment><tr><td valign=\"top\">\n";

        if (($this->ControlState & csDesigning) != csDesigning)
        {
                $this->Layout->dumpLayoutContents(array('Frame', 'Frameset'));
        }

//        echo "</td></tr></table>\n";

        if( $this->Layout->Type == JTANCHOR_LAYOUT && ( strlen( $this->_MinWidth ) || strlen( $this->_MinHeight ) ) )
            print( "</div>\r\n" );

        reset($this->controls->items);
        while (list($k,$v)=each($this->controls->items))
        {
                if (($v->Visible) && ($v->IsLayer))
                {
                        $v->show();
                }
        }

    }

    function classParent()
    {
        // Override the classParent function so that the descendant class thinks that we are the Page class.
        if( parent::classParent() == 'JTBasicPage' )
            return 'Page';
        else
            return parent::classParent();
    }

    function getMinHeight()
    {
        return $this->_MinHeight;
    }

    function setMinHeight( $value )
    {
        $this->_MinHeight = $value;
    }

    function defaultMinHeight()
    {
        return '';
    }

    function getMinWidth()
    {
        return $this->_MinWidth;
    }

    function setMinWidth( $value )
    {
        $this->_MinWidth = $value;
    }

    function defaultMinWidth()
    {
        return '';
    }
}
?>
