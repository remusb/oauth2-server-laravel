<?php namespace LucaDegasperi\OAuth2Server\Filters;

use AuthorizationServer;
use Response;
use Session;
use League\OAuth2\Server\Exception\ClientException;
use Exception;

class CheckAuthorizationParamsFilter
{

    public function filter($route, $request, $scope = null)
    {
        try {

            $params = AuthorizationServer::checkAuthorizeParams();

            Session::put('authorize-params', $params);


        } catch (ClientException $e) {

            return Response::json(array(
                'status' => 400,
                'error' => 'bad_request',
                'error_message' => $e->getMessage(),
            ), 400);

        } catch (Exception $e) {

            return Response::json(array(
                'status' => 500,
                'error' => 'internal_server_error',
                'error_message' => 'Internal Server Error',
            ), 500);
        }
    }
}