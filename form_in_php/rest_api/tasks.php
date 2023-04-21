<?php
use crud\TaskCRUD;
use models\Task;

include("./config.php");
include("../autoload.php");

$crud = new TaskCRUD;
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $task_id = filter_input(INPUT_GET,'task_id');
        $user_id = filter_input(INPUT_GET,'user_id');
        //task_id
        if(!is_null($task_id)){
            $tasks = $crud->read_by_task_id($task_id);
            if($tasks == false){
                    $response = [
                        'errors' => [
                            [
                                'status' => 404,
                                'title' => "Risorsa non trovata, task_id non esistente",
                                'details' => $task_id
                            ]
                        ]    
                    ];  
                    echo json_encode($response);
            }else{
                http_response_code(200);

                $response = [
                    'data' => $tasks,
                    'status' => 200
                ];
                echo json_encode($response);
            }
        //user_id
        }elseif(!is_null($user_id)){
            $tasks = $crud->read_by_user_id($user_id);
            if($tasks == false){
                $response = [
                    'errors' => [
                        [
                            'status' => 404,
                            'title' => "Risorsa non trovata, user_id non esistente",
                            'details' => $user_id
                        ]
                    ]    
                    ];
                echo json_encode($response);
            }else{
                http_response_code(200);

                $response = [
                    'data' => $tasks,
                    'status' => 200
                ];
                echo json_encode($response);
            }
        //all
        }else{
            $tasks = $crud->read_all();

            $response = [
                'data' => $tasks,
                'status'=>200
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
                    $task_id = filter_input(INPUT_GET, 'task_id');
            
                    $input = file_get_contents('php://input');
                    
                    $request = json_decode($input, true);
            
                    $task = Task::arraytotask($request);
            
                    $last_insert_id = $crud->update($task, $task_id);
            
                    $task = (array)$task;
            
                    $task['task_id'] = $last_insert_id;
                    
                        if ($last_insert_id == 1) {
                            http_response_code(200);
                            $response = [
                                'data' => $task,
                                'status' => 201
                            ];
                        }
                        if ($last_insert_id == 0) {
                            http_response_code(404);
                            // array associativo
                            $response = [
                                // proprietà errors
                                // 'chiave' => "valore"
                                'errors' => [
                                    [
                                        'status' => 404,
                                        'title' => "Risorsa non trovata, task già modificata",
                                        'details' => $task_id
                                    ]
                                ]
                            ];
                        }
                        //risposta va convertita in formato json
                        echo json_encode($response);
            
            
                default:
                    # code...
                    break;
                }