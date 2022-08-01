const init = function (parent = "") {
    if (parent != "") {
        parent = parent + " ";
    }
    /*******************************************************
                   SELECT Start
*******************************************************/
    if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)
    ) {
        $(parent + ".select-picker").selectpicker("mobile");
    } else {
        $(parent + ".select-picker").selectpicker();
    }
    // $(parent + ".select2").select2();
    /*******************************************************
                   SELECT End
*******************************************************/
    //turn off autocomplete for all inputs
    $(parent + "input").attr("autocomplete", "off");

    //initialise tooltip
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]',
        trigger: 'hover'
    });

    //initialise popover
    $(function () {
        $('[data-toggle="popover"]').popover();
    });

    //initialise dropify
    var drEvent = $(".dropify").dropify({
        messages: dropifyMessages,
    });

    drEvent.on("dropify.afterClear", function (event, element) {
        var elementID = element.element.id;
        var elementName = element.element.name;
        if ($("#" + elementID + "_delete").length == 0) {
            $("#" + elementID).after(
                '<input type="hidden" name="' +
                    elementName +
                    '_delete" id="' +
                    elementID +
                    '_delete" value="yes">'
            );
        }
    });
};

//select row in datatable
const dataTableRowCheck = (id) => {
    if ($(".select-table-row:checked").length > 0) {
        $("#quick-action-form").fadeIn();
        //if at-least one row is selected
        document.getElementById("select-all-table").indeterminate = true;
        $("#quick-actions")
            .find("input, textarea, button, select")
            .removeAttr("disabled");
        if ($("#quick-action-type").val() == "") {
            $("#quick-action-apply").attr("disabled", true);
        }
        $(".select-picker").selectpicker("refresh");
    } else {
        $("#quick-action-form").fadeOut();
        //if no row is selected
        document.getElementById("select-all-table").indeterminate = false;
        $("#select-all-table").attr("checked", false);
        resetActionButtons();
    }

    if ($("#datatable-row-" + id).is(":checked")) {
        $("#row-" + id).addClass("table-active");
    } else {
        $("#row-" + id).removeClass("table-active");
    }
};

//select all rows in datatable
const selectAllTable = (source) => {
    checkboxes = document.getElementsByName("datatable_ids[]");
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        // if disabled property is given to checkbox, it won't select particular checkbox.
        if (!$("#" + checkboxes[i].id).prop('disabled')){
            checkboxes[i].checked = source.checked;
        }
        if ($("#" + checkboxes[i].id).is(":checked")) {
            $("#" + checkboxes[i].id)
                .closest("tr")
                .addClass("table-active");
            $("#quick-actions")
                .find("input, textarea, button, select")
                .removeAttr("disabled");
            if ($("#quick-action-type").val() == "") {
                $("#quick-action-apply").attr("disabled", true);
            }
            $(".select-picker").selectpicker("refresh");
        } else {
            $("#" + checkboxes[i].id)
                .closest("tr")
                .removeClass("table-active");
            resetActionButtons();
        }
    }

    if ($(".select-table-row:checked").length > 0) {
        $("#quick-action-form").fadeIn();
    } else {
        $("#quick-action-form").fadeOut();
    }
};

//reset table action form elements
const resetActionButtons = () => {
    $("#quick-action-form")[0].reset();
    $("#quick-actions")
        .find("input, textarea, button, select")
        .attr("disabled", "disabled");
    $(".select-picker").selectpicker("refresh");
};

function deSelectAll() {
    $("#select-all-table").prop("checked", false);
}

//show hide secret values
$("body").on("click", ".toggle-password", function () {
    var $selector = $(this).closest(".input-group").find("input.form-control");
    $(this).find(".svg-inline--fa").toggleClass("fa-eye fa-eye-slash");
    var $type = $selector.attr("type") === "password" ? "text" : "password";
    $selector.attr("type", $type);
});