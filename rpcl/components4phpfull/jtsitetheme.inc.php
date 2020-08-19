<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Site Theme component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once( "vcl/vcl.inc.php" );

use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );
use_unit( "components4phpfull/jtphp.inc.php" );
use_unit( "components4phpfull/jtfont.inc.php" );
use_unit( "components4phpfull/jtlayout.inc.php" );
use_unit( "components4phpfull/jtthemedgraphiccontrol.inc.php" );
use_unit( "components4phpfull/jtthemedcustompanel.inc.php" );

global $JTSiteThemeGlobalInstance;

$JTSiteThemeGlobalInstance = null;

class JTSiteTheme extends Component
{
    // Loaded theme directory.
    protected $_ThemeDir;
    protected $_ThemeWebDir;

    protected $HasDumpedJS = false;
    protected $ComponentJSCode = array();
    protected $AfterSiteThemeJS = '';

    // Currently loaded control theme info.
    protected $_ComponentThemes = array();

    // Currently loaded language file.
    protected $_LangStrings = array();

    // Properties
    protected $_LanguageFile = 'english';
    protected $_Theme = 'default';

    function __construct( $aowner = null )
    {
        global $JTSiteThemeGlobalInstance;

        parent::__construct( $aowner );

        $JTSiteThemeGlobalInstance = $this;
    }

    function __destruct()
    {
    }

