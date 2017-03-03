<?php

namespace App\Http\Controllers;

use App\Models\Arching;
use App\Models\Contract;
use App\Models\PaymentA;
use App\Models\PaymentM;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;

use App\Models\Person;
use Illuminate\Support\Facades\Response;

class PersonController extends Controller
{
	protected $person;
	
	/**
	 * Inject the User Repository
	 */
	public function __construct(Person $person)
	{
		$this->middleware('auth');
		$this->person = $person;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = \DataFilter::source ( Person::where ( [
            'delete' => 0
        ] ) );

        $filter->add ( 'ci', 'Buscar por CI', 'text' );
        $filter->attributes ( [
            'id' => 'searchId'
        ] );
        $filter->submit ( 'Buscar' );
        $filter->reset ( 'Limpiar' );
        $filter->build ();

        $grid = \DataGrid::source ( $filter );
        $grid->add ( 'id', 'ID', true )->style ( "width:100px" );
        $grid->add ( 'ci', 'CI' );
        $grid->add ( 'names', 'Nombres' );
        $grid->add ( 'last_name_f', 'Apellido Paterno' );
        $grid->add ( 'last_name_m', 'Apellido Materno' );
        $grid->add ( 'email', 'Email' );
        $grid->add ( 'phone', 'Telefono' );
        $grid->add ( 'phone_cel', 'Celular' );


        $grid->add ( 'busy', 'Acciones' )->cell ( function ($value, $row) {
            return '
                    <a href="#" onclick="openModelEditPerson(\''.$row->id.'\')" data-toggle="tooltip" title="Editar Persona"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a>
                    <a href="#" onclick="openModelDeletePerson(\''.$row->id.'\')" data-toggle="tooltip" title="Borrar Persona"><span class="fa fa-trash" aria-hidden="true"></span></a>
                    <a href="#" onclick="openModelViewPerson(\''.$row->id.'\')" data-toggle="tooltip" title="Ver Persona"><span class="fa fa-street-view" aria-hidden="true"></span></a>
                ';
        } );

        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->add('<a href="#" data-id="{{ $id }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>', '');
        // $grid->edit('/admin/edit', 'Acciones','show|modify|delete');
        $grid->attributes(array("class" => "table table-striped arcedi_table"));
        $grid->orderBy ( 'id', 'asc' );
        $grid->paginate ( 10 );

        $personModel = new Person();

        return view ( 'person.home', compact ( 'filter', 'grid', 'personModel') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requests\StorePersonPost $request)
    {
        $person = new Person();
        if(isset($_POST['ci'])){
            $person->ci = $_POST['ci'];
        }
        if(isset($_POST['names'])){
            $person->names = $_POST['names'];
        }
        if(isset($_POST['expedido'])){
            $person->expedido = $_POST['expedido'];
        }
        if(isset($_POST['last_name_f'])){
            $person->last_name_f = $_POST['last_name_f'];
        }
        if(isset($_POST['last_name_m'])){
            $person->last_name_m = $_POST['last_name_m'];
        }
        if(isset($_POST['email'])){
            $person->email = $_POST['email'];
        }
        if(isset($_POST['career'])){
            $person->career = $_POST['career'];
        }
        if(isset($_POST['phone'])){
            $person->phone = $_POST['phone'];
        }
        if(isset($_POST['phone_cel'])){
            $person->phone_cel = $_POST['phone_cel'];
        }

        $person->save();
        echo 'true:: '.$person->names;
        return;
//
//        $person = new Person($request->all());
//
//        if($request->validate()){
//            dd('dddddddd if');
//        }else{
//            dd('dddddddd if');
//        }
//        die();
        //if($request->)
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ci
     * @return \Illuminate\Http\Response
     */
    public function show($ci)
    {
    	//return $this->person->find($id);
    	return $this->person->getPersonByCi($ci);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePersonPost $request)
    {
        if(isset($_POST['id'])){
            $person = Person::where('id', '=', $_POST['id'])->first();
            if(isset($_POST['ci'])){
                $person->ci = $_POST['ci'];
            }
            if(isset($_POST['names'])){
                $person->names = $_POST['names'];
            }
            if(isset($_POST['expedido'])){
                $person->expedido = $_POST['expedido'];
            }
            if(isset($_POST['last_name_f'])){
                $person->last_name_f = $_POST['last_name_f'];
            }
            if(isset($_POST['last_name_m'])){
                $person->last_name_m = $_POST['last_name_m'];
            }
            if(isset($_POST['email'])){
                $person->email = $_POST['email'];
            }
            if(isset($_POST['career'])){
                $person->career = $_POST['career'];
            }
            if(isset($_POST['phone'])){
                $person->phone = $_POST['phone'];
            }
            if(isset($_POST['phone_cel'])){
                $person->phone_cel = $_POST['phone_cel'];
            }

            $person->save();
            echo 'true:: ';
        }
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPerson(Request $request){
        $person_id = $request->input('person_id');
        try {
            $person = Person::getPersonById($person_id);

            $statusCode = 200;
            $response = null;
            $response = [
                'person' => $person
            ];
        } catch ( Exception $e ) {
            $response = [
                "error" => "File doesn`t exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }

    }

    public function getPersonById($id){;
        try {
            $person = Person::where('id', '=', $id)->first();

            $statusCode = 200;
            $response = null;
            $response = [
                'person' => $person
            ];
        } catch ( Exception $e ) {
            $response = [
                "error" => "PErsona no existe exists"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function validDeletePerson($per_id){;
        try {
            $statusCode = 200;
            $response = [
                'valid' => $this->isValidDeletePerson($per_id),
                'person' => Person::where('id', '=', $per_id)->first()
            ];
        } catch ( Exception $e ) {
            $response = [
                "error" => "Algo paso con la validacion"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    public function deletePerson($per_id){;
        try {
            $person = Person::where('id', '=', $per_id)->first();

            $person->delete();
            $statusCode = 200;
            $response = [
                'valid' => true,

            ];
        } catch ( Exception $e ) {
            $response = [
                "error" => "Algo paso con la validacion"
            ];
            $statusCode = 404;
        } finally{
            return response ()->json ( $response, $statusCode );
        }
    }

    private function isValidDeletePerson($per_id){;
        $valid = true;
        $person = Person::where('id', '=', $per_id)->first();

        $p1 = Contract::where('per_id', $per_id)->first();
        $p2 = Arching::where('per_id', $per_id)->first();

        $p3 = PaymentA::where('ci', $person->ci)->first();
        $p4 = PaymentM::where('ci', $person->ci)->first();

        if(isset($p1)){
            $valid = false;
        }
        if(isset($p2)){
            $valid = false;
        }
        if(isset($p3)){
            $valid = false;
        }
        if(isset($p4)){
            $valid = false;
        }

        return $valid;
    }
}
