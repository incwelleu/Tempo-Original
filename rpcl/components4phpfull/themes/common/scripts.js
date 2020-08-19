/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/
var JTIEVer = getIEVersion();
var JTAdvEditList = new Array();
var JTClockList = new Array();
var JTExplanationPopups = new Array();
var JTExplanationPopupActive = null;
var JTExplanationSkipClick = false;
var JTInputValidators = new Array();
var JTCategoryButtonsUpdateList = new Array();
var JTRegisteredOnResize = new Array();
var JTDatePickerList = new Array();
var JTDatePickerActive = null;
var JTDatePickerSkipClick = false;
var JTGridHidden = new Array();
var JTPageLoaded = false;
var JTToolBarList = new Array();
var JTToolBarScrollTimer = -1;
var JTNextFocusOut = null;
var JTIsWebKit = getIsWebKit();
var JTFFVer = getFFVersion();
var JTBaseTabControlActiveTabState = [];
var invalidValueMessage = 'You did not enter a valid value for this field. Please try again.';

addEvent( window, "load", JTAdvEditOnLoad );
addEvent( window, "load", JTExpPopupOnLoad );
addEvent( document, "click", JTExpPopupDocumentClick );
addEvent( window, "load", JTInputValidatorsOnLoad );
addEvent( window, "load", JTCategoryButtonsOnLoad );
addEvent( window, "load", JTDatePickerOnLoad );
addEvent( document, "click", JTDatePickerDocumentClick );
addEvent( window, "load", JTRegisteredDisplayChangeFire );
addEvent( window, "load", JTPageOnLoad );
addEvent( window, "load", JTToolBarOnLoad );

if( JTIEVer == -1 && typeof( document.activeElement ) == "undefined" )
	document.activeElement = null;

function JTPageOnLoad()
{
    JTPageLoaded = true;

    if( JTIEVer == -1 )
    {
		addEvent( document, "focus", JTPageElementFocus );

		var elementsOnPage = document.getElementsByTagName( "*" );
		for( var i = 0; i < elementsOnPage.length; ++i )
		{
			if( elementsOnPage[ i ].tabIndex > -1 )
				addEvent( elementsOnPage[ i ], "focus", JTPageElementFocus );
		}
    }
}

function JTPageElementFocus( e )
{
	var event = e || window.event;

	if( typeof( document.activeElement ) == "undefined" )
		document.activeElement = getEventTarget( event );

	if( JTNextFocusOut )
	{
		JTNextFocusOut( null );
		JTNextFocusOut = null;
	}
}

function JTSetOnFocusOut( eventHandler )
{
	if( JTIEVer == -1 )
		JTNextFocusOut = eventHandler;
}

function JTJSLog( message )
{
	if( typeof( console ) != "undefined" )
	{
		console.log( "JT: " + message );
	}
	else
	{
		if( typeof( jtLogWindow ) == "undefined" || jtLogWindow.closed )
		{
			jtLogWindow = window.open( "", null, "width=500,height=300,scrollbars=yes,resizable=yes,status=no,location=no,menubar=no,toolbar=no" );
			if( !jtLogWindow )
				return;

			jtLogWindow.document.open();
			jtLogWindow.document.write( "<html><head><title>JomiTech JavaScript Debug Output</title></head><body></body></html>" );
			jtLogWindow.document.close();
		}

		jtLogWindow.document.body.appendChild( jtLogWindow.document.createTextNode( message ) );
		jtLogWindow.document.body.appendChild( jtLogWindow.document.createElement( "br" ) );
		jtLogWindow.scrollTo(0, 10000);
	}
}

function JTLogAndPause( message, time )
{
	if( typeof( time ) == "undefined" )
		time = 1000;

	JTJSLog( message );

	var endTime = getCurrentTime() + time;
	while( getCurrentTime()	< endTime )
	{
		// Do nothing, we should really release the CPU, but can't.
	}
}

function getCurrentTime()
{
	return new Date().getTime();
}

function getEventTarget( e )
{
    return ( e.srcElement ) ? e.srcElement : e.target;
}

function getParentNode( object )
{
    var p = object.parentNode;

    while( p.id == ( object.id + "_outer" ) || p.id == ( object.id + "_outerdiv" ) )
        p = p.parentNode;

    return p;
}

function getSizedParentNode( object )
{
    if( getOuterNode( object ) )
        return getOuterNode( object ).offsetParent;
    else
        return object.offsetParent;
}

function getOuterNode( object )
{
    return document.getElementById( object.id + "_outer" );
}

function getBrowserScrollX()
{
    if( window.pageXOffset )
        return window.pageXOffset;
    else if( document.documentElement && document.documentElement.scrollLeft )
        return document.documentElement.scrollLeft;
    else
        return document.body.scrollLeft;
}

function getBrowserScrollY()
{
    if( window.pageYOffset )
        return window.pageYOffset;
    else if( document.documentElement && document.documentElement.scrollTop )
        return document.documentElement.scrollTop;
    else
        return document.body.scrollTop;
}

function setBrowserScrollX( x )
{
	window.scroll( x, getBrowserScrollY() );
}

function setBrowserScrollY( y )
{
	window.scroll( getBrowserScrollX(), y );
}

function getBrowserWidth()
{
    if( document.documentElement && document.documentElement.clientWidth )
        return document.documentElement.clientWidth;
    else
        return document.body.clientWidth;
}

function getBrowserHeight() {
    var height;

    if (window.innerHeight) {
        height = window.innerHeight;
    }
    else {
        height = document.body.parentNode.clientHeight;
        if (height == 0)
            height = document.body.clientHeight;
    }

    var scrollBarWidth = (window.innerWidth ? window.innerWidth : document.body.offsetWidth) - getBrowserWidth();

    return height - scrollBarWidth;
}

function getDocumentHeight() {
	if (document.documentElement && document.documentElement.clientHeight)
        return document.documentElement.clientHeight;
    else
        return document.body.clientHeight;
}

function getObjectScreenX( object )
{
    var op, x = 0;

    while( object && object != document.body )
    {
        x += object.offsetLeft;
        op = object.offsetParent;
        while (object != op && op != null) {
        	object = object.parentNode;
        	if (object && object != document.body)
        		x -= object.scrollLeft;
        }
        object = op;
    }

    return x;
}

function getObjectScreenY( object )
{
    var y = 0;

    while( object && object != document.body )
    {
        y += object.offsetTop;
        if( object.offsetParent )
			y -= object.scrollTop;

        object = object.offsetParent;
    }

    return y;
}

function setObjectScreenY( object, y )
{
    y -= getObjectScreenY( getParentNode( object ) );

    getTruePositionNode( object ).style.top = y + "px";
}

function getIEVersion()
{
    var rv = -1;

    if( navigator.appName == 'Microsoft Internet Explorer' )
    {
        var ua = navigator.userAgent;
        var re = new RegExp( "MSIE ([0-9]{1,}[\.0-9]{0,})" );

        if( re.exec( ua ) != null )
            rv = parseFloat( RegExp.$1 );
    }

    return rv;
}

function getIsWebKit()
{
	return ( navigator.userAgent.toLowerCase().indexOf( " applewebkit/" ) > -1 );
}

function getFFVersion()
{
	var rv = -1;
	var ua = navigator.userAgent;
    var re = new RegExp( " Firefox/([0-9]+).+" );

    if( re.exec( ua ) != null )
		rv = parseFloat( RegExp.$1 );

    return rv;
}

function getTruePositionNode( obj )
{
    if( getOuterNode( obj ) )
        return getOuterNode( obj );
    else
        return obj;
}

function getParentWidth( obj )
{
    if( getSizedParentNode( obj ) == document.body )
        return getBrowserWidth();
    else
        return getTruePositionNode( getSizedParentNode( obj ) ).clientWidth;
}

function getParentHeight( obj )
{
    if( getSizedParentNode( obj ) == document.body )
        return getDocumentHeight();
    else
        return getTruePositionNode( getSizedParentNode( obj ) ).clientHeight;
}

function getParentForm(obj) {
    while (obj) {
        if (obj.tagName == "FORM") {
            return obj;
        }
        obj = obj.parentNode;
    }

    return null;
}

function addEvent( object, eventName, functionPtr )
{
    if( window.addEventListener )
        object.addEventListener( eventName, functionPtr, false );
    else if( window.attachEvent )
        object.attachEvent( "on" + eventName, functionPtr );
}

function deleteEvent( object, eventName, functionPtr )
{
    if( window.removeEventListener )
        object.removeEventListener( eventName, functionPtr, false );
    else if( window.detachEvent )
        object.detachEvent( "on" + eventName, functionPtr );
}

function addOnSubmitEvent( object, functionPtr )
{
    addEvent( object, "submit", functionPtr );

    if( typeof( object.onSubmitEvents ) == "undefined" )
    {
        object.onSubmitEvents = new Array();

        object.oldSubmit = object.submit;
        object.submit = function()
        {
            if( JTIEVer == -1 )
            {
                var e = new JTEvent( this, "submit" );
                var i;

                for( i = 0; i < this.onSubmitEvents.length; ++i )
                {
                    var funcPtr = this.onSubmitEvents[ i ];

                    if( !funcPtr( e ) )
                        return;
                }
            }
            else
            {
                if( !this.fireEvent( "onsubmit" ) )
                    return;
            }

            this.oldSubmit();
        }

    }

    object.onSubmitEvents.push( functionPtr );
}

function getEventPageX( e )
{
	return e.clientX + getBrowserScrollX();
}

function getEventPageY( e )
{
	return e.clientY + getBrowserScrollY();
}

function getSelectionLength( f )
{
    var l = 0;

    if( document.selection )
    {
        f.focus();

        var range = document.selection.createRange();

        l = range.text.length;
    }
    else if( f.selectionStart || f.selectionStart == "0" )
    {
        l = f.selectionEnd - f.selectionStart;
    }

    return l;
}

function getCaretPosition( f )
{
    var i = 0;

    if( document.selection )
    {
        f.focus();

        var range = document.selection.createRange();

        range.moveStart( 'character', -f.value.length );

        i = range.text.length;
    }
    else if( f.selectionEnd || f.selectionStart == "0" )
    {
        i = f.selectionEnd;
    }

    return i;
}


function setCaretPosition( f, pos, selLength )
{
    if( document.selection )
    {
        f.focus();

        var range = document.selection.createRange();

        range.moveStart( 'character', -f.value.length );
        range.moveEnd( 'character', -f.value.length );

        range.moveStart( 'character', pos );
        range.moveEnd( 'character', selLength );

        range.select();
    }
    else if( f.selectionStart || f.selectionStart == '0' )
    {
        f.selectionStart = pos;
        f.selectionEnd = pos + selLength;
        f.focus();
    }
}

function parseDBDate( dateStr )
{
    var dateAndTime = /^([\d]{4})\-([\d]{2})\-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})/;
    var dateOnly = /^([\d]{4})\-([\d]{2})\-([\d]{2})/;
    var timeOnly = /^([\d]{2}):([\d]{2}):([\d]{2})/;
    var matches;
    if (matches = dateAndTime.exec(dateStr)) {
        return new Date(matches[1], matches[2] - 1, matches[3], matches[4], matches[5], matches[6]);
    }
    else if (matches = dateOnly.exec(dateStr)) {
        return new Date(matches[1], matches[2] - 1, matches[3]);
    }
    else if (matches = timeOnly.exec(dateStr)) {
        var now = new Date();
        return new Date(now.getFullYear(), now.getMonth(), now.getDate(), matches[1], matches[2], matches[3]);
    }
    else {
        return null;
    }
}

function getDaysInMonth( year, month )
{
    var dateObj = new Date( year, month + 1, 0 );

    return dateObj.getDate();
}

function getFirstDayInMonth( year, month )
{
    var dateObj = new Date( year, month, 1 );

    return dateObj.getDay();
}

function getMonthByName( month )
{
	return getMonthName( month );
}

function getMonthName( month )
{
    if( typeof( monthNames ) == "undefined" )
        monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

    return monthNames[ month ];
}

