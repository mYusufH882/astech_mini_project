$(document).ready(function () {
    var chooseType = $("#type");

    chooseType.on('change', function () {
        var typeId = $(this).val();
        if (typeId) {
            $.ajax({
                url: '/categories/' + typeId,
                type: "GET",
                data: { "_token": "{{ csrf_token() }}" },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $("#category").empty();
                        // $("#category").append("<option hidden>Choose Categories</option>");
                        $.each(data, function (key, category) {
                            $("select[name='category_id']").append("<option value=" + category.id + ">" + category.category_name + "</option>");
                        });
                    } else {
                        $("#category").empty();
                    }
                }
            });
        } else {
            $("#category").empty();
        }
    });
});