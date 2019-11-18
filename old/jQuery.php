<html>
<head>
<title>jQuery</title>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
<link type="text/css" href="css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.3.1.js" rel="script"></script>
<script>

        let
            AJAX;

        function upClick() {

            function getData() {
                if ((AJAX.readyState === 4) && (AJAX.status === 200)) {
                    document.getElementById("out").innerHTML = AJAX.responseText;
                }
            }

            AJAX = new XMLHttpRequest();
            AJAX.open("GET", "text.txt", true);
            AJAX.onreadystatechange = getData;
            AJAX.send();
        }

        function unClick() {
            document.getElementById("out").innerHTML = 'Текст из файла удален!';
        }

        function upLoad() {
            document.getElementById("out").innerHTML = 'Тут будет текст из файла...';
        }

</script>
</head>
    <body onload="upLoad()">

    <div>Данные загруженные изначально.</div>

Нажмите чтобы прочитать текст из файла!<br>
<input type="button" onclick="upClick()" name="button" value="Добавить">
<input type="button" onclick="unClick()" name="button" value="Удалить">

<div id="out"></div>
Данные загруженные изначально.

<div id="jq">

<p>Проверка и тестирование jQuery!!!</p>

</div>

    <div id="tooltip" title="tooltip"></div>

<script>

    $('p').add('<H7>').css('color', 'red');
    $('#jq').click(function() {
        $(this).hide(1000);
    });

    $('#jq').mousemove().attr('title', $('#tooltip').attr('title'));

</script>

</body>
</html>