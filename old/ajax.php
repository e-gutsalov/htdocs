<html>
<head>
    <title>AJAX</title>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
</head>
<body onload="upLoad()">

<div>Данные загруженные изначально.</div>

Нажмите чтобы прочитать текст из файла!<br>
<input type="button" onclick="upClick();" name="button" value="Добавить">
<input type="button" onclick="unClick();" name="button" value="Удалить">

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

<div id="out"></div>
Данные загруженные изначально.

</body>
</html>