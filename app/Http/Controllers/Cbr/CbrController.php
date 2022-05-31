<?php

namespace App\Http\Controllers\Cbr;

use App\Components\CbrComponent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CbrController extends Controller
{
    private $component;

    public function __construct(CbrComponent $component)
    {
        $this->component = $component;
    }

    /**
     * @throws ApiCheckCbrException
     */
    public function checkCbr(Request $request)
    {
        $rule = [
            'data' => $request->data
        ];
        $validator = Validator::make($rule, [
            'data' => 'required|date_format:d-m-Y'
        ]);
        if($validator->fails()){
            return response()->json(['message' => 'Не верная дата']);
        }else{
            $data = $validator->validated();
            $date = Carbon::createFromFormat('d-m-Y', $data['data']);
            return response()->json(['resultCbr' => $this->component->checkCbrFromApi($data['data'])]);
        }
    }
}
