  <!-- Page title -->
  <section class="no-padding" data-height-lg="500" data-height-xs="200" data-height-sm="300">
    <!-- Google map sensor -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4s3FbBXAFPYUt478kvfmi4DENy7AUAQ&sensor=true&libraries=places"></script>
    <div  data-height-lg="50" class="map" data-map-address="<?=$aData['oCourseInfo']->addr_string?>" data-map-zoom="15" data-map-icon="/skin/images/markers/marker1.png" data-map-type="ROADMAP"></div>
  </section>
  <!-- end: Page title -->

  <!-- School Product info -->
  <section id="product-page" class="product-page p-b-0">
    <div class="container">
      <div class="product">
        <div class="row m-b-40">
          <div class="col-md-5">
            <div class="product-image">
              <!-- Carousel slider -->
              <div class="carousel dots-inside dots-dark arrows-visible arrows-only arrows-dark" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay-timeout="2500" data-lightbox="gallery"> <a href="<?=$aData['oCourseInfo']->img?>" data-lightbox="" title="happy school"> <img alt="happy school" src="<?=$aData['oCourseInfo']->img?>"> </a> <a href="<?=$aData['oCourseInfo']->img?>" data-lightbox="" title="happy school"><img alt="happy school" src="<?=$aData['oCourseInfo']->img?>"> </a> </div>
              <!-- Carousel slider -->
            </div>
          </div>
          <div class="col-md-7">
            <div class="product-description">
            <div class="product-category"><?=$aData['oCourseInfo']->addr_string?></div>
              <div class="product-title">
                <h3><?=$aData['oCourseInfo']->subjnm?> <?php if($aData['oCourseInfo']->part) echo "( ".$aData['oCourseInfo']->part." )"; ?> </h3>
              </div>
              <div class="product-rate"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> </div>
              <div class="product-reviews"><a href="#">진행자 - <?=$aData['oTutorInfo']->mb_name?>( <?=$aData['oTutorInfo']->mb_hp?> )</a> </div>
              <div class="seperator m-b-10"></div>
              <p><?=$aData['oCourseInfo']->explain?></p>
              <div class="product-meta">

                <!--p>Tags: <a href="#" rel="tag">학교</a>, <a rel="tag" href="#">캠프</a>
                                    </p-->

              </div>
              <div class="seperator m-t-20 m-b-10"></div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <!--h6>참가하기</h6-->
                <a href="#" class="btn" data-target="#modal-3" data-toggle="modal">신청</a> </div>
            </div>
          </div>
        </div>
        <div id="tabs-1" class="tabs simple">
          <ul class="tabs-navigation">
            <li class="active"><a href="#tab1"><i class="fa fa-align-justify"></i>프로그램</a> </li>
            <!--li><a href="#tab2"><i class="fa fa-info"></i> 과정 상세정보</a> </li-->
          </ul>
          <div class="tabs-content">
            <div class="tab-pane active" id="tab1">
                <?=$aData['oCourseInfo']->edupreparation?>
            </div>
            <!--div class="tab-pane" id="tab2">
                <?=$aData['oCourseInfo']->memo?>
            </div-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end: School Product info -->

