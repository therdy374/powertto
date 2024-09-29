<?php require "./includes/header.php"; ?>


<script type="text/javascript">
    // 마이크로소프트 익스플로러인지 확인
    if (navigator.appName.indexOf("Microsoft") > -1) {
        // 익스플로러이면 버전 6인지 확인
        if (navigator.appVersion.indexOf("MSIE 6") > -1) {
            // 익스 플로러이면 버전 7인지 확인   
        } else if (navigator.appVersion.indexOf("MSIE 7") > -1) {

        }
        NVM = "TRIDENT";
    } else {
        // 익스플로러가 아닐 경우
        NVM = "OTHer";
    }

    var no_max_k_num = 28;
    var no_max_powerball = 9;

    function click_num(num) {
        var no_select = 0;
        var num_id = 'k_num' + num;


        if (document.form1.s_num1.value == "QP") { // QPick 을 선택하면  초기화시긴타.

            document.form1.s_num1.value = '';
            document.form1.s_num2.value = '';
            document.form1.s_num3.value = '';
            document.form1.s_num4.value = '';
            document.form1.s_num5.value = '';
            document.form1.s_num6.value = '';
            document.all["powerballqp"].className = ''; //QPick 있으면 없앤다.
            powerball_view.innerHTML = "";
        }

        document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.

        if (document.all[num_id].className == '') { // 번호를 선택하면

            // 번호가 몇개 선택되었는지 확인 한다
            for (i = 1; i <= no_max_k_num; i++) {

                k_num_id = 'k_num' + i;

                if (document.all[k_num_id].className == 'on') {
                    no_select = no_select + 1;
                }


            }

            if (no_select < 5) {
                if (document.form1.s_num1.value == '') {
                    document.form1.s_num1.value = num;
                } else if (document.form1.s_num2.value == '') {
                    document.form1.s_num2.value = num;
                } else if (document.form1.s_num3.value == '') {
                    document.form1.s_num3.value = num;
                } else if (document.form1.s_num4.value == '') {
                    document.form1.s_num4.value = num;
                } else if (document.form1.s_num5.value == '') {
                    document.form1.s_num5.value = num;
                }

                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
            } else {
                alert('일반번호는 5개까지 선택하실 수 있습니다.');
            }
        } else { // 번호 선택을 헤제하면
            document.all[num_id].className = '';

            for (z = 1; z <= 5; z++) {
                s_num_del = 's_num' + z;
                if (document.all[s_num_del].value == num) {
                    document.all[s_num_del].value = '';
                }
            }

        }

        var k_num_list = "";

        for (i = 1; i <= no_max_k_num; i++) {
            num_id = 'k_num' + i;


            if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
                k_num_list = k_num_list + '<span>' + i + '</span>';
            }
        }

        k_num_list = "" + k_num_list + "";

        k_num_view.innerHTML = k_num_list;
        document.form1.cho_method.value = "1"; //1.수동 2.자동선택, 3 반자동, 그외 없음
    }

    function Powerball_click_num(num) {
        var num_id = 'powerball' + num;


        if (document.form1.s_num1.value == "QP") { // QPick 을 선택하면  초기화시긴타.

            document.form1.s_num1.value = '';
            document.form1.s_num2.value = '';
            document.form1.s_num3.value = '';
            document.form1.s_num4.value = '';
            document.form1.s_num5.value = '';
            document.form1.s_num6.value = '';
            k_num_view.innerHTML = '';
            document.all["k_numqp"].className = '';
        }



        document.all["powerballqp"].className = '';
        if (document.all[num_id].className == '') // 번호를 선택하면
        {
            for (i = 1; i <= no_max_powerball; i++) {

                powerball_id = 'powerball' + i;

                document.all[powerball_id].className = ''
            }

            if (NVM == "TRIDENT") {
                document.all[num_id].className = 'on';
            } else {
                document.all[num_id].className = 'on';
            }
            document.form1.s_num6.value = num;

            powerball_view.innerHTML = "" + num + "";
        } else // 번호 선택을 헤제하면
        {
            document.all[num_id].className = '';
            document.form1.s_num6.value = '';
            document.form1.sel_k_num1 = '';
            powerball_view.innerHTML = "";
        }
        document.form1.cho_method.value = "1"; //1.수동 2.자동선택, 3 반자동, 그외 없음
    }

    function click_clear() {
        document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
        document.all["powerballqp"].className = '';
        for (i = 1; i <= no_max_k_num; i++) {
            num_id = 'k_num' + i;
            document.all[num_id].className = '';
        }

        for (i = 1; i <= no_max_powerball; i++) {
            powerball_id = 'powerball' + i;
            document.all[powerball_id].className = '';
        }
        document.form1.s_num1.value = '';
        document.form1.s_num2.value = '';
        document.form1.s_num3.value = '';
        document.form1.s_num4.value = '';
        document.form1.s_num5.value = '';
        document.form1.s_num6.value = '';
        k_num_view.innerHTML = '';
        powerball_view.innerHTML = '';
    }

    // 자동선택 함수
    function click_random() {
        var k_num = random_powerball(5, no_max_k_num)
        var powerball_num = random_powerball(1, no_max_powerball)
        var k_num_list = "";

        document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
        document.all["powerballqp"].className = '';

        for (i = 1; i <= no_max_k_num; i++) {
            compare_num = i - 1;
            num_id = 'k_num' + i;

            if (compare_num == k_num[0] || compare_num == k_num[1] || compare_num == k_num[2] || compare_num == k_num[3] || compare_num == k_num[4]) // 선택된 볼이면
            {
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }

                k_num_list = k_num_list + '<span>' + i + '</span>';;

                if (compare_num == k_num[0]) {
                    document.form1.s_num1.value = k_num[0];
                }
                if (compare_num == k_num[1]) {
                    document.form1.s_num2.value = k_num[1];
                }
                if (compare_num == k_num[2]) {
                    document.form1.s_num3.value = k_num[2];
                }
                if (compare_num == k_num[3]) {
                    document.form1.s_num4.value = k_num[3];
                }
                if (compare_num == k_num[4]) {
                    document.form1.s_num5.value = k_num[4];
                }
            } else // 선택되지 않은 볼이면
            {
                document.all[num_id].className = '';
            }
        }

        k_num_view.innerHTML = "" + k_num_list + "";


        for (i = 1; i <= no_max_powerball; i++) {
            compare_num = i - 1;
            powerball_id = 'powerball' + i;

            if (compare_num == powerball_num) {
                if (NVM == "TRIDENT") {
                    document.all[powerball_id].className = 'on';
                } else {
                    document.all[powerball_id].className = 'on';
                }
                document.form1.s_num6.value = powerball_num;
                powerball_view.innerHTML = " " + i + " ";
            } else {
                document.all[powerball_id].className = '';
            }
        }
        document.form1.cho_method.value = "2"; //2.자동선택, 3 반자동, 그외 없음
    }

    //반자동 함수
    function click_half_random() {

        var no_select = 0;
        var powerball_count = 0;
        // 번호가 몇개 선택되었는지 확인 한다
        var no_min_k_num = 0;
        var r_num_1 = "";
        var r_num_2 = "";
        var r_num_3 = "";
        var r_num_4 = "";
        var r_num_5 = "";
        for (i = 1; i <= no_max_k_num; i++) {
            k_num_id = 'k_num' + i;

            if (document.all[k_num_id].className == 'on' || document.all[k_num_id].className == 'on') {
                no_select = no_select + 1;

                if (no_select == 1) {
                    r_num_1 = i;
                }
                if (no_select == 2) {
                    r_num_2 = i;
                }
                if (no_select == 3) {
                    r_num_3 = i;
                }
                if (no_select == 4) {
                    r_num_4 = i;
                }
                if (no_select == 5) {
                    r_num_5 = i;
                }

            }
        }

        var no_powerball = 0;
        for (i = 1; i <= no_max_powerball; i++) {
            powerball_id = 'powerball' + i;

            if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
                no_powerball = i;
                powerball_count++;
            }
        }



        var select_num1 = 5 - no_select; //반자동 선택할 숫자갯수
        var select_num = 6; //무조건 5번

        var k_num = random_powerball_half(6, no_max_k_num);
        var q = 0;

        for (k = no_select + 1; k <= 5; k++) {

            if (k == 1) {
                if (r_num_1 == k_num['' + q]) {
                    q++;
                }
                r_num_1 = k_num['' + q];
            }
            if (k == 2) {
                if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q])) {
                    q++;
                }
                r_num_2 = k_num['' + q];
            }
            if (k == 3) {
                if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q])) {
                    q++;
                }
                r_num_3 = k_num['' + q];
            }
            if (k == 4) {
                if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q]) || (r_num_4 == k_num['' + q])) {
                    q++;
                }
                r_num_4 = k_num['' + q];
            }
            if (k == 5) {
                if ((r_num_1 == k_num['' + q]) || (r_num_2 == k_num['' + q]) || (r_num_3 == k_num['' + q]) || (r_num_4 == k_num['' + q]) || (r_num_5 == k_num['' + q])) {
                    q++;
                }
                r_num_5 = k_num['' + q];
            }
            q++;
        }

        if (powerball_count == "1") {
            var powerball_num = no_powerball;
        } else {
            var powerball_num = random_powerball(1, no_max_powerball);
            if (powerball_num == 0) { //값이 0으로 넘어오면 한번더
                powerball_num = random_powerball(1, no_max_powerball);
            }
        }

        var k_num_list = "";

        document.all["k_numqp"].className = ''; //QPick 있으면 없앤다.
        document.all["powerballqp"].className = '';


        for (i = 1; i <= no_max_k_num; i++) {
            compare_num = i;
            num_id = "k_num" + i;

            if (compare_num == r_num_1) {
                document.form1.s_num1.value = r_num_1;
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
                k_num_list = k_num_list + '<span>' + i + '</span>';;

            }
            if (compare_num == r_num_2) {
                document.form1.s_num2.value = r_num_2;
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
                k_num_list = k_num_list + '<span>' + i + '</span>';;

            }
            if (compare_num == r_num_3) {
                document.form1.s_num3.value = r_num_3;
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
                k_num_list = k_num_list + '<span>' + i + '</span>';

            }
            if (compare_num == r_num_4) {
                document.form1.s_num4.value = r_num_4;
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
                k_num_list = k_num_list + '<span>' + i + '</span>';

            }
            if (compare_num == r_num_5) {
                document.form1.s_num5.value = r_num_5;
                if (NVM == "TRIDENT") {
                    document.all[num_id].className = 'on';
                } else {
                    document.all[num_id].className = 'on';
                }
                k_num_list = k_num_list + '<span>' + i + '</span>';

            }

        }

        k_num_view.innerHTML = " " + k_num_list + " ";



        for (i = 1; i <= no_max_powerball; i++) {
            compare_num = i;
            powerball_id = 'powerball' + i;

            if (compare_num == powerball_num) {
                if (NVM == "TRIDENT") {
                    document.all[powerball_id].className = 'on';
                } else {
                    document.all[powerball_id].className = 'on';
                }
                document.form1.s_num6.value = powerball_num;
                powerball_view.innerHTML = " " + i + " ";
            } else {
                document.all[powerball_id].className = '';
            }
        }


        document.form1.cho_method.value = "3"; //1.수동 2.자동선택, 3 반자동, 그외 없음
    }

    function random_powerball(num, max_num) {
        var no_random = new Array(num);

        for (var i = 0, y = 0; i < num; i++) {
            no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
            for (y = 0; y < i; y++) {
                while (no_random[y] == no_random[i]) {
                    no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
                    y = 0;
                }
            }
        }
        return no_random;
    }

    function random_powerball_half(num, max_num) {
        var no_random = new Array(num);

        for (var i = 0, y = 0; i < num; i++) {
            no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
            for (y = 0; y < i; y++) {
                while (no_random[y] == no_random[i]) {
                    no_random[i] = (Math.floor(Math.random() * 10000) % max_num);
                    y = 0;
                }
            }
        }
        return no_random;
    }


    function num_save() {

        // 일반
        var no_num = '';
        var num_count = 0;

        form = document.form1;

        if (document.form1.s_num1.value == "QP") { // 일반번호가 QPick 일때
            form.s_num1.value = "QP";
            form.s_num2.value = "QP";
            form.s_num3.value = "QP";
            form.s_num4.value = "QP";
            form.s_num5.value = "QP";
        } else {
            for (i = 1; i <= no_max_k_num; i++) {
                num_id = 'k_num' + i;

                if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
                    if (no_num == '') no_num = i;
                    else no_num = no_num + '-' + i;

                    num_count++;
                }
            }

            if (num_count < 5) {
                alert('일반번호 5개를 선택하세요.');
                return;
            }

            var kkk = no_num.split('-');

            form.s_num1.value = kkk[0];
            form.s_num2.value = kkk[1];
            form.s_num3.value = kkk[2];
            form.s_num4.value = kkk[3];
            form.s_num5.value = kkk[4];
        }

        // 보너스
        var no_powerball = '';
        var powerball_count = 0;

        if (document.form1.s_num6.value == "QP") { // 파워볼이 QPick 일때
            form.s_num6.value = "QP";
        } else {

            for (i = 1; i <= no_max_powerball; i++) {
                powerball_id = 'powerball' + i;

                if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
                    no_powerball = i;
                    powerball_count++;
                }
            }

            if (powerball_count < 1) {
                alert('파워볼을 선택하세요.');
                return;
            }
            form.s_num6.value = no_powerball;
        }

        if (document.form1.s_num1.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form1.s_num2.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form1.s_num3.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form1.s_num4.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form1.s_num5.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form1.s_num6.value == "") {
            alert("파워볼을 선택해주세요");
            return;
        } else {
            document.form1.mode.value = "insert";
            //EXIT;
            form.submit();
            click_clear();
        }


    }

    function num_many_save() {
        form = document.form1;
        document.form1.mode.value = "manyinsert";
        form.submit();
    }


    // QPick 관련함수
    function click_num_qp(num) {
        if (num == "QP") {
            for (i = 1; i <= no_max_k_num; i++) { //일반번호 모두삭제
                num_id = 'k_num' + i;
                document.all[num_id].className = '';
            }

            if (NVM == "TRIDENT") {
                document.all["k_numqp"].className = 'on';
            } else {
                document.all["k_numqp"].className = 'on';
            }
            document.form1.s_num1.value = 'QP';
            document.form1.s_num2.value = 'QP';
            document.form1.s_num3.value = 'QP';
            document.form1.s_num4.value = 'QP';
            document.form1.s_num5.value = 'QP';
            k_num_view.innerHTML = "<span>QP</span>";

            // QP면 모두가 QP 로 선택된다.
            for (i = 1; i <= no_max_powerball; i++) { // 파워볼 번호삭제
                powerball_id = 'powerball' + i;
                document.all[powerball_id].className = '';
            }

            if (NVM == "TRIDENT") {
                document.all["powerballqp"].className = 'on';
            } else {
                document.all["powerballqp"].className = 'on';
            }

            document.form1.s_num6.value = 'QP';
            powerball_view.innerHTML = "<b>QP</b>";
        }
    }

    function Powerball_click_num_qp(num) {
        if (num == "QP") {
            for (i = 1; i <= no_max_powerball; i++) { // 파워볼 번호삭제
                powerball_id = 'powerball' + i;
                document.all[powerball_id].className = '';
            }

            if (NVM == "TRIDENT") {
                document.all["powerballqp"].className = 'on';
            } else {
                document.all["powerballqp"].className = 'on';
            }

            document.form1.s_num6.value = 'QP';
            powerball_view.innerHTML = "<b>QP</b>";


            //// QP면 모두가 QP 로 선택된다.
            for (i = 1; i <= no_max_k_num; i++) { //일반번호 모두삭제
                num_id = 'k_num' + i;
                document.all[num_id].className = '';
            }

            if (NVM == "TRIDENT") {
                document.all["k_numqp"].className = 'on';
            } else {
                document.all["k_numqp"].className = 'on';
            }

            document.form1.s_num1.value = 'QP';
            document.form1.s_num2.value = 'QP';
            document.form1.s_num3.value = 'QP';
            document.form1.s_num4.value = 'QP';
            document.form1.s_num5.value = 'QP';
            k_num_view.innerHTML = "<span>QP</span>";
        }
    }

    function num_many_save_qp() {
        form = document.form1;
        document.form1.mode.value = "manyinsert_qp";
        form.submit();
    }


    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }

    function click_mynumber() {

        // 일반
        var no_num = '';
        var num_count = 0;

        form = document.form2;

        if (document.form2.s_num1.value == "QP") { // 일반번호가 QPick 일때
            form.s_num1.value = "QP";
            form.s_num2.value = "QP";
            form.s_num3.value = "QP";
            form.s_num4.value = "QP";
            form.s_num5.value = "QP";
        } else {
            for (i = 1; i <= no_max_k_num; i++) {
                num_id = 'k_num' + i;

                if (document.all[num_id].className == 'on' || document.all[num_id].className == 'on') {
                    if (no_num == '') no_num = i;
                    else no_num = no_num + '-' + i;

                    num_count++;
                }
            }

            if (num_count < 5) {
                alert('일반번호 5개를 선택하세요.');
                return;
            }

            var kkk = no_num.split('-');

            form.s_num1.value = kkk[0];
            form.s_num2.value = kkk[1];
            form.s_num3.value = kkk[2];
            form.s_num4.value = kkk[3];
            form.s_num5.value = kkk[4];
        }

        // 보너스
        var no_powerball = '';
        var powerball_count = 0;

        if (document.form2.s_num6.value == "QP") { // 파워볼이 QPick 일때
            form.s_num6.value = "QP";
        } else {

            for (i = 1; i <= no_max_powerball; i++) {
                powerball_id = 'powerball' + i;

                if (document.all[powerball_id].className == 'on' || document.all[powerball_id].className == 'on') {
                    no_powerball = i;
                    powerball_count++;
                }
            }

            if (powerball_count < 1) {
                alert('파워볼을 선택하세요.');
                return;
            }
            form.s_num6.value = no_powerball;
        }


        if (document.form2.s_num1.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form2.s_num2.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form2.s_num3.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form2.s_num4.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form2.s_num5.value == "") {
            alert("일반번호를 선택해주세요");
            return;
        } else if (document.form2.s_num6.value == "") {
            alert("파워볼을 선택해주세요");
            return;
        } else {
            form.submit();
        }


    }
