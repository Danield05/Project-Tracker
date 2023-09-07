@extends('layouts.app-master')

@section('content')
<h2>Enter Monthly Budget</h2>
<form class="border border-white p-3" action="{{ url('/budget') }}" method="POST">
  @csrf
  
  <div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Submitted by</label>
    <div class="col-sm-10">
      <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->name ?? auth()->user()->username }}" readonly>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="inputMonth" class="col-sm-2 col-form-label">Month</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="month" name="month" value="{{ now()->format('F') }}" readonly>
    </div>
  </div>
  
  <div class="mb-3 row">
    <label for="inputYear" class="col-sm-2 col-form-label">Year</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="year" name="year" value="{{ now()->format('Y') }}" readonly>
    </div>
  </div>
  
  <!-- Nota en inglés para el usuario -->
  <div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
      <p class="text-primary">Please enter your Monthly Budget to make the most of our app experience.</p>
    </div>
  </div>
  
  <div class="mb-3 row">
  <label for="inputYear" class="col-sm-2 col-form-label">Monthly Budget($)</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" id="budget" name="budget" step="0.01" @if($budget) readonly value="{{ $budget->budget }}" @endif required  min="0.01">
    </div>
    <div class="col-sm-2">
      @if($budget)
        <a href="{{ url('budget/'.$budget->id) }}" class="btn btn-warning" id="editButton">
          <i class="fas fa-edit"></i>
        </a>
      @endif
    </div>
  </div>
  
  <div class="mb-3 row">
    <div class="col-sm-10 offset-sm-2">
      <a href="/home" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-primary" id="submitButton" @if($budget) disabled @endif>Submit</button>
    </div>
  </div>
</form>
@if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
    // Mostrar el mensaje de éxito y ocultarlo después de 5 segundos
    document.addEventListener("DOMContentLoaded", () => {
        const successMessage = document.getElementById("success-message");
        if (successMessage) {
            successMessage.style.display = "block";
            setTimeout(() => {
                successMessage.style.display = "none";
            }, 3000); // 3000 milisegundos = 3 segundos
        }

        
    });
</script>

@endsection
