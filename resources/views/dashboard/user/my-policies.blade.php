<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Policies - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: #2563eb; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #2563eb; margin-right: 20px; font-weight: 500; }
        .policy-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; }
        .policy-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .policy-header { padding: 20px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
        .policy-body { padding: 20px; }
        .status-badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; }
        .status-active { background: #10b981; color: white; }
        .status-pending { background: #f59e0b; color: white; }
        .btn { background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; margin: 5px; }
        .btn:hover { background: #1d4ed8; }
        .no-policies { text-align: center; padding: 60px 20px; background: white; border-radius: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 My Insurance Policies</h1>
            <p>Manage your insurance coverage and submit claims</p>
        </div>

        <div class="nav">
            <a href="{{ route('user.index') }}">← Back to Dashboard</a>
            <a href="{{ route('user.insurance-packages') }}">Buy New Insurance</a>
            <a href="{{ route('user.commissions') }}">View Commissions</a>
        </div>

        @if($policies->count() > 0)
        <div class="policy-grid">
            @foreach($policies as $policy)
            <div class="policy-card">
                <div class="policy-header">
                    <h3>{{ $policy->package->name }}</h3>
                    <p>Policy #{{ $policy->policy_number }}</p>
                    <span class="status-badge status-{{ $policy->status }}">
                        {{ ucfirst($policy->status) }}
                    </span>
                </div>
                
                <div class="policy-body">
                    <div style="margin-bottom: 15px;">
                        <strong>Type:</strong> {{ ucfirst($policy->package->type) }} Insurance<br>
                        <strong>Premium:</strong> ${{ number_format($policy->premium_amount, 2) }}/month<br>
                        <strong>Coverage:</strong> ${{ number_format($policy->package->coverage_amount, 2) }}<br>
                        <strong>Deductible:</strong> ${{ number_format($policy->package->deductible, 2) }}
                    </div>

                    <div style="margin-bottom: 15px;">
                        <strong>Start Date:</strong> {{ $policy->start_date->format('M d, Y') }}<br>
                        <strong>End Date:</strong> {{ $policy->end_date->format('M d, Y') }}<br>
                        <strong>Next Payment:</strong> {{ $policy->next_payment_date->format('M d, Y') }}
                    </div>

                    @if($policy->claims->count() > 0)
                    <div style="background: #f9fafb; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                        <strong>Claims ({{ $policy->claims->count() }}):</strong><br>
                        @foreach($policy->claims->take(3) as $claim)
                        <small>{{ $claim->claim_number }} - {{ ucfirst($claim->status) }} - ${{ number_format($claim->claim_amount, 2) }}</small><br>
                        @endforeach
                    </div>
                    @endif

                    <div>
                        <a href="{{ route('claims.create', $policy) }}" class="btn">Submit Claim</a>
                        <a href="#" class="btn" style="background: #6b7280;">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-policies">
            <h2>🛡️ No Insurance Policies Yet</h2>
            <p>You haven't purchased any insurance policies yet. Start protecting yourself and earning commissions today!</p>
            <a href="{{ route('user.insurance-packages') }}" class="btn" style="margin-top: 20px;">Browse Insurance Packages</a>
        </div>
        @endif
    </div>
</body>
</html>