<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckInnRequest;
use App\Services\Contracts\InnChecker;
use Illuminate\Support\Facades\Cache;

class CheckInnController extends Controller
{
    public function __invoke(CheckInnRequest $request, InnChecker $checker)
    {
        $inn = $request->get('inn');
        if (!Cache::has('inn_' . $inn)) {
            $responseObject = $checker->check($inn);
            Cache::put('inn_' . $inn, $responseObject, 60 * 60 * 24);
        }

        $responseObject = Cache::get('inn_' . $inn);

        return back()->withInput($request->all())
            ->with([
                'success' => $responseObject->isSuccess(),
                'message' => $responseObject->getMessage(),
                'error_code' => $responseObject->getErrorCode()
            ]);
    }
}
