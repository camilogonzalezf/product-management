<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
class CustomersController extends Controller
{

    public function index()
        {
            $customers = Customers::all();
            return view('register-person', ['customers' => $customers]);
        }
    public function store(Request $request)
        {
            $request->validate([
                'name_customer' => 'required|min:3',
                'email' => 'required|email',
            ]);
            $customer = new Customers;
            $customer->name_customer = $request->name_customer;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->number_phone = $request->number_phone;
            $customer->save();
            return redirect()->route('customers')->with('success', 'Persona registrada correctamente');
        }

        public function destroy($id){
            $customer = Customers::find($id);
            $customer->delete();
            return redirect()->route('customers')->with('success', 'Persona eliminada');
        }

}
