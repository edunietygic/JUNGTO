
  <!-- Content -->
  <section id="page-content">
    <div class="container">
      <!--filter district -->
      <div class="row m-b-20">
        <div class="col-md-6 p-t-10 m-b-20">
          <h3 class="m-b-20">HI~Happy School</h3>
          <p>우리동네 행복학교를 찾아보세요.</p>
        </div>
        <div class="col-md-3">
          <div class="order-select">
            <!--h6>Sort by city</h6-->
            <p></p>
            <form name="fo" action='/Course' method="post">
              <select name="p_addr1" id="addr1" onchange="addrChange()">
                <option value="">시도검색</option>
                <?php foreach($aData['addr1'] as $key=>$val) :?>
                  <?php if($val->code == $aData['select_addr1']) :?>
                    <option value=<?=$val->code?> selected><?=$val->value?></option>
                  <?php else :?>
                    <option value=<?=$val->code?>><?=$val->value?></option>
                  <?php endif;?>
                <?php endforeach;?>
                <option value="ALL"><< 전체검색 >></option>
              </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="order-select">
            <!--h6>Sort by borough</h6-->
            <p></p>
              <select name="p_addr2" id="addr2" onchange="selectSubmit()" >
                <option value="">선택</option>
                <?php if(isset($aData['addr2'])) :?>
                    <?php foreach($aData['addr2'] as $key=>$val) :?>
                        <?php if($val->code == $aData['select_addr2']) :?>
                          <option value=<?=$val->code?> selected><?=$val->value?></option>
                        <?php else :?>
                          <option value=<?=$val->code?>><?=$val->value?></option>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
              </select>
            </form>
          </div>
        </div>
      </div>
      <!--end: filter district-->
      <!-- post content -->
