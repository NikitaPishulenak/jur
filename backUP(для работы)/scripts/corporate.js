//Горизонтальная прокрутка при кручении колесом
// Функция для добавления обработчика событий
function addHandler(object, event, handler) {
    if (object.addEventListener) {
        object.addEventListener(event, handler, false);
    }
    else if (object.attachEvent) {
        object.attachEvent('on' + event, handler);
    }
    else alert("Обработчик не поддерживается");
}

addHandler(window, 'DOMMouseScroll', wheel);
addHandler(window, 'mousewheel', wheel);
addHandler(document, 'mousewheel', wheel);

function wheel(event) {
    var target=$(event.target);
    if (target.is("div.grade")){
        var curLeft=$(".result_box_statistic").scrollLeft();
        var delta; // Направление колёсика мыши
        event = event || window.event;
        // Opera и IE работают со свойством wheelDelta
        if (event.wheelDelta) { // В Opera и IE
            delta = event.wheelDelta / 120;
            // В Опере значение wheelDelta такое же, но с противоположным знаком
            if (window.opera) delta = -delta; // Дополнительно для Opera
        }
        else if (event.detail) { // Для Gecko
            delta = -event.detail / 3;
        }
        // Запрещаем обработку события браузером по умолчанию
        if (event.preventDefault) event.preventDefault();
        event.returnValue = false;
        //alert(delta); // Выводим направление колёсика мыши
        if(delta==1){
            $(".result_box_statistic").scrollLeft(curLeft+50);
        }
        else if(delta==-1){
            $(".result_box_statistic").scrollLeft(curLeft-50);
        }

    }

}