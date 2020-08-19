<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//               -- Base class for lookup box components --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

abstract class JTBaseLookupBox extends JTThemedGraphicControl
{
    protected $_AllowEmpty = true;
    protected $_Enabled = true;
/*    protected $_ReadOnly = 0;*/
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_LookupDataSource = null;
    protected $_LookupField = '';
    protected $_LookupDataField = '';
    protected $_SelectedValue = false;

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
        $this->setLookupDataSource( $this->_LookupDataSource );
    }

    function preinit()
    {
        $submitted = $this->input->{$this->Name};

        if( is_object( $submitted ) )
        {
            $this->_SelectedValue = $submitted->asString();
            $this->updateDataField( $this->_SelectedValue );
        }
    }

    protected function dumpThemedContents()
    {
        $contents = '';

        if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_LookupDataSource && $this->_LookupField )
        {
            $selectedValue = $this->_SelectedValue;

            if( $selectedValue === false && $this->_datafield && $this->_datasource )
                $selectedValue = $this->_datasource->DataSet->Fields[ $this->_datafield ];

            $lookupfield = $this->_LookupField;
            $lookupdatafield = $this->_LookupDataField;

            $items = array();

            if( $this->_AllowEmpty )
                $items[] = array( '', '' );

            for( $this->_LookupDataSource->DataSet->First(); !$this->_LookupDataSource->DataSet->EOF; $this->_LookupDataSource->DataSet->Next() )
            {
                $data = $this->_LookupDataSource->DataSet->Fields[ $lookupfield ];

                if( $lookupdatafield )
                    $itemvalue = $this->_LookupDataSource->DataSet->Fields[ $lookupdatafield ];
                else
                    $itemvalue = $data;

                $items[] = array( $itemvalue, $data );
            }

            foreach( $items as $item )
            {
                list( $itemvalue, $data ) = $item;

                $contents .= $this->GenerateItemContents( $data, $itemvalue, ( strcmp( $selectedValue, $itemvalue ) == 0 ) );
            }
        }

        print( $this->GenerateBoxContents( $contents ) );
    }

    abstract protected function GenerateItemContents( $content, $value, $selected );
    abstract protected function GenerateBoxContents( $items );

    function getAllowEmpty()
    {
        return $this->_AllowEmpty;
    }

    function setAllowEmpty( $value )
    {
        $this->_AllowEmpty = $value;
    }

    function defaultAllowEmpty()
    {
        return true;
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

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        if( $value && $value == $this->_LookupDataSource )
            throw new Exception( 'DataSource cannot be set to the same Datasource as the LookupDataSource property' );

        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getEnabled()
    {
        return $this->_Enabled;
    }

    function setEnabled( $value )
    {
        $this->_Enabled = $value;
    }

    function defaultEnabled()
    {
        return true;
    }

    function getLookupField()
    {
        return $this->_LookupField;
    }

    function setLookupField( $value )
    {
        $this->_LookupField = $value;
    }

    function defaultLookupField()
    {
        return '';
    }

    function getLookupDataField()
    {
        return $this->_LookupDataField;
    }

    function setLookupDataField( $value )
    {
        $this->_LookupDataField = $value;
    }

    function defaultLookupDataField()
    {
        return '';
    }

    function getLookupDataSource()
    {
        return $this->_LookupDataSource;
    }

    function setLookupDataSource( $value )
    {
        if( $value && $value == $this->_datasource )
            throw new Exception( 'LookupDataSource cannot be set to the same Datasource as the DataSource property' );

        $this->_LookupDataSource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultLookupDataSource()
    {
        return null;
    }

    /*function getReadOnly()
    {
        return $this->_ReadOnly;
    }

    function setReadOnly( $value )
    {
        $this->_ReadOnly = $value;
    }

    function defaultReadOnly()
    {
        return 0;
    }*/

    function getSelectedValue()
    {
        return ( $this->_SelectedValue !== false ) ? $this->_SelectedValue : '';
    }

    function setSelectedValue( $value )
    {
        $this->_SelectedValue = $value;
    }

    function defaultSelectedValue()
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

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
    }

    function getjsOnBlur()
    {
        return $this->readjsOnBlur();
    }

    function setjsOnBlur( $value )
    {
        $this->writejsOnBlur( $value );
    }

    function getjsOnFocus()
    {
        return $this->readjsOnFocus();
    }

    function setjsOnFocus( $value )
    {
        $this->writejsOnFocus( $value );
    }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }
}
?>
