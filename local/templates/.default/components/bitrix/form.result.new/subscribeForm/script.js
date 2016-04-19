
$(function(){
    setData();  
})

function setData(){      

    //обработка событий поля ввода email
    var emailField = $("input[name=form_email_2]");       
    emailField.on("blur", function(){
        $(this).removeClass("wrong-email");
    })

    emailField.on("focus",function(){
        if ($(this).hasClass("wrong-email")) {
            $(this).val("").removeClass("wrong-email");
        } 
    })         

    //вешаем хендлер на отправку формы
    $(".subscription__btn").on("click",function(){

        //проверяем email
        var email = emailField.val();
        var emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if (!emailPattern.test(email)) {
            emailField.addClass("wrong-email");
            emailField.val("введите корректный email");     
        } else {  
            emailField.removeClass("wrong-email");      
            $("input[name=web_form_submit]").click();   
        }

    }) 

    //добавляем аттрибуты к форме и элементам формы
    $("form[name=SIMPLE_FORM_2]").addClass("subscription__form");                        
    emailField.attr("placeholder","Введите вашу эл. почту");        
}


BX.addCustomEvent('onAjaxSuccess', function(){
    setData();
})