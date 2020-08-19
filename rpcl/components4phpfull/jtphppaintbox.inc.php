<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                 -- PHP Paintbox component component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtphpcanvas.inc.php" );

define( 'itPNG', 'itPNG' );
define( 'itJPG', 'itJPG' );
define( 'itGIF', 'itGIF' );

class JTPHPPaintBox extends JTThemedGraphicControl
{
    protected $_Canvas = null;
    protected $_ImageType = itPNG;
    protected $_onpaint;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function init()
    {
        parent::init();

        $classname = get_class( $this );
        $v = $this->input->{ $this->Name };

        $key = md5( $this->owner->Name . '.' . $this->Name );

        if( is_object( $v ) && $v->asString() == $key )
            $this->dumpBlobImage();
    }

    protected function dumpThemedContents()
    {
        $vars = array();

        $querystring = '?' . $this->Name . '=' . md5( $this->owner->Name . '.' . $this->Name );

        if( ( $this->ControlState & csDesigning ) == csDesigning )
            $vars[ 'SRC' ] = 'url.php' . $querystring;
        else
            $vars[ 'SRC' ] = $_SERVER[ 'PHP_SELF' ] . $querystring;

        echo( $this->generateComponentSectionCode( 'image', $vars ) );
    }

    protected function dumpBlobImage()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_onpaint )
        {
            $this->_Canvas = new JTPHPCanvas( $this->Width, $this->Height );

            $this->callEvent( 'onpaint', array() );

            ob_start();

            switch( $this->_ImageType )
            {
                case itPNG:
                    $imageType = 'image/png';
                    $this->_Canvas->PNG();
                    break;

                case itJPG:
                    $imageType = 'image/jpeg';
                    $this->_Canvas->JPEG();
                    break;

                case itGIF:
                    $imageType = 'image/gif';
                    $this->_Canvas->GIF();
                    break;
            }

            $imageContents = ob_get_clean();
        }
        else
        {
            // If the OnPaint event is null, we need to return a transparent GIF file.
            $ptr = imagecreatetruecolor( 1, 1 );
            $color = imagecolorallocate( $ptr, 0, 0, 0 );
            imagecolortransparent( $ptr, $trans_color );

            ob_start();

            imagegif( $ptr );

            $imageContents = ob_get_clean();

            imagedestroy( $ptr );

            $imageType = 'image/gif';
        }

        header( 'Content-type: ' . $imageType );
        header( 'Content-length: ' . strlen( $imageContents ) );

        echo( $imageContents );

        exit;
    }

    function readCanvas()
    {
        return $this->_Canvas;
    }

    function getImageType()
    {
        return $this->_ImageType;
    }

    function setImageType( $value )
    {
        $this->_ImageType = $value;
    }

    function defaultImageType()
    {
        return itPNG;
    }

    function getOnPaint()
    {
        return $this->_onpaint;
    }

    function setOnPaint( $value )
    {
        $this->_onpaint = $value;
    }

    function defaultOnPaint()
    {
        return null;
    }
}
?>