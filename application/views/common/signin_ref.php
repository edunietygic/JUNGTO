<form action="account/rpcSignin" data-scheme="ajax">
	<input type="hidden" name="tk" id="tk" value="9Rg/Z7oqgkmE9zzq">
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
	</div>
	<div class="row">
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group text-center">
				<button class="btn btn-default btn-submit" type="button">가입하기</button>
			</div>
		</div>
	</div>
</form>
