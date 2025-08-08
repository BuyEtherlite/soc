<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsurancePackage;
use App\Models\InsurancePolicy;
use App\Models\Claim;
use App\Models\Commission;
use App\Models\User;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard homepage
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get user's insurance policies
        $policies = $user->insurancePolicies()->with('package')->get();
        
        // Get user's commissions
        $totalCommissions = $user->commissions()->where('status', 'paid')->sum('amount');
        $pendingCommissions = $user->commissions()->where('status', 'pending')->sum('amount');
        
        // Get user's MLM network stats
        $directReferrals = $user->referrals()->count();
        $totalNetworkSize = $this->calculateNetworkSize($user);
        
        // Get current rank
        $currentRank = $user->currentRank;
        
        return view('dashboard.user.index', compact(
            'policies', 
            'totalCommissions', 
            'pendingCommissions', 
            'directReferrals', 
            'totalNetworkSize', 
            'currentRank'
        ));
    }

    /**
     * Show insurance packages available for purchase
     */
    public function insurancePackages()
    {
        $packages = InsurancePackage::where('is_active', true)->get();
        return view('dashboard.user.insurance-packages', compact('packages'));
    }

    /**
     * Show user's insurance policies
     */
    public function myPolicies()
    {
        $policies = auth()->user()->insurancePolicies()->with(['package', 'claims'])->get();
        return view('dashboard.user.my-policies', compact('policies'));
    }

    /**
     * Show MLM network and team building interface
     */
    public function mlmNetwork()
    {
        $user = auth()->user();
        $referralCode = $user->referral_code;
        $directReferrals = $user->referrals()->with('currentRank')->get();
        $mlmChildren = $user->mlmChildren()->get();
        
        return view('dashboard.user.mlm-network', compact('referralCode', 'directReferrals', 'mlmChildren'));
    }

    /**
     * Show commissions and earnings
     */
    public function commissions()
    {
        $user = auth()->user();
        $commissions = $user->commissions()->with('fromUser', 'sourcePolicy')->orderBy('created_at', 'desc')->get();
        $totalEarned = $user->commissions()->where('status', 'paid')->sum('amount');
        $pendingAmount = $user->commissions()->where('status', 'pending')->sum('amount');
        
        return view('dashboard.user.commissions', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    /**
     * Show AI advisor interface
     */
    public function aiAdvisor()
    {
        $user = auth()->user();
        $suggestions = $this->generateAISuggestions($user);
        
        return view('dashboard.user.ai-advisor', compact('suggestions'));
    }

    /**
     * Handle daily check-in for premium discounts
     */
    public function dailyCheckIn(Request $request)
    {
        // Implementation for daily check-in functionality
        // This would track driving scores, health metrics, etc.
        
        return response()->json(['message' => 'Check-in recorded successfully', 'discount_earned' => 2.5]);
    }

    /**
     * Calculate total network size recursively
     */
    private function calculateNetworkSize($user, $visited = [])
    {
        if (in_array($user->id, $visited)) {
            return 0; // Prevent infinite loops
        }
        
        $visited[] = $user->id;
        $size = $user->referrals()->count();
        
        foreach ($user->referrals as $referral) {
            $size += $this->calculateNetworkSize($referral, $visited);
        }
        
        return $size;
    }

    /**
     * Generate AI suggestions for the user
     */
    private function generateAISuggestions($user)
    {
        $suggestions = [];
        
        // Analyze user's current situation and provide suggestions
        if ($user->insurancePolicies()->count() == 0) {
            $suggestions[] = "Consider getting your first insurance policy to start earning referral commissions.";
        }
        
        if ($user->referrals()->count() < 5) {
            $suggestions[] = "Invite more friends to increase your network and earn more commissions.";
        }
        
        if (!$user->currentRank) {
            $suggestions[] = "Work towards achieving your first rank to unlock additional benefits.";
        }
        
        return $suggestions;
    }
}
