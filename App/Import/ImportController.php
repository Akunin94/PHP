<?php


namespace App\Import;


use App\Import;
use App\Renderer;
use App\Response;
use App\TasksQueue;

class ImportController
{

    public function index()
    {

        Renderer::getSmarty()->display('import/index.tpl');
    }

    public function upload()
    {
        $file = $_FILES['import_file'] ?? null;

        if ( is_null($file) || empty($file['name']) ) {
            die('not import file uploaded');
        }

        $uploadDir = APP_UPLOAD_DIR . '/import';
        if ( !file_exists($uploadDir) ) {
            mkdir($uploadDir);
        }

        $importFilename = 'i_' . time() . '.' . $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $importFilename);

        $filepath = APP_UPLOAD_DIR . '/import/' . $importFilename;

        $taskName = 'Импорт товаров ' . $importFilename;
        $task = Import::class . '::productsFromFileTask';
        $taskParams = [
            'filename' => $importFilename
        ];

        TasksQueue::addTask($taskName, $task, $taskParams);

        Response::redirect('/queue/list');
        exit;
    }
}