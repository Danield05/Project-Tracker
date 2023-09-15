@extends('layouts.app-master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/expenses.css') }}">

<h1>Analytics</h1>

<div class="row mt-5">
  
  

  <div class="col-md-6">
  <div class="mb-5">
    <canvas id="myChart1"></canvas>
  </div>
</div>

<div class="col-md-6">
  <div class="mb-5">
    <canvas id="myChart"></canvas>
  </div>
</div>
  
  
<div class="col-md-6">
    <div class="mb-5">
      <canvas id="pieChart1"></canvas>
    </div>
  </div>

<div class="col-md-6">
    <div class="mb-5">
      <canvas id="pieChart"></canvas>
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-5">
      <canvas id="lineChart"></canvas>
    </div>
  </div>

  
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
     const ctx = document.getElementById('myChart');
     const labels = @json($labels); // Convierte las etiquetas a JSON
     const values = @json($values); // Convierte los valores a JSON

     // Definir una paleta de colores específica para 12 categorías
     const backgroundColors = [
         'rgba(255, 99, 132, 0.5)',
         'rgba(54, 162, 235, 0.5)',
         'rgba(255, 206, 86, 0.5)',
         'rgba(75, 192, 192, 0.5)',
         'rgba(153, 102, 255, 0.5)',
         'rgba(255, 159, 64, 0.5)',
         'rgba(255, 0, 0, 0.5)',
         'rgba(0, 255, 0, 0.5)',
         'rgba(0, 0, 255, 0.5)',
         'rgba(128, 0, 128, 0.5)',
         'rgba(255, 192, 203, 0.5)',
         'rgba(0, 128, 128, 0.5)', // Ejemplo de un color adicional
     ];

     // Definir una paleta de colores diferentes para los bordes
     const borderColors = [
         'rgba(255, 99, 132, 1)',
         'rgba(54, 162, 235, 1)',
         'rgba(255, 206, 86, 1)',
         'rgba(75, 192, 192, 1)',
         'rgba(153, 102, 255, 1)',
         'rgba(255, 159, 64, 1)',
         'rgba(255, 0, 0, 1)',
         'rgba(0, 255, 0, 1)',
         'rgba(0, 0, 255, 1)',
         'rgba(128, 0, 128, 1)',
         'rgba(255, 192, 203, 1)',
         'rgba(0, 128, 128, 1)', // Ejemplo de un color adicional
     ];

     new Chart(ctx, {
         type: 'bar',
         data: {
             labels: labels, // Utiliza las etiquetas obtenidas del controlador
             datasets: [{
                 label: 'Total Expenses($) Current Month by Category',
                 data: values, // Utiliza los valores obtenidos del controlador
                 backgroundColor: backgroundColors, // Asigna los colores a las barras
                 borderColor: borderColors, // Asigna los colores a los bordes de las barras
                 borderWidth: 1.5 // Aumenta el ancho del borde
             }]
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true
                 }
             }
         }
     });


     //---------------------

     const ctx1 = document.getElementById('myChart1');
     const labels1 = @json($labels1); // Convierte las etiquetas a JSON
     const values1 = @json($values1); // Convierte los valores a JSON

     // Definir una paleta de colores específica para 12 categorías
     const backgroundColors1 = [
         'rgba(255, 99, 132, 0.5)',
         'rgba(54, 162, 235, 0.5)',
         'rgba(255, 206, 86, 0.5)',
         'rgba(75, 192, 192, 0.5)',
         'rgba(153, 102, 255, 0.5)',
         'rgba(255, 159, 64, 0.5)',
         'rgba(255, 0, 0, 0.5)',
         'rgba(0, 255, 0, 0.5)',
         'rgba(0, 0, 255, 0.5)',
         'rgba(128, 0, 128, 0.5)',
         'rgba(255, 192, 203, 0.5)',
         'rgba(0, 128, 128, 0.5)', // Ejemplo de un color adicional
     ];

     // Definir una paleta de colores diferentes para los bordes
     const borderColors1 = [
         'rgba(255, 99, 132, 1)',
         'rgba(54, 162, 235, 1)',
         'rgba(255, 206, 86, 1)',
         'rgba(75, 192, 192, 1)',
         'rgba(153, 102, 255, 1)',
         'rgba(255, 159, 64, 1)',
         'rgba(255, 0, 0, 1)',
         'rgba(0, 255, 0, 1)',
         'rgba(0, 0, 255, 1)',
         'rgba(128, 0, 128, 1)',
         'rgba(255, 192, 203, 1)',
         'rgba(0, 128, 128, 1)', // Ejemplo de un color adicional
     ];

     new Chart(ctx1, {
         type: 'bar',
         data: {
             labels: labels1, // Utiliza las etiquetas obtenidas del controlador
             datasets: [{
                 label: 'Total Expenses($) Previous Month by Category',
                 data: values1, // Utiliza los valores obtenidos del controlador
                 backgroundColor: backgroundColors1, // Asigna los colores a las barras
                 borderColor: borderColors1, // Asigna los colores a los bordes de las barras
                 borderWidth: 1.5 // Aumenta el ancho del borde
             }]
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true
                 }
             }
         }
     });


     const pieChartCtx = document.getElementById('pieChart').getContext('2d');

     
     const budgetValue = {{ $budget->budget ?? 0 }}; // Puedes establecer un valor predeterminado si $budget es nulo

     new Chart(pieChartCtx, {
         type: 'doughnut',
         data: {
             labels: ['Budget($) for this Month', 'Total Expenses($) this Month'],
             datasets: [{
                 data: [budgetValue, {{ $totalExpensesValue }}], // Asegúrate de obtener el valor total de gastos desde PHP
                 backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)']
             }],
         },
         options: {
             responsive: true,
             maintainAspectRatio: false,
             plugins: {
                 legend: {
                     position: 'top',
                 },
             },
             
         }
     });




     //------------

     const pieChartCtx1 = document.getElementById('pieChart1').getContext('2d');
     
const budgetValue1 = {{ $budget1->budget ?? 0 }}; // Puedes establecer un valor predete
new Chart(pieChartCtx1, {
    type: 'doughnut',
    data: {
        labels: ['Budget($) for previous Month', 'Total Expenses($) previous Month'],
        datasets: [{
            data: [budgetValue1, {{ $totalExpensesValue1 }}], // Asegúrate de obtener e
            backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)']
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
            },
        },
        
    }
});

//----------------


const ctx2 = document.getElementById('lineChart').getContext('2d');

// Sample data
const data = {
    labels: @json($labels2), // Use the labels from your controller
    datasets: [{
        label: 'Total Expenses($) daily Trend',
        data: @json($values2), // Use the values from your controller
        fill: false,
        borderColor: 'rgba(255, 99, 132, 3)',
        borderWidth: 2,
        pointRadius: 5,
        pointBackgroundColor: 'rgba(255, 99, 132, 0.5)',
        pointBorderColor: 'rgba(255, 99, 132, 0.5)',
        pointHoverRadius: 7,
        pointHoverBackgroundColor: 'rgba(255, 99, 132, 0.5)',
        pointHoverBorderColor: 'rgba(255, 99, 132, 0.5)',
    }]
};

// Chart configuration
const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Create the line chart
new Chart(ctx2, config);


//---------------------------------


</script>
@endsection