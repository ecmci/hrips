<!-- Purchase Items Table -->
	<fieldset><legend><b>Purchase Request Details</b></legend>
	<div class="row">
		<?=$items_error?>
		<table id="items_purchase">
			<thead>				
				<tr>
					<td>Item</td>
					<td>Quantity</td>
					<td>Description</td>
					<td>Est. Price</td>
					<td>Total Price</td>
				</tr>				
			</thead>				
			<tbody>
				<?php
					$i=0;
					foreach($items_purchase as $row){
						echo "<tr>";
						echo "<td><input size='5' type='text' name='ReqItemsPurchase[$i][item_num]' value='".$row['item_num']."'></td>";
						echo "<td><input size='5' id='qty' onkeyup='getValues()' type='text' name='ReqItemsPurchase[$i][qty]' value='".$row['qty']."'></td>";
						echo "<td><input maxlength='100' size='50' type='text' name='ReqItemsPurchase[$i][item_name_detail]' value='".$row['item_name_detail']."'></td>";
						echo "<td><input id='rate' onkeyup='getValues()' type='text' name='ReqItemsPurchase[$i][est_price]' value='".$row['est_price']."'></td>";
						echo "<td><input id='subTotal' type='text' disabled='disabled' name='subTotal'></td>";
						echo "</tr>";
						$i++;						
					}
				?>				
			<tbody>
		</table>
	</div>

	<p><input type="button" value="Add Item" onclick="addRowPurchaseItems()" /></p>
	<p>Purchase Total: <input type="text"  id="total" name="total" style="width:80px;" value="0.00" disabled="disabled"></p>
	</fieldset>	