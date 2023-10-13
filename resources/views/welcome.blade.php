@extends('layouts.template')

@section('content')
<div class="row m-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title">Income</h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">&dollar; <span id="totalIncome"></span></h4>
                <canvas id="chartIncome" class="w-10"></canvas>
            </div>
            <div class="card-footer bg-success"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title"><b>Monefy</b></h3>
                <span class="card-title">Track your income and expense</span>
            </div>
            <div class="card-body">
                <h4 class="text-center">Total Balance &dollar; <span id="totalBalance"></span></h4>
                <hr>

                <form action="{{route('dashboard.store')}}" class="form-group" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type</label>
                            <select name="type_id" id="type" class="form-control" aria-placeholder="Type">
                                <option value="">Choose Type</option>
                                @foreach ($types as $item)
                                <option value="{{$item->id}}">{{$item->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" id="category" class="form-control" required>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="transaction_date" class="form-label">Date</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                value="{{date('Y-m-d')}}" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">CREATE</button>
                    </div>
                </form>
                <hr>
                <div class="col">
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                        class="scrollspy-example" tabindex="0">
                        <script>
                            $(document).ready(function () {
                                $.ajax({
                                    url: "{{route('dashboard.index')}}",
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

                                            var icon = type.id == 1 ? 'money-recive.svg' : 'money-send.svg';
                                            var card = `
                                                <div class="card border-light" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-2">
                                                            <div class="card-body">
                                                                <img src="{{asset('assets/images/`+ icon + `')}}" alt="Out"
                                                                    style="width:50px; margin-top: 5px;">
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
                        </script>
                        <div id="itemCard"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title">Expense</h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">&dollar; <span id="totalExpense"></span></h4>
                <canvas id="chartExpense"></canvas>
            </div>
            <div class="card-footer bg-danger"></div>
        </div>
    </div>
</div>
@endsection