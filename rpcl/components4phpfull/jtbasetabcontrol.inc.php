<?php
//-----------------------------------------------------------------------
//                 - JomiTech Components For PHP 1.0 -
//                    -- Base Tab Control class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

abstract class JTBaseTabControl extends JTThemedCustomPanel
{
    protected $_Tabs = array();
    protected $_TabIndex = -1;
    protected $_onchange;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 200;
    }

    function preinit()
    {
        parent::preinit();

        $indexField = $this->input->{$this->Name . '_Index'};
        if( is_object( $indexField ) && is_numeric( $indexField->asString() ) )
            $this->_TabIndex = $indexField->asString();

        $this->validateTabIndex();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'pagecontrol' ) );
    }

    protected function internalDumpThemedContents()
    {
        $this->validateTabIndex();

        $j = 0;
        $tabbutton_code = '';
        $visibleTabCount = 0;

        foreach( $this->_Tabs as $tab_data )
        {
            if( $this->isTabVisible( $tab_data[ 2 ] ) )
                ++$visibleTabCount;
        }

        foreach( $this->_Tabs as $i => $tab_data )
        {
            list( $name, $caption, $tabvisible ) = $tab_data;

            if( $this->isTabVisible( $tabvisible ) )
            {
                $tabbutton_code .= $this->GenerateTabButton( $i, $tab_data, $j, $visibleTabCount );
                ++$j;
            }
        }

        $tabsheet_code = $this->GenerateTabSheets();

        $vars = array(
            'TABBUTTONCODE'     => $tabbutton_code,
            'TABSHEETCODE'      => $tabsheet_code,
            'TABCOUNT'          => count( $this->_Tabs ),
        );

        print( $this->generateComponentSectionCode( 'tabcontrol', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
        }
    }

    protected function GenerateTabButton( $i, $tab_data, $j, $visibleTabCount )
    {
        list( $caption, $name ) = $tab_data;

        $name = $this->Name . '_' . $name;

        $content = $caption;

        $centerclasstype = ( $this->_TabIndex == $i ) ? 'active' : 'inactive';

        if( $this->_TabIndex == $i )
            $leftclasstype = 'active';
        else if( $j == 0 )
            $leftclasstype = 'end';
        else if( ( $this->_TabIndex + 1 ) == $i )
            $leftclasstype = 'afteractive';
        else
            $leftclasstype = 'mid';

        if( $this->_TabIndex == $i )
            $rightclasstype = 'active';
        else if( ( $visibleTabCount - 1 ) == $j )
            $rightclasstype = 'end';
        else if( ( $this->_TabIndex - 1 ) == $i )
            $rightclasstype = 'beforeactive';
        else
            $rightclasstype = 'mid';

        if( $this->_TabIndex == $i )
            $tabclasstype = 'active';
        else if( $i < $this->_TabIndex )
            $tabclasstype = 'before';
        else
            $tabclasstype = 'after';

        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $vars = array(
            'TABNAME'           => $name,
            'LEFTCLASSTYPE'     => $leftclasstype,
            'CENTERCLASSTYPE'   => $centerclasstype,
            'RIGHTCLASSTYPE'    => $rightclasstype,
            'TABCLASSTYPE'      => $tabclasstype,
            'STYLE'             => $style,
            'CONTENT'           => $content,
            'TABWIDTH'          => ceil( 100 / count( $this->_Tabs ) ),
            'TABINDEX'          => $this->_TabIndex,
        );

        return $this->generateComponentSectionCode( 'tabbutton', $vars );
    }

    abstract protected function GenerateTabSheets();

    protected function dumpThemedContainerContents( $content )
    {
    }

    function dumpForAjax()
    {
        global $ajaxResponse;

        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_clean();

        $script = extractjscript( $contents );
        $script = $script[ 0 ];

        if( $ajaxResponse )
        {
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );

            ob_start();

            $this->dumpBodyJavaScript();

            $js = ob_get_clean();

            $ajaxResponse->script( $js );
            $ajaxResponse->script( $script );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
            print( $script );
        }
    }

    function dumpBodyJavaScript()
    {
        $first = true;
        $str = '';

        foreach( $this->_Tabs as $i => $tab_data )
        {
            list( $caption, $name, $tabvisible ) = $tab_data;

            if( !$this->isTabVisible( $tabvisible ) )
                continue;

            $name = $this->Name . '_' . $name;

            if( $first )
                $first = false;
            else
                $str .= ', ';

            $str .= "'" . $name . "'";
        }

        if( $this->Parent && $this->Parent->inheritsFrom( 'QWidget' ) )
            print( "JTEliminateDuplicateID('" . $this->Name . "');\r\n" );

        print( "JTInitializeTabControl('" . $this->Name . "',[$str]," .  $this->_TabIndex . "," . GetJTJSEventToString( $this->JsOnChange ) . ");\r\n" );
    }

    protected function isTabVisible( $tabvisible )
    {
        return ( $tabvisible === '' || $tabvisible );
    }

    protected function validateTabIndex()
    {
        $value = $this->_TabIndex;

        if( $value < 0 )
            $value = -1;
        else if( $value >= count( $this->_Tabs ) )
            $value = count( $this->_Tabs ) - 1;

        if( $value > -1 )
        {
            list( $caption, $name, $tabvisible ) = $this->_Tabs[ $value ];

            if( !$this->isTabVisible( $tabvisible ) )
            {
                $value = -1;

                for( $i = 0; $i < count( $this->_Tabs ); ++$i )
                {
                    list( $caption, $name, $tabvisible ) = $this->_Tabs[ $i ];

                    if( $this->isTabVisible( $tabvisible ) )
                    {
                        $value = $i;
                        break;
                    }
                }
            }
        }
        else if( count( $this->_Tabs ) > 0 )
        {
            $value = 0;
        }

        $this->_TabIndex = $value;
    }

    function getTabs()
    {
        return $this->_Tabs;
    }

    function setTabs( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );

            if( count( $v ) < 3 )
                $v[] = '';
        }

        $this->_Tabs = $value;
    }

    function getTabIndex()
    {
        return $this->_TabIndex;
    }

    function setTabIndex( $value )
    {
        $this->_TabIndex = $value;
    }

    function defaultTabIndex()
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
