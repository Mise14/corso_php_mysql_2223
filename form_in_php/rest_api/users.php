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
            echo json_encode($crud->read($user_id));
        } else {
            $users = $crud->read();
            echo json_encode($users);
        }
        break;

    case 'DELETE':
        $user_id = filter_input(INPUT_GET, 'user_id');
        if (!is_null($user_id)) {
            $rows = $crud->delete($user_id);
            if ($rows == 1) {
                http_response_code(204);
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
            }
            echo json_encode($response);
        }
        break;

    case 'POST':
        //print_r($_POST);
        //ci permette di passare i dati in formato json
        $input =  file_get_contents('php://input');
        $request = json_decode($input, true);
        //var_dump($request);

        $user = User::arrayToUser($request);

        $last_id = $crud->create($user);

        // $response = [
        //     'data' =>[
        //         'type' => "user",
        //         'id' => $last_id,
        //         'attributes' => [
        //             $user
        //         ],
        //     ]
        // ];
        $user = (array) $user;
        //unset annulla gli indici degli array, quindi in qst caso non visualizzo la password
        unset($user['password']);
        $user['user_id'] = $last_id;
        $response = [
            'data' => $user,
            'status' => 202
        ];

        echo json_encode($response);


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
