<!-- 아이디/비밀번호찾기 -->
  <section>
    <div class="container">
      <div class="row">
        <div id="findDiv" class="col-sm-6 col-sm-offset-3">
          <h3>아이디/비밀번호 찾기</h3>
           <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 15px;">
              <li role="presentation" class="active"><a href="#findId" aria-controls="findId" role="tab" data-toggle="tab">아이디 찾기</a></li>
              <li role="presentation" class=""><a href="#findPw" aria-controls="findPw" role="tab" data-toggle="tab">비밀번호 찾기</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="findId">
                <form id="findIdFrm" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="sr-only">이름</label>
                        <input type="text" class="form-control" name="senderName" id="senderName" placeholder="이름" aria-required="true">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="sr-only">이메일</label>
                        <input type="text" class="form-control" name="senderInfo" id="senderInfo" placeholder="이메일(id@domain.com) 또는 휴대전화(010-0000-0000)" aria-required="true">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group text-center">
                        <button class="btn btn-default" type="button" onclick="findId();">확인</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div role="tabpanel" class="tab-pane" id="findPw">
                <div class="alert alert-success alert-sm">
                  비밀번호 찾기 결과는 임시비밀번호가 발급되어 제공되며, <br>
                  등록된 이메일로 안내 됩니다.<br>
                </div>
                <form id="findPasswordFrm" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="sr-only">아이디</label>
                        <input type="text" class="form-control" name="senderId" id="senderId" placeholder="아이디 (영문, 숫자로 4자이상 20자이하)" aria-required="true">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="sr-only">이메일</label>
                        <input type="text" class="form-control" name="senderEmail" id="senderEmail" placeholder="이메일 (id@domain.com)" aria-required="true">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group text-center">
                        <button class="btn btn-default" type="button" onclick="findPassword();">확인</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>

        <div id="findIdRrt" class="col-sm-6 col-sm-offset-3" style="display:none;">
          <h3>아이디 찾기 결과</h3>
          <div class="alert alert-success alert-sm">
            <i class="fa fa-check-circle"></i> 가입하신 아이디는 <b><span id="mb_id"></span></b> 입니다.
          </div>
          <div class="form-group text-center">
            <a class="btn btn-default" href="<?=HOSTURL?>/loginout/login">로그인</a>
            <a class="btn btn-light" href="<?=HOSTURL?>/account/find">비밀번호 찾기</a>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- //아이디/비밀번호찾기 -->
  <script>
  function findId()
  {
    var senderName = $('#findIdFrm [name="senderName"]').val();
    var senderInfo = $('#findIdFrm [name="senderInfo"]').val();

    if(!senderName){
      alert('이름은 필수입력 사항입니다.');
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
                  $('#findDiv').hide();
                  $('#findIdRrt').show();
                  $('#mb_id').html(data.id);
                }
                else if(data.code == 99)
                {
                  alert(data.msg);
                  return false;
                }
             }
         });
  }
  function findPassword()
  {
    var senderId = $('#findPasswordFrm [name="senderId"]').val();
    var senderEmail = $('#findPasswordFrm [name="senderEmail"]').val();

    if(!senderId){
      alert('아이디는 필수입력 사항입니다.');
      return false;
    }
    if(!senderEmail){
      alert('이메일은 필수입력 사항입니다.');
      return false;
    }

    $.ajax({
         type: 'POST',
         url: '<?=HOSTURL?>/Account/rpcFindPassword',
         data: { "senderId": senderId, "senderInfo": senderEmail },
         success: function (data) {
                 console.log(data);
                 if(data.code == 1)
                 {
                  alert(data.msg.replace('<br>','\r\n'));
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