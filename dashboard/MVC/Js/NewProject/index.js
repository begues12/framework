
$(document).ready(function () {

    $("#submit-new-project").click(function () {

        // Call to Engine\dashboard\Actions\NewProject\NewProject.php
        alert("Project created successfully");

        $.ajax({
            type: "POST",
            url: "Actions/NewProject/NewProject.php",
            data: $("#form-new-project").serialize(),
            success: function (data) {
                if (data == "success") {
                    alert("Project created successfully");
                }else{
                    $("#error").html(data);
                }
            }

        });

    });
 
});