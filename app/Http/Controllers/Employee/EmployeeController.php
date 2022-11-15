<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function edit_profile($id)
    {
        $user = Employee::findOrFail($id);
        return view('employee.profiles.edit', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'same:confirm-password'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = Employee::findOrFail($id);
        $user->update($input);
        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $fileName = $profile_pic->getClientOriginalName();
            $uploadDir = 'uploads/profiles/employees/' . $id;
            $profile_pic->move($uploadDir, $fileName);
            $user->profile_pic = $uploadDir . '/' . $fileName;
            $user->save();
        }
        return redirect()->back()->with('success',trans('main.profile_info_updated'));
    }
}
