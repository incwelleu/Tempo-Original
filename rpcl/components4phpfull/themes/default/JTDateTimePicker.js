/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/

function JTDateTimePickerInitialize( id, jsOnChange, timeDisplayFormat, jsOnBlur, jsOnFocus )
{
    var datePicker = document.getElementById( id );
    var inputHeight;
    
    if( datePicker.parentNode.parentNode.parentNode.className == "inputcontainer" )
		datePicker.inputContainer = datePicker.parentNode.parentNode.parentNode;
    
    if( JTIEVer > -1 )
    {
        document.getElementById( id + "_dropdown" ).style.top = "2px";
        document.getElementById( id + "_calendar" ).onselectstart = function () { return false; };
    }

	JTDateTimePickerCleanup( id );

	addEvent(datePicker, "click", function() { JTDateTimePickerShowCalendar(id) });

	datePicker.jsOnChange = jsOnChange;
	datePicker.jsOnBlur = jsOnBlur;
	datePicker.jsOnFocus = jsOnFocus;
	datePicker.FTimeDisplayFormat = timeDisplayFormat;
	datePicker.timeFormat = ( ( timeDisplayFormat == "12Hour" ) ? "tt12Hour" : "tt24Hour" );

    if( !JTPageLoaded )
        JTDateTimePickerList.push( id );
    else
        JTDateTimePickerLoad( id );

    eval( "window." + id + " = datePicker;" );
}
function JTDateTimePickerLoad( id )
{
	var datePicker = document.getElementById( id );
    var inputHeight;
    if( datePicker.parentNode.parentNode.parentNode.className == "inputcontainer" )
		inputHeight = datePicker.parentNode.parentNode.parentNode.offsetHeight + 2;
	else
		inputHeight = datePicker.offsetHeight;

    if( inputHeight > 0 )
    {
		if( JTIEVer > -1 )
			inputHeight -= 2;

        document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 0 ) + "px";
    }

    var calendar = document.getElementById( id + "_calendar" );

    calendar.parentNode.removeChild( calendar );

    document.body.appendChild( calendar );

    calendar.style.zIndex = 1900; //getParentNode( calendar ).childNodes.length + 2;
}

