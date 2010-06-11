<?php

/*
//debug code

require_once "clsDataConn.php";
$RefFigure = new RefFigure(2,true);
//echo "top1 _" . $RefFigure->name . "_<BR>";

//$RefFigure->name = "1.01";
//echo "top2 _" . $RefFigure->name . "_<BR>";

//$RefFigure->commitFields();

//$RefFigure = new RefFigure(2,false);
//echo "top3 _" . $RefFigure->name . "_<BR>";
*/

class RefFigure {

// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $name;
	public $exploded_view_file;
	public $text_file;
	public $hub_identification_chart_file;
	
	private $dataconn;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($id,$debugOutput = false) 
	{
		$this->dataconn = new DataConn("");
		$no_return = $this->loadFields($id,$debugOutput);
	}
	
	function __destruct () 
	{
		
	}
	
	public function deleteSelf () 
	{
		$sql = "DELETE FROM ref_figures WHERE id = '".mysql_real_escape_string($this->id)."'";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function loadFields ($id,$debugOutput = false)
	{
		if (is_numeric($id)) {
			$sql = "SELECT * FROM ref_figures WHERE id = '".mysql_real_escape_string($id)."'";
			$reffigureData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
			if (is_array($reffigureData)) {
				//echo "loadFields _".$reffigureData["ref_figures.name"][0] . "_<BR>\n";
				$this->id = $id;
				$this->name = $reffigureData["ref_figures.name"][0];
				$this->exploded_view_file = $reffigureData["ref_figures.exploded_view_file"][0];
				$this->text_file = $reffigureData["ref_figures.text_file"][0];
				$this->hub_identification_chart_file = $reffigureData["ref_figures.hub_identification_chart_file"][0];
				
				if ($debugOutput == true) {
					var_dump($reffigureData);
				}
				
				return true;
			}
		}
		
		$this->id = 0;
		$this->name = "";
		$this->exploded_view_file = "";
		$this->text_file = "";
		$this->hub_identification_chart_file = "";
		return false;
	}
	
	public function commitFields ()
	{
		
		//need validation here for any required fields
		
		$sql = "
			UPDATE ref_figures SET 
				name = '".mysql_real_escape_string($this->name)."',
				exploded_view_file = '".mysql_real_escape_string($this->exploded_view_file)."',
				text_file = '".mysql_real_escape_string($this->text_file)."',
				hub_identification_chart_file = '".mysql_real_escape_string($this->hub_identification_chart_file)."'
			WHERE id = '".mysql_real_escape_string($this->id)."'";
		//echo $sql . "<BR>\n";
		return $this->dataconn->f_ExecuteSqlInsertID($sql);
	}
	
	public function insertNew ()
	{
		//this was not fully tested
		
		//need validation here for any required fields
		
		$sql = "
			INSERT INTO ref_figures (
				name, exploded_view_file,text_file,hub_identification_chart_file
			) VALUES (
				'".mysql_real_escape_string($this->name)."',
				'".mysql_real_escape_string($this->exploded_view_file)."',
				'".mysql_real_escape_string($this->text_file)."',
				'".mysql_real_escape_string($this->hub_identification_chart_file)."'
				
			)";
		//echo $sql . "<BR>\n";
		return $this->dataconn->f_ExecuteSqlInsertID($sql);
	}
}