var q1_status = "";
var q2_status = "";
var user_id="";
var pictureAppend=1;
var edit_pictureAppend=1;

setTimeout(function() {
    $('#notif').fadeOut('slow');
}, 4000); // <-- time in milliseconds

function edit_profile(mode)
{
	if (mode=='edit')
	{
		document.getElementById('fname').removeAttribute('disabled');
		document.getElementById('lname').removeAttribute('disabled');
		document.getElementById('birth').removeAttribute('disabled');
		//document.getElementById('email').removeAttribute('disabled');
		document.getElementById('pw_group').style.display = "block";
		document.getElementById('btn-profile').innerHTML = '<button type="button" class="btn btn-success" data-dismiss="modal" onclick="edit_profile(\'save\')" id="edit_btn" disabled>Save</button>';
	}
	else
	{
		document.getElementById('edit_verify_pw').innerHTML = '<br/>'
		document.getElementById('fname').setAttribute('disabled','');
		document.getElementById('lname').setAttribute('disabled','');
		document.getElementById('birth').setAttribute('disabled','');
		//document.getElementById('email').setAttribute('disabled','');
		document.getElementById('pw_group').style.display = "none";
		document.getElementById('btn-profile').innerHTML = '<button type="button" class="btn btn-success" data-dismiss="modal" onclick="edit_profile(\'edit\')">Edit</button>'
	}
}
function edit_verify_pw()
{
	var pw=document.getElementById('pw').value;
	var cpw=document.getElementById('confirmpw').value;
	if (pw==cpw) {
		document.getElementById('edit_verify_pw').innerHTML = '<h5 style="padding: 10px; background-color: green; color: white;">Password Match</h5>'
		document.getElementById('edit_btn').removeAttribute('disabled');
	}
	else {
		if (cpw=='') {
			document.getElementById('edit_verify_pw').innerHTML = '<br/>'
			document.getElementById('edit_btn').setAttribute('disabled','');
		}
		else
		{
			document.getElementById('edit_verify_pw').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Password Mismatch</h5>'
			document.getElementById('edit_btn').setAttribute('disabled','');
		}	
	}
}
function login()
{
	var email = document.getElementById('login_email').value;
	var pw = document.getElementById('login_pw').value;
	$.ajax({
		type: 'post',
		url: 'login',
		data: {
			email:email,pw:pw,
		},
		success: function(result){
			if (result=="success")
			{
				window.location.href= document.URL;
			}
			else
			{
				$('#failed').html(result);
			}
		}
	});
}
function verify_email()
{
	var email = document.getElementById('signup_email').value;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (reg.test(email)==true)
	{
		$.ajax({
			type: 'post',
			url: 'verify_email',
			data: {
				email:email,
			},
			success: function(result){
				if (result=='exist') {
					document.getElementById('verify_result').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Existing Email Address</h5>'
					//document.getElementById('signup_btn').setAttribute('disabled','');
					document.getElementById('signup_pw').setAttribute('disabled','');
					document.getElementById('signup_cpw').setAttribute('disabled','');
				}
				else if (result=='not_exist'){
					document.getElementById('verify_result').innerHTML = '<h5 style="padding: 10px; background-color: green; color: white;">Valid Email Address</h5>'
					//document.getElementById('signup_btn').removeAttribute('disabled');
					document.getElementById('signup_pw').removeAttribute('disabled');
					document.getElementById('signup_cpw').removeAttribute('disabled');
				}
				else{
					document.getElementById('verify_result').innerHTML = '<br/>'
					//document.getElementById('signup_btn').setAttribute('disabled','');
					document.getElementById('signup_pw').setAttribute('disabled','');
					document.getElementById('signup_cpw').setAttribute('disabled','');
				}
			}
		});
	}
	else
	{
		document.getElementById('verify_result').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Invalid Email Address</h5>'
		//document.getElementById('verify_result').innerHTML = '<br/>'
		//document.getElementById('signup_btn').setAttribute('disabled','');
		document.getElementById('signup_pw').setAttribute('disabled','');
		document.getElementById('signup_cpw').setAttribute('disabled','');
	}
	if (email=='') {
		document.getElementById('verify_result').innerHTML = '<br/>'
		//document.getElementById('signup_btn').setAttribute('disabled','');
		document.getElementById('signup_pw').setAttribute('disabled','');
		document.getElementById('signup_cpw').setAttribute('disabled','');
	}
}
function verify_pw()
{
	var pw=document.getElementById('signup_pw').value;
	var cpw=document.getElementById('signup_cpw').value;
	if (pw==cpw) {
		document.getElementById('verify_pw').innerHTML = '<h5 style="padding: 10px; background-color: green; color: white;">Password Match</h5>'
		//document.getElementById('signup_btn').removeAttribute('disabled');
		document.getElementById('signup_q1').removeAttribute('disabled');
		document.getElementById('signup_q1_ans').removeAttribute('disabled');
		document.getElementById('signup_q2').removeAttribute('disabled');
		document.getElementById('signup_q2_ans').removeAttribute('disabled');
	}
	else {
		if (cpw=='') {
			document.getElementById('verify_pw').innerHTML = '<br/>'
			//document.getElementById('signup_btn').setAttribute('disabled','');
			document.getElementById('signup_q1').setAttribute('disabled','');
			document.getElementById('signup_q1_ans').setAttribute('disabled','');
			document.getElementById('signup_q2').setAttribute('disabled','');
			document.getElementById('signup_q2_ans').setAttribute('disabled','');
		}
		else
		{
			document.getElementById('verify_pw').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Password Mismatch</h5>'
			//document.getElementById('signup_btn').setAttribute('disabled','');
			document.getElementById('signup_q1').setAttribute('disabled','');
			document.getElementById('signup_q1_ans').setAttribute('disabled','');
			document.getElementById('signup_q2').setAttribute('disabled','');
			document.getElementById('signup_q2_ans').setAttribute('disabled','');
		}	
	}
}
function sec_question()
{
	var q1=document.getElementById('signup_q1').value;
	var q1_ans=document.getElementById('signup_q1_ans').value;
	var q2=document.getElementById('signup_q2').value;
	var q2_ans=document.getElementById('signup_q2_ans').value;

	if (q2!=""&&q2_ans!=""&&q1!=""&&q1_ans!="") {
		document.getElementById('signup_btn').removeAttribute('disabled');
	}
	else{
		document.getElementById('signup_btn').setAttribute('disabled','');
	}
}
function fetch_sec_question()
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var email = document.getElementById('forgot_email').value;
	if (reg.test(email)==true)
	{
		$.ajax({
			type: 'post',
			url: 'fetch_security',
			data: {
				email:email,
			},
			success: function(result){
				if (result=="0") {
					document.getElementById('forgot_email_result').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Email Address does not exist.</h5>'
					$('#sec_question_result').html("");
				}
				else
				{
					$('#forgot_email_result').html("");
					$('#sec_question_result').html(result);
				}
			}
		});
	}
	else
	{
		document.getElementById('forgot_email_result').innerHTML = '<h5 style="padding: 10px; background-color: red; color: white;">Invalid Email Address</h5>'
		$('#sec_question_result').html("");

	}
	if (email=="") {
		document.getElementById('forgot_email_result').innerHTML = '';
		$('#sec_question_result').html("");
	}
}
function sec_question_answer(target)
{
	var ans = document.getElementById("forgot_"+target+"_ans").value;
	user_id=document.getElementById("forgot_id").value;
	if (ans!="") {
		$.ajax({
			type:'post',
			url: 'check_security',
			data: {
				id:user_id,q_target:target,ans:ans,
			},
			success: function(response)
			{
				if (target=="q1")
				{
					if (response=="success")
					{
						$("#q1_result").html('<h5 style="padding: 10px; background-color: green; color: white;">Correct Answer.</h5>');
						q1_status = "success";
						if (q1_status=="success"&&q2_status=="success") {
							document.getElementById('forgot_next_btn').removeAttribute('disabled');
							document.getElementById('change_submit').setAttribute('action','change_pw/'+user_id);
						}
						else
						{
							document.getElementById('forgot_next_btn').setAttribute('disabled','');
							document.getElementById('change_submit').removeAttribute('action');
						}
					}
					else
					{
						$("#q1_result").html('<h5 style="padding: 10px; background-color: red; color: white;">Wrong Answer</h5>');
						q1_status = "failed";
						if (q1_status=="success"&&q2_status=="success") {
							document.getElementById('forgot_next_btn').removeAttribute('disabled');
							document.getElementById('change_submit').setAttribute('action','change_pw/'+user_id);
						}
						else
						{
							document.getElementById('forgot_next_btn').setAttribute('disabled','');
							document.getElementById('change_submit').removeAttribute('action');
						}
					}
				}
				else
				{
					if (response=="success")
					{
						$("#q2_result").html('<h5 style="padding: 10px; background-color: green; color: white;">Correct Answer.</h5>');
						q2_status = "success";
						if (q1_status=="success"&&q2_status=="success") {
							document.getElementById('forgot_next_btn').removeAttribute('disabled');
							document.getElementById('change_submit').setAttribute('action','change_pw/'+user_id);
						}
						else
						{
							document.getElementById('forgot_next_btn').setAttribute('disabled','');
							document.getElementById('change_submit').removeAttribute('action');
						}
					}
					else
					{
						$("#q2_result").html('<h5 style="padding: 10px; background-color: red; color: white;">Wrong Answer</h5>');
						q2_status = "failed";
						if (q1_status=="success"&&q2_status=="success") {
							document.getElementById('forgot_next_btn').removeAttribute('disabled');
							document.getElementById('change_submit').setAttribute('action','change_pw/'+user_id);
						}
						else
						{
							document.getElementById('forgot_next_btn').setAttribute('disabled','');
							document.getElementById('change_submit').removeAttribute('action');
						}
					}
				}
			}
		});
	}
	else
	{
		$("#"+target+"_result").html("<br/>");
		document.getElementById('change_submit').removeAttribute('action');
	}
	
}

