<?php
// test code
// echo '<pre>aDetailData: '. print_r( $aDetailData, true ) .'</pre>';
// echo '<pre>aPreData: '. print_r( $aPreData, true ) .'</pre>';
// echo '<pre>aNextData: '. print_r( $aNextData, true ) .'</pre>';
// echo '<pre>aAttachFile: '. print_r( $aAttachFile, true ) .'</pre>';
// die();
?>
<!-- Article Content -->
	<section id="page-content" class="sidebar-right">
		<div class="container">
			<div class="row">
				<!-- content -->
				<div class="content col-md-9">
					<!-- Blog -->
					<div id="blog" class="single-post">
						<!-- Post single item-->
						<div class="post-item">
							<div class="post-item-wrap">
								<div class="post-item-description">
									<h2><?=$aDetailData->adtitle?></h2>
									<div class="post-meta">
										<span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($aDetailData->addate,0,4).'-'.substr($aDetailData->addate,4,2).'-'.substr($aDetailData->addate,6,2)?></span>
										<span class="post-meta-category"><i class="fa fa-user"></i><?=$aDetailData->adname?></span>
										<!-- <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span> -->
										<span class="post-meta-comments"><i class="fa fa-eye"></i><?=$aDetailData->cnt?> Views</span>
										<span class="post-meta-comments"><i class="fa fa-link"></i><?=$aDetailData->filecnt?> Files</span>
									</div>
									<?=$aDetailData->adcontent?>
									<?php if( is_array($aAttachFile) && count($aAttachFile) > 0 ) : ?>
									<div class="seperator"><span>File Download</span></div>
									<?php foreach ($aAttachFile as $key => $obj) : ?>
									<span class="post-meta-comments"><i class="fa fa-link"></i><a href="<?=ATTACHURL?>/<?=$obj->savefile?>" download="<?=$obj->realfile?>"><?=$obj->realfile?></a></span>
									<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<!-- <div class="post-tags"><a href="#">백제</a><a href="#">서울</a><a href="#">유적</a><a href="#">기원전</a></div> -->
								<!-- page navigation -->
								<div class="post-navigation">
									<a href="<?=( isset($aPreData->seq) ) ? $aPreData->seq : 'javascript:;' ?>" class="post-prev">
										<div class="post-prev-title"><span>이전글</span><?=( isset($aPreData->title) ) ? $aPreData->title : '' ?></div>
									</a>
									<a href="<?=HOSTURL?>/news" class="post-all"><i class="fa fa-th"></i></a>
									<a href="<?=( isset($aNextData->seq) ) ? $aNextData->seq : 'javascript:;' ?>" class="post-next">
										<div class="post-next-title"><span>다음글</span><?=( isset($aNextData->title) ) ? $aNextData->title : '' ?></div>
									</a>
								</div>
								<!-- //page navigation -->

							</div>
						</div>
						<!-- end: Post single item-->
					</div>
				</div>
				<!-- end: content -->

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
	<!-- end: Article Content -->