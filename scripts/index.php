.colloquium {
    background-color: #e63046;
}

ul#navigation {
    position: fixed;
    margin: 0px;
    padding: 0px;
    top: 10px;
    left: 0px;
    list-style: none;
    z-index: 9999;
}

ul#navigation li {
    width: 100px;
}

ul#navigation li a {
    display: block;
    margin-left: -2px;
    width: 100px;
    height: 70px;
    background-color: #CFCFCF;
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid #AFAFAF;
    -moz-border-radius: 0px 2px 2px 0px;
    -webkit-border-bottom-right-radius: 2px;
    -webkit-border-top-right-radius: 2px;
    -khtml-border-bottom-right-radius: 2px;
    -khtml-border-top-right-radius: 2px;
    /*-moz-box-shadow: 0px 4px 3px #000;
    -webkit-box-shadow: 0px 4px 3px #000;
    */
    opacity: 0.6;
    filter: progid:DXImageTransform.Microsoft.Alpha(opacity=60);
}

ul#navigation .home a {
    background-image: url(images/home.png);
}

ul#navigation .about a {
    background-image: url(images/id_card.png);
}

ul#navigation .search a {
    background-image: url(images/search.png);
}

ul#navigation .podcasts a {
    background-image: url(images/ipod.png);
}

ul#navigation .rssfeed a {
    background-image: url(images/rss.png);
}

ul#navigation .photos a {
    background-image: url(images/camera.png);
}

ul#navigation .contact a {
    background-image: url(images/mail.png);
}

.table1 {
    border: solid brown 2px;
    text-align: right;

}

.name {
    width: 700px;
}

input[type=text] {
    border-radius: 4px;
    margin: 2px 2px 2px 2px;
}

.col1 {
    width: 50px;
}

.button {
    width: 40%;
    height: 20%;
    background: #6b8bad;
    border-radius: 5px;
    border: none;
    color: #fff;
    cursor: pointer;
    text-shadow: 0 1px 2px black;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 40px;
    background: -moz-linear-gradient(top, #6b8bad 0%, #39577f 48%, #254b72 52%, #102d4c 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #6b8bad), color-stop(48%, #39577f), color-stop(52%, #254b72), color-stop(100%, #102d4c));
    background: -webkit-linear-gradient(top, #6b8bad 0%, #39577f 48%, #254b72 52%, #102d4c 100%);
    background: -o-linear-gradient(top, #6b8bad 0%, #39577f 48%, #254b72 52%, #102d4c 100%);
    background: -ms-linear-gradient(top, #6b8bad 0%, #39577f 48%, #254b72 52%, #102d4c 100%);
    background: linear-gradient(to bottom, #6b8bad 0%, #39577f 48%, #254b72 52%, #102d4c 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#6b8bad', endColorstr='#102d4c', GradientType=0);
    align-items: center;
}

.button:hover {
    background: #7290b0;
    background: -moz-linear-gradient(top, #7290b0 0%, #3d5e89 48%, #29537d 52%, #133559 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #7290b0), color-stop(48%, #3d5e89), color-stop(52%, #29537d), color-stop(100%, #133559));
    background: -webkit-linear-gradient(top, #7290b0 0%, #3d5e89 48%, #29537d 52%, #133559 100%);
    background: -o-linear-gradient(top, #7290b0 0%, #3d5e89 48%, #29537d 52%, #133559 100%);
    background: -ms-linear-gradient(top, #7290b0 0%, #3d5e89 48%, #29537d 52%, #133559 100%);
    background: linear-gradient(to bottom, #7290b0 0%, #3d5e89 48%, #29537d 52%, #133559 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7290b0', endColorstr='#133559', GradientType=0);
}

.attention {
    width: 40%;
    height: 20%;
    border-radius: 15px;
    border: none;
    color: #fff;
    cursor: pointer;
    text-shadow: 0 1px 2px black;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 40px;
    background: radial-gradient(#ad7370, #890706);
    align-items: center;
    margin-left: 10%;
}

tr:hover {
    background-color: lawngreen;
}

.content {
    margin-left: 20%;
}

.left_header {
    top: 0;
    left: 0%;
}

.info {
    color: blue;
    position: absolute;
    top: 0;
    left: 70%;
    padding: 0 10px 0 10px;
    float: left;

}

.line {
    border-left: 2px solid #ccc; /* Параметры линии */
    margin-left: 15px; /* Отступ слева */
    padding-left: 15px; /* Расстояние от линии до текста */
}

/*18-08-17*/


.date_col {
    border: solid black 1px;
    width: auto;
    float: left;
    text-align: center;
}

.grade {
    border-bottom: solid black 1px;
    border-top: solid black 1px;
    width: 80px;
    height: 30px;
    text-align: center;
    cursor: pointer;
    vertical-align: middle;
}

.box {
    width: 95%;
    display: inline-block;
    align-items: center;
}

.fio {

    border-bottom: solid black 1px;
    float: left;
    width: auto;
}

.title {
    text-align: center;
    border: solid black 1px;
    /*border-bottom: none;*/
}


.date_title{
    border-bottom: solid black 1px;
}


.fio_student {
    border: solid black 1px;
    height: 30px;
}

.result_box {
    width: auto;
}

.colloquium_theme {
    background-color: cornflowerblue;
}

.exam_theme {
    background-color: burlywood;
}

input .edit_grade {
    background-color: #8c0000;
}

/*.add_grade {*/
    /*color: blue;*/
    /*text-align: center;*/
    /*border-radius: 50px;*/
    /*margin-right: 30px;*/
    /*cursor: pointer;*/
/*}*/

.inp_cell {
    width: 60px;
}

.tool{
    cursor: pointer;
}

.space{
    border-left: solid blue 1px;
    margin: 0 8px 0 8px;
}

.tool:hover{
    color: blue;
}

.fail{
    color: #8c0000;
}