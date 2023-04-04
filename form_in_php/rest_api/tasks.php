<?php
use crud\TaskCRUD;
use models\Task;

include("../../config.php");
include("../autoload.php");

$crud = new TaskCRUD;
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        #prendo un parametro dal get
        $task_id = filter_input(INPUT_GET, 'task_id');
        if (!is_null($task_id)) {
            echo json_encode($crud->read($task_id));
        } else {
            $tasks = $crud->read();
            echo json_encode($tasks);
        }
        break;

        case 'DELETE':
            $task_id = filter_input(INPUT_GET, 'task_id');
            if (!is_null($task_id)) {
                $rows = $crud->delete($task_id);
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
                                'details' => "Utente id: " . $task_id
                            ]
                        ]
                    ];
                }
                echo json_encode($response);
            }
            break;

            case 'POST':
                $input =  file_get_contents('php://input');
                $request = json_decode($input, true);
                $task = Task::arrayToTask($request);
                $last_id = $crud->create($task);

                $task = (array) $task;
                $task['task_id'] = $last_id;
                $response = [
                    'data' => $task,
                    'status' => 202
                ];
        
                echo json_encode($response);
                break;

                case 'PUT':
                    $input =  file_get_contents('php://input');
                    $request = json_decode($input, true);
                    $task = Task::arrayToTask($request);
                    $task_id = filter_input(INPUT_GET, 'task_id');
            
                    $rows = $crud->read($task_id);
            
                    if ($rows==true) {
                        $crud->update($task_id, $task);
                        $task = (array) $task;
                        $response = [
                            'data' => [
                                'type' => "task",
                                'attributes' => $task
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
                                    'details' => "Utente id: " . $task_id
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