function getAbbrevMonthName( month )
{
    if( typeof( abbrevMonthNames ) == "undefined" )
        abbrevMonthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

    return abbrevMonthNames[ month ];
}

function getDayName( i )
{
    if( typeof( dayNames ) == "undefined" )
        dayNames = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];

    return dayNames[ i ];
}

function getAbbrevDayName( i )
{
	if( typeof( abbrevDayNames ) == "undefined" )
        abbrevDayNames = [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ];

    return abbrevDayNames[ i ];
}

function getSingleDayName(i) {
	if (typeof (singleDayNames) == "undefined")
		singleDayNames = ["S", "M", "T", "W", "T", "F", "S"];

	return singleDayNames[i];
}

function strPad( str, length, character, side )
{
    str = new String( str );

    while( str.length < length )
    {
        if( side == "left" )
            str = character + str;
        else
            str += character;
    }

    return str;
}

function getTotalDocumentTagCount()
{
    var all = document.all || document.getElementsByTagName( "*" );

    return all.length;
}

function safeSplit( str, delimeter )
{
	if( str.length == 0 )
		return new Array();
	else
		return str.split( delimeter );
}

function isChild( child, parent )
{
	while( child )
	{
		if( child == parent )
			return true;

		child = child.parentNode;
	}

	return false;
}

function phpDateToStr( format, date ) {
	if (format.length == 0)
		format = "Y-m-d";
	if (date == null)
		return "";

	format = format.replace( /(?!\\)d/g, strPad( date.getDate(), 2, "0", "left" ) );
	format = format.replace( /(?!\\)D/g, getAbbrevDayName( date.getDay() ) );
	format = format.replace( /(?!\\)j/g, date.getDate() );
	format = format.replace( /(?!\\)l/g, getDayName( date.getDay() ) );
	format = format.replace( /(?!\\)N/g, (date.getDay() == 0) ? 7 : (date.getDay() + 1) );
	var ending, lastDigit = date.getDate() - ( Math.floor( date.getDate() / 10 ) * 10 );
	if( lastDigit == 1 )
		ending = "st";
	else if( lastDigit == 2 )
		ending = "nd";
	else if( lastDigit == 3 )
		ending = "rd";
	else
		ending = "th";
	format = format.replace( /(?!\\)S/g, ending );
	format = format.replace( /(?!\\)w/g, date.getDay() );
	format = format.replace( /(?!\\)F/g, getMonthName( date.getMonth() ) );
	format = format.replace( /(?!\\)m/g, strPad( date.getMonth() + 1, 2, "0", "left" ) );
	format = format.replace( /(?!\\)M/g, getAbbrevMonthName( date.getMonth() ) );
	format = format.replace( /(?!\\)n/g, date.getMonth() + 1 );
	format = format.replace( /(?!\\)Y/g, date.getFullYear() );
	format = format.replace( /(?!\\)y/g, date.getYear() % 100 );
	format = format.replace( /(?!\\)a/g, date.getHours() < 12 ? "am" : "pm" );
	format = format.replace( /(?!\\)A/g, date.getHours() < 12 ? "AM" : "PM" );
	var amPmTime = date.getHours();
	if( amPmTime == 0 )
		amPmTime = 12;
	else if( amPmTime > 12 )
		amPmTime -= 12;
	format = format.replace( /(?!\\)g/g, amPmTime );
	format = format.replace( /(?!\\)G/g, date.getHours() + 1 );
	format = format.replace( /(?!\\)h/g, strPad( amPmTime, 2, "0", "left" ) );
	format = format.replace( /(?!\\)H/g, date.getHours() );
	format = format.replace( /(?!\\)i/g, strPad( date.getMinutes(), 2, "0", "left" ) );
	format = format.replace( /(?!\\)s/g, strPad( date.getSeconds(), 2, "0", "left" ) );
	format = format.replace( /(?!\\)u/g, date.getMilliseconds() );
	format = format.replace( /(?!\\)O/g, (date.getTimezoneOffset() < 0 ? "-" : "+") + Math.floor(date.getTimezoneOffset() / 60) + "00" );
	format = format.replace( /(?!\\)P/g, (date.getTimezoneOffset() < 0 ? "-" : "+") + Math.floor(date.getTimezoneOffset() / 60) + ":00" );
	format = format.replace( /(?!\\)Z/g, date.getTimezoneOffset() * 60 );
	format = format.replace( /(?!\\)c/g, function() { return phpDateToStr( "Y-m-d\\TH:i:sP", date ); } );
	format = format.replace( /(?!\\)r/g, function() { return phpDateToStr( "D, j M Y H:i:s O", date ); } );
	format = format.replace( /(?!\\)U/g, date.getTime() );
	return format;
}

function JTGetChildrenByTagName( Object, TagName )
{
	var result = [];

	if( Object )
	{
		for( var i = 0; i < Object.childNodes.length; ++i )
		{
			if( Object.childNodes[ i ].tagName == TagName )
				result.push( Object.childNodes[ i ] );
		}
	}

	return result;
}

function JTLocateFirstChildByTagName( Object, TagName )
{
    if( !Object )
        return;

    var i;

    for( i = 0; i < Object.childNodes.length; ++i )
    {
        if( Object.childNodes[ i ].tagName == TagName )
            return Object.childNodes[ i ];
    }

    return null;
}

function JTGetChildrenByClassName( Object, ClassName )
{
	var result = [];

	if (Object)	{
		for (var i = 0; i < Object.childNodes.length; ++i) {
		    if (Object.childNodes[i].className) {
		        var cn = Object.childNodes[ i ].className;
			    if (cn.substr(0, ClassName.length) == ClassName || cn.indexOf(" " + ClassName) > -1) {
				    result.push(Object.childNodes[i]);
    		    }
    		}
		}
	}

	return result;
}

function JTLocateFirstChildByClassName( Object, ClassName )
{
    if( !Object )
        return;

    for (var i = 0; i < Object.childNodes.length; ++i)
    {
        if( Object.childNodes[ i ].className )
        {
            var cn = Object.childNodes[ i ].className;
            if (cn.substr(0, ClassName.length) == ClassName || cn.indexOf(" " + ClassName) > -1) {
                return Object.childNodes[ i ];
            }
        }
    }

    return null;
}

function ParentSendDisplayChanged( parent )
{
    if( typeof( parent.childDisplayList ) == "undefined" )
        return;

    for( var i = 0; i < parent.childDisplayList.length; ++i )
        parent.childDisplayList[ i ].onParentDisplayChange();
}

function registerForDisplayChange( object )
{
    if( typeof( object.onParentDisplayChange ) == "undefined" )
        return;

    var parent = object;
    while( parent )
    {
        if( ( parent.style && ( parent.style.display.toLowerCase() == "none" || parent.className.indexOf(" dc") > -1 ) ) || parent == document.body )
            break;

        parent = parent.parentNode;
    }

    if( !parent )
        return;

    if( typeof( parent.childDisplayList ) == "undefined" )
        parent.childDisplayList = new Array();

	for( var i = 0; i < parent.childDisplayList.length; ++i )
	{
		if( parent.childDisplayList[ i ] == object )
			return;
	}

    parent.childDisplayList.push(object);

    if (parent.clientWidth != 0) {
        object.onParentDisplayChange();
    }
}

function JTRegisteredDisplayChangeFire() {
    ParentSendDisplayChanged( document.body );
}

function inArray( arr, str )
{
    for( var i = 0; i < arr.length; ++i )
    {
        if( arr[ i ] == str )
            return true;
    }

    return false;
}

