$('input:radio[name=userType]').click(function () {
	$clicked_value = $('input:radio[name=userType]:checked').val();
	if($clicked_value == 1){
		$("#privilegesArea").hide();
	}else{
		$("#privilegesArea").show();
	}
});


$('input:radio[name=test_type]').click(function () {
	$clicked_value = $('input:radio[name=test_type]:checked').val();
	if($clicked_value == 2){
		$(".testType").hide();
	}else{
		$(".testType").show();
	}
});


$('#answer_type').on('change', function (e) {
    var valueSelected = this.value;
	console.log(valueSelected);
	$("#single_choice").hide();
	$("#multiple_choice").hide();
	$("#input_answer").hide();
	if(valueSelected == "SLQ"){
		$("div#single_choice").show();
	}else if(valueSelected == "MCQ"){
		$("#multiple_choice").show();
	}else if(valueSelected == "INPUT"){
		$("#input_answer").show();
	}
});


$("#checkBoxBtn").click(function () {
    if($(this).prop('checked')){        
		$('input[type=checkbox]').prop('checked', true);
		strCheck = "Check"; 
		strString = "UnCheck All";
    }else{
		$('input[type=checkbox]').prop('checked', false);
		strCheck = "unCheck"; 
		strString = "Check All";
    }

	$('input[name="wholeonly"]').prop('checked', false);	
	
	$("input[name=txtCheck]").val(strCheck);
	$("#divCheck").html(strString);
});

$("input[name='chk[]']").click(function () {
    if($(this).prop('checked')){        
		strCheck = "Check"; 
		strString = "UnCheck All";
    }else{
		strCheck = "unCheck"; 
		strString = "Check All";
    }
	
	$("input[name=txtCheck]").val(strCheck);
	$("#divCheck").html(strString);
});

function topAction(action){
	var txtCheck = $("input[name=txtCheck]").val();
	if(txtCheck == "Check"){
		if(action == "labels"){
			$("input[name=iconSubmit]").val(action);
			$("#actionfrm").submit();			
		}else if(action == "address"){
			$("input[name=iconSubmit]").val(action);
			$("#actionfrm").submit();
		}else if(action == "details"){
			$("input[name=iconSubmit]").val(action);
			$("#actionfrm").submit();
		}
	}else{
		alert("Please select the records to process.");
		if (window.event) {
			window.event.returnValue = false;
		}
	}
}

function book_download(){
	$("#actionfrm").submit();
}

$(function() {
	$( ".row_position" ).sortable({
		delay: 150,
		change: function() {
	var selectedLanguage = new Array();
	$('.row_position>tr').each(function() {
	selectedLanguage.push($(this).attr("id"));
	});
	document.getElementById("row_order").value = selectedLanguage;
	}
	});
  });
  
  
 function save(pagename) { 
	var data = new Array();
	$('.row_position tr').each(function() {
	   data.push($(this).attr("id"));
	});
	
	if(pagename == "quicklink"){
		var sort_url = "quicklink_sort_order.php";
	}else if(pagename == "slider"){
		var sort_url = "slider_sort_order.php";
	}
	
	$.ajax({
		url:sort_url,
		type:'post',
		data:{position:data},
		success:function(){
			alert('Your sort order has been saved successfully!');
		}
	})
  }
  
  $(".datepicker").datepicker({
	  orientation: "right bottom"
  });
  
 /*function submitDespatchDetail(){               
	
    var csvfile = $('#uploadCsv').val();
    if(csvfile.trim() == '' ){
		$('.statusMsg').html('<span style="color:red;">Please upload your CSV file</span>');
        return false;
    }else{
		var file_data = $('#uploadCsv').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('csv', file_data);
	
        $.ajax({
		
            type:'POST',
            url:'upload_despatch.php',
			dataType: 'text',
            cache: false,
			contentType: false,
			processData: false,
			data: form_data,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'ok'){
                    $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}*/


$("#saveTag").click(function () {
	//$('#tag_name').val("");
	 var tag_name = $('#tag_name').val();
	
	 $('#tag_error').html('');
	 if(tag_name !=""){
		$.ajax({
			url:'save_tag.php',
			type:'post',
			data:{tagname:tag_name},
			success:function(data){
				//alert('Your tag has been saved successfully!');
				if(data == " exe"){
					$('#tag_error').html('<span style="color:red; text-align:center;">This tag already exists!.</span>');
					return false;
				}else{
					$( "#tag_id" ).prepend(data);
					$('#tag_id').multiselect('rebuild');
					$('#tag_name').val("");
					$('#myModal').modal('hide');
				}
			}
		})
	 }else{
		 $('#tag_error').html('<span style="color:red; text-align:center;">Please enter tag name</span>');
         return false;
	 }
});