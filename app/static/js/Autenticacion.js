
$(document).ready(function () {
    $("form[name='user-login'] input").focus(function() {
        $("form[name='user-login']").find('.form-line-error:visible').fadeOut();
    });

    $("form[name='user-login'] input[type='submit']").click(function() {
        var forminstance = $("form[name='user-login']");

        if (!validateEmail(forminstance.find('input[name="username"]').val())) {
            forminstance.find('.form-line-error').html('El <strong>email</strong> no es válido.').fadeIn();
            return false;
        }

        var pass = $('input[name="password"]').val();

        if (pass.length < 6 || pass.length > 20) {
            forminstance.find('.form-line-error').html('La contraseña debe tener entre 6 y 20 caracteres.').fadeIn();
            return false;
        }
        else {
            $("input[name='password']").val('');
            $("input[name='password-encrypted']").val(CryptoJS.SHA1(pass));
        }

        forminstance.find('.form-line-error').fadeOut();
    });
});
