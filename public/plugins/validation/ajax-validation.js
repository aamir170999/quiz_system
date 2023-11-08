function printErrorMsg(errors = null, formID = "") {
    $("textarea, input, select").removeClass("is-invalid");
    $(".invalid-feedback").remove();
    formID = formID == "" ? "" : "#" + formID + " ";
    let index = 0;
    $.each(errors, function (key, value) {
        if (index == 0) {
            $(formID + '[name="' + key + '"]').focus();
        }
        $(formID + '[name="' + key + '"]').addClass("is-invalid");
        $(formID + '[name="' + key + '"]').after(`
<div class="invalid-feedback">
    ${value[0]}
</div>`);
        index++;
    });
}
function addFormData(
    formIdentity,
    path,
    resetForm = true,
    tableId = null,
    refreshPage = null
) {
    buttonText = $(formIdentity + " button[type=submit]").text();
    $(formIdentity).submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: path,
            method: "POST",
            beforeSend: function () {
                $(formIdentity + " button[type=submit]").attr("disabled", true);
                $(formIdentity + " button[type=submit]").html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin me-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg> Loading'
                );
            },
            data: $(formIdentity).serialize(),
            success: function (data) {
                $("textarea, input, select").removeClass("is-invalid");
                $(".invalid-feedback").remove();
                Snackbar.show({
                    //success
                    text: data.msg,
                    pos: "bottom-right",
                    actionTextColor: "#fff",
                    backgroundColor: "#00ab55",
                    actionText: "X",
                });
                // reset form after completing ajax request
                if (resetForm) {
                    $(formIdentity)[0].reset();
                }
                if (tableId) {
                    $("#" + tableId)
                        .DataTable()
                        .ajax.reload();
                }
                if (refreshPage) {
                    window.location.reload();
                }
            },
            error: function (xhr) {
                $(formIdentity + " button[type=submit]").attr(
                    "disabled",
                    false
                );
                $(formIdentity + " button[type=submit]").text(buttonText);
                $("textarea, input, select").removeClass("is-invalid");
                $(".invalid-feedback").remove();
                errors = xhr.responseJSON.errors;
                printErrorMsg(errors);
                Snackbar.show({
                    // danger
                    text: "Errors! Please try again.",
                    pos: "bottom-right",
                    actionTextColor: "#fff",
                    backgroundColor: "#e7515a",
                    actionText: "X",
                });
            },
            complete: function () {
                $(formIdentity + " button[type=submit]").attr(
                    "disabled",
                    false
                );
                $(formIdentity + " button[type=submit]").text(buttonText);
            },
        });
    });
}
