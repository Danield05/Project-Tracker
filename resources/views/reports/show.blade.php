@extends('layouts.app-master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Budget for Last Month:</h2>
    <form>
        <div class="mb-3">
            <label for="budgetLastMonth" class="form-label">Select Last Month:</label>
            <select class="form-select" id="budgetLastMonth" name="budgetLastMonth">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <!-- Agrega las opciones para otros meses aquí -->
            </select>
        </div>
        <div class="mb-3">
            <label for="totalSpentLastMonth" class="form-label">Total Spent Last Month:</label>
            <input type="text" class="form-control" id="totalSpentLastMonth" name="totalSpentLastMonth">
        </div>
        <div class="mb-3">
            <label for="resultLastMonth" class="form-label">Result of the Budget Last Month:</label>
            <input type="text" class="form-control" id="resultLastMonth" name="resultLastMonth">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
