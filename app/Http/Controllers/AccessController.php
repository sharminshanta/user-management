<?php
/**
 * Write something about the purpose of this file
 *
 * @author Sharmin Shanta <shantaex81@gmail.com>
 * @url http://www.sharminshanta.com
 */

namespace App\Http\Controllers;

use Besofty\Web\Accounts\Models\UsersModel;
use Illuminate\Http\Request;

/**
 * Class AccessController
 * @package App\Http\Controllers
 */
class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signupProcess(Request $request)
    {
        $profileData = $request->all()['profile'];
        $userData = $request->all()['user'];
        $postData = array_merge($profileData, $userData);

        //Set rules for the post data
        $dataRules = [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'email_address' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ];

        //Check the valid post data
        $validator = $this->userValidation($postData, $dataRules);

        if ($validator->fails()) {
            \Session::flash('error', 'Sorry, Something went wrong');
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    $validator->messages()
                );
        }

        return redirect('/');

        /*$postData = $request->all();
        $userModel = new UsersModel();
        $recentUser = $userModel->createNewUser($postData);*/

        //$user = $userModel->details($recentUser['uuid'], true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Validation\Validator
     */
    private function userValidation(array $data, array $rules)
    {
        $messages = [
            'first_name.required' => 'First name is required',
            'first_name.max' => 'First name cannot be more than 15 characters',
            'last_name.required' => 'Last name is required',
            'last_name.max' => 'Last name cannot be more than 15 characters',
            'email_address.required' => 'Email is required',
            'email_address.email' => 'Invalid email adderss',
            'email_address.unique' => 'This email address already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password_confirmation.required' => 'Confirm password is required',
            'password_confirmation.same' => 'Confirm password and password does not match',
            'password_confirmation.min' => 'Password must be at least 6 characters',
        ];

        return \Validator::make($data, $rules, $messages);
    }
}
