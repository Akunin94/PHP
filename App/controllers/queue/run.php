<?php

use App\TasksQueue;
use App\Request;
use App\Response;

$id = Request::getIntFromGet('id');

$result = TasksQueue::runById($id);

Response::redirect('/queue/list');