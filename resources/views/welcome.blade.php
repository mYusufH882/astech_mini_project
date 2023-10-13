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