/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/

var JTDivWindowMovingWindow = null;
var JTDivWindowMovingBorder = "";
var JTDivWindowMouseStartX = 0;
var JTDivWindowMouseStartY = 0;
var JTDivWindowMaskList = new Array();

JTDivWindowInitializeOnLoadHandler();

function JTDivWindowInitialize( id, position, borderstyle, visible, modal )
{
    var windowObject = document.getElementById( id );

    windowObject.Hide = function() {
    	if (!this.Visible)
    		return;

    	this.style.display = "none";
    	if (getOuterNode(this))
    		getOuterNode(this).style.display = "none";

    	this.modalMask.style.display = "none";

    	this.RemoveMaximizeOrMinimizeState();

    	if (this.Modal) {
    		jQuery("*").each(JTEnableFocus);
    	}

    	this.Visible = false;
    	this.Modal = false;

    	if (this.maskTimer > -1) {
    		clearInterval(this.maskTimer);
    		this.maskTimer = -1;
    	}

    	if (this.OnHide)
    		this.OnHide(this);
    }

    windowObject.Maximize = function()
    {
        if( this.Maximized )
            return;

        if( !this.Minimized )
        {
            this.oldLeft = this.getLeft();
            this.oldTop = this.getTop();
            this.oldWidth = this.getWidth();
            this.oldHeight = this.getHeight();
        }
        else
        {
            this.RemoveFromParentMinimize();
            this.setBorderStyle( this.oldBorderStyle );
        }

        this.DoMaximizedState();

        this.BringToFront();
        
        if( this.OnResize )
			this.OnResize( this );
    }

    windowObject.Minimize = function()
    {
        if( this.Miminized )
            return;

        if( !this.Maximized )
        {
            this.oldLeft = this.getLeft();
            this.oldTop = this.getTop();
            this.oldWidth = this.getWidth();
            this.oldHeight = this.getHeight();
        }

        if( this.Maximized )
            this.UnlockParent();

        this.DoMinimizedState();
    }

    windowObject.Restore = function()
    {
        this.SetBounds( this.oldLeft, this.oldTop, this.oldWidth, this.oldHeight );

        this.RemoveMaximizeOrMinimizeState();

        this.Minimized = false;
        this.Maximized = false;

        this.BringToFront();
        
        if( this.OnResize )
			this.OnResize( this );
    }

    windowObject.Show = function() {
    	if (this.Visible)
    		return;

    	this.style.display = "block";
    	if (getOuterNode(this))
    		getOuterNode(this).style.display = "block";

    	if (!this.posInit)
    		this.SetPositionAndSize();
    	
    	this.DoWindowSizeAndPosition();

    	if (this.Maximized)
    		this.DoMaximizedState();
    	else if (this.Minimized)
    		this.DoMinimizedState();

    	JTDivWindowFixClientArea(this, -1);

    	this.Visible = true;
    	this.Modal = false;

    	this.BringToFront();

    	ParentSendDisplayChanged(this);

    	if (this.OnShow)
    		this.OnShow(this);
    }

    windowObject.ShowModal = function() {
    	if (this.Visible)
    		return;

    	this.style.display = "block";
    	if (getOuterNode(this))
    		getOuterNode(this).style.display = "block";

    	this.modalMask.style.display = "block";

    	if (!this.posInit)
    		this.SetPositionAndSize();
    	
    	this.DoWindowSizeAndPosition();

    	if (this.Maximized)
    		this.DoMaximizedState();
    	else if (this.Minimized)
    		this.DoMinimizedState();

    	JTDivWindowFixClientArea(this, -1);

    	this.Visible = true;
    	this.Modal = true;

    	var ieVer = getIEVersion();

    	if (ieVer > 0 && ieVer < 7)
    		this.maskTimer = setInterval("JTDivWindowResizeMask( '" + this.id + "' )", 100);

    	this.BringToFront();

    	ParentSendDisplayChanged(this);

    	jQuery("*").each(JTDisableFocus);
    	jQuery("#" + this.id + " *").each(JTEnableFocus);

    	if (this.OnShow)
    		this.OnShow(this);
    }

    windowObject.SetBounds = function( x, y, w, h )
    {
        this.setWidth( w );
        this.setHeight( h );
        this.setLeft( x );
        this.setTop( y );

        JTDivWindowFixClientArea( this, h );
    }

    windowObject.SetPositionAndSize = function() {
        if (this.Maximized || this.Minimized)
            return;

        if (typeof (this._left) != "undefined" && typeof (this._top) != "undefined") {
            return;
        }
        if (this.Position == "poDefaultPosOnly") {
            this.setLeft(0);
            this.setTop(0);
        }
        else {
            var sizedParent = getSizedParentNode(this);
            if (this.Position == "poParentCenter" && sizedParent != document.body) {
                this.setLeft((sizedParent.offsetWidth - this.getWidth()) / 2);
                this.setTop((sizedParent.offsetHeight - this.getHeight()) / 2);
            }
            else {  // this.Position == "poBrowserCenter"
                this.setLeft((getBrowserScrollX() + (getBrowserWidth() - this.getWidth()) / 2) - getObjectScreenX(getSizedParentNode(this)));
                this.setTop((getBrowserScrollY() + (getBrowserHeight() - this.getHeight()) / 2) - getObjectScreenY(getSizedParentNode(this)));
            }
        }
    }

    windowObject.AddToParentMinimize = function()
    {
    	document.minimizedWindows[this.GetParentMinimizeIndex()] = this;
    }

    windowObject.GetParentMinimizeIndex = function() {
    	var i;

    	for (i = 0; i < document.minimizedWindows.length; ++i) {
    		if (document.minimizedWindows[i] == null)
    			break;
    	}

    	return i;
    }

    windowObject.RemoveFromParentMinimize = function()
    {
        var i;
        var mw = document.minimizedWindows;

        for( i = 0; i < mw.length; ++i )
        {
            if( mw[ i ] == this )
            {
                if( i == ( mw.length - 1 ) )
                    mw.pop();
                else
                    mw[ i ] = null;

                break;
            }
        }
    }

    windowObject.BringToFront = function() {
    	if (!this.Visible)
    		return;

    	var i;
    	var dw = document.divWindows;
    	var ref = getParentNode(this).childNodes.length + 2;

    	for (i = 0; i < dw.length; ++i) {
    		if (dw[i] == this)
    			break;
    	}

    	if (i == dw.length)
    		return;

    	dw.splice(i, 1);
    	dw.push(this);

    	for (i = 0; i < dw.length; ++i)
    		dw[i].setZIndex(ref + (i * 2));
    }

    windowObject.LockParent = function()
    {
        getSizedParentNode( this ).oldScrollLeft = ( getSizedParentNode( this ) == document.body ) ? getBrowserScrollX() : getSizedParentNode( this ).scrollLeft;
        getSizedParentNode( this ).oldScrollTop = ( getSizedParentNode( this ) == document.body ) ? getBrowserScrollY() : getSizedParentNode( this ).scrollTop;

        getSizedParentNode( this ).oldOverflow = getSizedParentNode( this ).style.overflow;
        getSizedParentNode( this ).style.overflow = "hidden";

        if( getSizedParentNode( this ) == document.body )
        {
            setBrowserScrollX( 0 );
            setBrowserScrollY( 0 );
        }
        else
        {
            getSizedParentNode( this ).scrollLeft = 0;
            getSizedParentNode( this ).scrollTop = 0;
        }
    }

    windowObject.UnlockParent = function()
    {
        getSizedParentNode( this ).style.overflow = getSizedParentNode( this ).oldOverflow;

        if( getSizedParentNode( this ) == document.body )
        {
            window.scroll( getSizedParentNode( this ).oldScrollLeft, getSizedParentNode( this ).oldScrollTop );
        }
        else
        {
            getSizedParentNode( this ).scrollLeft = getSizedParentNode( this ).oldScrollLeft;
            getSizedParentNode( this ).scrollTop = getSizedParentNode( this ).oldScrollTop;
        }
    }

    windowObject.RemoveMaximizeOrMinimizeState = function()
    {
        if( this.Maximized )
        {
            this.UnlockParent();

            var maximizeButtonObject = document.getElementById( id + "_button_maximize" );
            if( maximizeButtonObject )
            {
                maximizeButtonObject.className = "jtbb jtdivwindowbutton jtdivwindowbutton_maximize";
                maximizeButtonObject.buttonType = "maximize";
            }
        }
        else if( this.Minimized )
        {
            document.getElementById( this.id + "_frame" ).style.display = "block";

            var minimizeButtonObject = document.getElementById( id + "_button_minimize" );
            if( minimizeButtonObject )
            {
                minimizeButtonObject.className = "jtbb jtdivwindowbutton jtdivwindowbutton_minimize";
                minimizeButtonObject.buttonType = "minimize";
            }

            this.RemoveFromParentMinimize();
            this.setBorderStyle( this.oldBorderStyle );
        }
    }

    windowObject.DoMaximizedState = function()
    {
        var w, h;

        this.LockParent();

        document.getElementById( this.id + "_frame" ).style.display = "block";

        if( getSizedParentNode( this ) == document.body )
        {
            w = getBrowserWidth();
            h = getBrowserHeight();
        }
        else
        {
            w = getSizedParentNode( this ).clientWidth;
            h = getSizedParentNode( this ).clientHeight;
        }

        this.SetBounds( 0, 0, w, h );

        var maximizeButtonObject = document.getElementById( id + "_button_maximize" );
        if( maximizeButtonObject )
        {
            maximizeButtonObject.className = "jtbb jtdivwindowbutton jtdivwindowbutton_restore";
            maximizeButtonObject.buttonType = "restore";
        }

        this.Maximized = true;
        this.Minimized = false;
    }

    windowObject.DoMinimizedState = function()
    {
        var y, w;

        if( getSizedParentNode( this ) == document.body )
        {
            w = getBrowserWidth();
            y = getBrowserHeight() - 30;
        }
        else
        {
            w = getSizedParentNode( this ).clientWidth;
            y = getSizedParentNode( this ).clientHeight - 30;
        }

        this.oldBorderStyle = this.BorderStyle;
        this.setBorderStyle( "bsSingle" );

        var titleBarObject = document.getElementById( this.id + "_titlebar" );
        var minimizedHeight = titleBarObject.offsetHeight + 8;
        var minimizeIndex = this.GetParentMinimizeIndex();
        var maxWindowsPerWidth = Math.floor( w / minimizedHeight );
        var level = Math.floor( minimizeIndex / maxWindowsPerWidth );
        var position = minimizeIndex - ( level * maxWindowsPerWidth );

        this.SetBounds( position * 250, y - ( level * minimizedHeight ), 250, minimizedHeight );

        document.getElementById( this.id + "_frame" ).style.display = "none";

        var minimizeButtonObject = document.getElementById( id + "_button_minimize" );
        if( minimizeButtonObject )
        {
            minimizeButtonObject.className = "jtbb jtdivwindowbutton jtdivwindowbutton_restore";
            minimizeButtonObject.buttonType = "restore";
        }

        this.Minimized = true;
        this.Maximized = false;

        this.AddToParentMinimize();
    }

    windowObject.DoWindowSizeAndPosition = function() {
    	if (typeof (this._left) != "undefined") {
    		this.setLeft(this._left);
    	}
    	if (typeof (this._top) != "undefined") {
    		this.setTop(this._top);
    	}
    	if (typeof (this._width) != "undefined") {
    		this.setWidth(this._width);
    	}
    	if (typeof (this._height) != "undefined") {
    		this.setHeight(this._height);
    	}
    }
    
    windowObject.getCaption = function()
    {
		var captionDiv = document.getElementById( this.id + "_caption" );
		return ( captionDiv ? captionDiv.innerHTML : "" );
    }
    
    windowObject.setCaption = function( value )
    {
		var captionDiv = document.getElementById( this.id + "_caption" );
		if( captionDiv )
			captionDiv.innerHTML = value;
    }

    // Getters
    windowObject.getLeft = function()
    {
        if( getOuterNode( this ) )
        	return getOuterNode(this).offsetLeft + this.offsetLeft;
        else
            return this.offsetLeft;
    }

    windowObject.getTop = function()
    {
        if( getOuterNode( this ) )
        	return getOuterNode(this).offsetTop + this.offsetTop;
        else
            return this.offsetTop;
    }

    windowObject.getWidth = function()
    {
        return this.offsetWidth;
    }

    windowObject.getHeight = function()
    {
        return this.offsetHeight;
    }

    // Setters
    windowObject.setLeft = function(x) {
    	if (getOuterNode(this))
    		this.style.left = (x - getOuterNode(this).offsetLeft) + "px";
    	else
    		this.style.left = x + "px";

    	this._left = x;
    }

    windowObject.setTop = function(y) {
    	if (getOuterNode(this))
    		this.style.top = (y - getOuterNode(this).offsetTop) + "px";
    	else
    		this.style.top = y + "px";

    	this._top = y;
    }

    windowObject.setWidth = function(w) {
    	if (w > 10) {
    		this.style.width = w + "px";
    		this._width = w;
    	}
    }

    windowObject.setHeight = function(h) {
    	if (h > 11) {
    		this.style.height = h + "px";
    		this._height = h;
    	}
    }

    windowObject.setBorderStyle = function( borderStyle )
    {
        this.BorderStyle = borderstyle;
        this.className = "jtbb jtdivwindow jtdivwindow_" + borderStyle;

        if( borderStyle != "bsNone" )
            document.getElementById( this.id + "_titlebar" ).className = "jtbb jtdivwindowtitlebar jtdivwindowtitlebar_" + borderStyle;

        document.getElementById( id + "_inner" ).className = "jtbb jtdivwindowinner jtdivwindowinner_" + borderStyle;

        if( borderStyle == "bsSizeable" )
        {
            document.getElementById( id + "_topborder" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_leftborder" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_rightborder" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_bottomborder" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_topleftcorner" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_toprightcorner" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_bottomleftcorner" ).onmousedown = JTDivWindowBorderMouseDown;
            document.getElementById( id + "_bottomrightcorner" ).onmousedown = JTDivWindowBorderMouseDown;
        }
        else
        {
            document.getElementById( id + "_topborder" ).onmousedown = null;
            document.getElementById( id + "_leftborder" ).onmousedown = null;
            document.getElementById( id + "_rightborder" ).onmousedown = null;
            document.getElementById( id + "_bottomborder" ).onmousedown = null;
            document.getElementById( id + "_topleftcorner" ).onmousedown = null;
            document.getElementById( id + "_toprightcorner" ).onmousedown = null;
            document.getElementById( id + "_bottomleftcorner" ).onmousedown = null;
            document.getElementById( id + "_bottomrightcorner" ).onmousedown = null;
        }
    }

    windowObject.setZIndex = function( zIndex )
    {
        if( getOuterNode( this ) )
        	getOuterNode(this).style.zIndex = zIndex;
            
        this.style.zIndex = zIndex;
        this.modalMask.style.zIndex = zIndex - 1;
    }

    if( borderstyle != "bsNone" )
    {
        document.getElementById( id + "_caption" ).onmousedown = JTDivWindowBorderMouseDown;
        document.getElementById( id + "_titlebar" ).onmousedown = JTDivWindowBorderMouseDown;
    }

    document.getElementById( id ).onmousedown = JTDivWindowMouseDown;

    if( document.getElementById( id + "_button_maximize" ) )
    {
        document.getElementById( id + "_caption" ).ondblclick = JTDivWindowBorderDoubleClick;
        document.getElementById( id + "_titlebar" ).ondblclick = JTDivWindowBorderDoubleClick;
    }

    if( borderstyle != "bsNone" )
        document.getElementById( id + "_caption" ).onselectstart = JTDivWindowOnSelectStart;

    windowObject.Modal = modal;
    windowObject.pendingVisible = visible;
    windowObject.Visible = false;
    windowObject.Position = position;
    windowObject.Minimized = false;
    windowObject.Maximized = false;
    windowObject.maskTimer = -1;
    windowObject.posInit = false;

    var o = getOuterNode(windowObject);
    if (o) {
    	o.style.display = (visible ? "block" : "none");
    	o.style.height = "0";
    	o.style.width = "0";
    }

    eval( "window." + windowObject.id + " = windowObject;" );

	if( JTPageLoaded )
	{
		JTDivWindowItemLoad( id );
		if( windowObject.pendingVisible )
		{
			if( windowObject.Modal )
                windowObject.ShowModal();
            else
                windowObject.Show();
		}	
	}
	else
	{
		JTDivWindowMaskList.push( id );
	}

    windowObject.setBorderStyle( borderstyle );
}

