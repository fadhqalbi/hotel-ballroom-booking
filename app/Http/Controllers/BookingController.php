<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingSummary;
use App\Models\Customer;
use App\Models\Room;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Customer $customer, Room $room)
    {
        $today = Carbon::now()->format('l j F Y');
        $date = Carbon::now()->toDateString();
        $bookings = Booking::all();

        return view('bookings.index',[
            'customers' => Customer::all(),
            'rooms' => Room::all(),
            'booking_details' => BookingDetail::all()
        ],compact('bookings','today','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // dd($request);
        $date = Carbon::now()->toDateString();
        $year = Carbon::now()->format('Y');
        $bookings = Booking::all();
        $records = Booking::where('no_booking', 'LIKE', 'INV'.$year.'%')->get()->last();
        if($records)
        {
            $lastnum = $records->no_booking;
            $lastnum = substr($lastnum, -4);
            $newnum = sprintf('%04d', $lastnum+1);
        }
        else
        {
            $newnum = '0001';
        }
        $no_booking = 'INV'.$year.$newnum;
        $date = explode(" ", $request->tgl_penggunaan_ruang);
        $start = new DateTime($date[0]);
        $end = new DateTime($date[2]);
        $lama_booking = $start->diff($end)->days;

        $validatedData = $request->validate([
            'nama_user' => 'required',
            'no_customer' => 'required',
            'tgl_booking' => 'required',
            'kode_ruang' => 'required',
            'tgl_penggunaan_ruang' => 'required',
        ]);
        try{
            DB::beginTransaction();
            Booking::create([
                'no_booking' => $no_booking,
                'nama_user' => $request->input('nama_user'),
                'no_customer' => $request->input('no_customer'),
                'tgl_booking' => $request->input('tgl_booking'),
            ]);
            BookingDetail::create([
                'no_booking' => $no_booking,
                'kode_ruang' => $request->input('kode_ruang'),
                'tgl_penggunaan_ruang' => $start->format('Y-m-d'),
                'lama_booking' => $lama_booking+1,
            ]);
            DB::commit();
            $result = [
                'status' => 'success',
                'message' => 'New booking has been added!'
            ];
        }
        catch(Exception $e){
            DB::rollBack();
            $result = [
                'status' => 'error',
                'message' => 'Failed to add new booking!'
            ];
        }
        return redirect()->route('booking.index')->with($result);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit',[
            'booking' => $booking,
            'bookings' => Booking::all(),
            'booking_details' => BookingDetail::all(),
            'customers' => Customer::all(),
            'rooms' => Room::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking, BookingDetail $bookingDetail)
    {
        // dd($request->all());
        $request->validate([
            'no_booking' => 'required',
            'nama_user' => 'required',
            'no_customer' => 'required',
            'tgl_booking' => 'required',
            'kode_ruang' => 'nullable',
            'tgl_penggunaan_ruang' => 'required',
            'lama_booking' => 'required',
        ]);

        try{
            DB::beginTransaction();
            $booking->where('no_booking',$request->input('no_booking'))
                    ->update([
                            'nama_user' => $request->input('nama_user'),
                            'no_customer' => $request->input('no_customer'),
                            'tgl_booking' => $request->input('tgl_booking'),
            ]);
            $bookingDetail->where('no_booking',$request->input('no_booking'))
                        ->update([
                            'kode_ruang' => $request->input('kode_ruang'),
                            'tgl_penggunaan_ruang' => $request->input('tgl_penggunaan_ruang'),
                            'lama_booking' => $request->input('lama_booking'),
            ]);
            DB::commit();
            $result = [
                'status' => 'success',
                'message' => 'Booking data has been updated!'
            ];
        }
        catch(Exception $e){
            DB::rollBack();
            $result = [
                'status' => 'error',
                'message' => 'Failed to update booking data!'
            ];
        }
        return redirect()->route('booking.index')->with($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        Booking::destroy($booking->no_booking);
        return redirect()->route('booking.index')->with([
                    'status' => 'success',
                    'message' => 'Booking data has been deleted!'
                ]);
    }

    public function summary(Booking $booking)
    {
        return view('bookings.summary',[
            'summary' => BookingSummary::all(),
            'rooms' => Room::all()
        ]);
    }

    public function getsummary(Booking $booking)
    {

    }
}
