<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{

    /**
     * Retornar página de login, ou página home se usuário
     * estiver autenticado
     */
    public function showFormLogin()
    {
        if (\Auth::guard('admin')->check()) {
           return redirect()->route('admin.home');
        }
        return view('admin.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => true
        ];

        // Verificando se há campos vázios
        if (in_array('', $credentials)) {
            $responseJson['fail'] = $this->message->error('Por favor, informe todos os campos!')->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando se o e-mail informado é válido
        if (!filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
            $responseJson['fail'] = $this->message->error('Atenção, o e-mail informado não possui formato válido!')->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando se os dados conferem com a base de dados [Se TRUE = Logado].
        if (\Auth::guard('admin')->attempt($credentials)) {
            $responseJson['redirect'] = route('admin.home');
            return response()->json($responseJson);
        }

        $responseJson['fail'] = $this->message->error('Atenção, os dados informados não conferem!')->renderNotify();
        return response()->json($responseJson);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    /**
     * Retornar view de edição do cliente.
     * @param $id
     */
    public function editClient($id)
    {
        $client = User::find($id);
        return view('admin.clients.edit', ['client' => $client]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function updateClient($id, Request $request)
    {
        $client = User::find($id);
        $client->active = $request->status;

        if ($client->save()) {
            $responseJason['success'] = $this->message->success("Cliente agora está {$client->status() }!!!")->renderNotify();;
            return response()->json($responseJason);
        }
        $responseJason['fail'] = $this->message
            ->criticalError('Oops. Operação parece não ter realizado com sucesso. Tente novamente.')
            ->renderNotify();;

    }

    /**
     * @param Request $request
     */
    public function home(Request $request)
    {
        $clients = User::orderBy('created_at', 'DESC')->get();
        return view('admin.dashboard', ['clients' => $clients]);
    }

    /**
     * @return mixed
     */
    public function loadData()
    {
        $admins = Admin::orderBy('created_at', 'DESC')->get(['id', 'name', 'email', 'created_at']);
        return DataTables::of($admins)->addColumn('action', function ($admins) {
            return view('admin.member.buttons-datatables', ['admin' => $admins]);
        })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Verificando se todos os campos obrigatórios foram informados
        if (in_array('', $request->all())) {
            $responseJson['fail'] = $this->message
                ->error(
                    'Ooops. Os campos, nome completo, email, senha, confirme senha, precisam ser informados!!!'
                )->renderNotify();;

            return response()->json($responseJson);
        }

        // Validando dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        // Verificar se o nome foi informado
        $errors = $validator->errors();
        if ($errors->has('name')) {
            $responseJson['fail'] = $this->message->error($errors->first('name'))->renderNotify();;
            return response()->json($responseJson);
        }

        // verificar campo email
        if ($errors->has('email')) {
            $responseJson['fail'] = $this->message->error($errors->first('email'))->renderNotify();;
            return response()->json($responseJson);
        }

        // Verificando campo senha
        if ($errors->has('password')) {
            $responseJson['fail'] = $this->message->error($errors->first('password'))->renderNotify();;
            return response()->json($responseJson);
        }

        // Populando Objeto
        $admin = new Admin();
        $admin->fill($request->all());
        $admin->password = $request->password;

        // verificando se dados de usuário foram persistidos
        if ($admin->save()) {
            $responseJason['success'] = $this->message->success('Membro administrador cadastrado com sucesso!!!')->renderNotify();;
            return response()->json($responseJason);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.member.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validando dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => mb_strlen($request->password) > 0 ? [ 'required', 'confirmed', Password::min(6) ] : 'nullable',
        ]);

        // Verificar se o nome foi informado
        $errors = $validator->errors();
        if ($errors->has('name')) {
            $responseJson['fail'] = $this->message->error($errors->first('name'))->renderNotify();;
            return response()->json($responseJson);
        }

        // verificar campo email
        if ($errors->has('email')) {
            $responseJson['fail'] = $this->message->error($errors->first('email'))->renderNotify();;
            return response()->json($responseJson);
        }

        // Verificando campo senha
        if ($errors->has('password')) {
            $responseJson['fail'] = $this->message->error($errors->first('password'))->renderNotify();;
            return response()->json($responseJson);
        }

        // Populando Objeto
        $admin = Admin::find($id);
        $admin->fill($request->all());
        $admin->active = $request->status;
        $admin->password = $request->password;

        // verificando se dados de usuário foram persistidos
        if ($admin->save()) {
            $responseJason['success'] = $this->message->success('Membro administrador cadastrado com sucesso!!!')->renderNotify();;
            return response()->json($responseJason);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin->delete()) {
            $responseJason['success'] = $this->message->success('Membro administrador deletado com sucesso!!!')->renderNotify();;
            return response()->json($responseJason);
        }
        $responseJson['fail'] = $this->message->error('Não foi possível deletar esse registro');
        return response()->json($responseJson);
    }
}
