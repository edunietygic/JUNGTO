<?php
// test code
// echo '<pre>: '. print_r( $aLdata, true ) .'</pre>';
// echo '<pre>aRecentReply: '. print_r( $aRecentReply, true ) .'</pre>';
// echo '<pre>aRecentContents: '. print_r( $aRecentContents, true ) .'</pre>';
// echo '<pre>aHotContents: '. print_r( $aHotContents, true ) .'</pre>';
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
                      <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->adname?></span>
                      <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span>
                      <span class="post-meta-comments"><i class="fa fa-eye"></i><?=$obj->cnt?> Views</span>
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
                        <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->adname?></span>
                        <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span>
                        <span class="post-meta-comments"><i class="fa fa-eye"></i><?=$obj->cnt?> Views</span>
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
                        <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->adname?></span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <span class="post-meta-comments"><i class="fa fa-eye"></i><?=$obj->cnt?> Views</span>
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
              <li class="active"><a href="#">1</a> </li>
              <li><a href="#">2</a> </li>
              <li><a href="#">3</a> </li>
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
                      <?php foreach ($aRecentReply as $key => $obj) : ?>
                      <div class="post-thumbnail-entry">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                          <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->comment?></span></a>
                          <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                          <span class="post-category"><i class="fa fa-user"></i> <?=$obj->mb_name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                    <div class="post-thumbnail-list">
                      <?php foreach ($aRecentContents as $key => $obj) : ?>
                      <div class="post-thumbnail-entry">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                            <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->title?></span></a>
                            <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                            <span class="post-category"><i class="fa fa-user"></i> <?=$obj->name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab3">
                    <div class="post-thumbnail-list">
                      <?php foreach ($aHotContents as $key => $obj) : ?>
                      <div class="post-thumbnail-entry">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                          <a href="#"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->title?></span></a>
                          <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                          <span class="post-category"><i class="fa fa-user"></i> <?=$obj->name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
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