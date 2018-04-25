<?php
$controller = $this->uri->segment(1);
?>
<!-- Header -->
<header id="header" class="header-fullwidth <?=($controller=='main') ? 'header-plain' : '';?>">
  <div id="header-wrap">
    <div class="container">
      <!--Logo-->
      <div id="logo"> <a href="<?=HOSTURL?>/main" class="logo" data-dark-logo="<?=SKINURL?>/images/logo-dark.png"> <img src="<?=SKINURL?>/images/logo-01.png" alt="hihappyschool Logo"> </a> </div>
      <!--End: Logo-->

      <!--Top Search Form-->
      <div id="top-search">
        <form action="search-results-page.html" method="get">
          <input type="text" name="q" class="form-control" value="" placeholder="Start typing & press  &quot;Enter&quot;">
        </form>
      </div>
      <!--end: Top Search Form-->

      <!--Header Extras-->
      <div class="header-extras">
        <ul>
          <li>
            <!--top search-->
            <a id="top-search-trigger" href="#" class="toggle-item hidden-xs"><i class="fa fa-search"></i><i class="fa fa-close"></i>
            </a>
            <!--end: top search-->
          </li>
          <li class="hidden-lg hidden-md hidden-sm">
             <!--xs login-->
            <div>
              <a href="<?=HOSTURL?>/loginout/login"><i class="fa fa-user"></i></a>
            </div>
             <!--end: xs login-->
          </li>
        </ul>
      </div>
      <!--end: Header Extras-->

      <!--Navigation Resposnive Trigger-->
      <div id="mainMenu-trigger">
        <button class="lines-button x"> <span class="lines"></span> </button>
      </div>
      <!--end: Navigation Resposnive Trigger-->

      <!--Navigation-->
      <div id="mainMenu" class="light">
        <div class="container">
          <nav>
            <ul>
              <?php if($name) :?>
              <li><a href="<?=HOSTURL?>/mypage">내정보</a></li>
              <?php endif; ?>
              <li class="dropdown"> <a href="<?=HOSTURL?>/happyschool">행복학교</a>
                <ul class="dropdown-menu">
                  <li><a href="<?=HOSTURL?>/happyschool">행복학교 소개</a></li>
                  <li><a href="<?=HOSTURL?>/happyschool/greeting">인사말</a></li>
                </ul>
              </li>
              <li><a href="<?=HOSTURL?>/course">수강신청</a></li>
              <li><a href="<?=HOSTURL?>/news">행복학교 소식</a></li>
              <li><a href="<?=HOSTURL?>/board/camp">행복캠프</a></li>
              <li><a href="<?=HOSTURL?>/lecture">즉문즉설</a></li>
              <li><a href="<?=HOSTURL?>/board/review">수강후기</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <!--end: Navigation-->
    </div>
  </div>
</header>
<!-- end: Header -->