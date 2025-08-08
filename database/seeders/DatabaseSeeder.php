<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\InsurancePackage;
use App\Models\Rank;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@insurance-mlm.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '+1-555-ADMIN',
            'address' => '123 Admin Street, Management City, MC 12345'
        ]);

        // Create sample regular users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'referral_code' => User::generateReferralCode(),
            'phone' => '+1-555-0101',
            'address' => '456 User Lane, Customer City, CC 67890',
            'commission_balance' => 150.75
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'referral_code' => User::generateReferralCode(),
            'referred_by' => $user1->id,
            'phone' => '+1-555-0102',
            'address' => '789 Referral Road, Network City, NC 54321',
            'commission_balance' => 89.25,
            'mlm_parent_id' => $user1->id,
            'mlm_position' => 'left'
        ]);

        $user3 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'referral_code' => User::generateReferralCode(),
            'referred_by' => $user1->id,
            'phone' => '+1-555-0103',
            'address' => '321 Binary Blvd, MLM City, MC 98765',
            'commission_balance' => 42.50,
            'mlm_parent_id' => $user1->id,
            'mlm_position' => 'right'
        ]);

        // Create MLM ranks
        $ranks = [
            [
                'name' => 'Bronze',
                'requirements' => ['referrals' => 2, 'personal_volume' => 500],
                'monthly_salary' => 50.00,
                'commission_percentage' => 5.00,
                'benefits' => ['Basic training materials', 'Email support']
            ],
            [
                'name' => 'Silver',
                'requirements' => ['referrals' => 5, 'personal_volume' => 1000, 'team_volume' => 2000],
                'monthly_salary' => 150.00,
                'commission_percentage' => 7.50,
                'benefits' => ['Advanced training', 'Phone support', 'Marketing materials']
            ],
            [
                'name' => 'Gold',
                'requirements' => ['referrals' => 10, 'personal_volume' => 2000, 'team_volume' => 5000],
                'monthly_salary' => 350.00,
                'commission_percentage' => 10.00,
                'benefits' => ['Premium training', 'Dedicated support', 'Custom materials', 'Quarterly bonus']
            ],
            [
                'name' => 'Platinum',
                'requirements' => ['referrals' => 20, 'personal_volume' => 5000, 'team_volume' => 15000],
                'monthly_salary' => 750.00,
                'commission_percentage' => 12.50,
                'benefits' => ['VIP training', '24/7 support', 'Leadership program', 'Annual retreat']
            ],
            [
                'name' => 'Diamond',
                'requirements' => ['referrals' => 50, 'personal_volume' => 10000, 'team_volume' => 50000],
                'monthly_salary' => 1500.00,
                'commission_percentage' => 15.00,
                'benefits' => ['Executive training', 'Personal mentor', 'Global recognition', 'Luxury incentives']
            ]
        ];

        foreach ($ranks as $rankData) {
            Rank::create($rankData);
        }

        // Create insurance packages
        $packages = [
            [
                'name' => 'Essential Car Protection',
                'type' => 'car',
                'description' => 'Basic car insurance coverage for everyday drivers. Includes liability, collision, and comprehensive coverage.',
                'base_premium' => 89.99,
                'coverage_amount' => 25000.00,
                'deductible' => 500.00,
                'terms' => [
                    'Liability coverage up to $25,000',
                    'Collision coverage',
                    'Comprehensive coverage',
                    'Roadside assistance',
                    '24/7 claim support'
                ],
                'required_fields' => [
                    'Vehicle make and model',
                    'Vehicle year',
                    'License plate number',
                    'Driver\'s license number',
                    'Annual mileage'
                ]
            ],
            [
                'name' => 'Premium Car Coverage',
                'type' => 'car',
                'description' => 'Comprehensive car insurance with enhanced benefits and lower deductibles for maximum protection.',
                'base_premium' => 149.99,
                'coverage_amount' => 100000.00,
                'deductible' => 250.00,
                'terms' => [
                    'Liability coverage up to $100,000',
                    'Full collision and comprehensive',
                    'Rental car coverage',
                    'Gap insurance',
                    'Premium roadside assistance',
                    'Accident forgiveness'
                ],
                'required_fields' => [
                    'Vehicle make and model',
                    'Vehicle year',
                    'License plate number',
                    'Driver\'s license number',
                    'Annual mileage',
                    'Vehicle VIN'
                ]
            ],
            [
                'name' => 'Health Guardian Basic',
                'type' => 'health',
                'description' => 'Essential health insurance covering doctor visits, emergency care, and prescription medications.',
                'base_premium' => 199.99,
                'coverage_amount' => 50000.00,
                'deductible' => 1000.00,
                'terms' => [
                    'Doctor visits covered',
                    'Emergency room coverage',
                    'Prescription drug coverage',
                    'Preventive care included',
                    'Specialist referrals'
                ],
                'required_fields' => [
                    'Date of birth',
                    'Medical history',
                    'Current medications',
                    'Primary care physician',
                    'Emergency contact'
                ]
            ],
            [
                'name' => 'Life Security Plan',
                'type' => 'life',
                'description' => 'Term life insurance to protect your family\'s financial future with affordable monthly premiums.',
                'base_premium' => 45.99,
                'coverage_amount' => 500000.00,
                'deductible' => 0.00,
                'terms' => [
                    '$500,000 death benefit',
                    '20-year term coverage',
                    'Accidental death benefit',
                    'Terminal illness rider',
                    'No medical exam required'
                ],
                'required_fields' => [
                    'Date of birth',
                    'Beneficiary information',
                    'Health questionnaire',
                    'Occupation details',
                    'Lifestyle information'
                ]
            ],
            [
                'name' => 'Home Protection Plus',
                'type' => 'home',
                'description' => 'Comprehensive home insurance protecting your property and belongings from various risks.',
                'base_premium' => 119.99,
                'coverage_amount' => 300000.00,
                'deductible' => 750.00,
                'terms' => [
                    'Dwelling coverage up to $300,000',
                    'Personal property protection',
                    'Liability coverage',
                    'Additional living expenses',
                    'Natural disaster coverage'
                ],
                'required_fields' => [
                    'Property address',
                    'Home value',
                    'Year built',
                    'Square footage',
                    'Security features'
                ]
            ],
            [
                'name' => 'Travel Shield',
                'type' => 'travel',
                'description' => 'Travel insurance for domestic and international trips, covering medical emergencies and trip cancellations.',
                'base_premium' => 29.99,
                'coverage_amount' => 100000.00,
                'deductible' => 100.00,
                'terms' => [
                    'Medical emergency coverage',
                    'Trip cancellation protection',
                    'Lost luggage coverage',
                    'Flight delay compensation',
                    '24/7 travel assistance'
                ],
                'required_fields' => [
                    'Travel destination',
                    'Travel dates',
                    'Number of travelers',
                    'Pre-existing conditions',
                    'Emergency contact'
                ]
            ]
        ];

        foreach ($packages as $packageData) {
            InsurancePackage::create($packageData);
        }
    }
}
