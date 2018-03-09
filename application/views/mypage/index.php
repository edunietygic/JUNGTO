
  <!-- My page Content -->
  <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row">
        <!-- content -->
        <div class="content col-md-12">
          <!-- Blog -->
          <!-- navi path -->
          <!--div class="breadcrumb float-right hidden-xs">
            <ul>
              <li><a href="#">Home</a> </li>
              <li class="active"><a href="#">My page</a> </li>
            </ul>
          </div-->
          <!-- end: navi path -->
          <div id="blog" class="single-post">
            <!-- Post single item-->
            <div class="post-item">
              <div class="post-item-wrap">
                <div class="post-item-description">
                  <div class="row">
                    <!--Horizontal tabs default-->
                    <div id="tabs-003" class="tabs simple">
                      <h1>내 정보</h1>
                      <p></p>
                      <ul class="tabs-navigation">
                        <li class="active"><a href="#Class"><i class="fa fa-home"></i>수강신청내역</a> </li>
                        <li><a href="#Personal"><i class="fa fa-user"></i>개인정보수정</a> </li>
                        <li><a href="#Member"><i class="fa fa-home"></i>회원탈퇴</a> </li>
                      </ul>
                      <div class="tabs-content">
                        <div class="tab-pane active" id="Class">
                          <!--Toggle fancy clean-->
                          <?php if(isset($oMem->myCourseInfo) && $oMem->myCourseInfo!="no req list") :?>
                            <?php foreach($oMem->myCourseInfo as $key=>$val) :?>
                            <div class="accordion toggle fancy clean">
                              <div class="ac-item">
                              <h4 class="ac-title"><i class="fa fa-home"></i><?=$val->subjnm?>&nbsp;&nbsp;<?=$val->state_string?></h4>
                                <div class="ac-content"> <i class="fa fa-angle-down"></i> 신청기간 : <?=substr($val->open_date,0,10)?> <?php echo "(".getDayOfTheWeek(substr($val->open_date,0,4), substr($val->open_date,5,2),substr($val->open_date,8,2)).")" ?> ~ <?=substr($val->start_date,0,10)?> <?php echo "(".getDayOfTheWeek(substr($val->start_date,0,4), substr($val->start_date,5,2),substr($val->start_date,8,2)).")" ?><br/>
                                  <i class="fa fa-angle-down"></i> 학습기간 : <?=substr($val->start_date,0,10)?> <?php echo "(".getDayOfTheWeek(substr($val->start_date,0,4), substr($val->start_date,5,2),substr($val->start_date,8,2)).")" ?> ~ <?=substr($val->end_date,0,10)?> <?php echo "(".getDayOfTheWeek(substr($val->end_date,0,4), substr($val->end_date,5,2),substr($val->end_date,8,2)).")" ?><br/>
                                  <i class="fa fa-angle-down"></i> 장소 : <?=$val->addr_string?><br/>
                                  <i class="fa fa-angle-down"></i> 진행자 : <?=$val->tutor_name?> ( <?=$val->tutor_hp?> )<br/>
                                </div>
                              </div>
                            </div>
                            <?php endforeach;?>

                          <?php else : ?>
                          <h4>아직 참가하신 이력이 없습니다.</h4>
                          <p>캠프나 학교등 아직 참가하신 이력이 없습니다.</p>
                          <?php endif;?>
                        <!--END: Toggle fancy clean-->
                        </div>
                        <div class="tab-pane" id="Personal">
                          <h4>개인정보수정</h4>
                          <div class="alert alert-success alert-sm">
                            항목을 변경하고 수정 버튼을 눌러주세요<br>
                             &nbsp;* 정보 변경 : 패스워드 만 입력<br>
                             &nbsp;* 패스워드 변경 : 패스워드 , 패스워드 확인 입력<br>
                          </div> 
                          <form class="form-transparent-grey">
                            <div class="row">
                              <div class="col-md-6 form-group">
                                <label class="sr-only">Name</label>
                                <input type="text" id="name" value="<?=$oMem->oMemberInfo->mb_name?>" placeholder="이름" class="form-control input-lg">
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">ID</label>
                                <input type="text" id="mb_id" value="<?=$oMem->oMemberInfo->mb_id?>" placeholder="ID" class="form-control input-lg" readonly>
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">패스워드</label>
                                <input type="password" id="pwd1" value="" placeholder="패스워드" class="form-control input-lg">
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">패스워드 확인</label>
                                <input type="password" id="pwd2" value="" placeholder="패스워드 확인" class="form-control input-lg">
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">Email</label>
                                <input type="text" id="email" value="<?=$oMem->oMemberInfo->mb_email?>" placeholder="Email" class="form-control input-lg">
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">연락처</label>
                                <input type="text" id="hp" value="<?=$oMem->oMemberInfo->mb_hp?>" placeholder="연락처" class="form-control input-lg">
                              </div>
                              <div class="col-md-12 form-group">
                                <button class="btn btn-default" id="bUPDATE" type="button">수정</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="tab-pane" id="Member">
                          <h4>회원탈퇴</h4>
                          <p>회원 탈퇴시 개인정보와 참가하신 학교,캠프의 이력이 모두 삭제 됩니다.동의 하시면 삭제 버튼을 눌러 주세요.(작성하신 게시글은 탈퇴해도 남아있게 됩니다. 원치 않으시면 먼저 삭제 후 탈퇴해주세요. ) </p>
                          <button type="button" id="bDEL" class="btn btn-light btn-sm">위 내용을 확인 하였고 탈퇴를 신청합니다.</button>
                        </div>
                      </div>
                    </div>
                    <!--END: Horizontal tabs default-->
                  </div>
                </div>
              </div>
            </div>
            <!-- end: Post single item-->
          </div>
        </div>
        <!-- end: content -->

<script>
$(function(){
   $('#bUPDATE').click(function(){
      $.post(
        "/Mypage/rpcUpdateMembInfo"
        ,{
             "mb_id"  : $('#mb_id').val()
             ,"name"  : $('#name').val()
             ,"pwd1"  : $('#pwd1').val()
             ,"pwd2"  : $('#pwd2').val()
             ,"email" : $('#email').val()
             ,"hp"    : $('#hp').val()
         }
        ,function(data, status) {
              if (status == "success" && data.code == 1)
              {
                  alert('변경 되었습니다.');
                  location.reload();
              }
              else
              {
                  alert(data.msg);
              }
        }
      );
   });
   $('#bDEL').click(function(){
      $.post(
        "/Mypage/rpcDeleteMember"
        ,{
             "mb_id"  : $('#mb_id').val()
         }
        ,function(data, status) {
              if (status == "success" && data.code == 1)
              {
                  alert('삭제 되었습니다.');
                  location.reload();
              }
              else
              {
                  alert(data.msg);
              }
        }
      );
    });

});

</script>

      </div>
    </div>
  </section>
  <!-- end: My page Content -->

</div>
<!-- end: Wrapper -->

<!-- Go to top button -->
<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>
