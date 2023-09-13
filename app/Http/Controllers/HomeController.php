<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expenses; // Asegúrate de importar el modelo Expenses con el nombre correcto.

class HomeController extends Controller
{
    public function index()
    {
        // Obtiene el usuario autenticado
        $user = auth()->user();
        
        // Verifica si el usuario tiene un presupuesto para el mes actual
        $budget = Budget::where('username', $user->name ?? $user->username)
            ->where('month', now()->format('F'))
            ->where('year', now()->format('Y'))
            ->first();

        // Calcula el total de gastos para el mes actual
        $totalExpenses = Expenses::where('username', $user->name ?? $user->username)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        // Calcula el presupuesto restante
        $remainingBudget = $budget->budget - $totalExpenses;

        // Verifica si se ha excedido el presupuesto
        $budgetExceeded = $remainingBudget < 0;

        return view('home.index', [
            'budget' => $budget,
            'totalExpenses' => $totalExpenses,
            'remainingBudget' => $remainingBudget,
            'budgetExceeded' => $budgetExceeded,
        ]);
    }
}
