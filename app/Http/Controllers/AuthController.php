<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Session;
use Crypt;

/**
 * Class AuthController.
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector|View
     */
    public function verifyAccount(Request $request)
    {
        $token = $request->get('token', null);

        if (empty($token)) {
            Session::flash('error', 'Token non existant.');

            return redirect('login');
        }

        try {
            $token = Crypt::decrypt($token);
            list($userId, $activationCode) = $result = explode('|', $token);

            if (count($result) < 2) {
                Session::flash('error', 'Token non existant.');

                return redirect('login');
            }

            /** @var User $user */
            $user = User::whereActivationCode($activationCode)->findOrFail($userId);

            if (empty($user)) {
                Session::flash('error', 'Ce jeton d\'activation de compte n\'est pas valide.');

                return redirect('login');
            }
            if ($user->is_active) {
                Session::flash('success', 'Votre compte déjà activé. Veuillez vous connecter.');

                return redirect('login');
            }

            $user->is_active = true;
            $user->email_verified_at = Carbon::now();
            $user->save();

            notify()->success('Votre compte est activé avec succès. ', 'Activation de compte');
            Session::flash('success', 'Votre compte est activé avec succès. Veuillez vous connecter.');

            return redirect('login');

        } catch (Exception $e) {
            Session::flash('error', 'Quelque chose s\'est mal passé');

            return redirect('login');
        }
    }
}
