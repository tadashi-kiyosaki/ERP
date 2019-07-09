<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyStatus;
use App\PropertyType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Landlord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;

class PropertiesController extends Controller
{
    //
    public function actions () {
        return view('properties.actions');
    }

    public function reports() {
        return view('properties.reports');
    }

    public function propertyDetails(Request $request) {

        if ($request->ajax()) {
            $propertyStatus = PropertyStatus::all();

            $new_properties = new Collection;

            foreach ($propertyStatus as $status)
            {
                $property = DB::table("tbl_properties")->where("id", $status->property_id)->first();
                $type_name = DB::table("tbl_property_types")->where("id", $property->type)->first()->{'property_type'};
                $tenant = DB::table("tbl_tenants")->where("id", $status->tenant_id)->first();
                $tenant_name = $tenant->title.' '.$tenant->first_name.' '.$tenant->middle_name.' '.$tenant->sur_name;
                $Mgt = 'No';
                if ($property->mgt == 1)
                    $Mgt = 'Yes';
                $array = [
                    'unit_type' => $type_name,
                    'size' => $property->size,
                    'mgt' => $Mgt,
                    'tenant_name' => $tenant_name,
                    'unit_rent' => $property->unit_rent,
                    'start_date' => $status->start_date,
                    'end_date' => $status->end_date,
                    'service_charges' => $property->service_charges,
                    'deposit' => $status->deposit,
                ];
                $new_properties->push($array);
            }

//            dd($new_properties);

            return DataTables::of($new_properties)
                ->addIndexColumn()
//                ->addColumn('unit_type', function($row){
//                    dd($row->unit_type);
//                    return $row->unit_type;
//                })
//                ->addColumn('size', function($row){
//                    return $row->size;
//                })
//                ->addColumn('mgt', function($row){
//                    return $row->mgt;
//                })
//                ->addColumn('tenant_id', function($row){
//                    return $row->tenant_id;
//                })
//                ->addColumn('unit_rent', function($row){
//                    return $row->unit_rent;
//                })
//                ->addColumn('start_date', function($row){
//                    return $row->start_date;
//                })
//                ->addColumn('end_date', function($row){
//                    return $row->end_date;
//                })
//                ->addColumn('service_charges', function($row){
//                    return $row->service_charges;
//                })
//                ->addColumn('deposit', function($row){
//                    return $row->deposit;
//                })
                ->make(true);
        }
        return view('properties.showProperties');
    }

    public function newProperty() {
        return view('properties.createProperty', ['landlords' => Landlord::all(), 'types' => PropertyType::all()]);
    }

    public function saveProperty(Request $request) {

        $validator = Validator::make($request->all(), [
            'landlord' => 'required',
            'propertyType' => 'required',
            'size' => 'required',
            'mgt' => 'required',
            'unitRent' => 'required',
            'serviceCharges' => 'required',
        ]);

        if ($validator->fails())
        {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $landlord = $request->input('landlord');
        $type = $request->input('propertyType');
        $size = $request->input('size');
        if ($request->input('mgt') == "yes")
            $mgt = true;
        else
            $mgt = false;
        $unitRent = $request->input('unitRent');
        $serviceCharges = $request->input('serviceCharges');

        $property = new Property();
        $property->landlord_id = $landlord;
        $property->type = $type;
        $property->size = $size;
        $property->mgt = $mgt;
        $property->unit_rent = $unitRent;
        $property->service_charges = $serviceCharges;
        $property->occupation_status = false;

        $property->save();

        return redirect()->route('new_property');

    }

    public function rentProperty() {
        $tenant = DB::table('tbl_tenants')
                    ->where('email', Auth::user()->email)
                    ->first();
        return view('properties.rentProperty', ['tenant' => $tenant, 'landlords' => Landlord::all(), 'types' => PropertyType::all()]);
    }

    public function rentComplete(Request $request) {
        $validator = Validator::make($request->all(), [
            'landlord' => 'required',
            'propertyType' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'deposit' => 'required',
        ]);

        if ($validator->fails())
        {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tenantId = $request->input('tenantId');
        $landlord = $request->input('landlord');
        $type = $request->input('propertyType');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $deposit = $request->input('deposit');

        $propertyStatus = new PropertyStatus();

        $propertyStatus->property_id = $type;
        $propertyStatus->tenant_id = $tenantId;
        $propertyStatus->start_date = Carbon::parse($startDate);
        $propertyStatus->end_date = Carbon::parse($endDate);
        $propertyStatus->deposit = $deposit;

        $propertyStatus->save();

        $property = Property::where('id', $type)->first();
        if ($property != null) {
            $property->update(array('occupation_status' => true));
        }

        return redirect()->route('rent_property');
    }

    public function propertyForLandlordAjax($landlordId) {
        $landlord_id = urldecode($landlordId);
//        dd($landlord_id);
        $properties = DB::table("tbl_properties")
            ->where('landlord_id', $landlord_id)
            ->where('occupation_status', false)
            ->get();
        $new_properties = [];
        foreach ($properties as $property)
        {
            $name = DB::table("tbl_property_types")->where("id", $property->id)->first()->{'property_type'};
            $array = [
                'id' => $property->id,
                'name' => $name,
                'landlord_id' => $property->landlord_id,
                'type' => $property->type,
                'size' => $property->size,
                'mgt' => $property->mgt,
                'unit_rent' => $property->unit_rent,
                'service_charges' => $property->service_charges,
                'occupation_status' => $property->occupation_status,
            ];
            array_push($new_properties, $array);
        }
        return json_encode($new_properties);
    }
}
