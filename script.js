// Signup form AJAX request
$('#signupForm').submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "./actions.php",
        data: {
            data: $(this).serialize(),
            action: 'signup'
        },
        success: function (response) {
            $('#signupForm').trigger("reset");
            $('.info').empty();
            try {
                const jsonResponse = JSON.parse(response);

                if (jsonResponse.success) {
                    window.location.href = "./login.php?registration=success";
                } else {
                    const errors = jsonResponse.errors;
                    const infoDiv = $('.info');
                    errors.forEach(error => {
                        infoDiv.append(`<div class='failure'>${error}</div>`);
                    });
                }

            } catch (error) {
                console.error(error);
            }
        },
        error: function (status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

// Login form AJAX request
$('#loginForm').submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "./actions.php",
        data: {
            data: $(this).serialize(),
            action: 'login'
        },
        success: function (response) {
            $('#loginForm').trigger("reset");
            $('.info').empty();
            try {
                const jsonResponse = JSON.parse(response);

                if (jsonResponse.success) {
                    window.location.href = "./dashboard.php";
                } else {
                    const errors = jsonResponse.errors;
                    const infoDiv = $('.info');
                    errors.forEach(error => {
                        infoDiv.append(`<div class='failure'>${error}</div>`);
                    });
                }

            } catch (error) {
                console.error(error);
            }
        },
        error: function (status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});