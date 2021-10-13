<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\TrademarkRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TradeMarksDatatable;
use App\TradeMark;
use Storage;

class TradeMarksController extends Controller
{
    protected $tradeMark;
    protected $model;

    /**
     * TradeMarksController constructor.
     * @param TrademarkRepositoryInterface $trademarkRepository
     * @param TradeMark $trademarkModel
     */
    public function __construct(TrademarkRepositoryInterface $trademarkRepository, TradeMark $trademarkModel)
    {
        $this->tradeMark = $trademarkRepository;
        $this->model = $trademarkModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarksDatatable $tradeMark)
    {
        /**
         * data in datatable comes from CountriesDatatable query method not this method
         */
        TradeMark::select('*')->get();
        return $tradeMark->render('admin.trademarks', ['title' => __('trademarksController')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = [
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
            'trademarkIcon'  => $request->trademarkIcon,

        ];
        $tradeMark = $this->tradeMark->store($attributes, $this->model);
        if($tradeMark == true){
            $data = [
                'tradeMark'  => $tradeMark,
                'toast'    => 'success',
                'message'  => __('created')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_created')
            ] ;
        }
        return $data;
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
        $title = __('edit');
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

