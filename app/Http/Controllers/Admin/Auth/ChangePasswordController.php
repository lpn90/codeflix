<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
       // $this->middleware('guest');
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $email = \Auth::user()->email;
        return view('admin.auth.change-password', compact('email'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function updatePassword(Request $request)
    {

        $input = $request->all();
        $id = \Auth::user()->id;

        if (! Hash::check($input['password_old'],\Auth::user()->password)){
            return redirect(route('admin.users.change-password'))->withErrors(['password_old' => 'Senha atual está incorreta'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'email'      => "required|max:255|email|unique:users,email,$id",
            'password'   => ["required"],
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $input['password'] = bcrypt($input['password']);

        $this->repository->update($input, $id);
        $request->session()->flash('message', 'Senha do Usuário alterada com Sucesso!');



        return redirect()->route('admin.dashboard');
    }
}
