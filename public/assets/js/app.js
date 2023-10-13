$(document).ready(function () {
    $.ajax({
        url: "/dashboard",
        method: "GET",
        dataType: "json",
        success: function (data) {
            var tB = data.countIncome - data.countExpense;
            $("#totalIncome").text(data.countIncome);
            $("#totalExpense").text(data.countExpense);
            $("#totalBalance").text(tB);

            data.trans.forEach(item => {
                var category = item.category_item;
                var type = item.type_item;

                var color = type.id == 1 ? '#4ff613' : '#f61313';
                var card = `
                    <div class="card border-light" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <div class="card-body">
                                    <p><i class="fa-solid fa-sack-dollar fa-2xl mt-4" style="color: ${color};"></i></p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card-body">
                                    <div class="container">
                                        <p class="card-text">
                                            <b>`+ category.category_name + `</b>
                                            <br><small class="text-muted">&dollar; `+ item.amount + ` - ` + item.transaction_date + `</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card-body">
                                    <a href="#" data-id="`+ item.id + `" class="delete-confirm">
                                        <i class="fa fa-trash fa-lg mt-4 text-danger"></i>    
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $("#itemCard").append(card);
            });

            $(".delete-confirm").on('click', function () {
                var typeId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '/dashboard/' + typeId,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }

                });
            });
        }
    });
});