<!-- School promotion -->
  <!--section class="background-grey p-t-40 p-b-0">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="icon-box effect small clean">
            <div class="icon"> <a href="#"><i class="fa fa-gift"></i></a> </div>
            <h3>Promotion Title</h3>
            <p>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법을 만나보세요.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box effect small clean">
            <div class="icon"> <a href="#"><i class="fa fa-plane"></i></a> </div>
            <h3>Promotion Title</h3>
            <p>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법을 만나보세요.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box effect small clean">
            <div class="icon"> <a href="#"><i class="fa fa-history"></i></a> </div>
            <h3>Promotion Title</h3>
            <p>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법을 만나보세요.</p>
          </div>
        </div>
      </div>
    </div>
  </section-->
  <!-- end: School promotion -->


  <!-- end: modal -->
  <div class="modal fade" id="modal-3" tabindex="-1" role="modal" aria-labelledby="modal-label-3" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <form class="widget-contact-form" role="form" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="modal-label-3" class="modal-title"><?=$aData['oCourseInfo']->subjnm?></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <?=$aData['oCourseInfo']->explain?>
              <div class="seperator m-b-10"></div>
              <div class="row">

                <!--div class="col-md-12" style="margin-bottom: 30px">
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
                </div-->
                <div class="form-group col-sm-12">
                  <label for="subject">강좌명</label>
                  <input type="text" name="widget-contact-form-subject" class="form-control" value="<?=$aData['oCourseInfo']->subjnm?>" readonly>
                  <input type="hidden" id="subj" value="<?=$aData['oCourseInfo']->subj?>">
                </div>
                <?php if($aData['oLoginInfo']->mb_id) :?>
                <div class="form-group col-md-12">
                  <label class="sr-only">ID</label>
                  <input type="text" id="mb_id" placeholder="ID" value="<?=$aData['oLoginInfo']->mb_id?>" class="form-control required id" readonly>
                  <input type="hidden" id="passwd" value="<?=$aData['oLoginInfo']->pwd?>" >
                </div>
                <?php else : ?>
                <div class="form-group col-md-6">
                  <label class="sr-only">ID</label>
                  <input type="text" id="mb_id" placeholder="ID" value="<?=$aData['oLoginInfo']->mb_id?>" class="form-control required id">
                </div>
                <div class="form-group col-md-6">
                  <label class="sr-only">Password</label>
                  <input type="password" id="passwd" placeholder="Password" value="<?=$aData['oLoginInfo']->pwd?>" class="form-control required">
                </div>
                <?php endif;?>
                <div class="form-group col-md-4">
                  <label for="name">이름</label>
                  <input type="text" id="name" aria-required="true" name="widget-contact-form-name" value="<?=$aData['oLoginInfo']->name?>" class="form-control required name" placeholder="Enter your Name">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">전화번호</label>
                  <input type="text" id="hp" class="form-control required" name="phone" value="<?=$aData['oLoginInfo']->mb_hp?>" placeholder="01012341234 (-) 빼고 입력해주세요" id="phone" aria-required="true">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">E-mail</label>
                  <input type="email" id="email" aria-required="true" name="widget-contact-form-email" value="<?=$aData['oLoginInfo']->email?>" class="form-control required email" placeholder="Enter your Email">
                </div>

                <div class="form-group col-md-4">
                    <?php if(isset($aData['aClass']) && $aData['aClass']) : ?>
                    <label for="email">개설 반</label>
                    <div class="radio">
                    <?php $checked = "checked"; 
                        foreach($aData['aClass'] as $key=>$val) :  ?>
                        <label >
                        <input type="radio" name="class_idx" id="class_idx<?=$key+1?>" value="<?=$key+1?>" <?=$checked?>> <?=$val?>
                        </label>
                    <?php
                            $checked = ""; 
                        endforeach;?>
                    </div>
                    <?php endif;?>
                </div>

              </div>
   

                <?php if(!$aData['oLoginInfo']->mb_id):?>
                <div class="alert alert-success alert-sm">
                    수강 신청시 자동으로 회원가입이 진행 됩니다.<br>
                    &nbsp; - 기존 회원의 경우 입력하신 아이디와 비밀번호를 기준으로 수강신청이 진행됩니다.<br>
                </div> 
                <?php endif;?>

            </div>
          </div>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="submit" id="bREQ" style="margin-bottom:0;">신청</button>
            <button data-dismiss="modal" class="btn btn-light" type="button">취소</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- modal -->
<script>
$(function(){
   $('#bREQ').click(function(){
     $.post(
        "/Course/rpcReqCourse"
        ,{
             "mb_id"   : $('#mb_id').val()
             ,"subj"   : $('#subj').val()
             ,"passwd" : $('#passwd').val()
             ,"name"   : $('#name').val()
             ,"hp"     : $('#hp').val()
             ,"email"  : $('#email').val()
             ,"class_idx"  : $("input[type=radio][name=class_idx]:checked").val()
         }
        ,function(data, status) {
              if (status == "success" && data.code == 1)
              {
                  alert('신청되었습니다.');
              }
              else
              {
                  alert(data.msg);
              }
        }
      );
    });
});
</script>

