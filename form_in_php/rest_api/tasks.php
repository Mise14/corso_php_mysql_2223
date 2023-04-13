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
        $user_id = filter_input(INPUT_GET, 'user_id');

        if (!is_null($user_id)) {
            $tasks = $crud->read($user_id);
            $response = [
                'data' => $tasks,
                'status' => 200
            ];
            echo json_encode($response);
        } elseif(!is_null($task_id)){
           $tasks = $crud->read($task_id);
           $response = [
            'data' => $tasks,
            'status' => 200
        ];
        echo json_encode($response);
        } else {
            $tasks = $crud->read();
            $response = [
                'data' => $tasks,
                'status' => 200
            ];
            echo json_encode($response);
        }
        break;

        case 'DELETE':
            $task_id = filter_input(INPUT_GET, 'task_id');
            if (!is_null($task_id)) {
                $rows = $crud->delete($task_id);
                if ($rows == 1) {
                    $response = [
                        'data' => $task_id,
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
                                'title' => "Task non trovata",
                                'details' => "Task id: " . $task_id
                            ]
                        ]
                    ];
                    echo json_encode($response);
                }

                  
                 
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
                    'status' => 201
                ];
        
                echo json_encode($response);
                break;
                
                case 'PUT':
                    $input = file_get_contents('php://input');
                    $request = json_decode($input, true); // ottengo un array associativo
                    $task = Task::arrayToTask($request);
                    $task_id = filter_input(INPUT_GET, 'task_id');
                    if (!is_null($task_id)) {
            
                        $row = $crud->update($task);
            
                        if ($row == 1 ) {
            
                            http_response_code(202);
            
                            $response = [
                                "data" => $task,
                                'status' => 202
                            ];
                            echo json_encode($response);
                        } else if ($row == 0) {
            
                            http_response_code(404);
            
                            $response = [
                                'errors' => [
                                    [
                                        'status' => 404,
                                        'title' => "Task non trovata o già presente",
                                        'details' => $task_id
                                    ]
                                ]
                            ];
            
                            echo json_encode($response);
                        }
                    }
                    break;
            
            
                default:
                    # code...
                    break;
                }