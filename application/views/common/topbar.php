<!-- TOPBAR -->
  <div id="topbar" class="topbar-transparent visible-md visible-lg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php if($name) :?> 
          <div class="topbar-dropdown">
              <a class="title"><i class="fa fa-user">&nbsp;<?=$auth_name?></i></a>
              <?php if($auth) :?> 
              <div class="dropdown-list">
                  <a class="list-entry" href="http://jungtoadmin.eduniety.cc:8090/site_manage/login.php">운영툴 바로가기</a>
              </div>
              <?php endif;?> 
          </div>
          <div class="topbar-dropdown">
            <div class="title"><i class="fa fa-user">&nbsp;<?=$name?> 님</i></div>
            <div class="topbar-form">
                <div class="form-inline form-group">
                  <label><a href="javascript:void(0);" id="bLogout">로그아웃</a></label>
                </div>
            </div>
          </div>

          <?php else :?> 
          <div class="topbar-dropdown">
            <div class="title"><a href="<?=HOSTURL?>/loginout/login"><i class="fa fa-user"></i>로그인</a></div>
            <!-- <div class="topbar-form">
              <form>
                <div class="form-group">
                  <label class="sr-only">ID</label>
                  <input type="text" id="user_id" placeholder="아이디" class="form-control">
                </div>
                <div class="form-group">
                  <label class="sr-only">Password</label>
                  <input type="password" id="user_pwd" placeholder="비밀번호" class="form-control">
                </div>
                <div class="form-inline form-group">
                   <button type="button" id="bSend" class="btn btn-primary btn-block">로그인</button>
                </div>
                <div class="form-inline form-group">
                   <div class="checkbox">
                     <label>
                       <input type="checkbox">
                       <small> 아이디 저장</small>
                     </label>
                   </div>
                   <div class="text-left" id="findAccount" data-toggle="modal" data-target="#commonModal" data-backdrop="static" data-id="applicationForm"><a href="javascript:void(0);">아이디/비밀번호 찾기</a></div>
                </div>
              </form>
            </div> -->
          </div>

          <div class="topbar-dropdown">
            <div class="title"><a href="<?=HOSTURL?>/account/signin"><i class="fa fa-id-badge" aria-hidden="true"></i>회원가입</a></div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <!-- end: TOPBAR -->
  <div class="modal fade" tabindex="-1" role="dialog" id="commonModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer"></div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<script>
$(function(){
   $('#bSend').click(function(){
      $.post(
        "/Loginout/rpcLogin"
        ,{
             "user_id" :  $('#user_id').val() 
             ,"user_pwd" : $('#user_pwd').val() 
         }
        ,function(data, status) {
              if (status == "success" && data.code == 1)
              {
                  location.reload();
              }
              else
              {
                  alert("올바른 정보로 입력 바랍니다.");
              } 
        }
      );
  });

  $('#bLogout').click(function(){
      $.post(
        "/Loginout/rpcLogout"
        ,{
         }
        ,function(data, status) {
              if (status == "success" && data.code == 1)
              {
                  location.reload();
              }
              else
              {
                  alert("올바른 정보로 입력 바랍니다.");
              } 
        }
      );
  });

  // $("#startAccount").click(function(){
  //   $('.modal-content').load('account/signin',function(){
  //       $('#commonModal').modal({show:true});
  //   });
  // });

  // $("#findAccount").click(function(){
  //   $('.modal-content').load('account/find',function(){
  //       $('#commonModal').modal({show:true});
  //   });
  // });
   
});

</script>
