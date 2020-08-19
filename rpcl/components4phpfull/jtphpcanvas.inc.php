<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                        -- PHP Canvas Class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

// Pen styles.
if( !defined( 'psSolid' ) )
    define( 'psSolid', 'psSolid' );

if( !defined( 'psClear' ) )
    define( 'psClear', 'psClear' );

// Brush styles.
define( 'bsSolid', 'bsSolid' );
define( 'bsClear', 'bsClear' );

class JTPHPPen extends Object
{
    protected $_Handle = null;
    protected $_CanvasHandle = null;
    protected $_Color = null;
    protected $_Style = psSolid;

    function __construct( $canvasHandle )
    {
        $this->_CanvasHandle = $canvasHandle;
        $this->_Color = RGB( 0, 0, 0 );
        $this->_Handle = imagecolorallocate( $this->_CanvasHandle, 0, 0, 0 );
    }

    function __destruct()
    {
        if( $this->_Handle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_Handle );
    }

    function getColor()
    {
        return $this->_Color;
    }

    function setColor( $value )
    {
        if( !is_array( $value ) )
            return;

        if( $this->_Handle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_Handle );

        list( $r, $g, $b ) = $value;

        $this->_Color = $value;
        $this->_Handle = imagecolorallocate( $this->_CanvasHandle, $r, $g, $b );
    }

    function readHandle()
    {
        return $this->_Handle;
    }

    function getStyle()
    {
        return $this->_Style;
    }

    function setStyle( $value )
    {
        $this->_Style = $value;
    }
}

class JTPHPBrush extends Object
{
    protected $_Handle = null;
    protected $_CanvasHandle = null;
    protected $_Color = null;
    protected $_Style = bsSolid;

    function __construct( $canvasHandle )
    {
        $this->_CanvasHandle = $canvasHandle;
        $this->_Color = RGB( 255, 255, 255 );
        $this->_Handle = imagecolorallocate( $this->_CanvasHandle, 255, 255, 255 );
    }

    function __destruct()
    {
        if( $this->_Handle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_Handle );
    }

    function getColor()
    {
        return $this->_Color;
    }

    function setColor( $value )
    {
        if( !is_array( $value ) )
            return;

        if( $this->_Handle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_Handle );

        list( $r, $g, $b ) = $value;

        $this->_Color = $value;
        $this->_Handle = imagecolorallocate( $this->_CanvasHandle, $r, $g, $b );
    }

    function readHandle()
    {
        return $this->_Handle;
    }

    function getStyle()
    {
        return $this->_Style;
    }

    function setStyle( $value )
    {
        $this->_Style = $value;
    }
}

class JTPHPFont extends Object
{
    protected $_CanvasHandle = null;
    protected $_Color = null;
    protected $_ColorHandle = null;
    protected $_File = '';
    protected $_Size = 8;

    function __construct( $canvasHandle )
    {
        $this->_CanvasHandle = $canvasHandle;
        $this->_Color = RGB( 0, 0, 0 );
        $this->_ColorHandle = imagecolorallocate( $this->_CanvasHandle, 0, 0, 0 );
    }

    function __destruct()
    {
        if( $this->_ColorHandle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_ColorHandle );
    }

    function getColor()
    {
        return $this->_Color;
    }

    function setColor( $value )
    {
        if( !is_array( $value ) )
            return;

        if( $this->_ColorHandle )
            imagecolordeallocate( $this->_CanvasHandle, $this->_ColorHandle );

        list( $r, $g, $b ) = $value;

        $this->_Color = $value;
        $this->_ColorHandle = imagecolorallocate( $this->_CanvasHandle, $r, $g, $b );
    }

    function readColorHandle()
    {
        $this->_ColorHandle;
    }

    function getFile()
    {
        return $this->_File;
    }

    function setFile( $value )
    {
        $this->_File = $value;
    }

    function getSize()
    {
        return $this->_Size;
    }

    function setSize( $value )
    {
        $this->_Size = $value;
    }
}

class JTPHPCanvas extends Object
{
    protected $_Handle = null;
    protected $_Brush = null;
    protected $_Pen = null;
    protected $_Font = null;
    protected $_PenX = 0;
    protected $_PenY = 0;
    protected $_Width = 0;
    protected $_Height = 0;
    protected $_TransparentColor = false;
    protected $_TransparentColorHandle = null;

