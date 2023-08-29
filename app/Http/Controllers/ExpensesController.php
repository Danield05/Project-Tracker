<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expenses;

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
        $expense->save();
    
        return redirect('/expenses/create')->with('success', 'Expense registered successfully.');
    }
    
   public function show(){
    $username = auth()->user()->name ?? auth()->user()->username; // Obtener el username de usuario actual
    $expenses = Expenses::where('username', $username)->get(); // Filtrar por el nombre de usuario
    //return para vistas en blade
    return view('home.tracker.view-expenses',['expenses' => $expenses]);
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
    

}
