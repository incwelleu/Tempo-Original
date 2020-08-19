/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/
var JTComboBoxList = [];
var JTComboBoxActive = null;

addEvent( window, "load", JTComboBoxOnLoad );

jQuery(document).mousedown(function(e) {
    if (JTComboBoxActive != null) {
        var n = e.target || e.srcElement;
        while (n != null) {
            if (n == JTComboBoxActive || n == JTComboBoxActive.DropDownBox) {
                return;
            }
            n = n.parentNode;
        }
        JTComboBoxCloseDropDown();
    }
});

function JTComboBoxInitialize(params)
{
    var id = params.Name;
	var comboBox = document.getElementById( id );
	var comboBoxView = document.getElementById( id + "_view" );
    var comboBoxIndex = document.getElementById( id + "_Index" );
	var comboBoxContainer = document.getElementById( id + "_container" );
	var comboBoxDropDownBox = document.getElementById( id + "_dropdownbox" );
	var $items = jQuery("li", comboBoxDropDownBox);

    comboBox.AutoDropDown = params.AutoDropDown;
	comboBox.container = comboBoxContainer;
	comboBox.DropDownBox = comboBoxDropDownBox;
	comboBox.DropDownCount = params.DropDownCount;
	comboBox.IsKeyValue = params.IsKeyValue;

	if (params.OnChange)
	    eval('comboBox.jsOnChange = ' + params.OnChange);
	else
	    comboBox.jsOnChange = null;

	if (params.OnBlur)
	    eval('comboBox.jsOnBlur = ' + params.OnBlur);
	else
	    comboBox.jsOnBlur = null;

	if (params.OnFocus)
	    eval('comboBox.jsOnFocus = ' + params.OnFocus);
	else
	    comboBox.jsOnFocus = null;

	comboBox.Style = params.Style;

	comboBox.Show = function() {
	    if (comboBoxView.disabled)
		    return;

		if (comboBoxDropDownBox.style.display == "block") {
		    return;
		}

	    var comboBoxDropDownBoxSizer = document.getElementById( id + "_dropdownboxsizer" );
	    var $container = jQuery(comboBoxContainer);
	    var $dropDown = jQuery(comboBoxDropDownBox);
	    var contPos = $container.offset();

        $items.removeClass("jtcomboboxitemselected");

        $dropDown.css({
            left: contPos.left,
            top: contPos.top + $container.outerHeight(),
            //width: $container.outerWidth(),
            height: (Math.min(comboBox.DropDownCount, $items.length) * comboBox.ItemHeight) + 2
        });
        $dropDown.scrollTop(0);
        $dropDown.slideDown(100, function() {
            if (comboBox.getItemIndex() > -1) {
                $dropDown.scrollTop(0);

                var $item = jQuery($items[comboBox.getItemIndex()]);
                var y = $item.position().top + $item.height() + 5;
                if (y > $dropDown.height()) {
                    $dropDown.scrollTop(y);
                }

                jQuery($items[comboBox.getItemIndex()]).addClass("jtcomboboxitemselected");
            }
        });

	    JTComboBoxActive = comboBox;
	}

	comboBox.Hide = function() {
	    if (comboBoxDropDownBox.style.display != "block") {
	        return;
	    }

	    var $dropDown = jQuery(comboBoxDropDownBox);

        $dropDown.slideUp(100);

	    JTComboBoxActive = null;
	}

	comboBox.getItemIndex = function() {
	    return parseInt(comboBoxIndex.value);
	}

	comboBox.setItemIndex = function(index) {
	    index = parseInt(index);

	    if (index < -1 || index >= $items.length || index == this.getItemIndex()) {
	        return;
	    }
	    this._SelectItem(index > -1 ? $items[index] : null);
	}

	comboBox.getSelectedValue = function() {
	    return this.value;
	}

	comboBox.setSelectedValue = function(value) {
	    for (var i = 0; i < $items.length; ++i) {
	        var $item = jQuery($items[i]);
            if ((this.IsKeyValue && $item.attr("data-value") == value) || (!this.IsKeyValue && $item.html() == value)) {
                this._SelectItem($items[i]);
                return;
            }
        }
        this._SelectItem(null);
	}

	comboBox.getSelectedText = function() {
	    return comboBoxView.value;
	}

	comboBox.setSelectedText = function(value) {
	    value += "&nbsp;";
	    var $selectedItem = $items.filter(
            function() {
                var b = (this.innerHTML == value);
                return b;
            });

        this._SelectItem($selectedItem.length ? $selectedItem[0] : null);
	}

    comboBox._Load = function () {
	    comboBoxDropDownBox.parentNode.removeChild(comboBoxDropDownBox);
	    document.body.appendChild(comboBoxDropDownBox);
	    comboBoxDropDownBox.style.zIndex = 1900;

	    // var $dropDown = jQuery(comboBoxDropDownBox);
	    // $dropDown.css({ display: "block", visibility: "hidden" });
	    comboBoxDropDownBox.style.visibility = "hidden";
	    comboBoxDropDownBox.style.display = "block";

	    comboBox.ItemHeight = jQuery($items[0]).outerHeight(true);

	    // $dropDown.css({ display: "none", visibility: "visible" });
	    comboBoxDropDownBox.style.display = "none";
	    comboBoxDropDownBox.style.visibility = "visible";
	};

	comboBox._KeyDown = function(e) {
	    var kc = e.charCode || e.keyCode;
	    if (kc == 38 || kc == 40) {
	        var i = comboBox.getItemIndex();
	        if (i > -1) {
	            i = Math.min(Math.max(i + (kc == 38 ? -1 : 1), 0), $items.length - 1);
	        }
	        else {
	            i = 0;
	        }
	        comboBox.setItemIndex(i);
	        if (comboBox.AutoDropDown) {
	            comboBox.Show();
	        }
	    }
	}

	comboBox._KeyPress = function(e) {
	    var kc = e.charCode || e.keyCode;
	    var cc = String.fromCharCode(kc);
	    if (comboBox.Style == 'DropDown') {
	        if (kc > 31 && (kc < 37 || kc > 40)) {
	            var selLength = getSelectionLength(comboBoxView);
	            var selStart = getCaretPosition(comboBoxView) - selLength;
	            var text = comboBoxView.value;
	            text = text.substr(0, selStart) + cc + text.substr(selStart + selLength, text.length);
	            text = text.toLowerCase();
	            for (var i = 0; i < $items.length; ++i) {
	                if ($items[i].innerHTML.substr(0, text.length).toLowerCase() == text) {
	                    comboBox._SelectItem($items[i]);

	                    var p = selStart + 1;
	                    setCaretPosition(comboBoxView, p, $items[i].innerHTML.length - p);

	                    if (e.stopPropagation)
                            e.stopPropagation();
                        if (e.preventDefault)
                            e.preventDefault();

	                    if (comboBox.AutoDropDown) {
	                        comboBox.Show();
	                    }

	                    return false;
	                }
	            }

                comboBox.value = "";
                comboBoxIndex.value = -1;
                // console.log("setting to -1");
                // console.trace();

                if (comboBox.jsOnChange) {
                    setTimeout(function() { comboBox.jsOnChange(new JTEvent(comboBox, "change")); }, 1);
                }
	        }
	    }
	}

	comboBox._SelectItem = function(item) {
	    var val, text;

	    if (item) {
	        text = item.innerHTML;
            text = text.substring(0, text.length - "&nbsp;".length);
	        val = this.IsKeyValue ? jQuery(item).attr("data-value") : text;
	    }
	    else {
	        val = '';
            text = '';
	    }

        var changed = (this.value != val);

        this.value = val;
	    comboBoxIndex.value = item ? $items.index(item) : -1;
	    // console.log("setting to " + comboBoxIndex.value);
	    // console.trace();
	    comboBoxView.value = text;

        if (comboBoxDropDownBox.style.display == "block") {
		    $items.removeClass("jtcomboboxitemselected");

		    if (item) {
		        var $dropDown = jQuery(comboBoxDropDownBox);
		        var itemTop = item.offsetTop;

		        if (itemTop < $dropDown.scrollTop()) {
		            $dropDown.scrollTop(itemTop);
		        }
		        else if((itemTop + this.ItemHeight) > ($dropDown.scrollTop() + comboBoxDropDownBox.clientHeight)) {
                    $dropDown.scrollTop(itemTop - comboBoxDropDownBox.clientHeight + this.ItemHeight);
                }
                jQuery(item).addClass("jtcomboboxitemselected");
            }
		}

        if (changed && this.jsOnChange) {
		    this.jsOnChange(new JTEvent(this, "change"));
        }
	}

	comboBox._ViewBlur = function(e) {
	    if (comboBox.Style == 'DropDown') {
	        var index = -1;

	        for (var i = 0; i < $items.length; ++i) {
	            var text = $items[i].innerHTML;
                text = text.substring(0, text.length - "&nbsp;".length);
	            if (text == comboBoxView.value) {
	                index = i;
	                break;
	            }
	        }

	        if (index > -1) {
	            comboBox._SelectItem($items[index]);
	        }
	        else if (comboBox.getItemIndex() != -1) {
	            comboBoxIndex.value = -1;
	            comboBox.value = "";
	            // console.log("setting to -1");
	            // console.trace();

	            if (comboBox.jsOnChange) {
		            comboBox.jsOnChange(new JTEvent(comboBox, "change"));
                }
	        }
	    }
	    if (comboBox.jsOnBlur) {
	        comboBox.jsOnBlur(e);
	    }
	    //console.trace();
	    //setTimeout(function() { comboBox.Hide(); }, 200);
	}

	comboBox._ViewChange = function(e) {
	}

	JTComboBoxCleanup( id );

    $items.hover(
        function() {
            jQuery(this).addClass("over");
        }, function() {
            jQuery(this).removeClass("over");
        });

    $items.mousedown(
        function() {
            comboBox._SelectItem(this);
	        JTComboBoxCloseDropDown();
        });

	var $view = jQuery(comboBoxView);
	$view.keydown(comboBox._KeyDown).blur(comboBox._ViewBlur);

    if (comboBoxView.disabled) {
        jQuery(comboBoxContainer).addClass("jtcomboboxdisabled");
    }

	if (comboBox.jsOnFocus) {
	    $view.focus(comboBox.jsOnFocus);
	}

    if (params.Style == 'DropDown') {
        $view.keypress(comboBox._KeyPress);
        $view.change(comboBox._ViewChange);
        $view.removeAttr('readonly');
    }

    if (!JTPageLoaded)
        JTComboBoxList.push( id );
    else
        comboBox._Load();

    window[id] = comboBox;
}

function JTComboBoxOnLoad()
{
	for (var i = 0; i < JTComboBoxList.length; ++i)
        document.getElementById(JTComboBoxList[i])._Load();

    JTComboBoxList = [];
}

function JTComboBoxCleanup( id )
{
	var node;
	var children = ( document.body.childNodes ) ? document.body.childNodes : document.documentElement.childNodes;

	id += "_dropdownbox";

	for (var i = 0; i < children.length; ++i) {
		node = children[ i ];
		if (node.id == id) {
			document.body.removeChild( node );
			break;
		}
	}
}

function JTComboBoxShowDropDownBox( id )
{
	document.getElementById( id ).Show();
}

function JTComboBoxCloseDropDown() {
	if (JTComboBoxActive)
	    JTComboBoxActive.Hide();
}
