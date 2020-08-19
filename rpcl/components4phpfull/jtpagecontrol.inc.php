<?php
//-----------------------------------------------------------------------
//                 - JomiTech Components For PHP 1.0 -
//                    -- Page Control component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtbasetabcontrol.inc.php" );

class JTPageControl extends JTBaseTabControl
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    protected function GenerateTabSheets()
    {
        $active_tab = $this->_TabIndex;
        $content = '';

        foreach( $this->_Tabs as $i => $tab_data )
        {
            list( $caption, $name, $tabvisible ) = $tab_data;

            if( $this->isTabVisible( $tabvisible ) )
            {
                $this->_TabIndex = $i;

                $content .= $this->GenerateTabsheet( $tab_data, ( $active_tab == $i ) );
            }
        }

        $this->_TabIndex = $active_tab;

        return $content;
    }

    protected function GenerateTabsheet( $tab_data, $active )
    {
        list( $caption, $name ) = $tab_data;

        $name = $this->Name . '_' . $name;

        ob_start();

        $this->renderChildren();

        $content = ob_get_contents();

        ob_end_clean();

        if( strlen( $content ) == 0 )
            $content = '&nbsp;';

        if( $active )
        {
            $display = 'block';
            $visibility = 'visible';
            $zindex = 3;
        }
        else
        {
            $display = 'none';
            $visibility = 'hidden';
            $zindex = 1;
        }

        $vars = array(
            'SHEETNAME'     => $name,
            'DISPLAY'       => $display,
            'VISIBILITY'    => $visibility,
            'ZINDEX'        => $zindex,
            'CONTENT'       => $content,
        );

        return $this->generateComponentSectionCode( 'tabsheet', $vars );
    }

    function getActiveLayer()
    {
        $result = "";

        if( ( $this->_TabIndex > -1 ) && ( $this->_TabIndex < count( $this->_Tabs ) ) )
        {
            list( $caption, $name ) = $this->_Tabs[ $this->_TabIndex ];

            $result = $name;
        }
        else
        {
            if( count( $this->_Tabs ) > 0 )
            {
                list( $caption, $name ) = $this->_Tabs[ 0 ];

                $result = $name;
            }
        }

        return $result;
    }

    function setActiveLayer( $value )
    {
        $this->_TabIndex = -1;

        foreach( $this->_Tabs as $i => $tab_data )
        {
            list( $caption, $name, $tabvisible ) = $tab_data;

            if( $value == $name && $this->isTabVisible( $tabvisible ) )
            {
                $this->_TabIndex = $i;
                return;
            }
        }
    }
}
?>
