<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct(){
         $this->middleware('admin')->only(['admin']);
     }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function admin(){
       $user= Auth::user();
       //if($user->email('juan@juan.es')){
            return response()->json(['user' => Auth::user], 200);
       //}
    }
    function login(Request $request) {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
    ], 200);
    }
    function protected(){
        return response()->json(['user' => Auth::user()],200);
    }
    function register(Request $request){
        try{
            User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) 
            ]);
        }catch(\Exception $e){
             return response()->json(['message'=>'User not created'],418);
        }
        return response()->json(['message'=>'User created'],201);
    }
    function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Logged out']);
    }
}
function cogeParam(Request $request){
    
}
/*Token admin:
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTJmNjM5NzE4MWFmZDBiZGJjNzc3Mzg4ODBkN2M2ZjAyZTNmNzc0ODZhNDEzZDY2YWI3NjQ2NmJjZmI1YmJhMTRmNzY0MmQ1Zjk1ZjdhYmQiLCJpYXQiOjE2NzM1OTk3MjQuODc4Njg2LCJuYmYiOjE2NzM1OTk3MjQuODc4Njg4LCJleHAiOjE3MDUxMzU3MjQuODcyMjkyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.UvNJPt_CZ-Mf99N1cpB68j-ErPFzlBGw1VXfHEacvST4y2bKfdKGTtqzAqdbG6lV9I68SHYWXFZYZkpcsbsuRtCTH9vwdLSaC8O-qkvB2syX0_89bDm7gpUpESBfZE8hzcffZgSzXEQshMvPNlRy3BH5OS_ihHp7Bj9XW5asZ_ChHf78sBER0Z2kM_AHX9JUs2bTnEatkMC0-5sbEZiHDjS0489uTuaotenQxiJ7Z3I4aoeHgPTx40KPU_BgtLTYLUo08JfQSLhq5ijOHmGEIY2mdLiWzj-6KCnBBzsYPnzQpmsCf1048onEjukhh5B0EqHFz1nKEsiFNdeega3L5ladDBhxqwBVTjOxAUn6TWhh9o2PPcg8KSCRGJiM_XuUL99BrZ3w1m_WBfHLn1NPxo6eYqL7luUIK1j2f643pf_600-m-AYy9R9PfBjvCXs38SakbLzKUP2U77Ulnd-14mTNx5jcI5rMLc2j6oBrZ_-_aEq6MP7NS9iDKWxa92xTysbffpsb3DsU1ZZuIfvvAoXAr2Py4eZU563bbJc169bSSYumu1n-t2CUpP6eNNO6nODyb9i0iaxdwBvRto5Fic7OU-xiK_ApkMxNHTlxremvCz_d3IZiV-XNHcKOQv6Ba-HR7nITdfluihD2fYy6-8W2rjb_P_-410GQG_Wfw2E
*/
