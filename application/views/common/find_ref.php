<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">아이디/비밀번호 찾기</h4>
</div>

<div class="modal-body">
	<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
		<li role="presentation" class="active"><a href="#findId" aria-controls="findId" role="tab" data-toggle="tab">아이디 찾기</a></li>
		<li role="presentation" class=""><a href="#findPw" aria-controls="findPw" role="tab" data-toggle="tab">비밀번호 찾기</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="findId">
			<!-- <div class="alert alert-success alert-sm">
			아이디 찾기 결과는 일부를 감추고 안내 됩니다.
			</div> -->
			<form id="findIdFrm" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="input-group col-fix">
								<div class="input-group-addon col-fix-3 text-left">
									<label class="upper" for="senderName">이름</label>
								</div>
								<input type="text" class="form-control required" name="senderName" id="senderName" placeholder="이름" id="gf-name-1519009442" aria-required="true">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div class="input-group col-fix">
								<div class="input-group-addon col-fix-3 text-left">
									<label class="upper" for="senderInfo">이메일 또는 휴대전화</label>
								</div>
								<input type="email" class="form-control required email" name="senderInfo" placeholder="이메일(id@domain.com) 또는 휴대전화(010-0000-0000)" id="senderInfo" aria-required="true">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group text-center">
							<button class="btn btn-default btn-submit" type="button" onclick="findId();">확인</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="findPw">
			<div class="alert alert-success alert-sm">
				비밀번호 찾기 결과는 임시비밀번호가 발급되어 제공되며, <br>
				등록된 이메일 또는 휴대전화로 안내 됩니다.<br>
			</div>
			<form id="findPasswordFrm" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="input-group col-fix">
								<div class="input-group-addon col-fix-3 text-left">
									<label class="upper" for="senderId">아이디</label>
								</div>
								<input type="text" class="form-control required" name="senderId" id="senderId" placeholder="아이디 (영문, 숫자로 4자이상 20자이하)" id="gf-name-1519009442" aria-required="true">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div class="input-group col-fix">
								<div class="input-group-addon col-fix-3 text-left">
									<label class="upper" for="senderInfo">이메일 또는 휴대전화</label>
								</div>
								<input type="email" class="form-control required email" name="senderInfo" placeholder="이메일 또는 휴대전화" id="senderInfo" aria-required="true">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-center">
							<button class="btn btn-default btn-submit" type="button" onclick="findPassword();">확인</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
function findId()
{
	var senderName = $('#findIdFrm [name="senderName"]').val();
	var senderInfo = $('#findIdFrm [name="senderInfo"]').val();

	if(!senderName){
		alert('아이디는 필수입력 사항입니다.');
		return false;
	}
	if(!senderInfo){
		alert('이메일 또는 휴대전화는 필수입력 사항입니다.');
		return false;
	}

	$.ajax({
	     type: 'POST',
	     url: '<?=HOSTURL?>/Account/rpcFindId',
	     data: { "senderName": senderName, "senderInfo": senderInfo },
	     success: function (data) {
	             console.log(data);
	             if(data.code == 1)
	             {
	             	$('.modal-body').load('account/find_ret/'+data.id,function(){
				        // $('#commonModal').modal({show:true});
				    });
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