function JTDivWindowMouseDown( e )
{
    this.BringToFront();
}

function JTDivWindowBorderMouseDown( e )
{
    var event = e || window.event;
    var eventObj = getEventTarget( event );
    var objNames = eventObj.id.split( "_" );
    var parentObjectName = objNames[ 0 ];
    var borderName = objNames[ 1 ];
    var parentObject = document.getElementById( parentObjectName );

    // Check whether the user is using IE, and if they are, whether the left button was pushed.
    if( document.all )
    {
        if( event.button != 1 )
            return false;
    }
    else if( event.button != 0 )
    {
        return false;
    }

    parentObject.BringToFront();

    if( parentObject.Minimized || parentObject.Maximized )
        return false;

    JTDivWindowMovingWindow = parentObject;
    JTDivWindowMovingBorder = borderName;

    JTDivWindowMovingWindow.oldLeft = JTDivWindowMovingWindow.getLeft();
    JTDivWindowMovingWindow.oldTop = JTDivWindowMovingWindow.getTop();
    JTDivWindowMovingWindow.oldWidth = JTDivWindowMovingWindow.getWidth();
    JTDivWindowMovingWindow.oldHeight = JTDivWindowMovingWindow.getHeight();

    JTDivWindowMouseStartX = event.clientX;
    JTDivWindowMouseStartY = event.clientY;

    if( borderName != "caption" && borderName != "titlebar" )
        JTDivWindowMovingWindow.style.cursor = eventObj.style.cursor;

    JTDivWindowCaptureMouseMove();

    document.onselectstart = JTDivWindowOnSelectStart;

    return false;
}

