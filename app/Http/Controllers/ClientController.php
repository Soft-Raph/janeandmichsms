<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        $client->messages->create($recipients,
                ['from' => $twilio_number, 'body' => $message] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_messages(Request $request)
    {
        Message::updateOrCreate(
            ['id' => 1],
            [
                'w_m_f' => $request->w_m_f,
                'w_m_s' => $request->w_m_s,
                's_e_m_f' => $request->s_e_m_f,
                's_e_m_s' => $request->s_e_m_s,
                'm_a_f' => $request->m_a_f,
                'm_a_s' => $request->m_a_s
            ]
        );
        return back()->with('status','Messages Updated Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile($id)
    {
        $client = Client::find($id);
        return view('profile', [
            'client' => $client,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $mes = Message::find(1);
        if($request->plan == 'fat'){
            $this->sendMessage($mes->w_m_f, $request->phone);
        }
        else{
            $this->sendMessage($mes->w_m_s, $request->phone);
        }
        Client::create($request->all());
        return back()->with('status','Client Added Successfully');
    }


    public function message(Request $request)
    {
        $this->sendMessage($request->message, $request->phone);
        return back()->with('status','Message sent successfully');
    }


    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return back()->with('status','Client Deleted Successfully');
    }

    public function automate(Request $request){
        if ($request->password == 'janeandmich'){
            $mes = Message::find(1);
            $clients = Client::all();

            $timezone = 'Africa/Lagos';
            $today = Carbon::now($timezone);

            $dmf = $mes->m_a_f;
            $edmf = explode(':',$dmf);

            $dms = $mes->m_a_s;
            $edms = explode(':',$dms);

            $num = rand(0,4);


            foreach ($clients as $client){
                $join = $client->created_at;

                //Daily Message
                //morning
                if ($today->hour == 10 && $client->status == 'active'){
                    $this->sendMessage($edmf[$num], $client->phone);
                }

                //night
                if ($today->hour == 16 && $client->status == 'active'){
                    $this->sendMessage($edms[$num], $client->phone);
                }

                //End Message
                if ($join->diffInMonths($today) == $client->duration && $client->plan == 'fat' && $client->status == 'active'){
                    $this->sendMessage($mes->s_e_m_f, $client->phone);
                    $client->status = 'inactive';
                    $client->save();
                }
                if ($join->diffInMonths($today) == $client->duration && $client->plan == 'slim' && $client->status == 'active'){
                    $this->sendMessage($mes->s_e_m_s, $client->phone);
                    $client->status = 'inactive';
                    $client->save();
                }

            }
            return 'Success';
        }
        else{
            return 'Access Denied';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
