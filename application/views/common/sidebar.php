<?php
  $aBbsTabseq = edu_get_config('bbs_tabseq', 'jungto');
?>
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
                      <?php if(is_array($aRecentReply) && count($aRecentReply)>0 ) : ?>
                      <?php foreach ($aRecentReply as $key => $obj) : ?>
                      <div class="post-thumbnail-entry" style="width: 100%;">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                          <a href="<?=HOSTURL?>/board/<?=$aBbsTabseq[$obj->tabseq]['url']?>/board_detail/<?=$obj->refseq?>"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->content?></span></a>
                          <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                          <span class="post-category"><i class="fa fa-user"></i> <?=$obj->name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                    <div class="post-thumbnail-list">
                      <?php if(is_array($aRecentContents) && count($aRecentContents)>0 ) : ?>
                      <?php foreach ($aRecentContents as $key => $obj) : ?>
                      <div class="post-thumbnail-entry" style="width: 100%;">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                            <a href="<?=HOSTURL?>/board/<?=$aBbsTabseq[$obj->tabseq]['url']?>/board_detail/<?=$obj->seq?>"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->title?></span></a>
                            <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                            <span class="post-category"><i class="fa fa-user"></i> <?=$obj->name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab3">
                    <div class="post-thumbnail-list">
                      <?php if(is_array($aHotContents) && count($aHotContents)>0 ) : ?>
                      <?php foreach ($aHotContents as $key => $obj) : ?>
                      <div class="post-thumbnail-entry" style="width: 100%;">
                        <!--img alt="" src="images/blog/thumbnail/6.jpg"-->
                        <div class="post-thumbnail-content">
                          <a href="<?=HOSTURL?>/board/<?=$aBbsTabseq[$obj->tabseq]['url']?>/board_detail/<?=$obj->seq?>"><span style="font-family:'맑은 고딕';font-size: 10pt;font-weight: lighter"><?=$obj->title?></span></a>
                          <span class="post-date"><i class="fa fa-clock-o"></i> <?=$obj->diffdate?></span>
                          <span class="post-category"><i class="fa fa-user"></i> <?=$obj->name?></span>
                        </div>
                      </div>
                      <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--End: Tabs with Posts-->

          </div>
        </div>