function check_change()
{
	var new_pw=document.getElementById('change_new_pw').value;
	var change_pw=document.getElementById('change_confirm').value;

	if (new_pw==change_pw) {
		$('#change_result').html('<h5 style="padding: 10px; background-color: green; color: white;">Password Match</h5>');
		document.getElementById('change_btn').removeAttribute('disabled');
	}
	else if (new_pw==""&&change_pw==""){
		$('#change_result').html('<br/>');
		document.getElementById('change_btn').setAttribute('disabled','');
	}
	else{
		$('#change_result').html('<h5 style="padding: 10px; background-color: red; color: white;">Password Mismatch</h5>');
		document.getElementById('change_btn').setAttribute('disabled','');
	}
}
function append()
{
	var div = document.getElementById('pictureAppend');
	var img = document.getElementById('previewPictureAppend');
	pictureAppend++;
	div.innerHTML += '<div class="col-sm-12" id="picture'+pictureAppend+'"><div class="input-group"><span class="input-group-addon">#</span><input type="file" class="form-control" id="photo'+pictureAppend+'" onchange="PreviewImage('+pictureAppend+')" name="picture'+pictureAppend+'" required><span class="input-group-btn"><button class="btn btn-default" type="button" onclick="removePicture('+pictureAppend+');">&times;</button></span></div><br/></div>';
	img.innerHTML += '<div class="col-sm-12" id="preview'+pictureAppend+'"><img src="" class="img-responsive" id="imgPreview'+pictureAppend+'"><hr/></div>';
	document.getElementById('addProductForm').setAttribute("action","admin/add_product_process/"+pictureAppend);
}

