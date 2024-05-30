<?php
namespace App\AMS;
use Illuminate\Http\RedirectResponse;
use App\AMS\Ncda;
use App\AMS\Validator;
use App\Models\Ark as ArkModel;
use App\Models\Naan as NaanModel;
use App\Models\Status as StatusModel;


class Resolver {

    public static function resolve($request, $naan, $baseNameAndSuffixes)
    {

        $inflection = parse_url($request->fullUrl(), PHP_URL_QUERY);

        /**
         * Normalize NAAN 
         * NAAN consists only of betanumeric characters
         */ 
        $naan = strtolower($naan);
        
        /**
         * Normalize basename and suffixes
         * Remove hyphens and whitespace
         */
        $baseNameAndSuffixes = explode('/', trim(preg_replace('/[\x{0020}|\x{00a0}|\x{002d}|\x{00ad}|\x{2000}-\x{2015}]/u', '', $baseNameAndSuffixes)));
        $baseName = $baseNameAndSuffixes[0];
        $suffixes = implode('/', array_slice($baseNameAndSuffixes, 1));
        $checkZone = $naan.'/'.$baseName;
        
        // search ARK in database
        $ark = ArkModel::where('ark', $checkZone)->first();        

        // ARK has been found
        if($ark){

            // Get HTTP-Status of ARK
            if($ark->status_id){
                $status = StatusModel::find($ark->status_id);
                return abort($status->code);
            }
            
            // Return URI for redirection passing trough the suffix
            return $ark->uri.'/'.$suffixes;
                    
        }else{
            
            // ARK has not been found
            // Check if NAAN is valid
            if(!Validator::validNaan($naan)){
                abort(400, __('errors.invalidNAAN'));
            }

            // check if ARK is valid
            if(!Ncda::verify($checkZone)){
                abort(400, __('errors.invalidARK'));
            }

            // Check if NAAN in database and if not redirect to global resolver.
            $naanInDatabase = NaanModel::where('naan', $naan)->first();
            if(!$naanInDatabase){
                return 'https://n2t.net/ark:'.$naan.'/'.$baseNameAndSuffixes;
            }

            return abort(404, __('errors.notFoundARK'));
    
        }

    }
    

    

}