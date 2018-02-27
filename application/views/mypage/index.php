 
  <!-- My page Content -->
  <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row"> 
        <!-- content -->
        <div class="content col-md-9"> 
          <!-- Blog --> 
          <!-- navi path -->
          <div class="breadcrumb float-right hidden-xs">
            <ul>
              <li><a href="#">Home</a> </li>
              <li class="active"><a href="#">My page</a> </li>
            </ul>
          </div>
          <!-- end: navi path -->
          <div id="blog" class="single-post"> 
            <!-- Post single item-->
            <div class="post-item">
              <div class="post-item-wrap">
                <div class="post-item-description">
                  <div class="row"> 
                    <!--Horizontal tabs default-->
                    <div id="tabs-003" class="tabs simple">
                      <h3>My page</h3>
                      <p></p>
                      <ul class="tabs-navigation">
                        <li class="active"><a href="#Class"><i class="fa fa-home"></i>Class</a> </li>
                        <li><a href="#Personal"><i class="fa fa-user"></i>Personal</a> </li>
                        <li><a href="#Member"><i class="fa fa-home"></i>Member leave</a> </li>
                      </ul>
                      <div class="tabs-content">
                        <div class="tab-pane active" id="Class"> 
                          <!--Toggle fancy clean-->
                          <?php if(isset($oMem->myCourseInfo) && count($oMem->myCourseInfo)>=1) :?>
                            <?php foreach($oMem->myCourseInfo as $key=>$val) :?>
                            <div class="accordion toggle fancy clean">
                              <div class="ac-item">
                              <h4 class="ac-title"><i class="fa fa-home"></i><?=$val->subjnm?><?=$val->state_string?></h4>
                                <div class="ac-content"> <i class="fa fa-angle-down"></i> 신청기간 : <?=substr($val->open_date,0,10)?> ~ <?=substr($val->start_date,0,10)?><br/>
                                  <i class="fa fa-angle-down"></i> 학습기간 : <?=substr($val->start_date,0,10)?> ~ <?=substr($val->end_date,0,10)?> <br/>
                                  <i class="fa fa-angle-down"></i> 장소 : <?=$val->addr_string?><br/>
                                  <i class="fa fa-angle-down"></i> 진행자 : <?=$val->tutor_name?> <br/>
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
                          <p>항목을 변경하고 수정 버튼을 눌러주세요.</p>
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
                                <label class="sr-only">새 패스워드</label>
                                <input type="password" id="pwd1" value="" placeholder="새 패스워드" class="form-control input-lg">
                              </div>
                              <div class="col-md-6 form-group">
                                <label class="sr-only">새 패스워드 확인</label>
                                <input type="password" id="pwd2" value="" placeholder="새 패스워드 확인" class="form-control input-lg">
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

        <!-- Sidebar-->
        <div class="sidebar col-md-3">
          <div class="pinOnScroll"> 
            <!--Sub Navigation->
                        	<div id="mainMenu" class="widget menu-onclick menu-vertical hidden-xs">
							<div class="container">
								<nav>
									<ul>
										<li class="dropdown"><a href="#"><span style="font-family:'Noto Sans KR';font-weight: 600">수업자료실</span></a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 한국사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">오리엔테이션, 역사란 무엇인가?</a> </li>
														<li><a href="#">선사시대~후삼국 시대</a> </li>
														<li><a href="#">고려 시대</a> </li>
														<li><a href="#">조선 시대</a> </li>
														<li><a href="#">흥선대원군~일제 강점기</a> </li>
														<li><a href="#">해방 이후</a> </li>
													</ul>
												</li>
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 동아시아사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">동아시아 역사의 시작</a> </li>
														<li><a href="#">동아시아 세계의 성립</a> </li>
														<li><a href="#">국제관계의 변화와 지배층의 재편</a> </li>
														<li><a href="#">동아시아 사회의 지속과 변화</a> </li>
														<li><a href="#">근대국가의 수립 모색</a> </li>
														<li><a href="#">오늘날의 동아시아</a> </li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown"><a href="#"><span style="font-family:'Noto Sans KR';font-weight: 600">수업 활동 결과물</span></a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 한국사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">오리엔테이션, 역사란 무엇인가?</a> </li>
														<li><a href="#">선사시대~후삼국 시대</a> </li>
														<li><a href="#">고려 시대</a> </li>
														<li><a href="#">조선 시대</a> </li>
														<li><a href="#">흥선대원군~일제 강점기</a> </li>
														<li><a href="#">해방 이후</a> </li>
													</ul>
												</li>
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 동아시아사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">동아시아 역사의 시작</a> </li>
														<li><a href="#">동아시아 세계의 성립</a> </li>
														<li><a href="#">국제관계의 변화와 지배층의 재편</a> </li>
														<li><a href="#">동아시아 사회의 지속과 변화</a> </li>
														<li><a href="#">근대국가의 수립 모색</a> </li>
														<li><a href="#">오늘날의 동아시아</a> </li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown"> <a href="#"><span style="font-family:'Noto Sans KR';font-weight: 600">수업 관련 자료</span></a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 한국사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">오리엔테이션, 역사란 무엇인가?</a> </li>
														<li><a href="#">선사시대~후삼국 시대</a> </li>
														<li><a href="#">고려 시대</a> </li>
														<li><a href="#">조선 시대</a> </li>
														<li><a href="#">흥선대원군~일제 강점기</a> </li>
														<li><a href="#">해방 이후</a> </li>
													</ul>
												</li>
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 동아시아사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">동아시아 역사의 시작</a> </li>
														<li><a href="#">동아시아 세계의 성립</a> </li>
														<li><a href="#">국제관계의 변화와 지배층의 재편</a> </li>
														<li><a href="#">동아시아 사회의 지속과 변화</a> </li>
														<li><a href="#">근대국가의 수립 모색</a> </li>
														<li><a href="#">오늘날의 동아시아</a> </li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown"> <a href="#"><span style="font-family:'Noto Sans KR';font-weight: 600">역사 동아리 관련</span></a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 한국사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">오리엔테이션, 역사란 무엇인가?</a> </li>
														<li><a href="#">선사시대~후삼국 시대</a> </li>
														<li><a href="#">고려 시대</a> </li>
														<li><a href="#">조선 시대</a> </li>
														<li><a href="#">흥선대원군~일제 강점기</a> </li>
														<li><a href="#">해방 이후</a> </li>
													</ul>
												</li>
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 동아시아사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">동아시아 역사의 시작</a> </li>
														<li><a href="#">동아시아 세계의 성립</a> </li>
														<li><a href="#">국제관계의 변화와 지배층의 재편</a> </li>
														<li><a href="#">동아시아 사회의 지속과 변화</a> </li>
														<li><a href="#">근대국가의 수립 모색</a> </li>
														<li><a href="#">오늘날의 동아시아</a> </li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown"> <a href="#"><span style="font-family:'Noto Sans KR';font-weight: 600">역사 발문 모음</span></a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 한국사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">오리엔테이션, 역사란 무엇인가?</a> </li>
														<li><a href="#">선사시대~후삼국 시대</a> </li>
														<li><a href="#">고려 시대</a> </li>
														<li><a href="#">조선 시대</a> </li>
														<li><a href="#">흥선대원군~일제 강점기</a> </li>
														<li><a href="#">해방 이후</a> </li>
													</ul>
												</li>
												<li class="dropdown-submenu"><span class="dropdown-menu-title-only">고등 동아시아사 </span>
													<ul class="dropdown-menu">
														<li><a href="#">동아시아 역사의 시작</a> </li>
														<li><a href="#">동아시아 세계의 성립</a> </li>
														<li><a href="#">국제관계의 변화와 지배층의 재편</a> </li>
														<li><a href="#">동아시아 사회의 지속과 변화</a> </li>
														<li><a href="#">근대국가의 수립 모색</a> </li>
														<li><a href="#">오늘날의 동아시아</a> </li>
													</ul>
												</li>
											</ul>
										</li>								
									</ul>
								</nav>
							</div>
                    		</div>
                            <!--end: Sub Navigation--> 
            <!--Tabs with Posts-->
            <div class="widget"> 
              <!--h4 class="widget-title">최근게시글</h4-->
              <div id="tabs-01" class="tabs simple">
                <ul class="tabs-navigation">
                  <li class="active"><a href="#tab1">최근댓글</a> </li>
                  <li><a href="#tab2">최근글</a> </li>
                  <li><a href="#tab3">인기글</a> </li>
                </ul>
                <div class="tabs-content">
                  <div class="tab-pane active" id="tab1">
                    <div class="post-thumbnail-list">
                      <div class="post-thumbnail-entry"> <img alt="" src="http://dimg.donga.com/egc/CDB/WOMAN/Article/14/69/06/82/1469068212737.jpg">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">행복하기 위해 버려야 할 10가지 습관들</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 6분전</span> <span class="post-category"><i class="fa fa-tag"></i> 박병섭</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> 
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">행복에 대한 12가지 정의와 행복 명언 36선</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 9분전</span> <span class="post-category"><i class="fa fa-tag"></i> 이민동</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> <img alt="" src="http://sccdn.chosun.com/news/html/2016/10/27/2016102801002411000174441.jpg">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">'행복해지는 과학'은 있다, 일상 속에 얼마든지</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 11분전</span> <span class="post-category"><i class="fa fa-tag"></i> 김태우</span> </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                    <div class="post-thumbnail-list">
                      <div class="post-thumbnail-entry"> <img alt="" src="https://pbs.twimg.com/profile_images/2852980511/af103c3f49677e741f21cbaeb44fc0a9_400x400.jpeg">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">6월민주항쟁 30주년 수업자료</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 6분전</span> <span class="post-category"><i class="fa fa-tag"></i> 박병섭</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> 
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">[논평]"문재인 대통령, 역사교육 적폐청산에 박차를 ...</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 9분전</span> <span class="post-category"><i class="fa fa-tag"></i> 이민동</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> <img alt="" src="http://munjang.or.kr/wp-content/uploads/2016/05/%EB%B0%B0%EB%AA%85%ED%9B%88-%EC%9E%91%EA%B0%802.jpg">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">마음이 힘들 때 우울증 극복하는 방법 ...</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 11분전</span> <span class="post-category"><i class="fa fa-tag"></i> 김태우</span> </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab3">
                    <div class="post-thumbnail-list">
                      <div class="post-thumbnail-entry"> <img alt="" src="http://pds.joins.com/news/component/htmlphoto_mmdata/201708/03/1a94b18b-5194-426b-8ccc-510f2a524993.jpg">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">인연과를 알면 인생이 자유롭다</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 6분전</span> <span class="post-category"><i class="fa fa-tag"></i> 박병섭</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> 
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">정회원으로 가입하고자 합니다.절차와 방법을 알려 주시면 ...</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 9분전</span> <span class="post-category"><i class="fa fa-tag"></i> 이민동</span> </div>
                      </div>
                      <div class="post-thumbnail-entry"> <img alt="" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmYXhR0OnqK_22HGbscLsGnwHiRq7FqLVVLzHsKPY1b2NSZQiI">
                        <div class="post-thumbnail-content"> <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter">'행복해지는 과학'은 있다, 일상 속에 얼마든지</span></a> <span class="post-date"><i class="fa fa-clock-o"></i> 11분전</span> <span class="post-category"><i class="fa fa-tag"></i> 김태우</span> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--End: Tabs with Posts--> 
            
            <!-- Twitter widget -->
            <div class="widget widget-facebook" data-username="akht21" data-limit="2">
              <h4 class="widget-title">Recent facebook</h4>
            </div>
            <!-- end: Twitter widget--> 
            
            <!--widget tags -->
            <div class="widget  widget-tags">
              <h4 class="widget-title">Tags</h4>
              <div class="tags"> <a href="#">video</a> <a href="#">Seminar</a> <a href="#">평화</a> <a href="#">역사</a> <a href="#">학교</a> <a href="#">법륜</a> <a href="#">고려</a> <a href="#">불교</a> <a href="#">행복</a> <a href="#">중세</a> </div>
            </div>
            <!--end: widget tags --> 
            
            <!--widget newsletter-->
            <div class="widget  widget-newsletter">
              <form class="widget-subscribe-form form-inline" action="include/subscribe-form.php" role="form" method="post">
                <h4 class="widget-title">News letter</h4>
                <small>뉴스레터를 보내드립니다!</small>
                <div class="input-group">
                  <input type="email" aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                  <span class="input-group-btn">
                  <button type="submit" id="widget-subscribe-submit-button" class="btn btn-default"><i class="fa fa-paper-plane"></i></button>
                  </span> </div>
              </form>
            </div>
            <!--end: widget newsletter--> 
          </div>
        </div>
        <!-- end: Sidebar--> 
      </div>
    </div>
  </section>
  <!-- end: My page Content --> 
 
</div>
<!-- end: Wrapper --> 

<!-- Go to top button --> 
<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a> 