    function __construct( $width, $height )
    {
        $this->_Width = $width;
        $this->_Height = $height;

        $this->_Handle = imagecreatetruecolor( $width, $height );

        $this->_Brush = new JTPHPBrush( $this->_Handle );
        $this->_Pen = new JTPHPPen( $this->_Handle );
        $this->_Font = new JTPHPFont( $this->_Handle );

        $this->FillRect( 0, 0, $width, $height );
    }

    function __destruct()
    {
        $this->_Brush = null;
        $this->_Pen = null;

        if( $this->_Handle )
            imagedestroy( $this->_Handle );
    }

    function Arc( $cx, $cy, $width, $height, $startDeg, $endDeg )
    {
        imagearc( $this->_Handle, $cx, $cy, $width, $height, $startDeg, $endDeg, $this->_Pen->Handle );
    }

    function Ellipse( $cx, $cy, $width, $height )
    {
        if( $this->_Brush->Style != bsClear )
            imagefilledellipse( $this->_Handle, $cx, $cy, $width, $height, $this->_Brush->Handle );

        if( $this->_Pen->Style != psClear )
            imageellipse( $this->_Handle, $cx, $cy, $width, $height, $this->_Pen->Handle );
    }

    function FillRect( $x1, $y1, $x2, $y2 )
    {
        if( $this->_Brush->Style != bsClear )
            imagefilledrectangle( $this->_Handle, $x1, $y1, $x2, $y2, $this->_Brush->Handle );
    }

    function GIF( $file = null, $paletteColorCount = 256 )
    {
        $handle = imagecreatetruecolor( $this->_Width, $this->_Height );

        imagecopymerge( $handle, $this->_Handle, 0, 0, 0, 0, $this->_Width, $this->_Height, 100 );
        imagetruecolortopalette( $handle, false, $paletteColorCount );

        if( $file === null )
            $result = imagegif( $handle );
        else
            $result = imagegif( $handle, $file );

        imagedestroy( $handle );

        return $result;
    }

    function JPEG( $file = null, $quality = 75, $progressive = false )
    {
        imageinterlace( $this->_Handle, $progressive );

        return imagejpeg( $this->_Handle, $file, $quality );
    }

    function MoveTo( $x, $y )
    {
        $this->_PenX = $x;
        $this->_PenY = $y;
    }

    function LineTo( $x, $y )
    {
        if( $this->_Pen->Style != psClear )
            imageline( $this->_Handle, $this->_PenX, $this->_PenY, $x, $y, $this->_Pen->Handle );

        $this->_PenX = $x;
        $this->_PenY = $y;
    }

    function Line( $x1, $y1, $x2, $y2 )
    {
        if( $this->_Pen->Style != psClear )
            imageline( $this->_Handle, $x1, $y1, $x2, $y2, $this->_Pen->Handle );
    }

    function PNG( $file = null, $compression = 9, $interlaced = false, $paletteColorCount = false )
    {
        if( $paletteColorCount === false )
        {
            $handle = $this->_Handle;
        }
        else
        {
            $handle = imagecreatetruecolor( $this->_Width, $this->_Height );

            imagecopymerge( $handle, $this->_Handle, 0, 0, 0, 0, $this->_Width, $this->_Height, 100 );
            imagetruecolortopalette( $handle, false, $paletteColorCount );
        }

        imageinterlace( $handle, $interlaced );

        $result = imagepng( $handle, $file, $compression );

        if( $paletteColorCount !== false )
            imagedestroy( $handle );

        return $result;
    }

    function Polygon( $points )
    {
        if( $this->_Brush->Style != bsClear )
            imagefilledpolygon( $this->_Handle, $points, count( $points ) / 2, $this->_Brush->Handle );

        if( $this->_Pen->Style != psClear )
            imagepolygon( $this->_Handle, $points, count( $points ) / 2, $this->_Pen->Handle );
    }

    function Polyline( $points )
    {
        if( $this->_Pen->Style != psClear )
        {
            $l = count( $points ) / 2 - 1;
            for( $i = 0; $i < $l; ++$i )
                imageline( $this->_Handle, $points[ $i * 2 ], $points[ ( $i * 2 ) + 1 ], $points[ ( $i + 1 ) * 2 ], $points[ ( ( $i + 1 ) * 2 ) + 1 ], $this->_Pen->Handle );
        }
    }

