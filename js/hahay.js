$(document).ready(function(){
  var deptCount = $("#myTable > tbody > tr").length + 1;
  $('#addDeptBtn').click(function(){
      try{          
          var dept_id = $('#dept_id').val();
          var user_id = '';
          if(dept_id == '')throw 'Please select at least one department.';
          var dept_name = $('#dept_id').find(':selected').text();
          var r = $('#addDept-read').is(':checked') ? '1' : '0';
          var u = $('#addDept-update').is(':checked') ? '1' : '0';
          var d = $('#addDept-delete').is(':checked') ? '1' : '0';
          var row_id = 'deptRow'+deptCount;
          var idex = deptCount;
          $('#access > tbody').append(
            '<tr id="'+row_id+'">'+
                '<td><input name="HrisDocumentAccess['+idex+'][user_id]" value="'+user_id+'" type="hidden"/>'+user_id+'</td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][dept_id]" value="'+dept_id+'" type="hidden"/>'+dept_name+'</td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][read]" value="'+r+'" type="checkbox" '+((r=='1')?"checked=checked":"")+' /></td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][update]" value="'+u+'" type="checkbox" '+((u=='1')?"checked=checked":"")+' /></td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][delete]" value="'+d+'" type="checkbox" '+((d=='1')?"checked=checked":"")+' /></td>'+
                '<td><button class="btn btn-mini" onclick="$(\'#'+row_id+'\').fadeOut(300,function(){ $(\'#'+row_id+'\').remove(); });return false;">Remove</button></td>'+
            '</tr>'
          );
          deptCount++;
      }catch(err){
          alert(err);
      }
      return false;
  });
  
  $('#addUserBtn').click(function(){
      try{          
          var user_id = $('#user_id').val();
          var dept_id = '';
          if(user_id == '')throw 'Please select at least one user.';
          var user_name = $('#user_id').find(':selected').text();
          var dept_name = '';
          var r = $('#addUser-read').is(':checked') ? '1' : '0';
          var u = $('#addUser-update').is(':checked') ? '1' : '0';
          var d = $('#addUser-delete').is(':checked') ? '1' : '0';
          var row_id = 'deptRow'+deptCount;
          var idex = deptCount;
          $('#access > tbody').append(
            '<tr id="'+row_id+'">'+
                '<td><input name="HrisDocumentAccess['+idex+'][user_id]" value="'+user_id+'" type="hidden"/>'+user_name+'</td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][dept_id]" value="'+dept_id+'" type="hidden"/>'+dept_name+'</td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][read]" value="'+r+'" type="checkbox" '+((r=='1')?"checked=checked":"")+' /></td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][update]" value="'+u+'" type="checkbox" '+((u=='1')?"checked=checked":"")+' /></td>'+
                '<td><input name="HrisDocumentAccess['+idex+'][delete]" value="'+d+'" type="checkbox" '+((d=='1')?"checked=checked":"")+' /></td>'+
                '<td><button class="btn btn-mini" onclick="$(\'#'+row_id+'\').fadeOut(300,function(){ $(\'#'+row_id+'\').remove(); });return false;">Remove</button></td>'+
            '</tr>'
          );
          deptCount++;
      }catch(err){
          alert(err);
      }
      return false;
  });
  
});
