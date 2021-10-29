<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\contracts\UserRepositoryInterface;
use App\User;
use Socialite;
use App\Services\SocialFacebookAccountService;

class SocialController extends Controller
{
    protected $user;
    protected $model;

    /**
     * SocialController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param User $userModel
     */
    public function __construct(UserRepositoryInterface $userRepository, User $userModel){
        $this->user = $userRepository;
        $this->model = $userModel;
    }
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/home');
    }
}
