<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtradiobuttonlist.inc.php");

define('COL_COMPANY_ID', 0);
define('COL_YEAR_DATA_NO', 1);
define('COL_MONTH_DATA_NO', 2);


//Class definition
class relation_upload_file extends fmstrong
{
    public $btnUpload = null;
    public $gridUpload = null;
    public $company_id = null;
    public $rowUpload = null;
    public $sqlUpload_accounting = null;
    public $dsUpload_accounting = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $pnParameter = null;
    public $lbFrom = null;
    public $lbTo = null;
    public $From_dt = null;
    public $To_dt = null;
    public $rbDateQuery = null;

    function relation_upload_fileCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterUpload();
    }


    function ParameterUpload()
    {
      Global $lblUploadFile, $lblDeleteFile, $MonthLetter;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnDelete'] = array($lblDeleteFile, True, "5");
      $items['btnEdit'] = array(btnEdit, True, "2");
      $items['btnSave'] = array(btnSave, True, "4");
      $items['btnCancel'] = array(btnCancel, True, "3");
      $this->btnUpload->Items = $items;

      $this->From_dt->Date = date("Y-m-d", mktime(0, 0, 0, 1, 1, date("Y")));
      $this->To_dt->Date = date("Y-m-d", mktime(0, 0, 0, 12, 31, date("Y")));
      $this->rbDateQuery->itemindex = 0;

      $sql = 'SELECT company_id, short_name FROM company ORDER BY short_name';
      $records = sw_records_array($sql, Array('company_id', 'short_name'));
      $this->gridUpload->Columns[COL_COMPANY_ID]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridUpload->Columns[COL_COMPANY_ID]->FilterOptions = $records;
      $this->gridUpload->Columns[COL_COMPANY_ID]->TextField = "short_name";

      $year[(idate('Y')-1)] = (idate('Y')-1);
      $year[idate('Y')]     = idate('Y');
      $this->gridUpload->Columns[COL_YEAR_DATA_NO]->ComboBoxEditor->Values = $year;
      $year[''] = '';
      $this->gridUpload->Columns[COL_YEAR_DATA_NO]->FilterOptions = $year;

      $this->gridUpload->Columns[COL_MONTH_DATA_NO]->ComboBoxEditor->Values = $MonthLetter;
      $filter = $MonthLetter;
      $filter[''] = '';
      $this->gridUpload->Columns[COL_MONTH_DATA_NO]->FilterOptions = $filter;
    }


    function btnUploadJSClick($sender, $params)
    {
      Global $lblDeleteFileMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowUpload").value;

          if (toolButton == 'btnUpload'){
        		if (toolButtonName == 'btnFilter') {
          		gridUpload.deselectAll();
							gridUpload._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridUpload->ajaxCall('filter_grid', array(), array($this->gridUpload->Name)); ?>
          		return false;
        		}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridUpload.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridUpload.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridUpload.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lblDeleteFileMsg ?>");}
                else return false;
            }
          }

        //end
        <?php
    }


    function btnUploadClick($sender, $params)
    {
      Global $VirtualFile, $lblUploadFile, $relation_upload_file;

      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnDelete")
      {
        $this->DeleteFileSelected();
      }
    }


    function DeleteFileSelected()
    {
      $upload_accounting_id = $this->gridUpload->SelectedPrimaryKeys;
      $upload_accounting_id = implode(",", $upload_accounting_id);

      if ($upload_accounting_id){
        Global $connectionDB;

        $sql = "SELECT * FROM upload_accounting WHERE upload_accounting_id in (" . $upload_accounting_id . ")";
        $query = new query();
        $query->Database = $connectionDB->DbConnection;
        $query->LimitStart = -1;
        $query->LimitCount = -1;
        $query->SQL = $sql;
        $query->open();

        While (!$query->EOF) {
          $file = $query->Fields['link'];
          if ((!file_exists($file)) || unlink($file)) {
            $connectionDB->DbConnection->BeginTrans();
            $connectionDB->DbConnection->execute("DELETE FROM upload_accounting WHERE upload_accounting_id = " . $query->Fields['upload_accounting_id']);
            $connectionDB->DbConnection->CompleteTrans();
          }
          $query->next();
        }
        $this->gridUpload->writeSelectedCells(array());
      }
    }

    function gridUploadSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT upload_accounting.*, short_name, processed_by_user, uploaded_by_user
              FROM upload_accounting
                LEFT JOIN
                  (SELECT user_id AS processed_by_user_id, user.username as processed_by_user FROM user) AS processed_user
                ON upload_accounting.processed_by_user_id = processed_user.processed_by_user_id
                LEFT JOIN
                  (SELECT user_id AS uploaded_by_user_id, user.username as uploaded_by_user FROM user) AS uploaded_user
                ON upload_accounting.created_by_user_id = uploaded_user.uploaded_by_user_id
                INNER JOIN company ON upload_accounting.company_id = company.company_id ";

      $query_date = "WHERE (upload_dt BETWEEN '{$this->From_dt->Date}' AND '{$this->To_dt->Date}')";
      if ($this->rbDateQuery->ItemIndex) {
        $query_date = "WHERE (processed_dt BETWEEN '{$this->From_dt->Date}' AND '{$this->To_dt->Date}')";
      }
      $sql .= $query_date;

      $this->FilterMonth($filterSql);

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlUpload_accounting->SQL = $sql;
    }


    function FilterMonth(&$filterSql)
    {
      $Column = $this->gridUpload->Columns[$this->gridUpload->findColumnByFieldName('month_data_no')];
      if (!eregi("NoFilter", $Column->FilterMethod) && ($Column->Filter))
      {
        Global $MonthLetter;

        $month_index = (string)array_search($Column->Filter, $MonthLetter);
        $month = $MonthLetter[$month_index];
        $filterSql = str_replace($month, $month_index, $filterSql);
      }
    }

    function gridUploadJSSelect($sender, $params)
    {
        ?>
        //begin js
        var a = getEventTarget(event);

        document.getElementById("rowUpload").value = row;

        if (a.tagName == "A" && a.href) {
          a.target = "_blank";
        }
        //end
        <?php
    }

    function gridUploadRowData($sender, $params)
    {
      Global $MonthLetter;

      $fields = &$params[ 1 ];

      $fields[ "month_data_no" ] = $MonthLetter[$fields[ "month_data_no" ]];
    }


    function gridUploadUpdate($sender, $params)
    {
      $fields = &$params[ 1 ];
      $fields[ 'upload_accounting_id' ] = $params[ 0 ];

      $fields[ 'processed_by_user_id' ] = $_SESSION['user_id'];
      if ($fields[ 'processed_dt' ] == '') unset($fields[ 'processed_dt' ]);

      //Update upload
      sw_update_table("upload_accounting", $fields, "upload_accounting_id = {$fields['upload_accounting_id']}");
    }

    function gridUploadJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        /* year_data  */
        var cellvalue = gridUpload.getCellText(rowIndex, <?php echo COL_YEAR_DATA_NO;?>);
        var objComboBox = document.getElementById("gridUpload_year_data_no_Editor");
        sw_SelectComboBox(objComboBox, cellvalue)

        /* year_data  */
        var cellvalue = gridUpload.getCellText(rowIndex, <?php echo COL_MONTH_DATA_NO;?>);
        var objComboBox = document.getElementById("gridUpload_month_data_no_Editor");
        sw_SelectComboBox(objComboBox, cellvalue)

        //end
        <?php
    }

    function imXLSClick($sender, $params)
    {
      $this->gridUpload->exportGridToXLSDownload("Relation upload file.xls", 'File name', true);
    }

    function From_dtJSChange($sender, $params)
    {
        echo $this->From_dt->ajaxCall("ParameterChange", array(), array("gridUpload"));
        ?>
        //begin js
          return false;
        //end
        <?php
    }

    function ParameterChange()
    {
      $this->gridUpload->SortBy = 'upload_dt';
      if ($this->rbDateQuery->ItemIndex) {
        $this->gridUpload->SortBy = 'processed_dt';
      }
    }


}

global $application;

global $relation_upload_file;

//Creates the form
$relation_upload_file=new relation_upload_file($application);

//Read from resource file
$relation_upload_file->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $relation_upload_file->show();

?>