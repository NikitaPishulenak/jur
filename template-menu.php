<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css" type="text/css">
    <script type="text/javascript" src="scripts/jquery-1.3.2.js"></script>
</head>

<body>
<div class="header"></div>
<div class="scroll"></div>
<ul id="navigation">
    <li class="home"><a href="" title="На главную страницу"> </a></li>
    <li class="about"><a href="index2.php" title="Просмотреть журнал"></a></li>
    <li class="search"><a href="" title="Новое занятие"></a></li>
<!--    <li class="photos"><a href="" title="Photos"></a></li>-->
<!--    <li class="rssfeed"><a href="" title="Rss Feed"></a></li>-->
<!--    <li class="podcasts"><a href="" title="Podcasts"></a></li>-->
<!--    <li class="contact"><a href="" title="Contact"></a></li>-->
</ul>

<script type="text/javascript">
    $(function() {
        $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

        $('#navigation > li').hover(
            function () {
                $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
            },
            function () {
                $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
            }
        );
    });
</script>

</body>
</html>