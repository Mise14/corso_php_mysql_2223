<?php

use crud\UserCRUD;
use models\User;
use PSpell\Config;

include("../../config.php");
include("../autoload.php");

$crud = new UserCRUD;
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        #prendo un parametro dal get
        $user_id = filter_input(INPUT_GET, 'user_id');
        if (!is_null($user_id)) {
            //   echo json_encode($crud->read($user_id));

            $response = [
                'data' => $crud->read($user_id),
                'status' => 200
            ];
            echo json_encode($response);
            
        } else {
            $users = $crud->read();
            $response = [
                'data' => $users,
                'status' => 200
            ];
            echo json_encode($response);
            // echo json_encode($users);

        }
        break;

        case 'DELETE':
            $user_id = filter_input(INPUT_GET, 'user_id');
            if (!is_null($user_id)) {
                $rows = $crud->delete($user_id);
                if ($rows == 1) {
                    $response = [
                        'data' => $user_id,
                        'status' => 200
                    ];
                    echo json_encode($response);
                }
    
    
                if ($rows == 0) {
                    http_response_code(404);
                    $response = [
                        'errors' => [
                            [
                                'status' => 404,
                                'title' => "Utente non trovato",
                                'details' => "Utente id: " . $user_id
                            ]
                        ]
                    ];
                    echo json_encode($response);
                }
            }
            break;

    case 'POST':
        //print_r($_POST);
        //ci permette di passare i dati in formato json
        $input =  file_get_contents('php://input');
        $request = json_decode($input, true);
        //var_dump($request);

        $user = User::arrayToUser($request);

        try{
        $last_id = $crud->create($user);

        $user = (array) $user;
        //unset annulla gli indici degli array, quindi in qst caso non visualizzo la password
        unset($user['password']);
        $user['user_id'] = $last_id;
        $response = [
            'data' => $user,
            'status' => 202
        ];

        //echo json_encode($response,JSON_PRETTY_PRINT);

        }catch (\Throwable $th){
            http_response_code(422);
            $response = [
                'errors' => [
                    [
                        'status' => 422,
                        'title' => "Formato non trovato",
                        'details' => $th->getMessage(),
                        'code' => $th->getCode()
                    ]
                ]
            ];
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
        break;

    case 'PUT':
        $input =  file_get_contents('php://input');
        $request = json_decode($input, true);
        $user = User::arrayToUser($request);
        $user_id = filter_input(INPUT_GET, 'user_id');

        $rows = $crud->read($user_id);

        if ($rows==true) {
            $crud->update($user_id, $user);
            $user = (array) $user;
            unset($user['password']);
            unset($user['username']);
            $response = [
                'data' => [
                    'type' => "user",
                    'attributes' => $user
                ]
            ];
            echo json_encode($response);
        }else {
            http_response_code(404);
            $response = [
                'errors' => [
                    [
                        'status' => 404,
                        'title' => "Utente non trovato",
                        'details' => "Utente id: " . $user_id
                    ]
                ]
            ];
            echo json_encode($response);
        }

        break;

    default:
        # code...
        break;
}
