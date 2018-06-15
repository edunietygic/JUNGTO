<?php
// test code
// echo '<pre>aMemberInfo: '. print_r( $aMemberInfo, true ) .'</pre>';
// echo '<pre>: '. print_r( $aReplyDetail, true ) .'</pre>';
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
										<span class="post-meta-comments"><i class="fa fa-eye"></i>조회수 <?=$aDetailData->cnt?></span>
										<span class="post-meta-comments"><i class="fa fa-link"></i>첨부파일 <?=$aDetailData->filecnt?></span>
									</div>
									<?=nl2br($aDetailData->content)?>
                                    <?php if( is_array($aAttachFile) && count($aAttachFile) > 0 ) : ?>
									<div class="seperator"><span>File Download</span></div>
									<?php foreach ($aAttachFile as $key => $obj) : ?>
									<span class="post-meta-comments"><i class="fa fa-link"></i><a href="<?=ATTACHURL?>/<?=$obj->savefile?>" download="<?=$obj->realfile?>"><?=$obj->realfile?></a></span>
                                    <img src="<?=ATTACHURL.'/'.$obj->savefile?>" alt="Smiley face" height="100%" width="100%">
									<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<!-- <div class="post-tags"><a href="#">백제</a><a href="#">서울</a><a href="#">유적</a><a href="#">기원전</a></div> -->
								<!-- page navigation -->
								<div class="post-navigation">
									<a href="<?=( isset($aPreData->seq) ) ? $aPreData->seq : 'javascript:;' ?>" class="post-prev">
										<div class="post-prev-title"><span>이전글</span><?=( isset($aPreData->title) ) ? $aPreData->title : '' ?></div>
									</a>
									<a href="<?=HOSTURL?>/board/<?=$this->uri->segment(2)?>" class="post-all"><i class="fa fa-th"></i></a>
									<a href="<?=( isset($aNextData->seq) ) ? $aNextData->seq : 'javascript:;' ?>" class="post-next">
										<div class="post-next-title"><span>다음글</span><?=( isset($aNextData->title) ) ? $aNextData->title : '' ?></div>
									</a>
								</div>
								<!-- //page navigation -->

								<!-- Comments -->
								<div class="comments" id="comments">
								  <div class="comment_number"> 댓글 <span>(<?=(is_array($aReplyDetail) && count($aReplyDetail)>0) ? count($aReplyDetail) : '0' ?>)</span> </div>
								  <div class="comment-list">
								    <!-- Comment -->
								    <?php if( is_array($aReplyDetail) ) : ?>
								    <?php foreach ($aReplyDetail as $key => $obj) : ?>
								    <div class="comment" id="comment-1">
								      <!--div class="image"><img alt="" src="<?=HOSTURL?>/static/image/author.jpg" class="avatar"></div-->
								      <div class="text">
								        <h5 class="name"><?=$obj->name?></h5>
								        <span class="comment_date"><?=substr($obj->indate,0,4).'-'.substr($obj->indate,4,2).'-'.substr($obj->indate,6,2).' '.substr($obj->indate,8,2).':'.substr($obj->indate,10,2)?></span>
								        <div class="text_holder">
								          <p><?=$obj->content?></p>
								        </div>
								      </div>
								    </div>
									<?php endforeach; ?>
									<?php endif; ?>
								    <!-- end: Comment -->
								  </div>
								</div>
								<!-- end: Comments -->
								<?php if( is_array($aMemberInfo) ) : ?>
								<div class="respond-form" id="respond">
								  <div class="respond-comment"> <span>댓글 남기기</span></div>
								  <form class="form-gray-fields" id="commentFrm" name="commentFrm">
								  	<input type="hidden" id="tabseq" name="tabseq" value="<?=$tabseq?>">
								  	<input type="hidden" id="refseq" name="refseq" value="<?=$seq?>">
								  	<input type="hidden" id="mb_id" name="mb_id" value="<?=$aMemberInfo['mb_id']?>">
								  	<input type="hidden" id="mb_name" name="mb_name" value="<?=$aMemberInfo['name']?>">
								  	<input type="hidden" id="title" name="title" value="<?=$aDetailData->title?>">
								    <div class="row">
								      <div class="col-md-12">
								        <div class="form-group">
								          <!--label class="upper" for="comment">comment</label-->
								          <textarea class="form-control required" name="comment" rows="9" placeholder="내용을 입력하세요" id="comment" aria-required="true"></textarea>
								        </div>
								      </div>
								    </div>
								    <div class="row">
								      <div class="col-md-12">
								        <div class="form-group text-center">
								          <a href="javascript:save();" id="bRegister" class="btn btn-primary">저장</a>
								        </div>
								      </div>
								    </div>
								  </form>
								</div>
								<?php endif;?>
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

<script>
function save() {
  var params = jQuery("#commentFrm").serialize();

  $.ajax({
      type: 'POST',
      url: '<?=HOSTURL?>/board/<?=$this->uri->segment(2)?>/rpcSaveBoardReply',
      data: params,
      success: function (data) {
                console.log(data);
                if(data.code == 1)
                {
                  alert(data.msg);
                  window.location.reload();
                }
                else if(data.code == 999)
                {
                  alert(data.msg);
                  return false;
                }
            }
        });
   }

</script>
