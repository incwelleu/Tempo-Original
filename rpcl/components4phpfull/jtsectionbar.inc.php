<?php
//-----------------------------------------------------------------------
//                 - JomiTech Components For PHP 1.0 -
//                    -- Section Bar Component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

 class JTSectionBar extends JTThemedCustomPanel
{
    protected $_Sections;
    protected $_SectionIndex = -1;
    protected $_onchange;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 400;

        $this->_Sections = array();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            if( ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'sectionbar' ) );
        }
    }

    function dumpThemedContents()
    {
        if( count( $this->_Sections ) == 0 )
        {
            $this->_SectionIndex = -1;
        }
        else
        {
            if( $this->_SectionIndex < 0 )
                $this->_SectionIndex = 0;
            else if( $this->_SectionIndex >= count( $this->_Sections ) )
                $this->_SectionIndex = count( $this->_Sections ) - 1;
        }

        $sections_code = '';
        $active_tab = $this->_SectionIndex;

        foreach( $this->_Sections as $i => $section_data )
        {
            $this->_SectionIndex = $i;
            $sections_code .= $this->GenerateSection( $i, $section_data );
        }

        $this->_SectionIndex = $active_tab;

        $vars = array(
            'SECTIONSCODE'      => $sections_code,
        );

        print( $this->generateComponentSectionCode( 'sectionbar', $vars ) );
    }

    protected function dumpControlFooter()
    {
        print( "<script language=\"JavaScript\">\r\n" );

        $this->dumpBodyJavaScript();

        print( "</script>\r\n" );
    }

    protected function GenerateSection( $i, $section_data )
    {
        list( $caption, $name ) = $section_data;

        $name = $this->Name . '_' . $name;

        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        if( $i == $this->_SectionIndex )
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

        ob_start();

        $this->renderChildren();

        $content = ob_get_contents();

        ob_end_clean();

        if( strlen( $content ) == 0 )
            $content = '&nbsp;';

        $vars = array(
            'SECTIONNAME'       => $name,
            'STYLE'             => $style,
            'CAPTION'           => $caption,
            'CONTENT'           => $content,
            'DISPLAY'           => $display,
            'VISIBILITY'        => $visibility,
            'ZINDEX'            => $zindex,
        );

        return $this->generateComponentSectionCode( 'section', $vars );
    }

    protected function dumpThemedContainerContents( $content )
    {
    }

    function dumpForAjax()
    {
        $this->dumpBodyJavaScript();
        $this->dumpChildrenForAjax();
    }

    function dumpBodyJavaScript()
    {
        $first = true;
        $str = '';

        foreach( $this->_Sections as $i => $tab_data )
        {
            list( $caption, $name ) = $tab_data;

            $name = $this->Name . '_' . $name;

            if( $first )
                $first = false;
            else
                $str .= ', ';

            $str .= "'" . $name . "'";
        }

        if( $this->Parent && $this->Parent->inheritsFrom( 'QWidget' ) )
            print( "JTEliminateDuplicateID( '" . $this->Name . "' );\r\n" );

        print( "JTInitializeSectionBar( '" . $this->Name . "', new Array( $str ), " .  $this->_SectionIndex . ", " . GetJTJSEventToString( $this->JsOnChange ) . " )\r\n" );

        if( $this->_SectionIndex > -1 )
        {
            list( $caption, $name ) = $this->_Sections[ $this->_SectionIndex ];

            print( "JTSectionBarButtonClick( '" . $this->Name . "', '" . $this->Name . '_' . $name . "' );\r\n" );
        }
    }

    function getActiveLayer()
    {
        $result = "";

        if( ( $this->_SectionIndex > -1 ) && ( $this->_SectionIndex < count( $this->_Sections ) ) )
        {
            list( $caption, $name ) = $this->_Sections[ $this->_SectionIndex ];

            $result = $name;
        }
        else
        {
            if( count( $this->_Sections ) > 0 )
            {
                list( $caption, $name ) = $this->_Sections[ 0 ];

                $result = $name;
            }
        }

        return $result;
    }

    function setActiveLayer( $value )
    {
        $this->_SectionIndex = -1;

        foreach( $this->_Sections as $i => $tab_data )
        {
            list( $caption, $name ) = $tab_data;

            if( $value == $name )
            {
                $this->_SectionIndex = $i;
                return;
            }
        }
    }

    function getSections()
    {
        return $this->_Sections;
    }

    function setSections( $value )
    {
        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );
        }

        $this->_Sections = $value;
    }

    function getSectionIndex()
    {
        return $this->_SectionIndex;
    }

    function setSectionIndex( $value )
    {
        $this->_SectionIndex = $value;
    }

    function defaultSectionIndex()
    {
        return -1;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }
}
?>
