<?php
// test code
// echo "<!--";
// print_r($aLdata);
// echo "-->";
// test code
// echo '<pre>aDetailData: '. print_r( $aDetailData, true ) .'</pre>';
// die();
?>
<!-- Content -->
  <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row">
        <!-- post content -->
        <div class="content col-md-9">
          <div class="page-title">
            <h1>행복캠프</h1>
          </div>
          <!-- end: Page title -->
          <!-- Portfolio Filter -->
          <!--<nav class="grid-filter gf-outline" data-layout="#blog">
            <ul>
              <li class="active"><a href="#" data-category="*">글쓰기</a></li>
            </ul>
            <div class="grid-active-title">Show All</div>
          </nav>-->
          <?php if( isset($aMemberInfo['mb_id'])) : ?>
          <a href="<?=HOSTURL?>/camp/camp_write" class="btn btn-light right" style="margin-bottom: 26px;" ><i class="fa fa-pencil"></i> 글쓰기</a>
          <?php endif; ?>
          <!-- end: Portfolio Filter -->
          <!-- Blog -->
          <div id="blog" class="grid-layout post-thumbnails" data-item="post-item">
            <?php foreach ($aLdata as $key => $obj) : ?>
              <!-- Post item quote-->
                <div class="post-item">
                  <div class="post-item-wrap">
                    <div class="row">
                      <div class="post-item-description col-md-12">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($obj->indate,0,4).'-'.substr($obj->indate,4,2).'-'.substr($obj->indate,6,2)?></span>
                        <span class="post-meta-category"><i class="fa fa-user"></i><?=$obj->name?></span>
                        <!-- <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span> -->
                        <span class="post-meta-comments"><i class="fa fa-eye"></i><?=$obj->cnt?> Views</span>
                        <span class="post-meta-comments"><i class="fa fa-link"></i><?=$obj->filecnt?> Files</span>
                        <h2><a href="<?=HOSTURL?>/camp/camp_detail/<?=$obj->seq?>"><?=$obj->title?></a></h2>
                        <p><?=$obj->summary?></p>
                        <a href="<?=HOSTURL?>/camp/camp_detail/<?=$obj->seq?>" class="item-link">Read More <i class="fa fa-arrow-right"></i></a> </div>
                        <div class="seperator m-b-10"></div>
                    </div>
                  </div>
                </div>
              <!-- end: Post item-->
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
        <?=$sidebar?>
        <!-- end: Sidebar-->

      </div>
    </div>
  </section>
  <!-- end: Content-->
