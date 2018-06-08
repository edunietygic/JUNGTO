        <!-- Post item-->
        <?php foreach($aData['aCourseList']->oActiveCourse as $key=>$val) :?>
        <div class="post-item border">
          <div class="post-item-wrap">
            <div class="post-image"> <!--a href="javascript:;" data-target="#modal-3" data-toggle="modal"--> <img alt="" src="<?=$val->img?>" height="200"> <!--/a--> <?php if($val->part) : ?> <span class="post-meta-category"><?=$val->part?></span><?php endif;?> </div>
            <div class="post-item-description"> <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($val->open_date,0,4).'-'.substr($val->open_date,5,2).'-'.substr($val->open_date,8,2)?></span> <!--span class="post-meta-comments"><i class="fa fa-user"></i><?=$val->a_cnt?> 신청</span-->
            <h2><!--a href="javascript:;" data-target="#modal-3" data-toggle="modal"--><?=$val->subjnm?><!--/a--></h2>
              <!--p>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법을 만나보세요.</p-->

              <p>장소 : <?=$val->place?><br/>개강 : <?=$val->start_date?></p>
              <!--p><?=$val->eduoutline?></p-->
              <a href="<?=HOSTURL?>/course/course_detail/<?=$val->subj?>" class="item-link">과정 상세 보기 <i class="fa fa-arrow-right"></i></a> </div>
          </div>
        </div>
        <?php endforeach;?>

