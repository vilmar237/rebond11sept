<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Http\Requests\Admin\Employee\StoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Helper\Reply;
use App\Helper\Files;
use App\Models\User;
use Hash;
use Auth;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        //$roles = Role::where('name', '<>', 'Customer')->get();
        //dd($roles->pluck('name')->toArray());
        //$users = User::all();
        //return view('admin.user.view')->with('users', $users);
        return $dataTable->render('admin.user.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $this->pageTitle = __('app.add') . ' ' . __('app.employee');
        abort_if(!auth()->user()->permission('users.create'),403, __('Vous n\'avez pas de droit d\'accéder à cette page.'));

        $this->roles = Role::all();

        if (request()->ajax()) {
            $html = view('admin.user.ajax.create', $this->data)->render();
            return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle]);
        }
        
        $this->view = 'admin.user.ajax.create';

        return view('admin.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        abort_if(!auth()->user()->permission('users.create'),403, __('Vous n\'avez pas de droit d\'accéder à cette page.'));

        DB::beginTransaction();
        try {

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->mobile;
            $user->gender = $request->gender;

            $roleName = Role::where('id',$request->role)->first();

            $user->role = $roleName->name;

            $user->assignRole($roleName);



            if ($request->has('login')) {
                $user->login = $request->login;
            }

            if ($request->has('email_notifications')) {
                $user->email_notifications = $request->email_notifications == "yes" ? 1 : 0;
            }

            if ($request->hasFile('image')) {
                Files::deleteFile($user->avatar, 'avatar');
                $user->avatar = Files::upload($request->image, 'avatar', 300);
            }

            $user->save();

            // Commit Transaction
            DB::commit();

        } catch (\Swift_TransportException $e) {
            // Rollback Transaction
            DB::rollback();
            return Reply::error('Veuillez configurer les détails SMTP pour ajouter un membre. Visiter Paramètres -> Paramètres de notification pour configurer smtp', 'smtp_error');
        } catch (\Exception $e) {
            Log::error($e);
            // Rollback Transaction
            DB::rollback();
            return Reply::error('Une erreur s\'est produite lors de l\'insertion des données. Veuillez réessayer ou contacter l\'assistance');
        }
        
        return Reply::successWithData(__('messages.employeeAdded'), ['redirectUrl' => route('user.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->employee = User::withoutGlobalScope('active')->findOrFail($id);

        abort_if(!auth()->user()->permission('users.edit'),403, __('Vous n\'avez pas de droit d\'accéder à cette page.'));

        $this->pageTitle = __('app.update') . ' ' . __('app.employee');

        $this->roles = Role::all();

        if (request()->ajax()) {
            $html = view('admin.user.ajax.edit', $this->data)->render();
            return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle]);
        }

        $this->view = 'admin.user.ajax.edit';

        return view('admin.user.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::withoutGlobalScope('active')->findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;

            if ($request->password != '') {
                $user->password = bcrypt($request->password);
            }

            $user->phone = $request->mobile;
            $user->gender = $request->gender;

            if (request()->has('status')) {
                $user->status = $request->status;
            }

            if($id != user()->id){
                $user->login = $request->login;
            }

            if ($request->has('email_notifications')) {
                $user->email_notifications = $request->email_notifications;
            }

            if ($request->image_delete == 'yes') {
                Files::deleteFile($user->image, 'avatar');
                $user->avatar = null;
            }

            if ($request->hasFile('image')) {

                Files::deleteFile($user->avatar, 'avatar');
                $user->avatar = Files::upload($request->image, 'avatar', 300);
            }

            $roleName = Role::where('id',$request->role)->first();

            $user->role = $roleName->name;

            $user->syncRoles($roleName);

            $user->save();

            if (user()->id == $user->id) {
                session()->forget('user');
            }
            // Commit Transaction
            DB::commit();

        } catch (\Swift_TransportException $e) {
            // Rollback Transaction
            DB::rollback();
            return Reply::error('Veuillez configurer les détails SMTP pour ajouter un membre. Visiter Paramètres -> Paramètres de notification pour configurer smtp', 'smtp_error');
        } catch (\Exception $e) {
            Log::error($e);
            // Rollback Transaction
            DB::rollback();
            return Reply::error('Une erreur s\'est produite lors de l\'insertion des données. Veuillez réessayer ou contacter l\'assistance');
        }

        return Reply::successWithData(__('messages.updateSuccess'), ['redirectUrl' => route('user.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withoutGlobalScope('active')->findOrFail($id);

        abort_if(!auth()->user()->permission('users.delete'),403, __('Vous n\'avez pas de droit d\'accéder à cette page.'));

        if ($user->hasRole('Super') && !in_array('Super', user_roles())) {
            return Reply::error(__('messages.adminCannotDelete'));
        }

        $user->roles()->detach();

        User::withoutGlobalScope('active')->where('id', $id)->delete();

        return Reply::success(__('messages.employeeDeleted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = User::find($id);
        return view('admin.user.profile')->with([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'gender' => 'required|in:male,female,others',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'address' => 'max:200',
            'facebook_id' => 'max:200',
            'twitter_id' => 'max:200',
            'google_id' => 'max:200',
            'about' => 'max:300'
        ];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:jpeg,jpg,png,JPG,JPEG,PNG';
        }

        if (!empty($request->input('phone'))) {
            $rules['phone'] = 'numeric|max:999999999999999';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all)
                ->withErrors($validator)
                ->with('user', $user);
        } else {
            $user = User::find($id);
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->gender = $request->input('gender');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->facebook_id = $request->input('facebook_id');
            $user->twitter_id = $request->input('twitter_id');
            $user->google_id = $request->input('google_id');
            $user->about = $request->input('about');

            if ($request->hasFile('avatar')) {
                if(!in_array($user->avatar, ['boy.png', 'boy-1.png', 'girl.png', 'girl-1.png', 'girl-2.png','man.png', 'man-1.png', 'man-2.png', 'man-3.png'])){
                    Storage::delete('public/avatars/'.$user->avatar);
                }
                $path = $request->file('avatar')->store('','avatar');
                $user->avatar = $path;
            }

            $user->save();
            notify()->success('Le profil utilisateur a été mis à jour. ', 'Profil');
            return redirect()->back()->with('success','Le profil utilisateur a été mis à jour');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function setting($id)
    {
        return view('admin.user.setting');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_setting(Request $request, $id)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            notify()->error('Votre mot de passe actuel ne correspond pas au mot de passe. ', 'Mot de passe');
            return redirect()->back()->with("error","Votre mot de passe actuel ne correspond pas au mot de passe.");
        }

        if(strcmp($request->get('current_password'), $request->get('password')) == 0){
            // Current password and new password same
            notify()->error('Le nouveau mot de passe ne peut pas être le même que votre mot de passe actuel. ', 'Mot de passe');
            return redirect()->back()->with("error","Le nouveau mot de passe ne peut pas être le même que votre mot de passe actuel.");
        }

        $user = User::find($id);
        $rules = [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('user', $user);
        } else {
            $user = User::find($id);
            $user->password = bcrypt($request->input('password'));

            $user->save();

            notify()->success('Mot de passe changé avec succès! ', 'Mot de passe');
            return redirect()->back()->with("success","Mot de passe changé avec succès!");
            return redirect('/admin');
        }
    }
}
