
$(document).ready(function () {
    $("a.usertype-button").click(function() {
        $("input[name='user-type']").val( $(this).attr('id') );
        $("#urf_select_user").slideUp();
        $("#urf_insert_data").slideDown();

        var usertype = $("input[name='user-type']").val();
        if (usertype == 'utype_profe' || usertype == 'utype_organ') {
            $('.orgjur-info').show();
        }
        else if (usertype == 'utype_parti') {
            $('.part-info').show();
        }
    });

    $("form[name='user-registry'] input").focus(function() {
        $("form[name='user-registry']").find('.form-line-error:visible').fadeOut();
    });

    $("form[name='user-registry'] input[type='submit']").click(function() {
        var forminstance = $("form[name='user-registry']");

        if (!validateEmail(forminstance.find('input[name="username"]').val())) {
            forminstance.find('.form-line-error').html('El <strong>email</strong> no es válido.').fadeIn();
            return false;
        }

        var usertype = $("input[name='user-type']").val();
        if (usertype == 'utype_profe' || usertype == 'utype_organ') {
            if (stringEmpty(forminstance.find('input[name="firstname"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir un <strong>nombre</strong> correcto.').fadeIn();
                return false;
            }

            if (stringEmpty(forminstance.find('input[name="lastname"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir unos <strong>apellidos</strong> correctos.').fadeIn();
                return false;
            }
        }
        else if (usertype == 'utype_parti') {
            if (stringEmpty(forminstance.find('input[name="localname"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir un <strong>nombre de local</strong> correcto.').fadeIn();
                return false;
            }

            if (stringEmpty(forminstance.find('input[name="localaddr"]').val())) {
                forminstance.find('.form-line-error').html('Debe introducir una <strong>dirección</strong> para el local.').fadeIn();
                return false;
            }
        }

        var pass1 = $('input[name="password"]').val();
        var pass2 = $('input[name="password-repeat"]').val();

        if (pass1.length < 6 || pass1.length > 20) {
            forminstance.find('.form-line-error').html('La contraseña debe tener entre 6 y 20 caracteres.').fadeIn();
            return false;
        } else if (pass1 != pass2) {
            forminstance.find('.form-line-error').html('Ambas contraseñas deben coincidir.').fadeIn();
            return false;
        }
        else {
            $('input[name="password"]').val('');
            $('input[name="password-repeat"]').val('');
            $('input[name="password-encrypted"]').val(CryptoJS.SHA1(pass1));
        }

        forminstance.find('.form-line-error').fadeOut();
    });
});
