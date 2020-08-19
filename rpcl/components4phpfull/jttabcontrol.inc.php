<?php
//-----------------------------------------------------------------------
//                 - JomiTech Components For PHP 1.0 -
//                     -- Tab Control component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtbasetabcontrol.inc.php" );

class JTTabControl extends JTBaseTabControl
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    protected function GenerateTabSheets()
    {
        // Tab control does not use tab sheets, so just print the controls out.
        ob_start();

        $this->renderChildren();

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}
?>
