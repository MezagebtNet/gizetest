<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use Livewire\Component;

class Currencies extends Component
{
    public $currencies, $currency_name, $currency_code, $currency_id;
    public $updateMode = false;

    public function index()
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all();

        return view('livewire.currencies', compact('currencies'));

    }

    public function render()
    {
        $this->currencies = Currency::all();
        return view('livewire.currencies');
    }

    private function resetInputFields()
    {
        $this->currency_name = '';
        $this->currency_code = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'currency_name' => 'required',
            'currency_code' => 'required|email',
        ]);

        Currency::create($validatedData);

        session()->flash('message', 'Currency Created Successfully.');

        $this->resetInputFields();

        $this->emit('currencyStore'); // Close modal by sending event to jquery

    }

    public function edit($id)
    {
        $this->updateMode = true;
        $currency = Currency::where('id', $id)->first();
        $this->currency_id = $id;
        $this->currency_name = $currency->currency_name;
        $this->currency_code = $currency->currency_code;

    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();

    }

    public function update()
    {
        $validatedData = $this->validate([
            'currency_name' => 'required',
            'currency_code' => 'required',
        ]);

        if ($this->currency_id) {
            $currency = Currency::find($this->currency_id);
            $currency->update([
                'currency_name' => $this->currency_name,
                'currency_code' => $this->currency_code,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Currency Updated Successfully.');
            $this->resetInputFields();

        }
    }

    public function delete($id)
    {
        if ($id) {
            Currency::where('id', $id)->delete();
            session()->flash('message', 'Currency Deleted Successfully.');
        }
    }
}