function JTObjectToJSON( obj )
{
	var m = { '\b': '\\b', '\t': '\\t', '\n': '\\n', '\f': '\\f', '\r': '\\r', '"' : '\\"', '\\': '\\\\' };

	s = {
		array: function( x )
		{
			var a = ['['], b, f, i, l = x.length, v;
			for (i = 0; i < l; i += 1) {
				v = x[i];
				f = s[typeof v];
				if (f) {
					v = f(v);
					if (typeof v == 'string') {
						if (b) {
							a[a.length] = ',';
						}
						a[a.length] = v;
						b = true;
					}
				}
			}
			a[a.length] = ']';
			return a.join('');
		},
		'boolean': function (x) {
			return String(x);
		},
		'null': function (x) {
			return "null";
		},
		number: function (x) {
			return isFinite(x) ? String(x) : 'null';
		},
		object: function (x) {
			if (x) {
				if (x instanceof Array) {
					return s.array(x);
				}
				if (!x.json)
				{
				x.json=1;
				var a = ['{'], b, f, i, v;
				for (i in x) {
					v = x[i];
					f = s[typeof v];
					if (f) {
						v = f(v);
						if (typeof v == 'string') {
							if (b) {
								a[a.length] = ',';
							}
							a.push(s.string(i), ':', v);
							b = true;
						}
					}
				}
				a[a.length] = '}';
				return a.join('');
				}
			}
			return 'null';
		},
		string: function (x) {
			if (/["\\\x00-\x1f]/.test(x)) {
				x = x.replace(/([\x00-\x1f\\"])/g, function(a, b) {
					var c = m[b];
					if (c) {
						return c;
					}
					c = b.charCodeAt();
					return '\\u00' +
						Math.floor(c / 16).toString(16) +
						(c % 16).toString(16);
				});
			}
			return '"' + x + '"';
		}
	};

	return s.object( obj );
}

function JTEnableFocus(i) {
	if (typeof (this.oldTabIndex) != "undefined") {
		if (this.tagName == "INPUT" || this.tagName == "BUTTON" || this.tagName == "SELECT" || this.tagName == "A" || this.tagName == "TEXTAREA") {
			if (parseInt(this.oldTabIndex) != NaN && this.oldTabIndex >= 0)
				this.tabIndex = this.oldTabIndex;
			else
				this.tabIndex = "0";
		}
	}
}

function JTDisableFocus(i) {
	if (this.tagName == "INPUT" || this.tagName == "BUTTON" || this.tagName == "SELECT" || this.tagName == "A" || this.tagName == "TEXTAREA") {
		this.oldTabIndex = this.tabIndex;
		this.tabIndex = "-1";
	}
}

Array.prototype.indexOf = function( str )
{
    for( var i = 0; i < this.length; ++i )
    {
        if( this[ i ] == str )
            return i;
    }
    return -1;
}

Array.prototype.removeItem = function( str )
{
    var i = this.indexOf( str );
    if( i > -1 )
        this.splice( i, 1 );
}

String.prototype.trim = function()
{
	return this.replace( /^\s+|\s+$/g, "" );
}

function submitClickEvent( object, value )
{
    object.submitInputElement.value = value;

    if( ( object.form.onsubmit ) && ( typeof( object.form.onsubmit ) == 'function' ) )
        object.form.onsubmit();

    object.form.submit();
}

function JTJSFont( fontFamily, fontSize, fontColor, fontWeight, fontLineHeight, fontAlign, fontStyle, fontVariant, fontCase )
{
    this.fontAlign = fontAlign;
    this.fontCase = fontCase;
    this.fontColor = fontColor;
    this.fontFamily = fontFamily;
    this.fontLineHeight = fontLineHeight;
    this.fontSize = fontSize;
    this.fontStyle = fontStyle;
    this.fontVariant = fontVariant;
    this.fontWeight = fontWeight;

    this.applyToObjectStyle = function( object )
    {
        object.style.fontFamily = this.fontFamily;
        object.style.fontSize = this.fontSize;
        object.style.color = this.fontColor;
        object.style.fontWeight = this.fontWeight;
        object.style.lineHeight = this.fontLineHeight;
        object.style.textAlign = this.fontAlign;
        object.style.fontStyle = this.fontStyle;
        object.style.fontVariant = this.fontVariant;
        object.style.textTransform = this.fontCase;
    }
}

function JTPageControlChangeEvent( pageControlObject, activeTab )
{
    this.PageControl = pageControlObject;
    this.ActiveTab = activeTab;
}

function JTEvent( fromElement, type )
{
    this.target = fromElement;
    this.srcElement = fromElement;
    this.type = type;
}

function JTPageControlSetTabState( pageControlObject, tabsheet, index, activeindex )
{
    var centerclasstype, tabclasstype;

    centerclasstype = ( index == activeindex ) ? 'active' : 'inactive';

    if( index == activeindex )
        tabclasstype = 'active';
    else if( index < activeindex )
        tabclasstype = 'before';
    else
        tabclasstype = 'after';

    document.getElementById( "jttabbutton_" + tabsheet ).className = "jtbb jtfont jttab jttab_" + centerclasstype;
    document.getElementById( "jttabinner_" + tabsheet ).className = "jtbb jtfont jttabinner jttabinner_" + tabclasstype;
    document.getElementById( "jttabinner2_" + tabsheet ).className = "jtbb jttabinner2 jttabinner2_" + centerclasstype;

    if( document.getElementById( tabsheet ) )
    {
        if( index == activeindex )
        {
            document.getElementById( tabsheet ).style.zIndex = "3";
            document.getElementById( tabsheet ).style.display = "block";
            ParentSendDisplayChanged( document.getElementById( tabsheet ) );
        }
        else
        {
            document.getElementById( tabsheet ).style.zIndex = "1";
            document.getElementById( tabsheet ).style.display = "none";
        }
    }
}

function JTPageControlTabClick( pagecontrol, tabsheet )
{
    var pageControlObject = document.getElementById( pagecontrol );
    var tabs = pageControlObject.Tabs;
    var i;
    var ActiveTab;

	if( !tabs )
		return;

    for( i = 0; i < tabs.length; ++i )
    {
        if( tabs[ i ] == tabsheet )
            break;
    }

    if( i < tabs.length )
        ActiveTab = i;
    else
        ActiveTab = -1;

    JTPageControlSetTabState( pageControlObject, tabs[ ActiveTab ], ActiveTab, ActiveTab );

    for( i = 0; i < tabs.length; ++i )
    {
        if( i != ActiveTab )
            JTPageControlSetTabState( pageControlObject, tabs[ i ], i, ActiveTab );
    }

    if( pageControlObject.TabIndex != ActiveTab )
    {
        pageControlObject.TabIndex = ActiveTab;
    	JTBaseTabControlActiveTabState[pagecontrol] = ActiveTab;

    	document.getElementById(pagecontrol + "_Index").value = ActiveTab;

        if( pageControlObject.OnChange )
        {
            var pageControlEvent = new JTPageControlChangeEvent( pageControlObject, ActiveTab );

            pageControlObject.OnChange( pageControlEvent );
        }
    }
}

function JTAddPageControlTabs( pagecontrol, tabs )
{
    PageControlTabs[ pagecontrol ] = tabs;
}

function JTExpandPanelClick( id )
{
    var panelObject = document.getElementById( id );

    JTSetExpandPanelState( id, ( panelObject.PanelState == "psHidden" ) ? "psVisible" : "psHidden" );

    if( panelObject.OnChange )
        panelObject.OnChange( panelObject, panelObject.PanelState );
}

function JTSetExpandPanelState( id, state )
{
    var panelObject = document.getElementById( id );
    var panelContent = document.getElementById( id + "_content" );
    var panelControl = document.getElementById( id + "_control" );
    var panelControlSpan = document.getElementById( id + "_controltext" );
    var panelOuter = document.getElementById( id + "_outer" );
    var ncStartX = 0;
    var ncObject = null;

    if( panelObject.NextControl )
    {
        ncObject = document.getElementById( panelObject.NextControl + "_outer" );
        if( !ncObject )
            ncObject = document.getElementById( panelObject.NextControl );
    }

    if( ncObject )
        ncStartX = panelObject.offsetHeight;

    if( state == "psVisible" )
    {
        panelContent.style.display = "block";
        panelObject.style.height = panelObject.origHeight;

		if( panelOuter && typeof( panelOuter.originalHeight ) != "undefined" )
			panelOuter.style.height = panelOuter.originalHeight;

        setTimeout( "document.getElementById( '" + ( id + "_controltext" ) + "' ).innerHTML = '" + panelObject.HideText + "'", 1 );

        ParentSendDisplayChanged( panelContent );
    }
    else
    {
        panelContent.style.display = "none";
        panelObject.style.height = "";

		if( panelOuter )
		{
			panelOuter.originalHeight = panelOuter.style.height;
			panelOuter.style.height = panelObject.offsetHeight + "px";
		}

        setTimeout( "document.getElementById( '" + ( id + "_controltext" ) + "' ).innerHTML = '" + panelObject.ShowText + "'", 1 );
    }

    panelObject.PanelState = state;

    if( ncObject )
        setObjectScreenY( ncObject, getObjectScreenY( ncObject ) + ( panelObject.offsetHeight - ncStartX ) );
}

function JTGridDoSelectCell( GridID, GridObject, Row, Col )
{
    JTGridSetGridSelectionState( GridID, GridObject, GridObject.SelectedRow, GridObject.SelectedCol, false );
    JTGridSetGridSelectionState( GridID, GridObject, Row, Col, true );

    GridObject.SelectedRow = Row;
    GridObject.SelectedCol = Col;

    JTGridScrollCellIntoView( GridID, GridObject, Row, Col );
}

function JTGridScrollCellIntoView( GridID, GridObject, Row, Col )
{
    var dataDiv = document.getElementById( GridID + "_data" );
    var headerDiv = document.getElementById( GridID + "_headerdiv" );
    var selectedCell = document.getElementById( GridID + "_cell_" + Row + "_" + Col );

    //if( GridObject.ShouldScroll )
    {
        if( ( dataDiv.scrollTop + headerDiv.offsetHeight ) > selectedCell.offsetTop )
            dataDiv.scrollTop = selectedCell.offsetTop - headerDiv.offsetHeight;
        else if( ( dataDiv.scrollTop + dataDiv.clientHeight ) < ( selectedCell.offsetTop + selectedCell.offsetHeight ) )
            dataDiv.scrollTop = selectedCell.offsetTop - ( dataDiv.clientHeight - selectedCell.offsetHeight - 1 );
    }
    //if( GridObject.ShouldHorzScroll )
    {
        if( dataDiv.scrollLeft > selectedCell.offsetLeft )
        {
            dataDiv.scrollLeft = selectedCell.offsetLeft - 1;
        }
        else if( ( dataDiv.scrollLeft + dataDiv.offsetWidth ) < ( selectedCell.offsetLeft + selectedCell.offsetWidth ) )
        {
            if( dataDiv.offsetWidth <= selectedCell.offsetWidth )
                dataDiv.scrollLeft = selectedCell.offsetLeft;
            else
                dataDiv.scrollLeft = ( selectedCell.offsetLeft + selectedCell.offsetWidth ) - dataDiv.clientWidth;
        }
    }
}

function JTGridSetGridSelectionState( GridID, GridObject, Row, Col, Selected )
{
    if( GridObject.RowSelect )
    {
        if( Row < 0 )
            return;

        var RowObject = document.getElementById( GridID + "_row_" + Row );
        var RowCells = RowObject.getElementsByTagName( "TD" );
        var RowClass;
        var RowColor;
        var i;

        if( Selected )
        {
            RowObject.lastBackColor = RowObject.style.backgroundColor;
            RowObject.lastClassName = RowObject.className;

            RowClass = "jtgrid_row_selected";
            RowColor = GridObject.SelectedColor;
        }
        else
        {
            RowClass = RowObject.lastClassName;
            RowColor = RowObject.lastBackColor;
        }

        RowObject.className = RowClass;
        RowObject.style.backgroundColor = RowColor;

        for( i = 0; i < RowCells.length; ++i )
        {
            JTGridSetGridCellSelectionState( GridID, GridObject, RowCells[ i ], Row, Col, Selected );
        }
    }
    else
    {
        if( Row < 0 || Col < 0 )
            return;

        JTGridSetGridCellSelectionState( GridID, GridObject, document.getElementById( GridID + "_cell_" + Row + "_" + Col ), Row, Col, Selected );
    }

    if( Selected )
    {
        document.getElementById( GridID + "_sr" ).value = Row;
        document.getElementById( GridID + "_sc" ).value = Col;
    }
}

function JTGridSetGridCellSelectionState( GridID, GridObject, CellObject, Row, Col, Selected )
{
    if( Selected )
    {
        CellObject.lastClassName = CellObject.className
        CellObject.lastStyle = CellObject.style.cssText;

        CellClass = "jtgrid_data_cell jtgrid_cell_selected";
        CellColor = GridObject.SelectedColor;
        CellFont = GridObject.SelectedFont;

        CellObject.style.backgroundColor = CellColor;
        CellFont.applyToObjectStyle( CellObject );
    }
    else
    {
        CellClass = CellObject.lastClassName;

        CellObject.style.cssText = CellObject.lastStyle;
    }

    CellObject.className = CellClass;
}

function JTGridDoCellDoubleClick( GridID, GridObject, Row, Col )
{
    JTGridDoSelectCell( GridID, GridObject, Row, Col );

    if( document.getElementById( GridID + "_cell_" + Row + "_" + Col + "_dataview" ) )
        return;

    var gridInput = document.getElementById( GridID + "Input" );
    var gridCell = document.getElementById( GridID + "_cell_" + Row + "_" + Col );
    var gridData = document.getElementById( GridID + "_data" );
    var gridRows = document.getElementById( GridID + "_data" );

    gridInput.value = JTGridGetCellText( GridID, Row, Col );
    gridInput.style.fontFamily = gridCell.style.fontFamily;
    gridInput.style.fontSize = gridCell.style.fontSize;
    gridInput.style.left = gridCell.offsetLeft - gridData.scrollLeft + gridData.offsetLeft + gridRows.offsetLeft + "px";
    gridInput.style.top = gridCell.offsetTop - gridData.scrollTop + gridData.offsetTop + gridRows.offsetTop + "px";
    gridInput.style.width = gridCell.offsetWidth + "px";
    gridInput.style.display = "block";
    gridInput.focus();
}

function JTGridDoInputBlur( GridID )
{
    var GridObject = document.getElementById( GridID );
    var gridInput = document.getElementById( GridID + "Input" );
    var oldText = JTGridGetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol );

    gridInput.style.display = "none";
}

function JTGridDoInputKeyUp( e )
{
    var event = e || window.event;
    var kc = event.charCode || event.keyCode;

    if( kc != 13 && kc != 10 )
        return true;

    var gridInput = getEventTarget( event );
    var GridID = gridInput.id.substr( 0, gridInput.id.length - 5 );
    var GridObject = document.getElementById( GridID );
    var oldText = JTGridGetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol );

    gridInput.style.display = "none";

    if( gridInput.value != oldText )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldText, gridInput.value ) == false )
            return false;

        JTGridSetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol, gridInput.value );
    }

    return false;
}

function JTGridOnSelectChange( e )
{
    var event = e || window.event;
    var dataView = getEventTarget( event );
    var dataValue = document.getElementById( dataView.id.substr( 0, dataView.id.length - 9 ) + "_value" );
    var GridID = dataView.id.split( "_" )[ 0 ];
    var GridObject = document.getElementById( GridID );
    var newValue = dataView.options[ dataView.selectedIndex ].text;
    var oldValue = dataValue.value;

    if( newValue != oldValue )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldValue, newValue ) == false )
        {
            for( var i = 0; i < dataView.options.length; ++i )
            {
                if( dataView.options[ i ].text == oldValue )
                {
                    dataView.selectedIndex = i;
                    break;
                }
            }
        }
        else
        {
            dataValue.value = newValue;
        }
    }
}

function JTGridOnCheckChange( e )
{
    var event = e || window.event;
    var dataView = getEventTarget( event );
    var dataValue = document.getElementById( dataView.id.substr( 0, dataView.id.length - 9 ) + "_value" );
    var GridID = dataView.id.split( "_" )[ 0 ];
    var GridObject = document.getElementById( GridID );
    var newValue = ( dataView.checked ? "1" : "0" );
    var oldValue = dataValue.value;

    if( newValue != oldValue )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldValue, newValue ) == false )
        {
            dataView.checked = ( oldValue == "1" );
        }
        else
        {
            dataValue.value = newValue;
        }
    }
}

