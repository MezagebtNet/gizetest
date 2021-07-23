<?php

namespace App\Http\Controllers\Admin\SystemConfigs;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{

    public function addTodo($id, $name)
    {
        return 1;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('system_setting'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $currencies = Currency::all();

        return view('admin.system_configs.currencies.index', compact('currencies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('system_setting'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.system_configs.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency_name' => 'required|unique:currencies,currency_name|max:255',
            'currency_code' => 'required|unique:currencies,currency_code|max:5',
        ]);

        $currency = Currency::create($validated);

        return redirect()->route('admin.system_configs.currencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        abort_if(Gate::denies('system_setting'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.system_configs.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        abort_if(Gate::denies('system_setting'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.system_configs.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'currency_name' => 'required|max:255|unique:currencies,currency_name,' . $currency->id . ',id',
            'currency_code' => 'required|max:5|unique:currencies,currency_code,' . $currency->id . ',id',
        ]);

        $currency->update($validated);

        return redirect()->route('admin.system_configs.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        abort_if(Gate::denies('system_setting'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $currency->delete();

        return redirect()->route('admin.system_configs.currencies.index');
    }
}
