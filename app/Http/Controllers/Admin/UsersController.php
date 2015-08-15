<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Http\Requests\Admin\RegisterFormRequest;
use App\Http\Requests\EditUserFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {

        $this->flasher = $flasher;
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with(compact('users'));
    }

    public function showRegister()
    {
        return view('admin.users.register');
    }

    public function postRegistration(RegisterFormRequest $request)
    {
        User::create($request->all());

        $this->flasher->success('User added', 'Crack a bottle of champagne');

        return redirect()->to('/admin/users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit')->with(compact('user'));
    }

    public function update($id, EditUserFormRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $this->flasher->success('Info updated', 'Pat yourself on the back.');

        return redirect()->to('/admin/users');
    }

    public function delete($id)
    {
        if(User::all()->count() < 2) {
            $this->flasher->error('No no no!', 'You can not delete the final user');
            return redirect()->back()->withErrors(['delete' => 'Can not delete final user']);
        }

        $user = User::findOrFail($id);

        $user->delete();

        $this->flasher->success('User deleted', 'People come, people go.');

        return redirect()->to('/admin/users');
    }

    public function showResetPassword()
    {
        return view('admin.users.resetpassword');
    }

    public function doResetPassword(ResetPasswordFormRequest $request)
    {
        if(! Auth::validate(['email' => Auth::user()->email, 'password' => $request->get('current_password')])) {
            return back()->withErrors(['current_password' => 'Invalid password']);
        }

        $user = Auth::user();
        $user->password = $request->get('password');
        $user->save();

        $this->flasher->success('Password Reset!', 'Keeping a tight ship matey! I like it!');

        return redirect()->to('/admin');
    }
}
