<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- News control component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTNewsControl extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_DescriptionField = '';
    protected $_ItemCount = 3;
    protected $_Items = array();
    protected $_LinkField = '';
    protected $_DateField = '';
    protected $_DateFormat = 'r';
    protected $_PrependURL = '';
    protected $_TitleField = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 100;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'news' ) );
    }

    protected function dumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $items = array();

        if( $this->_datasource && $this->_TitleField )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_datasource->DataSet )
            {
                for( $i = 0, $this->_datasource->DataSet->First(); !$this->_datasource->DataSet->EOF && $i < $this->_ItemCount; $this->_datasource->DataSet->Next(), ++$i )
                {
                    $items[] = array
                    (
                        $this->_datasource->DataSet->AssociativeFieldValues[ $this->_TitleField ],
                        ( $this->_DescriptionField ) ? $this->_datasource->DataSet->AssociativeFieldValues[ $this->_DescriptionField ] : '',
                        ( $this->_LinkField ) ? $this->_datasource->DataSet->AssociativeFieldValues[ $this->_LinkField ] : '',
                        ( $this->_DateField ) ? $this->_datasource->DataSet->AssociativeFieldValues[ $this->_DateField ] : '',
                    );
                }
            }
        }
        else
        {
            $items = array_slice( $this->_Items, 0, $this->_ItemCount );
        }

        $content = '';

        foreach( $items as $i => $item )
        {
            if( count( $item ) < 4 )
            {
                list( $title, $description, $link ) = $item;
                $date = '';
            }
            else
                list( $title, $description, $link, $date ) = $item;

            if( $link )
            {
                $vars = array
                (
                    'TITLE'         => $title,
                    'DESCRIPTION'   => $description,
                    'URL'           => $this->_PrependURL . $link,
                );

                $link = $this->generateComponentSectionCode( 'link', $vars );
            }
            else
            {
                $link = $title;
            }

            if( $date )
                $date = date( $this->_DateFormat, strtotime( $date ) );

            $vars = array(
                'INDEX'         => $i,
                'TITLE'         => $title,
                'DESCRIPTION'   => $description,
                'LINK'          => $link,
                'DATE'          => $date,
                'STYLE'         => $style,
            );

            $content .= $this->generateComponentSectionCode( 'item', $vars );
        }

        $vars = array(
            'CONTENT'       => $content,
        );

        print( $this->generateComponentSectionCode( 'newscontrol', $vars ) );
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

    function getDescriptionField()
    {
        return $this->_DescriptionField;
    }

    function setDescriptionField( $value )
    {
        $this->_DescriptionField = $value;
    }

    function defaultDescriptionField()
    {
        return '';
    }

    function getItemCount()
    {
        return $this->_ItemCount;
    }

    function setItemCount( $value )
    {
        if( is_numeric( $value ) )
            $this->_ItemCount = $value;
    }

    function defaultItemCount()
    {
        return 3;
    }

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$item )
        {
            if( !is_array( $item ) )
                $item = unserialize( $item );
        }

        $this->_Items = $value;
    }

    function getLinkField()
    {
        return $this->_LinkField;
    }

    function setLinkField( $value )
    {
        $this->_LinkField = $value;
    }

    function defaultLinkField()
    {
        return '';
    }

    function getDateField()
    {
        return $this->_DateField;
    }

    function setDateField( $value )
    {
        $this->_DateField = $value;
    }

    function defaultDateField()
    {
        return '';
    }

    function getDateFormat()
    {
        return $this->_DateFormat;
    }

    function setDateFormat( $value )
    {
        $this->_DateFormat = $value;
    }

    function defaultDateFormat()
    {
        return 'r';
    }

    function getPrependURL()
    {
        return $this->_PrependURL;
    }

    function setPrependURL( $value )
    {
        $this->_PrependURL = $value;
    }

    function defaultPrependURL()
    {
        return '';
    }

    function getTitleField()
    {
        return $this->_TitleField;
    }

    function setTitleField( $value )
    {
        $this->_TitleField = $value;
    }

    function defaultTitleField()
    {
        return '';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }
}
?>
