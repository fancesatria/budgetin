<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SettingsController extends Controller
{
    public function index() {
        confirmDelete(__('settings.delete_account_confirm'));
        return(view('pages.user.settings',[
            'title' => __('nav.settings'),
            'pushEnabled' => Auth::user()->pushSubscriptions()->exists()
        ]));
    }

    public function changePassword(Request $request){
        $request->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'different:currentPassword'],
            'confirmPassword' => ['required', 'same:newPassword']
        ]);

        $user = Auth::user();

        if(!Hash::check($request->currentPassword, $user->password)){
            return back()->withInput()->with('error', __('settings.current_password_incorrect'));
        }

        $user->update([
            'password' => Hash::make($request->newPassword)
        ]);

        toast()->success('Password updated!');
        return redirect()->back()->with('success', 'Password updated!');
    }

    public function deleteAccount(Request $request){
        // ini nanti kasi minta password biar ga langsung delete
        $request->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if(!Hash::check($request->password, $user->password)){
            return back()->withInput()->with('error', __('settings.current_password_incorrect'));
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect()->route('login');

    }

    public function deleteGoogleAccountCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')
                ->redirectUrl(config('services.google_delete.redirect'))
                ->user();

            $user = Auth::user();

            if (!$user) {
                return redirect()
                    ->route('login')
                    ->with('error', __('settings.google_verification_failed'));
            }

            if (!$user->google_id) {
                return redirect()
                    ->route('settings.index')
                    ->with('error', __('settings.google_account_not_match'));
            }

            if ($user->google_id !== $googleUser->getId()) {
                return redirect()
                    ->route('settings.index')
                    ->with('error', __('settings.google_account_not_match'));
            }
            $user->delete();
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('success', __('settings.account_deleted'));

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('settings.index')
                ->with('error', __('settings.google_verification_failed'));
        }
    }

    public function redirectToGoogleForDeletion()
    {
        return Socialite::driver('google')
            ->redirectUrl(config('services.google_delete.redirect'))
            ->with([
                'prompt' => 'select_account',
            ])
            ->redirect();
    }
}