function PreviewImage(no) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("photo"+no).files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("imgPreview"+no).src = oFREvent.target.result;
    };
};

function removePicture(no){
	var div = document.getElementById('picture'+no);
	var img = document.getElementById('preview'+no);
	div.remove();
	img.remove();
}

function product_search()
{
	var search = document.getElementById('product_search').value;
	$.ajax({
		type: 'post',
		url: 'admin/search',
		data: {
			search: search,
		},
		success: function(result){
			$('#product_search_result').html(result);
		}
	});
}

function delete_product(id,name)
{
	var ans = confirm('Confirm Delete : '+name);
	if (ans==true) {
		$.ajax({
			type: 'post',
			url: 'admin/delete_product_process',
			data: {
				id:id,
			},
			success: function(result){
				if (result=="SUCCESS") {
					alert('Delete Successfully.');
				}
				else {
					alert('Failed to Delete Product.');
				}
			}
		});
	}
	else
	{
		alert('Cancelled.');
	}
	product_search();
}

function discount_price_process()
{
	var price = parseFloat(document.getElementById('price').value);
	var discount = parseFloat(document.getElementById('discount').value)/100;
	var disc_price = 0;

	disc_price = price * discount;
	var total = price - disc_price;
	document.getElementById('discount_price').value = total;
}

function edit_discount_price_process()
{
	var price = parseFloat(document.getElementById('edit_price').value);
	var discount = parseFloat(document.getElementById('edit_discount').value)/100;
	var disc_price = 0;

	disc_price = price * discount;
	var total = price - disc_price;
	document.getElementById('edit_discount_price').value = total;
}

