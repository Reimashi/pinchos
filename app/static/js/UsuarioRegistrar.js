
$(document).ready(function () {
    $("a.usertype-button").click(function() {
        $("input[name='user-type']").val( $(this).attr('id') );
        $("#urf_select_user").slideUp();
        $("#urf_insert_data").slideDown();
    });

    $("a#urf_show_select_user").click(function() {
        $("input[name='user-type']").val('');
        $("#urf_select_user").slideDown();
        $("#urf_insert_data").slideUp();
    });

    $("form[name='user-registry'] input").focus(function() {
        $("form[name='user-registry']").find('.form-line-error:visible').fadeOut();
    });

    $("form[name='user-registry'] input[type='submit']").click(function() {
        var forminstance = $("form[name='user-registry']");

        if (!validateEmail(forminstance.find('input[name="username"]').val())) {
            forminstance.find('.form-line-error').html('El email no es válido.').fadeIn();
            return false;
        }

        var usertype = $("input[name='user-type']").val();
        if (usertype == 'utype_parti' || usertype == 'utype_organ') {
            if (stringEmpty(forminstance.find('input[name="firstname"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir un Nombre correcto.').fadeIn();
                return false;
            }

            if (stringEmpty(forminstance.find('input[name="lastname"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir unos Apellidos correctos.').fadeIn();
                return false;
            }
        }

        var pass1 = $("input[name='password']").val();
        var pass2 = $("input[name='password-repeat']").val();

        if (pass1.length < 6 || pass1.length > 20) {
            forminstance.find('.form-line-error').html('La contraseña debe tener entre 6 y 20 caracteres.').fadeIn();
            return false;
        } else if (pass1 != pass2) {
            forminstance.find('.form-line-error').html('Ambas contraseñas deben coincidir.').fadeIn();
            return false;
        }

        forminstance.find('.form-line-error').fadeOut();
    });
});
