<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Insurance & MLM Platform</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { background: #dc2626; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat { font-size: 2rem; font-weight: bold; color: #dc2626; }
        .nav { background: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .nav a { text-decoration: none; color: #dc2626; margin-right: 20px; font-weight: 500; }
        .nav a:hover { text-decoration: underline; }
        .btn { background: #dc2626; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn:hover { background: #b91c1c; }
        .btn-approve { background: #10b981; }
        .btn-approve:hover { background: #059669; }
        .btn-reject { background: #f59e0b; }
        .btn-reject:hover { background: #d97706; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th, .table td { text-align: left; padding: 12px; border-bottom: 1px solid #eee; }
        .table th { background: #f9fafb; font-weight: 600; }
        .status { padding: 4px 8px; border-radius: 12px; font-size: 12px; color: white; }
        .status.pending { background: #f59e0b; }
        .status.approved { background: #10b981; }
        .status.active { background: #3b82f6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👑 Admin Dashboard</h1>
            <p>Complete platform oversight and management</p>
        </div>

        <div class="nav">
            <a href="{{ route('admin.index') }}">Dashboard</a>
            <a href="{{ route('admin.users') }}">Users</a>
            <a href="{{ route('admin.insurance-packages') }}">Insurance Packages</a>
            <a href="{{ route('admin.claims') }}">Claims</a>
            <a href="{{ route('admin.financials') }}">Financials</a>
            <a href="{{ route('admin.ranks') }}">Ranks</a>
            <a href="{{ route('admin.analytics') }}">Analytics</a>
            <a href="{{ route('admin.settings') }}">Settings</a>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>👥 Total Users</h3>
                <div class="stat">{{ number_format($totalUsers) }}</div>
                <p>Active platform users</p>
                <a href="{{ route('admin.users') }}" class="btn">Manage Users</a>
            </div>

            <div class="card">
                <h3>📋 Insurance Policies</h3>
                <div class="stat">{{ number_format($totalPolicies) }}</div>
                <p>Total policies issued</p>
            </div>

            <div class="card">
                <h3>⚠️ Pending Claims</h3>
                <div class="stat">{{ $pendingClaims }}</div>
                <p>Claims awaiting review</p>
                <a href="{{ route('admin.claims') }}" class="btn">Review Claims</a>
            </div>

            <div class="card">
                <h3>💰 Total Payouts</h3>
                <div class="stat">${{ number_format($totalPayouts, 2) }}</div>
                <p>Commission payments made</p>
            </div>

            <div class="card">
                <h3>⏳ Pending Withdrawals</h3>
                <div class="stat">${{ number_format($pendingWithdrawals, 2) }}</div>
                <p>Awaiting approval</p>
                <a href="{{ route('admin.financials') }}" class="btn">Process Payments</a>
            </div>

            <div class="card">
                <h3>📊 Platform Health</h3>
                <div class="stat">98.5%</div>
                <p>System performance</p>
                <a href="{{ route('admin.analytics') }}" class="btn">View Analytics</a>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
            <div class="card">
                <h3>🚨 Recent Claims (Pending Review)</h3>
                @if($recentClaims->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Claim #</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentClaims->take(5) as $claim)
                        <tr>
                            <td>{{ $claim->claim_number }}</td>
                            <td>{{ $claim->policy->user->name }}</td>
                            <td>{{ ucfirst($claim->type) }}</td>
                            <td>${{ number_format($claim->claim_amount, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.claims.approve', $claim) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-approve">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.claims.reject', $claim) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No pending claims to review.</p>
                @endif
            </div>

            <div class="card">
                <h3>📋 Recent Policies</h3>
                @if($recentPolicies->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Policy #</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Premium</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPolicies->take(5) as $policy)
                        <tr>
                            <td>{{ $policy->policy_number }}</td>
                            <td>{{ $policy->user->name }}</td>
                            <td>{{ ucfirst($policy->package->type) }}</td>
                            <td>${{ number_format($policy->premium_amount, 2) }}</td>
                            <td>
                                <span class="status {{ $policy->status }}">
                                    {{ ucfirst($policy->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No recent policies.</p>
                @endif
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h3>🔧 Quick Admin Actions</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
                <a href="{{ route('admin.insurance-packages') }}" class="btn">Create Insurance Package</a>
                <a href="{{ route('admin.ranks') }}" class="btn">Manage MLM Ranks</a>
                <a href="{{ route('admin.users') }}" class="btn">Add New User</a>
                <a href="{{ route('admin.analytics') }}" class="btn">Fraud Detection</a>
                <a href="{{ route('admin.settings') }}" class="btn">System Settings</a>
                <a href="{{ route('admin.analytics') }}" class="btn">Generate Reports</a>
            </div>
        </div>
    </div>
</body>
</html>