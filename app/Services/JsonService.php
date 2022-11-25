<?php

namespace App\Services;
 
class JsonService {

    public function index(JsonService $jsonService)
    {
        // where the text file is stored
        $path = Storage::get('public/affiliates2.txt');
        // reformat invalid json
        $JsonAddCommas = str_replace("}", "},", $path);
        // remove the very last comma and wrap it all in []
        $JsonRemoveLastComma = "[";
        $JsonRemoveLastComma .= str_replace("522366\"},", "522366\"}", $JsonAddCommas);
        $JsonRemoveLastComma .= "]";        
        // convert the JSON object to a PHP object
        $aff = json_decode($JsonRemoveLastComma);
        // make the data a collection to be sortable
        $laravelArray = collect($aff);
        // sort the list
        $affiliates = $laravelArray->sortBy('affiliate_id'); 
        // check if json is invalid
        if (json_last_error()) {
            print('Invalid JSON provided!');
            dd($JsonRemoveLastComma);
        }
        // Dublin office coordinates
        $officeLatitude = 53.3340285;
        $officeLongitude = -6.2535495;
        $unit = 'kilometers';
 
        return $affiliates;
    }
}