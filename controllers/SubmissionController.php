<?php

class SubmissionController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function handleSubmission()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = array();
    
            $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
            
            if ($amount === false || $amount < 0) {
                //echo 'amount';exit();
                $errors[] = "Amount must be a number.";
            }
            
            $buyer = filter_input(INPUT_POST, 'buyer');
            
            if (!preg_match('/^[A-Za-z0-9\s]{1,20}$/', $buyer)) {
                $errors[] = "Buyer must be alphanumeric and less than 20 characters.";
            }
        
            $receiptId = filter_input(INPUT_POST, 'receipt_id');
            if (!preg_match('/^[A-Za-z]+$/', $receiptId)) {
                $errors[] = "Receipt ID must be text only.";
            }
        
            
            $items = isset($_POST['items']) ? $_POST['items'] : array();

                foreach ($items as $item) {
                    if (!preg_match('/^[A-Za-z\s]+$/', $item)) {
                        $errors[] = "Items must be text only.";
                        break;
                    }
                }
            $buyerEmail = filter_input(INPUT_POST, 'buyer_email', FILTER_VALIDATE_EMAIL);
            
            if ($buyerEmail === false) {
                $errors[] = "Invalid email address.";
            }
        
            $note = filter_input(INPUT_POST, 'note');
            if (str_word_count($note) > 30) {
                $errors[] = "Note must not exceed 30 words.";
            }
        
            $city = filter_input(INPUT_POST, 'city');
            if (!preg_match('/^[A-Za-z\s]+$/', $city)) {
                $errors[] = "City must be text and spaces only.";
            }
        
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
            
            if (!ctype_digit($phone)) {
                $errors[] = "Phone must contain only numbers.";
            }
        
            $entryBy = filter_input(INPUT_POST, 'entry_by', FILTER_VALIDATE_INT);
            if ($entryBy === false) {
                $errors[] = "Entry By must contain only numbers.";
            }
            if(isset($_COOKIE['submission_time'])) {
                $date1 = time();
                $date2 =$_COOKIE['submission_time'];
                $mins = ($date2 - $date1) / 60;
                if($mins<(24*60))
                {
                    echo json_encode(array("success" => false, "errors" => 'Please try after 24 hours from previous submission.'));
                }
            }
            if (empty($errors)) {
                $data = [
                    'amount' => $_POST['amount'],
                    'buyer' => $_POST['buyer'],
                    'receipt_id' => $_POST['receipt_id'],
                    'items' => implode(",",$_POST['items']),
                    'buyer_email' => $_POST['buyer_email'],
                    'buyer_ip' => $_SERVER['REMOTE_ADDR'],
                    'note' => $_POST['note'],
                    'city' => $_POST['city'],
                    'phone' => $_POST['phone'],
                    'hash_key' => hash('sha512', $_POST['receipt_id'] . 'arraytics'),
                    'entry_at' => date('Y-m-d H:i:s'),
                    'entry_by' => $_POST['entry_by'],
                ];
                $success = $this->model->insertSubmission($data);
                //echo($success);exit();
                if ($success) {
                    setcookie('submission_time', time(), time() + 3600 * 24, '/');
                   echo(json_encode('success',200));
                    exit();
                } else {
                    echo(json_encode('error',401));
                    exit();
                }
            } else {
                echo json_encode(array("success" => false, "errors" => $errors));
            }
            
        } else {
            echo 'Invalid request method';
        }
    }
    public function handleFilter()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $userId = $_POST['userId'];

            $filteredSubmissions = $this->model->getFilteredSubmissions($startDate, $endDate, $userId);
            print_r(json_encode($filteredSubmissions));
            //return Response::json($filteredSubmissions);
        // return $filteredSubmissions;
            //include __DIR__ . '/../views/report.php';
            //echo (['success' => true, 'message' => 'Data saved successfully']);
        } else {
            echo(json_encode('error',401));
        }
    }
}

?>