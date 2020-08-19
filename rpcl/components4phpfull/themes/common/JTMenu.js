var JTMenuActive = null;
var JTMenuSkipClick = false;
var JTMenuList = [];

jQuery(window).load(function () {
    if (JTIEVer <= 6 && JTIEVer > -1) {
        var menuFrame = document.createElement( "IFRAME" );
        document.body.appendChild( menuFrame );
        menuFrame.id = "JTMenuFrame";
        menuFrame.scrolling = "no";
        menuFrame.frameBorder = 0;
        menuFrame.style.display = "none";
        menuFrame.style.position = "absolute";
        menuFrame.style.zIndex = 199;
    }

    for (var i = 0; i < JTMenuList.length; ++i) {
        JTMenuList[i].OnLoad();
    }
});

jQuery(document).click(function () {
    if (JTMenuSkipClick) {
        JTMenuSkipClick = false;
        return;
    }

    if (JTMenuActive) {
        JTMenuActive.Hide();
    }
});

function JTInitializeMenu(id, onClick, controlName, controlButton, controlAttachType, submitField)
{
    var menuObject = document.getElementById(id);
    if (!menuObject) {
        return;
    }

    menuObject.Popup = function( x, y )
    {
        var menuFrame = document.getElementById( "JTMenuFrame" );

        if (JTMenuActive)
            JTMenuActive.Hide();

        if (this.JTActiveChildMenu) {
            var childMenu = document.getElementById(this.JTActiveChildMenu.id + "_menu");
            if (childMenu) {
                childMenu.style.display = "none";
            }
        }

        this.style.left = x + "px";
        this.style.top = y + "px";
        // this.style.display = "block";

        if (menuFrame) {
            menuFrame.style.left = this.style.left;
            menuFrame.style.top = this.style.top;
            menuFrame.style.width = this.offsetWidth;
            menuFrame.style.height = this.offsetHeight;
            menuFrame.style.display = "block";
            menuFrame.style.zIndex = this.style.zIndex - 1;
        }

        jQuery(this).fadeIn("fast");

        JTMenuActive = this;
        JTMenuSkipClick = true;
    }

    menuObject.PopupForControl = function (ctl) {
        var x = getObjectScreenX(ctl);
        var y = getObjectScreenY(ctl) + ctl.offsetHeight;

        if (typeof (heightOffset) == "undefined")
            heightOffset = 0;

        this.Popup(x, y + heightOffset);
    }

    menuObject.Hide = function()
    {
        var menuFrame = document.getElementById( "JTMenuFrame" );

        if( menuFrame )
            menuFrame.style.display = "none";

        this.style.display = "none";

        JTMenuActive = null;
    }

    menuObject.OnLoad = function() {
        jQuery("#" + id + " .jtmenuitem")
            .hover(
                function () {
                    jQuery(this).addClass("jtmenuitem_over");

                    if (this.parentNode.JTActiveChildMenu && this.parentNode.JTActiveChildMenu != this) {
                        var childMenu = document.getElementById(this.parentNode.JTActiveChildMenu.id + "_menu");
                        if (childMenu) {
                            childMenu.style.display = "none";
                        }
                    }

                    var childMenu = document.getElementById(this.id + "_menu");
                    if (childMenu) {
                        var x = this.offsetWidth + ((this.parentNode.offsetWidth - this.offsetWidth) / 2);
                        var y = 0;

                        if (childMenu.offsetWidth == 0) {
                            jQuery(childMenu)
                                .css({
                                    display: "none",
                                    left: x + "px",
                                    top: y + "px"
                                })
                                .fadeIn("fast");
                        }

                        this.parentNode.JTActiveChildMenu = this;
                    }
                },
                function () {
                    jQuery(this).removeClass("jtmenuitem_over");
                })
            .click(
                function (e) {
                    if (onClick && onClick(e, this.id, jQuery(this).attr("tag")) === false) {
                        return false;
                    }

                    if (JTMenuActive) {
                        JTMenuActive.Hide();
                    }

                    if (jQuery("a", this).attr("href") == "") {
                        if (submitField) {
                            var field = document.getElementById(submitField);

                            field.value = this.id;
                            if (field.form.onsubmit) {
                                field.form.onsubmit();
                            }
                            field.form.submit();
                        }

                        return false;
                    }

                    e.stopImmediatePropagation();
                });

        if (this.controlName && this.controlButton) {
            var controlObject = document.getElementById(this.controlButton);

            if (controlObject) {
                controlObject.menuObject = this;

                if (this.controlAttachType)
                    addEvent(controlObject, this.controlAttachType, JTMenuControlMouseOver);
            }
        }

        this.parentNode.removeChild(this);
        document.body.appendChild(this);

        this.style.zIndex = getTotalDocumentTagCount() + 2;

        var outer = getOuterNode(this);
        if (outer)
            outer.style.display = "none";
    }

    menuObject.controlName = controlName;
    menuObject.controlButton = controlButton;
    menuObject.controlAttachType = controlAttachType;

    window[menuObject.id] = menuObject;

    if( !JTPageLoaded )
        JTMenuList.push( menuObject );
    else
        menuObject.OnLoad();
}

function JTMenuShowForControl( controlObject, heightOffset )
{
    if( controlObject && controlObject.menuObject )
    {
        var x, y;

        x = getObjectScreenX( controlObject ) - getObjectScreenX( getSizedParentNode( controlObject.menuObject ) );
        y = getObjectScreenY( controlObject ) - getObjectScreenY( getSizedParentNode( controlObject.menuObject ) ) + controlObject.offsetHeight;

        if( controlObject.clientWidth > 0 )
            x += ( controlObject.offsetWidth - controlObject.clientWidth ) / 2;

        if( typeof( heightOffset ) == "undefined" )
            heightOffset = 0;

        controlObject.menuObject.Popup( x, y + heightOffset );
    }
}

function JTMenuCleanup(id) {
    document.body.removeChild(document.getElementById(id));
}

function JTMenuBarInitialize(settings, onClick) {
    jQuery("#" + settings.Id + " .jtmenubarinner .jtmenubaritem")
        .hover(
            function () {
                jQuery(this).addClass("jtmenubarbutton_over");

                if (JTMenuActive && JTMenuActive.controlName == settings.Id) {
                    JTMenuShowForControl(this);
                    JTMenuSkipClick = false;
                }
            },
            function () {
                jQuery(this).removeClass("jtmenubarbutton_over");
            })
        .click(
            function (e) {
                if (onClick && onClick(e, this.id, jQuery(this).attr("tag")) === false) {
                    return false;
                }

                JTMenuShowForControl(this);
                JTMenuSkipClick = false;

                if (jQuery(this).attr("href") == "") {
                    return false;
                }
            });

    $.each(settings.Items, function (index, item) {
        JTInitializeMenu(item.MenuId, onClick, settings.Id, item.ButtonId, '',
            settings.SubmitFieldId);
    });
}