<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      --  Ad-rotator component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTAdRotator extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_UrlField = '';
    protected $_ImageSourceField = '';
    protected $_HintField = '';
    protected $_ongetadvertisment = null;

    protected $_NextAdUrl = '';
    protected $_NextAdImg = '';
    protected $_NextAdHint = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 468;
        $this->Height = 60;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function init()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( $this->_datasource && $this->_UrlField && $this->_ImageSourceField )
            {
                $this->_datasource->DataSet->First();

                $this->_NextAdUrl = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_UrlField ];
                $this->_NextAdImg = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_ImageSourceField ];

                if( $this->_HintField )
                    $this->_NextAdHint = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_HintField ];

                $safe_namepath = str_replace( '.', '_', $this->NamePath );

                $lastad = $_COOKIE[ $safe_namepath ];
                if( !empty( $lastad ) )
                {
                    for( ; !$this->_datasource->DataSet->EOF; $this->_datasource->DataSet->Next() )
                    {
                        if( $this->_datasource->DataSet->AssociativeFieldValues[ $this->_ImageSourceField ] == $lastad )
                            break;
                    }

                    $this->_datasource->DataSet->Next();

                    if( !$this->_datasource->DataSet->EOF )
                    {
                        $this->_NextAdUrl = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_UrlField ];
                        $this->_NextAdImg = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_ImageSourceField ];

                        if( $this->_HintField )
                            $this->_NextAdHint = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_HintField ];
                    }
                }

                setcookie( $safe_namepath, '', time() - 1000, '/' );
                setcookie( $safe_namepath, $this->_NextAdImg, time() + 60 * 60 * 24 * 30, '/' );
            }
        }
    }

    protected function dumpThemedContents()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( $this->_ongetadvertisment )
            {
                $params = array(
                    'URL'       => $this->_NextAdUrl,
                    'Image'     => $this->_NextAdImg,
                    'Hint'      => $this->_NextAdHint,
                );

                $this->callEvent( 'ongetadvertisment', $params );
            }

            $vars = array(
                'ADURL'         => $this->_NextAdUrl,
                'ADIMAGESRC'    => $this->_NextAdImg,
                'ADHINT'        => $this->_NextAdHint,
            );

            print( $this->generateComponentSectionCode( 'ad', $vars ) );
        }
        else
        {
?>
<div id="<?php print( $this->Name ); ?>" style="width: <?php print( $this->Width ); ?>px; height: <?php print( $this->Height ); ?>px; border: dotted 1px black;">
  <!-- Design-time HTML code only -->
  <table border="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="center">Advertisment</td>
    </tr>
  </table>
</div>
<?php
        }
    }

    function SetNextAd( $url, $imagesrc, $hint = '' )
    {
        $this->_NextAdUrl = $url;
        $this->_NextAdImg = $imagesrc;
        $this->_NextAdHint = $hint;
    }

    function getHelp()
    {
        return get_class( $this );
    }

    function setHelp( $value )
    {
    }

    function defaultHelp()
    {
        return get_class( $this );
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getUrlField()
    {
        return $this->_UrlField;
    }

    function setUrlField( $value )
    {
        $this->_UrlField = $value;
    }

    function defaultUrlField()
    {
        return '';
    }

    function getImageSourceField()
    {
        return $this->_ImageSourceField;
    }

    function setImageSourceField( $value )
    {
        $this->_ImageSourceField = $value;
    }

    function defaultImageSourceField()
    {
        return '';
    }

    function getHintField()
    {
        return $this->_HintField;
    }

    function setHintField( $value )
    {
        $this->_HintField = $value;
    }

    function defaultHintField()
    {
        return '';
    }

    function getOnGetAdvertisment()
    {
        return $this->_ongetadvertisment;
    }

    function setOnGetAdvertisment( $value )
    {
        $this->_ongetadvertisment = $value;
    }
}
?>
