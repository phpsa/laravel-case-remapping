<?php

namespace Phpsa\LaravelCaseRemapping\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Phpsa\LaravelCaseRemapping\LaravelCaseRemappingServiceProvider;

class CollectionMacroTest extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return [
            LaravelCaseRemappingServiceProvider::class,
        ];
    }

    public function testKeysToSnakeCaseCollectionMacroWithoutTidy()
    {
        $input = [
            'test'                  => 'hello',
            'singleLine'            => 'hello',
            'ArrayBased'            => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_Underscore' => 'true',
            'already_correct'       => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnotherDepth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $output = [
            'test'                   => 'hello',
            'single_line'            => 'hello',
            'array_based'            => [
                'single_again' => 'single-arrow',
                'third_tier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with__underscore' => 'true',
            'already_correct'        => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'key_based_on_another_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $res = collect($input)->snakeKeys(false)->toArray();

        $this->assertEquals($output, $res);
    }

    public function testKeysToSnakeCaseCollectionMacro()
    {
        $input = [
            'test'                  => 'hello',
            'singleLine'            => 'hello',
            'ArrayBased'            => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_Underscore' => 'true',
            'already_correct'       => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnotherDepth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $output = [
            'test'                  => 'hello',
            'single_line'           => 'hello',
            'array_based'           => [
                'single_again' => 'single-arrow',
                'third_tier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_underscore' => 'true',
            'already_correct'       => [
                'going_down' => [
                    'kebab_to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'key_based_on_another_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $res = collect($input)->snakeKeys(true)->toArray();

        $this->assertEquals($output, $res);
    }

    public function testKeysToCamelCaseCollectionMacro()
    {
        $input = [
            'test'                  => 'hello',
            'singleLine'            => 'hello',
            'ArrayBased'            => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_Underscore' => 'true',
            'already__correct'      => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnother_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $output = [
            'test'                => 'hello',
            'singleLine'          => 'hello',
            'arrayBased'          => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issueWithUnderscore' => 'true',
            'alreadyCorrect'      => [
                'goingDown' => [
                    'kebabToSnake' => [
                        'integerArray' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnotherDepth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $res = collect($input)->camelKeys()->toArray();

        $this->assertEquals($output, $res);
    }

    public function testKeysToKebabCaseCollectionMacro()
    {
        $input = [
            'test'                  => 'hello',
            'singleLine'            => 'hello',
            'ArrayBased'            => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_Underscore' => 'true',
            'already__correct'      => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnother_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $output = [
            'test'                  => 'hello',
            'single-line'           => 'hello',
            'array-based'           => [
                'single-again' => 'single-arrow',
                'third-tier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue-with-underscore' => 'true',
            'already-correct'       => [
                'going-down' => [
                    'kebab-to-snake' => [
                        'integer-array' => [
                            0,1,2,3,4,[
                                'key-based-on-another-depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $res = collect($input)->kebabKeys()->toArray();

        $this->assertEquals($output, $res);
    }

    public function testKeysToKebabCaseCollectionMacroWithoutTidy()
    {
        $input = [
            'test'                  => 'hello',
            'singleLine'            => 'hello',
            'ArrayBased'            => [
                'singleAgain' => 'single-arrow',
                'thirdTier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_Underscore' => 'true',
            'already__correct'      => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'keyBasedOnAnother_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $output = [
            'test'                   => 'hello',
            'single-line'            => 'hello',
            'array-based'            => [
                'single-again' => 'single-arrow',
                'third-tier'   => [
                    '1','2',5,6,7
                ],
            ],
            'issue_with_-underscore' => 'true',
            'already__correct'       => [
                'going_down' => [
                    'kebab-to_snake' => [
                        'integer_array' => [
                            0,1,2,3,4,[
                                'key-based-on-another_depth' => 'yes'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $res = collect($input)->kebabKeys(false)->toArray();

        $this->assertEquals($output, $res);
    }
}
