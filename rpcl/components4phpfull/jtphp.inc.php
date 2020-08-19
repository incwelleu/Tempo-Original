<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                         -- Common Functions --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once( "vcl/vcl.inc.php" );

define( 'JT_NO_SITETHEME_MESSAGE', 'JTSiteTheme component needs to be added to this page.' );

if( defined( 'RPCL_FS_PATH' ) && !defined( 'VCL_FS_PATH' ) )
    define( 'VCL_FS_PATH', RPCL_FS_PATH );

if( defined( 'RPCL_HTTP_PATH' ) && !defined( 'VCL_HTTP_PATH' ) )
    define( 'VCL_HTTP_PATH', RPCL_HTTP_PATH );

function GetJTPHPPath()
{
    $path = VCL_FS_PATH;
    if( !empty( $path ) && $path[ strlen( $path ) - 1 ] != '/' )
        $path .= '/';

    return $path . 'components4phpfull/';
}

function GetJTPHPWebPath()
{
    $path = VCL_HTTP_PATH;
    if( !empty( $path ) && $path[ strlen( $path ) - 1 ] != '/' )
        $path .= '/';

    return $path . 'components4phpfull/';
}

function GetJTFontString( $font )
{
    $style = '';

    if( $font->Family )
        $style .= ' font-family: ' . $font->Family . ';';

    if( strlen( $font->Size ) )
        $style .= ' font-size: ' . $font->Size . ';';

    if( $font->Color )
        $style .= ' color: ' . $font->Color . ';';

    if( $font->Weight )
        $style .= ' font-weight: ' . $font->Weight . ';';

    if( $font->LineHeight )
        $style .= ' line-height: ' . $font->LineHeight . ';';

    switch( $font->Align )
    {
        case taLeft: $style .= " text-align: left;"; break;
        case taRight: $style .= " text-align: right;"; break;
        case taCenter: $style .= " text-align: center;"; break;
        case taJustify: $style .= " text-align: justify;"; break;
    }

    switch( $font->Style )
    {
        case fsNormal: $style .= " font-style: normal;"; break;
        case fsItalic: $style .= " font-style: italic;"; break;
        case fsOblique: $style .= " font-style: oblique;"; break;
    }

    switch( $font->Variant )
    {
        case vaNormal: $style .= " font-variant: normal;"; break;
        case vaSmallCaps: $style .= " font-variant: small-caps;"; break;
    }

    switch( $font->Case )
    {
        case caCapitalize: $style .= " text-transform: capitalize;"; break;
        case caUpperCase: $style .= " text-transform: uppercase;"; break;
        case caLowerCase: $style .= " text-transform: lowercase;"; break;
        case caNone: $style .= " text-transform: none;"; break;
    }

    return trim( $style );
}

function GetJTJSFontString( $font )
{
    $result = 'new JTJSFont( "' . $font->Family . '", "' . $font->Size . '", "' . $font->Color . '", "' . $font->Weight . '", "' . $font->LineHeight . '", "';

    switch( $font->Align )
    {
        case taLeft: $result .= 'left'; break;
        case taRight: $result .= 'right'; break;
        case taCenter: $result .= 'center'; break;
        case taJustify: $result .= 'justify'; break;
    }

    $result .= '", "';

    switch( $font->Style )
    {
        case fsNormal: $result .= 'normal;'; break;
        case fsItalic: $result .= 'italic;'; break;
        case fsOblique: $result .= 'oblique;'; break;
    }

    $result .= '", "';

    switch( $font->Variant )
    {
        case vaNormal: $result .= 'normal'; break;
        case vaSmallCaps: $result .= 'small-caps'; break;
    }

    $result .= '", "';

    switch( $font->Case )
    {
        case caCapitalize: $result .= 'capitalize'; break;
        case caUpperCase: $result .= 'uppercase'; break;
        case caLowerCase: $result .= 'lowercase'; break;
        case caNone: $result .= 'none'; break;
    }

    $result .= '" )';

    return $result;
}

function GetJTJSBoolean( $value )
{
    if( $value )
        return "true";
    else
        return "false";
}

function GetJTJSEventToString( $value )
{
    if( $value )
        return $value;
    else
        return 'null';
}

function GetJTUserIP()
{
    return $_SERVER[ 'REMOTE_ADDR' ];
}

function JTObjectPropertyFixupAndCheck( $instance, $value, $type )
{
    $result = $instance->fixupProperty( $value );

    if( ( $instance->ControlState & csDesigning ) != csDesigning && is_object( $result ) )
    {
        if( !$result->inheritsFrom( $type ) )
            throw new Exception( $instance->Name . ' property type mismatch, expected ' . $type . ', received ' . get_class( $result ) );
    }

    return $result;
}

function JTForceTimeZone()
{
	$errorHandler = set_error_handler( "JTNullErrorHandler" );

    date_default_timezone_set( @date_default_timezone_get() );

	set_error_handler( $errorHandler );
}

function JTNullErrorHandler($errno, $errstr, $errfile, $errline)
{
	return true;
}

JTForceTimeZone();
//-------------------------------------------------------------------
// Debug Logging system.
//-------------------------------------------------------------------
global $jtLogFileHandle;

$jtLogFileHandle = false;

register_shutdown_function( 'jtCloseLogFile' );

function jtWriteLog( $msg )
{
    global $jtLogFileHandle;

    if( $jtLogFileHandle === false )
    {
        $filename = GetJTPHPPath() . 'jtlog' . getmypid() . '.log';

        $jtLogFileHandle = fopen( $filename, 'ab' );

        fwrite( $jtLogFileHandle, "--- Begin Request " . ( isset( $_SERVER[ 'REQUEST_URI' ] ) ? "'" . $_SERVER[ 'REQUEST_URI' ] . "'" : '' ) . "---\r\n" );
    }

    $str = date( 'm/d/Y H:i:s' ) . ": $msg\r\n";

    fwrite( $jtLogFileHandle, $str );
}

function jtCloseLogFile()
{
    global $jtLogFileHandle;

    if( $jtLogFileHandle !== false )
    {
        fwrite( $jtLogFileHandle, "\r\n\r\n" );
        fclose( $jtLogFileHandle );
    }
}
?>
