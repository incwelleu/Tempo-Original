/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/
var JTDateTimePickerList = new Array();
var JTDateTimePickerActive = null;
var JTDateTimePickerSkipClick = false;

addEvent( window, "load", JTDateTimePickerOnLoad );
addEvent( document, "click", JTDateTimePickerDocumentClick );

function JTDateTimePickerInitialize( id, jsOnChange, timeDisplayFormat, jsOnBlur, jsOnFocus )
{
    var datePicker = document.getElementById( id );
    
    datePicker.inputContainer = document.getElementById( id + "_container" );
    
    if( JTIEVer > -1 )
        document.getElementById( id + "_calendar" ).onselectstart = function () { return false; };

	JTDateTimePickerCleanup( id );

	addEvent(datePicker, "click", function() { JTDateTimePickerShowCalendar(id) });

	datePicker.getDate = JTDateTimePickerGetDate;
	datePicker.setDate = JTDateTimePickerSetDate;

	datePicker.jsOnChange = jsOnChange;
	datePicker.jsOnBlur = jsOnBlur;
	datePicker.jsOnFocus = jsOnFocus;
	datePicker.FTimeDisplayFormat = timeDisplayFormat;
	datePicker.timeFormat = ( ( timeDisplayFormat == "12Hour" ) ? "tt12Hour" : "tt24Hour" );

	if (!JTPageLoaded) {
		if (!inArray(JTDateTimePickerList, id))
			JTDateTimePickerList.push(id);
	}
	else
		JTDateTimePickerLoad(id);

    eval( "window." + id + " = datePicker;" );
}

function JTDateTimePickerOnKeyUp( id )
{
	JTDateTimePickerLoadCalendarForDate( id, parseDBDate( document.getElementById( id ).value ) );
}

function JTDateTimePickerOnBlur( id )
{
    var datePicker = document.getElementById( id );
	var selDate = parseDBDate( datePicker.value );

	if( !selDate )
		return;

	var year = selDate.getFullYear();
	var month = selDate.getMonth();
	var day = selDate.getDate();
	var h = parseInt( document.getElementById( id + "_h" ).value );
	var m = document.getElementById( id + "_m" ).value;
	var s = document.getElementById( id + "_s" ).value;
	var am = ( document.getElementById( id + "_a" ).selectedIndex == 0 );
	if( isNaN( h ) )
	{
		if( datePicker.FTimeDisplayFormat == "12Hour" )
		{
			h = 1;
			am = true;
		}
		else
		{
			h = 1;
		}
		m = 0;
		s = 0;
	}
	var dStr = "";
	dStr += strPad( year, 4, "0", "left" ) + "-";
	dStr += strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-";
	dStr += strPad( day, 2, "0", "left" ) + " ";
	if( datePicker.FTimeDisplayFormat == "12Hour" )
	{
		if( am )
		{
			if( h == 12 )
				h = 0;
		}
		else
		{
			if( h < 12 )
				h += 12;
		}
	}
	dStr += strPad( h, 2, "0", "left" ) + ":";
	dStr += strPad( m, 2, "0", "left" ) + ":";
	dStr += strPad( s, 2, "0", "left" );	
		
	datePicker.value = dStr;
 
	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );

	JTDateTimePickerLoadCalendarForDate( id, parseDBDate( datePicker.value ) );
}

function JTDateTimePickerShowCalendar( id )
{
	if( JTDateTimePickerActive )
		JTDateTimePickerDocumentClick();

	var curDate = parseDBDate( document.getElementById( id ).value );
	if( curDate == null )
		curDate = new Date();

    var picker = document.getElementById( id );
    var calendar = document.getElementById( id + "_calendar" );

    JTDateTimePickerLoadCalendarForDate( id, curDate );

	if( picker.inputContainer )
	{
		calendar.style.left = ( getObjectScreenX( picker.inputContainer ) ) + "px";
		calendar.style.top = getObjectScreenY( picker.inputContainer ) + picker.inputContainer.offsetHeight + "px";
	}
	else
	{
		calendar.style.left = ( getObjectScreenX( picker ) ) + "px";
		calendar.style.top = getObjectScreenY( picker ) + picker.offsetHeight + "px";
	}
	
    calendar.style.display = "block";
    
    JTDateTimePickerActive = picker;
    JTDateTimePickerSkipClick = true;

    if( picker.jsOnFocus )
		picker.jsOnFocus( picker );
}

