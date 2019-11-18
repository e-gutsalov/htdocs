<?php
/**
 * Created by PhpStorm.
 * User: e-gut
 * Date: 22-May-18
 * Time: 23:13
 */
?>

<link type="text/css" href="css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.3.1.js" rel="script"></script>
<script type="text/javascript" src="js/bootstrap.js" rel="script"></script>
<script type="text/javascript" src="js/vue.js" rel="script"></script>

<div id="app">
    <button-counter></button-counter>
    <button-counter></button-counter>
    <button-counter></button-counter>
</div>

<script>

Vue.component('button-counter', {
    data: function () {
        return {
            styleCSS: ''
        }
    },
    template: '<tr v-bind:class="styleCSS">\n' +
    '            <td>Time</td>\n' +
    '            <td>Message</td>\n' +
    '            <td>\n' +
    '                <form action="test.php" method="GET">\n' +
    '                    <input type="hidden" name="mark_read" value="#">\n' +
    '                    <input v-on:click="styleCSS=\'bg-success\'" type="submit" class="btn btn-primary" value="Прочитать">\n' +
    '                </form>\n' +
    '            </td>\n' +
    '            <td>\n' +
    '                <form action="test.php" method="GET">\n' +
    '                    <input type="hidden" name="mark_del" value="#">\n' +
    '                    <input v-on:click="styleCSS=\'bg-success\'" type="submit" class="btn btn-primary" value="Удалить">\n' +
    '                </form>\n' +
    '            </td>\n' +
    '        </tr>'
});


    let app = new Vue({
        el: '#app'
    });
</script>
