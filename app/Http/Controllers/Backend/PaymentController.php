<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository) {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->paymentRepository->basePaginate();
        $columns = $this->paymentRepository->getAccessibleColumn();

        return view('backend.payments.index',compact('entities','columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $fillable_columns = $this->paymentRepository->getFillableColumn();
        $method = 'CCP';

        return view('backend.payments.create',compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->processRequestForStore($request);
        $this->paymentRepository->baseCreate( $data);

        return redirect(route('payment.index'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->baseFindOrFail( $id);
        $this->paymentRepository->delete($payment);
        return redirect()->back();
    }



/*
|---------------------------------------------------------------------------|
| CUSTOM FUNCTION                                                           |
|---------------------------------------------------------------------------|
*/

    public function processRequestForStore(Request $request){
        return $request->only(['method','contact_info','phone_number']);
    }
}
