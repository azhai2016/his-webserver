<?php
return [
    'registers'=>
      [
        [
           'name' => 'getPlans',
           'params' => [
                'userid' => 'xsd:string',
                'pageindex' => 'xsd:string'
            ],
            'return' => ['return' => 'tns:ResponseObject'],
            'namespace' => '',
            'soapaction' => '',
            'style' => 'rpc',
            'use' => 'encoded',
            'documentation' => ''
        ]
     ],
     'complexTypes'=>
     [
       [
         'name' => 'ResponseObject',
         'typeClass' => 'complexType',
         'phpType' => 'struct',
         'compositor' => 'all',
         'restrictionBase' => '',
         'elements' =>[
             'responseCode' => ['type' => 'xsd:int'],
             'totalpage' => ['type' => 'xsd:int'],
             'pagesize' => ['type' => 'xsd:int'],
             'flag' => ['type' => 'xsd:int'],
             'role' => ['type' => 'xsd:int'],
             'responseMessage' => ['type' => 'xsd:string'],
             'PlansArray' => ['type' => 'tns:PlansArray']
          ],
          'attrs' => [],
          'arrayType' => ''
        ],

        [
             'name' => 'PlansArray',
             'typeClass' => 'complexType',
             'phpType' => 'array',
             'compositor' => '',
             'restrictionBase' => 'SOAP-ENC:Array',
             'elements' => [],
             'attrs' => [
                       [
                         'ref' => 'SOAP-ENC:arrayType',
                         'wsdl:arrayType' => 'tns:Plans[]'
                       ]
                     ],
              'arrayType' => 'tns:Plans'
          ],
          [
            'name' => 'Plans',
            'typeClass' => 'complexType',
            'phpType' => 'struct',
            'compositor' => 'all',
            'restrictionBase' => '',
            'elements' =>[
                  'rowid' =>['name' => 'rowid','type' => 'xsd:int'],
                  'rq' =>['name' => 'rq','type' => 'xsd:string'],
                  'hshj' => ['name' => 'hshj','type' => 'xsd:double']
             ],
           'attrs' => [],
           'arrayType' => ''
           ]

       ]
     ];
