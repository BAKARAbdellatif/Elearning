$(document).ready(function() {
    $("#validateBtn").click(function(event) {
        form = $(this);
        event.preventDefault();
        nom = $("#nom").val();
        prenom = $("#prenom").val();
        email = $("#email").val();
        password = $("#password").val();
        passwordConfirm = $("#password_confirm").val();
        alert(nom);
        errors = [];
        if(nom == "") {
            errors.push("Le nom est requis");
        }
        if(prenom == "") {
            errors.push("Le prénom est requis");
        }
        emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if(emailRegex.test(email) == false) {
            errors.push("L'email est invalide");
        }
        if(password == "") {
            errors.push("Le mot de passe est requis");
        }
        if(passwordConfirm == "") {
            errors.push("La confirmation du mot de passe est requise");
        }
        if(password != passwordConfirm) {
            errors.push("Les mots de passe ne correspondent pas");
        }
        if(errors.length > 0) {
            $("#error").html(errors.join("<br>"));
            $("#error").show();

        } else {
            $("#error").hide();
            $("#form").submit();
        }
    })
})