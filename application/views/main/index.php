<!-- SECTION IMAGE FULLSCREEN --> 
  <section id="mainBg" class="fullscreen" data-vide-bg="<?=SKINURL?>/homepages/video-background/video/Leaves_of_Tree" data-video-options="position: 0% 50%"> 
    <div class="container-fluid">
      <div class="container-fullscreen">
        <div class="text-middle text-center"><i class="fa fa-bullseye"></i>
          <h3 class="m-b-0"></h3>
          <h2 class="text-medium m-t-0 hidden-xs">
            <img src="<?=SKINURL?>/images/happy-is.png" alt="head">
          </h2>
          <h2 class="text-medium m-t-0 hidden-lg hidden-sm hidden-md"><img src="<?=SKINURL?>/images/happy-is.png" width="80%" alt="head">
          </h2>
          <!-- <p class="lead hidden-xs" style="color: #000000">행복학교에서 오늘 내 삶에 만족하고 감사하며 <br>
            지금 이대로 행복해지는 법을 만나보세요.</p> -->
          <a class="btn btn-dark btn-outline" style="font-size: 16px; padding: 16px 32px;" href="<?=HOSTURL?>/course">행복학교 신청하기</a> </div>
      </div>
    </div>
  </section>
  <!-- end: SECTION IMAGE FULLSCREEN --> 
  
  <script type="text/javascript">
    $(document).ready(function() {
      $(window).load(function() {
        $('#mainBg').data('vide').getVideoObject().play();
      });
    });  
  </script> 
  