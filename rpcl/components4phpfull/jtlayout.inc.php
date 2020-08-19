<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                      -- Anchor Layout Class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
use_unit( 'graphics.inc.php' );

define( 'JTANCHOR_LAYOUT', 'JTANCHOR_LAYOUT' );

class JTLayout extends Layout
{
    function dumpLayoutContents( $exclude = array() )
    {
        if( $this->Type == JTANCHOR_LAYOUT )
            $this->dumpAnchorLayout( $exclude );
        else
            parent::dumpLayoutContents( $exclude );
    }

    function dumpAnchorLayout( $exclude = array() )
    {
        if( $this->_control )
        {
            $parentHasActiveLayer = $this->_control->methodExists( 'getActiveLayer' );

            if( $parentHasActiveLayer )
                $parentActiveLayer = $this->_control->Activelayer;

            if( $this->_control->methodExists( 'readClientWidth' ) )
                $parentWidth = $this->_control->ClientWidth;
            else
                $parentWidth = $this->_control->Width;

            if( $this->_control->methodExists( 'readClientHeight' ) )
                $parentHeight = $this->_control->ClientHeight;
            else
                $parentHeight = $this->_control->Height;

            foreach( $this->_control->controls->items as $k => $v )
            {
                if( !empty( $exclude ) )
                {
                    if( in_array( $v->classname(), $exclude ) )
                        continue;
                }

                $dump = false;
                if( $v->Visible && !$v->IsLayer )
                {
                    if( $parentHasActiveLayer )
                    {
                        $dump = ( (string)$v->Layer == (string)$parentActiveLayer );
                    }
                    else
                    {
                        $dump = true;
                    }
                }

                if( $dump )
                {
                    $right = '';
                    $bottom = '';

                    if( $v->methodExists( 'getAnchors' ) )
                    {
                        $anchors = $v->Anchors;

                        if( $anchors->Relative )
                        {
                            if( $anchors->Left )
                                $left = round( $v->Left * 100 / $parentWidth, 4 ) . '%';
                            else
                                $left = '';

                            if( $anchors->Top )
                                $top = round( $v->Top * 100 / $parentHeight, 4 ) . '%';
                            else
                                $top = '';

                            if( $anchors->Right && !$anchors->Left )
                                $right = ( 100 - round( ( $v->Left + $v->Width ) * 100 / $parentWidth, 4 ) ) . '%';

                            if( $anchors->Bottom && !$anchors->Top )
                                $bottom = ( 100 - round( ( $v->Top + $v->Height ) * 100 / $parentHeight, 4 ) ) . '%';

                            if( $anchors->Right && $anchors->Left )
                                $width = round( $v->Width * 100 / $parentWidth, 4 ) . '%';
                            else
                                $width = $v->Width . 'px';

                            if( $anchors->Bottom && $anchors->Top )
                                $height = round( $v->Height * 100 / $parentHeight, 4 ) . '%';
                            else
                                $height = $v->Height . 'px';
                        }
                        else
                        {
                            if( $anchors->Left || !$anchors->Right )
                                $left = $v->Left . 'px';
                            else
                                $left = '';

                            if( $anchors->Top || !$anchors->Bottom )
                                $top = $v->Top . 'px';
                            else
                                $top = '';

                            if( $anchors->Right )
                                $right = ( $parentWidth - ( $v->Left + $v->Width ) + 2 ) . 'px';

                            if( $anchors->Bottom )
                                $bottom = ( $parentHeight - ( $v->Top + $v->Height ) + 2 ) . 'px';

                            if( $anchors->Left && $anchors->Right )
                                $width = 'expression(offsetParent.clientWidth-' . ( $v->Left + ( $parentWidth - ( $v->Left + $v->Width ) + 2 ) ) . ')';
                            else
                                $width = $v->Width . 'px';

                            if( $anchors->Top && $anchors->Bottom )
                                $height = 'expression(offsetParent.clientHeight-' . ( $v->Top + ( $parentHeight - ( $v->Top + $v->Height ) + 2 ) ) . ')';
                            else
                                $height = $v->Height . 'px';
                        }
                    }
                    else
                    {
                        $left = $v->Left . 'px';
                        $top = $v->Top . 'px';
                        $width = $v->Width . 'px';
                        $height = $v->Height . 'px';
                    }

                    $style = 'position: absolute; z-index: ' . $k . ';';

                    if( $left )
                        $style .= ' left: ' . $left . ';';

                    if( $top )
                        $style .= ' top: ' . $top . ';';

                    if( $right )
                        $style .= ' right: ' . $right . ';';

                    if( $bottom )
                        $style .= ' bottom: ' . $bottom . ';';

                    if( $width )
                        $style .= ' width: ' . $width . ';';

                    if( $height )
                        $style .= ' height: ' . $height . ';';

                    print( '<div id="' . $v->Name . '_outer" style="' . $style . "\">\r\n" );

                    if( $v->methodExists( 'readDumpDimensions' ) )
                        $v->DumpDimensions = false;

                    $v->show();

                    print( "\r\n</div>\r\n" );
                }
            }
        }
    }
}
?>
