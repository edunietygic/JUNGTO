<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="행복학교" />
    <meta name="description" content="법륜스님과 함께하는 행복학교">
    <title>비밀번호발송</title>
</head>
<body style="position: relative;padding-bottom: 120px;margin: 0;background: #eee;">
    <div style="width: 100%;padding-top: 20px;">
        <!--topbar-->
        <div style="background-color: #00c49f;height: 15px;margin: 0 20%;"></div><!--//topbar-->
        <!--mail contents-->
        <div>
            <div style="padding: 20px 5%;margin: 0 20%;background: #fff;">
                <p style="font-size: 15px;"><span style="color: #00c49f" class="name"><?=$name?></span>님 안녕하세요, 행복학교입니다.</p>
                <p style="font-size: 15px;">회원님께서 '비밀번호 찾기'를 통해 요청하신 임시비밀번호를 보내드립니다.</p>
                <br>
                <p style="font-size: 15px;">임시비밀번호: <span class="tempPwd" style="color: #00c49f"><?=$tmp_password?></span></p>
                <br>
                <p style="font-size: 15px;">임시비밀번호로 로그인 하신 후 꼭 비밀번호를 변경해주세요.</p>
                <p style="font-size: 15px;">홈페이지 상단 마이페이지에서 비밀번호를 변경할 수 있습니다.</p>
                <p style="font-size: 15px;">감사합니다.</p>
                <br>
                <p style="font-size: 15px;">홈페이지로 이동하려면 아래의 링크를 방문하시기 바랍니다.<br>
                <a href="http://jungto.eduniety.cc:8090/main" style="font-size: 15px; text-decoration: underline; color: #00c49f">http://jungto.eduniety.cc:8090/main</a></p>
                <p style="font-size: 13px; padding-top:20px;">*본 메일은 발송 전용 메일입니다.</p>
            </div>
        </div><!--//mail contents-->
    </div>
    <!--footer-->
    <div class="mailBottom clearfix" style="*zoom: 1;padding: 30px 5% 20px;margin: 0 20%;background: #fff;border-top: 1px dotted #959595;">
        <!-- <div class="left logo" style="float: left;width: 40%;">
            <a href="http://jungto.eduniety.cc:8090/main"><img src="<?=SKINURL?>/images/logo-gray.png" alt="행복학교"></a>
            <div class="info">
                <p style="font-size: 10px;margin: 0px;line-height: 1.5;">서울 서초구 서초동 1623-2 우일빌딩 3층</p>
                <p style="font-size: 10px;margin: 0px;line-height: 1.5;">P: (02) 567-8080</p>
            </div>
        </div> -->
        <div class="right">
            <p class="tit" style="font-size: 15px;color: #959595;font-weight: bold;text-align: right;">"행복도 배울 수 있나요?"</p>
            <p class="txt" style="font-size: 10px;color: #959595;text-align: right;">오늘의 행복을 내일로 미루지 않는 법.<br>행복학교에서 오늘 내 삶에 만족하고 감사하며 지금 이대로 행복해지는 법<br>을 만나보세요.</p>
        </div>
    </div>
    <!--//footer-->
</body>
</html>