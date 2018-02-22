course

<?php
echo "<pre>";
print_r($aData);
echo "</pre>";
?>

<input type="button" id="bREQ" value="수강신청하기" />


<script>
$(function(){
   $('#bREQ').click(function(){
      $.post(
        "/Course/rpcReqCourse"
        ,{
            // "mb_id" :  $('#user_id').val() 
            // ,"subj" : $('#user_pwd').val() 
             "mb_id" : 'jazzwave14' 
            , "subj" : 1388 
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

