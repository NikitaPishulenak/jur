$(function(){
    var classDate="";//тип занятия кол, аттестация или прост занятие
    var students_fio=[];//массив ФИО студентов
    var dates=[];//массив дат занятий
    var grades=[];//массив отметок
    var mas_grade=[];//ассив со всеми отметками
    var nameGroup=$("input:hidden#nGroup").val();//название группы
    var nameSubject=$("h3>a:eq(0)").text();
    var idPL=$("input:hidden#idPL").val();
    var namePL="";//лк или пз

    namePL=(idPL==0) ? "ПЗ" : "ЛК";
    var csv="гр. "+nameGroup+";"+nameSubject+";"+namePL+";\n"+"ФИО;";//итоговая строка
    
    var countSt=$("div.fio_student").length;
    var countDate=$("div.date_title").length;

    $("div.grade").each(function(){mas_grade.push($(this).text());});
 
    
    for(var i=0; i<countSt; i++){
        students_fio[i]=$("div.fio_student:eq(" + i + ")").text();
    }

    for(var i=0; i<countDate; i++){
        dates[i]=$("div.date_title:eq(" + i + ")").text();
        if($("div.date_title:eq(" + i + ")").parents().hasClass('colloquium_theme')){
            csv+=dates[i]+"(k);";
        }
        else if ($("div.date_title:eq(" + i + ")").parents().hasClass('exam_theme')){
            csv+=dates[i]+"(a);";
        }
        else{
            csv+=dates[i]+";";
        }       
    }
    csv+="\n";


    for(var i=0; i<countSt; i++){ 
        csv+=students_fio[i]+";";
        grades[i]=[]; 
        for (var j=0; j<countDate; j++){ 
            csv+=(mas_grade[j*countSt+i]).replace(/\//g, ",")+";"; 
        }
        csv+="\n";  
    }

    window.URL = window.URL || window.webkiURL;
    var blob = new Blob(["\ufeff", csv]);
    var blobURL = window.URL.createObjectURL(blob);
    $("<a></a>").attr("href", blobURL).attr("download", nameGroup+"("+translite(nameSubject)+")_"+translite(namePL)+".csv").text("Экспортировать в .CSV").appendTo('.export');
});

function translite(str){
    var arr={'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'e', 'ж':'g', 'з':'z', 'и':'i', 'й':'y', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 'о':'o', 'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'ы':'i', 'э':'e', 'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ж':'G', 'З':'Z', 'И':'I', 'Й':'Y', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O', 'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Ы':'I', 'Э':'E', 'ё':'yo', 'х':'h', 'ц':'ts', 'ч':'ch', 'ш':'sh', 'щ':'shch', 'ъ':'', 'ь':'`', 'ю':'yu', 'я':'ya', 'Ё':'YO', 'Х':'H', 'Ц':'TS', 'Ч':'CH', 'Ш':'SH', 'Щ':'SHCH', 'Ъ':'', 'Ь':'`','Ю':'YU', 'Я':'YA'};                                                                                                                                                         
    var replacer=function(a){return arr[a]||a};
    return str.replace(/[А-яёЁ]/g,replacer);
}