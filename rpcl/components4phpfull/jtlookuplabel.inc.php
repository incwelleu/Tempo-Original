<?php
require_once("vcl/vcl.inc.php");
//Includes
use_unit("components4phpfull/jtlabel.inc.php");

//Class definition
class JTLookupLabel extends JTLabel
{
    protected $_ValueField = '';
    protected $_ValueKeyField = '';
    protected $_ValueTable = '';
    protected $_Database;

    function __construct($aowner = null)
    {
        parent::__construct($aowner);
    }

    function dumpContents()
    {
        parent::dumpContents();
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatabase( $this->_Database );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " $style";

        if( $this->_Datasource && strlen( $this->_DataField ) && strlen( $this->_ValueField ) && strlen( $this->_ValueTable ) )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $query = new Query();
                $query->Database = $this->_Database;
                $query->SQL = "SELECT $this->_ValueField FROM $this->_ValueTable WHERE $this->_ValueKeyField=?";
                $query->Params = array($this->_Datasource->DataSet->Fields[$this->_DataField]);
                $query->Open();

                $content = $query->Fields[ $this->_ValueField ];
            }
            else
            {
                $content = $this->_Caption;
            }
        }
        else
        {
            $content = $this->_Caption;
        }

        if( $this->_Datasource && strlen( $this->_LinkField ) )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $linkfield = $this->_LinkField;

                $link = $this->_Datasource->DataSet->$linkfield;
            }
            else
            {
                $link = '';
            }
        }
        else if( $this->_Link )
        {
            $link = $this->_Link;
        }
        else
        {
            $link = '';
        }

        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        if( strlen( $link ) )
        {
            $vars = array(
                'LINK'      => $link,
                'CONTENT'   => $content,
                'TABINDEX'  => $tabindex,
            );

            $content = $this->generateComponentSectionCode( 'link', $vars );

            $tabindex = -1;
        }

        if( $this->_color )
            $style .= ' background: ' . $this->_color . ';';

        $vars = array(
            'TEXTCLASS' => $this->_TextClass,
            'STYLE'     => $style,
            'CONTENT'   => $content,
            'TABINDEX'  => $tabindex,
        );

        print( $this->generateComponentSectionCode( 'label', $vars ) );
    }

    function getValueField()
    {
        return $this->_ValueField;
    }

    function setValueField( $value )
    {
        $this->_ValueField = $value;
    }

    function defaultValueField()
    {
        return '';
    }

    function getValueKeyField()
    {
        return $this->_ValueKeyField;
    }

    function setValueKeyField( $value )
    {
        $this->_ValueKeyField = $value;
    }

    function defaultValueKeyField()
    {
        return '';
    }

    function getValueTable()
    {
        return $this->_ValueTable;
    }

    function setValueTable( $value )
    {
        $this->_ValueTable = $value;
    }

    function defaultValueTable()
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
}

?>