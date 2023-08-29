@extends('layouts.app-master')

@section('content')
<h2>Edit Expense</h2>
<form class="border border-white p-3" action="{{url('expenses/'.$data->id)}}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Submitted by</label>
    <div class="col-sm-10">
    <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->name ?? auth()->user()->username }}" readonly >
      
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <select name="type" id="type" class="form-control">
        <option value="" disabled selected>{{ $data->type }}</option>
        @foreach ($categories as $category)
          <option value="{{ $category->name }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="date" name="date" value="{{$data->date}}" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="description" name="description" rows="3" required>{{ $data->description }}</textarea>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputAmount" class="col-sm-2 col-form-label">Amount($)</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="amount" name="amount" step="0.01" value="{{$data->amount}}" required>
    </div>
  </div>
  <div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
      <a href="/expenses/view" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
@if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<script>
    // Mostrar el mensaje de éxito al cargar la página
    document.addEventListener("DOMContentLoaded", () => {
        console.log("DOMContentLoaded event triggered.");
        const successMessage = document.getElementById("success-message");
        if (successMessage) {
            successMessage.style.display = "block";
            setTimeout(() => {
                successMessage.style.display = "none";
                window.location.href("{{ url('/expenses/view') }}");
            }, 3000); // 3000 milisegundos = 3 segundos
        }
    });
</script>

@endsection
