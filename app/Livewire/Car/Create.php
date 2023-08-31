<?php

namespace App\Livewire\Car;

use App\Models\Car;
use App\Models\CarFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use WithFileUploads, LivewireAlert;

    public $images = [], $brand, $model, $year, $price, $image;

    protected $rules = [
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|numeric',
        'price' => 'required|numeric',
        'image' => 'nullable'
    ];

    public function create()
    {
        $this->validate();

        $car = Car::create([
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
        ]);

        $this->saveImage($car->id);
        $this->reset('brand', 'model', 'year', 'price', 'image', 'images');
        $this->alert('success', 'Vehiculo creado correctamente.');
    }

    public function removeNewImage($index): void
    {
        array_splice($this->images, $index, 1);
    }

    public function updatedImage(): void
    {
        $this->images[] = $this->image;
    }

    public function saveImage($car_id): void
    {
        $data = [];

        foreach ($this->images as $image) {
            $filename = uniqid().'-'.$image->getClientOriginalName();
            $filepath = 'car/' . $car_id . '/';
            $image->storeAs($filepath, $filename, 'car_files');

            $data[] = [
                'path' => $filepath,
                'file' => $filename,
                'car_id' => $car_id
            ];
        }


        CarFile::insert($data);

        $this->images = [];
    }

    public function render()
    {
        return view('livewire.car.create');
    }
}