    function Rectangle( $x1, $y1, $x2, $y2 )
    {
        if( $this->_Brush->Style != bsClear )
            imagefilledrectangle( $this->_Handle, $x1, $y1, $x2, $y2, $this->_Brush->Handle );

        if( $this->_Pen->Style != psClear )
            imagerectangle( $this->_Handle, $x1, $y1, $x2, $y2, $this->_Pen->Handle );
    }

    function RoundRect( $x1, $y1, $x2, $y2, $x3, $y3 )
    {
        if( $this->_Brush->Style != bsClear )
        {
            imagefilledrectangle( $this->_Handle, $x1 + $x3, $y1, $x2 - $x3, $y1 + $y3, $this->_Brush->Handle );
            imagefilledrectangle( $this->_Handle, $x1, $y1 + $y3, $x2, $y2 - $y3, $this->_Brush->Handle );
            imagefilledrectangle( $this->_Handle, $x1 + $x3, $y2 - $y3, $x2 - $x3, $y2, $this->_Brush->Handle );
            imagefilledellipse( $this->_Handle, $x1 + $x3, $y1 + $y3, $x3 * 2, $y3 * 2, $this->_Brush->Handle );
            imagefilledellipse( $this->_Handle, $x2 - $x3, $y1 + $y3, $x3 * 2, $y3 * 2, $this->_Brush->Handle );
            imagefilledellipse( $this->_Handle, $x1 + $x3, $y2 - $y3, $x3 * 2, $y3 * 2, $this->_Brush->Handle );
            imagefilledellipse( $this->_Handle, $x2 - $x3, $y2 - $y3, $x3 * 2, $y3 * 2, $this->_Brush->Handle );
        }

        if( $this->_Pen->Style != psClear )
        {
            imagearc( $this->_Handle, $x1 + $x3, $y1 + $y3, $x3 * 2, $y3 * 2, 180, 270, $this->_Pen->Handle );
            imageline( $this->_Handle, $x1 + $x3, $y1, $x2 - $x3, $y1, $this->_Pen->Handle );
            imagearc( $this->_Handle, $x2 - $x3, $y1 + $y3, $x3 * 2, $y3 * 2, 270, 360, $this->_Pen->Handle );
            imageline( $this->_Handle, $x2, $y1 + $y3, $x2, $y2 - $y3, $this->_Pen->Handle );
            imagearc( $this->_Handle, $x2 - $x3, $y2 - $y3, $x3 * 2, $y3 * 2, 0, 90, $this->_Pen->Handle );
            imageline( $this->_Handle, $x2 - $x3, $y2, $x1 + $x3, $y2, $this->_Pen->Handle );
            imagearc( $this->_Handle, $x1 + $x3, $y2 - $y3, $x3 * 2, $y3 * 2, 90, 180, $this->_Pen->Handle );
            imageline( $this->_Handle, $x1, $y2 - $y3, $x1, $y1 + $y3, $this->_Pen->Handle );
        }
    }

    function TextExtent( $str )
    {
        $arr = imagettfbbox( $this->_Font->Size, 0, $this->_Font->File, $str );

        return array( $arr[ 2 ] - $arr[ 6 ], $arr[ 3 ] - $arr[ 7 ] );
    }

    function TextHeight( $str )
    {
        $ext = $this->TextExtent( $str );

        return $ext[ 1 ];
    }

    function TextOut( $x, $y, $str )
    {
        imagettftext( $this->_Handle, $this->_Font->Size, 0, $x, $y + $this->TextHeight( $str ), $this->_Font->ColorHandle, $this->_Font->File, $str );
    }

    function TextWidth( $str )
    {
        $ext = $this->TextExtent( $str );

        return $ext[ 0 ];
    }

    function readBrush()
    {
        return $this->_Brush;
    }

    function readPen()
    {
        return $this->_Pen;
    }

    function readFont()
    {
        return $this->_Font;
    }

    function readHandle()
    {
        return $this->_Handle;
    }
}

function RGB( $r, $g, $b )
{
    return array( $r, $g, $b );
}
?>