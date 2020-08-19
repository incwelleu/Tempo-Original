<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jttoolbar.inc.php");

session_start();

//Class definition
class view_report extends fmstrong
{
    public $ImageList = null;
	  public $sql_report = null;
    public $gridData = null;
    public $sqlResult = null;
    public $dsResult = null;
    public $SiteTheme = null;
    public $report_id = null;
    public $btnViewReport = null;

    function view_reportCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ViewReportData();
    }


		function ViewReportData()
    {
    	Global $language;
      unset($_POST['btnViewReportSubmitEvent']);


      if (isset($_REQUEST['ID'])) {
      	$this->report_id->Value = $_REQUEST['ID'];
      }

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnCustomFilter'] = array(btnCustomFilter, 1, "8");
      $items['btnExportXLS'] = array(btnExportXLS, 1, "9");

      $this->btnViewReport->Items = $items;

    	$report = sw_get_data_table("report", "report_id = {$this->report_id->Value}");
      $this->lbTitle->Caption = $report["description_{$language}"];
      $this->lbTitle->Visible = True;

      $sql = trim($report['sql']);
      eval("\$this->sql_report->Value = \"$sql\";");
      $this->sqlResult->SQL = $this->sql_report->Value;
      $this->CreateColumnGrid($report);
    }


    //Creted Grid Tax
    function CreateColumnGrid($report)
    {
      $columns_report = explode(',', $report['column']);

      foreach ($columns_report as $column){
        // FTP: All docs uploaded last 12 months
        $property = array();
        if (($this->report_id->Value == 2) && (trim($column) == 'description')){
          $property = array(HYPER_LINK_FIELD => 'link');
        }
      	$columns[] = sw_create_grid_column(trim($column), $this->gridData, $property);
      }

    	$this->gridData->Columns = $columns;
      $this->gridData->SortBy = $report['order_by'];
      $this->gridData->ExportFileName = sw_clean_characters_spanish($this->lbTitle->Caption);
			$this->gridData->Header->ShowFilterBar = True;
    }


    function gridDataSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = $this->sql_report->Value;
      $lwhere = strpos(strtoupper($sql), 'WHERE') !== False;
      $lgroup = strpos(strtoupper($sql), 'GROUP BY') !== False;
      $lhaving = strpos(strtoupper($sql), 'HAVING') !== False;

      if (!$lwhere && !$lgroup) $where = " WHERE ";
      else if (($lwhere && !$lgroup) || ($lgroup && $lhaving)) $where = " AND ";
      else if ($lgroup && !$lhaving) $where = " HAVING ";

    	if (($filterSql) && (sw_valid_sql($sql . $where . $filterSql))){
          $sql .= $where . $filterSql;
      }

      $sortSql = " ORDER BY " . $sortSql;
      $this->sqlResult->SQL = $sql . $sortSql;
    }


    function gridDataSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;" . $Columna->Caption] = $Total;
    }


    function btnViewReportJSClick($sender, $params)
    {
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];

          if (toolButton == 'btnViewReport'){
        		if (toolButtonName == 'btnFilter') {
          		gridData.deselectAll();
							gridData._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridData->ajaxCall('filter_grid', array(), array($this->gridData->Name)); ?>
          		return false;
        		}
        		else if (toolButtonName == 'btnCustomFilter') {
          		gridData.deselectAll();
							gridData._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridData->ajaxCall('custom_filter_grid', array(), array($this->gridData->Name)); ?>
          		return false;
        		}
          }
        //end
        <?php
    }

    function btnViewReportClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnExportXLS")
      {
        $filename = sw_clean_characters_spanish($this->lbTitle->Caption);
      	$this->gridData->exportGridToXLSDownload($filename . ".xls", $filename, True);
      }
    }

    function gridDataRowData($sender, $params)
    {
      $fields = &$params[1];

      if (isset($fields['invoice_pdf']) && $fields['link']){
        $fields['invoice_pdf'] = 'images/ftp/1px.gif';
        $file = utf8_decode($fields['link']);
        if (($file != "") && file_exists($file))
        {
          $fields['invoice_pdf'] = 'images/ftp/pdf.gif';
        }else $fields['link'] = "";
      }
    }


    function gridDataJSSelect($sender, $params)
    {
        ?>
        //begin js
					var $pdf = sw_SearchStringInArray(sender.FEditableColumns, 'Name', 'invoice_pdf');
					var $link = sw_SearchStringInArray(sender.FEditableColumns, 'Name', 'link');

          if (parseInt(col) === $pdf)
        	{
        		var cellValue = sender.getCellText(row, $link);

          	if (cellValue && parseInt(sender.SelectedCol) != 0){
          		window.open(cellValue + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000),"_blank","", false);
							sender.SelectedCol = 0;
          	}
          }
        //end
        <?php
    }

}

global $application;

global $view_report;

//Creates the form
$view_report=new view_report($application);

//Read from resource file
$view_report->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $view_report->show();

?>