<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homepageContent = <<<EOF
            <h4>Hello, World!</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $renterInfo = <<<EOF
            <h4>Information for renters</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $contact = <<<EOF
            <h4>Contact Info</h4>

            <p>
                Acme Corp.
                Test Street 123, 12345 Test City
                Phone: 123 456 789
                Email: user@example.com
            </p>
EOF;

        $landlordInfo = <<<EOF
            <h4>Information for landlords</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $interiorDesign = <<<EOF
            <h4>Interior design</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $about = <<<EOF
            <h4>About Acme Corp.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $tos = <<<EOF
            <h4>Terms of service</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
EOF;

        $privacyPolicy = <<<EOF
            <h4>Privacy policy</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

EOF;

        $thanks = <<<EOF
        <p>Thanks!</p>
        <p>Your data was submitted.</p>
EOF;


        $textEntries = [
            [
                'id' => 1,
                'text_type' => 'HOMEPAGE_BANNER',
                'text_content' => 'Hello, World!',
            ],
            [
                'id' => 2,
                'text_type' => 'HOMEPAGE_CONTENT',
                'text_content' => $homepageContent,
            ],
            [
                'id' => 3,
                'text_type' => 'RENTER_INFO',
                'text_content' => $renterInfo,
            ],
            [
                'id' => 4,
                'text_type' => 'CONTACT',
                'text_content' => $contact,
            ],
            [
                'id' => 5,
                'text_type' => 'LANDLORD_INFO',
                'text_content' => $landlordInfo,
            ],
            [
                'id' => 6,
                'text_type' => 'INTERIOR_DESIGN',
                'text_content' => $interiorDesign,
            ],
            [
                'id' => 7,
                'text_type' => 'ABOUT',
                'text_content' => $about,
            ],
            [
                'id' => 8,
                'text_type' => 'TOS',
                'text_content' => $tos,
            ],
            [
                'id' => 9,
                'text_type' => 'PRIVACY_POLICY',
                'text_content' => $privacyPolicy,
            ],
            [
                'id' => 10,
                'text_type' => 'THANKS',
                'text_content' => $thanks,
            ],
        ];
        foreach ($textEntries as $entry) {
            DB::table('texts')->insert($entry);
        }
    }
}
