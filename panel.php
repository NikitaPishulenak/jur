<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="scripts/jquery-1.3.2.js"></script>
    <script src="scripts/jquery.maskedinput.js"></script>

    <script>
            $(document).ready(function() {
                $(":text").click(function() {
                    inp_id=$(this).attr('id');

                    $("button").click(function () {
                        var text = $(this).text();
                        $("#"+inp_id).val(text);
                        inp_id = "0"
                    });

                });

                $("div.trigger").toggle(function() {
                        // Отображаем скрытый блок

                        $("DIV#box").fadeIn(); // fadeIn - плавное появление
                        return false; // не производить переход по ссылке
                    },
                    function() {
                        // Скрываем блок
                        $("DIV#box").fadeOut(); // fadeOut - плавное исчезновение
                        return false; // не производить переход по ссылке
                    }); // end of toggle()

                $(":text").focus(function(){    // получение фокуса текстовым полем
                    $(this).select();
                });


//                $("body").click(function(e)
//                {
//                    if($(e.target).closest("DIV#box").length==0)
//                        $("DIV#box").css("display","none");
//                });
                $("body").click(function(e) {
                    $("#box").css("display","none");
                });
                $("#box").click(function(e) {
                    e.stopImmediatePropagation();
                });

            }); // end of ready()


    </script>
</head>

<body>

<?php
for ($i=0; $i<10;$i++)
{
    echo"
        <div class=\"trigger\">
        <input type=\"text\" id=\"inp$i\" maxlength=\"2\" onkeyup=\"this.value = this.value.replace (/\D/, ''); if (this.value<1 || this.value>10) this.value='';\">fdcv<br>
        </div>

    ";
}

?>


 <!-- Всё происходит при нажатии на ссылку -->
<div id='box' style='display: none;padding:10px; margin-left: 220px; position: relative; background-color:#f1f1f1;width:320px;'>
    <span class='line'></span>
    <button id="1"><b>Н<sub>у</sub></b></button>
    <button id="2"><b>Н<sub>б/у</sub></b></button>
    <button id="3"><b>Н<sub>б/отр.</sub></b></button>
    <button id="4"><b>Зач.</b></button>
    <button id="5"><b>Незач.</b></button>
</div>


</body>
</html>