<script>
var tbl = null;
var rowId = null;
$(document).ready(function(){
	tbl = document.getElementById('mychildren');
	rowId = tbl.rows.length;	
});

function addRowChild() {
	 
	var table = document.getElementById('mychildren');

	var rowIdx = table.rows.length;
	var row = table.insertRow(rowIdx);
	rowIdx -= 1;
	row.id = rowId;
	
	//item_num cell
	var cell = row.insertCell(0);
	var element = document.createElement("input");
	element.type = "text";
	element.id="mychildren_childname";
	element.name = "mychildren["+rowIdx+"][childname]";
	element.size = "5";
	element.setAttribute('required', 'required');
	cell.appendChild(element);
	
	//qty cell
	var cell = row.insertCell(1);
	var element = document.createElement("input");
	element.type = "text";
	element.id = "bday["+rowIdx+"]";
	element.name = "mychildren["+rowIdx+"][bday]";
	element.size = "5";
	//element.setAttribute('onkeyup', 'getValues('+rowIdx+')');
	element.setAttribute('required', 'required');
	cell.appendChild(element);
	
	var cell = row.insertCell(2);
	var element = document.createElement("a");
	var txt = document.createTextNode("Remove");
	element.id='rem-lnk';
	element.href='#';
	element.appendChild(txt);	
	element.setAttribute('onclick', 'deleteRow('+rowId+')');
	cell.appendChild(element);

	
	rowId++;
}

function deleteRow(id) {
	try {
		$('#'+id).remove();
	}catch(e) {
		console.log(e);
	}
}
</script>

<table id="mychildren">
	<thead><tr><td>Child Name</td><td>Birthday</td></tr></thead>
		<tbody>
			<?php
				$children=array();
				foreach($children as $i=>$child):
			?>
			<tr id="<?=$i?>">
				<td><?php echo $form->textField($child,"[$i]ChildName",array('size'=>'5','required'=>'required')); ?></td>
				<td><?php if($i>0):?><a id="rem-lnk" href="#" onclick="deleteRow(<?=$i?>)">Remove</a><?php endif; ?></td>
			</tr>
			<?php endforeach; ?>	
		</tbody>
</table>

<p><input type="button" value="Add Item" onclick="addRowChild()" /></p>