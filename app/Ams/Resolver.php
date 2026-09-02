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
use Exception;
use Illuminate\Http\Request;

class Resolver
{
    /**
     * Resolve incoming ARK.
     * @param Request $request
     * @param string $naan
     * @return mixed
     */
    public static function resolve(Request $request, string $naan, string $baseNameAndSuffixes): mixed
    {
        /** Normalize incoming request */
        $components = Ark::splitIntoComponents($request->fullUrl());

        /** Try to retrieve ARK from database */
        $ark = ArkModel::query()
            ->select('ark', 'uri', 'updated_at', 'metadata', 'status_id')
            ->firstWhere('ark', $components['baseCompactName']);
        
        /** If ARK could be retrieved process request */
        if ($ark !== null) {
            
            /** Return metadata if inflection is present */
            if (in_array($components['inflection'], ['?info', '??']) === true) {

                $lastModified = $ark->updated_at;

                if ($ark->metadata) {
                    $metadata = Metadata::deserialize($ark->metadata, true);
                } else {
                    $metadata = 'erc: (:tba) | (:tba) | (:tba) | (:tba)';
                }

                return response($metadata)->withHeaders([
                    'Content-Type' => 'text/plain',
                    'Last-Modified'=> date_format($lastModified, 'r')
                ]);
            }

            /** Return status if present */
            if ($ark->status_id) {
                $status = StatusModel::query()
                    ->select('code')
                    ->firstWhere('id', $ark->status_id);

                return abort($status->code, __('errors.default_message', ['pid' => $ark->ark]));
            }


            /** Suffix Passthrough */
            if(NaanModel::suffixPasstrough($components['naan']) === true){
                if (strlen(trim($components['suffixes'])) > 0) {
                    $concatChar = substr($components['suffixes'], 0, 1) === '?' ? '' : '/';
                    $ark->uri = $ark->uri . $concatChar . $components['suffixes'];
                }
            }

            /** Redirect */
            return redirect()->away($ark->uri, 302);

        }

        /** Check if NAAN is valid  */
        if (Validator::isValidNaan($components['naan']) === false) {
            return abort(400, __('errors.invalidNAAN'));
        }

        /** Check if NAAN is present in database */
        $naan = NaanModel::query()
            ->select('minter_id')
            ->firstWhere('naan', $components['naan']);

        /** If NAAN is present in database but no ARK is found */
        if ($naan) {
            
            /** If minter calculates NCDA, then check for transcription errors */
            $minter = MinterModel::query()
                ->select('xdigits', 'ncda')
                ->firstWhere('id', $naan->minter_id);
            
            if($minter->ncda === 1 && Ncda::verify($components['checkZone'], $minter->xdigits) === false){
                abort(400, __('errors.invalidARK'));
            }

            /** If no other error found, return 404 */
            return abort(404, __('errors.notFoundARK'));
        }

        /** Redirect to global resolver. */
        return redirect()->away('https://n2t.net/' . $components['baseCompactName'] . '/' . $components['suffixes'], 302);

        
    }
}