function JTDivWindowBorderMouseUp( e )
{
    JTDivWindowReleaseMouseMove();

    JTDivWindowMovingWindow.style.cursor = "";

    document.onselectstart = null;

    if( JTDivWindowMovingWindow.OnResize && JTDivWindowMovingBorder != "caption" && JTDivWindowMovingBorder != "titlebar" && (JTDivWindowMovingWindow.oldWidth != JTDivWindowMovingWindow.getWidth() || JTDivWindowMovingWindow.oldHeight != JTDivWindowMovingWindow.getHeight()) )
        JTDivWindowMovingWindow.OnResize( JTDivWindowMovingWindow );

    if( JTDivWindowMovingWindow.OnMove && (JTDivWindowMovingWindow.oldLeft != JTDivWindowMovingWindow.getLeft() || JTDivWindowMovingWindow.oldTop != JTDivWindowMovingWindow.getTop()) )
        JTDivWindowMovingWindow.OnMove( JTDivWindowMovingWindow );
}

function JTDivWindowCaptureMouseMove()
{
    addEvent( document, "mousemove", JTDivWindowMouseMove );
    addEvent( document, "mouseup", JTDivWindowBorderMouseUp );
}

function JTDivWindowReleaseMouseMove()
{
    deleteEvent( document, "mousemove", JTDivWindowMouseMove );
    deleteEvent( document, "mouseup", JTDivWindowBorderMouseUp );
}

