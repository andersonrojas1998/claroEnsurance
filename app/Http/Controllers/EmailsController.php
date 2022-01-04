<?php

namespace App\Http\Controllers;
use App\Model\emails;
use Illuminate\Http\Request;
use App\Mail\SendEmail; 
use Mail;

class EmailsController extends Controller
{
    /**
     * Retorna vista principal     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('emails.indexEmail');
    }

    /**
     * Retorna vista principal     
     * @return \Illuminate\Http\Response
     */
    public function indexSend()
    {
       return view('emails.IndexSendInvoice');
    }
    
    /**
     * Envia Emails
     * @return \Illuminate\Http\Response
     */
    public function sendEmails()
    {        
      Mail::to('rojasanderson07@gmail.com')->queue(new SendEmail());  
      return [];
    }

    /**    
     * Retorna todos los usuarios registrados 
     * @return []
     */
    public function listData()
    {        
            $aryEm=Emails::all();
            $data=[]; $x=0;
            foreach($aryEm as $k=> $objEm)
            {
                $data[$x]['id']=$objEm->id;
                $data[$x]['asunto']=$objEm->asunto;
                $data[$x]['destinario']=$objEm->destinario;
                $data[$x]['cuerpo']=$objEm->cuerpo;
                $data[$x]['status']=$objEm->status;                                
                ++$x;            
            }
          return json_encode($data);        
    }  
}
