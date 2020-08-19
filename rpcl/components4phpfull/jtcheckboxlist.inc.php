<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- Check box list component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTCheckBoxList extends JTThemedGraphicControl
{
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_TextClass = 'fsDefault';
    protected $_Items = array();
    protected $_Columns = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function preinit()
    {
        parent::preinit();

        if( ( !$this->_datasource || !$this->_datafield ) && is_object( $this->input->{$this->Name} ) )
        {
            foreach( $this->_Items as $i => &$item )
            {
                $checkname = $this->Name . '_' . $i;
                $v = $this->input->{$checkname};

                $item[ 1 ] = is_object( $v );
            }
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'checkboxlist' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'label' ) );
        }
    }

    function dumpForAjax()
    {
        global $ajaxResponse;

        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_contents();

        ob_end_clean();

        if( $ajaxResponse )
        {
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            echo( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

        foreach( $this->_Items as $i => $item )
            echo( "    document.getElementById('{$this->Name}_$i').checked = " . ( $item[ 1 ] ? "true" : "false" ) . ";\r\n" );
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
            $style = " style=\"$style\"";

        $contents = '';

        $events = ( $this->jsOnClick ? ' onclick="' . $this->jsOnClick . '(event)"' : '' );
        $events .= ( $this->jsOnBlur ? ' onblur="' . $this->jsOnBlur . '(event)"' : '' );
        $events .= ( $this->jsOnFocus ? ' onfocus="' . $this->jsOnFocus . '(event)"' : '' );

        $vars = array(
            'EVENTS'        => $events,
            'TEXTCLASS'     => $this->_TextClass,
            'STYLE'         => $style,
        );

        if( $this->_TabStop )
            $tabindex = $this->_TabOrder;
        else
            $tabindex = -1;


        if( $this->_Columns > 1 )
            $contents .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';

        if( $this->_datasource && $this->_datafield )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $field = $this->_datafield;

                for( $this->_datasource->DataSet->First(), $i = 0; !$this->_datasource->DataSet->EOF; $this->_datasource->DataSet->Next(), ++$i )
                {
                    $data = $this->_datasource->DataSet->AssociativeFieldValues[ $field ];

                    $checkname = $this->Name . '_' . $i;
                    $checked = is_object( $this->input->{$checkname} );

                    $vars[ 'INDEX' ] = $i;
                    $vars[ 'CONTENT' ] = $data;
                    $vars[ 'STATE' ] = ( $checked ? 'checked' : '' );
                    $vars[ 'TABINDEX' ] = $tabindex;

                    $contents .= $this->generateInsides( $vars, $i );

                    if( $tabindex > 0 )
                        ++$tabindex;
                }
            }
        }
        else
        {
            foreach( $this->_Items as $i => $item )
            {
                list( $caption, $checked ) = $item;

                $vars[ 'INDEX' ] = $i;
                $vars[ 'CONTENT' ] = $caption;
                $vars[ 'STATE' ] = ( $checked ? 'checked="checked"' : '' );
                $vars[ 'TABINDEX' ] = $tabindex;

                $contents .= $this->generateInsides( $vars, $i );

                if( $tabindex > 0 )
                    ++$tabindex;
            }
        }

        if( $this->_Columns > 1 )
            $contents .= '</tr></table>';

        $vars = array(
            'CONTENT'       => $contents,
        );

        print( $this->generateComponentSectionCode( 'checkboxlist', $vars ) );
    }

    function generateInsides( $vars, $index )
    {
        $newContents = '';

        if($this->_Columns > 0)
        {
            if($index % $this->_Columns === 0 || $index === 0)
                $newContents .= ( $index === 0 ? "<tr>" : "</tr>\r\n<tr>" );
            $newContents .= $this->generateComponentSectionCode( 'checkbox-td', $vars );
        }
        else
            $newContents .= $this->generateComponentSectionCode( 'checkbox', $vars );

        return $newContents;
    }

    function isChecked( $index )
    {
        if( $this->_datasource && $this->_datafield )
        {
            $checkname = $this->Name . '_' . $index;

            return is_object( $this->input->{$checkname} );
        }
        else
        {
            if( $index > -1 && $index < count( $this->_Items ) )
            {
                list( $caption, $checked ) = $this->_Items[ $index ];

                return $checked;
            }

            return false;
        }
    }

    function getDataField()
    {
        return $this->_datafield;
    }

    function setDataField( $value )
    {
        $this->_datafield = $value;
    }

    function defaultDataField()
    {
        return '';
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getColumns()
    {
        return $this->_Columns;
    }

    function setColumns( $value )
    {
        $this->_Columns = $value;
    }

    function defaultColumns()
    {
        return 0;
    }

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );
        }

        $this->_Items = $value;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getTabOrder()
    {
        return $this->readTabOrder();
    }

    function setTabOrder( $value )
    {
        $this->writeTabOrder( $value );
    }

    function getTabStop()
    {
        return $this->readTabStop();
    }

    function setTabStop( $value )
    {
        $this->writeTabStop( $value );
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

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
    }

    function getjsOnBlur()
    {
        return $this->readjsOnBlur();
    }

    function setjsOnBlur( $value )
    {
        $this->writejsOnBlur( $value );
    }

    function getjsOnFocus()
    {
        return $this->readjsOnFocus();
    }

    function setjsOnFocus( $value )
    {
        $this->writejsOnFocus( $value );
    }
}
?>
