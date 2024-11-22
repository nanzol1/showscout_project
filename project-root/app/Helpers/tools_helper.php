<?php
if(!function_exists('sendMail')){
    function sendMail($emailTo,$data = []){
        $email = service('email');

        $message = view('templates/email_template', $data);
        $email->setFrom('showscoutad@gmail.com', 'ShowScout\'s Team');
        $email->setTo($emailTo);
        $email->setSubject('Értesítés');
        $email->setMessage($message);

        if (!$email->send()) {
            return false;
        }else{
            return true;
        }
    }
}
?>