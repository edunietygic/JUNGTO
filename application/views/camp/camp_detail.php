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
									<h2><?=$aDetailData->title?></h2>
									<div class="post-meta">
										<span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($aDetailData->indate,0,4).'-'.substr($aDetailData->indate,4,2).'-'.substr($aDetailData->indate,6,2)?></span>
										<span class="post-meta-category"><i class="fa fa-user"></i><?=$aDetailData->name?></span>
										<!-- <span class="post-meta-comments"><i class="fa fa-comments-o"></i>33 Comments</span> -->
										<span class="post-meta-comments"><i class="fa fa-eye"></i><?=$aDetailData->cnt?> Views</span>
										<span class="post-meta-comments"><i class="fa fa-link"></i><?=$aDetailData->filecnt?> Files</span>
									</div>
									<?=$aDetailData->content?>
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
				<?=$sidebar?>
				<!-- end: Sidebar-->

			</div>
		</div>
	</section>
	<!-- end: Article Content -->