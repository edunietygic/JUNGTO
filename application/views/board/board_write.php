<?php
// test code
// echo '<pre>: '. print_r( $aMemberInfo, true ) .'</pre>';
// echo '<pre>aBoardInfo: '. print_r( $aBoardInfo, true ) .'</pre>';
// die();
?>
  <!-- Article write Content -->
  <section id="page-content" class="sidebar-right">
    <div class="container">
      <div class="row">
        <!-- content -->
        <div class="content col-md-9">
          <div class="page-title">
            <h1><?=$aBoardInfo['title']?></h1>
          </div>
          <!-- navi path ->
          <div class="breadcrumb float-right hidden-xs">
            <ul>
              <li><a href="#">Home</a> </li>
              <li class="active"><a href="#">일반게시판</a> </li>
            </ul>
          </div>
          <!-- end: navi path -->

          <form action="<?=HOSTURL?>/board/<?=$this->uri->segment(2)?>/rpcSaveBoard" id="writeBoard" name="writeBoard" method="post">
          <div id="blog" class="single-post">
            <!-- Post single item-->
            <div class="post-item">
              <div class="post-item-wrap">
                <div class="post-item-description">
                  <input type="hidden" id="tabseq" name="tabseq" value="<?=$aBoardInfo['tabseq']?>">
                  <input type="hidden" id="mb_id" name="mb_id" value="<?=$aMemberInfo['mb_id']?>">
                  <input type="hidden" id="mb_name" name="mb_name" value="<?=$aMemberInfo['name']?>">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label for="title">제목</label>
                      <input type="text" id="title" name="title" class="form-control" placeholder="제목을 입력해주세요.">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="upper" for="comment">본문</label>
                        <textarea class="form-control required" name="comment" rows="20" placeholder="본문을 작성해 주세요." id="comment" aria-required="true"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="seperator"><span>File upload</span></div>
                  <div>
                    <input type="file" id="files" name="file" multiple />
                    <div id="progress_bar">
                      <div class="percent">0%</div>
                    </div>
                  </div>
                  <div class="seperator"></div>
                  <script>
                    var reader;
                    var progress = document.querySelector('.percent');

                    function abortRead() {
                      reader.abort();
                    }

                    function errorHandler(evt) {
                      switch(evt.target.error.code) {
                        case evt.target.error.NOT_FOUND_ERR:
                          alert('File Not Found!');
                          break;
                        case evt.target.error.NOT_READABLE_ERR:
                          alert('File is not readable');
                          break;
                        case evt.target.error.ABORT_ERR:
                          break; // noop
                        default:
                          alert('An error occurred reading this file.');
                      };
                    }

                    function updateProgress(evt) {
                      // evt is an ProgressEvent.
                      if (evt.lengthComputable) {
                        var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
                        // Increase the progress bar length.
                        if (percentLoaded < 100) {
                          progress.style.width = percentLoaded + '%';
                          progress.textContent = percentLoaded + '%';
                        }
                      }
                    }

                    function handleFileSelect(evt) {
                      // Reset progress indicator on new file selection.
                      progress.style.width = '0%';
                      progress.textContent = '0%';

                      reader = new FileReader();
                      reader.onerror = errorHandler;
                      reader.onprogress = updateProgress;
                      reader.onabort = function(e) {
                        alert('File read cancelled');
                      };
                      reader.onloadstart = function(e) {
                        document.getElementById('progress_bar').className = 'loading';
                      };
                      reader.onload = function(e) {
                        // Ensure that the progress bar displays 100% at the end.
                        progress.style.width = '100%';
                        progress.textContent = '100%';
                        setTimeout("document.getElementById('progress_bar').className='';", 2000);
                      }

                      // Read in the image file as a binary string.
                      reader.readAsBinaryString(evt.target.files[0]);
                    }

                    document.getElementById('files').addEventListener('change', handleFileSelect, false);
                  </script>
                  <div style="text-align: center;">
                  	<a href="javascript:save();" id="bRegister" class="btn btn-primary"><i class="fa fa-pencil"></i> 등록</a>
                  	<a href="<?=HOSTURL?>/camp" id="bCancle" class="btn btn-light"><i class="fa fa-undo"></i> 취소</a>
              	  </div>
                </div>
              </div>
            </div>
            <!-- end: Post single item-->
          </div>
        </form>

        </div>
        <!-- end: content -->

        <!-- Sidebar-->
        <?=$sidebar?>
        <!-- end: Sidebar-->

      </div>
    </div>
  </section>
  <!-- end: Article write Content -->

  <script>
  $(function(){
    // $('#bRegister').click(function(){
    //   alert('등록하기');
    // });
  });

  //등록하기
  function save() {
    var params = jQuery("#writeBoard").serialize();

    $.ajax({
        type: 'POST',
        url: '<?=HOSTURL?>/board/<?=$this->uri->segment(2)?>/rpcSaveBoard',
        data: params,
        success: function (data) {
                  console.log(data);
                  if(data.code == 1)
                  {
                    alert(data.msg);
                    location.href = "<?=HOSTURL?>/board/<?=$this->uri->segment(2)?>";
                  }
                  else if(data.code == 999)
                  {
                    alert(data.msg);
                    return false;
                     // location.href = “register/“+data.c_idx;
                  }
              }
          });
     }

  </script>
