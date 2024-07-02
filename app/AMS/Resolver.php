<?php

namespace App\AMS;

use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Ncda;
use Burgerbibliothek\ArkManagementTools\Validator;
use App\Models\Ark as ArkModel;
use App\Models\Naan as NaanModel;
use App\Models\Minter as MinterModel;
use App\Models\Status as StatusModel;

class Resolver
{

    public static function resolve($request, $naan, $baseNameAndSuffixes)
    {
        
        /** Normalize incoming request */
        $ark = Ark::normalize($request->fullUrl());
        $components = Ark::splitIntoComponents($ark);

        /** Try to retrive ARK from database  */
        $ark = ArkModel::where('ark', $components['checkZone'])->first();

       /** If ARK could be retrieved process request */
        if ($ark) {

            $uri = $ark->uri . '/' . $components['suffixes'];

            /** Return metadata when inflection is present */
            if(in_array(array_key_first($request->query()), ['?', 'info'])){  
                return response($ark->metadata)->header('Content-Type', 'text/plain');
            }

            /** Return status if present */
            if ($ark->status_id) {

                $status = StatusModel::find($ark->status_id);
                $code = $status->code;

                if ($code > 299 && $code < 400) {
                    return redirect()->away($uri, $code);
                }

                return abort($code);
            }

            /** Redirect */
            return redirect()->away($uri, 302);

        } else {

            /** Check if NAAN is valid  */
            if (!Validator::followsNaanCharacterRepetoire($components['naan'])) {
                return abort(400, __('errors.invalidNAAN'));
            }

            /** Check if NAAN is present in database */
            $naan = NaanModel::where('naan', $components['naan'])->first();

            if ($naan) {

                /** Check ARK for transcription errors */
                $minter = MinterModel::firstWhere('id', $naan->minter_settings_id);
                
                if (!Ncda::verify($components['checkZone'], $minter->xdigits)) {
                    abort(400, __('errors.invalidARK'));
                }

                /** If nothing worked out, return 404 */
                return abort(404, __('errors.notFoundARK'));
            }

            /** Redirect to global resolver. */
            return redirect()->away('https://n2t.net/ark:' .  $components['checkZone'] . '/' . $components['suffixes'] , 301);
        }
    }
}