    function loaded()
    {
        parent::loaded();

        $this->setTheme( $this->_Theme );
        $this->setLanguageFile( $this->_LanguageFile );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        if( !defined( 'JTSITETHEME' ) )
        {
            if( !defined( 'JT_USESPLITCSS' ) )
            {
                if( file_exists( GetJTPHPPath() . 'themes/common/merged.css' ) )
                    print( "<link href=\"" . GetJTPHPWebPath() . "themes/common/merged.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n" );

                if( file_exists( $this->_ThemeDir . 'merged.css' ) )
                    print( "<link href=\"" . $this->_ThemeWebDir . "merged.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n" );
            }
            else
            {
                print( $this->generateComponentCSSCode( 'sitetheme' ) );
            }

            if( !defined( 'JQUERY' ) && ( !defined( 'JQUERY_FILE' ) || ( $this->ControlState & csDesigning ) == csDesigning ) )
            {
                define( 'JQUERY', 1 );
                /*
                print( "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . VCL_HTTP_PATH . "/jquery/jquery.js\"></script>\r\n" );
                */
                print( "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . GetJTPHPWebPath() . "themes/common/jquery-1.4.2.min.js\"></script>\r\n" );

                if( defined( 'QOOXDOO' ) )
                {
                    echo( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
                    echo( "jQuery.noConflict();\r\n" );
                    echo( "</script>\r\n" );
                }
            }

            if( file_exists( GetJTPHPPath() . 'themes/common/scripts.js' ) )
                print( "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . GetJTPHPWebPath() . 'themes/common/' . "scripts.js\"></script>\r\n" );

            if( file_exists( $this->_ThemeDir . 'scripts.js' ) )
                print( "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . $this->_ThemeWebDir . "scripts.js\"></script>\r\n" );

            define( 'JTSITETHEME', 1 );

            echo( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
            echo( "var JTThemeWebDir = \"" . $this->_ThemeWebDir . "\";\r\n" );
            echo( "</script>\r\n" );
        }

        foreach( $this->ComponentJSCode as $code )
            print( $code );

        if( $this->AfterSiteThemeJS )
        {
            echo( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
            echo( $this->AfterSiteThemeJS );
            echo( "</script>\r\n" );
        }

        $this->HasDumpedJS = true;
    }

    function loadComponentTheme( $class )
    {
        if( !array_key_exists( $class, $this->_ComponentThemes ) )
        {
            if( file_exists( $this->_ThemeDir . $class . '.xml' ) )
                $themefile = $this->_ThemeDir . $class . '.xml';
            else
                $themefile = GetJTPHPPath() . 'themes/common/' . $class . '.xml';

            $parser = new JTSiteThemeComponentThemeParser();

            if( !$parser->parseComponentTheme( $themefile ) )
                return false;

            $this->_ComponentThemes[ $class ] = $parser->getComponentTheme();
        }

        return true;
    }

    function generatePageCSSCode()
    {
        return "<link href=\"" . $this->_ThemeWebDir . "page_styles.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
    }

    function generateComponentCSSCode( $object )
    {
        if( !defined( "JTCSSSTYLE_$object" ) && ( defined( 'JT_USESPLITCSS' ) || ( $this->ControlState & csDesigning ) == csDesigning ) )
        {
            $data = '';

            if( ( $this->ControlState & csDesigning ) == csDesigning && $object != 'sitetheme' )
                $data .= $this->generateComponentCSSCode( 'sitetheme' );

            if( file_exists( GetJTPHPPath() . 'themes/common/' . $object . "styles.css" ) )
                $data .= "<link href=\"" . GetJTPHPWebPath() . 'themes/common/' . $object . "styles.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";

            if( file_exists( $this->_ThemeDir . $object . 'styles.css' ) )
                $data .= "<link href=\"" . $this->_ThemeWebDir . $object . "styles.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n";

            define( "JTCSSSTYLE_$object", 1 );
        }
        else
        {
            $data = '';
        }

        return $data;
    }

    function addComponentJSCode( $object )
    {
        $data = '';

        if( !defined( "JTJS_$object" ) )
        {
            if( file_exists( GetJTPHPPath() . 'themes/common/' . $object . ".js" ) )
                $data .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . GetJTPHPWebPath() . 'themes/common/' . $object . ".js\"></script>\r\n";

            if( file_exists( $this->_ThemeDir . $object . ".js" ) )
                $data .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . $this->_ThemeWebDir . $object . ".js\"></script>\r\n";

            define( "JTJS_$object", 1 );
        }

        if( $this->HasDumpedJS )
            print( $data );
        else
            $this->ComponentJSCode[] = $data;
    }

    function addAfterSiteThemeJS( $code )
    {
        if( $this->HasDumpedJS )
        {
            echo( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
            echo( $code );
            echo( "</script>\r\n" );
        }
        else
        {
            $this->AfterSiteThemeJS .= $code . "\r\n";
        }
    }

    function generateComponentSectionCode( $component, $section, $vars )
    {
        $class = get_class( $component );
        $skin = $component->getSkin();

        return $this->generateSectionCode( $class, $skin, $section, $vars );
    }

    function generateSectionCode( $class, $skin, $section, $vars )
    {
        if( !array_key_exists( $class, $this->_ComponentThemes ) ||
            !array_key_exists( $skin, $this->_ComponentThemes[ $class ]->Skins ) ||
            !array_key_exists( $section, $this->_ComponentThemes[ $class ]->Skins[ $skin ]->SkinCodeSections ) )
            return '';

        $code = $this->_ComponentThemes[ $class ]->Skins[ $skin ]->SkinCodeSections[ $section ];

        $vars[ 'THEMEWEBDIR' ] = $this->_ThemeWebDir;

        if( strpos( $code, '{$Str' ) !== false )
            $code = preg_replace( '/\{\$Str([a-z]+)\}/ei',
                '( isset( $this->_LangStrings[\'$1\'] ) ? $this->_LangStrings[\'$1\'] : \'$1\')', $code );

        foreach( $vars as $k => $v )
            $code = str_replace( '{$' . $k . '}', $v, $code );

        return $code;
    }

    function retrieveSetting( $component, $name )
    {
        $class = get_class( $component );
        $skin = $component->Skin;

        if( array_key_exists( $class, $this->_ComponentThemes ) )
        {
            if( array_key_exists( $skin, $this->_ComponentThemes[ $class ]->Skins ) && array_key_exists( $name, $this->_ComponentThemes[ $class ]->Skins[ $skin ]->SkinSettings ) )
                return $this->_ComponentThemes[ $class ]->Skins[ $skin ]->SkinSettings[ $name ];

            if( array_key_exists( $name, $this->_ComponentThemes[ $class ]->GlobalSettings ) )
                return $this->_ComponentThemes[ $class ]->GlobalSettings[ $name ];
        }

        return '';
    }

    function retrieveString( $name )
    {
        return ( isset( $this->_LangStrings[ $name ] ) ? $this->_LangStrings[ $name ] : $name );
    }

    static function PrintNoSiteTheme( $width, $height, $error = '' )
    {
        if( strlen( $width ) && $width{ strlen( $width ) - 1 } != '%' )
            $width .= 'px';

        if( strlen( $height ) && $height{ strlen( $height ) - 1 } != '%' )
            $height .= 'px';

        print( "<table style=\"width: " . $width . "; height: " . $height . "; background-color: #CC0000;\"><tr><td align=\"center\" valign=\"center\" style=\"font-family: Tahoma,Verdana,Geneva,Arial,Helvetica,sans-serif; font-size: 8pt; color: white;\">Error rendering component! $error</td></tr></table>" );
    }

    protected function loadTheme()
    {
        $themefile = GetJTPHPPath() . 'themes/';

        if( empty( $this->_Theme ) )
            $themefile .= 'default';
        else
            $themefile .= $this->_Theme;

        $themefile .= '/';

        if( !file_exists( $themefile ) )
            return false;

        $this->_ThemeDir = $themefile;

        $themefile = GetJTPHPWebPath() . 'themes/';

        if( empty( $this->_Theme ) )
            $themefile .= 'default';
        else
            $themefile .= $this->_Theme;

        $themefile .= '/';

        $this->_ThemeWebDir = $themefile;

        if( count( $this->_LangStrings ) == 0 )
            $this->loadLanguage();

        return true;
    }

    protected function loadLanguage()
    {
        if( $this->_LanguageFile == '' || $this->_LanguageFile == '(default)' )
            $this->_LanguageFile = 'english';

        $langFile = GetJTPHPPath() . 'languages/' . $this->_LanguageFile . '.txt';
        if( !file_exists( $langFile ) )
            throw new Exception( "Language file $langFile does not exist." );

        $this->_LangStrings = array();

        $strings = file( $langFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
        foreach( $strings as $line )
        {
            list( $name, $value ) = explode( '=', trim( $line ), 2 );
            // echo( "<!-- $name = $value -->\r\n" );
            $this->_LangStrings[ $name ] = $value;
        }
    }

    function getLanguageFile()
    {
        return $this->_LanguageFile;
    }

    function setLanguageFile( $value )
    {
        $this->_LanguageFile = $value;
        $this->loadLanguage();
    }

    function defaultLanguageFile()
    {
        return 'english';
    }

    function getTheme()
    {
        return $this->_Theme;
    }

    function setTheme( $value )
    {
        $oldtheme = $this->_Theme;

        $this->_Theme = $value;

        if( !$this->loadTheme() )
        {
            $this->_Theme = $oldtheme;
        }
    }

    function defaultTheme()
    {
        return 'default';
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

    function readThemeDir()
    {
        return $this->_ThemeWebDir;
    }

    function readThemeImagesDir()
    {
        return $this->_ThemeWebDir . 'images';
    }
}

class JTSiteThemeComponentTheme
{
    public $Skins = array();
    public $GlobalSettings = array();
}

class JTSiteThemeComponentSkin
{
    public $SkinCodeSections = array();
    public $SkinSettings = array();
}

class JTSiteThemeComponentThemeParser
{
    private $_ComponentTheme = null;
    private $_CurrentSkin = null;
    private $_CurrentCodeID = '';
    private $_CurrentCode = '';

    function __construct()
    {
    }

    function parseComponentTheme( $classfile )
    {
        $this->_ComponentTheme = new JTSiteThemeComponentTheme();

        $xml_parser = xml_parser_create();

        xml_set_element_handler( $xml_parser, array( $this, 'startElement' ), array( $this, 'endElement' ) );
        xml_set_character_data_handler( $xml_parser, array( $this, 'charData' ) );

        $result = true;

        $fp = @fopen( $classfile, 'rb' );
        if( $fp )
        {
            while( $data = fread( $fp, 262144 ) )
            {
                if( !xml_parse( $xml_parser, $data, feof( $fp ) ) )
                {
                    printf( "XML error parsing $classfile: %s at line %d", xml_error_string( xml_get_error_code( $xml_parser ) ), xml_get_current_line_number( $xml_parser ) );

                    $result = false;
                    break;
                }
            }

            fclose( $fp );
        }
        else
        {
            $result = false;
        }

        xml_parser_free( $xml_parser );

        return $result;
    }

    function getComponentTheme()
    {
        return $this->_ComponentTheme;
    }

    private function startElement( $parser, $tagname, $attribs )
    {
        if( $tagname == 'SKIN' )
        {
            $skinid = $attribs[ 'ID' ];
            if( strlen( $skinid ) == 0 )
                $skinid = 'default';

            $this->_CurrentSkin = new JTSiteThemeComponentSkin();

            $this->_ComponentTheme->Skins[ $skinid ] = $this->_CurrentSkin;
        }
        else if( $tagname == 'SETTING' )
        {
            if( $this->_CurrentSkin )
                $this->_CurrentSkin->SkinSettings[ $attribs[ 'NAME' ] ] = $attribs[ 'VALUE' ];
            else
                $this->_ComponentTheme->GlobalSettings[ $attribs[ 'NAME' ] ] = $attribs[ 'VALUE' ];
        }
        else if( $tagname == 'CODE' && $this->_CurrentSkin )
        {
            $this->_CurrentCodeID = $attribs[ 'ID' ];
            $this->_CurrentCode = '';
        }
    }

    private function endElement( $parser, $tagname )
    {
        if( $tagname == 'SKIN' )
        {
            $this->_CurrentSkin = null;
        }
        else if( $tagname == 'CODE' )
        {
            $code = $this->_CurrentCode;
            $i = strpos( $code, "\r\n" );
            if( $i !== false )
                $code = substr( $code, $i + 2 );
            $i = strrpos( $code, "\r\n" );
            if( $i !== false )
                $code = substr( $code, 0, $i );

            $this->_CurrentSkin->SkinCodeSections[ $this->_CurrentCodeID ] = trim( $code );

            $this->_CurrentCodeID = '';
            $this->_CurrentCode = '';
        }
    }

    private function charData( $parser, $data )
    {
        $this->_CurrentCode .= $data;
    }
}
?>
