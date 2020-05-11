<?php

namespace App\Http\Controllers;

use App\Consumption;
use App\Resource;
use App\Branch;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(Request $request)
    {
        $consumptions = Consumption::query();

        // limit access for branches
        if (branch()) {
            $branch = Branch::where('user_id', auth()->id())->first();
            if (!$branch) {
                return back()->withError('Not a valid branch');
            }
            $consumptions = $consumptions->where('branch_id', $branch->id);
        }

        // filter results
        if ($request->b && is_array($request->b) && count($request->b)) {
            $consumptions = $consumptions->whereIn('branch_id', $request->b);
        }

        if ($request->r && is_array($request->r) && count($request->r)) {
            $consumptions = $consumptions->whereIn('resource_id', $request->r);
        }

        if ($request->q && is_array($request->q) && count($request->q)) {
            $consumptions = $consumptions->whereIn('quarter', $request->q);
        }

        if ($request->y) {
            $consumptions = $consumptions->where('year', $request->y);
        }


        // search box neccessary variables
        $branches = Branch::all();
        $resources = Resource::all();

        $consumptions = $consumptions->latest()->paginate(25);
        return view('app.consumption.index', compact('consumptions', 'branches', 'resources'));
    }

    public function create()
    {
        $consumption = new Consumption;
        $resources = Resource::all();
        return view('app.consumption.form', compact('consumption','resources'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        $branch = Branch::where('user_id', auth()->id())->first();
        if (!$branch) {
            return back()->withError('Not a valid branch');
        }
        $data['branch_id'] = $branch->id;
        $data['target'] = $branch->getQuantityValue('resource', $request->resource_id);
        Consumption::create($data);
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public function edit(Consumption $consumption)
    {
        $resources = Resource::all();
        return view('app.consumption.form', compact('consumption','resources'));
    }

    public function update(Request $request, Consumption $consumption)
    {
        $data = self::validation($consumption);
        $consumption->update($data);
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public function destroy(Consumption $consumption)
    {
        $consumption->delete();
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public static function validation($consumption=null)
    {
        $data = request()->validate([
            'resource_id' => 'required|exists:resources,id',
            'amount' => 'required|integer',
            'quarter' => 'required|integer|between:1,4',
            'year' => 'required|integer|digits:4',
        ]);

        if ($new_file = request('document')) {
            $old_file = $consumption ? $consumption->document : null;
            $data['document'] = upload($new_file, $old_file);
        }

        return $data;
    }
}