function JTGridGetCellText( GridID, Row, Col )
{
    var gridObject = document.getElementById( GridID );

    return gridObject.getCellValue( Row, Col );
}

function JTGridSetCellText( GridID, Row, Col, Value )
{
    var gridObject = document.getElementById( GridID );

    gridObject.setCellValue( Row, Col, Value );
}

function JTGridGetCellHTML( GridID, Row, Col )
{
    var gridObject = document.getElementById( GridID );

    return gridObject.getCellHTML( Row, Col );
}

function JTGridSetCellHTML( GridID, Row, Col, Value )
{
    var gridObject = document.getElementById( GridID );

    gridObject.setCellHTML( Row, Col, Value );
}

function JTGridInitColumns( GridID )
{
    var gridObject = document.getElementById( GridID );
    var gridHeader = document.getElementById( GridID + "_header" );
    var gridData = document.getElementById( GridID + "_rows" );
    var i;

    if( /*!gridHeader ||*/ !gridData )
        return;

    var gridBody, firstGridRow;

    gridBody = JTLocateFirstChildByTagName( gridData, "TBODY" );
    firstGridRow = JTLocateFirstChildByTagName( gridBody, "TR" );
    if( !firstGridRow )
        return;

    var dataColumnArray = firstGridRow.getElementsByTagName( "TD" );
    var dataDiv = document.getElementById( GridID + "_data" );

    // gridHeader = JTLocateFirstChildByTagName( gridHeader, "TBODY" );
    // gridHeader = JTLocateFirstChildByTagName( gridHeader, "TR" );
    gridHeader = document.getElementById( GridID + "_headerdiv" );
    if( gridHeader )
    {
        // var columnArray = gridHeader.getElementsByTagName( "TD" );
        var columnArray = gridHeader.getElementsByTagName( "DIV" );

        if( dataColumnArray.length > 0 && dataColumnArray[ 0 ].offsetWidth == 0 )
        {
            // setTimeout( "JTGridInitColumns( '" + GridID + "' )", 10 );
            registerForDisplayChange( gridObject );
            return;
        }

        var headerDiv = document.getElementById( GridID + "_headerdiv" );
        if( headerDiv )
        {
            headerDiv.style.width = ( dataDiv.clientWidth == 0 ? dataDiv.offsetWidth : dataDiv.clientWidth ) + "px";
            headerDiv.style.height = firstGridRow.offsetHeight + "px";
        }

        var s = 0;

        for( i = 0; i < columnArray.length; ++i )
        {
            if( dataColumnArray.length <= i )
                break;

            columnArray[ i ].style.left = s + "px";
            columnArray[ i ].style.width = ( dataColumnArray[ i ].offsetWidth - (jQuery.boxModel || jQuery.support.boxModel ? 7 : 0) ) + "px";
            columnArray[ i ].style.height = ( dataColumnArray[ i ].offsetHeight - 6 ) + "px";
            columnArray[ i ].style.zIndex = i + 1;

            s += dataColumnArray[ i ].offsetWidth;
        }

        // document.getElementById( GridID + "_header" ).style.width = ( s - 1 ) + "px";
        //document.getElementById( GridID + "_headerdiv" ).style.width = ( s + 1 ) + "px";
    }

    if( dataColumnArray )
        gridObject.ColCount = dataColumnArray.length;

    if( gridBody )
        gridObject.RowCount = gridBody.getElementsByTagName( "TR" ).length - 1;

    dataDiv.gridID = GridID;
    dataDiv.onscroll = JTGridGridScroll;
}

function JTGridSelectCellHandler( event, GridID, Row, Col )
{
	var e = event || window.event;
    var GridObject = document.getElementById( GridID );

    var OldSelRow = document.getElementById( GridID + "_sr" ).value;
    var OldSelCol = document.getElementById( GridID + "_sc" ).value;

    document.getElementById( GridID + "_sr" ).value = Row;
    document.getElementById( GridID + "_sc" ).value = Col;

    if( GridObject.OnSelectCell && GridObject.OnSelectCell( e, GridObject, Row, Col ) == false )
    {
        document.getElementById( GridID + "_sr" ).value = OldSelRow;
        document.getElementById( GridID + "_sc" ).value = OldSelCol;
        return;
    }

    JTGridDoSelectCell( GridID, GridObject, Row, Col );
}

function JTGridHeaderClickHandler( GridID, Col )
{
    var GridObject = document.getElementById( GridID );

    if( GridObject.OnHeaderClick )
        GridObject.OnHeaderClick( GridObject, Col );
}

function JTGridGridScroll( e )
{
    var event = e || window.event;
    var target = getEventTarget( event );
    var headerObject = document.getElementById( target.gridID + "_headerdiv" );

    headerObject.scrollLeft = target.scrollLeft;
}

function JTGridOnKeyPress( e )
{
    var event = e || window.event;
    var target = getEventTarget( event );
    var kc = event.keyCode;
    var gridID = target.id.split( "_" )[ 0 ];
    var gridObject = document.getElementById( gridID );

    if( !gridObject.RowSelect && kc == 37 && gridObject.SelectedCol > 0 )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow, gridObject.SelectedCol - 1 );
    else if( kc == 38 && gridObject.SelectedRow > 0 )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow - 1, gridObject.SelectedCol );
    else if( !gridObject.RowSelect && kc == 39 && gridObject.SelectedCol < ( gridObject.ColCount - 1 ) )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow, gridObject.SelectedCol + 1 );
    else if( kc == 40 && gridObject.SelectedRow < ( gridObject.RowCount - 1 ) )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow + 1, gridObject.SelectedCol );
	else if( kc == 33 )
	{
        if( gridObject.SelectedRow > 4 )
			JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow - 5, gridObject.SelectedCol );
		else
			JTGridSelectCellHandler( e, gridID, 0, gridObject.SelectedCol );
	}
    else if( kc == 34 )
	{
		if( gridObject.SelectedRow < ( gridObject.RowCount - 5 ) )
			JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow + 5, gridObject.SelectedCol );
		else
			JTGridSelectCellHandler( e, gridID, gridObject.RowCount - 1, gridObject.SelectedCol );
	}
    else
        return;

    if( event.stopPropagation )
        event.stopPropagation();
    if( event.preventDefault )
        event.preventDefault();
    return false;
}

function JTGridInitialize( gridID )
{
    var gridObject = document.getElementById( gridID );

    gridObject.onParentDisplayChange = function()
    {
        JTGridInitColumns( this.id );
    }

    gridObject.getCellValue = function( row, col )
    {
        if( row < 0 || col < 0 )
            return "";

        var cellID = this.id + "_cell_" + row + "_" + col;
		var cell = document.getElementById( cellID );

        if( document.getElementById( cellID + "_value" ) )
            return document.getElementById( cellID + "_value" ).value;
		else if (typeof (cell.innerText) != "undefined")
			return cell.innerText;
		else if (typeof (cell.textContent) != "undefined")
			return cell.textContent;
		else
			return cell.innerHTML.replace(/<[^>]+>/g, "");
    }

    gridObject.setCellValue = function( row, col, value )
    {
        if( row < 0 || col < 0 )
            return;

        var cellID = this.id + "_cell_" + row + "_" + col;
        var cellValue = document.getElementById( cellID + "_value" );

        if( cellValue )
        {
            cellValue.value = value;
            var cellDataView = document.getElementById( cellID + "_dataview" );
            if( cellDataView.tagName == "SELECT" )
            {
                dataView.selectedIndex = -1;
                for( var i = 0; i < dataView.options.length; ++i )
                {
                    if( dataView.options[ i ].text == value )
                    {
                        dataView.selectedIndex = i;
                        break;
                    }
                }
            }
            else if( cellDataView.tagName == "INPUT" )
            {
                cellDataView.checked = !( value == "" || value == "0" );
            }
        }
        else
        {
			var cell = document.getElementById( cellID );

			if (typeof (cell.innerText) != "undefined")
				cell.innerText = value;
			else if (typeof (cell.textContent) != "undefined")
				cell.textContent = value;
			else
				cell.innerHTML = value;
        }

        JTGridInitColumns( this.id );
    }

	gridObject.getCellHTML = function( row, col )
	{
        if( row < 0 || col < 0 )
            return "";

        var cellID = this.id + "_cell_" + row + "_" + col;

        if( document.getElementById( cellID + "_value" ) )
            return document.getElementById( cellID + "_value" ).value;
        else
            return document.getElementById( cellID ).innerHTML;
	}

    gridObject.setCellHTML = function( row, col, value )
    {
        if( row < 0 || col < 0 )
            return;

        var cellID = this.id + "_cell_" + row + "_" + col;
        var cellValue = document.getElementById( cellID + "_value" );

        if( cellValue )
        {
            cellValue.value = value;
            var cellDataView = document.getElementById( cellID + "_dataview" );
            if( cellDataView.tagName == "SELECT" )
            {
                dataView.selectedIndex = -1;
                for( var i = 0; i < dataView.options.length; ++i )
                {
                    if( dataView.options[ i ].text == value )
                    {
                        dataView.selectedIndex = i;
                        break;
                    }
                }
            }
            else if( cellDataView.tagName == "INPUT" )
            {
                cellDataView.checked = !( value == "" || value == "0" );
            }
        }
        else
        {
            document.getElementById( cellID ).innerHTML = value;
        }
    }

    gridObject.selectCell = function( row, col )
    {
        JTGridDoSelectCell( this.id, this, row, col );
    }

    gridObject.ColCount = 0;
    gridObject.RowCount = 0;

    jQuery(document).ready(function() {
        JTGridInitColumns( gridID );
    });

    if( !inArray( JTRegisteredOnResize, "JTGridInitColumns('" + gridID + "')" ) )
        JTRegisteredOnResize.push( "JTGridInitColumns('" + gridID + "')" );

    if( document.getElementById( gridID + "Input" ) )
        document.getElementById( gridID + "Input" ).onkeypress = JTGridDoInputKeyUp;

    gridObject.onkeydown = JTGridOnKeyPress;

    eval( "window." + gridID + " = gridObject;" );
}

function JTNavBarInitialize( navBarID, navItems, selected, clickHandler )
{
    var i;
    var navBarObject = document.getElementById( navBarID );

    for( i = 0; i < navItems.length; ++i )
    {
        var itemObject = document.getElementById( navItems[ i ] );

        itemObject.onclick = clickHandler;
        itemObject.navBar = navBarObject;
    }

    if( selected )
        navBarObject.activeSubBar = selected + "_subbar";
    else
        navBarObject.activeSubBar = "";
}

function JTNavBarButtonOver( NavButtonID, ButtonType )
{
    JTNavBarSetButtonState( NavButtonID, ButtonType, "over" );

    var itemObject = document.getElementById( NavButtonID );
    var barObject = document.getElementById( NavButtonID + "_subbar" );

    if( itemObject.navBar && itemObject.navBar.activeSubBar && document.getElementById( itemObject.navBar.activeSubBar ) )
        document.getElementById( itemObject.navBar.activeSubBar ).style.display = "none";

    if( barObject )
    {
        barObject.style.display = "block";

        if( typeof(itemObject.navBar) != "undefined")
			itemObject.navBar.activeSubBar = barObject.id;
    }
}

function JTNavBarButtonOut( NavButtonID, ButtonType, OrigState )
{
    JTNavBarSetButtonState( NavButtonID, ButtonType, OrigState );
}

function JTNavBarSetButtonState( NavButtonID, ButtonType, State )
{
    document.getElementById( NavButtonID ).className = "jtbb jtfont jt" + ButtonType + "navbar_button jt" + ButtonType + "navbar_button_" + State;

    if( document.getElementById( NavButtonID + "_inner" ) )
        document.getElementById( NavButtonID + "_inner" ).className = "jtbb jtfont jt" + ButtonType + "navbar_button_inner jt" + ButtonType + "navbar_button_inner_" + State;
}

