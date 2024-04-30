 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	
	var ajax = new XMLHttpRequest();
    ajax.open("GET", "data.php", true);
    ajax.send();
	
	
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
		htmlRows += '<td><select class="form-control font" name="itemtype[]" id ="itemtype_'+count+'" required>';
		htmlRows += '<option value=""> ເລືອກ ອຸປະກອນ </option>';
		htmlRows += '<option value="1"> ນ້ຳດື່ມ </option>';
		htmlRows += '<option value="2"> ສະແນັກ </option>';
		htmlRows += '<option value="3"> ຄອມພິວເຕີ </option>';
		htmlRows += '<option value="4"> ພອຍເຕີ້ </option>';
		htmlRows += '<option value="5"> ກາເຟ </option>';
		htmlRows += '<option value="6"> ເຟີດຂຽນກະດານຟ້າ </option>';
		htmlRows += '<option value="7"> ເຟີດຂຽນກະດານແດງ </option>';
		htmlRows += '<option value="8"> ໂປຣເຈັກເຕີ້ </option>';
		htmlRows += '<option value="9"> ໄມ </option>';
		htmlRows += '<option value="10"> ຊາ </option>';
		htmlRows += '<option value="11"> ໂອວັນຕິນ </option>';
	  
		 
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';       
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		 
	});		
	 
 
 
});	