function edit_product(id)
{
	$.ajax({
		type: 'post',
		url: 'admin/edit_content',
		data: {
			id:id,
		},
		success: function(result){
			$('#edit_content').html(result);
		}
	});
	var editBtn = document.getElementById('edit_btn');
	edit_btn.setAttribute('onclick','form_append_id('+id+')');
}

var formLink = "";
var retry = 0;
var no_of_pic = 0;
var no_of_pic_erased = 0;
function delete_picture(target,no)
{
	no_of_pic = no;
	var ans = confirm('Confirm Delete?');
	if (ans==true) {
		var img = document.getElementById('edit_old_preview'+target);
		img.remove();
		var setForm = document.getElementById('editProductForm');
		oldLink = setForm.action;
		if (retry==0) {
			formLink = setForm.action;
			retry++;
		}
		//alert(oldLink);
		if (oldLink==formLink) {
			setForm.setAttribute('action',oldLink+'?target='+target);
		}
		else
		{
			setForm.setAttribute('action',oldLink+','+target);	
		}
		oldLink = setForm.action;
		//alert(oldLink);
		no_of_pic_erased++;
	}
	else {
		alert('Cancelled');
	}
	if (no_of_pic_erased+1==no_of_pic) {
		document.getElementById('edit_picture1').setAttribute('required','required');
		document.getElementById('banner_stored_in_db').style.display = 'none';
	}
}

function edit_append()
{
	var div = document.getElementById('edit_pictureAppend');
	var img = document.getElementById('edit_previewPictureAppend');
	edit_pictureAppend++;
	div.innerHTML += '<div class="col-sm-12" id="edit_photo'+edit_pictureAppend+'"><div class="input-group"><span class="input-group-addon">#</span><input type="file" class="form-control" id="edit_picture'+edit_pictureAppend+'" onchange="edit_PreviewImage('+edit_pictureAppend+')" name="picture'+edit_pictureAppend+'" required><span class="input-group-btn"><button class="btn btn-default" type="button" onclick="edit_removePicture('+edit_pictureAppend+');">&times;</button></span></div><br/></div>';
	img.innerHTML += '<div class="col-sm-12" id="edit_new_preview'+edit_pictureAppend+'"><img src="" class="img-responsive" id="edit_imgPreview'+edit_pictureAppend+'"><hr/></div>';
}

function edit_PreviewImage(no) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("edit_picture"+no).files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("edit_imgPreview"+no).src = oFREvent.target.result;
    };
};

function edit_removePicture(no){
	var div = document.getElementById('edit_photo'+no);
	var img = document.getElementById('edit_new_preview'+no);
	div.remove();
	img.remove();
}

function form_append_id(id){
	var formLink = document.getElementById('editProductForm');
	var oldLink = formLink.action;

	var newLink = oldLink+"&id="+id;
	formLink.setAttribute('action',newLink);
	
}

function view_content(id){
	$.ajax({
		type: 'post',
		url: 'admin/view_content',
		data: {
			id:id,
		},
		success: function(result){
			$('#view_content').html(result);
		}
	});
}

function addtoform(id){
	var addToCartForm = document.getElementById('addToCartForm');
	addToCartForm.setAttribute('action','/add_to_cart_process/?product='+id)
}

function request_shipping(id){
	$.ajax({
		type: 'post',
		url: 'request_shipping',
		data: {
			id:id,
		},
		success: function(result){
			if (result=="TRUE") {
				alert("Requested. We will notify you if the shipping fee is already available.");
				window.location.href = "/";
			}
			else
			{
				alert("Request Failed. Please try again.");
			}
		}
	});
}

function shipping_fee(id,name,rate){
	var data = document.getElementById('shipping_fee_title');
	var link = document.getElementById('shippingLink');
	var newLinkRate = link.action+id;
	link.setAttribute('action',newLinkRate);
	data.innerHTML = name;
	var ship = document.getElementById('shipping_fee');
	ship.value = rate;
}

function delete_cart(id,target){
	var ans = confirm("Delete Product in Cart?");
	var target_cart = document.getElementById('target'+target);
	var data = {
		id:id
	};
	if (ans==true) {
		$.getJSON("delete_cart.php", data, function(result) {
		  if (result.status == "true") {
		  	$('#cart_count').html(result.cart_count);
		  	alert('Removed Successfully.');
		  	target_cart.remove();
		  	calculate_price();
		  }
		  else {
		  	alert('Failed to Remove item due to an Error. Please try again.')
		  }
		});
	}
}