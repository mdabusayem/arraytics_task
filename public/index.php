<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/SubmissionModel.php');
require_once(__DIR__ . '/../controllers/SubmissionController.php');

$model = new SubmissionModel($db);
$controller = new SubmissionController($model);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'filter') {
        $controller->handleFilter();
    } 
    elseif ($action === 'submit') {
        $controller->handleSubmission();
    }
    elseif ($action === 'fetch') {
        $model->getSubmissions();
    }
     elseif ($action === 'report') {
        include __DIR__ . '/../views/report.php';
    } else {
        echo 'Invalid action!';
    }
} else {
    include __DIR__ . '/../views/submission_form.php';
}
?>