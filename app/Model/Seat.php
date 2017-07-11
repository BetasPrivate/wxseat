<?php
App::uses('Trade', 'Model');
class Seat extends AppModel {
    var $hasMany = [
        'Order',
    ];

    public $belongsTo = [
        'SeatType' => [
            'className' => 'SeatType',
            'foreignKey' => 'type',
        ],
    ];

    //下单后锁定时间为5min
    const PROVISIONAL_TIME = 300;
    const FREE = 0;
    const OCCUPIED = 1;
    
    public static $texts = [
        self::FREE => "空闲",
        self::OCCUPIED => "占用",
    ];

    public static $classes = [
        self::FREE => 'info',
        self::OCCUPIED => 'warning',
    ];

    public static function text($index)
    {
        $result = '未知';
        if (isset(self::$texts[$index])) {
            $result = self::$texts[$index];
        }

        return $result;
    }

    public static function className($index)
    {
        $result = 'active';
        if (isset(self::$classes[$index])) {
            $result = self::$classes[$index];
        }

        return $result;
    }

    public function getOccupiedStatus()
    {
        return self::OCCUPIED;
    }

    public function getUnavaliableIdInfos($seatIds, $startDate, $endDate)
    {
        $seatInfos = $this->find('all', [
            'conditions' => [
                'status' => self::OCCUPIED,
                'free_time >' => $endDate,
                'Seat.real_id' => $seatIds,
            ],
        ]);

        $unavaliableIdInfos = [];
        foreach ($seatInfos as $seatInfo) {
            $seatId = $seatInfo['Seat']['real_id'];
            $endDate = $seatInfo['Seat']['free_time'];
            $unavaliableIdInfos[$seatId] = [
                'endDate' => $endDate,
            ];
        }

        $result = [
            'unavaliableIdInfos' => $unavaliableIdInfos,
        ];

        return $result;
    }

    public function getAvaliableSeatInfos($seatIds)
    {
        $seatInfos = $this->find('all', [
            'conditions' => [
                'Seat.real_id' => $seatIds,
                'Seat.is_deleted' => 0,
            ],
        ]);

        $avaliableIdInfos = [];
        foreach ($seatInfos as $seatInfo) {
            $version = $seatInfo['Seat']['version'];
            $id = $seatInfo['Seat']['real_id'];
            $avaliableIdInfos[] = [
                'seatId' => $id,
                'version' => $version,
            ];
        }

        $result = [
            'avaliableIdInfos' => $avaliableIdInfos,
        ];

        return $result;
    }

    public function getSeatPrices($ids)
    {
        $price = 0;
        $query = sprintf("select * from seats Seat left join seat_type_price_relations SeatTypePriceRelation on Seat.type = SeatTypePriceRelation.seat_type_id where Seat.real_id in %s", $ids);
        $seatInfos = $this->query($query);

        foreach ($seatInfos as $seatInfo) {
            $price += $seatInfo['SeatTypePriceRelation']['price'];
        }

        return $price;
    }

    public function getSeatStrBySeatIds($seatIds)
    {
        $seatIdStr = '';
        foreach ($seatIds as $id) {
            $seatIdStr .= ','.$id;
        }

        $seatIdStr = substr($seatIdStr, 1);

        return $seatIdStr;
    }


    public function releaseSeats()
    {
        $seats = $this->find('all', [
            'conditions' => [
                'status' => self::OCCUPIED,
            ],
        ]);

        $seatIdStr = '';
        foreach ($seats as $seat) {
            $seatId = $seat['Seat']['id'];
            $freeTime = $seat['Seat']['free_time'];

            //no free time, means no order.
            if (!$freeTime) {
                $seatIdStr .= ','.$seatId;
                //time exceed, means can free.
            } elseif (strtotime($freeTime) < time()) {
                $seatIdStr .= ','.$seatId;
            }
        }

        if (strlen($seatIdStr) > 0) {
            $seatIdStr = '('.substr($seatIdStr, 1).')';
            $query  = sprintf('update seats set status = %d, free_time = null where id in %s', self::FREE, $seatIdStr);
            $this->query($query);
        }
    }

    public function setSeatOcuppiedProvisionally($seatRealId)
    {
        $this->updateAll(
            [
                'free_time' => "'".date('Y-m-d H:i:s', time() + self::PROVISIONAL_TIME)."'",
            ],
            [
                'real_id' => $seatRealId,
                'is_deleted' => 0,
            ]
        );
    }

    public function formatSeatDate($seat)
    {
        if (sizeof($seat['Order']) == 0) {
            $seat['start_date'] = '';
            $seat['end_date'] = '';
        } else {
            $seat['start_date'] = $seat['Order'][0]['start_date'];
            $seat['end_date'] = $seat['Order'][0]['end_date'];
        }

        //座位如果有过期时间，则按照座位的过期时间来展示
        if ($seat['Seat']['free_time']) {
            $seat['start_date'] = '';
            $seat['end_date'] = $seat['Seat']['free_time'];
        }

        return $seat;
    }

    public function getDeposit($seatIdStr)
    {
        return round(100,2);
        //codes to write.
    }

    //conference

    //fill in when needed.
    public function checkConferenceLegal($data)
    {
        return true;
    }

    //parse the data.
    public function parseConferenceRentData($data)
    {
        $dates = [];
        //过滤
        foreach ($data as $dateStr) {
            if (!array_key_exists($dateStr, $dates)) {
                $dates[$dateStr] = 1;
            }
        }

        $rentDateArr = [];
        foreach ($dates as $date => $v) {
            $dateArr = explode(CONFERENCE_DATA_DS, $date);
            $year = $dateArr[0];
            $month = $dateArr[1];
            $day = $dateArr[2];
            $fromTime = $dateArr[3];
            $toTime = $dateArr[4];
            $startDate = $year.'-'.$month.'-'.$day.' '.$fromTime;
            $endDate = $year.'-'.$month.'-'.$day.' '.$toTime;
            $date = [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
            array_push($rentDateArr, $date);
        }

        return $rentDateArr;
    }

    public function getConferencePrice($dates, $conferenceId)
    {
        return 100;
    }

    public function getConferenceIdByConferenceName($conferenceName)
    {
        $seat = $this->find('first', [
            'conditions' => [
                'SeatType.name' => $conferenceName,
            ],
        ]);

        return isset($seat['Seat']['id']) ? $seat['Seat']['id'] : false;
    }

    public function getConferenceRentInfos($conferenceId)
    {
        $conferenceInfos = $this->Order->find('all', [
            'conditions' => [
                'Seat.id' => $conferenceId,
                'Order.start_date >' => date('Y-m-d'),
                'or' => [
                    'Trade.status' => [\Trade::NO_PAY, \Trade::PAID],
                    'Order.trade_id' => 0,
                ]
            ],
        ]);

        $infoArr = [];

        foreach ($conferenceInfos as $conferenceInfo) {
            $order = $conferenceInfo['Order'];
            $startDate = $order['start_date'];
            $endDate = $order['end_date'];
            $year = Date('Y', strtotime($startDate));
            $month = Date('m', strtotime($startDate));
            $day = Date('d', strtotime($startDate));
            $startTime = Date('H:i', strtotime($startDate));
            $endTime = Date('H:i', strtotime($endDate));
            $perDateStr = $year.CONFERENCE_DATA_DS.$month.CONFERENCE_DATA_DS.$day.CONFERENCE_DATA_DS.$startTime.CONFERENCE_DATA_DS.$endTime;
            array_push($infoArr, $perDateStr);
        }

        return $infoArr;
    }
}