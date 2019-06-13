<?php

namespace App\Http\Controllers\Api\SMS;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SMS\VerifyMobile;
use App\CodeGenerator\MobileCodesGenerator;
use App\Http\Requests\VerifyMobile\VerifyMobileStore;

class VerifyMobileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(VerifyMobileStore $request, User $user)
    {
        if ($request->code === $user->mobile_verification_code) {
            $user->mobile_verified_at = Carbon::now();
            $user->mobile_verification_code = null;
            $user->save();
        } else {
            abort(422, 'Codi incorrecte');
        }
    }

    public function send(Request $request, User $user)
    {
        $code = MobileCodesGenerator::generate();
        $user->mobile_verification_code = $code;
        $user->save();
        $user->notify(new VerifyMobile($code));
    }
}
