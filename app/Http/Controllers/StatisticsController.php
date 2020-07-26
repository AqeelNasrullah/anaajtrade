<?php

namespace App\Http\Controllers;

use App\MedicineType;
use App\RiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $account = $this->getAccountBook();
        $oil = $this->getOil();
        $fertilizer = $this->getFertilizerStock();
        $fert_record = $this->getFertilizerRecord();
        $medicine = $this->getMedicineStock();
        $med_record = $this->getMedicineRecord();
        $wheat = $this->getWheatStock();
        $wh_record = $this->getWheatRecord();
        $rice = $this->getRiceStock();
        $ri_record = $this->getRiceRecord();
        $others = $this->getOther();
        return view('dashboard.statistics', [
            'account' => $account, 'oil' => $oil, 'fertilizer' => $fertilizer, 'fert_record' => $fert_record,
            'medicine' => $medicine, 'med_record' => $med_record, 'wheat' => $wheat, 'wh_record' => $wh_record,
            'rice' => $rice, 'ri_record' => $ri_record, 'others' => $others
        ]);
    }

    // Get Account Book
    public function getAccountBook()
    {
        $account = [];
        $week_date = date('Y-m-d', strtotime('-1 week', time()));
        $month_date = date('Y-m-d', strtotime('-1 month', time()));
        $season_date = date('Y-m-d', strtotime('-6 month', time()));
        $account['weekly_loan'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Loan')->where('created_at', '>', $week_date)->first();
        $account['weekly_returned'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Returned')->where('created_at', '>', $week_date)->first();
        $account['monthly_loan'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Loan')->where('created_at', '>', $month_date)->first();
        $account['monthly_returned'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Returned')->where('created_at', '>', $month_date)->first();
        $account['seasonly_loan'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Loan')->where('created_at', '>', $season_date)->first();
        $account['seasonly_returned'] = Auth::user()->accountBooks()->selectRaw('sum(amount) as amount')->where('type', 'Returned')->where('created_at', '>', $season_date)->first();

        return $account;
    }

    // Get Oil
    public function getOil()
    {
        $oil = [];
        $week_date = date('Y-m-d', strtotime('-1 week', time()));
        $month_date = date('Y-m-d', strtotime('-1 month', time()));
        $season_date = date('Y-m-d', strtotime('-6 month', time()));

        $oil['weekly_oil'] = Auth::user()->oilRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $week_date)->first();
        $oil['monthly_oil'] = Auth::user()->oilRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $month_date)->first();
        $oil['seasonly_oil'] = Auth::user()->oilRecords()->selectRaw('sum(quantity) as quantity')->where('created_at', '>', $season_date)->first();

        $oil['weekly_amount'] = Auth::user()->oilRecords()->selectRaw('sum(quantity * paid_per_litre) as amount')->where('created_at', '>', $week_date)->first();
        $oil['monthly_amount'] = Auth::user()->oilRecords()->selectRaw('sum(quantity * paid_per_litre) as amount')->where('created_at', '>', $month_date)->first();
        $oil['seasonly_amount'] = Auth::user()->oilRecords()->selectRaw('sum(quantity * paid_per_litre) as amount')->where('created_at', '>', $season_date)->first();

        $oil['weekly_profit'] = Auth::user()->oilRecords()->selectRaw('sum((quantity * paid_per_litre) - (quantity * price_per_litre)) as amount')->where('created_at', '>', $week_date)->first();
        $oil['monthly_profit'] = Auth::user()->oilRecords()->selectRaw('sum((quantity * paid_per_litre) - (quantity * price_per_litre)) as amount')->where('created_at', '>', $month_date)->first();
        $oil['seasonly_profit'] = Auth::user()->oilRecords()->selectRaw('sum((quantity * paid_per_litre) - (quantity * price_per_litre)) as amount')->where('created_at', '>', $season_date)->first();

        return $oil;
    }

    // Get Fertilizer Stock
    public function getFertilizerStock()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $types = ['Urea', 'DAP'];
        $fertilizer = $stock = $trans = [];

        foreach ($types as $type) {
            foreach ($dates as $key => $date) {
                $stock[$key] = Auth::user()->fertilizerStocks()->selectRaw('sum(quantity) as quantity')->where('type', $type)->where('created_at', '>', $date)->first();
                $trans[$key] = $stock[$key]->quantity;
            }
            $fertilizer[$type] = $trans;
        }

        return $fertilizer;
    }

    // get Fertilizer Record
    public function getFertilizerRecord()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Sale', 'Total Amount', 'Profit']; $types = ['Urea', 'DAP'];
        $fertilizer = $outer_record = $record = [];

        foreach ($types as $type ) {
            foreach ($trans as $tr ) {
                if ($tr == 'Sale') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity) as quantity')->where('type', $type)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tr == 'Total Amount') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->fertilizerRecords()->selectRaw('sum(quantity * paid) as quantity')->where('type', $type)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tr == 'Profit') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->fertilizerRecords()->selectRaw('sum((quantity * paid) - (quantity * price)) as quantity')->where('type', $type)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                }
                $outer_record[$tr] = $inner_record;
            }
            $fertilizer[$type] = $outer_record;
        }

        return $fertilizer;
    }

    // Get Medicine Stock
    public function getMedicineStock()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $types = MedicineType::all();
        $medicine = $stock = $stock_inner = [];

        foreach ($types as $type) {
            foreach ($dates as $key => $date) {
                $stock[$key] = Auth::user()->medicineStocks()->selectRaw('sum(quantity) as quantity')->where('medicine_type_id', $type->id)->where('created_at', '>', $date)->first();
                $stock_inner[$key] = $stock[$key]->quantity;
            }
            $medicine[$type->name . ' (' . $type->type . ')'] = $stock_inner;
        }

        return $medicine;
    }

    // get Medicine Record
    public function getMedicineRecord()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Sale', 'Total Amount', 'Profit']; $types = MedicineType::all();
        $medicine = $outer_record = $record = [];

        foreach ($types as $type ) {
            foreach ($trans as $tr ) {
                if ($tr == 'Sale') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->medicineRecords()->selectRaw('sum(quantity) as quantity')->where('medicine_type_id', $type->id)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tr == 'Total Amount') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->medicineRecords()->selectRaw('sum(quantity * paid) as quantity')->where('medicine_type_id', $type->id)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tr == 'Profit') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->medicineRecords()->selectRaw('sum((quantity * paid) - (quantity * price)) as quantity')->where('medicine_type_id', $type->id)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                }
                $outer_record[$tr] = $inner_record;
            }
            $medicine[$type->name . ' (' . $type->type . ')'] = $outer_record;
        }

        return $medicine;
    }

    // Get Wheat Stock
    public function getWheatStock()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Stock', 'Total Price', 'Profit']; $categ = ['A', 'B', 'C', 'D'];
        $wheat = $stock = $inner_stock = $outer_stock = [];

        foreach ($categ as $value) {
            foreach ($trans as $tran) {
                if ($tran == 'Stock') {
                    foreach ($dates as $key => $date) {
                        $stock[$key] = Auth::user()->wheatStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_stock[$key] = $stock[$key]->quantity;
                    }
                } else if ($tran == 'Total Price') {
                    foreach ($dates as $key => $date) {
                        $stock[$key] = Auth::user()->wheatStocks()->selectRaw('sum(((num_of_sack * weight_per_sack) / 40) * price) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_stock[$key] = $stock[$key]->quantity;
                    }
                } else if ($tran == 'Profit') {
                    foreach ($dates as $key => $date) {
                        $stock[$key] = Auth::user()->wheatStocks()->selectRaw('sum((commission / 100) * (((num_of_sack * weight_per_sack) / 40) * price)) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_stock[$key] = $stock[$key]->quantity;
                    }
                }
                $outer_stock[$tran] = $inner_stock;
            }
            $wheat[$value] = $outer_stock;
        }

        return $wheat;
    }

    // Get Wheat Record
    public function getWheatRecord()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Sale', 'Total Price', 'Profit']; $categ = ['A', 'B', 'C', 'D'];
        $wheat = $record = $inner_record = $outer_record = [];

        foreach ($categ as $value) {
            foreach ($trans as $tran) {
                if ($tran == 'Sale') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->wheatRecords()->selectRaw('sum(quantity) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tran == 'Total Price') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->wheatRecords()->selectRaw('sum(quantity * paid_per_mann) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                } else if ($tran == 'Profit') {
                    foreach ($dates as $key => $date) {
                        $record[$key] = Auth::user()->wheatRecords()->selectRaw('sum((quantity * paid_per_mann) - (quantity * price_per_mann)) as quantity')->where('category', $value)->where('created_at', '>', $date)->first();
                        $inner_record[$key] = $record[$key]->quantity;
                    }
                }
                $outer_record[$tran] = $inner_record;
            }
            $wheat[$value] = $outer_record;
        }

        return $wheat;
    }

    // Get Rice Stock
    public function getRiceStock()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Stock', 'Total Price', 'Profit']; $categ = ['A', 'B', 'C', 'D'];
        $types = RiceType::all();

        $rice = $stock = $inner_stock = $outer_stock = $last_stock = [];

        foreach ($types as $value) {
            foreach ($categ as $cat) {
                foreach ($trans as $tran) {
                    if ($tran == 'Stock') {
                        foreach ($dates as $key => $date) {
                            $stock[$key] = Auth::user()->riceStocks()->selectRaw('sum(num_of_sack * weight_per_sack) as quantity')->where('category', $cat)->where('rice_type_id', $value->id)->where('created_at', '>', $date)->first();
                            $inner_stock[$key] = $stock[$key]->quantity;
                        }
                    } else if ($tran == 'Total Price') {
                        foreach ($dates as $key => $date) {
                            $stock[$key] = Auth::user()->riceStocks()->selectRaw('sum(((num_of_sack * weight_per_sack) / 40) * price) as quantity')->where('category', $cat)->where('rice_type_id', $value->id)->where('created_at', '>', $date)->first();
                            $inner_stock[$key] = $stock[$key]->quantity;
                        }
                    } else if ($tran == 'Profit') {
                        foreach ($dates as $key => $date) {
                            $stock[$key] = Auth::user()->riceStocks()->selectRaw('sum((commission / 100) * (((num_of_sack * weight_per_sack) / 40) * price)) as quantity')->where('rice_type_id', $value->id)->where('category', $cat)->where('created_at', '>', $date)->first();
                            $inner_stock[$key] = $stock[$key]->quantity;
                        }
                    }
                    $outer_stock[$tran] = $inner_stock;
                }
                $last_stock[$cat] = $outer_stock;
            }
            $rice[$value->name] = $last_stock;
        }

        return $rice;
    }

    // Get Rice Record
    public function getRiceRecord()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $trans = ['Sale', 'Total Price', 'Profit']; $categ = ['A', 'B', 'C', 'D'];
        $types = RiceType::all();

        $rice = $record = $inner_record = $outer_record = $last_record = [];

        foreach ($types as $value) {
            foreach ($categ as $cat) {
                foreach ($trans as $tran) {
                    if ($tran == 'Sale') {
                        foreach ($dates as $key => $date) {
                            $record[$key] = Auth::user()->riceRecords()->selectRaw('sum(quantity) as quantity')->where('category', $cat)->where('rice_type_id', $value->id)->where('created_at', '>', $date)->first();
                            $inner_record[$key] = $record[$key]->quantity;
                        }
                    } else if ($tran == 'Total Price') {
                        foreach ($dates as $key => $date) {
                            $record[$key] = Auth::user()->riceRecords()->selectRaw('sum(quantity * paid_per_mann) as quantity')->where('category', $cat)->where('rice_type_id', $value->id)->where('created_at', '>', $date)->first();
                            $inner_record[$key] = $record[$key]->quantity;
                        }
                    } else if ($tran == 'Profit') {
                        foreach ($dates as $key => $date) {
                            $record[$key] = Auth::user()->riceRecords()->selectRaw('sum((quantity * paid_per_mann) - (quantity * price_per_mann)) as quantity')->where('rice_type_id', $value->id)->where('category', $cat)->where('created_at', '>', $date)->first();
                            $inner_record[$key] = $record[$key]->quantity;
                        }
                    }
                    $outer_record[$tran] = $inner_record;
                }
                $last_record[$cat] = $outer_record;
            }
            $rice[$value->name] = $last_record;
        }

        return $rice;
    }

    // Get Other
    public function getOther()
    {
        $weekly_date = date('Y-m-d', strtotime('-1 week', time()));
        $monthly_date = date('Y-m-d', strtotime('-1 month', time()));
        $seasonly_date = date('Y-m-d', strtotime('-6 month', time()));
        $dates = ['weekly' => $weekly_date, 'monthly' => $monthly_date, 'seasonly' => $seasonly_date];
        $others = [];

        foreach ($dates as $key => $value) {
            $others[$key] = Auth::user()->others()->where('created_at', '>', $value)->sum('amount');
        }

        return $others;
    }
}
