<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Superhero;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SuperheroController extends Controller
{
    public function uploadContent(Request $request)
    {
        $file = $request->file('uploaded_file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads';
            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);
            $file = fopen($filepath, "r");
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 0, ",")) !== FALSE) {
                $num = count($filedata);
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);
            $j = 0;
            foreach ($importData_arr as $importData) {
                $j++;
                try {
                    DB::beginTransaction();
                    Superhero::create([
                        'id' => $importData[0],
                        'name' => $importData[1],
                        'fullname' => $importData[2],
                        'strength' => $importData[3],
                        'speed' => $importData[4],
                        'durability' => $importData[5],
                        'power' => $importData[6],
                        'combat' => $importData[7],
                        'race' => $importData[8],
                        'height_0' => $importData[9],
                        'height_1' => $importData[10],
                        'weight_0' => $importData[11],
                        'weight_1' => $importData[12],
                        'eyecolor' => $importData[13],
                        'haircolor' => $importData[14],
                        'publisher' => $importData[15]
                    ]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx");
        $maxFileSize = 2097152;
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

    public static function getByProperty($property)
    {
        $model = new Superhero;
        if (in_array($property, $model->getFillable()))
        {
            return Superhero::all($property);
        } else {
            return response()->json([
                'message' => 'Property ' . $property . ' Not Found. Please check the URI'], 404);
        }
    }

    public static function getByPropertyOrdered($property, $order)
    {
        $model = new Superhero;
        if (in_array($property, $model->getFillable()))
        {
            if ($order > 0)
            {
                return Superhero::orderBy('id', 'desc')->get($property);
            } else {
                return Superhero::orderBy('id', 'asc')->get($property);
            }
        } else {
            return response()->json([
                'message' => 'Property ' . $property . ' Not Found. Please check the URI'], 404);
        }
    }

    public static function getByPropertyOrderedPaginate($property, $order, $perPage)
    {
        $model = new Superhero;
        if (in_array($property, $model->getFillable()))
        {
            if ($order > 0)
            {
                $superheroArray = Superhero::orderBy('id', 'desc')->get($property);
            } else {
                $superheroArray = Superhero::orderBy('id', 'asc')->get($property);
            }
            $page = Paginator::resolveCurrentPage('page');
            $result = new LengthAwarePaginator($superheroArray->forPage($page, $perPage), count($superheroArray), $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]);
            return $result;
        } else {
            return response()->json([
                'message' => 'Property ' . $property . ' Not Found. Please check the URI'], 404);
        }
    }

    public static function getByPropertyPaginate($property, $perPage)
    {
        $model = new Superhero;
        if (in_array($property, $model->getFillable()))
        {
            $superheroArray = Superhero::all($property);
            $page = Paginator::resolveCurrentPage('page');
            $result = new LengthAwarePaginator($superheroArray->forPage($page, $perPage), count($superheroArray), $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]);
            return $result;
        } else {
            return response()->json([
                'message' => 'Property ' . $property . ' Not Found. Please check the URI'], 404);
        }
    }

    public static function getByPropertyFilter($property, $filter)
    {
        $model = new Superhero;
        if (in_array($property, $model->getFillable()))
        {
            return Superhero::all()->where($property, null, $filter);
        } else {
            return response()->json([
                'message' => 'Property ' . $property . ' Not Found. Please check the URI'], 404);
        }
    }

    public static function getOrdered($order)
    {
        if ($order > 0)
        {
            return Superhero::orderBy('id', 'desc')->get();
        } else {
            return Superhero::orderBy('id', 'asc')->get();
        }
    }

    public static function getOrderedPaginate($order, $perPage)
    {
        if ($order > 0)
        {
            $superheroArray = Superhero::orderBy('id', 'desc')->get();
        } else {
            $superheroArray = Superhero::orderBy('id', 'asc')->get();
        }
        $page = Paginator::resolveCurrentPage('page');
        $result = new LengthAwarePaginator($superheroArray->forPage($page, $perPage), count($superheroArray), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return $result;
    }

    public static function getPaginate($perPage)
    {
        $superheroArray = Superhero::all();
        $page = Paginator::resolveCurrentPage('page');
        $result = new LengthAwarePaginator($superheroArray->forPage($page, $perPage), count($superheroArray), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return $result;
    }
}
