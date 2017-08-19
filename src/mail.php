<?php
/*
-> name komicho\mail
-> author komicho
-> version  1.0
-> github https://github.com/komicho/mail
*/

namespace komicho;

class mail
{
    public function from ($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->from = $email;
        } else {
            $this->out['status'] = 'false';
            $this->out['message'] = "from '$email' is not a valid email address";
        }
        return $this;
    }
    
    public function to ($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->to = $email;
        } else {
            $this->out['status'] = 'false';
            $this->out['message'] = "to '$email' is not a valid email address";
        }
        return $this;
    }
    
    public function subject ($subject = 'subject')
    {
        $this->subject = $subject;
        return $this;
    }
    
    public function tem ($tem = 'tems/default')
    {
        $this->tem = $tem;
        return $this;
    }

    public function data ($data_tem)
    {
        foreach($data_tem as $key => $value){
            $$key = $value;
        }
        
        $file = $this->tem . '.php';
        if(file_exists($file)){
            ob_start();
            require($file);
            $res = ob_get_contents();
            ob_end_clean();
            $this->message = $res;
        }else{
            $this->message = '!file';
        }
        return $this;
    }

    public function demo ()
    {
        if($this->message == '!file'){
            $this->out['status'] = 'false';
            $this->out['message'] = "File Template not Available";
        }else{
            echo $this->message;
        }
        return $this;
    }

    public function send ()
    {
        if($this->message == '!file'){
            $this->out['status'] = 'false';
            $this->out['message'] = "File Template not Available";
        }else{
            $headers = 'From: ' . $this->from . '' . " " . 'Reply-To: ' . $this->from;
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            if(@ mail($this->to,$this->subject,$this->message,$headers) ){
                $this->out['status'] = 'true';
                $this->out['message'] = "Email has been sent";
            }else{
                $this->out['status'] = 'false';
                $this->out['message'] = "Email has not been sent";
            }
            return $this;
        }
    }
    
    public function out ()
    {
        if (isset($this->out)) {
            return $this->out;
        }
    }
}