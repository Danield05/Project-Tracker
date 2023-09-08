<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expenses;
use App\Models\Budget; 

class ExpensesController extends Controller
{
    
    public function index(){
        $categories = Category::all();
        return view('home/tracker/tracker', compact('categories'));
    }


    public function store(Request $request)
    {
        $expense = new Expenses();
        $expense->username = auth()->user()->name ?? auth()->user()->username;
        $expense->type = $request->input('type');
        $expense->date = $request->input('date');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->status = 'Activo'; 
        $expense->save();
    
        return redirect('/expenses/create')->with('success', 'Expense registered successfully.');
    }
    
    public function show(){
        $username = auth()->user()->name ?? auth()->user()->username;
    
        // Obtener el mes actual y el año actual en el formato correcto
        $mesActual = now()->format('m');
        $anoActual = now()->format('Y');
        $mesActual_budget = now()->format('F');
        
        $expenses = Expenses::where('username', $username)
            ->where('status', 'Activo')
            ->get();
    
        $expenses_current_month = Expenses::where('username', $username)
            ->where('status', 'Activo')
            ->whereRaw('MONTH(date) = ? AND YEAR(date) = ?', [$mesActual, $anoActual])
            ->get();
    
        $total_expenses_current_month = $expenses_current_month->sum('amount');
    
        // Obtener el presupuesto o null si no existe
        $budget = Budget::where('username', $username)
            ->where('month', $mesActual_budget)
            ->where('year', $anoActual)
            ->first();

            if (!$budget) {
                $budget = null; // Otra opción es asignar un valor predeterminado, como 0
            }
    
        return view('home.tracker.view-expenses', [
            'expenses' => $expenses,
            'total_expenses_current_month' => $total_expenses_current_month,
            'budget' => $budget, // Puede ser null si no existe un presupuesto
        ]);
    }
    

   public function edit(string $id)
   {
       $expense = Expenses::findOrFail($id);
       $categories = Category::all(); 
       return view('home.tracker.update-expense',['data' => $expense,  'categories' => $categories]);
   }
public function update(Request $request, string $id)
{
   
    $expense = Expenses::findOrFail($id);
    $expense->update($request->all());
    return redirect('expenses/view')->with('success', 'Expense updated successfully.');;
   
}

public function updateStatus($id) //funcion para "eliminar" un expense
{
    $expense = Expenses::findOrFail($id);
    $expense->status = 'Inactivo'; // Cambiar el estado a "Inactivo"
    $expense->save();

    return redirect('/expenses/view')->with('success', 'Expense marked as Inactive.');
}
public function showBudget()
{
    $username = auth()->user()->name ?? auth()->user()->username; 

    // Obtener el mes actual y el año actual en el formato correcto
    $mesActual = now()->format('F'); // "september"
    $anoActual = now()->format('Y'); // "2023"
    

    // Realizar la consulta para obtener el presupuesto del mes y año actual
    $budget = Budget::where('username', $username)
        ->where('month', $mesActual)
        ->where('year', $anoActual)
        ->first();

    return view('home.tracker.budget', ['budget' => $budget]);
}



   public function storeBudget(Request $request)
   {
       $budget = new Budget();
       $budget->username = auth()->user()->name ?? auth()->user()->username;
       $budget->month = now()->format('F');
       $budget->year = now()->format('Y');
       $budget->budget = $request->input('budget');
       $budget->save();
   
       return redirect('/budget')->with('success', 'Budget registered successfully.');
   }


   public function editBudget(string $id)
   {
       $budget = Budget::findOrFail($id);
       return view('home.tracker.update-budget',['data' => $budget]);
   }
public function updateBudget(Request $request, string $id)
{
   
    $budget = Budget::findOrFail($id);
    $budget->update($request->all());
    return redirect('/budget')->with('success', 'Budget updated successfully.');;
   
}


public function showAnalytics()
{
    $username = auth()->user()->name ?? auth()->user()->username;
    $mesActual = now()->format('m');
    $anoActual = now()->format('Y');
    // Obtener el mes anterior restando 1 al mes actual
    $mesAnterior = now()->subMonth()->format('m');
    $anoAnterior = now()->subMonth()->format('Y');
    $mesActual_budget = now()->format('F'); // "september"
    $mesPrevious_budget = now()->subMonth()->format('F'); // "september"
    
    $budget = Budget::where('username', $username)
    ->where('month', $mesActual_budget)
    ->where('year', $anoActual)
    ->first();

    $budget1 = Budget::where('username', $username)
    ->where('month', $mesPrevious_budget)
    ->where('year', $anoActual)
    ->first();
    

    $total_expenses = Expenses::where('username', $username)
    ->where('status', 'Activo')
    ->get();
    
    $expenses_current_month = Expenses::where('username', $username)
        ->where('status', 'Activo')
        ->whereRaw('MONTH(date) = ? AND YEAR(date) = ?', [$mesActual, $anoActual])
        ->get();

    $expenses_previous_month = Expenses::where('username', $username)
        ->where('status', 'Activo')
        ->whereRaw('MONTH(date) = ? AND YEAR(date) = ?', [$mesAnterior, $anoAnterior])
        ->get();


     $expenses_trend = Expenses::where('username', $username)
        ->where('status', 'Activo')
        ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as date, SUM(amount) as total')
        ->groupBy('date')
        ->get();

     // Extract labels and values from expenses_trend
     $labels2 = $expenses_trend->pluck('date');
     $values2 = $expenses_trend->pluck('total');


    // Obtener las categorías y contar la cantidad de gastos por categoría
    $categories = $expenses_current_month->groupBy('type')->map->sum('amount');
    $categories1 = $expenses_previous_month->groupBy('type')->map->sum('amount');
    
    // Obtener las etiquetas (nombres de las categorías) y los valores (cantidad de gastos)
    $labels = $categories->keys();
    $values = $categories->values();

    $labels1 = $categories1->keys();
    $values1 = $categories1->values();

    // Ordenar las etiquetas y valores de menor a mayor
    $sortedData = collect($labels)->zip($values)->sortBy(1);

    $sortedData1 = collect($labels1)->zip($values1)->sortBy(1);

    // Obtener las etiquetas y valores ordenados
    $labels = $sortedData->pluck(0);
    $values = $sortedData->pluck(1);

    $labels1 = $sortedData1->pluck(0);
    $values1 = $sortedData1->pluck(1);

      // Calcular el valor total de gastos
      $totalExpensesValue = $expenses_current_month->sum('amount');

      $totalExpensesValue1 = $expenses_previous_month->sum('amount');


    return view('home/analytics/expenses', [
        'labels' => $labels,
        'values' => $values,
        'labels1' => $labels1,
        'values1' => $values1,
        'labels2' => $labels2,
        'values2' => $values2,
        'budget' => $budget,
        'budget1' => $budget1,
        'totalExpensesValue' => $totalExpensesValue,
        'totalExpensesValue1' => $totalExpensesValue1,
    ]);
}
 
   
   

}
