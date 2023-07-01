<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;

class RequestController extends Controller
{
    public function edit($id){
       $request = ModelsRequest::find($id);
       $request_user = User::find($request->user_id);
        $user = auth()->user();
       $film = Film::find($request->film_id);
       return view('containers.request', ["request" => $request, "film" => $film, "user"=> $user, "request_user"=> $request_user]);
    }

    public function update(Request $request, $id){
        $modelrequest = ModelsRequest::find($id);
        if($request->selected == 'accept'){
            $modelrequest->request_status = "Резерв подтвержден";
            $modelrequest->save();
        }elseif($request->selected == 'dontaccept'){
            $modelrequest->request_status = "Резерв не подтвержден";
            $modelrequest->save();
        }elseif($request->selected == 'canceled'){
            $modelrequest->request_status = "Заявка отменена";
            $modelrequest->save();
        }elseif($request->selected == 'done'){
            $film = Film::find($modelrequest->film_id);
            $film->length = $film->length - $modelrequest->size;
            $film->save();
            $modelrequest->request_status = "Заявка выполнена";
            $modelrequest->save();
        }elseif($request->selected == 'reserv'){
            $modelrequest->request_status = "В резервации";
            $modelrequest->save();
        }
    return back()->with("successChange", "Статус был успешно обнавлен");
}
}
