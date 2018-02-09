<!-- Header -->
<header id="header" class="header-fullwidth header-transparent header-plain">
  <div id="header-wrap">
    <div class="container"> 
      <!--Logo-->
      <div id="logo"> <a href="index.html" class="logo" data-dark-logo="images/logo-dark.png"> <img src="<?=SKINURL?>/images/logo.png" alt="hihappyschool Logo"> </a> </div>
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
            <a id="top-search-trigger" href="#" class="toggle-item"> <i class="fa fa-search"></i> <i class="fa fa-close"></i> </a> 
            <!--end: top search--> 
          </li>
          <li class="hidden-xs"> 
            <!--shopping cart -->
                              <div id="shopping-cart">
                                  <a href="#">
                                      <span class="shopping-cart-items">8</span>

                                      <i class="fa fa-shopping-cart"></i></a>
                              </div>
                              <!--end: shopping cart--> 
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
              <li><a href="#">MY PAGE</a></li>
              <li class="dropdown"> <a href="#">행복학교</a>
                <ul class="dropdown-menu">
                  <li><a href="#">행복학교 소개</a></li>
                  <li><a href="#">가치체계<span class="label label-danger">NEW</span></a></li>
                  <li><a href="#">프로그램 소개</a></li>
                </ul>
              </li>
              <li><a href="page-map.html">수강신청</a></li>
              <li><a href="archive-paginav.html">행복학교 소식</a></li>
              <li><a href="archive-paginav.html">행복캠프</a></li>
              <li><a href="archive-paginav.html">행복한강연</a></li>
              <li><a href="archive-paginav.html">생생후기</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <!--end: Navigation--> 
    </div>
  </div>
</header>
<!-- end: Header --> 