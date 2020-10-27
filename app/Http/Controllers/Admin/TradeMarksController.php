<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TradeMarksDatatable;
use App\TradeMark;
use Storage;

class TradeMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarksDatatable $tradeMark)
    {
        /*
            data in datatable comes from CountriesDatatable query method
            not this method
        */
        $data = TradeMark::select('*')->whereNotIn('status', [-1])->get();
        return $tradeMark->render('admin.trademarks.index', ['title' => __('admin.trademarksController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create', ['title'=> trans("admin.add")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ar'              => 'required|min:3|max:50',
            'name_en'    		   => 'required|min:3|max:50',
            'trademarkIcon'        => 'required|max:10000|'.validate_image(),
        ]);
        if($validatedData){
            if($request->hasFile('trademarkIcon')){
                $validatedData['trademarkIcon'] = up()->upload([
                    'file'        => 'trademarkIcon',
                    'path'        => 'tradeMarks',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            TradeMark::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/trademarks'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tradeMark = TradeMark::find($id);
        $title = __('admin.edit');
        return view('admin.trademarks.edit', compact('tradeMark', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_ar'              => 'required|min:3|max:50',
            'name_en'              => 'required|min:3|max:50',
            'trademarkIcon'        => 'max:10000|'.validate_image(),
        ]);

        if($validatedData){

            $tradeMark = TradeMark::find($id);
            if($request->hasFile('trademarkIcon')){
                $validatedData['trademarkIcon'] = up()->upload([
                    'file'        => 'trademarkIcon',
                    'path'        => 'trademarkIcon',
                    'upload_type' => 'single',
                    'delete_file' => $tradeMark->trademarkIcon,
                ]);
            }
            TradeMark::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/trademarks'));
        }
    }

    /**
    * Remove the specified resourse from storage.
    */
    public function delete_trade_mark($id){
        $tradeMark = TradeMark::find($id);
        Storage::delete($tradeMark->trademarkIcon);
        $tradeMark->status = -1;
        $tradeMark->trademarkIcon = null;
        $tradeMark->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_trade_mark($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $tradeMarksIDs = $request->item;
        foreach ($tradeMarksIDs as $key => $tradeMarkID) {
            self::delete_trade_mark($tradeMarkID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}

