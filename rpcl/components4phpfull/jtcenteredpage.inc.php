<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Centered page class --
//
//            Copyright © JomiTech 2009. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "forms.inc.php" );

class JTCenteredPage extends Page
{
    protected $_InnerColor = '';

    function __construct( $parent = null )
    {
        parent::__construct( $parent );
    }

    function dumpChildrenHeaderCode()
    {
        parent::dumpChildrenHeaderCode();

        ?>
<style type="text/css"><!--
body {
    text-align: center;
}

#<?php print( $this->Name ); ?> {
    // Required for IE
    text-align: center;
}

#centeredContent {
<?php
        if( $this->_InnerColor )
            print( 'background-color: ' . $this->_InnerColor . ';' );
?>
    margin: 0 auto;
    position: relative;
    text-align: left;
}
-->
</style>
        <?php
    }

    function dumpChildren()
    {
        print( "\r\n  <div id=\"centeredContent\" style=\"width:" . $this->Width . "px; height: " . $this->Height . "px;\">\r\n" );

        parent::dumpChildren();

        print( "  </div>\r\n" );
    }

    function classParent()
    {
       // Override the classParent function so that the descendant class thinks that we are the Page class.
        if( parent::classParent() == 'JTCenteredPage' )
            return 'Page';
        else
            return parent::classParent();
    }

    function getInnerColor()
    {
        return $this->_InnerColor;
    }

    function setInnerColor( $value )
    {
        $this->_InnerColor = $value;
    }

    function defaultInnerColor()
    {
        return '';
    }
}
?>
