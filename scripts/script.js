


var table=document.createElement('table');
table.border=2;
for(i=1;i<5;i++)
{
    var row=table.insertRow(0)
    var cell=row.insertCell(0)
    cell.innerHTML="ok"

    var cell2=row.insertCell(0)
    cell2.innerHTML="okk"
}
function add()
{
    var row=table.insertRow(0)
    var cell=row.insertCell(0)
    cell.innerHTML="ok"

    var cell2=row.insertCell(0)
    cell2.innerHTML="okk"
}

$(document).ready(function () {
    $("#simple_lesson").click(function () {
        $("div#cat1").slideToggle(200);
    });

    $("#test").click(function () {
        $("div#cat2").slideToggle(200);
    });

    $("#colloquium").click(function () {
        $("div#cat3").slideToggle(200);
    });

    $("#exam").click(function () {
        $("div#cat4").slideToggle(200);
    });
})
