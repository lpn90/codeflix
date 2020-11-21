<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class UserSettingsController extends Controller
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
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        //Verifica a URL de Origem
        //$origin = $request->session()->previousUrl();

        $email = \Auth::user()->email;
        return view('admin.auth.settings', compact('email'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function update(Request $request)
    {

        $data = array_except($request->all(), ['email']) ;
        $id = \Auth::user()->id;

        /*
        if (! Hash::check($input['password_old'],\Auth::user()->password)){
            return redirect(route('admin.user_settings.edit'))->withErrors(['password_old' => 'Senha atual está incorreta'])->withInput();
        }
        */
        $validator = Validator::make($request->all(), [
           // 'email'      => "required|max:255|email|unique:users,email,$id",
            'password'   => ["required"],
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('admin/users/change-password')
                ->withErrors($validator)
                ->withInput();
        }
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Senha do Usuário alterada com Sucesso!');



        return redirect()->route('admin.dashboard');
    }
}
