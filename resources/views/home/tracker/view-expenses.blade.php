@extends('layouts.app-master')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Total</th>
            <th scope="col">id</th>
            <th scope="col">Category</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Amount($)</th>
            <th scope="col">Actions</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php $num = 0; $total = 0; ?> <!-- Inicializar las variables $num y $total aquí -->
        @foreach($expenses as $expense)
        <tr>
            <td><?php echo $num+=1; ?></td>
            <td>{{ $expense->id }}</td>
            <td>{{ $expense->type }}</td>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->description }}</td>
            <td>{{ $expense->amount }}</td>
            <td><a href="{{ url('expenses/'.$expense->id) }}" class="btn btn-warning">Edit</a></td>
            <td>
                <form action="{{ url('expenses/'.$expense->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php $total += $expense->amount; ?> <!-- Sumar el monto del gasto al total -->
        @endforeach
    </tbody>
</table>

<div class="mb-3">
    <strong>Total records: {{ $num }}</strong> <!-- Mostrar el total después de la tabla -->
</div>

<div class="mb-3">
    <strong>Total: ${{ $total }}</strong> <!-- Mostrar el total después de la tabla -->
</div>

<a href="{{ url('/expenses/create') }}" class="btn btn-primary">Add more expenses</a>
@stop