function JTVNavBarInitialize (navBarID, onClick, submitField) {
    $("#" + navBarID + " a")
        .hover(
            function () {
                $(this).addClass("jtvnavbar_button_over");
            },
            function () {
                $(this).removeClass("jtvnavbar_button_over");
            })
        .click(
            function (e) {
                if (onClick && onClick(e, this.parentNode.id, $(this).attr("tag")) === false) {
                    return false;
                }

                if ($(this).attr("href") == "") {
                    if (submitField) {
                        var field = document.getElementById(submitField);

                        field.value = this.parentNode.id;
                        if (field.form.onsubmit) {
                            field.form.onsubmit();
                        }
                        field.form.submit();
                    }

                    return false;
                }

                e.stopImmediatePropagation();
            });
}

function JTToolButtonOver( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "over", true );
}

function JTToolButtonOut( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "over", false );
    JTToolButtonSetStateClass( ToolButtonID, "down", false );
}

function JTToolButtonDown( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "down", true );
}

function JTToolButtonUp( ToolButtonID )
{
	JTToolButtonSetStateClass( ToolButtonID, "down", false );
}

function JTToolButtonSetStateClass( ToolButtonID, StateClass, AddStyle )
{
    StateClass = "jttoolbutton_" + StateClass;

    if( AddStyle )
		document.getElementById( ToolButtonID ).className += " " + StateClass;
	else
		document.getElementById( ToolButtonID ).className = document.getElementById( ToolButtonID ).className.replace( " " + StateClass, "" );
}

function JTToolBarSetEnabledState( ToolButtonID, enabled )
{
	JTToolButtonSetStateClass( ToolButtonID, "disabled", !enabled );
}

function JTToolBarInitialize( id )
{
	if( JTPageLoaded )
		JTToolBarLoad( id );
	else
		JTToolBarList.push( id );
}

function JTToolBarOnLoad()
{
	var i;

	for( i = 0; i < JTToolBarList.length; ++i )
		JTToolBarLoad( JTToolBarList[ i ] );
}

function JTToolBarLoad( id )
{
	var scroller = document.getElementById( id + "_scroller" );
	var inner = document.getElementById(id + "_inner2");
	var scrollerScrollWidth = scroller.scrollWidth;
	var scrollerClientWidth = scroller.clientWidth;
	var scrollerScrollLeft = scroller.scrollLeft;

	if (scrollerScrollWidth > scrollerClientWidth)
	{
		inner.style.paddingLeft = "10px";
		inner.style.paddingRight = "10px";
	}
	else
	{
		inner.style.paddingLeft = "0";
		inner.style.paddingRight = "0";
	}

    var fwdScroller = document.getElementById(id + "_fwdscroller");
    var revScroller = document.getElementById(id + "_revscroller");

	fwdScroller.style.display = (scrollerScrollWidth > scrollerClientWidth) ? "block" : "none";
	revScroller.style.display = (scrollerScrollWidth > scrollerClientWidth) ? "block" : "none";
	revScroller.style.visibility = ((scrollerScrollLeft + scrollerClientWidth) >= scrollerScrollWidth) ? "hidden" : "visible";
    fwdScroller.style.visibility = (scrollerScrollLeft > 0) ? "visible" : "hidden";
}

function JTToolBarScrollLeftStart( id )
{
	JTToolBarScrollTimer = setInterval( "JTToolBarScrollTick('" + id + "',-20)", 50 );
}

function JTToolBarScrollLeftStop( id )
{
	clearInterval( JTToolBarScrollTimer );
}

function JTToolBarScrollRightStart( id )
{
	JTToolBarScrollTimer = setInterval( "JTToolBarScrollTick('" + id + "',20)", 50 );
}

function JTToolBarScrollRightStop( id )
{
	clearInterval( JTToolBarScrollTimer );
}

function JTToolBarScrollTick( id, direction )
{
	var scroller = document.getElementById( id + "_scroller" );

	scroller.scrollLeft += direction;

	document.getElementById(id + "_revscroller").style.visibility = ((scroller.scrollLeft + scroller.clientWidth) >= scroller.scrollWidth) ? "hidden" : "visible";
	document.getElementById(id + "_fwdscroller").style.visibility = (scroller.scrollLeft > 0) ? "visible" : "hidden";
}

function JTUpdateAnchors()
{
    /*if( JTIEVer > -1 )
    {
        if( JTIEVer < 7 )
            JTUpdateElementAndChildrenWidth( document.body );

        JTUpdateElementAndChildrenHeight( document.body );
    }*/

    var i, l;

    l = JTRegisteredOnResize.length;
    for( i = 0; i < l; ++i )
        eval( JTRegisteredOnResize[ i ] );
}

function JTUpdateElementAndChildrenWidth( obj )
{
    if( obj != document.body && obj.style )
    {
        if( obj.style.right && obj.style.left )
        {
            var w = getParentWidth( obj ) - obj.offsetLeft - parseInt( obj.style.right );

            if( obj.style.width == "" && w > -1 )
                obj.style.width = w + "px";

            w -= ( obj.offsetWidth - parseInt( obj.style.width ) );

            if( w > -1 )
                obj.style.width = w + "px";
        }
    }

    var i, l;

    l = obj.childNodes.length;

    for( i = 0; i < l; ++i )
        JTUpdateElementAndChildrenWidth( obj.childNodes[ i ] );
}

function JTUpdateElementAndChildrenHeight( obj )
{
    if( obj != document.body && obj.style )
    {
        if( obj.style.bottom && obj.style.top )
        {
            var h = getParentHeight( obj ) - obj.offsetTop - parseInt( obj.style.bottom );

            if( obj.style.height == "" && h > -1 )
                obj.style.height = h + "px";

            h -= ( obj.offsetHeight - parseInt( obj.style.height ) );

            if( h > -1 )
                obj.style.height = h + "px";
        }
    }

    var i, l;

    l = obj.childNodes.length;

    for( i = 0; i < l; ++i )
        JTUpdateElementAndChildrenHeight( obj.childNodes[ i ] );
}

function JTInitAnchorUpdate()
{
    if( JTIEVer > -1 )
        window.attachEvent( "onload", JTUpdateAnchors );

    addEvent( window, "resize", JTUpdateAnchors );
}

