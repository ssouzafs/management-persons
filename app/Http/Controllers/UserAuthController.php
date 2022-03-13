<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\Telephone;
use App\Models\User;
use App\Support\TypeOfTelephone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Auth;

class UserAuthController extends Controller
{
    public function showFormLogin()
    {
        if (\Auth::guard('web')->check()) {
            return redirect()->route('user.edit', ['id' => Auth::user()->id]);
        }
        return view('user.index');
    }

    /**
     * Realizar logout no sistema
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::guard('web')->logout();
        return redirect()->route('user.login');
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

        if (\Auth::guard('web')->attempt($credentials)) {
            $responseJson['redirect'] = route('user.edit', ['id' => Auth::user()->id]);
            return response()->json($responseJson);
        }

        $responseJson['fail'] = $this->message->error('Atenção, os dados informados não conferem!')->renderNotify();
        return response()->json($responseJson);

    }

    /**
     * Mostrar tela de se registrar.
     */
    public function showFormRegister()
    {
        return view('user.register');
    }

    /**
     * Realizar o cadastro do usuário e em seguida regirecioná-lo
     * para a página de edição do perfil.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function register(Request $request)
    {
        if (in_array('', $request->all())) {
            $responseJson['fail'] = $this->message->error('Oops! Todos os campos precisam ser informados.')->renderNotify();
            return response()->json($responseJson);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        // Verificar se o nome foi informado
        $errors = $validator->errors();
        if ($errors->has('name')) {
            $responseJson['fail'] = $this->message->error($errors->first('name'))->renderNotify();
            return response()->json($responseJson);
        }

        // verificar campo email
        if ($errors->has('email')) {
            $responseJson['fail'] = $this->message->error($errors->first('email'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando campo senha
        if ($errors->has('password')) {
            $responseJson['fail'] = $this->message->error($errors->first('password'))->renderNotify();
            return response()->json($responseJson);
        }

        $user = new User();
        $user->fill($request->all());

        if ($user->save()) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (\Auth::guard('web')->attempt($credentials)) {
                $responseJson['redirect'] = route('user.edit', ['id' => $user->id]);
                return response()->json($responseJson);
            }
        }
    }

    /**
     * Mostrar tela de edição de perfil do usuário.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Realizar update dos dados do usuário.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|void|null
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        // Pré tratamento de dados para serem validados
        $dataRequest = [
            'name' => $request->name,
            'cpf' => get_clear_field($request->cpf),
            'rg' => $request->rg,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'cell_phone' => $request->cell_phone,
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'state' => $request->state,
            'city' => $request->city
        ];

//        Verificando se todos os campos obrigatórios foram informados
        if (in_array('', $dataRequest)) {
            $responseJson['fail'] = $this->message
                ->error(
                    'Ooops. Os campos, nome, CPF, RG, email, senha, confirme senha, data de nascimento,
                            celular, CEP, logradouro, bairro, estado, cidade precisam ser informados!!!'
                )->renderNotify();

            return response()->json($responseJson);
        }

        // Não obrigatórios, mas válidados
        $dataRequest['password'] = $request->password;
        $dataRequest['password_confirmation'] = $request->password_confirmation;
        $dataRequest['genre'] = $request->genre;
        $dataRequest['phone'] = $request->phone;
        $dataRequest['complement'] = $request->complement;
        $dataRequest['number'] = $request->number;

        // Validando dados
        $validator = Validator::make($dataRequest, [
            'name' => 'required|min:3|max:191',
            'cpf' => 'required|cpf|unique:users,cpf,' . $id,
            'rg' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => mb_strlen($dataRequest['password']) > 0 ? [
                'required',
                'confirmed',
                Password::min(6)
            ] : 'nullable',
            'date_of_birth' => 'required|date', // ver depois
            'cell_phone' => 'required|celular_com_ddd',
            'phone' => mb_strlen($dataRequest['phone']) > 0 ? 'telefone_com_ddd' : 'nullable',
            'genre' => Rule::in(['female', 'male']),
            'zipcode' => mb_strlen(get_clear_field($dataRequest['zipcode'])) > 0 ? 'formato_cep' : 'nullable',
            'address' => 'required|min:3|max:255',
            'neighborhood' => 'required|min:3|max:255',
            'complement' => mb_strlen($dataRequest['complement']) > 0 ? 'max:255' : 'nullable',
            'number' => mb_strlen($dataRequest['number']) > 0 ? 'max:255' : 'nullable',
            'city' => 'required|min:3|max:255',
            'state' => 'required|min:2|max:255'
        ]);

        // Verificar se o nome foi informado
        $errors = $validator->errors();
        if ($errors->has('name')) {
            $responseJson['fail'] = $this->message->error($errors->first('name'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificar CPF
        if ($errors->has('cpf')) {
            $responseJson['fail'] = $this->message->error($errors->first('cpf'))->renderNotify();
            return response()->json($responseJson);
        }
        // Verificar RG
        if ($errors->has('rg')) {
            $responseJson['fail'] = $this->message->error($errors->first('rg'))->renderNotify();
            return response()->json($responseJson);
        }

        // verificar campo email
        if ($errors->has('email')) {
            $responseJson['fail'] = $this->message->error($errors->first('email'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando senha
        if ($errors->has('password')) {
            $responseJson['fail'] = $this->message->error($errors->first('password'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando data de aniversário
        if ($errors->has('date_of_birth')) {
            $responseJson['fail'] = $this->message->error($errors->first('date_of_birth'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando celular
        if ($errors->has('cell_phone')) {
            $responseJson['fail'] = $this->message->error($errors->first('cell_phone'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando Telefone fixo
        if ($errors->has('phone')) {
            $responseJson['fail'] = $this->message->error($errors->first('phone'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando gênero
        if ($errors->has('genre')) {
            $responseJson['fail'] = $this->message->error($errors->first('genre'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando CEP
        if ($errors->has('zipcode')) {
            $responseJson['fail'] = $this->message->error($errors->first('zipcode'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando Endereço
        if ($errors->has('address')) {
            $responseJson['fail'] = $this->message->error($errors->first('address'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando Bairro
        if ($errors->has('neighborhood')) {
            $responseJson['fail'] = $this->message->error($errors->first('neighborhood'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando complemento
        if ($errors->has('complement')) {
            $responseJson['fail'] = $this->message->error($errors->first('complement'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando número
        if ($errors->has('number')) {
            $responseJson['fail'] = $this->message->error($errors->first('number'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando cidade
        if ($errors->has('city')) {
            $responseJson['fail'] = $this->message->error($errors->first('city'))->renderNotify();
            return response()->json($responseJson);
        }

        // Verificando estado
        if ($errors->has('state')) {
            $responseJson['fail'] = $this->message->error($errors->first('state'))->renderNotify();
            return response()->json($responseJson);
        }

        /** @var User $user */
        $user = User::find($id);
        $city = $user->city();
        if ($city) {
            $city->name = $dataRequest['city'];
            $state = $city->state();
            $state->name = $dataRequest['state'];
            $state->save();
            $city->save();
        }

        if (!$city) {
            $state = new State();
            $city = new City();
            $state->name = $dataRequest['state'];
            $state->save();
            $city->name = $dataRequest['city'];
            $city->state_id = $state->id;
            $city->save();
            $user->city_id = $city->id;
        }
        if (!empty($dataRequest['password'])) {
            $user->password = $dataRequest['password'];
        }

        $user->fill($dataRequest);
        $updatedAtBeforeSave = $user->updated_at;

        // verificando se dados de usuário foram persistidos
        if ($user->save()) {

            /** se houve alteração retorna response json com a mensagem de sucesso. Senão, retorna nulo */
            $noDataChanged = ($user->updated_at == $updatedAtBeforeSave);
            if ($noDataChanged) {
                return null;
            }
            $responseJason['success'] = $this->message->info('Tudoo certo!!! Seu perfil já foi atualizado.')->renderNotify();
            return response()->json($responseJason);
        }
    }

}
