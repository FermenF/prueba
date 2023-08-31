<?php

namespace App\Livewire\Car;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = [ 'confirmed' ];

    public $car_id = null;

    public $cars;
    public $filter_brand = "", $filter_model = "";
    public $availableBrands = [];

    public function destroy($id, $brand, $model)
    {
        $this->car_id = $id;

        $this->alert('question', '¿Estás seguro de eliminar este vehiculo: , '. $brand .' '. $model .'?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Sí, eliminar',
            'confirmButtonColor' => 'darkred',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'timer' => 5000,
            'onConfirmed' => 'confirmed'
        ]);
    }

    public function confirmed()
    {
        try {
            Car::destroy($this->car_id);
            $this->alert('success', 'Vehiculo eliminado correctamente.');
            $this->car_id = null;

        } catch (\Throwable $th) {
            $this->alert('error', 'Error al eliminar vehiculo.');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->availableBrands = Car::distinct('brand')->pluck('brand');
    }

    public function render()
    {
        $this->cars = Car::byBrand($this->filter_brand)->byModel($this->filter_model)
            ->get(['id', 'brand', 'model', 'year', 'price']);

        return view('livewire.car.index');
    }
}








