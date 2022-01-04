<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    /**
     * Retorna vista principal     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('users.indexUser');
    }

    /**
     * Retorna un array : status , objUser
     * success = status
     * user = object new  user
     * @return []
     */
    public function create(Request $request)
    {

        $objvalid=User::where('email',$request['email'])->get();
        
        if(!empty($objvalid[0])){
            return response()->json(['success'=>false],400);
        }else{
            $obj= new User();
            $obj->name=$request['name'];
            $obj->identificacion=$request['dni'];
            $obj->email=$request['email'];
            $obj->estado=1;
            $hashedPassword = \Hash::make($request['password']);
            $obj->password= $hashedPassword;
            $obj->phone=$request['phone'];
            $obj->birthday=date('Y-m-d',strtotime($request['bithDay']));
            $obj->codCity=$request['codCity'];
            $obj->save();            
            return response()->json(['success'=>true,'user'=>$obj],201);
        }


        
    }

    /**    
     * Retorna todos los usuarios registrados 
     * @return []
     */
    public function listData()
    {        
            $aryPatient=User::all();
            $data=[]; $x=0;
            foreach($aryPatient as $k=> $objpt)
            {
                $data[$x]['id']=$objpt->id;
                $data[$x]['identificacion']=$objpt->identificacion;
                $data[$x]['name']=$objpt->name;
                $data[$x]['email']=$objpt->email;
                $data[$x]['estado']=$objpt->estado;
                
                $diff1 = new \DateTime($objpt->birthday);
                $diff2 = new \DateTime(date('Y-m-d'));
                $y = $diff1->diff($diff2)->y;

                
                $data[$x]['years']= $y;
                $data[$x]['editable']=false;
                ++$x;            
            }
          return json_encode($data);        
    }    


    /**
     * Actualizar los atributos del usuario registrado
     *
     * @param  \Illuminate\Http\Request  $request     
     * @return [] : status
     */
    public function update(Request $request)
    {
        $obj=User::find($request['id']);
        $obj->name=$request['name'];
        $obj->save();
        return response()->json(['success'=>true],201);
    }

    /**
     * Eliminar el usuario registrado    
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::transaction(function()use ($id){
                $obj=User::find($id);
                $obj->delete();
            });
            return response()->json(['success'=>true],201);

        } catch (\Exception $ex) {            
            return response()->json(['success'=>false,'error' => $ex->getMessage()],400);
        }


        
        
    }
}
