// form login
$("form#frm-login").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error).addClass('validate invalid error');
        offset = element.offset();
        error.addClass('text-danger');  // add a class to the wrapper
    },
    rules: {
        email:{
            required: true,
            email : true
        },
        password: {
            required:true,
            minlength: 6
        },               
    },
    messages: {
        email:{
            required : "Please input email",
            email: "Email not match"
        },
        password: {
            required: "Please input password",
            minlength:"The password must at least 6 character"
        },
    },
    submitHandler: function(form) {

        $.ajax({
            type: "POST",
            url: "/user/login",
            data: {
                 "email" : $( form ).find( 'input[name=email]' ).val(),
                 "password" : $( form ).find( 'input[name=password]' ).val()
            },
            dataType: 'json',
            success: function(data)
            {
               if(data.msg == 'success'){
                    window.location.reload();
               }else{
                    $( form ).find( '#msg-login' ).text(data.msg);
               }
               
            }
         });

        return false;

    }
});// end login form


// form login
$("form#frm-register").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error).addClass('validate invalid error');
        offset = element.offset();
        error.addClass('text-danger');  // add a class to the wrapper
    },
    rules: {
        email:{
            required: true,
            email : true
        },
        password: {
            required:true,
            minlength: 6
        },  
        confirm_password: {
            required:true,
            minlength: 6,
            equalTo: "#password"
        },         

    },
    messages: {
        email:{
            required : "Please input email",
            email: "Email wrong format"
        },
        password: {
            required: "Please input password",
            minlength:"The password must at least 6 character"
        },
         confirm_password: {
            required: "Please input password",
            minlength:"The password must at least 6 character",
            equalTo: "The confirm password not match"
        },  
    },
    submitHandler: function(form) {

        $.ajax({
            type: "POST",
            url: "/user/register",
            data: $(form).serialize(),
            dataType: 'json',
            success: function(data)
            {
               if(data.success){
                    window.location.href = '/user/register/success';
               }else{
                    $( form ).find( '#msg' ).text(data.msg);
               }
               
            }
         });

        return false;

    }
});// end login form


/*
$("form#frm-forgot").validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
        element.after(error).addClass('validate invalid error');
        offset = element.offset();
        error.addClass('text-danger');  // add a class to the wrapper
    },
    rules: {
        email:{
            required: true,
            email : true
        },
    },
    messages: {
        email:{
            required : "Please input email",
            email: "Email wrong format"
        }
       
    },
    submitHandler: function(form) {
        $(form).submit();
    }
}); 
*/