function JTDivWindowMouseMove( e )
{
    var event = e || window.event;
    var eventXStray = event.clientX - JTDivWindowMouseStartX;
    var eventYStray = event.clientY - JTDivWindowMouseStartY;
    var NewX = JTDivWindowMovingWindow.oldLeft + eventXStray;
    var NewY = JTDivWindowMovingWindow.oldTop + eventYStray;
    var NewWidth = JTDivWindowMovingWindow.oldWidth;
    var NewHeight = JTDivWindowMovingWindow.oldHeight;

    if( JTDivWindowMovingBorder == "bottomleftcorner" || JTDivWindowMovingBorder == "leftborder" || JTDivWindowMovingBorder == "topleftcorner" )
    {
        NewWidth = JTDivWindowMovingWindow.oldWidth - eventXStray;
    }
    else if( JTDivWindowMovingBorder == "toprightcorner" || JTDivWindowMovingBorder == "rightborder" || JTDivWindowMovingBorder == "bottomrightcorner" )
    {
        NewWidth = JTDivWindowMovingWindow.oldWidth + eventXStray;
    }

    if( JTDivWindowMovingBorder == "bottomleftcorner" || JTDivWindowMovingBorder == "bottomrightcorner" || JTDivWindowMovingBorder == "bottomborder" )
    {
        NewHeight = JTDivWindowMovingWindow.oldHeight + eventYStray;
    }
    else if( JTDivWindowMovingBorder == "topleftcorner" || JTDivWindowMovingBorder == "topborder" || JTDivWindowMovingBorder == "toprightcorner" )
    {
        NewHeight = JTDivWindowMovingWindow.oldHeight - eventYStray;
    }

    if( NewWidth > 200 )
    {
        if( JTDivWindowMovingBorder == "bottomleftcorner" || JTDivWindowMovingBorder == "leftborder" || JTDivWindowMovingBorder == "topleftcorner" ||
            JTDivWindowMovingBorder == "toprightcorner" || JTDivWindowMovingBorder == "rightborder" || JTDivWindowMovingBorder == "bottomrightcorner" ||
            JTDivWindowMovingBorder == "caption" || JTDivWindowMovingBorder == "titlebar" )
        {
            if( JTDivWindowMovingBorder != "caption" && JTDivWindowMovingBorder != "titlebar" )
                JTDivWindowMovingWindow.setWidth( NewWidth );

            if( JTDivWindowMovingBorder == "bottomleftcorner" || JTDivWindowMovingBorder == "leftborder" || JTDivWindowMovingBorder == "topleftcorner" ||
                JTDivWindowMovingBorder == "caption" || JTDivWindowMovingBorder == "titlebar" )
            {
                JTDivWindowMovingWindow.setLeft( NewX );
            }
        }
    }

    if( NewHeight > 35 )
    {
        if( JTDivWindowMovingBorder == "bottomleftcorner" || JTDivWindowMovingBorder == "bottomrightcorner" || JTDivWindowMovingBorder == "bottomborder" ||
            JTDivWindowMovingBorder == "topleftcorner" || JTDivWindowMovingBorder == "topborder" || JTDivWindowMovingBorder == "toprightcorner" ||
            JTDivWindowMovingBorder == "caption" || JTDivWindowMovingBorder == "titlebar" )
        {
            if( JTDivWindowMovingBorder != "caption" && JTDivWindowMovingBorder != "titlebar" )
                JTDivWindowMovingWindow.setHeight( NewHeight );

            if( JTDivWindowMovingBorder == "topleftcorner" || JTDivWindowMovingBorder == "topborder" || JTDivWindowMovingBorder == "toprightcorner" ||
                JTDivWindowMovingBorder == "caption" || JTDivWindowMovingBorder == "titlebar" )
            {
                JTDivWindowMovingWindow.setTop( NewY );
            }
        }
    }

    if( NewWidth > 200 || NewHeight > 35 )
        JTDivWindowFixClientArea( JTDivWindowMovingWindow, NewHeight );
}

