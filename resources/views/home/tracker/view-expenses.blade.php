@extends('layouts.app-master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="card my-2">
    <div class="card-body">
        <table id="expenses" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <!--<th scope="col">id</th>-->
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount($)</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 0; $total = 0; ?> <!-- Inicializar las variables $num y $total aquí -->
                @foreach($expenses as $expense)
                <tr>
                    <td><?php echo $num+=1; ?></td>
                    <!--<td>{{ $expense->id }}</td>-->
                    <td>{{ $expense->type }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td><a href="{{ url('expenses/'.$expense->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form id="updateStatusForm{{ $expense->id }}" action="{{ url('expenses/'.$expense->id.'/status') }}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="Inactivo">
                            <button class="btn btn-danger" type="button" onclick="confirmUpdate({{ $expense->id }})"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $total += $expense->amount; ?> <!-- Sumar el monto del gasto al total -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card my-2 card-body">
    <div class="mb-3 alert alert-light">
        <strong>Total records: {{ $num }}</strong> <!-- Mostrar el total después de la tabla -->
    </div>

    <div class="mb-3 alert alert-light">
        <strong>Total expenses: ${{ $total }}</strong> <!-- Mostrar el total después de la tabla -->
    </div>

    <div class="mb-3 alert alert-light">
        @if ($budget)
            <strong>Budget for this month: ${{ $budget->budget }}</strong>
        @else
            <strong>Monthly budget has not been assigned yet <a href="{{ url('/budget') }}">click here</a> to enter budget.</strong>
        @endif
    </div>

    <div class="mb-3 alert alert-light">
        <strong>Total expenses this month: ${{ $total_expenses_current_month }}</strong>
    </div>

    <div class="mb-3 alert @if ($budget && $total_expenses_current_month > $budget->budget) alert-danger @elseif (!$budget) alert-warning @else alert-success @endif">
    @if ($budget && $total_expenses_current_month > $budget->budget)
        <strong>Monthly budget exceeded!</strong>
    @elseif (!$budget)
        <strong>Monthly budget has not been assigned yet.</strong>
    @else
        <strong>Monthly budget not exceeded.</strong>
    @endif
</div>

</div>

<a href="{{ url('/expenses/create') }}" class="btn btn-primary">Add more expenses</a>

<script>
    const confirmUpdate = (expenseId) => {
        if (confirm('Are you sure you want to delete this expense?')) {
            document.getElementById(`updateStatusForm${expenseId}`).submit();
        }
    };   
</script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
   new DataTable('#expenses');
</script>

@endsection <!-- Cierra la sección 'content' -->
