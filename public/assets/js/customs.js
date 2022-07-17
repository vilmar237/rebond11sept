//DATE PICKER	
$(function() {
    var from_min_date = new Date();
    var dateFormat = "yyyy/mm/dd",
    from = $("#from")
    .datepicker({
        minDate: from_min_date,
        dateFormat: dateFormat,
        changeMonth: false,
        numberOfMonths: 1
    })
    .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
        from_min_date = getDate(this);
    })

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});