function JTDivWindowFixClientArea( windowObject, windowHeight )
{
    var titleBarObject = document.getElementById( windowObject.id + "_titlebar" );
    var contentsObject = document.getElementById( windowObject.id + "_contents" );

    if( windowObject.offsetHeight == 0 )
        return;

    if( windowHeight == -1 )
        windowHeight = windowObject.getHeight();

	/*
    if( JTIEVer > -1 )
    {
        if( JTIEVer < 7 )
            JTUpdateElementAndChildrenWidth( windowObject );

        JTUpdateElementAndChildrenHeight( windowObject );
    }
    */
    JTUpdateAnchors();
}

function JTDivWindowOnSelectStart()
{
    return false;
}

function JTDivWindowButtonClick( id, button )
{
    var windowObject = document.getElementById( id );

    if( button == "minimize" )
    {
        if( windowObject.Minimized )
            windowObject.Restore();
        else
            windowObject.Minimize();
    }
    else if( button == "maximize" )
    {
        if( windowObject.Maximized )
            windowObject.Restore();
        else
            windowObject.Maximize();
    }
    else if( button == "close" )
    {
        windowObject.Hide();
    }
    else if( button == "help" )
    {
        if( windowObject.OnHelp )
            windowObject.OnHelp( windowObject );
    }
}

