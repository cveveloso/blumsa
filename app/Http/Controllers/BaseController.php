<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FlashMessages;

class BaseController extends Controller
{
    use FlashMessages;

    /**
     * @var return data
     */
    protected $data = null; 

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function ShowErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ResponseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error'         => $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          => $data
        ]);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function ResponseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false, $params = array())
    {
        $this->SetFlashMessage($message, $type);
        $this->ShowFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        if (count($params) > 0) {
            return redirect()->route($route, $params);
        }
        
        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function ResponseRedirectBack($message, $type = 'info', $error = false, $withOldInputWhenError = false, $errors = array())
    {
        $this->SetFlashMessage($message, $type);        
        $this->ShowFlashMessages();

        if ($error && $withOldInputWhenError) {            
            return redirect()->back()->withErrors($errors)->withInput();
        }

        return redirect()->back();
    }
}
