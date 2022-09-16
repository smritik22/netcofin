<?php

namespace App\Http\Controllers\BusinessOwner\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Items;
use App\Models\Modifiers;


class SubscriptionPlanController extends Controller
{
    public function index(Request $request)
    {
       
        return view("businessOwner.dashboard.subscriptionPlan.list");
    }
}
