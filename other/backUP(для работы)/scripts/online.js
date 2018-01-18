        $(document).ready(function(){  
            setInterval('Onl()',600000);  
        });  

        function Onl()  
        {  
            $.ajax({ 
                type:'get', 
                url: 'online.php',  
                cache: false,
                success:function (st) {
                  if (st=="AisD"){
                     alert("Извините, время вашей рабочей сессии истекло. Пожалуйста, закройте браузер и заново авторизуйтесь");
                     window.location.reload();
                  }
                }  
            });  
        }  
   