function JTAdvEditInitialize( id, mask, maskChar, maskNum, validReg, onValidate, localInvalidMessage )
{
    var editObject = document.getElementById( id );

    editObject.match = function( inChar, maskChar )
    {
        if( maskChar == "?" || ( maskChar != "#" && inChar == maskChar ) || ( maskChar == "#" && inChar == this.maskNum ) )
            return true;
        else if( maskChar == "#" )
            return !isNaN( parseInt( inChar ) );

        return false;
    }

    editObject.updateEdit = function() {
    	if (this.maskStr.length == 0)
    		return;

    	var mask = this.maskStr;
    	var str = this.value;
    	var i;
    	var maskView = mask;

    	maskView = maskView.replace(/\#/g, this.maskNum);
    	maskView = maskView.replace(/\?/g, this.maskChar);

    	str = str.substr(0, mask.length);
    	str += maskView.substr(str.length, mask.length);

    	for (i = 0; i < str.length; ++i) {
    		var sc = str.charAt(i);
    		var mc = mask.charAt(i);

    		if (!this.match(sc, mc)) {
    			if (mc == "#" || mc == "?")
    				str = str.substr(0, i) + (mc == "#" ? this.maskNum : this.maskChar) + str.substr(i + 1, str.length);
    			else
    				str = str.substr(0, i) + mc + str.substr(i, str.length);
    		}
    	}

    	str = str.substr(0, mask.length);

    	if (this.offsetWidth > 0) {
    		var sw = getSelectionLength(this);
    		var p = getCaretPosition(this) - sw;

    		this.value = str;

    		setCaretPosition(this, p, sw);
    	}
    	else {
    		this.value = str;
    	}
    }

	invalidValueMessage = localInvalidMessage;

    editObject.OnFormSubmit = function( e )
    {
        return JTAdvEditValidate( this, invalidValueMessage );
    }

    editObject.maskStr = mask;
    editObject.maskChar = maskChar;
    editObject.maskNum = maskNum;
    editObject.validReg = validReg;
    editObject.onvalidate = onValidate;

    if( typeof( editObject.form.jtAdvancedEdits ) == "undefined" )
    {
        editObject.form.jtAdvancedEdits = new Array();

        addOnSubmitEvent( editObject.form, JTAdvEditFormSubmit );
    }

    editObject.form.jtAdvancedEdits.push( editObject );

    if( editObject.maskStr.length > 0 )
    {
        addEvent( editObject, "keypress", JTAdvEditKeyPress );
        addEvent( editObject, "keyup", JTAdvEditKeyUp );
    }

    JTAdvEditList.push( editObject );

    editObject.updateEdit();
}

function JTAdvEditKeyUp( e )
{
    getEventTarget( e ).updateEdit();
}

function JTAdvEditKeyPress( e )
{
    var event = e || window.event;
    var edit = getEventTarget( e );
    var sw = getSelectionLength( edit );
    var p = getCaretPosition( edit ) - sw;
    var kc = event.charCode || event.keyCode;
    var cc = String.fromCharCode( kc );
    var mc = edit.maskStr.charAt( p );

    if( kc == 8 || ( kc >= 37 && kc <= 40 ) || kc == 46 || kc == 36 || kc == 9 || kc == 35 )
        return true;

    if( mc == "#" )
    {
        if( isNaN( parseInt( cc ) ) )
        {
            if( event.stopPropagation )
                event.stopPropagation();
            if( event.preventDefault )
                event.preventDefault();
            return false;
        }
        else
        {
            setCaretPosition( edit, p, sw + 1 );

            return true;
        }
    }
    else if( mc == "?" )
    {
        setCaretPosition( edit, p, sw + 1 );

        return true;
    }
    else
    {
		var c1 = edit.maskStr.indexOf( "?", p );
		var c2 = edit.maskStr.indexOf( "#", p );
		if( c1 > -1 && ( c2 == -1 || c2 >= c1 ) )
		{
			setCaretPosition( edit, c1, sw );
			return JTAdvEditKeyPress( e );
		}
		else if( c2 > -1 && ( c1 == -1 || c1 > c2 ) )
		{
			setCaretPosition( edit, c2, sw );
			return JTAdvEditKeyPress( e );
		}
    }

    setCaretPosition( edit, p + 1, sw );
    if( event.stopPropagation )
        event.stopPropagation();
    if( event.preventDefault )
        event.preventDefault();
    return false;
}

function JTAdvEditBlur( e )
{
    var event = e || window.event;
    var edit = getEventTarget( e );

    JTAdvEditValidate( edit, invalidValueMessage );
}

function JTAdvEditFormSubmit( e )
{
    var event = e || window.event;
    var form = getEventTarget( e );
    var i;

    for( i = 0; i < form.jtAdvancedEdits.length; ++i )
    {
        if( !JTAdvEditValidate( form.jtAdvancedEdits[ i ], invalidValueMessage ) )
            return false;
    }

    return true;
}

function JTAdvEditValidate( edit, invalidValueMessage )
{
    if( edit.validReg.length > 0 )
    {
        var re = /^\/(.+)\/([a-zA-Z]*)$/;
        var arr;

        arr = re.exec( edit.validReg );

        if( arr != null )
        {
            re = new RegExp( arr[ 1 ], arr[ 2 ] );

            if( re.exec( edit.value ) == null )
            {
                alert( invalidValueMessage );
                edit.focus();
                return false;
            }
        }
    }

    if( edit.onvalidate )
    {
        if( !edit.onvalidate( edit ) )
        {
            alert( invalidValueMessage );
            edit.focus();
            return false;
        }
    }

    return true;
}

function JTAdvEditOnLoad( e )
{
    var i;

    for( i = 0; i < JTAdvEditList.length; ++i )
        addEvent( JTAdvEditList[ i ], "blur", JTAdvEditBlur );
}

function JTTimePickerInitialize( timePickerID, timePickerFormat, jsOnChange )
{
    var timePickerObj = document.getElementById( timePickerID );

    timePickerObj.timeFormat = timePickerFormat;
    timePickerObj.jsOnChange = jsOnChange;

    timePickerObj.getValue = function() {
        var h = parseInt(document.getElementById(this.id + "_h").value);
        var m = parseInt(document.getElementById(this.id + "_m").value);
        var s = parseInt(document.getElementById(this.id + "_s").value);
        var amPm = document.getElementById(this.id + "_a");

        if (this.timeFormat != "tt24Hour") {
            var amPmValue = amPm.options[amPm.selectedIndex].value;

            if (amPmValue == "AM") {
                if (h == 12)
                    h = 0;
            }
            else {
                if (h < 12)
                    h += 12;
            }
        }

        return h + ":" + m + ":" + s;
    }

    timePickerObj.setValue = function(value) {
        var date = parseDBDate(value);

        if (this.timeFormat == "tt24Hour") {
            document.getElementById(this.id + "_h").value = (date != null) ? date.getHours() : "";
        }
        else {
            var ap, h;

            if (date != null) {
                h = date.getHours();
                ap = (h > 11) ? "PM" : "AM";

                if (h == 0) {
                    h = 12;
                }
                else if (h > 12) {
                    h -= 12;
                }
            }
            else {
                h = "";
                ap = "AM";
            }

            document.getElementById(this.id + "_h").value = h;

            var amPM = document.getElementById(this.id + "_a");
            for (var i = 0; i < amPM.options.length; ++i) {
                if (amPM.options[i].value == ap) {
                    amPM.selectedIndex = i;
                    break;
                }
            }
        }

        document.getElementById(this.id + "_m").value = (date != null) ? date.getMinutes() : "";
        document.getElementById(this.id + "_s").value = (date != null) ? date.getSeconds() : "";
    }
}

function JTTimePickerKeyDown( e )
{
    var event = e || window.event;
    var kc = event.charCode || event.keyCode;
    var edit = getEventTarget( e );
    var editType = edit.id.substr( edit.id.length - 1, 1 );
    var cc = String.fromCharCode( kc );
    var timePickerObj = document.getElementById( edit.id.substr( 0, edit.id.length - 2 ) );

    if (kc == 8 || kc == 37 || kc == 39 || kc == 46 || kc == 36 || kc == 9 || kc == 35)
        return true;

    if( kc == 38 || kc == 40 )
    {
        var nv = parseInt( edit.value, 10 );
        if( isNaN( nv ) )
			nv = 0;

        nv += ( kc == 38 ? 1 : -1 );

        if( ( editType == "h" && ( ( nv < 24 && timePickerObj.timeFormat == "tt24Hour" ) || ( nv < 13 && timePickerObj.timeFormat == "tt12Hour" ) ) && nv > 0 ) || ( editType == "m" && nv < 60 && nv > -1 ) || ( editType == "s" && nv < 60 && nv > -1 ) )
        {
            if( nv < 10 )
                nv = "0" + nv;

            edit.value = nv;
        }
    }

    return true;
}

function JTTimePickerKeyPress( e )
{
	var event = e || window.event;
    var kc = event.charCode || event.keyCode;
    var cc = String.fromCharCode( kc );

    if (kc == 8 || kc == 37 || kc == 39 || kc == 46 || kc == 36 || kc == 9 || kc == 35)
    	return true;

    if( isNaN( parseInt( cc ) ) )
        return false;

    return true;
}

function JTTimePickerControlFocus( id, control )
{
	control.oldValue = control.value;
}

function JTTimePickerControlBlur( id, control )
{
	if( control.value != control.oldValue )
		JTTimePickerControlChange( id );
}

function JTTimePickerControlChange( id )
{
	var timePicker = document.getElementById( id );
	if( timePicker.jsOnChange )
		timePicker.jsOnChange( timePicker );
}

function JTClockInitialize( clockID, clockType )
{
    if( clockType == "Digital" )
    {
        if( JTClockList.length == 0 )
            setInterval( "JTClockTick()", 500 );

        JTClockList.push( clockID );

        JTClockTick();
    }
}

function JTClockTick()
{
    var i;
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var am_pm = ( hours > 12 ) ? "PM" : "AM";

    if( hours > 12 )
        hours -= 12;

    for( i = 0; i < JTClockList.length; ++i )
        JTClockUpdateClock( JTClockList[ i ], hours, minutes, seconds, am_pm );
}

function JTClockUpdateClock( id, hours, minutes, seconds, am_pm )
{
    JTClockUpdateDigit(id + "_h1", ( ( hours > 9 ) ? "1" : "0" ));
    JTClockUpdateDigit(id + "_h2", ( hours % 10 ));

    JTClockUpdateDigit(id + "_m1", Math.floor( minutes / 10 ));
    JTClockUpdateDigit(id + "_m2", ( minutes % 10 ));

    JTClockUpdateDigit(id + "_s1", Math.floor( seconds / 10 ));
    JTClockUpdateDigit(id + "_s2", ( seconds % 10 ));

    var amPm = document.getElementById( id + "_apm" );
    var className = amPm.className.replace(/\s*jtdigitalclock_[ap]m\s*/, '');
    amPm.className = className + " jtdigitalclock_" + ( ( am_pm == "AM" ) ? "am" : "pm" );
    // document.getElementById( id + "_apm" ).style.background = "url(" + JTThemeWebDir + "images/clock_dig_" + ( ( am_pm == "AM" ) ? "am" : "pm" ) + ".gif)";
}

function JTClockUpdateDigit( id, digit ) {
    // document.getElementById(id).style.background = "url(" + JTThemeWebDir + "images/clock_dig_" + ( seconds % 10 ) + ".gif)";
    var element = document.getElementById(id);
    var className = element.className.replace(/\s*jtdigitalclock_d[0-9]\s*/, '');
    element.className = className + " jtdigitalclock_d" + digit;
}

function JTEliminateDuplicateID( id )
{
    var object = document.getElementById( id );

    if( object )
    {
        var objectParent = object.parentNode;

        objectParent.removeChild( object );
    }
}

function JTInitializeTabControl( id, tabArray, tabIndex, onChange )
{
    var tabObject = document.getElementById( id );

    tabObject.Tabs = tabArray;
    tabObject.TabIndex = tabIndex;
    tabObject.OnChange = onChange;

    addEvent(window, "load", function () {
        if (tabIndex > -1 && tabIndex < tabObject.Tabs.length) {
            JTPageControlTabClick(id, tabObject.Tabs[tabIndex]);
        }
    });
}

function JTCategoryButtonsInitialize( id )
{
    var stateObject = document.getElementById( id + "_state" );

    if( stateObject )
    {
        var curState = stateObject.value;
        var categories = document.getElementById( id );
        var i;

        for( i = 0; i < categories.childNodes.length; ++i )
        {
            if( curState.indexOf( categories.childNodes[ i ].id ) > -1 )
            {
                if( JTIEVer <= 7 )
                    JTCategoryButtonsUpdateList.push( new Array( id, categories.childNodes[ i ].id ) );
                else
                    JTCategoryButtonCatClick( id, categories.childNodes[ i ].id );
            }
        }
    }
}

function JTCategoryButtonsOnLoad()
{
    var i;

    for( i = 0; i < JTCategoryButtonsUpdateList.length; ++i )
    {
        var cbUpdate = JTCategoryButtonsUpdateList[ i ];

        JTCategoryButtonCatClick( cbUpdate[ 0 ], cbUpdate[ 1 ] );
    }
}

function JTCategoryButtonCatClick( id, categoryId )
{
    var catObject = document.getElementById( categoryId );
    var catCaptionObject = document.getElementById( categoryId + "_caption" );

    if( typeof( catObject.catState ) == "undefined" || catObject.catState == "expanded" )
    {
        JTHeightAnimate( catObject, catCaptionObject.offsetHeight + 1 );
        catObject.style.overflow = "hidden";
        catObject.catState = "shrunk";
    }
    else
    {
        JTHeightRestore( catObject );
        catObject.style.overflow = "visible";
        catObject.catState = "expanded";
    }

    var stateObject = document.getElementById( id + "_state" );
    var categories = document.getElementById( id ).getElementsByTagName( "DIV" );
    var i, newState = "";

    for( i = 0; i < categories.length; ++i )
    {
        if( typeof( categories[ i ].catState ) != "undefined" && categories[ i ].catState == "shrunk" )
            newState += categories[ i ].id + ";";
    }

    stateObject.value = newState;
}

function JTCategoryButtonsMouseOver( id )
{
    document.getElementById( id ).className = "jtbb jtfont jtcatbutton jtcatbuttonover";
}

function JTCategoryButtonsMouseOut( id )
{
    document.getElementById( id ).className = "jtbb jtfont jtcatbutton";
}

function JTExplanationPopupInitialize( id, htmlCode )
{
    JTExplanationPopups.push( new Array( id, htmlCode ) );
}

function JTExpPopupOnLoad()
{
    var i;

    for( i = 0; i < JTExplanationPopups.length; ++i )
    {
        var expPopDiv = document.createElement( "DIV" );

        document.body.appendChild( expPopDiv );

        expPopDiv.innerHTML = JTExplanationPopups[ i ][ 1 ];

        var expPopObject = document.getElementById( JTExplanationPopups[ i ][ 0 ] );
        if( expPopObject )
        {
            expPopObject.Hint = function( id, message )
            {
                this.internalShow( id, message, true );
            }

            expPopObject.Popup = function( id, message )
            {
                this.internalShow( id, message, false );
            }

            expPopObject.Hide = function()
            {
                this.style.visibility = "hidden";
                JTExplanationPopupActive = null;
            }

            expPopObject.setText = function( str )
            {
                document.getElementById( this.id + "_inner" ).innerHTML = str;
            }

            expPopObject.internalShow = function( id, message, hint )
            {
                if( JTExplanationPopupActive )
                    JTExplanationPopupActive.Hide();

                this.setText( message );

                var object = document.getElementById( id );
                if( object )
                {
                    var x = ( getBrowserScrollX() > getObjectScreenX( object ) ) ? getBrowserScrollX() : getObjectScreenX( object );
                    var y;
                    var arrowObject = document.getElementById( this.id + "_arrow" );

                    if( getBrowserScrollY() > ( getObjectScreenY( object ) - this.offsetHeight - 29 ) )
                    {
                        arrowObject.className = "jtbb jtexppopuparrow jtexppopuparrowup";
                        arrowObject.style.top = "-27px";

                        y = getObjectScreenY( object ) + object.offsetHeight + 31;
                    }
                    else
                    {
                        arrowObject.className = "jtbb jtexppopuparrow jtexppopuparrowdown";
                        arrowObject.style.top = ( this.offsetHeight - 2 ) + "px";
                        arrowObject.style.bottom = "0";

                        y = ( getObjectScreenY( object ) - this.offsetHeight ) - 29;
                    }

                    this.style.left = ( x + 10 ) + "px";
                    this.style.top = y + "px";
                    this.style.visibility = "visible";

                    JTExplanationPopupActive = this;

                    JTExplanationSkipClick = !hint;

                    if( hint )
                        addEvent( object, "mouseout", JTExpPopupOnOut );
                }
            }

            eval( "window." + JTExplanationPopups[ i ][ 0 ] + " = document.getElementById( '" + JTExplanationPopups[ i ][ 0 ] + "' );" );
        }
    }
}

function JTExpPopupDocumentClick()
{
    if( JTExplanationSkipClick )
        JTExplanationSkipClick = false;
    else if( JTExplanationPopupActive )
        JTExplanationPopupActive.Hide();
}

function JTExpPopupOnOut()
{
    if( JTExplanationPopupActive )
        JTExplanationPopupActive.Hide();
}

function JTInputValidator( canBeEmpty, regularExpression, inputType )
{
    this.canBeEmpty = canBeEmpty;
    this.regularExpression = regularExpression;
    this.inputType = inputType;

    this.Validate = function( str )
    {
        str = new String( str );

        if( str.length == 0 )
            return this.canBeEmpty;

        if( this.inputType == "itNumeric" && isNaN( parseInt( str ) ) )
            return false;

        if( this.regularExpression )
        {
            var re = /^\/(.+)\/([a-zA-Z]*)$/;
            var arr;

            arr = re.exec( this.regularExpression );

            if( arr != null )
            {
                re = new RegExp( arr[ 1 ], arr[ 2 ] );

                if( re.exec( str ) == null )
                    return false;
            }
        }

        return true;
    }
}

function JTInputValidatorInitialize( name, canBeEmpty, controlID, escapeHTML, regularExpression, removeTags, inputType )
{
    var validator = new JTInputValidator( canBeEmpty, regularExpression, inputType );

    eval( "window." + name + " = validator;" );

    if( controlID )
        JTInputValidators.push( new Array( name, controlID ) );
}

function JTInputValidatorsOnLoad()
{
    var i;

    for( i = 0; i < JTInputValidators.length; ++i )
    {
        var cID = JTInputValidators[ i ][ 1 ];
        var cObject = document.getElementById( cID );

        if( cObject.form )
        {
            if( typeof( cObject.form.JTInputValidators ) == "undefined" )
            {
                cObject.form.JTInputValidators = new Array();
                addOnSubmitEvent( cObject.form, JTInputValidatorFormSubmit );
            }

            cObject.form.JTInputValidators.push( JTInputValidators[ i ] );
        }
    }
}

function JTInputValidatorFormSubmit( e )
{
    var event = e || window.event;
    var form = getEventTarget( event );

    if( typeof( form.JTInputValidators ) != "undefined" )
    {
        var i;

        for( i = 0; i < form.JTInputValidators.length; ++i )
        {
            eval( "var validator = " + form.JTInputValidators[ i ][ 0 ] + ";" );

            var inputObject = document.getElementById( JTInputValidators[ i ][ 1 ] );

            if( inputObject && typeof( inputObject.value ) != "undefined" )
            {
                if( !validator.Validate( inputObject.value ) )
                    return false;
            }
        }
    }

    return true;
}

function JTHeightAnimate( heightObject, destHeight )
{
    setTimeout( "JTDoHeightAnimate( '" + heightObject.id + "', " + heightObject.offsetHeight + ", " + destHeight + ", 0 )", 20 );
}

function JTHeightRestore( heightObject )
{
    heightObject.style.height = "auto";
}

function JTDoHeightAnimate( id, startHeight, endHeight, index )
{
    document.getElementById( id ).style.height = ( ( index < 4 ) ? ( ( ( ( endHeight - startHeight ) / 5 ) * index ) + startHeight ) : endHeight ) + "px";

    if( index < 4 )
        setTimeout( "JTDoHeightAnimate( '" + id + "', " + startHeight + ", " + endHeight + ", " + ( index + 1 ) + ")", 20 );
}

function JTInitializeSectionBar( id, sectionArray, sectionIndex, onChange )
{
    var sectionBarObject = document.getElementById( id );

    sectionBarObject.Sections = sectionArray;
    sectionBarObject.SectionIndex = sectionIndex;
    sectionBarObject.OnChange = onChange;
}

function JTSectionBarButtonClick( sectionBarId, sectionId )
{
    var sectionBarObject = document.getElementById( sectionBarId );
    var sections = sectionBarObject.Sections;
    var i;
    var ActiveTab;

    if( document.getElementById( sectionId + "_caption" ).offsetHeight == 0 )
    {
        setTimeout( "JTSectionBarButtonClick( '" + sectionBarId + "', '" + sectionId + "' )", 10 );
        return;
    }

    for( i = 0; i < sections.length; ++i )
    {
        if( sections[ i ] == sectionId )
            break;
    }

    if( i < sections.length )
        ActiveTab = i;
    else
        ActiveTab = -1;

    for( i = 0; i < sections.length; ++i )
    {
        if( i != ActiveTab )
            JTSectionBarSetSectionState( sectionBarObject, sections[ i ], i, ActiveTab );
    }

    JTSectionBarSetSectionState( sectionBarObject, sections[ ActiveTab ], ActiveTab, ActiveTab );

    sectionBarObject.SectionIndex = ActiveTab;

    if( sectionBarObject.OnChange )
    {
        var pageControlEvent = new JTPageControlChangeEvent( sectionBarObject, ActiveTab );

        sectionBarObject.OnChange( pageControlEvent );
    }
}

function JTSectionBarSetSectionState( sectionBarObject, sectionId, index, activeindex )
{
    var sectionObject = document.getElementById( sectionId );
    var sectionObjectContainer = document.getElementById( sectionId + "_container" );
    var sectionObjectCaption = document.getElementById( sectionId + "_caption" );
    var sectionClosedHeight = sectionObjectCaption.offsetHeight - 2;

    if( index <= activeindex )
    {
        sectionObject.style.bottom = "";
        sectionObject.style.top = ( sectionClosedHeight * index + ( index * 2 ) ) + "px";
    }
    else
    {
        sectionObject.style.top = "";
        sectionObject.style.bottom = ( sectionClosedHeight * ( sectionBarObject.Sections.length - index - 1 ) + ( ( sectionBarObject.Sections.length - index - 1 ) * 2 ) ) + "px";
    }

    sectionObjectContainer.style.display = ( index == activeindex ) ? "block" : "none";
    sectionObjectCaption.style.cursor = ( index == activeindex ) ? "default" : "pointer";

    if( sectionObjectContainer.style.display == "block" )
        ParentSendDisplayChanged( sectionObjectContainer );
}

function JTMonthCalInitialize( monthCalId, selectedYear, selectedMonth, selectedDay, formObject, submitFieldId, onSelectDate )
{
    var monthCalObject = document.getElementById( monthCalId );

    selectedYear = parseInt( selectedYear, 10 );
    if( isNaN( selectedYear ) )
        selectedYear = "";

    selectedMonth = parseInt( selectedMonth, 10 );
    if( isNaN( selectedMonth ) )
        selectedMonth = "";

    selectedDay = parseInt( selectedDay, 10 );
    if( isNaN( selectedDay ) )
        selectedDay = "";

    monthCalObject.SelectedYear = selectedYear;
    monthCalObject.SelectedMonth = selectedMonth;
    monthCalObject.SelectedDay = selectedDay;
    monthCalObject.form = formObject;
    monthCalObject.SubmitFieldId = submitFieldId;
    monthCalObject.OnSelectDate = onSelectDate;

    document.getElementById( monthCalId + "_selyear" ).value = selectedYear;
    document.getElementById( monthCalId + "_selmonth" ).value = selectedMonth;
    document.getElementById( monthCalId + "_selday" ).value = selectedDay;
}

function JTMonthCalendarDateClick( monthCalId, year, month, day )
{
    var monthCalObject = document.getElementById( monthCalId );

    year = parseInt( year, 10 );
    month = parseInt( month, 10 );
    day = parseInt( day, 10 );

    if( monthCalObject.OnSelectDate && monthCalObject.OnSelectDate( monthCalObject, year, month, day ) == false )
        return;

    document.getElementById( monthCalId + "_selyear" ).value = year;
    document.getElementById( monthCalId + "_selmonth" ).value = month;
    document.getElementById( monthCalId + "_selday" ).value = day;

    if( monthCalObject.SubmitFieldId )
    {
        monthCalObject.form.elements[ monthCalObject.SubmitFieldId ].value = monthCalId;

        if( ( monthCalObject.form.onsubmit ) && ( typeof( monthCalObject.form.onsubmit ) == "function" ) )
            monthCalObject.form.onsubmit();

        monthCalObject.form.submit();
    }
    else
    {
        // if( monthCalObject.SelectedYear == year && monthCalObject.SelectedMonth == month )
        {
            if( monthCalObject.SelectedDay )
            {
                var curSelectedCell = document.getElementById( monthCalId + "_day_" + monthCalObject.SelectedDay );

                curSelectedCell.className = curSelectedCell.className.replace( " jtmonthcalendarcellselected", "" );
            }

            var newSelectedCell = document.getElementById( monthCalId + "_day_" + day );

            newSelectedCell.className = newSelectedCell.className + " jtmonthcalendarcellselected";

            monthCalObject.SelectedYear = year;
            monthCalObject.SelectedMonth = month;
            monthCalObject.SelectedDay = day;
        }
    }
}

function JTJSWindowInitialize( windowName, URL, parameters )
{
    var temp = new JTJSWindow( windowName, URL, parameters );

    eval( "window." + windowName + " = temp;" );
}

function JTJSWindow( windowName, URL, parameters )
{
    this.windowName = windowName;
    this.URL = URL;
    this.parameters = parameters;
    this.window = null;

    this.open = function()
    {
        this.window = window.open( this.URL, this.windowName, this.parameters );

        return this.window;
    }
}

function JTDatePickerInitialize( id, jsOnChange, jsOnBlur, jsOnFocus, dateFormat )
{
    var datePicker = document.getElementById( id );
    var inputHeight = datePicker.offsetHeight;

	if( datePicker.parentNode.parentNode.parentNode.className == "inputcontainer" )
		datePicker.inputContainer = datePicker.parentNode.parentNode.parentNode;

	if( datePicker.inputContainer )
		inputHeight = datePicker.inputContainer.offsetHeight + 2;

    if( JTIEVer > -1 )
    {
        // document.getElementById( id + "_dropdown" ).style.top = "2px";
        document.getElementById( id + "_calendar" ).onselectstart = function () { return false; };
    }

    var calendar = document.getElementById( id + "_calendar" );

    // if( inputHeight > 0 )
    //    document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 2 ) + "px";

	JTDatePickerCleanup( id );

	var view = document.getElementById( id + "_view" );

	if( !view.onblur )
		addEvent(view, "click", function() { JTDatePickerShowCalendar(id) });

	datePicker.setValue = function(value) {
		this.value = value;
		this.viewInput.value = phpDateToStr(this.dateFormat, parseDBDate(value));
	};

	datePicker.jsOnChange = jsOnChange;
	datePicker.jsOnBlur = jsOnBlur;
	datePicker.jsOnFocus = jsOnFocus;
	datePicker.dateFormat = dateFormat;
	datePicker.viewInput = view;

    if( !JTPageLoaded )
        JTDatePickerList.push( id );
    else
        JTDatePickerLoad( id );

    eval( "window." + id + " = datePicker;" );
}

function JTDatePickerOnBlur( id )
{
    var datePicker = document.getElementById( id );
	var view = document.getElementById(id + "_view");
	var selDate = parseDBDate( view.value );

	if( !selDate )
		return;

	var year = selDate.getFullYear();
	var month = selDate.getMonth();
	var day = selDate.getDate();
	var dStr = "";
	dStr += strPad( year, 4, "0", "left" ) + "-";
	dStr += strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-";
	dStr += strPad( day, 2, "0", "left" ) + " ";

	view.value = dStr;

	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );

	JTDatePickerSelectDate( id, year, month, day );
}

