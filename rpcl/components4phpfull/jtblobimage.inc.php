<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                  -- Database blob image component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( dirname( __FILE__ ) . "/../../vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "dbtables.inc.php" );

class JTBlobImage extends JTThemedGraphicControl
{
    protected $_AltText = '';
    protected $_AltField = '';
    protected $_Database = null;
    protected $_datasource = null;
    protected $_datafield = '';
    protected $_KeyDataSource = null;
    protected $_KeyField = '';
    protected $_KeyValue = '';
    protected $_ImageKeyField = '';
    protected $_ImageTypeField = '';
    protected $_ImageTableName = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatabase( $this->_Database );
        $this->setDataSource( $this->_datasource );
        $this->setKeyDataSource( $this->_KeyDataSource );
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

    function dumpFromRequest( $sessionData )
    {
        $dbType = $sessionData[ 'DbType' ];

        $owner = new JTBlobImageFakeOwner( $sessionData[ 'DbPath' ] );

        $this->_Database = new $dbType( $owner );
        $this->_Database->Name = $sessionData[ 'DbName' ];

        $this->_Database->unserialize();

        $this->_KeyField = $sessionData[ 'KeyField' ];
        $this->_datafield = $sessionData[ 'ImgField' ];
        $this->_ImageTypeField = $sessionData[ 'ImgTypeField' ];
        $this->_ImageKeyField = $sessionData[ 'ImgKeyField' ];
        $this->_ImageTableName = $sessionData[ 'ImgTable' ];

        $this->dumpBlobImage();
    }

    protected function dumpThemedContents()
    {
        $vars = array();

        // Validate all settings.
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( !$this->_datafield )
                throw new Exception( $this->Name . "->DataField property empty." );

            if( !$this->_datasource && !$this->_Database )
                throw new Exception( $this->Name . "->DataSource or " . $this->Name . "->Database must be set." );

            if( $this->_Database )
            {
                if( ( !$this->_KeyDataSource || !$this->_KeyField ) && strlen( $this->_KeyValue ) == 0 )
                    throw new Exception( $this->Name . "->KeyDataSource/KeyField or KeyValue properties must be set." );

                if( !$this->_ImageTableName )
                    throw new Exception( $this->Name . "->ImageTableName property empty." );
            }
        }

        // Determine the key to use.
        $id = '';

        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( !$this->_datasource )
            {
                if( $this->_KeyValue )
                {
                    $id = $this->_KeyValue;
                }
                else
                {
                    if( !isset( $this->_KeyDataSource->DataSet->Fields[ $this->_KeyField ] ) )
                        throw new Exception( "Failed to locate KeyField '{$this->_KeyField}' in KeyDataSource for {$this->Name}." );

                    $id = $this->_KeyDataSource->DataSet->Fields[ $this->_KeyField ];
                }
            }
        }
        else
        {
            $id = 'Databound';
        }

        $imageKeyField = $this->_ImageKeyField ? $this->_ImageKeyField : $this->_KeyField;

        // Retrieve the alt value.
        $vars[ 'ALT' ] = $this->retrieveAltValue( $id );

        $key = md5( $this->owner->Name . '.' . $this->Name );

        $querystring = '?' . $this->Name . '=' . $key;

        if( $this->_Database && ( $this->ControlState & csDesigning ) != csDesigning )
        {
            $_SESSION[ $key ] = array(
                'DbType'        => $this->_Database->className(),
                'DbName'        => $this->_Database->Name,
                'DbPath'        => $this->_Database->readOwner()->readNamePath(),
                'KeyField'      => $this->_KeyField,
                'ImgField'      => $this->_datafield,
                'ImgTypeField'  => $this->_ImageTypeField,
                'ImgKeyField'   => $this->_ImageKeyField,
                'ImgTable'      => $this->_ImageTableName,
            );

            $querystring .= '&JTBlobImage=' . $key;
        }

        if( strlen( $id ) )
            $querystring .= '&id=' . urlencode( $id );

        if( ( $this->ControlState & csDesigning ) == csDesigning )
        {
            $url = 'url.php';
        }
        else
        {
            if( $this->_Database )
            {
                $url = GetJTPHPWebPath() . 'jtblobimage.inc.php';
            }
            else
            {
                $url = $_SERVER[ 'PHP_SELF' ];
            }
        }

        $vars[ 'SRC' ] = $url . $querystring;

        if( $this->JsOnClick )
            $vars[ 'EVENTS' ] = ' onclick="' . $this->JsOnClick . '(event)"';
        else
            $vars[ 'EVENTS' ] = '';

        echo( $this->generateComponentSectionCode( 'image', $vars ) );
    }

    protected function retrieveAltValue( $id )
    {
        if( $this->_AltField )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                if( $this->_datasource )
                {
                    $result = $this->_datasource->DataSet->Fields[ $this->_AltField ];
                }
                else
                {
                    $queryObject = new Query();
                    $queryObject->Database = ( $this->_Database ? $this->_Database : $this->_KeyDataSource->DataSet->Database );

                    $queryObject->LimitCount = 1;
                    $queryObject->LimitStart = 0;
                    $queryObject->SQL =
                        'SELECT ' . $this->_AltField . ' FROM ' . $this->_ImageTableName . ' ' .
                        'WHERE ' . ( $this->_ImageKeyField ? $this->_ImageKeyField : $this->_KeyField ) . ' = ?';
                    $queryObject->Params = array( $id );
                    $queryObject->Open();

                    $result = $queryObject->Fields[ $this->_AltField ];

                    $queryObject->Close();
                    $queryObject = null;
                }
            }
            else
            {
                $result = '<Databound>';
            }
        }
        else
        {
            $result = $this->_AltText;
        }

        return $result;
    }

    protected function dumpBlobImage()
    {
        $id = $_GET[ 'id' ];

        if( ( $this->ControlState & csDesigning ) != csDesigning && ( $this->_datasource || strlen( $id ) ) )
        {
            list( $image, $imagetype ) = $this->retrieveBlobImage( $id );

            $this->dumpImageData( $image, $imagetype );
        }
        else
        {
            header( 'HTTP/1.0 404 Not Found' );

            echo( "<p>404 Not Found</p>\r\n" );
        }

        die;
    }

    protected function retrieveBlobImage( $id )
    {
        try
        {
            $imagetype = '';

            if( $this->_datasource )
            {
                $image = $this->_datasource->DataSet->Fields[ $this->_datafield ];
                if( is_object( $image ) && get_class( $image ) == 'OCI-Lob' )
                    $image = $image->load();

                if( $this->_ImageTypeField )
                    $imagetype = $this->_datasource->DataSet->Fields[ $this->_ImageTypeField ];
            }
            else
            {
                $query = 'SELECT ' . $this->_datafield;

                if( $this->_ImageTypeField )
                    $query .= ',' . $this->_ImageTypeField;

                $query .=
                    ' FROM ' . $this->_ImageTableName .
                    ' WHERE ' . ( $this->_ImageKeyField ? $this->_ImageKeyField : $this->_KeyField ) . ' = ?';

                $queryObject = new Query();
                $queryObject->Database = ( $this->_Database ? $this->_Database : $this->_KeyDataSource->DataSet->Database );
                $queryObject->LimitCount = 1;
                $queryObject->LimitStart = 0;
                $queryObject->SQL = $query;
                $queryObject->Params = array( $id );
                $queryObject->Open();

                $image = $queryObject->Fields[ $this->_datafield ];
                if( is_object( $image ) && get_class( $image ) == 'OCI-Lob' )
                    $image = $image->load();

                if( $this->_ImageTypeField )
                    $imagetype = $queryObject->Fields[ $this->_ImageTypeField ];

                $queryObject->Close();
                $queryObject = null;
            }
        }
        catch( Exception $e )
        {
            $image = '';
            $imagetype = 'image/png';

            $ptr = imagecreatetruecolor( $this->Width, $this->Height );
            $backColor = imagecolorallocate( $ptr, 255, 255, 255 );
            $textColor = imagecolorallocate( $ptr, 0, 0, 0 );
            imagefilledrectangle( $ptr, 0, 0, $this->Width, $this->Height, $backColor );

            $fontWidth = imagefontwidth( 2 );
            $fontHeight = imagefontheight( 2 );
            $maxCharsPerLine = floor( $this->Width / $fontWidth );
            $text = wordwrap( (string)$e, $maxCharsPerLine, "\n", true );
            $lines = explode( "\n", $text );
            $y = 0;
            foreach( $lines as $line )
            {
                imagestring( $ptr, 2, 0, $y, trim( $line ), $textColor );
                $y += $fontHeight;
            }

            ob_start();

            imagepng( $ptr );

            $image = ob_get_clean();

            imagedestroy( $ptr );
        }

        return array( $image, $imagetype );
    }

    protected function dumpImageData( $image, $imagetype )
    {
        if( strlen( $image ) == 0 )
        {
            // If the blob field is empty, we need to return a transparent GIF file.
            $ptr = imagecreatetruecolor( 1, 1 );
            $color = imagecolorallocate( $ptr, 0, 0, 0 );
            imagecolortransparent( $ptr, $trans_color );

            ob_start();

            imagegif( $ptr );

            $image = ob_get_clean();

            imagedestroy( $ptr );

            $imagetype = 'image/gif';
        }
        else
        {
            if( empty( $imagetype ) )
            {
                // Determine image type.
                if( substr( $image, 0, 3 ) == 'GIF' )
                    $imagetype = 'image/gif';
                else if( substr( $image, 0, 4 ) == "\x89PNG" )
                    $imagetype = 'image/png';
                else
                    $imagetype = 'image/jpeg';
            }
        }

        header( 'Content-type: ' . $imagetype );
        header( 'Content-length: ' . strlen( $image ) );

        echo( $image );
    }

    protected function quoteStr( $v )
    {
        if( !is_numeric( $v ) )
            $v = "'" . addslashes( $v ) . "'";

        return $v;
    }

    function getAltField()
    {
        return $this->_AltField;
    }

    function setAltField( $value )
    {
        $this->_AltField = $value;
    }

    function defaultAltField()
    {
        return '';
    }

    function getAltText()
    {
        return $this->_AltText;
    }

    function setAltText( $value )
    {
        $this->_AltText = $value;
    }

    function defaultAltText()
    {
        return '';
    }

    function getDatabase()
    {
        return $this->_Database;
    }

    function setDatabase( $value )
    {
        $this->_Database = $this->fixupPropertyAndCheck( $value, 'Database' );
    }

    function defaultDatabase()
    {
        return null;
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

    function getKeyDataSource()
    {
        return $this->_KeyDataSource;
    }

    function setKeyDataSource( $value )
    {
        $this->_KeyDataSource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultKeyDataSource()
    {
        return null;
    }

    function getKeyField()
    {
        return $this->_KeyField;
    }

    function setKeyField( $value )
    {
        $this->_KeyField = $value;
    }

    function defaultKeyField()
    {
        return '';
    }

    function getKeyValue()
    {
        return $this->_KeyValue;
    }

    function setKeyValue( $value )
    {
        $this->_KeyValue = $value;
    }

    function defaultKeyValue()
    {
        return '';
    }

    function getImageKeyField()
    {
        return $this->_ImageKeyField;
    }

    function setImageKeyField( $value )
    {
        $this->_ImageKeyField = $value;
    }

    function defaultImageKeyField()
    {
        return '';
    }

    function getImageTypeField()
    {
        return $this->_ImageTypeField;
    }

    function setImageTypeField( $value )
    {
        $this->_ImageTypeField = $value;
    }

    function defaultImageTypeField()
    {
        return '';
    }

    function getImageTableName()
    {
        return $this->_ImageTableName;
    }

    function setImageTableName( $value )
    {
        $this->_ImageTableName = $value;
    }

    function defaultImageTableName()
    {
        return '';
    }

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
    }
}

class JTBlobImageFakeOwner extends Component
{
    private $_Path;

    function __construct( $path )
    {
        parent::__construct( null );

        $this->_Path = $path;
    }

    function readNamePath()
    {
        return $this->_Path;
    }
}

if( isset( $_SERVER[ 'SCRIPT_FILENAME' ] ) && strcasecmp( basename( $_SERVER[ 'SCRIPT_FILENAME' ] ), 'jtblobimage.inc.php' ) == 0 )
{
    if( isset( $_GET[ 'JTBlobImage' ] ) )
    {
        $key = $_GET[ 'JTBlobImage' ];

        session_start();

        if( isset( $_SESSION[ $key ] ) )
        {
            $data = $_SESSION[ $key ];

            $blobImage = new JTBlobImage( null );
            $blobImage->dumpFromRequest( $data );
        }
    }
}