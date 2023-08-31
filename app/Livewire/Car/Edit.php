<?php

namespace App\Livewire\Car;

use App\Models\Car;
use App\Models\CarFile;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    protected $listeners = ['confirmed', 'confirmed2'];

    public $url, $car;
    public $brand, $model, $year, $price, $image;
    public $images = [];
    public $image_id = null;
    public $new_image_id = null;

    public $new_images = [], $new_image;

    protected $rules = [
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|numeric',
        'price' => 'required|numeric',
        'new_image' => 'nullable|max:4096'
    ];

    public function mount($id)
    {
        $this->car = Car::with('files:id,path,file,car_id')->find($id);

        if($this->car){
            $this->brand = $this->car->brand;
            $this->model = $this->car->model;
            $this->year = $this->car->year;
            $this->price = $this->car->price;
            $this->images = $this->car->files;
        }
    }

    public function updatedNewImage()
    {
        $this->new_images[] = $this->new_image;
    }

    public function removeImage($id)
    {
        $this->image_id = $id;
        $this->messageDeleteImage(1);
    }

    public function messageDeleteImage($type_image)
    {
        {
            $options = [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Sí, eliminar',
                'confirmButtonColor' => 'darkred',
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'timer' => 5000,
            ];

            $options['onConfirmed'] = ($type_image == 1) ? 'confirmed' : 'confirmed2';

            return $this->alert('question', '¿Estás seguro de eliminar este archivo?', $options);
        }
    }

    public function confirmed()
    {
        try {

            $image = CarFile::find($this->image_id);
            if ($image) {
                $path  = public_path('app/'.$image->path.$image->name);
                if(File::exists($path)){
                    File::delete($path);
                }
            }
            $image->delete();
            $this->image_id = null;

            $this->render();
            $this->images = $this->car->files;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function confirmed2()
    {
        array_splice($this->new_images, $this->new_image_id, 1);
        $this->new_image_id = null;
    }

    public function removeNewImage($index)
    {
        $this->new_image_id = $index;
        $this->messageDeleteImage(2);
    }

    public function update()
    {
        $this->validate();

        try {
            $this->car->update([
                'brand' => $this->brand,
                'model' => $this->model,
                'year' => $this->year,
                'price' => $this->price,
            ]);

            if($this->new_images){
                $this->saveImage($this->car->id);
            }

            $this->alert('success', 'Vehiculo actualizado correctamente');

        } catch (\Throwable $th) {
            $this->alert('success', 'Error al actualizar vehiculo '. $th->getMessage());
        }
    }

    public function saveImage($car_id)
    {
        $data = [];

        foreach ($this->new_images as $image) {
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

        $this->render();
    }

    public function downloadFile($file_name, $path)
    {
        $file = public_path('app/'.$path.$file_name);
        return response()->download($file);
    }

    public function render()
    {
        return view('livewire.car.edit');
    }
}
