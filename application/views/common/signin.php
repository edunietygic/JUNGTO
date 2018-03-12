<!-- 회원가입페이지 -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel">
					<div class="panel-body">
						<h3>회원가입</h3>
						<form id="signinFrm" method="post">
						<div class="row">

							<div class="form-group">
								<div class="col-md-9">
									<label class="sr-only">아이디</label>
									<input type="text" name="nwId" id="nwId" placeholder="아이디 (영문, 숫자, 하이픈, 언더바로 4자이상 20자이하)" class="form-control">
								</div>
								<div class="col-md-3" style="padding-left:0;">
									<button class="btn btn-light" type="button" id="chkid_btn"onclick="chkid();" style="padding:11px 37px;">중복확인</button>
									<button class="btn btn-warning" type="button" name="chkid_com" id="chkid_com" style="padding:11px 37px; display:none;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> 확인</button>
									<input type="hidden" name="chkId" id="chkId" value="">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only">비밀번호</label>
									<input type="password" class="form-control" name="nwPw" placeholder="비밀번호 (영문, 숫자, 특수문자로 8자 이상)" id="nwPw" aria-required="true">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only">비밀번호 확인</label>
				 					<input type="password" class="form-control required" name="nwPw2" placeholder="비밀번호 확인 (비밀번호 재입력)" id="nwPw2" aria-required="true">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only">이름</label>
				 					<input type="text" class="form-control required" name="nName" placeholder="이름" id="nName" aria-required="true">
								</div>
							</div>


							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only">이메일</label>
									<input type="email" class="form-control required email" name="nEmail" placeholder="이메일 (id@domain.com)" id="nEmail" aria-required="true">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="sr-only">휴대전화</label>
									<input type="text" class="form-control required" name="nPhone" placeholder="휴대전화 (010-0000-0000)" id="nPhone" aria-required="true">
								</div>
							</div>

							<div class="form-group text-center">
								<button class="btn btn-default" type="button" onclick="signin();" style="margin-top:21px">가입하기</button>
							</div>


				 			</div>
				 		</form>
				 	</div>
				 </div>
			</div>
		</div>
	</div>
</section>
<script>
function chkid()
{
	if(!$('#nwId').val()){
		alert('아이디는 필수입력 사항입니다.');
		return false;
	}
	if($('#nwId').val().length < 4 || $('#nwId').val().length > 20){
		alert('아이디는 영문, 숫자, 하이픈, 언더바로 4자이상 20자이하로 입력하세요.');
		return false;
	}

	var params = {'mb_id':$('#nwId').val()};

	$.ajax({
	     type: 'POST',
	     url: '<?=HOSTURL?>/Account/rpcChkId',
	     data: params,
	     success: function (data) {
	             console.log(data);
	             if(data.code == 1)
	             {
	             	if(confirm(data.msg))
	             	{
	             		$('#chkId').val('complete');
	             		$('#nwId').attr('readonly',true);
	             		$('#chkid_btn').hide();
	             		$('#chkid_com').show();
	             	}
	             }
	             else if(data.code == 99)
	             {
	                alert(data.msg);
	                return false;
	             }
	         }
	     });

}
function signin()
{
	if(!$('#nwId').val()){
		alert('아이디는 필수입력 사항입니다.');
		return false;
	}
	if(!$('#nwPw').val()){
		alert('비밀번호는 필수입력 사항입니다.');
		return false;
	}
	if(!$('#nwPw2').val()){
		alert('비밀번호 확인은 필수입력 사항입니다.');
		return false;
	}
	if(!$('#nName').val()){
		alert('이름은 필수입력 사항입니다.');
		return false;
	}
	if(!$('#nEmail').val()){
		alert('이메일은 필수입력 사항입니다.');
		return false;
	}
	if(!$('#nPhone').val()){
		alert('휴대전화는 필수입력 사항입니다.');
		return false;
	}

	//아이디유효성
	if($('#nwId').val().length < 4 || $('#nwId').val().length > 20){
		alert('아이디는 영문, 숫자, 하이픈, 언더바로 4자이상 20자이하로 입력하세요.');
		return false;
	}

	//비번확인
	if($('#nwPw').val() != $('#nwPw2').val()){
		alert('비밀번호가 일치하지 않습니다.');
		return false;
	}

	//이메일유효성
	var regEmail = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

	if(!regEmail.test($('#nEmail').val())) {
	    alert('이메일 주소가 유효하지 않습니다');
	    $('#nEmail').focus();
	    return false;
	}

	//휴대전화유효성
	var trans_num = $('#nPhone').val().replace(/-/gi,'');
	if(trans_num.length==11 || trans_num.length==10){

		var regPhone = /^((01[1|6|7|8|9])[1-9]+[0-9]{6,7})|(010[1-9][0-9]{7})$/;
		if(!regPhone.test(trans_num)) {
			alert('휴대전화가 유효하지 않습니다1');
			$('#nPhone').focus();
			return false;
		}
		else{
			trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
			$('#nPhone').val(trans_num);
		}
	}else{
	    alert('휴대전화가 유효하지 않습니다');
	    $('#nPhone').focus();
	    return false;
	}

	if(!$('#chkId').val()){
		alert('아이디 중복확인을 하세요.');
		return false;
	}

	var params = jQuery("#signinFrm").serialize();
	$.ajax({
	     type: 'POST',
	     url: '<?=HOSTURL?>/Account/rpcSignin',
	     data: params,
	     success: function (data) {
	             console.log(data);
	             if(data.code == 1)
	             {
	                alert(data.msg);
	                location.href = "<?=HOSTURL?>/main";
	             }
	             else if(data.code == 99)
	             {
	                alert(data.msg);
	                return false;
	             }
	         }
	     });
}
</script>