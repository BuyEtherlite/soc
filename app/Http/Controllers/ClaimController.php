<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\InsurancePolicy;

class ClaimController extends Controller
{
    /**
     * Show claim submission form
     */
    public function create(InsurancePolicy $policy)
    {
        return view('claims.create', compact('policy'));
    }

    /**
     * Submit a new claim
     */
    public function store(Request $request)
    {
        $request->validate([
            'insurance_policy_id' => 'required|exists:insurance_policies,id',
            'type' => 'required|string',
            'description' => 'required|string|min:10',
            'incident_date' => 'required|date|before_or_equal:today',
            'claim_amount' => 'required|numeric|min:1',
            'supporting_documents' => 'nullable|array',
            'supporting_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120' // 5MB max
        ]);

        // Handle file uploads
        $documentPaths = [];
        if ($request->hasFile('supporting_documents')) {
            foreach ($request->file('supporting_documents') as $file) {
                $path = $file->store('claims', 'public');
                $documentPaths[] = $path;
            }
        }

        $claim = Claim::create([
            'insurance_policy_id' => $request->insurance_policy_id,
            'claim_number' => Claim::generateClaimNumber(),
            'type' => $request->type,
            'description' => $request->description,
            'incident_date' => $request->incident_date,
            'claim_amount' => $request->claim_amount,
            'supporting_documents' => $documentPaths,
            'status' => 'pending'
        ]);

        return redirect()->route('user.my-policies')
            ->with('success', 'Claim submitted successfully! Claim Number: ' . $claim->claim_number);
    }

    /**
     * Show claim details
     */
    public function show(Claim $claim)
    {
        // Ensure user can only view their own claims or admin can view all
        if (!auth()->user()->isAdmin() && $claim->policy->user_id !== auth()->id()) {
            abort(403);
        }

        return view('claims.show', compact('claim'));
    }

    /**
     * Update claim status (admin only)
     */
    public function update(Request $request, Claim $claim)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected,paid',
            'admin_notes' => 'nullable|string'
        ]);

        $claim->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'processed_by' => auth()->id(),
            'processed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Claim updated successfully');
    }
}