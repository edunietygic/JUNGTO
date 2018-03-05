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
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nwId">아이디</label>
				 							</div>
				 							<input type="text" class="form-control required" name="nwId" placeholder="아이디 (영문, 숫자, 하이픈, 언더바로 4자이상 20자이하)" id="nwId" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nwPw">비밀번호</label>
				 							</div>
				 							<input type="password" class="form-control required" name="nwPw" placeholder="비밀번호 (영문, 숫자, 특수문자로 8자 이상)" id="nwPw" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nwPw2">비밀번호 확인</label>
				 							</div>
				 							<input type="password" class="form-control required" name="nwPw2" placeholder="비밀번호 재입력" id="nwPw2" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nName">이름</label>
				 							</div>
				 							<input type="text" class="form-control required" name="nName" placeholder="이름 (실명)" id="nName" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nEmail">이메일</label>
				 							</div>
				 							<input type="email" class="form-control required email" name="nEmail" placeholder="이메일 (id@domain.com)" id="nEmail" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<div class="input-group col-fix">
				 							<div class="input-group-addon col-fix-2 text-left">
				 								<label class="upper" for="nPhone">휴대전화</label>
				 							</div>
				 							<input type="text" class="form-control required" name="nPhone" placeholder="휴대전화 (010-0000-0000)" id="nPhone" aria-required="true">
				 						</div>
				 					</div>
				 				</div>
				 				<div class="col-md-12">
				 					<div class="form-group">
				 						<button class="btn btn-default" type="button" onclick="signin();">가입하기</button>
				 					</div>
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
	
	//비번확인
	if($('#nwPw').val() != $('#nwPw2').val()){
		alert('비밀번호가 일치하지 않습니다.');
		return false;
	}

	//이메일유효성
	//휴대전화유효성

	var params = jQuery("#signinFrm").serialize();
	$.ajax({
	     type: 'POST',
	     url: '/Account/rpcSignin',
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