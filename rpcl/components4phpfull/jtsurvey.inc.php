<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- Survey component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

define( 'sfEdit', 'sfEdit' );
define( 'sfRadio', 'sfRadio' );
define( 'sfCheckbox', 'sfCheckbox' );
define( 'sfTextarea', 'sfTextarea' );

class JTSurvey extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_Questions = array();
    protected $_Answers = array();
    protected $_Answered = false;
    protected $_AlreadyAnswered = false;
    protected $_AnswerAttempted = false;
    protected $_FieldMessages = array();
    protected $_RequiredText = '*';
    protected $_IPField = '';
    protected $_SetCookie = 0;

    protected $_ontrysubmit = null;
    protected $_onsubmitted = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 700;
        $this->Height = 500;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function preinit()
    {
        $submitted = $this->input->{$this->Name};

        if( is_object( $submitted ) )
        {
            $this->populateFieldValues();
            $this->attemptSubmitAnswer();
        }
    }

    function init()
    {
        parent::init();

        if( $this->_onsubmitted && $this->_Answered && !$this->_AlreadyAnswered )
            $this->callEvent( 'onsubmitted', $this->_Answers );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'survey' ) );
    }

    protected function dumpThemedContents()
    {
        if( !$this->_Answered )
        {
            $contents = '';

            if( $this->_AnswerAttempted )
                $contents .= $this->generateComponentSectionCode( 'answerinvalid', array() );

            foreach( $this->_Questions as $question )
            {
                $type = $question[ 0 ];
                $name = $question[ 1 ];
                $inputObject = $this->input->$name;
                if( is_object( $inputObject ) )
                    $value = $inputObject->asString();
                else
                    $value = '';

                switch( $type )
                {
                    case sfEdit:
                        $contents .= $this->dumpEditQuestion( $question, $value );
                        break;

                    case sfRadio:
                        $contents .= $this->dumpRadioQuestion( $question, $value );
                        break;

                    case sfCheckbox:
                        $contents .= $this->dumpCheckboxQuestion( $question, $value );
                        break;

                    case sfTextarea:
                        $contents .= $this->dumpTextAreaQuestion( $question, $value );
                        break;
                }
            }

            $vars = array(
                'CONTENT'      => $contents,
            );

            print( $this->generateComponentSectionCode( 'surveyform', $vars ) );
        }
        else
        {
            print( $this->generateComponentSectionCode( 'answersuccess', array() ) );
        }
    }

    protected function dumpEditQuestion( $question, $value )
    {
        list( $type, $name, $caption, $required ) = $question;

        $vars = array(
            'FIELDNAME' => $this->Name . '_fld_' . $name,
            'CAPTION'   => $caption,
            'MESSAGE'   => $this->_FieldMessages[ $name ],
            'REQUIRED'  => ( ( $required ) ? $this->_RequiredText : '' ),
            'VALUE'     => $value,
        );

        return $this->generateComponentSectionCode( 'editquestion', $vars );
    }

    protected function dumpRadioQuestion( $question, $value )
    {
        list( $type, $name, $caption, $options ) = $question;

        $result = '';
        $vars = array(
            'FIELDNAME' => $this->Name . '_fld_' . $name,
            'CAPTION'   => $caption,
            'MESSAGE'   => $this->_FieldMessages[ $name ],
        );

        foreach( $options as $i => $option )
        {
            list( $itemValue, $text, $hasEditField ) = $option;

            $vars[ 'RADIOVALUE' ] = $itemValue;
            $vars[ 'RADIOTEXT' ] = $text;
            $vars[ 'RADIOINDEX' ] = $i;
            $vars[ 'CHECKED' ] = ( ( $value == $itemValue ) ? ' checked' : '' );

            if( $hasEditField )
            {
                $vars[ 'RADIOEDITNAME' ] = $this->Name . '_fld_' . $name . '_' . $i . '_edit';

                $result .= $this->generateComponentSectionCode( 'radioquestion_option_withedit', $vars );
            }
            else
            {
                $result .= $this->generateComponentSectionCode( 'radioquestion_option', $vars );
            }
        }

        $vars[ 'CONTENT' ] = $result;

        return $this->generateComponentSectionCode( 'radioquestion', $vars );
    }

    protected function dumpCheckboxQuestion( $question, $value )
    {
        list( $type, $name, $caption ) = $question;

        $vars = array(
            'FIELDNAME' => $this->Name . '_fld_' . $name,
            'CAPTION'   => $caption,
            'MESSAGE'   => $this->_FieldMessages[ $name ],
            'CHECKED'   => ( $value ? ' checked' : '' ),
        );

        return $this->generateComponentSectionCode( 'checkquestion', $vars );
    }

    protected function dumpTextAreaQuestion( $question, $value )
    {
        list( $type, $name, $caption, $required ) = $question;

        $vars = array(
            'FIELDNAME' => $this->Name . '_fld_' . $name,
            'CAPTION'   => $caption,
            'MESSAGE'   => $this->_FieldMessages[ $name ],
            'REQUIRED'  => ( ( $required ) ? $this->_RequiredText : '' ),
            'VALUE'     => $value,
        );

        return $this->generateComponentSectionCode( 'textareaquestion', $vars );
    }

    protected function populateFieldValues()
    {
        foreach( $this->_Questions as $question )
        {
            $type = $question[ 0 ];
            $name = $question[ 1 ];

            $formFieldName = $this->Name . '_fld_' . $name;

            $submitted = $this->input->{$formFieldName};
            if( is_object( $submitted ) )
                $value = $submitted->asString();
            else
                $value = '';

            if( $type == sfCheckbox && $value === '' )
                $value = '0';

            $this->_Answers[ $name ] = $value;

            if( $type == sfRadio )
            {
                $options = $question[ 3 ];

                foreach( $options as $i => $option )
                {
                    if( $value == $option[ 0 ] && $option[ 2 ] )
                    {
                        $editFieldName = $this->Name . '_fld_' . $name . '_' . $i . '_edit';
                        $editFieldInput = $this->input->$editFieldName;
                        if( is_object( $editFieldInput ) )
                            $editValue = $editFieldInput->asString();
                        else
                            $editValue = '';

                        $this->_Answers[ $name . '_edit' ] = $editValue;
                    }
                }
            }
        }
    }

    protected function attemptSubmitAnswer()
    {
        $this->resolveSiteThemeInstance();

        if( $this->_AnswerAttempted )
            return;

        $this->_AnswerAttempted = true;

        $cookieName = $this->NamePath . '_Submitted';
        if( !isset( $_COOKIE[ $cookieName ] ) )
        {
            if( !$this->verifyFields() )
                return;

            if( $this->_ontrysubmit && !$this->callEvent( 'ontrysubmit', $this->_Answers ) )
                return;

            if( $this->_datasource )
            {
                $this->_datasource->DataSet->Append();

                foreach( $this->_Answers as $n => $v )
                    $this->_datasource->DataSet->$n = $v;

                if( $this->_IPField )
                    $this->_datasource->DataSet->{ $this->_IPField } = GetJTUserIP();

                $this->_datasource->DataSet->Post();
            }

            if( $this->_SetCookie )
            {
                $expireTime = 3600 * 24 * 365 * 5;

                setcookie( $cookieName, '1', time() + $expireTime );
            }
        }
        else
        {
            $this->AlreadyAnswered = true;
        }

        $this->_Answered = true;
    }

    protected function verifyFields()
    {
        $ok = true;

        foreach( $this->_Questions as $i => $question )
        {
            $type = $question[ 0 ];
            $name = $question[ 1 ];

            $formFieldName = $this->Name . '_fld_' . $name;
            $msg = '';

            $submitted = $this->input->{$formFieldName};
            if( is_object( $submitted ) )
                $value = $submitted->asString();
            else
                $value = '';

            if( $type == sfRadio )
            {
                $options = $question[ 3 ];
                $tok = false;
                $msg = $this->SiteThemeInstance->retrieveString( 'PleaseSelectOption' );

                foreach( $options as $i => $option )
                {
                    if( $value == $option[ 0 ] )
                    {
                        $tok = true;
                        break;
                    }
                }

                if( $ok && !$tok )
                    $ok = false;
            }
            else if( $type == sfCheckbox )
            {
                if( $value == '' )
                    $value = '0';

                if( $value != '0' && $value != '1' )
                {
                    $msg = $this->SiteThemeInstance->retrieveString( 'PleaseCheckOrUnCheck' );
                    $ok = false;
                }
            }
            else
            {
                $required = $question[ 3 ];

                if( !strlen( $value ) && $required )
                {
                    $ok = false;
                    $msg = $this->SiteThemeInstance->retrieveString( 'PleaseEnterValidText' );
                }
            }

            if( !$ok )
                $this->_FieldMessages[ $name ] = $msg;
        }

        return $ok;
    }

    function AddEditQuestion( $name, $caption, $required )
    {
        if( $name == '' )
            throw new Exception( 'Name cannot be empty' );

        $this->_Questions[] = array( sfEdit, $name, $caption, $required );
    }

    function AddRadioQuestion( $name, $caption, $options )
    {
        if( $name == '' )
            throw new Exception( 'Name cannot be empty' );

        $this->_Questions[] = array( sfRadio, $name, $caption, $options );
    }

    function AddCheckboxQuestion( $name, $caption )
    {
        if( $name == '' )
            throw new Exception( 'Name cannot be empty' );

        $this->_Questions[] = array( sfCheckbox, $name, $caption );
    }

    function AddTextareaQuestion( $name, $caption, $required )
    {
        if( $name == '' )
            throw new Exception( 'Name cannot be empty' );

        $this->_Questions[] = array( sfTextarea, $name, $caption, $required );
    }

    function ClearQuestions()
    {
        $this->_Questions = array();
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function readQuestions()
    {
        return $this->_Questions;
    }

    function writeQuestions( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$question )
        {
            if( !is_array( $question ) )
                $question = unserialize( $question );

            $type = $question[ 0 ];

            if( $type == sfRadio )
            {
                $options = $question[ 3 ];

                if( !is_array( $options ) )
                    $options = unserialize( $options );

                foreach( $options as &$option )
                {
                    if( !is_array( $option ) )
                        $option = unserialize( $option );
                }

                $question[ 3 ] = $options;
            }
        }

        $this->_Questions = $value;
    }

    function readAnswers()
    {
        return $this->_Answers;
    }

    function readAnswered()
    {
        return $this->_Answered;
    }

    function getIPField()
    {
        return $this->_IPField;
    }

    function setIPField( $value )
    {
        $this->_IPField = $value;
    }

    function defaultIPField()
    {
        return '';
    }

    function getRequiredText()
    {
        return $this->_RequiredText;
    }

    function setRequiredText( $value )
    {
        $this->_RequiredText = $value;
    }

    function defaultRequiredText()
    {
        return 'Required';
    }

    function getSetCookie()
    {
        return $this->_SetCookie;
    }

    function setSetCookie( $value )
    {
        $this->_SetCookie = ( $value ) ? true : 0;
    }

    function defaultSetCookie()
    {
        return 0;
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

    function getOnTrySubmitted()
    {
        return $this->_ontrysubmit;
    }

    function setOnTrySubmitted( $value )
    {
        $this->_ontrysubmit = $value;
    }

    function getOnSubmitted()
    {
        return $this->_onsubmitted;
    }

    function setOnSubmitted( $value )
    {
        $this->_onsubmitted = $value;
    }
}
?>
