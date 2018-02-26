<?php
// test code
// echo '<pre>: '. print_r( $aLdata, true ) .'</pre>';
// die();
?>
  <!-- Content -->
  <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row">
        <!-- post content -->
        <div class="content col-md-9">
          <!-- Page title -->
          <div class="page-title">
            <h1>행복학교 소식</h1>
          </div>
          <!-- end: Page title -->
          <!-- Portfolio Filter -->
          <nav class="grid-filter gf-outline" data-layout="#blog">
            <div class="grid-active-title">Show All</div>
          </nav>
          <!-- end: Portfolio Filter -->
          <!-- Blog -->
          <div id="blog" class="grid-layout post-thumbnails" data-item="post-item">
            <!--div id="blog" class="grid-layout post-thumbnails m-b-30" data-item="post-item"-->
            <?php foreach ($aLdata as $obj) : ?>
              <?php if($obj->isall == 'Y') : ?>
              <!-- * 공지사항 고정 -->
              <!-- Post item quote-->
              <div class="post-item quote">
                <div class="post-item-wrap">
                  <div class="post-item-description">
                      <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->addate,0,4).'-'.substr($obj->addate,4,2).'-'.substr($obj->addate,6,2)?></span>
                      <span class="post-meta-category"><i class="fa fa-tag"></i><?=$obj->adname?></span>
                      <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span>
                      <span class="post-meta-comments"><i class="fa fa-comments-o"></i><?=$obj->cnt?> Views</span>
                      <p><span style="font-family: '맑은 고딕'; font-size: 14pt; font-weight: bold"><a href="<?=HOSTURL?>/news/viewnews/<?=$obj->seq?>"><?=$obj->adtitle?></a></span><br>
                      <span style="font-family: '맑은 고딕'; font-size: 11pt"><?=$obj->summary?></span></p>
                  </div>
                </div>
              </div>
              <!-- end: Post item-->
              <?php elseif($obj->isall == 'N' && $obj->filecnt<1) :?>
                <!-- 일반 text 공지사항 -->
                <!-- Post item-->
                <div class="post-item bc-법륜">
                  <div class="post-item-wrap">
                    <div class="row">
                      <div class="post-item-description col-md-12">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->addate,0,4).'-'.substr($obj->addate,4,2).'-'.substr($obj->addate,6,2)?></span>
                        <span class="post-meta-category"><i class="fa fa-tag"></i><?=$obj->adname?></span>
                        <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span>
                        <span class="post-meta-comments"><i class="fa fa-comments-o"></i><?=$obj->cnt?> Views</span>
                        <h2><a href="<?=HOSTURL?>/news/viewnews/<?=$obj->seq?>"><?=$obj->adtitle?></a></h2>
                        <p><?=$obj->summary?></p>
                        <a href="<?=HOSTURL?>/news/viewnews/<?=$obj->seq?>" class="item-link">Read More <i class="fa fa-arrow-right"></i></a> </div>
                        <div class="seperator m-b-10"></div>
                    </div>
                  </div>
                </div>
                <!-- end: Post item-->
              <?php else: ?>
                <!-- 이미지 있는 공지사항 -->
                <!-- Post item-->
                <div class="post-item bc-법륜">
                  <div class="post-item-wrap">
                    <div class="row">
                      <div class="post-item-description col-md-6"> <img alt="" src="<?=ATTACHURL?>/0_Cfei5IbP_E18492E185A2E186BCE18487E185A9E186A8E18492E185A1E186A8E18480E185AD.jpg"> </div>
                      <div class="post-item-description col-md-6">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->addate,0,4).'-'.substr($obj->addate,4,2).'-'.substr($obj->addate,6,2)?></span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <span class="post-meta-comments"><i class="fa fa-comments-o"></i><?=$obj->cnt?> Views</span>
                        <h2><a href="<?=HOSTURL?>/news/viewnews/<?=$obj->seq?>"><?=$obj->adtitle?></a></h2>
                        <p><?=$obj->summary?></p>
                        <a href="<?=HOSTURL?>/news/viewnews/<?=$obj->seq?>" class="item-link">Read More <i class="fa fa-arrow-right"></i></a> </div>
                        <div class="seperator m-b-10"></div>
                    </div>
                  </div>
                </div>
                <!-- end: Post item-->
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
          <!-- end: Blog -->

          <!-- Pagination -->
          <div class="pagination pagination-simple">
            <ul>
              <li> <a href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"></i></span> </a> </li>
              <li><a href="#">1</a> </li>
              <li><a href="#">2</a> </li>
              <li class="active"><a href="#">3</a> </li>
              <li><a href="#">4</a> </li>
              <li><a href="#">5</a> </li>
              <li> <a href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-angle-right"></i></span> </a> </li>
            </ul>
          </div>
          <!-- end: Pagination -->
        </div>
        <!-- end: post content -->

        <!-- Sidebar-->
        <div class="sidebar col-md-3">
          <div class="pinOnScroll">
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

          </div>
        </div>
        <!-- end: Sidebar-->
      </div>
    </div>
  </section>
  <!-- end: Content -->