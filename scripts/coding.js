var str = "11121517";
var result = Decrypt(str);


function Decrypt(value) {
    var res="";
    var mas=value.match(/.{2}/g);
    for (i=0;i<mas.length; i++){
       mas[i]=MatchDecrypt(mas[i]);
    }
    res=mas.join('/');
    alert(res);
}

function MatchDecrypt(val) {
    switch (val){
        case '11':
            return '1';
            break;
        case '12':
            return '2';
            break;
        case '13':
            return '3';
            break;
        case '14':
            return '4';
            break;
        case '15':
            return '5';
            break;
        case '16':
            return '6';
            break;
        case '17':
            return '7';
            break;
        case '18':
            return '8';
            break;
        case '19':
            return '9';
            break;
        case '20':
            return '10';
            break;
        case '21':
            return 'Ну';
            break;
        case '22':
            return 'Нб_у';
            break;
        case '23':
            return 'Нб_отр.';
            break;
        case '24':
            return 'Зач.';
            break;
        case '25':
            return 'Незач.';
            break;
        case '26':
            return 'Недопуск';
            break;
    }

}