</script>

<section class="container" style="padding-top: 130px;">
    <h1 class="content-tit visual01"><span>로또구매</span></h1>
    <div class="header">
        <h2>파워볼</h2>
        <div class="btn-w">
            <a href="javascript:void(0);" class="tab-view">파워볼이란?click_num
                <div class="tab-view-layer" style="display: none;">
                    <h3>파워볼(Powerball)</h3>
                    <div>
                        파워볼(POWERBALL)은 2010년 1월 31일부터 미국의 대부분의 주에서 판매하는 최대 복권이 되었습니다. 이번 파워볼의 확장은 기존 메가밀리언의 34개 판매주 대부분과 겹치는 상황이 되었습니다. 현재 파워볼 판매에 참여하지 않은 주는 네바다,유타,와이오밍, 알래스카,엘러바마, 미시시피,하와이등 일부 주뿐이며 대부분의 주에서 파워볼을 판매한다고 볼 수 있습니다. 2012년11월 파워볼 최대 잭팟 금액은 $587,500,000 였습니다.
                    </div>
                </div>
            </a>
            <a href="../w_info/lotto_pb.php">이용안내 보기</a>
        </div>
        <div class="navi">
            <a href="/index.php">홈으로</a>
            <span>로또구매</span>
            <span>파워볼</span>
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="../w_play/lotto_pb.php">파워볼</a></li>
        </ul>
        <div class="inner-contents">
            <div class="prize-num-w">
                <div class="prize-tit">
                    최근추첨번호 <span class="ico-state bg-bl">이월</span>
                    <div><?php echo date('Y.m.d(D)'); ?> 23:00 (뉴욕시각기준)</div>
                </div>
                <?php

                function generatePowerball()
                {
                    // Generate 5 random main numbers (1 to 69)
                    $mainNumbers = [];
                    while (count($mainNumbers) < 5) {
                        $number = rand(1, 69);
                        if (!in_array($number, $mainNumbers)) {
                            $mainNumbers[] = $number;
                        }
                    }

                    // Sort the main numbers in ascending order
                    sort($mainNumbers);

                    // Generate a random Powerball number (1 to 26)
                    $powerballNumber = rand(1, 26);

                    // Return an array containing the main numbers and the Powerball number
                    return [
                        'main_numbers' => $mainNumbers,
                        'powerball_number' => $powerballNumber
                    ];
                }

                // Database connection parameters
                include "./includes/connect.php";
               
                // Retrieve the stored result and timestamp from the session
                $storedResult = isset($_SESSION['powerball_result']) ? $_SESSION['powerball_result'] : null;
                $storedTimestamp = isset($_SESSION['timestamp']) ? $_SESSION['timestamp'] : null;

                // Calculate the remaining countdown time
                $remainingCountdown = ($storedTimestamp + 24 * 60 * 60) - time();

                // If the stored result is not available or the countdown has expired, generate new numbers
                if (!$storedResult || $remainingCountdown <= 0) {
                    $powerballTicket = generatePowerball();

                    // Insert the result into the database
                    $mainNumbers = implode(", ", $powerballTicket['main_numbers']);
                    $powerballNumber = $powerballTicket['powerball_number'];
                    $insertQuery = "INSERT INTO generate_numbers (main_numbers, powerball_number) VALUES ('$mainNumbers', $powerballNumber)";
                    $conn->query($insertQuery);

                    // Store the generated result and timestamp in the session
                    $_SESSION['powerball_result'] = $powerballTicket;
                    $_SESSION['timestamp'] = time();
                } else {
                    // If the stored result is available and the countdown is still active, use the stored result
                    $powerballTicket = $storedResult;
                }

                // Close the database connection
                $conn->close();
                ?>
                <?php

                // echo "<p>Main Numbers: [" . implode(", ", $powerballTicket['main_numbers']) . "]</p>";
                // echo "<p>Powerball Number: " . $powerballTicket['powerball_number'] . "</p>";

                echo "<div class='prize-num'>";
                echo '<span>' . ($powerballTicket['main_numbers'][0]) . '</span>';
                echo '<span>' . ($powerballTicket['main_numbers'][1]) . '</span>';
                echo '<span>' . ($powerballTicket['main_numbers'][2]) . '</span>';
                echo '<span>' . ($powerballTicket['main_numbers'][3]) . '</span>';
                echo '<span>' . ($powerballTicket['main_numbers'][4]) . '</span>';
                echo '<span class="bg-pk">' . ($powerballTicket['powerball_number']) . '</span>';
                echo "</div>";

                ?>

            </div>

            <div class="table-lisw-w table-line-type lotto-buy-head">
                <div class="item th-head">
                    <div class="w33p">추첨일</div>
                    <div class="pwauto play-prize-th">당첨금</div>
                    <div class="w33p">주문마감일</div>
                </div>
                <!-- JavaScript code for countdown -->
                <script>
                    // Countdown timer in seconds
                    var countdownSeconds = <?php echo max(0, $remainingCountdown); ?>;

                    function updateCountdown() {
                        var countdownElement = document.getElementById('countdown');
                        countdownElement.innerText = ' ' + formatTime(countdownSeconds) + ' ';
                        countdownSeconds--;

                        if (countdownSeconds < 0) {
                            // Reload the page to generate new numbers after one day
                            location.reload();
                        } else {
                            // Call the function recursively every second
                            setTimeout(updateCountdown, 1000);
                        }
                    }

                    function formatTime(seconds) {
                        var hours = Math.floor(seconds / 3600);
                        var minutes = Math.floor((seconds % 3600) / 60);
                        var remainingSeconds = seconds % 60;
                        return hours + '시간  ' + minutes + '분 ' + remainingSeconds + '초';
                    }

                    // Start the countdown when the page loads
                    document.addEventListener('DOMContentLoaded', function() {
                        updateCountdown();
                    });
                </script>
                <div class="tbody">
                    <div class="item">
                        <div class="w33p f-wrap">
                            <div class="w100p t-bl">24.01.04 <br class="mo-view">13:00 (한국시간)</div>
                            <div class="w100p t-pk">24.01.03 <br class="mo-view">23:00 (미국시간)</div>
                        </div>
                        <div class="pwauto f-wrap play-prize-td">
                            <div class="w100p t-w">₩ 10,554억원</div>
                            <div class="w100p t-pk">US $ 810,000,000</div>
                        </div>
                        <div class="w33p f-wrap">
                            <div class="w100p t-bl">24.01.03 <br class="mo-view">23:50 (한국시간)</div>
                            <div class="w100p t-pk"><span id="countdown">1일 13시간 30분 6초</span>
                                <script>
                                    // getTime();
                                </script>
                                <!-- <p>Next draw in <span id="countdown"></span> seconds</p> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="tit-lotto-buy"><img src="asset/images/img_info_pb.jpg" alt="파워볼"></h3>

            <!-- List of user total amount user -->
            <div class="table-lisw-w table-line-type buy-select-num">
                <h3 class="tit-h3 mt50">당첨자 명단</h3><br>
                <div class="item th-head">
                    <div class="pw20p t-l"><span class="mo-hide">(ID)</span></div>
                    <div class="pwauto">WINNING PRICE AMOUNT</div>
                    <div class="pw15p">SELECTION <br class="mo-view">NUMBER</div>
                    <div class="pw15p">POWERBALL</div>
                    <div class="pw20p">WINNING <br class="mo-view">MATCHED<br class="mo-view"> NUMBER </div>
                </div>

                <div class="tbody">
                    <?php
                    include "./includes/connect.php";

                    $sql = "SELECT * FROM user_purchases ORDER BY date_purchase DESC LIMIT 4";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='item'>";
                            echo '<div class="pw20p t-l">' . $row["id"] . ' ' . $row['username'] . '</div>';
                            echo '<div class="pwauto t-red"> ₩ ' . number_format($row["winning_amount"]) . '</div>';
                            echo '<div class="pw15p">' . $row["selected_numbers"] . '</div>';
                            echo '<div class="pw15p t-red">' . $row["powerballs"] . '</div>';
                            echo '<div class="pw20p">' . $row["winning_match_numbers"] . '</div>';
                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $query = "SELECT * FROM user_purchases";
                    $query_run = mysqli_query($conn, $query);

                    $qty = 0;
                    while ($num = mysqli_fetch_assoc($query_run)) {
                        $qty +=  $num['winning_amount'];
                    }
    
                    ?>
                </div>
                <div class="list-result">
                    당첨금액: ₩ &nbsp; <strong><span id="odometer-container"></span></strong>
                </div>
                <!-- odometer script-->
                <script>
                    var odometer = new Odometer({
                        el: document.querySelector('#odometer-container'),
                        value: <?php echo $qty; ?>, // Set the initial value to 12345
                        format: '(,ddd)',
                    });


                    odometer.render();


                    function simulateUpdates() {
                        let currentValue = <?php echo $qty; ?>;
                        setInterval(function() {

                            currentValue += Math.floor(Math.random() * 3);
                            odometer.update(currentValue);
                        }, 5000);
                    }

                    // Run the simulation on page load
                    simulateUpdates();
                </script>
            </div>
            <!-- End list of user total amount user -->
            <form name="form2" method="post" target="ifr1" action="../w_play/mynumber_ok.php">
                <input type="hidden" name="mode" value="num_insert">
                <input type="hidden" name="part_idx" value="34">
                <input type="hidden" name="code" value="1703516887">
                <input type="hidden" name="lottery_closing_date" value="202312272350">
                <input type="hidden" name="s_num1" value="">
                <input type="hidden" name="s_num2" value="">
                <input type="hidden" name="s_num3" value="">
                <input type="hidden" name="s_num4" value="">
                <input type="hidden" name="s_num5" value="">
                <input type="hidden" name="s_num6" value="">
            </form>

            <!--로또번호 선택 시작 -->
            <form name="form1" method="post" target="ifr" action="number_list.php">
                <input type="hidden" name="mode" value="insert">
                <input type="hidden" name="part_idx" value="34">
                <input type="hidden" name="cho_method" value="">
                <input type="hidden" name="code" value="1703516887">
                <input type="hidden" name="lottery_closing_date" value="202312272350">
                <input type="hidden" name="s_num1" value="">
                <input type="hidden" name="s_num2" value="">
                <input type="hidden" name="s_num3" value="">
                <input type="hidden" name="s_num4" value="">
                <input type="hidden" name="s_num5" value="">
                <input type="hidden" name="s_num6" value="">

                <div class="lotto-buy-w">
                    <div class="number-select-w">
                        <h3 class="tit-h3">5개의 번호를 선택하세요.</h3>
                        <!-- 5 numbers -->
                        <div class="number-select">
                            <?php
                            for ($i = 1; $i <= 28; $i++) {
                                echo "<button type='button' onclick='click_num($i)' id='k_num$i'>$i</button>";
                            }
                            ?>
                            <!-- <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button> -->
                            <button type="button" id="k_numqp" onclick="click_num_qp('QP')">QP</button>
                        </div>
                        <!-- 1 powerball -->
                        <h3 class="tit-h3 mt30">1개의 파워볼을 선택하세요.</h3>
                        <div class="number-select num-power">
                            <?php
                            for ($i = 1; $i <= 9; $i++) {
                                echo "<button type='button' onclick='Powerball_click_num($i)' id='powerball$i'>$i</button>";
                            }
                            ?>
                            <!-- <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button>
                            <button type="button" class="mo-num-hide"></button> -->
                            <button type="button" id="powerballqp" onclick="Powerball_click_num_qp('QP')">QP</button>

                        </div>
                    </div>

                    <div class="number-selected-w">
                        <h3 class="tit-h3 p-l">선택한 번호
                            <a href="javascript:void(0);" class="bt_basic_play2" onclick="MM_openBrWindow('old_number.php','oldNumber','scrollbars=yes,width=520,height=600');"><button type="button" class="btn-prev-num btn-comm-mid"><img src="./asset/images/ico_prev_num.png" alt="icon"> 이전구매한번호</button></a>
                        </h3>
                        <div class="message-box-gy">
                            <div class="general-num" id="k_num_view">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <span id="powerball_view" class="bg-pk"></span>
                        </div>

                        <div class="btn-number">
                            <a href="#none" onclick="click_clear();" class="btn-comm-mid btn-gy">삭제</a>
                            <a href="#none" onclick="click_random();" class="btn-comm-mid btn-gy">자동선택</a>
                            <a href="#none" onclick="click_half_random();" class="btn-comm-mid btn-gy">반자동선택</a>
                            <a href="#none" onclick="click_mynumber();" class="btn-comm-mid btn-gy">번호보관</a>
                        </div>

                        <div class="btn-cart">
                            <!-- <a href="#none" name="btn_purchase" onclick="num_save();"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5"> 선택된 번호 구매리스트에 담기 button</a> -->
                            <button type="submit" name="btn_purchase" class="btn-comm btn-dpk"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5"> 선택된 번호 구매리스트에 담기 button</button>

                        </div>
                        <div class="btn-select">
                            <select name="game_su" id="game_su">
                                <option value="1">- 1게임</option>
                                <option value="2">- 2게임</option>
                                <option value="3">- 3게임</option>
                                <option value="4">- 4게임</option>
                                <option value="5">- 5게임</option>
                                <option value="6">- 6게임</option>
                                <option value="7">- 7게임</option>
                                <option value="8">- 8게임</option>
                                <option value="9">- 9게임</option>
                                <option value="10">- 10게임</option>
                                <option value="20">- 20게임</option>
                                <option value="30">- 30게임</option>
                                <option value="50">- 50게임</option>
                                <option value="70">- 70게임</option>
                                <option value="100">- 100게임</option>
                            </select>
                            <a href="javascript:num_many_save();" class="btn-comm-mid btn-gy" title="일괄자동선택">일괄자동선택</a>
                            <a href="javascript:num_many_save_qp();" class="btn-comm-mid btn-gy" title="QP선택">QP선택</a>
                        </div>
                    </div>
                </div>
            </form>

            <h3 class="tit-h3 mt50">구매선택된 번호</h3>

            <iframe src="number_list.php" name="ifr" scrolling="auto" frameborder="0" class="lotto-buy-frame" style="width: 100%; height: 441px;"></iframe>

            <h3 class="tit-h3 mt50">로또 구매관련 안내</h3>
            <div class="message-box-gy ">
                <div class="dot-item">Powerplay옵션은 뉴욕주에서 티켓을 구매할시에 장바구니에서 선택가능하며, 옵션1게임당 1불 및 수수료가 추가됩니다. (* 구매는 뉴욕주.캘리포니아주, 메릴렌드주에서 번갈아 구매되고 있습니다. 캘리포니아주는 옵션플레이가 없습니다)</div>
                <div class="dot-item">번호는 수동번호를 직접 선택하거나 빠른 "자동선택" 또는 "반자동(일부번호 선택 후 나머지번호자동선택)" "일괄자동선택" QP등을 이용할 수 있습니다.</div>
                <div class="dot-item">선택번호는 번호보관함에 저장해두고 필요시마다 꺼내어 같은번호로 다시 주문할 수 있습니다. 선택한번호의 당첨확률은 선택번호 우측 Smart Analysis (%)에서 확인가능합니다.</div>
                <div class="dot-item">선택번호의 당첨등수 히스토리는 당첨번호 페이지 내번호분석페이지에서 가능합니다.</div>
                <div class="dot-item">QP구매는 공식판매소 컴퓨터에서 발행하는 랜덤한 번호를 받는 주문방식입니다. QP번호확인은 티켓이 업로드된 구매완료 후 가능합니다.</div>
                <div class="dot-item">Powerplay옵션은 장바구니에서 선택 가능합니다.</div>
                <div class="dot-item">멀티 &amp; 낙첨복권등 기타상품은 기타특별복권구매하기 미국탭코너를 이용하세요.</div>
                <div class="dot-item">주문시 반드시 상단당첨금박스의 추첨날짜와 시간을 확인하세요, 마감중 주문은 다음회차로 접수가 되며, 정산후 당첨금액이 변동될 수 있습니다.</div>
                <div class="dot-item">같은 로또를 한장바구니에서 결제하지 않고 시간을 달리해 여러건으로 나누어 주문하는 경우는 구매완료 이메일은 1건만 발송될 수 있습니다.</div>
                <div class="dot-item">일정수량게임이상의 할인은 장바구니화면에서 처리됩니다.</div>
                <div class="dot-item">룰과 당첨의 자세한 사항은 로또안내 페이지를 참고하세요.</div>
            </div>
        </div>
    </div>
</section>

<iframe src="" name="ifr1" width="0" height="0"></iframe>

<?php require "includes/footer.php"; ?>