function JTDivWindowInitializeOnLoadHandler()
{
    addEvent( window, "load", JTDivWindowOnLoad );
}

function JTDivWindowOnLoad()
{
    var i;

    for( i = 0; i < JTDivWindowMaskList.length; ++i )
        JTDivWindowItemLoad( JTDivWindowMaskList[ i ] );

    for( i = 0; i < JTDivWindowMaskList.length; ++i )
    {
        var id = JTDivWindowMaskList[ i ];

        var idObject = document.getElementById( id );

        if( idObject.pendingVisible )
        {
            if( idObject.Modal )
                idObject.ShowModal();
            else
                idObject.Show();
        }
    }
}

function JTDivWindowItemLoad( id )
{
	var idObject = document.getElementById( id );
	var div = document.getElementById( id + "_modalmask" );

	if( !div )
	{
		div = document.createElement( "div" );
		
		div.id = id + "_modalmask";
		div.className = "jtdivwindowmodalback";
		
		getParentNode( idObject ).appendChild( div );
	}
	else
	{
		div.style.display = "none";
	}

	if (typeof (document.minimizedWindows) == "undefined")
		document.minimizedWindows = [];

	if (typeof (document.divWindows) == "undefined")
		document.divWindows = [];

	document.divWindows.push(idObject);

    idObject.modalMask = div;

	var outer = getOuterNode(idObject);
	if (outer) {
		idObject.DesignedLeft = parseInt(outer.style.left);
		idObject.DesignedTop = parseInt(outer.style.top);
	}
	else {
		idObject.DesignedLeft = 0;
		idObject.DesignedTop = 0;
	}
	idObject.DesignedWidth = parseInt(idObject.style.width);
	idObject.DesignedHeight = parseInt(idObject.style.height);

	if (idObject.Position == "poDesigned")
		idObject.SetBounds(idObject.DesignedLeft, idObject.DesignedTop, idObject.DesignedWidth, idObject.DesignedHeight); 

    // idObject.SetPositionAndSize();
}

