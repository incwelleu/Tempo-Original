<?php
require_once("rpcl/rpcl.inc.php");
require_once("functions.php");
require_once("acceso.php");
require_once("create_grid_column.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");

session_start();

//Class definition
class add_service_item_company extends Page
{
    public $SiteTheme = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $lbCompany = null;
    public $cbCompany = null;
    public $gridService = null;
    public $sqlService = null;
    public $dsService = null;
    public $btnSaveService = null;
    public $SelectedKeysService = null;
    public $btnClose = null;

    function __construct($aowner = null)
    {
      parent::__construct($aowner);

      Global $acceso;

      //Evaluated if the user has logged session
      $acceso->sw_login_check();
    }


    function add_service_item_companyCreate($sender, $params)
    {
      sw_style_selected($this);

      if (!$this->gridService->inSession('')){
      	$this->Caption = btnAddService;
      	$description = "description_{$_SESSION['language']}";
				$sql = "SELECT service_id, service_category.service_category_name,
                				CASE IFNULL({$description}, '') WHEN '' THEN description_en
                    		ELSE {$description} END as description,
                        price_amt
								FROM service LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id ";

      	$this->sqlService->SQL = $sql;

      	$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                        CAPTION => SW_CAPTION_SERVICE_CATEGORY_NAME,
                        DATA_FIELD => 'service_category_name',
                        WIDTH => 100);
      	$columns[] = sw_create_grid_column('service_id', $this->gridService, $property);
      	$columns[] = sw_create_grid_column('description', $this->gridService);
      	$columns[] = sw_create_grid_column('price_amt', $this->gridService);
      	$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '', WIDTH => 0, VISIBLE => false);
      	$columns[] = sw_create_grid_column('service_id', $this->gridService, $property);

    		$this->gridService->Columns = $columns;
        $this->gridService->SortBy = "service_category_name, description";
				$this->sqlService->open();
      }
    }


    function btnSaveServiceJSClick($sender, $params)
    {
      Global $lbRequiredFieldError;
        ?>
        //begin js
        var keys = [];
        var msgError = '';

        if (document.getElementById("cbCompany").value === '') {
          msgError = msgError + document.getElementById('lbCompany').innerHTML + '</br>';
        }

        if (msgError != ''){
          msgError = "<?php echo $lbRequiredFieldError; ?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
          return false;
        }

        for (var row in gridService.SelectedCells) {
        	if (typeof(gridService.SelectedCells[row]) != "function" &&
          	  (gridService.SelectedCells[row] != '') &&
              (gridService.SelectedCells[row] != null)) {
              keys.push(gridService.getPrimaryKey(row));
          }
        }

        if (findObj('SelectedKeysService').value = keys.join(',')){
         return true;
        }
        return false;
        //end
        <?php
    }


    function btnSaveServiceClick($sender, $params)
    {
    	Global $connectionDB, $invoice;

      $sql = "INSERT INTO line_item (company_id, created_dt, status_cd, service_id, description,
      															 quantity_no, price_amt, total_amt, commission_amt,
                                     future_commission_amt, service_type_id, created_by_user_id)
      				SELECT {$this->cbCompany->SelectedValue}, NOW(), '" . SW_STATUS_LI_SERVICE . "',
                     service_id, description_en, 1 AS quantity_no, price_amt,
                     (1 * price_amt) AS Total, commission_amt, future_commission_amt,
                     service_type_id, {$_SESSION['user_id']}
              FROM service
              WHERE service_id in ({$this->SelectedKeysService->Value})";

      $connectionDB->DbConnection->execute($sql);
    	$invoice->winProcess->Hide();
        ?>
           <script type="text/javascript">
            gridInvoice.Refresh();
           </script>
        <?php
    }

    function btnCloseClick($sender, $params)
    {
    	Global $invoice;
      $invoice->CloseWindows();
    }


}

global $application;

global $add_service_item_company;

//Creates the form
$add_service_item_company=new add_service_item_company($application);

//Read from resource file
$add_service_item_company->loadResource(__FILE__);

//Shows the form
$add_service_item_company->show();

?>