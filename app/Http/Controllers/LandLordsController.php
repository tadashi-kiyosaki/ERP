<?php

namespace App\Http\Controllers;

use App\Country;
use App\State;
use App\Landlord;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class LandLordsController extends Controller
{
    //
    public $phone_code = '+254';

    public function actions () {
        return view('landlords.actions');
    }

    public function reports() {
        return view('landlords.reports');
    }

    public function newLandlord() {

        return view('landlords.createLandlord', ['countries' => Country::all(), 'states' => State::all()]);
    }

    public function removeLandlord($id) {
        $item = Landlord::find($id);

        if ($item != null){
            $item->delete();
            return redirect('/landlord/reports/show')->with('message','Landlord Successfully Deleted');
        }
        else {
            return redirect('/landlord/reports/show')->with('message','Unable to Delete');
        }
    }

    public function editLandlord($id) {
        return view('landlords.editLandlord', ['landlord' => Landlord::find($id), 'countries' => Country::all(), 'states' => State::all()]);
    }

    public function saveLandlord(Request $request) {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|min:2|max:255',
            'surName' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'idNumber' => 'required|string|min:3|max:255',
            'pinNumber' => 'required|string|min:3|max:255',
            'vatNumber' => 'required|string|min:3|max:255',
            'primaryPhoneNumber' => 'required|string|min:3|max:255',
            'poBox' => 'required|string|min:2|max:255',
            'postalCode' => 'required|string|min:2|max:255',
            'country' => 'required|string|min:2|max:255',
            'state' => 'required|string|min:2|max:255',
            'fileUpload' => 'file|max:10000|mimes:doc,docx,pdf',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails())
        {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $title = $request->input('title_group');
        $landLord = new Landlord;

        $first_name = $request->input('firstName');
        $middle_name = $request->input('middleName');
        $sur_name = $request->input('surName');
        $id_number = $request->input('idNumber');
        $pin_number = $request->input('pinNumber');
        $vat_number = $request->input('vatNumber');
        $primary_phone = $request->input('primaryPhoneNumber');
        $alternate_phone = $request->input('alternatePhoneNumber');
        $primary_phone_code = $request->input('primaryPhoneCode');
        $alternate_phone_code = $request->input('alternatePhoneCode');
        $primary_country_code = $request->input('primaryCountryCode');
        $alternate_country_code = $request->input('alternateCountryCode');
        $po_box = $request->input('poBox');
        $postal_code = $request->input('postalCode');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $email = $request->input('email');
        $password = $request->input('password');

        $document = null;
        if ($request->hasFile('fileUpload')) {
            $docFile = $request->file('fileUpload');
            $newFileName = time().'-'.$docFile->getClientOriginalName();

            $docFile->move(storage_path().'/landLords', $newFileName);
            $document = $newFileName;
        }

        $landLord->title = $title;
        $landLord->first_name = $first_name;
        $landLord->middle_name = $middle_name;
        $landLord->sur_name = $sur_name;
        $landLord->id_number = $id_number;
        $landLord->pin_number = $pin_number;
        $landLord->vat_number = $vat_number;
        $landLord->primary_phone_number = $primary_phone;
        $landLord->alternate_phone_number = $alternate_phone;
        $landLord->primary_phone_code = $primary_phone_code;
        $landLord->alternate_phone_code = $alternate_phone_code;
        $landLord->primary_country_code = $primary_country_code;
        $landLord->alternate_country_code = $alternate_country_code;
        $landLord->po_box = $po_box;
        $landLord->postal_code = $postal_code;
        $landLord->country = $country;
        $landLord->state = $state;
        $landLord->city = $city;
        $landLord->email = $email;
        $landLord->document = $document;

        $landLord->save();

        //Saving to user table with credentials
        $user = new User();
        if ($middle_name == null)
            $user->name = $first_name.' '.$sur_name;
        else
            $user->name = $first_name.' '.$middle_name.' '.$sur_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->roleId =  3;
        $user->save();


        return redirect()->route('new_landlord');
    }

    public function editCompleteLandlord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|min:2|max:255',
            'surName' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255',
            'idNumber' => 'required|string|min:3|max:255',
            'pinNumber' => 'required|string|min:3|max:255',
            'vatNumber' => 'required|string|min:3|max:255',
            'primaryPhoneNumber' => 'required|string|min:3|max:255',
            'poBox' => 'required|string|min:2|max:255',
            'postalCode' => 'required|string|min:2|max:255',
            'country' => 'required|string|min:2|max:255',
            'state' => 'required|string|min:2|max:255',
            'fileUpload' => 'file|max:10000|mimes:doc,docx,pdf',
        ]);

        if ($validator->fails())
        {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $id = $request->input('landlordId');
        $title = $request->input('title_group');
        $landLord = Landlord::whereId($id);

        $first_name = $request->input('firstName');
        $middle_name = $request->input('middleName');
        $sur_name = $request->input('surName');
        $id_number = $request->input('idNumber');
        $pin_number = $request->input('pinNumber');
        $vat_number = $request->input('vatNumber');
        $primary_phone = $request->input('primaryPhoneNumber');
        $alternate_phone = $request->input('alternatePhoneNumber');
        $primary_phone_code = $request->input('primaryPhoneCode');
        $alternate_phone_code = $request->input('alternatePhoneCode');
        $primary_country_code = $request->input('primaryCountryCode');
        $alternate_country_code = $request->input('alternateCountryCode');
        $po_box = $request->input('poBox');
        $postal_code = $request->input('postalCode');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
        $email = $request->input('email');

        $document = null;
        if ($request->hasFile('fileUpload')) {
            $docFile = $request->file('fileUpload');
            $newFileName = time().'-'.$docFile->getClientOriginalName();

            $docFile->move(storage_path().'/landLords', $newFileName);
            $document = $newFileName;
        }

        $currentEmail = $landLord->select('email')->first()->email;
        if ($currentEmail != $email)
        {
            $user = User::where('email', $currentEmail)->first();
            if ($user != null) {
                $user->update(array('email' => $email));
            }
        }

        $landLord->update([
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'sur_name' => $sur_name,
            'id_number' => $id_number,
            'pin_number' => $pin_number,
            'vat_number' => $vat_number,
            'primary_phone_number' => $primary_phone,
            'alternate_phone_number' => $alternate_phone,
            'primary_phone_code' => $primary_phone_code,
            'alternate_phone_code' => $alternate_phone_code,
            'primary_country_code' => $primary_country_code,
            'alternate_country_code' => $alternate_country_code,
            'po_box' => $po_box,
            'postal_code' => $postal_code,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'email' => $email,
            'document' => $document
        ]);
        return view('landlords.showLandlords');

    }

    public function showLandlords(Request $request) {
        if ($request->ajax()) {
            $landlords = Landlord::all();
            return DataTables::of($landlords)
                ->addIndexColumn()
                ->addColumn('landlord_name', function($row){
                    return $row->title.' '.$row->first_name.' '.$row->middle_name.' '.$row->sur_name;
                })
                ->addColumn('phone_number', function($row){
                    return '+'.$row->primary_phone_code.' '.$row->primary_phone_number;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="/landlord/landlords/edit/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i>EDIT</a>';
                    return $btn;
                })
                ->editColumn('delete', function($row){
                    $btn = '<a href="/landlord/landlords/remove/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i>DELETE</a>';
                    return $btn;
                })
                ->rawColumns(['delete' => 'delete', 'action' => 'action'])
                ->make(true);
        }

        return view('landlords.showLandlords');

//        $lords = Landlord::orderBy('id', 'asc')->paginate(5);
//        return view('landlords.showLandlords', compact('lords'));
    }

    public function stateForCountryAjax($country_name)
    {
        $country_name = urldecode($country_name);
        $country_id = $this->_stateCountryIDForCountryName($country_name);
        if ($country_id == 113){
            $states = DB::table('kenya_counties')
                ->distinct()
                ->get('name');
//            dd($states);
        }
        else{
            $states = DB::table("states")
                ->where("country_id",$country_id)
                ->get();
        }

        return json_encode($states);
    }

    private function _stateCountryIDForCountryName($country_name)
    {
        return DB::table('countries')->where("name",$country_name)->first()->id;
    }

    public function cityForStateAjax(Request $request)
    {
        $cities = null;
        $country_name = urldecode($request->input('country'));
        $state_name = urldecode($request->input('state'));
        if ($country_name == 'Kenya'){
            $cities = DB::table("kenya_towns")
                ->where('County', $state_name)
                ->get();
        }
        else{
            $state_id = $this->_cityStateIDForStateName($state_name);
            $cities = DB::table("cities")
                ->where("state_id",$state_id)
                ->get();
        }
        return json_encode($cities);
    }

    private function _cityStateIDForStateName($state_name)
    {
        return DB::table('states')->where("name",$state_name)->first()->id;
    }
}