function JTDivWindowResizeMask( id )
{
    var windowObject = document.getElementById( id );
    var maskObject = document.getElementById( id + "_modalmask" );
    var parentObject = getParentNode( windowObject );

    maskObject.style.width = parentObject.clientWidth + "px";
    maskObject.style.height = parentObject.clientHeight + "px";
}

function JTDivWindowBorderDoubleClick( e )
{
    var event = e || window.event;
    var eventObj = getEventTarget( event );
    var objNames = eventObj.id.split( "_" );
    var parentObjectName = objNames[ 0 ];
    var borderName = objNames[ 1 ];
    var parentObject = document.getElementById( parentObjectName );

    if( parentObject.Maximized )
        parentObject.Restore();
    else
        parentObject.Maximize();
        
    if( event.stopPropagation )
        event.stopPropagation();
        
    event.cancelBubble = true;
        
    return false;
}

function JTDivWindowButtonMouseDown( id, button )
{
    var buttonObject = document.getElementById( id );

    if( typeof( buttonObject.buttonType ) == "undefined" )
        buttonObject.buttonType = button;

    buttonObject.className = "jtbb jtdivwindowbutton jtdivwindowbutton_" + buttonObject.buttonType + " jtdivwindowbutton_" + buttonObject.buttonType + "_down";
}

function JTDivWindowButtonMouseUp( id, button )
{
    var buttonObject = document.getElementById( id );

    if( typeof( buttonObject.buttonType ) == "undefined" )
        buttonObject.buttonType = button;

    document.getElementById( id ).className = "jtbb jtdivwindowbutton jtdivwindowbutton_" + buttonObject.buttonType;
}
