<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MonitorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $types = collect();

        $types->add([
            'key' => 'http',
            'label' => 'HTTP',
            'inputs' => [
                [
                    'key' => 'url',
                    'label' => 'URL',
                    'required' => true,
                    'defaultValue' => 'https://isaeken.com.tr',
                    'type' => 'string',
                ],
            ],
        ]);

        $types->add([
            'key' => 'tcp',
            'label' => 'TCP',
            'inputs' => [
                [
                    'key' => 'hostname',
                    'label' => 'Hostname',
                    'required' => true,
                    'defaultValue' => '127.0.0.1',
                    'type' => 'string',
                ],
                [
                    'key' => 'port',
                    'label' => 'PORT',
                    'required' => true,
                    'defaultValue' => '80',
                    'type' => 'integer',
                ],
            ],
        ]);

        $types->add([
            'key' => 'ping',
            'label' => 'PING',
            'inputs' => [
                [
                    'key' => 'hostname',
                    'label' => 'Hostname',
                    'required' => true,
                    'defaultValue' => '127.0.0.1',
                    'type' => 'string',
                ],
            ],
        ]);

        $types->add([
            'key' => 'dns',
            'label' => 'DNS',
            'inputs' => [
                [
                    'key' => 'hostname',
                    'label' => 'Hostname',
                    'required' => true,
                    'defaultValue' => '127.0.0.1',
                    'type' => 'string',
                ],
                [
                    'key' => 'resolver_server',
                    'label' => 'DNS Resolver Server',
                    'required' => true,
                    'defaultValue' => '8.8.8.8',
                    'type' => 'string',
                ],
                [
                    'key' => 'dns_record_type',
                    'label' => 'DNS Record',
                    'required' => true,
                    'defaultValue' => 'A',
                    'type' => 'select',
                    'options' => [
                        ['key' => 'a', 'label' => 'A'],
                        ['key' => 'aaaa', 'label' => 'AAAA'],
                        ['key' => 'caa', 'label' => 'CAA'],
                        ['key' => 'cname', 'label' => 'CNAME'],
                        ['key' => 'mx', 'label' => 'MX'],
                        ['key' => 'ns', 'label' => 'NS'],
                        ['key' => 'ptr', 'label' => 'PTR'],
                        ['key' => 'soa', 'label' => 'SOA'],
                        ['key' => 'srv', 'label' => 'SRV'],
                        ['key' => 'txt', 'label' => 'TXT'],
                    ],
                ],
            ],
        ]);

        return response()->json($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
