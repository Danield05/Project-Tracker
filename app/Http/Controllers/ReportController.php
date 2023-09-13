<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expenses;
use Barryvdh\facade\pdf;

class ReportController extends Controller
{
    public function show()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();
        
        // Verificar si el usuario tiene un presupuesto para el mes actual
        $budget = Budget::where('username', $user->name ?? $user->username)
            ->where('month', now()->format('F'))
            ->where('year', now()->format('Y'))
            ->first();
    
        if ($budget) {
            // Calcular el total de gastos para el mes actual
            $totalExpenses = Expenses::where('username', $user->name ?? $user->username)
                ->where('status', 'Activo')
                ->whereRaw('MONTH(date) = ? AND YEAR(date) = ?', [now()->format('m'), now()->format('Y')])
                ->sum('amount');
    
            // Calcular el presupuesto restante
            $remainingBudget = $budget->budget - $totalExpenses;
    
            // Verificar si se ha excedido el presupuesto
            $budgetExceeded = $remainingBudget < 0;
        } else {
            // No se encontró un presupuesto para el mes actual
            $totalExpenses = 0;
            $remainingBudget = 0;
            $budgetExceeded = false;
        }
    
        return view('reports.show', [
            'budget' => $budget,
            'totalExpenses' => $totalExpenses,
            'remainingBudget' => $remainingBudget,
            'budgetExceeded' => $budgetExceeded,
        ]);

}    
}
    