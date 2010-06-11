		
		<div class="long">
		<div class='label'><strong>Search Product Line:</strong></div>
		<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class='clear'></div>
		
		<div class='long'>
		<div class='label'><strong>Number of Teeth:</strong></div>
		<form name="form_no_of_teeth" id="form_no_of_teeth" method="get" action="part_finder.php" class="form">	
			<?
			require_once "includes/classes/clsNoOfTeeth.php";
			$no_of_teeth 		= new NoOfTeeth();
			FormObjects::selectBox("no_of_teeth", $no_of_teeth->displays, $no_of_teeth->values, $get["no_of_teeth"], "dropdown", "product_line"); ?>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">	
		</form>
		</div>