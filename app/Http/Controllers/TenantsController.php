<?php

namespace App\Http\Controllers;

use App\BillType;
use App\Country;
use App\State;
use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class TenantsController extends Controller
{
    //
    public function actions () {
        return view('tenants.actions');
    }

    public function reports() {
        return view('tenants.reports');
    }

    public function newTenant() {
        return view('tenants.createTenant', ['billTypes' => BillType::all(), 'countries' => Country::all(), 'states' => State::all()]);
    }

    public function removeTenant($id) {
        $item = Tenant::find($id);

        if ($item != null){
            $item->delete();
            return redirect('/tenant/reports/show')->with('message','Tenant Successfully Deleted');
        }
        else {
            return redirect('/tenant/reports/show')->with('message','Unable to Delete');
        }
    }

    public function editTenant($id) {
        return view('tenants.editTenant', ['billTypes' => BillType::all(), 'tenant' => Tenant::find($id), 'countries' => Country::all(), 'states' => State::all()]);
    }

    public function editCompleteTenant(Request $request) {

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

        $title = $request->input('title_group');

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
        $bill_type = $request->input('billtype');

        $document = null;
        if ($request->hasFile('fileUpload')) {
            $docFile = $request->file('fileUpload');
            $newFileName = time().'-'.$docFile->getClientOriginalName();

            $docFile->move(storage_path().'/tenants', $newFileName);
            $document = $newFileName;
        }

        $id = $request->input('tenantId');
        $tenant = Tenant::whereId($id);

        $currentEmail = $tenant->select('email')->first()->email;
        if ($currentEmail != $email)
        {
            $user = User::where('email', $currentEmail)->first();
            if ($user != null) {
                $user->update(array('email' => $email));
            }
        }

        $tenant->update([
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
            'document' => $document,
            'email' => $email,
            'bill_type' => implode(',', $bill_type),
        ]);

        return redirect()->route('show_tenants');
    }

    public function saveTenant(Request $request) {

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
        $bill_type = $request->input('billtype');

        $document = null;
        if ($request->hasFile('fileUpload')) {
            $docFile = $request->file('fileUpload');
            $newFileName = time().'-'.$docFile->getClientOriginalName();

            $docFile->move(storage_path().'/tenants', $newFileName);
            $document = $newFileName;
        }

        $tenant = new Tenant();
        $tenant->title = $title;
        $tenant->first_name = $first_name;
        $tenant->middle_name = $middle_name;
        $tenant->sur_name = $sur_name;
        $tenant->id_number = $id_number;
        $tenant->pin_number = $pin_number;
        $tenant->vat_number = $vat_number;
        $tenant->primary_phone_number = $primary_phone;
        $tenant->alternate_phone_number = $alternate_phone;
        $tenant->primary_phone_code = $primary_phone_code;
        $tenant->alternate_phone_code = $alternate_phone_code;
        $tenant->primary_country_code = $primary_country_code;
        $tenant->alternate_country_code = $alternate_country_code;
        $tenant->po_box = $po_box;
        $tenant->postal_code = $postal_code;
        $tenant->country = $country;
        $tenant->state = $state;
        $tenant->city = $city;
        $tenant->document = $document;
        $tenant->email = $email;
        $tenant->bill_type = implode(',', $bill_type);

        $tenant->save();

        //Saving to user table with credentials
        $user = new User();
        if ($middle_name == null)
            $user->name = $first_name.' '.$sur_name;
        else
            $user->name = $first_name.' '.$middle_name.' '.$sur_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->roleId =  4;
        $user->save();

        return redirect()->route('new_tenant');
    }

    public function showTenants(Request $request) {
        if ($request->ajax()) {
            $tenants = Tenant::all();
            return DataTables::of($tenants)
                ->addIndexColumn()
                ->addColumn('tenant_name', function($row){
                    return $row->title.' '.$row->first_name.' '.$row->middle_name.' '.$row->sur_name;
                })
                ->addColumn('phone_number', function($row){
                    return '+'.$row->primary_phone_code.' '.$row->primary_phone_number;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="/tenant/tenants/edit/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i>EDIT</a>';
                    return $btn;
                })
                ->editColumn('delete', function($row){
                    $btn = '<a href="/tenant/tenants/remove/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i>DELETE</a>';
                    return $btn;
                })
                ->rawColumns(['delete' => 'delete', 'action' => 'action'])
                ->make(true);
        }

        return view('tenants.showTenants');
    }
}
