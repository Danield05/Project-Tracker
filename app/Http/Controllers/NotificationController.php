<?php

namespace App\Http\Controllers;
use App\Notifications\ExpenseAddedNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expenses;


class NotificationController extends Controller
{
    // Mostrar la vista de notificación por correo
    public function showEmailNotification()
    {
        return view('email_notification');
    }

    // Enviar la notificación por correo
    public function sendEmailNotification(Request $request, $userId)
    {
         // Encuentra al usuario al que deseas enviar la notificación
        $user = User::find($userId); // Reemplaza $userId con el ID del usuario

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Obtén el objeto de gasto que deseas incluir en la notificación
        $expense = Expenses::find($request->input('expense_id')); // Reemplaza 'expense_id' con el nombre correcto del campo que almacena el ID del gasto en tu solicitud

        if (!$expense) {
            return response()->json(['error' => 'Expense not found'], 404);
        }

        // Envía la notificación por correo
        $user->notify(new ExpenseAddedNotification($expense));

        return response()->json(['message' => 'Notification sent successfully']);
       
    }
 }

