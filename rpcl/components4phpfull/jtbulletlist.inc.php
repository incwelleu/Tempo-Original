<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                        -- Bullet list component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTBulletList extends JTThemedGraphicControl
{
    protected $_TextClass = 'fsDefault';
    protected $_BulletType = 'btDisc';
    protected $_Bullets;
    protected $_Datasource = null;
    protected $_Datafield = '';
    protected $_Linkfield = '';

    protected $_OnData;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;

        $this->_Bullets = array();
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatasource( $this->_Datasource );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'bulletlist' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'label' ) );
        }
    }

    protected function dumpThemedContents()
    {
        $bulletTypeToListStyle = array(
            'btUnbulleted'      => 'none',
            'btDisc'            => 'disc',
            'btCircle'          => 'circle',
            'btSquare'          => 'square',
            'btDecimal'         => 'decimal',
            'btLowerRoman'      => 'lower-roman',
            'btUpperRoman'      => 'upper-roman',
            'btLowerAlpha'      => 'lower-alpha',
            'btUpperAlpha'      => 'upper-alpha',
        );

        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $bullet_content = '';

        $vars = array(
            'TEXTCLASS'     => $this->_TextClass,
            'STYLE'         => $style,
        );

        if( $this->_Datasource && $this->_Datafield )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $dataField = $this->_Datafield;
                $dataSet = $this->_Datasource->DataSet;

                for( $dataSet->First(), $i = 0; !$dataSet->EOF; $dataSet->Next(), ++$i )
                {
                    $content = $dataSet->Fields[ $dataField ];

                    if( $this->_OnData )
                        $content = $this->callEvent( 'OnData', $content );

                    $link = strlen( $this->_Linkfield ) ? $dataSet->Fields[ $this->_Linkfield ] : '';

                    $bullet_content .= $this->generateBulletContent( $vars, $content, $link, $i );
                }
            }
        }
        else
        {
            foreach( $this->_Bullets as $i => $item )
            {
                if( count( $item ) > 1 )
                    list( $bullet, $link ) = $item;
                else
                {
                    $bullet = $item;
                    $link = '';
                }

                $bullet_content .= $this->generateBulletContent( $vars, $bullet, $link, $i );
            }
        }

        $vars = array(
            'LISTSTYLE'     => $bulletTypeToListStyle[ $this->_BulletType ],
            'CONTENT'       => $bullet_content,
        );

        print( $this->generateComponentSectionCode( 'bulletlist', $vars ) );
    }

    function generateBulletContent( $vars, $content, $link, $i )
    {
        $vars[ 'CONTENT' ] = $content;
        $vars[ 'LINK' ] = $link;

        if( $this->_TabStop )
        {
            if( $this->_TabOrder != 0 )
                $vars[ 'TABINDEX' ] = $this->_TabOrder + $i;
            else
                $vars[ 'TABINDEX' ] = 0;
        }
        else
        {
            $vars[ 'TABINDEX' ] = '-1';
        }

        if( empty( $link ) )
            return $this->generateComponentSectionCode( 'bulletitem', $vars );
        else
            return $this->generateComponentSectionCode( 'bulletitem_link', $vars );
    }

    function AddItem( $value, $link = '' )
    {
        $this->_Bullets[] = array( $value, $link );

        return count( $this->_Bullets ) - 1;
    }

    function InsertItem( $value, $index, $link = '' )
    {
        array_splice( $this->_Bullets, $index, 0, array( array ( $value, $link ) ) );

        return $index;
    }

    function DeleteItem( $index )
    {
        if( $index < 0 || $index >= count( $this->_Bullets ) )
            return false;

        array_splice( $this->_Bullets, $index );

        return true;
    }

    function ClearItems()
    {
        $this->_Bullets = array();
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

    function getBulletType()
    {
        return $this->_BulletType;
    }

    function setBulletType( $value )
    {
        $this->_BulletType = $value;
    }

    function defaultBulletType()
    {
        return 'btDisc';
    }

    function getBullets()
    {
        return $this->_Bullets;
    }

    function setBullets( $value )
    {
        foreach( $value as &$item )
        {
            if( !array( $item ) )
                $item = array( $item, '' );
        }

        $this->_Bullets = $value;
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        $this->_Datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getDataField()
    {
        return $this->_Datafield;
    }

    function defaultDataField()
    {
        return '';
    }

    function setDataField( $value )
    {
        $this->_Datafield = $value;
    }

    function getLinkField(  )
    {
        return $this->_Linkfield;
    }

    function setLinkField( $value )
    {
        $this->_Linkfield = $value;
    }

    function defaultLinkField()
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

    function getOnData()
    {
        return $this->_OnData;
    }

    function setOnData( $value )
    {
        $this->_OnData = $value;
    }

    function defaultOnData()
    {
        return null;
    }
}
?>
