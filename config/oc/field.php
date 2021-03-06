<?php
return [
    /*订单类型
    key_word是关键字
    chinese是中文
    value是值
    */
  'order_type'=>[
      '0'=>[
          'key_word'=>'no_pay',
          'chinese'=>'未付款',
          'value'=>'0',
      ],
      '1'=>[
          'key_word'=>'no_finished',
          'chinese'=>'未完成',
          'value'=>'1',
      ],
      '2'=>[
          'key_word'=>'finished',
          'chinese'=>'已完成',
          'value'=>'2',
      ],
      '3'=>[
          'key_word'=>'misstake',
          'chinese'=>'问题订单',
          'value'=>'3',
      ],
  ],
    //省份
  'province'=>[
      '0'=>[
          'key_word'=>'beijing',
          'chinese'=>'北京',
          'value'=>'1',
      ],
  ],
    //卡密状态
    'status'=>[
        '0'=>[
            'key_word'=>'normal',
            'chinese'=>'正常',
            'value'=>'0',
        ],
        '1'=>[
            'key_word'=>'no_normal',
            'chinese'=>'不正常',
            'value'=>'1',
        ],
    ],
    //面额
    'denomination'=>[
        '0'=>[
            'key_word'=>'fifty',
            'chinese'=>'50',
            'value'=>'50',
        ],
        '1'=>[
            'key_word'=>'hundred',
            'chinese'=>'100',
            'value'=>'100',
        ],
    ],
    //采购方式
    'procurement_type'=>[

    ],
    //折扣
    'discount'=>[

    ],
    //油卡选择
    'oil_card'=>[

    ],
    //城市
    'city'=>[

    ],
    'commodity'=>[

    ],
    //供卡名称
    'platform_type'=>[

    ],
    //供卡状态
    's_status'=>[

    ],
    //面额
    'price'=>[

    ],
];