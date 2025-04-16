<?php

namespace App\Http\Services;

class NameContestantService
{
    /*
      Get rent duration for Housing
    */
    public static function rentDuration($rentByDay = true, $all = null)
    {
        // Initialize the data array
        $data = [
            [
                'id' => 3,
                'name' => __('mobile.Monthly'),
            ],
            [
                'id' => 4,
                'name' => __('mobile.Yearly'),
            ],
        ];

        // If $all is true, prepend the 'All' option to the data array
        if ($all) {
            array_unshift($data, [
                'id' => 1,
                'name' => __('mobile.All')
            ]);
        }

        // If $rentByDay is true, return a different set of data
        if ($rentByDay) {
            $data =  [
                [
                    'id' => 2,
                    'name' => __('mobile.Daily'),
                ],
                [
                    'id' => 5,
                    'name' => __('mobile.Weekly'),
                ],
                [
                    'id' => 3,
                    'name' => __('mobile.Monthly'),
                ],
            ];
            if ($all) {
                array_unshift($data, [
                    'id' => 1,
                    'name' => __('mobile.All')
                ]);
            }
            return $data;
        }

        return $data;
    }


    /*
      Get purposes for Housing
    */
    public static function purposes()
    {
        return [
            [
                'id' => 0,
                'name' => __('mobile.Residential commercial.'),
            ],
            [
                'id' => 1,
                'name' => __('mobile.Residential'),
            ],
            [
                'id' => 2,
                'name' => __('mobile.Commercial'),
            ],

            [
                'id' => 3,
                'name' => __('mobile.In building'),
            ],
            [
                'id' => 4,
                'name' => __('mobile.In villa'),
            ],
            [
                'id' => 5,
                'name' => __('mobile.Independent'),
            ],
            [
                'id' => 6,
                'name' => __('mobile.Duplex'),
            ],
        ];
    }

    public static function purposesDependOnType($type, $all = null)
    {
        $data = []; // Initialize an empty array for purposes

        if ($type == 'commercial-or-residential') {
            $data = [
                [
                    'id' => 0,
                    'name' => __('mobile.Residential commercial.'),
                ],
                [
                    'id' => 1,
                    'name' => __('mobile.Residential'),
                ],
                [
                    'id' => 2,
                    'name' => __('mobile.Commercial'),
                ],

            ];
        } elseif ($type == 'duplex') {
            $data = [
                [
                    'id' => 5,
                    'name' => __('mobile.Independent'),
                ],
                [
                    'id' => 6,
                    'name' => __('mobile.Duplex'),
                ],
            ];
        } elseif ($type == 'villa-or-building') {
            $data = [
                [
                    'id' => 3,
                    'name' => __('mobile.In building'),
                ],
                [
                    'id' => 4,
                    'name' => __('mobile.In villa'),
                ],
            ];
        } else {
            // Call the default purposes method if type does not match any condition
            $data = self::purposes();
        }

        // If $all is true, prepend the 'All' option
        if ($all) {
            array_unshift($data, [
                'id' => 10,  // Use a unique ID for 'All'
                'name' => __('mobile.All'),
            ]);
        }

        return $data;
    }

    /*
      Get purpose name by key
    */
    public static function getPurposeName($key)
    {
        switch ($key) {
            case 0 || '0':
                return __('mobile.Residential commercial.');
            case 1:
                return __('mobile.Residential');
            case 2:
                return __('mobile.Commercial');
            case 3:
                return __('mobile.In building');
            case 4:
                return __('mobile.In villa');
            case 5:
                return __('mobile.Independent');
            case 6:
                return __('mobile.Duplex');
            case 10:
                return __('mobile.All');
            default:
                return "";
        }
    }

    public static function getPurposeTitle($key)
    {
        if ($key == 5 || $key == 6) {
            return __('mobile.Purpose');
        } elseif ($key == 0  || $key == '0' || $key == 1 || $key == 2 || $key == 3 || $key == 4 || $key == 10) {
            return __('mobile.Type');
        }
        return '';
    }
    public static function getPurposeIconNumber($key)
    {
        if ($key == 0 || $key == 1 || $key == 2) {
            return "residential";
        } elseif ($key == 3 || $key == 4) {
            return "building";
        } elseif ($key == 10) {
            return 'all';
        } else {
            return "independent";
        }
        return '';
    }

    /*
      Get rent duration name by key
    */
    public static function getRentDurationName($key)
    {
        switch ($key) {
            case 0:
                return __('mobile.All');
            case 2:
                return __('mobile.Daily');
            case 1:
                return __('mobile.Weekly');
            case 3:
                return __('mobile.Monthly');
            case 4:
                return __('mobile.Yearly');
            default:
                return '';
        }
    }
}