function JTDateTimePickerLoadCalendarForDate( id, curDate )
{
    var i, d, l, month, year;
    var datePicker = document.getElementById( id );
    var selDate = parseDBDate( datePicker.value );
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

		className = "";
        if( selDate && selDate.getFullYear() == curDate.getFullYear() && selDate.getMonth() == curDate.getMonth() && selDate.getDate() == ( i + 1 ) )
            className = " jtdatepickerselected";
            
        if( todayDate.getFullYear() == curDate.getFullYear() && todayDate.getMonth() == curDate.getMonth() && todayDate.getDate() == ( i + 1 ) )
            className += " jtdatepickertoday";

        html += "<td class=\"jtdatepickercalendarcell" + className + "\" onclick=\"return JTDateTimePickerSelectDate( event, '" + id + "', '" + year + "', '" + month + "', '" + ( i + 1 ) + "' )\">" + ( i + 1 ) + "</td>";
    }

    html += "</tr></table>";

    document.getElementById( id + "_calendartable" ).innerHTML = html;
    document.getElementById( id + "_calendartitle" ).innerHTML = getMonthByName( month ) + " " + year;
    
    var h = ( selDate ? selDate.getHours() : "" );
    var m = ( selDate ? selDate.getMinutes() : "" );
    var s = ( selDate ? selDate.getSeconds() : "" );
    if( selDate )
    {
		if( datePicker.FTimeDisplayFormat == "12Hour" )
		{
			document.getElementById( id + "_a" ).selectedIndex = ( h < 12 ) ? 0 : 1;
			if( h == 0 )
				h = 12;
			else if( h > 12 )
				h -= 12;
		}

		h = strPad( h, 2, "0", "left" );
		m = strPad( m, 2, "0", "left" );
		s = strPad( s, 2, "0", "left" );		
	}
    document.getElementById( id + "_h" ).value = h;
    document.getElementById( id + "_m" ).value = m;
    document.getElementById( id + "_s" ).value = s;
    
    datePicker.curDate = curDate;
}

function JTDateTimePickerSelectDate( e, id, year, month, day )
{
	var datePicker = document.getElementById( id );
	var h = parseInt( document.getElementById( id + "_h" ).value, 10 );
	var m = document.getElementById( id + "_m" ).value;
	var s = document.getElementById( id + "_s" ).value;
	var am = ( document.getElementById( id + "_a" ).selectedIndex == 0 );
	if( isNaN( h ) )
	{
		if( datePicker.FTimeDisplayFormat == "12Hour" )
		{
			h = 1;
			am = true;
		}
		else
		{
			h = 1;
		}
		m = 0;
		s = 0;
	}
	var dStr = "";
	dStr += strPad( year, 4, "0", "left" ) + "-";
	dStr += strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-";
	dStr += strPad( day, 2, "0", "left" ) + " ";
	if( datePicker.FTimeDisplayFormat == "12Hour" )
	{
		if( am )
		{
			if( h == 12 )
				h = 0;
		}
		else
		{
			if( h < 12 )
				h += 12;
		}
	}
	dStr += strPad( h, 2, "0", "left" ) + ":";
	dStr += strPad( m, 2, "0", "left" ) + ":";
	dStr += strPad( s, 2, "0", "left" );	
		
	datePicker.value = dStr;
	var curDate = datePicker.curDate;
    if( curDate )
        JTDateTimePickerLoadCalendarForDate( id, curDate );
    
	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );
		
	var event = e || window.event;
	event.cancelBubble = true;
	if( event.stopPropagation )
		event.stopPropagation();
			
	return false;
}

function JTDateTimePickerOnLoad()
{
    var i;

    for( i = 0; i < JTDateTimePickerList.length; ++i )
        JTDateTimePickerLoad( JTDateTimePickerList[ i ] );

    JTDateTimePickerList = new Array();
}

