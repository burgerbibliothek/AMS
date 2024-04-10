<?php
namespace App\AMS;
use Illuminate\Http\RedirectResponse;
use App\AMS\NCDA;
use App\Models\Ark as ArkModel;
use App\Models\Naan as NaanModel;
use App\Models\Status as StatusModel;


class Resolver {

    public static function resolve($request, $naan, $baseNameAndSuffixes){

        $inflection = parse_url($request->fullUrl(), PHP_URL_QUERY);

        // NAAN consists of betanumeric characters
        $naan = strtolower($naan);
        
        // remove hyphens and whitespace from basename and suffixes.
        $baseNameAndSuffixes = explode('/', trim(preg_replace('/[\x{0020}|\x{00a0}|\x{002d}|\x{00ad}|\x{2000}-\x{2015}]/u', '', $baseNameAndSuffixes)));
        $baseName = $baseNameAndSuffixes[0];
        $suffixes = implode('/', array_slice($baseNameAndSuffixes, 1));
        $checkZone = $naan.'/'.$baseName;
        
        // search ARK in database
        $ark = ArkModel::where('ark', $checkZone)->first();        

        if($ark){

            // check if entry has a status.
            if($ark->status_id){
                $status = StatusModel::find($ark->status_id);
                return abort($status->code);
            }
            
            // redirect to page with suffix passtrough
            return $ark->uri.'/'.$suffixes;
                    
        }else{

            // check if NAAN is valid
            if(preg_match('/[^0123456789bcdfghjkmnpqrstvwxz]/', $naan) > 0){
                abort(400, __('errors.invalidNAAN'));
            }

            // check if ARK is valid
            if(!NCDA::verify($checkZone)){
                abort(400, __('errors.invalidARK'));
            }

            // check if NAAN in database and if not redirect to global resolver.
            $checkNAAN = NaanModel::where('naan', $naan)->first();
            if(!$checkNAAN){
                return 'https://n2t.net/ark:'.$naan.'/'.$baseNameAndSuffixes;
            }

            return abort(404, 'errors.notFoundARK');
    
        }

    }
    

    

}