<script>
function selectSubmit()
{
    document.fo.submit();
}
function addrChange(){
        var selectitem = $("#addr1").val();
        if(selectitem == 'ALL')
        {
            $("#addr1").val('');
            $("#addr2").val('');

            document.fo.submit();
        }
        else
        {
                $.ajax({
                 type: 'post',
                 url: "/Course/rpcGetAddrCode",
                 data: { "code": selectitem},
                 success: function (data) {
                         if(data.code == 1)
                         {
                            console.log(data);
                            var changeitem = data.result;

                            $('#addr2').empty();

                            var option = $("<option value=''>시군구선택</option>");
                            $('#addr2').append(option);
                            for(var count = 0; count < changeitem.length; count++){
                                var option = $("<option value="+changeitem[count]['code']+">"+changeitem[count]['value']+"</option>");
                                $('#addr2').append(option);
                            }
                         }
                         else if(data.code == 99)
                         {
                            alert(data.msg);
                            return false;
                         }
                     }
                });

        }

}
</script>
      <!-- Page title -->
      <div class="page-title">
        <!--h1>happy school</h1-->
        <div class="breadcrumb float-left">
          <ul>
            <li>서울특별시</li>
            <li class="active">서초구</li>
          </ul>
        </div>
      </div>
      <!-- end: Page title -->

      <!-- Blog -->
      <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">

      <?if(isset($aData['aCourseList']) && count($aData['aCourseList']) >=1 ) :?>
        <!-- Post item-->
        <?php foreach($aData['aCourseList']->oActiveCourse as $key=>$val) :?>
        <div class="post-item border">
          <div class="post-item-wrap">
            <div class="post-image"> <a href="javascript:;" data-target="#modal-3" data-toggle="modal"> <img alt="" src="<?=$val->img?>"> </a> <!--span class="post-meta-category">주간</span--> </div>
            <div class="post-item-description"> <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?=substr($val->open_date,0,4).'.'.substr($val->open_date,5,2).'.'.substr($val->open_date,8,2)?></span> <span class="post-meta-comments"><i class="fa fa-comments-o"></i><?=$val->studentlimit?> People</span>
            <h2><!--a href="javascript:;" data-target="#modal-3" data-toggle="modal"--><?=$val->subjnm?><!--/a--></h2>
              <!--p>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법을 만나보세요.</p-->
              
              <p>장소 : <?=$val->place?><br/>개강 : <?=substr($val->start_date,0,10)?></p>
              <!--p><?=$val->eduoutline?></p-->
              <a href="/course/course_detail/<?=$val->subj?>" class="item-link">Map More <i class="fa fa-arrow-right"></i></a> </div>
          </div>
        </div>
        <?php endforeach;?>
        <!-- end: Post item-->
        <?php endif;?>

      </div>
      <!-- end: Blog -->

      <!-- Load next portfolio items -->
      <div id="pagination" class="infinite-scroll"> <a href="infinite-scroll-2.html"></a> </div>
      <!-- end:Load next portfolio items -->

    </div>
    <!-- end: post content -->

  </section>
  <!-- end: Content -->

  <!-- end: modal -->
  <div class="modal fade" id="modal-3" tabindex="-1" role="modal" aria-labelledby="modal-label-3" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 id="modal-label-3" class="modal-title">서초행복학교</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <p>지난 2년간의 국사 수업에서 이야기로서의 역사를 복원하고, 학생들을 역사 수업의 주체로 세우며, 역사 공부를 통해 인간을 성찰해보자는 뜻을 가졌다. 그 가능성을 찾기 위해 교과서를 재구성하였고, 새로운 주제를 설정하였으며, 매 시간 아이들에게 ‘정답이 없는’ 질문을 수없이 던졌다. 또 역사 수업이 단순한 옛날이야기로 끝나지 않도록 지금 우리 현실과 연관시키려 애썼다. 이 수업자료집은 그 소산이다. </p>
            <div class="seperator m-b-10"></div>
            <div class="row">
              <form class="widget-contact-form" action="include/contact-form.php" role="form" method="post">
                <div class="col-md-12" style="margin-bottom: 30px">
                  <h6>기수선택</h6>
                  <label class="sr-only">기수선택</label>
                  <select style="padding:10px" >
                    <option value="">기수를 선책해 주세요…</option>
                    <option value="">1기 서초행복학교</option>
                    <option selected="selected" value="">2기 서초행복학교</option>
                    <option value="">3기 서초행복학교</option>
                    <option value="">4기 서초행복학교</option>
                    <option value="">5기 서초행복학교</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="sr-only">ID</label>
                  <input type="text" placeholder="ID" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label class="sr-only">Password</label>
                  <input type="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">이름</label>
                  <input type="text" aria-required="true" name="widget-contact-form-name" class="form-control required name" placeholder="Enter your Name">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">전화번호</label>
                  <input type="text" class="form-control required" name="phone" placeholder="Enter phone" id="phone" aria-required="true">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">E-mail</label>
                  <input type="email" aria-required="true" name="widget-contact-form-email" class="form-control required email" placeholder="Enter your Email">
                </div>
                <div class="col-md-6">
                  <h6>성별</h6>
                  <ul class="product-size">
                    <li>
                      <label>
                        <input type="radio" name="product-size" value="option1" checked="checked">
                        <span>남</span> </label>
                    </li>
                    <li>
                      <label>
                        <input type="radio" name="product-size" value="option1" checked="checked">
                        <span>여</span> </label>
                    </li>
                  </ul>
                </div>
                <!--div class="form-group">
                          <script src="https://www.google.com/recaptcha/api.js"></script>
                          <!--div class="g-recaptcha" data-sitekey="6LddCxAUAAAAAKOg0-U6IprqOZ7vTfiMNSyQT2-M"></div>
                        </div-->
                <div class="col-md-12">
                  <button class="btn btn-default" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;신청</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-light" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->

<!-- Go to top button -->
<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>



<?php
echo "<!--";
print_r($aData['addr1']);
print_r($aData['aCourseList']);
echo "-->";
?>
