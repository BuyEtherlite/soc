<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InsurancePackage;
use App\Models\InsurancePolicy;
use App\Models\Claim;
use App\Models\Commission;
use App\Models\Rank;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard homepage
     */
    public function index()
    {
        // Get key metrics for the dashboard
        $totalUsers = User::where('role', 'user')->count();
        $totalPolicies = InsurancePolicy::count();
        $pendingClaims = Claim::where('status', 'pending')->count();
        $totalPayouts = Commission::where('status', 'paid')->sum('amount');
        $pendingWithdrawals = Commission::where('status', 'pending')->sum('amount');
        
        // Recent activity
        $recentClaims = Claim::with(['policy.user', 'policy.package'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $recentPolicies = InsurancePolicy::with(['user', 'package'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard.admin.index', compact(
            'totalUsers',
            'totalPolicies', 
            'pendingClaims',
            'totalPayouts',
            'pendingWithdrawals',
            'recentClaims',
            'recentPolicies'
        ));
    }

    /**
     * User management interface
     */
    public function users()
    {
        $users = User::with(['currentRank', 'insurancePolicies'])
            ->where('role', 'user')
            ->paginate(20);
        
        return view('dashboard.admin.users', compact('users'));
    }

    /**
     * Insurance package management
     */
    public function insurancePackages()
    {
        $packages = InsurancePackage::withCount('policies')->get();
        return view('dashboard.admin.insurance-packages', compact('packages'));
    }

    /**
     * Claims management and approval
     */
    public function claims()
    {
        $pendingClaims = Claim::with(['policy.user', 'policy.package'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $allClaims = Claim::with(['policy.user', 'policy.package', 'processor'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('dashboard.admin.claims', compact('pendingClaims', 'allClaims'));
    }

    /**
     * Approve a claim
     */
    public function approveClaim(Request $request, Claim $claim)
    {
        $claim->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'processed_by' => auth()->id(),
            'processed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Claim approved successfully');
    }

    /**
     * Reject a claim
     */
    public function rejectClaim(Request $request, Claim $claim)
    {
        $claim->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'processed_by' => auth()->id(),
            'processed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Claim rejected');
    }

    /**
     * Financial oversight and withdrawal management
     */
    public function financials()
    {
        $pendingWithdrawals = Commission::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalPayouts = Commission::where('status', 'paid')->sum('amount');
        $monthlyPayouts = Commission::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->sum('amount');
        
        return view('dashboard.admin.financials', compact(
            'pendingWithdrawals',
            'totalPayouts',
            'monthlyPayouts'
        ));
    }

    /**
     * Approve withdrawal request
     */
    public function approveWithdrawal(Commission $commission)
    {
        $commission->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        // Update user's commission balance
        $user = $commission->user;
        $user->decrement('commission_balance', $commission->amount);

        return redirect()->back()->with('success', 'Withdrawal approved and processed');
    }

    /**
     * MLM rank management
     */
    public function ranks()
    {
        $ranks = Rank::withCount('users')->get();
        return view('dashboard.admin.ranks', compact('ranks'));
    }

    /**
     * Analytics and reporting
     */
    public function analytics()
    {
        // Risk and fraud center data
        $suspiciousActivities = $this->detectSuspiciousActivities();
        
        // Churn prediction
        $churnRiskUsers = $this->identifyChurnRiskUsers();
        
        // Geospatial data for claims
        $claimLocations = $this->getClaimLocations();
        
        return view('dashboard.admin.analytics', compact(
            'suspiciousActivities',
            'churnRiskUsers', 
            'claimLocations'
        ));
    }

    /**
     * System configuration
     */
    public function settings()
    {
        return view('dashboard.admin.settings');
    }

    /**
     * Detect suspicious activities for fraud prevention
     */
    private function detectSuspiciousActivities()
    {
        // Implementation for fraud detection logic
        // This would analyze patterns in claims, user behavior, etc.
        return [
            'multiple_claims_same_user' => Claim::selectRaw('insurance_policy_id, COUNT(*) as count')
                ->groupBy('insurance_policy_id')
                ->having('count', '>', 3)
                ->with('policy.user')
                ->get(),
            'high_value_claims' => Claim::where('claim_amount', '>', 10000)
                ->where('status', 'pending')
                ->with('policy.user')
                ->get()
        ];
    }

    /**
     * Identify users at risk of churning
     */
    private function identifyChurnRiskUsers()
    {
        // Users who haven't logged in for 30+ days and have no recent activity
        return User::where('role', 'user')
            ->where('updated_at', '<', now()->subDays(30))
            ->whereDoesntHave('insurancePolicies', function($query) {
                $query->where('created_at', '>', now()->subDays(30));
            })
            ->limit(20)
            ->get();
    }

    /**
     * Get geographical distribution of claims
     */
    private function getClaimLocations()
    {
        // This would analyze claim locations for pattern recognition
        // For now, return mock data structure
        return [
            'high_frequency_areas' => [],
            'claim_density_map' => [],
            'regional_statistics' => []
        ];
    }
}