function JTDateTimePickerLoad( id )
{
    var calendar = document.getElementById( id + "_calendar" );

    calendar.parentNode.removeChild( calendar );
    document.body.appendChild( calendar );
    calendar.style.zIndex = 1900;
}

function JTDateTimePickerDocumentClick()
{
    if( JTDateTimePickerSkipClick )
    {
        JTDateTimePickerSkipClick = false;
    }
    else if( JTDateTimePickerActive )
    {
        document.getElementById( JTDateTimePickerActive.id + "_calendar" ).style.display = "none";

		if( JTDateTimePickerActive.jsOnBlur )
			JTDateTimePickerActive.jsOnBlur( JTDateTimePickerActive );
        JTDateTimePickerActive = null;
    }
}

function JTDateTimePickerPrevYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() - 1 );

        JTDateTimePickerLoadCalendarForDate( id, curDate );
    }

    JTDateTimePickerSkipClick = true;
}

function JTDateTimePickerPrevMonth( id )
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

        JTDateTimePickerLoadCalendarForDate( id, curDate );
    }

    JTDateTimePickerSkipClick = true;
}

function JTDateTimePickerNextYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() + 1 );

        JTDateTimePickerLoadCalendarForDate( id, curDate );
    }

    JTDateTimePickerSkipClick = true;
}

function JTDateTimePickerNextMonth( id )
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

        JTDateTimePickerLoadCalendarForDate( id, curDate );
    }

    JTDateTimePickerSkipClick = true;
}

function JTDateTimePickerToday( id )
{
    JTDateTimePickerLoadCalendarForDate( id, new Date() );
	JTDateTimePickerSkipClick = true;
}

function JTDateTimePickerCleanup( id )
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

function JTDateTimePickerClear( id ) {
    var datePicker = document.getElementById(id);
    
    datePicker.value = "";

    if (datePicker.jsOnChange)
        datePicker.jsOnChange(new JTEvent(datePicker, "change"));
}

function JTDateTimePickerTimeBarClick()
{
	JTDateTimePickerSkipClick = true;	
}

function JTDateTimePickerTimeChange( id )
{
	// 24-hour time goes from 01:00:00 to 24:00:00
	var datePicker = document.getElementById( id );
    var selDate = parseDBDate( datePicker.value );
    if( !selDate )
		return;
	var year = selDate.getFullYear();
	var month = selDate.getMonth();
	var day = selDate.getDate();
	var h = parseInt( document.getElementById( id + "_h" ).value );
	var m = document.getElementById( id + "_m" ).value;
	var s = document.getElementById( id + "_s" ).value;
	var am = ( document.getElementById( id + "_a" ).selectedIndex == 0 );
	if( isNaN( h ) )
	{
		if( datePicker.FTimeDisplayFormat == "12Hour" )
		{
			h = 1;
			am = true;
		}
		else
		{
			h = 1;
		}
		m = 0;
		s = 0;
	}
	var dStr = "";
	dStr += strPad( year, 4, "0", "left" ) + "-";
	dStr += strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-";
	dStr += strPad( day, 2, "0", "left" ) + " ";
	if( datePicker.FTimeDisplayFormat == "12Hour" )
	{
		if( am )
		{
			if( h == 12 )
				h = 0;
		}
		else
		{
			if( h < 12 )
				h += 12;
		}
	}
	dStr += strPad( h, 2, "0", "left" ) + ":";
	dStr += strPad( m, 2, "0", "left" ) + ":";
	dStr += strPad( s, 2, "0", "left" );	
		
	datePicker.value = dStr;   
	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );
}

function JTDateTimePickerGetDate()
{
	return parseDBDate( this.value );
}

function JTDateTimePickerSetDate( value )
{
	var dStr = "";
	dStr += value.getFullYear() + "-";
	dStr += strPad( value.getMonth() + 1, 2, "0", "left" ) + "-";
	dStr += strPad( value.getDate(), 2, "0", "left" ) + " ";
	dStr += strPad( value.getHours(), 2, "0", "left" ) + ":";
	dStr += strPad( value.getMinutes(), 2, "0", "left" ) + ":";
	dStr += strPad( value.getSeconds(), 2, "0", "left" );	
	this.value = dStr;
}