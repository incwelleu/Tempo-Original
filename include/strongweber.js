// insert JavaScript source code here

    function OpenDocuments(doc)
    {

      nAlto = 660  //alto inicial
      nAncho= 820 //ancho
      nLeft = (screen.width-nAncho)/2
      nTop  = (screen.height-nAlto)/2
      win = window.open(doc,'','height=' + nAlto + ',width=' + nAncho +',top=' + nTop + ',left=' + nLeft + ',toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,modal=yes');
      win.focus();

      return win;
      //window.open(doc,"new","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=600,height=600");
      //return false;
    }


    function SignIn()

    {
      var ventana = window.parent;
      ventana.opener = window.parent;
      ventana.location = 'login.php';

      return false;
    }


    function CloseSession(domain)
    {
      var ventana = window.parent;

      ventana.opener = window.parent;
      ventana.location = "http://" + domain;

      return false;
    }


    function ViewWindow(cPHP)
    {
      nAlto = 660  //alto inicial
      nAncho= 820 //ancho
      nLeft = (screen.width-nAncho)/2
      nTop  = (screen.height-nAlto)/2
      win = window.open(cPHP,'height=' + nAlto + ',width=' + nAncho +',top=' + nTop + ',left=' + nLeft + ',toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,modal=yes');
      win.focus();

      return win;
    }


    function sw_SelectComboBox(objComboBox, cellvalue)
    {
        var xlong=objComboBox.options.length;

        for (j=0; j<xlong; ++j){
          if (objComboBox.options[j].text == cellvalue){
            objComboBox.options[j].selected = true;
          }
        }
    }


    function sw_SearchStringInArray(InArray, strKey, strSearch)
    {
        for (j=0; j<InArray.length; ++j){
          if (InArray[j][strKey] == strSearch){
            return j;
          }
        }

        return -1;
    }

    function sw_validate_email(email)
    {

      return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(email));

    }

    function sw_change_tax_rate(objectValue, objectSelect, session) {
      var data = {
            table: 'tax_rate',
            fieldId: 'tax_rate_id',
            fieldIdValue: $("#" + objectValue).val(),
            fieldView: 'overhead_rate_no',
            defaultValue: 0.00,
            session: session
          };

      $.ajax({
        type: "POST",
        url: "include/get_select_option.php",
        data: data,
        dataType: "html",
        success: function(r){
          $("#" + objectSelect).html(r);
        }
      });
    }

