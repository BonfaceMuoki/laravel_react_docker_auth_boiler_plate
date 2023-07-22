<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;

class PasswordResetRequestController extends Controller
    {
    //
    public function sendPasswordResetEmail(Request $request)
        {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'reset_password_url' => 'required|url',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            }
        // If email does not exist
        if (! $this->validEmail($request->email)) {
            return response()->json([
                'message' => 'Email does not exist.'
            ], Response::HTTP_NOT_FOUND);
            } else {
            // If email exists
            $this->sendMail($request->email, $request->reset_password_url);
            return response()->json([
                'message' => 'Check your inbox, we have sent a link to reset email.'
            ], Response::HTTP_OK);
            }
        }

    public function resetPasswordForm()
        {
        return view('Email.resetPasswordform');
        }
    public function sendMail($email, $callbackurl)
        {
        $token = $this->generateToken($email);
        Mail::to($email)->send(new SendMail($token, $callbackurl));
        }

    public function validEmail($email)
        {
        return ! ! User::where('email', $email)->first();
        }

    public function generateToken($email)
        {
        $isOtherToken = DB::table('password_resets')->where('email', $email)->first();

        if ($isOtherToken) {
            return $isOtherToken->token;
            }

        $token = Str::random(80);
        ;
        $this->storeToken($token, $email);
        return $token;
        }

    public function storeToken($token, $email)
        {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        }
    }