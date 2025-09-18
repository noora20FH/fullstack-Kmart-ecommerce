<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;

use Livewire\Component;

class PrincingCheck extends Component
{
    public string $destination = '';
    public array $resultDestination = [];

    public function searchDestination()
    {
        $this->resultDestination = Http::withHeader('key', config('rajaongkir.api_key'))
            ->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . $this->destination . '&limit=999&offset=999')
            ->json('data');
    }

    public function render()
    {
        return view('livewire.princing-check');
    }
}
