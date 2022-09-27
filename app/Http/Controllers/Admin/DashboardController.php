<?php

namespace App\Http\Controllers\Admin;


use App\Codes\Logic\generateLogic;
use App\Codes\Models\Admin;
use App\Codes\Models\Settings;
use App\Codes\Models\V1\AppointmentDoctor;
use App\Codes\Models\V1\AppointmentDoctorProduct;
use App\Codes\Models\V1\AppointmentLab;
use App\Codes\Models\V1\Article;
use App\Codes\Models\V1\Invoice;
use App\Codes\Models\V1\Klinik;
use App\Codes\Models\V1\Lab;
use App\Codes\Models\V1\LabKlinikService;
use App\Codes\Models\V1\Product;
use App\Codes\Models\V1\Service;
use App\Codes\Models\V1\Sliders;
use App\Codes\Models\V1\Transaction;
use App\Codes\Models\V1\Users;
use App\Codes\Models\V1\UsersCartDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->data = [
            'thisLabel' => 'Dashboard',
            'thisRoute' => 'dashboard',
        ];
    }

    public function dashboard()
    {
        $data = $this->data;

        return view(env('ADMIN_TEMPLATE').'.page.dashboard', $data);
    }

}
