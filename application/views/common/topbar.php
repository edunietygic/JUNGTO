<!-- TOPBAR -->
  <div id="topbar" class="topbar-transparent visible-md visible-lg">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="topbar-dropdown"> <a class="title"><i class="fa fa-caret-down"> manager</i></a>
            <div class="dropdown-list"> <a class="list-entry" href="#">총괄관리자</a> <a class="list-entry" href="#">운영자</a> <a class="list-entry" href="#">학습자</a> <a class="list-entry" href="#">개인정보수정</a> </div>
          </div>
          
          <div class="topbar-dropdown">
          <?php if($name) :?> 
          <div class="title"><i class="fa fa-user">&nbsp;<?=$name?> 님</i></div>
            <div class="topbar-form">
                <div class="form-inline form-group">
                    <label><small><a href="#" id="bLogout">Logout</a></small></label>
                  </div>
            </div>
          <?php else :?> 
            <div class="title"><i class="fa fa-user"></i><a href="#">Login</a></div>
            <div class="topbar-form">
              <form>
                <div class="form-group">
                  <label class="sr-only">ID</label>
                  <input type="text" id="user_id" placeholder="Username or Email" class="form-control">
                </div>
                <div class="form-group">
                  <label class="sr-only">Password</label>
                  <input type="password" id="user_pwd" placeholder="Password" class="form-control">
                </div>
                <div class="form-inline form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      <small> Remember me</small> </label>
                  </div>
                  <button type="button" id="bSend" class="btn btn-primary btn-block">Login</button>
                </div>
              </form>
            </div>
          <?php endif;?> 
          </div>
        </div>
        <div class="col-sm-6 hidden-xs">
          <div class="social-icons social-icons-colored-hover">
            <ul>
              <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
              <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
              <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li class="social-dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li class="social-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
              <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end: TOPBAR -->
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
                  alert('login OK');
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
                  alert('logout OK');
                  location.reload();
              }
              else
              {
                  alert("올바른 정보로 입력 바랍니다.");
              } 
        }
      );
  });


});
      

    </script>