function JTDatePickerShowCalendar( id, hideIfVisible )
{
	var curDate = parseDBDate( document.getElementById( id ).value );
	if( curDate == null )
		curDate = new Date();

    var picker = document.getElementById( id );
    var calendar = document.getElementById( id + "_calendar" );
	if( picker.disabled )
		return;

	if (typeof(hideIfVisible) != "undefined" && calendar.style.display == "block") {
	    calendar.style.display = "none";
	    return;
	}

    JTDatePickerLoadCalendarForDate( id, curDate );

    calendar.style.left = getObjectScreenX( picker.viewInput ) + "px";
    calendar.style.top = getObjectScreenY( picker.viewInput ) + picker.viewInput.offsetHeight + "px";
    calendar.style.display = "block";
    calendar.focus();

	var screenEdgeX = getBrowserScrollX() + getBrowserWidth();
	var screenEdgeY = getBrowserScrollY() + getBrowserHeight();
	var objectDiffX = getObjectScreenX( calendar ) + calendar.offsetWidth - screenEdgeX;
	var objectDiffY = getObjectScreenY( calendar ) + picker.viewInput.offsetHeight + calendar.offsetHeight - screenEdgeY;

	if( objectDiffX > 0 )
		setBrowserScrollX( getBrowserScrollX() + objectDiffX );
	if( objectDiffY > 0 )
		setBrowserScrollY( getBrowserScrollY() + objectDiffY );

    if( JTIEVer > -1 )
		calendar.onfocusout = JTDatePickerCalendarFocusOut;
	else
		calendar.onblur = JTDatePickerCalendarBlur;

    JTDatePickerActive = picker;
    JTDatePickerSkipClick = true;

    if( picker.jsOnFocus )
		picker.jsOnFocus( picker );
}

