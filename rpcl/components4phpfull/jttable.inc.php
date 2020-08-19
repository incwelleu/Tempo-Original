<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                         -- Table component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTTable extends JTThemedGraphicControl
{
    protected $_BackColor = '';
    protected $_BackgroundImage = '';
    protected $_Border = '';
    protected $_CellData = array();
    protected $_CellPadding = '';
    protected $_Cells = array();
    protected $_CellSpacing = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 400;
        $this->Height = 400;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'table' ) );
    }

    protected function dumpThemedContents()
    {
        $content = '';

        foreach( $this->_Cells as $i => $row )
        {
            list( $rowcolor, $cells ) = $row;

            $content .= '<tr';

            if( $rowcolor )
                $content .= ' style="background-color: ' . $rowcolor . ';"';

            $content .= ">\r\n";

            foreach( $cells as $j => $cell )
            {
                list( $font, $backcolor, $width, $align, $valign ) = $cell;

                $content .= '<td';

                if( $align )
                    $content .= ' align="' . $align . '"';

                if( $font || $backcolor )
                {
                    $content .= ' style="';

                    if( $font )
                        $content .= $font . ' ';

                    if( $backcolor )
                        $content .= 'background-color: ' . $backcolor . ';';

                    $content .= '"';
                }

                if( $width )
                    $content .= ' width="' . $width . '"';

                if( $valign )
                    $content .= ' valign="' . $valign . '"';

                if( is_array( $this->_CellData ) && $i < count( $this->_CellData ) && $j < count( $this->_CellData[ $i ] ) )
                    $value = $this->_CellData[ $i ][ $j ];
                else
                    $value = '&nbsp;';

                $content .= '>' . $value . "</td>\r\n";
            }

            $content .= "</tr>\r\n";
        }

        $attr = '';

        if( strlen( $this->_Border ) )
            $attr .= 'border="' . $this->_Border . '" ';

        if( strlen( $this->_CellPadding ) )
            $attr .= 'cellpadding="' . $this->_CellPadding . '" ';

        if( strlen( $this->_CellSpacing ) )
            $attr .= 'cellspacing="' . $this->_CellSpacing . '" ';

        $style = '';

        if( strlen( $this->_BackColor ) )
            $style .= ' background-color: ' . $this->_BackColor . ';';

        if( strlen( $this->_BackgroundImage ) )
            $style .= ' background-image: url(' . $this->_BackgroundImage . ');';

        $vars = array(
            'ATTRIBUTES'    => $attr,
            'CONTENT'       => $content,
            'STYLE'         => $style,
        );

        print( $this->generateComponentSectionCode( 'table', $vars ) );
    }

    function AddRow( $values = array() )
    {
        $this->_CellData[] = $values;
    }

    function InsertRow( $index, $values = array() )
    {
        array_splice( $this->_CellData, $index, 0, array( $values ) );
    }

    function DeleteRow( $index )
    {
        array_splice( $this->_CellData, $index, 1 );
    }

    function ClearRows()
    {
        $this->_CellData = array();
    }

    function getBackColor()
    {
        return $this->_BackColor;
    }

    function setBackColor( $value )
    {
        $this->_BackColor = $value;
    }

    function defaultBackColor()
    {
        return '';
    }

    function getBackgroundImage()
    {
        return $this->_BackgroundImage;
    }

    function setBackgroundImage( $value )
    {
        $this->_BackgroundImage = $value;
    }

    function defaultBackgroundImage()
    {
        return '';
    }

    function getBorder()
    {
        return $this->_Border;
    }

    function setBorder( $value )
    {
        $this->_Border = $value;
    }

    function defaultBorder()
    {
        return '';
    }

    function readCellData()
    {
        return $this->_CellData;
    }

    function writeCellData( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$a )
        {
            if( !is_array( $a ) )
                $a = unserialize( $a );
        }

        $this->_CellData = $value;
    }

    function getCellPadding()
    {
        return $this->_CellPadding;
    }

    function setCellPadding( $value )
    {
        $this->_CellPadding = $value;
    }

    function defaultCellPadding()
    {
        return '';
    }

    function getCells()
    {
        return $this->_Cells;
    }

    function setCells( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$row )
        {
            if( !is_array( $row ) )
                $row = unserialize( $row );

            $rowcolor = $row[ 0 ];
            $cols = $row[ 1 ];

            if( !is_array( $cols ) )
                $cols = unserialize( $cols );

            foreach( $cols as &$cell )
            {
                if( !is_array( $cols ) )
                    $cols = unserialize( $cols );

                foreach( $cols as &$cell )
                {
                    if( !is_array( $cell ) )
                        $cell = unserialize( $cell );
                }
            }

            $row[ 1 ] = $cols;
        }

        $this->_Cells = $value;
    }

    function getCellSpacing()
    {
        return $this->_CellSpacing;
    }

    function setCellSpacing( $value )
    {
        $this->_CellSpacing = $value;
    }

    function defaultCellSpacing()
    {
        return '';
    }
}
?>