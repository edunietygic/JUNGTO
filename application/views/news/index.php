<?php
// test code
// echo '<pre>aLdata: '. print_r( $aLdata, true ) .'</pre>';
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
          <?php if($aLdata && isset($aLdata)) :?>
          <div id="blog" class="grid-layout post-thumbnails" data-item="post-item">
            <!--div id="blog" class="grid-layout post-thumbnails m-b-30" data-item="post-item"-->
            <?php foreach ($aLdata as $key => $obj) : ?>
              <?php if($obj->isall == 'Y') : ?>
              <!-- * 공지사항 고정 -->
              <!-- Post item quote-->
                <div class="post-item">
                  <div class="post-item-wrap">
                    <div class="row">
                      <div class="post-item-description col-md-12">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->addate,0,4).'-'.substr($obj->addate,4,2).'-'.substr($obj->addate,6,2)?></span>
                        <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->adname?></span>
                        <!-- <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span> -->
                        <span class="post-meta-comments"><i class="fa fa-eye"></i>조회수 <?=$obj->cnt?></span>
                        <span class="post-meta-comments"><i class="fa fa-link"></i>첨부파일 <?=$obj->filecnt?></span>
                        <h2><i class="fa fa-asterisk"></i> <a href="<?=HOSTURL?>/news/news_detail/<?=$obj->seq?>"><?=$obj->adtitle?></a></h2>
                        <p><?=$obj->summary?></p>
                        <a href="<?=HOSTURL?>/news/news_detail/<?=$obj->seq?>" class="item-link">더보기 <i class="fa fa-arrow-right"></i></a> </div>
                        <div class="seperator m-b-10"></div>
                    </div>
                  </div>
                </div>
              <!-- end: Post item-->
              <?php else :?>
                <!-- 일반 text 공지사항 -->
                <!-- Post item-->
                <div class="post-item">
                  <div class="post-item-wrap">
                    <div class="row">
                      <div class="post-item-description col-md-12">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->addate,0,4).'-'.substr($obj->addate,4,2).'-'.substr($obj->addate,6,2)?></span>
                        <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->adname?></span>
                        <!-- <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span> -->
                        <span class="post-meta-comments"><i class="fa fa-eye"></i>조회수 <?=$obj->cnt?></span>
                        <span class="post-meta-comments"><i class="fa fa-link"></i>첨부파일 <?=$obj->filecnt?></span>
                        <h2><a href="<?=HOSTURL?>/news/news_detail/<?=$obj->seq?>"><?=$obj->adtitle?></a></h2>
                        <p><?=$obj->summary?></p>
                        <a href="<?=HOSTURL?>/news/news_detail/<?=$obj->seq?>" class="item-link">더보기 <i class="fa fa-arrow-right"></i></a> </div>
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
          <?php else : ?>
          <div id="blog" class="grid-layout post-thumbnails" data-item="post-item">
              <div class="post-item">
                <div class="post-item-wrap">
                  <div class="row">
                  공지 사항이 없습니다.
                  </div>
                </div>
              </div>
          </div>

          <?php endif; ?>
        </div>
        <!-- end: post content -->

        <!-- Sidebar-->
        <?=$sidebar?>
        <!-- end: Sidebar-->

      </div>
    </div>
  </section>
  <!-- end: Content -->