function JTDatePickerLoadCalendarForDate( id, curDate )
{
    var i, d, l, month, year;
    var selDate = parseDBDate( document.getElementById( id ).value );
    var todayDate = new Date();
    var html = "";
    var className;

    html = "<table class=\"jtbb jtfont jtdatepickercalendartable\" cellpadding=\"0\" cellspacing=\"0\"><tr class=\"jtdatepickercalendarheader\">";

    for( i = 0; i < 7; ++i )
        html += "<td>" + getDayName( i ).substring( 0, 1 ) + "</td>";

    html += "</tr><tr>";

    year = curDate.getFullYear();
    month = curDate.getMonth();

    l = getFirstDayInMonth( year, month );
    for( i = 0, d = 0; i < l; ++i, ++d )
        html += "<td>&nbsp;</td>";

    l = getDaysInMonth( year, month );
    for( i = 0; i < l; ++i, ++d )
    {
        if( ( d % 7 ) == 0 )
            html += "</tr><tr>";

        if( selDate && selDate.getFullYear() == curDate.getFullYear() && selDate.getMonth() == curDate.getMonth() && selDate.getDate() == ( i + 1 ) )
            className = " jtdatepickerselected";
        else if( todayDate.getFullYear() == curDate.getFullYear() && todayDate.getMonth() == curDate.getMonth() && todayDate.getDate() == ( i + 1 ) )
            className = " jtdatepickertoday";
        else
            className= "";

        html += "<td class=\"jtdatepickercalendarcell" + className + "\" onclick=\"JTDatePickerSelectDate( '" + id + "', '" + year + "', '" + month + "', '" + ( i + 1 ) + "' )\">" + ( i + 1 ) + "</td>";
    }

    html += "</tr></table>";

    document.getElementById( id + "_calendartable" ).innerHTML = html;
    document.getElementById( id + "_calendartitle" ).innerHTML = getMonthByName( month ) + " " + year;
    document.getElementById( id ).curDate = curDate;
}

function JTDatePickerSelectDate( id, year, month, day )
{
	var datePicker = document.getElementById( id );

	datePicker.value = strPad( year, 4, "0", "left" ) + "-" + strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-" + strPad( day, 2, "0", "left" );
	datePicker.viewInput.value = phpDateToStr( datePicker.dateFormat, new Date(	year, month, day ) );
	document.getElementById( id + "_calendar" ).style.display = "none";
	JTDatePickerActive = null;

	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );

	if( datePicker.jsOnBlur )
		datePicker.jsOnBlur( datePicker );
}

function JTDatePickerOnLoad()
{
    var i;

    for( i = 0; i < JTDatePickerList.length; ++i )
        JTDatePickerLoad( JTDatePickerList[ i ] );

    JTDatePickerList = new Array();
}

function JTDatePickerLoad( id )
{
	var datePicker = document.getElementById( id );
    var inputHeight = datePicker.offsetHeight;

    if( datePicker.inputContainer )
		inputHeight = datePicker.inputContainer.offsetHeight + 2;

    // if( inputHeight > 0 )
    //     document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 2 ) + "px";

    var calendar = document.getElementById( id + "_calendar" );

    calendar.parentNode.removeChild( calendar );
    document.body.appendChild( calendar );
    calendar.style.zIndex = 1900;
}

function JTDatePickerDocumentClick()
{
    if( JTDatePickerSkipClick )
    {
        JTDatePickerSkipClick = false;
    }
    else if( JTDatePickerActive )
    {
        //document.getElementById( JTDatePickerActive.id + "_calendar" ).style.display = "none";
        //JTDatePickerActive = null;
    }
}

function JTDatePickerCalendarBlur( e )
{
	if( JTDatePickerActive && JTIEVer == -1 )
    {
		var event = e || window.event;
		var calendar = document.getElementById( JTDatePickerActive.id + "_calendar" );
		var target = getEventTarget( event );

		JTSetOnFocusOut( JTDatePickerCalendarFocusOut );
    }
}

function JTDatePickerCalendarFocusOut( e )
{
	if( JTDatePickerActive )
    {
		var calendar = document.getElementById( JTDatePickerActive.id + "_calendar" );

		if( isChild( document.activeElement, calendar ) )
		{
			if( JTIEVer > -1 )
				document.activeElement.onfocusout = JTDatePickerCalendarFocusOut;
			else
				document.activeElement.onblur = JTDatePickerCalendarBlur;
			return;
		}

		calendar.style.display = "none";
        JTDatePickerActive = null;
    }
}

function JTDatePickerPrevYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() - 1 );

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerPrevMonth( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        var month = curDate.getMonth();
        if( ( month - 1 ) < 0 )
        {
            curDate.setYear( curDate.getFullYear() - 1 );
            curDate.setMonth( 11 );
        }
        else
        {
            curDate.setMonth( month - 1 );
        }

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerNextYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() + 1 );

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerNextMonth( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        var month = curDate.getMonth();
        if( ( month + 1 ) > 11 )
        {
            curDate.setYear( curDate.getFullYear() + 1 );
            curDate.setMonth( 0 );
        }
        else
        {
            curDate.setMonth( month + 1 );
        }

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerToday( id )
{
    JTDatePickerLoadCalendarForDate( id, new Date() );
	JTDatePickerSkipClick = true;
}

function JTDatePickerCleanup( id )
{
	var node;
	var children = ( document.body.childNodes ) ? document.body.childNodes : document.documentElement.childNodes;

	id += "_calendar";

	for( var i = 0; i < children.length; ++i )
	{
		node = children[ i ];
		if( node.id == id )
		{
			document.body.removeChild( node );
			break;
		}
	}
}

function JTDatePickerClear( id )
{
	var datePicker = document.getElementById( id );
	datePicker.value = "";
	datePicker.viewInput.value = "";

	if (datePicker.jsOnChange)
	    datePicker.jsOnChange(new JTEvent(datePicker, "change"));

	if( datePicker.jsOnBlur )
		datePicker.jsOnBlur( datePicker );
}

function JTProgressBarInitialize( id, max, min, position, step )
{
    var progressBarObject = document.getElementById( id );

    progressBarObject.Max = max;
    progressBarObject.Min = min;
    progressBarObject.Position = position;
    progressBarObject.Step = step;

    progressBarObject.setPosition = function( value )
    {
        if( typeof( value ) != "number" )
            value = parseInt( value );

        if( value < this.Min || value > this.Max )
            return;

        this.Position = value;

        document.getElementById( this.id + "_indicator" ).style.width = ( Math.round( ( value * 10000 ) / ( this.Max - this.Min ) ) / 100 ) + "%";
    }

    progressBarObject.StepBy = function( value )
    {
        var newValue = this.Position + value;

        while( newValue > this.Max )
            newValue = ( newValue - this.Max ) + this.Min;

        this.setPosition( newValue );
    }

    progressBarObject.StepIt = function()
    {
        this.StepBy( this.Step );
    }

    eval( "window." + id + " = progressBarObject;" );
}

function JTTreeViewInitialize( treeName, selectedNodeName, collapsedNodeNames, jsClickEvent, hasServerOnClick, pageForm, submitInputElement )
{
    var treeObject = document.getElementById( treeName );

    treeObject.getSelectedCaption = function () {
        if (!this.selectedNode)
            return null;

        return document.getElementById(this.selectedNode.id + "_title").innerHTML;
    }

    treeObject.setSelectedNode = function( node )
    {
        if( this.selectedNode )
            document.getElementById( this.selectedNode.id + "_title" ).className = "jtfont jttreenodetitle";

        this.selectedNode = node;

        if( node )
        {
            document.getElementById( this.id + "_sn" ).value = node.id;
            document.getElementById( node.id + "_title" ).className = "jtfont jttreenodetitle jttreenodetitleselected";
        }
    }

    treeObject.setNodeState = function( node, collapsed )
    {
        if( !node )
            return;
        var plusNode = document.getElementById( node.id + "_plus" );
        var childNodesList = node.getElementsByTagName( "UL" )[ 0 ];
        if( childNodesList )
        {
            var cnList = this.collapsedNodeInput.value.split( " " );
            if( !collapsed )
            {
                childNodesList.style.display = "block";
                plusNode.className = "jttreenodeminus";
                node.collapsed = false;
                cnList.removeItem( node.id );
            }
            else
            {
                childNodesList.style.display = "none";
                plusNode.className = "jttreenodeplus";
                node.collapsed = true;
                if( cnList.indexOf( node.id ) == -1 )
                    cnList.push( node.id );
            }
            this.collapsedNodeInput.value = cnList.join( " " );
        }
    }

    treeObject.toggleNodeState = function( node )
    {
        if( !node )
            return;
        if( node.collapsed )
            this.setNodeState( node, false );
        else
            this.setNodeState( node, true );
    }

    treeObject.form = pageForm;
    treeObject.submitInputElement = submitInputElement;
    treeObject.jsOnClick = jsClickEvent;
    treeObject.hasServerOnClick = hasServerOnClick;
    treeObject.selectedNode = null;
    treeObject.collapsedNodeInput = document.getElementById( treeObject.id + "_cn" );

    if( selectedNodeName )
    {
        var selectedNode = document.getElementById( selectedNodeName );
        treeObject.setSelectedNode( selectedNode );
    }

    var cnList = collapsedNodeNames.split( " " );
    for( var i = 0; i < cnList.length; ++i )
        treeObject.setNodeState(document.getElementById(cnList[i]), true);

    eval("window." + treeName + " = treeObject;");
}

function JTTreeViewPlusClick( e, treeName )
{
    var event = e || window.event;
    var node = getEventTarget( event ).parentNode;
    while( node.tagName != "LI" )
        node = node.parentNode;
    var treeObject = document.getElementById( treeName );

    treeObject.toggleNodeState( node );
}

function JTTreeViewNodeClick( e, treeName )
{
    var event = e || window.event;
    var nodeTitle = getEventTarget( event );
    var node = nodeTitle.parentNode;
    var treeObject = document.getElementById( treeName );

    treeObject.setSelectedNode( node );
    if( treeObject.jsOnClick )
    {
        if( treeObject.jsOnClick( e, new Array( treeObject, node ) ) == false )
            return false;
    }

    if( treeObject.hasServerOnClick )
    {
        submitClickEvent( treeObject, node.id );
        return false;
    }

    return true;
}

function JTAjaxWaitPopupInitialize(name, html) {
    if (xajax) {
        $(document).ready(function () {
            var div = document.createElement("DIV");
            div.innerHTML = html;

            document.body.appendChild(div);

            xajax.loadingFunction = function () {
                var $p = $("#" + name);

                $p.css({ display: "block", visibility: "hidden" });
                $p.css({
                    left: (getBrowserScrollX() + (getBrowserWidth() - $p.width()) / 2),
                    top: (getBrowserScrollY() + (getBrowserHeight() - $p.height()) / 2),
                    display: "none",
                    visibility: "visible" });

                $("#" + name + "_background").fadeIn("fast");
                $p.fadeIn("fast");
            };

            xajax.doneLoadingFunction = function () {
                $("#" + name + "_background").fadeOut("fast");
                $("#" + name).fadeOut("fast");
            }

            xajax.callback.global.onRequest = xajax.loadingFunction;
            xajax.callback.global.onComplete = xajax.doneLoadingFunction;
        });
    }
}