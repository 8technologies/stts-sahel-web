<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var string
     */
    protected $loginView = 'admin::login';

    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function getLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view($this->loginView);
    }

    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Get a validator for an incoming login request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function loginValidator(array $data)
    {
        return Validator::make($data, [
            $this->username()   => 'required',
            'password'          => 'required',
        ]);
    }

    /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(config('admin.route.prefix'));
    }

    /**
     * User setting page.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function getSetting(Content $content)
    {
        $form = $this->settingForm();
        $form->tools(
            function (Form\Tools $tools) {
                $tools->disableList();
                $tools->disableDelete();
                $tools->disableView();
            }
        );

        return $content
            ->title(trans('admin.user_setting'))
            ->body($form->edit(Admin::user()->id));
    }

    /**
     * Update user setting.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putSetting()
    {
        return $this->settingForm()->update(Admin::user()->id);
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $class = config('admin.database.users_model');
        $currentUser = auth()->user(); // Assuming you're using the default auth system
        $currentPassword = $currentUser->password;;

        $form = new Form(new $class());

        $form->text('username', trans('admin.username'))->rules('required');
        $form->text('name', trans('admin.name'))->rules('required');
        $form->email('email', trans('admin.email'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->html('<div class="input-group">
                    <span class="input-group-addon">
                    <i class="fa fa-eye" id="eye-icon"></i></span>
                    <input id="password-input" type="text" class="form-control password" name="password" placeholder="' . $currentPassword . '" required >

                </div>','<span style="color:red;">*</span>'. trans('admin.password'))->rules('confirmed|required');
        $form->html('<div class="input-group">
            <span class="input-group-addon">
            <i class="fa fa-eye" id="eye-icon1"></i></span>
            <input id="password-confirm" type="text" class="form-control password" name="password" autocomplete="current-password" placeholder="'. $currentPassword .'" required >

        </div>', '<span style="color:red;">*</span>'.trans('admin.password_confirmation'))->default(function ($form) {
            return $form->model()->password;
        });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            // Access password and confirmation from the request
            $password = request('password');
            $passwordConfirmation = request('password_confirmation');

            // Validate that the password matches the confirmation
            // if ($password != $passwordConfirmation) {
            //     admin_error('Error', 'Passwords do not match.');
            //     return back()->withInput();
            // }

            // Hash and save the password to the database
            if ($password) {
                $form->password = $password;
                Log::info([$form->password]);
                
            }
            if ($form->password && $form->model()->password != $form->password) {
                $form->model()->password = Hash::make($form->password);
                Log::info([$form->password]);
            }
            else{
                Log::info([$form->password]);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        //disable check boxes
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable view check boxes 
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->disableCreatingCheck();
      
        //javascript to make the password visible
        $form->html('<script>
        document.getElementById("eye-icon").addEventListener("click", function() {
            var passwordInput = document.getElementById("password-input");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                passwordInput.type = "text"; // Show password
                
            } else {
                passwordInput.type = "password"; // Hide password
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
        document.getElementById("eye-icon1").addEventListener("click", function() {
            var passwordInput = document.getElementById("password-confirm");
            var eyeIcon = document.getElementById("eye-icon1");
            if (passwordInput.type === "password") {
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                passwordInput.type = "text"; // Show password
                
            } else {
                passwordInput.type = "password"; // Hide password
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>');


        return $form;
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? trans('auth.failed')
            : 'These credentials do not match our records.';
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('admin.route.prefix');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        admin_toastr(trans('admin.login_successful'));

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Admin::guard();
    }
}
