<!-- 로그인페이지 -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel ">
            <div class="panel-body">
              <h3>로그인</h3>
              <form>
                <div class="form-group">
                  <label class="sr-only">ID</label>
                  <input type="text" placeholder="아이디" class="form-control">
                </div>
                <div class="form-group m-b-5">
                  <label class="sr-only">Password</label>
                  <input type="password" placeholder="비밀번호" class="form-control">
                </div>
                <div class="form-group form-inline m-b-10 ">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      <small> 아이디 기억</small> </label>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-default" type="button">로그인</button>
                </div>
              </form>
            </div>
          </div>
          <p class="small">
		        <a href="<?=HOSTURL?>/account/find">아이디/패스워드가 기억이 나지 않으신가요?</a>
            <br/>아이디가 없으신가요?
            <a href="<?=HOSTURL?>/account/signin">회원가입</a>
		      </p>
        </div>
      </div>
    </div>
  </section>