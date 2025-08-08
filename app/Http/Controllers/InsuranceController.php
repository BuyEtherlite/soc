<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsurancePackage;
use App\Models\InsurancePolicy;
use App\Models\User;

class InsuranceController extends Controller
{
    /**
     * Show insurance package details
     */
    public function show(InsurancePackage $package)
    {
        return view('insurance.show', compact('package'));
    }

    /**
     * Purchase insurance policy
     */
    public function purchase(Request $request, InsurancePackage $package)
    {
        $request->validate([
            'user_provided_data' => 'required|array',
            'coverage_customizations' => 'nullable|array',
        ]);

        $policy = InsurancePolicy::create([
            'user_id' => auth()->id(),
            'insurance_package_id' => $package->id,
            'policy_number' => InsurancePolicy::generatePolicyNumber(),
            'premium_amount' => $this->calculatePremium($package, $request->coverage_customizations),
            'coverage_customizations' => $request->coverage_customizations,
            'user_provided_data' => $request->user_provided_data,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'next_payment_date' => now()->addMonth(),
            'status' => 'pending'
        ]);

        // Generate commissions for referrer
        $this->generateReferralCommissions($policy);

        return redirect()->route('user.my-policies')
            ->with('success', 'Insurance policy purchased successfully! Policy Number: ' . $policy->policy_number);
    }

    /**
     * Calculate premium based on package and customizations
     */
    private function calculatePremium(InsurancePackage $package, $customizations = null)
    {
        $basePremium = $package->base_premium;
        
        // Apply customization adjustments
        if ($customizations) {
            foreach ($customizations as $option => $value) {
                // Logic to adjust premium based on customizations
                // This would be specific to each insurance type
            }
        }

        // Apply user-specific discounts (daily check-ins, safety scores, etc.)
        $discountPercentage = $this->calculateUserDiscount(auth()->user());
        
        return $basePremium * (1 - $discountPercentage / 100);
    }

    /**
     * Calculate user-specific discounts
     */
    private function calculateUserDiscount(User $user)
    {
        // Mock implementation - would track actual check-ins and scores
        $baseDiscount = 0;
        
        // Example: 1% discount per month of membership
        $monthsActive = $user->created_at->diffInMonths(now());
        $loyaltyDiscount = min($monthsActive * 1, 10); // Max 10%
        
        return $baseDiscount + $loyaltyDiscount;
    }

    /**
     * Generate commissions for referral network
     */
    private function generateReferralCommissions(InsurancePolicy $policy)
    {
        $user = $policy->user;
        $referrer = $user->referrer;
        
        if ($referrer) {
            // Direct referral commission (5% of premium)
            Commission::create([
                'user_id' => $referrer->id,
                'from_user_id' => $user->id,
                'type' => 'referral',
                'amount' => $policy->premium_amount * 0.05,
                'source_policy_id' => $policy->id,
                'level' => 1,
                'status' => 'pending'
            ]);

            // Update referrer's commission balance
            $referrer->increment('commission_balance', $policy->premium_amount * 0.05);

            // Generate upper-level commissions (binary tree)
            $this->generateBinaryCommissions($policy, $referrer->mlmParent, 2);
        }
    }

    /**
     * Generate binary MLM commissions up the tree
     */
    private function generateBinaryCommissions(InsurancePolicy $policy, $parent, $level)
    {
        if (!$parent || $level > 5) return; // Max 5 levels

        $commissionRate = $this->getBinaryCommissionRate($level);
        
        Commission::create([
            'user_id' => $parent->id,
            'from_user_id' => $policy->user_id,
            'type' => 'binary',
            'amount' => $policy->premium_amount * $commissionRate,
            'source_policy_id' => $policy->id,
            'level' => $level,
            'status' => 'pending'
        ]);

        $parent->increment('commission_balance', $policy->premium_amount * $commissionRate);

        // Continue up the tree
        $this->generateBinaryCommissions($policy, $parent->mlmParent, $level + 1);
    }

    /**
     * Get commission rate for binary levels
     */
    private function getBinaryCommissionRate($level)
    {
        $rates = [
            2 => 0.03, // 3% for level 2
            3 => 0.02, // 2% for level 3
            4 => 0.01, // 1% for level 4
            5 => 0.005 // 0.5% for level 5
        ];

        return $rates[$level] ?? 0;
    }
}