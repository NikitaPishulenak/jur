<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница методиста</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="scripts/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/jquery-ui.js"></script>
    <script src="scripts/manager.js"></script>
</head>
<body>



<div class="manager-list">
    <select size="1" name="faculty">
        <option value="">---</option>
        <optgroup label="Выберите факультет">
            <option value="232">Военный факультет</option>
            <option value="210">Лечебный факультет</option>
            <option value="230">Медико-профилактический факультет</option>
            <option value="233">Медицинский факультет иностранных учащихся</option>
            <option value="229">Педиатрический факультет</option>
            <option value="231">Стоматологический факультет</option>
            <option value="285">Факультет профориентации</option>
            <option value="283">Фармацевтический факультет</option>
        </optgroup>
    </select>

    <select size="1" name="course">
        <option value="">---</option>
        <optgroup label="Выберите курс">
            <option value="1">I</option>
            <option value="2">II</option>
            <option value="3">III</option>
            <option value="4">IV</option>
            <option value="5">V</option>
            <option value="6">VI</option>
        </optgroup>
    </select>

    <span class="spase60px"></span>
    <button id='showSubjects' class='button' onclick='return showSub();'>Показать дисциплины</button>


    <div id="subjects"></div>
</div>




</body>
</html>