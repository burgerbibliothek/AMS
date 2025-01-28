<?php

namespace App\Ams;

use App\Models\Ark as ArkModel;
use App\Models\Minter as MinterModel;
use App\Models\Naan as NaanModel;
use App\Models\Status as StatusModel;
use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Erc;
use Burgerbibliothek\ArkManagementTools\Ncda;
use Burgerbibliothek\ArkManagementTools\Validator;
use Illuminate\Http\Request;

class Resolver
{
    /**
     * Resolve incoming ARK.
     * @param Request $request
     * @param string $naan
     * @return mixed
     */
    public static function resolve(Request $request, string $naan): mixed
    {

        /** Normalize incoming request */
        $ark = Ark::normalize($request->fullUrl());
        $components = Ark::splitIntoComponents($ark);

        /** Try to retrieve ARK from database  */
        $ark = ArkModel::where('ark', $components['checkZone'])->first();

        /** If ARK could be retrieved process request */
        if ($ark) {

            $uri = $ark->uri;

            /** Return metadata when inflection is present */
            if (in_array(array_key_first($request->query()), ['?', 'info'])) {

                if (empty($ark->metadata)) {
                    return response('erc: (:tba) | (:tba) | (:tba) | (:tba)')->header('Content-Type', 'text/plain');
                }

                $erc = new Erc;
                $erc->record = Metadata::deserialize($ark->metadata, 1);

                return response($erc->record())->header('Content-Type', 'text/plain');
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

            /** Suffix Passthrough */
            if (strlen(trim($components['suffixes'])) > 0) {
                $uri = $uri.'/'.$components['suffixes'];
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

            /** If NAAN ist present in database but no ARK is found */
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
            return redirect()->away('https://n2t.net/ark:'.$components['checkZone'].'/'.$components['suffixes'], 301);
        }
    }
}
